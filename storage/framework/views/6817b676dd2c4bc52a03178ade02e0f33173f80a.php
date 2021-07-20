<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Garage Packages Subscription List</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active">Garage Packages Subscription List</li>
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
                     <form>
               <div class="form-group">
                <span>Status Filter:</span>
                 <select class="custom-select mr-sm-2" id="f_status" name="f_status">
                    <option value="all">All</option>
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="cancel">Cancel</option>
                    <option value="inactive">InActive</option>
                    <option value="request-payment">Request-payment</option>
                     <option value="received-payment">Received-Paymentt</option>
                    <option value="required-payment-approval">Required-Payment-Approval</option>
                  </select>
              </div>
              </form>
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
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Package</th>
                            <th>Garage</th>
                            <th>Username</th>
                             <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                         <tr style="background: #e9ecef">
                            <th>Id</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Package</th>
                            <th>Garage</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      <?php if(!empty($subscriptions) && count($subscriptions) > 0): ?>
                        <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                              <td><?php echo e($subscription->id); ?></td>
                              <td><?php echo e($subscription->updated_at); ?></td>
                              <td>AED <?php echo e(number_format($subscription->amount, 2)); ?></td>
                              <td><?php echo e($subscription->servicePackage->name); ?></td>
                              <td><?php echo e($subscription->garage->defaultGarageDescription[0]->garages_name); ?></td>
                              <td><?php echo e($subscription->garage->username); ?></td>
                              <td>
                                  <?php if($subscription->status == 1): ?>
                                    Active
                                  <?php elseif($subscription->status == 2): ?>
                                    Cancel
                                  <?php elseif($subscription->status == 3): ?>
                                    Pending
                                  <?php elseif($subscription->status == 4): ?>
                                    Inactive
                                  <?php elseif($subscription->status == 5): ?>
                                    Request-Payemnt
                                  <?php elseif($subscription->status == 6): ?>
                                    Received-Payment
                                  <?php elseif($subscription->status == 7): ?>
                                    Required-Payment-Approval
                                  <?php endif; ?>
                              </td>
                              <td>
                                 <a class="btn btn-sm btn-outline-danger "  href="<?php echo e(route('superadmin.subscriptions.garages.settings',['id' => $subscription->id])); ?>">
                                    Update
                                  </a>
                                  &nbsp;
                                  <a  class="btn btn-sm btn-outline-danger" href="<?php echo e(route('superadmin.subscriptions.garages.logs',['id' => $subscription->id])); ?>">
                                    Logs
                                  </a>
                              </td>
                          </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="8">
                              No Active Subscription Found.
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


<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/subscription/garage_list.blade.php ENDPATH**/ ?>