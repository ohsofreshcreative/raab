@php
$sectionClass = '';
@endphp

<section data-gsap-anim="section" class="contact -spt {{ $sectionClass }}">
	<div class="__wrapper c-main-wide grid grid-cols-1 lg:grid-cols-2 gap-10">
		<div class="__content w-full lg:w-11/12 flex flex-col justify-between">
			<div class="__data">
				<h1 class="__txt m-title">{!! $g_contact_1['title'] !!}</h1>
				<div class="__txt mt-8">{!! $g_contact_1['txt'] !!}</div>
				<a class="__phone flex items-center w-max mt-4" href="tel:{{ $g_contact_1['phone'] }}">{{ $g_contact_1['phone'] }}</a>
				<a class="__mail flex items-center w-max mt-2" href="mailto:{{ $g_contact_1['phone'] }}">{{ $g_contact_1['mail'] }}</a>
			</div>
			<img class="__img object-cover w-full img-xs" src="{{ $g_contact_1['image']['url'] }}" alt="{{ $g_contact_1['image']['alt'] ?? '' }}">
		</div>
		<div class="__form b-border bg-white p-10 ">
			<h2>{{ $g_contact_2['title'] }}</h2>
			<h5>{{ $g_contact_2['subtitle'] }}</h5>
			<div class="contact-form-container">
				{!! do_shortcode($g_contact_2['shortcode']) !!}
			</div>
		</div>
	</div>

</section>