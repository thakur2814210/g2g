<!-- //footer style One -->
 <footer id="footerOne" class="footer-area footer-one footer-desktop ">
    <div class="wrapper">
		<div class="container">
		  <div class="row">
			<div class="col-12 col-lg-3">
			  <div class="single-footer">
				<h5><?php echo app('translator')->get('website.footer_contact_info'); ?></h5>
				<div class="row">
				  <div class="col-12 col-lg-8">
					<hr>
				  </div>
				</div>
				<?php $contactusinfo = \DB::table('contact_us')->first(); ?>
				<ul class="contact-list  pl-0 mb-0">
					  <li> <i class="fas fa-map-marker"></i>&nbsp;&nbsp;&nbsp;<span><?php echo e(( \Config::get('app.locale') == 'en' ) ? $contactusinfo->address_en : $contactusinfo->address_ar); ?></span> </li>
				  <li> <i class="fas fa-phone"></i><span>Office: <?php echo e($contactusinfo->phone); ?><br>Mobile: <?php echo e($contactusinfo->mobile); ?></span> </li>
				  <li> <i class="fas fa-envelope"></i><span> <a href="mailto:info@g2g.ae"><?php echo e($contactusinfo->email); ?></a> </span> </li>

				</ul>
			  </div>
			</div>
			<div class="col-12 col-md-6 col-lg-3">
			  <div class="footer-block">
				  <div class="single-footer single-footer-left">
					<h5><?php echo app('translator')->get('website.Our Services'); ?></h5>
					<div class="row">
						<div class="col-12 col-lg-8">
						  <hr>
						</div>
					  </div>
					<ul class="links-list pl-0 mb-0">
					<li> <a href="<?php echo e(URL::to('/shop')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.Shop'); ?></a> </li>
					<li> <a href="<?php echo e(URL::to('/orders')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.Orders'); ?></a> </li>
					<li> <a href="<?php echo e(URL::to('/viewcart')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.Shopping Cart'); ?></a> </li>
					<li> <a href="<?php echo e(URL::to('/wishlist')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.Wishlist'); ?></a> </li>
					</ul>
				  </div>

			  </div>
			</div>
			<div class="col-12 col-md-6 col-lg-3">
			  <div class="single-footer single-footer-right">
				<h5><?php echo app('translator')->get('website.Information'); ?></h5>
				<div class="row">
					<div class="col-12 col-lg-8">
					  <hr>
					</div>
				  </div>
				<ul class="links-list pl-0 mb-0">
				  <?php if(count($result['commonContent']['pages'])): ?>
					  <?php $__currentLoopData = $result['commonContent']['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						  <li> <a href="<?php echo e(URL::to('/page?name='.$page->slug)); ?>"><i class="fa fa-angle-right"></i><?php echo e($page->name); ?></a> </li>
					  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				  <?php endif; ?>
					  <li> <a href="<?php echo e(route('page.term-and-condtions')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.terms_and_conditions'); ?></a> </li>
					  <li><a href="<?php echo e(route('page.faq')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.faq'); ?></a></li>
					  <li><a href="<?php echo e(route('page.privacy')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.privacy'); ?></a></li>
					  <li><a href="<?php echo e(route('page.contact-us')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.contact_us'); ?></a></li>
				</ul>
			  </div>
			</div>
			<div class="col-12 col-md-6 col-lg-3">
			  <div class="single-footer single-footer-right">
				<h5><?php echo app('translator')->get('website.footer_quick_links'); ?></h5>
				<div class="row">
					<div class="col-12 col-lg-8">
					  <hr>
					</div>
				  </div>
				<ul class="links-list pl-0 mb-0">
					<li> <a href="<?php echo e(URL::to('/')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.Home'); ?></a> </li>
					<li><a href="<?php echo e(route('page.about-us')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.about_us'); ?></a></li>
					<li><a href="<?php echo e(route('listings.workshops-garages',['category' => 'all'])); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.workshop_garage'); ?></a></li>
					<li><a href="<?php echo e(route('page.package-price')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.packages'); ?></a></li>
				</ul>
			  </div>
			</div>

			
		  </div>
		</div>
		<div class="container-fluid p-0">
			<div class="copyright-content">
				<div class="container">
				  <div class="row align-items-center">
					  <div class="col-12 col-md-6">
						<div class="footer-image">
							<img class="img-fluid" src="<?php echo e(asset('web/images/miscellaneous/payments.png')); ?>">
						</div>

					  </div>
					  <div class="col-12 col-md-6">
						<div class="footer-info">
						G2G©<?php echo date('Y'); ?>
						</div>

					  </div>
				  </div>
				</div>
			  </div>
		</div>
    </div>
</footer>
<?php /**PATH /home/g2g/public_html/resources/views/autoshop/footers/footer1.blade.php ENDPATH**/ ?>