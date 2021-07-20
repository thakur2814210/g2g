<?php $__env->startSection('content'); ?>
 <?php $r =   'web.shop-pages.shop' . $final_theme['shop']; ?>
 <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/web/shop.blade.php ENDPATH**/ ?>