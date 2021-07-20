<?php $__env->startSection('content'); ?>
<main>	
		<div class="container">

			<div id="results">
	   			<div class="container">
				   <div class="row">
					   	<div class="col-md-12">
					   			<form method="get" action="<?php echo e(route('listings.search-by-location')); ?>">
			                    	<div class="row no-gutters custom-search-input-2">
			                            <input type="hidden" name="latitude" id="latitude" value="">
			                            <input type="hidden" name="longitude" id="longitude" value="">
			                            <div class="col-lg-7">
			                                <div class="form-group">
			                                    <input type="text" name="address" id="autocomplete" class="form-control" placeholder="<?php echo e(trans('website.Location/City/Address')); ?>">
			                                    <i class="icon_search"></i>
			                                </div>
			                                 <i class="pe-7s-edit toogle-distance-slider"></i>
			                                <div class="distance-slider" style="display: none;">
			                                    <div class="text-primary mb-2"><?php echo e(trans('website.Distance')); ?>: <span id="distance-value">5</span>KM</div>
			                                    <input id="thedistance" name="distance" type="range" min="0" max="1000" step="5" value="5" >
			                                </div>
			                            </div>
			                            <div class="col-lg-3">
			                                <select class="wide" name="category">
			                                    <option value="all"><?php echo e(trans('website.All Categories')); ?></option>	
			                                    <?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                                    	<option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
			                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			                                </select>
			                            </div>
			                            <div class="col-lg-2">
			                                <input type="submit" value="<?php echo e(trans('website.Search')); ?>">
			                            </div>
			                        </div>
			                        <!-- /row -->
			                    </form>
			            </div>
				   </div>
		  
					<div class="search_mob_wp">
						<div class="custom-search-input-2">
							 <form method="get" action="<?php echo e(route('listings.search')); ?>">
							   <a href="#0" class="search_mob btn_search_mobile"></a> <!-- /open search panel -->
								<div class="row no-gutters custom-search-input-2 inner">
									<div class="col-lg-8">
										<div class="form-group">
											 <input type="text" name="location" id="autocomplete" class="form-control" placeholder="Location/City/Address">
											<i class="icon_search"></i>	
										</div>
										 <i class="pe-7s-edit toogle-distance-slider"></i>
			                            <div class="distance-slider" style="display: none;">
			                                <div class="text-primary mb-2">Distance: <span id="distance-value">5</span>KM</div>
			                                <input id="thedistance" name="distance" type="range" min="0" max="100" step="5" value="5" >
			                            </div>
									</div>
									<div class="col-lg-3">
										<select class="wide" name="category">
											<option value="-1">All Categories</option>	
											<?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                                	<option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
			                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
									<div class="col-lg-1">
										<input type="submit" class="bg-danger" value="Search">
									</div>
								</div>
							</form>
						</div>
					</div>
	   			</div>
			</div>

			<div class="hero_in shop_detail" style="background: url(<?php echo e(asset( $garage->profile_image)); ?>) center center no-repeat;background-size: cover;">
				<div class="wrapper">
				<span class="magnific-gallery">
					<a href="<?php echo e(asset($garage->profile_image)); ?>" class="btn_photos" title="Photo title" data-effect="mfp-zoom-in"><?php echo e(trans('website.View photos')); ?></a>
				</span>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<section id="description">

						<div class="row">
							<div class="col-lg-12">
								<div class="opening add_bottom_30">
		                            <div class="ribbon bg-red">
		                                <span class="open">Featured</span>
		                            </div>
		                            <h1 class="text-center"><?php echo e($garage->garages_name); ?></h1>
		                            <hr/>
		                            <?php echo $garage->garages_description; ?>

		                        </div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-8">
								<div class="main_title_2" style="padding:10px;">
				                  <h2 style="padding-bottom: 10px;"><?php echo app('translator')->get('labels.Services'); ?></h2>
				                   <span><em style="background-color: #B53327"></em></span>
				                </div>

				                <div class=" opening">
				                	<div class="row">
									<?php $__currentLoopData = $garageServices['mainCats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainCatId =>  $mainCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<div class="col-lg-4">
										<ul class="bullets" >
											<li style="list-style: none;"><b><?php echo e($mainCat); ?></b></li>

											<?php if(isset($garageServices['subCats'][$mainCatId])): ?>
												<?php $__currentLoopData = $garageServices['subCats'][$mainCatId]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													
														
												<li style="list-style: none;"><?php echo e($subCats); ?></li>
														
													
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												
											<?php endif; ?>
										</ul>
									</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								</div>
							</div>

							<div class="col-md-4">

								<div class="main_title_2" style="padding:10px;">
				                  <h2 style="padding-bottom: 10px;"><?php echo app('translator')->get('labels.Opening Hours'); ?></h2>
				                   <span><em style="background-color: #B53327"></em></span>
				                </div>

				                <div class="opening add_bottom_30">
		                            <div class="ribbon">
		                                <span class="open"><?php echo app('translator')->get('labels.Now Open'); ?></span>
		                            </div>
		                            <i class="icon_clock_alt"></i>
		                            <h4><?php echo app('translator')->get('labels.Opening Hours'); ?></h4>
		                            <hr/>
		                            <div class="row">
		                            	<div class="col-md-12">
		                            		<ul class="bullets" >
		                                        <li style="list-style: none;"><?php echo app('translator')->get('labels.Monday'); ?> <span><?php if(isset($garageworkingHours->mon) && $garageworkingHours->mon != 'Closed'): ?> <?php echo e($garageworkingHours->mon); ?>  <?php else: ?> <?php echo app('translator')->get('labels.Closed'); ?> <?php endif; ?></span></li>
		                                        <hr/>
		                                        <li style="list-style: none;"><?php echo app('translator')->get('labels.Tuesday'); ?> <span><?php if(isset($garageworkingHours->mon) && $garageworkingHours->tue != 'Closed'): ?> <?php echo e($garageworkingHours->tue); ?>  <?php else: ?> <?php echo app('translator')->get('labels.Closed'); ?> <?php endif; ?></span></li>
		                                         <hr/>
		                                        <li style="list-style: none;"><?php echo app('translator')->get('labels.Wednesday'); ?> <span><?php if(isset($garageworkingHours->mon) && $garageworkingHours->wed != 'Closed'): ?> <?php echo e($garageworkingHours->wed); ?>  <?php else: ?> <?php echo app('translator')->get('labels.Closed'); ?> <?php endif; ?></span></li>
		                                         <hr/>
		                                        <li style="list-style: none;"><?php echo app('translator')->get('labels.Thursday'); ?> <span><?php if(isset($garageworkingHours->mon) && $garageworkingHours->thu != 'Closed'): ?> <?php echo e($garageworkingHours->thu); ?>  <?php else: ?> <?php echo app('translator')->get('labels.Closed'); ?> <?php endif; ?></span></li>
		                                         <hr/>
		                                        <li style="list-style: none;"><?php echo app('translator')->get('labels.Friday'); ?> <span><?php if(isset($garageworkingHours->mon) && $garageworkingHours->fri != 'Closed'): ?> <?php echo e($garageworkingHours->fri); ?>  <?php else: ?> <?php echo app('translator')->get('labels.Closed'); ?> <?php endif; ?></span></li>
		                                         <hr/>
		                                        <li style="list-style: none;"><?php echo app('translator')->get('labels.Saturday'); ?> <span><?php if(isset($garageworkingHours->mon) && $garageworkingHours->sat != 'Closed'): ?> <?php echo e($garageworkingHours->sat); ?>  <?php else: ?> <?php echo app('translator')->get('labels.Closed'); ?> <?php endif; ?></span></li>
		                                         <hr/>
		                                        <li style="list-style: none;"><?php echo app('translator')->get('labels.Sunday'); ?> <span><?php if(isset($garageworkingHours->mon) && $garageworkingHours->sun != 'Closed'): ?> <?php echo e($garageworkingHours->sun); ?>  <?php else: ?> <?php echo app('translator')->get('labels.Closed'); ?> <?php endif; ?></span></li>
		                                    </ul>
		                                </div>
		                               
		                            </div>
		                        </div>
							</div>
						</div>

						<div class="row">
							<?php if(count($garageimages) > 0): ?>
								<div class="col-lg-12">
									<div class="main_title_2" style="padding:10px;">
					                  <h2 style="padding-bottom: 10px;"><?php echo app('translator')->get('labels.Media Galllery'); ?></h2>
					                   <span><em style="background-color: #B53327"></em></span>
					                </div>

					                <div class="grid-gallery opening">
										<ul class="magnific-gallery row ">
											<?php $__currentLoopData = $garageimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garageimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<li class="col-md-6" style="padding: 10px;background-color:rgba(0, 77, 218, 0.05);">
													<figure>
														<img src="<?php echo e(asset($garageimage->image )); ?>" alt="">
														<figcaption>
															<div class="caption-content">
																<a href="<?php echo e(asset($garageimage->image )); ?>" title="Photo title" data-effect="mfp-zoom-in">
																	<i class="pe-7s-albums"></i>
																	<p>Garage Media</p>
																</a>
															</div>
														</figcaption>
													</figure>
												</li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>
									</div>
								</div>
							<?php endif; ?>

							<?php if(count($garageVideos) > 0): ?>
								<div class="col-lg-12">
									<div class="main_title_2" style="padding:10px;">
					                  <h2 style="padding-bottom: 10px;"><?php echo app('translator')->get('labels.Video Galllery'); ?></h2>
					                   <span><em style="background-color: #B53327"></em></span>
					                </div>

					                <div class="grid-gallery opening">
										<ul class="magnific-gallery row ">
											<?php $__currentLoopData = $garageVideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garageVideo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<div class="col-md-6">
							                      <div class="embed-responsive embed-responsive-16by9">
							                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo e($garageVideo->yt_video_id); ?>?rel=0" allowfullscreen></iframe>
							                      </div>
							                      <br/>
							                 	 </div>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>
									</div>
								</div>
							<?php endif; ?>
						</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="main_title_2" style="padding:10px;">
				                  <h2 style="padding-bottom: 10px;"><?php echo app('translator')->get('labels.Location'); ?></h2>
				                   <span><em style="background-color: #B53327"></em></span>
				                </div>
				                <div class="opening">
					                <h3><?php echo e($garage->address); ?>, <?php echo e($allCities[$garage->city_id]['name']); ?>, <?php echo e($countries[$garage->country_id]['name']); ?>, <?php echo e($garage->postal); ?> </h3>
					                <iframe src="https://www.google.com/maps?q=<?php echo e($garage->latitude); ?>,<?php echo e($garage->longitude); ?>&hl=es;z=14&amp;output=embed" width="600" height="450" allowfullscreen id="map_iframe"></iframe>
					            </div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</main>

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

<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/website/garages/single.blade.php ENDPATH**/ ?>