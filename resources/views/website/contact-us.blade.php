@extends('website.layout')
@section('content')
<style type="text/css">
  #success, #fail{
  display: none;

}

#message, #success, #fail{
  margin-top: 10px;
  margin-bottom: 10px;
}
</style>
<!-- contact Content -->
<section class="contact-content contact-two-content">
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
            <div class="col-12 col-lg-8">
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
                        <input type="email"  name="email" class="form-control" id="validationCustomUsername" placeholder="@lang('website.Please enter your email address')" aria-describedby="inputGroupPrepend" required>
                        <span class="help-block error-content" hidden>@lang('website.Please enter your email address')</span>

                    </div>
                    <label for="email">@lang('website.Message')</label>
                    <textarea class="form-control" style="margin-bottom:0px;" type="text" name="message"  placeholder="@lang('website.Please enter your message')" rows="5" cols="56"></textarea>
                    <span class="help-block error-content" hidden>@lang('website.Please enter your message')</span>

                     <label for="email">{{ trans('labels.Pleaseverify') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="question"></span>
                        </div>
                        <input id="ans" class="form-control" type="text">
                         &nbsp;&nbsp;
                         <span id="success" class="help-block error-content">@lang('website.Validation complete')</span>
                          <span id="fail" class="help-block error-content">@lang('website.Validation failed')</span>
                    </div>
                    <br/>
                    
                   

                    <button type="submit" class="btn btn-secondary">@lang('website.Send') <i class="fas fa-location-arrow"></i></button>
                  </form>
              </div>
          </div>
          <div class="col-12 col-lg-4 contact-main">
            <div class="row">
              <div class="col-12">
                  <ul class="contact-logo">
                    <li> <i class="fas fa-mobile-alt"></i><br>{{ trans('labels.contactUsPage') }}<br/>
                        Mobile: {{$contactusinfo->phone}}<br/>
                        Office: {{$contactusinfo->mobile}}
                    </li>
                     <br/><br/>
                    <li> <i class="fas fa-map-marker"></i><br>{{ trans('labels.Address') }} <br/>
                      <div class="contact-address-span">{{( \Config::get('app.locale') == 'en' ) ? $contactusinfo->address_en : $contactusinfo->address_ar }}</div>
                    </li>
                    <br/><br/>
                    <li> <i class="fas fa-envelope"></i><br>{{ trans('labels.EmailAddress') }}<br/> 
                    <a href="mailto:{{$contactusinfo->email}}">{{$contactusinfo->email}}</a></li>
                   
                  </ul>
              </div>
            </div>


             <p style="margin-top:30px;">
              {{$result['commonContent']['setting'][112]->value}}
             </p>
          </div>


        </div>
      </div>
    </div>

  </div>
</section>



@endsection


@section('js')

<script type="text/javascript">

  var total;

  function getRandom(){return Math.ceil(Math.random()* 20);}
  function createSum(){
      var randomNum1 = getRandom(),
        randomNum2 = getRandom();
    total =randomNum1 + randomNum2;
    $( "#question" ).text( randomNum1 + " + " + randomNum2 + "=" );  
    $("#ans").val('');
    checkInput();
  }

  function checkInput(){
      var input = $("#ans").val(), 
        slideSpeed = 200,
        hasInput = !!input, 
        valid = hasInput && input == total;
      $('#message').toggle(!hasInput);
      $('button[type=submit]').prop('disabled', !valid);  
      $('#success').toggle(valid);
      $('#fail').toggle(hasInput && !valid);
  }

  $(document).ready(function(){
    //create initial sum
    createSum();
    // On "reset button" click, generate new random sum
    $('button[type=reset]').click(createSum);
    // On user input, check value
    $( "#ans" ).keyup(checkInput);
  });

</script>

@stop
