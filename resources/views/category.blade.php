@extends('layouts.app')

@section('content')
@php
$term = get_queried_object();
$title = $term ? get_field('title', 'category_' . $term->term_id) : null;
$txt = $term ? get_field('txt', 'category_' . $term->term_id) : null;
$image = $term ? get_field('image', 'category_' . $term->term_id) : null;
$hero = [
'title' => $title ?: ($term->name ?? ''),
'txt' => $txt ?: ($term->name ?? ''),
'image' => $image['url'] ?? '',
// 'cta' => $cta, // jeśli dodasz pole CTA do kategorii
];
$sectionClass = 'hero hero--category';

// Użyj gradientu na tle, jeśli jest obrazek
$backgroundImage = !empty($hero['image'])
? "linear-gradient(180deg, rgba(255,255,255,0.2), rgba(255,255,255,1)), url('{$hero['image']}')"
: '';
@endphp

<section data-gsap-anim="section" class="{{ $sectionClass }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: center;">
	<div class="__wrapper c-main grid grid-cols-1 md:grid-cols-[2fr_1fr] justify-between items-end {{ !empty($hero['image']) ? 'pt-50 pb-8' : '' }}">

		<div class="">
			<h2 data-gsap-element="header" class="pt-26 w-2/3">{{ $hero['title'] }}</h2>
			@if(!empty($hero['txt']))
			<div data-gsap-element="content" class="mt-2 __content">
				{!! $hero['txt'] !!}
			</div>
			@endif
		</div>
		<a href="#inspiracje">
			<img data-gsap-element="arrow" class="justify-self-end" src="http://shadowcontrol.local/wp-content/uploads/2025/06/down-arrow.svg" />
		</a>
	</div>
</section>

{{-- HEADER (opcjonalnie) --}}
@include('partials.page-header')

{{-- LISTA POSTÓW W GRIDCIE --}}
@if (have_posts())
<div id="inspiracje" class="c-main -smt pb-25 posts grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
	@while (have_posts()) @php(the_post())
	@includeFirst(['partials.content', 'partials.content'])
	@endwhile
</div>
{!! get_the_posts_navigation() !!}
@else
<p>Brak wpisów w tej kategorii.</p>
@endif
@endsection