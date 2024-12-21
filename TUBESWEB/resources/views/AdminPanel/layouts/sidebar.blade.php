<nav id="sidebarMenu" class="col-md-3 col-lg-2 bg-light sidebar shadow-sm">
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
            <li class="nav-item">
                <a class="nav-link text-dark @if ($menu == 'category') active fw-bold @endif" href="{{ route('list_category') }}">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-th me-2 text-success fs-5"></i>
                        <span>Category</span>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark @if ($menu == 'cities') active fw-bold @endif" href="{{ route('list_cities') }}">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-building me-2 text-info fs-5"></i>
                        <span>Cities</span>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark @if ($menu == 'facilities') active fw-bold @endif" href="{{ route('list_facilities') }}">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-layer-group me-2 text-warning fs-5"></i>
                        <span>Facilities</span>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark @if ($menu == 'properties') active fw-bold @endif" href="{{ route('list_properties') }}">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-home me-2 text-secondary fs-5"></i>
                        <span>Properties</span>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark @if ($menu == 'reviews') active fw-bold @endif" href="{{ route('list_reviews') }}">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-comments me-2 text-danger fs-5"></i>
                        <span>Reviews</span>
                    </div>
                </a>
            </li>
            @if ($user['type'] == 'R')
            <li class="nav-item">
                <a class="nav-link text-dark @if ($menu == 'users') active fw-bold @endif" href="{{ route('list_users') }}">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user me-2 text-primary fs-5"></i>
                        <span>Users</span>
                    </div>
                </a>
            </li>
            @endif
        </ul>

        @if ($user['type'] == 'R' || 'A')
            <h6 class="mt-4 text-uppercase text-muted small">Change Password</h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-dark @if ($menu == 'chng_password') active fw-bold @endif" href="{{ route('chng_password') }}">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-key me-2 text-danger fs-5"></i>
                            <span>Change Password</span>
                        </div>
                    </a>
                </li>
            </ul>
        @endif
    </div>
</nav>


