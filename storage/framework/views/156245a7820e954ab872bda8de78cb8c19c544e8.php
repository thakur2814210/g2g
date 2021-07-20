
<?php $__env->startSection('content'); ?>
<!-- cart Content -->
<?php $r =   'autoshop.carts.cart' . $final_theme['cart']; ?>
<?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/autoshop/carts/viewcart.blade.php ENDPATH**/ ?>