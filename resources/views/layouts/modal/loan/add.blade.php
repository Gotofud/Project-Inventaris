<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="ti ti-script-plus"></i> Loan Item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Input Group -->
                <form action="{{ route('loan.store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="ti ti-calculator"></i></span>
                        <input type="text" class="form-control" placeholder="Borrower's Name" aria-label="brws_name"
                            aria-describedby="basic-addon1" name="brws_name">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="ti ti-category"></i></span>
                        <select class="form-select" aria-label="Default select example" name="item_id">
                            <option selected>Select Data</option>
                            @foreach ($l_Maindata as $data)
                                <option value="{{ $data->id }}">
                                    {{ $data->name }} | Stock : {{ $data->stock }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="ti ti-calculator"></i></span>
                        <input type="number" class="form-control" placeholder="Amount" aria-label="Amount"
                            aria-describedby="basic-addon1" name="amount">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="ti ti-calendar"></i></span>
                        <input type="date" class="form-control" placeholder="Entry Date" aria-label="Password"
                            aria-describedby="basic-addon1" name="loan_date">
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