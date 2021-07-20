<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G2G | Garage</title>

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
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/css/vendors.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/css/color-red.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/admin/css/admin.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('website-theme/admin/vendor/font-awesome/css/font-awesome.min.css')); ?> " rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?php echo e(asset('website-theme/admin/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/admin/css/date_picker.css')); ?>">
     <?php echo $__env->yieldContent('website_css'); ?>

</head>

<body>
        
    <div id="page">
        
        <?php echo $__env->make('website::include.home-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <main>
            <div class="" style="padding: 10px;">
                <div class="row margin_60_35">
                    <aside class="col-lg-3">

                            <div class="box_style_cat">
                              <div class="card flex-row flex-wrap m-0">
                                  <div class="card-header border-0">
                                       <i class="fa fa-2x fa-user-circle"></i>  
                                  </div>
                                  <div class="card-block px-2">
                                      <h6 style="margin: 0px;" class="card-title m-0 text-danger"><?php echo e(Auth::user()->username); ?></h6>
                                        Garage Admin Panel
                                  </div>
                              </div> 
                            </div>
                            
                             <div class="box_style_cat">
                                <ul id="cat_nav">
                                    <li>
                                        <a href="<?php echo e(route('garage.dashboard')); ?>" class="<?php echo e(request()->is('garage/dashboard') ? 'active' : ''); ?>">
                                            <i class="fa fas fa-home"></i>  Dashboard
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="box_style_cat">
                               <ul id="cat_nav" >
                                    <li style="background: #ddd;" class="text-center p-2">
                                        Manage Customers Activity
                                    </li>
                               
                                    <li>
                                        <a href="<?php echo e(route('garage.customers.service-request')); ?>" class="<?php echo e(request()->is('garage/customer-service-request') ? 'active' : ''); ?>">
                                            <i class="fa fas fa-list"></i> Customer Service Requests
                                        </a>
                                    </li>

                                     <li>
                                        <a href="<?php echo e(route('garage.customers.packages-subscribed')); ?>" class="<?php echo e(request()->is('garage/customer-package-subscription') ? 'active' : ''); ?>">
                                            <i class="fa fas fa-tags"></i> Customer Package Subscription
                                        </a>
                                    </li>
                                   
                                   
                                    <li>
                                        <a href="<?php echo e(route('garage.customers.payments')); ?>" class="<?php echo e(request()->is('garage/payments') ? 'active' : ''); ?>">
                                            <i class="fa fas fa-money"></i> Customer Transactions
                                        </a>
                                    </li>
                                   
                                    
                                </ul>
                            </div>

                            <div class="box_style_cat">
                                <ul id="cat_nav">
                                    <li style="background: #ddd;" class="text-center p-2">
                                         Manage Own Garage
                                    </li>
                              
                                     <li>
                                        <a href="<?php echo e(route('garage.packages')); ?>" class="<?php echo e(request()->is('garage/packages') ? 'active' : ''); ?>">
                                            <i class="fa fas fa-tags"></i>Garage Package Subscription
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="<?php echo e(route('garage.detail.view')); ?>" class="<?php echo e(request()->is('garage/detail') ? 'active' : ''); ?>">
                                            <i class="fa fas fa-building"></i> Manage Garage
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('garage.profile.view')); ?>" class="<?php echo e(request()->is('garage/profile/view-profile') ? 'active' : ''); ?>">
                                            <i class="fa fas fa-user-circle"></i>View Login Profile
                                        </a>
                                    </li>
                                    <li><a href="<?php echo e(route('garage.profile.password-change')); ?>" class="<?php echo e(request()->is('garage/profile/change-password') ? 'active' : ''); ?>"><i class="fa fas fa-key"></i>Change Password</a></li>
                                   <li><a class="dropdown-item" href="<?php echo e(route('garage.logout')); ?>"><i class="fas fa-sign-out-alt fa-lg"></i> Logout</a>
                                </ul>
                            </div>
                            <!--/sticky -->
                    </aside>

                    <div class="col-lg-9">
                         <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            </div>
        </main>

        <?php echo $__env->make('website::include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    </div>
   
    
    
    
    <div id="toTop"></div><!-- Back to top button -->
    
    <!-- COMMON SCRIPTS -->
    <script src="<?php echo e(asset('website-theme/js/common_scripts.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/js/functions.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/assets/validate.js')); ?>"></script>

    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/admin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

   

    <?php echo $__env->yieldContent('website_js'); ?>

</body>
</html><?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Garage/Resources/views/layouts/master.blade.php ENDPATH**/ ?>