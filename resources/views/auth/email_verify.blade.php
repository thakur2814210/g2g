@extends('website.layout')

@section('content')


<section class="page-area pro-content">
    <div class="container">
        <div class="row justify-content-center
            <div class="col-12 col-sm-12 col-md-12 justify-content-center" style"padding-top:30px;">
                @if(empty($customers))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="">@lang('website.Error'):</span>
                       @lang('website.failedConfirmEmail')

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif(!empty($customers))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="">@lang('website.success'):</span>
                        
                        @lang('website.successConfirmEmail')

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
    
            