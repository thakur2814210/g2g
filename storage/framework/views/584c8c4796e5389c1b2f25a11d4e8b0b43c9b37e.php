<?php $__env->startSection('website_css_pre'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
		
	<div class="sub_header_in sticky_header">
		<div class="container">
			<h1><?php echo app('translator')->get('website::default.privacy'); ?></h1>
		</div>
	</div>

	<main>
		<div class="container margin_60 content-page">
			<?php if(\Config::get('app.locale') == 'en'): ?>
				<?php echo $pageContnet->privacy_policy_en; ?>

			<?php else: ?>
				<?php echo $pageContnet->privacy_policy_ar; ?>

			<?php endif; ?>
			
		</div>
	</main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('website::layouts.page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Website/Resources/views/pages/privacy.blade.php ENDPATH**/ ?>