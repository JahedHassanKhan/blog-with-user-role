<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
//        if (Auth::guard('admin')->check()){
//            return $next($request);
//        }
        if ($user->type == 1){
            return $next($request);
        }
        $roles = $user->roles;
        foreach ($roles as $role){
            $permissions = $role->roleRoutes;
            $actionName = class_basename($request->route()->getActionname());
            foreach ($permissions as $permission){
                $_namespaces_chunks = explode('\\', $permission->controller);
                $controller = end($_namespaces_chunks);
                if ($actionName == $controller . '@' . $permission->method){
                    return $next($request);
                }
            }
        }
        return redirect()->back()->with('message', 'you are not permitted');
    }
}
