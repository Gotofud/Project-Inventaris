@include('layouts.admin.header')

<body>
   <!-- Toast -->
    @include('layouts.alert.mainData')

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
                                    <a href="" class="btn btn-danger btn-md text-white mb-3 me-0"><i
                                            class="ti ti-refresh"></i></a>
                                    <a type="button" class="btn btn-primary btn-md text-white mb-3 me-0"
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                                            class=" ti ti-folder-plus"></i></a>
                                    <a href="{{ route('mainData.export') }}" type="button"
                                        class="btn btn-success btn-md text-white mb-3 me-0"><i
                                            class=" ti ti-file-spreadsheet"></i> Export Excel</a>
                                </div>
                            </div>
                            <!-- Modal Form Add data-->
                            @include('layouts.modal.mainData.add')
                            <!-- End Modal Add data -->
                            <!-- Table -->
                            <div class="table-responsive mb-3">
                                <table class="table table-striped table-bordered text-nowrap align-middle mainData">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label>Category Filter</label>
                                            <select id="categoryFilter" class="form-select">
                                                <option value="">All Category</option>
                                                @foreach ($category as $filter)
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
                                                <td>
                                                @if ($data->stock > 0)
                                                {{ $data->stock }}
                                                @else
                                                <span class="badge bg-danger text-white">Empty</span>
                                                @endif
                                            </td>
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
                                           @include('layouts.modal.mainData.edit')
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
                let date = data[5]; // Column Date (5)
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