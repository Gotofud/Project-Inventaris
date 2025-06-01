<div class="modal fade" id="room" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="ti ti-category"></i> Add Room</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Input Group -->
                <form action="{{ route('room.store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="ti ti-category"></i></span>
                        <input type="text" name="room_name" class="form-control" placeholder="Add Room">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy"></i> Save
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
</div>