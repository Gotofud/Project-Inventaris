@if (session('edit_success'))
    <div class="toast toast-onload align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="toast-body hstack align-items-start gap-6">
            <i class="ti ti-circle-check fs-6"></i>
            <div>
                <h5 class="text-white fs-3 mb-1">Edit Category Success</h5>
            </div>
            <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
@elseif (session('delete_success'))
    <div class="toast toast-onload align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="toast-body hstack align-items-start gap-6">
            <i class="ti ti-circle-check fs-6"></i>
            <div>
                <h5 class="text-white fs-3 mb-1">Delete Category Success</h5>
            </div>
            <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
@elseif (session('category_success'))
    <div class="toast toast-onload align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="toast-body hstack align-items-start gap-6">
            <i class="ti ti-circle-check fs-6"></i>
            <div>
                <h5 class="text-white fs-3 mb-1">Add Category Success</h5>
            </div>
            <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
@elseif (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="toast toast-onload align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-body hstack align-items-start gap-6">
                <i class="ti ti-circle-x fs-6"></i>
                <div>
                    <h5 class="text-white fs-3 mb-1">{{$error}}</h5>
                </div>
                <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @endforeach
@endif