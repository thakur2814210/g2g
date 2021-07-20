<?php $__env->startSection('content'); ?>
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
     <div class="row">
         
       <div class="col-12 col-lg-3">
           <div class="heading">
               <h2>
                   <?php echo app('translator')->get('website.My Address'); ?>
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
          <i class="fa fa-list"></i> <?php echo app('translator')->get('website.My Address'); ?>
        </div>
        <div class="card-body">
          <div style="padding-bottom: 10px;">
           <a class="btn btn-sm btn-outline-danger "  href="<?php echo e(URL::to('/my-address/add')); ?>">
            <i class="fa fa-plus"></i> <?php echo app('translator')->get('website.Add'); ?> <?php echo app('translator')->get('website.Address'); ?></a>
           </div>
          <div class="table-responsive">
           <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                 <tr class="bg-danger text-white">
                  <th>#</th>
                  <th><?php echo app('translator')->get('website.Address'); ?></th>
                  <th><?php echo app('translator')->get('website.Status'); ?></th>
                  <th><?php echo app('translator')->get('website.Action'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($result['clientLocation']) && count($result['clientLocation']) > 0): ?>
                  <?php $__currentLoopData = $result['clientLocation']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $clientLocation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="text-center"><?php echo e($index + 1); ?></td>
                      <td><?php echo e($clientLocation->address); ?></td>
                      <td><?php echo e($clientLocation->status); ?></td>
                      <td>
                          <a class="btn btn-sm btn-outline-danger "  href="<?php echo e(URL::to('/my-address/edit/'.$clientLocation->id)); ?>">
                            <?php echo e(trans('website.Update')); ?>

                          </a>
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7">
                        <?php echo e(trans('website.No record found')); ?>

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




<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\g2g\resources\views/autoshop/address/index.blade.php ENDPATH**/ ?>