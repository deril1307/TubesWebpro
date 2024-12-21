@extends('layouts.app')
@section('content_box')
    <div class="container">
        <div class="py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">Change Password</h3>
                        </div>
                        <form action="{{ route('user_save_password') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="old_password" class="form-label fw-semibold">Old Password</label>
                                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" 
                                           id="old_password" name="old_password" placeholder="Enter your old password">
                                    @error('old_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="new_password" class="form-label fw-semibold">New Password</label>
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                               id="new_password" name="new_password" placeholder="Enter your new password">
                                        @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="new_password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
                                        <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                                               id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm your new password">
                                        @error('new_password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-save me-2"></i>Change Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
