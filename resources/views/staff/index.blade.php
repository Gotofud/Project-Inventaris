    @include('layouts.admin.header')

    <body>
        <!-- Toast -->
         @include('layouts.alert.staff')
         
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
                                    <div class="action">
                                        <a type="button" class="btn btn-primary btn-md   text-white mb-3 me-0"
                                            data-bs-toggle="modal" data-bs-target="#add"><i
                                                class=" ti ti-user-plus"></i></a>
                                        <a href="{{ route('staff.export') }}" type="button"
                                            class="btn btn-success btn-md text-white mb-3 me-0"><i
                                                class=" ti ti-file-spreadsheet"></i> Export Excel</a>
                                    </div>
                                </div>
                                <!-- Add Modal Form-->
                                @include('layouts.modal.staff.add')
                                <!-- Add End Modal -->
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
                                                                 <img src="../assets/images/profile/user-2.jpg" width="45"
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
                                            @include('layouts.modal.staff.edit')
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