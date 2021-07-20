<div class="filters_listing version_2  sticky_horizontal">
	<div class="container">
		<ul class="clearfix">
			<li>
				<div class="switch-field">
					
					<a href="{{ route('listings.workshops-garages',['category' => 'all'])}}">
						<button class="btn btn-sm btn-primary-outline">All</button>
					</a>

					<a href="{{ route('listings.workshops-garages',['category' => 'featured'])}}">
					<button class="btn btn-sm btn-primary-outline">Featured</button>
					</a>

					<a href="{{ route('listings.workshops-garages',['category' => 'latest'])}}">
						<button class="btn btn-sm btn-primary-outline">Latest</button>
					</a>
				</div>
			</li>
			<li>
				@if(!empty($garages) && count($garages) > 0)
					{{ $garages->appends($_GET)->links() }}
				@endif
			</li>
			<li>
				<div class="p-2">
					<strong>{{ $per_page }}</strong> result for <strong>{{ $garages->total() }}</strong> Garages
				</div>
			</li>
		</ul>
	</div>
</div>
