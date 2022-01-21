<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    private $user ;
    private $userRoute ;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $this->user = $user;
            $userRoles = $user->roles;
            $userRoute = [];
            if($user->type == 1){
                foreach (Route::getRoutes()->getRoutes() as $key => $route){
                    array_push($userRoute, $route->getName());
                }
            } else{
                foreach ($user->roles as $role){
                    foreach ($role->roleRoutes as $routes){
                        array_push($userRoute, $routes->route_name);
                    }
                }
            }
            $this->userRoute = $userRoute;
            $request->merge(compact('userRoute'));
            if (Auth::user()->type === 1){
                return $next($request);
            } elseif (Auth::user()->status == 1){
                return $next($request);
            }
            return redirect()->route('/')->send();
        });
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $userRoutes     = $this->userRoute;
        $roles          =   Role::with('roleRoutes')->get();
        $routeLists     =   Route::getRoutes();
        $result         =   [];
        foreach ($routeLists->getRoutes() as $key => $routelist) {
            $routeMiddlware = $routelist->middleware();
            foreach ($routeMiddlware as $key => $m) {
                if ($m == 'checkRole') {
                    array_push($result, $routelist);
                }
            }
        }
        return view('backend.role.index', [
            'routeLists'    => $result,
            'roles'         => $roles,
            'userRoutes'    => $userRoutes,
        ]);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $role               =   new Role();
            $role->created_by   =   $this->user->id;
            $this->saveRole($role, $request);
            $role->save();
            $this->saveRoute($request, $role);
            return redirect()->back()->with('message', 'New Role has been created!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message', 'Some problem here Please try again!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Role $role)
    {
        $userRoutes = $this->userRoute;
//        $role          =   Role::with('roleRoutes')->find($id);
        $routeLists     =   Route::getRoutes();
        $result         =   [];
        foreach ($routeLists->getRoutes() as $key => $routelist) {
            $routeMiddlware = $routelist->middleware();
            foreach ($routeMiddlware as $key => $m) {
                if ($m == 'checkRole') {
                    array_push($result, $routelist);
                }
            }
        }
        return view('backend.role.edit', [
            'routeLists'    => $result,
            'role'         => $role,
            'userRoutes'    => $userRoutes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Role $role)
    {
        try {
            $user = Auth::user();
            $role->updated_by         = $this->user->id;
            $this->saveRole($role, $request);
            $role->save();
            $role->roleRoutes()->delete();
            $this->saveRoute($request, $role);
            return redirect(\route('role.index'))->with('message', 'Role has been updated!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message', 'Some problem here Please try again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('message', 'Role has been deleted successfully!');

    }
    public function status($id)
    {
        $role = Role::find($id);
//        return $role;
        if ($role->status == 1) {
            $role->status = 0;
            $message = 'Role status Unpublished successfully!';
        } else {
            $role->status = 1;
            $message = 'Role status Published successfully!';
        }
        $role->save();
        return redirect()->back()->with('message', $message);
    }

    private function saveRole($role, $request){
        $role->name         =   $request->name;
        $role->slug         =   Str::slug($request->name);
        $role->description  =   $request->description;
    }

    private function saveRoute($request, $role){
        foreach ($request->route_name as $item) {
            foreach (Route::getRoutes()->getRoutes() as $key => $route) {
                if ($route->getName() == $item) {
                    $action = $route->getActionName();
                    $routeName = $route->getName();

                    // separating controller and method
                    $_action = explode('@', $action);
                    $controller = $_action[0];
                    $method = end($_action);

                    $roleRoute = new RoleRoute();
                    $roleRoute->role_id = $role->id;
                    $roleRoute->role_name = $role->name;
                    $roleRoute->route_name = $item;
                    $roleRoute->controller = $controller;
                    $roleRoute->method = $method;
                    $roleRoute->save();
                }
            }
        }
    }
}
