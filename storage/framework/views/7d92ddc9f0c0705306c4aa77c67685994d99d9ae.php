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
       <div class="card">
        <div class="card-header">
          <i class="fa fa-list"></i> Service Request List</div>
        <div class="card-body">
          <div class="table-responsive">
           <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                 <tr class="bg-danger text-white">
                  <th>#</th>
                  <th>Code/Date</th>
                  <th>Category</th>
                  <th>Vehicle</th>
                  <th>Quote Amount(AED)</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr class="bg-danger text-white">
                  <th>#</th>
                  <th>Code/Date</th>
                  <th>Category</th>
                  <th>Vehicle</th>
                  <th>Quote Amount(AED)</th>
                  <th>Status</th>
                  <th width="20%">Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php if(!empty($serviceRequests) && count($serviceRequests) > 0): ?>
                  <?php $__currentLoopData = $serviceRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $serviceRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="text-center"><?php echo e($index + 1); ?></td>
                      <td>
                          <label><?php echo e($serviceRequest->sr_code); ?></label><br/>
                          <small>( <?php echo e(date('M d,Y', strtotime($serviceRequest->created_at))); ?> )</small>
                      </td>

                      <td><?php echo e($serviceRequest->category->name); ?></td>

                      <td><a href="<?php echo e(route('client.vehicle.view',['id' => $serviceRequest->vehicle->id ])); ?>"><?php echo e($serviceRequest->vehicle->plate_no); ?></a></td>
                       
                       <td class="text-center">
                           <?php echo e((!empty($serviceRequest->quote_amount) ? 'AED '. $serviceRequest->quote_amount : 'Not Available' )); ?>

                        </td>
                       
                         <td class="text-center text-uppercase">
                          <?php if( $serviceRequest->status == 'cancel'): ?>
                            <label class="unread text-large"><?php echo e($serviceRequest->status); ?></label>
                          <?php elseif( $serviceRequest->status == 'new' || $serviceRequest->status == 'request-payment'): ?>
                           <label class="pending"><?php echo e($serviceRequest->status); ?></label>
                          <?php else: ?>
                             <label class="read"><?php echo e($serviceRequest->status); ?></label>
                          <?php endif; ?>

                        </td>
                       
                       <td>
                          <a class="btn btn-sm btn-outline-danger "  href="<?php echo e(URL::to('/service-request/settings/'.$serviceRequest->id)); ?>">
                            Update
                          </a>
                          &nbsp;
                          <a  class="btn btn-sm btn-outline-danger" href="<?php echo e(URL::to('/service-request/logs/'.$serviceRequest->id)); ?>">
                            Log
                          </a>
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7">
                        No Service Request Found.
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
     </div>
   </div>
 </section>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/resources/views/autoshop/service-request/index.blade.php ENDPATH**/ ?>