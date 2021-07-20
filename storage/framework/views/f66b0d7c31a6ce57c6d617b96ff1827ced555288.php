<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Edit Section</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.category.list')); ?>">Section List</a>
        </li>
      <li class="active">Edit Section</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

     <div class="row">
          <div class="col-12">
            <div class="box">
               <div class="box-header">
                    <h3 class="box-title"> Edit: <?php echo e($categories->name); ?></h3>
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
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.category.update')); ?>" enctype="multipart/form-data">
                       <?php echo e(csrf_field()); ?>

                       <input type="hidden" name="id" value="<?php echo e($categories->id); ?>">
                    <div class="box-body">

                        <div class="form-group">
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

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/category/edit-category.blade.php ENDPATH**/ ?>