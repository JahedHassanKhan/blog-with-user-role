<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\CompanyInfo;
use App\Models\Photo;
use App\Models\PhotoCategory;
use App\Models\Post;
use App\Models\PostView;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontEndHomeController extends Controller
{
    public function index(Request $request)
    {
        $mostView = Post::with('user')->where('created_at','>=', now()->subdays(1))->orderBy('views', 'desc')->latest()->paginate(5);
        $company = CompanyInfo::first();
        $banglaCategories = Category::where('main_category', 1)->get();
        $englishCategories = Category::where('main_category', 2)->get();
        $norwegianCategories = Category::where('main_category', 3)->get();
        $categories = Category::where('status',1);
        $tags = Tag::where('status',1);
        $sliderPosts = Post::with('tags', 'categories')->where('status',1)->orderBy('id', 'DESC')->take(3)->get();
        $allPosts = Post::with('tags', 'categories')->where('status', 1)->orderBy('id', 'DESC')->get();
        $posts = Post::where([
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if ($term = $request->term) {
                    $query->orWhere('title', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])->with('tags', 'categories')->where('status', 1)->orderBy('id', 'DESC')->paginate(6);

        return view('frontend.home', compact('posts', 'sliderPosts', 'tags', 'allPosts', 'categories', 'englishCategories', 'norwegianCategories', 'banglaCategories', 'company'));
    }
    public function singlePost(Post $post)
    {
//        return $post->categories ;
        $company = CompanyInfo::first();
        $banglaCategories = Category::where('main_category', 1)->get();
        $englishCategories = Category::where('main_category', 2)->get();
        $norwegianCategories = Category::where('main_category', 3)->get();
        $categories = Category::all();
        $tags = Tag::all();
        $allPosts = Post::with('tags', 'categories')->where('status', 1)->orderBy('id', 'DESC')->get();
        $previous = Post::where('id', '<', $post->id)->where('status', 1)->orderBy('id', 'desc')->first();
        $next = Post::where('id', '>', $post->id)->where('status', 1)->orderBy('id', 'asc')->first();

//        Some bits from the following query ("category", "user") are made for my own application, but I felt like leaving it for inspiration.
        if($post->showPost()){// this will test if the user viwed the post or not
            PostView::createViewLog($post);
            return view('frontend.single-post', compact('post',  'tags', 'allPosts', 'previous', 'next', 'categories', 'englishCategories', 'norwegianCategories', 'banglaCategories', 'company'));
        }

        $post->increment('views');//I have a separate column for views in the post table. This will increment the views column in the posts table.
        PostView::createViewLog($post);
        return view('frontend.single-post', compact('post',  'tags', 'allPosts', 'previous', 'next', 'categories', 'englishCategories', 'norwegianCategories', 'banglaCategories', 'company'));



//        return view('frontend.single-post', compact('post',  'tags', 'allPosts', 'previous', 'next', 'categories', 'englishCategories', 'norwegianCategories', 'banglaCategories', 'company'));
    }

    public function categoryPost(Request $request, $slug)
    {
        $company = CompanyInfo::first();
        $banglaCategories = Category::where('main_category', 1)->get();
        $englishCategories = Category::where('main_category', 2)->get();
        $norwegianCategories = Category::where('main_category', 3)->get();
        $allPosts = Post::with('tags', 'categories')->where('status', 1)->orderBy('id', 'DESC')->get();
        $category = Category::where('slug', $slug)->first();
        $categories = Category::all();
        $tags = Tag::all();
        $posts = Post::where('status', 1 && 'category_id', $category->id)->paginate(6);
//        $posts = $category->posts->where('status', 1)->paginate(1);

        return view('frontend.category-post', compact('allPosts', 'posts', 'tags', 'category', 'company', 'categories', 'englishCategories', 'norwegianCategories', 'banglaCategories'));
    }
    public function photoPage()
    {
        $company = CompanyInfo::first();
        $banglaCategories = Category::where('main_category', 1)->get();
        $englishCategories = Category::where('main_category', 2)->get();
        $norwegianCategories = Category::where('main_category', 3)->get();
        $allPosts = Post::with('tags', 'categories')->where('status', 1)->orderBy('id', 'DESC')->get();
        $categories = Category::all();
        $tags = Tag::all();
        $posts = Post::where('status', 1)->get();
        $photos = Photo::where('status', 1)->paginate(30);
        $photoCategories = PhotoCategory::where('status', 1)->get();
        // $results = [];
        // foreach ($posts as $key => $post) {
        //     $temps = [];
        //     foreach ($post->categories as $key1 => $postCategory) {
        //         $temps[$key1]['category_name'] = $postCategory->category_name;
        //     }
        //     $results[$key]['post_image'] = $post->post_image;
        //     $results[$key]['temps'] = $temps;
        // }
        // return view('frontend.photo-page', compact('allPosts', 'posts', 'results', 'tags', 'posts', 'categories', 'englishCategories', 'norwegianCategories', 'banglaCategories'));

        return view('frontend.photo-page', compact('allPosts', 'posts', 'tags', 'posts', 'categories', 'englishCategories', 'norwegianCategories', 'banglaCategories', 'photos', 'photoCategories', 'company'));
    }
    public function author(Request $request, $id, $auth)
    {

        $banglaCategories = Category::where('main_category', 1)->get();
        $englishCategories = Category::where('main_category', 2)->get();
        $norwegianCategories = Category::where('main_category', 3)->get();
        $company = CompanyInfo::first();
        $allPosts = Post::with('tags', 'categories')->where('status', 1)->orderBy('id', 'DESC')->get();
        $user = User::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        $posts = Post::where('status', 1 && 'created_by', $id)->paginate(4);
        return view('frontend.author', compact('allPosts', 'tags', 'posts', 'user', 'categories', 'englishCategories', 'norwegianCategories', 'banglaCategories', 'company', 'auth'));
    }
}
