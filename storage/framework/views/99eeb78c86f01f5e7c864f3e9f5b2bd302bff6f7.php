<section class="products-content">
  <div class="container">
    <!-- Banner -->
  <?php if(count($result['commonContent']['homeBanners'])>0): ?>
   <?php $__currentLoopData = ($result['commonContent']['homeBanners']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homeBanners): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($homeBanners->type==39): ?>
    <div class="full-width-banner">
      <div class="row">
        <div class="col-12 col-sm-12">
          <figure class="banner-image">
            <a href="shop?category=vehicles-and-customization">
              <img class="img-fluid" src="<?php echo e(asset('').$homeBanners->path); ?>" alt="Full Width Banner">
            </a>
          </figure>
        </div>
      </div>
    </div>
    <?php endif; ?>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
</div>
</section>
<?php /**PATH /home/g2g/public_html/resources/views/autoshop/product-sections/sec_ad_banner.blade.php ENDPATH**/ ?>