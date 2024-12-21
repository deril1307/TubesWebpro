<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\UserCheck;

//User Controller

// 404
Route::get('/404', [UserController::class, 'not_found'])->name('not_found');

//Pendaftaran User
Route::get('/signup', [UserController::class, 'signupForm'])->name('UserSignupForm');
Route::post('/signup', [UserController::class, 'signup'])->name('UserSignup');

//Login User
Route::get('/login', [UserController::class, 'loginForm'])->name('UserLoginForm');
Route::post('/login', [UserController::class, 'login'])->name('UserLogin');

//user logout
Route::get('/logout', [UserController::class, 'logout'])->name('UserLogout');

//User home
Route::get('/', [UserController::class, 'userHome'])->name('userHome');

//Check User Middleware
Route::middleware([UserCheck::class])->group(function () {



});


//AdminPanel 

//admin login
Route::get('/admin/login', [AdminController::class, 'loginPage'])->name('AdminLoginPage');
Route::post('/admin/login', [AdminController::class, 'login'])->name('AdminLogin');

//Admin Route
//checking admin is logged
Route::middleware(AuthCheck::class)->group(function () {
    //Admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('AdminHome');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('AdminLogout');

    //Kategori
    Route::get('/admin/category', [AdminController::class, 'list_category'])->name('list_category');
    Route::get('/admin/category/add', [AdminController::class, 'add_category'])->name('add_category');
    Route::post('/admin/category/add', [AdminController::class, 'category_added'])->name('category_added');

    Route::get('/admin/category/{id}/del', [AdminController::class, 'del_category'])->name('del_category');
    Route::get('/admin/category/{id}/edit', [AdminController::class, 'edit_category'])->name('edit_category');
    Route::post('/admin/category/{id}/edit', [AdminController::class, 'category_edited'])->name('category_edited');
    

    //Cities
    Route::get('/admin/cities', [AdminController::class, 'list_cities'])->name('list_cities');
    Route::get('/admin/cities/add', [AdminController::class, 'add_cities'])->name('add_cities');
    Route::post('/admin/cities/add', [AdminController::class, 'cities_added'])->name('cities_added');

    Route::get('/admin/cities/{id}/del', [AdminController::class, 'del_cities'])->name('del_cities');
    Route::get('/admin/cities/{id}/edit', [AdminController::class, 'edit_cities'])->name('edit_cities');
    Route::post('/admin/cities/{id}/edit', [AdminController::class, 'cities_edited'])->name('cities_edited');
  
});
Route::get('/{any}', [UserController::class, 'not_found'])->where('any', '.*');
