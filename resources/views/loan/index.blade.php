@include('layouts.admin.header')

<body>
    <!-- Toast -->
    @include('layouts.alert.loan')

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
                                    <a href="" class="btn btn-danger btn-md text-white mb-3 me-0"><i
                                            class="ti ti-refresh"></i></a>
                                    <a type="button" class="btn btn-primary btn-md text-white mb-3 me-0"
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                                            class=" ti ti-folder-plus"></i></a>
                                    <a href="{{ route('loan.export') }}" type="button"
                                        class="btn btn-success btn-md text-white mb-3 me-0"><i
                                            class=" ti ti-file-spreadsheet"></i> Export Excel</a>
                                </div>
                            </div>
                            <!-- Modal Form-->
                            @include('layouts.modal.loan.add')
                            <!-- End Modal -->
                            <!-- Table -->
                            <div class="table-responsive mb-3">
                                <table class="table table-striped table-bordered text-nowrap align-middle loan">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label>Category Filter</label>
                                            <select id="categoryFilter" class="form-select">
                                                <option value="">All Category</option>
                                                @foreach ($l_Category as $filter)
                                                    <option value="{{ $filter->category_name }}">
                                                        {{ $filter->category_name }}
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
                                              @include('layouts.modal.loan.edit')
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
        var table = $('.loan').DataTable();

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