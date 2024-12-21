@extends('layouts.app')
@section('content_box')
    <div class="container py-5">
        <div class="row">
            <div class="col-12 mb-3 text-center">
                <h1>{{ $title }}</h1>
            </div>
        </div>
        <form id="filter" class="row g-3" enctype="multipart/form-data">
            <div class="col-12 mb-3">
                <div class="input-group">
                    <span class="input-group-text">Search</span>
                    <input class="form-control fltr" name="search" type="text" placeholder="Search by Name" value="{{ $SecStr ?? '' }}">
                    <button class="btn btn-success" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <span class="input-group-text">Category</span>
                    <select class="form-select fltr" name="category">
                        <option value="*">All</option>
                        @foreach ($cate as $item)
                            <option value="{{ $item->slug_name }}" {{ !empty($cate_fltr) && $cate_fltr == $item->slug_name ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="input-group">
                    <span class="input-group-text">City</span>
                    <select class="form-select fltr" name="city">
                        <option value="*">All</option>
                        @foreach ($city as $item)
                            <option value="{{ $item->slug_city }}" {{ !empty($city_fltr) && $city_fltr == $item->slug_city ? 'selected' : '' }}>{{ $item->city }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="input-group">
                    <span class="input-group-text">Sale/Rent</span>
                    <select class="form-select fltr" name="purpose">
                        <option value="*">All</option>
                        <option value="sale" {{ !empty($purpose_fltr) && $purpose_fltr == 'sale' ? 'selected' : '' }}>Sale</option>
                        <option value="rent" {{ !empty($purpose_fltr) && $purpose_fltr == 'rent' ? 'selected' : '' }}>Rent</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <span class="input-group-text">Sort by</span>
                    <select class="form-select fltr" name="sort">
                        <option value="latest">Latest</option>
                        <option value="oldest">Oldest</option>
                        <option value="phtl">Price High to Low</option>
                        <option value="plth">Price Low to High</option>
                        <option value="ahtl">Area High to Low</option>
                        <option value="alth">Area Low to High</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 mb-2">
                <button class="btn btn-primary w-100" type="submit"><i class="fas fa-filter"></i> Filter</button>
            </div>
        </form>
        <div id="showbox" class="mt-4">
            @include('frontend.showinitem')
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('submit', '#filter', function(e) {
                e.preventDefault();
                var formdata = $('#filter').serializeArray();
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajaxFilter') }}",
                    data: formdata,
                    dataType: "HTML",
                    success: function(response) {
                        $('#showbox').html(response);
                    }
                });
            });
            $(document).on('change keyup', '#filter .fltr', function(e) {
                e.preventDefault();
                var formdata = $('#filter').serializeArray();
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajaxFilter') }}",
                    data: formdata,
                    dataType: "HTML",
                    success: function(response) {
                        $('#showbox').html(response);
                    }
                });
            });

            $(document).on('click', '#showbox .page-link', function(e) {
                e.preventDefault();
                var pagelink = $(this).attr('href');
                var formdata = $('#filter').serializeArray();

                $.ajax({
                    type: "GET",
                    url: pagelink,
                    data: formdata,
                    dataType: "HTML",
                    success: function(response) {
                        $('#showbox').html(response);
                    }
                });
            });
        });
    </script>
@endsection
