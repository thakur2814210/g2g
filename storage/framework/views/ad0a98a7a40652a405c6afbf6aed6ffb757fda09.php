<?php $__env->startSection('website_css_pre'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_css'); ?>
	<style id="theia-sticky-sidebar-stylesheet-TSS">.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>
	<style type="text/css">
		.slidecontainer {
		  width: 100%;
		}

		.slider {
		  -webkit-appearance: none;
		  width: 100%;
		  height: 25px;
		  background: #d3d3d3;
		  outline: none;
		  opacity: 0.7;
		  -webkit-transition: .2s;
		  transition: opacity .2s;
		}

		.slider:hover {
		  opacity: 1;
		}

		.slider::-webkit-slider-thumb {
		  -webkit-appearance: none;
		  appearance: none;
		  width: 25px;
		  height: 25px;
		  background: #4CAF50;
		  cursor: pointer;
		}

		.slider::-moz-range-thumb {
		  width: 25px;
		  height: 25px;
		  background: #4CAF50;
		  cursor: pointer;
		}
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
		
	
<main>
	<!-- /header -->
	<?php echo $__env->make('website::listings.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   	<?php echo $__env->make('website::listings.partials.header-filters_listing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   		
	
	
	<div class="container p-1">

		<!--div class="row">
			<div class="col-12">
				<div class="alert alert-success">
					<b>Filter : </b> <br/>
					<h6>
						City: <span><a href="#" class="badge badge-primary">Primary X</a> </span> | 
						Category: <a href="#" class="badge badge-primary">Primary</a> | 
						Distance: <a href="#" class="badge badge-primary">Primary</a> | 
					</h6>
				</div>
			</div>
		</div-->
		<div class="row">
			<!-- /left-filter-sidebar -->
			<aside class="col-lg-3" id="sidebar">
				<form id="filterForm" method="get" action="<?php echo e(route('listings.search')); ?>">
					<?php echo $__env->make('website::listings.partials.left-filter-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</form>
			</aside>

			<div class="col-lg-9">
				<?php echo $__env->make('website::listings.partials.garages-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		</div>		
	</div>
	<!-- /container -->
	
</main>
	
	
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('website::layouts.search-listings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Website/Resources/views/listings/all-workshops-garages.blade.php ENDPATH**/ ?>