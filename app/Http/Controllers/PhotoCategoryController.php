<?php

namespace App\Http\Controllers;

use App\Models\PhotoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class PhotoCategoryController extends Controller
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
        $userRoutes = $this->userRoute;
        $categories = PhotoCategory::get();
        return view('backend.photo-category.manageCategory', compact('categories', 'userRoutes'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $category = new PhotoCategory();
        $category -> created_by      =  $this->user->id;
        $category -> slug            =  Str::slug($request->name . '-' . Carbon::now()->format('Y' . 'm' . 'd' . 'h' . 'm' . 's' . 'v'));
        $this->savePhotoCategory($category, $request);
        $category -> save();
        return redirect()->back()->with('message', 'PhotoCategory added successfully!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhotoCategory  $photoCategory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(PhotoCategory $photoCategory)
    {
        $userRoutes = $this->userRoute;
//        $photoCategory = PhotoCategory::find($photoCategory->id);
        return view('backend.photo-category.edit-category', compact('photoCategory', 'userRoutes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PhotoCategory  $photoCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PhotoCategory $photoCategory)
    {
        $photoCategory -> updated_by      =  $this->user->id;
        $this->savePhotoCategory($photoCategory, $request);
        $photoCategory -> save();
        return redirect()->back()->with('message', 'PhotoCategory updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhotoCategory  $photoCategory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(PhotoCategory $photoCategory)
    {
        $photoCategory->delete();
        return redirect(route('photo-category.index'))->with('message', 'PhotoCategory deleted successfully!');
    }
    public function status($id)
    {
        $category = PhotoCategory::find($id);
        if ($category->status == 1) {
            $category->status = 0;
            $message = 'PhotoCategory status Unpublished successfully!';
        } else {
            $category->status = 1;
            $message = 'PhotoCategory status Published successfully!';
        }
        $category->save();
        return redirect()->back()->with('message', $message);
    }


    private function savePhotoCategory($category, $request){
        $category -> name               =       $request->name;
        $category -> status             =       $request->status;
    }
}
