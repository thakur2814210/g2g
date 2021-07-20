<?php $__env->startSection('content'); ?>

<style type="text/css" media="screen">
     #error-in-dialog{
        background: #fff;
        padding: 30px;
        padding-top: 0;
        text-align: left;
        max-width: 400px;
        margin: 40px auto;
        position: relative;
        box-sizing: border-box;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        border-radius: 4px;
    }

.pricing .card {
  border: none;
  border-radius: 1rem;
  transition: all 0.2s;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.pricing hr {
  margin: 1.5rem 0;
}

.pricing .card-title {
  margin: 0.5rem 0;
  font-size: 0.9rem;
  letter-spacing: .1rem;
  font-weight: bold;
}

.pricing .card-price {
  font-size: 3rem;
  margin: 0;
}

.pricing .card-price .period {
  font-size: 0.8rem;
}

.pricing ul li {
  margin-bottom: 1rem;
}

.pricing .text-muted {
  opacity: 0.7;
}

.pricing .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  opacity: 0.7;
  transition: all 0.2s;
}

/* Hover Effects on Card */

@media (min-width: 992px) {
  .pricing .card:hover {
    margin-top: -.25rem;
    margin-bottom: .25rem;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
  }
  .pricing .card:hover .btn {
    opacity: 1;
  }
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link{
  background: #f0151f;
}

</style>

	<section class="blog-content">
		  <div class="container ">
		    <div class="blog-area">
		    	<div class="bg_color_1">
		    	 <div class="main_title_2" style="padding:10px;margin-bottom:20px;">
				          <h2><?php echo app('translator')->get('website.buy_upgrade_package'); ?></h2>
				           <span><em></em></span>
				        </div>

				
 

  <div class="box_general padding_bottom">
    <div class="header_box version_2">
    <ul class="nav nav-pills nav-justified text-uppercase">
        <li class="nav-item">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa fa-user-circle"></i> <?php echo app('translator')->get('website.customer_package'); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa fa-building"></i> <?php echo app('translator')->get('website.garage_package'); ?></a>
        </li>
      </ul>
      <br/>
    </div>

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

    <div class="tab-content" id="pills-tabContent">

      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card padding_bottom text-center">
          <div class="card-header"><h4><?php echo app('translator')->get('website.Want custom service in your package'); ?></h4> </div>
          <div class="card-body">
              <div class="row">

                <div class="col-12">
                   <label><?php echo app('translator')->get('website.No problem You can create custom package and send quote to Garage'); ?></label><br/><br/>
                   <?php if(Auth::guard('client')->check()): ?>
                      <a href="<?php echo e(route('client.custom-package')); ?>" class="btn1 btn-success text-uppercase p-2"><?php echo app('translator')->get('website.custom_customer_package'); ?></a>
                  <?php elseif(Auth::guard('admin')->check() || Auth::guard('garage')->check()): ?>
                    <a href="#error-in-dialog"  class="login error-in-modal btn1 btn-success text-uppercase p-2" ><?php echo app('translator')->get('website.custom_customer_package'); ?></a>
                  <?php else: ?>
                    <a href="#sign-in-dialog" data-slug="custom-package" data-page="client-package-subscription" class="login sign-in-modal btn1 btn-success text-uppercase p-2" ><?php echo app('translator')->get('website.custom_customer_package'); ?></a>
                  <?php endif; ?>
                </div>
              </div>
          </div>
        </div>
        
        <br/>
        <div class="form-card">   
            <?php if(!empty($clientPackageData) && count($clientPackageData) > 0): ?>
                <div class="row">
                   <?php $__currentLoopData = $clientPackageData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <!-- Free Tier -->
                  <div class="col-lg-4">
                      <div class="card mb-5 mb-lg-0">
                      
                          <div class="card-header text-center text-uppercase text-danger"><?php echo e($package->section->name); ?> Package</div>
                      
                          
                      
                        <div class="card-body">
                          <h4 class="card-title text-white text-uppercase text-center alert" style="background: #f0151f"><?php echo e($package->name); ?></h4>
                          <h6 class="text-center p-0">AED <?php echo e($package->price); ?><span class="period">/<?php echo e($package->period); ?> Days</span></h6>
                          <hr>
                          <ul class="fa-ul">
                             <?php $__currentLoopData = $package->packageFeatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $features): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                  $pf_values = [];
                                  if (strpos($features->feature_value, ',') !== false) {
                                     $pf_values = explode(',', $features->feature_value);
                                  }else{
                                    $pf_values[] = $features->feature_value;
                                  }
                                ?>

                                <li>
                                    <h6 style="padding: 0px;">
                                      <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> <?php echo e($features->feature_name); ?>

                                    </h6>
                                    <?php $__currentLoopData = $pf_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <label><?php echo e($val); ?></label><br/>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </li>
                                  
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </ul>
                          <div class="text-center p-1">
                            
                           
                              <?php if(Auth::guard('client')->check()): ?>
                                  <a href="<?php echo e(route('client.package-subscription.create',['category' => $package->section->slug])); ?>" class="btn btn-danger btn-block text-uppercase"><?php echo app('translator')->get('website.select'); ?></a>
                              <?php elseif(Auth::guard('admin')->check() || Auth::guard('garage')->check()): ?>
                                <a href="#error-in-dialog"  class="login error-in-modal btn btn-danger btn-block text-uppercase" ><?php echo app('translator')->get('website.select'); ?></a>
                              <?php else: ?>
                                <a href="#sign-in-dialog" data-slug="<?php echo e($package->section->slug); ?>" data-page="client-package-subscription" class="login sign-in-modal btn btn-danger btn-block text-uppercase" ><?php echo app('translator')->get('website.select'); ?></a>
                              <?php endif; ?>
                           </div>
                        </div>
                      </div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
              <?php else: ?>
              <p><?php echo app('translator')->get('website.No package for this request'); ?></p>
            <?php endif; ?>

          </div>
        </div>


        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="form-card">                 
              
              <?php if(!empty($garagePackageData) && count($garagePackageData) > 0): ?>
                  <div class="row">
                     <?php $__currentLoopData = $garagePackageData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- Free Tier -->
                    <div class="col-lg-4">
                      <div class="card-header text-center text-uppercase text-danger"><?php echo app('translator')->get('website.garage_package'); ?></div>
                        <div class="card mb-5 mb-lg-0">
                          <div class="card-body">
                             <h4 class="card-title text-white text-uppercase text-center alert" style="background: #f0151f"><?php echo e($package->name); ?></h4>
                          <h6 class="text-center p-0">AED <?php echo e($package->price); ?><span class="period">/<?php echo e($package->period); ?> Days</span></h6>
                            <hr>
                            <ul class="fa-ul">
                               <?php $__currentLoopData = $package->packageFeatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $features): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php
                                    $pf_values = [];
                                    if (strpos($features->feature_value, ',') !== false) {
                                       $pf_values = explode(',', $features->feature_value);
                                    }else{
                                      $pf_values[] = $features->feature_value;
                                    }
                                  ?>

                                  <li>
                                      <label><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> <?php echo e($features->feature_name); ?></label>
                                      <br/>
                                      <?php $__currentLoopData = $pf_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($val); ?>

                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </li>
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="text-center p-1">
                             
                              <?php if(Auth::guard('garage')->check()): ?>
                                  <a href="<?php echo e(route('garage.packages.buy_or_upgrade',['slug' => $package->slug ])); ?>" class="btn btn-danger btn-block text-uppercase"><?php echo app('translator')->get('website.select'); ?></a>
                              <?php elseif(Auth::guard('client')->check() || Auth::guard('admin')->check()): ?>
                                <a href="#error-in-dialog"  class="login error-in-modal btn btn-danger btn-block text-uppercase" ><?php echo app('translator')->get('website.select'); ?></a>
                              <?php else: ?>
                                <a href="#sign-in-dialog" data-slug="<?php echo e($package->slug); ?>" data-page="garage-package-subscription" class="login sign-in-modal btn btn-danger btn-block text-uppercase" ><?php echo app('translator')->get('website.select'); ?></a>
                              <?php endif; ?>
                            
                            </div>
                          </div>
                        </div>
                    </div>
                     <!-- Plus Tier -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                <?php else: ?>
                <p><?php echo app('translator')->get('website.No package for this request'); ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
</div>
    </div>
  </div>
</div>
</section>	

<?php $__env->stopSection(); ?>
<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/resources/views/website/package-price.blade.php ENDPATH**/ ?>