<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Sub-Section List</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.category.list')); ?>">Section List</a>
        </li>
      <li class="breadcrumb-item active">Sub-Section List</li>
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
                    <a href="<?php echo e(route('superadmin.subcategory.add')); ?>" class="pull-right">  
                      <button type="button" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-plus"></i>  Add Sub-Category
                      </button>
                    </a>
                   </div>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">

                  <table id="example1" class="table table-bordered">
                    <thead>
                       <tr style="background: #e9ecef">
                        <th>Id</th>
                        <th>Subsection</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Section</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                       <tr style="background: #e9ecef">
                        <th>Id</th>
                        <th>Subsection</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Section</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                     <?php if(!empty($categories) && count($categories) > 0): ?>

                      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($category->id); ?></td>
                          
                          <td><?php echo e($category->subsection_name_en); ?> <br/>( <?php echo e($category->subsection_name_ar); ?> )</td>
                          <td><?php echo e($category->slug); ?></td>
                          <td>
                            <?php if($category->status == 1): ?>
                              <span class="badge bg-green">Active</span>
                            <?php elseif($category->status == 3): ?>
                              <span class="badge bg-blue">unpublished</span>
                            <?php else: ?>
                              <span class="badge bg-red">Delete</span>
                            <?php endif; ?>
                          </td>
                          <td><?php echo e($category->section_name_en); ?> <br/> ( <?php echo e($category->section_name_ar); ?> ) </td>
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




<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/category/subcategory-list.blade.php ENDPATH**/ ?>