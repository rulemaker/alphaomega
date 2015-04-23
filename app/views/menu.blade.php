@section("menu")
<nav role="navigation" class="navbar navbar-inverse">

	<div class="container">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button data-target=".navbar-ex1-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
      <span class="sr-only">Toggle navigation</span>
      <i class="fa fa-cog"></i>
    </button>
		{{ HTML::link('', get_option('site_title'), array('class' => 'navbar-brand')) }}
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav navbar-right">
      
			<li class="dropdown">
				@if(!Auth::check())						   
					{{ HTML::link('user/login', 'Login', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown')) }}
				@else					
				<a data-toggle="dropdown" class="dropdown-toggle" href="javscript:;">
					<i class="fa fa-user"></i> 
					Hi {{ Auth::user()->firstname }}!
					<b class="caret"></b>
				</a>
				
				<ul class="dropdown-menu">
					<li>{{ HTML::link('users/'.Auth::user()->id.'/show', 'My Profile') }}</li>			
					<li class="divider"></li>
					<li>{{ HTML::link('settings', 'General Settings') }}</li>
					<!--li class="divider"></li>
					<li>{{ HTML::link('options/jamsostek', 'Jamsostek Settings') }}</li-->
					<li class="divider"></li>
					<li>{{ HTML::link('user/logout', 'Logout') }}</li>
				</ul>
				@endif
			</li>
    </ul>
    
  </div><!-- /.navbar-collapse -->
</div> <!-- /.container -->
</nav>
@include("subnav")
@show