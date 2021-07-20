
<header class="main-header">


    <!-- Logo -->
    <a href="<?php echo e(URL::to('vendor/dashboard')); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini" style="font-size:12px"><b><?php echo e(trans('labels.VendorDashboard')); ?></b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><?php echo e(trans('labels.VendorDashboard')); ?></b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" id="linkid" data-toggle="offcanvas" role="button">
        <span class="sr-only"><?php echo e(trans('labels.toggle_navigation')); ?></span>
      </a>
		<div id="countdown" style="
    width: 350px;
    margin-top: 13px !important;
    position: absolute;
    font-size: 16px;
    color: #ffffff;
    display: inline-block;
    margin-left: -175px;
    left: 50%;
"></div>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <span class="hidden-xs"><?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">

                <p>
                  <?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?>

                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo e(URL::to('vendor/profile')); ?>" class="btn btn-default btn-flat"><?php echo e(trans('labels.profile_link')); ?></a>
                </div>
                <div class="pull-right">
                    <a href="<?php echo e(URL::to('vendor/logout')); ?>" class="btn btn-default btn-flat"><?php echo e(trans('labels.sign_out')); ?></a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--<li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->
        </ul>
      </div>
    </nav>
  </header>
<?php /**PATH /Users/apple/Projects/g2g-v3/resources/views/garage/common/header.blade.php ENDPATH**/ ?>