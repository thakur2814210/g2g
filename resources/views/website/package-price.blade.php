@extends('website.layout')
@section('content')

<style type="text/css" media="screen">
     #error-in-dialog{
        background: #fff;
        padding: 30px;
        padding-top: 0;
        text-align: left;
        max-width: 400px;
        margin: 40px auto;
        position: relative;
        box-sizing: border-box;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        border-radius: 4px;
    }

.pricing .card {
  border: none;
  border-radius: 1rem;
  transition: all 0.2s;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.pricing hr {
  margin: 1.5rem 0;
}

.pricing .card-title {
  margin: 0.5rem 0;
  font-size: 0.9rem;
  letter-spacing: .1rem;
  font-weight: bold;
}

.pricing .card-price {
  font-size: 3rem;
  margin: 0;
}

.pricing .card-price .period {
  font-size: 0.8rem;
}

.pricing ul li {
  margin-bottom: 1rem;
}

.pricing .text-muted {
  opacity: 0.7;
}

.pricing .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  opacity: 0.7;
  transition: all 0.2s;
}

/* Hover Effects on Card */

@media (min-width: 992px) {
  .pricing .card:hover {
    margin-top: -.25rem;
    margin-bottom: .25rem;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
  }
  .pricing .card:hover .btn {
    opacity: 1;
  }
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link{
  background: #f0151f;
}

</style>

	<section class="blog-content">
		  <div class="container ">
		    <div class="blog-area">
		    	<div class="bg_color_1">
		    	 <div class="main_title_2" style="padding:10px;margin-bottom:20px;">
				          <h2>@lang('website.buy_upgrade_package')</h2>
				           <span><em></em></span>
				        </div>

				
 

  <div class="box_general padding_bottom">
    <div class="header_box version_2">
    <ul class="nav nav-pills nav-justified text-uppercase">
        <li class="nav-item">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa fa-user-circle"></i> @lang('website.customer_package')</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa fa-building"></i> @lang('website.garage_package')</a>
        </li>
      </ul>
      <br/>
    </div>

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

    <div class="tab-content" id="pills-tabContent">

      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card padding_bottom text-center">
          <div class="card-header"><h4>@lang('website.Want custom service in your package')</h4> </div>
          <div class="card-body">
              <div class="row">

                <div class="col-12">
                   <label>@lang('website.No problem You can create custom package and send quote to Garage')</label><br/><br/>
                   @if(Auth::guard('customer')->check())
                      <a href="{{ route('client.custom-package')}}" class="btn1 btn-success text-uppercase p-2">@lang('website.custom_customer_package')</a>
                  @elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check())
                    <a href="#error-in-dialog"  class="login error-in-modal btn1 btn-success text-uppercase p-2" >@lang('website.custom_customer_package')</a>
                  @else
                    <a href="#sign-in-dialog" data-slug="custom-package" data-page="client-package-subscription" class="login sign-in-modal btn1 btn-success text-uppercase p-2" >@lang('website.custom_customer_package')</a>
                  @endif
                </div>
              </div>
          </div>
        </div>
        
        <br/>
        <div class="form-card">   
            @if(!empty($clientPackageData) && count($clientPackageData) > 0)
                <div class="row">
                   @foreach($clientPackageData as $package)
                  <!-- Free Tier -->
                  <div class="col-lg-4">
                      <div class="card mb-5 mb-lg-0">
                      
                            <div class="card-header text-center text-uppercase text-danger">
                               {{$package->section->name}} {{trans('website.Package')}}
                            </div>
                      
                          
                      
                        <div class="card-body">
                          <h4 class="card-title text-white text-uppercase text-center alert" style="background: #f0151f"> @if(\Config::get('app.locale') == 'en') {{ $package->name }}  @else {{ $package->name_ar }} @endif</h4>
                          <h6 class="text-center p-0">{{'AED '. $package->price }}  | (<span class="period">{{ $package->period }} {{trans('website.Days')}}</span>)</h6>
                          <hr>
                          <ul class="fa-ul">
                             @foreach($package->packageFeatures as $index => $features)
                                @php
                                  $pf_values = [];
                                  $features->feature_value = (\Config::get('app.locale') == 'en') ? $features->feature_value : $features->feature_value_ar;
                                  if (strpos($features->feature_value, ',') !== false) {
                                     $pf_values = explode(',', $features->feature_value);
                                  }else{
                                    $pf_values[] = $features->feature_value;
                                  }
                                @endphp

                                <li>
                                    <h6 style="padding: 0px;">
                                      <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> @if(\Config::get('app.locale') == 'en') {{ $features->feature_name }} @else {{ $features->feature_name_ar }} @endif
                                    </h6>
                                    @foreach($pf_values as $val)
                                      <label>{{ $val }}</label><br/>
                                    @endforeach
                                </li>
                                  
                              @endforeach
                          </ul>
                          <div class="text-center p-1">
                            
                           
                              @if(Auth::guard('customer')->check())
                                  <a href="{{ route('client.package-subscription.create',['category' => $package->section->slug])}}" class="btn btn-danger btn-block text-uppercase">@lang('website.select')</a>
                              @elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check())
                                <a href="#error-in-dialog"  class="login error-in-modal btn btn-danger btn-block text-uppercase" >@lang('website.select')</a>
                              @else
                                <a href="#sign-in-dialog" data-slug="{{$package->section->slug}}" data-page="client-package-subscription" class="login sign-in-modal btn btn-danger btn-block text-uppercase" >@lang('website.select')</a>
                              @endif
                           </div>
                        </div>
                      </div>
                  </div>
                  @endforeach

                </div>
              @else
              <p>@lang('website.No package for this request')</p>
            @endif

          </div>
        </div>


        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="form-card">                 
              
              @if(!empty($garagePackageData) && count($garagePackageData) > 0)
                  <div class="row">
                     @foreach($garagePackageData as $package)
                    <!-- Free Tier -->
                    <div class="col-lg-4">
                      <div class="card-header text-center text-uppercase text-danger">@lang('website.garage_package')</div>
                        <div class="card mb-5 mb-lg-0">
                          <div class="card-body">
                             <h4 class="card-title text-white text-uppercase text-center alert" style="background: #f0151f">@if(\Config::get('app.locale') == 'en') {{ $package->name }}  @else {{ $package->name_ar }} @endif</h4>
                          <h6 class="text-center p-0"> {{ 'AED '. $package->price }} | (<span class="period">{{ $package->period }} {{trans('website.Days')}}</span>)</h6>
                            <hr>
                            <ul class="fa-ul">
                               @foreach($package->packageFeatures as $index => $features)
                                  @php
                                    $pf_values = [];
                                    $features->feature_value = (\Config::get('app.locale') == 'en') ? $features->feature_value : $features->feature_value_ar;
                                    if (strpos($features->feature_value, ',') !== false) {
                                       $pf_values = explode(',', $features->feature_value);
                                    }else{
                                      $pf_values[] = $features->feature_value;
                                    }
                                  @endphp

                                  <li>
                                      <label><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> @if(\Config::get('app.locale') == 'en') {{ $features->feature_name }} @else {{ $features->feature_name_ar }} @endif</label>
                                      <br/>
                                      @foreach($pf_values as $val)
                                        {{ $val }}
                                      @endforeach
                                  </li>
                                    
                                @endforeach
                            </ul>
                            <div class="text-center p-1">
                             
                              @if(Auth::guard('vendor')->check())
                                  <a href="{{ route('garage.packages.buy_or_upgrade',['slug' => $package->slug ])}}" class="btn btn-danger btn-block text-uppercase">@lang('website.select')</a>
                              @elseif(Auth::guard('customer')->check() || Auth::guard('admin')->check())
                                <a href="#error-in-dialog"  class="login error-in-modal btn btn-danger btn-block text-uppercase" >@lang('website.select') sasa</a>
                              @else
                                <a href="#sign-in-dialog" data-slug="{{$package->slug}}" data-page="garage-package-subscription" class="login sign-in-modal btn btn-danger btn-block text-uppercase" >@lang('website.select')</a>
                              @endif

                              @if(Auth::guard('vendor')->check())
                                asdfsdfsd
                              @endif
                            </div>
                          </div>
                        </div>
                    </div>
                     <!-- Plus Tier -->
                    @endforeach
                  </div>
                @else
                <p>@lang('website.No package for this request')</p>
              @endif
            </div>
          </div>
        </div>
</div>
    </div>
  </div>
</div>
</section>	

 <style>
        #sign-in-dialog .form-group i{
            top:2.7rem !important;
        }
    </style>


<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header" style="width:100% !important">
        <span>{{trans('website.Sign In')}}</span>
    </div>
    <form action="{{ route('website.auth.sign-in-modal') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="slug" id="slug" value="">
        <input type="hidden" name="page" id="page" value="">
        <div class="sign-in-wrapper">
          
            <div class="form-group">
                  <p>{{trans('website.Email')}} / {{trans('website.Phone')}} / {{trans('website.Username')}}</p>
                  <input type="text" class="form-control" name="email" id="email" required>
                  <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
              <p>{{trans('website.Password')}}</p>
              <input type="password" class="form-control" name="password" id="password" value="" required>
              <i class="icon_lock_alt"></i>
            </div>
           <div class="text-center"><input type="submit" value="{{trans('website.Log In')}}" class="btn_1 full-width"></div>
        </div>
    </form>
</div>

@endsection

@section('js')
    <script type="text/javascript">
       $(function() {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.sign-in-modal').click(function(){
                $('#slug').val($(this).data('slug'));
                $('#page').val($(this).data('page'));
            });
        });
    </script>
@stop