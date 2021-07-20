<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('css'); ?>
   <link rel="stylesheet" href="<?php echo e(asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.css')); ?>">
   <style type="text/css">
     select.form-control:not([size]):not([multiple]){
      height: 30px;
     }
     .form-control-sm, .input-group-sm>.form-control, .input-group-sm>.input-group-addon, .input-group-sm>.input-group-btn>.btn{
        padding: .25rem .5rem !important;
     }
   </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
   <ol class="breadcrumb">
       <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.dashboard')); ?>">Dashboard</a>
        </li>
         <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.clients.delete-list')); ?>">Delete Customers List</a>
        </li>
         <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.clients.pending-list')); ?>">Pending Customers List</a>
        </li>
        <li class="breadcrumb-item active">Active Customers List</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
      <div class="col-12">
          <?php if(session('status')): ?>
              <div class="alert alert-warning">
                  <?php echo e(session('status')); ?>

              </div>
          <?php endif; ?>
      </div>
    </div>

     <div class="box_general padding_bottom">
        <div class="header_box version_2">
          <h2  class="text-danger"><i class="fa fa-users text-danger"></i> Active Customer List</h2>
          <a href="<?php echo e(route('superadmin.client.add')); ?>" class="float-right">  
            <button type="button" class="btn btn-outline-danger"><i class="fa fa-fw fa-plus"></i>Add Customers</button>
          </a>
        </div>
         <div class="card-body table-responsive">
            <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                 <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
               <tr>
                  <th>Id</th>
                  <th>Username</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
            <?php if(!empty($clients) && count($clients) > 0): ?>
              <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($client->id); ?></td>
                   <td><a href="<?php echo e(route('superadmin.client.details.view',['id' => $client->id])); ?>"><?php echo e($client->username); ?></a></td>
                  <td><?php echo e((!empty($client->first_name)) ? $client->first_name : '-'); ?> <?php echo e((!empty($client->last_name)) ? $client->last_name : '-'); ?></td>
                  <td><?php echo e($client->email); ?></td>
                  <td><?php echo e($client->phone); ?></td>
                  <td>
                       <a href="<?php echo e(route('superadmin.client.details',['action' => 'edit','id' => $client->id])); ?>" title="Edit Customer Settings">
                        <button type="button" class="btn btn-sm btn-outline-danger">Update</button>
                      </a>
                  </td>
                </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
              <tr>
                <td colspan="6">
                    No Active Customers Found.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <?php echo $__env->make('admin::modals.client-status-change', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
  
    
    <script src="<?php echo e(asset('website-theme/admin/vendor/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.js')); ?>"></script>

    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery.selectbox-0.2.js')); ?>"></script>  
    <script src="<?php echo e(asset('website-theme/admin/vendor/retina-replace.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery.magnific-popup.min.js')); ?>"></script>
    

     <script src="<?php echo e(asset('website-theme/admin/js/admin-datatables.js')); ?>"></script>

      <script >
    $(document).ready(function() {

      $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {

        var data_id = '';

        if (typeof $(this).data('id') !== 'undefined') {

          data_id = $(this).data('id');
        }

        $('#modal_client_id').val(data_id);
      })
    });
     </script>
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Admin/Resources/views/client/client-active-list.blade.php ENDPATH**/ ?>