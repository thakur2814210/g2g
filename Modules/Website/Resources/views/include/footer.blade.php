 <footer class="plus_border">
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h3 data-target="#collapse_ft_1" class="d-block d-sm-none">About G2G</h3>
                    <div class="collapse dont-collapse-sm" id="collapse_ft_1">
						<img class="mt-2 mb-3" src="{{ asset('website-theme/img/logo/logo-g2g.png') }}">
						<p>@lang('website::default.footer_text')</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h3 data-target="#collapse_ft_2">@lang('website::default.footer_quick_links')</h3>
                    <div class="collapse dont-collapse-sm" id="collapse_ft_2">
                        <ul class="links">
                            @if(Auth::guard('admin')->check())
                                  
                                @if(Auth::guard('admin')->check())
                                    <li><a href="{{ route('superadmin.dashboard')}}">@lang('website::default.dashboard')</a></li>
                                    <li><a href="{{ route('superadmin.logout')}}" >@lang('website::default.logout')</a></li>
                                @endif
                            @else
                                <li><a href="{{ route('superadmin.login') }}">@lang('website::default.admin_login')</a></li>
                            @endif
                           
                            <li><a href="{{ route('page.homepage')}}"> @lang('website::default.home') </a></li>
                            <li><a href="{{ route('page.about-us') }}">@lang('website::default.about_us')</a></li>
                            <li><a href="{{ route('listings.workshops-garages',['category' => 'all']) }}">@lang('website::default.workshop_garage')</a></li>
                            <li><a href="{{ route('page.package-price') }}"> @lang('website::default.packages')</a></li>
                            <li><a href="{{ route('page.faq') }}"> @lang('website::default.faq')</a></li>
                            <li><a href="{{ route('page.contact-us') }}"> @lang('website::default.contact_us')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h3 data-target="#collapse_ft_3">@lang('website::default.footer_categories')</h3>
                    <div class="collapse dont-collapse-sm" id="collapse_ft_3">
                        <ul class="links">
                            @foreach($main_categories as $category)
                                <li><a href="{{ route('listings.workshops-garages',['category' => $category->slug]) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h3 data-target="#collapse_ft_4">@lang('website::default.footer_contact_info')</h3>
                    <div class="collapse dont-collapse-sm" id="collapse_ft_4">
                        <ul class="contacts">
                            @if($contactusinfos->count())
                                @php
                                    $contactusinfo = $contactusinfos->first(); 
                                @endphp
                                <li><i class="ti-home"></i>
                                    @if(\Config::get('app.locale') == 'en')
                                        <a>{{ $contactusinfo->address_en }}</a>
                                    @else
                                        <a>{{ $contactusinfo->address_ar }}</a>
                                    @endif
                                </li>
                                <li><i class="ti-headphone-alt"></i>Office: {{ $contactusinfo->phone }}<br>Mobile: {{ $contactusinfo->mobile }}</li>
                                <li><i class="ti-email"></i><a href="mailto:info@g2g.ae">{{ $contactusinfo->email }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <hr>
            <div class="row">
                <div class="col-lg-12 ">
					<img src="{{asset('web/images/miscellaneous/payments.png')}}">
                    <ul id="additional_links">
                        <li><a href="{{ route('page.term-and-condtions') }}">@lang('website::default.terms_and_conditions')</a></li>
                        <li><a href="{{ route('page.privacy') }}">@lang('website::default.privacy')</a></li>
                        <li><span>G2G©@php echo date('Y'); @endphp</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>