<?php $__env->startSection('content'); ?>
<style type="text/css" media="screen">
	.faq-list ul{
		display: list-item !important;
		 list-style: square outside none !important;
	}
</style>

	<!-- Site Content -->
<section class="blog-content">
	<div class="container">
		<div class="row">
		 	<div class="col-12 col-lg-12">
			 	 <div class="main_title_2" style="margin-bottom: 10px;">
			        <h2><?php echo app('translator')->get('website.faq'); ?></h2>
			        <br/>
			         	<span><em style="background-color: #b42127;"></em></span>
			      </div>
			 </div>
		</div>
 		<div class="blog-area">

 			<?php if(!empty($faqs)): ?>
	   			<div class="row">
	   				<?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_name => $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <div class="col-12 col-lg-12  d-lg-block d-xl-block blog-menu">
		                    <div class="category-div">
								<div class="heading">
									<h2><?php echo $cat_name; ?></h2>
									<hr style="margin-bottom: 0;">
								</div>

								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                       
			                       	<a class=" main-manu btn" data-toggle="collapse" href="#<?php echo e('index_' . $index . '_' . strtolower($category['cat_name_en'])); ?>" role="button" aria-expanded="false" aria-controls="<?php echo e('index_' . $index . '_' .strtolower($category['cat_name_en'])); ?>">
			                            <?php echo $category['heading_en']; ?> <span><i class="fas fa-minus"></i></span>
			                         </a>
			                        <div class="sub-manu collapse multi-collapse" id="<?php echo e('index_' . $index . '_' .strtolower($category['cat_name_en'])); ?>">
			                           	  <div class="card-body faq-list">
											
											<?=stripslashes($category['answer_en'])?>     
										</div>
			                        </div>
			                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                   </div>
		                </div>
		            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	            </div>
	        <?php endif; ?>
    	</div>
    </div>
</section>








      	<!--main class="margin_60_35">
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
						
				</aside>
			
				
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
												<i class="indicator <?php echo e(($index == 0) ? 'ti-minus' : 'ti-plus'); ?>"></i>
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
												<i class="indicator <?php echo e(($index == 0) ? 'ti-minus' : 'ti-plus'); ?>"></i>
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
		
		</div>
	</main-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/website/faq.blade.php ENDPATH**/ ?>