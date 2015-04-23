<!DOCTYPE html>

<html lang="en">

<head id="Starter-Site">

	<meta charset="UTF-8">

	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>
		@section('title')
			{{{ $title }}} | Alpha Omega
		@show
	</title>

	<meta name="keywords" content="@yield('keywords')" />
	<meta name="author" content="@yield('author')" />
	<!-- Google will often use this as its description of your page/site. Make it good. -->
	<meta name="description" content="@yield('description')" />

	<!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->
	<meta name="google-site-verification" content="">

	<!-- Dublin Core Metadata : http://dublincore.org/ -->
	<meta name="DC.title" content="Project Name">
	<meta name="DC.subject" content="@yield('description')">
	<meta name="DC.creator" content="@yield('author')">

	<!--  Mobile Viewport Fix -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<!-- This is the traditional favicon.
	 - size: 16x16 or 32x32
	 - transparency is OK
	 - see wikipedia for info on browser support: http://mky.be/favicon/ -->
	<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">

	<!-- iOS favicons. -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
	<link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">

	<!-- CSS -->
	{{ HTML::style('css/bootstrap.min.css')}}
	{{ HTML::style('css/datatables-bootstrap.css')}}
	{{ HTML::style('css/colorbox.css')}}
	{{ HTML::style('css/datepicker.css')}}
	{{ HTML::style('css/font-awesome.min.css')}}
	{{ HTML::style('css/social-buttons.css')}}
	{{ HTML::style('css/style.css')}}

	@yield('styles')

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>
	<div class="main">

    <div class="container">

      <div class="row">
				
				<div class="page-header">
					<h3>
						{{ $title }}
						<div class="pull-right">
							<button class="btn btn-default btn-small btn-inverse close_popup"><span class="fa fa-arrow-circle-left"></span> Back</button>
						</div>
					</h3>
				</div>
		
				@include('notifications')
				
				@yield('content')
				
			</div>
			
		</div>
	
	</div>	

	<!-- Javascripts -->
	{{ HTML::script('js/jquery-1.10.2.min.js')}}
	{{ HTML::script('js/bootstrap.min.js')}}
	{{ HTML::script('js/jquery.dataTables.min.js')}}
	{{ HTML::script('js/datatables-bootstrap.js')}}
	{{ HTML::script('js/datatables.fnReloadAjax.js')}}
	{{ HTML::script('js/jquery.colorbox.js')}}
	{{ HTML::script('js/bootstrap-datepicker.js')}}
	
 <script type="text/javascript">
$(document).ready(function(){
$('.close_popup').click(function(){
parent.oTable.fnReloadAjax();
parent.jQuery.fn.colorbox.close();
return false;
});

$('.datepicker').datepicker({
  format: 'yyyy-mm-dd',
});

// Employee Photo
if( $('.employee-photo').length > 0 ) {
  $('.employee-photo').prev().hide();
}
$('.employee-photo .btn-delete').on('click', function(e){
  e.preventDefault();
  $(this).parent().slideUp(function(){
    $(this).prev().show();
  })
});
	
$('#deleteForm').submit(function(event) {
var form = $(this);
$.ajax({
type: form.attr('method'),
url: form.attr('action'),
data: form.serialize()
}).done(function() {
parent.jQuery.colorbox.close();
parent.oTable.fnReloadAjax();
}).fail(function() {
});
event.preventDefault();
});
});

</script>

    @yield('scripts')

</body>

</html>
