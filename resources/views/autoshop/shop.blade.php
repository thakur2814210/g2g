@extends('autoshop.layout')
@section('content')
 @php $r =   'autoshop.shop-pages.shop' . $final_theme['shop']; @endphp
 @include($r)
 
 @if(isset($result['show_vehicle_popup']) && $result['show_vehicle_popup'])
 
 <!-- The Modal -->
  <div class="modal" id="vehicleModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{ trans('website.vehicles and customization')}}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <ul style="list-style-type:disc;">
                <li class="ion-text-wrap">
                    {{ trans('website.Price listed with the car is the price seller is willing to sell')}}
                </li>
                <li class="ion-text-wrap">
                    {{ trans('website.G2G only arrange viewing of vehicles for AED 100 per viewing')}}
                </li>
                <li class="ion-text-wrap">
                    {{ trans('website.Add to cart and pay only for viewing charges')}}
                </li>
                <li class="ion-text-wrap">
                    {{ trans('website.Enter your location in Shipping details on checkout')}}
                </li>
            </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('website.proceed')}}</button>
        </div>
        
      </div>
    </div>
  </div>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>

    $(document).ready(function (){
        $('#vehicleModal').modal('hide');
        $('#vehicleModal').modal({backdrop: 'static',keyboard: false});
    });
    </script>
 @endif
 
 
 
@endsection
