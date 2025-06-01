<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="ti ti-script-plus"></i> Incoming Item
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Input Group -->
                <form action="{{ route('incoming-item.store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="ti ti-calculator"></i></span>
                        <button class="text-start form-control" type="button" id="itemsDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="text-muted">- Choose Item -</span>
                        </button> 
                        <ul class="dropdown-menu w-100" aria-labelledby="barangDropdown" style="max-height: 250px; overflow-y: auto;">
                            @foreach ($icmMaindata as $data)
                                <li style="display: flex; gap: 5px;" class="m-3">
                                    <img src="{{ asset('images/data/' . $data->img) }}" alt="" srcset=""
                                        style="width: 75px;">
                                    <a class="dropdown-item" href="#" data-id="{{ $data->id }}"
                                        data-name="{{ $data->name }}" data-stock="{{ $data->stock }}">
                                        <div>
                                            <strong>{{ $data->name }}</strong><br>
                                            @if ($data->stock > 0)
                                                <small class="badge bg-success mt-2"> Stock : {{ $data->stock }}</small>
                                            @else
                                                <small class="badge badge-sm bg-danger mt-2">Out Of Stock</small>
                                            @endif
                                        </div>
                                    </a>
                                </li>
                                <hr>
                            @endforeach
                        </ul>
                        <input type="hidden" name="item_id" id="item_id">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="ti ti-calculator"></i></span>
                        <input type="number" class="form-control" placeholder="Amount" aria-label="Amount"
                            aria-describedby="basic-addon1" name="amount">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="ti ti-calendar"></i></span>
                        <input type="date" class="form-control" placeholder="Entry Date" aria-label="Password"
                            aria-describedby="basic-addon1" name="entry_date">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="ti ti-info-circle"></i></span>
                        <textarea class="form-control" placeholder="Information" aria-label="info"
                            aria-describedby="basic-addon1" name="info"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy"></i>Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownItems = document.querySelectorAll('.dropdown-item');
        const dropdownButton = document.getElementById('itemsDropdown');
        const hiddenInput = document.getElementById('item_id');

        dropdownItems.forEach(item => {
            item.addEventListener('click', function () {
                const name = this.getAttribute('data-name');
                const id = this.getAttribute('data-id');

                // Update the button text
                dropdownButton.innerHTML = name;

                // Set the hidden input value
                hiddenInput.value = id;
            });
        });
    });
</script>