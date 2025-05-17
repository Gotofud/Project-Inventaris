<aside class="left-sidebar with-vertical">
    <div><!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('welcome') }}" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logo.svg') }}" class="dark-logo" alt="Logo-Dark" />
            </a>
            <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                <i class="ti ti-x"></i>
            </a>
        </div>


        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <!-- ---------------------------------- -->
                <!-- Main -->
                <!-- ---------------------------------- -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Main</span>
                </li>
                <!-- ---------------------------------- -->
                <!-- Dashboard -->
                <!-- ---------------------------------- -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('welcome') }}" id="get-url" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->is_admin === 1)
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('staff.index')}}" aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">Staff</span>
                        </a>
                    </li>
                @endif
                <!-- ---------------------------------- -->
                <!-- Data -->
                <!-- ---------------------------------- -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Data</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('mainData.index')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-folders"></i>
                        </span>
                        <span class="hide-menu">Main Data</span>
                    </a>
                </li>
                @if (Auth::user()->is_admin === 1)
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('category.index')}}" aria-expanded="false">
                            <span>
                                <i class="ti ti-category"></i>
                            </span>
                            <span class="hide-menu">Category</span>
                        </a>
                    </li>
                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('room.index')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-door"></i>
                        </span>
                        <span class="hide-menu">Room</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('incoming-item.index')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-script-plus"></i>
                        </span>
                        <span class="hide-menu">Incoming Item</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{{route('outcoming-item.index')}}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-script-x"></i>
                        </span>
                        <span class="hide-menu">Outcoming Item</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('loan.index')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-transfer-in"></i>
                        </span>
                        <span class="hide-menu">Loan Data</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('return.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-transfer-out"></i>
                        </span>
                        <span class="hide-menu">Return Data</span>
                    </a>
                </li>
        </nav>

        <div class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded mt-4">
            <div class="hstack gap-3">
                @if (Auth::user()->is_admin === 1)
                    <div class="john-img">
                        <img src="{{ asset('assets/images/profile/user-1.jpg') }}" class="rounded-circle" width="40"
                            height="40" alt="modernize-img" />
                    </div>
                @else
                    <div class="john-img">
                        <img src="{{ asset('') }}assets/images/profile/user-3.jpg" class="rounded-circle" width="40"
                            height="40" alt="modernize-img" />
                    </div>
                @endif
                <div class="john-title">
                    <h6 class="mb-0 fs-4 fw-semibold">{{ Auth::user()->name }}</h6>
                    <span class="fs-2">@if (Auth::user()->is_admin === 1)
                        Admin
                    @else
                            Staff
                        @endif
                    </span>
                </div>
                <a class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="ti ti-power fs-6"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</aside>