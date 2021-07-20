<?php $__env->startSection('title', 'Garage Dashboard'); ?>

<?php $__env->startSection('website_css'); ?>
<style type="text/css">
	.nav-link.active{
		color: #111;
	}
	.nav-item > a{
		color: #fff;
	}

	.card-header{
		background: #e9ecef;
		color: #d20811;
	}

	.nav-pills .nav-link.active, .nav-pills .show>.nav-link{
	  background: #f0151f;
	}
</style>

   
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

		<ol class="breadcrumb padding_bottom">
        <li class="breadcrumb-item">
          <a href="<?php echo e(route('garage.dashboard')); ?>"><i class="fa fas fa-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item"><i class="fa fas fa-building"></i> My Garage</li>
       
      </ol>

       <?php if($errors->any() || session('status')): ?>
       <div class="row">
          <div class="col-12">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
             <?php if(session('status')): ?>
                  <div class="alert alert-success">
                      <?php echo e(session('status')); ?>

                  </div>
              <?php endif; ?>
          </div>
        </div>
     <?php endif; ?>

		<div class="card">
          	<div class="card-header p-0" style="padding:0px;">
	           <ul class="nav nav-pills nav-justified text-uppercase">
				  <li class="nav-item">
				    <a class="nav-link active" id="pills-detail-tab" data-toggle="pill" href="#pills-detail" role="tab" aria-controls="pills-detail" aria-selected="true"><i class="fa fas fa-building"></i> Garage Detail</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="pills-team-tab" data-toggle="pill" href="#pills-team" role="tab" aria-controls="pills-team" aria-selected="false"><i class="fa fas fa-users"></i> Garage Team</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="pills-image-tab" data-toggle="pill" href="#pills-image" role="tab" aria-controls="pills-image" aria-selected="false"><i class="fa fas fa-image"></i> Garage Images</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="pills-video-tab" data-toggle="pill" href="#pills-video" role="tab" aria-controls="pills-video" aria-selected="false"><i class="fa fas fa-youtube"></i> Garage Video</a>
				  </li>
				</ul>
          	</div>

          	<div class="card-body table-responsive p-3">
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-detail" role="tabpanel" aria-labelledby="pills-detail-tab">
					  	<?php echo $__env->make('garage::garage.partials.garage-detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
					  <div class="tab-pane fade" id="pills-team" role="tabpanel" aria-labelledby="pills-team-tab">
					  		<?php echo $__env->make('garage::garage.partials.garage-team', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					  </div>
					  <div class="tab-pane fade" id="pills-image" role="tabpanel" aria-labelledby="pills-image-tab">
					  	<?php echo $__env->make('garage::garage.partials.garage-image', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					  </div>
					  <div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
					  	<?php echo $__env->make('garage::garage.partials.garage-video', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					  </div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('website_js'); ?>
 	
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('garage::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/g2g/public_html/Modules/Garage/Resources/views/garage/index.blade.php ENDPATH**/ ?>