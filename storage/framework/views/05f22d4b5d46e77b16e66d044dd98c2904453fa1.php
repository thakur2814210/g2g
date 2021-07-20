
<section class="product-page product-page-one ">
    <div class="container">

      <div class="product-main">

          <div class="row">
            <div class="col-12 col-sm-12">
                <div class="row justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">

                          <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><?php echo app('translator')->get('website.Home'); ?></a></li>

                          <?php if(!empty($result['category_name']) and !empty($result['sub_category_name'])): ?>
                            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/shop?category='.$result['category_slug'])); ?>"><?php echo e($result['category_name']); ?></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/shop?category='.$result['sub_category_slug'])); ?>"><?php echo e($result['sub_category_name']); ?></a></li>
                          <?php elseif(!empty($result['category_name']) and empty($result['sub_category_name'])): ?>
                            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/shop?category='.$result['category_slug'])); ?>"><?php echo e($result['category_name']); ?></a></li>
                          <?php endif; ?>
                          <li class="breadcrumb-item active"><?php echo e($result['detail']['product_data'][0]->products_name); ?></li>
                        </ol>
                      </nav>
                </div>
            </div>
            <div class="col-12 col-sm-12">
              <div class="row">
                    <div class="col-12 col-lg-5">

                      <div class="slider-wrapper">
                          <div class="slider-for">
                            <a class="slider-for__item ex1 fancybox-button" href="<?php echo e(asset('').$result['detail']['product_data'][0]->image_path); ?>" data-fancybox-group="fancybox-button" title="Lorem ipsum dolor sit amet">
                              <img src="<?php echo e(asset('').$result['detail']['product_data'][0]->image_path); ?>" alt="Zoom Image" />
                            </a>
                            <?php $__currentLoopData = $result['detail']['product_data'][0]->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($images->image_type == 'ACTUAL'): ?>
                              <a class="slider-for__item ex1 fancybox-button" href="<?php echo e(asset('').$images->image_path); ?>" data-fancybox-group="fancybox-button" title="Lorem ipsum dolor sit amet">
                                <img src="<?php echo e(asset('').$images->image_path); ?>" alt="Zoom Image" />
                              </a>
                              <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                          </div>
                          <div class="slider-nav">
                            <div class="slider-nav__item">
                              <img src="<?php echo e(asset('').$result['detail']['product_data'][0]->image_path); ?>" alt="Zoom Image"/>
                            </div>

                            <?php $__currentLoopData = $result['detail']['product_data'][0]->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($images->image_type == 'THUMBNAIL'): ?>
                            <div class="slider-nav__item">
                              <img src="<?php echo e(asset('').$images->image_path); ?>" alt="Zoom Image"/>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                          </div>
                        </div>
                  </div>

                    <div class="col-12 col-lg-7" >

                        <h1><?php echo e($result['detail']['product_data'][0]->products_name); ?></h1>
                        <div class="list-main">
                            <div class="icon-liked">
                              <a class="icon active is_liked" products_id="<?=$result['detail']['product_data'][0]->products_id?>">
                                <i class="fas fa-heart"></i>
                                <span  class="badge badge-secondary counter"  ><?php echo e($result['detail']['product_data'][0]->products_liked); ?></span>
                              </a>
                              </div>
                            <ul class="list">
                              <?php if(!empty($result['category_name']) and !empty($result['sub_category_name'])): ?>
                                <li><?php echo e($result['sub_category_name']); ?></li>
                              <?php elseif(!empty($result['category_name']) and empty($result['sub_category_name'])): ?>
                                <li><?php echo e($result['category_name']); ?></li>
                              <?php endif; ?>
                                <li> <?php echo e($result['detail']['product_data'][0]->products_ordered); ?>&nbsp;<?php echo app('translator')->get('website.Order(s)'); ?></li>
                                <?php if($result['detail']['product_data'][0]->products_type == 0): ?>
                                <?php if($result['detail']['product_data'][0]->defaultStock == 0): ?>
                                <li class="outstock"><i class="fas fa-check"></i><?php echo app('translator')->get('website.Out of Stock'); ?></li>
                                <?php else: ?>
                                <li class="instock"><i class="fas fa-check"></i><?php echo app('translator')->get('website.In stock'); ?></li>
                                <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <form name="attributes" id="add-Product-form" method="post" >
                            <input type="hidden" name="products_id" value="<?php echo e($result['detail']['product_data'][0]->products_id); ?>">

                            <input type="hidden" name="products_price" id="products_price" value="<?php if(!empty($result['detail']['product_data'][0]->flash_price)): ?> <?php echo e($result['detail']['product_data'][0]->flash_price+0); ?> <?php elseif(!empty($result['detail']['product_data'][0]->discount_price)): ?><?php echo e($result['detail']['product_data'][0]->discount_price+0); ?><?php else: ?><?php echo e($result['detail']['product_data'][0]->products_price+0); ?><?php endif; ?>">

                            <input type="hidden" name="checkout" id="checkout_url" value="<?php if(!empty(app('request')->input('checkout'))): ?> <?php echo e(app('request')->input('checkout')); ?> <?php else: ?> false <?php endif; ?>" >

                            <input type="hidden" id="max_order" value="<?php if(!empty($result['detail']['product_data'][0]->products_max_stock)): ?> <?php echo e($result['detail']['product_data'][0]->products_max_stock); ?> <?php else: ?> 0 <?php endif; ?>" >
                             <?php if(!empty($result['cart'])): ?>
                              <input type="hidden"  name="customers_basket_id" value="<?php echo e($result['cart'][0]->customers_basket_id); ?>" >
                             <?php endif; ?>
                                <div class="product-controls row">
                                  <?php if(count($result['detail']['product_data'][0]->attributes)>0): ?>
                                  <?php
                                      $index = 0;
                                  ?>
                                  <?php $__currentLoopData = $result['detail']['product_data'][0]->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$attributes_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php
                                      $functionValue = 'function_'.$key++;
                                  ?>
                                  <input type="hidden" name="option_name[]" value="<?php echo e($attributes_data['option']['name']); ?>" >
                                  <input type="hidden" name="option_id[]" value="<?php echo e($attributes_data['option']['id']); ?>" >
                                  <input type="hidden" name="<?php echo e($functionValue); ?>" id="<?php echo e($functionValue); ?>" value="0" >
                                  <input id="attributeid_<?=$index?>" type="hidden" value="">
                                  <input id="attribute_sign_<?=$index?>" type="hidden" value="">
                                  <input id="attributeids_<?=$index?>" type="hidden" name="attributeid[]" value="" >
                                  <div class="col-12 col-md-4 box">
                                    <label><?php echo e($attributes_data['option']['name']); ?></label>
                                    <div class="select-control ">
                                        <select name="<?php echo e($attributes_data['option']['id']); ?>" onChange="getQuantity()" class="currentstock form-control attributeid_<?=$index++?>" attributeid = "<?php echo e($attributes_data['option']['id']); ?>">
                                        <?php if(!empty($result['cart'])): ?>
                                          <?php
                                           $value_ids = array();
                                            foreach($result['cart'][0]->attributes as $values){
                                                $value_ids[] = $values->options_values_id;
                                            }
                                          ?>
                                            <?php $__currentLoopData = $attributes_data['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <?php if(!empty($result['cart'])): ?>
                                             <option <?php if(in_array($values_data['id'],$value_ids)): ?> selected <?php endif; ?> attributes_value="<?php echo e($values_data['products_attributes_id']); ?>" value="<?php echo e($values_data['id']); ?>" prefix = '<?php echo e($values_data['price_prefix']); ?>'  value_price ="<?php echo e($values_data['price']+0); ?>" ><?php echo e($values_data['value']); ?></option>
                                             <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          <?php else: ?>
                                            <?php $__currentLoopData = $attributes_data['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <option attributes_value="<?php echo e($values_data['products_attributes_id']); ?>" value="<?php echo e($values_data['id']); ?>" prefix = '<?php echo e($values_data['price_prefix']); ?>'  value_price ="<?php echo e($values_data['price']+0); ?>" ><?php echo e($values_data['value']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          <?php endif; ?>
                                        </select>
                                    </div>
                                  </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>

                                    <div class="col-12 col-md-4 box Qty" <?php if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date ): ?> style="display: none" <?php endif; ?>>
                                      <label>Quantity</label>
                                      <div class="Qty">
                                        <div class="input-group">
                                            <span class="input-group-btn first qtyminus">
                                              <button class="btn btn-defualt" type="button">-</button>
                                            </span>
                                            <input style="width:-20px;" type="text" readonly name="quantity" value=" <?php if(!empty($result['cart'])): ?> <?php echo e($result['cart'][0]->customers_basket_quantity); ?> <?php else: ?> <?php if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order): ?> <?php echo e($result['detail']['product_data'][0]->products_min_order); ?> <?php else: ?> 1 <?php endif; ?> <?php endif; ?>" min="<?php if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order): ?> <?php echo e($result['detail']['product_data'][0]->products_min_order); ?> <?php else: ?> 1 <?php endif; ?>" max="<?php if(!empty($result['detail']['product_data'][0]->products_max_stock) and $result['detail']['product_data'][0]->products_max_stock>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_max_stock): ?><?php echo e($result['detail']['product_data'][0]->products_max_stock); ?><?php else: ?><?php echo e($result['detail']['product_data'][0]->defaultStock); ?><?php endif; ?>" class="form-control qty">
                                            <span class="input-group-btn last qtyplus">
                                              <button class="btn btn-defualt" type="button">+</button>
                                            </span>
                                        </div>
                                      </div>
                                    </div>

                                </div>




                        <div class="product-buttons">
                            <h2>Total Price:
                              <span class="total_price">

                                <?php
                                $default_currency = DB::table('currencies')->where('is_default',1)->first();
                                if($default_currency->id == Session::get('currency_id')){
                                  if(!empty($result['detail']['product_data'][0]->discount_price)){
                                  $discount_price = $result['detail']['product_data'][0]->discount_price;
                                  }
                                  if(!empty($result['detail']['product_data'][0]->flash_price)){
                                    $flash_price = $result['detail']['product_data'][0]->flash_price;
                                  }
                                  $orignal_price = $result['detail']['product_data'][0]->products_price;
                                }else{
                                  $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
                                  if(!empty($result['detail']['product_data'][0]->discount_price)){
                                  $discount_price = $result['detail']['product_data'][0]->discount_price * $session_currency->value;
                                  }
                                  if(!empty($result['detail']['product_data'][0]->flash_price)){
                                    $flash_price = $result['detail']['product_data'][0]->flash_price * $session_currency->value;
                                  }
                                  $orignal_price = $result['detail']['product_data'][0]->products_price * $session_currency->value;
                                }
                                 if(!empty($result['detail']['product_data'][0]->discount_price)){

                                  if(($orignal_price+0)>0){
                                 $discounted_price = $orignal_price-$discount_price;
                                 $discount_percentage = $discounted_price/$orignal_price*100;
                                 $discounted_price = $result['detail']['product_data'][0]->discount_price;

                                 }else{
                                   $discount_percentage = 0;
                                   $discounted_price = 0;
                                 }
                                }
                                else{
                                  $discounted_price = $orignal_price;
                                }
                                ?>
                                <?php if(!empty($result['detail']['product_data'][0]->flash_price)): ?>
                                <?php echo e(Session::get('symbol_left')); ?><?php echo e($flash_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

                                <?php elseif(!empty($result['detail']['product_data'][0]->discount_price)): ?>
                                <?php echo e(Session::get('symbol_left')); ?><?php echo e($discount_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

                                <?php else: ?>
                                <?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

                                <?php endif; ?>
                                </h2>
                              <?php if($result['detail']['product_data'][0]->products_min_order>0): ?>
                                <p>
                                &nbsp; <?php echo app('translator')->get('website.Min Order Limit:'); ?> <?php echo e($result['detail']['product_data'][0]->products_min_order); ?>

                                  </p>
                              <?php endif; ?>

                              <div class="buttons">
                               <?php if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date ): ?>
                                <?php else: ?>
                                 <?php if($result['detail']['product_data'][0]->products_type == 0): ?>
                                      <?php if($result['detail']['product_data'][0]->defaultStock == 0): ?>
                                        <button class="btn  btn-block  btn-danger " type="button"><?php echo app('translator')->get('website.Out of Stock'); ?></button>
                                      <?php else: ?>
                                          <button class="btn btn-block btn-secondary add-to-Cart" type="button" products_id="<?php echo e($result['detail']['product_data'][0]->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></button>
                                      <?php endif; ?>
                                  <?php else: ?>
                                       <button class="btn btn-secondary btn-block  add-to-Cart stock-cart"  type="button" products_id="<?php echo e($result['detail']['product_data'][0]->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></button>
                                       <button class="btn btn-danger btn-block  stock-out-cart" hidden type="button"><?php echo app('translator')->get('website.Out of Stock'); ?></button>
                                  <?php endif; ?>
                                <?php endif; ?>
                              </div>

                        </div>
                      </form>

                      <div class="pro-dsc-module">
                          <div class="tab-list">
                            <div class="nav nav-pills" role="tablist">
                              <a class="nav-link nav-item nav-index active show" href="#description" id="description-tab" data-toggle="pill" role="tab">Description</a>
                            </div>
                            <div class="tab-content">
                              <div role="tabpanel" class="tab-pane fade active show" id="description" aria-labelledby="description-tab">
                                <div class="tabs-pera">
                                    <p>
                                     <?=stripslashes($result['detail']['product_data'][0]->products_description)?>
                                    </p>

                                </div>

                              </div>
                              <div role="tabpanel" class="tab-pane fade" id="review" aria-labelledby="review-tab">
                                  <div class="tabs-pera">
                                      <p>
                                          Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                          sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                          nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                          Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in
                                          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis aute irure dolor in
                                          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                      </p>
                                      <p>
                                          Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                          sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                        </p>
                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>

                     </div>

            </div>

          </div>

          </div>
      </div>

      <div class="products-area">
          <div class="row">
              <div class="col-12">
                <div class="heading">
                  <h2>
                    <?php echo app('translator')->get('website.Related Products'); ?>
                  </h2>
                  <hr style="margin-bottom: 0;">
                </div>
                <div id="p2" class="owl-carousel" style="margin-bottom: 10px;">
                  <?php $__currentLoopData = $result['simliar_products']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($result['detail']['product_data'][0]->products_id != $products->products_id): ?>
                  <?php if(++$key<=5): ?>
                  <?php echo $__env->make('autoshop.common.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <?php endif; ?>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </div>
            </div>

      </div>
    </div>
  </section>
<?php /**PATH /home/g2g/public_html/resources/views/web/details/detail1.blade.php ENDPATH**/ ?>