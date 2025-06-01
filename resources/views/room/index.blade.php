@include('layouts.admin.header')

<body>
    <!-- Toast -->
    @include('layouts.alert.room')

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
                                        data-bs-toggle="modal" data-bs-target="#room"><i
                                            class=" ti ti-folder-plus"></i></a>
                                    <a href="{{ route('room.export') }}" type="button"
                                        class="btn btn-success btn-md text-white mb-3 me-0"><i
                                            class=" ti ti-file-spreadsheet"></i> Export Excel</a>
                                    <a href="{{ route('room.exportPDF') }}" type="button"
                                        class="btn btn-info btn-md text-white mb-3 me-0"><i
                                            class=" ti ti-file-text"></i> Export PDF</a>
                                </div>
                            </div>
                            <!-- Modal Form Add room-->
                            @include('layouts.modal.room.add')
                            <!-- End Modal Add room -->
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
                                        @php
                                            $no = 1;
                                        @endphp
                                        <!-- start row -->
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
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure?')"><i
                                                                class="ti ti-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- Modal Form Edit room-->
                                            @include('layouts.modal.room.edit')
                                            <!-- End Modal Edit room -->
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
            <!-- Modal Form Add Room Items -->
            @include('layouts.modal.room_items.add')
            <!-- End Modal Add Room Items -->
            <!-- Script -->
            @include('layouts.admin.script')
</body>
<script type="text/javascript">
    $(document).ready(function () {
        $('.room').DataTable();
    });

    
</script>

</html>