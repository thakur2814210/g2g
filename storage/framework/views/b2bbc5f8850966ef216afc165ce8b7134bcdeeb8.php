<?php $__env->startSection('content'); ?>
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
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

          <div class="box_general padding_bottom">
           
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
                        <h6 class="text-white"><?php echo app('translator')->get('website.Package'); ?> <?php echo app('translator')->get('website.Status'); ?></h6>
                        <h5 class="text-white" ><?php echo e(trans('website.'.$packageStatus)); ?></h5>
                    </div>
                    <div class="col-6 ">
                        <h6 class="text-white"><?php echo app('translator')->get('website.Package'); ?> <?php echo app('translator')->get('website.Amount'); ?></h6>
                        <h5 class="text-white" ><?php echo e('AED '. number_format($clientPackageSubscribe->amount,2)); ?></h5>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                       <p class="font-weight-bold"><?php echo app('translator')->get('website.Garage'); ?></p>
                      <p><?php echo e(isset($clientPackageSubscribe->garage->defaultGarageDescription[0]->garages_name) ? $clientPackageSubscribe->garage->defaultGarageDescription[0]->garages_name : trans('website.Not Available')); ?></p>
                    </div>
                  </div>
                
                  <div class="col-12">
                    <div class="form-group">
                       <p class="font-weight-bold"><?php echo app('translator')->get('website.Vehicle'); ?></p>
                       <?php if(isset($clientPackageSubscribe->vehicle->vmake->name )): ?>
                        <p><?php echo e($clientPackageSubscribe->vehicle->vmake->name); ?>

                        <a href="<?php echo e(route('client.vehicle.view',['id' => $clientPackageSubscribe->vehicle->id ])); ?>" class="floar-right"><i class="fa fa-car"></i> <?php echo app('translator')->get('website.VIEW'); ?></a>
                        </p>
                      <?php else: ?>
                        <?php echo e(trans('website.Not Available')); ?>

                      <?php endif; ?>

                    </div>
                  </div>
               
                 <div class="col-6">
                  <div class="form-group">
                     <p class="font-weight-bold"><?php echo app('translator')->get('website.Subscription'); ?> <?php echo app('translator')->get('website.Start At'); ?></p>
                      <?php if($clientPackageSubscribe->subscription_start_at): ?>
                        <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($clientPackageSubscribe->subscription_start_at))); ?></p>
                      <?php else: ?>
                         <p class="text-uppercase"><?php echo app('translator')->get('website.Not Available'); ?></p>
                      <?php endif; ?>
                    </p>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                     <p class="font-weight-bold"><?php echo app('translator')->get('website.Subscription'); ?> <?php echo app('translator')->get('website.End At'); ?></p>
                      <?php if($clientPackageSubscribe->subscription_end_at): ?>
                        <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($clientPackageSubscribe->subscription_end_at))); ?></p>
                     <?php else: ?>
                        <p class="text-uppercase"><?php echo app('translator')->get('website.Not Available'); ?></p>
                      <?php endif; ?>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                     <p class="font-weight-bold"><?php echo app('translator')->get('website.Created At'); ?></p>
                    <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($clientPackageSubscribe->created_at))); ?></p>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                     <p class="font-weight-bold"><?php echo app('translator')->get('website.Last Updated At'); ?></p>
                    <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($clientPackageSubscribe->updated_at))); ?></p>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                     <p class="font-weight-bold"><?php echo app('translator')->get('website.Pick and drop your car from your location?'); ?></p>
                      <p>
                          <?php if($clientPackageSubscribe->vip_pickup_opted === 1): ?>
                              <?php echo app('translator')->get('website.Yes'); ?>, AED <?php echo e($clientPackageSubscribe->vip_pickup_price); ?> <?php echo app('translator')->get('website.payable in cash'); ?>
                          <?php else: ?>
                              <?php echo app('translator')->get('website.No'); ?>
                          <?php endif; ?>
                      </p>
                  </div>
                </div>


              </div>
           </div>
          </div>
        </div>
          

          <div class="col-6">
            <div class="card">
             <div class="card-header card-header-custom">
                <p class="card-title"><i class="fa fas fa-money"></i> <?php echo app('translator')->get('website.Payment'); ?> <?php echo app('translator')->get('website.Information'); ?></p>               
              </div>
              <div class="card-body table-responsive">
                      <?php if(!empty($clientPackageSubscribePayment)): ?>

                        <div class="jumbotron bg-success p-2 text-white">
                          <div class="row text-center">
                            <div class="col-6 ">
                              <h6 class="text-white" ><?php echo app('translator')->get('website.Payment'); ?> <?php echo app('translator')->get('website.Amount'); ?></h6>
                              <h5 class="text-white" >AED <?php echo e(number_format($clientPackageSubscribePayment->amount,2)); ?></h5>
                            </div>
                            <div class="col-6 ">
                              <h6 class="text-white" ><?php echo app('translator')->get('website.Payment'); ?> <?php echo app('translator')->get('website.Status'); ?></h6>
                              <h5 class="text-white" ><?php echo e(trans('website.'.$paymentStatus)); ?></h5>
                            </div>
                          </div>
                        </div>

                        <?php if(!empty($clientPackageSubscribePayment->date) && !empty($clientPackageSubscribePayment->payment_type) && $clientPackageSubscribePayment->status != 3): ?>
                            <div class="row text-center">
                              <div class="col-6 ">
                                <div class="form-group">
                                  <p><?php echo app('translator')->get('website.Payment'); ?> <?php echo app('translator')->get('website.Date'); ?></p>
                                  <p> <?php echo e($clientPackageSubscribePayment->date); ?></p>
                                </div>
                              </div>
                              <div class="col-6 ">
                               <div class="form-group">
                                  <p><?php echo app('translator')->get('website.Payment'); ?> <?php echo app('translator')->get('website.Type'); ?></p>
                                  <p> <?php echo e($clientPackageSubscribePayment->payment_type); ?></p>
                                </div>
                              </div>
                            </div>
                        <?php endif; ?>

                        <?php if($clientPackageSubscribePayment->status == 3): ?>
                         <p class="text-danger"><b><?php echo app('translator')->get('website.Information'); ?>:</b><br/> <?php echo app('translator')->get('website.Custom Package service request already created and waiting for the Garage quote amount'); ?></p>

                        <?php elseif($clientPackageSubscribe->status == 6): ?>
                          <div class="row text-center p-3">
                            <div class="col-12 alert alert-warning">
                              <p class="text-uppercase text-danger m-0">
                                <?php echo app('translator')->get('website.Note'); ?>: <?php echo app('translator')->get('website.Information'); ?>
                              </p>
                              <p class="text-danger"><?php echo app('translator')->get('website.Payment has already done in COD mode'); ?> </p>
                              <p class="text-danger">
                                  <?php echo app('translator')->get('website.Garage will contact you soon and activate the package'); ?>
                              </p><br/>
                              <small class="text-uppercase"> <?php echo app('translator')->get('website.Contact supports for further assistance'); ?></small>
                            </div>
                          </div>
                        <?php elseif($clientPackageSubscribe->status == 7): ?>
                          <div class="row text-center p-3">
                            <div class="col-12 alert alert-warning">
                              <p class="text-uppercase text-danger m-0">
                                <?php echo app('translator')->get('website.Note'); ?>: <?php echo app('translator')->get('website.Cash on Delievery need to verify from the Garage'); ?>
                              </p>
                              <small class="text-danger">
                                  <?php echo app('translator')->get('website.Wait for the Garage approval Or conatct supports for further assistance'); ?>
                              </small>
                            </div>
                          </div>
                        <?php endif; ?>
                    <?php else: ?>
                       <p class="text-danger"><b><?php echo app('translator')->get('website.Information'); ?>:</b><br/> <?php echo app('translator')->get('website.Custom Package service request already created and waiting for the Garage quote amount'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
          </div>
          </div>
        </div>
          </div>
        </div>
      </div>
    </div>
  </section>

        

<?php $__env->stopSection(); ?>




<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/autoshop/package/setting.blade.php ENDPATH**/ ?>