@extends('autoshop.layout')
@section('content')
<!-- Profile Content -->
<section class="profile-content">
   <div class="container">
        <ol class="breadcrumb padding_bottom">
          <li class="breadcrumb-item">
            <a href="{{ route('client.dashboard') }}">@lang('website.dashboard')</a>
          </li>
          <li class="breadcrumb-item active">@lang('website.Registered') @lang('website.Vehicle')</li>
        </ol>
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

          <div class="box_general">
       <div class="card">
        <div class="card-header">
          <i class="fa fa-list"></i>  @lang('website.Registered') @lang('website.Vehicle')
          <div class="card-tools float-right">
            <div class="input-group input-group-sm " style="width: 150px;">
              <div class="input-group-append">
                <a href="{{ URL::to('/vehicles/add')}}"><button type="button" class="btn btn-block btn-secondary"><i class="fa faw fa-plus"></i>@lang('website.Add') @lang('website.Vehicle')</button></a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body card-body-custom">
          <div class="table-responsive">
           <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                 <tr >
                  <th>#</th>
                  <th>@lang('website.Plate No')</th>
                  <th>@lang('website.Make')</th>
                  <th>@lang('website.Model')</th>
                  <th>@lang('website.Status')</th>
                  <th>@lang('website.Action')</th>
                </tr>
              </thead>
              <tfoot>
                <tr >
                    <th>#</th>
                   <th>@lang('website.Plate No')</th>
                  <th>@lang('website.Make')</th>
                  <th>@lang('website.Model')</th>
                  <th>@lang('website.Status')</th>
                  <th>@lang('website.Action')</th>
                </tr>
              </tfoot>
              <tbody>
                @if(!empty($vehicles) && count($vehicles) > 0)
                  @foreach($vehicles as $index => $vehicle)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $vehicle->plate_no }}</td>
                      <td>{{ !empty($vehicle->vmake->name) ? $vehicle->vmake->name : null }}</td>
                      <td>{{ !empty($vehicle->vmodel->name) ? $vehicle->vmodel->name : null }}</td>
                      
                      <td>
                        @if($vehicle->status == 1)
                          <span class="read">@lang('website.Active')</span>
                        @elseif($vehicle->status == 3)
                          <span class="pending">@lang('website.Hold')</span>
                        @else
                          <span class="unread">@lang('website.Delete')</span>
                        @endif
                      </td>
                      <td>
                          
                          <a href="{{ URL::to('/vehicles/edit/'.$vehicle->id)}}" title="Edit Vehicle" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> @lang('website.Update') </a>
                          <a href="{{ URL::to('/vehicles/delete/'.$vehicle->id)}}" title="Delete Vehicle" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> @lang('website.Delete')</a>
                      </td>
                    </tr>
                   @endforeach
                @else
                  <tr>
                    <td colspan="6">
                        No Vehicle Found.
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
 </section>

@stop
