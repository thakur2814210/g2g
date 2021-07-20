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
             <div class="card">
        <div class="card-header">
         Payment List
       </div>
       
          <div class="card-body table-responsive">
            <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr style="background: #e9ecef">
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Payment Type</th>
                  <th>For</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef">
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Payment Type</th>
                    <th>For</th>
                    <th>Status</th>
                    
                </tr>
              </tfoot>
              <tbody>
                <?php if(!empty($payments) && count($payments) > 0): ?>
                  <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                       <td><?php echo e(date('M d, Y',strtotime($payment['date']))); ?></td>
                    
                      <td>AED <?php echo e($payment['amount']); ?></td>
                      <td> <?php echo e($payment['payment_type']); ?></td>
                      <td>
                          <?php if(isset($payment['client_package_subscribe_id'])): ?>
                             Package Subscription
                          <?php else: ?>
                              Service Request
                          <?php endif; ?>
                      </td>
                      <td>
                        <?php if($payment['status'] == 1): ?>
                        Success
                        <?php elseif($payment['status'] == 2): ?>
                        Failed
                        <?php else: ?>
                        Pending
                        <?php endif; ?>

                      </td>
                      
                    </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7">
                        No customers Found.
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

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/resources/views/autoshop/transactions.blade.php ENDPATH**/ ?>