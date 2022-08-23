<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permission.refresh')->only('refresh');
        $this->middleware('permission:permission.view')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $permissions = DB::select("SELECT T1.id as id, T1.name as name FROM permissions T1");

            return Datatables::of($permissions)->addColumn('action', function ($permission) {
                return '<a href="permission/' . $permission->id . '" class="text-uppercase action-btn ml-2" id="delete-btn"><i class="fas fa-eye text-primary"></i></i></a>
                       ';
            })->make();
        }

        $permissions = DB::table('permissions as T1')->select('T1.id', 'T1.name as name')->get();
        return view('system.permissions.index');
    }

    /**
     * Regenerate the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
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
        if (!empty($permissions)) {
            foreach ($permissions as $permission) {
                Permission::updateOrCreate([
                    'name' => $permission,
                ], [
                    'name' => $permission,
                ]);
            }
        }
        //delete existing permissions in the database that are not found from routes
        Permission::whereNotIn('name', $permissions)->delete();
        return redirect()->route('permission.index')->with('success_msg', 'The permissions table has been regenerated.');
    }
}
