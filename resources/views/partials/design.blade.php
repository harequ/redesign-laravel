@if((count($illustrations) > 0) || (count($logos) > 0))
<section class="scene" id="design">
	<div class="line"><h2><span>Graphic Design</span></h2></div>
	<article>
		@if(count($illustrations) > 0)
		<div id="illustrations">
			<h3>illustrations</h3>
			<div id="gallery">
				@foreach($illustrations as $illustration)
					<a href="{{ asset('build/images/illustrations') . '/' . $illustration->image }}" data-lightbox="gallery"><img src="{{ asset('build/images/illustrations') . '/' . $illustration->thumb }}" alt="{{ $illustration->alt }}"></a>
				@endforeach
			</div>
		</div>
		@endif
		@if(count($logos) > 0)
		<div id="logos">
			<h3>logos</h3>
			<div class="carousel">
				@foreach($logos as $logo)
					<div><img src="{{ asset('build/images/logos') . '/' . $logo->image }}" alt="{{ $logo->alt }}"></div>
				@endforeach
			</div>
		</div>
		@endif
	</article>
</section>
@endif