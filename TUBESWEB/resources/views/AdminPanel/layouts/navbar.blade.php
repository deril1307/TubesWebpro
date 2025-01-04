<header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
    <!-- Brand Title -->
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-truncate d-flex align-items-center" href="#">
        <span class="fw-bold">
            {{ $brand_title->value ?? 'Properti Pedia' }}
        </span>
        <span class="ms-2 text-white small">
            @if ($status)
                | {{ $user['name'] }}
            @else
                | Guest
            @endif
        </span>
    </a>

    <!-- Toggle Button for Sidebar (Mobile) -->
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Spacer -->
    <div class="flex-grow-1"></div>

    <!-- Navigation Links (Desktop Only) -->
    <div class="navbar-nav d-none d-md-flex align-items-center">
        @if ($status)
            <div class="nav-item text-nowrap">
                <a class="nav-link btn btn-outline-light text-white px-3 rounded-pill" href="{{ url(route('AdminLogout')) }}">
                    <i class="fas fa-sign-out-alt me-2"></i> Log out
                </a>
            </div>
        @else
            <div class="nav-item text-nowrap">
                <a class="nav-link btn btn-outline-light text-white px-3 rounded-pill" href="{{ url(route('AdminLoginPage')) }}">
                    <i class="fas fa-sign-in-alt me-2"></i> Log in
                </a>
            </div>
        @endif
    </div>
</header>

<!-- Sidebar Menu -->
<nav id="sidebarMenu" class="col-md-3 col-lg-2 collapse bg-light shadow-sm">
    <div class="position-sticky py-4 px-3">
        <ul class="nav flex-column gap-3">
            <li class="nav-item">
                <a class="nav-link text-dark @if ($menu == 'dashboard') active fw-bold @endif" href="{{ route('AdminHome') }}">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-chart-line me-2 text-primary fs-5"></i>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            <!-- Other Menu Items -->
            <li class="nav-item">
                <a class="nav-link text-dark @if ($menu == 'reviews') active fw-bold @endif" href="{{ route('list_reviews') }}">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-comments me-2 text-danger fs-5"></i>
                        <span>Reviews</span>
                    </div>
                </a>
            </li>

            <!-- Log out Button for Mobile -->
            @if ($status)
                <li class="nav-item d-md-none">
                    <a class="nav-link text-dark" href="{{ url(route('AdminLogout')) }}">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-sign-out-alt me-2 text-danger fs-5"></i>
                            <span>Log out</span>
                        </div>
                    </a>
                </li>
            @else
                <li class="nav-item d-md-none">
                    <a class="nav-link text-dark" href="{{ url(route('AdminLoginPage')) }}">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-sign-in-alt me-2 text-primary fs-5"></i>
                            <span>Log in</span>
                        </div>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
