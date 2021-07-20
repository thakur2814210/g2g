@extends('garage::layouts.master')

@section('title', 'Garage Dashboard')

@section('website_css')
    <style type="text/css" media="screen">
     

.pricing .card {
  border: none;
  border-radius: 1rem;
  transition: all 0.2s;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.pricing hr {
  margin: 1.5rem 0;
}

.pricing .card-title {
  margin: 0.5rem 0;
  font-size: 0.9rem;
  letter-spacing: .1rem;
  font-weight: bold;
}

.pricing .card-price {
  font-size: 3rem;
  margin: 0;
}

.pricing .card-price .period {
  font-size: 0.8rem;
}

.pricing ul li {
  margin-bottom: 1rem;
}

.pricing .text-muted {
  opacity: 0.7;
}

.pricing .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  opacity: 0.7;
  transition: all 0.2s;
}

/* Hover Effects on Card */

@media (min-width: 992px) {
  .pricing .card:hover {
    margin-top: -.25rem;
    margin-bottom: .25rem;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
  }
  .pricing .card:hover .btn {
    opacity: 1;
  }
}
    </style>
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

    <ol class="breadcrumb padding_bottom">
        <li class="breadcrumb-item">
          <a href="{{ route('garage.dashboard') }}"><i class="fa fas fa-home"></i> Dashboard</a>
        </li>
         <li class="breadcrumb-item">
          <a href="{{ route('garage.packages') }}"><i class="fa fas fa-home"></i> My Packages</a>
        </li>
        <li class="breadcrumb-item"><i class="fa fas fa-tags"></i> Cancel Request: Package Subscription</li>
    </ol>

    <div class="box_general padding_bottom">
      <div class="header_box version_2">
        <h2  class="text-danger"><i class="fa fa-user text-danger"></i> Cancel Request: Package Subscription</h2>
      </div>
     
        <div class="alert alert-danger text-center">
          <h5> <b>{{$package->servicePackage->name}}</b>
            <br/> The package is yet not approved and activated by the Admin.
            <br/>Please contact admin for futher assistance  
          </h5>
        </div>

        <div class="header_box text-center">
          <form id="msform" method="POST" action="{{ route('garage.packages.cancel-subscribe-request')}}">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$package->id}}">
            <button type="submit" class="btn btn-danger text-white text-uppercase" name="submit" ><i class="fa fa-ban"></i> Cancel Request</button>
          </form>
        </div>
         
    </div>

@stop