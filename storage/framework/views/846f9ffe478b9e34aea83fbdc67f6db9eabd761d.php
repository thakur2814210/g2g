<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>FAQ</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active">FAQ</li>
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
                    <a href="<?php echo e(route('superadmin.pages.faq.add')); ?>" class="pull-right">  
                      <button type="button" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-plus"></i> Add FAQ
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
                          <th>Cat Name(En)</th>
                          <th>Cat Name(Ar)</th>
                          <th>Heading(En)</th>
                          <th>Heading(Ar)</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(!empty($faqs) && count($faqs) > 0): ?>
                          <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($faq->id); ?></td>
                              <td><?php echo e($faq->cat_name_en); ?></td>
                              <td><?php echo e($faq->cat_name_ar); ?></td>
                              <td><?php echo e($faq->heading_en); ?></td>
                              <td><?php echo e($faq->heading_ar); ?></td>
                              <td>
                                <?php if($faq->status == 1): ?>
                                  <span class=" text-success">Active</span>
                                <?php else: ?>
                                  <span class=" text-danger">Delete</span>
                                <?php endif; ?>
                              </td>
                              <td>
                                  <a href="<?php echo e(route('superadmin.pages.faq.edit',['id' => $faq->id])); ?>">
                                    <button type="button" class="btn btn-sm btn-warning">
                                      <i class="fa fa-fw fa-edit"></i> Edit
                                    </button>
                                  </a>
                              </td>
                            </tr>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="6">
                                No FAQ Found.
                            </td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                      <div class="row" style="padding: 20px;">
                         <?php if(!empty($faqs) && count($faqs) > 0): ?>
                           <?php echo e($faqs->links()); ?>

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

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/page/faq/index.blade.php ENDPATH**/ ?>