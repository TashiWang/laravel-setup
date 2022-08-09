<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles.view')->only('index');
    }
    /**
     * Display a listing of the resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = DB::table('roles as T1')
                ->leftJoin('model_has_roles as T2', 'T2.role_id', '=', 'T1.id')
                ->leftJoin('users as T3', 'T3.id', '=', 'T2.model_id')
                ->select('T1.id as id', 'T1.name as name', DB::raw('COUNT(T3.id) as userCount'))
                ->groupBy('T1.id')
                ->get();

            return Datatables::of($roles)->addColumn('action', function ($role) {
                return '<a href="roles/' . $role->id . '/edit" class="text-uppercase action-btn" id="edit-btn"><i class="fa-solid fa-pen-to-square text-info"></i></a>
                        <a href="roles/' . $role->id . '" class="text-uppercase action-btn ml-2" id="delete-btn"><i class="fas fa-eye text-primary"></i></i></a>
                        <a href="' . url('http://127.0.0.1:8000/setting/roles/') . $role->id . '" class="text-uppercase action-btn ml-2 delete-btn" id="' . $role->id . '" data-token="{{ csrf_token() }}"><i class="fa-solid fa-trash text-danger"></i></a>
                       ';
            })->make();
        }

        $permissions = Permission::select('id', 'name as name')->get();
        return view('system.roles.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::select('id', 'name as name')->get();
        return view('system.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'max:25', 'unique:roles'],
            'permissions' => ['required'],
        ]);
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        if ($request->has('permissions')) {
            foreach ($request->permissions as $permission) {
                $role->givePermissionTo((int) $permission);
            }
        }
        return redirect('/roles')->with('success_msg', 'Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //get all permissions
        $rawPermissions = Permission::orderBy('name')->get();
        $permissions = [];
        if ($rawPermissions->count()) {
            foreach ($rawPermissions as $rawPermission) {
                $permission = explode('.', $rawPermission->name);
                $permissions[$permission[0]][] = [
                    'id' => $rawPermission->id,
                    'name' => $rawPermission->name, //some permissions may not have an action, so set the name to ALL for displaying
                ];
            }
        }
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('system.roles.show', compact('role', 'permissions', 'rolePermissions'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::select('id', 'name as name')->get();
        return view('system.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => ['required', 'max:25'],
            'permissions' => 'required',
        ]);

        if ($request->has('permissions')) {
            foreach ($request->permissions as $permission) {
                $role->givePermissionTo((int) $permission);
            }
        }
        $role->update(['name' => $request->name]);
        return redirect('/roles')->with('success_msg', 'Role created successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['status' => '200']);
    }
}
