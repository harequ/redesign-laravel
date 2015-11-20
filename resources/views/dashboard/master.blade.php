<html>
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="{{ url(elixir('css/all.css')) }}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
	@include('dashboard/nav')
	<div id="wrapper" class="menu-displayed">
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li {!! (Request::is('dashboard/projects') ? 'class=active' : '') !!}>
					<a href="{{ url('dashboard/projects') }}" ><i class="fa fa-folder-open"></i><span>&nbsp;&nbsp; Projects</span></a>
				</li>
				<li><a href="#"><i class="fa fa-picture-o"></i><span>&nbsp;&nbsp; Illustrations</span></a></li>
				<li><a href="#"><i class="fa fa-credit-card"></i><span>&nbsp;&nbsp; Logos</span></a></li>
				<li><a href="#" id="menu-toggle"><i class="fa fa-chevron-left"></i></a></li>
			</ul>
		</div>
		<div id="page-content-wrapper">
			@yield('content')
		</div>
	</div>
	<script type="text/javascript" src="{{ asset('js/vendor/vendor.js') }}"></script>
	<script type="text/javascript" src="{{ url(elixir('js/all.js')) }}"></script>
</body>
</html>