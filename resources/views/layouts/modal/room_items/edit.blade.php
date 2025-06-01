<!-- Modal -->
<div class="modal fade" id="edit_{{ $item->rooms_id }}_{{ $item->item_id }}" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form
                action="{{ route('room_items.update', ['rooms_id' => $item->rooms_id, 'item_id' => $item->item_id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title"><i class="ti ti-category"></i> Edit Room Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="rooms_id" value="{{ $item->rooms_id }}">
                    <input type="hidden" name="item_id" class="item_id" value="{{ $item->item_id }}">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="ti ti-box"></i></span>
                        <button class="text-start form-control itemsDropdown" type="button" id="itemsDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="selected-item-name">{{ $item->mainData->name ?? '- Choose Item -' }}</span>
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
                        <input type="number" class="form-control mx-2" name="amount" placeholder="Amount" required
                            value="{{ $item->total_amount }}">
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
            item.addEventListener('click', function (e) {
                e.preventDefault();
                const name = this.getAttribute('data-name');
                const id = this.getAttribute('data-id');
                const row = this.closest('.modal-content');
                const dropdownButton = row.querySelector('.itemsDropdown .selected-item-name');
                const hiddenInput = row.querySelector('.item_id');
                dropdownButton.textContent = name;
                hiddenInput.value = id;
            });
        });
    });
</script>