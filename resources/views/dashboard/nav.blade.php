<div class="navbar navbar-default">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
      	</button>
		<a class="navbar-brand" href="{{ url('dashboard') }}">Dashboard</a>
	</div>
	<div class="navbar-collapse collapse navbar-responsive-collapse">
		{{-- <ul class="nav navbar-nav">
			<li {!! (Request::is('dashboard/projects') ? 'class=active' : '') !!}><a href="{{ url('dashboard/projects') }}">Projects</a></li>
			<li><a href="#">Illustrations</a></li>
			<li><a href="#">Logos</a></li>
		</ul> --}}
		<ul class="nav navbar-nav navbar-right">
			<li><a href="{{ url('auth/logout') }}" id="logout">Logout</a></li>
		</ul>
	</div>
</div>