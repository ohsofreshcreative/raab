@php
$featured_image = get_the_post_thumbnail_url(null, 'full');
$sectionClass = 'single-hero'; // Możesz dodać więcej klas według uznania
$backgroundImage = $featured_image
? "linear-gradient(180deg, rgba(255,255,255,0.2), rgba(255,255,255,1)), url('{$featured_image}')"
: '';
@endphp

<section data-gsap-anim="section" class="{{ $sectionClass }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: center;">
	<div class="__wrapper c-main grid grid-cols-1 md:grid-cols-[2fr_1fr] justify-between items-end {{ $featured_image ? 'pt-50 pb-8' : '' }}">
		<div>
			<h2 data-gsap-element="header" class="pt-26 w-2/3">{{ get_the_title() }}</h2>
			@if(has_excerpt())
			<div data-gsap-element="content" class="mt-2 __content">
				{!! get_the_excerpt() !!}
			</div>
			@endif
		</div>
		<a href="#inspiracje">
			<img data-gsap-element="arrow" class="justify-self-end" src="http://shadowcontrol.local/wp-content/uploads/2025/06/down-arrow.svg" />
		</a>
	</div>
</section>

@php
  $content = apply_filters('the_content', get_the_content());

  preg_match_all('/<h([1-4])[^>]*>(.*?)<\/h[1-4]>/', $content, $matches, PREG_SET_ORDER);

  $toc = '<nav class="toc"><ol>';
  $used_ids = [];
  foreach ($matches as $match) {
      $level = $match[1];
      $title = strip_tags($match[2]);
      $id = sanitize_title($title);
      $base_id = $id;
      $i = 2;
      while (in_array($id, $used_ids)) {
          $id = $base_id . '-' . $i;
          $i++;
      }
      $used_ids[] = $id;
      $content = preg_replace(
          '/<h' . $level . '[^>]*>' . preg_quote($match[2], '/') . '<\/h' . $level . '>/',
          '<h' . $level . ' id="' . $id . '">' . $match[2] . '</h' . $level . '>',
          $content,
          1
      );
      $toc .= '<li class="toc-h' . $level . '"><a href="#' . $id . '">' . $title . '</a></li>';
  }
  $toc .= '</ol></nav>';
@endphp

<div class="__content c-main -smt grid grid-cols-1 md:grid-cols-[1fr_2fr] gap-10">

<div class="relative md:sticky top-0 md:top-30 b-border h-max p-6">
	<h5 class="m-title">Spis treści</h5>
	@if(count($matches))
	  {!! $toc !!}
	@endif
</div>

<div id="tresc" class="__entry">
  {!! $content !!}
</div>

</div>


@php
  $current_id = get_the_ID();
  $categories = wp_get_post_categories($current_id);
  $related_args = [
      'category__in'   => $categories,
      'post__not_in'   => [$current_id],
      'posts_per_page' => 3,
      'ignore_sticky_posts' => 1,
  ];
  $related_query = new WP_Query($related_args);
@endphp

@if($related_query->have_posts())
  <section class="related-posts c-main -smt pt-20 pb-26">
    <h3 class="text-2xl font-bold mb-6">Pozostałe wpisy</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @while($related_query->have_posts())
        @php($related_query->the_post())
        <article @php(post_class())>
          <header>
            @if(has_post_thumbnail())
              <a href="{{ get_permalink() }}">
                {!! get_the_post_thumbnail(null, 'large', ['class' => 'featured-image img-xs m-img']) !!}
              </a>
            @endif

            <h2 class="entry-title text-h5">
              <a href="{{ get_permalink() }}">
                {{ get_the_title() }}
              </a>
            </h2>

            <!--  @include('partials.entry-meta') -->
          </header>

          <a class="underline-btn m-btn" href="{{ get_permalink() }}">
            Przeczytaj
          </a>

          <!--
          <div class="entry-summary">
            @php(the_excerpt())
          </div>
          -->
        </article>
      @endwhile
      @php(wp_reset_postdata())
    </div>
  </section>
@endif