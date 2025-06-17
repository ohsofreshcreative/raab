<article @php(post_class())>
	<header>
		@if(has_post_thumbnail())
		<a class="m-img" href="{{ get_permalink() }}">
			{!! get_the_post_thumbnail(null, 'large', ['class' => 'featured-image img-xs']) !!}
		</a>
		@endif

		<h2 class="entry-title text-h5">
			<a href="{{ get_permalink() }}">
				{!! $title !!}
			</a>
		</h2>

		<!--  @include('partials.entry-meta') -->
	</header>

	<a class="underline-btn m-btn" href="{{ get_permalink() }}">
		Przeczytaj
	</a>

	<!--   <div class="entry-summary">
    @php(the_excerpt())
  </div> -->
</article>