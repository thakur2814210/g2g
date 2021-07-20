
<?php $__env->startSection('css'); ?>
    <style>
        .main_categories ul li{
            margin-bottom: 10px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
      
<main class="pattern">
            
    <section class="hero_single version_5">
      <div class="wrapper">
        <div class="container">
          <div class="row justify-content-center pt-lg-5">
            <div class="col-xl-6 col-lg-6">
              <p style="font-size: 2.25rem;text-shadow: none;color: #fff;margin: 0;text-transform: uppercase;font-weight: 700;"><?php echo app('translator')->get('website.homapage_slider_text_1'); ?></p>
              <p><?php echo app('translator')->get('website.homapage_slider_text_2'); ?></p>
              <form method="get" action="<?php echo e(route('listings.search-by-location')); ?>">
                <input type="hidden" name="latitude" id="latitude" value="">
                <input type="hidden" name="longitude" id="longitude" value="">
                <input type="hidden" name="city" id="city" value="all">
                <div class="custom-search-input-2">
                  <div class="form-group">
                    <input type="text" name="address" id="autocomplete" class="form-control" placeholder="<?php echo e(trans('website.Location/City/Address')); ?>">
                    <i class="pe-7s-edit toogle-distance-slider"></i>
                    <div class="distance-slider" style="display: none;">
                    <div class="text-primary mb-2"><?php echo e(trans('website.Distance')); ?>: <span id="distance-value">5</span><?php echo e(trans('website.KM')); ?></div>
                        <input id="thedistance" name="distance" type="range" min="0" max="100" step="5" value="5" >
                      </div>
                  </div>
                  <select class="wide" name="category">
                    <option value="all"><?php echo e(trans('website.All Categories')); ?></option> 
                    <?php $__currentLoopData = $all_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <input type="submit" value="<?php echo e(trans('website.Search')); ?>" style="background-color: #fb8d00;">
                </div>
              </form>
            </div>
            <div class="col-xl-4 col-lg-6 text-right d-none d-lg-block">
              <img src="<?php echo e(asset('website-theme/img/g2g-phone.png')); ?>" alt="" style="height: 500px; margin-top: -100px; margin-bottom: -100px;">
            </div>
          </div>

        </div>
      </div>
    </section>
        <!-- /hero_single -->
        
        <div class="main_categories">
            <div class="container">
                <ul class="clearfix row">
                    <li class="col-6 col-md-3 col-lg-2">
                               
                        <a href="<?php echo e(URL::to('/autoshop')); ?>" target="_blank">
                            <i class="ti-shopping-cart"></i>
                            <span class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600"><?php echo app('translator')->get('website.auto_shop'); ?></span>
                        </a>
                        
                    </li>
                  <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($category->type == 1 && $category->slug != 'custom-request'): ?>
                            <li class="col-6 col-md-3 col-lg-2" style="margin-bottom: 10px;">
                                <?php if(Auth::guard('customer')->check()): ?>
                                    <a href="<?php echo e(route('client.service-request.create',['category' => $category->slug])); ?>">
                                <?php elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check()): ?>
                                    <a href="#error-in-dialog"  class="login error-in-modal">
                                <?php else: ?>
                                    <a href="#sign-in-dialog" data-slug="<?php echo e($category->slug); ?>" data-page="service-request"  class="login sign-in-modal" >
                                <?php endif; ?>
                                    <i class="<?php echo e($category->cat_icon); ?>"></i>
                                    <span class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600"><?php echo e($category->sections_name); ?></span>
                                </a>
                                
                            </li>
                        <?php endif; ?>
                  
                        <?php if($category->type == 1 && $category->slug == 'custom-request'): ?>
                            <li class="col-6 col-md-3 col-lg-2" style="margin-bottom: 10px;">
                            <?php if(Auth::guard('customer')->check()): ?>
                                <a href="<?php echo e(route('client.service-request.create',['category' => $category->slug])); ?>">
                            <?php elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check()): ?>
                                <a href="#error-in-dialog"  class="login error-in-modal">
                            <?php else: ?>
                                <a href="#sign-in-dialog" data-slug="<?php echo e($category->slug); ?>" data-page="service-request"  class="login sign-in-modal" >
                            <?php endif; ?>
                                    <i class="<?php echo e($category->cat_icon); ?>"></i>
                                    <span class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600"><?php echo e($category->sections_name); ?></span>
                                </a>
                                
                            </li>
                        <?php endif; ?>
                    
                        <?php if($category->type == 2 && $category->slug != 'custom-package'): ?>
                            <li class="col-6 col-md-3 col-lg-2" style="margin-bottom: 10px;">
                            <?php if(Auth::guard('customer')->check()): ?>
                                <a href="<?php echo e(route('client.package-subscription.create',['category' => $category->slug])); ?>">
                            <?php elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check()): ?>
                                <a href="#error-in-dialog"  class="login error-in-modal">
                            <?php else: ?>
                                <a href="#sign-in-dialog" data-slug="<?php echo e($category->slug); ?>" data-page="client-package-subscription"  class="login sign-in-modal">
                            <?php endif; ?>
                                    <i class="<?php echo e($category->cat_icon); ?>"></i>
                                    <span class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600"><?php echo e($category->sections_name); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                   
                        <?php if($category->type == 2 && $category->slug == 'custom-package'): ?>
                            <li class="col-6 col-md-3 col-lg-2" style="margin-bottom: 10px;">
                            <?php if(Auth::guard('customer')->check()): ?>
                                <a href="<?php echo e(route('client.package-subscription.create',['category' => $category->slug])); ?>">
                            <?php elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check()): ?>
                                <a href="#error-in-dialog"  class="login error-in-modal">
                            <?php else: ?>
                                <a href="#sign-in-dialog" data-slug="<?php echo e($category->slug); ?>" data-page="client-package-subscription"  class="login sign-in-modal">
                            <?php endif; ?>
                                    <i class="<?php echo e($category->cat_icon); ?>"></i>
                                    <span class="btn btn-outline-danger btn-sm btn-block text-uppercase" style="font-size: .75rem;font-weight: 600"><?php echo e($category->sections_name); ?></span>
                                </a>
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
        <h2><?php echo app('translator')->get('website.workshop_and_garage'); ?></h2>
        <p><?php echo app('translator')->get('website.recommended'); ?></p>
      </div>
      <?php if(count($featureGarages) && !empty($featureGarages)): ?>

        <div id="reccomended11" class="owl-carousel owl-theme g2gListCarousel">
          <?php $__currentLoopData = $featureGarages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featureGarage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
              <div class="strip grid">
                <figure>
                  <a href="#" class="wish_bt"></a>
                  <a href="<?php echo e(route('listings.workshops-garages.single',['slug' =>$featureGarage['slug'] ])); ?>">
                    <img src="<?php echo e(asset($featureGarage['profile_image'] )); ?>" class="img-fluid" alt="" width="400" height="266">
                    <div class="read_more"><span><?php echo e(trans('website.Read more')); ?></span></div>
                  </a>
                  <small><?php echo e(trans('website.Garage')); ?></small>
                </figure>
                <div class="wrapper text-center">
                  <h3><a href="<?php echo e(route('listings.workshops-garages.single',['slug' =>$featureGarage['slug'] ])); ?>"><?php echo e($featureGarage['garages_name']); ?></a></h3>
                  <p>              
                  <?php echo e($featureGarage['address']); ?>, <?php echo e($allCities[$featureGarage['city_id']]['name']); ?>, <?php echo e($countries[$featureGarage['country_id']]['name']); ?>, <?php echo e($featureGarage['postal']); ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="container">
          <div class="btn_home_align text-center mt-3"><a href="<?php echo e(route('listings.workshops-garages',['category' => 'featured'])); ?>" class="btn_1 rounded"><?php echo app('translator')->get('website.view_all'); ?></a></div>
        </div>
      <?php endif; ?>
    </div>
    <!-- /container -->
    
    <div class="call_section">
            <div class="wrapper">
                <div class="container margin_80_55">
                    <div class="main_title_2">
                        <span><em></em></span>
                        <h2><?php echo app('translator')->get('website.how_it_works_title'); ?></h2>
                        <p><?php echo app('translator')->get('website.how_it_works_text'); ?></p>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-mouse"></i>
                                <h3><?php echo app('translator')->get('website.how_it_works_choose_service_title'); ?></h3>
                                <p><?php echo app('translator')->get('website.how_it_works_choose_service_text'); ?></p>
                                <span></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-tools"></i>
                                <h3><?php echo app('translator')->get('website.how_it_works_select_garage_title'); ?></h3>
                                <p><?php echo app('translator')->get('website.how_it_works_select_garage_text'); ?></p>
                                <span></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-photo"></i>
                                <h3><?php echo app('translator')->get('website.how_it_works_take_photo_send_title'); ?></h3>
                                <p><?php echo app('translator')->get('website.how_it_works_take_photo_send_text'); ?><br><small>(<?php echo e(trans('website.For fixed services, packages & auto spare parts, costumer can directly buy online')); ?>)</small></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box_how">
                                <i class="pe-7s-like2"></i>
                                <h3><?php echo app('translator')->get('website.how_it_works_easy_payment_title'); ?></h3>
                                <p><?php echo app('translator')->get('website.how_it_works_easy_payment_text'); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                    <p class="text-center add_top_30 wow bounceIn" data-wow-delay="0.5s"><a href="<?php echo e(URL::to('/register')); ?>" class="btn_1 rounded"><?php echo app('translator')->get('website.register_now'); ?></a></p>
                </div>
                <canvas id="hero-canvas" width="1920" height="1080"></canvas>
            </div>
            <!-- /wrapper -->
        </div>
        <!--/call_section-->
    
    <div class="container-fluid margin_80_55">
      <div class="main_title_2">
        <span><em></em></span>
        <h2><?php echo app('translator')->get('website.g2g_latest'); ?></h2>
                <p><?php echo app('translator')->get('website.recommended'); ?></p>
      </div>
      <?php if(count($latestGarages) && !empty($latestGarages)): ?>
        <div id="latest" class="owl-carousel owl-theme g2gListCarousel">
          <?php $__currentLoopData = $latestGarages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latestGarage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($latestGarage['garages_name']) && isset($latestGarage['address'])): ?>
            <div class="item">
              <div class="strip grid">
                <figure>
                  <a href="#" class="wish_bt"></a>
                  <a href="<?php echo e(route('listings.workshops-garages.single',['slug' =>$latestGarage['slug'] ])); ?>">
                    <img src="<?php echo e(asset( $latestGarage['profile_image'] )); ?>" class="img-fluid" alt="" width="400" height="266">
                    <div class="read_more"><span><?php echo app('translator')->get('website.Read more'); ?></span></div>
                  </a>
                  <small><?php echo app('translator')->get('website.Garage'); ?></small>
                </figure>
                <div class="wrapper text-center">
                  <h3><a href="<?php echo e(route('listings.workshops-garages.single',['slug' =>$latestGarage['slug'] ])); ?>"> <?php echo e($latestGarage['garages_name']); ?></a></h3>
                  <p>
                  <?php echo e($latestGarage['address']); ?>, <?php echo e($allCities[$latestGarage['city_id']]['name']); ?>, <?php echo e($countries[$latestGarage['country_id']]['name']); ?>, <?php echo e($latestGarage['postal']); ?></p>
                </div>
              </div>
            </div>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="container">
          <div class="btn_home_align text-center mt-3"><a href="<?php echo e(route('listings.workshops-garages',['category' => 'latest'])); ?>" class="btn_1 rounded"><?php echo app('translator')->get('website.view_all'); ?></a></div>
        </div>
      <?php endif; ?>
    </div>
    <!-- /container -->
    <?php if(!empty($testimonials)): ?>
    <div class="container-fluid margin_80_55 px-0 testimonials-wrapper">
      <div class="main_title_2">
        <span><em></em></span>
        <h2><?php echo app('translator')->get('website.testimonials_title'); ?></h2>
        <p><?php echo app('translator')->get('website.testimonials_text'); ?></p>
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
                <h2><?php echo app('translator')->get('website.mobile_app_title'); ?></h2>
                <p><?php echo app('translator')->get('website.mobile_app_text'); ?></p>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col-md-6">
                    <img src="<?php echo e(asset('website-theme/img/g2g-phone.png')); ?>" alt="" class="img-fluid add_bottom_45" style="max-height: 500px;">
                    <div class="app_icons">
                        <a href="https://play.google.com/store/apps/details?id=com.g2g.app" target="_blank" class="pr-lg-2"><img src="<?php echo e(asset('website-theme/img/app_android.svg')); ?>" alt=""></a>
                        <a href="https://apps.apple.com/ae/app/g2g-garage-to-go/id1530018365" target="_blank" class="pl-lg-2"><img src="<?php echo e(asset('website-theme/img/app_apple.svg')); ?>" alt=""></a>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- /container -->
        
        <?php if(count($sponsors) && !empty($sponsors)): ?>
        <div class="container-fluid margin_80_55">
            <div class="main_title_2">
                <span><em></em></span>
                <h2><?php echo app('translator')->get('website.sponsors'); ?></h2>
                <p><?php echo app('translator')->get('website.sponsors_text'); ?></p>
            </div>
         
            <div id="latest" class="owl-carousel owl-theme g2gsponsors g2gListCarousel" >
              <?php $__currentLoopData = $sponsors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sponsor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                    <img src="<?php echo e(asset( $sponsor->logo )); ?>" class="img-fluid"/>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
        
        
    </main>
    
    <style>
        #sign-in-dialog .form-group i{
            top:2.7rem !important;
        }
    </style>

    <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
      <div class="small-dialog-header" style="width:100% !important">
          <span><?php echo e(trans('website.Sign In')); ?></span>
      </div>
      <form action="<?php echo e(route('website.auth.sign-in-modal')); ?>" method="post">
          <?php echo e(csrf_field()); ?>

          <input type="hidden" name="slug" id="slug" value="">
          <input type="hidden" name="page" id="page" value="">
          <div class="sign-in-wrapper">
            
              <div class="form-group">
                  <p><?php echo e(trans('website.Email')); ?> / <?php echo e(trans('website.Phone')); ?> / <?php echo e(trans('website.Username')); ?></p>
                  <input type="text" class="form-control" name="email" id="email" required>
                  <i class="icon_mail_alt"></i>
              </div>
              <div class="form-group">
                  <p><?php echo e(trans('website.Password')); ?></p>
                  <input type="password" class="form-control" name="password" id="password" value="" required>
                  <i class="icon_lock_alt"></i>
              </div>
              <div class="text-center"><input type="submit" value="<?php echo e(trans('website.Log In')); ?>" class="btn_1 full-width"></div>
          </div>
      </form>
    </div>

    <div id="error-in-dialog" class="zoom-anim-dialog mfp-hide">
      <div class="small-dialog-header">
          <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo e(trans('website.Error')); ?></h3>
      </div>
     
      <div class="sign-in-wrapper">
          <div class="text-center">
              <p class="text-danger"><?php echo app('translator')->get("website.you don't have permission to access this page"); ?></p>
              <p><?php echo app('translator')->get("website.This page can only be accessed by customer. Please register as a Customer"); ?></p>
          </div>
      </div>
    </div>
    
    

    <div id="error-in-dialog" class="zoom-anim-dialog mfp-hide">
      <div class="small-dialog-header">
          <h3><?php echo e(trans('website.Sign In')); ?></h3>
      </div>
      <form action="<?php echo e(route('website.auth.sign-in-modal')); ?>" method="post">
          <?php echo e(csrf_field()); ?>

          <input type="hidden" name="slug" id="slug" value="">
          <div class="sign-in-wrapper">
            
              <div class="form-group">
                   <p><?php echo e(trans('website.Email')); ?> / <?php echo e(trans('website.Phone')); ?> / <?php echo e(trans('website.Username')); ?></p>
                  <input type="text" class="form-control" name="email" id="email" required>
                  <i class="icon_mail_alt"></i>
              </div>
              <div class="form-group">
                  <p><?php echo e(trans('website.Password')); ?></p>
                  <input type="password" class="form-control" name="password" id="password" value="" required>
                  <i class="icon_lock_alt"></i>
              </div>
              <div class="clearfix add_bottom_15">
                  <div class="checkboxes float-left">
                      <p class="container_check"><?php echo e(trans('website.Remember me')); ?>

                        <input type="checkbox">
                        <span class="checkmark"></span>
                      </p>
                  </div>
                  <div class="float-right mt-1"><a id="forgot" href="javascript:void(0);"><?php echo e(trans('website.Forgot Password?')); ?></a></div>
              </div>
              <div class="text-center"><input type="submit" value="<?php echo e(trans('website.Log In')); ?>" class="btn_1 full-width"></div>
              <div class="text-center">
                  <?php echo e(trans('website.Don’t have an account?')); ?> <a href="register.html"><?php echo e(trans('website.Sign up')); ?></a>
              </div>
          </div>
      </form>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
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
        //  types: ['(regions)'], geocode
           var options = {
             
             componentRestrictions: {country: "AE"}
           };

           var input = document.getElementById('autocomplete');
           var autocomplete = new google.maps.places.Autocomplete(input, options);
           autocomplete.addListener('place_changed', function() {
               var place = autocomplete.getPlace();
               console.log(place);
               var city ="all";
               for(var i = 0; i < place.address_components.length; i += 1) {
                  var addressObj = place.address_components[i];
                  for(var j = 0; j < addressObj.types.length; j += 1) {
                    if (addressObj.types[j] === 'locality') {
                      //console.log(addressObj.types[j]); // confirm that this is 'country'
                      //console.log(addressObj.long_name); // confirm that this is the country name
                      city = addressObj.long_name;
                    }
                  }
                }
               
               
               $('#city').val(city);
               $('#latitude').val(place.geometry['location'].lat());
               $('#longitude').val(place.geometry['location'].lng());

            // --------- show lat and long ---------------
               $("#lat_area").removeClass("d-none");
               $("#long_area").removeClass("d-none");
           });
           
            
       }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/website/index.blade.php ENDPATH**/ ?>