<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Customers Package Subscription Payment</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active">Customers Package Subscription Payment</li>
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
              <div class="alert alert-success">
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
                            <option value="success">Success</option>
                            <option value="failed">Failed</option>
                            <option value="pending">Pending</option>
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
                          <tr>
                           <th>Date</th>
                          <th>Amount</th>
                          <th>Commission</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                          <tr>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Commission</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <?php if(!empty($clientPackageSubscribes) && count($clientPackageSubscribes) > 0): ?>
                          <?php $__currentLoopData = $clientPackageSubscribes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clientPackageSubscribe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                               <td><?php echo e(date('Y-m-d', strtotime($clientPackageSubscribe->date))); ?></td>
                              <td>AED <?php echo e(number_format($clientPackageSubscribe->amount,2)); ?></td>
                              <td>
                                <?php
                                      $commission_amount = $commission->client_package_subscription;
                                      if($commission_amount > 0)
                                        $f_amount = (float) ($clientPackageSubscribe->amount / $commission_amount);
                                      else
                                        $f_amount = 0;
                                ?>
                                AED <?php echo e(number_format($f_amount,2)); ?>


                              </td>
                              <td>
                                   <?php if($clientPackageSubscribe->status == 1): ?>
                                      Success
                                    <?php elseif($clientPackageSubscribe->status == 2): ?>
                                      Failed
                                    <?php elseif($clientPackageSubscribe->status == 3): ?>
                                      Pending
                                    <?php elseif($clientPackageSubscribe->status == 4): ?>
                                      Required-Payment-Approval
                                    <?php endif; ?>
                              </td>
                               <td>
                                <a class="btn btn-sm btn-outline-danger "  href="<?php echo e(route('superadmin.subscriptions.clients.settings',['id' => $clientPackageSubscribe->id])); ?>">
                                  Manage
                                </a>
                              </td>
                              
                            </tr>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="4">
                                No payment Found.
                            </td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                    <?php if(!empty($clientPackageSubscribes) && count($clientPackageSubscribes) > 0): ?>
                  <div class="col-xs-12 text-right">
                    <?php echo e($clientPackageSubscribes->links()); ?>

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


<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/transaction/customers_package_subscription.blade.php ENDPATH**/ ?>