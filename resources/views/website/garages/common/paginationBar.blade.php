<div class="container">
	<ul class="clearfix">
		<li style="list-style: none;">
			<label>{{trans('website.VIEW')}}: </label>
			<a class="text-danger text-uppercase" href="{{ route('listings.workshops-garages',['category' => 'near-by-garages'])}}" >{{trans('website.NearBy')}} <span class="d-none d-md-inline">{{trans('website.Garages')}}</span></a>
			&nbsp;|&nbsp;
			<a class="text-info text-uppercase" href="{{ route('listings.workshops-garages',['category' => 'all'])}}" >{{trans('website.All')}} <span class="d-none d-md-inline">{{trans('website.Garages')}}</span></a>
			&nbsp;|&nbsp;
			<a class="text-warning text-uppercase" href="{{ route('listings.workshops-garages',['category' => 'featured'])}}">{{trans('website.Featured')}} <span class="d-none d-md-inline">{{trans('website.Garages')}}</span></a>
			&nbsp;|&nbsp;
			<a class="text-primary text-uppercase" href="{{ route('listings.workshops-garages',['category' => 'latest'])}}">{{trans('website.Latest')}} <span class="d-none d-md-inline">{{trans('website.Garages')}}</span></a>
		</li>
		<li style="list-style: none;">
			@if(!empty($garages) && count($garages) > 0)
				{{ $garages->appends($_GET)->links() }}
			@endif
		</li>
		<li style="list-style: none;">
			
				@if(!empty($garages) && count($garages) > 0)
					<strong>{{ $per_page }}</strong> {{trans('website.result for')}} <strong>{{ $garages->total() }}</strong> {{trans('website.Garages')}}
				@endif
			
		</li>
	</ul>
</div>