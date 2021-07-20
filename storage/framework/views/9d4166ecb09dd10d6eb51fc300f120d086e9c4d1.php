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
         <?php echo app('translator')->get('website.Payment'); ?>  <?php echo app('translator')->get('website.List'); ?>
       </div>
       
          <div class="card-body table-responsive">
            <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr style="background: #e9ecef">
                      <th>#</th>
                  <th> <?php echo app('translator')->get('website.Date'); ?></th>
                  <th> <?php echo app('translator')->get('website.Amount'); ?></th>
                  <th> <?php echo app('translator')->get('website.Payment'); ?> <?php echo app('translator')->get('website.Type'); ?></th>
                  <th> <?php echo app('translator')->get('website.For'); ?></th>
                  <th> <?php echo app('translator')->get('website.Status'); ?></th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef">
                     <th>#</th>
                    <th> <?php echo app('translator')->get('website.Date'); ?></th>
                  <th> <?php echo app('translator')->get('website.Amount'); ?></th>
                  <th> <?php echo app('translator')->get('website.Payment'); ?> <?php echo app('translator')->get('website.Type'); ?></th>
                  <th> <?php echo app('translator')->get('website.For'); ?></th>
                  <th> <?php echo app('translator')->get('website.Status'); ?></th>
                    
                </tr>
              </tfoot>
              <tbody>
                <?php if(!empty($payments) && count($payments) > 0): ?>
                  <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                       <td><?php echo e(date('M d, Y',strtotime($payment['date']))); ?></td>
                    
                      <td>AED <?php echo e($payment['amount']); ?></td>
                      <td> <?php echo e(trans('website.'.$payment['payment_type'])); ?></td>
                      <td>
                          <?php if(isset($payment['client_package_subscribe_id'])): ?>
                            <?php echo app('translator')->get('website.Package Subscription'); ?> 
                          <?php else: ?>
                              <?php echo app('translator')->get('website.Service Request'); ?>
                          <?php endif; ?>
                      </td>
                      <td>
                        <?php if($payment['status'] == 1): ?>
                            <?php echo app('translator')->get('website.Success'); ?>
                        <?php elseif($payment['status'] == 2): ?>
                            <?php echo app('translator')->get('website.Failed'); ?> 
                        <?php else: ?>
                            <?php echo app('translator')->get('website.Pending'); ?>
                        <?php endif; ?>

                      </td>
                      
                    </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7">
                        <?php echo app('translator')->get('website.No record found'); ?>
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

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/autoshop/transactions.blade.php ENDPATH**/ ?>