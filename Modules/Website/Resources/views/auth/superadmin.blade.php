@extends('website::layouts.page')

@section('website_css_pre')

@stop

@section('website_css')

@stop

@section('content')
	
	<main style="padding-top: 5%;">

		<div class="container margin_60">
			<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="client">SuperAdmin Dashboard Login Here</h3>
					<form action="{{ route('superadmin.authenticate') }}" method="post">
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
						                  <div class="alert alert-danger">
						                      {{ session('status') }}
						                  </div>
						              @endif
						          </div>
						        </div>
						     @endif

							<div class="form-group mb-3">
		                        <input id="email" type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Enter Email Or Phone" name="email" value="{{ old('email') }}" required autofocus>
		                        <!--input type="email" name="email" class="form-control " value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus-->
		                        @if ($errors->has('email'))
		                            <div class="invalid-feedback">
		                                {{ $errors->first('email') }}
		                            </div>
		                        @endif
		                    </div>
		                    <div class="form-group mb-3">
		                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('adminlte::adminlte.password') }}">
		                        @if ($errors->has('password'))
		                            <div class="invalid-feedback">
		                                {{ $errors->first('password') }}
		                            </div>
		                        @endif
		                    </div>

							<div class="clearfix add_bottom_15">
								<div class="checkboxes float-left">
									<label class="container_check">Remember me
										<input type="checkbox" name="remember" id="remember">
										<span class="checkmark"></span>
									</label>
								</div>
								
							</div>

							<div class="text-center">
								<input type="submit" value="Log In" class="btn_1 full-width">
							</div>
						</div>
					</form>
				</div>
				
			</div>
		</div>
		<!-- /row -->
		</div>
		<!-- /container -->
	</main>
	<!--/main-->
	
	
@stop

@section('website_js')

@stop