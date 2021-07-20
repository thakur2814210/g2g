 <!-- Logout Modal-->
<div class="modal fade" id="clientStatusChange" tabindex="-1" role="dialog" aria-labelledby="clientStatusChange" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="clientStatusChange">Status Change?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
     <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.client.status.update')); ?>" enctype="multipart/form-data">
       <?php echo e(csrf_field()); ?>

      <div class="modal-body">
       <input type="hidden" name="modal_client_id" id="modal_client_id" value="" >
          <div class="form-group row">
            <label for="tag_status" class="col-sm-12 col-form-label">Status</label>
            <div class="col-sm-12">
              <select class="form-control" name="status" id="status" required="required">
                  <option value="">Select Status</option>
                  <option value="1">Active</option>
                  <option value="2">Delete</option>
                  <option value="3">pending</option>
                </select>
            </div>
          </div>
                        
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger " type="button" data-dismiss="modal">Cancel</button>
        <button class="btn btn-success " type="submit" >Submit</button>
      </div>
    </form>
    </div>
  </div>
</div><?php /**PATH /home/devhs/public_html/g2g-v3/Modules/Admin/Resources/views/modals/client-status-change.blade.php ENDPATH**/ ?>