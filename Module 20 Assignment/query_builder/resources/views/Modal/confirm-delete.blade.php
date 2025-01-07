
<div class="modal fade" id="delete-modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-zoom">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5" id="delete-modal">Delete Confirmation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <p class="">Are you sure to delete this?</p>
            <div class="row pt-2">
                <div class="col-6">
                    <button data-bs-dismiss="modal" class="btn btn-outline-danger">cencel</button>
                </div>
                <div class="col-6">
                    <form id="delete-link" action="" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
