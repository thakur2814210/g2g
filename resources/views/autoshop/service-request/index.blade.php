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
          <i class="fa fa-list"></i> @lang('website.Service Request List')</div>
        <div class="card-body">
          <div class="table-responsive">
           <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                 <tr class="bg-danger text-white">
                  <th>#</th>
                  <th>@lang('website.Code/Date')</th>
                  <th>@lang('website.Category')</th>
                  <th>@lang('website.Vehicle')</th>
                  <th>@lang('website.Quote Amount (AED)')</th>
                  <th width="20%">@lang('website.Status')</th>
                  <th width="20%">@lang('website.Action')</th>
                </tr>
              </thead>
              <tfoot>
                <tr class="bg-danger text-white">
                  <th>#</th>
                  <th>@lang('website.Code/Date')</th>
                  <th>@lang('website.Category')</th>
                  <th>@lang('website.Vehicle')</th>
                  <th>@lang('website.Quote Amount (AED)')</th>
                  <th>@lang('website.Status')</th>
                  <th>@lang('website.Action')</th>
                </tr>
              </tfoot>
              <tbody>
                @if(!empty($serviceRequests) && count($serviceRequests) > 0)
                  @foreach($serviceRequests as $index => $serviceRequest)
                  @php
                    $vehicle_id = null;
                    $plate_no = null;
                    
                    if(isset($serviceRequest->vehicle->id)){
                        $vehicle_id = $serviceRequest->vehicle->id;
                        $plate_no = $serviceRequest->vehicle->plate_no;
                    }
                    
                    
                  @endphp
                    <tr>
                      <td class="text-center">{{ $index + 1 }}</td>
                      <td>
                          <label>{{ $serviceRequest->sr_code }}</label><br/>
                          <small>( {{ date('M d,Y', strtotime($serviceRequest->created_at)) }} )</small>
                      </td>

                      <td>{{ $serviceRequest->category->name }}</td>

                      <td>
                          @if($vehicle_id)
                            <a href="{{ route('client.vehicle.view',['id' => $vehicle_id])}}">{{ $plate_no }}</a>
                          @endif
                        </td>
                       
                       <td class="text-center">
                           {{ (!empty($serviceRequest->quote_amount) ? 'AED '. $serviceRequest->quote_amount : trans('website.Not Available') )}}
                        </td>
                       
                         <td class="text-center text-uppercase">
                             <label
                                  @if( $serviceRequest->status == 'cancel')
                                     class="unread text-large">
                                  @elseif( $serviceRequest->status == 'new' || $serviceRequest->status == 'request-payment')
                                    class="pending">
                                  @else
                                     class="read">
                                  @endif
                              {{ trans("website.$serviceRequest->status") }}</label>

                        </td>
                       
                       <td>
                          <a class="btn btn-sm btn-outline-danger "  href="{{ URL::to('/service-request/settings/'.$serviceRequest->id)}}">
                            {{ trans('website.Update')}}
                          </a>
                          &nbsp;
                          <a  class="btn btn-sm btn-outline-danger" href="{{ URL::to('/service-request/logs/'.$serviceRequest->id)}}">
                            {{ trans('website.Log')}}
                          </a>
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="7">
                        {{ trans('website.No Service Request Found')}}
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
 </section>

@stop



