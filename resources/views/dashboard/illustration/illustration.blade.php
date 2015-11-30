@extends('dashboard/master')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Add Illustration</h3>
					</div>
					<div class="panel-body">
						<div id="project-img">
							<div id="project-images">
								<div class="row">
									@if(count($illustrations) > 0)
										@foreach($illustrations as $illustration)
											<div class="col-xs-6 col-sm-3 col-md-2">
												<div class="thumbnail">
													<img src="{{url('build/images/illustrations') . '/' . $illustration->thumb }}" alt="{{ $illustration->alt }}">
													<span>
														<button class="remove-illustration btn btn-danger btn-sm glyphicon glyphicon-trash"></button>
													</span>
												</div>
											</div>
										@endforeach
									@endif
								</div>
							</div>

							{!! Form::open(['method' => 'POST', 'action' => ['IllustrationsController@uploadIllustration'], 'files' => true, 'id' => 'form-image', 'class' => 'form-horizontal']) !!}

								<div class="form-group">
									{!! Form::label('thumbnail', 'Image', ['class' => 'col-lg-1 control-label']) !!}
									<div class="col-lg-5">
										{!! Form::file('imgFile', ['class' => 'form-control', 'id' => 'img-file']) !!}
									</div>
								</div>

								<div class="form-group">
									{!! Form::label('alt', 'Alt', ['class' => 'col-lg-1 control-label']) !!}
									<div class="col-lg-5">
										{!! Form::text('alt', null, ['class' => 'form-control']) !!}
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-5 col-lg-offset-1">
										<button id="add-image" class="btn btn-default"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span>&nbsp;Add Illustration</button>
									</div>
								</div>

							{!! Form::close() !!}

						</div>
					</div> {{-- .panel-body --}}
				</div> {{-- .panel panel-default --}}
			</div>	
		</div>
	</div>	
@endsection