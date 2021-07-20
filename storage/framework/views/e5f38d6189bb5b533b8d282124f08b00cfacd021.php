<!-- //header style One -->
<header id="headerOne" class="header-area header-one header-desktop d-none d-lg-block d-xl-block sticky-top">
    <div class="header-mini bg-top-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
            <nav id="navbar_0_2" class="navbar navbar-expand-md navbar-dark navbar-0">
              <div class="navbar-lang">

                <?php if(count($languages) > 1): ?>
                <div class="dropdown">

                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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
                              <span>
                                <?php if(auth()->guard('customer')->check()): ?> 
                                  <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;<?php echo app('translator')->get('labels.Hi'); ?>&nbsp;
                                  <?php echo e(auth()->guard('customer')->user()->first_name); ?> <?php echo e(auth()->guard('customer')->user()->last_name); ?>

                                
                                <?php endif; ?> 
                             
                                <?php if(auth()->guard('vendor')->check()): ?>  
                                   <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;<?php echo app('translator')->get('labels.Hi'); ?>&nbsp;
                                  <?php echo e(auth()->guard('vendor')->user()->first_name); ?> <?php echo e(auth()->guard('vendor')->user()->last_name); ?>

                                   
                                <?php endif; ?> 

                              
                                <?php if(auth()->check() && auth()->user()->role_id == 1 ): ?> 
                                 <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;<?php echo app('translator')->get('labels.Hi'); ?>&nbsp;
                                  <?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?>

                                  
                                <?php endif; ?> 
                              
                            </span>
                        </div>
                      </li>
                      <?php if(auth()->guard('customer')->check()): ?>
                        <li class="nav-item"> <a href="<?php echo e(url('dashboard')); ?>" class="nav-link" ><i class="fa fa-home" aria-hidden="true"></i> <?php echo app('translator')->get('website.My Account'); ?></a> </li>
                        
                        <li class="nav-item"> <a href="<?php echo e(url('logout')); ?>" class="nav-link padding-r0"><i class="fa fa-paper-plane" aria-hidden="true"></i> <?php echo app('translator')->get('website.Logout'); ?></a> </li>

                      <?php elseif(auth()->guard('vendor')->check()): ?>
                        <li class="nav-item"> <a href="<?php echo e(URL::to('/garage/dashboard')); ?>" class="nav-link" ><i class="fa fa-home" aria-hidden="true"></i> <?php echo app('translator')->get('website.My Account'); ?></a> </li>

                        <li class="nav-item"> <a href="<?php echo e(url('vlogout')); ?>" class="nav-link padding-r0"><i class="fa fa-paper-plane" aria-hidden="true"></i> <?php echo app('translator')->get('website.Logout'); ?></a> </li>

                      <?php elseif(auth()->check() && auth()->user()->role_id == 1 ): ?>          
                        <li class="nav-item"> <a href="<?php echo e(URL::to('/admin/dashboard/this_month')); ?>" class="nav-link"><i class="fa fa-home" aria-hidden="true"></i> <?php echo app('translator')->get('website.My Account'); ?></a> </li>

                        <li class="nav-item"> <a href="<?php echo e(url('vlogout')); ?>" class="nav-link padding-r0"><i class="fa fa-paper-plane" aria-hidden="true"></i> <?php echo app('translator')->get('website.Logout'); ?></a> </li>

                      <?php else: ?>

                        <li class="nav-item"><div class="nav-link"><?php echo app('translator')->get('website.Welcome'); ?>!</div></li>
                        <li class="nav-item"> <a href="<?php echo e(URL::to('/login')); ?>" class="nav-link -before"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;<?php echo app('translator')->get('website.Login'); ?></a> </li>
                        <li class="nav-item"> <a href="<?php echo e(URL::to('/register')); ?>" class="nav-link -before">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;<?php echo app('translator')->get('website.register'); ?></a> </li>

                      <?php endif; ?>
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
        <a href="<?php echo e(URL::to('/autoshop')); ?>" class="logo">
    <?php if($result['commonContent']['setting'][77]->value=='name'): ?>
    <?=stripslashes($result['commonContent']['setting'][78]->value)?>
    <?php endif; ?>

    <?php if($result['commonContent']['setting'][77]->value=='logo'): ?>
    <img src="<?php echo e(asset('').$result['commonContent']['setting'][15]->value); ?>" alt="<?=stripslashes($result['commonContent']['setting'][79]->value)?>">
    <?php endif; ?>
    <!--span class="autoshop-logo-text"><?php echo app('translator')->get('website.autoshop'); ?></span-->
    </a>
          <div class=" navbar-collapse">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link " href="<?php echo e(route('page.homepage')); ?>" >
                    <?php echo app('translator')->get('website.Home'); ?>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link" href="<?php echo e(url('/shop')); ?>"  >
                    <?php echo app('translator')->get('labels.link_products'); ?>
                    <span class="badge badge-secondary"><?php echo app('translator')->get('website.browse'); ?></span>
                  </a>

                </li>
               
              <li class="nav-item ">
              <a href="<?php echo e(route('page.about-us')); ?>"class="nav-link"><?php echo app('translator')->get('website.about_g2g'); ?></a>
              </li>
              <li class="nav-item ">
             <!--a href="javascript:void(0)" onclick="getAllGarageList()" class="nav-link"><?php echo app('translator')->get('website.workshop_&_garages'); ?></a-->
              <a href="<?php echo e(URL::to('listings/workshops-garages/near-by-garages')); ?>" class="nav-link"><?php echo app('translator')->get('website.workshop_&_garages'); ?></a>
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
           
              </ul>
            </div>

        </nav>
      </div>
    </div>
    <?php if(!\Request::is('login') && !\Request::is('register') && !\Request::is('resend-verification-email') && !\Request::is('forgotPassword') && !\Request::is('recoverPassword')): ?> 
    <div class="header-maxi bg-header-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-lg-8">

            <form class="form-inline" action="<?php echo e(URL::to('/shop')); ?>" method="get">
              <div class="search">
                  <div class="select-control">
                    <select class="form-control" id="searchCategory" name="category">
                     <?php echo $__env->make('autoshop.common.HeaderCategories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     <?php    productCategories(); ?>
                    </select>
                  </div>

                  <?php if( Config::get('app.locale') == 'en'): ?>
                     <input type="search"  name="search" class="typeahead" placeholder="<?php echo app('translator')->get('website.Search entire store here'); ?>..." value="<?php echo e(app('request')->input('search')); ?>" aria-label="<?php echo app('translator')->get('website.Search entire store here'); ?>...">
                  <?php else: ?>
                     <input type="search"  name="search" class="typeahead" dir="rtl" placeholder="<?php echo app('translator')->get('website.Search entire store here'); ?>..." value="<?php echo e(app('request')->input('search')); ?>" aria-label="<?php echo app('translator')->get('website.Search entire store here'); ?>...">
                  <?php endif; ?>
                   
                  <button class="btn btn-secondary" type="submit">
                  <i class="fa fa-search"></i></button>
              </div>
            </form>
          </div>
          <div class="col-12 col-lg-4">
            <ul class="top-right-list">
              <li class="nav-item ">
                      <a href="<?php echo e(url('shop?type=special')); ?>"class="btn btn-secondary btn-lg" >
                      <i class="fa fa-tags" style="color: #fff;"></i>&nbsp;
                      <?php echo app('translator')->get('website.SPECIAL DEALS'); ?></a>
                    </li>
              <li class="cart-header dropdown head-cart-content d-none d-md-block">
                <?php $qunatity=0; ?>
                                <?php $__currentLoopData = $result['commonContent']['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                	<?php $qunatity += $cart_data->customers_basket_quantity; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <a href="#" id="dropdownMenuButton" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <!--span class="badge badge-secondary"><?php echo e($qunatity); ?></span-->
                                    <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                    <!--<img class="img-fluid" src="<?php echo e(asset('').'public/images/shopping_cart.png'); ?>" alt="icon">-->

                                    <span class="block">
                                    	<span class="title"><?php echo app('translator')->get('website.My Cart'); ?></span>
                                        <?php if(count($result['commonContent']['cart'])>0): ?>
                                            <span class="items"><?php echo e(count($result['commonContent']['cart'])); ?>&nbsp;<?php echo app('translator')->get('website.items'); ?></span>
                                        <?php else: ?>
                                            <span class="items">(0)&nbsp;<?php echo app('translator')->get('website.item'); ?></span>
                                        <?php endif; ?>
                                    </span>
                                </a>

                                <?php if(count($result['commonContent']['cart'])>0): ?>
                                <?php
                                $default_currency = DB::table('currencies')->where('is_default',1)->first();
                                if($default_currency->id == Session::get('currency_id')){

                                  $currency_value = 1;
                                }else{
                                  $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();

                                  $currency_value = $session_currency->value;
                                }
                                ?>
                                <div class="shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right" aria-labelledby="dropdownCartButton_9">
                                    <ul class="shopping-cart-items">
                                        <?php
                                            $total_amount=0;
                                            $qunatity=0;
                                        ?>
                                        <?php $__currentLoopData = $result['commonContent']['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php
                                          
                					             	$total_amount += $cart_data->final_price*$cart_data->customers_basket_quantity;
                					            	$qunatity 	  += $cart_data->customers_basket_quantity; ?>
                                        <li>
                                            <div class="item-thumb">
                                            	<a href="<?php echo e(URL::to('/deleteCart?id='.$cart_data->customers_basket_id)); ?>" class="icon" ><img class="img-fluid" src="<?php echo e(asset('').'web/images/close.png'); ?>" alt="icon"></a>
                                            	<div class="image">
                                                	<img class="img-fluid" src="<?php echo e(asset('').$cart_data->image); ?>" alt="<?php echo e($cart_data->products_name); ?>"/>
                                                </div>
                                            </div>
                                            <div class="item-detail">
                                              <h2 class="item-name">
                                                  <a href="<?php echo e(URL::to('/product-detail/'.$cart_data->products_slug)); ?>"><?php echo e($cart_data->products_name); ?></a></h2>
                                              <span class="item-quantity"><?php echo app('translator')->get('website.Qty'); ?>&nbsp;:&nbsp;<?php echo e($cart_data->customers_basket_quantity); ?></span>
                                              <span class="item-price"><?php echo e(Session::get('symbol_left')); ?><?php echo e($cart_data->final_price*$cart_data->customers_basket_quantity*$currency_value); ?><?php echo e(Session::get('symbol_right')); ?></span>
                                           </div>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                      <div class="tt-summary">
                                      	  <p><?php echo app('translator')->get('website.items'); ?><span><?php echo e($qunatity); ?></span></p>
                                        	<p><?php echo app('translator')->get('website.SubTotal'); ?><span><?php echo e(Session::get('symbol_left')); ?><?php echo e($total_amount*$currency_value); ?><?php echo e(Session::get('symbol_right')); ?></span></p>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="buttons">
                                          <a class="btn btn-dark" href="<?php echo e(URL::to('/viewcart')); ?>"><?php echo app('translator')->get('website.View Cart'); ?></a>
                                          <a class="btn btn-secondary" href="<?php echo e(URL::to('/checkout')); ?>"><?php echo app('translator')->get('website.Checkout'); ?></a>
                                      </div>
                                   </li>
                                 </ul>

                                </div>

                				<?php else: ?>

                          <div class="shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                              <ul class="shopping-cart-items">
                                  <li><?php echo app('translator')->get('website.You have no items in your shopping cart'); ?></li>
                              </ul>
                          </div>
                        <?php endif; ?>

              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </header>
<?php /**PATH D:\xampp74\htdocs\g2g\resources\views/autoshop/headers/headerOne.blade.php ENDPATH**/ ?>