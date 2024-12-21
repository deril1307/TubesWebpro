<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Facilities;
use App\Models\gallary;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function not_found()
    {
        $title = "Page Not Found";
        $menu = 'none';

        $data = compact('title', 'menu');
        return view('errors.404', $data);
    }
    public function loginForm()
    {
        $title = "Log In";

        $data = compact('title');
        return view('User.UserLogIn', $data);
    }

    public function login(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'email' => 'required|email|exists:users,email', // Memastikan email ada di database
            'password' => 'required|string', // Pastikan password terisi dan berupa string
        ]);
    
        // Mencari user berdasarkan email
        $user = User::where('email', $request->email)->first();
    
        // Memeriksa apakah password cocok
        if ($user && Hash::check($request->password, $user->password)) {
            // Jika password benar, ambil data terkait dan simpan ke session
            $user = User::with('Data', 'Reviews')->findOrFail($user->id);
            $request->session()->put('user', $user->toArray());
    
            // Arahkan ke halaman beranda pengguna setelah login
            return redirect(route('userHome'));
        } else {
            // Jika password tidak cocok, berikan pesan kesalahan
            return back()->withErrors([
                'password' => 'The provided password is incorrect.',
            ]);
        }
    }
    

    //sending to sign up form
    public function signupForm()
    {
        $title = "Sign In";

        $data = compact('title');
        return view('User.UserSignUp', $data);
    }

    //signing up
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'conf_password' => 'required|same:password'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $user_data = new UserData;
        $user_data->id = $user->id;
        $user_data->save();
        return redirect(route('UserLoginForm'));
    }

    //managing login logout
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect()->back();
    }

    //User Profile Page
    public function userprofile(Request $request)
    {
        $user = $request->session()->get('user');
        $userId = $user['id'];
        $user = User::with('Data')->findOrFail($userId);
        $title = $user->name . " | Profile";
        $menu = "none";

        $data = compact('title', 'menu', 'user');
        return view('User.Profile', $data);
    }
    
  

    
}
