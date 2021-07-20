
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
     <h1> <?php echo e($pageTitle); ?> <small><?php echo e($pageTitle); ?>...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li><a href="<?php echo e(URL::to('admin/vendors/active')); ?>"><i class="fa fa-users"></i> <?php echo e(trans('labels.Active Vendors')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.EditVendor')); ?></li>
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
            <h3 class="box-title"><?php echo e(trans('labels.EditVendor')); ?> </h3>
          </div> 

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              		<div class="box box-info">
                        <br>

                        <?php if(session()->has('message')): ?>
                            <div class="alert alert-success" role="alert">
						  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo e(session()->get('message')); ?>

                            </div>
                        <?php endif; ?>

                        <?php if(session()->has('errorMessage')): ?>
                            <div class="alert alert-danger" role="alert">
						  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo e(session()->get('errorMessage')); ?>

                            </div>
                        <?php endif; ?>

                        <!-- form start -->
                         <div class="box-body">
                            <?php echo Form::open(array('url' =>'admin/updatevendor', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                            <?php echo Form::hidden('myid', $result['myid'], array('id'=>'myid')); ?>

                          <div class="form-group">
                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.ShopName')); ?> </label>
                                <div class="col-sm-10 col-md-4">
                                  <?php echo Form::text('shop_name', $result['admins'][0]->shop_name, array('class'=>'form-control field-validate', 'id'=>'shop_name')); ?>

                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.ShopNameText')); ?></span>
                                  <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                </div>
                              </div>
                            <hr>
                            <h4><?php echo e(trans('labels.Personal Info')); ?> </h4>
                            <hr>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.FirstName')); ?> </label>
                                  <div class="col-sm-10 col-md-4">
                                    <?php echo Form::text('first_name',  $result['admins'][0]->first_name, array('class'=>'form-control field-validate', 'id'=>'first_name')); ?>

                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.FirstNameText')); ?></span>
                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.LastName')); ?> </label>
                                  <div class="col-sm-10 col-md-4">
                                    <?php echo Form::text('last_name',  $result['admins'][0]->last_name, array('class'=>'form-control field-validate', 'id'=>'last_name')); ?>

                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.lastNameText')); ?></span>
                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Telephone')); ?></label>
                                  <div class="col-sm-10 col-md-4">
                                    <?php echo Form::text('phone',  $result['admins'][0]->phone, array('class'=>'form-control', 'id'=>'phone')); ?>

                                   <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                   <?php echo e(trans('labels.TelephoneText')); ?></span>
                                  </div>
                                </div>
                                <hr>
                                <h4><?php echo e(trans('labels.Login Info')); ?></h4>
                                <hr>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.EmailAddress')); ?> </label>
                                  <div class="col-sm-10 col-md-4">
                                     <?php echo Form::text('email',  $result['admins'][0]->email, array('class'=>'form-control email-validate', 'id'=>'email')); ?>

                                     <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                     <?php echo e(trans('labels.EmailText')); ?></span>
                                    <span class="help-block hidden"> <?php echo e(trans('labels.EmailError')); ?></span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.changePassword')); ?></label>
                                  <div class="col-sm-10 col-md-4">
                                    <?php echo Form::checkbox('changePassword', 'yes', null, ['class' => '', 'id'=>'change-passowrd']); ?>

                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Password')); ?></label>
                                  <div class="col-sm-10 col-md-4">
                                    <?php echo Form::password('password', array('class'=>'form-control', 'id'=>'password')); ?>

                	                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                   <?php echo e(trans('labels.PasswordText')); ?></span>
                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?> </label>
                                  <div class="col-sm-10 col-md-4">
                                    <select class="form-control" name="isActive">
                                          <option value="1" <?php if($result['admins'][0]->status==1): ?> selected <?php endif; ?>><?php echo e(trans('labels.Active')); ?></option>
                                          <option value="3" <?php if($result['admins'][0]->status==3): ?> selected <?php endif; ?>><?php echo e(trans('labels.Inactive')); ?></option>
                                           <option value="2" <?php if($result['admins'][0]->status==2): ?> selected <?php endif; ?>><?php echo e(trans('labels.Pending')); ?></option>
									</select>
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                  <?php echo e(trans('labels.StatusText')); ?></span>
                                  </div>
                                </div>

                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                <a href="<?php echo e(URL::to('admin/vendors/active')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
                              </div>
                              <!-- /.box-footer -->
                            <?php echo Form::close(); ?>

                        </div>
                  </div>
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

    <!-- Main row -->

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/admin/vendors/edit.blade.php ENDPATH**/ ?>