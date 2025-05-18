<div class="modal fade" id="edit-{{ $data->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5"><i class="ti ti-pencil"></i> Edit
                    Staff</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Input Group -->
                <form action="{{ route('staff.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="ti ti-user"></i></span>
                        <input type="text" class="form-control" value="{{ $data->name }}" name="name">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">@</span>
                        <input type="email" class="form-control" value="{{ $data->email }}" name="email">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="ti ti-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Edit Password" name="password">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="ti ti-lock-access"></i></span>
                        <input type="password" class="form-control" placeholder="Confirm Password"
                            name="password_confirmation">
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