<div class="row">
   	<div class="col-md-12">
   		 @if(Request::path() == 'listings/search-by-location')
		<p>
			<b>
				<i class="fa fa-map-marker" aria-hidden="true"></i>  
				<span id="current_location"></span>
			</b>
		</p>
		@endif
		<form method="get" action="{{ route('listings.search-by-location')}}">
	    	<div class="row no-gutters custom-search-input-2">
	            <input type="hidden" name="latitude" id="latitude" value="">
	            <input type="hidden" name="longitude" id="longitude" value="">
	            <div class="col-lg-7">
	                <div class="form-group">
	                    <input type="text" name="address" id="autocomplete" class="form-control" placeholder="{{trans('website.Location/City/Address')}}">
	                    <i class="icon_search"></i>
	                </div>
	                 <i class="pe-7s-edit toogle-distance-slider"></i>
	                <div class="distance-slider" style="display: none;">
	                    <div class="text-primary mb-2">{{trans('website.Distance')}}: <span id="distance-value">5</span>KM</div>
	                    <input id="thedistance" name="distance" type="range" min="0" max="1000" step="5" value="5" >
	                </div>
	            </div>
	            <div class="col-lg-3">
	                <select class="wide" name="category">
	                    <option value="all">{{trans('website.All Categories')}}</option>	
	                    @foreach($all_categories as $cat)
	                    	<option value="{{ $cat->id }}">{{ $cat->name }}</option>
	                    @endforeach
	                </select>
	            </div>
	            <div class="col-lg-2">
	                <input type="submit" value="{{trans('website.Search')}}">
	            </div>
	        </div>
	        <!-- /row -->
	    </form>
    </div>
</div>

<div class="search_mob_wp">
	<div class="custom-search-input-2">
		 <form method="get" action="{{ route('listings.search')}}">
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
						@foreach($all_categories as $cat)
                        	<option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
					</select>
				</div>
				<div class="col-lg-1">
					<input type="submit" class="bg-danger" value="Search">
				</div>
			</div>
		</form>
	</div>
</div>