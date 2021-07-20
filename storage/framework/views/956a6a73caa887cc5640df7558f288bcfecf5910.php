<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Customer Package Subscription Settings</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
       <li class="breadcrumb-item">
          <a href="<?php echo e(route('client.packages')); ?>">Package Subscription List</a></li>
        </li>
      <li class="active">Customer Package Subscription Settings</li>
    </ol>
  </section>

  <section class="content">

     <div class="row">
          <div class="col-md-12">
            <div class="box box-danger">
               <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                          <br>
                          <div class="row">
                            <div class="col-md-12">
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
                                    <div class="alert alert-warning">
                                        <?php echo e(session('status')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                          </div>
                         <div class="box-body">



        <div class="row">
          <div class="col-md-6 ">

            <div class="box box-solid box-primary">

              <div class="box-header">
                <p class="box-title"><i class="fa fas fa-tags"></i> <?php echo e($clientPackageSubscribe->servicePackage->name); ?></p>
              </div>
               <div class="box-body">

                <div class="jumbotron p-2 bg-success text-white">
                  <div class="row text-center">
                    <div class="col-md-6 ">
                        <h6 class="text-white">Package Status</h6>
                        <h5 class="text-white" >
                           <?php if($clientPackageSubscribe->status == 1): ?>
                          Active
                        <?php elseif($clientPackageSubscribe->status == 2): ?>
                          Cancel
                        <?php elseif($clientPackageSubscribe->status == 3): ?>
                          Pending
                        <?php elseif($clientPackageSubscribe->status == 4): ?>
                          Inactive
                        <?php elseif($clientPackageSubscribe->status == 5): ?>
                          Request-Payemnt
                        <?php elseif($clientPackageSubscribe->status == 6): ?>
                          Received-Payment
                        <?php elseif($clientPackageSubscribe->status == 7): ?>
                          Required-Payment-Approval
                        <?php endif; ?>
                        </h5>
                    </div>
                    <div class="col-md-6 ">
                        <h6 class="text-white">Package Amount</h6>
                        <h5 class="text-white" ><?php echo e('AED '. number_format($clientPackageSubscribe->amount,2)); ?></h5>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                       <label>Garage Name</label>
                      <p><?php echo e($clientPackageSubscribe->garage->name); ?></p>
                    </div>
                  </div>

                   <div class="col-md-6">
                    <div class="form-group">
                       <label>Garage Email</label>
                      <p><?php echo e($clientPackageSubscribe->garage->email); ?></p>
                    </div>
                  </div>

                   <div class="col-md-6">
                    <div class="form-group">
                       <label>Garage Phone</label>
                      <p><?php echo e($clientPackageSubscribe->garage->phone); ?></p>
                    </div>
                  </div>
                
                  <div class="col-md-12">
                    <div class="form-group">
                       <label>Vehicle</label>
                      <p><?php echo e($clientPackageSubscribe->vehicle->vmake->name); ?> ( <?php echo e($clientPackageSubscribe->vehicle->vmodel->name); ?> )
                     
                      </p>
                    </div>
                  </div>
               
                 <div class="col-md-6">
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

                <div class="col-md-6">
                  <div class="form-group">
                     <label>Subscription End At</label>
                      <?php if($clientPackageSubscribe->subscription_end_at): ?>
                        <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($clientPackageSubscribe->subscription_end_at))); ?></p>
                     <?php else: ?>
                        <p class="text-uppercase">Not Available</p>
                      <?php endif; ?>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                     <label>Created At</label>
                    <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($clientPackageSubscribe->created_at))); ?></p>
                    </p>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                     <label>Last Updated At</label>
                    <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($clientPackageSubscribe->updated_at))); ?></p>
                  </div>
                </div>

              </div>
           </div>
          </div>
        </div>
          

          <div class="col-md-6">
            <div class="box box-solid box-primary">
             <div class="box-header">
                <p class="box-title"><i class="fa fas fa-money"></i> Payment Information</p>               
              </div>
              <div class="box-body">
                      <?php if(!empty($clientPackageSubscribePayment)): ?>

                        <div class="jumbotron bg-success p-2 text-white">
                          <div class="row text-center">
                            <div class="col-md-6 ">
                              <h6 class="text-white" >Payment Amount</h6>
                              <h5 class="text-white" >AED <?php echo e(number_format($clientPackageSubscribePayment->amount,2)); ?></h5>
                            </div>
                            <div class="col-md-6 ">
                              <h6 class="text-white" >Payment Status</h6>
                              <h5 class="text-white">
                               <?php if($clientPackageSubscribePayment->status == 1): ?>
                                Success
                              <?php elseif($clientPackageSubscribePayment->status == 2): ?>
                                Failed
                              <?php elseif($clientPackageSubscribePayment->status == 3): ?>
                                Pending
                              <?php elseif($clientPackageSubscribePayment->status == 4): ?>
                                Required-Payment-Approval
                              <?php endif; ?>
                            </h5>
                            </div>
                          </div>
                        </div>

                        <?php if(!empty($clientPackageSubscribePayment->date) && !empty($clientPackageSubscribePayment->payment_type) && $clientPackageSubscribePayment->status != 3): ?>
                            <div class="row text-center">
                              <div class="col-md-6 ">
                                <div class="form-group">
                                  <label>Payment Date</label>
                                  <p> <?php echo e($clientPackageSubscribePayment->date); ?></p>
                                </div>
                              </div>
                              <div class="col-md-6 ">
                               <div class="form-group">
                                  <label>Payment Type</label>
                                  <p> <?php echo e($clientPackageSubscribePayment->payment_type); ?></p>
                                </div>
                              </div>
                            </div>
                        <?php endif; ?>
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
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/subscription/customer_settings.blade.php ENDPATH**/ ?>