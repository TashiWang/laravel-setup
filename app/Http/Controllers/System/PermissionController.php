<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;

class PermissionController extends Controller
{
    public function __construct()
    {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $permissions = DB::table('permissions as T1')->select('T1.id', 'T1.name')->get();

            return Datatables::of($permissions)->addColumn('action', function ($permission) {
                return '<a href="permissions/' . $permission->id . '/edit" class="text-uppercase action-btn" id="edit-btn"><i class="fa-solid fa-pen-to-square text-info"></i></a>
                        <a href="permissions/' . $permission->id . '" class="text-uppercase action-btn ml-2" id="delete-btn"><i class="fas fa-eye text-primary"></i></i></a>
                        <a href="' . url('http://127.0.0.1:8000/permissions/') . $permission->id . '" class="text-uppercase action-btn ml-2 delete-btn" id="' . $permission->id . '" data-token="{{ csrf_token() }}"><i class="fa-solid fa-trash text-danger"></i></a>
                       ';
            })->make();
        }

        // dd(DB::table('permissions as T1')->select('T1.id', 'T1.name')->get());

        return view('system.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->json(['status' => '200']);
    }


    public function refresh(Request $request)
    {
        //get the permissions from all routes through their middleware
        $permissions = [];
        $routes = app('router')->getRoutes();
        //loop through each router and gather the middleware for each route
        foreach ($routes as $route) {
            $middlewares = $route->gatherMiddleware();
            if (!empty($middlewares)) {
                foreach ($middlewares as $middleware) {
                    //check if $middleware is string and has permission: pattern
                    if (is_string($middleware) && preg_match('/.*permission:(.*)$/', $middleware, $matches) === 1) {
                        //permission middleware may have many OR operators eg: permission:user_add|user_edit, we separate those individual permission
                        $matches = explode('|', $matches[1]);
                        foreach ($matches as $match) {
                            //if permission not already in the permissions array, add it
                            if (!in_array($match, $permissions)) {
                                $permissions[] = $match;
                            }
                        }
                    }
                }
            }
        }
        //add these permissions to the database if they do not already exist
        if (!empty($permissions)){
            foreach ($permissions as $permission) {
                Permission::updateOrCreate([
                    'name' => $permission
                ], [
                    'name' => $permission
                ]);
            }
        }
        //delete existing permissions in the database that are not found from routes
        Permission::whereNotIn('name', $permissions)->delete();
        return redirect()->route('permission.index')->with('msg_success', 'The permissions table has been regenerated.');
    }
}
