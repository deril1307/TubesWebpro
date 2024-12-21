<!-- Header Bootstrap -->
<header class="py-2 bg-primary sticky-top text-white shadow">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <!-- Logo Section -->
            @if (!empty($logo_image->value))
                <a class="navbar-brand d-flex align-items-center" href="{{ route('userHome') }}">
                    <img style="height: 40px" src="{{ asset('storage/siteSettings/' . $logo_image->value) }}"
                        alt="{{ $brand_title->value ?? 'DG-Estate' }}" class="me-2">
                    <span class="fw-bold">{{ $brand_title->value ?? 'Propedia' }}</span>
                </a>
            @else
                <a class="navbar-brand fw-bold" href="{{ route('userHome') }}">{{ $brand_title->value ?? 'Properti Pedia' }}</a>
            @endif

            <!-- Toggler for Mobile View -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Left Menu -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @if ($menu == 'home') active fw-semibold @endif" href="{{ route('userHome') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @if ($menu == 'purpose') active fw-semibold @endif" href="#"
                            id="purposeDropdown" role="button" data-bs-toggle="dropdown">
                            Purpose
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('show_purpose', 'sale') }}">Sale</a></li>
                            <li><a class="dropdown-item" href="{{ route('show_purpose', 'rent') }}">Rent</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @if ($menu == 'category') active fw-semibold @endif" href="#"
                            id="categoryDropdown" role="button" data-bs-toggle="dropdown">
                            Category
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($cate as $item)
                                <li><a class="dropdown-item" href="{{ route('show_category', $item->slug_name) }}">{{ $item->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @if ($menu == 'city') active fw-semibold @endif" href="#"
                            id="cityDropdown" role="button" data-bs-toggle="dropdown">
                            City
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($city as $item)
                                <li><a class="dropdown-item" href="{{ route('show_city', $item->slug_city) }}">{{ $item->city }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>

                <!-- Search Bar -->
                <form id="searchFrm" action="{{ route('propSearch') }}" method="POST" class="d-flex me-3">
                    @csrf
                    <div class="input-group">
                        <select class="form-select" name="purpose">
                            <option value="sale" @if (!empty($purpose) && $purpose == 'sale') selected @endif>Sale</option>
                            <option value="rent" @if (!empty($purpose) && $purpose == 'rent') selected @endif>Rent</option>
                            <option value="*" @if (!empty($purpose) && $purpose == '*') selected @endif>All</option>
                        </select>
                        <input type="search" class="form-control" name="search" placeholder="Search by Name" value="{{ $SecStr ?? '' }}">
                        <button class="btn btn-light" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <!-- Right Menu -->
                @if ($status)
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-light text-decoration-none dropdown-toggle"
                            id="dropdownUser" data-bs-toggle="dropdown">
                            <img src="{{ !empty($user['data']['image']) ? asset('/storage/userdata/' . $user['data']['image']) : asset('stockUser.png') }}"
                                alt="{{ $user['name'] }}" width="38" height="38" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end text-small" aria-labelledby="dropdownUser">
                            <li><span class="dropdown-item">{{ $user['name'] }}</span></li>
                            @if ($user['type'] == 'A' || $user['type'] == 'R')
                                <li><a class="dropdown-item" target="_blank" href="{{ route('AdminHome') }}">Admin</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('UserProfile') }}">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('UserLogout') }}">Log out</a></li>
                        </ul>
                    </div>
                @else
                    <a class="btn btn-outline-light me-2" href="{{ route('UserLoginForm') }}">Login</a>
                    <a class="btn btn-warning text-dark fw-bold" href="{{ route('UserSignupForm') }}">Sign-up</a>
                @endif
            </div>
        </nav>
    </div>
</header>
