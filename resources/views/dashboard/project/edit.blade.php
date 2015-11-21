@extends('dashboard/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h2>Edditing project: {{ $project->title }}</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Update Project: {{ $project->title }}</h3>
					</div>
					<div class="panel-body">
						{!! Form::model($project, ['method' => 'PATCH', 'action' => ['ProjectsController@updateProject', $project->id], 'files' => true, 'class' => 'form-horizontal']) !!}
						<fieldset>
							@include('errors/list')
							@include('dashboard/project/form', ['submitButtonText' => 'Update Project', 'delete' => 'Delete Project', 'icon' => 'glyphicon-refresh'])
						</fieldset>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Project's thumbnail</h3>
						</div>
						<div class="panel-body">
							<img src="{{asset('images/projects/'. $project->slug . '/' . $project->thumbnail) }}" class="img-responsive" width="200" style="margin:auto;">
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Add project images</h3>
						</div>
						<div class="panel-body">
							<div id="project-img">
								<div id="project-images">
									<div class="row">
										@if(count($projectImages) > 0)
											@foreach($projectImages as $image)
												<div class="col-xs-6 col-sm-4 col-md-3">
													<div class="thumbnail">
														<img src="{{url('images/projects') . '/' . $project->slug . '/' . $image->img_thumb }}" alt="{{ $image->alt }}">
														<span>
															<button class="remove-image btn btn-danger btn-sm glyphicon glyphicon-trash"></button>
														</span>
													</div>
												</div>
											@endforeach
										@endif
									</div>
								</div>

								{!! Form::open(['method' => 'POST', 'action' => ['ProjectImagesController@uploadImage', $project->id], 'files' => true, 'id' => 'form-image', 'class' => 'form-horizontal']) !!}

									<div class="form-group">
										{!! Form::label('thumbnail', 'Image', ['class' => 'col-lg-2 control-label']) !!}
										<div class="col-lg-10">
											{!! Form::file('imgFile', ['class' => 'form-control', 'id' => 'img-file']) !!}
										</div>
									</div>

									<div class="form-group">
										{!! Form::label('alt', 'Alt', ['class' => 'col-lg-2 control-label']) !!}
										<div class="col-lg-10">
											{!! Form::text('alt', null, ['class' => 'form-control']) !!}
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-10 col-lg-offset-2">
											<button id="add-image" class="btn btn-default"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span>&nbsp;Add Image</button>
										</div>
									</div>
								{!! Form::close() !!}

							</div>
						</div> {{-- .panel-body --}}
					</div> {{-- .panel panel-default --}}
				</div>
			</div>
		</div>
	</div> {{-- row --}}
</div>
@endsection