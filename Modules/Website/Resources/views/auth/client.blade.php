@extends('website::layouts.page')

@section('website_css_pre')

@stop

@section('website_css')

@stop

@section('content')
	
	<main style="padding-top: 5%">

		<div class="container margin_60">
			<div class="row justify-content-center">
				<div class="col-xl-6 col-lg-6 col-md-8">
					<div class="card">
			          <div class="card-header p-0 text-center" style="padding:0px;">
			            <ul class="nav nav-tabs" id="pills-tab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="pills-signin-tab" data-toggle="pill" href="#pills-signin" role="tab" aria-controls="pills-signin" aria-selected="true"><i class="fa fas fa-sign-in"></i>  @lang('website::default.customer') @lang('website::default.sign_in')</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="pills-register-tab" data-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false"><i class="fa fas fa-registered"></i>  @lang('website::default.customer') @lang('website::default.register')</a>
						  </li>
						</ul>
			          </div>

			        <div class="card-body table-responsive p-3">

						<div class="tab-content" id="pills-tabContent">
						  
							<div class="tab-pane fade show active" id="pills-signin" role="tabpanel" aria-labelledby="pills-signin-tab">

								<div class="box_account">
									<h3 class="client">@lang('website::default.already_account')</h3>
									<form action="{{ route('client.authenticate') }}" method="post">
				                    	{{ csrf_field() }}
										<div class="form_container">

											 @if ($errors->any() || session('status'))
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
										     @endif

											<div class="form-group mb-3">
						                        <input id="email" type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="@lang('website::default.enter_email_phone')" name="email" value="{{ old('email') }}" required autofocus>
						                        <!--input type="email" name="email" class="form-control " value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus-->
						                        @if ($errors->has('email'))
						                            <div class="invalid-feedback">
						                                {{ $errors->first('email') }}
						                            </div>
						                        @endif
						                    </div>
						                    <div class="form-group mb-3">
						                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="@lang('website::default.password')">
						                        @if ($errors->has('password'))
						                            <div class="invalid-feedback">
						                                {{ $errors->first('password') }}
						                            </div>
						                        @endif
						                    </div>

											<div class="clearfix add_bottom_15">
												<div class="checkboxes float-left">
													<label class="container_check">@lang('website::default.remember_me')
														<input type="checkbox" name="remember" id="remember">
														<span class="checkmark"></span>
													</label>
												</div>
												<div class="float-right"><a id="forgot" href="javascript:void(0);">@lang('website::default.lost_password')</a></div>
											</div>

											<div class="text-center">
												<input type="submit" value="@lang('website::default.sign_in')" class="btn_1 full-width">
											</div>
											
											<!--div id="forgot_pw">
												<div class="form-group">
													<input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Type your email">
												</div>
												<p>A new password will be sent shortly.</p>
												<div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
											</div-->

										</div>
									</form>
								</div>
							</div>
						  
							<div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
								<div class="box_account">
									<h3 class="new_client">@lang('website::default.register_account')</h3> <small class="float-right pt-2">* @lang('website::default.required_fields')</small>
									<div class="form_container">
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
									      </div>
									    </div>
										<form action="{{ route('client.register') }}" method="post">
											{{ csrf_field() }}
											<div class="form-group">
												<input type="text" class="form-control" name="username" id="username" placeholder="* @lang('website::default.username')" value="{{Request::old('name')}}" required="">
											</div>
											<div class="form-group">
												<input type="email" class="form-control" name="email" id="email" placeholder="* @lang('website::default.email')" value="{{Request::old('email')}}" required="">
											</div>
											<div class="form-group">
												<input type="password" class="form-control" name="password" id="password" value="{{Request::old('password')}}" placeholder="* @lang('website::default.password')" required="">
											</div>
											<div class="row ">
												<div class="col-3">
													<div class="form-group">
														<input type="text" class="form-control"  value="971-5" readonly="">
													</div>
												</div>
												<div class="col-9">
													<div class="form-group">
														<input type="number" class="form-control" name="phone" id="phone"  min="8" value="" placeholder="* @lang('website::default.enter_phone')" value="{{Request::old('phone')}}" required="">
													</div>
												</div>
											</div>

											<div class="form-group">
												<input type="text" class="form-control" name="first_name" id="first_name" value="" placeholder="* @lang('website::default.first_name')" value="{{Request::old('first_name')}}" required="">
											</div>

											<div class="form-group">
												<input type="text" class="form-control" name="last_name" id="last_name" value="" placeholder="* @lang('website::default.last_name')" value="{{Request::old('last_name')}}" required="">
											</div>

											 <div class="form-group">
								               <div class="card shadow">
								                        <div class="card-body">
								                            <div class="form-group">
								                                <label for="autocomplete">* Location/City/Address </label>
								                                <input type="text"  name="address" id="autocomplete" class="form-control" placeholder="Select Location" required="">
								                            </div>

								                            <div class="form-group" id="lat_area">
								                                <label for="latitude"> Latitude </label>
								                                <input type="text" name="latitude" id="latitude" class="form-control" readonly="" required="">
								                            </div>

								                            <div class="form-group" id="long_area">
								                                <label for="latitude"> Longitude </label>
								                                <input type="text" name="longitude" id="longitude" class="form-control" readonly="" required="">
								                            </div>

								                            <div class="form-group">
																<select class="form-control" name="city" id="city" required="required">
															      <option value="">* Select City</option>
															      @foreach($cities as $city)
															        <option value="{{$city->id }}">{{ $city->name }}</option>
															      @endforeach
															    </select>
															</div>

															<div class="form-group">
																<select class="form-control" name="country" id="country" required="required">
															      <option value="">* Select Country</option>
															      @foreach($countries as $country)
															        <option value="{{$country->id }}">{{ $country->name }}</option>
															      @endforeach
															    </select>
															</div>

															<div class="form-group">
																  <input type="number" class="form-control" name="postal" placeholder="* Enter Postal" required="" />
															</div>
								                        </div>
								                    </div>
								              </div>


											
								           

										
											<div style="clear:both"></div>
											<div class="form-group">
												<label class="container_check">@lang('website::default.accept') <a href="{{ route('page.term-and-condtions') }}" target="_blank">@lang('website::default.terms_and_conditions')</a>
													<input type="checkbox">
													<span class="checkmark"></span>
												</label>
											</div>
											<div class="text-center">
												<input type="submit" value="@lang('website::default.register')" class="btn_1 full-width">
											</div>
										</form>
									</div>
									<!-- /form_container -->
								</div>	
							</div>
							<!-- /box_account -->
								<div class="row hidden_tablet">
									<div class="col-md-6">
										<ul class="list_ok">
											<li>@lang('website::default.feature_1')</li>
											<li>@lang('website::default.feature_2')</li>
											<li>@lang('website::default.feature_3')</li>
										</ul>
									</div>
									<div class="col-md-6">
										<ul class="list_ok">
											<li>@lang('website::default.feature_4')</li>
											<li>@lang('website::default.feature_5')</li>
										</ul>
									</div>
								</div>
						</div>
			        </div>
			    </div>
			</div>
		</div>
	</main>
	
	
@stop

@section('website_js')

	<script  defer src="https://maps.google.com/maps/api/js?key=AIzaSyB7FpjrldkyyNzh3o8QpRrPLNsdVAKn_kI&libraries=places&language={{ $language}}" type="text/javascript"></script>

   <script>
       $(document).ready(function() {
            $("#lat_area").addClass("d-none");
            $("#long_area").addClass("d-none");
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