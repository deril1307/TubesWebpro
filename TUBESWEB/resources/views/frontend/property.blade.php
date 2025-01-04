@extends('layouts.app')
@section('content_box')
    <div class="container">
        <div class="py-5">
            {{-- <div class="row">
                <div class="col-12 mb-3">
                    <h1>{{ $title }}</h1>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="card mb-3 p-0">
                        <div class="row g-0 mb-2 ">
                            <div class="col-md-4">
                                {{-- <a href="#"> --}}
                                    <img class="img-fluid rounded-start h-100 w-100" style="cursor: pointer" data-fancybox="gallery"
                                        data-src="{{ asset('/storage/property/' . $item->image) }}"
                                        src="{{ asset('/storage/property/' . $item->image) }}" alt="{{ $item->title }}">
                                {{-- </a> --}}
                            </div>
                            <div class="col-md-8">
    <div class="card-body">
        <div class="row">
            <!-- Title Section -->
            <div class="col-12 mb-3">
                <a class="btn p-0 text-secondary" href="{{ route('show_pro', $item->title_slug) }}">
                    <h1 class="card-title">{{ $title }}</h1>
                </a>
            </div>

            <!-- Category and City Section -->
            <div class="col-12 mb-3">
                <p class="card-text mb-1">
                    <a class="btn btn-sm btn-outline-dark" href="{{ route('show_category', $item->Cate->slug_name) }}">
                        {{ $item->Cate->name }}
                    </a>
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('show_city', $item->City->slug_city) }}">
                        {{ $item->City->city }}
                    </a>
                </p>
                <div class="col-12 mb-3 w-75">
                    <p class="card-text" style="text-align: justify">{{ $item->description }}</p>
                </div>
            </div>

            <!-- Rooms and Bathrooms -->
            <div class="col-12 mb-3">
                <p class="card-text">
                    <i class="fas fa-bed"></i> {{ $item->rooms }}
                    <i class="fas fa-shower"></i> {{ $item->bathrooms }}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row g-0 mb-2 border-bottom card-body">
    <!-- Purpose and Price Section -->
    <div class="col-4">
        <div class="card-body">
            <h4 class="card-title">
                <i class="fas fa-shopping-cart"></i> {{ ucfirst($item->purpose) }}
            </h4>
        </div>
    </div>
    <div class="col-8">
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <h5 class="card-title"><i class="fas fa-tag"></i> Price :</h5>
                </div>
                <div class="col-10">
                    <h5 class="card-text">
                        Rp {{ number_format($item->price) }}
                        @if ($item->purpose != 'sale')
                            /month
                        @endif
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery and Video Section -->
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="row">
                                    @if (!empty($gals))
                                        <div class="col-12 mb-3">
                                            <h5 class="card-title"><i class="fas fa-images"></i> :</h5>
                                            <div class="carousel">
                                                @forelse ($gals as $gal)
                                                    <div class="carousel__slide">
                                                        <img class="w-100 rounded" src="{{ asset('/storage/gallary/' . $gal->pro_id . '/' . $gal->gal_image) }}" 
                                                            data-fancybox="gallery" 
                                                            alt="Gallery Image">
                                                    </div>
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty($item->video))
                                        <div class="col-12 mb-2">
                                            <h5 class="card-title"><i class="fab fa-youtube"></i> Video :</h5>
                                            {!! $item->video !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Area, Floorplan, and Facilities -->
                        <div class="col-md-5">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Area -->
                                    <div class="col-12 mb-3">
                                        <h5 class="d-flex align-items-center text-info">
                                            <i class="fas fa-th-large me-2"></i> Luas Area:
                                        </h5>
                                        <p class="ms-4">{{ number_format($item->area) }} m2</p>
                                    </div>

                                    <!-- Floorplan -->
                                    @if (!empty($item->floorplan))
                                        <div class="col-12 mb-3">
                                            <h5 class="d-flex align-items-center text-warning">
                                                <i class="fas fa-drafting-compass me-2"></i> Floorplan: 
                                            </h5>
                                            <img class="img-fluid rounded border shadow-sm" 
                                                src="{{ asset('/storage/property/' . $item->floorplan) }}" 
                                                data-fancybox="gallery" 
                                                alt="Floorplan">
                                        </div>
                                    @endif

                                    <!-- Facilities -->
                                    @if (!empty($faci))
                                        <div class="col-12 mb-3">
                                            <h5 class="d-flex align-items-center text-success">
                                                <i class="fas fa-shapes me-2"></i> Facilities:
                                            </h5>
                                            @foreach ($faci as $fac)
                                                @if ($fac)
                                                    <button class="btn btn-{{ $fac->color }} btn-sm m-1">
                                                        {!! $fac->fa !!} {{ $fac->faci }}
                                                    </button>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Contact -->
                                    <div class="col-12 mb-3">
                                        <!-- Contact Section -->
                                        <h5 class="d-flex align-items-center text-primary">
                                            <i class="fas fa-address-book me-2"></i> Contact Information
                                        </h5>
                                        <div class="row g-3">
                                            <!-- Phone Contact -->
                                            <div class="col-6">
                                                <a href="tel:{{ $item->cont_ph }}" class="btn btn-success w-100 d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-phone-alt me-2"></i>
                                                    <span>Call: {{ $item->cont_ph }}</span>
                                                </a>
                                            </div>
                                            <!-- Email Contact -->
                                            <div class="col-6">
                                                <a href="mailto:{{ $item->cont_em }}" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-envelope me-2"></i>
                                                    <span>Email: {{ $item->cont_em }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="row g-0 mb-2 border-bottom card-body">
                            <div class="col-12">
                                <div class="card-body">
                                    <!-- Address Section -->
                                    <h5 class="card-title d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt me-2 text-danger"></i> Address
                                    </h5>
                                    <p class="card-text ms-4 text-muted">
                                        {{ $item->address }}
                                    </p>

                                    <!-- Map Section (if available) -->
                                    @if (!empty($item->map))
                                        <h5 class="card-title d-flex align-items-center mt-4">
                                            <i class="fas fa-map me-2 text-success"></i> Interactive Map
                                        </h5>
                                        <div class="ms-4">
                                            <div class="map-container border rounded shadow-sm">
                                                {!! $item->map !!}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>



                        <div class="row g-0 mb-3 card-body">
                                <!-- Reviews Header -->
                                <div class="col-12 mb-3">
                                    <h5 class="card-title d-flex align-items-center text-primary">
                                        <i class="fas fa-comment-alt me-2"></i> Reviews
                                    </h5>
                                </div>

                                <!-- Review Form -->
                                @if ($status)
                                    <div class="col-12 mb-3">
                                        <form action="" id="review_form" class="card border-0 shadow-sm p-3">
                                            @csrf
                                            <div class="row align-items-start">
                                                <div class="col-1 text-center">
                                                    <a href="{{ route('UserProfile') }}">
                                                        <img class="rounded-circle"
                                                            src="{{ !empty($user['data']['image'])? asset('/storage/userdata/' . $user['data']['image']): asset('stockUser.png') }}"
                                                            width="60px" alt="User Image">
                                                    </a>
                                                    <a href="{{ route('UserProfile') }}" class="text-decoration-none">
                                                        <p class="m-0 text-muted small">{{ $user['name'] }}</p>
                                                    </a>
                                                </div>
                                                <div class="col-11">
                                                    <textarea name="review_text" id="review_form_input" class="form-control" rows="3"
                                                            placeholder="Enter your review here..." required></textarea>
                                                    <div class="mt-2 text-end">
                                                        <button class="btn btn-success btn-sm">Submit</button>
                                                        <button id="review_cancel" class="btn btn-outline-danger btn-sm ms-2">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- User Reviews -->
                                    @forelse ($user_reviews as $userrev)
                                        <div id="review{{ $userrev['id'] }}" class="col-12 mb-3">
                                            <div class="card border-0 shadow-sm p-3">
                                                <div class="row align-items-start">
                                                    <div class="col-1 text-center">
                                                        <a href="{{ route('UserProfile') }}">
                                                            <img class="rounded-circle"
                                                                src="{{ !empty($user['data']['image'])? asset('/storage/userdata/' . $user['data']['image']): asset('stockUser.png') }}"
                                                                width="60px" alt="User Image">
                                                        </a>
                                                        <a href="{{ route('UserProfile') }}" class="text-decoration-none">
                                                            <p class="m-0 text-muted small">{{ $user['name'] }}</p>
                                                        </a>
                                                    </div>
                                                    <div class="col-11">
                                                        <p class="mb-2">{{ $userrev['review'] }}</p>
                                                        <div class="text-end">
                                                            <button id="review_delete" data-id="{{ $userrev['id'] }}"
                                                                    class="btn btn-outline-danger btn-sm">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 mb-3 text-center">
                                            <h5 class="text-muted">No reviews from users</h5>
                                        </div>
                                    @endforelse
                                @endif
                            </div>

                            @forelse ($reviews as $review)
    <div class="col-12 mb-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="row align-items-center">
                <!-- User Image and Name -->
                <div class="col-2 col-md-1 text-center">
                    <img class="rounded-circle img-fluid"
                        src="{{ !empty($review->Users[0]->Data->image) ? asset('/storage/userdata/' . $review->Users[0]->Data->image) : asset('stockUser.png') }}"
                        alt="User Image" style="max-width: 60px;">
                    <p class="m-0 text-muted small mt-2">{{ $review->Users[0]->name }}</p>
                </div>
                <!-- Review Content -->
                <div class="col-10 col-md-11">
                    <p class="mb-0">{{ $review->review }}</p>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12 mb-3 text-center">
        <h5 class="text-muted">No reviews from People.</h5>
    </div>
@endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('iframe').addClass('d-block mx-auto');
            $('iframe').css('width', '100%');
            $('iframe').css('height', '25em');
            Fancybox.bind("gallery", {});
            const myCarousel = new Carousel(document.querySelector(".carousel"), {});

            @if($status)
                $('#review_form_btns').hide();
                $(document).on('focus', '#review_form_input', function(e) {
                    e.preventDefault();
                    $('#review_form_btns').fadeIn(100);
                });
                $(document).on('click', '#review_cancel', function(e) {
                    e.preventDefault();
                    $('#review_form_btns').fadeOut();
                    $('#review_form_input').val('');
                });
                $(document).on('submit', '#review_form', function(e) {
                    e.preventDefault();
                    var formdata = $('#review_form').serializeArray();
                    formdata.push({
                        name: 'u_id',
                        value: {{ $user['id'] }}
                    }, {
                        name: 'pro_id',
                        value: {{ $item->id }}
                    })
                    // console.log(formdata);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('add_review') }}",
                        data: formdata,
                        success: function(response) {
                            location.reload();
                        }
                    });
                });
                $(document).on('click', '#review_delete', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    console.log('delete ' + id);
                    $.ajax({
                        type: "GET",
                        url: `{{ route('del_review') }}/${id}`,
                        success: function(response) {
                            location.reload();
                        }
                    });
                });
            @endif

        });
    </script>
@endsection
