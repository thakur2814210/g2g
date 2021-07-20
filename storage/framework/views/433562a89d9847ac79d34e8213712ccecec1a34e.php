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
         <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.delete')); ?>">Delete Garage List</a>
        </li>
         <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.pending')); ?>">Pending Garage List</a>
        </li>
        <li class="breadcrumb-item active">Active Garage List</li>
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
                  <h2  class="text-danger"><i class="fa fa-users text-danger"></i> Active Garage List</h2>
                   <a href="<?php echo e(route('superadmin.garage.add')); ?>" class="float-right ">  
                    <button type="button" class="btn btn-outline-danger">
                      <i class="fa fa-fw fa-plus"></i> Add Garage
                    </button>
                  </a>
                </div>
                 <div class="table-responsive">
                 <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                       <tr>
                        <th>Id</th>
                        <th>Garage Name</th>
                        <th>Garage Address</th>
                        <th>Username</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                       <tr>
                          <th>Id</th>
                          <th>Garage Name</th>
                          <th>Garage Address</th>
                          <th>Username</th>
                          <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                     <?php if(!empty($garages) && count($garages) > 0): ?>
                      <?php $__currentLoopData = $garages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($garage->id); ?></td>
                          <td><?php echo e($garage->garages_name); ?></td>
                          <td><?php echo e($garage->address); ?></td>
                          <td><?php echo e($garage->username); ?></td>
                          <td>
                             
                              <div class="btn-group">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-outline-danger btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">Update</button>
                                  <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-116px, -84px, 0px);">
                                    <a class="dropdown-item" href="<?php echo e(route('superadmin.garage.edit',['id' => $garage->id])); ?>">Garage Details</a>
                                    <a class="dropdown-item" href="<?php echo e(route('superadmin.garage.team.view',['id' => $garage->id])); ?>">Garage Teams</a>
                                    <a class="dropdown-item" href="<?php echo e(route('superadmin.garage.image.view',['id' => $garage->id])); ?>">Garage Images</a>
                                    <a class="dropdown-item" href="<?php echo e(route('superadmin.garage.video.view',['id' => $garage->id])); ?>">Garage Videos</a>
                                  </div>
                                </div>
                              </div>
                          </td>
                        </tr>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="6">
                            No Active Garage Found.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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


<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devhs/public_html/g2g-v3/Modules/Admin/Resources/views/garage/garage-active-list.blade.php ENDPATH**/ ?>