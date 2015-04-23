@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} | @parent
@stop

{{-- Content --}}
@section('content')
<div class="col-md-12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="fa fa-gear"></i>
			<h3>{{{ $title }}}</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			{{ Form::open(array('url'=>'settings/save')) }}
				<!-- CSRF Token -->
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<div class="form-group">
				{{ Form::label('site_title', 'Site Title') }}
				{{ Form::text('site_title', $options['site_title'], array('class'=>'form-control', 'placeholder'=>'Site Title')) }}
				</div>
				{{ Form::submit('Save Settings', array('class'=>'btn btn-primary btn-lg'))}}
			{{ Form::close() }}
			
		</div>
	</div>
</div>	
	
@stop
