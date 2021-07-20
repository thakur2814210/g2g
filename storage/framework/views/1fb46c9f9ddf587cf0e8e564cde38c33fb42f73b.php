<?php $__env->startSection('content'); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Customers Packages Subscription List</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
        <li class="active">Customers Packages Subscription List</li>
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

 

     
      <div class="box box-danger">
          <div class="box-body">
            <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr style="background: #e9ecef">
                  <th>Date</th>
                  <th>Customer</th>
                  <th>Service Package</th>
                  <th>Amount</th>
                  <th>Duration</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef">
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Service Package</th>
                    <th>Amount</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th width="20%">Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php if(!empty($customers) && count($customers) > 0): ?>
                  <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e(date('M d, Y', strtotime($customer['created_at']))); ?></td>
                      <td><?php echo e($customer['client']['user']['first_name'] . ' ' .$customer['client']['user']['last_name']); ?></td>
                      <td><?php echo e($customer['servicePackage']['name']); ?></td>
                      <td>AED <?php echo e(number_format($customer['amount'] ,2)); ?></td>

                      <td>
                          <?php if(!empty($customer['subscription_start_at']) && !empty($customer['subscription_start_at'])): ?>
                            <?php echo e(date('M d, Y', strtotime($customer['subscription_start_at']))); ?> - <?php echo e(date('M d, Y', strtotime($customer['subscription_end_at']))); ?>

                          <?php else: ?>
                            <?php echo e('--'); ?>

                          <?php endif; ?>
                      </td>
                       <td class="text-uppercase">
                          <?php echo e($packageStatus[$customer['status']]); ?>

                      </td>
                      <td>
                          <?php if($customer['servicePackage']['slug'] == 'custom-package'): ?>
                            <a class="btn btn-sm btn-outline-danger" href="<?php echo e(route('garage.customers.packages-subscribed.custom.settings',['id' => $customer['id']])); ?>" title="Setting">Update</a>
                          <?php else: ?>
                            <a class="btn btn-sm btn-outline-danger" href="<?php echo e(route('garage.customers.packages-subscribed.settings',['id' => $customer['id']])); ?>" title="Setting">Update</a>
                          <?php endif; ?>
                          <a class="btn btn-sm btn-outline-danger" href="<?php echo e(route('garage.customers.packages-subscribed.logs',['id' => $customer['id']])); ?>" title="Logs">Log</a>
                      </td>
                    </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7">
                        No Customer package subscription found.
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
   

<?php $__env->stopSection(); ?>

<?php echo $__env->make('garage.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Garage/Resources/views/customer/packages-subscribed.blade.php ENDPATH**/ ?>