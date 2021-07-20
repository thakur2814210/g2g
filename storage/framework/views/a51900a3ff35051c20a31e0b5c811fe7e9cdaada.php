<!DOCTYPE html>
<html>

<!-- meta contains meta taga, css and fontawesome icons etc -->
<?php echo $__env->make('vendor.common.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./end of meta -->

<body class=" hold-transition skin-blue sidebar-mini">
<!-- wrapper -->
<div class="wrapper">

    <!-- header contains top navbar -->
<?php echo $__env->make('vendor.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./end of header -->

    <!-- left sidebar -->
<?php echo $__env->make('vendor.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./end of left sidebar -->

    <!-- dynamic content -->
<?php echo $__env->yieldContent('content'); ?>
<!-- ./end of dynamic content -->

    <!-- right sidebar -->
<?php echo $__env->make('vendor.common.controlsidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./right sidebar -->
    <?php echo $__env->make('vendor.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!-- ./wrapper -->

<!-- all js scripts including custom js -->
<?php echo $__env->make('vendor.common.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./end of js scripts -->

</body>
</html>
<?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/vendor/layout.blade.php ENDPATH**/ ?>