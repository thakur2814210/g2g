<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Garage Detail</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(route('garage.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
       
      <li class="active">Garage Detail</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="row">
          <div class="col-md-12">
            <div class="box">
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

                              <form class="form-horizontal" method="POST" action="<?php echo e(route('garage.update')); ?>"  enctype="multipart/form-data">
                                
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($garage->id); ?>" />

                                <div class="box-body">

                                   <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-user-circle" ></i>  Garage
                                    </div>
                                    <div class="box-body">

                                 <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group">
                                          <label for="tag_name" class="col-sm-12 col-form-label">Garage/Shop Name English</label>
                                          <div class="col-sm-12">
                                            <input type="text" class="form-control" name="garage_name_en" id="garage_name"  value="<?php echo e($garage->garages_name_en); ?>" required="required" />
                                          </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                         <div class="form-group">
                                          <label for="tag_name" class="col-sm-12 col-form-label">Garage/Shop Name Arabic</label>
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
                                </div>
                              </div>



                                <div style="clear:both"><br/></div>

                                 
                                 <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-user-circle" ></i>  Garage Profile Pic
                                    </div>
                                    <div class="box-body">

                                <div class="row" style="min-height: 200px; padding-left: 20px;">

                                   

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
                                </div>
                                </div>

                                 

                                  <!----------------------------------------------------------------------------
                                    Garage Location
                                  ------------------------------------------------------------------------------->

                                  <div style="clear:both"><br/></div>


                                   <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-user-circle" ></i>Garage Location / Address
                                    </div>
                                    <div class="box-body">


                                 

                                  <div class="col-sm-12">
                                        <div class="form-group">
                                         
                                           <div class="box box-info" style="padding:20px;">
                                              <div class="box-body">
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
                                </div>
                              </div>

                                 
                                  
                                 
                                  <!----------------------------------------------------------------------------
                                    Garage Owner Information
                                  ------------------------------------------------------------------------------->


                                  <div style="clear:both"><br/></div>

                                   <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-user-circle" ></i>Garage Owner Information
                                    </div>
                                    <div class="box-body">

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
                                </div>
                              </div>


                                   <!----------------------------------------------------------------------------
                                    Admin Section
                                  ------------------------------------------------------------------------------->


                                  <div style="clear:both"><br/></div>

                                  

                                  
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
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>

<?php
/*
  <div style="clear:both"><br/></div>
                                  @if(isset($catList['subCats']))
                                 

                                   <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-user-circle" ></i> Garage Services
                                    </div>
                                    <div class="box-body">


                                   
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
                                   
                                    <div style="padding-left: 30px;">
                                     @foreach($catList['mainCats'] as $cat)

                                      
                                        <br/>
                                      <p class="text-red"><input class="form-check-input" type="checkbox" name="cat_id[]" value="{{ $cat['id'] }}" @if(in_array($cat['id'], $cat_id_arr)) checked @endif><b> Main Category :{{ $cat['name'] }}</b></p>
                                        @if(isset($catList['subCats'][$cat['id']]))
                                          <div class="row">
                                           @foreach($catList['subCats'][$cat['id']] as $subcat)
                                            <div class="col-sm-12 col-md-4">
                                              <div class="form-check d-inline">
                                                <input class="form-check-input" type="checkbox" name="sub_cat_id[]" value="{{ $subcat['id'] }}" @if(in_array($subcat["id"], $sub_cat_id_arr)) checked @endif> {{ $subcat['name'] }}
                                              </div>
                                          </div>
                                          @endforeach
                                        </div>
                                        @else
                                        <p>No Sub Category.</p>
                                        @endif
                                      
                                        <div style="clear:both"><br/></div>
                                    @endforeach
                                     </div>
                                    </div>
                                  </div>

                                   @endif



                                  
                                   <div style="clear:both"><br/></div>


                                   <div class="box box-solid box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-user-circle" ></i>Garage Working Hours
                                    </div>
                                    <div class="box-body">

                                   <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                          <label for="tag_name" class="col-sm-3 col-form-label">Monday</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="mon" id="mon" value="{{ $garage_working_hours->mon }}" required="required" />
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group row">
                                          <label for="tag_slug" class="col-sm-3 col-form-label">Tuesday</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="tue" id="tue" value="{{ $garage_working_hours->tue }}" required="required" />
                                          </div>
                                        </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                          <label for="tag_name" class="col-sm-3 col-form-label">Wednessday</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="wed" id="wed" value="{{ $garage_working_hours->wed }}" required="required" />
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group row">
                                          <label for="tag_slug" class="col-sm-3 col-form-label">Thrusday</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="thu" id="thu" value="{{ $garage_working_hours->thu }}" required="required" />
                                          </div>
                                        </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                          <label for="tag_name" class="col-sm-3 col-form-label">Friday</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="fri" id="fri" value="{{ $garage_working_hours->fri }}" required="required" />
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group row">
                                          <label for="tag_slug" class="col-sm-3 col-form-label">Saturday</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="sat" id="sat" value="{{ $garage_working_hours->sat }}" required="required" />
                                          </div>
                                        </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                          <label for="tag_name" class="col-sm-3 col-form-label">sunday</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="sun" id="sun" value="{{ $garage_working_hours->sun }}" required="required" />
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                                   
                                  
*/
?>

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


<?php echo $__env->make('garage.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\g2g\Modules/Garage\Resources/views/garage/garage_details.blade.php ENDPATH**/ ?>