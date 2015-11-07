<div class="navbar navbar-default navbar-material-blue-grey-800">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="{{ url('dashboard') }}">Dashboard</a>
	</div>
	<div class="navbar-collapse collapse navbar-responsive-collapse">
		<ul class="nav navbar-nav">
			<li {!! (Request::is('dashboard/projects') ? 'class=active' : '') !!}><a href="{{ url('dashboard/projects') }}">Projects</a></li>
			<li><a href="javascript:void(0)">Illustrations</a></li>
			<li><a href="javascript:void(0)">Logos</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="{{ url('auth/logout') }}">Logout</a></li>
		</ul>
	</div>
</div>