<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class PostController extends Controller
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
        $categories = Category::where('status', 1)->get();
        $tags       = Tag::where('status', 1)->get();
        $posts      = Post::with('categories', 'tags')->get();

        return view('backend.post.all-post-table', compact('posts', 'categories', 'tags', 'userRoutes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $userRoutes = $this->userRoute;
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.post.create-post', compact('categories', 'tags', 'userRoutes'));
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
            $post = new Post();
            $post->created_by = $this->user->id;
            $post->slug = Str::slug($request->title . '-' . Carbon::now()->format('Y' . 'm' . 'd' . 'h' . 'm' . 's' . 'v'));
            $this->savePost($post, $request);
            $post->save();
            $post->tags()->sync($request->tags);
            $post->categories()->sync($request->categories);
            return redirect()->back()->with('message', 'Post created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message', 'Post does not create successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        $userRoutes = $this->userRoute;
        return view('backend.post.single-post', compact('post', 'userRoutes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Post $post)
    {
        $userRoutes = $this->userRoute;
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.post.edit-post', compact('post', 'categories', 'tags', 'userRoutes'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
//        try {
            $post->updated_by = $this->user->id;
            $this->savePost($post, $request);
            $post->save();
            $post->tags()->sync($request->tags);
            $post->categories()->sync($request->categories);
            return redirect()->back()->with('message', 'Post created successfully!');
//        } catch (\Exception $e) {
//            DB::rollBack();
//            return redirect()->back()->with('message', 'Post does not create successfully!');
//        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Post $post)
    {
        if ($post->post_image) {
            if (file_exists($post->post_image)) {
                unlink($post->post_image);
            }
        }
        $post->delete();

        return redirect(route('post.index'))->with('message', 'Post deleted successfully!');
    }
    public function allPostTable(Request $request)
    {
        $postYears= Post::get()->groupBy(function($val) {
                return Carbon::parse($val->created_at)->format('Y');
            })->toArray();
        $userRoutes = $this->userRoute;
        $tags   =   Tag::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $posts = Post::where([
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if ($term = $request->term) {
                    $query->orWhere('title', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])->with('categories', 'tags')->paginate(10);

        return view('backend.post.all-post', compact('posts', 'categories', 'tags', 'userRoutes', 'postYears'));
    }
    public function status($id)
    {
        $post = Post::find($id);
        if ($post->status == 1) {
            $post->status = 0;
            $message = 'Post status Unpublished successfully!';
        } else {
            $post->status = 1;
            $message = 'Post status Published successfully!';
        }
        $post->save();
        return redirect()->back()->with('message', $message);
    }
    public function setCategory(Request $request)
    {
        $main_category = $_GET['main_category'];
        $categories = Category::where('main_category', $main_category)->get();
        return json_encode($categories);
    }
    private function savePost($post, $request){
        $image  = $request->file('image');
        if ($image) {
            if ($post->image) {
                if (file_exists($post->image)) {
                    unlink($post->image);
                }
            }
            $post->image = $this->imageUpload($image, $this->postImageDirectory());
        }
        $post->title           =   $request->title;
        $post->body            =   $request->body;
    }

    private function imageUpload($image, $directory){
//        $type = $image->getClientOriginalExtension();
        $imageName = Str::camel($image->getClientOriginalName());
        $image->move($directory, $imageName);
        return $directory.$imageName;
    }
    private function postImageDirectory() {
        return 'assets/images/post-image/';
    }
}
