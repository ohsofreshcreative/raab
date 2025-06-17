@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

<section data-gsap-anim="section" class="hero-offer {{ $sectionClass }}">

	<div class="__wrapper c-main pt-28">
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-13 items-end">
			<h1 data-gsap-element="header" class="">{{ $hero_offer['title'] }}</h1>

			<div data-gsap-element="content" class="text-lg mb-2">
				{!! $hero_offer['content'] !!}
			</div>
		</div>

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-13 items-end mt-5">
			<div></div>

			@if (!empty($hero_offer['cta']))
			<a data-gsap-element="button" class="main-btn" href="{{ $hero_offer['cta']['url'] }}" target="{{ $hero_offer['cta']['target'] }}">{{ $hero_offer['cta']['title'] }}</a>
			@endif
		</div>

		@if (!empty($hero_offer['image']))
		<img class="object-cover w-full __img img-l pt-20" src="{{ $hero_offer['image']['url'] }}" alt="{{ $hero_offer['image']['alt'] ?? '' }}">
		@endif

	</div>

</section>