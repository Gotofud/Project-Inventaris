@include('layouts.admin.header')

<body>
    @if (session('login_success'))
        <div class="toast toast-onload align-items-center text-bg-primary border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-body hstack align-items-start gap-6">
                <i class="ti ti-progress-check fs-6"></i>
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
                    <!-- start Zero Configuration -->
                    <script>
                        let table = new DataTable('#myTable');
                    </script>
                    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                        <div class="card-body px-4 py-3">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h4 class="fw-semibold mb-8">Staff Data</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-muted text-decoration-none"
                                                    href="{{ route('welcome') }}">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">Staff Data</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="col-3">
                                    <div class="text-center mb-n5">
                                        <img src="../assets/images/breadcrumb/ChatBc.png" alt="modernize-img"
                                            class="img-fluid mb-n4" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                                <h4 class="card-title"><i class="ti ti-users"></i>Staff Data</h4>
                                <a type="button" class="btn btn-primary btn-md text-white mb-3 me-0"
                                    data-bs-toggle="modal" data-bs-target="#add"><i class=" ti ti-user-plus"></i></a>
                            </div>
                            <!-- Modal Form-->
                            <div class="modal fade" id="add" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel"><i
                                                    class="ti ti-users"></i> Add Staff</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form Input Group -->
                                            <form action="{{ route('register') }}" method="POST">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="ti ti-user"></i></span>
                                                    <input type="text" class="form-control" placeholder="Username"
                                                        aria-label="Username" aria-describedby="basic-addon1"
                                                        name="name">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">@</span>
                                                    <input type="email" class="form-control" placeholder="Email"
                                                        aria-label="Email" aria-describedby="basic-addon1" name="email">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="ti ti-lock"></i></span>
                                                    <input type="password" class="form-control" placeholder="Password"
                                                        aria-label="Password" aria-describedby="basic-addon1"
                                                        name="password">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="ti ti-lock-access"></i></span>
                                                    <input type="password" class="form-control"
                                                        placeholder="Confirm Password" aria-label="Password"
                                                        aria-describedby="basic-addon1" name="password_confirmation">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="ti ti-device-floppy"></i>Save</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                        </form>
                                        <!-- End Form -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <!-- Table -->
                            <div class="table-responsive mb-3">
                                <table class="table table-striped table-bordered text-nowrap align-middle dataStaff">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
                                        <!-- start row -->
                                        @foreach ($staff as $data)
                                            <tr>
                                                <td>
                                                    @if ($data->is_admin == 1)
                                                        <div class="d-flex align-items-center gap-6">
                                                            <img src="../assets/images/profile/user-1.jpg" width="45"
                                                                class="rounded-circle" />
                                                            <h6 class="mb-0"> {{ $data->name }}</h6>
                                                        </div>
                                                    @else
                                                        <div class="d-flex align-items-center gap-6">
                                                            <img src="../assets/images/profile/user-3.jpg" width="45"
                                                                class="rounded-circle" />
                                                            <h6 class="mb-0"> {{ $data->name }}</h6>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>{{ $data->email }}</td>
                                                <td>
                                                    @if ($data->is_admin == 1)
                                                        <span class="badge bg-success">Admin</span>
                                                    @else
                                                        <span class="badge bg-info">Staff</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->is_admin === 1)
                                                        <span class="badge bg-danger">There's no action for Admin</span>
                                                    @else
                                                        <form action="{{ route('staff.destroy', $data->id) }}" method="POST">
                                                            <a type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                                data-bs-target="#edit-{{ $data->id }}">
                                                                <i class="ti ti-pencil"></i>
                                                            </a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="return confirm('Are you sure?')"><i
                                                                    class="ti ti-trash"></i></button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                            <!-- Edit Modal Form -->
                                            <div class="modal fade" id="edit-{{ $data->id }}" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"><i class="ti ti-pencil"></i> Edit
                                                                Staff</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Form Input Group -->
                                                            <form action="{{ route('staff.update', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text"><i
                                                                            class="ti ti-user"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $data->name }}" name="name">
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text">@</span>
                                                                    <input type="email" class="form-control"
                                                                        value="{{ $data->email }}" name="email">
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text"><i
                                                                            class="ti ti-lock"></i></span>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="Edit Password" name="password">
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text"><i
                                                                            class="ti ti-lock-access"></i></span>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="Confirm Password"
                                                                        name="password_confirmation">
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary"><i
                                                                    class="ti ti-device-floppy"></i> Save</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Edit Modal -->
                                        @endforeach
                                        <!-- end row -->
                                    </tbody>
                            </div>
                            <!-- end Zero Configuration -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Script -->
            @include('layouts.admin.script')
</body>
<script type="text/javascript">
    $(document).ready(function () {
        $('.dataStaff').DataTable();
    });
</script>

</html>