<header id="headerMobile" class="header-area header-mobile d-lg-none d-xl-none">
    <div class="header-mini bg-top-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">

            <nav id="navbar_0" class="navbar navbar-expand-md navbar-dark navbar-0">
              <div class="navbar-lang">
                <?php if(count($languages) > 1): ?>
                <div class="dropdown">
                    <button class="btn" style="background:none;" href="#">
                      <img style="margin-right:-30px;"src="<?php echo e(asset('').session('language_image')); ?>" width="17px" />
                    </button>
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <?php echo e(session('language_name')); ?>

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

                  <!--  CHANGE Currency CODE SECTION -->
                  <?php if(count($currencies) > 1): ?>
                  <div class="dropdown">
                      <button class="btn" style="background:none;" href="#">
                       <?php if(session('symbol_left') != null): ?>
                       <span style="margin-right:-30px;"><?php echo e(session('symbol_left')); ?></span>
                       <?php else: ?>
                       <span style="margin-right:-30px;"><?php echo e(session('symbol_right')); ?></span>
                       <?php endif; ?>
                      </button>
                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                       <?php echo e(session('currency_code')); ?>

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
                    <!-- END  Currency LANGUAGE CODE SECTION -->
              </div>
              <div class="contact d-none d-md-block">
                <i class="fas fa-phone"></i> Call us Now 888-9636-6000
              </div>

            </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="header-maxi bg-header-bar ">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-2 pr-0">
              <div class="navigation-mobile-container">
                  <a href="javascript:void(0)" class="navigation-mobile-toggler">
                      <span class="fas fa-bars"></span>
                  </a>
                  <nav id="navigation-mobile">
                      <div class="logout-main">
                          <div class="welcome">
                            <span><?php if(auth()->guard('customer')->check()){ ?><?php echo app('translator')->get('website.Welcome'); ?>&nbsp;! <?php echo e(auth()->guard('customer')->user()->first_name); ?> <?php }?> </span>
                          </div>
                          <?php if(auth()->guard('customer')->check()): ?>
                          <div class="logout">
                              <a href="<?php echo e(url('logout')); ?>" class=""><?php echo app('translator')->get('website.Logout'); ?></a>
                          </div>
                          <?php endif; ?>
                      </div>

                      <a href="<?php echo e(url('/')); ?>" class="main-manu btn btn-primary">
                        <?php echo app('translator')->get('website.Home'); ?>
                      </a>

                      <a class="main-manu btn btn-primary" data-toggle="collapse" href="#shoppages" role="button" aria-expanded="false" aria-controls="shoppages">
                          <?php echo app('translator')->get('website.infoPages'); ?><span><i class="fas fa-chevron-down"></i></span>
                          <span><i class="fas fa-chevron-up"></i></span>
                      </a>
                      <div class="sub-manu collapse multi-collapse" id="shoppages">
                          <ul class="unorder-list">
                            <li class="">
                              <?php $__currentLoopData = $result['commonContent']['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <a href="<?php echo e(URL::to('/page?name='.$page->slug)); ?>" class="btn btn-primary">
                                <?php echo e($page->name); ?>

                              </a>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </li>
                          </ul>
                      </div>

                      <a class=" main-manu btn btn-primary" data-toggle="collapse" href="#productpages" role="button" aria-expanded="false" aria-controls="productpages">
                        <?php echo app('translator')->get('website.News'); ?> <span><i class="fas fa-chevron-down"></i></span>
                        <span><i class="fas fa-chevron-up"></i></span>
                      </a>
                      <div class="sub-manu collapse multi-collapse" id="productpages">
                          <ul class="unorder-list">
                            <li class="">
                              <?php $__currentLoopData = $result['commonContent']['newsCategories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <a href="<?php echo e(URL::to('/news?category='.$categories->slug)); ?>" class="btn btn-primary">
                                <?php echo e($categories->name); ?>

                              </a>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </li>
                          </ul>
                      </div>
                      <?php if(auth()->guard('customer')->check()){ ?>
                       <a href="<?php echo e(url('profile')); ?>" class="main-manu btn btn-primary"><?php echo app('translator')->get('website.Profile'); ?></a>
                       <a href="<?php echo e(url('wishlist')); ?>" class="main-manu btn btn-primary"><?php echo app('translator')->get('website.Wishlist'); ?></a>
                       <a href="<?php echo e(url('compare')); ?>" class="main-manu btn btn-primary"><?php echo app('translator')->get('website.Compare'); ?>&nbsp;(<span id="compare"><?php echo e($count); ?></span>)</a>
                       <a href="<?php echo e(url('orders')); ?>" class="main-manu btn btn-primary"><?php echo app('translator')->get('website.Orders'); ?></a>
                       <a href="<?php echo e(url('shipping-address')); ?>" class="main-manu btn btn-primary"><?php echo app('translator')->get('website.Shipping Address'); ?></a>
                       <a href="<?php echo e(url('logout')); ?>" class="main-manu btn btn-primary"><?php echo app('translator')->get('website.Logout'); ?></a>
                      <?php }else{ ?>
                        <div class="nav-link"><?php echo app('translator')->get('website.Welcome'); ?>!</div>
                         <a href="<?php echo e(URL::to('/login')); ?>" class="main-manu btn btn-primary"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;<?php echo app('translator')->get('website.Login/Register'); ?></a>
                       <?php } ?>
                  </nav>
              </div>

          </div>



          <div class="col-8">
            <a href="<?php echo e(URL::to('/')); ?>" class="logo">
            <?php if($result['commonContent']['setting'][77]->value=='name'): ?>
            <?=stripslashes($result['commonContent']['setting'][78]->value)?>
            <?php endif; ?>

            <?php if($result['commonContent']['setting'][77]->value=='logo'): ?>
            <img src="<?php echo e(asset('').$result['commonContent']['setting'][15]->value); ?>" alt="<?=stripslashes($result['commonContent']['setting'][79]->value)?>">
            <?php endif; ?>
           </a>
          </div>

          <div class="col-2 pl-0">
              <div class="cart-dropdown dropdown head-cart-content">
               <?php echo $__env->make('autoshop.headers.cartButtons.cartButton', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-navbar bg-menu-bar">
      <div class="container">
        <form class="form-inline" action="<?php echo e(URL::to('/shop')); ?>" method="get">
          <div class="search">
            <div class="select-control">
              <select class="form-control" name="category">
                <?php productCategories(); ?>
              </select>
            </div>
            <input  type="search" placeholder="Search entire store here">
            <button class="btn btn-secondary" type="submit">
            <i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>
    </div>
</header>
<?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/web/headers/mobile.blade.php ENDPATH**/ ?>