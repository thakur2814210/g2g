
	<?php if(!empty($garages) && count($garages) > 0): ?>
	<p class="text-danger">#<?php echo e($garages->count()); ?> <?php echo e(trans('website.Garages found')); ?> </p>
			<br/>
		<div class="card-body table-responsive">
			
			<?php $__currentLoopData = $garages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<div class="card flex-row flex-wrap">
					 <div class="card-header border-0">
	                  <input type="radio"  name="garage_id" value="<?php echo e($garage->id); ?>">
	             	 </div>
			        <div class="card-block px-2">
			            <h6 style="margin: 0px;" class="card-title m-0 text-danger"><?php echo e($garage->name); ?></h6>
	                    <label class="card-text text-mute">
                            <small> 
                            <b> <?php echo e(trans('website.Address')); ?>:</b> <?php echo e($garage->address); ?>, 
                                <?php if(\Config::get("app.locale") == 'en'): ?> <?php echo e($garage->city_name); ?> <?php else: ?> <?php echo e($garage->city_name); ?>  <?php endif; ?>, 
                                <?php echo e($garage->pobox); ?>, 
                                <?php if(\Config::get("app.locale") == 'en'): ?> <?php echo e($garage->country_name); ?> <?php else: ?> <?php echo e($garage->country_name_ar); ?>  <?php endif; ?>
                            </small>
	                    </label>
			        </div>
			    </div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		</div>
	 <?php else: ?>
	 	<div class="card-body table-responsive" style="margin-bottom: 10px; border:5px solid #ddd; ">
	 		<div class="alert alert-danger">
	 			<label> <?php echo e(trans('website.no_garage_found')); ?></label>
	 		</div>
	 	</div>
	<?php endif; ?>
<?php /**PATH D:\xampp74\htdocs\g2g\Modules/Client\Resources/views/service-request/includes/garage-list.blade.php ENDPATH**/ ?>