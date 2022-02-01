<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyInfoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontEndHomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PhotoCategoryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserPermissionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/register', [AuthController::class, 'registerForm'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::get('/login', [AuthController::class, 'loginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/personal-information', [DashboardController::class, 'personalInformation'])->middleware('auth')->name('personal-information');
Route::post('/personal-information', [DashboardController::class, 'personalInformationUpdate'])->middleware('auth')->name('personal-information.store');
Route::get('/change-password', [DashboardController::class, 'changePasswordForm'])->middleware('auth')->name('change-password');
Route::post('/change-password', [DashboardController::class, 'changePassword'])->middleware('auth')->name('change-password');

Route::resource('/role', RoleController::class)->middleware(['auth','checkRole']);
Route::get('/change-role-status/{role}', [RoleController::class, 'status'])->middleware(['auth','checkRole'])->name('role.status');
Route::get('/user-list', [UserPermissionController::class, 'getUserList'])->middleware('auth','checkRole')->name('user-list');
Route::get('/banned-user-list', [UserPermissionController::class, 'getBannedUserList'])->middleware('auth','checkRole')->name('banned-user-list');
Route::get('/edit-user/{user}', [UserPermissionController::class, 'editUser'])->middleware('auth','checkRole')->name('edit-user');
Route::post('/edit-user/{user}', [UserPermissionController::class, 'updateUser'])->middleware('auth','checkRole')->name('update-user');
Route::get('/change-user-status/{id}', [UserPermissionController::class, 'status'])->middleware(['auth','checkRole'])->name('user.status');

Route::resource('/category', CategoryController::class)->middleware(['auth','checkRole']);
Route::get('/change-category-status/{id}', [CategoryController::class, 'status'])->middleware(['auth','checkRole'])->name('category.status');

Route::resource('/tag', TagController::class)->middleware(['auth','checkRole']);
Route::get('/change-tag-status/{id}', [TagController::class, 'status'])->middleware(['auth','checkRole'])->name('tag.status');

Route::resource('/post', PostController::class)->middleware(['auth','checkRole']);
Route::get('/change-post-status/{id}', [PostController::class, 'status'])->middleware(['auth','checkRole'])->name('post.status');
Route::get('/all-post-table', [PostController::class, 'allPostTable'])->middleware(['auth','checkRole'])->name('all-post-table');
Route::get('/set-category-by-main-category', [PostController::class, 'setCategory'])->middleware(['auth','checkRole'])->name('set-category-by-main-category');

Route::resource('/photo-category', PhotoCategoryController::class)->middleware(['auth','checkRole']);
Route::get('/change-photo-category-status/{id}', [PhotoCategoryController::class, 'status'])->middleware(['auth','checkRole'])->name('photoCategory.status');

Route::resource('/photo', PhotoController::class)->middleware(['auth','checkRole']);
Route::get('/change-photo-status/{id}', [PhotoController::class, 'status'])->middleware(['auth','checkRole'])->name('photo.status');

Route::get('/company', [CompanyInfoController::class, 'index'])->name('company.index')->middleware(['auth']);
Route::post('/company', [CompanyInfoController::class, 'store'])->name('company')->middleware(['auth']);

//Route::get('/', function () {
//    return view('welcome');
//})->name('/');

Route::get('/', [FrontEndHomeController::class, 'index'])->name('/') ;
Route::get('/blogPost/{post}', [FrontEndHomeController::class, 'singlePost'])->name('blogPost');
Route::get('/category/{category}', [FrontEndHomeController::class, 'categoryPost'])->name('categoryPost');
Route::get('/gallery', [FrontEndHomeController::class, 'photoPage'])->name('photoPage');
Route::get('/author/{id}', [FrontEndHomeController::class, 'author'])->name('author');

Route::post('/reply/{id}', [ReplyController::class, 'store'])->middleware(['auth'])->name('reply');
Route::post('/reply-reply/{reply}', [ReplyController::class, 'replyReply'])->middleware(['auth'])->name('replyReply');

Route::middleware('auth')->group(function () {
    Route::post('like', [LikeController::class,'like'])->name('like');
    Route::delete('like', [LikeController::class,'unlike'])->name('unlike');
});
