<?php $__env->startSection('content'); ?>
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
    <br/>
     <div class="row">
       <div class="col-12 col-lg-3">
           <div class="heading">
               <h2>
                   <?php echo app('translator')->get('website.My Account'); ?>
               </h2>
               <hr >
             </div>

           <?php echo $__env->make('autoshop.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       </div>
       <div class="col-12 col-lg-9 ">
           <div class="heading">
               <h2><?php echo app('translator')->get('website.dashboard'); ?></h2>
               <hr >
            </div>

            <div class="row">

        
              <div class="col-xl-6 col-sm-6 mb-3">
                <div class="card dashboard text-white bg-success o-hidden">
                  <div class="card-body">
                      <h3>#   <?php echo e($sr_customer->count()); ?> </h3>
                      <h5 class="text-white"><?php echo app('translator')->get('website.Service Request'); ?></h5>
                  </div>
                   <div class="card-footer text-center" >
                     <a href="<?php echo e(URL::to('service-request/list')); ?>" class="text-white" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.View All'); ?> <?php echo app('translator')->get('website.Service Request'); ?>"><?php echo app('translator')->get('website.View All'); ?> <?php echo app('translator')->get('website.Service Request'); ?> <i class="fa fa-arrow-circle-right"></i></a>
                   </div>
                </div>
              </div>

              <div class="col-xl-6 col-sm-6 mb-3">
                <div class="card dashboard text-white bg-primary o-hidden">
                  <div class="card-body">
                      <h3># <?php echo e($ps_customer->count()); ?> </h3>
                     <h5 class="text-white"><?php echo app('translator')->get('website.Package Subscription'); ?></h5>
                  </div>
                   <div class="card-footer text-center" >
                     <a href="<?php echo e(URL::to('package-subscription/packages')); ?>" class="text-white"  data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.View All'); ?> <?php echo app('translator')->get('website.Package Subscription'); ?>"><?php echo app('translator')->get('website.View All'); ?> <?php echo app('translator')->get('website.Package Subscription'); ?> <i class="fa fa-arrow-circle-right"></i></a>
                   </div>
                </div>
              </div>
            </div> <!-- row ends -->
         <!-- ............the end..... -->
       </div>


     </div>
   </div>
 </section>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/autoshop/dashboard.blade.php ENDPATH**/ ?>