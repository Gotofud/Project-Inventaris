@include('layouts.admin.header')

<body>
    <!-- Toast -->
    @include('layouts.alert.roomItems')

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
                    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4"
                        style="background-image: url('{{ asset('assets/images/backgrounds/profilebg.jpg') }}')">
                        <div class="card-body px-4 py-3">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h4 class="fw-semibold mb-8">Room</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-muted text-decoration-none"
                                                    href="{{ route('welcome') }}">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">Room</li>
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
                                        data-bs-toggle="modal" data-bs-target="#room_items"><i
                                            class=" ti ti-folder-plus"></i></a>
                                    <a href="{{ route('room_items.export') }}" type="button"
                                        class="btn btn-success btn-md text-white mb-3 me-0"><i
                                            class=" ti ti-file-spreadsheet"></i> Export Excel</a>
                                    <a href="{{ route('room_items.exportPDF') }}" type="button"
                                        class="btn btn-info btn-md text-white mb-3 me-0"><i
                                            class=" ti ti-file-text"></i> Export PDF</a>
                                </div>
                            </div>
                            <!-- Table -->
                            <div class="table-responsive mb-3">
                                <table class="table table-striped table-bordered text-nowrap align-middle room_item">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label>Room Filter</label>
                                            <select id="roomFilter" class="form-select">
                                                <option value="">All Room</option>
                                                @foreach ($room as $filter)
                                                    <option value="{{ $filter->room_name }}">
                                                        {{ $filter->room_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Item Filter</label>
                                            <select id="itemFilter" class="form-select">
                                                <option value="">All Item</option>
                                                @foreach ($mainData as $filter)
                                                    <option value="{{ $filter->name }}">
                                                        {{ $filter->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th>#</th>
                                            <th>Room Name</th>
                                            <th>Item</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($groupedItems as $item)
                                            @php
                                                $roomName = $room->firstWhere('id', $item->rooms_id)->room_name ?? 'Unknown Room';
                                                $itemName = $mainData->firstWhere('id', $item->item_id)->name ?? 'Unknown Item';
                                            @endphp
                                            <tr data-room="{{ $item->rooms_id->room_name ?? '' }}"
                                                data-item="{{ $item->item_id->name ?? '' }}">
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $roomName }}</td>
                                                <td>{{ $itemName }}</td>
                                                <td>{{ $item->total_amount }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('room_items.destroy', ['rooms_id' => $item->rooms_id, 'item_id' => $item->item_id]) }}"
                                                        method="POST">
                                                        <a type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#edit_{{ $item->rooms_id }}_{{ $item->item_id }}">
                                                            <i class="ti ti-pencil"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @include('layouts.modal.room_items.edit')
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <!-- end Zero Configuration -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Item -->
            @include('layouts.modal.room_items.add')
            <!-- End Of Add Item -->
            <!-- Script -->
            @include('layouts.admin.script')
</body>
<script type="text/javascript">
    $(document).ready(function () {
        var table = $('.room_item').DataTable();

        // room Filter
        $('#roomFilter').on('change', function () {
            let selected = $(this).val();
            // Filter Column (1) Category
            table.column(1).search(selected).draw();
        });

        // item Filter
        $('#itemFilter').on('change', function () {
            let selected = $(this).val();
            // Filter Column (2) Category
            table.column(2).search(selected).draw();
        });
    });
</script>

</html>