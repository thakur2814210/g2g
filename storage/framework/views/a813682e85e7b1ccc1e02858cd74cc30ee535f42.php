<?php $__env->startSection('title', 'Client Dashboard'); ?>

<?php $__env->startSection('website_css'); ?>
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

<?php $__env->startSection('content'); ?>
   
    

   <ol class="breadcrumb padding_bottom">
      <li class="breadcrumb-item">
        <a href="<?php echo e(route('client.dashboard')); ?>">Dashboard</a>
      </li>
      <li class="breadcrumb-item active"> Service Request List</li>
    </ol>

    <div class="row">
      <div class="col-12">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
         <?php if(session('status')): ?>
              <div class="alert alert-success">
                  <?php echo e(session('status')); ?>

              </div>
          <?php endif; ?>
      </div>
    </div>


    <div class="box_general padding_bottom">
       <div class="card">
        <div class="card-header">
          <i class="fa fa-list"></i> Service Request List</div>
        <div class="card-body">
          <div class="table-responsive">
           <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                 <tr class="bg-danger text-white">
                  <th>#</th>
                  <th>Code/Date</th>
                  <th>Category</th>
                  <th>Vehicle</th>
                  <th>Quote Amount(AED)</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr class="bg-danger text-white">
                  <th>#</th>
                  <th>Code/Date</th>
                  <th>Category</th>
                  <th>Vehicle</th>
                  <th>Quote Amount(AED)</th>
                  <th>Status</th>
                  <th width="20%">Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php if(!empty($serviceRequests) && count($serviceRequests) > 0): ?>
                  <?php $__currentLoopData = $serviceRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $serviceRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="text-center"><?php echo e($index + 1); ?></td>
                      <td>
                          <label><?php echo e($serviceRequest->sr_code); ?></label><br/>
                          <small>( <?php echo e(date('M d,Y', strtotime($serviceRequest->created_at))); ?> )</small>
                      </td>

                      <td><?php echo e($serviceRequest->category->name); ?></td>

                      <td><a href="<?php echo e(route('client.vehicle.view',['id' => $serviceRequest->vehicle->id ])); ?>"><?php echo e($serviceRequest->vehicle->plate_no); ?></a></td>
                       
                       <td class="text-center">
                           <?php echo e((!empty($serviceRequest->quote_amount) ? 'AED '. $serviceRequest->quote_amount : 'Not Available' )); ?>

                        </td>
                       
                         <td class="text-center text-uppercase">
                          <?php if( $serviceRequest->status == 'cancel'): ?>
                            <label class="unread text-large"><?php echo e($serviceRequest->status); ?></label>
                          <?php elseif( $serviceRequest->status == 'new' || $serviceRequest->status == 'request-payment'): ?>
                           <label class="pending"><?php echo e($serviceRequest->status); ?></label>
                          <?php else: ?>
                             <label class="read"><?php echo e($serviceRequest->status); ?></label>
                          <?php endif; ?>

                        </td>
                       
                       <td>
                          <a class="btn btn-sm btn-outline-danger "  href="<?php echo e(route('client.service-request.settings',['id' => $serviceRequest->id])); ?>">
                            Update
                          </a>
                          &nbsp;
                          <a  class="btn btn-sm btn-outline-danger" href="<?php echo e(route('client.service-request.logs',['id' => $serviceRequest->id])); ?>">
                            Log
                          </a>
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7">
                        No Service Request Found.
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
   </div>
          
<?php $__env->stopSection(); ?>


<?php $__env->startSection('website_js'); ?>

    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
  
    
    <script src="<?php echo e(asset('website-theme/admin/vendor/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.js')); ?>"></script>

    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery.selectbox-0.2.js')); ?>"></script>  
    <script src="<?php echo e(asset('website-theme/admin/vendor/retina-replace.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery.magnific-popup.min.js')); ?>"></script>
    

     <script src="<?php echo e(asset('website-theme/admin/js/admin-datatables.js')); ?>"></script>

   
   
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Client/Resources/views/service-request/index.blade.php ENDPATH**/ ?>