
<div style="padding: 5px;">
  <div style="width: 100%; display: block">
    <h2><?php echo e(trans('labels.OrderID')); ?># <?php echo e($data->ps_code); ?> 
    <h3><?php echo e(trans('labels.OrderedDate')); ?>: <?php echo e(date('m/d/Y', strtotime($data->created_at))); ?></h3>
  </div>
  
  <!-- info row -->
  <div style="width: 100%;padding: 0 0 20px;">
    <div > <strong><?php echo e(trans('labels.CustomerInfo')); ?>:</strong>
      <address>
      <span style="text-transform: capitalize;"><?php echo e($data->customers_name); ?></span><br>
      <?php echo e($data->customers_street_address); ?> <br>
        <?php echo e($data->customers_city); ?>, <?php echo e($data->customers_postcode); ?>, <?php echo e($data->customers_country); ?><br>
        <?php echo e(trans('labels.Phone')); ?>: <?php echo e($data->customers_telephone); ?><br>
        <?php echo e(trans('labels.Email')); ?>: <?php echo e($data->email); ?>

      </address>
    </div>
    <br/>
    <br/>
    <div> <strong><?php echo e(trans('labels.PackageInfo')); ?>:</strong>
      <address>
        <span style="text-transform: capitalize;">
         <?php echo e(trans('labels.Package Name')); ?>: <?php echo e($data->package_name); ?></span><br>
         <?php echo e(trans('labels.Status')); ?>: <?php echo e($data->package_status); ?></span><br>
        <?php echo e(trans('labels.Vehicle')); ?>: <?php echo e($data->vehicle_plate_no); ?><br>
        <?php echo e(trans('labels.Garage')); ?>: <?php echo e($data->garage_name); ?><br>
        <?php echo e(trans('labels.subscription_start_at')); ?>: <?php echo e($data->subscription_start_at); ?><br>
        <?php echo e(trans('labels.subscription_end_at')); ?>: <?php echo e($data->subscription_end_at); ?><br>
      </address>
    </div>
    <br/>
    <br/>
    <div> <strong><?php echo e(trans('labels.PaymentInfo')); ?>:</strong>
      <address>
        <span style="text-transform: capitalize;">
        <?php echo e(trans('labels.Amount')); ?>: <?php echo e($data->package_payment_amount); ?><br>
        <?php echo e(trans('labels.Status')); ?>: <?php echo e($data->package_payment_status); ?><br>
        <?php echo e(trans('labels.Date')); ?>: <?php echo e($data->package_payment_date); ?><br>
        <?php echo e(trans('labels.PaymentMethods')); ?>: <?php echo e(($data->package_payment_type == 'cod') ? 'Cash On Delivery' : 'Credit Card'); ?><br>
      </address>
    </div>
   
    
    <!-- /.col --> 
  </div>
  <!-- /.row --> 

</div>
<?php /**PATH D:\xampp74\htdocs\g2g\resources\views//mail/packageSubscription/success.blade.php ENDPATH**/ ?>