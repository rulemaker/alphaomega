@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('Login') }}} |
@parent
@stop

{{-- Content --}}
@section('content')
				
  <h2 class="text-center login-title">Please Login</h2>
	@if(Session::has('message'))
	<div class="alert alert-danger">{{ Session::get('message') }}</div>
	@endif
  <div class="account-wall">
			{{ HTML::image('img/avatar_2x.png','Profile Image',array('class'=>'profile-img')) }}
			{{ Form::open(array('url'=>'user/login', 'class'=>'form-signin')) }}
			{{ Form::hidden('_token',csrf_token()) }}
			<div class="form-group">
			{{ Form::text('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>Lang::get('confide::confide.username_e_mail') )) }}
			</div>
			<div class="form-group">
			{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>Lang::get('confide::confide.password'))) }}
			</div>
			<div class="form-group">
			<div class="checkbox">
			<label for="remember">
			 {{ Lang::get('confide::confide.login.remember') }}
			 {{ Form::hidden('remember', 0) }}
			 {{ Form::checkbox('remember', 1, '', array()) }}
			</label>
			</div>
			</div>
			<div class="form-group">
			{{ Form::submit(Lang::get('confide::confide.login.submit'), array('class'=>'btn btn-lg btn-primary btn-block'))}}
      <a href="forgot" class="need-help">{{ Lang::get('confide::confide.login.forgot_password') }}</a>
			</div>
      {{ Form::close() }}
  </div>

@stop
