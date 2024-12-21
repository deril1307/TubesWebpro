@extends('layouts.app')
@section('content_box')
    <div class="container">
        <div class="py-5">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="card shadow-lg">
                        <form class="row g-4 p-4" action="{{ route('editedUserProfile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Bagian Gambar -->
                            <div class="col-md-4 text-center">
                                <div class="ratio ratio-1x1 mx-auto" style="max-width: 300px;">
                                    <img id="pro-img" class="img-fluid rounded-circle border border-secondary"
                                        src="{{ !empty($user->Data->image) ? asset('/storage/userdata/' . $user->Data->image) : asset('stockUser.png') }}" 
                                        alt="{{ $user->name }}">
                                </div>
                                <div class="mt-3">
                                    <input class="form-control" name="image" type="file">
                                    <button class="btn btn-danger mt-2" id="rm-img" type="button">
                                        <i class="fa fa-trash"></i> Remove
                                    </button>
                                </div>
                                @error('image')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Bagian Form -->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Nama -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label h6" for="name">Name</label>
                                            <input class="form-control" name="name" type="text" 
                                                placeholder="Your name here" value="{{ $user->name }}">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label h6" for="email">Email</label>
                                            <input class="form-control" name="email" type="email" 
                                                placeholder="Your new email here" value="{{ $user->email }}">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Tentang -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label h6" for="about">About</label>
                                            <textarea class="form-control" name="about" rows="4" 
                                                placeholder="Write something about you...">{{ $user->Data->about ?? '' }}</textarea>
                                            @error('about')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Tombol Simpan -->
                                        <div class="col-12 mt-4 text-end">
                                            <button type="submit" class="btn btn-success btn-lg">
                                                <i class="fa fa-floppy-o"></i> Save Profile
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const removeButton = document.getElementById('rm-img');
            const profileImg = document.getElementById('pro-img');
            const defaultImg = "{{ asset('stockUser.png') }}";

            removeButton.addEventListener('click', function(e) {
                e.preventDefault();

                fetch("{{ route('del_profile_img') }}", {
                    method: "GET",
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        profileImg.src = defaultImg;
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
