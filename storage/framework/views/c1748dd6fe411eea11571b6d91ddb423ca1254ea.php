<!-- //footer style One -->
 <footer id="footerOne" class="footer-area footer-one footer-desktop d-none d-lg-block d-xl-block">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-3">
          <div class="single-footer">
            <h5><?php echo app('translator')->get('website::default.footer_contact_info'); ?></h5>
            <div class="row">
              <div class="col-12 col-lg-8">
                <hr>
              </div>
            </div>
            <ul class="contact-list  pl-0 mb-0">
			
			<li> <i class="fas fa-map-marker"></i><span>Sobha Ivory 1, Business Bay,<br>Office No.#803, Po.Box-15459,<br>Dubai U.A.E.</span> </li>
			<li> <i class="fas fa-phone"></i><span>Office: 04 222 79 73<br>Mobile: 054 55 75 644</span> </li>
			<li> <i class="fas fa-envelope"></i><span> <a href="mailto:info@g2g.ae">info@g2g.ae</a> </span> </li>
			

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
                <li> <a href="<?php echo e(URL::to('/shop')); ?>"><i class="fa fa-angle-right"></i>Shop</a> </li>
                <li> <a href="<?php echo e(URL::to('/orders')); ?>"><i class="fa fa-angle-right"></i>Orders</a> </li>
                <li> <a href="<?php echo e(URL::to('/viewcart')); ?>"><i class="fa fa-angle-right"></i>Shopping Cart</a> </li>
                <li> <a href="<?php echo e(URL::to('/wishlist')); ?>"><i class="fa fa-angle-right"></i>Wishlist</a> </li>
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
                  <li> <a href="<?php echo e(route('page.term-and-condtions')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website::default.terms_and_conditions'); ?></a> </li>
				  <li><a href="<?php echo e(route('page.faq')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website::default.faq'); ?></a></li>
				  <li><a href="<?php echo e(route('page.privacy')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website::default.privacy'); ?></a></li>
				  <li><a href="<?php echo e(route('page.contact-us')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website::default.contact_us'); ?></a></li>
					  
            </ul>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="single-footer single-footer-right">
            <h5><?php echo app('translator')->get('website::default.footer_quick_links'); ?></h5>
            <div class="row">
                <div class="col-12 col-lg-8">
                  <hr>
                </div>
              </div>
            <ul class="links-list pl-0 mb-0">
				<li> <a href="<?php echo e(URL::to('/')); ?>"><i class="fa fa-angle-right"></i>Home</a> </li>
				<li><a href="<?php echo e(route('page.about-us')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website::default.about_us'); ?></a></li>
				<li><a href="<?php echo e(route('listings.workshops-garages',['category' => 'all'])); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website::default.workshop_garage'); ?></a></li>
				<li><a href="<?php echo e(route('page.package-price')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website::default.packages'); ?></a></li>
				
				
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
</footer>
<?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/web/footers/footer1.blade.php ENDPATH**/ ?>