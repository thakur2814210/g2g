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
          <i class="fa fa-list"></i> <?php echo app('translator')->get('website.Service Request List'); ?></div>
        <div class="card-body">
          <div class="table-responsive">
           <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                 <tr class="bg-danger text-white">
                  <th>#</th>
                  <th><?php echo app('translator')->get('website.Code/Date'); ?></th>
                  <th><?php echo app('translator')->get('website.Category'); ?></th>
                  <th><?php echo app('translator')->get('website.Vehicle'); ?></th>
                  <th><?php echo app('translator')->get('website.Quote Amount (AED)'); ?></th>
                  <th width="20%"><?php echo app('translator')->get('website.Status'); ?></th>
                  <th width="20%"><?php echo app('translator')->get('website.Action'); ?></th>
                </tr>
              </thead>
              <tfoot>
                <tr class="bg-danger text-white">
                  <th>#</th>
                  <th><?php echo app('translator')->get('website.Code/Date'); ?></th>
                  <th><?php echo app('translator')->get('website.Category'); ?></th>
                  <th><?php echo app('translator')->get('website.Vehicle'); ?></th>
                  <th><?php echo app('translator')->get('website.Quote Amount (AED)'); ?></th>
                  <th><?php echo app('translator')->get('website.Status'); ?></th>
                  <th><?php echo app('translator')->get('website.Action'); ?></th>
                </tr>
              </tfoot>
              <tbody>
                <?php if(!empty($serviceRequests) && count($serviceRequests) > 0): ?>
                  <?php $__currentLoopData = $serviceRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $serviceRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                    $vehicle_id = null;
                    $plate_no = null;
                    
                    if(isset($serviceRequest->vehicle->id)){
                        $vehicle_id = $serviceRequest->vehicle->id;
                        $plate_no = $serviceRequest->vehicle->plate_no;
                    }
                    
                    
                  ?>
                    <tr>
                      <td class="text-center"><?php echo e($index + 1); ?></td>
                      <td>
                          <label><?php echo e($serviceRequest->sr_code); ?></label><br/>
                          <small>( <?php echo e(date('M d,Y', strtotime($serviceRequest->created_at))); ?> )</small>
                      </td>

                      <td><?php echo e($serviceRequest->category->name); ?></td>

                      <td>
                          <?php if($vehicle_id): ?>
                            <a href="<?php echo e(route('client.vehicle.view',['id' => $vehicle_id])); ?>"><?php echo e($plate_no); ?></a>
                          <?php endif; ?>
                        </td>
                       
                       <td class="text-center">
                           <?php echo e((!empty($serviceRequest->quote_amount) ? 'AED '. $serviceRequest->quote_amount : trans('website.Not Available') )); ?>

                        </td>
                       
                         <td class="text-center text-uppercase">
                             <label
                                  <?php if( $serviceRequest->status == 'cancel'): ?>
                                     class="unread text-large">
                                  <?php elseif( $serviceRequest->status == 'new' || $serviceRequest->status == 'request-payment'): ?>
                                    class="pending">
                                  <?php else: ?>
                                     class="read">
                                  <?php endif; ?>
                              <?php echo e(trans("website.$serviceRequest->status")); ?></label>

                        </td>
                       
                       <td>
                          <a class="btn btn-sm btn-outline-danger "  href="<?php echo e(URL::to('/service-request/settings/'.$serviceRequest->id)); ?>">
                            <?php echo e(trans('website.Update')); ?>

                          </a>
                          &nbsp;
                          <a  class="btn btn-sm btn-outline-danger" href="<?php echo e(URL::to('/service-request/logs/'.$serviceRequest->id)); ?>">
                            <?php echo e(trans('website.Log')); ?>

                          </a>
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7">
                        <?php echo e(trans('website.No Service Request Found')); ?>

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




<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/autoshop/service-request/index.blade.php ENDPATH**/ ?>