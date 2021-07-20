<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Add New Service Package </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
        <li class="breadcrumb-item">
          <a href="<?php echo e(route('superadmin.service-package')); ?>">Service Packages List</a>
        </li>
      <li class="active">Add New Service Package</li>
    </ol>
  </section>

   <!-- Main content -->
  <section class="content">

    <div class="row">
          <div class="col-12">
            <div class="box">
               <div class="box-header">
                    <h3 class="box-title">Add New Service Package</h3>
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

                              <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.service-package.save')); ?>" enctype="multipart/form-data">
                                 <?php echo e(csrf_field()); ?>

                              <div class="card-body">

                                  <div class="form-group row">
                                    <label for="tag_status" class="col-sm-2 col-form-label">Package For</label>
                                    <div class="col-sm-10">
                                      <select class="form-control" name="package_for" id="package_for" required="required">
                                          <option value="">Select Package For</option>
                                          <option value="1">Client</option>
                                          <option value="2">Garage</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group row " id="select_category">
                                    <label for="tag_status" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                      <select class="form-control" name="section_id" id="section_id" >
                                          <option value="">Select category</option>
                                          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="tag_name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter Package Name" required="required" />
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="tag_slug" class="col-sm-2 col-form-label">Slug</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter Package Slug" required="required" />
                                      <p class="text-sm text-danger"> please eneter in small character and replace space with hyphen.</p>
                                    </div>

                                  </div>

                                  <div class="form-group row">
                                    <label for="tag_slug" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="description" id="description" placeholder="Enter Package Description" />
                                    </div>
                                  </div>

                                  

                                   <div class="form-group row">
                                    <label for="tag_slug" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="price" id="price" placeholder="Enter Package Price" required="required" />
                                    </div>
                                  </div>

                                   <div class="form-group row">
                                    <label for="tag_slug" class="col-sm-2 col-form-label">Promo Price</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="promo_price" id="promo_price" placeholder="Enter Package Promo Price" />
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="tag_slug" class="col-sm-2 col-form-label">Period</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="period" id="period" placeholder="Enter Package Period in days (15,30,365 example)" required="required" />
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
                                <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Create New Package</button>
                                <button type="reset" class="btn btn-danger float-right"><i class="fa fa-trash  " ></i> Reset</button>
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

<?php $__env->startSection('js'); ?>
   <script> 
        $('#select_category').show();
        $('#package_for').on('change', function() {
          if(this.value == 1){
             $('#select_category').show();
          }else{
            $('#select_category').hide();
          }
        });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/servicepackage/package-add.blade.php ENDPATH**/ ?>