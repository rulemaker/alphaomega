@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('Error 500') }}} |
@parent
@stop

{{-- Content --}}
@section('content')
<div class="col-md-12">

	<div class="error-container">
		<?php $messages = array('Ouch.', 'Oh no!', 'Whoops!'); ?>
		<h1><?php echo $messages[mt_rand(0, 2)]; ?></h1>
		
		<h2>Server Error: 500 (Internal Server Error)</h2>
		
		<div class="error-details">
			Something went wrong on our servers while we were processing your request.
			We're really sorry about this, and will work hard to get this resolved as
			soon as possible.
			
		</div> <!-- /error-details -->
		
		<div class="error-actions">
			<a class="btn btn-primary btn-lg" href="{{{ URL::to('/') }}}">
				<i class="fa fa-chevron-left"></i>
				&nbsp;
				Back to Dashboard						
			</a>
			
		</div> <!-- /error-actions -->
					
	</div> <!-- /error-container -->			
	
</div>
@stop