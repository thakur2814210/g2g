
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.Customers')); ?> <small><?php echo e(trans('labels.ListingAllCustomers')); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li class="active"><?php echo e(trans('labels.Customers')); ?></li>
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
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6 form-inline" id="contact-form">
                                    <form name='registration' id="registration" class="registration" method="get" action="<?php echo e(url('admin/customers/filter')); ?>">
                                        <input type="hidden" value="<?php echo e(csrf_token()); ?>">
                                        <!--div class="input-group-btn search-panel "-->
                                        <div class="input-group-form search-panel ">
                                            <select type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" name="FilterBy" id="FilterBy">
                                                <option value="" selected disabled hidden>Filter By</option>
                                                <option value="Name" <?php if(isset($filter)): ?> <?php if($filter=="Name" ): ?> <?php echo e('selected'); ?> <?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Name')); ?></option>
                                                <option value="E-mail" <?php if(isset($filter)): ?> <?php if($filter=="E-mail" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Email')); ?></option>
                                                <option value="Phone" <?php if(isset($filter)): ?> <?php if($filter=="Phone" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Phone')); ?></option>
                                                <!--option value="Address" <?php if(isset($filter)): ?> <?php if($filter=="Address" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Address')); ?></option>
                                                <option value="Postcode" <?php if(isset($filter)): ?> <?php if($filter=="Postcode" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Postcode')); ?></option>
                                                <option value="City" <?php if(isset($filter)): ?> <?php if($filter=="City" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.City')); ?></option>
                                                <option value="State" <?php if(isset($filter)): ?> <?php if($filter=="State" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.State')); ?></option>
                                                <option value="Country" <?php if(isset($filter)): ?> <?php if($filter=="Country" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Country')); ?></option-->
                                            </select>
                                            <input type="text" class="form-control input-group-form " name="parameter" placeholder="Search term..." id="parameter" <?php if(isset($parameter)): ?> value="<?php echo e($parameter); ?>" <?php endif; ?>>
                                            <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                            <?php if(isset($parameter,$filter)): ?> <a class="btn btn-danger " href="<?php echo e(url('admin/customers/display')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
                                        </div>
                                    </form>
                                    <div class="col-lg-4 form-inline" id="contact-form12"></div>
                                </div>
                                <div class="box-tools pull-right">
                                    <a href="<?php echo e(url('admin/customers/add')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
                                </div>
                            </div>
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
                                <!-- prev was  example1 -->
                                <table id="customer_datatable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('id', trans('labels.ID')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('first_name', trans('labels.Full Name')));?> </th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('email', trans('labels.Email')));?> </th>
                                            <th><?php echo e(trans('labels.Phone')); ?> </th>
                                            <th><?php echo e(trans('labels.Status')); ?> </th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($customers['result'])): ?>
                                        <?php $__currentLoopData = $customers['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$listingCustomers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($listingCustomers->id); ?></td>
                                            <td><?php echo e($listingCustomers->first_name); ?> <?php echo e($listingCustomers->last_name); ?></td>
                                            <td><?php echo e($listingCustomers->email); ?></td>
                                            <td>                                               
                                                <strong><?php echo e(trans('labels.Phone')); ?>: </strong> <?php echo e($listingCustomers->phone); ?> <br>
                                                
                                            </td>
                                             <td>
                                                <?php if($listingCustomers->status == 1): ?>
                                                    <span class="text-success"><?php echo e(trans('labels.Active')); ?></span>
                                                <?php else: ?>
                                                    <span class="text-danger"><?php echo e(trans('labels.Inactive')); ?></span>
                                                <?php endif; ?>
                                             </td>

                                            <!--td>
                                                <?php if(!empty($listingCustomers->entry_street_address)): ?>
                                                <?php echo e($listingCustomers->entry_street_address); ?>,
                                                <?php endif; ?>
                                                <?php if(!empty($listingCustomers->entry_city)): ?>
                                                <?php echo e($listingCustomers->entry_city); ?>,
                                                <?php endif; ?>
                                                <?php if(!empty($listingCustomers->entry_state)): ?>
                                                <?php echo e($listingCustomers->zone_name); ?>,
                                                <?php endif; ?>
                                                <?php if(!empty($listingCustomers->entry_postcode)): ?>
                                                <?php echo e($listingCustomers->entry_postcode); ?>

                                                <?php endif; ?>
                                                <?php if(!empty($listingCustomers->countries_name)): ?>
                                                <?php echo e($listingCustomers->countries_name); ?>

                                                <?php endif; ?>

                                            </td-->
                                            <td>
                                                <ul class="nav table-nav">
                                                    <li class="dropdown">
                                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                            <?php echo e(trans('labels.Action')); ?> <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(url('admin/customers/edit')); ?>/<?php echo e($listingCustomers->id); ?>"><?php echo e(trans('labels.EditCustomers')); ?></a></li>
                                                            <li role="presentation" class="divider"></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(url('admin/customers/address/display/'.$listingCustomers->id)); ?>"><?php echo e(trans('labels.EditAddress')); ?></a></li>
                                                            <li role="presentation" class="divider"></li>
                                                            <li role="presentation"><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteCustomerFrom"
                                                                  users_id="<?php echo e($listingCustomers->id); ?>"><?php echo e(trans('labels.Delete')); ?></a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="4"><?php echo e(trans('labels.NoRecordFound')); ?></td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                
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
                        <h4 class="modal-title" id="deleteCustomerModalLabel"><?php echo e(trans('labels.Delete')); ?></h4>
                    </div>
                    <?php echo Form::open(array('url' =>'admin/customers/delete', 'name'=>'deleteCustomer', 'id'=>'deleteCustomer', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                    <?php echo Form::hidden('action', 'delete', array('class'=>'form-control')); ?>

                    <?php echo Form::hidden('users_id', '', array('class'=>'form-control', 'id'=>'users_id')); ?>

                    <div class="modal-body">
                        <p><?php echo e(trans('labels.DeleteCustomerText')); ?></p>
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
<?php $__env->startSection('js'); ?>

<!--https://code.jquery.com/jquery-3.5.1.js -->

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css" />
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
        $('#customer_datatable').DataTable();
    } );  
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/admin/customers/index.blade.php ENDPATH**/ ?>