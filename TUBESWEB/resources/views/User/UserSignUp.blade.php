@push('title')
    Sign Up 
@endpush
@include('layouts.header')


<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3 text-primary">Selamat Datang<br /> Properti Pedia</h1>
            <p class="col-lg-10 fs-4">
                
            </p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-light" method="POST" action="{{ route('UserSignup') }}">

                @csrf
                <x-log-input type="text" name="name" label="User Name" placeholder="name@example.com" />
                <x-log-input type="email" name="email" label="Email address" placeholder="name@example.com" />
                <x-log-input type="password" name="password" label="Password" placeholder="Password" />
                <x-log-input type="password" name="conf_password" label="Confirm Password" placeholder="Password" />
                {{-- <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div> --}}
                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up</button>
                <hr class="my-4">
                <small class="text-muted">Already have an account? <a href="{{ route('UserLoginForm') }}">Log In</a></small>
            </form>
        </div>
    </div>
</div>

@include('layouts.close')
