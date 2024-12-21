<style>
    footer {
        background-color: #f8f9fa;
        color: #6c757d;
        border-top: 1px solid #e9ecef;
    }

    footer h5 {
        color: #343a40;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    footer .nav-link {
        color: #6c757d;
        transition: color 0.3s;
    }

    footer .nav-link:hover {
        color: #343a40;
        text-decoration: none;
    }

    footer .btn {
        margin-bottom: 0.5rem;
    }

    footer .link-dark {
        color: #343a40;
        transition: color 0.3s;
    }

    footer .link-dark:hover {
        color: #0056b3;
    }

    footer .fa {
        font-size: 1.5rem;
    }

    footer .fa:hover {
        color: #007bff;
    }
</style>
<!-- Footer -->
<footer class="text-center bg-body-tertiary py-4">
    <!-- Grid container -->
    <div class="container pt-4">
        <!-- Section: Logo and Contact -->
        <div class="row">
            <div class="col-md-4 mb-4">
                @if (!empty($logo_image->value))
                    <a class="navbar-brand" href="{{ route('userHome') }}">
                        <img style="height: 80px" src="{{ asset('storage/siteSettings/' . $logo_image->value) }}"
                            alt="{{ $brand_title->value ?? 'DG-Estate' }}" />
                    </a>
                @endif
                <p class="text-muted my-2">
                    {{ $brand_title->value ?? 'Propedia' }}
                </p>
                @if (!empty($contacts['phone']->value))
                    <div class="my-2">
                        <a class="btn btn-outline-success btn-sm" href="tel:{{ $contacts['phone']->value }}">
                            <i class="fas fa-phone-alt"></i>
                            {{ $contacts['phone']->value }}
                        </a>
                    </div>
                    @endif @if (!empty($contacts['email']->value))
                        <div class="my-2">
                            <a class="btn btn-outline-primary btn-sm" href="mailto:{{ $contacts['email']->value }}">
                                <i class="fas fa-envelope"></i>
                                {{ $contacts['email']->value }}
                            </a>
                        </div>
                    @endif
            </div>

            <!-- Section: Quick Links -->
            <div class="col-md-4 mb-4">
                <h5>Quick Links</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="{{ route('userHome') }}" class="nav-link p-0 text-muted">Home</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('show') }}" class="nav-link p-0 text-muted">Properties</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('UserProfile') }}" class="nav-link p-0 text-muted">Profile</a>
                    </li>
                </ul>
            </div>

            <!-- Section: Social media -->
            <div class="col-md-4 mb-4">
                <h5>Follow Us</h5>
                <section class="mb-4">
                    <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!"
                        role="button" data-mdb-ripple-color="dark">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!"
                        role="button" data-mdb-ripple-color="dark">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!"
                        role="button" data-mdb-ripple-color="dark">
                        <i class="fab fa-google"></i>
                    </a>
                    <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!"
                        role="button" data-mdb-ripple-color="dark">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!"
                        role="button" data-mdb-ripple-color="dark">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!"
                        role="button" data-mdb-ripple-color="dark">
                        <i class="fab fa-github"></i>
                    </a>
                </section>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center p-3">
            © {{ date('Y') }} {{ $brand_title->value ?? 'Website Jual Beli Sewa Properti' }}. All
            rights reserved.
        </div>
    </div>
    <!-- Grid container -->
</footer>
<!-- Footer -->