@extends('website.layout')

@section('content')


<section class="page-area pro-content">
    <div class="container"> 

<div class="row justify-content-center">       
          
        
          <div class="col-12 col-sm-12 col-md-6">
              
            <div class="col-12 my-5 px-0">

                <div class="col-12 col-sm-12 col-md-12 justify-content-center">
                @if(Session::has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="">@lang('website.Error'):</span>
                        {!! session('loginError') !!}

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="">@lang('website.success'):</span>
                        {!! session('success') !!}

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if( count($errors) > 0)
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">@lang('website.Error'):</span>
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endforeach
                @endif

                @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">@lang('website.Error'):</span>
                        {!! session('error') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">@lang('website.Success'):</span>
                        {!! session('success') !!}

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

            </div>
                        
                 <div class="text-center alert alert-warning">
                    <h4 class="heading login-heading" style="color:  #f0151f;margin:0px;"> {{  trans('website.register_account') }}</h4>
                </div>
                <ul class="nav nav-tabs nav-justified" id="registerTab" role="tablist">
                    <li class="nav-item show @if(session('active_reg_tab') == 'customer') active @endif">
                      <a class="nav-link show @if(session('active_reg_tab') == 'customer') active @endif" id="customer-tab" data-toggle="tab" href="#customer" role="tab" aria-controls="customer" aria-selected="@if(session('active_reg_tab') == 'customer') true @endif">@lang('website.customer')</a>
                    </li>
                    <li class="nav-item show @if(session('active_reg_tab') == 'garage') active @endif">
                      <a class="nav-link @if(session('active_reg_tab') == 'garage') show active @endif" id="garage-tab" data-toggle="tab" href="#garage" role="tab" aria-controls="garage" aria-selected="@if(session('active_reg_tab') == 'garage') true @endif">@lang('website.garage')/@lang('labels.vendor')</a>
                    </li>
                    
                  </ul>

                  <div class="tab-content" id="registerTabContent">
                      
                      
                      
                    <div class="tab-pane @if(session('active_reg_tab') == 'customer')  show active @else fade @endif" id="customer" role="tabpanel" aria-labelledby="customer-tab">
                   
                        <div class="registration-process">
                        
                        
                        <form name="signup" enctype="multipart/form-data"  action="{{ URL::to('/signupProcess')}}" method="post">
                            {{csrf_field()}}

                            
                           


                             <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.username')</label></div>
                                <div class="input-group col-12">
                                    <input  name="userName" type="text" class="form-control field-validate" id="userName" placeholder="@lang('website.Please enter your user name')" value="{{ old('userName') }}" required>
                                    <span class="help-block" hidden>@lang('website.Please enter your user name')</span>
                                </div>
                            </div>
                            
                            <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"> @lang('website.company')</label></div>
                                <div class="input-group col-12">
                                    <input  name="company" type="text" class="form-control field-validate" id="company" placeholder="@lang('website.Please enter company name')" value="{{ old('company') }}">
                                    <span class="help-block" hidden>@lang('website.Please enter company name')</span>
                                </div>
                            </div>

                            <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.First Name')</label></div>
                                <div class="input-group col-12">
                                    <input  name="firstName" type="text" class="form-control field-validate" id="firstName" placeholder="@lang('website.Please enter your first name')" value="{{ old('firstName') }}" required>
                                    <span class="help-block" hidden>@lang('website.Please enter your first name')</span>
                                </div>
                            </div>
                            <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Last Name')</label></div>
                                <div class="input-group col-12">
                                    <input  name="lastName" type="text" class="form-control field-validate field-validate" id="lastName" placeholder="@lang('website.Please enter your first name')" value="{{ old('lastName') }}" required>
                                    <span class="help-block" hidden>@lang('website.Please enter your last name')</span>
                                </div>
                            </div>
                                <div class="from-group mb-3">
                                    <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Email Adrress')</label></div>
                                    <div class="input-group col-12">
                                        <input  name="email" type="email" class="form-control" id="inlineFormInputGroup" placeholder="@lang('website.Please enter your valid email address')" value="{{ old('email') }}" required>
                                        <span class="help-block" hidden>@lang('website.Please enter your valid email address')</span>
                                    </div>
                                </div>
                                 <div class="from-group mb-3">
                                    <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Phone')</label></div>
                                    <div class="input-group col-12">
                                        <input  name="phone" type="text" class="form-control" id="inlineFormInputGroup" placeholder="@lang('website.Please enter your valid phone number')" value="{{ old('phone') }}" required>
                                        <span class="help-block" hidden>@lang('website.Please enter your valid phone number')</span>
                                    </div>
                                </div>
                                <div class="from-group mb-3">
                                    <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Password')</label></div>
                                    <div class="input-group col-12">
                                        <input name="password" id="password" type="password" class="form-control"  placeholder="@lang('website.Please enter your password')" required>
                                        <span class="help-block" hidden>@lang('website.Please enter your password')</span>

                                    </div>
                                </div>
                                <div class="from-group mb-3">
                                        <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Confirm Password')</label></div>
                                        <div class="input-group col-12">
                                            <input type="password" class="form-control" id="re_password" name="re_password" placeholder="@lang('website.Please re-enter your password')" required>
                                            <span class="help-block" hidden>@lang('website.Please re-enter your password')</span>
                                            <span class="help-block" hidden>@lang('website.Password does not match the confirm password')</span>
                                        </div>
                                    </div>
                                    <div class="from-group mb-3">
                                        <div class="col-12" > <label for="inlineFormInputGroup"><strong  style="color: red;">*</strong>@lang('website.Gender')</label></div>
                                        <div class="input-group col-12">
                                            <select class="form-control field-validate" name="gender" id="inlineFormCustomSelect" required>
                                                <option selected value="">@lang('website.Choose...')</option>
                                                <option value="0" @if(!empty(old('gender')) and old('gender')==0) selected @endif)>@lang('website.Male')</option>
                                                <option value="1" @if(!empty(old('gender')) and old('gender')==1) selected @endif>@lang('website.Female')</option>
                                            </select>
                                            <span class="help-block" hidden>@lang('website.Please select your gender')</span>
                                        </div>
                                    </div>
                                    <div class="from-group mb-3">
                                        <div class="input-group col-12">
                                            <input required style="margin:4px;"class="form-controlt checkbox-validate" type="checkbox">
                                            <span>@lang('website.Creating an account means you are okay with our')  @if(!empty($result['commonContent']['pages'][3]->slug))&nbsp;<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][3]->slug)}}">@endif @lang('website.Terms and Services')@if(!empty($result['commonContent']['pages'][3]->slug))</a>@endif, @if(!empty($result['commonContent']['pages'][1]->slug))<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][1]->slug)}}">@endif @lang('website.Privacy Policy')@if(!empty($result['commonContent']['pages'][1]->slug))</a> @endif and @if(!empty($result['commonContent']['pages'][2]->slug))<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][2]->slug)}}">@endif @lang('website.Refund Policy') @if(!empty($result['commonContent']['pages'][3]->slug))</a>@endif.</span>
                                            <span class="help-block" hidden>@lang('website.Please accept our terms and conditions')</span>
                                        </div>
                                    </div>

                              <div class="col-12 col-sm-12">
                                <button type="submit" class="btn btn-danger btn-block swipe-to-top">{{trans('website.create_an_account')}}</button>
                            </div>
                        </form>
                        </div>
                        
                    </div>
                    <div class="tab-pane @if(session('active_reg_tab') == 'garage') show active @else fade @endif" id="garage" role="tabpanel" aria-labelledby="garage-tab">
                        <div class="registration-process">

                            <form name="signup" enctype="multipart/form-data"  action="{{ URL::to('/signupProcessVendor')}}" method="post">
                            {{csrf_field()}}

                             <div class="from-group mb-3">
                                 <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.select_garage_vendor')</label></div>
                                  <div class="input-group col-12">
                                         <select class="form-control" name="garage_vendor_type">
                                        <option value="">@lang('website.Choose...')</option>
                                        <option value="1">@lang('website.Garage Only')</option>
                                        <option value="2">@lang('website.Shop Vendor Only')</option>
                                         <option value="3" selected>@lang('website.Garage & Shop Vendor')</option>
                                      </select>

                                </div>
                            </div>

                             <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.username')</label></div>
                                <div class="input-group col-12">
                                    <input  name="userName" type="text" class="form-control field-validate" id="userName" placeholder="@lang('website.Please enter your user name')" value="{{ old('userName') }}">
                                    <span class="help-block" hidden>@lang('website.Please enter your user name')</span>
                                </div>
                            </div>
                            
                            <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.company')</label></div>
                                <div class="input-group col-12">
                                    <input  name="company" type="text" class="form-control field-validate" id="company" placeholder="@lang('website.Please enter company name')" value="{{ old('company') }}">
                                    <span class="help-block" hidden>@lang('website.Please enter company name')</span>
                                </div>
                            </div>

                            <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.First Name')</label></div>
                                <div class="input-group col-12">
                                    <input  name="firstName" type="text" class="form-control field-validate" id="firstName" placeholder="@lang('website.Please enter your first name')" value="{{ old('firstName') }}">
                                    <span class="help-block" hidden>@lang('website.Please enter your first name')</span>
                                </div>
                            </div>
                            <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Last Name')</label></div>
                                <div class="input-group col-12">
                                    <input  name="lastName" type="text" class="form-control field-validate field-validate" id="lastName" placeholder="@lang('website.Please enter your first name')" value="{{ old('lastName') }}">
                                    <span class="help-block" hidden>@lang('website.Please enter your last name')</span>
                                </div>
                            </div>
                                <div class="from-group mb-3">
                                    <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Email Adrress')</label></div>
                                    <div class="input-group col-12">
                                        <input  name="email" type="text" class="form-control" id="inlineFormInputGroup" placeholder="@lang('website.Please enter your valid email address')" value="{{ old('email') }}">
                                        <span class="help-block" hidden>@lang('website.Please enter your valid email address')</span>
                                    </div>
                                </div>
                                 <div class="from-group mb-3">
                                    <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Phone')</label></div>
                                    <div class="input-group col-12">
                                        <input  name="phone" type="text" class="form-control" id="inlineFormInputGroup" placeholder="@lang('website.Please enter your valid phone number')" value="{{ old('phone') }}">
                                        <span class="help-block" hidden>@lang('website.Please enter your valid phone number')</span>
                                    </div>
                                </div>
                                <div class="from-group mb-3">
                                    <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Password')</label></div>
                                    <div class="input-group col-12">
                                        <input name="password" id="password" type="password" class="form-control"  placeholder="@lang('website.Please enter your password')">
                                        <span class="help-block" hidden>@lang('website.Please enter your password')</span>

                                    </div>
                                </div>
                                <div class="from-group mb-3">
                                        <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Confirm Password')</label></div>
                                        <div class="input-group col-12">
                                            <input type="password" class="form-control" id="re_password" name="re_password" placeholder="@lang('website.Please re-enter your password')">
                                            <span class="help-block" hidden>@lang('website.Please re-enter your password')</span>
                                            <span class="help-block" hidden>@lang('website.Password does not match the confirm password')</span>
                                        </div>
                                    </div>
                                   
                                    <div class="from-group mb-3">
                                        <div class="input-group col-12">
                                            <input required style="margin:4px;"class="form-controlt checkbox-validate" type="checkbox">
                                            @lang('website.Creating an account means you are okay with our')  @if(!empty($result['commonContent']['pages'][3]->slug))&nbsp;<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][3]->slug)}}">@endif @lang('website.Terms and Services')@if(!empty($result['commonContent']['pages'][3]->slug))</a>@endif, @if(!empty($result['commonContent']['pages'][1]->slug))<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][1]->slug)}}">@endif @lang('website.Privacy Policy')@if(!empty($result['commonContent']['pages'][1]->slug))</a> @endif &nbsp; and &nbsp; @if(!empty($result['commonContent']['pages'][2]->slug))<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][2]->slug)}}">@endif @lang('website.Refund Policy') @if(!empty($result['commonContent']['pages'][3]->slug))</a>@endif.
                                            <span class="help-block" hidden>@lang('website.Please accept our terms and conditions')</span>
                                        </div>
                                    </div>

                              <div class="col-12 col-sm-12">
                                <button type="submit" class="btn btn-danger btn-block swipe-to-top">{{trans('website.create_an_account')}}</button>
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


<!--div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="/" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div-->

@endsection
