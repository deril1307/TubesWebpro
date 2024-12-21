@extends('AdminPanel.layouts.main')
@section('main-section')
    <div class="container py-5">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">Categories</h2>
            <a href="{{ route('add_category') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Add Category
            </a>
        </div>

        <!-- Alert Message -->
        @if (session('msg'))
            <div class="alert alert-{{ session('msgst') }} alert-dismissible fade show" role="alert">
                {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Categories Table -->
        <table class="table table-bordered table-hover mt-4">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cate as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ asset('storage/images/' . $category->image) }}" data-fancybox="gallery">
                                <img src="{{ asset('storage/images/' . $category->image) }}" alt="Category Image" height="40" class="rounded">
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('edit_category', $category->id) }}" class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            @if (session('AdminUser')['type'] === 'R')
                                <a href="{{ route('del_category', $category->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => document.querySelector('.alert')?.classList.add('d-none'), 3000);
        });
    </script>
@endsection
