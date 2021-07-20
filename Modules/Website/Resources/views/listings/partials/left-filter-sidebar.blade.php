<div id="filters_col">
	<form id="filterForm" method="get" action="{{ route('listings.search')}}">

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
				  <input type="range" min="all" max="500" value="{{$distance_filters}}" class="slider" name="distance_filter" id="distance_filter_range">
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
						  <input type="checkbox" value="all" id="select_all_city" class="city_filter" @if($city_filters == 'all') checked @endif)>
						  <span class="checkmark"></span>
						</label>
					</li>
					@foreach($allCities as $index => $city)
						<li>
							<label class="container_check">{{ $city['name'] }}
							  <input type="checkbox" value="{{ $city['id'] }}" class="city_filter" @if($city_filters == $city['id'] ) checked @endif)>
							  <span class="checkmark"></span>
							</label>
						</li>
					@endforeach
				</ul>
			</div>

			<div class="filter_type">
				<h6>Category</h6>
				<ul>
					<li>
						<label class="container_check">All
						  <input type="checkbox" value="all" id="select_all_category" class="category_filter" @if(in_array('all', $category_filters) !== false ) checked @endif)>
						  <span class="checkmark"></span>
						</label>
					</li>
					@foreach($all_categories as $index => $cat)
					<li>
						<label class="container_check">{{ $cat->name }}
						  <input type="checkbox" value="{{ $cat->id }}"  class="category_filter" @if(in_array($cat->id, $category_filters) !== false ) checked @endif)>
						  <span class="checkmark"></span>
						</label>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</form>
</div>
