<div class="row">
	<?php if(!empty($garages) && count($garages)): ?>
		<?php $__currentLoopData = $garages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-6">
				<div class="strip grid">
					<figure>
						<a href="#" class="wish_bt"></a>
						<a href="<?php echo e(route('listings.workshops-garages.single',['slug' =>$garage['slug'] ])); ?>">
							<img src="<?php echo e(asset( $garage['profile_image'] )); ?>" class="img-fluid" alt="" width="400" height="266">
							<div class="read_more"><span>Read more</span></div>
						</a>
						<?php if($garage['is_feature'] == 1): ?>
							<small class="bg-danger">Premier Garage </small>
						<?php endif; ?>
					</figure>
					<div class="wrapper">
						<h3><a href="<?php echo e(route('listings.workshops-garages.single',['slug' =>$garage['slug'] ])); ?>"><?php echo e($garage->garages_name); ?></a></h3>
						<p> <b>Address:</b>
						<?php echo e($garage['address']); ?>, <?php echo e($allCities[$garage['city_id']]['name']); ?>, <?php echo e($countries[$garage['country_id']]['name']); ?>, <?php echo e($garage['postal']); ?></p>
					</div>
					<ul>
						<li><span class="loc_open">Now Open</span></li>
						<li><div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div></li>
					</ul>
				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php else: ?>
		<div class="col-12 p-3">
			<div class="strip grid">
				<div class="alert alert-danger">
					<label><i class="fa fa-exclamation-circle"></i> No Garage found for this request </label>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php /**PATH /home/devhs/public_html/g2g-v3/Modules/Website/Resources/views/listings/partials/garages-list.blade.php ENDPATH**/ ?>