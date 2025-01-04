<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Facilities;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    //auth starts

    // Mengirim ke database
    public function dashboard(Request $request)
    {
        $title = 'Dashboard';
        $menu = 'dashboard';
        $newUsers = User::with('Data')->whereMonth('created_at', Carbon::now()->month)->latest()->get();
        $newReviews = Reviews::with('Users')->whereMonth('created_at', Carbon::now()->month)->latest()->get();
        $newProperty = Property::whereMonth('created_at', Carbon::now()->month)->latest()->get();
        $data = compact('title', 'menu', 'newUsers', 'newReviews', 'newProperty');
        return view('AdminPanel.dashboard.dashboard')->with($data);
    }
    // halaman login
    public function loginPage()
    {
    return view('AdminPanel.AdminUser.AdminLogin', [
        'title' => 'Log In',
        'status' => false,
    ]);
    }

    //logging In
    public function login(Request $request)
    {
    // Validasi input
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required',
    ]);

    // Cari pengguna berdasarkan email
    $user = User::where('email', $request->email)->first();

    // Periksa kecocokan password
    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'Password yang dimasukkan salah.']);
    }

    // Ambil data lengkap pengguna dengan relasi
    $user = User::with('Data', 'Reviews')->find($user->id);

    // Cek tipe pengguna dan arahkan ke halaman yang sesuai
    if (in_array($user->type, ['A', 'R'])) {
        $request->session()->put('AdminUser', $user->toArray());
        return redirect()->route('AdminHome');
    }

    return redirect()->route('userHome');
    }


    public function logout(Request $request)
    {   
        $request->session()->forget('AdminUser');
        return redirect()->route('UserLogin');
    }
    //auth ends


    //category starts
    public function list_category(Request $request)
    {
        return view('AdminPanel.category.list', [
            'title' => 'Category List',
            'menu' => 'category',
            'cate' => Category::latest()->get(),
        ]);
    }
    

    public function add_category(Request $request)
    {
    return view('AdminPanel.category.form', [
        'title' => 'Add Category',
        'menu' => 'category',
    ]);
    }


    public function category_added(Request $request)
{
    $request->validate([
        'name' => 'required|unique:categories,name',
        'image' => 'required|mimes:png,jpg'
    ]);

    $cate = new Category;
    $cate->name = $request->name;
    $cate->slug_name = \Str::slug($request->name);  // Use Str helper for slug
    $cate->image = $this->storeImage($request->file('image')); 
    $cate->save();
    $request->session()->flash('msg', 'Added...');
    $request->session()->flash('msgst', 'success');

    return redirect()->route('list_category');
}

private function storeImage($image)
{
    if ($image) {
        $iname = date('Ym') . '-' . rand() . '.' . $image->extension();
        $image->storeAs('public/images', $iname);
        return $iname;
    }

    return null; // In case image is not provided
}


