<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('css'); ?>
   <link rel="stylesheet" href="<?php echo e(asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.css')); ?>">
   <style type="text/css">
     select.form-control:not([size]):not([multiple]){
      height: 30px;
     }
     .form-control-sm, .input-group-sm>.form-control, .input-group-sm>.input-group-addon, .input-group-sm>.input-group-btn>.btn{
        padding: .25rem .5rem !important;
     }
   </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
   <ol class="breadcrumb">
      <li class="breadcrumb-item">
          <a href="<?php echo e(route('superadmin.dashboard')); ?>">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Service Request List</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
      <div class="col-12">
          <?php if(session('status')): ?>
              <div class="alert alert-warning">
                  <?php echo e(session('status')); ?>

              </div>
          <?php endif; ?>
      </div>
    </div>

     <div class="box_general padding_bottom">
        <div class="header_box version_2">
          <h2  class="text-danger"><i class="fa fa-users text-danger"></i>Service Request List</h2>
        </div>
         <div class="table-responsive">
           <div class="row">
            <div class="col-12">
              <div class="col-3">
                <form>
               <div class="form-group">
                <span>Status Filter:</span>
                 <select class="custom-select mr-sm-2" id="f_status" name="f_status">
                    <option value="all">All</option>
                    <option value="new">New</option>
                    <option value="in-progress">in-progress</option>
                    <option value="completed">Completed</option>
                    <option value="cancel">Cancel</option>
                    <option value="inactive">InActive</option>
                    <option value="request-payment">Request-payment</option>
                     <option value="received-payment">Received-Paymentt</option>
                    <option value="required-payment-approval">Required-Payment-Approval</option>
                  </select>
              </div>
              </form>
            </div>
          </div>
        </div>
          <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr style="background: #e9ecef">
                <th>Code</th>
                <th>Category</th>
                <th>User</th>
                <th>Vehicle</th>
                <th>Garage</th>
                <th>Quote Amount</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
               <tr style="background: #e9ecef">
                  <th>Code</th>
                  <th>Category</th>
                  <th>User</th>
                  <th>Vehicle</th>
                  <th>Garage</th>
                  <th>Quote Amount</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
            <?php if(!empty($serviceRequests) && count($serviceRequests) > 0): ?>
              <?php $__currentLoopData = $serviceRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($serviceRequest->sr_code); ?></td>
                  <td><?php echo e($serviceRequest->category->name); ?></td>
                  <td><?php echo e($serviceRequest->client->username); ?></td>
                  <td><?php echo e($serviceRequest->vehicle->vmake->name); ?><br/>(<?php echo e($serviceRequest->vehicle->vmodel->name); ?>)</td>
                  <td><?php echo e($serviceRequest->garage->name); ?></td>
                   <td class="text-center">
                      <?php if(!empty($serviceRequest->quote_amount)): ?>
                      <?php echo e('AED '. $serviceRequest->quote_amount); ?>

                      <?php else: ?>
                         <?php echo e(' Not Available '); ?>

                      <?php endif; ?>
                         
                  </td>
                   <td class="text-center text-uppercase">
                     <?php echo e($serviceRequest->status); ?>

                    </td>
                  <td>
                     <a class="btn btn-sm btn-outline-danger "  href="<?php echo e(route('superadmin.service-requests.view',['id' => $serviceRequest->id])); ?>">
                        Update
                      </a>
                  </td>
                 
                </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
              <tr>
                <td colspan="8">
                    No Service Request Found.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

   
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
  
    
    <script src="<?php echo e(asset('website-theme/admin/vendor/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.js')); ?>"></script>

    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery.selectbox-0.2.js')); ?>"></script>  
    <script src="<?php echo e(asset('website-theme/admin/vendor/retina-replace.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery.magnific-popup.min.js')); ?>"></script>
    

   
     <script type="text/javascript">
      /* Custom filtering function which will search data in column four between two values */
      $.fn.dataTable.ext.search.push(
          function( settings, data, dataIndex ) {
              var f_status = $('#f_status').val();
              
              var d_status = data[6];
              console.log(d_status);
              console.log(f_status);
              if(f_status != 'undefined'){
                f_status = f_status.trim();
                if(f_status == 'all') return true;
                if (f_status.toLowerCase() == d_status.toLowerCase()){
                  return true;
                }
              }
              
              return false;
          }
      );
      $(document).ready(function() {
        var table = $('#dataTable').DataTable();
        $('#f_status').on('change', function() {
            table.draw();
        } );
      });
    </script>

     

   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Admin/Resources/views/servicerequest/index.blade.php ENDPATH**/ ?>