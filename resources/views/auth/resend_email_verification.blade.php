@extends('autoshop.layout')
@section('content')

<!-- page Content -->
<section class="page-area">
  <div class="container">
      <div class="row justify-content-center">
         
        <div class="col-12 col-sm-12 col-md-6">
            <div class="col-12 my-5">
                <div class="card ">
                    <div class="card-header text-center" style="background:#cc0000;color:#fff">
                      <h4 style="margin:0px">{{trans('website.Resend verification email')}}</h4>
                    </div>
                    <div class="card-body"> 
                         @if(Session::has('error'))
                            <div class="card bg-danger text-white">
                                <div class="card-body">	{!! session('error') !!}</div>
                            </div>
                            <br/>
                         @endif
                        
                  	    @if( count($errors) > 0)
            				@foreach($errors->all() as $error)
            				 <div class="card bg-danger text-white">
                                <div class="card-body">{{ $error }}</div>
                            </div>
            				@endforeach
            				<br/>
            			@endif
                         <form name="signup" enctype="multipart/form-data" class="form-validate"  action="{{ URL::to('/processResendVerificationEmail')}}" method="post">
                            {{csrf_field()}}
                              <div class="from-group mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Email')</label></div>
                                <div class="input-group col-12">
                                  <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                  </div>
                                  <input class="form-control" type="email" name="email" id="email"placeholder="@lang('website.Please enter your valid email address')">
                                  <span class="help-block error-content" hidden>@lang('website.Please enter your valid email address')</span>                            </div>
                              </div>
                                <div class="col-12 col-sm-12">
                                    <button type="submit"  class="btn-block btn btn-secondary">@lang('website.Send')</button>
                                </div>
                          </form>
                    </div>
                </div>
          </div>
        </div>

      </div>
  </div>
</section>


@endsection
