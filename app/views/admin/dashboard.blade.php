@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('Dashboard') }}} |
@parent
@stop

{{-- Content --}}
@section('content')

<div class="col-md-12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="fa fa-dashboard"></i>
			<h3>Quick Stats</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<div class="dashboard-pie">
				<div id="placeholder" class="pie-placeholder"></div>
			</div>
			<div class="stats">
				<div class="stat">
					<span class="stat-value">{{ count(User::all()) }}</span>									
					Number of Employees
				</div> <!-- /stat -->
				<div class="stat">
					<span class="stat-value">{{ count(Position::all()) }}</span>									
					Positions
				</div> <!-- /stat -->
				<div class="stat">
					<span class="stat-value">{{ count(Department::all()) }}</span>									
					Departments
				</div> <!-- /stat -->
				<div class="stat">
					<span class="stat-value">{{ count(Role::all()) }}</span>									
					Roles
				</div> <!-- /stat -->
			</div> <!-- /stats -->
		</div> <!-- /widget-content -->		
	</div>
  
</div>

@stop

@section('styles')
<style type="text/css">
.dashboard-pie {
	width: 500px;
	height: 300px;
	margin: 0 auto 40px;
}

.pie-placeholder {
	width: 100%;
	height: 100%;
}

</style>
@stop
	
@section('scripts')
{{ HTML::script('js/jquery.flot.js')}}
{{ HTML::script('js/jquery.flot.pie.js')}}

<script type="text/javascript">

$(function() {

		// Example Data

		var data = [
			{ label: "Employees",  data: {{ count(User::all()) }}},
			{ label: "Positions",  data: {{ count(Position::all()) }}},
			{ label: "Departments",  data: {{ count(Department::all()) }}},
			{ label: "Roles",  data: {{ count(Role::all()) }}}
		];
		
				var placeholder = $("#placeholder");

		$("#placeholder").show(function() {

			$.plot(placeholder, data, {
				series: {
					pie: { 
						innerRadius: 0.5,
						show: true
					}
				}
			});

			setCode([
				"$.plot('#placeholder', data, {",
				"    series: {",
				"        pie: {",
				"            innerRadius: 0.5,",
				"            show: true",
				"        }",
				"    }",
				"});"
			]);
		});
	
});

function setCode(lines) {
		$("#code").text(lines.join("\n"));
	}
	
</script>

@stop