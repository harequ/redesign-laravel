@extends('dashboard/master')

@section('content')
@include('dashboard/nav')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="well">
				{!! Form::open(['url' => 'dashboard/projects', 'files' => true, 'class' => 'form-horizontal']) !!}
				<fieldset>
					<legend>Add New Project</legend>
					@include('errors/list')
					@include('dashboard/project/form', ['submitButtonText' => 'Add Project'])
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
						<td><i class="{{ $project->published ? 'mdi-action-visibility' : 'mdi-action-visibility-off'}} "></i></td>
						<td><img src="{{ asset('images/projects'). '/' . $project->slug. '/' . $project->thumbnail }}" width="100"></td>
						<td>{{$project->title}}</td>
						<td><a href="{{ url('dashboard/projects') . '/' . $project->slug . '/edit' }}">Edit</a> / <a href="#">Delete</a></td>
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
</div>
@endsection