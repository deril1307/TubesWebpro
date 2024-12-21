@push('title')
    Log In 
@endpush
@include('layouts.header')

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
        <!-- Left Section -->
        <div class="col-lg-6 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3 text-primary">Selamat datang di Properti Pedia</h1>
            <p class="col-lg-10 fs-5 text-muted">
                Temukan properti impian Anda dengan mudah di platform kami. Properti Pedia menyediakan berbagai pilihan yang sesuai dengan kebutuhan Anda.
            </p>
        </div>

        <!-- Right Section -->
        <div class="col-md-10 mx-auto col-lg-6">
            <form class="p-4 p-md-5 shadow rounded-3 bg-white" method="POST" action="{{ route('UserLogin') }}">
                @csrf

                <!-- Email Input -->
                <div class="mb-3 position-relative">
                    <label for="email" class="form-label fw-bold">Email address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" class="form-control" name="email" placeholder="name@example.com" required />
                    </div>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" class="form-control" name="password" placeholder="Password" required />
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button class="w-100 btn btn-lg btn-primary" type="submit">Log In</button>

                <hr class="my-4">
               
                <div class="mt-2">
                    <small class="text-muted">Belum memiliki akun? <a href="{{ route('UserSignupForm') }}" class="text-primary">Daftar Sekarang</a></small>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.close')
