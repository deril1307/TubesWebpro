@include('AdminPanel.layouts.start')
@include('AdminPanel.layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 p-0">
            @include('AdminPanel.layouts.sidebar')
        </div>
        <main class="col-md-9 col-lg-10 ms-auto px-md-4 py-4 bg-light">
            <div class="content-wrapper shadow-sm p-4 bg-white rounded">
                @yield('main-section')
            </div>
        </main>
    </div>
</div>

@include('AdminPanel.layouts.end')
