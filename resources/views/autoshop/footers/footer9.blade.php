<!-- //footer style Nine   -->
<footer id="footerNine"  class="footer-area footer-nine footer-desktop d-none d-lg-block d-xl-block">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6 col-lg-6">
              <div class="row">
                <div class="col-6">
                    <div class="footer-image mb-4">
                      <h5>@lang('DOWNLOAD OUR APP')</h5>
                      <a href="{{$result['commonContent']['setting'][109]->value}}"><img class="img-fluid" src="{{asset('web/images/miscellaneous/google-play-btn.png')}}"></a>
                      <a href="{{$result['commonContent']['setting'][110]->value}}"><img class="img-fluid" src="{{asset('web/images/miscellaneous/app-store-btn.png')}}"></a>
                    </div>
                    <div class="footer-image mb-3">
                        <h5>We Using safe payments</h5>
                          <img class="img-fluid" src="{{asset('web/images/miscellaneous/payments.png')}}">
                      </div>
                </div>
                <div class="col-6">
                    <h5>TAGS</h5>
                    <ul class="links-tag pl-0 mb-0">
                      @if(!empty($result['categories']))
                       @foreach($result['categories'] as $category)
                        <li> <a href="{{url('shop?category=').$category->slug}}">{{$category->categories_name}}</a> </li>
                       @endforeach
                      @endif
                      </ul>
                </div>
              </div>
          </div>
          <div class="col-12 col-md-6 col-lg-6">
            <div class="row">
              <div class="col-12 col-md-6 col-lg-3">
                <div class="single-footer single-footer-left">
                  <h5>@lang('website.Our Services')</h5>
                  <div class="row">
                      <div class="col-12 col-lg-8">
                        <hr>
                      </div>
                    </div>
                  <ul class="links-list pl-0 mb-0">
                    <li> <a href="{{ URL::to('/')}}"><i class="fa fa-angle-right"></i>Home</a> </li>
                  <li> <a href="{{ URL::to('/shop')}}"><i class="fa fa-angle-right"></i>Shop</a> </li>
                  <li> <a href="{{ URL::to('/orders')}}"><i class="fa fa-angle-right"></i>Orders</a> </li>
                  <li> <a href="{{ URL::to('/viewcart')}}"><i class="fa fa-angle-right"></i>Shopping Cart</a> </li>
                  <li> <a href="{{ URL::to('/wishlist')}}"><i class="fa fa-angle-right"></i>Wishlist</a> </li>
                  </ul>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <h5>@lang('website.Our Services')</h5>
                <div class="row">
                    <div class="col-12 col-lg-8">
                      <hr>
                    </div>
                </div>
                <ul class="links-list pl-0 mb-0">
                  @if(count($result['commonContent']['pages']))
                      @foreach($result['commonContent']['pages'] as $page)
                          <li> <a href="{{ URL::to('/page?name='.$page->slug)}}"><i class="fa fa-angle-right"></i>{{$page->name}}</a> </li>
                      @endforeach
                  @endif
                      <li> <a href="{{ URL::to('/contact')}}"><i class="fa fa-angle-right"></i>@lang('website.Contact Us')</a> </li>
                </ul>
              </div>
              <div class="col-12 col-lg-5">
                  <h5>@lang('Contact Us')</h5>
                  <div class="row">
                      <div class="col-12 col-lg-8">
                        <hr>
                      </div>
                  </div>
                  <ul class="contact-list  pl-0 mb-0">
                    <li> <i class="fas fa-map-marker"></i><span>{{$result['commonContent']['setting'][4]->value}} {{$result['commonContent']['setting'][5]->value}} {{$result['commonContent']['setting'][6]->value}}, {{$result['commonContent']['setting'][7]->value}} {{$result['commonContent']['setting'][8]->value}}</span> </li>
                    <li> <i class="fas fa-phone"></i><span>({{$result['commonContent']['setting'][11]->value}})</span> </li>
                    <li> <i class="fas fa-envelope"></i><span> <a href="mailto:sales@brandbychoice.com">{{$result['commonContent']['setting'][3]->value}}</a> </span> </li>
                  </ul>

              </div>
            </div>

          </div>

        </div>

      </div>
      <div class="container-fluid p-0">
          <div class="social-content">
              <div class="container">
                <div class="social-div">
                  <div class="row align-items-center">

                    <div class="col-12 col-md-8">
                      <div class="newsletter">

                          <div class="footer-info">
                            &copy;&nbsp;2019 Company, Inc.  <a href="{{url('/page?name=refund-policy')}}">@lang('website.Privacy')</a>&nbsp;&bull;&nbsp;<a href="{{url('/page?name=term-services')}}">@lang('website.Terms')</a>
                          </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="socials">
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
                                  <a href="{{$result['commonContent']['setting'][51]->value}}"  target="_blank"><i class="fab fa-google"></i></a>
                              @else
                                  <a href="#"><i class="fab fa-google"></i></a>
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
                  </div>
              </div>
              </div>
          </div>
      </div>
</footer>
