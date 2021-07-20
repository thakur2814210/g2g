<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('css'); ?>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.dashboard')); ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Set  Commissions </li>
    </ol>
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


  <div class="card">
      <div class="card-header bg-gray">
      Set  Commissions ( % )
      </div>

      <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.general-settings.update')); ?>">
      <?php echo e(csrf_field()); ?>

    
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group ">
              <label for="tag_name" class="col-sm-12 col-form-label">Google Map Key</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" name="google_map_key" value="<?php echo e(isset($setting->google_map_key) ? $setting->google_map_key : null); ?>" />
              </div>
            </div>
          </div>
       </div>
      </div>
       <div class="card-footer text-center">
        <button type="submit" class="btn btn-danger"><i class="fa fa-money" ></i> Update Setting</button>
      </div>
    </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/general-setting/setting.blade.php ENDPATH**/ ?>