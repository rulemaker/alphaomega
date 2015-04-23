@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<div class="col-md-12">
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Create Position Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($position)){{ URL::to('positions/' . $position->position_id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				<!-- position_name -->
				<div class="form-group {{{ $errors->has('position_name') ? 'error' : '' }}}">
					<label class="col-md-2 control-label" for="position_name">Position Name</label>
					<div class="col-md-10">
						<input class="form-control" type="text" name="position_name" id="position_name" value="{{{ Input::old('position_name', isset($position) ? $position->position_name : null) }}}" />
						{{ $errors->first('position_name', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ position_name -->

				<!-- Notes -->
				<div class="form-group {{{ $errors->has('notes') ? 'error' : '' }}}">
					<label class="col-md-2 control-label" for="notes">Notes</label>
					<div class="col-md-10">
						<textarea class="form-control fullwidth" name="notes" id="notes">{{{ Input::old('notes', isset($position) ? $position->notes : '') }}}</textarea>
						{{ $errors->first('notes', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ email -->

			</div>
			<!-- ./ general tab -->

		</div>
		<!-- ./ tabs content -->

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<element class="btn-cancel close_popup">Cancel</element>
				<button type="reset" class="btn btn-default">Reset</button>
				<button type="submit" class="btn btn-success">OK</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
	<div>
@stop
