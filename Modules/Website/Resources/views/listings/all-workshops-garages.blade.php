@extends('website::layouts.search-listings')

@section('website_css_pre')

@stop

@section('website_css')
	<style id="theia-sticky-sidebar-stylesheet-TSS">.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>
	<style type="text/css">
		.slidecontainer {
		  width: 100%;
		}

		.slider {
		  -webkit-appearance: none;
		  width: 100%;
		  height: 25px;
		  background: #d3d3d3;
		  outline: none;
		  opacity: 0.7;
		  -webkit-transition: .2s;
		  transition: opacity .2s;
		}

		.slider:hover {
		  opacity: 1;
		}

		.slider::-webkit-slider-thumb {
		  -webkit-appearance: none;
		  appearance: none;
		  width: 25px;
		  height: 25px;
		  background: #4CAF50;
		  cursor: pointer;
		}

		.slider::-moz-range-thumb {
		  width: 25px;
		  height: 25px;
		  background: #4CAF50;
		  cursor: pointer;
		}
	</style>
@stop

@section('content')
		
	
<main>
	<!-- /header -->
	@include('website::listings.partials.header')
   	@include('website::listings.partials.header-filters_listing')
   		
	
	
	<div class="container p-1">

		<!--div class="row">
			<div class="col-12">
				<div class="alert alert-success">
					<b>Filter : </b> <br/>
					<h6>
						City: <span><a href="#" class="badge badge-primary">Primary X</a> </span> | 
						Category: <a href="#" class="badge badge-primary">Primary</a> | 
						Distance: <a href="#" class="badge badge-primary">Primary</a> | 
					</h6>
				</div>
			</div>
		</div-->
		<div class="row">
			<!-- /left-filter-sidebar -->
			<aside class="col-lg-3" id="sidebar">
				<form id="filterForm" method="get" action="{{ route('listings.search')}}">
					@include('website::listings.partials.left-filter-sidebar')
				</form>
			</aside>

			<div class="col-lg-9">
				@include('website::listings.partials.garages-list')
			</div>
		</div>		
	</div>
	<!-- /container -->
	
</main>
	
	
	
@stop

@section('website_js')

@stop