<!DOCTYPE html>
<html>

<!-- meta contains meta taga, css and fontawesome icons etc -->
<?php echo $__env->make('garage.common.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./end of meta -->

<body class=" hold-transition skin-blue sidebar-mini">
<!-- wrapper -->
<div class="wrapper">

    <!-- header contains top navbar -->
<?php echo $__env->make('garage.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./end of header -->

    <!-- left sidebar -->
<?php echo $__env->make('garage.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./end of left sidebar -->

    <!-- dynamic content -->
<?php echo $__env->yieldContent('content'); ?>
<!-- ./end of dynamic content -->

    <!-- right sidebar -->
<?php echo $__env->make('garage.common.controlsidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./right sidebar -->
    <?php echo $__env->make('garage.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!-- ./wrapper -->

<!-- all js scripts including custom js -->
<?php echo $__env->make('garage.common.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./end of js scripts -->

</body>
</html>
<?php /**PATH /Users/apple/Projects/g2g-v3/resources/views/garage/layout.blade.php ENDPATH**/ ?>