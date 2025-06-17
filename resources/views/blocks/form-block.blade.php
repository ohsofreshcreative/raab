@php
$sectionClass = '';
@endphp

<section data-gsap-anim="section" class="form grid grid-cols-1 lg:grid-cols-2 -smt bg-dark {{ $sectionClass }}">
	<div class="__form w-3/5 py-20 m-auto">

		<h2 class="text-white">{{ $forms['title'] }}</h2>
		<h5 class="text-white">{{ $forms['subtitle'] }}</h5>
		<div class="contact-form-container">
			{!! do_shortcode($forms['shortcode']) !!}
		</div>
	</div>
	<div>
		@if (!empty($forms['image']))
		<img class="__img object-cover w-full h-full" src="{{ $forms['image']['url'] }}" alt="{{ $forms['image']['alt'] ?? '' }}">
		@endif
	</div>

</section>