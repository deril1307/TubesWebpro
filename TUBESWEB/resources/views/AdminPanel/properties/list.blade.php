@extends('AdminPanel.layouts.main')
@section('main-section')
    <div class="container py-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Properties</h2>
            <a class="btn btn-primary" href="{{ route('add_properties') }}">Add Property</a>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Properties</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>

        <!-- Alert Message -->
        @if (session()->has('msg'))
            <div class="alert alert-{{ session('msgst') ?? 'info' }} alert-dismissible fade show" role="alert">
                {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Properties Table -->
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Property List</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Public</th>
                            <th>Property</th>
                            <th>Price</th>
                            <th>Featured</th>
                            <th>Purpose</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>City</th>
                            <th>Gallery</th>
                            <th>Reviews</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pro as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td class="{{ $item->public == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $item->public == 1 ? 'Public' : 'Hidden' }}
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ number_format($item->price) }}</td>
                                <td class="{{ $item->featured == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $item->featured == 1 ? 'Active' : 'Disabled' }}
                                </td>
                                <td>{{ ucfirst($item->purpose) }}</td>
                                <td>{{ $item->Cate->name }}</td>
                                <td>
                                    <img height="30" class="rounded" style="cursor: pointer"
                                         data-fancybox="gallery"
                                         src="{{ asset('/storage/property/' . $item->image) }}" alt="Image">
                                </td>
                                <td>{{ $item->City->city }}</td>
                                <td>
                                    <a href="{{ route('get_gallary', $item->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-images"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('get_reviews', $item->id) }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-comment-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('edit_properties', $item->id) }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @if (session()->get('AdminUser')['type'] == 'R')
                                        <a href="{{ route('del_properties', $item->id) }}" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Sure to delete?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.alert').fadeOut(3000); // Auto hide alert after 3 seconds
            Fancybox.bind("[data-fancybox='gallery']", {}); // Initialize Fancybox for gallery
        });
    </script>
@endsection
