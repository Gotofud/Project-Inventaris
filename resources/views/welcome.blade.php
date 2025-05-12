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

    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('assets/images/icon.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>

    <div id="main-wrapper">
        <!-- Sidebar Start -->
        @include('layouts.admin.sidebar')
        <!--  Sidebar End -->
        <div class="page-wrapper">
            <!--  Navbar Start -->
            @include('layouts.admin.navbar')
            <!--  Navbar End -->
            <div class="body-wrapper">
                <div class="container-fluid">
                    <!-- Row -->
                    <div class="row">
                        <div class="col d-flex align-items-stretch">
                            <div class="card w-100 bg-primary-subtle overflow-hidden shadow-none">
                                <div class="card-body position-relative">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="d-flex align-items-center mb-7">
                                                <div class="rounded-circle overflow-hidden me-6">
                                                    @if (Auth::user()->is_admin === 1)
                                                        <img src="../assets/images/profile/user-1.jpg" alt="modernize-img"
                                                            width="40" height="40">
                                                    @else
                                                    <img src="../assets/images/profile/user-3.jpg" alt="modernize-img"
                                                    width="40" height="40">
                                                    @endif
                                                </div>
                                                <h5 class="fw-semibold mb-0 fs-5">Welcome back {{ Auth::user()->name }}!
                                                </h5>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="border-end pe-4 border-muted border-opacity-10">
                                                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">
                                                        $2,340<i
                                                            class="ti ti-arrow-up-right fs-5 lh-base text-info"></i>
                                                    </h3>
                                                    <p class="mb-0 text-dark">Today’s Sales</p>
                                                </div>
                                                <div class="ps-4">
                                                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">35%<i
                                                            class="ti ti-arrow-up-right fs-5 lh-base text-info"></i>
                                                    </h3>
                                                    <p class="mb-0 text-dark">Overall Performance</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="welcome-bg-img mb-n7 text-end">
                                                <img src="../assets/images/backgrounds/welcome-bg.svg"
                                                    alt="modernize-img" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  Owl carousel -->
                    <div class="owl-carousel counter-carousel owl-theme">
                        <div class="item">
                            <div class="card border-0 zoom-in bg-info-subtle shadow-none">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ asset('') }}assets/images/svgs/location-minus.svg" width="50"
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
                        </div> --
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
                                        <img src="{{ asset('assets/images/svgs/users.svg') }}" width="50"
                                            height="50" class="mb-3" alt="modernize-img" />
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
                </div>
            </div>
        </div>
    </div>
    <!-- Script -->
    @include('layouts.admin.script')
</body>

</html>