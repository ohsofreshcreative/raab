@php
$sectionClass = '';
$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
@endphp

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="offer-cards -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">
	<div class="{{ $block->classes }}">

		<div class="__wrapper c-main">
			<h2 class="w-1/2 m-auto text-center">{{ $title }}</h2>
			@if(!empty($offer_cards))
			@if($display_type === 'grid')
			<div class="__grid mt-10 columns-{{ $columns ?? '3' }}">
				@foreach($offer_cards as $card)
				<div class="__card b-border px-8 py-10">
					@if(!empty($card['offer_image']))
					<div class="__img m-img">
						{!! wp_get_attachment_image($card['offer_image']['ID'], 'medium', false, ['class' => 'img-fluid']) !!}
					</div>
					@endif

					@if(!empty($card['offer_title']))
					<h5 class="__title m-title">{{ $card['offer_title'] }}</h5>
					@endif

					@if(!empty($card['offer_description']))
					<div class="__txt">{{ $card['offer_description'] }}</div>
					@endif

					@if(!empty($card['cta']))
					<a href="{{ $card['cta']['url'] }}" class="underline-btn" target="{{ $card['cta']['target'] }}">
						Zobacz
					</a>
					@endif
				</div>
				@endforeach
			</div>
		</div>
		@else
		<div class="swiper offer-swiper c-main !overflow-visible">
			<div class="__arrows absolute flex gap-4">
				<div class="swiper-button-prev">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
						<path d="M13.2296 5.31498C13.2293 5.31469 13.2291 5.31435 13.2287 5.31406L8.41118 0.281803C8.05027 -0.0951806 7.46652 -0.0937777 7.10727 0.285093C6.74806 0.663916 6.74944 1.27664 7.11036 1.65367L10.3449 5.03226H1.42198C0.912773 5.03226 0.5 5.46552 0.5 6C0.5 6.53448 0.912773 6.96774 1.42198 6.96774H10.3448L7.1104 10.3463C6.74949 10.7234 6.74811 11.3361 7.10731 11.7149C7.46656 12.0938 8.05037 12.0951 8.41123 11.7182L13.2288 6.68594C13.2291 6.68565 13.2293 6.68531 13.2296 6.68502C13.5907 6.30673 13.5896 5.69202 13.2296 5.31498Z" fill="#292929" />
					</svg>
				</div>

				<div class="swiper-button-next">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
						<path d="M13.2296 5.31498C13.2293 5.31469 13.2291 5.31435 13.2287 5.31406L8.41118 0.281803C8.05027 -0.0951806 7.46652 -0.0937777 7.10727 0.285093C6.74806 0.663916 6.74944 1.27664 7.11036 1.65367L10.3449 5.03226H1.42198C0.912773 5.03226 0.5 5.46552 0.5 6C0.5 6.53448 0.912773 6.96774 1.42198 6.96774H10.3448L7.1104 10.3463C6.74949 10.7234 6.74811 11.3361 7.10731 11.7149C7.46656 12.0938 8.05037 12.0951 8.41123 11.7182L13.2288 6.68594C13.2291 6.68565 13.2293 6.68531 13.2296 6.68502C13.5907 6.30673 13.5896 5.69202 13.2296 5.31498Z" fill="#292929" />
					</svg>
				</div>
			</div>
			<div class="swiper-wrapper">

				@foreach($offer_cards as $card)
				<div class="swiper-slide ab">
					<div class="__card bg-secondary px-10 py-10">
						<div class="__rectangle absolute"></div>
						@if(!empty($card['offer_image']))
						<div class="__img mt-16">
							{!! wp_get_attachment_image($card['offer_image']['ID'], 'medium', false, ['class' => 'img-fluid']) !!}
						</div>
						@endif

						@if(!empty($card['offer_title']))
						<h5 class="text-white block pt-15">{{ $card['offer_title'] }}</h5>
						@endif

						@if(!empty($card['offer_description']))
						<div class="__txt">{{ $card['offer_description'] }}</div>
						@endif

						@if(!empty($card['cta']))
						<a href="{{ $card['cta']['url'] }}" class="underline-btn" target="{{ $card['cta']['target'] }}">
							Zobacz
						</a>
						@endif
					</div>
				</div>
				@endforeach
			</div>
		</div>
		@endif
		@else
		<div class="no-data">Brak danych oferty. Dodaj je w ustawieniach.</div>
		@endif
	</div>

</section>


<!-- 	<div class="swiper">
  <div class="swiper-wrapper">
    <div class="swiper-slide">Slide 1</div>
    <div class="swiper-slide">Slide 2</div>
    <div class="swiper-slide">Slide 3</div>
  </div>

  <div class="swiper-pagination"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div> -->