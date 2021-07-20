<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e($pageTitle); ?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e($pageTitle); ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-12">
          <?php if(session('status')): ?>
              <div class="alert alert-warning">
                  <?php echo e(session('status')); ?>

              </div>
          <?php endif; ?>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-12 form-inline" id="contact-form">
                    <a href="<?php echo e(route('superadmin.category.add')); ?>" class="pull-right">  
                      <button type="button" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-plus"></i> Add Category
                      </button>
                    </a>
                   </div>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                       <tr style="background: #e9ecef">
                        <th>Id</th>
                        <th>Type</th>
                        <th>Name(En)</th>
                        <th>Name(Ar)</th>
                        <th>Slug</th>
                        <th>Status</th>
                         <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                       <tr style="background: #e9ecef">
                           <th>Id</th>
                          <th>Type</th>
                          <th>Name</th>
                          <th>Slug</th>
                          <th>Status</th>
                         <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                     <?php if(!empty($categories) && count($categories) > 0): ?>
                      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($category->id); ?></td>
                          <td>
                            <?php if($category->type == 1): ?>
                              <span class="badge bg-green"><?php echo e(strtoupper('Quote')); ?></span>
                            <?php else: ?>
                              <span class="badge bg-blue"><?php echo e(strtoupper('Package')); ?></span>
                            <?php endif; ?>
                          </td>
                          <td><?php echo e($category->name_en); ?></td>
                          <td><?php echo e($category->name_ar); ?></td>
                          <td><?php echo e($category->slug); ?></td>
                          <td class="text-center">
                            <?php if($category->status == 1): ?>
                              <span class="badge bg-green">Active</span>
                            <?php elseif($category->status == 3): ?>
                              <span class="badge bg-blue">Unpublished</span>
                            <?php else: ?>
                              <span class="badge bg-red">Delete</span>
                            <?php endif; ?>
                          </td>
                          <td>
                               <a href="<?php echo e(route('superadmin.subcategory.list',['id' => $category->id])); ?>" title="Sub Category List"><button type="button" class="btn btn-sm btn-info"><i class="fa fa-fw fa-list"></i> SubCat</button></a>
                              <a href="<?php echo e(route('superadmin.category.edit',['id' => $category->id])); ?>" title="Edit Category"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></button></a>
                              <a href="<?php echo e(route('superadmin.category.delete',['id' => $category->id])); ?>" title="Delete Category"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></button></a>
                          </td>
                        </tr>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="6">
                            No Category Found.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
                <?php if(!empty($categories) && count($categories) > 0): ?>
                  <div class="col-xs-12 text-right">
                    <?php echo e($categories->links()); ?>

                  </div>
                 <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
 
              
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/category/category-list.blade.php ENDPATH**/ ?>