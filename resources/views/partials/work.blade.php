@if (count($projects) > 0)
<section class="scene" id="work">
	<div class="line"><h2><span>Featured work</span></h2></div>
	<article>
		@foreach($projects as $project)
		<div class="project-wrap">
			<div class="project">
				<a href="{{ url('projects') . '/' . $project->slug }}"><img src="{{ asset('build/images/projects') . '/' . $project->slug . '/' . $project->thumbnail}}" alt="{{ $project->title }}"></a>
				<div>
					<h3><a href="{{ url('projects') . '/' . $project->slug }}">{{ $project->title }}</a></h3>
					@if(count($project->projectRoles) > 0)
					<ul class="role">
						@foreach($project->projectRoles as $role)
							<li>{{ $role->name }}</li>
						@endforeach
					</ul>
					@endif
					<p>{{ $project->excerpt }}</p>
				</div>
			</div>
		</div>
		@endforeach
	</article>
</section>
@endif