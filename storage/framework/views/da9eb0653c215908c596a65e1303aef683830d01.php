
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e($pageTitle); ?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e($pageTitle); ?></li>
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
                            
                            <div class="input-group-form search-panel ">
                                <select type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" name="FilterBy" id="FilterBy">
                                    <option value="" selected disabled hidden>Filter By</option>
                                    <option value="Name" <?php if(isset($filter)): ?> <?php if($filter=="Name" ): ?> <?php echo e('selected'); ?> <?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Name')); ?></option>
                                    <option value="E-mail" <?php if(isset($filter)): ?> <?php if($filter=="E-mail" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Email')); ?></option>
                                    <option value="Phone" <?php if(isset($filter)): ?> <?php if($filter=="Phone" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Phone')); ?></option>
                                    <option value="Address" <?php if(isset($filter)): ?> <?php if($filter=="Address" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Address')); ?></option>
                                    <!-- <option value="Suburb" <?php if(isset($filter)): ?> <?php if($filter=="Suburb" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Suburb')); ?></option> -->
                                    <option value="Postcode" <?php if(isset($filter)): ?> <?php if($filter=="Postcode" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Postcode')); ?></option>
                                    <option value="City" <?php if(isset($filter)): ?> <?php if($filter=="City" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.City')); ?></option>
                                    <option value="State" <?php if(isset($filter)): ?> <?php if($filter=="State" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.State')); ?></option>
                                    <option value="Country" <?php if(isset($filter)): ?> <?php if($filter=="Country" ): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Country')); ?></option>
                                </select>
                                <input type="text" class="form-control input-group-form " name="parameter" placeholder="Search term..." id="parameter" <?php if(isset($parameter)): ?> value="<?php echo e($parameter); ?>" <?php endif; ?>>
                                <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                <?php if(isset($parameter,$filter)): ?> <a class="btn btn-danger " href="<?php echo e(url('admin/customers/display')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
                            </div>
                        </form>
                        <div class="col-lg-4 form-inline" id="contact-form12"></div>
                    </div>
                    <div class="box-tools pull-right">
                        <a href="<?php echo e(url('admin/g2g/section/add')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr style="background: #e9ecef">
                      <th><?php echo e(trans('labels.ID')); ?></th>
                      <th><?php echo e(trans('labels.Type')); ?></th>
                     <th><?php echo e(trans('labels.Name')); ?></th>
                     <th><?php echo e(trans('labels.Slug')); ?></th>
                     <th><?php echo e(trans('labels.Status')); ?></th>
                     <th><?php echo e(trans('labels.Action')); ?></th>    
                   </tr>
                 </thead>
                 <tfoot>
                    <tr style="background: #e9ecef">
                      <th><?php echo e(trans('labels.ID')); ?></th>
                      <th><?php echo e(trans('labels.Type')); ?></th>
                       <th><?php echo e(trans('labels.Name')); ?></th>
                       <th><?php echo e(trans('labels.Slug')); ?></th>
                       <th><?php echo e(trans('labels.Status')); ?></th>
                       <th><?php echo e(trans('labels.Action')); ?></th>    
                   </tr>
                 </tfoot>
                 
                  <tbody>
                    <?php if(!empty($categories) && count($categories) > 0): ?>
                      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($category->id); ?></td>
                          <td>
                            <?php if($category->type == 1): ?>
                              <span class="badge bg-green"><?php echo e(strtoupper('Quote')); ?></span>
                            <?php else: ?>
                              <span class="badge bg-light-blue"><?php echo e(strtoupper('Package')); ?></span>
                            <?php endif; ?>
                          </td>

                          <td><?php echo e($category->sections_name); ?></td>
                          <td><?php echo e($category->slug); ?></td>
                                      
                          <td>
                            <?php if($category->status == 1): ?>
                              <strong class="badge bg-green">Active</strong>
                            <?php elseif($category->status == 3): ?>
                            <strong class="badge bg-light-blue">Unpublished</strong>
                            <?php else: ?>
                              <strong class="badge bg-danger">Delete</strong>
                            <?php endif; ?>
                          </td>
                          
                          <td>
                                <ul class="nav table-nav">
                              <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                  <?php echo e(trans('labels.Action')); ?> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(URL::to('admin/editvendor')); ?>/<?php echo e($category->id); ?>"><?php echo e(trans('labels.editvendor')); ?></a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteCustomerFrom" users_id="<?php echo e($category->id); ?>"><?php echo e(trans('labels.Delete')); ?></a></li>
                                </ul>
                              </li>
                            </ul>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="6"><?php echo e(trans('labels.NoRecordFound')); ?></td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
                <?php if(!empty($categories) && count($categories) > 0): ?>
                  <div class="col-xs-12 text-right">
                    <?php echo e($categories->links()); ?>

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

          {<?php echo Form::hidden('users_id', '', array('class'=>'form-control', 'id'=>'users_id')); ?>

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

  
  </section>
  <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/resources/views/g2g/sections/section-list.blade.php ENDPATH**/ ?>