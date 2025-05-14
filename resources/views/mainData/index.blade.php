@include('layouts.admin.header')

<body>
    @if (session('add_success'))
        <div class="toast toast-onload align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-body hstack align-items-start gap-6">
                <i class="ti ti-circle-check fs-6"></i>
                <div>
                    <h5 class="text-white fs-3 mb-1">Add Item Success</h5>
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
                                    <h4 class="fw-semibold mb-8">Main Data</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-muted text-decoration-none"
                                                    href="{{ route('welcome') }}">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">Main Data</li>
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
                                <h4 class="card-title"><i class="ti ti-folders"></i>Main Data</h4>
                                <div class="action">
                                    <a type="button" class="btn btn-primary btn-md text-white mb-3 me-0"
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                                            class=" ti ti-folder-plus"></i></a>
                                    <a href="{{ route('mainData.export') }}" type="button"
                                        class="btn btn-success btn-md text-white mb-3 me-0"><i
                                            class=" ti ti-file-spreadsheet"></i> Export Excel</a>
                                </div>
                            </div>
                            <!-- Modal Form Add data-->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel"><i
                                                    class="ti ti-folder"></i> Add Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form Input Group -->
                                            <form action="{{ route('mainData.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="ti ti-folder"></i></span>
                                                    <input type="text" class="form-control" placeholder="Item Name"
                                                        aria-label="Username" aria-describedby="basic-addon1"
                                                        name="name">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="ti ti-category"></i></span>
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="category_id">
                                                        <option selected>Select Category</option>
                                                        @foreach ($category as $data)
                                                            <option value="{{ $data->id }}">{{ $data->category_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="file" id="formFile" name="img">
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
                            <!-- End Modal Add data -->
                            <!-- Table -->
                            <div class="table-responsive mb-3">
                                <table class="table table-striped table-bordered text-nowrap align-middle mainData">
                                               <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label>Category Filter</label>
                                            <select id="categoryFilter" class="form-select">
                                                <option value="">All Category</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->category_name }}">{{ $cat->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Date Filter</label>
                                            <div class="input-group">
                                                <input type="date" id="startDate" class="form-control"
                                                    placeholder="from">
                                                <input type="date" id="endDate" class="form-control"
                                                    placeholder="To">
                                            </div>
                                        </div>
                                    </div>
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th>Image</th>
                                            <th>Production Code</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Stock</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
                                        <!-- start row -->
                                        @foreach ($mainData as $data)
                                            <tr data-category="{{ $data->category->category_name }}"
                                                data-date="{{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d') }}">
                                                <td>
                                                    <img src="{{asset('/images/data/' . $data->img)}}" class="rounded"
                                                        width="50">
                                                </td>
                                                <td>{{ $data->prd_code }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->category->category_name }}</td>
                                                <td>{{ $data->stock }}</td>
                                                <td>{{ $data->created_at }}</td>
                                                <td>
                                                    <form action="{{ route('mainData.destroy', $data->id) }}" method="POST">
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
                                            <!-- Edit Modal Form -->
                                            <div class="modal fade" id="edit-{{ $data->id }}" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"><i class="ti ti-folder"></i> Edit
                                                                Data</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Form Input Group -->
                                                            <form action="{{ route('mainData.update', $data->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="input-group mb-3">
                                                                    <img src="{{asset('/images/data/' . $data->img)}}"
                                                                        width="50">
                                                                    <input class="form-control" type="file" id="formFile"
                                                                        name="img">
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text"><i
                                                                            class="ti ti-list-details"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $data->name }}" name="name">
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="ti ti-category"></i></span>
                                                                    <select class="form-select"
                                                                        aria-label="Default select example"
                                                                        name="category_id">
                                                                        <option selected>Select Category</option>
                                                                        @foreach ($category as $data)
                                                                            <option value="{{ $data->id}}">
                                                                                {{ $data->category_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
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
        var table = $('.mainData').DataTable();

        // Filter Kategori
        $('#categoryFilter').on('change', function () {
            var selected = $(this).val().toLowerCase();
            table.rows().every(function () {
                var category = $(this.node()).data('category').toLowerCase();
                if (selected === "" || category === selected) {
                    $(this.node()).show();
                } else {
                    $(this.node()).hide();
                }
            });
        });

        // Filter Tanggal
        $('#startDate, #endDate').on('change', function () {
            var start = $('#startDate').val();
            var end = $('#endDate').val();

            table.rows().every(function () {
                var date = $(this.node()).data('date');
                if ((!start || date >= start) && (!end || date <= end)) {
                    $(this.node()).show();
                } else {
                    $(this.node()).hide();
                }
            });
        });
    });
</script>


</html>