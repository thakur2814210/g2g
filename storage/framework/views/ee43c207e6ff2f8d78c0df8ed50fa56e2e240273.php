<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Testimonials</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active">Testimonials</li>
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
                    <a href="<?php echo e(route('superadmin.pages.testimonial.add')); ?>" class="pull-right">  
                      <button type="button" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-plus"></i> Add Testimonials
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
                          <th>Name</th>
                          <th>Designation)</th>
                          <th>Ordering</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(!empty($testimonials) && count($testimonials) > 0): ?>
                          <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($testimonial->id); ?></td>
                              <td><?php echo e($testimonial->name_en); ?> ( <?php echo e($testimonial->name_ar); ?> )</td>
                              <td><?php echo e($testimonial->designation_en); ?> ( <?php echo e($testimonial->designation_ar); ?> ) </td>
                              <td><?php echo e($testimonial->ordering); ?></td>
                              <td>
                                <?php if($testimonial->status == 1): ?>
                                  <span class=" text-success">Active</span>
                                <?php else: ?>
                                  <span class=" text-danger">Unpublished</span>
                                <?php endif; ?>
                              </td>
                              
                              <td>
                                  <a href="<?php echo e(route('superadmin.pages.testimonial.edit',['id' => $testimonial->id])); ?>">
                                    <button type="button" class="btn btn-sm btn-warning">
                                      <i class="fa fa-fw fa-edit"></i> Edit
                                    </button>
                                  </a>
                              </td>
                            </tr>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="5">
                                No Testimonial Found.
                            </td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                    <div class="row" style="padding: 20px;">
                       <?php if(!empty($testimonials) && count($testimonials) > 0): ?>
                         <?php echo e($testimonials->links()); ?>

                       <?php endif; ?>
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

<?php $__env->startSection('css'); ?>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/page/testimonial/index.blade.php ENDPATH**/ ?>