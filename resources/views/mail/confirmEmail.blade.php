<div style="width: 100%; display:block;">
<h2>{{ trans('website.WelcomeEamailTitle') }}</h2>
<p>
	<strong>{{ trans('website.hello') }} {{ $userData[0]->first_name }} {{ $userData[0]->last_name }}!</strong><br>
	{{ trans('website.accountCreatedText') }}<br>
	<a href="{{route('listings.verify-email-addresss', ['token' => $userData[0]->email_verified_token])}}">{{trans('website.activeLinkText') }}</a><br><br>
	<strong>{{ trans('website.Sincerely') }},</strong><br>
	{{ trans('labels.regardsForThanks') }}
</p>
</div>