<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('css'); ?>
   
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
   <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.dashboard')); ?>">Dashboard</a>
        </li>
          <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.active')); ?>">Active Garage List</a>
        </li>
         <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.delete')); ?>">Delete Garage List</a>
        </li>
         <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.pending')); ?>">Pending Garage List</a>
        </li>
        <li class="breadcrumb-item active">Garage Detail</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
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


  <div class="row">
    <div class="col-12">
      <div class="card-tools float-right">
        <div class="input-group input-group-sm" style="width: 200px;">
          <div class="input-group-append">
            <div class="btn-group">
              <div class="btn-group">
                <button type="button" class="btn btn-warning btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tags"></i> Garage Information&nbsp;</button>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-116px, -84px, 0px);">
                    <a class="dropdown-item" href="<?php echo e(route('superadmin.garage.team.view',['id' => $garage->id])); ?>">Garage Teams</a>
                    <a class="dropdown-item" href="<?php echo e(route('superadmin.garage.image.view',['id' => $garage->id])); ?>">Garage Images</a>
                    <a class="dropdown-item" href="<?php echo e(route('superadmin.garage.video.view',['id' => $garage->id])); ?>">Garage Videos</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gray">
          Garage Details
        </div>
       
        <div class="card-body table-responsive">

          

          <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.garage.update')); ?>"  enctype="multipart/form-data">
            
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="id" value="<?php echo e($garage->id); ?>" />

            <div class="card-body">

             <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Garage Name English</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="garage_name_en" id="garage_name"  value="<?php echo e($garage->garages_name_en); ?>" required="required" />
                      </div>
                    </div>
                </div>
                 <div class="col-md-6">
                     <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Garage Name Arabic</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="garage_name_ar" id="garage_name"  value="<?php echo e($garage->garages_name_ar); ?>" required="required" />
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                 <div class="col-md-12">
                    <div class="form-group">
                      <label for="tag_slug" class="col-sm-12 col-form-label">Description (English)</label>
                      <div class="col-sm-12">
                        <textarea rows="5" class="form-control" name="description_en" ><?php echo e($garage->description_en); ?></textarea> 
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="tag_slug" class="col-sm-12 col-form-label">Description (Arabic)</label>
                      <div class="col-sm-12">
                        <textarea rows="5" class="form-control" name="description_ar" ><?php echo e($garage->description_ar); ?></textarea> 
                      </div>
                    </div>
                  </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="tag_slug" class="col-sm-2 col-form-label">Slug</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="slug" id="slug" value="<?php echo e($garage->slug); ?>" required />
                      </div>
                    </div>
                </div>
              </div>


            <div style="clear:both"><br/></div>

              <div class="card-header bg-gray">
               Garage Media
              </div>

               <div style="clear:both"><br/></div>

            <div class="row" style="min-height: 200px;">

               

               <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Image Upload</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file"  id="image" name="image">
                      </div>
                    </div>
                    <div>
                      <p><small>Upload large Image. Prefer 1600x600</small></p>
                    </div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="text-center">
                      <?php if(isset($garage->thumbnail_image)): ?>
                        <img src="<?php echo e(asset(  $garage->thumbnail_image )); ?>" class="avatar img-thumbnail" height="192" width="192" alt="client_image">
                      <?php else: ?>
                        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-thumbnail" alt="client_image">
                      <?php endif; ?>
                    </div>
               </div>

              
            </div>

             <div style="clear:both"><br/></div>
              <?php if(isset($catList['subCats'])): ?>
              <div class="card-header bg-gray">
               Garage Services
              </div>

               <div style="clear:both"><br/></div>
                <?php
                  $cat_id_arr = $sub_cat_id_arr = [];
                  if(count($garage_services->toArray())){
                    $cat_id =  $garage_services->cat_id;
                    $sub_cat_id = $garage_services->sub_cat_id;

                    if(stripos($cat_id , ',') !== false) {
                       $cat_id_arr[] = explode(',', $cat_id);
                        $cat_id_arr = array_values($cat_id_arr[0]);
                    }else{
                       $cat_id_arr[] = $cat_id;
                    }

                   

                    if(stripos($sub_cat_id , ',') !== false) {
                       $sub_cat_id_arr[] = explode(',', $sub_cat_id);
                        $sub_cat_id_arr = array_values($sub_cat_id_arr[0]);
                    }else{
                      $sub_cat_id_arr[] = $sub_cat_id;
                    }

                   
                  }
                  //dump($cat_id_arr);die;
                 ?>
                <div class="row p-5">
                 <?php $__currentLoopData = $catList['mainCats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  
                    <div class="col-md-12">
                        <div class="form-check d-inline">
                          <input class="form-check-input" type="checkbox" name="cat_id[]" value="<?php echo e($cat['id']); ?>" <?php if(in_array($cat['id'], $cat_id_arr)): ?> checked <?php endif; ?>>
                          <label class="form-check-labe text-boldl">Main Category :<?php echo e($cat['name']); ?></label>
                        </div>
                    </div>
                    <?php if(isset($catList['subCats'][$cat['id']])): ?>
                      <div class="row p-3">
                       <?php $__currentLoopData = $catList['subCats'][$cat['id']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-12 col-md-6">
                          <div class="form-check d-inline">
                            <input class="form-check-input" type="checkbox" name="sub_cat_id[]" value="<?php echo e($subcat['id']); ?>" <?php if(in_array($subcat["id"], $sub_cat_id_arr)): ?> checked <?php endif; ?>>
                            <label class="form-check-label"><?php echo e($subcat['name']); ?></label>
                          </div>
                      </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                  
                    <div style="clear:both"><br/></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </div>
                <div style="clear:both"><br/></div>
               <?php endif; ?>



              <div class="card-header bg-gray">
                Garage Working Hours
              </div>

               <div style="clear:both"><br/></div>

               <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                      <label for="tag_name" class="col-sm-3 col-form-label">Monday</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="mon" id="mon" value="<?php echo e($garage_working_hours->mon); ?>" required="required" />
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group row">
                      <label for="tag_slug" class="col-sm-3 col-form-label">Tuesday</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="tue" id="tue" value="<?php echo e($garage_working_hours->tue); ?>" required="required" />
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                      <label for="tag_name" class="col-sm-3 col-form-label">Wednessday</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="wed" id="wed" value="<?php echo e($garage_working_hours->wed); ?>" required="required" />
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group row">
                      <label for="tag_slug" class="col-sm-3 col-form-label">Thrusday</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="thu" id="thu" value="<?php echo e($garage_working_hours->thu); ?>" required="required" />
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                      <label for="tag_name" class="col-sm-3 col-form-label">Friday</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="fri" id="fri" value="<?php echo e($garage_working_hours->fri); ?>" required="required" />
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group row">
                      <label for="tag_slug" class="col-sm-3 col-form-label">Saturday</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="sat" id="sat" value="<?php echo e($garage_working_hours->sat); ?>" required="required" />
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                      <label for="tag_name" class="col-sm-3 col-form-label">sunday</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="sun" id="sun" value="<?php echo e($garage_working_hours->sun); ?>" required="required" />
                      </div>
                    </div>
                </div>
              </div>

               
              

              <!----------------------------------------------------------------------------
                Garage Location
              ------------------------------------------------------------------------------->

              <div style="clear:both"><br/></div>

              <div class="card-header bg-gray">
               Garage Location
              </div>

               <div style="clear:both"><br/></div>

              <div class="col-sm-12">
                    <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Address</label>
                       <div class="card shadow">
                          <div class="card-body">
                              <div class="form-group">
                                  <label for="autocomplete"> Location/City/Address </label>
                                  <input type="text"  name="address" id="autocomplete" class="form-control"  value="<?php echo e($garage->address); ?>">
                              </div>

                              <div class="form-group" id="lat_area">
                                  <label for="latitude"> Latitude </label>
                                  <input type="text" name="latitude" id="latitude" class="form-control"  value="<?php echo e($garage->latitude); ?>">
                              </div>

                              <div class="form-group" id="long_area">
                                  <label for="latitude"> Longitude </label>
                                  <input type="text" name="longitude" id="longitude" class="form-control" value="<?php echo e($garage->longitude); ?>">
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>

              <div class="row">
                <div class="col-md-4">
                    <div class="form-group row">
                      <label for="tag_name" class="col-sm-3 col-form-label">City</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="city_id" id="city_id" required="required">
                            <option value="" >Select City</option>
                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($city->id); ?>" <?php if( $garage->city_id == $city->id): ?> selected <?php endif; ?> ><?php echo e($city->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </select>
                      </div>
                    </div>
                </div>
                <div class="col-md-4">
                   <div class="form-group row">
                      <label for="tag_name" class="col-sm-3 col-form-label">Country</label>
                      <div class="col-sm-9">
                      
                          <select class="form-control" name="country_id" id="country_id" required="required">
                            <option value="" >Select Country</option>
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($country->id); ?>" <?php if( $garage->country_id == $country->id): ?> selected <?php endif; ?> ><?php echo e($country->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                          </select>
                       
                      </div>
                    </div>
                </div>

                <div class="col-md-4">
                   <div class="form-group row">
                      <label for="tag_name" class="col-sm-2 col-form-label">Postal</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" name="postal" id="postal" value="<?php echo e($garage->postal); ?>" required="required"  />
                      </div>
                    </div>
                </div>
              </div>

             
              
             
              <!----------------------------------------------------------------------------
                Garage Owner Information
              ------------------------------------------------------------------------------->


              <div style="clear:both"><br/></div>

              <div class="card-header bg-gray">
                Garage Owner Information
              </div>
              
               <div style="clear:both"><br/></div>

               <div class="row">
                <div class="col-md-6">
                     <div class="form-group row">
                        <label for="tag_name" class="col-sm-3 col-form-label">Owner Name</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" name="owner_name" id="owner_name"value="<?php echo e($garage->owner_name); ?>" required="required" />
                        </div>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                      <label for="tag_slug" class="col-sm-3 col-form-label">Owner Phone</label>
                      <div class="col-sm-9">
                        <input type="number" class="form-control" name="owner_phone" id="owner_phone"  value="<?php echo e($garage->owner_phone); ?>" required="required" />
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                     <div class="form-group row">
                        <label for="tag_name" class="col-sm-3 col-form-label">Owner Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" name="owner_email" id="owner_email" value="<?php echo e($garage->owner_email); ?>" required="required" />
                        </div>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                      <label for="tag_slug" class="col-sm-3 col-form-label">Owner Address</label>
                      <div class="col-sm-9">
                         <input type="text" class="form-control" name="owner_address" id="owner_address"  value="<?php echo e($garage->owner_address); ?>" required="required"  />
                      </div>
                    </div>
                </div>
              </div>

               <!----------------------------------------------------------------------------
                Admin Section
              ------------------------------------------------------------------------------->


              <div style="clear:both"><br/></div>

              <div class="card-header bg-red">
                Admin Section
              </div>
              
               <div style="clear:both"><br/></div>

               <div class="row">
                <div class="col-md-6">
                     <div class="form-group row">
                        <label for="tag_status" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                          <select class="form-control" name="status" id="status" required="required">
                                <option value="1" <?php if( $garage->status == 1): ?> selected <?php endif; ?> >Approved</option>
                                <option value="2" <?php if( $garage->status == 2): ?> selected <?php endif; ?>>Delete</option>
                                <option value="3" <?php if( $garage->status == 3): ?> selected <?php endif; ?>>Pending</option>
                            </select>
                        </div>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="tag_status" class="col-sm-4 col-form-label">Feature Garage</label>
                        <div class="col-sm-8">
                          <select class="form-control" name="is_feature" id="is_feature" required="required">
                              <option value="1" <?php if( $garage->is_feature == 1): ?> selected <?php endif; ?> >Yes</option>
                              <option value="2" <?php if( $garage->is_feature == 2): ?> selected <?php endif; ?>>No</option>
                          </select>
                        </div>
                      </div>
                </div>
              </div>

                  


              
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <button type="submit" class="btn btn-danger"><i class="fa fa-save" ></i> Update Garage Information</button>
             
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script  defer src="https://maps.google.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places&" type="text/javascript"></script>

   <script>
       $(document).ready(function() {
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
           });
       }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ishan/g2g-v3/Modules/Admin/Resources/views/garage/garage_details.blade.php ENDPATH**/ ?>