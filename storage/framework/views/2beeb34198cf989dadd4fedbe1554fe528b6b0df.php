<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Edit FAQ</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.pages.faq')); ?>">FAQ List</a>
        </li>
      <li class="active">Edit FAQ</li>
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

               <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.pages.faq.update')); ?>" enctype="multipart/form-data">
                   <?php echo e(csrf_field()); ?>

                   <input type="hidden" name="id" value="<?php echo e($faqs->id); ?>">
                <div class="box-body">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="tag_name" class="col-md-12 col-form-label">Category Name(English)</label>
                        <div class="col-md-12">
                          <input type="text" class="form-control" name="cat_name_en" id="cat_name_en" placeholder="Enter Category Name" value="<?php echo e($faqs->cat_name_en); ?>" required="required" />
                        </div>
                      </div>
                      

                      <div class="form-group">
                        <label for="tag_slug" class="col-md-12 col-form-label">Heading(English)</label>
                        <div class="col-md-12">
                          <input type="text" class="form-control" name="heading_en" id="heading_en" placeholder="Enter Heading" value="<?php echo e($faqs->heading_en); ?>"  required="required" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="tag_slug" class="col-md-12 col-form-label">Answer(English)</label>
                        <div class="col-md-12">
                        

                           <textarea id="answer_en" name="answer_en" required="required" class="form-control" rows="5"><?php echo e($faqs->answer_en); ?></textarea>
                        </div>
                      </div>
                    </div>
                 
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="tag_name" class="col-md-12 col-form-label">Category Name(Arabic)</label>
                        <div class="col-md-12">
                          <input type="text" class="form-control" name="cat_name_ar" id="cat_name_ar" placeholder="Enter Category Name" value="<?php echo e($faqs->cat_name_ar); ?>" required="required" />
                        </div>
                      </div>
                      

                      <div class="form-group">
                        <label for="tag_slug" class="col-md-12 col-form-label">Heading(Arabic)</label>
                        <div class="col-md-12">
                          <input type="text" class="form-control" name="heading_ar" id="heading_ar" placeholder="Enter Heading" value="<?php echo e($faqs->heading_ar); ?>" required="required" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="tag_slug" class="col-md-12 col-form-label">Answer(Arabic)</label>
                        <div class="col-md-12">
                           <textarea id="answer_ar" name="answer_ar" required="required" class="form-control" rows="5"><?php echo e($faqs->answer_ar); ?></textarea>
                         
                        </div>
                      </div>
                    </div>
                  </div>

                   <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="tag_status" class="col-md-12 col-form-label">Status</label>
                          <div class="col-md-12">
                            <select class="form-control" name="status" id="status" required="required">
                                <option value="1" <?php if($faqs->status == 1): ?> selected <?php endif; ?>>Active</option>
                                <option value="2" <?php if($faqs->status == 2): ?> selected <?php endif; ?>>Delete</option>
                                <option value="3" <?php if($faqs->status == 3): ?> selected <?php endif; ?>>Unpublished</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> Update FAQ</button>
                 
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


<?php $__env->startSection('js'); ?>
    

    <script type="text/javascript">
    $(function() {

        CKEDITOR.replace('answer_ar');
         CKEDITOR.replace('answer_en');

        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();

    });
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/page/faq/edit.blade.php ENDPATH**/ ?>