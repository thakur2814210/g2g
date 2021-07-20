<?php $__env->startSection('content'); ?>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Vehicle Make List</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active">Vehicle Make List</li>
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
                    <a href="<?php echo e(route('superadmin.settings.vehicle-make.add')); ?>" class="pull-right">  
                      <button type="button" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-plus"></i> Vehicle Make
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
                          <th>Active</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                         <tr style="background: #e9ecef">
                          <th>Id</th>
                          <th>Name</th>
                          <th>Active</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      <?php if(!empty($lists) && count($lists) > 0): ?>
                        <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            	<td><?php echo e($list->id); ?></td>
                             	<td><?php echo e($list->name); ?></td>
                             	<td><?php echo e(($list->active) ? 'Yes' : 'No'); ?></td>
                              <td>
                                <a href="<?php echo e(route('superadmin.settings.vehicle-make.edit',['id' => $list->id])); ?>">
                                  <button type="button" class="btn btn-sm btn-warning">
                                    <i class="fa fa-fw fa-edit"></i> Edit
                                  </button>
                                </a>
                                 <a href="<?php echo e(route('superadmin.settings.vehicle-make.delete',['id' => $list->id])); ?>">
                                  <button type="button" class="btn btn-sm btn-danger">
                                    <i class="fa fa-fw fa-times"></i> Delete
                                  </button>
                                </a>
                              </td>
                          </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="5">
                              No Vehicle Make Found.
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

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin_bk/Resources/views/general-setting/vehicle-make-list.blade.php ENDPATH**/ ?>