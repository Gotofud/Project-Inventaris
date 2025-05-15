@include('layouts.admin.header')

<body>
    @if (session('add_success'))
        <div class="toast toast-onload align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-body hstack align-items-start gap-6">
                <i class="ti ti-circle-check fs-6"></i>
                <div>
                    <h5 class="text-white fs-3 mb-1">Incoming Item Success</h5>
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
                    <h5 class="text-white fs-3 mb-1">Edit Data Success</h5>
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
                    <h5 class="text-white fs-3 mb-1">Delete Data Success</h5>
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
                    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                        <div class="card-body px-4 py-3">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h4 class="fw-semibold mb-8">Incoming Item</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-muted text-decoration-none"
                                                    href="{{ route('welcome') }}">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">Incoming Data</li>
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
                                <h4 class="card-title"><i class="ti ti-folders"></i>Incoming Data</h4>
                                <div class="action">
                                    <a href="" class="btn btn-danger btn-md text-white mb-3 me-0"><i class="ti ti-refresh"></i></a>
                                    <a type="button" class="btn btn-primary btn-md text-white mb-3 me-0"
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                                            class=" ti ti-folder-plus"></i></a>
                                    <a href="{{ route('incoming.export') }}" type="button"
                                        class="btn btn-success btn-md text-white mb-3 me-0"><i
                                            class=" ti ti-file-spreadsheet"></i> Export Excel</a>
                                </div>
                            </div>
                            <!-- Modal Form-->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel"><i
                                                    class="ti ti-script-plus"></i> Incoming Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form Input Group -->
                                            <form action="{{ route('incoming-item.store') }}" method="POST">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="ti ti-category"></i></span>
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="item_id">
                                                        <option selected>Select Data</option>
                                                        @foreach ($icmMaindata as $data)
                                                            <option value="{{ $data->id }}">
                                                                {{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="ti ti-calculator"></i></span>
                                                    <input type="number" class="form-control" placeholder="Amount"
                                                        aria-label="Amount" aria-describedby="basic-addon1"
                                                        name="amount">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="ti ti-calendar"></i></span>
                                                    <input type="date" class="form-control" placeholder="Entry Date"
                                                        aria-label="Password" aria-describedby="basic-addon1"
                                                        name="entry_date">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="ti ti-info-circle"></i></span>
                                                    <textarea class="form-control" placeholder="Information"
                                                        aria-label="info" aria-describedby="basic-addon1"
                                                        name="info"></textarea>
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
                                <table class="table table-striped table-bordered text-nowrap align-middle icmItem">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label>Category Filter</label>
                                            <select id="categoryFilter" class="form-select">
                                                <option value="">All Category</option>
                                                @foreach ($icmCategory as $filter)
                                                    <option value="{{ $filter->category_name }}">{{ $filter->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Date Filter</label>
                                            <div class="input-group">
                                                <input type="date" id="startDate" class="form-control"
                                                    placeholder="from">
                                                <input type="date" id="endDate" class="form-control" placeholder="To">
                                            </div>
                                        </div>
                                    </div>
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th>Image</th>
                                            <th>Incoming Code</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Amount</th>
                                            <td>Info</td>
                                            <th>Coming At</th>
                                            <th>Action</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
                                        <!-- start row -->
                                        @foreach ($icm_item as $data)
                                            <tr>
                                                <td>
                                                    <img src="{{asset('/images/data/' . $data->mainData->img)}}"
                                                        class="rounded" width="50">
                                                </td>
                                                <td>{{ $data->icm_code }}</td>
                                                <td>{{ $data->mainData->name }}</td>
                                                <td>{{ $data->mainData->category->category_name }}</td>
                                                <td>{{ $data->amount }}</td>
                                                <td>{{ $data->info }}</td>
                                                <td>{{ $data->entry_date }}</td>
                                                <td>
                                                    <form action="{{ route('incoming-item.destroy', $data->id) }}"
                                                        method="POST">
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
                                            <!-- Modal Form-->
                                            <div class="modal fade" id="edit-{{ $data->id }}" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel"><i
                                                                    class="ti ti-script-plus"></i> Edit Item</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Form Edit Group -->
                                                            <form action="{{ route('incoming-item.update', $data->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="ti ti-category"></i></span>
                                                                    <select class="form-select"
                                                                        aria-label="Default select example" name="item_id">
                                                                        <option selected>Select Data</option>
                                                                        @foreach ($icmMaindata as $edit)
                                                                            <option value="{{ $edit->id }}" {{ $data->item_id == $edit->id ? 'selected' : ''}}>
                                                                                {{ $edit->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="ti ti-calculator"></i></span>
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Amount" aria-label="Amount"
                                                                        aria-describedby="basic-addon1" name="amount"
                                                                        value="{{ $data->amount }}">
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="ti ti-calendar"></i></span>
                                                                    <input type="date" class="form-control"
                                                                        placeholder="Entry Date" aria-label="Password"
                                                                        aria-describedby="basic-addon1" name="entry_date"
                                                                        value="{{ $data->entry_date }}">
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="ti ti-info-circle"></i></span>
                                                                    <textarea class="form-control" placeholder="Information"
                                                                        aria-label="info" aria-describedby="basic-addon1"
                                                                        name="info">{{$data->info}}</textarea>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary"><i
                                                                    class="ti ti-device-floppy"></i>Save</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                        <!-- End Edit Form -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
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
        var table = $('.icmItem').DataTable();

        // Category Filter
        $('#categoryFilter').on('change', function () {
            let selected = $(this).val();
            // Filter Column (3) Category
            table.column(3).search(selected).draw();
        });

        // Date Picker
        $('#startDate, #endDate').on('change', function () {
            let start = $('#startDate').val();
            let end = $('#endDate').val();

            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                let date = data[6]; // Column Date (5)
                let formatted = date.split(" ")[0]; // Take Y-m-d

                if (
                    (!start || formatted >= start) &&
                    (!end || formatted <= end)
                ) {
                    return true;
                }
                return false;
            });

            table.draw();
        });
    });

</script>


</html>