public function del_category(Request $request)
{
    $id = $request->route()->parameter('id');

    // Validasi ID kategori
    $valid = validator(['id' => $id], [
        'id' => 'exists:categories,id'
    ])->validate();

    if ($valid) {
        $cate = Category::findOrFail($id);

        // Cek apakah ada properti yang terkait dengan kategori
        if (Property::where('category', $id)->exists()) {
            $request->session()->flash('msg', 'Can not delete this category, there are properties listed in this category');
            $request->session()->flash('msgst', 'danger');
        } else {
            // Hapus gambar dan kategori
            Storage::delete('public/images/' . $cate->image);
            $cate->delete();
            $request->session()->flash('msg', 'Deleted...');
            $request->session()->flash('msgst', 'success');
        }
    }

    return redirect(route('list_category'));
}



    public function edit_category($id)
    {
        $cate = Category::findOrFail($id);
        
        return view('AdminPanel.category.form', [
            'title' => 'Edit Category',
            'menu'  => 'category',
            'cate'  => $cate,
        ]);
    }
    
    

    public function category_edited(Request $request)
    {
        $valid = validator($request->route()->parameters(), [
            'id' => 'exists:categories,id'
        ])->validate();
        
        $id = $request->route()->parameter('id');
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'image' => 'mimes:png,jpg'
        ]);

        $cate = Category::findorfail($id);
        $cate->name = $request->name;
        $cate->slug_name = str_slug($request->name);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $iname = date('Ym') . '-' . rand() . '.' . $image->extension();
            Storage::delete('public/images/' . $cate->image);
            $store = $image->storeAs('public/images', $iname);
            if ($store) {
                $cate->image = $iname;
            }
        }
        $cate->save();

        $request->session()->flash('msg', 'Edited...');
        $request->session()->flash('msgst', 'success');

        return redirect(route('list_category'));
    }
    //category ends


    //Cities Starts
    public function list_cities(Request $request)
    {
        $title = "Cities List";
        $menu = "cities";
        $city = City::latest()->get();

        $data = compact('title', 'menu', 'city');
        return view('AdminPanel.cities.list', $data);
    }



    public function add_cities(Request $request)
    {
        $title = "Add Cities";
        $menu = "cities";

        $data = compact('title', 'menu');
        return view('AdminPanel.cities.form', $data);
    }

    public function cities_added(Request $request)
{
    // Validasi input
    $request->validate([
        'city' => 'required|unique:cities,city',
        'status' => 'boolean'
    ]);

    // Membuat city baru dan menyimpan data
    $city = new City;
    $city->city = $request->city;
    $city->slug_city = str_slug($request->city);
    $city->status = $request->status ?? 0; // Menggunakan null coalescing operator untuk status
    $city->save();

    // Menampilkan pesan sukses
    $request->session()->flash('msg', 'Added...');
    $request->session()->flash('msgst', 'success');

    // Redirect ke halaman list cities
    return redirect(route('list_cities'));
}


