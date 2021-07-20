<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('css'); ?>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
   <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.dashboard')); ?>">Dashboard</a>
        </li>
         <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.pages.faq')); ?>">FAQ</a>
        </li>
        <li class="breadcrumb-item active">Add FAQ</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
      <div class="col-12">
        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-gray">
               Add New FAQ
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.pages.faq.save')); ?>" enctype="multipart/form-data">
                   <?php echo e(csrf_field()); ?>

                <div class="card-body">

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="tag_name" class="col-12 col-form-label">Category Name(English)</label>
                        <div class="col-12">
                          <input type="text" class="form-control" name="cat_name_en" id="cat_name_en" placeholder="Enter Category Name" required="required" />
                        </div>
                      </div>
                      

                      <div class="form-group">
                        <label for="tag_slug" class="col-12 col-form-label">Heading(English)</label>
                        <div class="col-12">
                          <input type="text" class="form-control" name="heading_en" id="heading_en" placeholder="Enter Heading" required="required" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="tag_slug" class="col-12 col-form-label">Answer(English)</label>
                        <div class="col-12">
                          <textarea class="form-control faq_textarea" rows="10" name="answer_en" id="answer_en" placeholder="Enter Answer" required="required" ></textarea>
                        </div>
                      </div>
                    </div>
                 
                    <div class="col-6">
                      <div class="form-group">
                        <label for="tag_name" class="col-12 col-form-label">Category Name(Arabic)</label>
                        <div class="col-12">
                          <input type="text" class="form-control" name="cat_name_ar" id="cat_name_ar" placeholder="Enter Category Name" required="required" />
                        </div>
                      </div>
                      

                      <div class="form-group">
                        <label for="tag_slug" class="col-12 col-form-label">Heading(Arabic)</label>
                        <div class="col-12">
                          <input type="text" class="form-control" name="heading_ar" id="heading_ar" placeholder="Enter Heading" required="required" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="tag_slug" class="col-12 col-form-label">Answer(Arabic)</label>
                        <div class="col-12">
                          <textarea class="form-control faq_textarea" rows="10" name="answer_ar" id="answer_ar" placeholder="Enter Answer" required="required" ></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                   <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="tag_status" class="col-12 col-form-label">Status</label>
                          <div class="col-12">
                            <select class="form-control" name="status" id="status" required="required">
                                <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="2">Delete</option>
                                <option value="3">Unpublished</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> Create FAQ</button>
                  <button type="reset" class="btn btn-danger float-right"><i class="fa fa-trash  " ></i> Reset</button>
                </div>
                <!-- /.card-footer -->
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
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
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/page/faq/add.blade.php ENDPATH**/ ?>