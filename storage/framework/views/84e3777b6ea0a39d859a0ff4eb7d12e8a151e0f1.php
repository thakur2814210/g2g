<?php $__env->startSection('website_css_pre'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_css'); ?>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<main>
		<div id="error_page">
			<div class="wrapper">
				<div class="container">
					<div class="row justify-content-center text-center">
						<div class="col-xl-7 col-lg-9">
							<h2>404 <i class="icon_error-triangle_alt"></i></h2>
							<p>We're sorry, but the page you were looking for doesn't exist.</p>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /wrapper -->
		</div>
		<!-- /error_page -->
	</main>
	
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_js'); ?>
	<script>
		$('.wish_bt.liked').on('click', function (c) {
			$(this).parent().parent().parent().fadeOut('slow', function (c) {});
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('website::layouts.homepage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Website/Resources/views/pages/404.blade.php ENDPATH**/ ?>