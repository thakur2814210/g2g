
      <div class="card">
        <div class="card-header">
          <i class="fa fas fa-building"></i> Manage Garage Details
        </div>
       
        <div class="card-body table-responsive p-0">

          <form class="form-horizontal" method="POST" action="<?php echo e(route('garage.detail.update')); ?>"  enctype="multipart/form-data">
            
            <?php echo e(csrf_field()); ?>

            <?php if($isGarageDetailExist): ?>
              <input type="hidden" name="id" value="<?php echo e($garagedetails['id']); ?>" />
            <?php endif; ?>
            <input type="hidden" name="form_action" value="<?php echo e($form_action); ?>" />

            <div class="card-body">

              <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Name</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="name" id="name" 
                                <?php if($isGarageDetailExist): ?>
                                  value="<?php echo e($garagedetails['name']); ?>"
                                <?php else: ?>
                                  placeholder="Enter Garage Name" 
                                <?php endif; ?>
                                required="required" 
                                />
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="tag_slug" class="col-sm-12 col-form-label">Slug</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="slug" id="slug" 
                                <?php if($isGarageDetailExist): ?>
                                  value="<?php echo e($garagedetails['slug']); ?>"
                                <?php else: ?>
                                  placeholder="Enter Garage Slug" 
                                <?php endif; ?>
                                required="required" 
                                />
                      </div>
                    </div>
                </div>
              </div>


             <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                    <label for="tag_slug" class="col-sm-12 col-form-label">Description</label>
                    <div class="col-sm-12">
                      <textarea rows="5" class="form-control" name="description" ><?php if($isGarageDetailExist): ?><?php echo e($garagedetails['description']); ?><?php endif; ?></textarea> 
                    </div>
                  </div>
                </div>
            </div>

            <div style="clear:both"><br/></div>
         	<div class="card-header bg-gray">
            	<i class="fa fas fa-image"></i> Garage Media
          	</div>

            <div style="clear:both"><br/></div>


            
            <div class="row" style="min-height: 200px;">

               

               <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Image Upload</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                    <div>
                      <p><small>Upload large Image. Prefer 1600x600</small></p>
                    </div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="text-center">
                      <?php if(isset($garagedetails['thumbnail_image']) && $isGarageDetailExist): ?>
                        <img src="<?php echo e(asset($garagedetails['thumbnail_image'])); ?>" class="avatar img-thumbnail" height="192" width="192" alt="client_image">
                      <?php else: ?>
                        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-thumbnail" alt="client_image">
                      <?php endif; ?>
                    </div>
               </div>

              
            </div>

             <div style="clear:both"><br/></div>
              <?php if(isset($catList['subCats'])): ?>

             	<div class="card-header bg-gray">
                	<i class="fa fas fa-server"></i> Garage Services
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
                <div class="row p-3">
                 	<?php $__currentLoopData = $catList['mainCats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 
	                    <div class="col-md-12">
	                        <div class="form-check d-inline">
	                          <input class="form-check-input" type="checkbox" name="cat_id[]" value="<?php echo e($cat['id']); ?>" <?php if(in_array($cat['id'], $cat_id_arr)): ?> checked <?php endif; ?>>
	                          <label class="form-check-labe text-bold"><b>Main Category :<?php echo e($cat['name']); ?></b></label>
	                        </div>
	                    </div>

	                    <?php if(isset($catList['subCats'][$cat['id']])): ?>
	                      	<div class="row p-3">
	                       		<?php $__currentLoopData = $catList['subCats'][$cat['id']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                        <div class="col-sm-122 col-md-6">
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
                <i class="fa fas fa-clock-o"></i> Garage Working Hours
              </div>

               <div style="clear:both"><br/></div>

               <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Monday</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="mon" id="mon" 
                                <?php if(!empty($garage_working_hours)): ?>
                                  value="<?php echo e($garage_working_hours->mon); ?>"
                                <?php else: ?>
                                   placeholder="09:30AM-03.12PM | Closed" 
                                <?php endif; ?>
                                required="required" 
                        />
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="tag_slug" class="col-sm-12 col-form-label">Tuesday</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="tue" id="tue" 
                                <?php if(!empty($garage_working_hours)): ?>
                                  value="<?php echo e($garage_working_hours->tue); ?>"
                                <?php else: ?>
                                   placeholder="09:30AM-03.12PM | Closed" 
                                <?php endif; ?>
                                required="required" 
                        />
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Wednessday</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="wed" id="wed" 
                                <?php if(!empty($garage_working_hours)): ?>
                                  value="<?php echo e($garage_working_hours->wed); ?>"
                                <?php else: ?>
                                   placeholder="09:30AM-03.12PM | Closed" 
                                <?php endif; ?>
                                required="required" 
                        />
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="tag_slug" class="col-sm-12 col-form-label">Thrusday</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="thu" id="thu" 
                                <?php if(!empty($garage_working_hours)): ?>
                                  value="<?php echo e($garage_working_hours->thu); ?>"
                                <?php else: ?>
                                   placeholder="09:30AM-03.12PM | Closed" 
                                <?php endif; ?>
                                required="required" 
                        />
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Friday</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="fri" id="fri" 
                                <?php if(!empty($garage_working_hours)): ?>
                                  value="<?php echo e($garage_working_hours->fri); ?>"
                                <?php else: ?>
                                  placeholder="09:30AM-03.12PM | Closed" 
                                <?php endif; ?>
                                required="required" 
                        />
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="tag_slug" class="col-sm-12 col-form-label">Saturday</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="sat" id="sat" 
                                <?php if(!empty($garage_working_hours)): ?>
                                  value="<?php echo e($garage_working_hours->sat); ?>"
                                <?php else: ?>
                                   placeholder="09:30AM-03.12PM | Closed" 
                                <?php endif; ?>
                                required="required" 
                        />
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">sunday</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="sun" id="sun" 
                                <?php if(!empty($garage_working_hours)): ?>
                                  value="<?php echo e($garage_working_hours->sun); ?>"
                                <?php else: ?>
                                   placeholder="09:30AM-03.12PM | Closed" 
                                <?php endif; ?>
                                required="required" 
                        />
                      </div>
                    </div>
                </div>
              </div>

               
              

              <!----------------------------------------------------------------------------
                Garage Location
              ------------------------------------------------------------------------------->

              <div style="clear:both"><br/></div>

               <div class="card-header bg-gray">
                 <i class="fa fas fa-map-marker"></i> Garage Location
              </div>

               <div style="clear:both"><br/></div>

              <div class="form-group">
                <label for="tag_name" class="col-sm-12 col-form-label">Address</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="address" id="address" 
                          <?php if($isGarageDetailExist): ?>
                            value="<?php echo e($garagedetails['address']); ?>"
                          <?php else: ?>
                            placeholder="Enter Garage Full Address" 
                          <?php endif; ?>
                          required="required" 
                  />
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
                              <option value="<?php echo e($city->id); ?>" 
                                <?php if($isGarageDetailExist): ?>
                                  <?php if( $garagedetails['city_id'] == $city->id): ?> selected <?php endif; ?>
                                <?php endif; ?>
                                ><?php echo e($city->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </select>
                      </div>
                    </div>
                </div>
                <div class="col-md-4">
                   <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Country</label>
                      <div class="col-sm-12">
                        <?php if($isGarageDetailExist): ?>
                          <select class="form-control" name="country_id" id="country_id" required="required">
                            <option value="" >Select Country</option>
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($country->id); ?>" 
                                <?php if($isGarageDetailExist): ?>
                                  <?php if( $garagedetails['country_id'] == $country->id): ?> selected <?php endif; ?>
                                <?php endif; ?>
                                ><?php echo e($country->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                          </select>
                         <?php endif; ?>
                      </div>
                    </div>
                </div>

                <div class="col-md-4">
                   <div class="form-group">
                      <label for="tag_name" class="col-sm-12 col-form-label">Postal</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="postal" id="postal" 
                                <?php if($isGarageDetailExist): ?>
                                  value="<?php echo e($garagedetails['postal']); ?>"
                                <?php else: ?>
                                  placeholder="Enter Postal" 
                                <?php endif; ?>
                                required="required" 
                        />
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                        <label for="tag_name" class="col-sm-12 col-form-label">Latitude</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="latitude" id="latitude" 
                                  <?php if($isGarageDetailExist): ?>
                                    value="<?php echo e($garagedetails['latitude']); ?>"
                                  <?php else: ?>
                                    placeholder="Enter Garage Address Latitude" 
                                  <?php endif; ?>
                                  required="required" 
                          />
                        </div>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tag_name" class="col-sm-12 col-form-label">Longitude</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="longitude" id="longitude" 
                                  <?php if($isGarageDetailExist): ?>
                                    value="<?php echo e($garagedetails['longitude']); ?>"
                                  <?php else: ?>
                                    placeholder="Enter Garage Address Longitude" 
                                  <?php endif; ?>
                                  required="required" 
                          />
                        </div>
                      </div>
                </div>
              </div>
              
             
              <!----------------------------------------------------------------------------
                Garage Owner Information
              ------------------------------------------------------------------------------->


              <div style="clear:both"><br/></div>

              <div class="card-header">
                <i class="fa fas fa-user-secret"></i>Garage Owner Information
              </div>
              
               <div style="clear:both"><br/></div>

               <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                        <label for="tag_name" class="col-sm-12 col-form-label">Owner Name</label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" name="owner_name" id="owner_name" 
                                  <?php if($isGarageDetailExist): ?>
                                    value="<?php echo e($garagedetails['owner_name']); ?>"
                                  <?php else: ?>
                                    placeholder="Enter Garage Owner Full Name" 
                                  <?php endif; ?>
                                  required="required" 
                          />
                        </div>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="tag_slug" class="col-sm-12 col-form-label">Owner Phone</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="owner_phone" id="owner_phone" 
                                <?php if($isGarageDetailExist): ?>
                                  value="<?php echo e($garagedetails['owner_phone']); ?>"
                                <?php else: ?>
                                  placeholder="Enter Garage Owner Phone" 
                                <?php endif; ?>
                                required="required" 
                        />
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                        <label for="tag_name" class="col-sm-12 col-form-label">Owner Email</label>
                        <div class="col-sm-12">
                          <input type="email" class="form-control" name="owner_email" id="owner_email" 
                                  <?php if($isGarageDetailExist): ?>
                                    value="<?php echo e($garagedetails['owner_email']); ?>"
                                  <?php else: ?>
                                    placeholder="Enter Garage Owner Officail Email" 
                                  <?php endif; ?>
                                  required="required" 
                          />
                        </div>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="tag_slug" class="col-sm-12 col-form-label">Owner Address</label>
                      <div class="col-sm-12">
                         <input type="text" class="form-control" name="owner_address" id="owner_address" 
                                <?php if($isGarageDetailExist): ?>
                                  value="<?php echo e($garagedetails['owner_address']); ?>"
                                <?php else: ?>
                                  placeholder="Enter Garage Owner Address" 
                                <?php endif; ?>
                                required="required" 
                        />
                      </div>
                    </div>
                </div>
              </div>

               <div class="col-md-12 text-center">
                    <div class="form-group">
                    	 <button type="submit" class="btn btn-danger"><i class="fa fa-save" ></i> <?php if($isGarageDetailExist): ?> Update <?php else: ?> Save <?php endif; ?> Garage Information</button>
                    </div>
                </div>

            </div>
          </form>
        </div>
      </div><?php /**PATH /home/g2g/public_html/Modules/Garage/Resources/views/garage/partials/garage-detail.blade.php ENDPATH**/ ?>