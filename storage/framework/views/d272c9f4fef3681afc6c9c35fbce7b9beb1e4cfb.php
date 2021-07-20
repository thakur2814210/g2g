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
          <div class="box-header">
            <h3 class="box-title"><?php echo e($pageTitle); ?></h3>
            <div class="box-tools pull-right">
              <a href="<?php echo e(URL::to('admin/transactions/withdrawMethod/add')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.addnew')); ?></a>
            </div>
          </div>
          
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
                      <th><?php echo e(trans('labels.Status')); ?></th>
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
          							  <td><?php if($admin->deleted == 1): ?> <b class="text-red"><?php echo e(trans('labels.disable')); ?> </b> <?php else: ?> <b class="text-success"><?php echo e(trans('labels.enable')); ?></b> <?php endif; ?></b></td>
          							  
								          <td>
                                <ul class="nav table-nav">
                              <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                  <?php echo e(trans('labels.Action')); ?> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(URL::to('admin/transactions/withdrawMethod/edit')); ?>/<?php echo e($admin->id); ?>"><?php echo e(trans('labels.Edit')); ?></a></li>
                                    <li role="presentation" class="divider"></li>

                                    <?php if($admin->deleted == 1): ?>
                                      <li role="presentation"><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.enable')); ?>" id="enableWithdrawMethodForm" enable_withdraw_method_id="<?php echo e($admin->id); ?>"><?php echo e(trans('labels.enable')); ?></a></li>
                                    <?php else: ?>
                                       <li role="presentation"><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.disable')); ?>" id="disableWithdrawMethodForm" disable_withdraw_method_id="<?php echo e($admin->id); ?>"><?php echo e(trans('labels.disable')); ?></a></li>
                                    <?php endif; ?>
                                </ul>
                              </li>
                            </ul>
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
	<div class="modal fade" id="enableWithdrawMethodModal" tabindex="-1" role="dialog" aria-labelledby="enableWithdrawMethodModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="enableWithdrawMethodModalLabel"><?php echo e(trans('labels.Enable Withdraw Method')); ?></h4>
		  </div>
		  <?php echo Form::open(array('url' =>'admin/transactions/withdrawMethod/enable', 'name'=>'enableWithdrawMethod', 'id'=>'enableWithdrawMethod', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

				  <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

				  <?php echo Form::hidden('enable_withdraw_method_id', '', array('class'=>'form-control', 'id'=>'enable_withdraw_method_id')); ?>

		  <div class="modal-body">
			  <p><?php echo e(trans('labels.Are you sure you want to enable this withdraw method')); ?> ?</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
			<button type="submit" class="btn btn-primary"><?php echo e(trans('labels.enable')); ?></button>
		  </div>
		  <?php echo Form::close(); ?>

		</div>
	  </div>
	</div>

  <div class="modal fade" id="disableWithdrawMethodModal" tabindex="-1" role="dialog" aria-labelledby="disableWithdrawMehodLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="disableWithdrawMehodLabel"><?php echo e(trans('labels.Disable Withdraw Method')); ?></h4>
      </div>
      <?php echo Form::open(array('url' =>'admin/transactions/withdrawMethod/delete', 'name'=>'disableWithdrawMethod', 'id'=>'disableWithdrawMethod', 'method'=>'post', 'class' => 'form-horizontal')); ?>

          <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

          <?php echo Form::hidden('disable_withdraw_method_id', '', array('class'=>'form-control', 'id'=>'disable_withdraw_method_id')); ?>

      <div class="modal-body">
        <p><?php echo e(trans('labels.Are you sure you want to disable this withdraw method')); ?>?</p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
      <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.disable')); ?></button>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/admin/withdraw/withdrawMethod.blade.php ENDPATH**/ ?>