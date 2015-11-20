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
		{!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '3']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('thumbnail', 'Thumb', ['class' => 'col-lg-2 control-label']) !!}
	<div class="col-lg-10">
		{!! Form::file('thumbnail', ['class' => 'form-control']) !!}
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
	{!! Form::label('list', 'Project roles', ['class' => 'col-lg-2 control-label']) !!}
	<div class="col-lg-10">
		{!! Form::select('list[]', $projectRoles, null, ['class' => 'form-control', 'multiple']) !!}
	</div>
</div>
<div class="form-group">
	<div class="col-lg-offset-2 col-lg-10">
		<label>{!! Form::checkbox('published') !!}</label>
	</div>
</div>
<div class="form-group">
	<div class="col-lg-10 col-lg-offset-2">
		<button type="submit" class="btn btn-primary">
		  <span class="glyphicon {{$icon}}" aria-hidden="true"></span>&nbsp;{{$submitButtonText}}
		</button>
		{{-- <input class="btn btn-primary glyphicon glyphicon-floppy-disk" type="submit" value="{{$submitButtonText}}">
		{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary'])!!} --}}
		@if($delete)
			<a href="{{ url('dashboard/projects') . '/' . $project->slug . '/delete' }}" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;{{ $delete }}</a>
		@endif
	</div>
</div>