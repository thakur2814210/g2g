<div class="row">
	@if(!empty($garages) && count($garages))
		@foreach($garages as $garage)
			<div class="col-6">
				<div class="strip grid">
					<figure>
						<a href="#" class="wish_bt"></a>
						<a href="{{ route('listings.workshops-garages.single',['slug' =>$garage['slug'] ])}}">
							<img src="{{ asset( $garage['profile_image'] ) }}" class="img-fluid" alt="" width="400" height="266">
							<div class="read_more"><span>Read more</span></div>
						</a>
						@if($garage['is_feature'] == 1)
							<small class="bg-danger">Premier Garage </small>
						@endif
					</figure>
					<div class="wrapper">
						<h3><a href="{{ route('listings.workshops-garages.single',['slug' =>$garage['slug'] ])}}">{{ $garage->garages_name }}</a></h3>
						<p> <b>Address:</b>
						{{ $garage['address'] }}, {{ $allCities[$garage['city_id']]['name'] }}, {{ $countries[$garage['country_id']]['name'] }}, {{ $garage['postal'] }}</p>
					</div>
					<ul>
						<li><span class="loc_open">Now Open</span></li>
						<li><div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div></li>
					</ul>
				</div>
			</div>
		@endforeach
	@else
		<div class="col-12 p-3">
			<div class="strip grid">
				<div class="alert alert-danger">
					<label><i class="fa fa-exclamation-circle"></i> No Garage found for this request </label>
				</div>
			</div>
		</div>
	@endif
</div>

