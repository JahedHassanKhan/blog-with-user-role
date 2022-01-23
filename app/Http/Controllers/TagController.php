<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class TagController extends Controller
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
    public function index(){
        $userRoutes = $this->userRoute;
        $tags = Tag::with('createdBy', 'updatedBy')->get();
        return view('backend.tag.manage-tag', compact('tags', 'userRoutes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $tag = new Tag();
        $tag -> created_by      =  $this->user->id;
        $tag -> slug            =       Str::slug($request->name . '-' . Carbon::now()->format('Y' . 'm' . 'd' . 'h' . 'm' . 's' . 'v'));
        $this->saveTag($tag, $request);
        $tag -> save();
        return redirect()->back()->with('message', 'Tag add successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Tag $tag)
    {
        $userRoutes = $this->userRoute;
        return view('backend.tag.edit-tag', compact('tag', 'userRoutes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->updated_by   =   $this->user->id;
        $this->saveTag($tag, $request);
        $tag->save();

        return redirect(route('tag.index'))->with('message', 'Tag updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect(route('tag.index'))->with('message', 'Tag deleted successfully');
    }

    public function status($id){
        $tag = Tag::find($id);
        if ($tag->status == 1 ){
            $tag->status = 0;
            $message = 'Tag status Unpublished successfully!';
        }else{
            $tag->status = 1;
            $message = 'Tag status Published successfully!';
        }
        $tag->save();
        return redirect()->back()->with('message', $message);
    }
    private function saveTag($tag, $request){
        $tag -> name               =       $request->name;
        $tag -> status             =       $request->status;
    }
}
