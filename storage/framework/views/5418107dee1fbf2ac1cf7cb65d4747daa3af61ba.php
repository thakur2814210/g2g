<div class="filters_listing version_2  sticky_horizontal">
	<div class="container">
		<ul class="clearfix">

			<li>
				<div class="switch-field">
					
					<a href="<?php echo e(route('listings.workshops-garages',['category' => 'all'])); ?>">
						<button class="btn btn-sm btn-primary-outline">All</button>
					</a>

					<a href="<?php echo e(route('listings.workshops-garages',['category' => 'featured'])); ?>">
					<button class="btn btn-sm btn-primary-outline">Featured</button>
					</a>

					<a href="<?php echo e(route('listings.workshops-garages',['category' => 'latest'])); ?>">
						<button class="btn btn-sm btn-primary-outline">Latest</button>
					</a>
				</div>
			</li>
			
			
			
			
			<li>
				<?php if(!empty($garages) && count($garages) > 0): ?>
					<?php echo e($garages->appends($_GET)->links()); ?>

				<?php endif; ?>
			</li>
			
			
			<li>
				<div class="p-2">
					<strong><?php echo e($per_page); ?></strong> result for <strong><?php echo e($garages->total()); ?></strong> Garages
				</div>
			</li>

		
			
		</ul>
	</div>
</div>
<?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Website/Resources/views/listings/partials/header-filters_listing.blade.php ENDPATH**/ ?>