@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<div class="col-md-12">
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Create Department Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($department)){{ URL::to('departments/' . $department->department_id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				<!-- department_name -->
				<div class="form-group {{{ $errors->has('department_name') ? 'error' : '' }}}">
					<label class="col-md-2 control-label" for="department_name">Department Name</label>
					<div class="col-md-10">
						<input class="form-control" type="text" name="department_name" id="department_name" value="{{{ Input::old('department_name', isset($department) ? $department->department_name : null) }}}" />
						{{ $errors->first('department_name', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ department_name -->

				<!-- Notes -->
				<div class="form-group {{{ $errors->has('notes') ? 'error' : '' }}}">
					<label class="col-md-2 control-label" for="notes">Notes</label>
					<div class="col-md-10">
						<textarea class="form-control" name="notes" id="notes">{{{ Input::old('notes', isset($department) ? $department->notes : '') }}}</textarea>
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
