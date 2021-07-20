@extends('website.layout')
@section('content')

	<div class="container">
		<div id="results">
   			<div class="container">
			   @include('website.garages.common.searchLocationBar')
   			</div>
		</div>
		<div class="filters_listing version_2  sticky_horizontal">
			@include('website.garages.common.paginationBar')
		</div>

		<div class="row">
			<aside class="col-lg-3" id="sidebar">
				@include('website.garages.common.leftSidebar')
			</aside>

			<div class="col-lg-9">
				<div class="row" id="garages-list">
					@if(!empty($garages) && count($garages))
						@foreach($garages as $garage)
						
							<div class="col-md-6 col-sm-12">
								<div class="strip grid">
									<figure>
										<a href="#" class="wish_bt"></a>
										<a href="{{ route('listings.workshops-garages.single',['slug' =>$garage['slug'] ])}}">
											<img src="{{ asset( $garage['profile_image'] ) }}" class="img-fluid" alt="" width="400" height="266">
											<div class="read_more"><span>{{trans('website.Read More')}}</span></div>
										</a>
										@if($garage['is_feature'] == 1)
											<small class="bg-danger">{{trans('website.Premier Garage')}} </small>
										@endif
									</figure>
									<div class="wrapper">
									    @php
									       // dd($garage);
									    @endphp
										<h3><a href="{{ route('listings.workshops-garages.single',['slug' =>$garage['slug'] ])}}">
										    {{ isset($garage['garages_name']) ? $garage['garages_name'] : '' }}
										 </a></h3>
										 @if(isset($garage['address']))
										<p> <b>{{trans('website.Address')}}:</b>
										{{ $garage['address'] }}, {{ $allCities[$garage['city_id']]['name'] }}, {{ $countries[$garage['country_id']]['name'] }}, {{ $garage['postal'] }}</p>
									    @endif
									</div>
								</div>
							</div>
							
						@endforeach
					@else
						<div class="col-12 p-3">
							<div class="strip grid">
								<div class="alert alert-danger">
									<label><i class="fa fa-exclamation-circle"></i>{{trans('website.No Garage found for this request')}}</label>
								</div>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>		

	</div>
@endsection


@section('js')
    @include('website.common.scripts.garages')
@stop
