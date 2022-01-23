<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use App\Models\PhotoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class PhotoController extends Controller
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
        $photoCategories = PhotoCategory::where('status', 1)->get();
        $photos = Photo::all();
        return view('backend.photo.managePhoto', compact('photos', 'photoCategories', 'userRoutes'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $photo = new Photo();
        $photo -> created_by      =  $this->user->id;
        $this->savephoto($photo, $request);
        $photo -> save();
        return redirect()->back()->with('message', 'Photo added successfully!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Photo $photo){
        $userRoutes = $this->userRoute;
        $photoCategories = PhotoCategory::all();
        return view('backend.photo.edit-photo', compact('photo', 'photoCategories', 'userRoutes'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Photo $photo){
        $photo -> updated_by      =  $this->user->id;
        $this->savephoto($photo, $request);
        $photo -> save();
        return redirect()->back()->with('message', 'Photo update successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Photo $photo){
        if ($photo->image) {
            if (file_exists($photo->image)) {
                unlink($photo->image);
            }
        }
        $photo->delete();
        return redirect(route('photo.index'))->with('message', 'Photo deleted successfully!');
    }
    public function status($id){
        $photo = Photo::find($id);

        if ($photo->status == 1) {
            $photo->status = 0;
            $message = 'Photo status Unpublished successfully!';
        } else {
            $photo->status = 1;
            $message = 'Photo status Published successfully!';
        }
        $photo->save();
        return redirect()->back()->with('message', $message);
    }
    private function savePhoto($photo, $request){
        $image  = $request->file('image');
        if ($image) {
            if ($photo->image) {
                if (file_exists($photo->image)) {
                    unlink($photo->image);
                }
            }
            $photo->image = $this->imageUpload($image, $this->ImageDirectory());
        }
        $photo->photo_category_id = $request->photo_category_id;
        $photo->description       = $request->description;
        $photo->status            = $request->status;
    }
    private function imageUpload($image, $directory){
//        $type = $image->getClientOriginalExtension();
        $imageName = Str::camel($image->getClientOriginalName());
        $image->move($directory, $imageName);
        return $directory.$imageName;
    }
    private function ImageDirectory() {
        return 'assets/images/image/';
    }
}
