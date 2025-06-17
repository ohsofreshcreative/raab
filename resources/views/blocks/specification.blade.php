@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';

$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
@endphp

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="specification -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">

	<div class="__wrapper c-main ">
		<h2 data-gsap-element="header" class="w-full lg:w-1/2">{{ $g_specification['title'] }}</h2>
		<div class="grid grid-cols-1 md:grid-cols-[1fr_2fr] gap-10 mt-10">
			@if (!empty($g_specification['image']))
			<img data-gsap-element="image" class="object-cover __img order1" src="{{ $g_specification['image']['url'] }}" alt="{{ $g_specification['image']['alt'] ?? '' }}">
			@endif
			<div class="__content order2">
				<h3 data-gsap-element="header" class="">{{ $g_specification['subtitle'] }}</h3>
				<div data-gsap-element="header" class="mt-2">
					{!! $g_specification['content'] !!}
				</div>
				@if (!empty($g_specification['button']))
				<a class="main-btn m-btn" href="{{ $g_specification['button']['url'] }}">{{ $g_specification['button']['title'] }}</a>
				@endif
				<div data-gsap-element="accordion" class="accordion-wrapper grid mt-6">
					@foreach ($repeater as $item)
					<div class="accordion">
						<input
							class="acc-check"
							type="radio"
							name="radio-a"
							id="check{{ $loop->index }}"
							{{ $loop->first ? 'checked' : '' }}>
						<label class="accordion-label" for="check{{ $loop->index }}">{{ $item['title'] }}</label>
						<div class="accordion-content">
							<p>{!! $item['txt'] !!}</p>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>



	</div>

</section>