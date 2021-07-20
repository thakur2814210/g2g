<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Service Request Update</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('garage.customers.service-request')); ?>">Customers Service Request List</a></li>
        <li class="active">Service Request Update</li>
      </ol>
    </section>

     <section class="content">
   

    
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

          <div class="col-md-6 ">
             <div class="box box-solid box-info">
                <div class="box-header">
                <p class="box-title"><i class="fa fas fa-tags"></i> Service Request Information</p>
              </div>
               <div class="box-body">
                  <div class="jumbotron p-2">
                      <div class="row text-center">
                        <div class="col-md-6 ">
                            <h6 >Service Request Status</h6>
                            <?php if(in_array($sr->status, ['new' , 'request-payment'])): ?> 
                               <label class="pending text-uppercase text-white p-2">
                            <?php elseif(in_array($sr->status, ['received-payment'])): ?> 
                              <label class="read text-uppercase text-white p-2">
                            <?php elseif(in_array($sr->status, ['in-progress'])): ?> 
                               <label class="read text-uppercase text-white p-2">
                            <?php elseif(in_array($sr->status, ['cancel'])): ?> 
                                <label class="unread text-uppercase text-white p-2">
                            <?php else: ?>
                              <label class="read text-uppercase text-white p-2">
                            <?php endif; ?>
                              <?php echo e($sr->status); ?>

                            </label>
                           
                        </div>
                        <div class="col-md-6 ">
                            <h6 >Quote Amount AED</h6>
                            <label class="read text-uppercase text-white p-2">
                              <?php echo e((!empty($sr->quote_amount) ? 'AED '. $sr->quote_amount : ' Not Available ' )); ?>

                            </label>
                        </div>
                      </div>
                    </div>
  
                    <?php if($sr->status !== 'completed' ): ?> 
                    <div class="row text-center">
                      <div class="col-md-12 ">
                        <form class="form-horizontal" method="POST" action="<?php echo e(route('garage.customers.service-requestd.update-sr-status')); ?>">
                          <?php echo e(csrf_field()); ?>

                          <input type="hidden" name="id" value="<?php echo e($sr->id); ?>">
                          <div class="form-group">
                             <h6 >Manage/ Update Status</h6>
                             
                             <?php if(in_array($sr->status, ['new' , 'request-payment'])): ?> 
                                <input type="hidden" name="status" value="cancel">
                                <button class="btn btn-sm btn-outline-danger" title="Cancel Service can resume again">
                                    <i class=" fa fa-times"></i> Cancel Service Request
                                </button>  
                              <?php elseif(in_array($sr->status, ['received-payment'])): ?> 
                                <input type="hidden" name="status" value="in-progress">
                                 <button class="btn btn-sm btn-outline-success ">
                                     <i class=" fa fa-check-circle"></i> Mark As Working
                                </button>  
                              <?php elseif(in_array($sr->status, ['in-progress'])): ?> 
                                <input type="hidden" name="status" value="completed">
                                  <button class="btn btn-sm btn-outline-success ">
                                    <i class=" fa fa-check-circle"></i> Mark As Complete
                                </button> 
                              <?php else: ?>
                                <h4 class="text-danger m-0">Service request has cancelled</h4>
                              <?php endif; ?>
                          </div>
                     </form>
                      </div>
                    </div>
                    <?php endif; ?>

                   <div class="form-group">
                      <label>faults_remarks</label>
                      <p><?php echo e($sr->faults_remarks); ?> </p>
                    </div>

                    <div class="row">
                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Category</label>
                          <p><?php echo e($sr->category->name); ?>

                          </p>
                        </div>
                      </div>

                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Appointment At</label>
                           <?php if(!empty($sr->appointment_at)): ?>
                              <p><?php echo e(date('Y-m-d h:i:s a' , strtotime($sr->appointment_at))); ?>

                          <?php else: ?>
                            <p>NULL</p>
                          <?php endif; ?>
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Created At</label>
                          <p><?php echo e(date('Y-m-d h:i:s a' , strtotime($sr->created_at))); ?>

                          </p>
                        </div>
                      </div>

                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Updated At</label>
                          <p><?php echo e(date('Y-m-d h:i:s a' , strtotime($sr->updated_at))); ?>

                          </p>
                        </div>
                      </div>
                    </div>
                    
                     
               </div>
             </div>
          </div>

          <div class="col-md-6 ">
              <div class="box box-solid box-info">
                <div class="box-header ">
                  <p class="box-title"><i class="fa fas fa-money "></i> Payment Information</p>
                </div>

                <div class="box-body table-responsive">
                    

                   <?php if($sr->status == 'new'): ?>

                      <div class="jumbotron">
                       <label class="text-danger" style="padding: 10px;">Customer Request for Quote Amount</label>
                        <form class="form-horizontal" style="padding: 10px;" method="POST" action="<?php echo e(route('garage.customers.service-request.update-quote-amount')); ?>">
                          <div class="modal-body">
                              <?php echo e(csrf_field()); ?>

                              <input type="hidden" name="id" value="<?php echo e($sr->id); ?>">
                               
                              <div class="form-group">
                                <label>Quote Amount (AED)</label>
                                <input class="form-control" type="number" name="amount">
                              </div>
                              <div class="form-group">
                                 <button type="submit" class="btn btn-success" data-dismiss="modal">Submit</button>
                              </div>
                          </div>
                        </form>
                      </div>
                    <?php elseif($sr->status == 'cancel'): ?>
                      <label class="text-danger">Not required! Service request has cancelled.</label>
                    <?php else: ?>

                      <?php if(!empty($sr_payment)): ?>

                      <div class="jumbotron p-2">
                        <div class="row text-center">
                          <div class="col-md-6 ">
                            <h6 >Payment amount</h6>
                            <label class="read text-uppercase text-white p-2">
                              AED <?php echo e($sr_payment->amount); ?>

                            </label>
                          </div>
                          <div class="col-md-6 ">
                            <h6>Payment Status</h6>
                            <label class="read text-uppercase text-white p-2">
                              <?php if(!empty($sr_payment->status == 1)): ?>
                                Success
                              <?php elseif(!empty($sr_payment->status == 2)): ?>
                                Failed
                              <?php else: ?>
                                Pending
                              <?php endif; ?>
                            </label>
                          </div>
                        </div>
                      </div>

                      <?php if(!empty($sr_payment->status == 1)): ?>
                        <div class="row text-center">
                          <div class="col-md-6 ">
                            <div class="form-group">
                              <label>Payment Date</label>
                              <p> <?php echo e($sr_payment->date); ?></p>
                            </div>
                          </div>
                          <div class="col-md-6 ">
                           <div class="form-group">
                              <label>Payment Type</label>
                              <p> <?php echo e($sr_payment->payment_type); ?></p>
                            </div>
                          </div>
                        </div>
                       <?php endif; ?>
                      <?php endif; ?>
                    <?php endif; ?>
                </div>
              </div>
          </div>
        </div>

        <br/>

  
        <div class="row">

          <div class="col-md-6">

            <div class="box box-solid box-info">

              <div class="box-header">
                <p class="box-title"><i class="fa fas fa-user-circle"></i> Customer Information</p>
              </div>
               <div class="box-body">

                    <div class="form-group">
                      <label>Customer Name</label>
                      <p><?php echo e($sr->client->first_name); ?> <?php echo e($sr->client->last_name); ?></p>
                    </div>

                    <div class="form-group">
                      <label>Address</label>
                      <p><?php echo e($sr->address); ?></p>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                         <div class="form-group">
                            <label>City</label>
                              <p><?php echo e($sr->t_city->name); ?></p>
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                           <label>Pobox</label>
                             <p><?php echo e($sr->pobox); ?></p>
                        </div>
                      </div>
                    </div>


               </div>
              </div>
            </div>
         
          

           <div class="col-md-6">
             <div class="box box-solid box-info">
            <div class="box-header">
                <p class="box-title"><i class="fa fas fa-car"></i> Vehicle Information</p>               
              </div>

                <div class="box-body">
                  <?php if( in_array($sr->status, ['new' , 'request-payment','cancel','delete'])): ?> 
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Make</label>
                          <p><?php echo e($sr->vehicle->vmake->name); ?></p>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Model</label>
                          <p><?php echo e($sr->vehicle->vmodel->name); ?></p>
                        </div>
                      </div>
                    </div>

                     <div class="alert alert-danger">
                        <label>Complete Vehicle information will be available only if customer paid the quote amount.</label>
                      </div>

                  <?php else: ?>

                   <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Make</label>
                          <p><?php echo e($sr->vehicle->vmake->name); ?></p>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Model</label>
                          <p><?php echo e($sr->vehicle->vmodel->name); ?></p>
                        </div>
                      </div>
                    </div>

                     <div class="row">
                       <div class="col-4">
                        <div class="form-group">
                          <label>Plate No.</label>
                          <p><?php echo e($sr->vehicle->plate_no); ?></p>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label>Registration No</label>
                          <p><?php echo e($sr->vehicle->registration_no); ?></p>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label>Chassis No</label>
                          <p><?php echo e($sr->vehicle->chassis_no); ?></p>
                        </div>
                      </div>
                    </div>

                    
                    <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <label>Color</label>
                          <p><?php echo e($sr->vehicle->color); ?></p>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label>Year</label>
                          <p><?php echo e($sr->vehicle->year); ?></p>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label>Current Mileage</label>
                          <p><?php echo e($sr->vehicle->current_mileage); ?></p>
                        </div>
                      </div>
                    </div>

                     <?php endif; ?>
              </div>
          </div>
        </div>
      </div>
    </section>
  </div>



      
          
<?php $__env->stopSection(); ?>
<?php echo $__env->make('garage.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Garage/Resources/views/customer/sr/setting.blade.php ENDPATH**/ ?>