<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Type;

class UserPermissionController extends Controller
{
    private $user ;
    private $userRoute ;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $this->user = $user;
            $userRoles = $user->roles;
            $userRoute = [];
            foreach ($user->roles as $role){
                foreach ($role->roleRoutes as $routes){
                    array_push($userRoute, $routes->route_name);
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

    public function getUserList(){
        $users = User::where('status', 1)->where( 'type', 0)->get();
        $roles   = Role::all();
        return view('backend.user-list.user-list', compact('users', 'roles'));
    }
    public function editUser($user){
        $user = User::find($user);
        $roles   = Role::all();
        return view('backend.user-list.edit-user', compact('user', 'roles'));
    }
    public function updateUser(Request $request, User $user){

        $user->roles()->sync($request->roles);
        return redirect(route('user-list'));
    }
    public function getBannedUserList(){
        $users = User::where('status', 0)->where( 'type', 0)->get();
        $roles   = Role::all();
        return view('backend.user-list.banned-user-list', compact('users', 'roles'));
    }
    public function status($id)
    {
        $user = User::find($id);
        if ($user->status == 1) {
            $user->status = 0;
            $message = 'User Banned successfully!';
        } else {
            $user->status = 1;
            $message = 'User Unbanned successfully!';
        }
        $user->save();
        return redirect()->back()->with('message', $message);
    }
}
