@extends('garage.layout')

@section('css')
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


/*
*
* ==================================================
* UNNECESSARY STYLE - JUST TO MAKE IT LOOKS NICE
* ==================================================
*
*/
.countdown {
    text-transform: uppercase;
    font-weight: bold;
}

.countdown span {
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    font-size: 3rem;
    margin-left: 0.8rem;
}

.countdown span:first-of-type {
    margin-left: 0;
}

.countdown-circles {
    text-transform: uppercase;
    font-weight: bold;
}

.countdown-circles span {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

.countdown-circles span:first-of-type {
    margin-left: 0;
}

.bg-gradient-3 {
    background: #ff416c;
    background: -webkit-linear-gradient(to right, #ff416c, #ff4b2b);
    background: linear-gradient(to right, #ff416c, #ff4b2b);
}



</style>
@stop

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Manage Garage Team</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('garage.dashboard') }}"><i class="fa fas fa-home"></i> Dashboard</a></li>
       <li>
          <a href="{{ route('garage.packages') }}">My Packages</a>
        </li>
      <li class="active">Package Subscribe</li>
    </ol>
  </section>



  <section class="content">
   
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

    

    <div class="row">
          <div class="col-md-12">
              <div class="box box-info">
        <div class="box-header"><i class="fa fa-list"></i> Garage Package Information</div>
        <div class="box-body">
         <div class="table-responsive">
           <table class="table table-head-fixed table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                 <tr>
                  <th>Date</th>
                  <th>Package</th>
                  <th>Amount</th>
                  <th>Start At</th>
                  <th>End At</th>
                  <th>Package Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>Date</th>
                    <th>Package</th>
                    <th>Amount</th>
                    <th>Start At</th>
                    <th>End At</th>
                    <th>Package Status</th>
                    <th width="15%">Action</th>
                </tr>
              </tfoot>
              <tbody>
                @if(!empty($garagePackageSubscribes) && count($garagePackageSubscribes) > 0)
                  @foreach($garagePackageSubscribes as $index => $garagePackageSubscribe)
                    <tr>
                      <td>{{ $garagePackageSubscribe->created_at }}</td>
                      <td>{{ $garagePackageSubscribe->servicePackage->name }}</td>
                      <td>AED {{ number_format($garagePackageSubscribe->amount, 2) }}</td>
                      <td>
                        @if(!empty($garagePackageSubscribe->subscription_start_at))
                          {{ $garagePackageSubscribe->subscription_start_at }}
                        @else
                           {{ 'N/A'}}
                        @endif
                      </td>
                      <td>
                        @if(!empty($garagePackageSubscribe->subscription_end_at))
                          {{ $garagePackageSubscribe->subscription_end_at }}
                        @else
                          {{ 'N/A'}}
                        @endif
                      </td>
                      <td>
                        {{ $packageStatus[$garagePackageSubscribe->status] }}
                      </td>
                      <td>
                        <a class="btn btn-sm btn-outline-danger "  href="{{ route('garage.packages.settings',['id' =>$garagePackageSubscribe->id])}}">
                          Update
                        </a>
                        &nbsp;
                        <a  class="btn btn-sm btn-outline-danger" href="{{ route('garage.packages.logs',['id' =>$garagePackageSubscribe->id])}}">
                          Log
                        </a>
                      </td>
                    </tr>
                   @endforeach
                @else
                  <tr>
                    <td colspan="9">
                        No Package Information.
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
</div>




    

 <?php
  /*

    <div class="card">
      <div class="card-header"><i class="fa fa-tags"></i> Package List</div>
        <div class="card-body table-responsive">
            <section class="pricing">
              <div class="container">
                <div class="form-card">                 
                  @if(!empty($packages) && count($packages) > 0)
                      <div class="row">
                         @foreach($packages as $package)
                        <!-- Free Tier -->
                        <div class="col-lg-4">
                            <div class="card mb-5 mb-lg-0">
                              <div class="card-body">
                                <h4 class="card-title text-muted text-uppercase text-center">{{ $package->name }}</h4>
                                <h6 class="card-price text-center">{{ $package->price }}<span class="period">/{{ $package->period }} Days</span></h6>
                                <hr>
                                <ul class="fa-ul">
                                   @foreach($package->packageFeatures as $index => $features)
                                      @php
                                        $pf_values = [];
                                        if (strpos($features->feature_value, ',') !== false) {
                                           $pf_values = explode(',', $features->feature_value);
                                        }else{
                                          $pf_values[] = $features->feature_value;
                                        }
                                      @endphp

                                      <li>
                                          <label><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> {{ $features->feature_name }}</label>
                                          <br/>
                                          @foreach($pf_values as $val)
                                            {{ $val }}
                                          @endforeach
                                      </li>
                                        
                                    @endforeach
                                </ul>
                                <ul class="text-center p-1">
                                  <a href="{{ route('garage.packages.buy_or_upgrade',['slug' => $package->slug ])}}" class="btn btn-danger btn-block text-uppercase">Select</a>
                                </ul>
                              </div>
                            </div>
                        </div>
                         <!-- Plus Tier -->
                        @endforeach
                      </div>
                    @else
                    <p> No Package Found.</p>
                  @endif
                  </div>
              </div>
            </section>
        </div>
      </div>
*/
?>
 

<!-- Modal -->
<div class="modal fade" id="cancelSubscribeRequest" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white">Cancel Request ? </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  method="POST" action="{{ route('garage.packages.cancel-subscribe-request')}}">
        <div class="modal-body">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="cancelSubscribeRequestId" value="">
            <label> Are you sure want to delete this request?</label>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Cancel Request</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cancelSubscribe" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white">Cancel Request ? </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form  method="POST" action="{{ route('garage.packages.cancel-subscription')}}">
        <div class="modal-body">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="cancelSubscribeId" value="">
            <label> Are you sure want to delete this request?</label>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Cancel Request</button>
        </div>
      </form>
    </div>
  </div>
</div>


@stop



@section('website_js')

  <script type="text/javascript">
    $(document).ready(function() {

      $('button[data-toggle=modal]').click(function (event) {

        var name = $(this).data('name');
        var id = $(this).data('id');
        if(name == 'cancelSubscribeRequest'){
          $('#cancelSubscribeRequestId').val(id);
        }

        if(name == 'cancelSubscribe'){
          $('#cancelSubscribeId').val(id);
        }
      })
    });
  </script>

    
   
    
  </script>
@stop