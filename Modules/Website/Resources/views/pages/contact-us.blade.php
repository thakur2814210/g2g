@extends('website::layouts.page')

@section('website_css_pre')

@stop

@section('website_css')
	 <style>
      /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
@stop

@section('content')
	
	<main>
		<!-- /map -->
		<div id="map"></div>
		
		
			<div class="row justify-content-center margin_60_35">
				
				<div class="col-xl-5 col-lg-6 pr-xl-5">
					<div class="main_title_3">
						<span></span>
						<h2>@lang('website::default.send_us_message')</h2>
					</div>
					<div id="message-contact"></div>
					<form method="post" action="assets/contact.php" id="contactform" autocomplete="off">
						
						<div class="form-group">
							<label>@lang('website::default.full_name')</label>
							<input class="form-control" type="text" id="name_contact" name="name_contact">
						</div>

						<div class="form-group">
							<label>@lang('website::default.email')</label>
							<input class="form-control" type="email" id="email_contact" name="email_contact">
						</div>
						
						<div class="form-group">
							<label>@lang('website::default.phone')</label>
							<input class="form-control" type="text" id="phone_contact" name="phone_contact">
						</div>
						<!-- /row -->
						<div class="form-group">
							<label>@lang('website::default.message')</label>
							<textarea class="form-control" id="message_contact" name="message_contact" style="height:120px;"></textarea>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>@lang('website::default.send_us_message_validation') 3 + 1 =</label>
									<input class="form-control" type="text" id="verify_contact" name="verify_contact">
								</div>
							</div>
						</div>
						<p class="add_top_30"><input type="button" value="Submit" class="btn_1" id="submit-contact"></p>
					</form>
				</div>
				@if($contactusinfos->count())
					@php 
						$contactusinfo = $contactusinfos->first(); 
					@endphp
					<div class="col-xl-5 col-lg-6 pl-xl-5">
						<div class="box_contacts">
							<i class="ti-email"></i>
							<h2>@lang('website::default.email')</h2>
							<a href="mailto:{{ $contactusinfo->email }}">{{ $contactusinfo->email }}</a>
						</div>
						<div class="box_contacts">
							<i class="ti-headphone"></i>
							<h2>@lang('website::default.phone')</h2>
							Office: <a href="tel:{{ $contactusinfo->phone }}">{{ $contactusinfo->phone }}</a><br>Mobile: <a href="tel:{{ $contactusinfo->mobile }}">{{ $contactusinfo->mobile }}</a>
						</div>
						<div class="box_contacts">
							<i class="ti-home"></i>
							<h2>@lang('website::default.address')</h2>
							@if(\Config::get('app.locale') == 'en')
								<a>{{ $contactusinfo->address_en }}</a>
							@else
								<a>{{ $contactusinfo->address_ar }}</a>
							@endif
							
						</div>
					</div>
				@endif
			</div>
	</main>
	
	
	
@stop

@section('website_js')
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&callback=initMap">
    </script>
 <script>
	// Initialize and add the map
	function initMap() {
	  // The location of Uluru
	  var uluru = {lat: {{$contactusinfo->latitude}}, lng: {{$contactusinfo->longitude}}};
	  // The map, centered at Uluru
	  var map = new google.maps.Map(
	      document.getElementById('map'), {zoom: 14, center: uluru});
	  // The marker, positioned at Uluru
	  var marker = new google.maps.Marker({position: uluru, map: map});
	}
 </script>


@stop