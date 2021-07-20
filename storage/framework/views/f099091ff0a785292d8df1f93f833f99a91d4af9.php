<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Edit Vehicle Make</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.settings.vehicle-make')); ?>">Vehicle Make List</a>
        </li>
      <li class="active">Edit Vehicle Make</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

     <div class="row">
          <div class="col-12">
            <div class="box">
               <div class="box-header">
                    <h3 class="box-title"> Edit: <?php echo e($vehicleMake->name); ?></h3>
                </div>
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
                            <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.settings.vehicle-make.update')); ?>" enctype="multipart/form-data">
                               <?php echo e(csrf_field()); ?>

                               <input type="hidden" name="id" value="<?php echo e($vehicleMake->id); ?>" />
                              <div class="card-body">
                                <div class="form-group row">
                                  <label for="tag_name" class="col-sm-2 col-form-label">Name</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo e($vehicleMake->name); ?>" required="required" />
                                  </div>
                                </div>
                              
                                <div class="form-group row">
                                  <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                                  <div class="col-sm-10">
                                    <select class="form-control" name="active" id="active" required="required">
                                        <option value="1" <?php if($vehicleMake->active == 1): ?> selected <?php endif; ?>>Yes</option>
                                        <option value="0" <?php if($vehicleMake->active == 0): ?> selected <?php endif; ?>>No</option>
                                    </select>
                                  </div>
                                </div>
                              
                            </div>
                            <div class="card-footer">
                              <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Update <?php echo e($vehicleMake->name); ?></button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/general-setting/vehicle-make-edit.blade.php ENDPATH**/ ?>