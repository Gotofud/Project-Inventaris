@include('layouts.admin.header')

<body>
   @if (session('add_success'))
        <div class="toast toast-onload align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-body hstack align-items-start gap-6">
                <i class="ti ti-circle-check fs-6"></i>
                <div>
                    <h5 class="text-white fs-3 mb-1">Loan Success</h5>
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
                    <h5 class="text-white fs-3 mb-1">Edit Staff Success</h5>
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
                    <h5 class="text-white fs-3 mb-1">Delete Staff Success</h5>
                </div>
                <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @elseif (session('return_success'))
        <div class="toast toast-onload align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-body hstack align-items-start gap-6">
                <i class="ti ti-circle-check fs-6"></i>
                <div>
                    <h5 class="text-white fs-3 mb-1">Return Success</h5>
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
                                    <h4 class="fw-semibold mb-8">Loan Data</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-muted text-decoration-none"
                                                    href="{{ route('welcome') }}">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">Loan Data</li>
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
                                <h4 class="card-title"><i class="ti ti-folders"></i>Loan Data</h4>
                                <div class="action">
                                    <a type="button" class="btn btn-primary btn-md text-white mb-3 me-0"
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                                            class=" ti ti-folder-plus"></i></a>
                                    <a href="{{ route('loan.export') }}" type="button"
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
                                                    class="ti ti-script-plus"></i> Loan Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form Input Group -->
                                            <form action="{{ route('loan.store') }}" method="POST">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="ti ti-calculator"></i></span>
                                                    <input type="text" class="form-control" placeholder="Borrower's Name"
                                                        aria-label="brws_name" aria-describedby="basic-addon1"
                                                        name="brws_name">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="ti ti-category"></i></span>
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="item_id">
                                                        <option selected>Select Data</option>
                                                        @foreach ($l_Maindata as $data)
                                                            <option value="{{ $data->id }}">
                                                                {{ $data->name }} | Stock : {{ $data->stock }}
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
                                                        name="loan_date">
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
                                <table class="table table-striped table-bordered text-nowrap align-middle loan">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th>Image</th>
                                            <th>Loan Code</th>
                                            <th>Borrower</th>
                                            <th>Item Name</th>
                                            <th>Category</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <td>Info</td>
                                            <th>Loan At</th>
                                            <th>Action</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
                                        <!-- start row -->
                                        @foreach ($loan as $data)
                                            <tr>
                                                <td>
                                                    <img src="{{asset('/images/data/' . $data->mainData->img)}}"
                                                        class="rounded" width="50">
                                                </td>
                                                <td>{{ $data->loan_code }}</td>
                                                <td>{{ $data->brws_name }}</td>
                                                <td>{{ $data->mainData->name }}</td>
                                                <td>{{ $data->mainData->category->category_name }}</td>
                                                <td>{{ $data->amount }}</td>
                                                <td> @if ($data->status === 0)
                                                    <span class="badge bg-danger text-white">Not Return</span>
                                                @else
                                                        <span class="badge bg-success text-white">Returned</span>
                                                    @endif
                                                </td>
                                                <td>{{ $data->info }}</td>
                                                <td>{{ $data->loan_date }}</td>
                                                <td>
                                                    <div class="action">
                                                        <!-- Form Return -->
                                                        @if ($data->status === 0)
                                                            <form action="{{ route('loan.return', $data->id) }}" method="POST"
                                                                style="display:inline-block;">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="number" class="d-none" name="amount"
                                                                    value="{{ $data->amount }}">
                                                                <button type="submit" class="btn btn-success me-0"
                                                                    onclick="return confirm('Are you sure?')" name="status"
                                                                    value="1"><i class="ti ti-arrow-back-up"></i></button>
                                                            </form>

                                                            <!-- Button Edit Modal -->
                                                            <a type="button" class="btn btn-warning me-0" data-bs-toggle="modal"
                                                                data-bs-target="#edit-{{ $data->id }}">
                                                                <i class="ti ti-pencil"></i>
                                                            </a>
                                                        @endif

                                                        <!-- Form Delete -->
                                                        <form action="{{ route('loan.destroy', $data->id) }}" method="POST"
                                                            style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger me-0"
                                                                onclick="return confirm('Are you sure?')"><i
                                                                    class="ti ti-trash"></i></button>
                                                        </form>

                                                    </div>

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
                                                            <!-- Form Input Group -->
                                                            <form action="{{ route('loan.update', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="ti ti-calculator"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Borrower's name" aria-label="brws_name"
                                                                        aria-describedby="basic-addon1" name="brws_name"
                                                                        value="{{ $data->brws_name }}">
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="ti ti-category"></i></span>
                                                                    <select class="form-select"
                                                                        aria-label="Default select example" name="item_id">
                                                                        <option selected>Select Data</option>
                                                                        @foreach ($l_Maindata as $edit)
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
                                                                        aria-describedby="basic-addon1" name="loan_date"
                                                                        value="{{ $data->loan_date }}">
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="ti ti-info-circle"></i></span>
                                                                    <textarea class="form-control" placeholder="Information"
                                                                        aria-label="info" aria-describedby="basic-addon1"
                                                                        name="info">{{ $data->info }}</textarea>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('.loan').DataTable();
    });
</script>

</html>