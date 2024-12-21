@extends('layouts.app')
@push('title')
    {{ $CMS['home_title'] ?? '' }}
@endpush
@push('meta')
    {{ $CMS['home_meta'] ?? '' }}
@endpush
@section('content_box')
    <main>
        @include('layouts.carousel')

        <div class="container marketing">
            <div class="row">
                <div class="col-12 mb-5 text-center">
                    <h1>Categories</h1>
                </div>
                <div id="cat_cara" class="carousel">
                    @forelse ($showcate as $item)
                        <div class="carousel__slide" style="width: 350px">
                            <div class="shadow w-100 mx-auto">
                                <a class="" href="{{ route('show_category', $item->slug_name) }}">
                                    <img style="height: 100%" class="w-100 rounded-top"
                                        src="{{ asset('/storage/images/' . $item->image) }}" alt="{{ $item->name }}">
                                </a>
                                <a class="btn btn-outline-primary rounded-bottom btn-lg w-100"
                                    href="{{ route('show_category', $item->slug_name) }}">{{ $item->name }}</a>
                            </div>
                        </div>
                    @empty
                        <div class="carousel__slide" style="width: 350px">
                            <div class="shadow w-100 mx-auto">
                                <a class="btn btn-outline-primary rounded-bottom btn-lg w-100" href="">Belum ada Kategorinya</a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- START THE FEATURETTES -->
            <hr class="featurette-divider">
            <div class="row featurette">
                @if (!empty($CMS['home_image']))
                    <div class="col-md-5">
                        <img width="500px" class="h-auto" src="{{ asset('/storage/cms/' . $CMS['home_image']) }}" alt="Error">
                    </div>
                @endif
                @if (!empty($CMS['home_image']))
                    <div class="col-md-12 d-flex align-items-center">
                        <div class="text-center w-100" style="text-align: justify">
                            {!! $CMS['home_content'] !!}
                        </div>
                    </div>
                @else
                    <div class="col-md-7 d-flex align-items-center">
                        <div class="w-100" style="text-align: justify">
                            {!! $CMS['home_content'] ?? '' !!}
                        </div>
                    </div>
                @endif
            </div>

            <hr class="featurette-divider">
            <div class="row featurette mb-3">
                <div class="col-12">
                    <h1>Properti Terbaru</h1>
                </div>
            </div>

            <div class="row featurette">
                @forelse ($newlyAdded as $item)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card mx-auto shadow">
                            <a href="{{ route('show_pro', $item->title_slug) }}">
                                <img height="300px" class="card-img-top" src="{{ asset('/storage/property/' . $item->image) }}" alt="{{ $item->title }}">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title mb-1">{{ $item->title }}</h4>
                                <p class="card-text mb-1">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('show_purpose', $item->purpose) }}">
                                        {{ ucfirst($item->purpose) }}
                                    </a>
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('show_category', $item->Cate->name) }}">
                                        {{ $item->Cate->name }}
                                    </a>
                                    <a class="btn btn-sm btn-outline-dark" href="{{ route('show_city', $item->City->slug_city) }}">
                                        {{ $item->City->city }}
                                    </a>
                                </p>
                                <p class="card-text">
                                    <i class="fas fa-bed"></i> {{ $item->rooms }}
                                    <i class="fas fa-shower"></i> {{ $item->bathrooms }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <h4>Belum ada yang menambahkan...</h4>
                @endforelse
            </div>

            @forelse ($catedata as $key => $cate)
                @if (sizeof($cate->Pro) > 0)
                    <hr class="featurette-divider">
                    <div class="row featurette mb-3">
                        <div class="col-12">
                            <a class="text-decoration-none text-secondary" href="">
                                <h1 class="">
                                    {{ $cate->name }}
                                </h1>
                            </a>
                        </div>
                    </div>
                    <div class="row featurette">
                        @foreach ($cate->Pro as $item)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card mx-auto shadow">
                                    <a href="{{ route('show_pro', $item->title_slug) }}">
                                        <img height="300px" class="card-img-top" src="{{ asset('/storage/property/' . $item->image) }}" alt="{{ $item->title }}">
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title mb-1">{{ $item->title }}</h4>
                                        <p class="card-text mb-1">
                                            <a class="btn btn-sm btn-outline-primary" href="{{ route('show_purpose', $item->purpose) }}">
                                                {{ ucfirst($item->purpose) }}
                                            </a>
                                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('show_category', $item->Cate->name) }}">
                                                {{ $item->Cate->name }}
                                            </a>
                                            <a class="btn btn-sm btn-outline-dark" href="{{ route('show_city', $item->City->slug_city) }}">
                                                {{ $item->City->city }}
                                            </a>
                                        </p>
                                        <p class="card-text">
                                            <i class="fas fa-bed"></i> {{ $item->rooms }}
                                            <i class="fas fa-shower"></i> {{ $item->bathrooms }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @empty
            @endforelse

            <hr class="featurette-divider">
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const myCarousel = new Carousel(document.querySelector("#cat_cara"), {});
        });
    </script>
@endsection
