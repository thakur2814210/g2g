<?php $__env->startSection('website_css_pre'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_css'); ?>
    <style id="theia-sticky-sidebar-stylesheet-TSS">.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<main>		
		<div class="hero_in shop_detail" style="background: url(<?php echo e(asset( $garage->profile_image)); ?>) center center no-repeat;background-size: cover;">
			<div class="wrapper">
				<span class="magnific-gallery">
					<a href="<?php echo e(asset($garage->profile_image)); ?>" class="btn_photos" title="Photo title" data-effect="mfp-zoom-in">View photos</a>
					<a href="img/gallery/hotel_list_2.jpg" title="Photo title" data-effect="mfp-zoom-in"></a>
					<a href="img/gallery/hotel_list_3.jpg" title="Photo title" data-effect="mfp-zoom-in"></a>
				</span>
			</div>
		</div>
		<!--/hero_in-->
		
		<nav class="secondary_nav sticky_horizontal_2">
			<div class="container">
				<ul class="clearfix">
					<li><a href="#description" class="active">Description</a></li>
					<li><a href="#reviews">Reviews</a></li>
					<li><a href="#sidebar">Booking</a></li>
				</ul>
			</div>
		</nav>

		<div class="container margin_60_35">
				<div class="row">
					<div class="col-lg-8">
						<section id="description">
							<div class="detail_title_1">
								<h1><?php echo e($garage->name); ?></h1>
								<?php echo e($garage->address); ?>, <?php echo e($allCities[$garage->city_id]['name']); ?>, <?php echo e($countries[$garage->country_id]['name']); ?>, <?php echo e($garage->postal); ?>      
							</div>
							<p><?php echo $garage->description; ?></p>

						
								<div class="main_title_2">
									
									<h2>Services</h2>
									<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
									<span><em></em></span>
								</div>
							<div class="row">
								<?php $__currentLoopData = $garageServices['mainCats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainCatId =>  $mainCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="col-lg-12">
										<ul class="bullets">
											<li><b><?php echo e($mainCat); ?></b></li>
										</ul>
									</div>

									 <?php if(isset($garageServices['subCats'][$mainCatId])): ?>
									 	<div class="row p-3">
										<?php $__currentLoopData = $garageServices['subCats'][$mainCatId]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="col-lg-4">
												<ul class="bullets">
													<li><?php echo e($subCats); ?></li>
												</ul>
											</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						

						
								<div class="main_title_2">
									<h2>Opening Hours</h2>
									<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
									<span><em></em></span>
								</div>

								<!-- /row -->						
								<div class="opening add_bottom_30">
	                                <div class="ribbon">
	                                    <span class="open">Now Open</span>
	                                </div>
	                                <i class="icon_clock_alt"></i>
	                                <h4>Opening Hours</h4>
	                                <div class="row">
	                                	<div class="col-md-6">
	                                        <ul>
	                                            <li>Monday <span><?php echo e($garageworkingHours->mon); ?></span></li>
	                                            <li>Tuesday <span><?php echo e($garageworkingHours->tue); ?></span></li>
	                                            <li>Wednesday <span><?php echo e($garageworkingHours->wed); ?></span></li>
	                                            <li>Thursday <span><?php echo e($garageworkingHours->thu); ?></span></li>
	                                        </ul>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <ul>
	                                            <li>Friday <span><?php echo e($garageworkingHours->fri); ?></span></li>
	                                            <li>Saturday <span><?php echo e($garageworkingHours->sat); ?></span></li>
	                                            <li>Sunday <span><?php echo e($garageworkingHours->sun); ?></span></li>
	                                        </ul>
	                                    </div>
	                                </div>
	                            </div>
	                            <!-- /opening -->
	                       

                           		<?php if(!is_null($garageimages->toArray())): ?>
									<div class="main_title_2">
										<h2>Media Galllery</h2>
										<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
										<span><em></em></span>
									</div>

									<div class="grid-gallery">
										<ul class="magnific-gallery">
											<?php $__currentLoopData = $garageimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garageimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<li>
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
								<?php endif; ?>
						
								<?php if(!is_null($garageVideos->toArray())): ?>
									<div class="main_title_2">
										<h2>Here some videos ...</h2>
										<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
										<span><em></em></span>
									</div>
									<div class="grid-gallery">
										<ul class="magnific-gallery row">
											<?php $__currentLoopData = $garageVideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garageVideo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<div class="col-sm-6">
							                      <div class="embed-responsive embed-responsive-16by9">
							                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo e($garageVideo->yt_video_id); ?>?rel=0" allowfullscreen></iframe>
							                      </div>
							                 	 </div>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>
									</div>
								<?php endif; ?>
									<!-- /grid -->
								
							
							
							
                            <!--h5>Special offers</h5>
                            	<hr>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <ul class="menu_list">
                                        <li>
                                            <div class="thumb">
                                                <img src="img/shop_item_1.jpg" alt="">
                                            </div>
                                            <h6>Clothing Cloth T-shirt <span>$12</span></h6>
                                            <p>
                                                Small / Medium / Large
                                            </p>
                                        </li>
                                        <li>
                                            <div class="thumb">
                                                <img src="img/shop_item_2.jpg" alt="">
                                            </div>
                                            <h6>Clothing Cloth T-shirt <span>$12</span></h6>
                                            <p>
                                                Small / Medium / Large
                                            </p>
                                        </li>
                                        <li>
                                            <div class="thumb">
                                                <img src="img/shop_item_3.jpg" alt="">
                                            </div>
                                           	<h6>Clothing Cloth T-shirt <span>$12</span></h6>
                                            <p>
                                                Small / Medium / Large
                                            </p>
                                        </li>
                                        <li>
                                            <div class="thumb">
                                                <img src="img/shop_item_4.jpg" alt="">
                                            </div>
                                            <h6>Clothing Cloth T-shirt <span>$12</span></h6>
                                            <p>
                                                Small / Medium / Large
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <ul class="menu_list">
                                        <li>
                                            <div class="thumb">
                                                <img src="img/shop_item_5.jpg" alt="">
                                            </div>
                                            <h6>Clothing Cloth T-shirt <span>$12</span></h6>
                                            <p>
                                                Small / Medium / Large
                                            </p>
                                        </li>
                                        <li>
                                            <div class="thumb">
                                                <img src="img/shop_item_6.jpg" alt="">
                                            </div>
                                            <h6>Clothing Cloth T-shirt <span>$12</span></h6>
                                            <p>
                                                Small / Medium / Large
                                            </p>
                                        </li>
                                        <li>
                                            <div class="thumb">
                                                <img src="img/shop_item_7.jpg" alt="">
                                            </div>
                                            <h6>Clothing Cloth T-shirt <span>$12</span></h6>
                                            <p>
                                                Small / Medium / Large
                                            </p>
                                        </li>
                                        <li>
                                            <div class="thumb">
                                                <img src="img/shop_item_8.jpg" alt="">
                                            </div>
                                            <h6>Clothing Cloth T-shirt <span>$12</span></h6>
                                            <p>
                                                Small / Medium / Large
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div-->
                            <!-- /row -->
							<div class="main_title_2">
								<span><em></em></span>
								<h2>Location</h2>
								<p><?php echo e($garage->address); ?>, <?php echo e($allCities[$garage->city_id]['name']); ?>, <?php echo e($countries[$garage->country_id]['name']); ?>, <?php echo e($garage->postal); ?> </p>
							</div>
							
							<iframe src="https://www.google.com/maps?q=<?php echo e($garage->latitude); ?>,<?php echo e($garage->longitude); ?>&hl=es;z=14&amp;output=embed" width="600" height="450" allowfullscreen id="map_iframe"></iframe>
							<!-- End Map -->
						</section>
						<!-- /section -->
					
						<section id="reviews">
							<h2>Reviews</h2>
							<div class="reviews-container add_bottom_30">
								<div class="row">
									<div class="col-lg-3">
										<div id="review_summary">
											<strong>8.5</strong>
											<em>Superb</em>
											<small>Based on 4 reviews</small>
										</div>
									</div>
									<div class="col-lg-9">
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>5 stars</strong></small></div>
										</div>
										<!-- /row -->
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>4 stars</strong></small></div>
										</div>
										<!-- /row -->
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>3 stars</strong></small></div>
										</div>
										<!-- /row -->
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>2 stars</strong></small></div>
										</div>
										<!-- /row -->
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>1 stars</strong></small></div>
										</div>
										<!-- /row -->
									</div>
								</div>
								<!-- /row -->
							</div>

							<div class="reviews-container">

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar1.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
										</div>
										<div class="rev-info">
											Admin – April 03, 2016:
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
								<!-- /review-box -->
								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar2.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
										</div>
										<div class="rev-info">
											Ahsan – April 01, 2016:
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
								<!-- /review-box -->
								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar3.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
										</div>
										<div class="rev-info">
											Sara – March 31, 2016:
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
								<!-- /review-box -->
							</div>
							<!-- /review-container -->
						</section>
						<!-- /section -->
						<hr>

							<div class="add-review">
								<h5>Leave a Review</h5>
								<form>
									<div class="row">
										<div class="form-group col-md-6">
											<label>Name and Lastname *</label>
											<input type="text" name="name_review" id="name_review" placeholder="" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Email *</label>
											<input type="email" name="email_review" id="email_review" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Rating </label>
											<div class="custom-select-form">
											<select name="rating_review" id="rating_review" class="wide">
												<option value="1">1 (lowest)</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5" selected>5 (medium)</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10 (highest)</option>
											</select>
											</div>
										</div>
										<div class="form-group col-md-12">
											<label>Your Review</label>
											<textarea name="review_text" id="review_text" class="form-control" style="height:130px;"></textarea>
										</div>
										<div class="form-group col-md-12 add_top_20 add_bottom_30">
											<input type="submit" value="Submit" class="btn_1" id="submit-review">
										</div>
									</div>
								</form>
							</div>
					</div>
					<!-- /col -->
					
					<aside class="col-lg-4" id="sidebar">
						<div class="box_detail booking">
							<div class="price">
								<h5 class="d-inline">Contact us</h5>
								<div class="score"><span>Good<em>350 Reviews</em></span><strong>7.0</strong></div>
							</div>
							<div id="message-contact-detail"></div>
							<form method="post" action="assets/contact_detail.php" id="contact_detail" autocomplete="off">
								<div class="form-group">
									<input class="form-control" type="text" placeholder="Name" name="name_detail" id="name_detail">
									<i class="ti-user"></i>
								</div>
								<div class="form-group">
									<input class="form-control" type="email" placeholder="Email" name="email_detail" id="email_detail">
									<i class="icon_mail_alt"></i>
								</div>
								<div class="form-group">
									<textarea placeholder="Your message" class="form-control" name="message_detail" id="message_detail"></textarea>
									<i class="ti-pencil"></i>
								</div>
								<div class="form-group">
									<input placeholder="Are you human? 3 + 1 =" class="form-control" type="text" id="verify_contact_detail" name="verify_contact_detail">
								</div>
								<div class="form-group">
									<input type="submit" value="Contact us" class="add_top_30 btn_1 full-width purchase" id="submit-contact-detail">
								</div>
								<a href="wishlist.html" class="btn_1 full-width outline wishlist"><i class="icon_heart"></i> Add to wishlist</a>
								<div class="text-center"><small>No money charged in this step</small></div>
							</form>
						</div>
						<ul class="share-buttons">
							<li><a class="fb-share" href="#0"><i class="social_facebook"></i> Share</a></li>
							<li><a class="twitter-share" href="#0"><i class="social_twitter"></i> Share</a></li>
							<li><a class="gplus-share" href="#0"><i class="social_googleplus"></i> Share</a></li>
						</ul>
					</aside>
				</div>
				<!-- /row -->
		</div>
		<!-- /container -->
		
	</main>    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_js'); ?>
    <!-- Map -->
   
    <script src="<?php echo e(asset('website-theme/js/map_single_shop.js')); ?>"></script>
    <script src="<?php echo e(asset('website-theme/js/infobox.js')); ?>"></script>

<?php $__env->stopSection(); ?>
	
<?php echo $__env->make('website::layouts.search-listings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Website/Resources/views/listings/single-workshops-garages.blade.php ENDPATH**/ ?>