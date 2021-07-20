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
					<div class="col-md-12 p-3">
						<div class="alert alert-danger">
							<b>Please wait... we are accessing your loaction to get the nearest garages.</b>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
@endsection


@section('js')
	@include('website.common.scripts.garages')


    <!--script>
      $.getJSON('https://geolocation-db.com/json/')
         .done (function(location) {
            //alert(location.country_name);
            var html = 'Current Location: ' + location.city + ', ' + location.state + ', ' + location.country_name + '( IP:' + location.IPv4 + ' )';
             $('#current_location').html(html);

            @if(Request::path() == 'listings/workshops-garages/all')
				 $.ajax({
			        url: "employees",
			        type: "post",
			        data: { id : $(this).val() },
			        success: function(data){
			            $("#employees").html(data);
			        }
			    });
			@endif
           // $('#state').html(location.state);
            //$('#city').html(location.city);
           // $('#latitude').html(location.latitude);
           //$('#longitude').html(location.longitude);
           // $('#ip').html(location.IPv4);
         });
    </script-->

   
@stop
