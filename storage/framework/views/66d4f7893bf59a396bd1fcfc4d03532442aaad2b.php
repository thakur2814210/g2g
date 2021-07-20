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
        <li class="breadcrumb-item active">Add Category</li>
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
                Add New Category
              </div>
              
              <div class="card-body table-responsive p-0">
                <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.category.save')); ?>" enctype="multipart/form-data">
                   <?php echo e(csrf_field()); ?>

                  <div class="card-body">

                    <div class="form-group row">
                      <label for="tag_name" class="col-sm-2 col-form-label">Name (English)</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name_en" id="name_en" placeholder="Enter Category Name (English)" required="required" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="tag_name" class="col-sm-2 col-form-label">Name (Arabic)</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="Enter Category Name (Arabic)" required="required" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="tag_slug" class="col-sm-2 col-form-label">Slug</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter Category Slug" required="required" />
                        <p class="text-sm text-danger"> please eneter in small character and replace space with hyphen.</p>
                      </div>

                    </div>

                    <div class="form-group row">
                      <label for="tag_slug" class="col-sm-2 col-form-label">Description</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="description" id="description" placeholder="Enter Category Description" required="required" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="tag_status" class="col-sm-2 col-form-label">Category Type</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="type" id="type" required="required">
                            <option value="">Select category type</option>
                            <option value="1">Quote</option>
                            <option value="2">Package</option>
                        </select>
                      </div>
                    </div>


                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Icon</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="cat_icon" id="cat_icon" placeholder="Enter Category Fa Icon" required="required" />
                      </div>
                    </div>

                 
                    <div class="form-group row">
                      <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="status" id="status" required="required">
                            <option value="">Select</option>
                            <option value="1">Active</option>
                            <option value="2">Delete</option>
                            <option value="3">Unpublished</option>
                        </select>
                      </div>
                    </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Save</button>
                  <button type="submit" class="btn btn-danger float-right"><i class="fa fa-trash  " ></i> Reset</button>
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


<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Admin/Resources/views/category/add-category.blade.php ENDPATH**/ ?>