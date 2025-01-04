@extends('AdminPanel.layouts.main')
@section('main-section')
    <div class="container">
        <div class="container-fluid">
            <div class="mt-4">
                <h2 class="text-primary">{{ $pro->title ?? '' }} Reviews</h2>
                <div aria-label="breadcrumb mt-5">
                    <ol class="breadcrumb bg-light p-2 rounded">
                        <li class="breadcrumb-item" aria-current="page">Reviews</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
            
            <!-- Session Message -->
            <div class="{{ session()->get('msgst') ? 'alert alert-' . session()->get('msgst') : 'm-0 border-0 p-0' }}">
                {{ session()->get('msg') ?? null }}
            </div>

            <div class="mt-4">
                <table class="table table-hover table-bordered table-striped align-middle" id="data">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Property</th>
                            <th scope="col">User</th>
                            <th scope="col">Review</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reviews as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->Property->title }}</td>
                                <td>
                                    <i class="fas fa-user-circle text-info me-2"></i>{{ $item->Users[0]->name }}
                                </td>
                                <td>
                                    <p class="text-muted small">{{ $item->review }}</p>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger btn-sm" onclick="return confirm('Sure to delete?')"
                                        href="{{ route('del_reviews', $item->id) }}">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-dark">Belum Terdapat Review</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
