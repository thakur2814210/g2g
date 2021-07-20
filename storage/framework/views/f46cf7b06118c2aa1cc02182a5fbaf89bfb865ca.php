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
                      <p><?php echo e($sr->faults_remarks); ?>

                        <br/>
                        <a href="#" class="text-danger"><i class="fa fa-image"></i> See images</a>
                      </p>
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
                          <p><?php echo e(date('Y-m-d h:i:s a' , strtotime($sr->appointment_at))); ?>

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
              <div class="box box-solid box-primary">
                <div class="box-header">
                  <p class="box-title"><i class="fa fas fa-money "></i> Payment Information</p>
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
                </div>
              </div>
          </div>
        </div>

        <br/>

  
        <div class="row">

          <div class="col-md-6">

            <div class="box box-solid box-primary">

              <div class="box-header card-header-custom">
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
                      <div class="col-md-4">
                         <div class="form-group">
                            <label>City</label>
                              <p><?php echo e($sr->t_city->name); ?></p>
                          </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Country</label>
                             <p><?php echo e($sr->t_country->name); ?></p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Pobox</label>
                             <p><?php echo e($sr->pobox); ?></p>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                         <div class="form-group">
                            <label>Latitude</label>
                              <p><?php echo e($sr->latitude); ?></p>
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Longitude</label>
                             <p><?php echo e($sr->longitude); ?></p>
                        </div>
                      </div>
                    </div>
               </div>
              </div>
            </div>
         
          

           <div class="col-md-6">
             <div class="box box-solid box-primary">
            <div class="box-header card-header-custom">
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

      
          
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/servicerequest/view.blade.php ENDPATH**/ ?>