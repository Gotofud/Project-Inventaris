<div class="modal fade" id="edit-{{ $data->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5"><i class="ti ti-folder"></i> Edit
                    Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Input Group -->
                <form action="{{ route('mainData.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <img src="{{asset('/images/data/' . $data->img)}}" width="50">
                        <input class="form-control" type="file" id="formFile" name="img">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="ti ti-list-details"></i></span>
                        <input type="text" class="form-control" value="{{ $data->name }}" name="name">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="ti ti-category"></i></span>
                        <select class="form-select" aria-label="Default select example" name="category_id">
                            <option selected>Select Category</option>
                            @foreach ($category as $data)
                                <option value="{{ $data->id}}">
                                    {{ $data->category_name }}
                                </option>
                            @endforeach
                        </select>
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