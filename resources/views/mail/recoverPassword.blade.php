<div style="width: 100%; display:block;">
<p>
	<strong>{{ trans('labels.Hi') }} {{ $existUser[0]->first_name }} {{ $existUser[0]->last_name }}!</strong><br>
	{{ trans('labels.recoverPasswordEmailText') }}<br>
	{{ trans('labels.Yourpasswordis') }} <strong>{{ $existUser[0]->password }}</strong><br><br>
	<strong>{{ trans('labels.Sincerely') }},</strong><br>
	{{ trans('labels.regardsForThanks') }}
</p>
</div>
