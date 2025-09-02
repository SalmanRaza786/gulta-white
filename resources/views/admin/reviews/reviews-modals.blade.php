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


