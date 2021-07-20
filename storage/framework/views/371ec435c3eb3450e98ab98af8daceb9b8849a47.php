<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.Add Currency')); ?> <small><?php echo e(trans('labels.Add Currency')); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i>
                    <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li><a href="<?php echo e(URL::to('admin/currencies/display')); ?>"><i
                        class="fa fa-gears"></i><?php echo e(trans('labels.Currency')); ?></a></li>
            <li class="active"><?php echo e(trans('labels.Add Currency')); ?></li>
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
                        <h3 class="box-title"><?php echo e(trans('labels.Add Currency')); ?> </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!-- form start -->
                                    <br>
                                    <?php if(count($errors) > 0): ?>
                                    <?php if($errors->any()): ?>
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo e($errors->first()); ?>

                                    </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(session()->has('success')): ?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <?php echo e(session()->get('success')); ?>

                                    </div>
                                    <?php endif; ?>
                                    <div class="box-body">

                                        <?php echo Form::open(array('url' =>'admin/currencies/add', 'method'=>'post', 'class'
                                        => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                        <div class="form-group">
                                            <label for="name"
                                                class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.title')); ?>

                                            </label>
                                            <div class="col-sm-10 col-md-4">
                                                <?php echo Form::text('title', '', array('class'=>'form-control
                                                field-validate', 'id'=>'title')); ?>

                                                <span class="help-block"
                                                    style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <?php echo e(trans('labels.title')); ?></span>
                                                <span
                                                    class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name"
                                                class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Country')); ?>

                                            </label>
                                            <div class="col-sm-10 col-md-4">
                                                <select class="form-control field-validate" name="code">
                                                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($currency->code); ?>"><?php echo e($currency->currency_name); ?>

                                                    </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="help-block"
                                            style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                            <?php echo e(trans('labels.Choose Country')); ?></span>
                                            </div>
                                            
                                            
                                        </div>

                                        <div class="form-group">
                                            <label for="name"
                                                class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.symbol')); ?>

                                            </label>
                                            <div class="col-sm-10 col-md-4">
                                                <?php echo Form::text('symbol', '', array('class'=>'form-control field-validate',
                                                'id'=>'symbol')); ?>

                                                <span class="help-block"
                                                    style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <?php echo e(trans('labels.symbol text')); ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name"
                                                class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Position')); ?></label>
                                            <div class="col-sm-10 col-md-4">
                                                <select class="form-control" name="position">
                                                    <option value="left"><?php echo e(trans('labels.Left')); ?></option>
                                                    <option value="right"><?php echo e(trans('labels.Right')); ?></option>
                                                </select>
                                                <span class="help-block"
                                            style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                            <?php echo e(trans('labels.Choose position of the currency')); ?></span>
                                            </div>
                                            
                                            
                                        </div>                                        

                                        <div class="form-group" style="display: none">
                                            <label for="name"
                                                class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.decimal_point')); ?>

                                            </label>
                                            <div class="col-sm-10 col-md-4">
                                                <?php echo Form::text('decimal_point', '', array('class'=>'form-control',
                                                'id'=>'decimal_point')); ?>

                                                <span class="help-block"
                                                    style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <?php echo e(trans('labels.decimal_point')); ?></span>
                                                <span
                                                    class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group" style="display: none">
                                            <label for="name"
                                                class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.thousands_point')); ?>

                                            </label>
                                            <div class="col-sm-10 col-md-4">
                                                <?php echo Form::text('thousands_point', '', array('class'=>'form-control',
                                                'id'=>'thousands_point')); ?>

                                                <span class="help-block"
                                                    style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <?php echo e(trans('labels.thousands_point')); ?></span>
                                                <span
                                                    class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name"
                                                class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.decimal_places')); ?>

                                            </label>
                                            <div class="col-sm-10 col-md-4">
                                                <?php echo Form::text('decimal_places', '', array('class'=>'form-control
                                                field-validate', 'id'=>'decimal_places')); ?>

                                                <span class="help-block"
                                                    style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <?php echo e(trans('labels.decimal_places')); ?></span>
                                                <span
                                                    class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name"
                                                class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.value')); ?>

                                            </label>
                                            <div class="col-sm-10 col-md-4">
                                                <?php echo Form::text('value', '', array('class'=>'form-control
                                                field-validate', 'id'=>'value')); ?>

                                                <span class="help-block"
                                                    style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <?php echo e(trans('labels.value')); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name"
                                                class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?></label>
                                            <div class="col-sm-10 col-md-4">
                                                <select class="form-control" name="status">
                                                    <option value="1"><?php echo e(trans('labels.Active')); ?></option>
                                                    <option value="0"><?php echo e(trans('labels.InActive')); ?></option>
                                                </select>
                                                <span class="help-block"
                                                    style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <?php echo e(trans('labels.StatusBannerText')); ?></span>
                                            </div>
                                        </div>

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit"
                                                class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                            <a href="<?php echo e(URL::to('admin/currencies/display')); ?>" type="button"
                                                class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/admin/currencies/add.blade.php ENDPATH**/ ?>