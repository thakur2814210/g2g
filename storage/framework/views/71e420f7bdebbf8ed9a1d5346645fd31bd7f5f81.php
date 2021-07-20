<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('css'); ?>
   
<?php $__env->stopSection(); ?>


<?php $__env->startSection('breadcrumb'); ?>
   <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.dashboard')); ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.category.list')); ?>">Category List</a>
        </li>
     
        <li class="breadcrumb-item active">Edit Category</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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

    <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-gray">
              Edit: <?php echo e($categories->name); ?>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.category.update')); ?>" enctype="multipart/form-data">
                   <?php echo e(csrf_field()); ?>

                   <input type="hidden" name="id" value="<?php echo e($categories->id); ?>">
                <div class="card-body">

                    <div class="form-group row">
                      <label for="tag_name" class="col-sm-2 col-form-label">Name (English)</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name_en" id="name_en" value="<?php echo e($categories->name_en); ?>" required="required" />
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="tag_name" class="col-sm-2 col-form-label">Name (Arabic)</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name_ar" id="name_ar" value="<?php echo e($categories->name_ar); ?>" required="required" />
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="tag_slug" class="col-sm-2 col-form-label">Category Slug</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="slug" id="slug" value="<?php echo e($categories->slug); ?>" required="required" />
                        <p class="text-sm text-danger"> please eneter in small character and replace space with hyphen.</p>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="tag_slug" class="col-sm-2 col-form-label">Category Description</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="description" id="description" value="<?php echo e($categories->description); ?>" required="required" />
                      </div>
                    </div>

                    


                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Icon</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="cat_icon" id="cat_icon" value="<?php echo e($categories->cat_icon); ?>" required="required" />
                      </div>
                    </div>

                
                  <div class="form-group row">
                    <label for="tag_status" class="col-sm-2 col-form-label">Category Status</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="status" id="status" required="required">
                          <option value="1"  <?php if( $categories->status == 1): ?> selected <?php endif; ?> >Active</option>
                          <option value="3" <?php if( $categories->status == 3): ?> selected <?php endif; ?> >Unpublished</option>
                          <option value="2" <?php if( $categories->status == 2): ?> selected <?php endif; ?> >Delete</option>
                        </select>
                    </div>
                  </div>
                  
                </div>
              
                <div class="card-footer">
                  <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Update</button>
                  <button type="reset" class="btn btn-danger float-right"><i class="fa fa-trash  " ></i> Reset</button>
                </div>
              </form>
              </div>
            </div>
          </div>
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

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Admin/Resources/views/category/edit-category.blade.php ENDPATH**/ ?>