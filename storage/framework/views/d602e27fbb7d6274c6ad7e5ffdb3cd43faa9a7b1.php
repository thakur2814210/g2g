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
   
   

    <!-- Breadcrumbs-->
      <ol class="breadcrumb padding_bottom">
        <li class="breadcrumb-item">
           <a href="<?php echo e(route('client.dashboard')); ?>"><i class="fa fas fa-home"></i> Dashboard</a>
        </li>
         <li class="breadcrumb-item">
          <a href="<?php echo e(route('client.packages')); ?>">Package Subscription List</a></li>
        </li>
        <li class="breadcrumb-item active">Package Subscription Settings </li>
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

        <div class="row">
          <div class="col-6 ">

            <div class="card">

              <div class="card-header card-header-custom">
                <p class="card-title"><i class="fa fas fa-tags"></i> <?php echo e($clientPackageSubscribe->servicePackage->name); ?></p>
              </div>
               <div class="card-body">

                <div class="jumbotron p-2 bg-success text-white">
                  <div class="row text-center">
                    <div class="col-6 ">
                        <h6 class="text-white">Package Status</h6>
                        <h5 class="text-white" ><?php echo e($packageStatus); ?></h5>
                    </div>
                    <div class="col-6 ">
                        <h6 class="text-white">Package Amount</h6>
                        <h5 class="text-white" ><?php echo e('AED '. number_format($clientPackageSubscribe->amount,2)); ?></h5>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                       <label>Garage</label>
                      <p><?php echo e($clientPackageSubscribe->garage->name); ?></p>
                    </div>
                  </div>
                
                  <div class="col-12">
                    <div class="form-group">
                       <label>Vehicle</label>
                      <p><?php echo e($clientPackageSubscribe->vehicle->vmake->name); ?>

                      <a href="<?php echo e(route('client.vehicle.view',['id' => $clientPackageSubscribe->vehicle->id ])); ?>" class="floar-right"><i class="fa fa-car"></i> View</a>
                      </p>
                    </div>
                  </div>
               
                 <div class="col-6">
                  <div class="form-group">
                     <label>Subscription Start At</label>
                      <?php if($clientPackageSubscribe->subscription_start_at): ?>
                        <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($clientPackageSubscribe->subscription_start_at))); ?></p>
                      <?php else: ?>
                         <p class="text-uppercase">Not Available</p>
                      <?php endif; ?>
                    </p>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                     <label>Subscription End At</label>
                      <?php if($clientPackageSubscribe->subscription_end_at): ?>
                        <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($clientPackageSubscribe->subscription_end_at))); ?></p>
                     <?php else: ?>
                        <p class="text-uppercase">Not Available</p>
                      <?php endif; ?>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                     <label>Created At</label>
                    <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($clientPackageSubscribe->created_at))); ?></p>
                    </p>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                     <label>Last Updated At</label>
                    <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($clientPackageSubscribe->updated_at))); ?></p>
                  </div>
                </div>

              </div>
           </div>
          </div>
        </div>
          

          <div class="col-6">
            <div class="card">
             <div class="card-header card-header-custom">
                <p class="card-title"><i class="fa fas fa-money"></i> Payment Information</p>               
              </div>
              <div class="card-body table-responsive">
                      <?php if(!empty($clientPackageSubscribePayment)): ?>

                        <div class="jumbotron bg-success p-2 text-white">
                          <div class="row text-center">
                            <div class="col-6 ">
                              <h6 class="text-white" >Payment Amount</h6>
                              <h5 class="text-white" >AED <?php echo e(number_format($clientPackageSubscribePayment->amount,2)); ?></h5>
                            </div>
                            <div class="col-6 ">
                              <h6 class="text-white" >Payment Status</h6>
                              <h5 class="text-white" ><?php echo e($paymentStatus); ?></h5>
                            </div>
                          </div>
                        </div>

                        <?php if(!empty($clientPackageSubscribePayment->date) && !empty($clientPackageSubscribePayment->payment_type) && $clientPackageSubscribePayment->status != 3): ?>
                            <div class="row text-center">
                              <div class="col-6 ">
                                <div class="form-group">
                                  <label>Payment Date</label>
                                  <p> <?php echo e($clientPackageSubscribePayment->date); ?></p>
                                </div>
                              </div>
                              <div class="col-6 ">
                               <div class="form-group">
                                  <label>Payment Type</label>
                                  <p> <?php echo e($clientPackageSubscribePayment->payment_type); ?></p>
                                </div>
                              </div>
                            </div>
                        <?php endif; ?>

                        <?php if($clientPackageSubscribePayment->status == 3): ?>
                         <label class="text-danger"><b>Information:</b><br/> Custom Package service request already created and waiting for the Garage quote amount.</label>

                        <?php elseif($clientPackageSubscribe->status == 6): ?>
                          <div class="row text-center p-3">
                            <div class="col-12 alert alert-warning">
                              <p class="text-uppercase text-danger m-0">
                                Note: Information
                              </p>
                              <label class="text-danger">Payment has already done in COD mode </label>
                              <label class="text-danger">
                               Garage will contact you soon and activate the package.
                              </label><br/>
                              <small class="text-uppercase">Contact supports for further assistance.</small>
                            </div>
                          </div>
                        <?php elseif($clientPackageSubscribe->status == 7): ?>
                          <div class="row text-center p-3">
                            <div class="col-12 alert alert-warning">
                              <p class="text-uppercase text-danger m-0">
                                Note: Cash on Delievery need to verify from the Garage.
                              </p>
                              <small class="text-danger">
                                Wait for the Garage approval Or conatct supports for further assistance.
                              </small>
                            </div>
                          </div>
                        <?php endif; ?>
                    <?php else: ?>
                       <label class="text-danger"><b>Information:</b><br/> Custom Package service request already created and waiting for the Garage quote amount.</label>
                    <?php endif; ?>
                </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
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
<?php echo $__env->make('client::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Client/Resources/views/package/setting.blade.php ENDPATH**/ ?>