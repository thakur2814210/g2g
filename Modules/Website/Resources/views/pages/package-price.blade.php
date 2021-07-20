@extends('website::layouts.page')

@section('website_css_pre')

@stop

@section('website_css')
    
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
@stop

@section('content')

	<div class="sub_header_in sticky_header">
		<div class="container">
			<h1>Buy/Upgrade Package</h1>
		</div>
	</div>

  <section class="pricing py-5">
      <div class="container">

  <div class="box_general padding_bottom">
    <div class="header_box version_2">
    <ul class="nav nav-pills nav-justified text-uppercase">
        <li class="nav-item">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa fa-user-circle"></i> Customer Package</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa fa-building"></i> Garage Package</a>
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
          <div class="card-header"><h4>Want custom service in your package ?</h4> </div>
          <div class="card-body">
              <div class="row">

                <div class="col-12">
                   <label>No problem, You can create custom package and send quote to Garage.</label><br/><br/>
                   @if(Auth::guard('client')->check())
                      <a href="{{ route('client.custom-package')}}" class="btn1 btn-success text-uppercase p-2">Customer Custom Package</a>
                  @elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check())
                    <a href="#error-in-dialog"  class="login error-in-modal btn1 btn-success text-uppercase p-2" >Customer Custom Package</a>
                  @else
                    <a href="#sign-in-dialog" data-slug="custom-package" data-page="client-package-subscription" class="login sign-in-modal btn1 btn-success text-uppercase p-2" >Customer Custom Package</a>
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
                      
                          <div class="card-header text-center text-uppercase text-danger">{{$package->section->name}} Package</div>
                      
                          
                      
                        <div class="card-body">
                          <h4 class="card-title text-white text-uppercase text-center alert" style="background: #f0151f">{{ $package->name }}</h4>
                          <h6 class="text-center p-0">AED {{ $package->price }}<span class="period">/{{ $package->period }} Days</span></h6>
                          <hr>
                          <ul class="fa-ul">
                             @foreach($package->packageFeatures as $index => $features)
                                @php
                                  $pf_values = [];
                                  if (strpos($features->feature_value, ',') !== false) {
                                     $pf_values = explode(',', $features->feature_value);
                                  }else{
                                    $pf_values[] = $features->feature_value;
                                  }
                                @endphp

                                <li>
                                    <h6 style="padding: 0px;">
                                      <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> {{ $features->feature_name }}
                                    </h6>
                                    @foreach($pf_values as $val)
                                      <label>{{ $val }}</label><br/>
                                    @endforeach
                                </li>
                                  
                              @endforeach
                          </ul>
                          <ul class="text-center">
                            
                            <li>
                              @if(Auth::guard('client')->check())
                                  <a href="{{ route('client.package-subscription.create',['category' => $package->section->slug])}}" class="btn btn-danger btn-block text-uppercase">Select</a>
                              @elseif(Auth::guard('admin')->check() || Auth::guard('vendor')->check())
                                <a href="#error-in-dialog"  class="login error-in-modal btn btn-danger btn-block text-uppercase" >Select</a>
                              @else
                                <a href="#sign-in-dialog" data-slug="{{$package->section->slug}}" data-page="client-package-subscription" class="login sign-in-modal btn btn-danger btn-block text-uppercase" >Select</a>
                              @endif
                            </li>
                          </ul>
                        </div>
                      </div>
                  </div>
                  @endforeach

                </div>
              @else
              <p> No package for this request.</p>
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
                      <div class="card-header text-center text-uppercase text-danger">Garage Package</div>
                        <div class="card mb-5 mb-lg-0">
                          <div class="card-body">
                             <h4 class="card-title text-white text-uppercase text-center alert" style="background: #f0151f">{{ $package->name }}</h4>
                          <h6 class="text-center p-0">AED {{ $package->price }}<span class="period">/{{ $package->period }} Days</span></h6>
                            <hr>
                            <ul class="fa-ul">
                               @foreach($package->packageFeatures as $index => $features)
                                  @php
                                    $pf_values = [];
                                    if (strpos($features->feature_value, ',') !== false) {
                                       $pf_values = explode(',', $features->feature_value);
                                    }else{
                                      $pf_values[] = $features->feature_value;
                                    }
                                  @endphp

                                  <li>
                                      <label><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> {{ $features->feature_name }}</label>
                                      <br/>
                                      @foreach($pf_values as $val)
                                        {{ $val }}
                                      @endforeach
                                  </li>
                                    
                                @endforeach
                            </ul>
                            <ul class="text-center p-1">
                             <li>
                              @if(Auth::guard('vendor')->check())
                                  <a href="{{ route('garage.packages.buy_or_upgrade',['slug' => $package->slug ])}}" class="btn btn-danger btn-block text-uppercase">Select</a>
                              @elseif(Auth::guard('client')->check() || Auth::guard('admin')->check())
                                <a href="#error-in-dialog"  class="login error-in-modal btn btn-danger btn-block text-uppercase" >Select</a>
                              @else
                                <a href="#sign-in-dialog" data-slug="{{$package->slug}}" data-page="garage-package-subscription" class="login sign-in-modal btn btn-danger btn-block text-uppercase" >Select</a>
                              @endif
                            </li>
                            </ul>
                          </div>
                        </div>
                    </div>
                     <!-- Plus Tier -->
                    @endforeach
                  </div>
                @else
                <p> No package for this request.</p>
              @endif
            </div>
          </div>
        </div>

    </div>
  </div>
</section>
@stop


@section('website_js')
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