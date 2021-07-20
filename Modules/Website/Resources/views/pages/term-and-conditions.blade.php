@extends('website::layouts.page')

@section('website_css_pre')

@stop

@section('website_css')

@stop

@section('content')
		
	<div class="sub_header_in sticky_header">
		<div class="container">
			<h1>@lang('website::default.terms_and_conditions')</h1>
		</div>
	</div>

	<main>
		<div class="container margin_60 content-page">
			@if(\Config::get('app.locale') == 'en')
				{!! $pageContnet->terms_conditions_en !!}
			@else
				{!! $pageContnet->terms_conditions_ar !!}
			@endif
			
		</div>
	</main>
@stop

@section('website_js')

@stop