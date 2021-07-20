<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.ManageTransaction')); ?> <small><?php echo e($pageTitle); ?>...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.ManageTransaction')); ?></li>
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
                      <th><?php echo e(trans('labels.Name')); ?></th>
                      <th><?php echo e(trans('labels.Limit/Trx')); ?></th>
                      <th><?php echo e(trans('labels.Charge/Trx')); ?></th>
                      <th><?php echo e(trans('labels.Process Time')); ?></th>
                      <th><?php echo e(trans('labels.Action')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php if(count($result['admins']) > 0): ?>
                      <?php $__currentLoopData = $result['admins']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($admin->name); ?></td>
                          <td><b>
                            <?php echo e($admin->min_limit); ?> </b> TO <b><?php echo e($admin->max_limit); ?> 
                             <?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> 
                             <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?>
                          </b></td>
                          <td><b><?php echo e($admin->fixed_charge); ?> </b> + <b><?php echo e($admin->percentage_charge); ?> %</b></td>
                          <td><b><?php echo e($admin->process_time); ?></b></td>
                          
                          
                          <td>
                              <a href="javascript::void(0)" type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.WithdrawMoney')); ?>" id="WithdrawMoneyForm" withdraw_method_id="<?php echo e($admin->id); ?>"><?php echo e(trans('labels.WithdrawMoney')); ?></a>
                          </td>
                     </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="5"><?php echo e(trans('labels.NoRecordFound')); ?></td>
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

    <!-- /.row -->

    <!-- deleteCustomerModal -->
  <div class="modal fade" id="WithdrawMoneyFormModal" tabindex="-1" role="dialog" aria-labelledby="WithdrawMoneyFormModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="WithdrawMoneyFormModalLabel"><?php echo e(trans('labels.Request Money Withdraw')); ?></h4>
      </div>
      <?php echo Form::open(array('url' =>'admin/vendor/transactions/withdrawRequest/store', 'name'=>'WithdrawMoneyMethod', 'id'=>'WithdrawMoneyMethod', 'method'=>'post', 'class' => 'form-horizontal')); ?>

          <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

          <?php echo Form::hidden('withdraw_method_id', '', array('class'=>'form-control', 'id'=>'withdraw_method_id')); ?>

      <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label"><?php echo e(trans('labels.Amount')); ?> </label>
            <div class="col-sm-10">
              <?php echo Form::text('amount',  '', array('class'=>'form-control field-validate', 'id'=>'amount')); ?>

              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.Enter amount you want to withdraw')); ?></span>
              <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label"><?php echo e(trans('labels.Details')); ?> </label>
            <div class="col-sm-10">
              <?php echo Form::textarea('details',  '', array('class'=>'form-control field-validate', 'id'=>'details')); ?>

              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.Enter your details to process money transfer')); ?></span>
              <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
      <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Send Withdraw Request')); ?></button>
      </div>
      <?php echo Form::close(); ?>

    </div>
    </div>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/admin/withdraw/vendor/withdrawMoney.blade.php ENDPATH**/ ?>