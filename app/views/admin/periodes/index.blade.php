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
				<i class="fa fa-briefcase"></i>
				<h3>{{{ $title }}}</h3>
			</div>
			<div class="widget-content">
				<div class="print-link">
					<a href="{{{ URL::to('periodes/print') }}}" class="btn btn-small btn-success"><i class="fa fa-print"></i> Print</a>
					<a href="{{{ URL::to('periodes/create') }}}" class="btn btn-small btn-info iframe"><i class="fa fa-plus-circle"></i> Create</a>
				</div>
				<div class="table-responsive">
					<table id="periodes" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th class="col-md-2">{{{ Lang::get('admin/periodes/table.user_id') }}}</th>
								<th class="col-md-2">{{{ Lang::get('admin/periodes/table.employee_name') }}}</th>
								<th class="col-md-2">{{{ Lang::get('admin/periodes/table.department') }}}</th>
								<th class="col-md-2">{{{ Lang::get('admin/periodes/table.position') }}}</th>
								<th class="col-md-2">{{{ Lang::get('admin/periodes/table.start_date') }}}</th>
								<th class="col-md-2">{{{ Lang::get('admin/periodes/table.end_date') }}}</th>
								<th class="col-md-2">{{{ Lang::get('admin/periodes/table.salary') }}}</th>
								<th class="col-md-2">{{{ Lang::get('admin/periodes/table.status') }}}</th>
								<th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>
	
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
				oTable = $('#periodes').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('periodes/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	     		}
			});
		});
	</script>
@stop