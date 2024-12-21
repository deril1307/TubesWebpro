@extends('AdminPanel.layouts.main')
@section('main-section')
<div class="container mt-4">
    <h2>Dashboard</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
    <div class="alert {{ session()->get('msgst') ? 'alert-' . session()->get('msgst') : 'd-none' }}">
        {{ session()->get('msg') }}
    </div>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class=" text-black-50 card-header">Users +{{ $newUsers->count() }}</div>
                <div class="card-body">
                    User baru bulan ini
                    <a class="stretched-link text-white" href="{{ route('list_users') }}">Info selanjutnya...</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class=" text-black-50 card-header">Reviews +{{ $newReviews->count() }}</div>
                <div class="card-body">
                    Review terbaru bulan ini
                    <a class="stretched-link text-white" href="{{ route('list_reviews') }}">Info selanjutnya...</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-dark">
                <div class=" text-black-50 card-header">Properties +{{ $newProperty->count() }}</div>
                <div class="card-body">
                    Properti baru bulan ini
                    <a class="stretched-link text-dark" href="{{ route('list_properties') }}">Info selanjutnya...</a>
                </div>
            </div>
        </div>
    </div>
    <h4 class="mt-5">More Info</h4>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Pengguna</h5>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('list_users') }}">More</a>
                </div>
                <div class="card-body">
                    @forelse ($newUsers->take(6) as $User)
                    <div class="d-flex mb-3">
                        <img class="rounded-circle me-3" src="{{ asset($User->Data->image ?? 'stockUser.png') }}" width="50" alt="User">
                        <div>
                            <div>{{ $User->name }}</div>
                            <a href="mailto:{{ $User->email }}">{{ $User->email }}</a>
                        </div>
                    </div>
                    @empty
                    <p>No new Users this month.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Reviews</h5>
                    <a class="btn btn-sm btn-outline-success" href="{{ route('list_reviews') }}">More</a>
                </div>
                <div class="card-body">
                    @forelse ($newReviews->take(6) as $review)
                    <div class="d-flex mb-3">
                        <img class="rounded-circle me-3" src="{{ asset($review->Users[0]->Data->image ?? 'stockUser.png') }}" width="50" alt="User">
                        <div>{{ $review->Users[0]->name }}: {{ $review->review }}</div>
                    </div>
                    @empty
                    <p>No new reviews this month.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Properties</h5>
                    <a class="btn btn-sm btn-outline-warning" href="{{ route('list_properties') }}">More</a>
                </div>
                <div class="card-body">
                    @forelse ($newProperty->take(6) as $property)
                    <div class="d-flex mb-3">
                        <img class="rounded-circle me-3" src="{{ asset('/storage/property/' . $property->image) }}" width="50" alt="Property">
                        <div>
                            <div>{{ $property->title }}</div>
                            <a href="{{ route('edit_properties', $property->id) }}">See more</a>
                        </div>
                    </div>
                    @empty
                    <p>No new properties this month.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
