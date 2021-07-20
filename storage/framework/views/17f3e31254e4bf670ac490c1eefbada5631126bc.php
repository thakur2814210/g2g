<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('css'); ?>
   <style type="text/css">
     .h-80{
      min-height: 80px !important;
     }
   </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
   <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.dashboard')); ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  	 <div class="row">
        <div class="col-xl-4 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-primary o-hidden h-80">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-building"></i>
              </div>
              <div class="mr-5">
                <h5># <?php echo e($counts['garage']); ?> </h5>
                <label class="text-white text-sm">Total Garages</label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-success o-hidden h-80">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-users"></i>
              </div>
				      <div class="mr-5">
                <h5># <?php echo e($counts['client']); ?> </h5>
                <label class="text-white text-sm">Total Customers</label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-money"></i>
              </div>
              <div class="mr-5">
                <h5># <?php echo e($counts['servicePackage']); ?> </h5>
                <label class="text-white text-sm">Total Package</label>
              </div>
            </div>
          </div>
        </div>
		</div>

    
     <div class="row">
        <div class="col-xl-4 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-primary o-hidden h-80">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-file"></i>
              </div>
              <div class="mr-5">
                <h5># <?php echo e($counts['serviceRequest']); ?> </h5>
                <label class="text-white text-sm">Service Request Quotes</label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-success o-hidden h-80">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-tags"></i>
              </div>
              <div class="mr-5">
                <h5># <?php echo e($counts['clientPackageSubscribe']); ?> </h5>
                <label class="text-white text-sm">Customer Package Subscription</label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-3">
          <div class="card dashboard  bg-danger o-hidden h-80">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-tags"></i>
              </div>
               <div class="mr-5">
                <h5># <?php echo e($counts['garagePackageSubscribe']); ?> </h5>
                <label class="text-white text-sm">Garage Package Subscription</label>
              </div>
            </div>
          </div>
        </div>
    </div>
	
	
          
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devhs/public_html/g2g-v3/Modules/Admin/Resources/views/dashboard/index.blade.php ENDPATH**/ ?>