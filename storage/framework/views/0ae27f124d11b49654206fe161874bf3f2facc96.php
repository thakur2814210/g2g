<div id="results">
   <div class="container p-0">
	   <div class="row p-0">
		   <div class="col-12 p-0">
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
		   	  <!--form id="headerSearchForm" method="get" action="<?php echo e(route('listings.search-by-location')); ?>">

		   	  		<input type="hidden" id="hs_city_filter" name="city_filter" value="" />
					<input type="hidden" id="hs_distance_filter" name="distance_filter" value="" />
					<input type="hidden" id="hs_category_filter" name="category_filter" value="" />

				  
					<div class="row no-gutters custom-search-input-2 inner">
						<div class="col-lg-8">
							<div class="form-group">
								 <input type="text" id="autocomplete" class="form-control" placeholder="Location/City/Address">
								<i class="icon_search"></i>	
							</div>
							 <i class="pe-7s-edit toogle-distance-slider"></i>
                                <div class="distance-slider" style="display: none;">
                                    <div class="text-primary mb-2">Distance: <span id="distance-value">5</span>KM</div>
                                    <input id="thedistance" name="distance" type="range" min="0" max="1000" step="5" value="5" >
                                </div>
							
						</div>
						<div class="col-lg-3">
							<select class="wide" id="hs_category">
								<option value="all">All Categories</option>	
								<?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                	<option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="col-lg-1">
							<input type="submit" class="bg-danger" value="Search">
						</div>
					</div>
				</form-->
		   </div>
	   </div>
	   <!-- /row -->
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
		<!-- /search_mobile -->
   </div>
   <!-- /container -->
   
</div><?php /**PATH /home/devhs/public_html/g2g-v3/Modules/Website/Resources/views/listings/partials/header.blade.php ENDPATH**/ ?>