<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Add Testimonial</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.pages.testimonial')); ?>">Testimonial List</a>
        </li>
      <li class="active">Add Testimonial</li>
    </ol>
  </section>

    <!-- Main content -->
  <section class="content">


    <div class="row">
          <div class="col-md-12">
            <div class="box">
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
                <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.pages.testimonial.save')); ?>" enctype="multipart/form-data">
                   <?php echo e(csrf_field()); ?>

                  <div class="card-body">
                    <div class="form-group row">
                      <label for="tag_name" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required="required" />
                      </div>
                    </div>
                    

                    <div class="form-group row">
                      <label for="tag_slug" class="col-sm-2 col-form-label">Designation</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="designation" id="designation" placeholder="Enter Designation" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="tag_slug" class="col-sm-2 col-form-label">Remarks</label>
                      <div class="col-sm-10">
                        <textarea class="form-control faq_textarea" rows="5" name="remarks" id="remarks" placeholder="Enter Answer" required="required" ></textarea>
                      </div>
                    </div>
  
                  <div class="row">
                   
                    <div class="col-md-6">
                       <div class="form-group">
                        <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="status" id="status" required="required">
                              <option value="">Select</option>
                              <option value="1">Active</option>
                              <option value="2">Unpublished</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                       <div class="form-group">
                          <label for="tag_name" class="col-sm-2 col-form-label">Ordering</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" name="ordering" id="ordering" placeholder="Enter Ordering"/>
                          </div>
                        </div>
                    </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6">
                       <div class="form-group">
                          <label for="exampleInputFile" class="col-sm-2 col-form-label">Image</label>
                          <div class="input-group col-sm-10">
                            <div class="custom-file ">
                              <input type="file" class="" id="image" name="image">
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>

                  
                   

                    
                  
                </div>
                <!-- /.card-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> Create Testimonial</button>
                  <button type="reset" class="btn btn-danger float-right"><i class="fa fa-trash  " ></i> Reset</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('vendor/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('vendor/summernote/summernote-bs4.min.js')); ?>"></script>
    <script>
      $(function () {
        $('.faq_textarea').summernote({
          height: 150, 
        })
      })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/page/testimonial/add.blade.php ENDPATH**/ ?>