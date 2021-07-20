<?php $__env->startSection('title', 'Garage Dashboard'); ?>

<?php $__env->startSection('website_css'); ?>
  <style type="text/css">
     .box_text_tittle{
        font-size: 14px;color: #fff;font-weight: 600;
      }
  </style>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
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

      <!-- Breadcrumbs-->
      <ol class="breadcrumb padding_bottom">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>



    <div class="box_general padding_bottom">
       <!-- Icon Cards-->
      <div class="row">

        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-primary o-hidden">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-users text-dark"></i>
              </div>
              <div class="mr-5">
                <h5># <?php echo e($total_customer); ?> </h5>
              </div>
               <h6 class="text-white">Total Customers </h5>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-success o-hidden">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-users text-dark"></i>
              </div>
              <div class="mr-5">
                <h5>#   <?php echo e($sr_customer_count); ?> </h5>
              </div>
               <h6 class="text-white">Service Request</h6>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-primary o-hidden">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-car text-dark"></i>
              </div>
              <div class="mr-5">
                <h5># <?php echo e($ps_customer_count); ?> </h5>
              </div>
               <h6 class="text-white">Package Subscribed</h6>
            </div>
          </div>
        </div>
        
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-money text-dark"></i>
              </div>
             <div class="mr-5">
                <h5>AED <?php echo e($payments_recieved); ?> </h5>
              </div>
              <h6 class="text-white">Payments Recieved </h6>
            </div>
          </div>
        </div>

      </div> <!-- row ends -->

      
      <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Payemnt Recieved Per Month</div>
            <div class="card-body">
              <canvas id="myBarChart" width="100" height="50"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
        </div>
        <div class="col-lg-4">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Customers Type</div>
            <div class="card-body">
              <canvas id="myPieChart" width="100%" height="100"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
        </div>

  
   
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
   
   
    
  </div>
          
<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_js'); ?>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

     <script src="<?php echo e(asset('website-theme/admin/vendor/chart.js/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/js/admin-charts-all.js')); ?>"></script>

  
<?php $__env->stopSection(); ?>





<?php echo $__env->make('garage::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devhs/public_html/g2g-v3/Modules/Garage/Resources/views/dashboard/index.blade.php ENDPATH**/ ?>