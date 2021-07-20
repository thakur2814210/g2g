<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('css'); ?>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
   <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.dashboard')); ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Privacy Policy</li>
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
                Privacy Policy
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.pages.update.content')); ?>" enctype="multipart/form-data">
                   <?php echo e(csrf_field()); ?>

                   <input type="hidden" name="page_type" value="privacy-policy">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="tag_slug" class="col-sm-12 col-form-label">Content(English)</label>
                      <div class="col-sm-12">
                        <textarea class="form-control faq_textarea" rows="12" name="privacy_policy_en" id="privacy_policy_en" placeholder="Enter Privacy Policy" required="required" ><?php if(!empty($privacyPolicy->privacy_policy_en)): ?> <?php echo e($privacyPolicy->privacy_policy_en); ?> <?php endif; ?></textarea>
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label for="tag_slug" class="col-sm-12 col-form-label">Content(Arabic)</label>
                      <div class="col-sm-12">
                        <textarea class="form-control faq_textarea" rows="12" name="privacy_policy_ar" id="privacy_policy_ar" placeholder="Enter Privacy Policy" required="required" ><?php if(!empty($privacyPolicy->privacy_policy_ar)): ?> <?php echo e($privacyPolicy->privacy_policy_ar); ?> <?php endif; ?></textarea>
                      </div>
                    </div>


                    <div class="text-center">
                      <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save" ></i> Privacy Policy</button>
                    </div>
                </div>
              </form>
              </div>
            </div>
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
           height: 300, 
        })
      })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/page/privacy-policy.blade.php ENDPATH**/ ?>