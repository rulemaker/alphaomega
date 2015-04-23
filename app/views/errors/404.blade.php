@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('404 Not Found') }}} |
@parent
@stop

{{-- Content --}}
@section('content')
<div class="col-md-12">

	<div class="error-container">
		<?php $messages = array('We need a map.', 'I think we\'re lost.', 'We took a wrong turn.'); ?>
		<h1><?php echo $messages[mt_rand(0, 2)]; ?></h1>
		
		<h2>404 Not Found</h2>
		
		<div class="error-details">
			We couldn't find the page you requested on our servers. We're really sorry about that. It's our fault, not yours. We'll work hard to get this page back online as soon as possible.					
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