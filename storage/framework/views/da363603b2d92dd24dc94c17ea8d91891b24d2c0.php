<?php $__env->startSection('content'); ?>

  <main>
    <div class="row p-1">
      <div class="col-md-12">
        <div class="container">
          <div class="row">
              <div class="col-12">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>* <?php echo e($error); ?></li>
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
          <div class="card ">
            <div class="card-header bg-danger text-white">
              <h5 class="text-white"><?php echo e(trans('website.Section')); ?>: <?php echo e($categories->name); ?> <?php echo e(trans('website.Service Request')); ?></h5>
            </div>
            <div class="card-body">
               <div id="accordion">


                  <div class="card">
                    <div class="card-header card-link">
                      <h5 class="text-danger header-login"><span class="badge badge-warning">1</span> <?php echo e(trans('website.Login')); ?> </h5>
                      <h6>
                        <strong class="text-danger"><?php echo e(trans('website.Uername')); ?>:</strong> <?php echo e(Auth::user()->user_name); ?>

                        <strong class="text-danger"><?php echo e(trans('website.Email')); ?>:</strong> <?php echo e(Auth::user()->email); ?>

                        <strong class="text-danger"><?php echo e(trans('website.Phone')); ?>:</strong> <?php echo e(Auth::user()->phone); ?>

                      </h6>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header card-link">
                      <h5 class="text-danger"><span class="badge badge-warning">2</span> <?php echo e(trans('website.Select Vehicle')); ?>

                        <span class="vehicle-change-span"></span>
                      </h5>
                    </div>
                    <div id="vehicle" class="collapse show" data-parent="#accordion">
                      <div class="card-body">

                        <?php if(!empty($vehicles) && count($vehicles) > 0): ?>      
                          <div class="form-group">
                            <p class="text-danger"><?php echo e(trans('website.Select your vehicle')); ?>:</p>
                            <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <div class="card flex-row flex-wrap">
                                  <div class="card-header border-0">
                                     <input type="radio"  name="vehicle_id" value="<?php echo e($vehicle->id); ?>" />
                                  </div>
                                  <div class="card-block px-2">
                                      <h6 style="margin: 0px;" class="card-title m-0 text-danger"><?php echo e($vehicle->plate_no); ?></h6>
                                      <small> 
                                          <b> <?php echo e(trans('website.Make')); ?>:</b> <?php echo e(!empty($vehicle->vmake->name) ? $vehicle->vmake->name : null); ?>

                                      </small>
                                      <small> 
                                          <b> <?php echo e(trans('website.Model')); ?>:</b> <?php echo e(!empty($vehicle->vmodel->name) ?$vehicle->vmodel->name : null); ?>

                                      </small>
                                      <small> 
                                          <b> <?php echo e(trans('website.Year')); ?>:</b> <?php echo e($vehicle->year); ?>

                                      </small>
                                  </div>
                              </div>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                          </div>  
                        <?php endif; ?>
                                  
                        <div class="form-group">
                          <a class="btn btn-danger text-uppercase" data-toggle="collapse" href="#RegisterNewVehicle">
                            <i class="fa fas fa-plus"></i> <?php echo e(trans('website.Register New Vehicle')); ?>

                          </a>
                          <button type="button"  class="btn btn-danger text-uppercase float-right btn-vehicle-continue" ><i class="fa fas fa-check-circle"></i> <?php echo e(trans('website.Continue')); ?></button>
                        </div>
 
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div id="RegisterNewVehicle" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                          <form class="form-horizontal" method="POST" action="<?php echo e(route('client.vehicle.save')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="client_id" value="<?php echo e($client->id); ?>">
                             <div class="card-body">

                              <div class="row">
                                     <div class="col-12 col-md-4">
                                       <div class="form-group">
                                          <label for="tag_slug" class="col-12 col-form-label text-danger"><?php echo e(trans('website.Plate No')); ?> * </label>
                                         <div class="col-12">
                                            <input type="text" class="form-control" name="plate_no" id="plate_no" placeholder="<?php echo e(trans('website.Enter Plate No')); ?>" required="" />
                                          </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                       <div class="form-group">
                                        <label for="tag_slug" class="col-md-12 col-form-label text-danger"><?php echo e(trans('website.Make')); ?> *</label>
                                        <div class="col-md-12">
                                          <select class="form-control" name="make" id="make" required="required">
                                             <option value=""><?php echo e(trans('website.Select Vehicle Make')); ?></option>
                                             <?php $__currentLoopData = $vehicle_makes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($make->id); ?>" data-url="<?php echo e(route('client.vehicle.model',['id' => $make->id])); ?>"  ><?php echo e($make->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          </select>
                                        </div>
                                      </div>
                                  </div>

                                  <div class="col-12 col-md-4">
                                       <div class="form-group">
                                          <label for="tag_slug" class="col-12 col-form-label text-danger"><?php echo e(trans('website.Model')); ?> *</label>
                                          <div class="col-12">
                                            <select class="form-control" name="model" id="model" required="required">
                                               <option>--<?php echo e(trans('website.Select Vehicle Models')); ?>--</option>
                                            </select>
                                          </div>
                                        </div>
                                  </div>
                              </div>
                             
                               <div class="row">

                                <div class="col-12 col-md-4">
                                  <div class="form-group">
                                    <label for="tag_slug" class="col-12 col-form-label text-danger"><?php echo e(trans('website.Year')); ?> *</label>
                                    <div class="col-12">
                                      <input type="text" class="form-control" name="year" id="year" placeholder="<?php echo e(trans('website.Enter Year')); ?>" required="required" />
                                    </div>
                                  </div>
                                </div>

                                 <div class="col-12 col-md-4">
                                       <div class="form-group">
                                          <label for="tag_slug" class="col-12 col-form-label text-danger"><?php echo e(trans('website.Registration No(Mulkiya)')); ?></label>
                                          <div class="col-12">
                                            <input type="text" class="form-control" name="registration_no" id="registration_no" placeholder="<?php echo e(trans('website.Enter Registration No(Mulkiya)')); ?>"  />
                                          </div>
                                        </div>
                                  </div>


                                 <div class="col-12 col-md-4">
                                       <div class="form-group">
                                          <label for="tag_slug" class="col-12 col-form-label text-danger"><?php echo e(trans('website.Chassis No')); ?></label>
                                         <div class="col-12">
                                            <input type="text" class="form-control" name="chassis_no" id="chassis_no" placeholder="<?php echo e(trans('website.Enter Chassis No')); ?>" />
                                          </div>
                                        </div>
                                   </div>
                              </div>

                              <div class="row">


                                  <div class="col-12 col-md-4">
                                       <div class="form-group">
                                          <label for="tag_slug" class="col-12 col-form-label text-danger"><?php echo e(trans('website.Color')); ?></label>
                                          <div class="col-12">
                                            <input type="text" class="form-control" name="color" id="color" placeholder="<?php echo e(trans('website.Enter Color')); ?>"/>
                                          </div>
                                        </div>
                                  </div>
                                  
                                  <div class="col-12 col-md-4">
                                      <div class="form-group">
                                        <label for="tag_name" class="col-12 col-form-label text-danger"><?php echo e(trans('website.Current Mileage')); ?></label>
                                         <div class="col-12">
                                          <input type="text" class="form-control" name="current_mileage" id="current_mileage" placeholder="<?php echo e(trans('website.Enter Current Mileage')); ?>" />
                                        </div>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-4">
                                      <div class="form-group">
                                        <label for="tag_status" class="col-12 col-form-label text-danger"><?php echo e(trans('website.Status')); ?></label>
                                        <div class="col-12">
                                          <select class="form-control" name="status" id="status" required="required">
                                            <option value="1" ><?php echo e(trans('website.Active')); ?></option>
                                          </select>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                             
                              <div class="row">
                                <div class="col-12 ">
                                  <div class="form-group">
                                    <div class="col-12 ">
                                      <button type="submit" class="btn btn-success"><i class="fa fa-car" ></i> <?php echo e(trans('website.Save New Vehicle')); ?></button>
                                      <button type="reset" class="btn btn-danger ml-2"><i class="fa fa-times" ></i> <?php echo e(trans('website.Reset')); ?></button>
                                      <button type="button" class="btn btn-warning float-right btn-register-vehicle-continue"><i class="fa fa-check-circle" ></i> <?php echo e(trans('website.Continue')); ?></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </form>
                      </div>
                    </div>
                  </div>


                  <div class="card">
                    <div class="card-header card-link">
                      <h5 class="text-danger"><span class="badge badge-warning">3</span> <?php echo e(trans('website.Your Location')); ?>

                         <span class="location-change-span"></span>
                      </h5>
                    </div>
                    <div id="Location" class="collapse" data-parent="#accordion">
                      
                      <div class="card-body">

                        <?php if(!empty($c_locations) && count($c_locations) > 0): ?>      
                            <?php $__currentLoopData = $c_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $c_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <div class="card flex-row flex-wrap">
                                  <div class="card-header border-0">
                                     <input type="radio"  name="your_location" data-lat="<?php echo e($c_location->latitude); ?>" data-long="<?php echo e($c_location->longitude); ?>" data-city="<?php echo e($c_location->city_id); ?>" data-country="<?php echo e($c_location->country_id); ?>" data-address="<?php echo e($c_location->address); ?>" data-pobox="<?php echo e($c_location->pobox); ?>" value="<?php echo e($c_location->id); ?>" />
                                  </div>
                                  <div class="card-block px-2">
                                      <h6 style="margin: 0px;" class="card-title m-0 text-danger"><?php echo e($c_location->address); ?></h6>
                                       <small> 
                                          <b> <?php echo e(trans('website.City')); ?>:</b> <?php echo e($c_location->city->name); ?>

                                      </small>
                                      <small> 
                                          <b> <?php echo e(trans('website.Country')); ?>:</b> <?php echo e($c_location->country->name); ?>

                                      </small>
                                      <small> 
                                          <b> <?php echo e(trans('website.Pobox')); ?>:</b> <?php echo e($c_location->pobox); ?>

                                      </small>
                                  </div>
                              </div>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                     
                        <div class="form-group">
                           <a class="btn btn-danger text-uppercase" data-toggle="collapse" href="#AddLocations">
                            <i class="fa fas fa-plus"></i> <?php echo e(trans('website.Add Locations')); ?>

                          </a>
                           <button type="button"  class="btn btn-danger text-uppercase btn-location-continue float-right" ><i class="fa fas fa-check-circle"></i> <?php echo e(trans('website.Continue')); ?></button>
                        </div>
                       
                      </div>
                    </div>

                      <div class="card">
                        <div id="AddLocations" class="collapse" data-parent="#accordion">
                          <div class="card-body">
                             <form class="form-horizontal" method="POST" action="<?php echo e(route('client.add-new-location')); ?>">
                              <?php echo e(csrf_field()); ?>

                              <div class="row">
                                <div class="col-12">
                                  <div class="form-group">
                                      <label class="text-danger"> <?php echo e(trans('website.Location/City/Address')); ?> *</label>
                                      <input type="text"  name="address" id="autocomplete" class="form-control" placeholder="<?php echo e(trans('website.Select Location')); ?>">
                                  </div>
                                </div>

                                
                                <div class="col-12 col-md-6">
                                  <div class="form-group" id="lat_area">
                                      <label class="text-danger"> <?php echo e(trans('website.Latitude')); ?> *</label>
                                      <input type="text" name="latitude" id="latitude" class="form-control" readonly="" >
                                  </div>
                                </div>

                                <div class="col-12 col-md-6">
                                  <div class="form-group" id="long_area">
                                      <label class="text-danger"> <?php echo e(trans('website.Longitude')); ?> *</label>
                                      <input type="text" name="longitude" id="longitude" class="form-control" readonly="">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                      <label class="text-danger"> <?php echo e(trans('website.City')); ?> *</label>
                                       <select class="form-control" name="city_id" id="city" required="required">
                                          <option value=""><?php echo e(trans('website.Select City')); ?></option>
                                          <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-12 col-md-4">
                                    <div class="form-group">
                                      <label class="text-danger"> <?php echo e(trans('website.Country')); ?> *</label>
                                       <select class="form-control" name="country_id" id="country" required="required">
                                          <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($country->id); ?>" selected=""><?php echo e($country->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-12 col-md-4">
                                    <div class="form-group">
                                      <label class="text-danger"> <?php echo e(trans('website.Pobox')); ?> *</label>
                                      <input type="number" class="form-control" name="pobox" id="pobox" placeholder="<?php echo e(trans('website.Your pobox(5 digit only)')); ?>">
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-12 ">
                                    <div class="form-group">
                                      <div class="col-12 ">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-car" ></i> <?php echo e(trans('website.Update Address')); ?></button>
                                        <button type="reset" class="btn btn-danger ml-2"><i class="fa fa-times" ></i> <?php echo e(trans('website.Reset')); ?></button>
                                        <button  class="btn btn-warning float-right btn-update-location-continue"><i class="fa fa-check-circle" ></i> <?php echo e(trans('website.Continue')); ?></button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header card-link">
                      <h5 class="text-danger"><span class="badge badge-warning">4</span> <?php echo e(trans('website.Service List')); ?>

                         <span class="location-change-span"></span>
                      </h5>
                    </div>
                    <div id="Service" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        <section class="pricing">
                          <div class="container">
                            <?php if(isset($catList['subCats'])): ?>
                              <div class="<?php if(\Config::get("app.locale") == 'en'): ?> float-left <?php else: ?> float-right <?php endif; ?> p-3">
                                  <div class="row">
                                   <?php $__currentLoopData = $catList['mainCats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <div class="col-md-12">
                                          <div class="form-check d-inline">
                                            <input class="form-check-input category_checkbox parent_<?php echo e($cat['id']); ?>" type="checkbox" name="cat_id[]" value="<?php echo e($cat['id']); ?>">
                                            <label class="form-check-label text-uppercase"><strong>&nbsp;<?php echo e(trans('website.Main Category')); ?>: <?php echo e($cat['name']); ?></strong></label>
                                          </div>
                                     
                                        <?php if(isset($catList['subCats'][$cat['id']])): ?>
                                          <div class="row p-3">
                                            <?php $__currentLoopData = $catList['subCats'][$cat['id']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <div class="col-sm-12 col-md-6">
                                                <div class="form-check d-inline">
                                                  <input class="form-check-input sub_category_checkbox child_<?php echo e($cat['id']); ?>" type="checkbox" name="sub_cat_id[]" value="<?php echo e($subcat['id']); ?>">
                                                  <label class="form-check-label"><?php echo e($subcat['name']); ?></label>
                                                </div>
                                              </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php else: ?>
                                          <div class="row p-3">
                                             <div class="col-sm-12 col-md-6">
                                                <small><?php echo e(trans('website.No Sub Categories available')); ?></small>
                                            </div>
                                          </div>
                                        <?php endif; ?>
                                      </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </div>
                                </div>
                              <?php endif; ?>
                          </div>
                            <div class="clearfix"></div>
                            <?php if($vip_pickup_enabled == 1): ?>
                            <div class="jumbotron">
                                <h5><?php echo e(trans('website.Pick and drop your car from your location?')); ?></h5>
                                <h6>AED <?php echo e($vip_pickup_amount); ?> <?php echo e(trans('website.payable in cash')); ?></h6>
                                <label class="radio-inline"><input type="radio" class="vipPickupRadio" name="vipPickup" value="1"><?php echo e(trans('website.Yes')); ?> 1</label>
                                <label class="radio-inline"><input type="radio" class="vipPickupRadio" name="vipPickup" value="0" checked><?php echo e(trans('website.No')); ?></label>
                            </div>
                            <?php else: ?>

                            <?php endif; ?>
                        </section>
                        <div class="form-group">
                          <button type="button"  class="btn btn-danger text-uppercase btn-service-continue float-right" ><i class="fa fas fa-check-circle"></i> <?php echo e(trans('website.Continue')); ?></button>
                        </div>
                        
                      </div>
                    </div>
                  </div>


                  <div class="card">
                    <div class="card-header card-link">
                      <h5 class="text-danger"><span class="badge badge-warning">4</span> <?php echo e(trans('website.Garages')); ?>

                        <span class="garage-change-span"></span>
                      </h5>
                    </div>
                    <div id="Garage" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        <div class="form-group">
                          <p class="text-danger"> <?php echo e(trans('website.Garage list shown here based on your location and in KM')); ?> *</p>
                           <select class="form-control col-12 col-md-6" name="garage_distance" id="garage_distance" required="required">
                                <option value="5">5 <?php echo e(trans('website.KM')); ?></option>
                                <option value="10" >10 <?php echo e(trans('website.KM')); ?></option>
                                <option value="20" selected="">20 <?php echo e(trans('website.KM')); ?></option>
                                <option value="30" >30 <?php echo e(trans('website.KM')); ?></option>
                                <option value="40" >40 <?php echo e(trans('website.KM')); ?></option>
                                <option value="50" >50 <?php echo e(trans('website.KM')); ?></option>
                            </select>
                        </div>
                        <div id="garage_list"><p><?php echo e(trans('website.Please wait')); ?></p></div>
                         <div class="form-card">                 
                          <div class="form-group">
                            <button type="button"  class="btn btn-danger text-uppercase btn-garage-continue float-right" ><i class="fa fas fa-check-circle"></i> <?php echo e(trans('website.Continue')); ?></button>
                          </div>
                         </div>
                      </div>
                    </div>
                  </div>


                   <div class="card">
                     <div class="card-header card-link">
                      <h5 class="text-danger"><span class="badge badge-warning">5</span> <?php echo e(trans('website.Information Required')); ?>

                         <span class="Fault-change-span"></span>
                      </h5>
                    </div>
                    <div id="Fault" class="collapse" data-parent="#accordion">
                      
                      <form id="msform" method="POST" action="<?php echo e(route('client.service-request.save-new')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                        <input type="hidden" name="cat_id" id="cat_id_hidden" value="<?php echo e($cat_slug); ?>">
                        <input type="hidden" name="vehicle_id" id="vehicle_id_hidden" value="">
                        <input type="hidden" name="garage_id" id="garage_id_hidden" value="">
                        <input type="hidden" name="address" id="address_hidden" value="">
                        <input type="hidden" name="latitude" id="latitude_hidden" value="">
                        <input type="hidden" name="longitude" id="longitude_hidden" value="">
                        <input type="hidden" name="city" id="city_hidden" value="">
                        <input type="hidden" name="country" id="country_hidden" value="">
                        <input type="hidden" name="pobox" id="pobox_hidden" value="">
                        <input type="hidden" name="faults_remarks" id="faults_remarks_hidden" value="">
                        <input type="hidden" name="sevices" id="sevices_hidden" value="">
                        <input type="hidden" name="vip_pickup_opted" id="vip_pickup_hidden" value="0">
                        <input type="hidden" name="vip_pickup_price" id="vip_pickup_price_hidden" value="<?php echo e($vip_pickup_amount); ?>">

                        <div class="card-body">

                          <div class="form-group">
                            <label class="text-danger"> <?php echo e(trans('website.Explain your problem')); ?> *</label>
                            <textarea class="form-control" name="faults_remarks" id="faults_remarks" placeholder="<?php echo e(trans('website.Explain your problem')); ?>" rows="5" required=""></textarea>
                          </div>

                           <div class="row">
                            <div class="col-12 col-md-6">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="nsr_info_file_1"  id="nsr_info_file_1">
                                <label class="custom-file-label" for="customFile" ><?php echo e(trans('website.Upload images related to your problem 1')); ?></label>
                              </div>
                            </div>

                             <div class="col-12 col-md-6">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="nsr_info_file_2" id="nsr_info_file_2">
                                  <label class="custom-file-label" for="customFile" ><?php echo e(trans('website.Upload images related to your problem 2')); ?></label>
                                </div>
                            </div>
                          </div>
                          <br/>

                           <?php if($categories->can_appointment): ?>
                           <div class="form-group">
                             <label for="sel1"><?php echo e(trans('website.Booking Slot Date&Time')); ?>:</label>
                              <div class='input-group date'>
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                  </div>
                                  <input type='text' class="form-control" id='datetimepicker1' name="appointment_at" placeholder="<?php echo e(trans('website.Select Date and Time')); ?>" />
                              </div>
                            </div>
                             <br/>
                          <?php endif; ?>

                          

                         
                          <div class="row justify-content-center">
                              <div class="col-12 text-center">
                                <h6 class="text-danger"><?php echo e(trans('website.Once service has been requested it cannot be cancelled after approval of quote')); ?></h6>
                                 <button type="submit" class="btn btn-success text-uppercase" name="submit" id="submit"> <i class="fa fas fa-save"></i> <?php echo e(trans('website.Create Service Request')); ?></button>
                              </div>
                           </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  

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

   $(document).ready(function ()
    {
            $('select[name="make"]').on('change',function(){
               var makeId = $(this).val();
               var dataUrl = $('#make option:selected').attr('data-url');
              
              // tis url not working on live
               if(makeId){
                  $.ajax({
                     url : dataUrl,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        $('select[name="model"]').empty();
                        $.each(data, function(key,value){
                           $('select[name="model"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else{
                $('select[name="state"]').empty();
               }
            });

            $('select[name="garage_distance"]').on('change',function(){
                // lets get the garage list
                var pleaseWait = "<?php echo e(trans('website.Please wait')); ?>";
                $('#garage_list').html('<p>' + pleaseWait + '</p>');

                var param = {
                  'language_id' : (language == 'en') ? 1: 2,
                  'latitude' : $('input[name="your_location"]:checked').attr('data-lat'),
                  'longitude' : $('input[name="your_location"]:checked').attr('data-long'),
                  'city_id': $('input[name="your_location"]:checked').attr('data-city'),
                  'country_id' : $('input[name="your_location"]:checked').attr('data-country'),
                  'distance' : $('#garage_distance').val(),
                  'category' : "<?php echo $cat_slug ?>",
                  '_token' : '<?php echo csrf_token() ?>'
                }
               
                $.ajax({
                   type:'POST',
                   url:'<?php echo e(route('client.service-request.garage-list-latlong')); ?>',
                   data: param,
                   success:function(data) {
                      $('#garage_list').html(data.html);
                   }
                });
            });
    });

   
</script>

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>


<script>

  // Category service...
        var category_checkbox = [];

        function removeA(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax= arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }

        $('input.category_checkbox').on('change', function() {

          var split_cls = ($(this).attr('class')).split("category_checkbox ");
          var parent_cls = (split_cls[1]).split("_");
          var parent_id = parent_cls[1];

          if($(this).is(':checked')){

             // check all child also... 
            $('.child_' + parent_id).prop('checked', true); 
            $('.child_' + parent_id + ':checked').each(function () {
              category_checkbox.push($(this).val());
            });

            // add to array
            category_checkbox.push($(this).val());

          }else{
            // remove from array
            removeA(category_checkbox, $(this).val());
            
            // uncheck all child also...
            // remove all child id 
            $('.child_' + parent_id).prop('checked', false);  
            $('.child_' + parent_id + ':not(:checked)').each(function () {
              removeA(category_checkbox, $(this).val());
            });
          }
        });

        $('input.sub_category_checkbox').on('change', function() {

          var split_cls = ($(this).attr('class')).split("sub_category_checkbox ");
          var child_cls = (split_cls[1]).split("_");
          var child_id = child_cls[1];

          if($(this).is(':checked')){
            

            category_checkbox.push($(this).val());

             // check parent and their id
            $('.parent_' + child_id).prop('checked', true); 
            category_checkbox.push($('.parent_' + child_id).val()); 

          }else{

            // remove child id
            removeA(category_checkbox, $(this).val());

            // check if all chiild is unchecked then uncheck parent and renove id from array... 
            if($('.child_' + child_id + ':checked').length == 0){
              $('.parent_' + child_id).prop('checked', false);  
              removeA(category_checkbox, $('.parent_' + child_id).val());
            }
          }

        });

  

  $('.btn-service-continue').click(function(){
   
    
    var floatDir = (language == 'en') ? 'float-right' : 'float-left';
    var changeBtnHtml = '<a class="btn btn-outline-danger btn-sm '+floatDir+'" data-toggle="collapse" href="#Service"><?php echo e(trans("website.Change")); ?></a>';
    $('.location-change-span').html(changeBtnHtml);
    $('#Service').removeClass('show');
    $('#Garage').addClass('show');

  });




  $('.btn-vehicle-continue').click(function(){
   
   
    if($('input[name="vehicle_id"]:checked').val() == undefined){
        var  alertText = "<?php echo e(trans('website.Select atleast one vehicle or register your vehicle')); ?>";
        alert(alertText);
    }else{
        var floatDir = (language == 'en') ? 'float-right' : 'float-left';
      var changeBtnHtml = '<a class="btn btn-outline-danger btn-sm '+floatDir+'" data-toggle="collapse" href="#vehicle"><?php echo e(trans("website.Change")); ?></a>';
      $('.vehicle-change-span').html(changeBtnHtml);
      $('#vehicle').removeClass('show');

      $('#Location').addClass('show');
    }

  });

  $('.btn-register-vehicle-continue').click(function(){
     $('#RegisterNewVehicle').removeClass('show');
    $('#vehicle').addClass('show');
  });


  $('.btn-update-location-continue').click(function(){
     $('#AddLocations').removeClass('show');
     $('#Location').addClass('show');
  });
  

  $('.btn-location-continue').click(function(){

    if($('input[name="your_location"]:checked').val() == undefined){
        var  alertText = "<?php echo e(trans('website.Select atleast one location or add new location')); ?>";
        alert(alertText);
    }else{
      var floatDir = (language == 'en') ? 'float-right' : 'float-left';
      var changeBtnHtml = '<a class="btn btn-outline-danger btn-sm '+floatDir+'" data-toggle="collapse" href="#Location"><?php echo e(trans("website.Change")); ?></a>';
      $('.location-change-span').html(changeBtnHtml);
      $('#Location').removeClass('show');
      $('#Service').addClass('show');

      var param = {
        'latitude' : $('input[name="your_location"]:checked').attr('data-lat'),
        'longitude' : $('input[name="your_location"]:checked').attr('data-long'),
        'city_id': $('input[name="your_location"]:checked').attr('data-city'),
        'country_id' : $('input[name="your_location"]:checked').attr('data-country'),
        'distance' : $('#garage_distance').val(),
        'category' : "<?php echo $cat_slug ?>",
        'category_checkbox': category_checkbox,
        '_token' : '<?php echo csrf_token() ?>'
      }
      $.ajax({
         type:'POST',
         url:'<?php echo e(route('client.service-request.garage-list-latlong')); ?>',
         data: param,
         success:function(data) {
            $('#garage_list').html(data.html);
         }
      });
    }
  });

    
  $('.btn-garage-continue').click(function(){
    
    if( $("input[name='garage_id']:checked").length  == 0){
        var  alertText = "<?php echo e(trans('website.Select atleast one garage')); ?>";
        alert(alertText);
      return;
    }
    
   
    var floatDir = (language == 'en') ? 'float-right' : 'float-left';
    var changeBtnHtml = '<a class="btn btn-outline-danger btn-sm  '+floatDir+'" data-toggle="collapse" href="#Garage"><?php echo e(trans("website.Change")); ?></a>';
    $('.garage-change-span').html(changeBtnHtml);
    $('#Garage').removeClass('show');
    $('#Fault').addClass('show');

    $('#vehicle_id_hidden').val($('input[name="vehicle_id"]:checked').val());
    $('#garage_id_hidden').val($("input[name='garage_id']:checked").val());
    $('#address_hidden').val($('input[name="your_location"]:checked').attr('data-address'));
    $('#latitude_hidden').val($('input[name="your_location"]:checked').attr('data-lat'));
    $('#longitude_hidden').val($('input[name="your_location"]:checked').attr('data-long'));
    $('#city_hidden').val($('input[name="your_location"]:checked').attr('data-city'));
    $('#country_hidden').val($('input[name="your_location"]:checked').attr('data-country'));
    $('#pobox_hidden').val($('input[name="your_location"]:checked').attr('data-pobox'));
    $('#faults_remarks_hidden').val($('#faults_remarks').val());
    $('#sevices_hidden').val(category_checkbox);
    $('#vip_pickup_hidden').val($('input[name="vipPickup"]:checked').val());
    alert($('#vip_pickup_hidden').val())

  });

  


</script>
 <script src="<?php echo e(asset('website-theme/js/bootstrap-datetimepicker.min.js')); ?>"></script>
 <script type="text/javascript">
            $(function () {

                $('#datetimepicker1').datetimepicker({
                    minDate:new Date(),
                    disabledDates: [new Date()],
                    daysOfWeekDisabled: [5],
                    showClose: true,
                    showClear: true,
                });
            });
        </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\g2g\Modules/Client\Resources/views/service-request/create-service-request.blade.php ENDPATH**/ ?>