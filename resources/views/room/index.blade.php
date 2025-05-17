@include('layouts.admin.header')

<body>
    @if (session('add_room'))
        <div class="toast toast-onload align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-body hstack align-items-start gap-6">
                <i class="ti ti-circle-check fs-6"></i>
                <div>
                    <h5 class="text-white fs-3 mb-1">Add Room Success</h5>
                </div>
                <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @elseif (session('edit_success'))
        <div class="toast toast-onload align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-body hstack align-items-start gap-6">
                <i class="ti ti-circle-check fs-6"></i>
                <div>
                    <h5 class="text-white fs-3 mb-1">Edit Item Success</h5>
                </div>
                <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @elseif (session('delete_success'))
        <div class="toast toast-onload align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-body hstack align-items-start gap-6">
                <i class="ti ti-circle-check fs-6"></i>
                <div>
                    <h5 class="text-white fs-3 mb-1">Delete Item Success</h5>
                </div>
                <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @elseif (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="toast toast-onload align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="toast-body hstack align-items-start gap-6">
                    <i class="ti ti-circle-x fs-6"></i>
                    <div>
                        <h5 class="text-white fs-3 mb-1">{{$error}}</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endforeach
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
                    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                        <div class="card-body px-4 py-3">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h4 class="fw-semibold mb-8">Room Data</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-muted text-decoration-none"
                                                    href="{{ route('welcome') }}">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">Room Data</li>
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
                                <h4 class="card-title"><i class="ti ti-folders"></i>Room Data</h4>
                                <div class="action">
                                    <a type="button" class="btn btn-primary btn-md text-white mb-3 me-0"
                                        data-bs-toggle="modal" data-bs-target="#data"><i
                                            class=" ti ti-folder-plus"></i></a>
                                    <a type="button" class="btn btn-warning btn-md text-white mb-3 me-0"
                                        data-bs-toggle="modal" data-bs-target="#room"><i class=" ti ti-door-enter"></i>
                                        Add Room</a>
                                    <a href="#" type="button" class="btn btn-success btn-md text-white mb-3 me-0"><i
                                            class=" ti ti-file-spreadsheet"></i> Export Excel</a>
                                </div>
                            </div>
                            <!-- Modal Form Add Room-->
                            <div class="modal fade" id="room" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="roomLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="roomLabel"><i class="ti ti-key"></i> Add
                                                Room</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form Input Group -->
                                            <form action="{{ route('room.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="ti ti-door"></i></span>
                                                    <input type="text" class="form-control" placeholder="Room Name"
                                                        aria-label="Room" aria-describedby="basic-addon1"
                                                        name="room_name">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="save"><i
                                                    class="ti ti-device-floppy"></i>Save</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                        </form>
                                        <!-- End Form -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Add Room -->
                            <!-- Modal Form Add Data-->
                            <div class="modal modal-lg fade" id="data" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="dataLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="dataLabel"><i class="ti ti-key"></i> Add
                                                Room</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form Input Group -->
                                            <div id="education_fields">
                                                <form class="row">
                                                    <div class="col-sm-3">
                                                        <div class="mb-3">
                                                            <select class="form-select" id="educationDate"
                                                                name="educationDate">
                                                                <option>Room</option>
                                                                <option value="2015">2015</option>
                                                                <option value="2016">2016</option>
                                                                <option value="2024">2024</option>
                                                                <option value="2024">2024</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="mb-3">
                                                            <select class="form-select" id="educationDate"
                                                                name="educationDate">
                                                                <option>Item</option>
                                                                <option value="2015">2015</option>
                                                                <option value="2016">2016</option>
                                                                <option value="2024">2024</option>
                                                                <option value="2024">2024</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                       <div class="col-sm-3">
                                                        <div class="mb-3">
                                                            <input type="number" class="form-control" id="Schoolname"
                                                                name="Schoolname" placeholder="Amount of Item" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="action d-flex justify-content-end">
                                                            <button onclick="education_fields();"
                                                                class="btn btn-success fw-medium" type="button">
                                                                <i class="ti ti-circle-plus fs-5 d-flex"></i>
                                                            </button>
                                                        </div>

                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="save"><i
                                                        class="ti ti-device-floppy"></i>Save</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- End Form -->
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Add data -->
                        <!-- Table -->
                        <div class="table-responsive mb-3">
                            <table class="table table-striped table-bordered text-nowrap align-middle room">
                                <thead>
                                    <!-- start row -->
                                    <tr>
                                        <th>#</th>
                                        <th>Room Code</th>
                                        <th>Room Name</th>
                                        <th>Action</th>
                                    </tr>
                                    <!-- end row -->
                                </thead>
                                <tbody>
                                    <!-- start row -->
                                    @php
                                        $no = 1;
                                     @endphp
                                    @foreach ($room as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->room_code }}</td>
                                            <td>{{ $data->room_name }}</td>
                                            <td>
                                                <form action="{{ route('room.destroy', $data->id) }}" method="POST">
                                                    <a type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#edit-{{ $data->id }}">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                                    <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#edit-{{ $data->id }}">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure?')"><i
                                                            class="ti ti-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach
                                    <!-- end row -->
                                </tbody>
                            </table>
                        </div>
                        <!-- end Zero Configuration -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Script -->
        @include('layouts.admin.script')
</body>

<script>
    $(document).ready(function () {
        $('.room').DataTable();
    });

</script>


</html>