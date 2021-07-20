<?php $__env->startSection('content'); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Package Subscription Logs</h1>
      <ol class="breadcrumb">
       <li class="breadcrumb-item">
           <a href="<?php echo e(route('garage.dashboard')); ?>"><i class="fa fas fa-home"></i> Dashboard</a>
        </li>
         <li class="breadcrumb-item">
          <a href="<?php echo e(route('garage.customers.packages-subscribed')); ?>">Customers Package Subscription List</a></li>
        </li>
        <li class="breadcrumb-item active">Package Subscription Logs </li>
      </ol>
    </section>
   
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
              <div class="alert alert-success">
                  <?php echo e(session('status')); ?>

              </div>
          <?php endif; ?>
      </div>
    </div>

    
     
       <div class="box box-solid box-info">
        <div class="box-header">
         Package Subscription Logs : <?php echo e($ps->client->user->first_name . ' ' . $ps->client->user->last_name); ?>

       </div>
       
          <div class="box-body table-responsive">
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



<?php echo $__env->make('garage.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\g2g\Modules/Garage\Resources/views/customer/ps/logs.blade.php ENDPATH**/ ?>