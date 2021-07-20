<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G2G | Client</title>

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
     <link rel="stylesheet" href="<?php echo e(asset('website-theme/admin/css/admin.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/css/vendors.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/css/color-red.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/css/custom.css')); ?>">
   

    <link rel="stylesheet" href="<?php echo e(asset('website-theme/admin/vendor/font-awesome/css/font-awesome.min.css')); ?> " rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/admin/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('website-theme/admin/css/date_picker.css')); ?>">
    <style type="text/css">
       
        /***    left menu ****/

        /***********************  TOP Bar ********************/
        .sidebar-active{background-color:#dc3545 !important; color: #fff !important;}
        .sidebar{  background-color:#000; }
        .bg-defoult{background-color:#fff;}
        .sidebar ul{ list-style:none; margin:0px; padding:0px; }
        .sidebar li a,.sidebar li a.collapsed.active{ display:block; padding:12px; color:#666;border-left:0px solid #dedede;  text-decoration:none}
        .sidebar li a.active{background-color:#fff;border-left:5px solid #dedede; }
        .sidebar li a:hover{background-color:#dc3545 !important; color: #fff !important; }
        .sidebar li a i{ padding-right:5px;}
        .sidebar ul li .sub-menu li a{ position:relative}
        .sidebar ul li .sub-menu li a:before{
            font-family: FontAwesome;
            content: "\f105";
            display: inline-block;
            padding-left: 0px;
            padding-right: 10px;
            vertical-align: middle;
        }
        .sidebar ul li .sub-menu li a:hover:after {
            content: "";
            position: absolute;
            left: -5px;
            top: 0;
            width: 5px;
            background-color: #111;
            height: 100%;
        }
        .sidebar ul li .sub-menu li a:hover{ background-color:#222; padding-left:20px;}
        .sub-menu{ border-left:5px solid #dedede;}
            .sidebar li a .nav-label,.sidebar li a .nav-label+span{ }
            

            .sidebar.fliph li a .nav-label,.sidebar.fliph li a .nav-label+span{ display:none;}
            .sidebar.fliph {
            width: 42px;transition: all 0.5s  ease-in-out;
           
        }
            
        .sidebar.fliph li{ position:relative}
        .sidebar.fliph .sub-menu {
            position: absolute;
            left: 39px;
            top: 0;
            background-color: #fff;
            width: 150px;
            z-index: 100;
        }
            

        .user-panel {
            clear: left;
            display: block;
            float: left;
        }
        .user-panel>.image>img {
            width: 100%;
            max-width: 45px;
            height: auto;
        }
        .user-panel>.info,  .user-panel>.info>a {
            color: #222;
        }
        .user-panel>.info>p {
            font-weight: 600;
            margin-bottom: 9px;
        }
        .user-panel {
            clear: left;
            display: block;
            float: left;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px 15px;
            border-bottom: 1px solid;
        }
        .user-panel>.info {
            padding: 5px 5px 5px 15px;
            line-height: 1;
            position: absolute;
            left: 30%;
        }

        .fliph .user-panel{ display: none; }


        .sidebar-divider{
            border-bottom: 1px solid #ddd;
        }

        .box_general{
            padding: 10px 0px 0px 10px !important;
        }
    </style>
     <?php echo $__env->yieldContent('css'); ?>

</head>

<body class="<?php if(\Config::get('app.locale') == 'ar'): ?> rtl <?php endif; ?> ">
        
    <div id="page">
        
        <?php echo $__env->make('website::include.home-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <main>
            <div class="" style="padding: 10px;">
                <div class="row margin_60_35">
                    <aside class="col-3">

                        <div class="sidebar left ">

                            <div class="user-panel bg-dark">
                              <div class="pull-left image">
                                <img src="http://via.placeholder.com/160x160" class="rounded-circle" alt="User Image">
                              </div>
                              <div class="pull-left info p-2 text-white">
                                <p><?php echo e(Auth::user()->username); ?></p>
                                <a href="#" class="text-white"><i class="fa fa-circle text-success"></i> Online</a>
                              </div>
                            </div>
                            
                            <ul class="list-sidebar" style="background: #d9d9d9;">

                                <li class="sidebar-divider" > 
                                    <a href="<?php echo e(route('superadmin.dashboard')); ?>" data-toggle="collapse" data-target="#dashboard" class="collapsed active" style="background: #d3d3d3;"> 
                                        <i class="fa fa-laptop"></i> 
                                        <span class="nav-label"> Manage Website </span> 
                                        <span class="fa fa-chevron-left pull-right"></span> 
                                    </a>
                                  <ul class="sub-menu collapse" id="dashboard">
                                    <li class="active"><a href="#">AutoShop Homepage</a></li>
                                    <li><a href="#" >AutoShop Admin Panel</a></li>
                                    <li><a href="<?php echo e(route('page.homepage')); ?>">Website Homepage</a></li>
                                  </ul>
                                </li>


                                 <li style="background: #fff;padding: 1px;"></li>

                                <li class="sidebar-divider"> <a class="<?php echo e(Request::is('administrator/dashboard') ? 'sidebar-active' : ''); ?>" href="<?php echo e(route('superadmin.dashboard')); ?>" ><i class="fa fa-dashboard"></i> <span class="nav-label">Manage Dashboard</span> </a></li>

                                 <li style="background: #fff;padding: 1px;"></li>

                                <li style="background: #777;" class="p-2 text-center text-white"> <label> Manage Customers & Garages</label></li>
                                
                                <li class="sidebar-divider"> <a class="<?php echo e(Request::is('administrator/clients/*') ? 'sidebar-active' : ''); ?>" href="#" data-toggle="collapse" data-target="#customers" class="collapsed active" > <i class="fa fa-users"></i> <span class="nav-label">Manage Customers</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu <?php echo e(Request::is('administrator/clients/*') ? 'show' : 'collapse'); ?>" id="customers">
                                      <li class="active"><a href="<?php echo e(route('superadmin.clients.active-list')); ?>">Active Customers</a></li>
                                      <li><a href="<?php echo e(route('superadmin.clients.pending-list')); ?>">Pending Customers</a></li>
                                      <li><a href="<?php echo e(route('superadmin.clients.delete-list')); ?>">Delete Customers</a></li>
                                     
                                    </ul>
                                </li>

                                <li class="sidebar-divider"> <a class="<?php echo e(Request::is('administrator/garages/*') ? 'sidebar-active' : ''); ?>" href="#" data-toggle="collapse" data-target="#garages" class="collapsed active" > <i class="fa fa-building"></i> <span class="nav-label">Manage Garages</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu <?php echo e(Request::is('administrator/garages/*') ? 'show' : 'collapse'); ?>" id="garages">
                                      <li class="active"><a href="<?php echo e(route('superadmin.garages.active')); ?>">Active Garages</a></li>
                                      <li><a href="<?php echo e(route('superadmin.garages.pending')); ?>">Pending Garages</a></li>
                                      <li><a href="<?php echo e(route('superadmin.garages.delete')); ?>">Delete Garages</a></li>
                                     
                                    </ul>
                                </li>

                                  <li style="background: #fff;padding: 1px;"></li>


                                <li style="background: #777;" class="p-2 text-center text-white"> <label>Manage Subscription, Requests & Transaction</label></li>

                                <li class="sidebar-divider"> <a class="<?php echo e(Request::is('administrator/subscriptions/*') ? 'sidebar-active' : ''); ?>" href="#" data-toggle="collapse" data-target="#package-subscription" class="collapsed active" > <i class="fa fa-shopping-cart"></i> <span class="nav-label">Package Subscription</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu <?php echo e(Request::is('administrator/subscriptions/*') ? 'show' : 'collapse'); ?>" id="package-subscription">
                                      <li class="active"><a href="<?php echo e(route('superadmin.subscriptions.clients.list')); ?>"> Customers</a></li>
                                      <li><a href="<?php echo e(route('superadmin.subscriptions.garages.list')); ?>"> Garages</a></li>
                                     
                                    </ul>
                                </li>

                                <li class="sidebar-divider"> <a class="<?php echo e(Request::is('administrator/service-request/*') ? 'sidebar-active' : ''); ?>" href="<?php echo e(route('superadmin.service-requests')); ?>" ><i class="fa fa-car"></i> <span class="nav-label"> Service Requests</span> </a></li>
                                
                                
                                <li class="sidebar-divider"> <a class="<?php echo e(Request::is('administrator/transactions/*') ? 'sidebar-active' : ''); ?>" href="#" data-toggle="collapse" data-target="#transactions" class="collapsed active" > <i class="fa fa-money"></i> <span class="nav-label">All Transactions</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu <?php echo e(Request::is('administrator/transactions/*') ? 'show' : 'collapse'); ?>" id="transactions">
                                        <li class="sidebar-divider"> <a  href="#" data-toggle="collapse" data-target="#c_transactions" class="collapsed active" > <span class="nav-label">Customers Transaction</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                            <ul class="sub-menu <?php echo e(Request::is('administrator/transactions/customers/*') ? 'show' : 'collapse'); ?>" id="c_transactions">
                                              <li class="active"><a href="<?php echo e(route('superadmin.transactions.customers_package_subscription')); ?>"> Package Subscription</a></li>
                                              <li><a href="<?php echo e(route('superadmin.transactions.customers_service_request')); ?>"> Service Requests</a></li>
                                             
                                            </ul>
                                        </li>
                                      <li><a href="<?php echo e(route('superadmin.transactions.garages_package_subscription')); ?>"> Garages Transaction</a></li>
                                     
                                    </ul>
                                </li>
    
                                  <li style="background: #fff;padding: 1px;"></li>
                                <li style="background: #777;" class="p-2 text-center text-white"> <label>Manage Vehicle, Section & Package</label></li>

                                <li class="sidebar-divider"> <a class="<?php echo e(Request::is('administrator/settings/vehicle*') ? 'sidebar-active' : ''); ?>" href="#" data-toggle="collapse" data-target="#manage-vehicle" class="collapsed active" > <i class="fa fa-car"></i> <span class="nav-label">Manage Vehicle</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu <?php echo e(Request::is('administrator/settings/vehicle*') ? 'show' : 'collapse'); ?>" id="manage-vehicle">
                                      <li class="active"><a href="<?php echo e(route('superadmin.settings.vehicle-make')); ?>">Vehicle Make</a></li>
                                      <li><a href="<?php echo e(route('superadmin.settings.vehicle-modal')); ?>">Vehicle Model</a></li>
                                     
                                    </ul>
                                </li>

                                 <li class="sidebar-divider"> <a class="<?php echo e(Request::is('administrator/category/*') || Request::is('administrator/subcategory/*') ? 'sidebar-active' : ''); ?>" href="#" data-toggle="collapse" data-target="#sections" class="collapsed active" > <i class="fa fa-diamond"></i> <span class="nav-label">Manage Sections</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu <?php echo e(Request::is('administrator/subcategory/*') || Request::is('administrator/subcategory/*') ? 'show' : 'collapse'); ?>" id="sections">
                                      <li class="active"><a href="<?php echo e(route('superadmin.category.list')); ?>">Section Category</a></li>
                                      <li><a href="<?php echo e(route('superadmin.subcategory.list')); ?>">Section Sub-Category </a></li>
                                     
                                    </ul>
                                </li>

                                 <li class="sidebar-divider"> <a class="<?php echo e(Request::is('administrator/service-package/*') ? 'sidebar-active' : ''); ?>" href="#" data-toggle="collapse" data-target="#packages" class="collapsed active" > <i class="fa fa-tags"></i> <span class="nav-label">Manage Packages</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu <?php echo e(Request::is('administrator/service-package/*') ? 'show' : 'collapse'); ?>" id="packages">
                                      <li class="active"><a href="<?php echo e(route('superadmin.service-package')); ?>">List</a></li>
                                      <li><a href="<?php echo e(route('superadmin.service-package.features')); ?>">Feature</a></li>
                                     
                                    </ul>
                                </li>
                               

                                  <li style="background: #fff;padding: 1px;"></li>
                                <li style="background: #777;" class="p-2 text-center text-white"> <label>Manage Profiles & Web Settings</label></li>
                               
                                
                                <li class="sidebar-divider"> <a class="<?php echo e(Request::is('administrator/pages/*') ? 'sidebar-active' : ''); ?>" href="#" data-toggle="collapse" data-target="#ManagePages" class="collapsed active" ><i class="fa fa-file-o"></i> <span class="nav-label">Manage Pages</span><span class="fa fa-chevron-left pull-right"></span></a>
                                  <ul  class="sub-menu <?php echo e(Request::is('administrator/pages/*') ? 'show' : 'collapse'); ?>" id="ManagePages" >
                                    <li><a href="<?php echo e(route('superadmin.pages.aboutus')); ?>"> About Us</a></li>
                                    <li><a href="<?php echo e(route('superadmin.pages.contactus')); ?>"> Contact Us</a></li>
                                    <li><a href="<?php echo e(route('superadmin.pages.termsconditions')); ?>"> Terms and conditions</a></li>
                                    <li><a href="<?php echo e(route('superadmin.pages.privacy-policy')); ?>"> Privacy Policy</a></li>
                                    <li><a href="<?php echo e(route('superadmin.pages.faq')); ?>"> FAQ</a></li>
                                    <li><a href="<?php echo e(route('superadmin.pages.testimonial')); ?>"> Testimonials</a></li>
                                    <li><a href="<?php echo e(route('superadmin.pages.seo')); ?>"> SEO Manager</a></li>
                                  </ul>
                                </li>

                               
                                <li class="sidebar-divider"> <a class="<?php echo e(Request::is('administrator/general-settings') || Request::is('administrator/settings/commissions') ? 'sidebar-active' : ''); ?>" href="#" data-toggle="collapse" data-target="#general-settings" class="collapsed active" ><i class="fa fa-cogs"></i> <span class="nav-label">General Settings</span><span class="fa fa-chevron-left pull-right"></span></a>
                                    <ul  class="sub-menu <?php echo e(Request::is('administrator/general-settings') || Request::is('administrator/settings/commissions') ? 'show' : 'collapse'); ?>" id="general-settings" >
                                      <li><a href="<?php echo e(route('superadmin.general-settings')); ?>"> Web Setting</a></li>
                                      <li><a href="<?php echo e(route('superadmin.settings.commissions')); ?>"> Commissions</a></li>
                                    </ul>
                                </li>

                                 <li class="sidebar-divider"> <a class="<?php echo e(Request::is('administrator/settings/langauges') || Request::is('administrator/translations') ? 'sidebar-active' : ''); ?>" href="#" data-toggle="collapse" data-target="#langauges" class="collapsed active" ><i class="fa fa-cogs"></i> <span class="nav-label">Manage Langauges</span><span class="fa fa-chevron-left pull-right"></span></a>
                                    <ul  class="sub-menu <?php echo e(Request::is('administrator/settings/langauges') || Request::is('administrator/translations') ? 'show' : 'collapse'); ?>" id="langauges" >
                                      <li><a href="<?php echo e(route('superadmin.settings.languages')); ?>"> Langauges List</a></li>
                                       <li><a  href="<?php echo action('\Barryvdh\TranslationManager\Controller@getIndex') ?>"> Translation Manager</a></li>
                                    </ul>
                                </li>

                                

                                <li class="sidebar-divider"> <a class="<?php echo e(Request::is('administrator/profile/*') ? 'sidebar-active' : ''); ?>" href="#" data-toggle="collapse" data-target="#profile" class="collapsed active" ><i class="fa fa-user-circle"></i> <span class="nav-label">Manage Profile</span><span class="fa fa-chevron-left pull-right"></span></a>
                                    <ul  class="sub-menu <?php echo e(Request::is('administrator/profile/*') ? 'show' : 'collapse'); ?>" id="profile" >
                                      <li><a href="<?php echo e(route('superadmin.view-profile')); ?>"> View Profile</a></li>
                                      <li><a href="<?php echo e(route('superadmin.change-password')); ?>"> Change Password</a></li>
                                    </ul>
                                </li>

                                 <li class="nav-item"  data-toggle="tooltip" data-placement="right" title="Dashboard">
                                  <a class="nav-link" data-toggle="modal" data-target="#logoutModal" data-backdrop="false">
                                     <i class="fa fa-fw fa-sign-out"></i>
                                    <span class="nav-link-text">Logout</span>
                                  </a>
                                </li>
                              
                            </ul>
                        </div>
                            
                    </aside>

                    <div class="col-9">
                        <!-- Breadcrumbs-->
                        <?php echo $__env->yieldContent('breadcrumb'); ?>
                        
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                     <?php echo $__env->make('admin::modals.logout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

            </div>

        <?php echo $__env->make('website::include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </main>
       
    
    </div>
   
   
    
    
    <div id="toTop"></div><!-- Back to top button -->
    
    <!-- COMMON SCRIPTS -->
    <script src="<?php echo e(asset('website-theme/js/common_scripts.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/js/functions.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/assets/validate.js')); ?>"></script>

    

   

    <?php echo $__env->yieldContent('js'); ?>

</body>
</html><?php /**PATH /home/devhs/public_html/g2g-v3/Modules/Admin/Resources/views/layouts/master.blade.php ENDPATH**/ ?>