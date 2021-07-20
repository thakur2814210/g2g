@extends('website.layout')
@section('content')
  <section class="blog-content">
      <div class="container">
        <div class="blog-area margin_80_55">
          <main class="content-page">
            <div class="bg_color_1">
              <div class="container ">
                <div class="row justify-content-between">
                  <div class="col-lg-12 text-center alert alert-primary">
                    @if(empty($customers))
                        <div class="card text-center">
                          <div class="card-body"> 
                            <h4>{{trans('website.thank-you-confirm-mail-failed-message')}}</h4>
                            <h5>{{trans('website.thank-you-confirm-mail-try-again-text')}}</h5>
                          </div>
                          <div class="card-footer"><a href="{{URL::to('/register')}}" class="btn_1 rounded">@lang('website.register')</a></div>
                        </div>
                    @elseif(!empty($customers))
                        <div class="card text-center">
                          <div class="card-body"> 
                            <h5>{{trans('website.thank-you-confirm-mail-login-text')}}</h5>
                          </div>
                          <div class="card-footer"><a href="{{URL::to('/login')}}" class="btn_1 rounded">@lang('website.Login')</a></div>
                        </div>
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