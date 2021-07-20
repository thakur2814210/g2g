<div class="container">
	<ul class="clearfix">
		<li style="list-style: none;">
			<label><?php echo e(trans('website.VIEW')); ?>: </label>
			<a class="text-danger text-uppercase" href="<?php echo e(route('listings.workshops-garages',['category' => 'near-by-garages'])); ?>" ><?php echo e(trans('website.NearBy')); ?> <span class="d-none d-md-inline"><?php echo e(trans('website.Garages')); ?></span></a>
			&nbsp;|&nbsp;
			<a class="text-info text-uppercase" href="<?php echo e(route('listings.workshops-garages',['category' => 'all'])); ?>" ><?php echo e(trans('website.All')); ?> <span class="d-none d-md-inline"><?php echo e(trans('website.Garages')); ?></span></a>
			&nbsp;|&nbsp;
			<a class="text-warning text-uppercase" href="<?php echo e(route('listings.workshops-garages',['category' => 'featured'])); ?>"><?php echo e(trans('website.Featured')); ?> <span class="d-none d-md-inline"><?php echo e(trans('website.Garages')); ?></span></a>
			&nbsp;|&nbsp;
			<a class="text-primary text-uppercase" href="<?php echo e(route('listings.workshops-garages',['category' => 'latest'])); ?>"><?php echo e(trans('website.Latest')); ?> <span class="d-none d-md-inline"><?php echo e(trans('website.Garages')); ?></span></a>
		</li>
		<li style="list-style: none;">
			<?php if(!empty($garages) && count($garages) > 0): ?>
				<?php echo e($garages->appends($_GET)->links()); ?>

			<?php endif; ?>
		</li>
		<li style="list-style: none;">
			
				<?php if(!empty($garages) && count($garages) > 0): ?>
					<strong><?php echo e($per_page); ?></strong> <?php echo e(trans('website.result for')); ?> <strong><?php echo e($garages->total()); ?></strong> <?php echo e(trans('website.Garages')); ?>

				<?php endif; ?>
			
		</li>
	</ul>
</div><?php /**PATH D:\xampp74\htdocs\g2g\resources\views/website/garages/common/paginationBar.blade.php ENDPATH**/ ?>