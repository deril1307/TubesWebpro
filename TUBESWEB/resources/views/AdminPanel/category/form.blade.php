@extends('AdminPanel.layouts.main')
@section('main-section')
    <div class="container py-5">
        <!-- Page Title -->
        <h2 class="fw-bold mb-4">@if (!empty($cate)) Edit @else Add @endif Category</h2>

        <!-- Breadcrumb -->
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Category</li>
                <li class="breadcrumb-item active">@if (!empty($cate)) Edit @else Add @endif</li>
            </ol>
        </nav>

        <!-- Form Card -->
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">@if (!empty($cate)) Edit @else Add @endif Category</h4>
            </div>
            <div class="card-body">
                <form action="@if (!empty($cate)){{ route('category_edited', $cate->id) }}@else{{ route('category_added') }}@endif" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Category Name -->
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" value="@if (!empty($cate)){{ $cate->name }}@else{{ old('name') }}@endif" required>
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category Image -->
                    <div class="mb-3">
                        <label class="form-label">Category Image</label>
                        <p class="text-muted small">For best output, upload a [400 x 225] image.</p>
                        <input type="file" name="image" class="form-control" @if (empty($cate)) required @endif>
                        @error('image')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Display Old Image (if editing) -->
                    @if (!empty($cate))
                        <div class="mb-3">
                            <label class="form-label">Old Image</label>
                            <img src="{{ asset('/storage/images/' . $cate->image) }}" alt="Category Image" class="img-fluid rounded">
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button type="submit" class="btn @if (!empty($cate)) btn-success @else btn-primary @endif">
                        @if (!empty($cate)) Update @else Submit @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
