<?php $__env->startSection('content'); ?>
 <?php $r =   'autoshop.shop-pages.shop' . $final_theme['shop']; ?>
 <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 
 <?php if(isset($result['show_vehicle_popup']) && $result['show_vehicle_popup']): ?>
 
 <!-- The Modal -->
  <div class="modal" id="vehicleModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><?php echo e(trans('website.vehicles and customization')); ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <ul style="list-style-type:disc;">
                <li class="ion-text-wrap">
                    <?php echo e(trans('website.Price listed with the car is the price seller is willing to sell')); ?>

                </li>
                <li class="ion-text-wrap">
                    <?php echo e(trans('website.G2G only arrange viewing of vehicles for AED 100 per viewing')); ?>

                </li>
                <li class="ion-text-wrap">
                    <?php echo e(trans('website.Add to cart and pay only for viewing charges')); ?>

                </li>
                <li class="ion-text-wrap">
                    <?php echo e(trans('website.Enter your location in Shipping details on checkout')); ?>

                </li>
            </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo e(trans('website.proceed')); ?></button>
        </div>
        
      </div>
    </div>
  </div>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>

    $(document).ready(function (){
        $('#vehicleModal').modal('hide');
        $('#vehicleModal').modal({backdrop: 'static',keyboard: false});
    });
    </script>
 <?php endif; ?>
 
 
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/autoshop/shop.blade.php ENDPATH**/ ?>