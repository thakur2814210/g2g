<section class="blog-content">
  <div class="container">

   <div class="blog-area">

  	 <div class="row">

  		 <div class="col-12 col-lg-8">
  				 <div class="row">
  					 <?php if($result['news']['success']==1): ?>
  					 <?php $__currentLoopData = $result['news']['news_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$news_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  						 <div class="col-12 col-sm-12 col-md-6">
  								 <div class="blog">
  									 <div class="blog-thumbnail">
  										 <img class="img-thumbnail" src="<?php echo e(asset('').$news_data->image_path); ?>" width="100%">
  										 <?php if($news_data->is_feature==1): ?>
  										 <div class="badge badge-primary"><span><?php echo app('translator')->get('website.Featured'); ?></span></div>
  										 <?php endif; ?>
  									 </div>

                     <a href="<?php echo e(URL::to('/news-detail/'.$news_data->news_slug)); ?>">
  									 <h6 class="blog-title"><?php echo e($news_data->news_name); ?></h6>
                     </a>
  											 <p>
  													<?php echo e($news_data->news_description); ?>

  											 </p>
  								 </div>
  						 </div>
  					 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  					 <?php endif; ?>

  				 </div>
  		 </div>
  		 <div class="col-12 col-lg-4  d-lg-block d-xl-block blog-menu">
  			 <div class="category-div">
  				 <div class="heading">
  						 <h2>
  							<?php echo app('translator')->get('website.Featured News'); ?>
  						 </h2>
  						 <hr style="margin-bottom: 0;">
  					 </div>
  					  <?php $__currentLoopData = $result['commonContent']['featuredNews']['news_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$news_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  					 <div class="media">
  							 <img src="<?php echo e(asset('').$news_data->image_path); ?>" alt="John Doe" class=" mt-1" style="width:68px;height:68px;">
  							 <div class="media-body">
                  <a href="<?php echo e(URL::to('/news-detail/'.$news_data->news_slug)); ?>">
  								 <h4><?php echo e($news_data->news_name); ?></h4>
                  </a>
  								 <p><?php echo e($news_data->news_description); ?></p>
  							 </div>
  						 </div>
  						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  				 </div>
  			 </div>
  		 </div>

   </div>
  </div>
</section>
<?php /**PATH /home/g2g/public_html/resources/views/autoshop/blogs/blog1.blade.php ENDPATH**/ ?>