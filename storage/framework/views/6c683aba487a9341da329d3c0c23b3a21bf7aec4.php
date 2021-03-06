
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  <?php echo e(trans('labels.units')); ?> <small><?php echo e(trans('labels.ListingUnits')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"> <?php echo e(trans('labels.units')); ?></li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><?php echo e(trans('labels.ListingUnits')); ?> </h3>
                            <div class="box-tools pull-right">
                                <a href="<?php echo e(URL::to('admin/addunit')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddUnit')); ?></a>
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
                                            <th><?php echo e(trans('labels.ID')); ?></th>
                                            <th><?php echo e(trans('labels.UnitName')); ?></th>
                                            <th><?php echo e(trans('labels.Status')); ?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($result['units'])>0): ?>
                                            <?php $__currentLoopData = $result['units']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($unit->unit_id); ?></td>
                                                    <td><?php echo e($unit->units_name); ?></td>
                                                    <td>
                                                        <?php if($unit->is_active==1): ?>
                                                            <strong class="badge bg-light-blue"><?php echo e(trans('labels.Active')); ?></strong>
                                                        <?php else: ?>
                                                            <strong class="badge bg-light-red"><?php echo e(trans('labels.InActive')); ?></strong>
                                                        <?php endif; ?></td>
                                                    <td><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Edit')); ?>" href="editunit/<?php echo e($unit->unit_id); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteUnitsId" unit_id ="<?php echo e($unit->unit_id); ?>" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="3"  style="text-transform:none"><strong><?php echo e(trans('labels.Units are not added yet')); ?></strong></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">
                                        <?php echo e($result['units']->links()); ?>

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
            <!-- deleteOrderStatusModal -->
            <div class="modal fade" id="deleteUnitModal" tabindex="-1" role="dialog" aria-labelledby="deleteUnitsModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteOrderStatusModalLabel"><?php echo e(trans('labels.DeleteUnit')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/deleteunit', 'name'=>'deleteunits', 'id'=>'deleteunits', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'unit_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.DeleteUnitText')); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deleteUnits"><?php echo e(trans('labels.Delete')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>

            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/admin/settings/general/units/index.blade.php ENDPATH**/ ?>