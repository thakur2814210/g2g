@extends('client::layouts.master')

@section('title', 'Client Dashboard')

@section('website_css')
    
@stop

@section('content')

 	<ol class="breadcrumb padding_bottom">
        <li class="breadcrumb-item">
          <a href="{{ route('client.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Profile</li>
    </ol>


	<div class="row">
      <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
         @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif
      </div>
    </div>

	<div class="card">
	    <div class="card-header">
          <i class="fa fa-user-circle"></i> Update Profile
        </div>
         
	          
      	<div class="card-body">
      		<ul class="list-group">
			  	<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-primary">
				   Username
				   <label>{{ $users->username }}</label>
				</li>
				<li class="list-group-item d-flex justify-content-between align-items-center">
				  Email
				    <label>{{ $users->email }}</label>
				  </li>
				  <li class="list-group-item d-flex justify-content-between align-items-center">
				    Phone
				   <label>{{ $users->phone }}</label>
				  </li>
				   <li class="list-group-item d-flex justify-content-between align-items-center">
					    Gender
					   <label>{{ $users->gender }}</label>
				  </li>
			</ul>
			
			<hr/>
	    	<div class="row">
	            <div class="col-12">
	            	
	                <form class="form-horizontal" action="{{ route('client.profile.update')}}" method="post">
						 {{ csrf_field() }}
						<div class="row">
							<div class="col-6">
								<div class="form-group">
			                        <label class=" text-danger"> *First name</label>
					                <input type="text" class="form-control" name="first_name" value="{{$users->first_name}}"  required=""/>
		                      	</div>
							</div>
							<div class="col-6">
								<div class="form-group">
			                        <label class=" text-danger"> *Last name</label>
					                 <input type="text" class="form-control" name="last_name" value="{{$users->last_name}}"  required=""/>
		                      	</div>
							</div>
						</div>
                      	              
                        <div class="form-group">
                        	<label class="text-danger"> *Address</label>
                            <input type="text"  name="address" id="autocomplete" class="form-control" value="{{$users->address}}" required="">
                        </div>

                         <div class="row">
							<div class="col-6">
								 <div class="form-group" id="lat_area">
		                            <label class="text-danger"> *Latitude </label>
		                            <input type="text" name="latitude" id="latitude" class="form-control" value="{{$users->latitude}}" readonly="" required="">
		                        </div>
							</div>
							<div class="col-6">
		                        <div class="form-group" id="long_area">
		                        	<label class="text-danger"> *Longitude</label>
		                            <input type="text" name="longitude" id="longitude" class="form-control" value="{{$users->longitude}}" readonly="" required="">
		                        </div>
							</div>
						</div>

                        <div class="row">
							<div class="col-4">
								<div class="form-group">
		                        	<label class=" text-danger"> *City</label>
									<select class="form-control" name="city" id="city" required="required">
								      <option value="">Select City</option>
								      @foreach($cities as $city)
								        <option value="{{$city->id }}" @if($city->id == $users->city ) selected @endif>{{ $city->name }}</option>
								      @endforeach
								    </select>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label class=" text-danger"> *Country</label>
									<select class="form-control" name="country" id="country" required="required">
								      <option value="">Select Country</option>
								      @foreach($countries as $country)
								        <option value="{{$country->id }}" @if($country->id == $users->country ) selected @endif>{{ $country->name }}</option>
								      @endforeach
								    </select>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label class=" text-danger"> *Pobox</label>
									<input type="number" class="form-control" name="postal" value="{{$users->postal}}" required="" />
								</div>
							</div>
						</div>

						
						<div class="row">
							<div class="col-4">
								<div class="form-group">
			                        <label class=" text-danger">Fax</label>
					                 <input type="text" class="form-control" name="fax" value="{{$users->fax}}"  />
		                      	</div>
							</div>
							<div class="col-4">
								<div class="form-group">
			                        <label class=" text-danger">Optional Mobile Number</label>
					                 <input type="text" class="form-control" name="mobile2" value="{{$users->mobile2}}"  />
		                      	</div>
							</div>
							<div class="col-4">
							 	<div class="form-group">
			                        <label class=" text-danger">Optional Phone Number</label>
					                 <input type="text" class="form-control" name="phone2" value="{{$users->phone2}}"  />
		                      	</div>
							</div>
						</div>

                     
	                    <div class="form-group">
                           	<div class="col-xs-12">
                              	<button class="btn btn-danger" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Update Profile</button>
                            </div>
	                    </div>
	              	</form>
	            </div>
	        </div>
		</div>
	</div>

	<div class="card">
		<div class="card-header card-header-custom">
			<p class="card-title"><i class="fa fas fa-user-circle"></i> Update Password</p>
		</div>

	    <div class="card-body table-responsive p-3">
	        <form class="form-horizontal" method="POST" action="{{ route('client.profile.update-password')}}">
	            {{ csrf_field() }}
	            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
	            <div class="form-group">
	              <label>New password</label>
	              <input class="form-control" type="password" name="password">
	            </div>
	            <div class="form-group">
	              <label>Confirm new password</label>
	              <input class="form-control" type="password" name="cpassword">
	            </div>
	            <div class="form-group">
	              <button type="submit" class="btn btn-danger" ><i class="fa faw fa-lock"></i> Update Password</button>
	            </div>
	        </form>
     	</div>
    </div>
@stop

@section('website_js')

	<script  defer src="https://maps.google.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places&language={{ $language}}" type="text/javascript"></script>

   <script>
       $(document).ready(function() {
            google.maps.event.addDomListener(window, 'load', initialize);
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