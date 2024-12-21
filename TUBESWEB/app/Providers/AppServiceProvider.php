<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\City;
use App\Models\cms;
use App\Models\SiteSettings;
use App\Models\UserData;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Global site settings for layouts and pages
        view()->composer(['layouts.app', 'AdminPanel.layouts.main', 'AdminPanel.AdminUser.AdminLogin', 
                    'User.UserLogIn', 'User.UserSignUp', 'errors.404'], function ($view) {
        $view->with([
            'logo_image' => 'default-logo.png', // Ganti dengan path logo Anda
            'meta_discription' => 'Properti Pedia - Platform Properti Terbaik',
            'brand_title' => 'Properti Pedia',
            'footer_content' => '© 2024 Properti Pedia. Semua Hak Dilindungi.',
            'social_links' => [
                'facebook_url' => 'https://facebook.com/properti-pedia',
                'instagram_url' => 'https://instagram.com/properti-pedia',
                'youtube_url' => 'https://youtube.com/properti-pedia',
                'twitter_url' => 'https://twitter.com/properti-pedia',
            ],
            'contacts' => [
                'site_contact' => '+62 123 4567 890',
                'site_email' => 'contact@propertipedia.com',
            ],
        ]);
    });


        // CMS data for specific pages
        view()->composer(['frontend.home', 'frontend.about', 'frontend.terms'], function ($view) {
            $CMS = [
                'home_title' => 'Selamat Datang di Properti Pedia',
                'about_content' => 'Properti Pedia adalah platform properti terpercaya.',
                'terms_content' => 'Syarat dan ketentuan berlaku untuk semua layanan kami.',
            ];
        
            $view->with(['CMS' => $CMS]);
        });
        

        // Admin user session data
        view()->composer(['AdminPanel.layouts.main'], function ($view) {
            $user = request()->session()->get('AdminUser', null);
            $view->with([
                'user' => $user,
                'status' => $user !== null,
            ]);
        });

   
    // User session data for layouts
    view()->composer(['layouts.app', 'frontend.show'], function ($view) {
        $request = request();
        $user = $request->session()->get('user', null);
        $status = $user !== null;
    
        // Check if the user is Admin or Moderator and set AdminUser session
        if ($status && ($user['type'] === "A" || $user['type'] === "R")) {
            $request->session()->put('AdminUser', $user);
        }
    
        // Fetch categories
        $categories = Category::all();
    
        // Fetch cities where status is active
        $city = City::where('status', 1)->get();
    
        // Pass data to the view
        $view->with([
            'user' => $user,
            'status' => $status,
            'cate' => $categories,
            'city' => $city,
        ]);
    });
    

    // Property and item views
    view()->composer(['frontend.showinitem', 'frontend.property'], function ($view) {
        $user = request()->session()->get('user', null);
        $status = false;

        if (!empty($user['id'])) {
            $user_data = UserData::firstOrCreate(['id' => $user['id']]);
            $saved = json_decode($user_data->saved, true) ?? [];
            $status = true;
        }

        $view->with([
            'user' => $user,
            'status' => $status,
        ]);
    });

    // Default settings
    Schema::defaultStringLength(191);
    Paginator::useBootstrap();

    }
}
