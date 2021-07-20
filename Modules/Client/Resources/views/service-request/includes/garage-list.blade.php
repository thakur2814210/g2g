
	@if(!empty($garages) && count($garages) > 0)
	<p class="text-danger">#{{ $garages->count()}} {{trans('website.Garages found')}} </p>
			<br/>
		<div class="card-body table-responsive">
			
			@foreach($garages as $garage)

				<div class="card flex-row flex-wrap">
					 <div class="card-header border-0">
	                  <input type="radio"  name="garage_id" value="{{ $garage->id}}">
	             	 </div>
			        <div class="card-block px-2">
			            <h6 style="margin: 0px;" class="card-title m-0 text-danger">{{$garage->name}}</h6>
	                    <label class="card-text text-mute">
                            <small> 
                            <b> {{trans('website.Address')}}:</b> {{$garage->address}}, 
                                @if(\Config::get("app.locale") == 'en') {{$garage->city_name}} @else {{$garage->city_name}}  @endif, 
                                {{$garage->pobox}}, 
                                @if(\Config::get("app.locale") == 'en') {{$garage->country_name}} @else {{$garage->country_name_ar}}  @endif
                            </small>
	                    </label>
			        </div>
			    </div>
			@endforeach

		</div>
	 @else
	 	<div class="card-body table-responsive" style="margin-bottom: 10px; border:5px solid #ddd; ">
	 		<div class="alert alert-danger">
	 			<label> {{trans('website.no_garage_found')}}</label>
	 		</div>
	 	</div>
	@endif
