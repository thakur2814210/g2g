
<?php $__env->startSection('content'); ?>
<!-- wishlist Content -->
<section class="wishlist-content my-4">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-3">
				<div class="heading">
						<h2>
								<?php echo app('translator')->get('website.My Account'); ?>
						</h2>
						<hr >
					</div>

				<?php echo $__env->make('autoshop.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			</div>
			<div class="col-12 col-lg-9 ">
					<div class="heading">
							<h2>
									<?php echo app('translator')->get('website.Wishlist'); ?>
							</h2>
							<hr >
						</div>

					<div class="col-12 media-main">
						<?php $__currentLoopData = $result['products']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="media">
										<img class="img-fluid" src="<?php echo e(asset('').$products->image_path); ?>" alt="<?php echo e($products->products_name); ?>">
										<div class="media-body">
											<div class="row">
												<div class="col-12 col-md-8  texting">
													<?php
														 $default_currency = DB::table('currencies')->where('is_default',1)->first();
														 if($default_currency->id == Session::get('currency_id')){
															 if(!empty($products->discount_price)){
															 $discount_price = $products->discount_price;
															 }
															 $orignal_price = $products->products_price;
														 }else{
															 $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
															 if(!empty($products->discount_price)){
																 $discount_price = $products->discount_price * $session_currency->value;
															 }
															 $orignal_price = $products->products_price * $session_currency->value;
														 }
															if(!empty($products->discount_price)){

															 if(($orignal_price+0)>0){
															$discounted_price = $orignal_price-$discount_price;
															$discount_percentage = $discounted_price/$orignal_price*100;
															}else{
																$discount_percentage = 0;
																$discounted_price = 0;
														}
													?>
													<span class="discount-tag"><?php echo (int)$discount_percentage; ?>%</span>
												 <?php }
												 $current_date = date("Y-m-d", strtotime("now"));

												 $string = substr($products->products_date_added, 0, strpos($products->products_date_added, ' '));
												 $date=date_create($string);
												 date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));

												 //echo $top_seller->products_date_added . "<br>";
												 $after_date = date_format($date,"Y-m-d");

												 if($after_date>=$current_date){
													 print '<span class="discount-tag">';
													 print __('website.New');
													 print '</span>';
												 }
													?>
													<h5><a href="<?php echo e(url('/shop')); ?>"><?php echo e($products->products_name); ?></a></h5>
													<h6>Total Price:
														<?php if(!empty($products->discount_price)): ?>
					                  <?php echo e(Session::get('symbol_left')); ?><?php echo e($discounted_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

					                  <span> <?php echo e(Session::get('symbol_left')); ?><?php echo e($products->price+0); ?><?php echo e(Session::get('symbol_right')); ?></span>
					                  <?php else: ?>
					                  <?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

					                  <?php endif; ?>
													</h6>
													<p class="d-none d-lg-block d-xl-block"><?=stripslashes($products->products_description)?></p>
													<div class="buttons">
															<?php if($products->products_type==0): ?>
																	<?php if(!in_array($products->products_id,$result['cartArray'])): ?>
																			<a  class="btn btn-secondary cart" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></a>
																	<?php elseif($products->products_min_order>1): ?>
																			<a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
																	<?php else: ?>
																			<a  class="btn btn-secondary active"><?php echo app('translator')->get('website.Added'); ?></a>
																	<?php endif; ?>
															<?php elseif($products->products_type==1): ?>
																	<a class="btn  btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
															<?php elseif($products->products_type==2): ?>
																	<a href="<?php echo e($products->products_url); ?>" target="_blank" class="btn btn-block btn-secondary"><?php echo app('translator')->get('website.External Link'); ?></a>
															<?php endif; ?>
													</div>
												</div>
												<div class="col-12 col-md-4 detail">
													<div class="share"><a href="<?php echo e(URL::to("/UnlikeMyProduct")); ?>/<?php echo e($products->products_id); ?>">Remove &nbsp;<i class="fas fa-trash-alt"></i></a> </div>
												</div>
												</div>
										</div>

								</div>
								<hr class="border-line">
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<div class="toolbar mb-3 loaded_content">
							<div class="form-inline">
								<div class="form-group col-12 col-md-4"></div>

									<div class="form-group col-12 col-md-4"></div>
									<div class="form-group col-12 col-md-4">
											<label class="col-12 col-lg-4 col-form-label"><?php echo app('translator')->get('website.Limit'); ?></label>
											<select class="col-12 col-lg-3 form-control sortbywishlist" name="limit">
													<option value="15" <?php if(app('request')->input('limit')=='15'): ?> selected <?php endif; ?>">15</option>
													<option value="30" <?php if(app('request')->input('limit')=='30'): ?> selected <?php endif; ?>>30</option>
													<option value="45" <?php if(app('request')->input('limit')=='45'): ?> selected <?php endif; ?>>45</option>
											</select>
											<label class="col-12 col-lg-5 col-form-label"><?php echo app('translator')->get('website.per page'); ?></label>
									</div>
							</div>
					</div>
					<hr class="border-line">

				<!-- ............the end..... -->
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/resources/views/autoshop/wishlist.blade.php ENDPATH**/ ?>