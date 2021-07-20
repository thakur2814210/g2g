<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G2G | Homepage.</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

     <?php echo $__env->yieldContent('website_css_pre'); ?>

    <!-- BASE CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/css/bootstrap.min.css')); ?>">
    <?php if(\Config::get('app.locale') == 'ar'): ?>
         <link rel="stylesheet" href="<?php echo e(asset('website-theme/bootstrap-v4-rtl/dist/css/bootstrap-rtl.min.css')); ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/css/vendors.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/css/color-red.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/css/custom.css')); ?>">
     <link rel="stylesheet" href="<?php echo e(asset('website-theme/admin/vendor/font-awesome/css/font-awesome.min.css')); ?> " rel="stylesheet" type="text/css">

     <?php echo $__env->yieldContent('website_css'); ?>

</head>

<body>
        
     <div id="page"  class=" <?php if(\Config::get('app.locale') == 'ar'): ?> rtl <?php endif; ?> ">
        
        <?php echo $__env->make('website::include.page-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('website::include.errorin-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->make('website::include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    </div>
   
    <?php echo $__env->make('website::include.signin-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    
    <div id="toTop"></div><!-- Back to top button -->
    
    <!-- COMMON SCRIPTS -->
    <script src="<?php echo e(asset('website-theme/js/common_scripts.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/js/functions.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/assets/validate.js')); ?>"></script>

    <?php echo $__env->yieldContent('website_js'); ?>

</body>
</html><?php /**PATH /home/devhs/public_html/g2g-v3/Modules/Website/Resources/views/layouts/page.blade.php ENDPATH**/ ?>