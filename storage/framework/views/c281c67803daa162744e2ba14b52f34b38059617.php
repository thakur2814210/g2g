<?php $__env->startSection('content'); ?>

	<div class="container">
		<div id="results">
   			<div class="container">
			   <?php echo $__env->make('website.garages.common.searchLocationBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   			</div>
		</div>
		<div class="filters_listing version_2  sticky_horizontal">
			<?php echo $__env->make('website.garages.common.paginationBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>

		<div class="row">
			<aside class="col-lg-3" id="sidebar">
				<?php echo $__env->make('website.garages.common.leftSidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</aside>

			<div class="col-lg-9">
				<div class="row" id="garages-list">
					<?php if(!empty($garages) && count($garages)): ?>
						<?php $__currentLoopData = $garages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						
							<div class="col-md-6 col-sm-12">
								<div class="strip grid">
									<figure>
										<a href="#" class="wish_bt"></a>
										<a href="<?php echo e(route('listings.workshops-garages.single',['slug' =>$garage['slug'] ])); ?>">
											<img src="<?php echo e(asset( $garage['profile_image'] )); ?>" class="img-fluid" alt="" width="400" height="266">
											<div class="read_more"><span><?php echo e(trans('website.Read More')); ?></span></div>
										</a>
										<?php if($garage['is_feature'] == 1): ?>
											<small class="bg-danger"><?php echo e(trans('website.Premier Garage')); ?> </small>
										<?php endif; ?>
									</figure>
									<div class="wrapper">
									    <?php
									       // dd($garage);
									    ?>
										<h3><a href="<?php echo e(route('listings.workshops-garages.single',['slug' =>$garage['slug'] ])); ?>">
										    <?php echo e(isset($garage['garages_name']) ? $garage['garages_name'] : ''); ?>

										 </a></h3>
										 <?php if(isset($garage['address'])): ?>
										<p> <b><?php echo e(trans('website.Address')); ?>:</b>
										<?php echo e($garage['address']); ?>, <?php echo e($allCities[$garage['city_id']]['name']); ?>, <?php echo e($countries[$garage['country_id']]['name']); ?>, <?php echo e($garage['postal']); ?></p>
									    <?php endif; ?>
									</div>
								</div>
							</div>
							
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
						<div class="col-12 p-3">
							<div class="strip grid">
								<div class="alert alert-danger">
									<label><i class="fa fa-exclamation-circle"></i><?php echo e(trans('website.No Garage found for this request')); ?></label>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>		

	</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <?php echo $__env->make('website.common.scripts.garages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/website/garages/listings.blade.php ENDPATH**/ ?>