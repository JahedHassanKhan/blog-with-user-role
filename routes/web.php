<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
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



Route::get('/', function () {
    return view('welcome');
})->name('/');
