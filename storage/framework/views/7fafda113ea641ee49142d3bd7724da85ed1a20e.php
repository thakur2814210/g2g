<?php $__env->startSection('content'); ?>
	<section class="blog-content">
		  <div class="container ">
		    <div class="blog-area margin_80_55">
		      <main class="content-page">
				    <div class="bg_color_1">
				      <div class="container ">
				        <div class="main_title_2" style="padding:10px;">
				          <h2><?php echo app('translator')->get('website.terms_and_conditions'); ?></h2>
				           <span><em></em></span>
				        </div>
				        <div class="row justify-content-between">
				        
				          <div class="col-lg-12">
				            <?php if(\Config::get('app.locale') == 'en'): ?>
								<?php echo $pageContnet->terms_conditions_en; ?>

							<?php else: ?>
								<?php echo $pageContnet->terms_conditions_ar; ?>

							<?php endif; ?>
				          </div>
				        </div>
				      </div>
				    </div>
    			</main>
			</div>
		</div>
	</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/resources/views/website/term-and-conditions.blade.php ENDPATH**/ ?>