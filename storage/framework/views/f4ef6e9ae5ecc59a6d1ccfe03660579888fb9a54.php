
	<?php if(!empty($garages) && count($garages) > 0): ?>
	<label class="text-danger">#<?php echo e($garages->count()); ?> Garages found. </label>
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
	                      <small> <b>Address:</b>
							<?php echo e($garage->address); ?>, <?php echo e($garage->postal); ?></small>
	                    </label>
			        </div>
			    </div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		</div>
	 <?php else: ?>
	 	<div class="card-body table-responsive" style="margin-bottom: 10px; border:5px solid #ddd; ">
	 		<div class="alert alert-danger">
	 			<label> No Garage available as per your Location and Category Request. Please change ctaegory OR request in Custom Service.</label>
	 		</div>
	 	</div>
	<?php endif; ?>
<?php /**PATH /home/devhs/public_html/g2g-v3/Modules/Client/Resources/views/service-request/includes/garage-list.blade.php ENDPATH**/ ?>