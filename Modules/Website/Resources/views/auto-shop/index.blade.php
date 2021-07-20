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
						<div class="col-xl-12 col-lg-12">
							<h2>We will be Online soon! </h2>
							<p>Meanwhile, you can make leave your email. We will advice when we will be online!</p>
						</div>
					</div>
					<div class="row justify-content-center">
					<div class="col-lg-6 ">
						<div id="newsletter_wp bg-white">
							<form method="post" action="assets/newsletter.php" id="newsletter" name="newsletter" autocomplete="off">
								<div class="row">
									<div class="col-lg-9">
										<input name="email_newsletter" id="email_newsletter" type="email" placeholder="Your Email" class="form-control bg-white">
									</div>
									<div class="col-lg-3">
										<button type="submit" class="btn btn-block btn-success" id="submit-newsletter">Subscribe</button>
									</div>
								</div>
								<div id="message-newsletter"></div>
							</form>
						</div>
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