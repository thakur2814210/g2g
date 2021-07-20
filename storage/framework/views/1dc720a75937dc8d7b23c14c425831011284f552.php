
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
                      <th><?php echo e(trans('labels.ShopName')); ?></th>
                      <th><?php echo e(trans('labels.Methods')); ?></th>
                      <th><?php echo e(trans('labels.Amount')); ?></th>
                      <th><?php echo e(trans('labels.Charge')); ?></th>
                       <th><?php echo e(trans('labels.Time')); ?></th>
                      <th><?php echo e(trans('labels.Status')); ?></th>
                      <th><?php echo e(trans('labels.TRX #')); ?></th>
                      <th><?php echo e(trans('labels.Details')); ?></th>                      
                    </tr>
                  </thead>
                  <tbody>
                   <?php if(count($result['admins']) > 0): ?>
          						<?php $__currentLoopData = $result['admins']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          							<tr>
          								<td><?php echo e($admin->id); ?></td>
          							 <td><?php echo e($admin->shop_name); ?></td>
                          <td>
                            <?php echo e($admin->first_name); ?> <?php echo e($admin->last_name); ?> 
                          </td>
                          <td>
                             <?php echo e($admin->email); ?> 
                          </td>
          							               

                        </td>
                                <td>
                                <?php if($admin->user_types_id==1): ?>
                                	<strong class="badge bg-green">
                                <?php else: ?>
                                	<strong class="badge bg-light-blue">
                                <?php endif; ?>
                                	<?php echo e($admin->user_types_name); ?></strong>
                                </td>
                                <td>
                                  <?php if($admin->isActive==1): ?>
                                    <strong class="badge bg-green"><?php echo e(trans('labels.Active')); ?> </strong>
                               	  <?php else: ?>
                                	<strong class="badge bg-light-grey"><?php echo e(trans('labels.InActive')); ?> </strong>
                                  <?php endif; ?>

                                </td>
								<td>
                                <ul class="nav table-nav">
                              <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                  <?php echo e(trans('labels.Action')); ?> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(URL::to('admin/editvendor')); ?>/<?php echo e($admin->id); ?>"><?php echo e(trans('labels.editvendor')); ?></a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteCustomerFrom" users_id="<?php echo e($admin->id); ?>"><?php echo e(trans('labels.Delete')); ?></a></li>
                                </ul>
                              </li>
                            </ul>
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

    <!-- /.row -->

    <!-- deleteCustomerModal -->
	<div class="modal fade" id="deleteCustomerModal" tabindex="-1" role="dialog" aria-labelledby="deleteCustomerModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="deleteCustomerModalLabel"><?php echo e(trans('labels.deleteVendor')); ?></h4>
		  </div>
		  <?php echo Form::open(array('url' =>'admin/deletevendor', 'name'=>'deleteAdmin', 'id'=>'deleteAdmin', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

				  <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

				  { <?php echo Form::hidden('users_id', '', array('class'=>'form-control', 'id'=>'users_id')); ?>

		  <div class="modal-body">
			  <p><?php echo e(trans('labels.Are you sure you want to delete this vendor')); ?></p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
			<button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Delete')); ?></button>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/admin/vendors/index.blade.php ENDPATH**/ ?>