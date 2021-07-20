<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Pending Garage/Vendor</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
       <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.active')); ?>">Active Garage/Vendor</a>
        </li>
         <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.delete')); ?>">Delete Garage/Vendor</a>
        </li>
      <li class="active">Pending Garage/Vendor</li>
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
        <div class="box box-danger">
          <div class="box-header">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-12 form-inline" id="contact-form">
                    <a href="<?php echo e(route('superadmin.garage.add')); ?>" class="pull-right">  
                      <button type="button" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-plus"></i> Add Garage
                      </button>
                    </a>
                   </div>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">
                    <table id="garage_datatable" class="table table-bordered table-striped">
                    <thead>
                       <tr>
                        <th>Id</th>
                         <th>Type</th>
                        <th>Garage Name</th>
                        <th>Garage Address</th>
                        <th>Username</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    </tfoot>
                    <tbody>
                     <?php if(!empty($garages) && count($garages) > 0): ?>
                      <?php $__currentLoopData = $garages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($garage->id); ?></td>
                          <td>
                            <?php if($garage->type == 1): ?>
                              <?php echo e('Garage'); ?>

                            <?php elseif($garage->type == 2): ?>
                              <?php echo e('Shop Vendor'); ?>

                            <?php elseif($garage->type == 3): ?>
                              <?php echo e('Garage & Shop Vendor'); ?>

                            <?php endif; ?>
                          </td>
                          <td><?php echo e($garage->garages_name); ?></td>
                          <td><?php echo e($garage->address); ?></td>
                          <td><?php echo e($garage->username); ?></td>
                          <td>

                              <ul class="nav table-nav">
                                  <li class="dropdown">
                                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                          <?php echo e(trans('labels.Update')); ?> <span class="caret"></span>
                                      </a>
                                      <ul class="dropdown-menu">
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(route('superadmin.garage.edit',['id' => $garage->id])); ?>">Information</a></li>

                                          <li role="presentation" class="divider"></li>

                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(route('superadmin.garage.working-hours.view',['id' => $garage->id])); ?>">Working Hours</a></li>

                                          <li role="presentation" class="divider"></li>

                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(route('superadmin.garage.services.view',['id' => $garage->id])); ?>">Services</a></li>

                                          <li role="presentation" class="divider"></li>

                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(route('superadmin.garage.team.view',['id' => $garage->id])); ?>">Members</a></li>

                                          <li role="presentation" class="divider"></li>

                                           <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(route('superadmin.garage.image.view',['id' => $garage->id])); ?>">Images</a></li>

                                          <li role="presentation" class="divider"></li>
                                          
                                           <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(route('superadmin.garage.video.view',['id' => $garage->id])); ?>">Videos</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </td>
                        </tr>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="6">
                            No records found.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<!--https://code.jquery.com/jquery-3.5.1.js -->

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css" />
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
        $('#garage_datatable').DataTable();
    } );  
</script>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Admin/Resources/views/garage/garage-pending-list.blade.php ENDPATH**/ ?>