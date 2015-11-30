@extends('dashboard/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Add New Project</h3>
				</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'dashboard/projects', 'files' => true, 'class' => 'form-horizontal']) !!}
						<fieldset>
							@include('errors/list')
							@include('dashboard/project/form', ['submitButtonText' => 'Add Project', 'delete' => false, 'icon' => 'glyphicon-floppy-save'])
						</fieldset>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			
			@if (count($projects) > 0)
			<table class="table table-striped table-responsive text-center">
				<thead>
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
						<td><i class="{{ $project->published ? 'fa fa-eye' : 'fa fa-eye-slash'}} "></i></td>
						<td><img src="{{ asset('build/images/projects'). '/' . $project->slug. '/' . $project->thumbnail }}" width="50"></td>
						<td>{{$project->title}}</td>
						<td><a href="{{ url('dashboard/projects') . '/' . $project->slug . '/edit' }}">Edit</a> / <a href="{{ url('dashboard/projects') . '/' . $project->slug . '/delete' }}" class="delete">Delete</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@endif
		</div>
	</div>
</div>
@endsection