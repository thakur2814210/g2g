<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('css'); ?>
   <link rel="stylesheet" href="<?php echo e(asset('assets/website-theme/admin/vendor/datatables/dataTables.bootstrap4.css')); ?>">
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
        <li class="breadcrumb-item active">Vehicle Make List</li>
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
          <h2  class="text-danger"><i class="fa fa-users text-danger"></i> Vehicle Make List</h2>
          <a href="<?php echo e(route('superadmin.settings.vehicle-make.add')); ?>" class="float-right">  
            <button type="button" class="btn btn-danger"><i class="fa fa-fw fa-plus"></i> Vehicle Make</button>
          </a>
        </div>
         <div class="table-responsive">
          <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr style="background: #e9ecef">
                <th>Id</th>
                <th>Name</th>
                <th>Active</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
               <tr style="background: #e9ecef">
                <th>Id</th>
                <th>Name</th>
                <th>Active</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
            <?php if(!empty($lists) && count($lists) > 0): ?>
              <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  	<td><?php echo e($list->id); ?></td>
                   	<td><?php echo e($list->name); ?></td>
                   	<td><?php echo e(($list->active) ? 'Yes' : 'No'); ?></td>
                    <td>
                      <a href="<?php echo e(route('superadmin.settings.vehicle-make.edit',['id' => $list->id])); ?>">
                        <button type="button" class="btn btn-sm btn-warning">
                          <i class="fa fa-fw fa-edit"></i> Edit
                        </button>
                      </a>
                       <a href="<?php echo e(route('superadmin.settings.vehicle-make.delete',['id' => $list->id])); ?>">
                        <button type="button" class="btn btn-sm btn-danger">
                          <i class="fa fa-fw fa-times"></i> Delete
                        </button>
                      </a>
                    </td>
                </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
              <tr>
                <td colspan="5">
                    No Vehicle Make Found.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets/website-theme/admin/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/website-theme/admin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
  
    
    <script src="<?php echo e(asset('assets/website-theme/admin/vendor/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/website-theme/admin/vendor/datatables/dataTables.bootstrap4.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/website-theme/admin/vendor/jquery.selectbox-0.2.js')); ?>"></script>  
    <script src="<?php echo e(asset('assets/website-theme/admin/vendor/retina-replace.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/website-theme/admin/vendor/jquery.magnific-popup.min.js')); ?>"></script>
    

     <script src="<?php echo e(asset('assets/website-theme/admin/js/admin-datatables.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Admin/Resources/views/general-setting/vehicle-make-list.blade.php ENDPATH**/ ?>