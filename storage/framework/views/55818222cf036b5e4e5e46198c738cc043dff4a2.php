<?php $__env->startSection('content'); ?>
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
     <div class="row">
         
       <div class="col-12 col-lg-3">
           <div class="heading">
               <h2>
                   <?php echo app('translator')->get('website.My Address'); ?>
               </h2>
               <hr >
             </div>

            <?php echo $__env->make('autoshop.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       </div>
       <div class="col-12 col-lg-9 ">
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

           <div class="box_general padding_bottom">
       <div class="card">
        <div class="card-header">
          <i class="fa fa-list"></i> <?php echo app('translator')->get('website.My Address'); ?>
        </div>
        <div class="card-body">
          <div style="padding-bottom: 10px;">
            <a class="btn btn-sm btn-outline-danger "  href="<?php echo e(URL::to('/my-address/add')); ?>">
            <i class="fa fa-plus"></i> <?php echo app('translator')->get('website.Add'); ?> <?php echo app('translator')->get('website.Address'); ?></a>
           <a class="btn btn-sm btn-outline-danger "  href="<?php echo e(URL::to('/my-address')); ?>">
            <i class="fa fa-list"></i>  <?php echo app('translator')->get('website.Address'); ?> <?php echo app('translator')->get('website.List'); ?></a>
           </div>
            <form class="form-horizontal" method="POST" action="<?php echo e(URL::to('/my-address/update')); ?>">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="id" value="<?php echo e($result['clientLocation']['id']); ?>">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                    <label class="text-danger"> <?php echo e(trans('website.Location/City/Address')); ?> *</label>
                    <input type="text"  name="address" id="autocomplete" class="form-control" value="<?php echo e($result['clientLocation']['address']); ?>">
                </div>
              </div>

              
              <div class="col-12 col-md-6">
                <div class="form-group" id="lat_area">
                    <label class="text-danger"> <?php echo e(trans('website.Latitude')); ?> *</label>
                    <input type="text" name="latitude" id="latitude" class="form-control" value="<?php echo e($result['clientLocation']['latitude']); ?>" readonly="" >
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group" id="long_area">
                    <label class="text-danger"> <?php echo e(trans('website.Longitude')); ?> *</label>
                    <input type="text" name="longitude" id="longitude" value="<?php echo e($result['clientLocation']['longitude']); ?>" class="form-control" readonly="">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label class="text-danger"> <?php echo e(trans('website.City')); ?> *</label>
                     <select class="form-control" name="city_id" id="city" required="required">
                        <option value=""><?php echo e(trans('website.Select City')); ?></option>
                        <?php $__currentLoopData = $result['cities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($city->id); ?>" <?php if($result['clientLocation']['city_id'] == $city->id): ?> selected <?php endif; ?>><?php echo e($city->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </div>
                </div>

                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label class="text-danger"> <?php echo e(trans('website.Country')); ?> *</label>
                     <select class="form-control" name="country_id" id="country" required="required">
                        <?php $__currentLoopData = $result['countries']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($country->id); ?>" selected=""><?php echo e($country->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </div>
                </div>

                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label class="text-danger"> <?php echo e(trans('website.Pobox')); ?> *</label>
                    <input type="number" class="form-control" name="pobox" id="pobox" value="<?php echo e($result['clientLocation']['pobox']); ?>">
                  </div>
                </div>

                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label class="text-danger"> <?php echo e(trans('website.Status')); ?> *</label>
                     <select class="form-control" name="status" id="status" required="required">
                       <option value="Active" <?php if($result['clientLocation']['status'] == 'Active'): ?> selected <?php endif; ?> ><?php echo app('translator')->get('website.Active'); ?></option>
                       <option value="Inactive" <?php if($result['clientLocation']['status'] == 'Inactive'): ?> selected <?php endif; ?> ><?php echo app('translator')->get('website.Inactive'); ?></option>
                      </select>
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-12 ">
                  <div class="form-group">
                    <div class="col-12 ">
                      <button type="submit" class="btn btn-success"><i class="fa fa-car" ></i> <?php echo e(trans('website.Update Address')); ?></button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
        </div>
      </div>
     </div>
   </div>
 </section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<script  defer src="https://maps.google.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places&sensor=false&&callback=initialize" type="text/javascript"></script>

<script>

    var language = "<?php echo e(\Config::get("app.locale")); ?>";
    
   $(document).ready(function() {
        $("#lat_area").addClass("d-none");
        $("#long_area").addClass("d-none");
        google.maps.event.addDomListener(window, 'load', initialize);
   });


   function initialize() {
   
       var options = {
         componentRestrictions: {country: "AE"}
       };

       var input = document.getElementById('autocomplete');
       var autocomplete = new google.maps.places.Autocomplete(input, options);
       autocomplete.addListener('place_changed', function() {
           var place = autocomplete.getPlace();
            $('#latitude').val(place.geometry['location'].lat());
            $('#longitude').val(place.geometry['location'].lng());

        // --------- show lat and long ---------------
           $("#lat_area").removeClass("d-none");
           $("#long_area").removeClass("d-none");
       });
   }

 </script>

   <?php $__env->stopSection(); ?>





<?php echo $__env->make('autoshop.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\g2g\resources\views/autoshop/address/edit.blade.php ENDPATH**/ ?>