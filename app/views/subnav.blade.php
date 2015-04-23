@section("subnav")
<div class="subnavbar">

	<div class="subnavbar-inner">
	
		<div class="container">
			
			<a data-target=".subnav-collapse" data-toggle="collapse" class="subnav-toggle" href="javascript:;">
		      <span class="sr-only">Toggle navigation</span>
		      <i class="fa fa-reorder"></i>
		      
		    </a>

			<div class="subnav-collapse">
				<ul class="mainnav">
				
					<li {{ (Request::is('dashboard*') ? ' class="active"' : '') }}>
						<a href="{{{ URL::to('dashboard/') }}}">
							<i class="fa fa-home"></i>
							<span>Dashboard</span>
						</a>	    				
					</li>
					
					<li {{ (Request::is('users*') ? 'class="dropdown active"' : 'class="dropdown"') }}>					
						<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
							<i class="fa fa-users"></i>
							<span>Employees</span>
						</a>	    
					
						<ul class="dropdown-menu">
							<li><a href="{{{ URL::to('users') }}}">All Employees</a></li>
							<li><a href="{{{ URL::to('roles') }}}">All Roles</a></li>
						</ul> 				
					</li>
					
					<li {{ (Request::is('periodes*') ? 'class="dropdown active"' : 'class="dropdown"') }}>					
						<a href="{{{ URL::to('periodes') }}}">
							<i class="fa fa-book"></i>
							<span>Periodes</span>
						</a>	
    				
					</li>
					
					<li {{ (Request::is('positions*') ? 'class="active"' : '') }}>					
						<a href="{{{ URL::to('positions') }}}">
							<i class="fa fa-bookmark"></i>
							<span>Positions</span>
						</a>	
   				
					</li>
					
					<li {{ (Request::is('departments*') ? 'class="active"' : '') }}>					
						<a href="{{{ URL::to('departments') }}}">
							<i class="fa fa-suitcase"></i>
							<span>Departments</span>
						</a>	
					  				
					</li>
					
					<li {{ (Request::is('maritals*') ? 'class="active"' : '') }}>					
						<a href="{{{ URL::to('maritals') }}}">
							<i class="fa fa-chain"></i>
							<span>Maritals</span>
						</a>	
  				
					</li>
					<!--li class="dropdown">					
						<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
							<i class="fa fa-building-o"></i>
							<span>Companies</span>
							<b class="caret"></b>
						</a>	
					
						<ul class="dropdown-menu">
							<li><a href="{{{ URL::to('companies/list') }}}">All Company</a></li>
							<li><a href="{{{ URL::to('companies/insert') }}}">Add New</a></li>
						</ul>    				
					</li-->
								
				</ul>
			</div> <!-- /.subnav-collapse -->

		</div> <!-- /container -->
	
	</div> <!-- /subnavbar-inner -->

</div>
@show