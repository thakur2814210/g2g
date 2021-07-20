<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Edit Testimonial</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.pages.testimonial')); ?>">Testimonial List</a>
        </li>
      <li class="active">Edit Testimonial</li>
    </ol>
  </section>

    <!-- Main content -->
  <section class="content">


    <div class="row">
          <div class="col-md-12">
            <div class="box box-solid box-info">
              <div class="box-header">
                Edit Testimonial
              </div>
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


                <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.pages.testimonial.update')); ?>" enctype="multipart/form-data">
                   <?php echo e(csrf_field()); ?>

                   <input type="hidden" name="id" value=<?php echo e($testimonials->id); ?> />
                  <div class="box-body">

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="tag_name" class="col-md-12 col-form-label">Name(English)</label>
                          <div class="col-md-12">
                            <input type="text" class="form-control" name="name_en" id="name_en" value="<?php echo e($testimonials->name_en); ?>" required="required" />
                          </div>
                        </div>
                        

                        <div class="form-group">
                          <label for="tag_slug" class="col-md-12 col-form-label">Designation(English)</label>
                          <div class="col-md-12">
                            <input type="text" class="form-control" name="designation_en" id="designation_en" value="<?php echo e($testimonials->designation_en); ?>" />
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="tag_slug" class="col-md-12 col-form-label">Remarks(English)</label>
                          <div class="col-md-12">
                            <textarea class="form-control faq_textarea" rows="5" name="remarks_en" id="remarks_en" required="required" ><?php echo e($testimonials->remarks_en); ?></textarea>
                          </div>
                        </div>
                      </div>

                       <div class="col-md-6">
                          <div class="form-group">
                            <label for="tag_name" class="col-md-12 col-form-label">Name(Arabic)</label>
                            <div class="col-md-12">
                              <input type="text" class="form-control" name="name_ar" id="name_ar" value="<?php echo e($testimonials->name_ar); ?>" required="required" />
                            </div>
                          </div>
                          

                          <div class="form-group">
                            <label for="tag_slug" class="col-md-12 col-form-label">Designation(Arabic)</label>
                            <div class="col-md-12">
                              <input type="text" class="form-control" name="designation_ar" id="designation_ar" value="<?php echo e($testimonials->designation_ar); ?>" />
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="tag_slug" class="col-md-12 col-form-label">Remarks(Arabic)</label>
                            <div class="col-md-12">
                              <textarea class="form-control faq_textarea" rows="5" name="remarks_ar" id="remarks_ar" required="required" ><?php echo e($testimonials->remarks_ar); ?></textarea>
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
                                  <option value="1" <?php if($testimonials->status == 1): ?> selected <?php endif; ?> >Active</option>
                                  <option value="2" <?php if($testimonials->status == 2): ?> selected <?php endif; ?>>Unpublished</option>
                              </select>
                            </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="tag_name" class="col-md-12 col-form-label">Ordering</label>
                            <div class="col-md-12">
                              <input type="number" class="form-control" name="ordering" id="ordering" value="<?php echo e($testimonials->ordering); ?>"/>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="exampleInputFile" class="col-md-12 col-form-label">Image</label>
                      <div class="input-group col-md-10">
                        <div class="custom-file ">
                          <input type="file"  id="image" name="image">
                        </div>
                      </div>
                    </div>

                    <?php if(!is_null($testimonials->image)): ?>
                     <div class="form-group row">
                      <label for="exampleInputFile" class="col-md-12 col-form-label">Existing Image</label>
                      <div class="input-group col-md-12">
                        <img src="<?php echo e(asset($testimonials->image)); ?>" height="80" width="80" />
                      </div>
                     </div>
                     <?php endif; ?>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save" ></i> Update Testimonial</button>
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

        CKEDITOR.replace('remarks_en');
         CKEDITOR.replace('remarks_ar');

        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/page/testimonial/edit.blade.php ENDPATH**/ ?>