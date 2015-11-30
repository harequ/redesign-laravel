@extends('dashboard/master')

@section('content')
	<div class="container-fluid">
		<h1>Dashboard</h1>
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<h3 class="panel-title">Projects</h3>
					</div>
					<div class="panel-body">
						<p>Projects: {{ $projectCount }}</p>
						<p>Published: {{ $published }}</p>
						<p>Unpublished: {{ $unpublished }}</p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<h3 class="panel-title">Illustrations</h3>
					</div>
					<div class="panel-body">
						<p>Illustrations: {{ $illustrations }}</p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<h3 class="panel-title">Logos</h3>
					</div>
					<div class="panel-body">
						<p>Logos: {{ $logos }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection