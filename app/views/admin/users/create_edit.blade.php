@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<div class="col-md-12">
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
			<li><a href="#tab-detail" data-toggle="tab">Detail</a></li>
			<li><a href="#tab-other" data-toggle="tab">Other</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Create User Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($user)){{ URL::to('users/' . $user->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				<!-- username -->
				<div class="form-group {{{ $errors->has('username') ? 'error' : '' }}}">
					{{ Form::label('username', 'Username', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('username', Input::old('username', isset($user) ? $user->username : null) , array('class'=>'form-control')) }}
						{{ $errors->first('username', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ username -->

				<!-- Email -->
				<div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
					{{ Form::label('email', 'Email', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('email', Input::old('email', isset($user) ? $user->email : null) , array('class'=>'form-control')) }}
						{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ email -->

				<!-- Password -->
				<div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
					<label class="col-md-2 control-label" for="password">Password</label>
					<div class="col-md-10">
						{{ Form::text('password', '' , array('class'=>'form-control')) }}
						{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ password -->

				<!-- Password Confirm -->
				<div class="form-group {{{ $errors->has('password_confirmation') ? 'error' : '' }}}">
					{{ Form::label('password_confirmation', 'Password Confirm', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('password_confirmation', '' , array('class'=>'form-control')) }}
						{{ $errors->first('password_confirmation', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ password confirm -->

				<!-- Activation Status -->
				<div class="form-group {{{ $errors->has('activated') || $errors->has('confirm') ? 'error' : '' }}}">
					{{ Form::label('confirm', 'Activate User?', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-6">
						@if ($mode == 'create')
							<select class="form-control" name="confirm" id="confirm">
								<option value="1"{{{ (Input::old('confirm', 0) === 1 ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.yes') }}}</option>
								<option value="0"{{{ (Input::old('confirm', 0) === 0 ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.no') }}}</option>
							</select>
						@else
							<select class="form-control" {{{ ($user->id === Confide::user()->id ? ' disabled="disabled"' : '') }}} name="confirm" id="confirm">
								<option value="1"{{{ ($user->confirmed ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.yes') }}}</option>
								<option value="0"{{{ ( ! $user->confirmed ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.no') }}}</option>
							</select>
						@endif
						{{ $errors->first('confirm', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ activation status -->

				<!-- Groups -->
				<div class="form-group {{{ $errors->has('roles') ? 'error' : '' }}}">
					{{ Form::label('roles', 'Roles', array('class'=>'col-md-2 control-label')) }}
	        <div class="col-md-6">
		        <select class="form-control" name="roles[]" id="roles[]" multiple>
		          @foreach ($roles as $role)
							@if ($mode == 'create')
		            <option value="{{{ $role->id }}}"{{{ ( in_array($role->id, $selectedRoles) ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
		          @else
								<option value="{{{ $role->id }}}"{{{ ( array_search($role->id, $user->currentRoleIds()) !== false && array_search($role->id, $user->currentRoleIds()) >= 0 ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
							@endif
		          @endforeach
						</select>

						<span class="help-block">
							Select a group to assign to the user, remember that a user takes on the permissions of the group they are assigned.
						</span>
	        </div>
				</div>
				<!-- ./ groups -->
			</div>
			<!-- ./ general tab -->
			
			<!-- Detail tab -->
			<div class="tab-pane" id="tab-detail">
				<!-- user nik -->
				<div class="form-group">
					{{ Form::label('user_nik', 'Employee ID', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('user_nik', Input::old('user_nik', isset($user) ? $user->user_nik : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ user nik -->
				
				<!-- firstname -->
				<div class="form-group">
					{{ Form::label('firstname', 'Firstname', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('firstname', Input::old('firstname', isset($user) ? $user->firstname : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ firstname -->
				
				<!-- lastname -->
				<div class="form-group">
					{{ Form::label('lastname', 'Lastname', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('lastname', Input::old('lastname', isset($user) ? $user->lastname : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ lastname -->
				
				<!-- Departments -->
				<div class="form-group ">
					{{ Form::label('department', 'Department', array('class'=>'col-md-2 control-label')) }}
	        <div class="col-md-6">
		        <select class="form-control" name="department" id="department">
		          @foreach ($departments as $department)
								@if ($mode == 'create')
								<option value="{{{ $department->department_id }}}">{{{ $department->department_name }}}</option>
								@else
		            <option value="{{{ $department->department_id }}}"{{{ ($user->department == $department->department_id) ? ' selected="selected"' : '' }}}>{{{ $department->department_name }}}</option>
								@endif
		          @endforeach
						</select>

	        </div>
				</div>
				<!-- ./ departments -->
				
				<!-- Positions -->
				<div class="form-group ">
					{{ Form::label('position', 'Position', array('class'=>'col-md-2 control-label')) }}
	        <div class="col-md-6">
		        <select class="form-control" name="position" id="position">
		          @foreach ($positions as $position)
								@if ($mode == 'create')
								<option value="{{{ $position->position_id }}}">{{{ $position->position_name }}}</option>
								@else
		            <option value="{{{ $position->position_id }}}"{{{ ($user->position == $position->position_id) ? ' selected="selected"' : '' }}}>{{{ $position->position_name }}}</option>
								@endif
		          @endforeach
						</select>

	        </div>
				</div>
				<!-- ./ positions -->
				
				<!-- Maritals -->
				<div class="form-group ">
					{{ Form::label('marital_status', 'Marital', array('class'=>'col-md-2 control-label')) }}
	        <div class="col-md-6">
		        <select class="form-control" name="marital_status" id="marital_status">
		          @foreach ($maritals as $marital)
								@if ($mode == 'create')
								<option value="{{{ $marital->marital_id }}}">{{{ $marital->marital_name }}}</option>
								@else
		            <option value="{{{ $marital->marital_id }}}"{{{ ($user->marital_status == $marital->marital_id) ? ' selected="selected"' : '' }}}>{{{ $marital->marital_name }}}</option>
								@endif
		          @endforeach
						</select>

	        </div>
				</div>
				<!-- ./ positions -->
				
				<!-- gender -->
				<div class="form-group">
					{{ Form::label('gender', 'Gender', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::select('gender', array('0'=>'Female','1'=>'Male'), Input::old('gender', isset($user) ? $user->gender : null), array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ gender -->
				
				<!-- indentity no -->
				<div class="form-group">
					{{ Form::label('identity_no', 'Identity No', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('identity_no', Input::old('identity_no', isset($user) ? $user->identity_no : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ identity no -->
				
				<!-- tax -->
				<div class="form-group">
					{{ Form::label('tax_status', 'Tax Status', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('tax_status', Input::old('tax_status', isset($user) ? $user->tax_status : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ tax -->
				
				<!-- npwp no -->
				<div class="form-group">
					{{ Form::label('npwp_no', 'NPWP No', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('npwp_no', Input::old('npwp_no', isset($user) ? $user->npwp_no : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ npwp no -->
				
				<!-- npwp date -->
				<div class="form-group">
					{{ Form::label('npwp_date', 'NPWP Date', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('npwp_date', Input::old('npwp_date', isset($user) ? $user->npwp_date : null) , array('class'=>'form-control datepicker')) }}
					</div>
				</div>
				<!-- ./ npwp date -->
				
				<!-- jamsostek no -->
				<div class="form-group">
					{{ Form::label('jamsostek_no', 'Jamsostek No', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('jamsostek_no', Input::old('jamsostek_no', isset($user) ? $user->jamsostek_no : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ jamsostek no -->
				
				<!-- job status -->
				<div class="form-group">
					{{ Form::label('job_status', 'Job Status', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('job_status', Input::old('job_status', isset($user) ? $user->job_status : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ job status -->
				
				<!-- photo -->
				<div class="form-group">
					{{ Form::label('photo', 'Photo', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::file('photo', array('class'=>'form-control')) }}
						@if(($mode != 'create')&&( $user->photo ))
							<div class="user-photo">
								<a href="#" class="btn btn-danger btn-delete">Delete Photo</a>
								{{ HTML::image( $user->photo ) }}
							</div>
						@endif
					</div>
				</div>
				<!-- ./ photo -->
				
			</div>
			
			<!-- Other tab -->
			<div class="tab-pane" id="tab-other">
				
				<!-- joined date -->
				<div class="form-group">
					{{ Form::label('joined_date', 'Joined Date', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('joined_date', Input::old('joined_date', isset($user) ? $user->joined_date : null) , array('class'=>'form-control datepicker')) }}
					</div>
				</div>
				<!-- ./ joined date -->
				
				<!-- birth place -->
				<div class="form-group">
					{{ Form::label('birth_place', 'Birth of Place', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('birth_place', Input::old('birth_place', isset($user) ? $user->birth_place : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ birth place -->
				
				<!-- birth date -->
				<div class="form-group">
					{{ Form::label('birth_date', 'Birth Date', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('birth_date', Input::old('birth_date', isset($user) ? $user->birth_date : null) , array('class'=>'form-control datepicker')) }}
					</div>
				</div>
				<!-- ./ birth date -->
				
				<!-- address -->
				<div class="form-group">
					{{ Form::label('address', 'Address', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('address', Input::old('address', isset($user) ? $user->address : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ address -->
				
				<!-- city -->
				<div class="form-group">
					{{ Form::label('city', 'City', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('city', Input::old('city', isset($user) ? $user->city : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ city -->
				
				<!-- state -->
				<div class="form-group">
					{{ Form::label('state', 'State', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('state', Input::old('state', isset($user) ? $user->state : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ state -->
				
				<!-- country -->
				<div class="form-group">
					{{ Form::label('country', 'Country', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('country', Input::old('country', isset($user) ? $user->country : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ country -->
				
				<!-- zipcode -->
				<div class="form-group">
					{{ Form::label('zipcode', 'Zip Code', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('zipcode', Input::old('zipcode', isset($user) ? $user->zipcode : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ zipcode -->
				
				<!-- home phone -->
				<div class="form-group">
					{{ Form::label('home_phone', 'Phone Number', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('home_phone', Input::old('home_phone', isset($user) ? $user->home_phone : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ home phone -->
				
				<!-- mobile phone -->
				<div class="form-group">
					{{ Form::label('mobile_phone', 'Mobile Number', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('mobile_phone', Input::old('mobile_phone', isset($user) ? $user->mobile_phone : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ mobile phone -->
				
				<!-- personal email -->
				<div class="form-group">
					{{ Form::label('personal_email', 'Personal Email', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('personal_email', Input::old('personal_email', isset($user) ? $user->personal_email : null) , array('class'=>'form-control')) }}
					</div>
				</div>
				<!-- ./ personal email -->
				
				<!-- ended date -->
				<div class="form-group">
					{{ Form::label('ended_date', 'Ended Job', array('class'=>'col-md-2 control-label')) }}
					<div class="col-md-10">
						{{ Form::text('ended_date', Input::old('ended_date', isset($user) ? $user->ended_date : null) , array('class'=>'form-control datepicker')) }}
					</div>
				</div>
				<!-- ./ ended date -->
			
			</div>

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
