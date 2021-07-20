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

   
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">{{ trans('labels.Create new vendor account here') }}</p>

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

        <form name="signup" class="form-validate" enctype="multipart/form-data"  action="{{ URL::to('/signupProcess')}}" method="post">
                {{csrf_field()}}

                <div class="form-group">
                  <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.First Name')</label>
                  <div class="input-group  col-md-12">
                    <input  name="firstName" type="text" class="form-control field-validate" id="firstName" placeholder="@lang('website.Please enter your first name')" value="{{ old('firstName') }}">
                    
                  </div>
                </div>


                <div class="form-group">
                  <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Last Name')</label>
                  <div class="input-group  col-md-12">                    
                    <input  name="lastName" type="text" class="form-control field-validate field-validate" id="lastName" placeholder="@lang('website.Please enter your first name')" value="{{ old('lastName') }}">
                    <span class="help-block" hidden>@lang('website.Please enter your last name')</span>
                  </div>
                </div>
                  <div class="form-group">
                    <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Email Adrress')</label>
                    <div class="input-group col-md-12">
                      <input  name="email" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter Your Email or Username" value="{{ old('email') }}">
                      <span class="help-block" hidden>@lang('website.Please enter your valid email address')</span>
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Password')</label>
                      <div class="input-group col-md-12">
                        <input name="password" id="password" type="password" class="form-control"  placeholder="@lang('website.Please enter your password')">
                        <span class="help-block" hidden>@lang('website.Please enter your password')</span>

                      </div>
                    </div>
                    <div class="form-group">
                        <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Confirm Password')</label>
                        <div class="input-group col-md-12">
                          <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Enter Your Password">
                          <span class="help-block" hidden>@lang('website.Please re-enter your password')</span>
                          <span class="help-block" hidden>@lang('website.Password does not match the confirm password')</span>
                        </div>
                      </div>
                      <div class="form-group">
                       <label for="inlineFormInputGroup"><strong  style="color: red;">*</strong>@lang('website.Gender')</label>
                        <div class="input-group col-md-12">
                          <select class="form-control field-validate" name="gender" id="inlineFormCustomSelect">
                            <option selected value="">@lang('website.Choose...')</option>
                            <option value="0" @if(!empty(old('gender')) and old('gender')==0) selected @endif)>@lang('website.Male')</option>
                            <option value="1" @if(!empty(old('gender')) and old('gender')==1) selected @endif>@lang('website.Female')</option>
                          </select>
                          <span class="help-block" hidden>@lang('website.Please select your gender')</span>
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="input-group col-md-12">
                            <input required style="margin:4px;"class="form-controlt checkbox-validate" type="checkbox">
                            @lang('website.Creating an account means you are okay with our')  @if(!empty($result['commonContent']['pages'][3]->slug))&nbsp;<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][3]->slug)}}">@endif @lang('website.Terms and Services')@if(!empty($result['commonContent']['pages'][3]->slug))</a>@endif, @if(!empty($result['commonContent']['pages'][1]->slug))<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][1]->slug)}}">@endif @lang('website.Privacy Policy')@if(!empty($result['commonContent']['pages'][1]->slug))</a> @endif &nbsp; and &nbsp; @if(!empty($result['commonContent']['pages'][2]->slug))<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][2]->slug)}}">@endif @lang('website.Refund Policy') @if(!empty($result['commonContent']['pages'][3]->slug))</a>@endif.
                            <span class="help-block" hidden>@lang('website.Please accept our terms and conditions')</span>
                          </div>
                        </div>
                         <button type="submit" class="btn btn-primary btn-bllock">@lang('website.Create an Account')</button>
                  
              </form>

  </div>

  <!-- /.login-box-body -->
</div>