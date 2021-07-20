@extends('client::layouts.master')

@section('title', 'Client Dashboard')

@section('website_css')
   
@stop

@section('content')
   
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

      <!-- Breadcrumbs-->
      <ol class="breadcrumb padding_bottom">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>

      <div class="box_general padding_bottom">
       <!-- Icon Cards-->
      <div class="row">

        
        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-success o-hidden">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-users text-dark"></i>
              </div>
              <div class="mr-5">
                <h5>#   {{ $sr_customer_count }} </h5>
              </div>
               <h6 class="text-white">Service Request</h6>
            </div>
          </div>
        </div>

        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-primary o-hidden">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-car text-dark"></i>
              </div>
              <div class="mr-5">
                <h5># {{ $ps_customer_count }} </h5>
              </div>
               <h6 class="text-white">Package Subscribed</h6>
            </div>
          </div>
        </div>
      </div> <!-- row ends -->
    </h6>
  </div>


          
@stop


