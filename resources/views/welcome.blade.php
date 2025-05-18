@include('layouts.admin.header')

<body>
    @if (session('login_success'))
        <div class="toast toast-onload align-items-center text-bg-primary border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-body hstack align-items-start gap-6">
                <i class="ti ti-circle-check fs-6"></i>
                <div>
                    <h5 class="text-white fs-3 mb-1">Login Success</h5>
                    <h6 class="text-white fs-2 mb-0">Welcome Back {{ Auth::user()->name }}!</h6>
                </div>
                <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="preloader">
        <img src="{{ asset('assets/images/icon.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>

    <div id="main-wrapper">
        @include('layouts.admin.sidebar')

        <div class="page-wrapper">
            @include('layouts.admin.navbar')

            <div class="body-wrapper">
                <div class="container-fluid">

                    <!-- Welcome Card -->
                    <div class="card w-100 bg-light shadow-sm border-0 rounded-3 mb-4">
                        <div class="card-body position-relative">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="d-flex align-items-center mb-4">
                                        <img src="{{ Auth::user()->is_admin ? asset('assets/images/profile/user-1.jpg') : asset('assets/images/profile/user-3.jpg') }}"
                                            class="rounded-circle me-3" width="48" height="48" alt="profile" />
                                        <div>
                                            <h5 class="mb-0 fw-bold">Welcome back, {{ Auth::user()->name }}!</h5>
                                            <p class="mb-0 text-muted">Here is a quick summary of your data</p>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-4">
                                        <div>
                                            <h4 class="fw-semibold mb-0 text-primary">{{ $totalIncoming }}</h4>
                                            <small class="text-muted">Total Incoming</small>
                                        </div>
                                        <div>
                                            <h4 class="fw-semibold mb-0 text-warning">{{ $totalLoan }}</h4>
                                            <small class="text-muted">Total Loan</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ asset('assets/images/backgrounds/welcome-bg.svg') }}" alt="welcome">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Summary Grid -->
                    <div class="owl-carousel counter-carousel owl-theme">
                        <div class="item">
                            <div class="card border-0 zoom-in bg-info-subtle shadow-none">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/images/svgs/location-minus.svg') }}" width="50"
                                            height="50" class="mb-3" alt="modernize-img" />
                                        <p class="fw-semibold fs-3 text-dark mb-1">Outcoming Data</p>
                                        <h5 class="fw-semibold text-dark mb-0">{{ $totalOutcoming }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card border-0 zoom-in bg-info-subtle shadow-none">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/images/svgs/location-plus.svg') }}" width="50"
                                            height="50" class="mb-3" alt="modernize-img" />
                                        <p class="fw-semibold fs-3 text-dark mb-1">Incoming Data</p>
                                        <h5 class="fw-semibold text-dark mb-0">{{ $totalIncoming }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->is_admin === 1)
                            <div class="item">
                                <div class="card border-0 zoom-in bg-info-subtle shadow-none">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/images/svgs/category.svg') }}" width="50" height="50"
                                                class="mb-3" alt="modernize-img" />
                                            <p class="fw-semibold fs-3 text-dark mb-1">Category</p>
                                            <h5 class="fw-semibold text-dark mb-0">{{$totalCategory}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="item">
                            <div class="card border-0 zoom-in bg-info-subtle shadow-none">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/images/svgs/folders.svg') }}" width="50" height="50"
                                            class="mb-3" alt="modernize-img" />
                                        <p class="fw-semibold fs-3 text-dark mb-1">Main Data</p>
                                        <h5 class="fw-semibold text-dark mb-0">{{$totalData}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->is_admin === 1)
                            <div class="item">
                                <div class="card border-0 zoom-in bg-info-subtle shadow-none">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/images/svgs/users.svg') }}" width="50" height="50"
                                                class="mb-3" alt="modernize-img" />
                                            <p class="fw-semibold fs-3 text-dark mb-1">
                                                Admin / Staff
                                            </p>
                                            <h5 class="fw-semibold text-dark mb-0">{{$totalStaff}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="item">
                            <div class="card border-0 zoom-in bg-info-subtle shadow-none">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/images/svgs/book-download.svg') }}" width="50"
                                            height="50" class="mb-3" alt="modernize-img" />
                                        <p class="fw-semibold fs-3 text-dark mb-1">Return Data</p>
                                        <h5 class="fw-semibold text-dark mb-0">{{ $totalReturn }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card border-0 zoom-in bg-info-subtle shadow-none">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ asset('') }}assets/images/svgs/book-upload.svg" width="50"
                                            height="50" class="mb-3" alt="modernize-img" />
                                        <p class="fw-semibold fs-3 text-dark mb-1">Loan Data</p>
                                        <h5 class="fw-semibold text-dark mb-0">{{ $totalLoan }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Donut Chart -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3 fw-bold">Data Chart Overview</h5>
                            <div id="donut-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.admin.script')
    <script>
        if ($('#donut-chart').length > 0) {
            var donutChart = {
                chart: {
                    height: 250,
                    type: 'donut',
                    toolbar: { show: false }
                },
                colors: ['#0D1B39', '#0074ba', '#49beff', '#ffae1f'],
                labels: {!! json_encode($chartData['name']) !!},
                series: {!! json_encode($chartData['series']) !!},
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: { width: 200 },
                        legend: { position: 'bottom' }
                    }
                }]
            };
            var donut = new ApexCharts(document.querySelector("#donut-chart"), donutChart);
            donut.render();
        }
    </script>
</body>

</html>