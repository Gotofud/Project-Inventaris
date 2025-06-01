<!-- Modal -->
<div class="modal fade" id="room_items" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('room_items.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="ti ti-category"></i> Add Room Items</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="ti ti-category"></i></span>
                        <select class="form-select" name="rooms_id" required >
                            <option selected disabled>Select Room</option>
                            @foreach ($room as $data)
                                <option value="{{ $data->id }}">{{ $data->room_name }}</option>
                            @endforeach
                        </select>
                    </div>

                             <div id="item-rows">
                        <div class="row mb-2 item-row">
                            <div class="col">
                            
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-box"></i></span>
                                    <button class="text-start form-control itemsDropdown" type="button" id="itemsDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="text-muted">- Choose Item -</span>
                                    </button>
                                    <ul class="dropdown-menu w-100" aria-labelledby="itemsDropdown" style="max-height: 250px; overflow-y: auto;">
                                        @foreach ($mainData as $mainItem)
                                            <li style="display: flex; gap: 5px;" class="m-3">
                                                <img src="{{ asset('images/data/' . $mainItem->img) }}" alt="{{ $mainItem->name }}"
                                                     style="width: 75px;">
                                                <a class="dropdown-item" href="#" data-id="{{ $mainItem->id }}"
                                                   data-name="{{ $mainItem->name }}" data-stock="{{ $mainItem->stock }}">
                                                    <div>
                                                        <strong>{{ $mainItem->name }}</strong><br>
                                                        @if ($mainItem->stock > 0)
                                                        <small class="badge bg-success mt-2"> Stock : {{ $mainItem->stock }}</small>
                                                        @else
                                                        <small class="badge badge-sm bg-danger mt-2">Out Of Stock</small>
                                                        @endif
                                                        
                                                    </div>
                                                </a>
                                            </li>
                                            <hr>
                                        @endforeach
                                    </ul>
                                    <input type="hidden" name="item_id[]" class="item_id">
                                    
                                    <input type="number" class="form-control mx-2" name="amount[]" placeholder="Amount" required>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy"></i> Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownItems = document.querySelectorAll('.dropdown-item');

        dropdownItems.forEach(item => {
            item.addEventListener('click', function () {
                const name = this.getAttribute('data-name');
                const id = this.getAttribute('data-id');

                // Find the parent .item-row of the clicked element
                const row = this.closest('.item-row');
                const dropdownButton = row.querySelector('.itemsDropdown');
                const hiddenInput = row.querySelector('.item_id');

                // Update values
                dropdownButton.innerHTML = name;
                hiddenInput.value = id; // Set the hidden input value

            });
        });
    });
</script>