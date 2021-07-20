@extends('website::layouts.page')

@section('website_css_pre')

@stop

@section('website_css')
	
@stop

@section('content')
		
	
	<main class="margin_60_35">
		<div class="container margin_60_35">
			<div class="row">
				@if(!empty($faqs))
				<aside class="col-lg-3" id="faq_cat">
						<div class="box_style_cat" id="faq_box">
							<ul id="cat_nav">
								@foreach($cat_names as $index => $category)
								<li>
									<a href="#{{ strtolower($category) }}" class="@if($index == 0) 'active' @else '' @endif">
										<i class="icon_document_alt"></i>{{$category}}
									</a>
								</li>
								@endforeach
							</ul>
						</div>
						<!--/sticky -->
				</aside>
				<!--/aside -->
				
				<div class="col-lg-9" id="faq">
					@foreach($faqs as $cat_name => $categories)


					<h4 class="nomargin_top">{{$cat_name}}</h4>
					<div role="tablist" class="add_bottom_45 accordion_2" id="{{ strtolower($cat_name) }}">
						@foreach($categories as $index => $category)
							<div class="card">
								@if(\Config::get('app.locale') == 'en')
									<div class="card-header" role="tab">
										<h5 class="mb-0">
											<a data-toggle="collapse" href="#collapse{{$index}}_{{ strtolower($category['cat_name_en']) }}" aria-expanded="true">
												<i class="indicator {{ ($index == 0) ? 'ti-minus' : 'ti-plus' }}"></i>
												{{ $category['heading_en']}}
											</a>
											
										</h5>
									</div>

									<div id="collapse{{$index}}_{{ strtolower($category['cat_name_en']) }}" class="collapse @if($index == 0) show @endif" role="tabpanel" data-parent="#{{ strtolower($category['cat_name_en']) }}">
										<div class="card-body">
											{!! $category['answer_en'] !!}
										</div>
									</div>
								@else
									<div class="card-header" role="tab">
										<h5 class="mb-0">
											<a data-toggle="collapse" href="#collapse{{$index}}_{{ strtolower($category['cat_name_ar']) }}" aria-expanded="true">
												<i class="indicator {{ ($index == 0) ? 'ti-minus' : 'ti-plus' }}"></i>
												{{ $category['heading_ar']}}
											</a>
											
										</h5>
									</div>

									<div id="collapse{{$index}}_{{ strtolower($category['cat_name_ar']) }}" class="collapse @if($index == 0) show @endif" role="tabpanel" data-parent="#{{ strtolower($category['cat_name_ar']) }}">
										<div class="card-body">
											{!! $category['answer_ar'] !!}
										</div>
									</div>
								@endif
							</div>
						@endforeach
					</div>
					@endforeach
				</div>
				@endif
			</div>
			<!-- /row -->
		</div>
	</main>
	
	
	
@stop

@section('website_js')

@stop