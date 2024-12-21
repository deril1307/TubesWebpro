<header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
    <!-- Brand Title -->
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-truncate" href="#">
        {{ $brand_title->value ?? 'Properti Pedia' }}
        @if ($status)
            | {{ $user['name'] }}
        @else
            | Guest
        @endif
    </a>

    <!-- Toggle Button for Sidebar (Mobile) -->
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Spacer to Push Navigation Buttons -->
    <div class="flex-grow-1"></div>

    <!-- Navigation Links -->
    <div class="navbar-nav d-flex align-items-center">
        @if ($status)
            <div class="nav-item text-nowrap">
                <a class="nav-link btn btn-primary text-white px-3" href="{{ url(route('AdminLogout')) }}">Log out</a>
            </div>
        @else
            <div class="nav-item text-nowrap">
                <a class="nav-link btn btn-dark text-white px-3" href="{{ url(route('AdminLoginPage')) }}">Log in</a>
            </div>
        @endif
    </div>
</header>
