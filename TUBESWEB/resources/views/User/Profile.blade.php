@extends('layouts.app')
@section('content_box')
    <div class="container">
        <div class="py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 mb-3">
                    <div class="card shadow-sm border-0">
                        <div class="row g-0 align-items-center">
                            <!-- Bagian Gambar -->
                            <div class="col-12 col-md-4 text-center p-4">
                                <div class="ratio ratio-1x1">
                                    <img class="img-fluid rounded-circle border border-secondary"
                                         src="{{ !empty($user->Data->image) ? asset('/storage/userdata/' . $user->Data->image) : asset('stockUser.png') }}"
                                         alt="{{ $user->name }}">
                                </div>
                            </div>
                            <!-- Bagian Informasi -->
                            <div class="col-12 col-md-8 p-4">
                                <div class="d-flex flex-column h-100">
                                    <!-- Informasi Dasar -->
                                    <div>
                                        <h1 class="text-primary mb-1">{{ $user->name }}</h1>
                                        <p class="text-muted mb-3">{{ $user->email }}</p>
                                    </div>
                                    <!-- Bagian Tentang -->
                                    <div>
                                        <h5 class="text-secondary">About:</h5>
                                        <p class="text-dark">{{ $user->Data->about ?? '' }}</p>
                                    </div>
                                    <!-- Tombol Aksi -->
                                    <div class="mt-auto d-flex flex-wrap gap-2">
                                        <a class="btn btn-success" href="{{ route('editUserProfile') }}">
                                            <i class="fas fa-edit"></i> Edit Profile
                                        </a>
                                        <a class="btn btn-primary" href="{{ route('user_chng_password') }}">
                                            <i class="fas fa-key"></i> Change Password
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
