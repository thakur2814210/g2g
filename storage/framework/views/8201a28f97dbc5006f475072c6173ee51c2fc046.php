<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('css'); ?>
   <link rel="stylesheet" href="<?php echo e(asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.css')); ?>">
   <style type="text/css">
     select.form-control:not([size]):not([multiple]){
      height: 30px;
     }
     .form-control-sm, .input-group-sm>.form-control, .input-group-sm>.input-group-addon, .input-group-sm>.input-group-btn>.btn{
        padding: .25rem .5rem !important;
     }
   </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('breadcrumb'); ?>
   <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.dashboard')); ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.category.list')); ?>">Category List</a>
        </li>
        <li class="breadcrumb-item active">Sub-Category List</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
      <div class="col-12">
          <?php if(session('status')): ?>
              <div class="alert alert-warning">
                  <?php echo e(session('status')); ?>

              </div>
          <?php endif; ?>
      </div>
    </div>

                
              <div class="box_general padding_bottom">
                <div class="header_box version_2">
                  <h2  class="text-danger"><i class="fa fa-users text-danger"></i>  Category List</h2>
                     Sub-Category List
                     <a href="<?php echo e(route('superadmin.subcategory.add')); ?>" class="float-right">  
                        <button type="button" class="btn btn-default btn-sm">
                          <i class="fa fa-fw fa-plus"></i> Add Sub-Category
                        </button>
                      </a>
                </div>
                 <div class="table-responsive">
                 <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                       <tr style="background: #e9ecef">
                        <th>Id</th>
                        <th>Parent Cat</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                       <tr style="background: #e9ecef">
                        <th>Id</th>
                        <th>Parent Cat</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                     <?php if(!empty($categories) && count($categories) > 0): ?>

                      <?php
                          $allCategory = [];
                          foreach($parent_cats as $category){
                            $allCategory[$category->id] = $category->name;
                          }
                         // dump($allCategory);
                      ?>

                      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($category->id); ?></td>
                           <td><?php echo e($allCategory[$category->parent ]); ?></td>
                          <td><?php echo e($category->name); ?></td>
                          <td><?php echo e($category->slug); ?></td>
                          <td>
                            <?php if($category->status == 1): ?>
                              <span class="read">Active</span>
                            <?php elseif($category->status == 3): ?>
                              <span class="unread">unpublished</span>
                            <?php else: ?>
                              <span class="unread">Delete</span>
                            <?php endif; ?>
                          </td>
                          <td>
                              <a href="<?php echo e(route('superadmin.subcategory.edit',['id' => $category->id])); ?>"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></button></a>
                              <a href="<?php echo e(route('superadmin.subcategory.delete',['id' => $category->id])); ?>"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></button></a>
                          </td>
                        </tr>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="9">
                            No Sub Category Found.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
  
    
    <script src="<?php echo e(asset('website-theme/admin/vendor/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.js')); ?>"></script>

    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery.selectbox-0.2.js')); ?>"></script>  
    <script src="<?php echo e(asset('website-theme/admin/vendor/retina-replace.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery.magnific-popup.min.js')); ?>"></script>
    

     <script src="<?php echo e(asset('website-theme/admin/js/admin-datatables.js')); ?>"></script>

   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Admin/Resources/views/category/subcategory-list.blade.php ENDPATH**/ ?>