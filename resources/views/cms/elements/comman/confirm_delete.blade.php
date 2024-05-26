<div id="confirm" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">delete {{ $name }}</h4>
            </div>

        <div class="modal-body">Are you sure you want to delete {{ $name }}?</div>
        <div class="modal-footer">
            <a href="" class="btn btn-primary delete-entry" id="delete">Delete</a>
            <button class="btn btn-outline-dark m-1" data-dismiss="modal" type="button">Cancel</button>
        </div>
      </div>
    </div>
</div>