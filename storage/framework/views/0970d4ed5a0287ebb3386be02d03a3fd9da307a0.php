<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Add Sub-Section </h1>
     <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.dashboard')); ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.category.list')); ?>">Section List</a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.subcategory.list')); ?>">Sub-Section List</a>
        </li>
        <li class="breadcrumb-item active">Add Sub-Section</li>
    </ol>
  </section>





  <!-- Main content -->
  <section class="content">



    <div class="row">
          <div class="col-12">
            <div class="box">
               <div class="box-header">
                    <h3 class="box-title">Add Sub Section</h3>
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
                <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.subcategory.save')); ?>" enctype="multipart/form-data">
                   <?php echo e(csrf_field()); ?>

                <div class="box-body">

                    <div class="form-group row">
                      <label for="tag_status" class="col-sm-2 col-form-label">Category</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="parent" id="parent" required="required">
                            <option value="">Select Category</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="tag_name" class="col-sm-2 col-form-label">Name (English)</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name_en" id="name_en" placeholder="Enter Sub Category Name (English)" required="required" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="tag_name" class="col-sm-2 col-form-label">Name (Arabic)</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="Enter Sub Category Name (Arabic)" required="required" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="tag_slug" class="col-sm-2 col-form-label">Slug</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter Sub Category Slug" required="required" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="tag_slug" class="col-sm-2 col-form-label">Description</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="description" id="description" placeholder="Enter Sub Category Description" required="required" />
                      </div>
                    </div>


              

                  <div class="form-group row">
                    <label for="tag_status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="status" id="status" required="required">
                          <option value="">Select</option>
                          <option value="1">Active</option>
                          <option value="3">Unpublished</option>
                          <option value="2">Delete</option>
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

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/category/add-subcategory.blade.php ENDPATH**/ ?>