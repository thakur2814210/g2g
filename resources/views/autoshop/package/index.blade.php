@extends('autoshop.layout')
@section('content')
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
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

          <div class="box_general padding_bottom">
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-list"></i> @lang('website.Package Subscription') @lang('website.List')</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                         <tr style="background: #e9ecef">
                          <th>#</th>
                          <th>@lang('website.Amount')</th>
                          <th>@lang('website.Vehicle')</th>
                          <th>@lang('website.Package')</th>
                          <th>@lang('website.Garage')</th>
                           <th>@lang('website.Start At') | @lang('website.End At')</th>
                          <th>@lang('website.Status')</th>
                          <th width="20%">@lang('website.Action')</th>
                        </tr>
                      </thead>
                      <tfoot>
                         <tr style="background: #e9ecef">
                            <th>#</th>
                             <th>@lang('website.Amount')</th>
                          <th>@lang('website.Vehicle')</th>
                          <th>@lang('website.Package')</th>
                          <th>@lang('website.Garage')</th>
                          <th>@lang('website.Start At') | @lang('website.End At')</th>
                          <th>@lang('website.Status')</th>
                          <th width="20%">@lang('website.Action')</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      @if(!empty($packages) && count($packages) > 0)
                        @foreach($packages as $index => $package)
                          <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>AED {{ $package->amount }}</td>
                            <td> {{ $package->vehicle->plate_no }}</td>
                            <td>{{ ( \Config::get('app.locale') == 'en' ) ? $package->service_package_name : $package->service_package_name_ar }}</td>
                            <td>{{ $package->garage }}</td>
                            <td>
                                  @if(!empty($package->subscription_start_at) && !empty($package->subscription_start_at))
                                    {{ date('M d, Y', strtotime($package->subscription_start_at)) }} | {{ date('M d, Y', strtotime($package->subscription_start_at)) }}
                                  @else
                                    {{ trans('website.Not Available')}}
                                  @endif
                            </td>
                            <td>
                              {{ trans('website.'.$packageStatus[$package->status]) }}
                            </td>
                            <td>

                                    @if($package->servicePackage->slug == 'custom-package')
                                      <a class="btn btn-sm btn-outline-danger " href="{{ URL::to('/custom-package/settings/'.$package->id)}}">
                                        @lang('website.Update')
                                      </a>
                                    @else
                                      <a class="btn btn-sm btn-outline-danger "  href="{{ URL::to('/package-subscription/settings/'.$package->id)}}">
                                        @lang('website.Update')
                                      </a>
                                    @endif
                                    &nbsp;
                                    <a  class="btn btn-sm btn-outline-danger" href="{{ URL::to('/package-subscription/logs/'.$package->id)}}">
                                      @lang('website.Log')
                                    </a>
                            </td>
                          </tr>
                         @endforeach
                      @else
                        <tr>
                          <td colspan="7">
                             @lang('website.No record found')
                          </td>
                        </tr>
                      @endif
                    </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@stop
