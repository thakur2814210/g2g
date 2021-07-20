<!-- contact Content -->
<section class="contact-content contact-one-content">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12">
          <div class="row justify-content-end">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>

                    <li class="breadcrumb-item active" aria-current="page">@lang('website.Contact Us')</li>
                  </ol>
                </nav>
          </div>
      </div>
      <div class="col-12 col-sm-12">
        <div class="row">

          <div class="col-12 col-lg-3">
              <div class="heading">
                  <h2>
                   @lang('website.Contact Us')
                  </h2>
                  <hr style="margin-bottom: 0;">
                </div>
              <div class="">
                  <ul class="contact-info pl-0 mb-0"  >
                      <li> <i class="fas fa-mobile-alt"></i><span>{{$result['commonContent']['setting'][11]->value}}</span> </li>
                      <li> <i class="fas fa-map-marker"></i><span>{{$result['commonContent']['setting'][4]->value}} {{$result['commonContent']['setting'][5]->value}} {{$result['commonContent']['setting'][6]->value}}, {{$result['commonContent']['setting'][7]->value}} {{$result['commonContent']['setting'][8]->value}}</span> </li>
                      <li> <i class="fas fa-envelope"></i><span> <a href="mailto:{{$result['commonContent']['setting'][3]->value}}">{{$result['commonContent']['setting'][3]->value}}</a><br><a href="#">{{$result['commonContent']['setting'][3]->value}}</a> </span> </li>
                      <li> <i class="fas fa-tty"></i><span><a href="mailto:{{$result['commonContent']['setting'][3]->value}}">{{$result['commonContent']['setting'][3]->value}}</a> </span> </li>

                    </ul>
                </div>

                <div class="socials">
                    <div class="heading">
                        <h2>
                         @lang('website.Follow Us')
                        </h2>
                        <hr style="margin-bottom: 0;">
                      </div>
                      <ul class="list">
                      	<li>
                          	@if(!empty($result['commonContent']['setting'][50]->value))
                          		<a href="{{$result['commonContent']['setting'][50]->value}}" class="fab fa-facebook-f" target="_blank"></a>
                              @else
                              	<a href="#" class="fab fa-facebook-f"></a>
                              @endif
                          </li>
                          <li>
                          @if(!empty($result['commonContent']['setting'][52]->value))
                              <a href="{{$result['commonContent']['setting'][52]->value}}" class="fab fa-twitter" target="_blank"></a>
                          @else
                              <a href="#" class="fab fa-twitter"></a>
                          @endif</li>
                          <li>
                          @if(!empty($result['commonContent']['setting'][51]->value))
                              <a href="{{$result['commonContent']['setting'][51]->value}}" class="fab fa-google" target="_blank"></a>
                          @else
                              <a href="#" class="fab fa-google"></a>
                          @endif
                          </li>
                          <li>
                          @if(!empty($result['commonContent']['setting'][53]->value))
                              <a href="{{$result['commonContent']['setting'][53]->value}}" class="fab fa-linkedin-in" target="_blank"></a>
                          @else
                              <a href="#" class="fab fa-linkedin-in"></a>
                          @endif
                          </li>
                      </ul>
                </div>

          </div>
          <div class="col-12 col-lg-5">
              <div class="heading">
                  <h2>
                   OUR LOCATION
                  </h2>
                  <hr style="margin-bottom: 0;">
                </div>
                <div id="map" style="height:400px; margin:15px auto;">

                </div>
                <script>
                  var map;
                  function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                      center: {lat: -34.397, lng: 150.644},
                      zoom: 8
                    });
                  }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"
                async defer></script>
                <p>
                    {{$result['commonContent']['setting'][112]->value}}
                </p>
          </div>
          <div class="col-12 col-lg-4">
              <div class="heading">
                  <h2>
                   WRITE US
                  </h2>
                  <hr style="margin-bottom: 0;">
                </div>
                <div class="form-start">
                  @if(session()->has('success') )
                     <div class="alert alert-success">
                         {{ session()->get('success') }}
                     </div>
                  @endif
                    <form enctype="multipart/form-data" action="{{ URL::to('/processContactUs')}}" method="post">
                      <input name="_token" value="{{ csrf_token() }}" type="hidden">

                      <label class="first-label" for="email">@lang('website.Full Name')</label>
                      <div class="input-group">

                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" id="name" name="name" placeholder="@lang('website.Please enter your name')" aria-describedby="inputGroupPrepend" required>
                          <span class="help-block error-content" hidden>@lang('website.Please enter your name')</span>
                      </div>
                      <label for="email">@lang('website.Email')</label>
                      <div class="input-group">

                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-at"></i></span>
                          </div>
                          <input type="email"  name="email" class="form-control" id="validationCustomUsername" placeholder="Enter Email here.." aria-describedby="inputGroupPrepend" required>
                          <span class="help-block error-content" hidden>@lang('website.Please enter your valid email address')</span>

                      </div>
                      <label for="email">@lang('website.Message')</label>
                      <textarea type="text" name="message"  placeholder="write your message here..." rows="5" cols="56"></textarea>
                      <span class="help-block error-content" hidden>@lang('website.Please enter your message')</span>
                      <button type="submit" class="btn btn-secondary">@lang('website.Send') <i class="fas fa-location-arrow"></i></button>
                    </form>
                </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
