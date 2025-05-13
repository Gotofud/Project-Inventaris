@include('layouts.admin.header')

<body>
    @if (session('edit_success'))
        <div class="toast toast-onload align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-body hstack align-items-start gap-6">
                <i class="ti ti-circle-check fs-6"></i>
                <div>
                    <h5 class="text-white fs-3 mb-1">Edit Category Success</h5>
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
                    <h5 class="text-white fs-3 mb-1">Delete Category Success</h5>
                </div>
                <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @elseif (session('category_success'))
        <div class="toast toast-onload align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-body hstack align-items-start gap-6">
                <i class="ti ti-circle-check fs-6"></i>
                <div>
                    <h5 class="text-white fs-3 mb-1">Add Category Success</h5>
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
                                    <h4 class="fw-semibold mb-8">Category</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-muted text-decoration-none"
                                                    href="{{ route('welcome') }}">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">Category</li>
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
                                <h4 class="card-title"><i class="ti ti-folders"></i>Category</h4>
                                <div class="action">
                                    <a type="button" class="btn btn-primary btn-md text-white mb-3 me-0"
                                        data-bs-toggle="modal" data-bs-target="#category"><i
                                            class=" ti ti-folder-plus"></i></a>
                                    <a href="{{ route('category.export') }}" type="button"
                                        class="btn btn-success btn-md text-white mb-3 me-0"><i
                                            class=" ti ti-file-spreadsheet"></i> Export Excel</a>
                                </div>

                            </div>
                            <!-- Modal Form Add category-->
                            <div class="modal fade" id="category" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel"><i
                                                    class="ti ti-category"></i> Add Category</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form Input Group -->
                                            <form action="{{ route('category.store') }}" method="POST">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="ti ti-folder"></i></span>
                                                    <input type="text" class="form-control" placeholder="Category Name"
                                                        aria-label="Username" aria-describedby="basic-addon1"
                                                        name="name">
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
                            <!-- End Modal Add category -->
                            <!-- Table -->
                            <div class="table-responsive mb-3">
                                <table class="table table-striped table-bordered text-nowrap align-middle category">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
                                        @php
                                        $no = 1;
                                        @endphp
                                        <!-- start row -->
                                        @foreach ($category as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->category_name }}</td>
                                                <td>
                                                    <form action="{{ route('category.destroy', $data->id) }}" method="POST">
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
                                                </td>
                                            </tr>
                                            <!-- Modal Form Edit category-->
                                            <div class="modal fade" id="edit-{{ $data->id }}" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel"><i
                                                                    class="ti ti-category"></i> Edit Category</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Form Input Group -->
                                                            <form action="{{ route('category.update', $data->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="ti ti-folder"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Category Name" aria-label="Username"
                                                                        aria-describedby="basic-addon1" name="name" value="{{ $data->category_name }}">
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
                                            <!-- End Modal Edit category -->
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
<script type="text/javascript">
    $(document).ready(function () {
        $('.category').DataTable();
    });
</script>

</html>