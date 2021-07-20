<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Set  Commissions</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active">Set  Commissions</li>
    </ol>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="row">
          <div class="col-md-12">
            <div class="box box-danger">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
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

                <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.settings.commissions.update')); ?>">
                <?php echo e(csrf_field()); ?>

              
                <div class="card-body">
                  <div class="row">
            
                    <div class="col-sm-4">
                      <div class="form-group ">
                        <label for="tag_name" class="col-sm-12 col-form-label">Service Request</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="service_request" value="<?php echo e(isset($commission->service_request) ? $commission->service_request : '0.00'); ?>" />
                        </div>
                      </div>
                    </div>

                     <div class="col-sm-4">
                        <div class="form-group ">
                            <label for="tag_name" class="col-sm-12 col-form-label">Client Package Subscription</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="client_package_subscription" value="<?php echo e(isset($commission->client_package_subscription) ? $commission->client_package_subscription :'0.00'); ?>" />
                            </div>
                        </div>
                     </div>
                 
                    <div class="col-sm-4">
                      <div class="form-group ">
                        <label for="tag_name" class="col-sm-12 col-form-label">Garage Package Subscription</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="garage_package_subscription" value="<?php echo e(isset($commission->garage_package_subscription) ? $commission->garage_package_subscription : '0.00'); ?>" />
                        </div>
                      </div>
                    </div>
                 </div>
                </div>
                 <div class="card-footer text-center">
                  <button type="submit" class="btn btn-danger"><i class="fa fa-money" ></i> Update Commissions</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/general-setting/commission.blade.php ENDPATH**/ ?>