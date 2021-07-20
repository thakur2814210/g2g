@extends('admin.layoutLlogin')
@section('content')
<style>
	.wrapper{
		display:  none !important;
	}
</style>
<div class="login-box">

  <div class="login-logo">

  	@if(empty($web_setting[15]->value))
        @if($web_setting[66]->value=='1' and $web_setting[67]->value=='0')
      		<img src="{{asset('images/admin_logo/logo-android-blue-v1.png')}}" class="ionic-hide">
        	<img src="{{asset('images/admin_logo/logo-ionic-blue-v1.png')}}" class="android-hide">
        @elseif($web_setting[66]->value=='1' and $web_setting[67]->value=='1' or $web_setting[66]->value=='0' and $web_setting[67]->value=='1')
   			<img src="{{asset('images/admin_logo/logo-laravel-blue-v1.png')}}" class="website-hide">
    	@endif
    @else
    	<img style="width: 60%" src="{{asset('').$web_setting[15]->value}}">
    @endif

    <div style="font-size: 25px;">
      {{ trans('labels.login_text') }}
    </div>

  </div>
  <!-- /.login-logo -->

    <!-- if email or password are not correct -->
    @if( count($errors) > 0)
      @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                  <span class="sr-only">{{ trans('labels.Error') }}:</span>
                  {{ $error }}
            </div>
         @endforeach
    @endif

    @if(Session::has('loginError'))
        <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">{{ trans('labels.Error') }}:</span>
              {!! session('loginError') !!}
        </div>
    @endif

    <div class="login-box-body">

          <p class="login-box-msg"> 
            <b> {{ trans('labels.welcome_message') }}</b>{{ trans('labels.welcome_message_to') }}
          </p>

          
          {!! Form::open(array('url' =>'admin/checkLogin', 'method'=>'post', 'class'=>'form-validate')) !!}

            <div class="form-group has-feedback">
              {!! Form::email('email', '', array('class'=>'form-control', 'id'=>'email')) !!}
              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.AdminEmailText') }}</span>
              <span class="help-block hidden"> {{ trans('labels.AdminEmailText') }}</span>
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            
            <div class="form-group has-feedback">
              <input type="password" name='password' class='form-control ' value="">
              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                       {{ trans('labels.AdminPasswordText') }}</span>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
            </div>
         
            <div class="row">
              <div class="col-xs-12">
                {!! Form::submit(trans('labels.login'), array('id'=>'login', 'class'=>'btn btn-primary btn-block btn-flat' )) !!}
              </div>
              
              
            </div>
            <br/>
            <div class="row">
              <div class="col-xs-12 text-center">
                <a href="/" class="text-red"><i class="fa fa-home" ></i> Back To Website</a>
              </div>
            </div>
          
          {!! Form::close() !!}
        </div>
</div>
