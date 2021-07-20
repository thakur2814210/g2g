<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Service Request List</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active">Service Request List</li>
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
                          <th>Code</th>
                          <th>Category</th>
                          <th>User</th>
                          <th>Vehicle</th>
                          <th>Garage</th>
                          <th>Quote Amount</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                         <tr style="background: #e9ecef">
                            <th>Code</th>
                            <th>Category</th>
                            <th>User</th>
                            <th>Vehicle</th>
                            <th>Garage</th>
                            <th>Quote Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      <?php if(!empty($serviceRequests) && count($serviceRequests) > 0): ?>
                        <?php $__currentLoopData = $serviceRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            <td><?php echo e($serviceRequest->sr_code); ?></td>
                            <td><?php echo e($serviceRequest->category->name); ?></td>
                            <td><?php echo e($serviceRequest->client->username); ?></td>
                            <td><?php echo e($serviceRequest->vehicle->vmake->name); ?><br/>(<?php echo e($serviceRequest->vehicle->vmodel->name); ?>)</td>
                            <td><?php echo e($serviceRequest->garage->name); ?></td>
                             <td class="text-center">
                                <?php if(!empty($serviceRequest->quote_amount)): ?>
                                <?php echo e('AED '. $serviceRequest->quote_amount); ?>

                                <?php else: ?>
                                   <?php echo e(' Not Available '); ?>

                                <?php endif; ?>
                                   
                            </td>
                             <td class="text-center text-uppercase">
                               <?php echo e($serviceRequest->status); ?>

                              </td>
                            <td>
                               <a class="btn btn-sm btn-outline-danger "  href="<?php echo e(route('superadmin.service-requests.view',['id' => $serviceRequest->id])); ?>">
                                  Update
                                </a>
                            </td>
                           
                          </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="8">
                              No Service Request Found.
                          </td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                   <?php if(!empty($serviceRequests) && count($serviceRequests) > 0): ?>
                  <div class="col-xs-12 text-right">
                    <?php echo e($serviceRequests->links()); ?>

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


<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/servicerequest/index.blade.php ENDPATH**/ ?>