<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Edit Service Package Feature</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
       <li class="breadcrumb-item">
          <a href="<?php echo e(route('superadmin.service-package')); ?>">Service Packages List</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo e(route('superadmin.service-package.features')); ?>">Service Packages Features</a>
        </li>
      <li class="active">Edit Service Package Feature</li>
    </ol>
  </section>

       <!-- Main content -->
  <section class="content">

     <div class="row">
          <div class="col-12">
            <div class="box">
               <div class="box-header">
                    <h3 class="box-title"> Edit Service Package Feature: <?php echo e($packagefeatures->feature_name); ?></h3>
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

                      <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.service-package.features.update')); ?>" enctype="multipart/form-data">
                         <?php echo e(csrf_field()); ?>

                         <input type="hidden" name="id" value="<?php echo e($packagefeatures->id); ?>">
                      <div class="card-body">

                          <div class="form-group row">
                            <label for="tag_status" class="col-sm-2 col-form-label">Package</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="service_package_id" id="service_package_id" required="required">
                                  <option value="">Select package</option>
                                  <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <option value="<?php echo e($package->id); ?>"  <?php if( $packagefeatures->service_package_id == $package->id): ?> selected <?php endif; ?>><?php echo e($package->slug); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                            </div>
                          </div>


                          <div class="form-group row">
                            <label for="tag_name" class="col-sm-2 col-form-label">Feature Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="feature_name" id="feature_name" value="<?php echo e($packagefeatures->feature_name); ?>"  required="required" />
                            </div>
                          </div>
        
                          <div class="form-group row">
                            <label for="tag_name" class="col-sm-2 col-form-label">Feature Value</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="feature_value" id="feature_value" value="<?php echo e($packagefeatures->feature_value); ?>" required="required" />
                            </div>
                          </div>   

                          <div class="form-group row">
                            <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="status" id="status" required="required">
                                <option value="1"  <?php if( $packagefeatures->status == 1): ?> selected <?php endif; ?> >Active</option>
                                <option value="2" <?php if( $packagefeatures->status == 2): ?> selected <?php endif; ?> >Disable</option>
                              </select>
                            </div>
                          </div>
                        
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-save" ></i> Update Service Package Feature</button>
                      </div>
                      <!-- /.card-footer -->
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

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/servicepackage/package-featutre-edit.blade.php ENDPATH**/ ?>