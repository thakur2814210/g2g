<?php $__env->startSection('content'); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Customers Packages Update</h1>
      <ol class="breadcrumb">
       <li class="breadcrumb-item">
          <a href="<?php echo e(route('garage.dashboard')); ?>"><i class="fa fas fa-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo e(route('garage.customers.packages-subscribed')); ?>">Customers Packages Subscribed List</a></li>
        </li>
        <li class="breadcrumb-item"><i class="fa fas fa-lock"></i> Customers Packages Update</li>
      </ol>
    </section>
   
   
    <section class="content-header">
   

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
          <div class="col-md-6">

             <div class="box box-solid box-info">

              <div class="box-header">
                <p class="box-title"><i class="fa fas fa-tags"></i>
                    <?php echo e($ps->servicePackage->name); ?>

                  </p>
              </div>

              <div class="box-body">

                    <div class="jumbotron p-2 bg-success text-white">
                      <div class="row text-center">
                        <div class="col-md-6 ">
                            <h6 class="text-white">Package Status</h6>
                            <h5 class="text-white" ><?php echo e($packageStatus); ?></h5>
                        </div>
                        <div class="col-md-6 ">
                            <h6 class="text-white">Package Amount</h6>
                            <h5 class="text-white" ><?php echo e('AED '. number_format($ps->amount,2)); ?></h5>
                        </div>
                      </div>
                    </div>
 
                    <div class="row">
                      <div class="col-md-4">
                         <div class="form-group">
                          <label>Customer Name</label>
                          <p><?php echo e($ps->client->first_name); ?> <?php echo e($ps->client->last_name); ?></p>
                        </div>
                      </div>
                      <?php if( $ps->status == 1 ): ?> 
                        <div class="col-md-4">
                            <div class="form-group">
                              <label>Customer Email</label>
                              <p><?php echo e($ps->client->email); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <label>Customer Phone</label>
                              <p><?php echo e($ps->client->phone); ?></p>
                            </div>
                        </div>
                      <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                         <label>Subscription Start At</label>
                          <?php if($ps->subscription_start_at): ?>
                            <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($ps->subscription_start_at))); ?></p>
                          <?php else: ?>
                             <p class="text-uppercase">Not Available</p>
                          <?php endif; ?>
                        </p>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                         <label>Subscription End At</label>
                          <?php if($ps->subscription_end_at): ?>
                            <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($ps->subscription_end_at))); ?></p>
                         <?php else: ?>
                            <p class="text-uppercase">Not Available</p>
                          <?php endif; ?>
                      </div>
                    </div>
                  
                    
                    <div class="col-md-6">
                      <div class="form-group">
                         <label>Created At</label>
                        <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($ps->created_at))); ?></p>
                        </p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         <label>Last Updated At</label>
                        <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($ps->updated_at))); ?></p>
                      </div>
                    </div>
                  </div>
              </div>
              </div>

            <div class="box box-solid box-info">

              <div class="box-header">
                <p class="box-title"><i class="fa fas fa-tags"></i>Vehicle Information</p>               
              </div>

                <div class="box-body">

                  <?php if( $ps->status == 3 || $ps->status == 5  ): ?> 
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Make</label>
                          <p><?php echo e($ps->vehicle->vmake->name); ?></p>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Model</label>
                          <p><?php echo e($ps->vehicle->vmodel->name); ?></p>
                        </div>
                      </div>
                    </div>
                     <div class="alert alert-warning text-center">
                        <label class="text-danger">Complete Vehicle information will be available only if Package is active.</label>
                      </div>

                   

                  <?php else: ?>

                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Make</label>
                          <p><?php echo e($ps->vehicle->vmake->name); ?></p>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Model</label>
                          <p><?php echo e($ps->vehicle->vmodel->name); ?></p>
                        </div>
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                         <label>Plate No.</label>
                          <p><?php echo e($ps->vehicle->plate_no); ?></p>
                        </div>
                      </div>
                    
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Registration No</label>
                          <p><?php echo e($ps->vehicle->registration_no); ?></p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Chassis No</label>
                          <p><?php echo e($ps->vehicle->chassis_no); ?></p>
                        </div>
                      </div>
                    </div>

                     
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Color</label>
                          <p><?php echo e($ps->vehicle->color); ?></p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Year</label>
                          <p><?php echo e($ps->vehicle->year); ?></p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Current Mileage</label>
                          <p><?php echo e($ps->vehicle->current_mileage); ?></p>
                        </div>
                      </div>
                    </div>

                     <?php endif; ?>

                  </div>
                </div>
              </div>
          

           <div class="col-md-6">

               <div class="box box-solid box-info">
                <div class="box-header">
                  <p class="box-title"><i class="fa fas fa-money"></i> Payment Information</p>
                </div>

               <?php if(!empty($ps_payment) ): ?>

                <div class="box-body table-responsive">

                  <div class="jumbotron <?php if($ps_payment->status == 1): ?> bg-success <?php else: ?> bg-warning <?php endif; ?> p-2 text-white">
                    <div class="row text-center">
                      <div class="col-md-6 ">
                        <h6 class="text-white" >Payment Amount</h6>
                        <h5 class="text-white" >AED <?php echo e(number_format($ps_payment->amount,2)); ?></h5>
                      </div>
                      <div class="col-md-6 ">
                        <h6 class="text-white" >Payment Status</h6>
                        <h5 class="text-white" ><?php echo e($paymentStatus); ?></h5>
                      </div>
                    </div>
                     <div class="clearfix"></div>
                      <div class="row text-center">
                          <div class="col-md-6 ">
                            <div class="form-group">
                              <h6 class="text-white" >Payment Date</h6>
                              <h5 class="text-white" ><?php echo e($ps_payment->date); ?></h5>
                            </div>
                          </div>
                          <div class="col-md-6 ">
                           <div class="form-group">
                              <h6 class="text-white" >Payment Type</h6>
                              <h5 class="text-white" > <?php echo e($ps_payment->payment_type); ?></h5>
                            </div>
                          </div>
                        </div> 
                  </div>
                  
                  <?php if($ps_payment->status == 3): ?> 
                    <div class="clearfix"><hr/></div>
                    <div style="padding: 20px;">
                     <form class="form-horizontal" method="POST" action="<?php echo e(route('garage.customers.packages-subscription.update-payment-status')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="id" value="<?php echo e($ps->id); ?>">
                        <input type="hidden" name="service_package_id" value="<?php echo e($ps->servicePackage->id); ?>">

                          <div class="form-group">
                            <label class="text-danger">Information: Customer has attempt to paid payment in COD mode.</label>
                          </div>

                          <div class="form-group">
                            <label> Please upadte the payment status</label>
                            <br/>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" value="1"> Mark as Success
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" value="2"> Mark as Failed
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <button type="submit"  class="btn btn-success "> <i class="fa faw fa-lock"></i> Confirm Payment</button>
                          </div>
                      </form>
                    </div>
                  <?php endif; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  </div>
          
<?php $__env->stopSection(); ?>
<?php echo $__env->make('garage::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Garage/Resources/views/customer/ps/setting.blade.php ENDPATH**/ ?>