<!-- //header style Two -->
 <header id="headerTwo" class="header-area header-two header-desktop d-none d-lg-block d-xl-block">
  <div class="header-mini bg-top-bar">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12">

          <nav id="navbar_0_1" class="navbar navbar-expand-md navbar-dark navbar-0">
            <div class="navbar-lang">
              <?php if(count($languages) > 1): ?>
              <div class="dropdown">

                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                   <img src="<?php echo e(asset('').session('language_image')); ?>" width="17px" />
                   <span style="color:white;"><?php echo e(session('language_name')); ?></span>
                  </button>
                  <ul class="dropdown-menu">
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li  <?php if(session('locale')==$language->code): ?> style="background:lightgrey;" <?php endif; ?>>
                      <button  onclick="myFunction1(<?php echo e($language->languages_id); ?>)" class="btn" style="background:none;" href="#">
                        <img style="margin-left:10px; margin-right:10px;"src="<?php echo e(asset('').$language->image_path); ?>" width="17px" />
                        <span><?php echo e($language->name); ?></span>
                      </button>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>
                <?php echo $__env->make('autoshop.common.scripts.changeLanguage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                <?php if(count($currencies) > 1): ?>
                <div class="dropdown">

                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">

                      <?php if(session('symbol_left') != null): ?>
                      <span style="color:white;"><?php echo e(session('symbol_left')); ?></span>
                      <?php else: ?>
                      <span style="color:white;"><?php echo e(session('symbol_right')); ?></span>
                      <?php endif; ?>
                      <span style="color:white;"><?php echo e(session('currency_code')); ?></span>


                    </button>
                    <ul class="dropdown-menu">
                      <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li  <?php if(session('currency_title')==$currency->code): ?> style="background:lightgrey;" <?php endif; ?>>
                        <button  onclick="myFunction2(<?php echo e($currency->id); ?>)" class="btn" style="background:none;" href="#">
                          <?php if($currency->symbol_left != null): ?>
                          <span style="margin-left:10px; margin-right:10px;"><?php echo e($currency->symbol_left); ?></span>
                          <span><?php echo e($currency->code); ?></span>
                          <?php else: ?>
                          <span style="margin-left:10px; margin-right:10px;"><?php echo e($currency->symbol_right); ?></span>
                          <span><?php echo e($currency->code); ?></span>
                          <?php endif; ?>
                        </button>
                      </li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </div>
                  <?php echo $__env->make('autoshop.common.scripts.changeCurrency', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <?php endif; ?>
            </div>
            <div class="navbar-collapse" >
              <ul class="navbar-nav">
                  <li class="nav-item">
                      <div class="nav-avatar nav-link">
                        <div class="avatar">
                        <?php
                        if(auth()->guard('customer')->check()){
                         if(auth()->guard('customer')->user()->avatar == null){ ?>
                          <img class="img-fluid" src="<?php echo e(asset('web/images/miscellaneous/avatar.jpg')); ?>">
                        <?php }else{ ?>
                          <img class="img-fluid" src="<?php echo e(auth()->guard('customer')->user()->avatar); ?>">
                        <?php
                              }
                           }
                        ?>
                        </div>
                        <span><?php if(auth()->guard('customer')->check()){ ?><?php echo app('translator')->get('website.Welcome'); ?>&nbsp;! <?php echo e(auth()->guard('customer')->user()->first_name); ?> <?php }?> </span>
                      </div>
                    </li>
                    <?php if(auth()->guard('customer')->check()){ ?>
                    <li class="nav-item"> <a href="<?php echo e(url('profile')); ?>" class="nav-link"><?php echo app('translator')->get('website.Profile'); ?></a> </li>
                    <li class="nav-item"> <a href="<?php echo e(url('wishlist')); ?>" class="nav-link"><?php echo app('translator')->get('website.Wishlist'); ?></a> </li>
                    <li class="nav-item"> <a href="<?php echo e(url('compare')); ?>" class="nav-link"><?php echo app('translator')->get('website.Compare'); ?>&nbsp;(<span id="compare"><?php echo e($count); ?></span>)</a> </li>
                    <li class="nav-item"> <a href="<?php echo e(url('orders')); ?>" class="nav-link"><?php echo app('translator')->get('website.Orders'); ?></a> </li>
                    <li class="nav-item"> <a href="<?php echo e(url('shipping-address')); ?>" class="nav-link"><?php echo app('translator')->get('website.Shipping Address'); ?></a> </li>
                    <li class="nav-item"> <a href="<?php echo e(url('logout')); ?>" class="nav-link padding-r0"><?php echo app('translator')->get('website.Logout'); ?></a> </li>
                    <?php }else{ ?>
                      <li class="nav-item"><div class="nav-link"><?php echo app('translator')->get('website.Welcome'); ?>!</div></li>
                      <li class="nav-item"> <a href="<?php echo e(URL::to('/login')); ?>" class="nav-link -before"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;<?php echo app('translator')->get('website.Login/Register'); ?></a> </li>                      <?php } ?>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="header-maxi bg-header-bar">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-sm-12 col-lg-3">
          <a href="<?php echo e(URL::to('/')); ?>" class="logo">
      <?php if($result['commonContent']['setting'][77]->value=='name'): ?>
      <?=stripslashes($result['commonContent']['setting'][78]->value)?>
      <?php endif; ?>

      <?php if($result['commonContent']['setting'][77]->value=='logo'): ?>
      <img src="<?php echo e(asset('').$result['commonContent']['setting'][15]->value); ?>" alt="<?=stripslashes($result['commonContent']['setting'][79]->value)?>">
      <?php endif; ?>
      </a>
        </div>
        <div class="col-12 col-sm-7 col-md-8 col-lg-6">
          <form class="form-inline" action="<?php echo e(URL::to('/shop')); ?>" method="get">
            <div class="search">
              <div class="select-control">
                <select class="form-control" name="category">
                 <?php echo $__env->make('autoshop.common.HeaderCategories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <?php    productCategories(); ?>
                </select>
              </div>
              <input type="search"  name="search" placeholder="<?php echo app('translator')->get('website.Search entire store here'); ?>..." value="<?php echo e(app('request')->input('search')); ?>" aria-label="Search">
              <button class="btn btn-secondary" type="submit">
              <i class="fa fa-search"></i></button>
            </div>
          </form>
        </div>
        <div class="col-12 col-sm-5 col-md-4 col-lg-3">
          <ul class="top-right-list">
            <li class="wishlist-header">
              <a href="<?php echo e(url('wishlist')); ?>">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-shopping-bag fa-stack-2x"></i>
                  <i class="fas fa-heart fa-stack-2x"></i>
                </span>
              </a>
            </li>
            <li class="cart-header dropdown head-cart-content">
              <?php echo $__env->make('autoshop.headers.cartButtons.cartButton2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="header-navbar bg-menu-bar">
    <div class="container">
      <nav id="navbar_header_1" class="navbar navbar-expand-lg  bg-nav-bar">
        <a class="navbar-brand home-icon" href="home.html"><i class="fa fa-home"></i></a>

        <div class=" navbar-collapse">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link " href="<?php echo e(url('/')); ?>" >
                <?php echo app('translator')->get('website.Home'); ?>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="<?php echo e(url('/shop')); ?>"  >
                <?php echo app('translator')->get('website.Shop'); ?>
                <span class="badge badge-secondary">Hot</span>
              </a>

            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" >
                  <?php echo app('translator')->get('website.News'); ?>
                </a>
                <div class="dropdown-menu">
                  <?php $__currentLoopData = $result['commonContent']['newsCategories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="dropdown-submenu">
                        <a class="dropdown-item" href="<?php echo e(URL::to('/news?category='.$categories->slug)); ?>"><?php echo e($categories->name); ?></a>
                      </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" >
                <?php echo app('translator')->get('website.infoPages'); ?>
              </a>
              <div class="dropdown-menu">
                <?php $__currentLoopData = $result['commonContent']['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <a class="dropdown-item" href="<?php echo e(URL::to('/page?name='.$page->slug)); ?>">
                    <?php echo e($page->name); ?>

                  </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="<?php echo e(url('contact')); ?>" >
                <?php echo app('translator')->get('website.Contact Us'); ?>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link">
                  <span><?php echo app('translator')->get('website.Hotline'); ?></span>
                  <?php echo e($result['commonContent']['setting'][11]->value); ?>

              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</header>
<?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/web/headers/headerTwo.blade.php ENDPATH**/ ?>