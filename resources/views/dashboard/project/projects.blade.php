@extends('dashboard/master')

@include('dashboard/nav', ['active' => "class='active'"])
@section('content')
<div class="row">
</div>
<div class="row">
	<div class="col-md-6">
		<div class="well">
			<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('dashboard/projects') }}">
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

					{!! csrf_field() !!}
					<div class="form-group">
						<label for="title" class="col-lg-2 control-label">Title</label>
						<div class="col-lg-10">
							<input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
						</div>
					</div>

					<div class="form-group">
						<label for="slug" class="col-lg-2 control-label">Slug</label>
						<div class="col-lg-10">
							<input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug') }}">
						</div>
					</div>

					<div class="form-group">
						<label for="excerpt" class="col-lg-2 control-label">Excerpt</label>
						<div class="col-lg-10">
							<textarea type="text" name="excerpt" class="form-control" id="excerpt" rows="3">{{ old('excerpt') }}</textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="body" class="col-lg-2 control-label">Body</label>
						<div class="col-lg-10">
							<textarea type="text" name="body" class="form-control" id="body" rows="10">{{ old('body') }}</textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="thumbnail" class="col-lg-2 control-label">Thumbnail</label>
						<div class="col-lg-10">
							<input type="file" name="thumbnail" id="thumbnail" multiple="" value="{{ old('thumbnail') }}">
						</div>
					</div>

					<div class="form-group">
						<label for="link" class="col-lg-2 control-label">Link</label>
						<div class="col-lg-10">
							<input type="text" name="link" class="form-control" id="link" value="{{ old('link') }}">
						</div>
					</div>

					<div class="form-group">
						<label for="href" class="col-lg-2 control-label">Href</label>
						<div class="col-lg-10">
							<input type="text" name="href" class="form-control" id="href" value="{{ old('href') }}">
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-2"><label for="published">Published</label></div>
						<div class="togglebutton col-lg-10">
							<label><input type="checkbox" name="published" value="1" {{ old('published') ? "checked='checked'" : ''}} id="published"></label>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-10 col-lg-offset-2">
							<button type="submit" class="btn btn-primary">Add Project</button>
						</div>
					</div>
				</fieldset>
			</form>
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