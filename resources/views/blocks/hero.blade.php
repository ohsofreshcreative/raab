@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

@php
    $backgroundImage = !empty($hero['image']['url']) ? "linear-gradient(180deg, rgba(255,255,255,0.2), rgba(255,255,255,1)), url({$hero['image']['url']})" : '';
@endphp

<section data-gsap-anim="section" class="{{ $sectionClass }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: center;">

	<div class="__wrapper c-main {{ !empty($hero['image']) ? 'pt-50 pb-8' : '' }}">

		<h2 data-gsap-element="header" class="pt-26 w-2/3">{{ $hero['title'] }}</h2>

		<div data-gsap-element="content" class="mt-2 __content">
			{!! $hero['content'] !!}
		</div>

		@if (!empty($hero['cta']))
		<a data-gsap-element="button" class="main-btn" href="{{ $hero['cta']['url'] }}" target="{{ $hero['cta']['target'] }}">{{ $hero['cta']['title'] }}</a>
		@endif

	</div>

</section>