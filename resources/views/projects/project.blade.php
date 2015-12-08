@extends('main')

@section('project')
<article class="overview">
	<section class="pr-description">	
		<h2>{{ $project-> title }}</h2>
		<div class="desc">
			<p>{{ $project->body }}</p>
			@if($project->link && $project->href)
				<p>Visit the website: <a href="{{ $project->href }}">{{ $project->link }}</a></p>
			@endif
		</div>
		<div class="role">
			<p>What I did:</p>
			<ul>
				@foreach($project->projectRoles as $role)
					<li>{{ $role->name }}</li>
				@endforeach
			</ul>
		</div>
	</section>
	@if(count($project->projectImages) > 0)
		<section class="pr-images">
			@foreach($project->projectImages as $image)
			<div>
				@if($image->img_thousand)
				<a href="{{ asset('build/images/projects') . '/' . $project->slug . '/' . $image->img_origin }}">
					<img src="{{ asset('build/images/projects') . '/' . $project->slug . '/' . $image->img_thousand }}" alt="{{ $image->alt }}">
				</a>
				@else
					<img src="{{ asset('build/images/projects') . '/' . $project->slug . '/' . $image->img_origin }}" alt="{{ $image->alt }}">
				@endif
			</div>
			@endforeach
			<a class="back" href="{{ url() . '/#work' }}">Go back</a>
		</section>
	@endif
</article>
@endsection

@section('footer-project')
	class = 'footer-project'
@endsection	