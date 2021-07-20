<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.Manage Vendors')); ?> <small><?php echo e($pageTitle); ?>...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.Manage Vendors')); ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->

    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">

          <?php if(count($errors) > 0): ?>
            <?php if($errors->any()): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo e($errors->first()); ?>

            </div>
            <?php endif; ?>
          <?php endif; ?>
              </div>

            </div>
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th><?php echo e(trans('labels.ID')); ?></th>
                      <th><?php echo e(trans('labels.TRX #')); ?></th>
                      <th><?php echo e(trans('labels.ShopName')); ?></th>
                      <th><?php echo e(trans('labels.Methods')); ?></th>
                      <th><?php echo e(trans('labels.Amount')); ?></th>
                      <th><?php echo e(trans('labels.Charge')); ?></th>
                       <th><?php echo e(trans('labels.Time')); ?></th>
                      <th><?php echo e(trans('labels.Status')); ?></th>
                      <th><?php echo e(trans('labels.Action')); ?></th>                       
                    </tr>
                  </thead>
                  <tbody>
                   <?php if(count($result['admins']) > 0): ?>
                      <?php $__currentLoopData = $result['admins']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($admin->id); ?></td>
                          <td><?php echo e($admin->trx); ?> </td>
                          <td><?php echo e($admin->shop_name); ?></td>
                          <td><?php echo e($admin->name); ?> </td>
                          <td><?php echo e($admin->amount); ?> </td>
                          <td><?php echo e($admin->charge); ?> </td>
                          <td><?php echo e(date('l jS \\of F Y h:i:s A' , strtotime($admin->created_at))); ?></td>
                          <td>
                            <?php if($admin->status== 'pending'): ?>
                              <strong class="badge bg-yellow">
                            <?php elseif($admin->status== 'refunded'): ?>
                              <strong class="badge bg-blue">
                            <?php elseif($admin->status== 'processed'): ?>
                              <strong class="badge bg-green">
                            <?php endif; ?>
                              <?php echo e($admin->status); ?></strong>
                          </td>
                          <td>
                              <a href="<?php echo e(URL::to('admin/transactions/withdrawLog')); ?>/<?php echo e($admin->id); ?>" type="button" class="btn btn-sm btn-primary" ><?php echo e(trans('labels.Details')); ?></a>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      <tr>
                       <td colspan="9"><?php echo e(trans('labels.NoRecordFound')); ?></td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
                <?php if(count($result['admins']) > 0): ?>
                  <div class="col-xs-12 text-right">
                    <?php echo e($result['admins']->links()); ?>

                  </div>
                 <?php endif; ?>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>

    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content notificationContent">

    </div>
    </div>
  </div>

    <!-- Main row -->

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/admin/withdraw/refundedLog.blade.php ENDPATH**/ ?>