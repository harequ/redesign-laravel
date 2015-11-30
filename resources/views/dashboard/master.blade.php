<html>
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="{{ url(elixir('css/dashboard.css')) }}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
	@include('dashboard/nav')
	<div id="wrapper" class="menu-displayed">
		<div id="sidebar-wrapper">
			<div class="greetings">
				<i class="fa fa-user  fa-2x"></i>
				<p>Welcome back, {{ Auth::user()->name }}</p>
			</div>
			<ul class="sidebar-nav">
				<li {!! (Request::is('dashboard/projects*') ? 'class=active' : '') !!}> 
					<a href="{{ url('dashboard/projects') }}" ><i class="fa fa-folder-open"></i><span>&nbsp;&nbsp; Projects</span></a>
					<div class="arrow-left"></div>
				</li>
				<li {!! (Request::is('dashboard/illustrations') ? 'class=active' : '') !!}>
					<a href="{{ url('dashboard/illustrations') }}"><i class="fa fa-picture-o"></i><span>&nbsp;&nbsp; Illustrations</span></a>
					<div class="arrow-left"></div>
				</li>
				<li {!! (Request::is('dashboard/logos') ? 'class=active' : '') !!}>
					<a href="{{ url('dashboard/logos') }}"><i class="fa fa-tree"></i><span>&nbsp;&nbsp; Logos</span></a>
					<div class="arrow-left"></div>
				</li>
				<li><a href="#" id="menu-toggle"><i class="fa fa-chevron-left"></i></a></li>
			</ul>
		</div>
		<div id="page-content-wrapper">
			@yield('content')
		</div>
	</div>
	<script type="text/javascript" src="{{ asset('js/vendor/dashboard-vendor.js') }}"></script>
	<script type="text/javascript" src="{{ url(elixir('js/dashboard.js')) }}"></script>
	@include('dashboard/noty')	
</body>
</html>