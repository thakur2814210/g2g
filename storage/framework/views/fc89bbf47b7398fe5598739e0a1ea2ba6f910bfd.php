 <footer class="plus_border">
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h3 data-target="#collapse_ft_1" class="d-block d-sm-none">About G2G</h3>
                    <div class="collapse dont-collapse-sm" id="collapse_ft_1">
						<img class="mt-2 mb-3" src="<?php echo e(asset('website-theme/img/logo/logo-g2g.png')); ?>">
						<p><?php echo app('translator')->get('website::default.footer_text'); ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h3 data-target="#collapse_ft_2"><?php echo app('translator')->get('website::default.footer_quick_links'); ?></h3>
                    <div class="collapse dont-collapse-sm" id="collapse_ft_2">
                        <ul class="links">
                            <?php if(Auth::guard('admin')->check()): ?>
                                  
                                <?php if(Auth::guard('admin')->check()): ?>
                                    <li><a href="<?php echo e(route('superadmin.dashboard')); ?>"><?php echo app('translator')->get('website::default.dashboard'); ?></a></li>
                                    <li><a href="<?php echo e(route('superadmin.logout')); ?>" ><?php echo app('translator')->get('website::default.logout'); ?></a></li>
                                <?php endif; ?>
                            <?php else: ?>
                                <li><a href="<?php echo e(route('superadmin.login')); ?>"><?php echo app('translator')->get('website::default.admin_login'); ?></a></li>
                            <?php endif; ?>
                           
                            <li><a href="<?php echo e(route('page.homepage')); ?>"> <?php echo app('translator')->get('website::default.home'); ?> </a></li>
                            <li><a href="<?php echo e(route('page.about-us')); ?>"><?php echo app('translator')->get('website::default.about_us'); ?></a></li>
                            <li><a href="<?php echo e(route('listings.workshops-garages',['category' => 'all'])); ?>"><?php echo app('translator')->get('website::default.workshop_garage'); ?></a></li>
                            <li><a href="<?php echo e(route('page.package-price')); ?>"> <?php echo app('translator')->get('website::default.packages'); ?></a></li>
                            <li><a href="<?php echo e(route('page.faq')); ?>"> <?php echo app('translator')->get('website::default.faq'); ?></a></li>
                            <li><a href="<?php echo e(route('page.contact-us')); ?>"> <?php echo app('translator')->get('website::default.contact_us'); ?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h3 data-target="#collapse_ft_3"><?php echo app('translator')->get('website::default.footer_categories'); ?></h3>
                    <div class="collapse dont-collapse-sm" id="collapse_ft_3">
                        <ul class="links">
                            <?php $__currentLoopData = $main_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('listings.workshops-garages',['category' => $category->slug])); ?>"><?php echo e($category->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h3 data-target="#collapse_ft_4"><?php echo app('translator')->get('website::default.footer_contact_info'); ?></h3>
                    <div class="collapse dont-collapse-sm" id="collapse_ft_4">
                        <ul class="contacts">
                            <?php if($contactusinfos->count()): ?>
                                <?php
                                    $contactusinfo = $contactusinfos->first(); 
                                ?>
                                <li><i class="ti-home"></i>
                                    <?php if(\Config::get('app.locale') == 'en'): ?>
                                        <a><?php echo e($contactusinfo->address_en); ?></a>
                                    <?php else: ?>
                                        <a><?php echo e($contactusinfo->address_ar); ?></a>
                                    <?php endif; ?>
                                </li>
                                <li><i class="ti-headphone-alt"></i>Office: <?php echo e($contactusinfo->phone); ?><br>Mobile: <?php echo e($contactusinfo->mobile); ?></li>
                                <li><i class="ti-email"></i><a href="mailto:info@g2g.ae"><?php echo e($contactusinfo->email); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <hr>
            <div class="row">
                <div class="col-lg-12 ">
					<img src="<?php echo e(asset('web/images/miscellaneous/payments.png')); ?>">
                    <ul id="additional_links">
                        <li><a href="<?php echo e(route('page.term-and-condtions')); ?>"><?php echo app('translator')->get('website::default.terms_and_conditions'); ?></a></li>
                        <li><a href="<?php echo e(route('page.privacy')); ?>"><?php echo app('translator')->get('website::default.privacy'); ?></a></li>
                        <li><span>G2G©<?php echo date('Y'); ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Website/Resources/views/include/footer.blade.php ENDPATH**/ ?>