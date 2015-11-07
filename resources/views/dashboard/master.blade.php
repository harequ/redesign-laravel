<html>
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="{{ url(elixir('css/all.css')) }}">
</head>
<body>
	@yield('content')
	<script type="text/javascript" src="{{ asset('js/vendor/vendor.js') }}"></script>
	<script type="text/javascript" src="{{ url(elixir('js/all.js')) }}"></script>
</body>
</html>