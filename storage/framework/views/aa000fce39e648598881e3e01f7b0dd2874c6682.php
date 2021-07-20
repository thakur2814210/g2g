<!-- //header style One -->
<header id="headerOne" class="header-area header-one header-desktop d-none d-lg-block d-xl-block">
    <div class="header-mini bg-top-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
            <nav id="navbar_0_2" class="navbar navbar-expand-md navbar-dark navbar-0">
              
              <div class="navbar-lang">

                <?php if(count($languages) > 1): ?>

               

                <div class="dropdown changeLanguageBtn">

                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <img src="<?php echo e(asset('').session('language_image')); ?>" width="17px" />
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
                  
              </div>
              <div class="navbar-collapse">
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
                        <li class="nav-item"> <a href="<?php echo e(url('logout')); ?>" class="nav-link padding-r0"><?php echo app('translator')->get('website.Logout'); ?></a> </li>
                      <?php }else{ ?>
                        <li class="nav-item"><div class="nav-link"><?php echo app('translator')->get('website.Welcome'); ?>!</div></li>
                      
                        <!--li class="nav-item"> <a href="<?php echo e(URL::to('/login')); ?>" class="nav-link -before"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp; <?php echo app('translator')->get('website.Login/Register'); ?></a> </li-->


                        <li class="nav-item dropdown">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              <i class="fa fa-lock" aria-hidden="true"></i>&nbsp; 
                              <?php echo app('translator')->get('website.Login/Register'); ?>
                            </a>
                            <ul class="dropdown-menu" style="background-color: #E23828;padding:0px;margin:0px;">

                                <a href="<?php echo e(URL::to('/login')); ?>" class="nav-link -before" style="border:1px solid #c1c0c0;color: #fff;font-weight:bold;">
                                  <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;<?php echo app('translator')->get('website.customer'); ?>
                                </a> 
                                 <a href="<?php echo e(URL::to('/login')); ?>" class="nav-link -before" style="color: #fff;font-weight:bold;">
                                  <i class="fa fa-building" aria-hidden="true"></i>&nbsp;<?php echo app('translator')->get('website.garage'); ?>
                                </a> 
                            </ul>
                          </div>
                        </li>

                      <?php } ?>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="header-navbar logo-nav bg-menu-bar">
      <div class="container">
        <nav id="navbar_1_2" class="navbar navbar-expand-lg  bg-nav-bar">
        <a href="<?php echo e(URL::to('/')); ?>" class="logo">
    <?php if($result['commonContent']['setting'][77]->value=='name'): ?>
    <?=stripslashes($result['commonContent']['setting'][78]->value)?>
    <?php endif; ?>

    <?php if($result['commonContent']['setting'][77]->value=='logo'): ?>
    <img src="<?php echo e(asset('').$result['commonContent']['setting'][15]->value); ?>" alt="<?=stripslashes($result['commonContent']['setting'][79]->value)?>">
    <?php endif; ?>
    </a>
          <div class=" navbar-collapse">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link " href="<?php echo e(route('page.homepage')); ?>" >
                    <?php echo app('translator')->get('website.Home'); ?>
                  </a>
                </li>
              
              <li class="nav-item ">
              <a href="<?php echo e(route('page.about-us')); ?>"class="nav-link"><?php echo app('translator')->get('website.about_g2g'); ?></a>
              </li>
              <li class="nav-item ">
              <a href="<?php echo e(route('listings.workshops-garages',['category' => 'all'])); ?>"class="nav-link"><?php echo app('translator')->get('website.workshop_&_garages'); ?></a>
              </li>
              <li class="nav-item ">
              <a href="<?php echo e(route('page.package-price')); ?>"class="nav-link"><?php echo app('translator')->get('website.packages'); ?></a>
              </li>
              <li class="nav-item ">
              <a href="<?php echo e(route('page.faq')); ?>"class="nav-link"><?php echo app('translator')->get('website.faq'); ?></a>
              </li>
               <li class="nav-item dropdown">
                <a class="nav-link" href="<?php echo e(url('contact')); ?>" >
                  <?php echo app('translator')->get('website.Contact Us'); ?>
                </a>
              </li>
                <li class="nav-item ">
                      <a href="<?php echo e(url('/shop')); ?>"  class="btn btn-secondary"> 
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>&nbsp;<?php echo app('translator')->get('website.autoshop'); ?></a>
                    </li>
              </ul>
            </div>

        </nav>
      </div>
    </div>
  </header>
<?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/website/headers/headerOne.blade.php ENDPATH**/ ?>