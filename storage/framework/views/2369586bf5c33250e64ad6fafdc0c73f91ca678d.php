<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Garage Packages Subscritpion Update</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
       <li class="breadcrumb-item">
          <a href="<?php echo e(route('superadmin.subscriptions.garages.list')); ?>">Garage Packages Subscritpion List</a></li>
        </li>
      <li class="active">Garage Packages Subscritpion Update</li>
    </ol>
  </section>

   <section class="content">

     <div class="row">
          <div class="col-12">
            <div class="box">
               <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                          <br>
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
                                    <div class="alert alert-warning">
                                        <?php echo e(session('status')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                          </div>
                         <div class="box-body">

        <div class="row">
          <div class="col-md-6">

            <div class="box box-solid box-primary">

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
                            <h5 class="text-white" >
                              <?php if($ps->status == 1): ?>
                                Active
                              <?php elseif($ps->status == 2): ?>
                                Cancel
                              <?php elseif($ps->status == 3): ?>
                                Pending
                              <?php elseif($ps->status == 4): ?>
                                Inactive
                              <?php elseif($ps->status == 5): ?>
                                Request-Payemnt
                              <?php elseif($ps->status == 6): ?>
                                Received-Payment
                              <?php elseif($ps->status == 7): ?>
                                Required-Payment-Approval
                              <?php endif; ?>
                            </h5>
                        </div>
                        <div class="col-md-6 ">
                            <h6 class="text-white">Package Amount</h6>
                            <h5 class="text-white" ><?php echo e('AED '. number_format($ps->amount,2)); ?></h5>
                        </div>
                      </div>
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

                  
                  <div class="col-md-12">
                    <div class="form-group">
                       <label>Garage Name</label>
                      <p><?php echo e($ps->garage->name); ?></p>
                    </div>
                  </div>

                   <div class="col-md-6">
                    <div class="form-group">
                       <label>Garage Email</label>
                      <p><?php echo e($ps->garage->email); ?></p>
                    </div>
                  </div>

                   <div class="col-md-6">
                    <div class="form-group">
                       <label>Garage Phone</label>
                      <p><?php echo e($ps->garage->phone); ?></p>
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

               <?php if(!empty($ps_payment) ): ?>

                <div class="box-body">

                  <div class="jumbotron bg-success p-2 text-white">
                    <div class="row text-center">
                      <div class="col-md-6 ">
                        <h6 class="text-white" >Payment Amount</h6>
                        <h5 class="text-white" >AED <?php echo e(number_format($ps_payment->amount,2)); ?></h5>
                      </div>
                      <div class="col-md-6 ">
                        <h6 class="text-white" >Payment Status</h6>
                        <h5 class="text-white">
                           <?php if($ps_payment->status == 1): ?>
                            Success
                          <?php elseif($ps_payment->status == 2): ?>
                            Failed
                          <?php elseif($ps_payment->status == 3): ?>
                            Pending
                          <?php elseif($ps_payment->status == 4): ?>
                            Required-Payment-Approval
                          <?php endif; ?>
                        </h5>
                      </div>
                    </div>
                  </div>

                  <?php if(!empty($ps_payment->date) && !empty($ps_payment->payment_type) && $ps->status != 3): ?>
                  <div class="clearfix"></div>
                  <div class="row text-center">
                      <div class="col-md-6 ">
                        <div class="form-group">
                          <label>Payment Date</label>
                          <p> <?php echo e($ps_payment->date); ?></p>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                       <div class="form-group">
                          <label>Payment Type</label>
                          <p> <?php echo e($ps_payment->payment_type); ?></p>
                        </div>
                      </div>
                    </div> 
                  <?php endif; ?>

                  <?php if($ps_payment->status == 4): ?> 
                      <div class="clearfix"></div>
                      <div class="row p-3">
                        <div class="col-md-12">
                         <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.subscriptions.garages.update-status')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id" value="<?php echo e($ps->id); ?>">
                              <div class="alert alert-success">
                                <label class="text-center">Customer has attempt to paid payment in COD mode, please upadte the payment status</label>
                              </div>
                              <button type="submit"  class="btn btn-sm btn-outline-danger " name="status" value="1"> <i class="fa faw fa-lock"></i> Mark as Success</button>
                              <button type="submit"  class="btn btn-sm btn-outline-danger " name="status" value="2"><i class="fa faw fa-lock"></i> Mark as Failed</button>
                          </form>
                        </div>
                      </div>
                 <?php endif; ?>

                
            </div>
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
</div>
</div>
</section>
</div>

          
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/subscription/garage_settings.blade.php ENDPATH**/ ?>