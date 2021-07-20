<?php $__env->startSection('title', 'Client Dashboard'); ?>

<?php $__env->startSection('website_css'); ?>
     <link rel="stylesheet" href="<?php echo e(asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
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

    <!-- Breadcrumbs-->
      <ol class="breadcrumb padding_bottom">
        <li class="breadcrumb-item">
          <a href="<?php echo e(route('client.dashboard')); ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Registered Vehicles</li>
      </ol>

      <div class="box_general padding_bottom">
       <div class="card">
        <div class="card-header">
          <i class="fa fa-list"></i> Registered Vehicle
          <div class="card-tools float-right">
            <div class="input-group input-group-sm " style="width: 100px;">
              <div class="input-group-append">
                <a href="<?php echo e(route('client.vehicle.add')); ?>"><button type="button" class="btn btn-block btn-sm"><i class="fa faw fa-plus"></i>Add Vehicle</button></a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body card-body-custom">
          <div class="table-responsive">
           <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                 <tr >
                  <th>Id</th>
                  <th>Plate No</th>
                  <th>Make</th>
                  <th>Model</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr >
                    <th>Id</th>
                    <th>Plate No</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php if(!empty($vehicles) && count($vehicles) > 0): ?>
                  <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($vehicle->id); ?></td>
                      <td><?php echo e($vehicle->plate_no); ?></td>
                      <td><?php echo e($vehicle->vmake->name); ?></td>
                      <td><?php echo e($vehicle->vmodel->name); ?></td>
                      <td>
                        <?php if($vehicle->status == 1): ?>
                          <span class="read">ACTIVE</span>
                        <?php elseif($vehicle->status == 3): ?>
                          <span class="pending">HOLD</span>
                        <?php else: ?>
                          <span class="unread">DELETE</span>
                        <?php endif; ?>
                      </td>
                      <td>
                          
                          <a href="<?php echo e(route('client.vehicle.edit',['id' => $vehicle->id])); ?>" title="Edit Vehicle"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> UPDATE</button></a>
                          <a href="<?php echo e(route('client.vehicle.delete',['id' => $vehicle->id])); ?>" title="Delete Vehicle"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> DELETE</button></a>
                      </td>
                    </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7">
                        No Vehicle Found.
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


<?php echo $__env->make('client::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Client/Resources/views/vehicle/index.blade.php ENDPATH**/ ?>