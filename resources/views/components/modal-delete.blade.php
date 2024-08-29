<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-delete" action="{{$deleteUrl}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal-delete-label">Deleting Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this data ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <x-button-submit></x-button-submit>
                </div>
            </form>
        </div>
    </div>
</div>
