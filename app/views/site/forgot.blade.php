@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('Forgot Password') }}} |
@parent
@stop

{{-- Content --}}
@section('content')

<h2 class="text-center login-title">{{{ Lang::get('Forgot Password') }}}</h2>
<div class="account-wall">
	<div class="form-signin forgot-password">
	{{ Confide::makeForgotPasswordForm() }}
	{{ HTML::link('user/login', 'Back to Login', array('class' => '')) }}
	</div>
</div>

@stop
