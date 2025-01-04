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

//Menampilkan Properti
Route::get('/property/category/{cate}', [UserController::class, 'show_category'])->name('show_category');
Route::get('/property/city/{city}', [UserController::class, 'show_city'])->name('show_city');
Route::get('/property/purpose/{purpose}', [UserController::class, 'show_purpose'])->name('show_purpose');
Route::get('/property', [UserController::class, 'show'])->name('show');

//Search Properti Ajax
Route::get('/property/ajaxFilter', [UserController::class, 'ajaxFilter'])->name('ajaxFilter');
Route::get('/property/{pro}', [UserController::class, 'show_pro'])->name('show_pro');
Route::post('/property/propSearch', [UserController::class, 'propSearch'])->name('propSearch');


//Check User Middleware
Route::middleware([UserCheck::class])->group(function () {
    //User profile
    Route::get('/user/profile', [UserController::class, 'userprofile'])->name('UserProfile');
    Route::get('/user/profile/edit', [UserController::class, 'edituserprofile'])->name('editUserProfile');
    Route::post('/user/profile/edit', [UserController::class, 'editeduserprofile'])->name('editedUserProfile');
    Route::get('/user/profile/del_profile_img', [UserController::class, 'del_profile_img'])->name('del_profile_img');

    //Menambahkan Review in Property
    Route::post('/user/review', [UserController::class, 'add_review'])->name('add_review');
    Route::get('/user/review/delete/{id?}', [UserController::class, 'del_review'])->name('del_review');

    //Ubah Password
    Route::get('/user/chng-password', [UserController::class, 'user_chng_password'])->name('user_chng_password');
    Route::post('/user/chng-password', [UserController::class, 'user_save_password'])->name('user_save_password');
});


//AdminPanel 
//admin login
Route::get('/admin/login', [AdminController::class, 'loginPage'])->name('AdminLoginPage');
Route::post('/admin/login', [AdminController::class, 'login'])->name('AdminLogin');

//Admin Route
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
  

    //Fasilitas
    Route::get('/admin/facilities', [AdminController::class, 'list_facilities'])->name('list_facilities');
    Route::get('/admin/facilities/add', [AdminController::class, 'add_facilities'])->name('add_facilities');
    Route::post('/admin/facilities/add', [AdminController::class, 'facilities_added'])->name('facilities_added');

    Route::get('/admin/facilities/{id}/del', [AdminController::class, 'del_facilities'])->name('del_facilities');
    Route::get('/admin/facilities/{id}/edit', [AdminController::class, 'edit_facilities'])->name('edit_facilities');
    Route::post('/admin/facilities/{id}/edit', [AdminController::class, 'facilities_edited'])->name('facilities_edited');
    

    //Properti
    Route::get('/admin/properties', [AdminController::class, 'list_properties'])->name('list_properties');
    Route::get('/admin/properties/add', [AdminController::class, 'add_properties'])->name('add_properties');
    Route::post('/admin/properties/add', [AdminController::class, 'properties_added'])->name('properties_added');

    Route::get('/admin/properties/{id}/del', [AdminController::class, 'del_properties'])->name('del_properties');
    Route::get('/admin/properties/{id}/edit', [AdminController::class, 'edit_properties'])->name('edit_properties');
    Route::post('/admin/properties/{id}/edit', [AdminController::class, 'properties_edited'])->name('properties_edited');
    

    //Galarry
    Route::get('/admin/gallary', [AdminController::class, 'list_gallary'])->name('list_gallary');
    Route::get('/admin/properties/{id}/gallary', [AdminController::class, 'get_gallary'])->name('get_gallary');
    Route::post('/admin/properties/{id}/gallary', [AdminController::class, 'set_gallary'])->name('set_gallary');
    Route::get('/admin/properties/{id}/gallary/{gid}', [AdminController::class, 'del_gallary'])->name('del_gallary');
   
    //reviews 
    Route::get('/admin/reviews', [AdminController::class, 'list_reviews'])->name('list_reviews');
    Route::get('/admin/properties/{id}/reviews', [AdminController::class, 'get_reviews'])->name('get_reviews');
    Route::get('/admin/reviews/del/{rid}', [AdminController::class, 'del_reviews'])->name('del_reviews');
    

    //Users 
    Route::get('/admin/users', [AdminController::class, 'list_users'])->name('list_users');
    Route::get('/admin/users/{id}/del', [AdminController::class, 'del_users'])->name('del_users');
    Route::post('/admin/update_user_type', [AdminController::class, 'update_user_type'])->name('admin.update_user_type');
    

    Route::get('/admin/chng-password', [AdminController::class, 'chng_password'])->name('chng_password');
    Route::post('/admin/chng-password', [AdminController::class, 'save_password'])->name('save_password');
   
});
Route::get('/{any}', [UserController::class, 'not_found'])->where('any', '.*');
