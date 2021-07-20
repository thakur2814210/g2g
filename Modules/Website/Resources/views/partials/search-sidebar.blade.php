<aside class="col-lg-3" id="sidebar">
	<div id="filters_col">
		<a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters </a>
		<div class="collapse show" id="collapseFilters">
			<div class="filter_type">
				<h6>Category</h6>
				<ul>
					@foreach($all_categories as $cat)
					<li>
						<label class="container_check">{{ $cat->name }}
						  <input type="checkbox" value="{{ $cat->id }}" name="category[]">
						  <span class="checkmark"></span>
						</label>
					</li>
					@endforeach
				</ul>
			</div>
			<div class="filter_type">
				<h6>City</h6>
				<ul>
					@foreach($allCities as $city)
					<li>
						<label class="container_check">{{ $city['name'] }}
						  <input type="checkbox" value="{{ $city['id'] }}" name="city[]">
						  <span class="checkmark"></span>
						</label>
					</li>
					@endforeach
				</ul>
			</div>
			<div class="filter_type">
                <h6>Distance</h6>
                <ul>
					<li>
						<label class="container_check">10 Km
						  <input type="checkbox" value="10" name="distance[]">
						  <span class="checkmark"></span>
						</label>
					</li>
					<li>
						<label class="container_check">15 Km
						  <input type="checkbox" value="10" name="distance[]">
						  <span class="checkmark"></span>
						</label>
					</li>
					<li>
						<label class="container_check">15 Km
						  <input type="checkbox" value="20" name="distance[]">
						  <span class="checkmark"></span>
						</label>
					</li>
					<li>
						<label class="container_check">25 Km
						  <input type="checkbox" value="25" name="distance[]">
						  <span class="checkmark"></span>
						</label>
					</li>
					<li>
						<label class="container_check">30 Km
						  <input type="checkbox" value="30" name="distance[]">
						  <span class="checkmark"></span>
						</label>
					</li>
				</ul>
            </div>
		</div>
	</div>
</aside>