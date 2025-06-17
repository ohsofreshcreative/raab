@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';

$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
@endphp

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="text-image -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">

	<div class="__wrapper c-main">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-10">
			@if (!empty($textimg['image']))
			<img class="object-cover w-full __img img-xl order1" src="{{ $textimg['image']['url'] }}" alt="{{ $textimg['image']['alt'] ?? '' }}">
			@endif

			<div class="__content order2">
				<h2 data-gsap-element="header" class="">{{ $textimg['title'] }}</h2>

				<div data-gsap-element="header" class="mt-2">
					{!! $textimg['content'] !!}
				</div>
				@if (!empty($textimg['button']))
				<a class="main-btn m-btn" href="{{ $textimg['button']['url'] }}">{{ $textimg['button']['title'] }}</a>
				@endif
			</div>

		</div>
	</div>

</section>