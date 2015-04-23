@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} | @parent
@stop

{{-- Content --}}
@section('content')
<div class="col-md-12">
  <div class="widget stacked ">
		
		<div class="widget-header">
      <i class="fa fa-user"></i>
      <h3>{{{ $title }}}</h3>
    </div>
		<div class="widget-content">
			<div class="row">
				<div class="col-md-3">
					<div class="text-center ">
						<h4>
						@if($user->confirmed)
							<span class="label label-success">Active</span>
						@else
							<span class="label label-danger">No Active</span>
						@endif
						</h4>
						<div data-provides="fileupload" class="fileupload fileupload-new">
							<div class="user-image">
								<div class="fileupload-new thumbnail">
									{{ HTML::image($user->photo, null, array('class'=>'employee_photo', 'width' => '200px', 'height' => '200px')) }}
								</div>					
							</div>
						</div>
						<hr>
						<p>
							<a class="btn btn-twitter btn-sm btn-squared">
								<i class="fa fa-twitter"></i>
							</a>
							<a class="btn btn-linkedin btn-sm btn-squared">
								<i class="fa fa-linkedin"></i>
							</a>
							<a class="btn btn-google-plus btn-sm btn-squared">
								<i class="fa fa-google-plus"></i>
							</a>
							<a class="btn btn-facebook btn-sm btn-squared">
								<i class="fa fa-facebook"></i>
							</a>
						</p>
					</div>						
					<hr>
					<table class="table table-no-border">
						<tbody>
							<tr>
								<td><strong>Department</strong></td>
								<td>{{ $department->department_name }}</td>
							</tr>
							<tr>
								<td><strong>Position</strong></td>
								<td>{{ $position->position_name }}</td>
							</tr>
							<tr>
								<td><strong>Last Logged In</strong></td>
								<td>56 min</td>
							</tr>
						</tbody>
					</table>	
				</div>
				<div class="col-md-9">
					<ul class="nav nav-tabs" id="myTab">
            <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
            <li class=""><a data-toggle="tab" href="#other">Other</a></li> 
						<!--li class=""><a data-toggle="tab" href="#leaves">Leaves History</a></li-->
          </ul>
					<div class="tab-content">
						<div id="profile" class="tab-pane fade active in">
							<table class="table table-condensed table-hover">
								<thead>
									<tr>
										<th colspan="3">Contact Information</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Employee ID:</td>
										<td>{{ $user->user_nik }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>First Name:</td>
										<td>{{ $user->firstname }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Last Name:</td>
										<td>{{ $user->lastname }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Place, Date of birth:</td>
										<td>{{ $user->birth_place }}, {{ date('F j, Y',strtotime($user->birth_date)) }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Gender:</td>
										<td>@if($user->gender == 1) Male	@else Female @endif</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Marital Status</td>
										<td>{{ $marital->marital_name }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Address</td>
										<td>
										{{ $user->address }}, {{ $user->city }} {{ $user->zipcode }}<br>
										{{ $user->state }}, {{ $user->country }}
										</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Phone:</td>
										<td>{{ $user->home_phone }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Mobile Number:</td>
										<td>{{ $user->mobile_phone }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Email:</td>
										<td>{{ $user->email }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Personal Email:</td>
										<td>{{ $user->personal_email }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div id="other" class="tab-pane fade">
							<table class="table table-condensed table-hover">
								<thead>
									<tr>
										<th colspan="3">Other Information</th>
									</tr>
								</thead>
								<tbody>
									<!--tr>
										<td>Company:</td>
										<td></td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr-->
									<tr>
										<td>Job Status:</td>
										<td>{{ $user->job_status }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Identity No:</td>
										<td>{{ $user->identity_no }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>NPWP No:</td>
										<td>{{ $user->npwp_no }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>NPWP Valid Date:</td>
										<td>{{ date('F j, Y',strtotime($user->npwp_date)) }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Jamsostek:</td>
										<td>{{ $user->jamsostek_no }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Tax Status:</td>
										<td>{{ $user->tax_status }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Joined Date:</td>
										<td>{{ date('F j, Y',strtotime($user->joined_date)) }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Ended Job:</td>
										<td>{{ date('F j, Y',strtotime($user->ended_date)) }}</td>
										<td><a class="iframe" href="{{{ URL::to('users/'.$user->id.'/edit') }}}"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
								</tbody>
							</table>	
						</div>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
		});
	</script>
@stop