<!DOCTYPE html>
<html>

<!-- meta contains meta taga, css and fontawesome icons etc -->
<?php echo $__env->make('vendor.common.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./end of meta -->

<body class="hold-transition login-page">
<!-- wrapper -->
<div class="wrapper">

    <!-- dynamic content -->
    <?php echo $__env->yieldContent('content'); ?>;
    <!-- ./end of dynamic content -->

</div>
<!-- ./wrapper -->

<!-- all js scripts including custom js -->
<?php echo $__env->make('vendor.common.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./end of js scripts -->

</body>
</html>
<?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/vendor/layoutLlogin.blade.php ENDPATH**/ ?>