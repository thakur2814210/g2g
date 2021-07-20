<!-- Products content -->
<?php if(!empty($result['commonContent']['categories'])): ?>
<section class="products-content">
  <div class="container">
    <div class="products-area category-area">
      <!-- heading -->
      <div class="heading">
        <h2><?php echo app('translator')->get('website.Categories'); ?></h2>
        <hr>
      </div>
      <div class="row">
        <!-- categories -->
        <?php $counter = 0;?>
        <?php $__currentLoopData = $result['commonContent']['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($counter<=7): ?>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                  <!-- categories -->
                  <div class="product">
                      <article>
                        <div class="module">
                          <div class="cat-thumb">
                              <img class="img-fluid" src="<?php echo e(asset('').$categories_data->path); ?>" alt="<?php echo e($categories_data->name); ?>">
                          </div>
                          <a href="<?php echo e(URL::to('/shop?category='.$categories_data->slug)); ?>" class="cat-title">
                            <?php echo e($categories_data->name); ?>

                          </a>
                        </div>
                      </article>
                  </div>
                </div>
                <?php endif; ?>
                <?php $counter++;?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>
    </div>


  </div>
</section>
<?php endif; ?>
<?php /**PATH /home/g2g/public_html/resources/views/web/product-sections/categories.blade.php ENDPATH**/ ?>