<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Customers Service Request</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active">Customers Service Request</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-12">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
         <?php if(session('status')): ?>
              <div class="alert alert-success">
                  <?php echo e(session('status')); ?>

              </div>
          <?php endif; ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-danger">
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">
                    <table id="example1" class="table table-bordered table-striped">


         
              <thead>
                  <tr style="background: #e9ecef">
                  <th>#</th>
                  <th>Date</th>
                  <th>User</th>
                  <th>Code / Category</th>
                  <th>Quote Amount</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                 <tr style="background: #e9ecef"> 
                    <th>#</th>
                    <th>Date</th>
                    <th>User</th>
                    <th>Code / Category</th>
                    <th>Quote Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php if(!empty($customers) && count($customers) > 0): ?>
                  <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($index + 1); ?></td>
                      <td><?php echo e($customer['updated_at']); ?></td>
                       <td><?php echo e($customer['client']['username']); ?></td>
                      <td>
                           <?php echo e($customer['sr_code']  .'('.  $customer['category']['name'].')'); ?>

                      </td>
                       
                      <td>
                          <?php echo e((!empty($customer['quote_amount']) ? 'AED '. $customer['quote_amount'] : ' Not Available ' )); ?>

                      </td>
                    
                      <td class="text-uppercase">
                         <?php echo e($customer['status']); ?>

                      </td>
                      
                      <td>
                      
                        <a class="btn btn-sm btn-outline-danger "  href="<?php echo e(route('garage.customers.service-request.settings',['id' =>$customer['id'] ])); ?>">
                          Update
                        </a>
                        &nbsp;
                        <a  class="btn btn-sm btn-outline-danger" href="<?php echo e(route('garage.customers.service-request.logs',['id' =>$customer['id'] ])); ?>">
                          Log
                        </a>

                      </td>
                    </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7">
                        No records Found.
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

        </div>

       



<?php $__env->stopSection(); ?>


<?php $__env->startSection('website_js'); ?>

    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
  
    
    <script src="<?php echo e(asset('website-theme/admin/vendor/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/datatables/dataTables.bootstrap4.js')); ?>"></script>

    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery.selectbox-0.2.js')); ?>"></script>  
    <script src="<?php echo e(asset('website-theme/admin/vendor/retina-replace.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery.magnific-popup.min.js')); ?>"></script>
    

    <script src="<?php echo e(asset('website-theme/admin/js/admin-datatables.js')); ?>"></script>
    
    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
   
   
  
  
    

  
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('garage::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Garage/Resources/views/customer/service-request.blade.php ENDPATH**/ ?>