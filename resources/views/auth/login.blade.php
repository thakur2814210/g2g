@extends('autoshop.layout')
@section('content')

<!-- login Content -->


<section class="page-area pro-content">
	<div class="container"> 

		<div class="row justify-content-center">	   
		  
		
		  <div class="col-12 col-sm-12 col-md-6">
			  
			<div class="col-12 my-5 px-0">

				<div class="justify-content-center">
				@if(Session::has('loginError'))
				    <div class="card bg-danger text-white">
                        <div class="card-body">	{!! session('loginError') !!}</div>
                     </div>
				@endif

				@if(Session::has('success'))
				 <div class="card bg-success text-white">
                    <div class="card-body">	{!! session('success') !!}</div>
                  </div>
				@endif

				@if( count($errors) > 0)
					@foreach($errors->all() as $error)
					     <div class="card bg-danger text-white">
                            <div class="card-body">{{ $error }}</div>
                         </div>
					@endforeach
				@endif

				@if(Session::has('error'))
				    <div class="card bg-danger text-white">
                        <div class="card-body">	{!! session('error') !!}</div>
                     </div>
				@endif

				@if(Session::has('email_verified'))
				    <div class="card bg-danger text-white">
                        <div class="card-body">	{!! session('email_verified') !!}</div>
                     </div>
                     <div class="col-12 text-center p-3">
                     <a href="{{ URL::to('/resend-verification-email')}}" class="btn btn-outline-secondary">@lang('website.Resend verification email')</a>
                     </div>
				@endif

			</div>
				
				 
				  <div class="tab-content" id="registerTabContent">
					<div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">




						<div class="registration-process">
							<div class="col-12 text-center">
								<h4 class="heading login-heading"> <i class="fa fa-universal-access" aria-hidden="true"></i> {{ trans('labels.login_text') }}</h4>
								<hr/>
								<br/>
							</div>

						<form  enctype="multipart/form-data"   action="{{ URL::to('/process-login')}}" method="post">
							{{csrf_field()}}


							<div class="from-group mb-3">
								<div class="col-12"> <label for="inlineFormInputGroup"><i class="fa fa-check-circle" aria-hidden="true"></i> @lang('website.User Type')</label></div>
								 <div class="input-group col-12">
								  <label><input type="radio" name="user_type" value="customer" checked>
								  	&nbsp;<i class="fa fa-users" aria-hidden="true"></i>
								  	{{trans('website.customer')}}</label>
								  &nbsp;&nbsp;&nbsp;&nbsp;
								  <label><input type="radio" name="user_type" value="garage">
								  	&nbsp;<i class="fa fa-building" aria-hidden="true"></i>
								  	{{trans('website.Garage/Vendor')}}</label>
								 </div>
							</div>


							<div class="from-group mb-3">
								<div class="col-12"> <label for="inlineFormInputGroup"><i class="fa fa-envelope" aria-hidden="true"></i> @lang('website.Email')/@lang('website.phone')</label></div>
								<div class="input-group col-12">
									<input type="text" name="email" id="email" placeholder="@lang('website.Please enter your valid email address')"class="form-control">
									<span class="help-block" hidden>@lang('website.Please enter your valid email address')</span>
								</div>
							</div>
						<div class="from-group mb-3">
								<div class="col-12"> <label for="inlineFormInputGroup"><i class="fa fa-key" aria-hidden="true"></i> @lang('website.Password')</label></div>
								<div class="input-group col-12">
									<input type="password" name="password" id="password" placeholder="{{trans('website.Please Enter Password')}}" class="form-control field-validate">
									<span class="help-block" hidden>@lang('website.This field is required')</span>										</div>
							</div>
							  <div class="col-12 col-sm-12 text-center">
								  <button class="btn btn-secondary btn-block swipe-to-top">@lang('website.Login')</button>
								<a href="{{ URL::to('/forgotPassword')}}" class="btn btn-link">@lang('website.Forgot Password')</a>

								
							  </div>
						</form>
						</div>
						
					</div>
				  </div>
			</div>
		  </div>

		</div>
	</div>
  </section>
@endsection
