<header class="header_in is_sticky">
	<div class="container">
		<div id="logo">
			<a href="<?php echo e(route('page.homepage')); ?>" title="G2G">
				<img src="<?php echo e(asset('website-theme/img/logo/logo-g2g.png')); ?>" height="44" alt="" class="logo_sticky">
			</a>
		</div>
		<a href="#menu" class="btn_mobile">
			<div class="hamburger hamburger--spin" id="hamburger">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
			</div>
		</a>
		<nav id="menu" class="main-menu">
			
			<ul>
				<li><span><a href="<?php echo e(route('page.homepage')); ?>"> <?php echo app('translator')->get('website::default.home'); ?> </a></span></li>
				<li><span><a href="<?php echo e(route('page.about-us')); ?>"><?php echo app('translator')->get('website::default.about_us'); ?></a></span></li>
				<li><span><a href="<?php echo e(route('listings.workshops-garages',['category' => 'all'])); ?>"><?php echo app('translator')->get('website::default.workshop_garage'); ?></a></span></li>
				<li><span><a href="<?php echo e(route('page.package-price')); ?>"> <?php echo app('translator')->get('website::default.packages'); ?></a></span></li>
				<li><span><a href="<?php echo e(route('page.faq')); ?>"> <?php echo app('translator')->get('website::default.faq'); ?></a></span></li>
				<li><span><a href="<?php echo e(route('page.contact-us')); ?>"> <?php echo app('translator')->get('website::default.contact_us'); ?></a></span></li>
				
	             <li>
	             	<?php if(\Config::get('app.locale') == 'en'): ?>
						<a href="javascript:void(0)"><img height="20" width="20" src="<?php echo e(asset('website-theme/img/uk.png')); ?>" /> English (En)</a>
	             	<?php elseif(\Config::get('app.locale') == 'ar'): ?>
						<a href="javascript:void(0)"><img height="20" width="20" src="<?php echo e(asset('website-theme/img/uae.png')); ?>" /> عربى (Ar)</a>
	             	<?php endif; ?>
	             	
					<ul>
                        <li><a href="<?php echo e(route('lang.switch', ['lang' => 'en'])); ?>"><img height="20" width="20" src="<?php echo e(asset('website-theme/img/uk.png')); ?>" /> English (En)</a></li>
                        <li><a href="<?php echo e(route('lang.switch', ['lang' => 'ar'])); ?>"><img height="20" width="20" src="<?php echo e(asset('website-theme/img/uae.png')); ?>" /> عربى (Ar)</a></li>
                    </ul>
				</li>

				<?php if(
	           		Auth::guard('admin')->check() || 
	           		Auth::guard('client')->check() || 
	           		Auth::guard('garage')->check()
	           		): ?>
	            	<li><span>
		            		<a href="javascript:void(0)" class="text-danger btn_add">
		            			My Account
		            		</a>
	            		</span>
						<ul>
							<?php if(Auth::guard('admin')->check()): ?>
			                    <li><a href="<?php echo e(route('superadmin.dashboard')); ?>">SuperAdmin: <?php echo e(Auth::guard('admin')->user()->username); ?></a></li>
			                    <li><a href="<?php echo e(route('superadmin.logout')); ?>" ><?php echo app('translator')->get('website::default.logout'); ?></a></li>
			                <?php elseif(Auth::guard('garage')->check()): ?>
			                    <li><a href="<?php echo e(route('garage.dashboard')); ?>" >Garage: <?php echo e(Auth::guard('garage')->user()->username); ?></a></li>
			                    <li><a href="<?php echo e(route('garage.logout')); ?>" ><?php echo app('translator')->get('website::default.logout'); ?></a></li>
			                <?php elseif(Auth::guard('client')->check()): ?>
			                    <li><a href="<?php echo e(route('client.dashboard')); ?>" >Customer: <?php echo e(Auth::guard('client')->user()->username); ?></a></li>
			                     <li><a href="<?php echo e(route('client.logout')); ?>" ><?php echo app('translator')->get('website::default.logout'); ?></a></li>
			                <?php endif; ?>
		            	</ul>
		            </li>
				<?php else: ?>
					 <li><span><a href="javascript:void(0)" class="text-danger btn_add"><?php echo app('translator')->get('website::default.sign_in'); ?></a></span>
	                    <ul>
	                        <li><a href="<?php echo e(route('client.login')); ?>"><?php echo app('translator')->get('website::default.customer'); ?></a></li>
	                        <li><a href="<?php echo e(route('garage.login')); ?>"><?php echo app('translator')->get('website::default.garage'); ?></a></li>
	                    </ul>
	                </li>
	            <?php endif; ?>
	            <li><a class="text-danger btn_add" href="<?php echo e(route('autoshop.homepage')); ?>"> <?php echo app('translator')->get('website::default.auto_shop'); ?></a></li>
			</ul>
		</nav>
	</div>
</header>
    <!-- /header --><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Website/Resources/views/include/page-header.blade.php ENDPATH**/ ?>