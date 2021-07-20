@extends('website::layouts.homepage')

@section('website_css_pre')

@stop

@section('website_css')
	
@stop

@section('content')
	
	<main>
		<div id="error_page">
			<div class="wrapper">
				<div class="container">
					<div class="row justify-content-center text-center">
						<div class="col-xl-7 col-lg-9">
							<h2>404 <i class="icon_error-triangle_alt"></i></h2>
							<p>We're sorry, but the page you were looking for doesn't exist.</p>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /wrapper -->
		</div>
		<!-- /error_page -->
	</main>
	
	
@stop

@section('website_js')
	<script>
		$('.wish_bt.liked').on('click', function (c) {
			$(this).parent().parent().parent().fadeOut('slow', function (c) {});
		});
	</script>
@stop