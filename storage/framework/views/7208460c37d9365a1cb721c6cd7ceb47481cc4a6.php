<?php $__env->startSection('title', 'Garage Dashboard'); ?>

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
   
    
    <!-- Breadcrumbs-->
      <ol class="breadcrumb padding_bottom">
        <li class="breadcrumb-item">
           <a href="<?php echo e(route('client.dashboard')); ?>"><i class="fa fas fa-home"></i> Dashboard</a>
        </li>
         <li class="breadcrumb-item">
          <a href="<?php echo e(route('client.packages')); ?>">Package Subscription List</a></li>
        </li>
        <li class="breadcrumb-item active">Package Subscription Logs </li>
      </ol>

     
       <div class="card">
        <div class="card-header">
         Package Subscription Logs : <?php echo e($clientPackageSubscribe->servicePackage->name); ?>

       </div>
       
          <div class="card-body table-responsive">
            <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr style="background: #e9ecef">
                  <th>Date</th>
                  <th>Description</th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef">
                    <th>Date</th>
                    <th>Description</th>
                </tr>
              </tfoot>
              <tbody>
                <?php if(!empty($logs) && count($logs) > 0): ?>
                  <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e(date('M d, Y', strtotime($log->date))); ?></td>
                      <td><?php echo e($log->description); ?></td>
                    </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="3">
                        No logs Found.
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
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

<?php echo $__env->make('client::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Client/Resources/views/package/logs.blade.php ENDPATH**/ ?>