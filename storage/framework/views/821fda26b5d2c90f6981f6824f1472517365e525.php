<?php $__env->startSection('content'); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Garage Transaction</h1>
      <ol class="breadcrumb">
       <li class="breadcrumb-item">
          <a href="<?php echo e(route('client.dashboard')); ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Garage Transaction</li>
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


     
       <div class="box">
          <!--div class="row">

            <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>AED <?php echo e(number_format( ($cps_total_amount + $sr_total_amount) , 2)); ?></h3>
                        <p>Total Amount</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3>AED <?php echo e(number_format($cps_total_amount,2)); ?></h3>
                        <p>Package Subscritpion Amount</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>

             <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>AED <?php echo e(number_format($sr_total_amount,2)); ?></h3>
                        <p>Service Request Amount</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>
          </div--> 

          <div class="row">
            <div class="col-md-6">
              <div class="box-header"><i class="fa fa-list"></i> Package Subscription Payments</div>
              <div class="box-body">
               <div class="table-responsive">
                 <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                       <tr>
                        <th>Record #</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                          <th>Record #</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Status</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php if(!empty($cps_payments) && count($cps_payments) > 0): ?>
                        <?php $__currentLoopData = $cps_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            <td>
                              <?php if($list->is_custom == 1): ?>
                                <a class="btn btn-sm btn-outline-danger" href="<?php echo e(route('garage.customers.packages-subscribed.custom.settings',['id' => $list->id ])); ?>">View # <?php echo e($list->id); ?></a>
                              <?php else: ?>
                                <a class="btn btn-sm btn-outline-danger" href="<?php echo e(route('garage.customers.packages-subscribed.settings',['id' => $list->id ])); ?>">View # <?php echo e($list->id); ?></a>
                              <?php endif; ?>
                            </td>
                            <td><?php echo e($list->date); ?></td>
                            <td>AED <?php echo e(number_format($list->amount, 2)); ?></td>
                            <td>
                              <?php if($list->status == 1): ?>
                                Success
                              <?php elseif($list->status == 3): ?>
                                Failed
                              <?php else: ?>
                                Pending
                              <?php endif; ?>
                            </td>
                          </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="4">
                              No Payemnt History Found.
                          </td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="box-header"><i class="fa fa-list"></i> Service Request Payments</div>
                 <div class="box-body">
                <div class="table-responsive">
                 <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                       <tr>
                        <th>Record #</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                           <th>Record #</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php if(!empty($csr_payments) && count($csr_payments) > 0): ?>
                        <?php $__currentLoopData = $csr_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                          <td> 
                            <a class="btn btn-sm btn-outline-danger "  href="<?php echo e(route('garage.customers.service-request.settings',['id' => $list->id ])); ?>">
                              View # <?php echo e($list->id); ?>

                            </a>
                          </td>
                           <td><?php echo e($list->date); ?></td>
                            <td>AED <?php echo e(number_format($list->amount, 2)); ?></td>
                            <td>
                              <?php if($list->status == 1): ?>
                                Success
                              <?php elseif($list->status == 3): ?>
                                Failed
                              <?php else: ?>
                                Pending
                              <?php endif; ?>
                            </td>
                          </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="4">
                              No Payemnt History Found.
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
      </section>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('garage.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Garage/Resources/views/payment/index.blade.php ENDPATH**/ ?>