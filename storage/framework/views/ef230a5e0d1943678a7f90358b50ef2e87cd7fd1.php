
<?php $__env->startSection('content'); ?>
<!-- Compare Content -->
<section class="compare-content">
  <div class="container">
    <div class="row">
      <div class="col-12 mb-3"><h1>Compare Products Overview</h1></div>

      <?php $__currentLoopData = $result['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-lg-6">
          <table class="table">
              <thead>
                <td align="center">
                  <div class="img-div">
                      <img class="img-fluid" src="<?php echo e($products['product_data'][0]->image_path); ?>">
                  </div>

                </td>
              </thead>

              <tbody>
                <tr>
                  <td>
                    <h2 ><?php echo e($products['product_data'][0]->products_name); ?></h2>
                  </td>

                </tr>
                <tr>
                  <?php
                  $default_currency = DB::table('currencies')->where('is_default',1)->first();
                  if($default_currency->id == Session::get('currency_id')){

                    $currency_value = 1;
                  }else{
                    $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();

                    $currency_value = $session_currency->value;
                  }
                  ?>
                  <td>
                    <span>Price&nbsp;:&nbsp;</span>
                    <span class="price-tag">
                      <?php echo e(Session::get('symbol_left')); ?>

                      <?php echo e($products['product_data'][0]->products_price+0*$currency_value); ?>

                      <?php echo e(Session::get('symbol_right')); ?>

                  </span>
                </td>
                </tr>
                <tr>
                  <td>
                    <span>Discount&nbsp;:&nbsp;</span>
                    <?php
                                                $current_date = date("Y-m-d", strtotime("now"));

                                                $string = substr($products['product_data'][0]->products_date_added, 0, strpos($products['product_data'][0]->products_date_added, ' '));
                                                $date=date_create($string);
                                                date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));


                                                $after_date = date_format($date,"Y-m-d");

                                                if($after_date>=$current_date){
                                                }

                                                if(!empty($products['product_data'][0]->discount_price)){
                                                    $discount_price = $products['product_data'][0]->discount_price;
                                                    $orignal_price = $products['product_data'][0]->products_price;

                                                    if(($orignal_price+0)>0){
                              $discounted_price = $orignal_price-$discount_price;
                              $discount_percentage = $discounted_price/$orignal_price*100;
                            }else{
                              $discount_percentage = 0;
                            }
                                              echo "<span style='margin-left:15px' class='discount-tag'>".(int)$discount_percentage."%</span>";
                            }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span style="margin-right:-14px;">New</span>
                    <span>Price&nbsp;:&nbsp;</span>
                    <span class="price-tag">
                    <?php echo e(Session::get('symbol_left')); ?>

                    <?php echo e($products['product_data'][0]->discount_price+0*$currency_value); ?>

                    <?php echo e(Session::get('symbol_right')); ?>

                  </span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span>Type&nbsp;:&nbsp;</span>
                  <?php  foreach($products['product_data'][0]->categories as $f) { ?>
                    <?php echo e($f->categories_name); ?><?php if(++$key === count($products['product_data'][0]->categories)): ?> <?php else: ?>, <?php endif; ?>
                  <?php   } ?>
                  </td>
                </tr>
                <?php  foreach($products['product_data'][0]->attributes as $f) { ?>
                <tr>
                  <td>
                    <span><?php echo e($f['option']['name']); ?>&nbsp;:&nbsp;</span>
                    <?php  foreach($f['values'] as $d) { ?>
                    <span style="margin-left:15px;"><?php echo e($d['value']); ?></span>
                    <?php   } ?>
                  </td>
                </tr>
                <?php   } ?>
                <tr>
                  <td>
                    <div class="detail-buttons">
                        <a href="<?php echo e(URL::to('/product-detail/'.$products['product_data'][0]->products_slug)); ?>" class="btn btn-secondary">View Details</a>
                        <div class="share"><a href="<?php echo e(URL::to("/deletecompare")); ?>/<?php echo e($products['product_data'][0]->products_id); ?>">Remove &nbsp;<i class="fas fa-trash-alt"></i></a> </div>

                    </div>

                  </td>

                </tr>
              </tbody>
            </table>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/web/compare.blade.php ENDPATH**/ ?>