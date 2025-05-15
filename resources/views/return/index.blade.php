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
                    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                        <div class="card-body px-4 py-3">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h4 class="fw-semibold mb-8">Return Data</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-muted text-decoration-none"
                                                    href="{{ route('welcome') }}">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">Return Data</li>
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
                                <h4 class="card-title"><i class="ti ti-folders"></i>Return Data</h4>
                                <div class="action">
                                    <a href="" class="btn btn-danger btn-md text-white mb-3 me-0"><i
                                            class="ti ti-refresh"></i></a>
                                    <a href="{{ route('return.export') }}" type="button"
                                        class="btn btn-success btn-md text-white mb-3 me-0"><i
                                            class=" ti ti-file-spreadsheet"></i> Export Excel</a>
                                </div>
                            </div>
                            <!-- Table -->
                            <div class="table-responsive mb-3">
                                <table class="table table-striped table-bordered text-nowrap align-middle return">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label>Category Filter</label>
                                            <select id="categoryFilter" class="form-select">
                                                <option value="">All Category</option>
                                                @foreach ($r_Category as $filter)
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
                                            <th>#</th>
                                            <th>Loan Code</th>
                                            <th>Borrower</th>
                                            <th>Item Name</th>
                                            <th>Category</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <td>Info</td>
                                            <th>Return At</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
                                        <!-- start row -->
                                        @php
                                            $no = 1;
                                         @endphp
                                        @foreach ($loan as $data)
                                            @if ($data->status === 1)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
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
                                                </tr>
                                            @endif
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
    var table = $('.return').DataTable();

    // Category Filter
    $('#categoryFilter').on('change', function () {
        let selected = $(this).val();
        // Filter Column (3) Category
        table.column(4).search(selected).draw();
    });

    // Date Picker
    $('#startDate, #endDate').on('change', function () {
        let start = $('#startDate').val();
        let end = $('#endDate').val();

        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            let date = data[8]; // Column Date (5)
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