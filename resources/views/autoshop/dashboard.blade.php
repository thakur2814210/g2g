@extends('autoshop.layout')
@section('content')
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
    <br/>
     <div class="row">
       <div class="col-12 col-lg-3">
           <div class="heading">
               <h2>
                   @lang('website.My Account')
               </h2>
               <hr >
             </div>

           @include('autoshop.common.sidebar')
       </div>
       <div class="col-12 col-lg-9 ">
           <div class="heading">
               <h2>@lang('website.dashboard')</h2>
               <hr >
            </div>

            <div class="row">

        
              <div class="col-xl-6 col-sm-6 mb-3">
                <div class="card dashboard text-white bg-success o-hidden">
                  <div class="card-body">
                      <h3>#   {{ $sr_customer->count() }} </h3>
                      <h5 class="text-white">@lang('website.Service Request')</h5>
                  </div>
                   <div class="card-footer text-center" >
                     <a href="{{ URL::to('service-request/list')}}" class="text-white" data-toggle="tooltip" data-placement="bottom" title="@lang('website.View All') @lang('website.Service Request')">@lang('website.View All') @lang('website.Service Request') <i class="fa fa-arrow-circle-right"></i></a>
                   </div>
                </div>
              </div>

              <div class="col-xl-6 col-sm-6 mb-3">
                <div class="card dashboard text-white bg-primary o-hidden">
                  <div class="card-body">
                      <h3># {{ $ps_customer->count() }} </h3>
                     <h5 class="text-white">@lang('website.Package Subscription')</h5>
                  </div>
                   <div class="card-footer text-center" >
                     <a href="{{ URL::to('package-subscription/packages')}}" class="text-white"  data-toggle="tooltip" data-placement="bottom" title="@lang('website.View All') @lang('website.Package Subscription')">@lang('website.View All') @lang('website.Package Subscription') <i class="fa fa-arrow-circle-right"></i></a>
                   </div>
                </div>
              </div>
            </div> <!-- row ends -->
         <!-- ............the end..... -->
       </div>


     </div>
   </div>
 </section>
 @endsection
