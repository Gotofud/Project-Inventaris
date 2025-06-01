<div class="modal fade" id="edit-{{ $data->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="ti ti-script-plus"></i> Edit Item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Edit Group -->
                <form action="{{ route('outcoming-item.update', $data->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <input type="hidden" name="item_id" class="item_id" value="{{ $data->item_id }}">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="ti ti-box"></i></span>
                            <button class="text-start form-control itemsDropdown" type="button" id="itemsDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="selected-item-name">{{ $data->mainData->name ?? '- Choose Item -' }}</span>
                            </button>
                            <ul class="dropdown-menu w-100" aria-labelledby="itemsDropdown" style="max-height: 250px; overflow-y: auto;">
                                @foreach ($outMaindata as $mainItem)
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
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="ti ti-calculator"></i></span>
                            <input type="number" class="form-control" placeholder="Amount" aria-label="Amount"
                                aria-describedby="basic-addon1" name="amount" value="{{ $data->amount }}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="ti ti-calendar"></i></span>
                            <input type="date" class="form-control" placeholder="Entry Date" aria-label="Password"
                                aria-describedby="basic-addon1" name="exit_date" value="{{ $data->exit_date }}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="ti ti-info-circle"></i></span>
                            <textarea class="form-control" placeholder="Information" aria-label="info"
                                aria-describedby="basic-addon1" name="info">{{$data->info}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy"></i>Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
                <!-- End Edit Form -->
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