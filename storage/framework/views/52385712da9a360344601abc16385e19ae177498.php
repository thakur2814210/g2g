<?php if($result['flash_sale']['success']==1): ?>
<section class="products-content">
  <div class="container">
    <?php if($result['flash_sale']['success']==1): ?>
    <div class="products-area">
      <!-- ..........tabs start ......... -->
      <div class="row">
        <div class="col-md-12">
          <div class="nav nav-pills" role="tablist">
            <?php if($result['top_seller']['success']==1): ?>
            <a class="nav-link nav-item nav-index active show" href="#featured" id="featured-tab" data-toggle="pill" role="tab"><?php echo app('translator')->get('website.TopSales'); ?></a>
            <?php endif; ?>
            <?php if($result['special']['success']==1): ?>
            <a class="nav-link nav-item nav-index" href="#special" id="special-tab" data-toggle="pill" role="tab" ><?php echo app('translator')->get('website.Special'); ?></a>
            <?php endif; ?>
            <?php if($result['most_liked']['success']==1): ?>
            <a class="nav-link nav-item nav-index" href="#liked" id="liked-tab" data-toggle="pill" role="tab" ><?php echo app('translator')->get('website.MostLiked'); ?></a>
            <?php endif; ?>
          </div>
          <!-- Tab panes -->
          <div class="tab-content">
            <?php if($result['top_seller']['success']==1): ?>
            <div role="tabpanel" class="tab-pane fade active show" id="featured" aria-labelledby="featured-tab">
              <div id="owl-tab" class="owl-tab owl-carousel">
                <?php $__currentLoopData = $result['top_seller']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('autoshop.common.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="product last-product">
                  <article>
                    <div class="icons">
                      <a href="<?php echo e(url('/shop')); ?>">
                        <i class="fas fa-angle-right icon"></i>
                      </a>
                      <a href="<?php echo e(url('/shop')); ?>" class="btn btn-block btn-link"><?php echo app('translator')->get('website.View'); ?></a>
                    </div>
                  </article>
                </div>

              </div>
              <!-- 1st tab -->
            </div>
            <?php endif; ?>
            <?php if($result['special']['success']==1): ?>
            <div role="tabpanel" class="tab-pane fade" id="special" aria-labelledby="special-tab">
                <div id="owl-tab" class="owl-tab owl-carousel">
                  <?php $__currentLoopData = $result['special']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php echo $__env->make('autoshop.common.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="product last-product">
                      <article>
                        <div class="icons">
                            <a href="<?php echo e(url('/shop')); ?>">
                                <i class="fas fa-angle-right icon"></i>
                              </a>
                              <a href="<?php echo e(url('/shop')); ?>" class="btn btn-block btn-link"><?php echo app('translator')->get('website.View'); ?></a>
                        </div>
                      </article>
                    </div>

                  </div>
              <!-- 2nd tab -->
            </div>
            <?php endif; ?>
            <?php if($result['most_liked']['success']==1): ?>
            <div role="tabpanel" class="tab-pane fade" id="liked" aria-labelledby="liked-tab">
                <div id="owl-tab" class="owl-tab owl-carousel">
                    <?php $__currentLoopData = $result['most_liked']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('autoshop.common.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="product last-product">
                      <article>
                        <div class="icons">
                            <a href="<?php echo e(url('/shop')); ?>">
                                <i class="fas fa-angle-right icon"></i>
                              </a>
                              <a href="<?php echo e(url('/shop')); ?>" class="btn btn-block btn-link"><?php echo app('translator')->get('website.View'); ?></a>
                        </div>
                      </article>
                    </div>

                  </div>
              <!-- 3rd tab -->
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>
<?php /**PATH /Users/apple/Projects/g2g-v3/resources/views/autoshop/product-sections/tab.blade.php ENDPATH**/ ?>