<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::with('createdBy', 'updatedBy')->get();
        return view('backend.category.manageCategory', compact('categories'));
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
        $category = new Category();
        $category -> created_by      =  $this->user->id;
        $this->saveCategory($category, $request);
        $category -> save();
        return redirect()->back()->with('message', 'Category add successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Category $category)
    {
        $category->updated_by   =   $this->user->id;
        $this->saveCategory($category, $request);
        $category->save();

        return redirect(route('category.index'))->with('message', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Category $category)
    {
        unlink($category->category_image);
        $category->delete();
        return redirect(route('category.index'))->with('message', 'Category deleted successfully');
    }

    public function status($id){
        $category = Category::find($id);

        if ($category->status == 1 ){
            $category->status = 0;
            $message = 'Category status Unpublished successfully!';
        }else{
            $category->status = 1;
            $message = 'Category status Published successfully!';
        }
        $category->save();
        return redirect()->back()->with('message', $message);
    }

    private function saveCategory($category, $request){
        $image  = $request->file('image');
        if ($image) {
            if ($category->image) {
                if (file_exists($category->image)) {
                    unlink($category->image);
                }
            }
            $category->image = $this->imageUpload($image, $this->categoryImageDirectory());
        }
        $category -> main_category      =       $request->main_category;
        $category -> name               =       $request->name;
        $category -> slug               =       Str::slug($request->name);
        $category -> status             =       $request->status;
    }

    private function imageUpload($image, $directory){
//        $type = $image->getClientOriginalExtension();
        $imageName = Str::camel($image->getClientOriginalName());
        $image->move($directory, $imageName);
        return $directory.$imageName;
    }
    private function categoryImageDirectory() {
        return 'assets/images/category-image/';
    }
}
