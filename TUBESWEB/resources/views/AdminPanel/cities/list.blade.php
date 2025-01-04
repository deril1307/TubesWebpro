@extends('AdminPanel.layouts.main')
@section('main-section')
    <div class="container py-5">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Cities</h2>
            <a class="btn btn-primary" href="{{ route('add_cities') }}">
                <i class="fa fa-plus"></i> Add City
            </a>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Cities</li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>

        <!-- Alert Message -->
        @if (session()->has('msg'))
            <div class="alert alert-{{ session('msgst') ?? 'info' }} alert-dismissible fade show" role="alert">
                {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Cities Table -->
        <div class="card mt-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">City List</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">City Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($city as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->city }}</td>
                                <td>
                                    <span class="badge bg-{{ $item->status ? 'success' : 'danger' }}">
                                        {{ $item->status ? 'Active' : 'Disabled' }}
                                    </span>
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{ route('edit_cities', $item->id) }}" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @if (session()->get('AdminUser')['type'] == 'R')
                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this city?')" href="{{ route('del_cities', $item->id) }}" title="Delete">
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
            // Automatically hide alert messages after 3 seconds
            setTimeout(function() {
                $('.alert').fadeOut();
            }, 3000);
        });
    </script>
@endsection
