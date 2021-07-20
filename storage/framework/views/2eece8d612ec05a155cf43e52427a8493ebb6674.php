<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Service Package List </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active">Service Package List</li>
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
                    <a href="<?php echo e(route('superadmin.service-package.add')); ?>" class="pull-right">  
                      <button type="button" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-plus"></i> Add Service Package
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
                            <th>For</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Price / Period</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                           <tr style="background: #e9ecef">
                            <th>Id</th>
                            <th>For</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Price / Period</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                         <?php if(!empty($packages) && count($packages) > 0): ?>
                          <?php
                              $allCategory = [];
                              foreach($categories as $category){
                                $allCategory[$category->id] = $category->name;
                              }
                              //dump($allCategory);
                          ?>
                          <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($package->id); ?></td>
                              <td >
                                <?php if($package->package_for == 1): ?>
                                  <span class="read">Client</span>
                                <?php elseif($package->package_for == 2): ?>
                                  <span class="pending">Garage</span>
                                <?php endif; ?>
                              </td>
                              <td>
                                  <?php echo e(isset($allCategory[$package->section_id ]) 
                                  ? $allCategory[$package->section_id ] 
                                  : 'N/A'); ?>

                              </td>
                              <td><?php echo e($package->name); ?></td>
                              <td ><?php echo e($package->price); ?> / <?php echo e($package->period); ?> Days</td>
                              <td >
                                <?php if($package->status == 1): ?>
                                  <span class="read">Active</span>
                                <?php elseif($package->status == 3): ?>
                                  <span class="pending">Unpublished</span>
                                <?php else: ?>
                                  <span class="unread">Delete</span>
                                <?php endif; ?>
                              </td>
                              
                              <td>
                                  <a href="<?php echo e(route('superadmin.service-package.features',['id' => $package->id ])); ?>" title="Feature List"><button type="button" class="btn btn-sm btn-info"><i class="fa fa-fw fa-list"></i> Feature</button></a>
                                  
                                  <a href="<?php echo e(route('superadmin.service-package.edit',['id' => $package->id ])); ?>" title="Edit Package">
                                    <button type="button" class="btn btn-sm btn-warning">
                                      <i class="fa fa-fw fa-edit"></i>
                                    </button>
                                  </a>
                                  
                                  <a href="<?php echo e(route('superadmin.service-package.delete',['id' => $package->id ])); ?>" title="Delete Package"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></button></a>
                              </td>
                            </tr>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="11">
                                No Package Found.
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


<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/servicepackage/package-list.blade.php ENDPATH**/ ?>