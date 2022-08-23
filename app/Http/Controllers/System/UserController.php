<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user.view')->only('index');
        $this->middleware('permission:user.create')->only('store');
        $this->middleware('permission:user.edit')->only('update');
        $this->middleware('permission:user.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = DB::select("SELECT
            T1.id AS id,
            T1.name AS name,
            T1.email AS email,
            T3.name AS role,
            DATE_FORMAT(T1.created_at, '%D %M %Y %h:%i %p') AS created_at
            FROM users T1
            LEFT JOIN model_has_roles T2 ON T1.id = T2.model_id
            LEFT JOIN roles T3 ON T2.role_id = T3.id");

            return Datatables::of($users)->addColumn('action', function ($user) {
                return '<a href="user/' . $user->id . '/edit" class="text-uppercase action-btn" id="edit-btn"><i class="fa-solid fa-pen-to-square text-info"></i></a>
                        <a href="user/' . $user->id . '" class="text-uppercase action-btn ml-2" id="delete-btn"><i class="fas fa-eye text-primary"></i></i></a>
                        <a href="' . url('http://127.0.0.1:8000/setting/user/') . $user->id . '" class="text-uppercase action-btn ml-2 delete-btn" id="' . $user->id . '" data-token="{{ csrf_token() }}"><i class="fa-solid fa-trash text-danger"></i></a>
                       ';
            })->make();
        }

        return view('system.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = DB::table('roles')->select('id', 'name')->get();
        return view('system.users.create', compact('roles'));
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
            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required'],
        ]);

        $data = $request->only('name', 'email');
        $data['password'] = Hash::make(str_random(8));
        $user = User::create($data);

        if ($request->has('role')) {
            $user->assignRole((int) $request->role);
        }

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $roles = Role::orderBy('id')->get();
        $userRole = $user->roles->pluck('id')->toArray();

        return view('system.users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required'],
        ]);

        $data = $request->only('name', 'email');
        $user->update($data);

        $user->assignRole((int) $request->role);

        return redirect()->route('user.index')->with('success_msg', 'User has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json(['status' => '200']);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
