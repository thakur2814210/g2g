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
                  <i class="fa fa-list"></i> <?php echo app('translator')->get('website.Package Subscription'); ?> <?php echo app('translator')->get('website.List'); ?></div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                         <tr style="background: #e9ecef">
                          <th>#</th>
                          <th><?php echo app('translator')->get('website.Amount'); ?></th>
                          <th><?php echo app('translator')->get('website.Vehicle'); ?></th>
                          <th><?php echo app('translator')->get('website.Package'); ?></th>
                          <th><?php echo app('translator')->get('website.Garage'); ?></th>
                           <th><?php echo app('translator')->get('website.Start At'); ?> | <?php echo app('translator')->get('website.End At'); ?></th>
                          <th><?php echo app('translator')->get('website.Status'); ?></th>
                          <th width="20%"><?php echo app('translator')->get('website.Action'); ?></th>
                        </tr>
                      </thead>
                      <tfoot>
                         <tr style="background: #e9ecef">
                            <th>#</th>
                             <th><?php echo app('translator')->get('website.Amount'); ?></th>
                          <th><?php echo app('translator')->get('website.Vehicle'); ?></th>
                          <th><?php echo app('translator')->get('website.Package'); ?></th>
                          <th><?php echo app('translator')->get('website.Garage'); ?></th>
                          <th><?php echo app('translator')->get('website.Start At'); ?> | <?php echo app('translator')->get('website.End At'); ?></th>
                          <th><?php echo app('translator')->get('website.Status'); ?></th>
                          <th width="20%"><?php echo app('translator')->get('website.Action'); ?></th>
                        </tr>
                      </tfoot>
                      <tbody>
                      <?php if(!empty($packages) && count($packages) > 0): ?>
                        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td>AED <?php echo e($package->amount); ?></td>
                            <td> <?php echo e($package->vehicle->plate_no); ?></td>
                            <td><?php echo e(( \Config::get('app.locale') == 'en' ) ? $package->service_package_name : $package->service_package_name_ar); ?></td>
                            <td><?php echo e($package->garage); ?></td>
                            <td>
                                  <?php if(!empty($package->subscription_start_at) && !empty($package->subscription_start_at)): ?>
                                    <?php echo e(date('M d, Y', strtotime($package->subscription_start_at))); ?> | <?php echo e(date('M d, Y', strtotime($package->subscription_start_at))); ?>

                                  <?php else: ?>
                                    <?php echo e(trans('website.Not Available')); ?>

                                  <?php endif; ?>
                            </td>
                            <td>
                              <?php echo e(trans('website.'.$packageStatus[$package->status])); ?>

                            </td>
                            <td>

                                    <?php if($package->servicePackage->slug == 'custom-package'): ?>
                                      <a class="btn btn-sm btn-outline-danger " href="<?php echo e(URL::to('/custom-package/settings/'.$package->id)); ?>">
                                        <?php echo app('translator')->get('website.Update'); ?>
                                      </a>
                                    <?php else: ?>
                                      <a class="btn btn-sm btn-outline-danger "  href="<?php echo e(URL::to('/package-subscription/settings/'.$package->id)); ?>">
                                        <?php echo app('translator')->get('website.Update'); ?>
                                      </a>
                                    <?php endif; ?>
                                    &nbsp;
                                    <a  class="btn btn-sm btn-outline-danger" href="<?php echo e(URL::to('/package-subscription/logs/'.$package->id)); ?>">
                                      <?php echo app('translator')->get('website.Log'); ?>
                                    </a>
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
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/autoshop/package/index.blade.php ENDPATH**/ ?>