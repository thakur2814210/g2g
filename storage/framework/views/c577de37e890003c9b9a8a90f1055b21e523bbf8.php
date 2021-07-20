<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Add Garage</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
       <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.active')); ?>">Active Garages</a>
        </li>
         <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.pending')); ?>">Pending Garages</a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('superadmin.garages.delete')); ?>">Delete Garages</a>
        </li>
        
      <li class="active">Add Garage</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
          <div class="col-md-12">
            <div class="box">
               <div class="box-header">
                    <h3 class="box-title">Add New Section</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                          <br>
                          <div class="row">
                              <div class="col-md-12">
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
                                    <div class="alert alert-warning">
                                        <?php echo e(session('status')); ?>

                                    </div>
                                <?php endif; ?>
                                 <?php if(isset($status)): ?>
                                    <div class="alert alert-warning">
                                        <?php echo e($status); ?>

                                    </div>
                                <?php endif; ?>
                              </div>
                            </div>
              
                            <div class="box-body">

                              <form class="form-horizontal" method="POST" action="<?php echo e(route('superadmin.garage.save')); ?>" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <div class="box-body">

                                 
                                <div class="box box-solid box-primary">
                                  <div class="box-header"><i class="fa fa-user" ></i>Create User</div>
                                  <div class="box-body">

                                    <div class="row">
                                      <div class="col-md-6">
                                           <div class="form-group">
                                            <label for="tag_name" class="col-sm-12 col-form-label">Username</label>
                                            <div class="col-sm-12">
                                               <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" required="required" />
                                            </div>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="tag_slug" class="col-sm-12 col-form-label">Email</label>
                                            <div class="col-sm-12">
                                              <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required="required" />
                                            </div>
                                          </div>
                                      </div>
                                    </div>

                                     <div class="row">
                                       <div class="col-md-6">
                                           <div class="form-group">
                                              <label for="tag_name" class="col-sm-12 col-form-label">Passowrd</label>
                                              <div class="col-sm-12">
                                                <input type="text" class="form-control" name="password" id="password" placeholder="Enter Passowrd" required="required" />
                                              </div>
                                            </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                              <label for="tag_name" class="col-sm-12 col-form-label">Phone</label>
                                              <div class="col-sm-12">
                                                <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter Phone" required="required" />
                                              </div>
                                            </div>
                                       </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-building" ></i>Create Garage
                                    </div>
                                    <div class="box-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                              <label for="tag_name" class="col-sm-12 col-form-label">Garage Name English</label>
                                              <div class="col-sm-12">
                                                <input type="text" class="form-control" name="garage_name_en" id="garage_name"  placeholder="Enter Garage Name" required="required" />
                                              </div>
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                              <label for="tag_name" class="col-sm-12 col-form-label">Garage Name Arabic</label>
                                              <div class="col-sm-12">
                                                <input type="text" class="form-control" name="garage_name_ar" id="garage_name"  placeholder="Enter Garage Name" required="required" />
                                              </div>
                                            </div>
                                        </div>
                                      </div>

                                       <div class="row">
                                         <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="tag_slug" class="col-sm-12 col-form-label">Description (English)</label>
                                              <div class="col-sm-12">
                                                <textarea rows="5" class="form-control" name="description_en" ></textarea> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="tag_slug" class="col-sm-12 col-form-label">Description (Arabic)</label>
                                              <div class="col-sm-12">
                                                <textarea rows="5" class="form-control" name="description_ar" ></textarea> 
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                
                                      <div class="row">
                                         <div class="col-md-12">
                                            <div class="form-group">
                                              <label class="col-sm-12 col-form-label">Feature Image Upload</label>
                                              <div class="col-sm-12">
                                                <div class="custom-file"  class="form-control">
                                                  <input type="file"  id="image" name="image">
                                                </div>
                                              </div>
                                              <div class="col-sm-12 text-danger">
                                                <p><small>Upload large Image. Prefer 2000 x 600</small></p>
                                              </div>
                                            </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="tag_slug" class="col-sm-12 col-form-label">Slug</label>
                                              <div class="col-sm-12">
                                                <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter Garage Slug" required="required" />
                                              </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                           

                              <div style="clear:both"></div>

                             <?php if(isset($catList['subCats'])): ?>

                                <div class="box box-solid box-primary">
                                  <div class="box-header">
                                      <i class="fa fa-tags" ></i>Garage Services
                                  </div>
                                  <div class="box-body">
                              
                                  <div style="padding-left: 30px;">
                                   <?php $__currentLoopData = $catList['mainCats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  
                                     <br/>
                                      <p class="text-red"><input class="form-check" type="checkbox" name="cat_id[]" value="<?php echo e($cat['id']); ?>">
                                        <b>Main Category: <?php echo e($cat['name']); ?></b></p>
                                       
                                      <?php if(isset($catList['subCats'][$cat['id']])): ?>
                                        <div class="row">
                                         <?php $__currentLoopData = $catList['subCats'][$cat['id']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <div class="col-sm-12 col-md-4">
                                            <div class="form-check d-inline">
                                              <input class="form-check-input" type="checkbox" name="sub_cat_id[]" value="<?php echo e($subcat['id']); ?>">
                                              <?php echo e($subcat['name']); ?>

                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                      </div>

                                      <?php else: ?>
                                        <p>No Sub Category.</p>

                                      <?php endif; ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                   </div>
                                </div>
                              </div>
                              <?php endif; ?>

                              

                              <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-clock-o" ></i>Working Hours
                                    </div>
                                    <div class="box-body">

                               
                                  <?php
                                    $days = [
                                        'mon' => 'Monday',
                                        'tue' => 'Tuesday',
                                        'wed' => 'Wednessday',
                                        'thu' => 'Thrusday',
                                        'fri' => 'Friday',
                                        'sat' => 'Saturday',
                                        'sun' => 'Sunday',
                                      ];
                                      $optionTime = [
                                        'Closed', 
                                        '12:00 AM',
                                        '00:30 AM',
                                        '01:00 AM',
                                        '01:30 AM',
                                        '02:00 AM',
                                        '02:30 AM',
                                        '03:00 AM',
                                        '03:30 AM',
                                        '04:00 AM',
                                        '04:30 AM',
                                        '05:00 AM',
                                        '05:30 AM',
                                        '06:00 AM',
                                        '06:30 AM',
                                        '07:00 AM',
                                        '07:30 AM',
                                        '08:00 AM',
                                        '08:30 AM',
                                        '09:00 AM',
                                        '09:30 AM',
                                        '10:00 AM',
                                        '10:30 AM',
                                        '11:00 AM',
                                        '11:30 AM',
                                        '12:00 PM',
                                        '00:30 PM',  
                                        '01:00 PM',
                                        '01:30 PM',
                                        '02:00 PM',
                                        '02:30 PM',
                                        '03:00 PM',
                                        '03:30 PM',
                                        '04:00 PM',
                                        '04:30 PM',
                                        '05:00 PM',
                                        '05:30 PM',
                                        '06:00 PM',
                                        '06:30 PM',
                                        '07:00 PM',
                                        '07:30 PM',
                                        '08:00 PM',
                                        '08:30 PM',
                                        '09:00 PM',
                                        '09:30 PM',
                                        '10:00 PM',
                                        '10:30 PM',
                                        '11:00 PM',
                                        '11:30 PM',
                                      ];
                                  ?>

                                  <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <!-- /row-->
                                    <div class="row">
                                      <div class="col-md-2">
                                        <label class="fix_spacing"><?php echo e($day); ?></label>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <div class="styled-select">
                                          <select name="ot_<?php echo e($index); ?>" class='form-control' required>
                                            <?php $__currentLoopData = $optionTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($value); ?>"><?php echo e($value); ?></option> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          </select>
                                          </div>
                                        </div>
                                      </div>
                                       <div class="col-md-1"></div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <div class="styled-select">
                                           <select name="ct_<?php echo e($index); ?>" class='form-control' required>
                                            <?php $__currentLoopData = $optionTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($value); ?>"><?php echo e($value); ?></option> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /row-->
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                              </div>

                               

                              <!----------------------------------------------------------------------------
                                Garage Location
                              ------------------------------------------------------------------------------->

                              <div style="clear:both"></div>

                               <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-map-marker" ></i>Address / Location
                                    </div>
                                    <div class="box-body">

                                     <div class="row">
                                        <div class="col-md-12" style="padding: 30px;">
                                          <div class="form-group" >
                                              <label for="autocomplete" class="col-sm-12 col-form-label"> Location/City/Address </label>
                                              <input type="text"  name="address" id="autocomplete" class="form-control" placeholder="Select Location">
                                          </div>

                                          <div class="form-group" id="lat_area">
                                              <label for="latitude" class="col-sm-12 col-form-label"> Latitude </label>
                                              <input type="text" name="latitude" id="latitude" class="form-control">
                                          </div>

                                          <div class="form-group" id="long_area">
                                              <label for="latitude" class="col-sm-12 col-form-label"> Longitude </label>
                                              <input type="text" name="longitude" id="longitude" class="form-control">
                                          </div>
                                        </div>
                                      </div>


                                  <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="tag_name" class="col-sm-12 col-form-label">City</label>
                                           <div class="col-sm-12">
                                            <select class="form-control" name="city_id" id="city_id" required="required">
                                                <option value="" >Select City</option>
                                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <option value="<?php echo e($city->id); ?>" ><?php echo e($city->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                            </select>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="tag_name" class="col-sm-12 col-form-label">Country</label>
                                          <div class="col-sm-12">
                                           
                                              <select class="form-control" name="country_id" id="country_id" required="required">
                                                <option value="" >Select Country</option>
                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <option value="<?php echo e($country->id); ?>" ><?php echo e($country->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                              </select>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="tag_name" class="col-sm-12 col-form-label">Postal</label>
                                           <div class="col-sm-12">
                                            <input type="number" class="form-control" name="postal" id="postal" placeholder="Enter Postal" required="required" />
                                          </div>
                                        </div>
                                    </div>
                                  </div>

                                 
                                </div>
                              </div>
                              
                             
                              <!----------------------------------------------------------------------------
                                Garage Owner Information
                              ------------------------------------------------------------------------------->


                              <div style="clear:both"></div>

                              <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-user-circle" ></i>Garage Owner Information
                                    </div>
                                    <div class="box-body">

                               

                                   <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="tag_name" class="col-sm-12 col-form-label">Owner Name</label>
                                            <div class="col-sm-12">
                                               <input type="text" class="form-control" name="owner_name" id="owner_name" placeholder="Enter Garage Owner Full Name" required="required" />
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="tag_slug" class="col-sm-12 col-form-label">Owner Phone</label>
                                          <div class="col-sm-12">
                                            <input type="number" class="form-control" name="owner_phone" id="owner_phone" placeholder="Enter Garage Owner Phone" required="required" />
                                          </div>
                                        </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="tag_name" class="col-sm-12 col-form-label">Owner Email</label>
                                            <div class="col-sm-12">
                                              <input type="email" class="form-control" name="owner_email" id="owner_email" placeholder="Enter Garage Owner Officail Email" required="required" />
                                            </div>
                                          </div>
                                    </div>
                                  
                                 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="tag_slug" class="col-sm-12 col-form-label">Owner Address</label>
                                          <div class="col-sm-12">
                                             <input type="text" class="form-control" name="owner_address" id="owner_address" placeholder="Enter Garage Owner Address" required="required" />
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                               <!----------------------------------------------------------------------------
                                Admin Section
                              ------------------------------------------------------------------------------->

                              <div style="clear:both"></div>

                               <div class="box box-solid box-danger">
                                    <div class="box-header">
                                        <i class="fa fa-user-circle" ></i>Admin Section
                                    </div>
                                    <div class="box-body">


                             

                                   <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="tag_status" class="col-sm-12 col-form-label">Status</label>
                                          <div class="col-sm-12">
                                            <select class="form-control" name="status" id="status" required="required">
                                                  <option value="1">Approved</option>
                                                  <option value="2">Delete</option>
                                                  <option value="3" selected>Pending</option>
                                              </select>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tag_status" class="col-sm-12 col-form-label">Feature Garage</label>
                                            <div class="col-sm-12">
                                              <select class="form-control" name="is_feature" id="is_feature" required="required">
                                                    <option value="1">Yes</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                              <!-- /.card-body -->
                            <div class="box-footer">
                              <button type="submit" class="btn btn-info"><i class="fa fa-save" ></i> Setup New Garage</button>
                              <button type="reset" class="btn btn-danger float-right"><i class="fa fa-trash  " ></i> Reset</button>
                            </div>
                            <!-- /.card-footer -->
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script  defer src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places" type="text/javascript"></script>

   <script>
       $(document).ready(function() {
          $("#lat_area").addClass("d-none");
          $("#long_area").addClass("d-none");
          initialize();
       });
  

       function initialize() {
         
           var options = {
             componentRestrictions: {country: "AE"}
           };

           var input = document.getElementById('autocomplete');
           var autocomplete = new google.maps.places.Autocomplete(input, options);
           autocomplete.addListener('place_changed', function() {
               var place = autocomplete.getPlace();
               console.log(place);
               $('#latitude').val(place.geometry['location'].lat());
               $('#longitude').val(place.geometry['location'].lng());

            // --------- show lat and long ---------------
               $("#lat_area").removeClass("d-none");
               $("#long_area").removeClass("d-none");
           });
       }
   
   </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/Modules/Admin/Resources/views/garage/add-garage.blade.php ENDPATH**/ ?>