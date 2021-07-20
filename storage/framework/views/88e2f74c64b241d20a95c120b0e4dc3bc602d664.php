<?php $__env->startSection('website_css_pre'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_css'); ?>
    <style>
         #error-in-dialog{
            background: #fff;
            padding: 30px;
            padding-top: 0;
            text-align: left;
            max-width: 400px;
            margin: 40px auto;
            position: relative;
            box-sizing: border-box;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -ms-border-radius: 4px;
            border-radius: 4px;
        }
    </style>

    <?php if(\Config::get('app.locale') == 'ar'): ?>
        <style>
            .owl-carousel,
            .bx-wrapper { direction: ltr; }
            .owl-carousel .owl-item { direction: rtl; }
        </style>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<main class="pattern">
        		
		<section class="hero_single version_2">
            <div class="wrapper">
                <div class="container">
                    <h3><?php echo app('translator')->get('website::default.homapage_slider_text_1'); ?></h3>
                    <p><?php echo app('translator')->get('website::default.homapage_slider_text_2'); ?></p>

                    <form method="get" action="<?php echo e(route('listings.search-by-location')); ?>">
                    	<div class="row no-gutters custom-search-input-2">
                            <input type="hidden" name="latitude" id="latitude" value="">
                            <input type="hidden" name="longitude" id="longitude" value="">
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <input type="text" name="address" id="autocomplete" class="form-control" placeholder="Location/City/Address">
                                    <i class="icon_search"></i>
                                </div>
                                 <i class="pe-7s-edit toogle-distance-slider"></i>
                                <div class="distance-slider" style="display: none;">
                                    <div class="text-primary mb-2">Distance: <span id="distance-value">5</span>KM</div>
                                    <input id="thedistance" name="distance" type="range" min="0" max="1000" step="5" value="5" >
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <select class="wide" name="category">
                                    <option value="all">All Categories</option>	
                                    <?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    	<option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <input type="submit" value="Search">
                            </div>
                        </div>
                        <!-- /row -->
                    </form>
                     <div class="row">
                          <div class="col-12">
                            <br/>
                            <?php if(session('status')): ?>
                                <div class="alert alert-warning">
                                    <?php echo e(session('status')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /hero_single -->
        
        <div class="main_categories">
            <div class="container">
                <ul class="clearfix row">
                    <li class="col-2">
                               
                        <a href="#" >
                            <i class="ti-shopping-cart"></i>
                            <label class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 500"><?php echo app('translator')->get('website::default.auto_shop'); ?></label>
                        </a>
                        <p><small><?php echo app('translator')->get('website::default.auto_shop'); ?></small></p>
                    </li>
                	<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($category->type == 1 && $category->slug != 'custom-request'): ?>
                            <li class="col-2">
                                <?php if(Auth::guard('client')->check()): ?>
                                    <a href="<?php echo e(route('client.service-request.create',['category' => $category->slug])); ?>">
                                <?php elseif(Auth::guard('admin')->check() || Auth::guard('garage')->check()): ?>
                                    <a href="#error-in-dialog"  class="login error-in-modal">
                                <?php else: ?>
                                    <a href="#sign-in-dialog" data-slug="<?php echo e($category->slug); ?>" data-page="service-request"  class="login sign-in-modal" >
                                <?php endif; ?>
                                    <i class="<?php echo e($category->cat_icon); ?>"></i>
                                    <label class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 500"><?php echo e($category->sections_name); ?></label>
                                </a>
                                <p><small><?php echo app('translator')->get('website::default.Service Request'); ?></small></p>
                            </li>
                        <?php endif; ?>
                	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($category->type == 1 && $category->slug == 'custom-request'): ?>
                            <li class="col-2">
                            <?php if(Auth::guard('client')->check()): ?>
                                <a href="<?php echo e(route('client.service-request.create',['category' => $category->slug])); ?>">
                            <?php elseif(Auth::guard('admin')->check() || Auth::guard('garage')->check()): ?>
                                <a href="#error-in-dialog"  class="login error-in-modal">
                            <?php else: ?>
                                <a href="#sign-in-dialog" data-slug="<?php echo e($category->slug); ?>" data-page="service-request"  class="login sign-in-modal" >
                            <?php endif; ?>
                                    <i class="<?php echo e($category->cat_icon); ?>"></i>
                                    <label class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 500"><?php echo e($category->sections_name); ?></label>
                                </a>
                                <p><small><?php echo app('translator')->get('website::default.Service Request'); ?></small></p>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($category->type == 2 && $category->slug != 'custom-package'): ?>
                            <li class="col-2">
                            <?php if(Auth::guard('client')->check()): ?>
                                <a href="<?php echo e(route('client.package-subscription.create',['category' => $category->slug])); ?>">
                            <?php elseif(Auth::guard('admin')->check() || Auth::guard('garage')->check()): ?>
                                <a href="#error-in-dialog"  class="login error-in-modal">
                            <?php else: ?>
                                <a href="#sign-in-dialog" data-slug="<?php echo e($category->slug); ?>" data-page="client-package-subscription"  class="login sign-in-modal">
                            <?php endif; ?>
                                    <i class="<?php echo e($category->cat_icon); ?>"></i>
                                    <label class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 500"><?php echo e($category->sections_name); ?></label>
                                </a>
                                <p><small><?php echo app('translator')->get('website::default.Package Subscription'); ?></small></p>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($category->type == 2 && $category->slug == 'custom-package'): ?>
                            <li class="col-2">
                            <?php if(Auth::guard('client')->check()): ?>
                                <a href="<?php echo e(route('client.package-subscription.create',['category' => $category->slug])); ?>">
                            <?php elseif(Auth::guard('admin')->check() || Auth::guard('garage')->check()): ?>
                                <a href="#error-in-dialog"  class="login error-in-modal">
                            <?php else: ?>
                                <a href="#sign-in-dialog" data-slug="<?php echo e($category->slug); ?>" data-page="client-package-subscription"  class="login sign-in-modal">
                            <?php endif; ?>
                                    <i class="<?php echo e($category->cat_icon); ?>"></i>
                                    <label class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 500"><?php echo e($category->sections_name); ?></label>
                                </a>
                                <p><small><?php echo app('translator')->get('website::default.Package Subscription'); ?></small></p>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
                </ul>
            </div>
            <!-- /container -->
        </div>
        <!-- /main_categories -->

        
		<!-- featured garage -->
		<div class="container-fluid margin_80_55">
			<div class="main_title_2">
				<span><em></em></span>
				<h2><?php echo app('translator')->get('website::default.workshop_and_garage'); ?></h2>
				<p><?php echo app('translator')->get('website::default.recommended'); ?></p>
			</div>
			<?php if(count($featureGarages) && !empty($featureGarages)): ?>

				<div id="reccomended" class="owl-carousel owl-theme">
					<?php $__currentLoopData = $featureGarages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featureGarage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="item">
							<div class="strip grid">
								<figure>
									<a href="#" class="wish_bt"></a>
									<a href="<?php echo e(route('listings.workshops-garages.single',['slug' =>$featureGarage['slug'] ])); ?>">
										<img src="<?php echo e(asset($featureGarage['profile_image'] )); ?>" class="img-fluid" alt="" width="400" height="266">
										<div class="read_more"><span>Read more</span></div>
									</a>
									<small>Garage</small>
								</figure>
								<div class="wrapper">
									<h3><a href="<?php echo e(route('listings.workshops-garages.single',['slug' =>$featureGarage['slug'] ])); ?>"><?php echo e($featureGarage['garages_name']); ?></a></h3>
									<p> <b>Address:</b>
                                   
									<?php echo e($featureGarage['address']); ?>, <?php echo e($allCities[$featureGarage['city_id']]['name']); ?>, <?php echo e($countries[$featureGarage['country_id']]['name']); ?>, <?php echo e($featureGarage['postal']); ?></p>
								</div>
								<ul>
									<li><span class="loc_open">Now Open</span></li>
									<li><div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div></li>
								</ul>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
				<div class="container">
					<div class="btn_home_align text-center mt-3"><a href="<?php echo e(route('listings.workshops-garages',['category' => 'featured'])); ?>" class="btn_1 rounded"><?php echo app('translator')->get('website::default.view_all'); ?></a></div>
				</div>
			<?php endif; ?>
		</div>
		<!-- /container -->
		
		<div class="call_section">
            <div class="wrapper">
                <div class="container margin_80_55">
                    <div class="main_title_2">
                        <span><em></em></span>
                        <h2><?php echo app('translator')->get('website::default.how_it_works_title'); ?></h2>
                        <p><?php echo app('translator')->get('website::default.how_it_works_text'); ?></p>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-mouse"></i>
                                <h3><?php echo app('translator')->get('website::default.how_it_works_choose_service_title'); ?></h3>
                                <p><?php echo app('translator')->get('website::default.how_it_works_choose_service_text'); ?></p>
                                <span></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-tools"></i>
                                <h3><?php echo app('translator')->get('website::default.how_it_works_select_garage_title'); ?></h3>
                                <p><?php echo app('translator')->get('website::default.how_it_works_select_garage_text'); ?></p>
                                <span></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-photo"></i>
                                <h3><?php echo app('translator')->get('website::default.how_it_works_take_photo_send_title'); ?></h3>
                                <p><?php echo app('translator')->get('website::default.how_it_works_take_photo_send_text'); ?></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-like2"></i>
                                <h3><?php echo app('translator')->get('website::default.how_it_works_easy_payment_title'); ?></h3>
                                <p><?php echo app('translator')->get('website::default.how_it_works_easy_payment_text'); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                    <p class="text-center add_top_30 wow bounceIn" data-wow-delay="0.5s"><a href="<?php echo e(route('client.login')); ?>" class="btn_1 rounded"><?php echo app('translator')->get('website::default.register_now'); ?></a></p>
                </div>
                <canvas id="hero-canvas" width="1920" height="1080"></canvas>
            </div>
            <!-- /wrapper -->
        </div>
        <!--/call_section-->
		
		<div class="container-fluid margin_80_55">
			<div class="main_title_2">
				<span><em></em></span>
				<h2><?php echo app('translator')->get('website::default.g2g_latest'); ?></h2>
                <p><?php echo app('translator')->get('website::default.recommended'); ?></p>
			</div>
			<?php if(count($latestGarages) && !empty($latestGarages)): ?>
				<div id="latest" class="owl-carousel owl-theme g2gListCarousel">
					<?php $__currentLoopData = $latestGarages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latestGarage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="item">
							<div class="strip grid">
								<figure>
									<a href="#" class="wish_bt"></a>
									<a href="<?php echo e(route('listings.workshops-garages.single',['slug' =>$latestGarage['slug'] ])); ?>">
										<img src="<?php echo e(asset( $latestGarage['profile_image'] )); ?>" class="img-fluid" alt="" width="400" height="266">
										<div class="read_more"><span>Read more</span></div>
									</a>
									<small>Garage</small>
								</figure>
								<div class="wrapper">
									<h3><a href="<?php echo e(route('listings.workshops-garages.single',['slug' =>$latestGarage['slug'] ])); ?>"> <?php echo e($latestGarage['garages_name']); ?></a></h3>
									<p> <b>Address:</b>
									<?php echo e($latestGarage['address']); ?>, <?php echo e($allCities[$latestGarage['city_id']]['name']); ?>, <?php echo e($countries[$latestGarage['country_id']]['name']); ?>, <?php echo e($latestGarage['postal']); ?></p>
								</div>
								<ul>
									<li><span class="loc_open">Now Open</span></li>
									<li><div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div></li>
								</ul>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
				<div class="container">
					<div class="btn_home_align text-center mt-3"><a href="<?php echo e(route('listings.workshops-garages',['category' => 'latest'])); ?>" class="btn_1 rounded"><?php echo app('translator')->get('website::default.view_all'); ?></a></div>
				</div>
			<?php endif; ?>
		</div>
		<!-- /container -->
		<?php if(!empty($testimonials)): ?>)
		<div class="container-fluid margin_80_55 px-0 testimonials-wrapper">
			<div class="main_title_2">
				<span><em></em></span>
				<h2><?php echo app('translator')->get('website::default.testimonials_title'); ?></h2>
				<p><?php echo app('translator')->get('website::default.testimonials_text'); ?></p>
			</div>
			<div class="utf_testimonial_carousel owl-carousel owl-theme">
				<?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="item">
					<div class="utf_testimonial_box">
						<div class="testimonial" style="color: #fff;"><?php if(\Config::get('app.locale') == 'en'): ?> <?php echo $testimonial['remarks_en']; ?> <?php else: ?> <?php echo $testimonial['remarks_ar']; ?> <?php endif; ?></div>
					</div>
					<div class="utf_testimonial_author"> <img src="<?php echo e(asset( $testimonial['image'] )); ?>" alt="image-testimonial">
						<h4><?php if(\Config::get('app.locale') == 'en'): ?> <?php echo e($testimonial['name_en']); ?> <?php else: ?> <?php echo e($testimonial['name_ar']); ?> <?php endif; ?> <span><?php if(\Config::get('app.locale') == 'en'): ?> <?php echo e($testimonial['designation_en']); ?> <?php else: ?> <?php echo e($testimonial['designation_ar']); ?> <?php endif; ?></span></h4>
					</div>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
		<?php endif; ?>
		
        
        <div class="container margin_80_55">
            <div class="main_title_2">
                <span><em></em></span>
                <h2><?php echo app('translator')->get('website::default.mobile_app_title'); ?></h2>
                <p><?php echo app('translator')->get('website::default.mobile_app_text'); ?></p>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col-md-6">
                    <img src="<?php echo e(asset('website-theme/img/mobile.svg')); ?>" alt="" class="img-fluid add_bottom_45">
                    <div class="app_icons">
                        <a href="javascript:void(0)" class="pr-lg-2"><img src="<?php echo e(asset('website-theme/img/app_android.svg')); ?>" alt=""></a>
                        <a href="javascript:void(0)" class="pl-lg-2"><img src="<?php echo e(asset('website-theme/img/app_apple.svg')); ?>" alt=""></a>
                    </div>
                    <div class="add_bottom_15"><small><?php echo app('translator')->get('website::default.mobile_app_coming_soon'); ?></small></div>
                </div>
            </div>
        </div>
        <!-- /container -->
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_js'); ?>
    <script type="text/javascript">
       $(function() {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.sign-in-modal').click(function(){
                $('#slug').val($(this).data('slug'));
                $('#page').val($(this).data('page'));
            });
        });
    </script>
    <script  defer src="https://maps.google.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places&" type="text/javascript"></script>

   <script>
       $(document).ready(function() {
            $("#lat_area").addClass("d-none");
            $("#long_area").addClass("d-none");
            initialize();
       });
  

       function initialize() {
       
           var options = {
             componentRestrictions: {country: "AE"}
           };

           var input = document.getElementById('autocomplete');
           var autocomplete = new google.maps.places.Autocomplete(input, options);
           autocomplete.addListener('place_changed', function() {
               var place = autocomplete.getPlace();
               $('#latitude').val(place.geometry['location'].lat());
               $('#longitude').val(place.geometry['location'].lng());

            // --------- show lat and long ---------------
               $("#lat_area").removeClass("d-none");
               $("#long_area").removeClass("d-none");
           });
       }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('website::layouts.homepage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devhs/public_html/g2g-v3/Modules/Website/Resources/views/pages/homepage.blade.php ENDPATH**/ ?>