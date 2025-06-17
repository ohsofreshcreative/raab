<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HeroOffer extends Block
{
	public $name = 'Sekcja Hero - Oferta';
	public $description = 'HeroOffer';
	public $slug = 'hero-offer';
	public $category = 'formatting';
	public $icon = 'align-full-width';
	public $keywords = ['tresc', 'zdjecie'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields()
	{
		$hero_offer = new FieldsBuilder('hero-offer');

		$hero_offer
			->setLocation('block', '==', 'acf/hero-offer') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Hero',
				'open' => false,
				'multi_expand' => true,
			])
			->addTab('Treść', ['placement' => 'top']) 
			->addGroup('hero_offer', ['label' => 'Hero'])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'medium',
			])
			->addText('title', ['label' => 'Tytuł'])
			->addWysiwyg('content', [
				'label' => 'Treść',
				'tabs' => 'all', // 'visual', 'text', 'all'
				'toolbar' => 'full', // 'basic', 'full'
				'media_upload' => true,
			])
			->addLink('cta', [
				'label' => 'Przycisk',
				'return_format' => 'array',
			])

			->endGroup()

			->addTab('Ustawienia bloku', ['placement' => 'top']) 

			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $hero_offer;
	}

	public function with()
	{
		return [
			'hero_offer' => get_field('hero_offer'),
			'flip' => get_field('flip'),
		];
	}
}
