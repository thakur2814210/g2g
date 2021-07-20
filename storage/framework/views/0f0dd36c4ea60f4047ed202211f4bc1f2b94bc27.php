<?php $__env->startSection('content'); ?>

	

	

	<div class="container">
		<div id="results">
   			<div class="container">
			   <div class="row">
				   	<div class="col-md-12">
				   			<form method="get" action="<?php echo e(route('listings.search-by-location')); ?>">
		                    	<div class="row no-gutters custom-search-input-2">
		                            <input type="hidden" name="latitude" id="latitude" value="">
		                            <input type="hidden" name="longitude" id="longitude" value="">
		                            <div class="col-lg-7">
		                                <div class="form-group">
		                                    <input type="text" name="address" id="autocomplete" class="form-control" placeholder="Location/City/Address">
		                                    <i class="icon_search"></i>
		                                </div>
		                                 <i class="pe-7s-edit toogle-distance-slider"></i>
		                                <div class="distance-slider" style="display: none;">
		                                    <div class="text-primary mb-2">Distance: <span id="distance-value">5</span>KM</div>
		                                    <input id="thedistance" name="distance" type="range" min="0" max="1000" step="5" value="5" >
		                                </div>
		                            </div>
		                            <div class="col-lg-3">
		                                <select class="wide" name="category">
		                                    <option value="all">All Categories</option>	
		                                    <?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                                    	<option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
		                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                                </select>
		                            </div>
		                            <div class="col-lg-2">
		                                <input type="submit" value="Search">
		                            </div>
		                        </div>
		                        <!-- /row -->
		                    </form>
		            </div>
			   </div>
	  
				<div class="search_mob_wp">
					<div class="custom-search-input-2">
						 <form method="get" action="<?php echo e(route('listings.search')); ?>">
						   <a href="#0" class="search_mob btn_search_mobile"></a> <!-- /open search panel -->
							<div class="row no-gutters custom-search-input-2 inner">
								<div class="col-lg-8">
									<div class="form-group">
										 <input type="text" name="location" id="autocomplete" class="form-control" placeholder="Location/City/Address">
										<i class="icon_search"></i>	
									</div>
									 <i class="pe-7s-edit toogle-distance-slider"></i>
		                            <div class="distance-slider" style="display: none;">
		                                <div class="text-primary mb-2">Distance: <span id="distance-value">5</span>KM</div>
		                                <input id="thedistance" name="distance" type="range" min="0" max="100" step="5" value="5" >
		                            </div>
								</div>
								<div class="col-lg-3">
									<select class="wide" name="category">
										<option value="-1">All Categories</option>	
										<?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                                	<option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
		                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
								<div class="col-lg-1">
									<input type="submit" class="bg-danger" value="Search">
								</div>
							</div>
						</form>
					</div>
				</div>
   			</div>
		</div>

		<div class="filters_listing version_2  sticky_horizontal">
			<div class="container">
				<ul class="clearfix">
					<li style="list-style: none;">
						
						  <button type="button" class="btn btn-info">
						  	<a href="<?php echo e(route('listings.workshops-garages',['category' => 'all'])); ?>" style="color: #fff;">See All Garage</a>
						  </button>
						  <button type="button" class="btn btn-warning">
						  	<a style="color: #fff;" href="<?php echo e(route('listings.workshops-garages',['category' => 'featured'])); ?>">See Featured Garage</a>
						  </button>
						  <button type="button" class="btn btn-danger">
						  	<a style="color: #fff;" href="<?php echo e(route('listings.workshops-garages',['category' => 'latest'])); ?>">See Latest Garage</a>
						  </button>
					
					</li>
					<li style="list-style: none;">
						<?php if(!empty($garages) && count($garages) > 0): ?>
							<?php echo e($garages->appends($_GET)->links()); ?>

						<?php endif; ?>
					</li>
					<li style="list-style: none;">
						<div class="p-2">
							<strong><?php echo e($per_page); ?></strong> result for <strong><?php echo e($garages->total()); ?></strong> Garages
						</div>
					</li>
				</ul>
			</div>
		</div>


		<!-- Main Page Content-->
		<div class="row">
			<!-- /left-filter-sidebar -->
			<aside class="col-lg-3" id="sidebar">
				<div id="filters_col">
					<form id="filterForm" method="get" action="<?php echo e(route('listings.search')); ?>">

						<input type="hidden" name="city_filter" value="" />
						<input type="hidden" name="distance_filter" value="" />
						<input type="hidden" name="category_filter" value="" />
						<div class="filter_type">
							<button type="submit" class="btn btn-sm  btn-success"><i class="fa fa-check-circle"></i> Apply</button>
							<button type="reset" class="btn btn-sm btn-danger float-right"><i class="fa fa-times"></i> Reset</button>

						</div>
						<br/>

						<a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters </a>
						<div class="collapse show" id="collapseFilters">
							<div class="filter_type">
					            <h6>Distance</h6>
					          	<div class="slidecontainer">
								  <input type="range" min="all" max="500" value="<?php echo e($distance_filters); ?>" class="slider" name="distance_filter" id="distance_filter_range">
								  <br/>
								  <p>Value: <span id="distance_filter_range_value"></span> KM<br/>
									 <small>Please select atleast one city to enable distance range.</small>
								  </p>

								</div>

					        </div>
							
							<div class="filter_type">
								<h6>City</h6>
								<ul>
									<li>
										<label class="container_check">All
										  <input type="checkbox" value="all" id="select_all_city" class="city_filter" <?php if($city_filters == 'all'): ?> checked <?php endif; ?>)>
										  <span class="checkmark"></span>
										</label>
									</li>
									<?php $__currentLoopData = $allCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li>
											<label class="container_check"><?php echo e($city['name']); ?>

											  <input type="checkbox" value="<?php echo e($city['id']); ?>" class="city_filter" <?php if($city_filters == $city['id'] ): ?> checked <?php endif; ?>)>
											  <span class="checkmark"></span>
											</label>
										</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							</div>

							<div class="filter_type">
								<h6>Category</h6>
								<ul>
									<li>
										<label class="container_check">All
										  <input type="checkbox" value="all" id="select_all_category" class="category_filter" <?php if(in_array('all', $category_filters) !== false ): ?> checked <?php endif; ?>)>
										  <span class="checkmark"></span>
										</label>
									</li>
									<?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li>
										<label class="container_check"><?php echo e($cat->name); ?>

										  <input type="checkbox" value="<?php echo e($cat->id); ?>"  class="category_filter" <?php if(in_array($cat->id, $category_filters) !== false ): ?> checked <?php endif; ?>)>
										  <span class="checkmark"></span>
										</label>
									</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							</div>
						</div>
					</form>
				</div>
			</aside>

			<div class="col-lg-9">
				<div class="row">
					<?php if(!empty($garages) && count($garages)): ?>
						<?php $__currentLoopData = $garages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-md-6 col-sm-12">
								<div class="strip grid">
									<figure>
										<a href="#" class="wish_bt"></a>
										<a href="<?php echo e(route('listings.workshops-garages.single',['slug' =>$garage['slug'] ])); ?>">
											<img src="<?php echo e(asset( $garage['profile_image'] )); ?>" class="img-fluid" alt="" width="400" height="266">
											<div class="read_more"><span>Read more</span></div>
										</a>
										<?php if($garage['is_feature'] == 1): ?>
											<small class="bg-danger">Premier Garage </small>
										<?php endif; ?>
									</figure>
									<div class="wrapper">
										<h3><a href="<?php echo e(route('listings.workshops-garages.single',['slug' =>$garage['slug'] ])); ?>"><?php echo e($garage->garages_name); ?></a></h3>
										<p> <b>Address:</b>
										<?php echo e($garage['address']); ?>, <?php echo e($allCities[$garage['city_id']]['name']); ?>, <?php echo e($countries[$garage['country_id']]['name']); ?>, <?php echo e($garage['postal']); ?></p>
									</div>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
						<div class="col-12 p-3">
							<div class="strip grid">
								<div class="alert alert-danger">
									<label><i class="fa fa-exclamation-circle"></i> No Garage found for this request </label>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>		

	</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
       $(function() {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.sign-in-modal').click(function(){
                $('#slug').val($(this).data('slug'));
                $('#page').val($(this).data('page'));
            });
        });
    </script>
    <script  defer src="https://maps.google.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places&" type="text/javascript"></script>

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
               $('#latitude').val(place.geometry['location'].lat());
               $('#longitude').val(place.geometry['location'].lng());

            // --------- show lat and long ---------------
               $("#lat_area").removeClass("d-none");
               $("#long_area").removeClass("d-none");
           });
       }

       // set value on load
	var slider = document.getElementById("distance_filter_range");
	var output = document.getElementById("distance_filter_range_value");
	output.innerHTML = slider.value;

	slider.oninput = function() {
		output.innerHTML = this.value;
	}

	$(document).ready(function() {

		// only one city is selected except all
		$('input.city_filter').on('change', function() {
		
			if($(this).is(':checked')){

				if($(this).val() == 'all'){
					$('input.city_filter').not(this).prop('checked', false);  
				}else{
					$('#select_all_city').prop('checked', false);  
				}
			}
		});

		// only one categort is selected except all
		$('input.category_filter').on('change', function() {
			if($(this).is(':checked')){
				if($(this).val() == 'all'){
					$('input.category_filter').not(this).prop('checked', false);  
				}else{
					$('#select_all_category').prop('checked', false);  
				}
			}
		});
	});

	$('#filterForm').submit(function() {
		
		var city_filter =   [];
        $.each($("input.city_filter:checked"), function(){            
            city_filter.push($(this).val());
        });
      	
	 	var distance_filter = [];
        distance_filter.push(slider.value);
        
      
        var  category_filter = [];
        $.each($("input.category_filter:checked"), function(){            
            category_filter.push($(this).val());
        });

	    $('#filterForm').find('input[name=city_filter]').val(city_filter);
	    $('#filterForm').find('input[name=distance_filter]').val(distance_filter);
	    $('#filterForm').find('input[name=category_filter]').val(category_filter);
	});

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/Projects/g2g-v3/resources/views/website/garages/listings.blade.php ENDPATH**/ ?>