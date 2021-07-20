@extends('website.layout')
@section('content')
<main>	
		<div class="container">

			<div id="results">
	   			<div class="container">
				   <div class="row">
					   	<div class="col-md-12">
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
	   			</div>
			</div>

			<div class="hero_in shop_detail" style="background: url({{asset( $garage->profile_image)}}) center center no-repeat;background-size: cover;">
				<div class="wrapper">
				<span class="magnific-gallery">
					<a href="{{ asset($garage->profile_image)}}" class="btn_photos" title="Photo title" data-effect="mfp-zoom-in">{{trans('website.View photos')}}</a>
				</span>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<section id="description">

						<div class="row">
							<div class="col-lg-12">
								<div class="opening add_bottom_30">
		                            <div class="ribbon bg-red">
		                                <span class="open">Featured</span>
		                            </div>
		                            <h1 class="text-center">{{ $garage->garages_name }}</h1>
		                            <hr/>
		                            {!! $garage->garages_description !!}
		                        </div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-8">
								<div class="main_title_2" style="padding:10px;">
				                  <h2 style="padding-bottom: 10px;">@lang('labels.Services')</h2>
				                   <span><em style="background-color: #B53327"></em></span>
				                </div>

				                <div class=" opening">
				                	<div class="row">
									@foreach($garageServices['mainCats'] as $mainCatId =>  $mainCat)

									<div class="col-lg-4">
										<ul class="bullets" >
											<li style="list-style: none;"><b>{{$mainCat}}</b></li>

											@if(isset($garageServices['subCats'][$mainCatId]))
												@foreach($garageServices['subCats'][$mainCatId] as $subCats)
													
														
												<li style="list-style: none;">{{$subCats}}</li>
														
													
												@endforeach
												
											@endif
										</ul>
									</div>
									@endforeach
								</div>
								</div>
							</div>

							<div class="col-md-4">

								<div class="main_title_2" style="padding:10px;">
				                  <h2 style="padding-bottom: 10px;">@lang('labels.Opening Hours')</h2>
				                   <span><em style="background-color: #B53327"></em></span>
				                </div>

				                <div class="opening add_bottom_30">
		                            <div class="ribbon">
		                                <span class="open">@lang('labels.Now Open')</span>
		                            </div>
		                            <i class="icon_clock_alt"></i>
		                            <h4>@lang('labels.Opening Hours')</h4>
		                            <hr/>
		                            <div class="row">
		                            	<div class="col-md-12">
		                            		<ul class="bullets" >
		                                        <li style="list-style: none;">@lang('labels.Monday') <span>@if(isset($garageworkingHours->mon) && $garageworkingHours->mon != 'Closed') {{ $garageworkingHours->mon}}  @else @lang('labels.Closed') @endif</span></li>
		                                        <hr/>
		                                        <li style="list-style: none;">@lang('labels.Tuesday') <span>@if(isset($garageworkingHours->mon) && $garageworkingHours->tue != 'Closed') {{ $garageworkingHours->tue}}  @else @lang('labels.Closed') @endif</span></li>
		                                         <hr/>
		                                        <li style="list-style: none;">@lang('labels.Wednesday') <span>@if(isset($garageworkingHours->mon) && $garageworkingHours->wed != 'Closed') {{ $garageworkingHours->wed}}  @else @lang('labels.Closed') @endif</span></li>
		                                         <hr/>
		                                        <li style="list-style: none;">@lang('labels.Thursday') <span>@if(isset($garageworkingHours->mon) && $garageworkingHours->thu != 'Closed') {{ $garageworkingHours->thu}}  @else @lang('labels.Closed') @endif</span></li>
		                                         <hr/>
		                                        <li style="list-style: none;">@lang('labels.Friday') <span>@if(isset($garageworkingHours->mon) && $garageworkingHours->fri != 'Closed') {{ $garageworkingHours->fri}}  @else @lang('labels.Closed') @endif</span></li>
		                                         <hr/>
		                                        <li style="list-style: none;">@lang('labels.Saturday') <span>@if(isset($garageworkingHours->mon) && $garageworkingHours->sat != 'Closed') {{ $garageworkingHours->sat}}  @else @lang('labels.Closed') @endif</span></li>
		                                         <hr/>
		                                        <li style="list-style: none;">@lang('labels.Sunday') <span>@if(isset($garageworkingHours->mon) && $garageworkingHours->sun != 'Closed') {{ $garageworkingHours->sun}}  @else @lang('labels.Closed') @endif</span></li>
		                                    </ul>
		                                </div>
		                               
		                            </div>
		                        </div>
							</div>
						</div>

						<div class="row">
							@if(count($garageimages) > 0)
								<div class="col-lg-12">
									<div class="main_title_2" style="padding:10px;">
					                  <h2 style="padding-bottom: 10px;">@lang('labels.Media Galllery')</h2>
					                   <span><em style="background-color: #B53327"></em></span>
					                </div>

					                <div class="grid-gallery opening">
										<ul class="magnific-gallery row ">
											@foreach($garageimages as $garageimage)
												<li class="col-md-6" style="padding: 10px;background-color:rgba(0, 77, 218, 0.05);">
													<figure>
														<img src="{{ asset($garageimage->image )}}" alt="">
														<figcaption>
															<div class="caption-content">
																<a href="{{ asset($garageimage->image )}}" title="Photo title" data-effect="mfp-zoom-in">
																	<i class="pe-7s-albums"></i>
																	<p>Garage Media</p>
																</a>
															</div>
														</figcaption>
													</figure>
												</li>
											@endforeach
										</ul>
									</div>
								</div>
							@endif

							@if(count($garageVideos) > 0)
								<div class="col-lg-12">
									<div class="main_title_2" style="padding:10px;">
					                  <h2 style="padding-bottom: 10px;">@lang('labels.Video Galllery')</h2>
					                   <span><em style="background-color: #B53327"></em></span>
					                </div>

					                <div class="grid-gallery opening">
										<ul class="magnific-gallery row ">
											@foreach($garageVideos as $garageVideo)
												<div class="col-md-6">
							                      <div class="embed-responsive embed-responsive-16by9">
							                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $garageVideo->yt_video_id}}?rel=0" allowfullscreen></iframe>
							                      </div>
							                      <br/>
							                 	 </div>
											@endforeach
										</ul>
									</div>
								</div>
							@endif
						</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="main_title_2" style="padding:10px;">
				                  <h2 style="padding-bottom: 10px;">@lang('labels.Location')</h2>
				                   <span><em style="background-color: #B53327"></em></span>
				                </div>
				                <div class="opening">
					                <h3>{{ $garage->address }}, {{ $allCities[$garage->city_id]['name'] }}, {{ $countries[$garage->country_id]['name'] }}, {{ $garage->postal }} </h3>
					                <iframe src="https://www.google.com/maps?q={{$garage->latitude}},{{$garage->longitude}}&hl=es;z=14&amp;output=embed" width="600" height="450" allowfullscreen id="map_iframe"></iframe>
					            </div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</main>

@endsection


@section('js')
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
    </script>
@stop
