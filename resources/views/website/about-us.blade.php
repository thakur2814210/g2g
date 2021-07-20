@extends('website.layout')
@section('content')
  <section class="blog-content">
      <div class="container">
        <div class="blog-area margin_80_55">
          <main class="content-page">
            <div class="bg_color_1">
              <div class="container ">
                <div class="main_title_2" style="padding:10px;">
                  <h2>@lang('website.About Us')</h2>
                   <span><em></em></span>
                </div>
                <div class="row justify-content-between">
                
                  <div class="col-lg-12" style="padding-left: 20px;">
                    @if(\Config::get('app.locale') == 'en')
                      {!! $aboutUs->about_us_content_en !!}
                    @else
                      {!! $aboutUs->about_us_content_ar !!}
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </main>
      </div>
    </div>
  </section>

@endsection