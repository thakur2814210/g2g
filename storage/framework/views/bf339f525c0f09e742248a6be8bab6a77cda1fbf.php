<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Service Request Update</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
       <li class="breadcrumb-item">
          <a href="<?php echo e(route('superadmin.service-requests')); ?>">Service Request List</a></li>
        </li>
      <li class="active">Service Request Update</li>
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

          <div class="col-md-6 ">
             <div class="box box-solid box-primary">
                <div class="box-header ">
                <p class="box-title"><i class="fa fas fa-tags"></i> Service Request Information</span>
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
                            <?php elseif(in_array($sr->status, ['delete'])): ?> 
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

                    
                    <div class="form-group">
                      <label>faults_remarks</label>
                      <span><?php echo e($sr->faults_remarks); ?></span>
                    </div>

                    <?php if(!empty($sr->image)): ?>
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="<?php echo e(asset('assets/uploads/service-request/' .$sr->image )); ?>" height="200" width="320" />
                      </div>
                    <?php endif; ?>

                    <?php if(!empty($sr->image1)): ?>
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="<?php echo e(asset('assets/uploads/service-request/' .$sr->image1 )); ?>" height="200" width="320" />
                      </div>
                    <?php endif; ?>

                    <?php if(!empty($sr->image2)): ?>
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="<?php echo e(asset('assets/uploads/service-request/' .$sr->image2 )); ?>" height="200" width="320" />
                      </div>
                    <?php endif; ?>

                    <?php if(!empty($sr->image3)): ?>
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="<?php echo e(asset('assets/uploads/service-request/' .$sr->image3 )); ?>" height="200" width="320" />
                      </div>
                    <?php endif; ?>


                    <?php if(!empty($sr->image4)): ?>
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="<?php echo e(asset('assets/uploads/service-request/' .$sr->image4 )); ?>" height="200" width="320" />
                      </div>
                    <?php endif; ?>

                    <?php if(!empty($sr->image5)): ?>
                      <div class="form-group">
                        <label>Images (It's Optional)</label>
                        <br/>
                        <img src="<?php echo e(asset('assets/uploads/service-request/' .$sr->image5 )); ?>" height="200" width="320" />
                      </div>
                    <?php endif; ?>


                     <div class="row">
                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Garage</label>
                          <span><?php echo e($sr->garage->defaultGarageDescription[0]->garages_name); ?>

                          </span>
                        </div>
                      </div>

                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Garage Username</label>
                          <span><?php echo e($sr->garage->user->user_name); ?>

                          </span>
                        </div>
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Garage User</label>
                          <span><?php echo e($sr->garage->user->first_name); ?> <?php echo e($sr->garage->user->last_name); ?>

                          </span>
                        </div>
                      </div>

                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Garage Email</label>
                          <span><?php echo e($sr->garage->user->email); ?>

                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Category</label>
                          <span><?php echo e($sr->category->name); ?>

                          </span>
                        </div>
                      </div>

                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Appointment At</label>
                          <span><?php echo e(isset($sr->appointment_at) ? date('Y-m-d h:i:s a' , strtotime($sr->appointment_at)) : 'N/A'); ?>

                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Created At</label>
                          <span><?php echo e(date('Y-m-d h:i:s a' , strtotime($sr->created_at))); ?>

                          </span>
                        </div>
                      </div>

                      <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Updated At</label>
                          <span><?php echo e(date('Y-m-d h:i:s a' , strtotime($sr->updated_at))); ?>

                          </span>
                        </div>
                      </div>
                    </div>
                    
                     
               </div>
             </div>
          </div>

          <div class="col-md-6 ">
              <div class="box box-solid box-primary">
                <div class="box-header">
                  <p class="box-title"><i class="fa fas fa-money "></i> Payment Information</span>
                </div>

                <div class="box-body">
                    

                   <?php if($sr->status == 'new'): ?>
                       <label class="text-danger">Garage has not send the quote amount yet to the Customer.</label>
                    <?php elseif($sr->status == 'cancel' || $sr->status == 'delete'): ?>
                      <label class="text-danger">Not required! Service request has cancel or deleted.</label>
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


                        <div class="row text-center">
                          <div class="col-md-6 ">
                            <div class="form-group">
                              <label>Payment Date</label>
                              <span> <?php echo e($sr_payment->date); ?></span>
                            </div>
                          </div>
                          <div class="col-md-6 ">
                           <div class="form-group">
                              <label>Payment Type</label>
                              <span> <?php echo e($sr_payment->payment_type); ?></span>
                            </div>
                          </div>
                        </div>
                      <?php endif; ?>
                    <?php endif; ?>
                </div>
              </div>
          </div>
        </div>

        <br/>

  
        <div class="row">

          <div class="col-md-6">

            <div class="box box-solid box-primary">

              <div class="box-header card-header-custom">
                <p class="box-title"><i class="fa fa-user"></i> Customer Information</span>
              </div>
               <div class="box-body">

                    <div class="form-group">
                      <label>Customer Name</label>
                      <span><?php echo e($sr->client->user->first_name); ?> <?php echo e($sr->client->user->last_name); ?></span>
                    </div>

                     <div class="form-group">
                      <label>Customer Email</label>
                      <span><?php echo e($sr->client->user->email); ?></span>
                    </div>

                     <div class="form-group">
                      <label>Customer Phone</label>
                      <span><?php echo e($sr->client->user->phone); ?></span>
                    </div>

                    <div class="form-group">
                      <label>Address</label>
                      <span><?php echo e($sr->address); ?></span>
                    </div>
                     <div class="row">
                      <div class="col-md-4">
                         <div class="form-group">
                            <label>City</label>
                              <span><?php echo e($sr->t_city->name); ?></span>
                          </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Country</label>
                             <span><?php echo e($sr->t_country->name); ?></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Pobox</label>
                             <span><?php echo e($sr->pobox); ?></span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                         <div class="form-group">
                            <label>Latitude</label>
                              <span><?php echo e($sr->latitude); ?></span>
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Longitude</label>
                             <span><?php echo e($sr->longitude); ?></span>
                        </div>
                      </div>
                    </div>
               </div>
              </div>
            </div>
         
          

           <div class="col-md-6">
             <div class="box box-solid box-primary">
            <div class="box-header card-header-custom">
                <p class="box-title"><i class="fa fas fa-car"></i> Vehicle Information</span>               
              </div>

                <div class="box-body">
                 
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Make</label>
                          <span><?php echo e($sr->vehicle->vmake->name); ?></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Model</label>
                          <span><?php echo e($sr->vehicle->vmodel->name); ?></span>
                        </div>
                      </div>
                    
                       <div class="col-md-4">
                        <div class="form-group">
                          <label>Plate No.</label>
                          <span><?php echo e(isset($sr->vehicle->plate_no) ? $sr->vehicle->plate_no : 'N/A'); ?></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Registration No</label>
                          <span><?php echo e(isset($sr->vehicle->registration_no) ? $sr->vehicle->registration_no : 'N/A'); ?></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Chassis No</label>
                          <span><?php echo e(isset($sr->vehicle->chassis_no) ? $sr->vehicle->chassis_no : 'N/A'); ?></span>
                        </div>
                      </div>
                   
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Color</label>
                          <span><?php echo e(isset($sr->vehicle->color) ? $sr->vehicle->color : 'N/A'); ?></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Year</label>
                          <span><?php echo e(isset($sr->vehicle->year) ? $sr->vehicle->year : 'N/A'); ?></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Current Mileage</label>
                           <span><?php echo e(isset($sr->vehicle->current_mileage) ? $sr->vehicle->current_mileage : 'N/A'); ?></span>
                        </div>
                      </div>
                    </div>
              </div>
          </div>
        </div>
      </div>

      
          
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/servicerequest/view.blade.php ENDPATH**/ ?>