<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="{{ url(elixir('css/style.css')) }}">
	<link rel="icon" href="{{ asset('brain.png') }}" type="image/png">
	<title>Constantine Suvorin - Web Designer &amp; Frontend Developer</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	@yield('intro')
	<main id="wrapper">
		@yield('work')
		@yield('design')
		@yield('skills')
		@yield('project')
	</main>
<footer @yield('footer-project')>
	<div class="footer-wrap">
		<div class="tree"></div>
		<section class="scene" id="contact">
			<h2>Get in Touch</h2>
			<a href="#" class="email">harequ@gmail.com</a>
			<div class="copy">
				<p>Copyright &copy; 2015<br> Designed by Constantine Suvorin<br>Powered by Laravel</p>
			</div>
		</section>
	</div>
</footer>
<div class="overlay">
	<div class="modal">
		<div class="close-btn"></div>
		{!! Form::open(['method' => 'POST', 'action' => 'ContactController@sendEmail', 'id' => 'get-in-touch']) !!}
			<p>
				<label for="name">Name</label>
				<input type="text" name="name" id="name">
			</p>
			<p>
				<label for="email">Email</label>
				<input type="email" name="email" id="email">
			</p>
			<p>
				<label for="message">Message</label>
				<textarea name="message" id="message"></textarea>
			</p>
			<p>
				<input type="submit" name="submit" id="submit">
			</p>
		{!! Form::close() !!}
	</div>
</div>
<script type="text/javascript" src="{{ url(elixir('js/app.js')) }}"></script>
</body>
</html>