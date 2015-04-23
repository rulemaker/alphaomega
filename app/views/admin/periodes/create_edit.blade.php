@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<div class="col-md-12">
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Create Periode Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($periode)){{ URL::to('periodes/' . $periode->periode_id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				<!-- user id -->
				<div class="form-group {{{ $errors->has('user_id') ? 'error' : '' }}}">
					{{ Form::label('user_id', 'Employee', array( 'class' => 'col-md-2 control-label')) }}
					<div class="col-md-10">
						<select class="form-control" name="user_id" id="user_id">
		          @foreach ($users as $user)
								@if ($mode == 'create')
								<option value="{{{ $user->id }}}">{{{ $user->firstname }}}</option>
								@else
		            <option value="{{{ $user->id }}}"{{{ ($periode->user_id == $user->id) ? ' selected="selected"' : '' }}}>{{{ $user->firstname }}}</option>
								@endif
		          @endforeach
						</select>
						{{ $errors->first('user_id', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ user id -->
				
				<div class="form-group">
					{{ Form::label('position_id', 'Position', array( 'class' => 'col-md-2 control-label')) }}
					<div class="col-md-10">
					<select class="form-control" name="position_id" id="position_id">
		          @foreach ($positions as $position)
								@if ($mode == 'create')
								<option value="{{{ $position->postition_id }}}">{{{ $position->position_name }}}</option>
								@else
		            <option value="{{{ $position->position_id }}}"{{{ ($periode->position_id == $position->position_id) ? ' selected="selected"' : '' }}}>{{{ $position->position_name }}}</option>
								@endif
		          @endforeach
						</select>
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('start_date', 'Start Date', array( 'class' => 'col-md-2 control-label')) }}
					<div class="col-md-10">
					{{ Form::text('start_date', Input::old('start_date', isset($periode) ? $periode->start_date : null), array('class'=>'form-control datepicker')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('end_date', 'End Date', array( 'class' => 'col-md-2 control-label')) }}
					<div class="col-md-10">
					{{ Form::text('end_date', Input::old('start_date', isset($periode) ? $periode->start_date : null), array('class'=>'form-control datepicker')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('Start Date', 'Request Leave Pay Date', array( 'class' => 'col-md-2 control-label')) }}
					<div class="col-md-10">
					{{ Form::text('request_pay_date', Input::old('request_pay_date', isset($periode) ? $periode->request_pay_date : null), array('class'=>'form-control datepicker')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('End Date', 'Accept Payment Date', array( 'class' => 'col-md-2 control-label')) }}
					<div class="col-md-10">
					{{ Form::text('accept_pay_date', Input::old('accept_pay_date', isset($periode) ? $periode->accept_pay_date : null), array('class'=>'form-control datepicker')) }}
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('salary', 'Salary', array( 'class' => 'col-md-2 control-label')) }}
					<div class="col-md-10">
					{{ Form::text('salary', Input::old('salary', isset($periode) ? $periode->salary : null), array('class'=>'form-control')) }}
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('status', 'Status', array( 'class' => 'col-md-2 control-label')) }}
					<div class="col-md-10">
					{{ Form::text('status', Input::old('status', isset($periode) ? $periode->status : null), array('class'=>'form-control')) }}
					</div>
				</div>
				
				<!-- Notes -->
				<div class="form-group {{{ $errors->has('notes') ? 'error' : '' }}}">
					<label class="col-md-2 control-label" for="notes">Notes</label>
					<div class="col-md-10">
						<textarea class="form-control" name="notes" id="notes">{{{ Input::old('notes', isset($periode) ? $periode->notes : '') }}}</textarea>
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
