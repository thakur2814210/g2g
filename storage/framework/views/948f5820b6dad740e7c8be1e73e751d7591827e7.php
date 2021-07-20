<?php $__env->startSection('title', 'Client Dashboard'); ?>

<?php $__env->startSection('website_css'); ?>
   
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
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>

      <div class="box_general padding_bottom">
       <!-- Icon Cards-->
      <div class="row">

        
        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-success o-hidden">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-users text-dark"></i>
              </div>
              <div class="mr-5">
                <h5>#   <?php echo e($sr_customer_count); ?> </h5>
              </div>
               <h6 class="text-white">Service Request</h6>
            </div>
          </div>
        </div>

        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-primary o-hidden">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-car text-dark"></i>
              </div>
              <div class="mr-5">
                <h5># <?php echo e($ps_customer_count); ?> </h5>
              </div>
               <h6 class="text-white">Package Subscribed</h6>
            </div>
          </div>
        </div>
      </div> <!-- row ends -->
    </h6>
  </div>


          
<?php $__env->stopSection(); ?>



<?php echo $__env->make('client::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Client/Resources/views/dashboard/index.blade.php ENDPATH**/ ?>