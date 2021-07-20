
<div style="padding: 5px;">
  <div style="width: 100%; display: block">
    <h2 style="font-size: 20px;border-bottom: 1px solid #eee;padding-bottom: 20px;"><?php echo e(trans('labels.OrderID')); ?># <?php echo e($data->ps_code); ?> 
    <span style="
    background-color: #3c8dbc;
    display: inline;
    padding: .2em .6em .3em;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
    font-size:14px !important;
    position: relative;
    top: -2px;
    margin: 0 5px;
    display: none;
    "> Pending</span> <small style="font-size: 14px;float: right;padding-right: 12px;margin-top: 6px;"><?php echo e(trans('labels.OrderedDate')); ?>: <?php echo e(date('m/d/Y', strtotime($data->created_at))); ?></small> </h2>
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
<?php /**PATH /home/g2g/public_html/resources/views//mail/packageSubscription/success.blade.php ENDPATH**/ ?>