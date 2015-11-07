@extends('dashboard/master')

@section('content')
@include('dashboard/nav')
<div class="container">
	@if(Session::has('update_message'))
		<div class="alert alert-success alert-dismissable">
			{{ Session::get('update_message') }}
		</div>
	@endif
	<div class="row">
		<div class="col-md-6">
			<div class="well">
				{!! Form::model($project, ['method' => 'PATCH', 'action' => ['ProjectsController@updateProject', $project->id], 'files' => true, 'class' => 'form-horizontal']) !!}
				<fieldset>
					<legend>Update Project: <strong>{{ $project->title }}</strong></legend>
					@include('errors/list')
					@include('dashboard/project/form', ['submitButtonText' => 'Update Project'])
				</fieldset>
				{!! Form::close() !!}
			</div>
		</div>
		<div class="col-md-6 dashed">
			<img src="{{asset('images/projects/'. $project->slug . '/' . $project->thumbnail) }}">
			<hr>

			<div id="project-img">
				<h2>Project images:</h2>
				<ul id="project-images"></ul>

				<h4>Add a new image:</h4>
				{!! Form::open(['method' => 'POST', 'action' => ['ProjectImagesController@uploadImage', $project->id], 'files' => true, 'id' => 'form-image']) !!}
					{!! Form::file('imgFile', ['id' => 'img-file']) !!}
					<button id="add-image" class="btn btn-primary">Add images</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection