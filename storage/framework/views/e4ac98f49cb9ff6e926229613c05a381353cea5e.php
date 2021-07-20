<?php $__env->startSection('website_css_pre'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_css'); ?>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
		
	
	<main class="margin_60_35">
		<div class="container margin_60_35">
			<div class="row">
				<?php if(!empty($faqs)): ?>
				<aside class="col-lg-3" id="faq_cat">
						<div class="box_style_cat" id="faq_box">
							<ul id="cat_nav">
								<?php $__currentLoopData = $cat_names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li>
									<a href="#<?php echo e(strtolower($category)); ?>" class="<?php if($index == 0): ?> 'active' <?php else: ?> '' <?php endif; ?>">
										<i class="icon_document_alt"></i><?php echo e($category); ?>

									</a>
								</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
						<!--/sticky -->
				</aside>
				<!--/aside -->
				
				<div class="col-lg-9" id="faq">
					<?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_name => $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


					<h4 class="nomargin_top"><?php echo e($cat_name); ?></h4>
					<div role="tablist" class="add_bottom_45 accordion_2" id="<?php echo e(strtolower($cat_name)); ?>">
						<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="card">
								<?php if(\Config::get('app.locale') == 'en'): ?>
									<div class="card-header" role="tab">
										<h5 class="mb-0">
											<a data-toggle="collapse" href="#collapse<?php echo e($index); ?>_<?php echo e(strtolower($category['cat_name_en'])); ?>" aria-expanded="true">
												<i class="indicator <?php if($index == 0): ?> ti-minus <?php endif; ?>"></i>
												<?php echo e($category['heading_en']); ?>

											</a>
											
										</h5>
									</div>

									<div id="collapse<?php echo e($index); ?>_<?php echo e(strtolower($category['cat_name_en'])); ?>" class="collapse <?php if($index == 0): ?> show <?php endif; ?>" role="tabpanel" data-parent="#<?php echo e(strtolower($category['cat_name_en'])); ?>">
										<div class="card-body">
											<?php echo $category['answer_en']; ?>

										</div>
									</div>
								<?php else: ?>
									<div class="card-header" role="tab">
										<h5 class="mb-0">
											<a data-toggle="collapse" href="#collapse<?php echo e($index); ?>_<?php echo e(strtolower($category['cat_name_ar'])); ?>" aria-expanded="true">
												<i class="indicator <?php if($index == 0): ?> ti-minus <?php endif; ?>"></i>
												<?php echo e($category['heading_ar']); ?>

											</a>
											
										</h5>
									</div>

									<div id="collapse<?php echo e($index); ?>_<?php echo e(strtolower($category['cat_name_ar'])); ?>" class="collapse <?php if($index == 0): ?> show <?php endif; ?>" role="tabpanel" data-parent="#<?php echo e(strtolower($category['cat_name_ar'])); ?>">
										<div class="card-body">
											<?php echo $category['answer_ar']; ?>

										</div>
									</div>
								<?php endif; ?>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
				<?php endif; ?>
			</div>
			<!-- /row -->
		</div>
	</main>
	
	
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('website::layouts.page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Website/Resources/views/pages/faq.blade.php ENDPATH**/ ?>