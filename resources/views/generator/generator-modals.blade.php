
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title add-lang-title" id="exampleModalLabel" >{{__('translation.add')}} Products</h5>
                <h5 class="modal-title edit-lang-title" id="exampleModalLabel" style="display: none">{{__('translation.edit')}} Products</h5>
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close btn-modal-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <div>
            </div>
            <form method="post" class=" g-3 needs-validation" action="{{route('admin.product.add')}}" autocomplete="off" id="RolesForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="number" name="id" value="0" class="d-none">
                        <label for="validationCustom01" class="form-label">Name</label>
                        <input type="text" class="form-control" name="title" id="validationCustom01" placeholder="Name"  required>

                    </div>
                    <div class="mb-3">

                        <label for="validationCustom01" class="form-label">Prefix</label>
                        <input type="text" class="form-control" name="prefix" id="validationCustom01" placeholder="Prefix"  required>

                    </div>
                    <div class="mb-3">

                        <label for="validationCustom01" class="form-label">Digits</label>
                        <input type="number" class="form-control" name="digits" id="validationCustom01" placeholder="Digits"  required>

                    </div>
                    <div class="mb-3">

                        <label for="validationCustom01" class="form-label">Image</label>
                        <input type="file" class="form-control" name="p_image" id="validationCustom01"  required>

                    </div>

                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light btn-modal-close" data-bs-dismiss="modal">{{__('translation.close')}}</button>
                        <button type="submit" class="btn btn-primary btn-submit btn-add" id="add-btn">Save </button>
                        <button type="submit" class="btn btn-primary btn-submit btn-save-changes" id="add-btn" style="display: none">@lang('translation.btn_update')</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="pCodes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title add-lang-title" id="exampleModalLabel" >{{__('translation.add')}} Generate Codes</h5>
                <h5 class="modal-title edit-lang-title" id="exampleModalLabel" style="display: none">{{__('translation.edit')}} @lang('translation.roles')</h5>
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close btn-modal-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <div>
            </div>
            <form method="post" class=" g-3 needs-validation" action="{{route('admin.product.code.create')}}" autocomplete="off" id="CodeForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="number" name="id" value="0" class="d-none">
                        <label for="validationCustom01" class="form-label">Name</label>
                        <select name="p_id" id="" class="form-control">
                            <option value="">Choose One</option>
                            @isset($data['products'])
                                @foreach($data['products'] as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            @endisset
                        </select>

                    </div>
                    <div class="mb-3">

                        <label for="validationCustom01" class="form-label">Qty</label>
                        <input type="text" class="form-control" name="qty" placeholder="Qty"  required>

                    </div>


                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light btn-modal-close" data-bs-dismiss="modal">{{__('translation.close')}}</button>
                        <button type="submit" class="btn btn-primary btn-submit btn-add" id="add-btn">Save</button>
                        <button type="submit" class="btn btn-primary btn-submit btn-save-changes" id="add-btn" style="display: none">@lang('translation.btn_update')</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="textMessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title add-lang-title" id="exampleModalLabel" >Message Text</h5>
                <h5 class="modal-title" id="exampleModalLabel">Message Text</h5>
                <button type="button" class="btn-close btn-modal-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <div>
            </div>
            <form method="post" class=" g-3 needs-validation" action="{{route('admin.text.message.update')}}" autocomplete="off" id="TextMessageForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="number" name="id" value="0" class="d-none">
                        <label for="validationCustom01" class="form-label">Valid Message</label>
                            <textarea name="valid_message" id="" cols="10" rows="3" class="form-control" required></textarea>

                    </div>
                    <div class="mb-3">

                        <label for="validationCustom01" class="form-label">Invalid Message</label>
                        <textarea name="invalid_message" id="" cols="10" rows="3" placeholder="Invalid Message" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">

                        <label for="validationCustom01" class="form-label">Verified Message</label>
                        <textarea name="verified_message" id="" cols="10" rows="3" placeholder="Verified Message" class="form-control" required></textarea>
                    </div>


                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light btn-modal-close" data-bs-dismiss="modal">{{__('translation.close')}}</button>
                        <button type="submit" class="btn btn-primary btn-submit btn-add" id="add-btn">Save</button>
                        <button type="submit" class="btn btn-primary btn-submit btn-save-changes" id="add-btn" style="display: none">@lang('translation.btn_update')</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="markAsPublishModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close btn-modal-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">

                    <lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f7b84b,secondary:#405189" style="width:130px;height:130px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you Sure ?</h4>
                        <p class="text-muted mx-4 mb-0">You want to update status of this Record ?</p>
                    </div>
                    <input type="hidden" name="inp_is_publish">
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light btn-modal-close" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger btn-confirm-publish" id="delete-record">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>