public function del_cities(Request $request)
{
    $id = $request->route()->parameter('id');

    // Validasi ID city
    validator(['id' => $id], [
        'id' => 'exists:cities,id'
    ])->validate();

    $city = City::findOrFail($id);

    // Cek apakah ada properti yang terkait dengan city
    if (Property::where('city', $id)->exists()) {
        $request->session()->flash('msg', 'Cannot delete this city, there are properties listed in this city');
        $request->session()->flash('msgst', 'danger');
    } else {
        // Hapus city
        $city->delete();
        $request->session()->flash('msg', 'Deleted...');
        $request->session()->flash('msgst', 'success');
    }

    return redirect(route('list_cities'));
}

    public function edit_cities(Request $request)
    {
        $valid = validator($request->route()->parameters(), [
            'id' => 'exists:cities,id'
        ])->validate();
        $id = $request->route()->parameter('id');

        if ($valid) {
            $city = City::findorfail($id);
        }

        $title = "Edit Cities";
        $menu = "cities";

        $data = compact('title', 'menu', 'city');
        return view('AdminPanel.cities.form', $data);
    }

    public function cities_edited(Request $request)
{
    $id = $request->route()->parameter('id');

    // Validasi ID dan input
    $request->validate([
        'id' => 'exists:cities,id',
        'city' => 'required|unique:cities,city,' . $id,
        'status' => 'boolean'
    ]);

    $city = City::findOrFail($id);
    $city->city = $request->city;
    $city->slug_city = str_slug($request->city);
    $city->status = $request->status ?? 0; // Gunakan null coalescing untuk status default
    $city->save();

    // Set pesan sukses
    $request->session()->flash('msg', 'Edited...');
    $request->session()->flash('msgst', 'success');

    // Redirect ke halaman list cities
    return redirect(route('list_cities'));
}
    //Cities Ends

    //Facilities starts
    public function list_facilities(Request $request)
    {
        return view('AdminPanel.facilities.list', [
            'title' => 'Facilities List',
            'menu' => 'facilities',
            'faci' => Facilities::latest()->get(),
        ]);
    }

    public function add_facilities(Request $request)
    {
        $title = "Add Facility";
        $menu = "facilities";

        $data = compact('title', 'menu');
        return view('AdminPanel.facilities.form', $data);
    }

    public function facilities_added(Request $request)
    {
        $valid = $request->validate([
            'faci' => 'required|unique:facilities,faci',
        ]);

        $faci = new Facilities;
        $faci->faci = $request->faci;
        $faci->save();

        $request->session()->flash('msg', 'Added...');
        $request->session()->flash('msgst', 'success');

        return redirect(route('list_facilities'));
    }

    public function del_facilities(Request $request)
    {
        $valid = validator($request->route()->parameters(), [
            'id' => 'exists:facilities,id'
        ])->validate();
        $id = $request->route()->parameter('id');

        if ($valid) {
            $faci = Facilities::findorfail($id);
            $faci->delete();
        }

        $request->session()->flash('msg', 'Deleted...');
        $request->session()->flash('msgst', 'danger');

        return redirect(route('list_facilities'));
    }

    public function edit_facilities(Request $request)
    {
        $id = $request->route()->parameter('id');
    
        // Validasi ID fasilitas
        $request->validate([
            'id' => 'exists:facilities,id',
        ]);
    
        // Ambil data fasilitas
        $faci = Facilities::findOrFail($id);
    
        // Set judul dan menu
        $title = "Edit Facility";
        $menu = "facilities";
    
        // Kirim data ke view
        return view('AdminPanel.facilities.form', compact('title', 'menu', 'faci'));
    }
    

    public function facilities_edited(Request $request)
    {
    $id = $request->route()->parameter('id');

    // Validasi ID dan input
    $request->validate([
        'id' => 'exists:facilities,id',
        'faci' => 'required|unique:facilities,faci,' . $id,
    ]);

    // Update data fasilitas
    $faci = Facilities::findOrFail($id);
    $faci->faci = $request->faci;
    $faci->save();

    // Set pesan sukses
    $request->session()->flash('msg', 'Edited...');
    $request->session()->flash('msgst', 'success');

    // Redirect ke halaman list facilities
    return redirect(route('list_facilities'));
    }
    //Facilities ends

    //Properties starts
    public function list_properties(Request $request)
    {
        $title = "Properties List";
        $menu = "properties";
        $pro = Property::with('Cate', 'City')->latest()->get();

        $data = compact('title', 'menu', 'pro');
        return view('AdminPanel.properties.list', $data);
    }
    
    public function add_properties(Request $request)
    {
        $title = "Add Property";
        $menu = "properties";
        $city = City::select('id', 'city')->where('status', '=', '1')->get();
        $cate = Category::select('id', 'name')->get();
        $faci = Facilities::select('*')->get();

        $data = compact('title', 'menu', 'city', 'cate', 'faci');
        return view('AdminPanel.properties.form', $data);
    }



     //Gallary starts
     public function list_gallary(Request $request)
     {
         $title = "Images Gallary";
         $menu = "gallary";
 
         $gal = gallary::with('Property')->latest()->get();
 
         $data = compact('title', 'menu', 'gal');
         return view('AdminPanel.gallary.list', $data);
     }
 
     public function get_gallary(Request $request)
     {
         $title = "Images Gallary";
         $menu = "gallary";
 
         $valid = validator($request->route()->parameters(), [
             'id' => 'exists:properties,id'
         ])->validate();
         $id = $request->route()->parameter('id');
         $pro = Property::where('id', $id)->first();
         $gal = gallary::with('Property')->where('pro_id', '=', $id)->get();
 
         $data = compact('title', 'menu', 'pro', 'gal', 'id');
         return view('AdminPanel.gallary.list', $data);
     }
 
     public function set_gallary(Request $request)
     {
   
     $request->validate([
         'gallary.*' => 'image|mimes:png,jpg|max:2048',  
         'id' => 'exists:properties,id'  
     ]);
 
     $id = $request->route()->parameter('id');
     $images = $request->file('gallary');
     foreach ($images as $img) {
         $iname = date('Ym') . '-' . Str::random(10) . '.' . $img->extension();
         $path = $img->storeAs('public/gallary/' . $id, $iname);
 
         // Save the image path to the database
         if ($path) {
             Gallary::create([
                 'pro_id' => $id,
                 'gal_image' => $iname
             ]);
         }
     }
 
     // Redirect to the gallery page after saving the images
     return redirect()->route('get_gallary', ['id' => $id]);
     }
 
     
     public function del_gallary(Request $request)
     {
     $request->validate([
         'id' => 'exists:properties,id',
         'gid' => 'exists:gallaries,id'
     ]);
     $id = $request->route()->parameter('id');
     $gid = $request->route()->parameter('gid');
     $gal = Gallary::findOrFail($gid);
     if ($gal->gal_image) {
         $imagePath = 'public/gallary/' . $id . '/' . $gal->gal_image;
         if (Storage::exists($imagePath)) {
             Storage::delete($imagePath);
         }
     }
     $gal->delete();
     $request->session()->flash('msg', 'Image Deleted Successfully.');
     $request->session()->flash('msgst', 'danger');
     return redirect()->back();
     }
     //Gallary ends


     //Reviews starts
    public function list_reviews(Request $request)
    {
        $title = "Reviews List";
        $menu = "reviews";

        $reviews = Reviews::with('Users', 'Property')
            ->latest()
            ->get();
        $data = compact('title', 'menu', 'reviews');
        return view('AdminPanel.reviews.list', $data);
    }

    public function get_reviews(Request $request)
    {
        $title = "Reviews List";
        $menu = "reviews";

        $valid = validator($request->route()->parameters(), [
            'id' => 'exists:properties,id'
        ])->validate();
        $id = $request->route()->parameter('id');
        $pro = Property::where('id', $id)->first();
        $reviews = Reviews::with('Users', 'Property')
            ->where('pro_id', $id)
            ->latest()
            ->get();
   

        $data = compact('title', 'menu', 'pro', 'reviews', 'id');
        return view('AdminPanel.reviews.list', $data);
    }
    
    public function del_reviews(Request $request)
    {
        $valid = validator($request->route()->parameters(), [
            // 'id' => 'exists:properties,id',
            'rid' => 'exists:reviews,id'
        ])->validate();
        // $id = $request->route()->parameter('id');
        $rid = $request->route()->parameter('rid');

        if ($valid) {
            $rev = Reviews::findorfail($rid);
            $rev->delete();
        }

        $request->session()->flash('msg', 'Deleted...');
        $request->session()->flash('msgst', 'danger');

        // return redirect(route('get_reviews', $id));
        return redirect()->back();
    }
    //Reviews ends

    //Users starts
    public function list_users(Request $request)
    {
        $title = "Users List";
        $menu = "users";
        $user = $request->session()->get('AdminUser');
        $usersData = User::with('Data')->where('type', '!=', 'R')->latest()->get()->except($user['id']);

        $data = compact('title', 'menu', 'usersData');
        return view('AdminPanel.users.list', $data);
    }

    public function del_users(Request $request)
    {
        $valid = validator($request->route()->parameters(), [
            'id' => 'exists:users,id'
        ])->validate();
        $id = $request->route()->parameter('id');

        if ($valid) {
            $usersData = User::findorfail($id);
            $user_data = UserData::findorfail($id);
            Storage::delete('public/userdata/' . $user_data->image);
            $user_reviews = Reviews::where('u_id', $id);
            $user_reviews->delete();
            $usersData->delete();
            $user_data->delete();
        }

        $request->session()->flash('msg', 'Deleted...');
        $request->session()->flash('msgst', 'danger');

        return redirect(route('list_users'));
    }

    public function update_user_type(Request $request)
    {
        $request->validate([
            'user_type' => 'required|array',
            'user_type.*' => 'required|in:A,U',
        ]);
    
        foreach ($request->user_type as $id => $type) {
            $user = User::find($id);
            if ($user) {
                $user->type = $type;
                $user->save();
            }
        }
    
        return redirect()->back()->with('msg', 'User types updated successfully')->with('msgst', 'success');
    }
    
    //Users ends



    //Chng Password Starts
    public function chng_password(Request $request)
    {
        $title = "Change Password";
        $menu = "chng_password";

        $data = compact('title', 'menu');
        return view('AdminPanel.chng_password.form', $data);
    }
    public function save_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);
        $id = $request->session()->get('AdminUser')['id'];
        $user = User::findOrFail($id);

        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->forget('AdminUser');

        return redirect()->back();
    }
    //Chng Password Ends

}
