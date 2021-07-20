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
                <p class="card-title"><i class="fa fas fa-tags"></i> Service Request Information</p>
              </div>
               <div class="card-body">

                 <div class="jumbotron p-2">
                      <div class="row text-center">
                        <div class="col-6 ">
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
                        <div class="col-6 ">
                            <h6 >Quote Amount AED</h6>
                            <label class="read text-uppercase text-white p-2">
                              <?php echo e((!empty($sr->quote_amount) ? 'AED '. $sr->quote_amount : ' Not Available ' )); ?>

                            </label>
                        </div>
                      </div>
                    </div>


                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                         <label class="text-danger">Faults/Remarks</label>
                        <p>
                          <?php echo e($sr->faults_remarks); ?>

                          
                        </p>
                      </div>
                    </div>

                    <?php
                        $language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;
                        $garage_name = null;
                        foreach($sr->garage->garageDescription as $gd){

                          if($gd['language_id'] === $language_id){
                            $garage_name = $gd['garages_name'];
                          }
                        }
                    ?>
                    <div class="col-12">
                      <div class="form-group">
                          <label class="text-danger">Garage Name</label>
                        <p><?php echo e($garage_name); ?></p>
                      </div>
                    </div>
                    
                    <div class="col-12">
                      <div class="form-group">
                          <label class="text-danger">Garage Address</label>
                        <p><?php echo e($sr->garage->address); ?>, <?php echo e($sr->garage->city->name); ?>, <?php echo e($sr->garage->country->name); ?>, POBOX-<?php echo e($sr->garage->postal); ?></p>
                      </div>
                    </div>
                   
                    <div class="col-6">
                        <div class="form-group">
                            <label class="text-danger">Garage Email</label>
                          <p><?php echo e($sr->garage->user->email); ?></p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                            <label class="text-danger">Garage Phone</label>
                          <p><?php echo e($sr->garage->user->phone); ?></p>
                        </div>
                      </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="text-danger">Category</label>
                        <p><?php echo e($sr->category->name); ?>

                        </p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="text-danger">Vehicle Information</label>
                        <p ><i class="fa fa-car"></i> <?php echo e($sr->vehicle->plate_no); ?>

                        </p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="text-danger">Created At</label>
                        <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($sr->created_at))); ?></p>
                        </p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="text-danger">Last Updated At</label>
                        <p class="text-uppercase"><?php echo e(date('Y-m-d h:i a', strtotime($sr->updated_at))); ?></p>
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
                    

                  <?php if($sr->status == 'request-payment'): ?>

                    <form class="form-horizontal" method="POST" action="<?php echo e(route('client.service-request.update-sr-payment-status')); ?>">
                      <?php echo e(csrf_field()); ?>

                      <input type="hidden" name="id" value="<?php echo e($sr->id); ?>">
                        <div class="form-group">
                            <h6 >Quote Amount AED</h6>
                            <label class="read text-uppercase text-white p-2">
                              AED <?php echo e($sr->quote_amount); ?>

                            </label>
                        </div>
                        <div class="form-group">
                           <h6 >Make Payment</h6>
                          <select class="form-control" name="payment_type" id="payment_type" >
                             <option value="cod" selected="">Cash On Delivery</option>
                             <option value="telr" disabled="">Telr</option>
                          </select>
                        </div>

                        <div class="form-group">
                           <button type="submit" class="btn btn-success" data-dismiss="modal">Submit Payment</button>
                        </div>
                      
                    </form>
                 
                   <?php elseif($sr->status == 'new'): ?>
                      <label class="text-danger"><b>Information:</b><br/> Service request create and waiting for the Garage quote amount.</label>
                    <?php elseif($sr->status == 'cancel' || $sr->status == 'delete'): ?>
                      <label class="text-danger">Not required! Service request has cancel or deleted.</label>
                    <?php else: ?>

                      <?php if(!empty($sr_payment)): ?>

                      <div class="jumbotron p-2">
                        <div class="row text-center">
                          <div class="col-6 ">
                            <h6 >Payment amount</h6>
                            <label class="read text-uppercase text-white p-2">
                              AED <?php echo e($sr_payment->amount); ?>

                            </label>
                          </div>
                          <div class="col-6 ">
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
                          <div class="col-6 ">
                            <div class="form-group">
                              <label>Payment Date</label>
                              <p> <?php echo e($sr_payment->date); ?></p>
                            </div>
                          </div>
                          <div class="col-6 ">
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
          </div>
        </div>
      </div>
    </div>
  </section>

        

<?php $__env->stopSection(); ?>


<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/resources/views/autoshop/service-request/setting.blade.php ENDPATH**/ ?>