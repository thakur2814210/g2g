<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Service Package Feature </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active">Service Package Feature</li>
    </ol>
  </section>

   <!-- Main content -->
  <section class="content">

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
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-12 form-inline" id="contact-form">
                    <a href="<?php echo e(route('superadmin.service-package.features.add')); ?>" class="pull-right">  
                      <button type="button" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-plus"></i> Service Package Feature
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
                          <th>Code</th>
                          <th>Service Package</th>
                          <th>Name</th>
                          <th width="30%">Value</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                         <tr style="background: #e9ecef">
                          <th>Id</th>
                          <th>Code</th>
                          <th>Service Package</th>
                          <th>Name</th>
                          <th width="30%">Value</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                    <tbody>
                      <?php if(!empty($packagefeatures) && count($packagefeatures) > 0): ?>

                       <?php
                            $allPackages = [];
                            foreach($packages as $val){
                              $allPackages[$val->id] = $val->slug;
                            }
                        ?>
                       

                        <?php $__currentLoopData = $packagefeatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pakagefeature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            <td><?php echo e($pakagefeature->id); ?></td>
                            <td><?php echo e($pakagefeature->pf_code); ?></td>
                            <td>
                              <?php echo e(isset($allPackages[$pakagefeature->service_package_id]) ? $allPackages[$pakagefeature->service_package_id] : 'N/A'); ?>

                            </td>
                            <td><?php echo e($pakagefeature->feature_name); ?></td>
                            <td><?php echo e($pakagefeature->feature_value); ?></td>
                            
                            <td class="text-center">
                              <?php if($pakagefeature->status == 1): ?>
                                <span class="read">Active</span>
                              <?php else: ?>
                                <span class="unread">Disable</span>
                              <?php endif; ?>
                            </td>
                            
                            <td>
                                <a href="<?php echo e(route('superadmin.service-package.features.edit' ,['id' => $pakagefeature->id])); ?>" title="Edit Package"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button></a>
                                <a href="<?php echo e(route('superadmin.service-package.features.delete' ,['id' => $pakagefeature->id])); ?>" title="Delete Package"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>
                            </td>
                          </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="7">
                              No Package Fetuare Found.
                          </td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
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
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
  
    
    <script src="<?php echo e(asset('website-theme/admin/vendor/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.js')); ?>"></script>

    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery.selectbox-0.2.js')); ?>"></script>  
    <script src="<?php echo e(asset('website-theme/admin/vendor/retina-replace.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery.magnific-popup.min.js')); ?>"></script>
    

     <script src="<?php echo e(asset('website-theme/admin/js/admin-datatables.js')); ?>"></script>

   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/servicepackage/package-features.blade.php ENDPATH**/ ?>