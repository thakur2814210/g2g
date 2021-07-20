    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
        <?php $result['setting'] = DB::table('settings')->get(); ?>
    @if(empty($result['setting'][18]->value))
    <title>@lang('website.Ecommerce')</title>
    @else
    <title><?=stripslashes($result['setting'][18]->value)?></title>
    @endif

    @if(!empty($result['setting'][86]->value))
    <link rel="icon" href="{{asset('').$result['setting'][86]->value}}" type="image/gif">
    @endif
    <meta name="DC.title"  content="<?=stripslashes($result['setting'][73]->value)?>"/>
    <meta name="description" content="<?=stripslashes($result['setting'][75]->value)?>"/>
    <meta name="keywords" content="<?=stripslashes($result['setting'][74]->value)?>"/>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap" rel="stylesheet"> 

    <!--<link rel='stylesheet' href="web/css/fontawesome.css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  
    <link rel="stylesheet" href="{{asset('web/css/app')}}.css">
   

    <link rel="stylesheet" href="{{asset('web/css/responsive.css') }}">
    <link rel="stylesheet" href="{{asset('web/css/rtl.css')}}">

    <link rel="stylesheet" href="{{ asset('website-theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('website-theme/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('website-theme/css/color-red.css') }}">
    <link rel="stylesheet" href="{{ asset('website-theme/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('website-theme/css/custom-common.css') }}">   


    <style>
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
    </style>

    @if(\Config::get('app.locale') == 'ar')
        <style>
            .owl-carousel,
            .bx-wrapper { direction: ltr; }
            .owl-carousel .owl-item { direction: rtl; }
        </style>
    @endif

    

    <!---- onesignal ------>
    @if($result['setting'][54]->value=='onesignal')
    <link rel="manifest" href="{!! asset('onesignal/manifest.json') !!}" />
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
    var OneSignal = window.OneSignal || [];
      OneSignal.push(function() {
          //push here
      });

    //onesignal
    OneSignal.push(["init", {
      appId: "{{$result['setting'][55]->value}}",
     // safari_web_id: oneSignalSafariWebId,
      persistNotification: false,
      notificationClickHandlerMatch: 'origin',
      autoRegister: false,
      notifyButton: {
       enable: false
      }
     }]);

    </script>
    @endif

    @if(!empty($result['setting'][76]->value))
        <?=stripslashes($result['setting'][76]->value)?>
    @endif
