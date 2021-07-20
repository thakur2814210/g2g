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
                        <hr>
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
                        <div class="row" style="padding-top: 1%;">

                            <div class="col-md-12 col-sm-12 ">
                                <div class="card">
                                    <div class="card-header" style="background: #111;">
                                        <span class="card-title text-white"><i
                                                    class="fa fa-money"></i>@lang('website.Service Request')  @lang('website.Payment') @lang('website.Information')</span>
                                    </div>
                                    <div class="card-body table-responsive">


                                        @if($sr->status == 'request-payment')

                                            <form class="form-horizontal" method="POST"
                                                  action="{{ route('client.service-request.update-sr-payment-status')}}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $sr->id }}">
                                                <div class="form-group">
                                                    <h6>@lang('website.Quote Amount (AED)')
                                                        : {{ number_format($sr->quote_amount,2) }}</h6>
                                                </div>
                                                <div class="form-group">
                                                    <h6>@lang('website.Make') @lang('website.Payment')</h6>
                                                    <select class="form-control" name="payment_type" id="payment_type">
                                                        <option value="cod"
                                                                selected="">@lang('website.Cash On Delivery')</option>
                                                        <option value="telr" disabled="">@lang('website.Telr')</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success"
                                                            data-dismiss="modal">@lang('website.Submit') @lang('website.Payment')</button>
                                                </div>

                                            </form>

                                        @elseif($sr->status == 'new')
                                            <p class="btn btn-block btn-outline-danger">
                                                <b>Information:</b><br/> @lang('website.Service request create and waiting for the Garage quote amount')
                                            </p>
                                        @elseif($sr->status == 'cancel' || $sr->status == 'delete')
                                            <p class="btn btn-block btn-outline-danger">@lang('website.Not required! Service request has cancel or deleted')</p>
                                        @else

                                            @if(!empty($sr_payment))

                                                <div class="p-1" style="background: #999;">
                                                    <div class="row text-center text-white">
                                                        <div class="col-6 ">
                                                            <p class="btn btn-block btn-outline-warning">@lang('website.Payment') @lang('website.Amount')</p>
                                                            <p class="read text-uppercase  p-2">
                                                                AED {{ $sr_payment->amount }}
                                                            </p>
                                                        </div>
                                                        <div class="col-6 ">
                                                            <p class="btn btn-block btn-outline-warning">@lang('website.Payment') @lang('website.Status')</p>
                                                            <p class="read text-uppercase text-white p-2">
                                                                @if(!empty($sr_payment->status == 1))
                                                                    @lang('website.Success')
                                                                @elseif(!empty($sr_payment->status == 2))
                                                                    @lang('website.Failed')
                                                                @else
                                                                    @lang('website.Pending')
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row text-center text-white">
                                                        <div class="col-6 ">
                                                            <div class="form-group">
                                                                <p class="btn btn-block btn-outline-warning">@lang('website.Payment') @lang('website.Date')</p>
                                                                <p> {{ $sr_payment->date }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 ">
                                                            <div class="form-group">
                                                                <p class="btn btn-block btn-outline-warning">@lang('website.Payment') @lang('website.Type')</p>
                                                                <p> {{ $sr_payment->payment_type }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>


                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 ">

                                <div class="card">

                                    <div class="card-header" style="background: #111;">
                                        <span class="card-title text-white"><i
                                                    class="fa fas fa-tags"></i> @lang('website.Service Request') @lang('website.Information')</span>
                                    </div>
                                    <div class="card-body">

                                        <div class="p-1" style="background: #999;">
                                            <div class="row text-center text-white">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <p class="btn btn-block btn-outline-warning">@lang('website.Status')</p>
                                                    @if(in_array($sr->status, ['new' , 'request-payment']))
                                                        <p class="pending text-uppercase text-white p-2">
                                                    @elseif(in_array($sr->status, ['received-payment']))
                                                        <p class="read text-uppercase text-white p-2">
                                                    @elseif(in_array($sr->status, ['in-progress']))
                                                        <p class="read text-uppercase text-white p-2">
                                                    @elseif(in_array($sr->status, ['cancel']))
                                                        <p class="unread text-uppercase text-white p-2">
                                                    @else
                                                        <p class="read text-uppercase text-white p-2">
                                                            @endif
                                                            {{ trans("website.$sr->status") }}
                                                        </p>

                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <p class="btn btn-block btn-outline-warning">@lang('website.Amount')</p>
                                                    <p class="read text-uppercase text-white p-2">
                                                        {{ (!empty($sr->quote_amount) ? 'AED '. $sr->quote_amount : trans('website.Not Available') )}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <br/>

                                        @if(!empty($sr->amount_json))
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('website.Particular')</th>
                                                        <th>@lang('website.Amount')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($sr->amount_json as $key=>$val)
                                                        <tr>
                                                            <th>{{$val['particular']}}</th>
                                                            <td>AED {{$val['amount']}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <th>@lang('website.Total')</th>
                                                    <th>AED {{$sr->quote_amount}}</th>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif

                                        <br>


                                        <div class="form-group">
                                            <p class="btn btn-block btn-outline-danger">@lang('website.Faults/Remarks')</p>
                                            <p>{{ $sr->faults_remarks }}</p>
                                        </div>

                                        @if(!empty($sr->image))
                                            <div class="form-group">
                                                <p class="btn btn-block btn-outline-danger">Images (It's Optional)</p>
                                                <img src="{{asset($sr->image )}}"
                                                     height="200" width="auto"/>
                                            </div>
                                        @endif

                                        @if(!empty($sr->image1))
                                            <div class="form-group">
                                                <p class="btn btn-block btn-outline-danger">Images (It's Optional)</p>
                                                <img src="{{asset($sr->image1 )}}"
                                                     height="200" width="auto"/>
                                            </div>
                                        @endif

                                        @if(!empty($sr->image2))
                                            <div class="form-group">
                                                <p class="btn btn-block btn-outline-danger">Images (It's Optional)</p>
                                                <img src="{{asset($sr->image2 )}}"
                                                     height="200" width="auto"/>
                                            </div>
                                        @endif

                                        @if(!empty($sr->image3))
                                            <div class="form-group">
                                                <p class="btn btn-block btn-outline-danger">Images (It's Optional)</p>
                                                <img src="{{asset($sr->image3 )}}"
                                                     height="200" width="auto"/>
                                            </div>
                                        @endif


                                        @if(!empty($sr->image4))
                                            <div class="form-group">
                                                <p class="btn btn-block btn-outline-danger">Images (It's Optional)</p>
                                                <img src="{{asset($sr->image4 )}}"
                                                     height="200" width="auto"/>
                                            </div>
                                        @endif

                                        @if(!empty($sr->image5))
                                            <div class="form-group">
                                                <p class="btn btn-block btn-outline-danger">Images (It's Optional)</p>
                                                <img src="{{asset($sr->image5 )}}"
                                                     height="200" width="auto"/>
                                            </div>
                                        @endif


                                        <div class="form-group">
                                            <p class="btn btn-block btn-outline-danger">@lang('website.Service Request')</p>
                                            <p> {{ $sr->section_name }} </p>
                                        </div>

                                        @php
                                            $language_id = ( \Config::get('app.locale') == 'en' ) ? 1 : 2;
                                            $garage_name = null;
                                            foreach($sr->garage->garageDescription as $gd){

                                              if($gd['language_id'] === $language_id){
                                                $garage_name = $gd['garages_name'];
                                              }
                                            }
                                        @endphp

                                        <div class="form-group">
                                            <p class="btn btn-block btn-outline-danger">@lang('website.Garage') @lang('website.Name')</p>
                                            <p>{{ $garage_name }}</p>
                                        </div>

                                        <div class="form-group">
                                            <p class="btn btn-block btn-outline-danger">@lang('website.Garage') @lang('website.Address')</p>
                                            <p>{{ $sr->garage->address }}, {{ $sr->garage->city->name }}
                                                , {{ $sr->garage->country->name }}, @lang('website.Pobox')
                                                -{{ $sr->garage->postal }}</p>
                                        </div>


                                        <div class="form-group">
                                            <p class="btn btn-block btn-outline-danger">@lang('website.Garage') @lang('website.Email')</p>
                                            <p>{{ $sr->garage->user->email }}</p>
                                        </div>

                                        <div class="form-group">
                                            <p class="btn btn-block btn-outline-danger">@lang('website.Garage') @lang('website.Phone')</p>
                                            <p>{{ $sr->garage->user->phone }}</p>
                                        </div>

                                        <div class="form-group">
                                            <p class="btn btn-block btn-outline-danger">@lang('website.Category')</p>
                                            <p>{{ $sr->category->name }}
                                            </p>
                                        </div>

                                        <div class="form-group">
                                            <p class="btn btn-block btn-outline-danger">@lang('website.Vehicle') @lang('website.Information')</p>
                                            <p><i class="fa fa-car"></i> {{  $sr->vehicle->plate_no }}
                                            </p>
                                        </div>

                                        <div class="form-group">
                                            <p class="btn btn-block btn-outline-danger">@lang('website.Created At')</p>
                                            <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($sr->created_at)) }}
                                            </p>
                                        </div>

                                        <div class="form-group">
                                            <p class="btn btn-block btn-outline-danger">@lang('website.Last Updated At')</p>
                                            <p class="text-uppercase">{{ date('Y-m-d h:i a', strtotime($sr->updated_at)) }}</p>
                                        </div>

                                        <div class="form-group">
                                            <p class="btn btn-block btn-outline-danger">@lang('website.Pick and drop your car from your location?')</p>
                                            <p>
                                                @if($sr->vip_pickup_opted === 1)
                                                    @lang('website.Yes'), AED {{$sr->vip_pickup_price}} @lang('website.payable in cash')
                                                @else
                                                    @lang('website.No')
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@stop

