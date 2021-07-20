<?php if(count($result['commonContent']['homeBanners'])>0): ?>
 <?php $__currentLoopData = ($result['commonContent']['homeBanners']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homeBanners): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($homeBanners->type==40): ?>
      <section class="full-screen-banner">

          <figure class="banner-image">
            <a href="<?php echo e($homeBanners->banners_url); ?>">
              <img src="<?php echo e(asset('').$homeBanners->path); ?>" width="100%" alt="Fullscreen Banner">
            </a>
          </figure>

      </section>
      <?php endif; ?>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php /**PATH /home/devhs/public_html/g2g-v3/resources/views/web/product-sections/ad_banner_section.blade.php ENDPATH**/ ?>