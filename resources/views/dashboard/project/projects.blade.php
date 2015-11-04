@extends('dashboard/master')

@include('dashboard/nav')
@section('content')
<div class="row">
</div>
<div class="row">
	<div class="col-md-6">
		<div class="well">
			{!! Form::open(['url' => 'dashboard/projects', 'files' => true, 'class' => 'form-horizontal']) !!}
			<fieldset>
				<legend>Add Project</legend>
				@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<div class="form-group">
					{!! Form::label('title', 'Title', ['class' => 'col-lg-2 control-label']) !!}
					<div class="col-lg-10">
						{!! Form::text('title', null, ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('slug', 'Slug', ['class' => 'col-lg-2 control-label']) !!}
					<div class="col-lg-10">
						{!! Form::text('slug', null, ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('excerpt', 'Excerpt', ['class' => 'col-lg-2 control-label']) !!}
					<div class="col-lg-10">
						{!! Form::textarea('excerpt', null, ['class' => 'form-control', 'rows' => '3']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('body', 'Body', ['class' => 'col-lg-2 control-label']) !!}
					<div class="col-lg-10">
						{!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '6']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('thumbnail', 'Thumbnail', ['class' => 'col-lg-2 control-label']) !!}
					<div class="col-lg-10">
						{!! Form::file('thumbnail', null, ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('link', 'Link', ['class' => 'col-lg-2 control-label']) !!}
					<div class="col-lg-10">
						{!! Form::text('link', null, ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('href', 'Href', ['class' => 'col-lg-2 control-label']) !!}
					<div class="col-lg-10">
						{!! Form::text('href', null, ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-2">{!! Form::label('published', 'Published') !!}</div>
					<div class="togglebutton col-lg-10">
						<label>{!! Form::checkbox('published') !!}</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-12">
						{!! Form::submit('Add Project', ['class' => 'btn btn-primary'])!!}
					</div>
				</div>
			</fieldset>
			{!! Form::close() !!}
		</div>
	</div>
	<div class="col-md-6">
		@if (count($projects) > 0)
		<table class="table table-striped table-bordered table-responsive text-center">
			<thead >
				<tr>
					<th>on/off</th>
					<th>thumbnail</th>
					<th>name of the project</th>
					<th>edit</th>
				</tr>
			</thead>
			<tbody>
				@foreach($projects as $project)
				<tr>
					<td><i class="{{ $project->published ? 'mdi-action-visibility mdi-material-teal-400' : 'mdi-action-visibility-off mdi-material-teal-200'}} "></i></td>
					<td><img src="{{ asset('images/projects_thumbnails') . '/' . $project->thumbnail }}" width="120"></td>
					<td>{{$project->title}}</td>
					<td><a href="#">Edit</a> / <a href="#">Delete</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<p>Number of projects: {{ $projects->count() }}</p>
		<p>Published: {{ $published }}</p>
		<p>Unpublished: {{ $unpublished }}</p>
		@endif
	</div>
</div>
@endsection