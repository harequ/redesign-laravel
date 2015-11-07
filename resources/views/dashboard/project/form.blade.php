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
	{!! Form::label('thumbnail', 'Thumbnail', ['class' => 'col-lg-2 control-label']) !!}
	<div class="col-lg-7">
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
	<div class="col-lg-2">{!! Form::label('published', 'Published') !!}</div>
	<div class="togglebutton col-lg-10">
		<label>{!! Form::checkbox('published') !!}</label>
	</div>
</div>
<div class="form-group">
	<div class="col-lg-12">
		{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary'])!!}
	</div>
</div>