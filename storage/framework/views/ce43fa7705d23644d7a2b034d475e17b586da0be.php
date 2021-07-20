<?php $__env->startSection('website_css_pre'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_css'); ?>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
		
	<div class="sub_header_in sticky_header">
		<div class="container">
			<h1><?php echo app('translator')->get('website::default.about_us'); ?></h1>
		</div>
	</div>
	
	<main>

		<div class="bg_color_1">
			<div class="container margin_80_55">
				<div class="main_title_2">
					<span><em></em></span>
					<h2><?php echo app('translator')->get('website::default.origin_story_title'); ?></h2>
					<p><?php echo app('translator')->get('website::default.origin_story_text'); ?></p>
				</div>
				<div class="row justify-content-between">
					<div class="col-lg-6 wow" data-wow-offset="150">
						<figure class="block-reveal">
							<div class="block-horizzontal"></div>
							<img src="<?php echo e(asset( 'website-theme/img/about_1.jpg')); ?>" class="img-fluid" alt="">
						</figure>
					</div>
					<div class="col-lg-5">
						<p>Lorem ipsum dolor sit amet, homero erroribus in cum. Cu eos <strong>scaevola probatus</strong>. Nam atqui intellegat ei, sed ex graece essent delectus. Autem consul eum ea. Duo cu fabulas nonumes contentiones, nihil voluptaria pro id. Has graeci deterruisset ad, est no primis detracto pertinax, at cum malis vitae facilisis.</p>
						<p>Dicam diceret ut ius, no epicuri dissentiet philosophia vix. Id usu zril tacimates neglegentur. Eam id legimus torquatos cotidieque, usu decore <strong>percipitur definitiones</strong> ex, nihil utinam recusabo mel no. Dolores reprehendunt no sit, quo cu viris theophrastus. Sit unum efficiendi cu.</p>
						<p><em>CEO Marc Schumaker</em></p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container margin_80_55">
			<div class="main_title_2">
				<span><em></em></span>
				<h2><?php echo app('translator')->get('website::default.why_choose_text'); ?></h2>
				<p><?php echo app('translator')->get('website::default.why_choose_title'); ?></p>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<a class="box_feat" href="#0">
						<i class="pe-7s-medal"></i>
						<h3><?php echo app('translator')->get('website::default.why_choose_box_1_title'); ?></h3>
						<p><?php echo app('translator')->get('website::default.why_choose_box_1_text'); ?></p>
					</a>
				</div>
				<div class="col-lg-4 col-md-6">
					<a class="box_feat" href="#0">
						<i class="pe-7s-credit"></i>
						<h3><?php echo app('translator')->get('website::default.why_choose_box_2_title'); ?></h3>
						<p><?php echo app('translator')->get('website::default.why_choose_box_2_text'); ?></p>
					</a>
				</div>
				<div class="col-lg-4 col-md-6">
					<a class="box_feat" href="#0">
						<i class="pe-7s-culture"></i>
						<h3><?php echo app('translator')->get('website::default.why_choose_box_3_title'); ?></h3>
						<p><?php echo app('translator')->get('website::default.why_choose_box_3_text'); ?></p>
					</a>
				</div>
			</div>
			<!--/row-->
		</div>
		<!-- /container -->

		
		
	</main>
	
	
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('website::layouts.page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devhs/public_html/g2g-v3/Modules/Website/Resources/views/pages/about-us.blade.php ENDPATH**/ ?>