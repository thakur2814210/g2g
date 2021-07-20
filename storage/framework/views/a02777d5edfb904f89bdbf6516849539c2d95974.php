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
        <li class="breadcrumb-item active">Language</li>
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
          <h2  class="text-danger"><i class="fa fa-users text-danger"></i> Language</h2>
        </div>
         <div class="table-responsive">
          <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr style="background: #e9ecef">
                <th>Code</th>
                <th>Name</th>
                <th>Text Direction</th>
                <th>Folder Name</th>
                <th>Order</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
               <tr style="background: #e9ecef">
                <th>Code</th>
                <th>Name</th>
                <th>Text Direction</th>
                <th>Folder Name</th>
                <th>Order</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
            <?php if(!empty($languages) && count($languages) > 0): ?>
              <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($language->language_code); ?></td>
                  	<td><?php echo e($language->name); ?></td>
                    <td><?php echo e($language->text_direction); ?></td>
                    <td><?php echo e($language->folder_name); ?></td>
                     <td><?php echo e($language->language_order); ?></td>
                   	<td><?php echo e(($language->status) ? 'Yes' : 'No'); ?></td>
                    <td>
                      <a href="#">
                        <button type="button" class="btn btn-sm btn-warning">
                          <i class="fa fa-fw fa-edit"></i>
                        </button>
                      </a>
                    </td>
                </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
              <tr>
                <td colspan="7">
                    No Language Found.
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
    

     <script src="<?php echo e(asset('website-theme/admin/js/admin-datatables.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Admin/Resources/views/general-setting/language.blade.php ENDPATH**/ ?>