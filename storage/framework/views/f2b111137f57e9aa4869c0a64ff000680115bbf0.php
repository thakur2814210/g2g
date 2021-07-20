<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Edit Service Packages</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
        <li class="breadcrumb-item">
          <a href="<?php echo e(route('superadmin.service-package')); ?>">Edit Service Packages</a>
        </li>
      <li class="active">Edit Service Package</li>
    </ol>
  </section>



      <!-- Main content -->
  <section class="content">

     <div class="row">
          <div class="col-12">
            <div class="box">
               <div class="box-header">
                    <h3 class="box-title">Edit Service Package: <?php echo e($packages->name); ?></h3>
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

                    <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.service-package.update')); ?>" enctype="multipart/form-data">
                       <?php echo e(csrf_field()); ?>

                       <input type="hidden" name="id" value="<?php echo e($packages->id); ?>">
                    <div class="card-body">

                        <?php if($packages->package_for == 1): ?>
                          <div class="form-group row" id="select_category">
                            <label for="tag_status" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="section_id" id="section_id">
                                  <option value="">Select category</option>
                                  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php if( $packages->section_id ==  $category->id): ?> selected <?php endif; ?> ><?php echo e($category->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                            </div>
                          </div>
                        <?php endif; ?>
                      

                        <div class="form-group row">
                          <label for="tag_name" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo e($packages->name); ?>" required="required" />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="tag_slug" class="col-sm-2 col-form-label">Slug</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="slug" id="slug" value="<?php echo e($packages->slug); ?>" required="required" />
                            <p class="text-sm text-danger"> please eneter in small character and replace space with hyphen.</p>
                          </div>

                        </div>

                        <div class="form-group row">
                          <label for="tag_slug" class="col-sm-2 col-form-label">Description</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="description" id="description" value="<?php echo e($packages->description); ?>" />
                          </div>
                        </div>


                         <div class="form-group row">
                          <label for="tag_slug" class="col-sm-2 col-form-label">Price</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="price" id="price" value="<?php echo e($packages->price); ?>" required="required" />
                          </div>
                        </div>

                         <div class="form-group row">
                          <label for="tag_slug" class="col-sm-2 col-form-label">Promo Price</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="promo_price" id="promo_price" value="<?php echo e($packages->promo_price); ?>" />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="tag_slug" class="col-sm-2 col-form-label">Period</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="period" id="period" value="<?php echo e($packages->period); ?>" required="required" />
                          </div>
                        </div>


                        <div class="form-group row">
                          <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="status" id="status" required="required">
                                <option value="">Select</option>
                                <option value="1" <?php if( $packages->status == 1): ?> selected <?php endif; ?> >Active</option>
                                <option value="2" <?php if( $packages->status == 2): ?> selected <?php endif; ?> >Delete</option>
                                <option value="3" <?php if( $packages->status == 3): ?> selected <?php endif; ?> >Unpublished</option>
                            </select>
                          </div>
                        </div>
                      
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Update Service Package</button>
                    </div>
                    <!-- /.card-footer -->
                  </form>
                </div
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



<?php $__env->startSection('js'); ?>

  <script> 
        var file_cat_image_option = $("input[name='file_cat_image_option']:checked").val();
        if(file_cat_image_option == 'no-same-image'){
           $('#cat_image_div').hide();
        }

         $("input[type='radio']").click(function(){
            var file_cat_image_option1 = $("input[name='file_cat_image_option']:checked").val();
            if(file_cat_image_option1 == 'no-same-image'){
              $('#cat_image_div').hide();
            }else{
              $('#cat_image_div').show();
            }
        });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/servicepackage/package-edit.blade.php ENDPATH**/ ?>