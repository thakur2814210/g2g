<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Garage Package Subscription Logs</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="breadcrumb-item">
          <a href="<?php echo e(route('superadmin.subscriptions.garages.list')); ?>">Garage Package Subscription List</a></li>
      <li class="active">Garage Package Subscription Logs</li>
    </ol>
  </section>

   
   <section class="content">
   
    
     
        <div class="box box-danger">
        <div class="box-header">
         <i class="fa fa-file"></i> <?php echo e($ps->garage->name); ?> Subscription Logs
       </div>
       
          <div class="box-body">
            <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr style="background: #e9ecef">
                  <th>Date</th>
                  <th>Description</th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef">
                    <th width="15%">Date</th>
                    <th>Description</th>
                </tr>
              </tfoot>
              <tbody>
                <?php if(!empty($logs) && count($logs) > 0): ?>
                  <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e(date('M d, Y', strtotime($log->date))); ?></td>
                      <td><?php echo e($log->description); ?></td>
                    </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="3">
                        No logs Found.
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
   

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/subscription/garage_logs.blade.php ENDPATH**/ ?>