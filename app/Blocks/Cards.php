<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Cards extends Block
{
	public $name = 'Kafelki';
	public $description = 'cards';
	public $slug = 'cards';
	public $category = 'formatting';
	public $icon = 'ellipsis';
	public $keywords = ['cards', 'kafelki'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields()
	{
		$cards = new FieldsBuilder('cards');

		$cards
			->setLocation('block', '==', 'acf/cards') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Kafelki',
				'open' => false,
				'multi_expand' => true,
			])
			/*--- FIELDS ---*/
			->addTab('Treści', ['placement' => 'top'])
			->addGroup('tiles', ['label' => ''])

			->addText('title', ['label' => 'Tytuł'])

			->addRepeater('repeater', [
				'label' => 'Kafelki',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'min' => 1,
				'max' => 4,
				'button_label' => 'Dodaj kafelek'
			])
			->addImage('card_image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'medium',
			])
			->addText('card_title', [
				'label' => 'Nagłówek',
			])
			->addTextarea('card_txt', [
				'label' => 'Opis',
				'rows' => 4,
				'new_lines' => 'br',
			])
			->endRepeater()

			->endGroup()

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('lightbg', [
				'label' => 'Jasne tło',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('nomt', [
				'label' => 'Usunięcie marginesu górnego',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $cards;
	}

	public function with()
	{
		return [
			'tiles' => get_field('tiles'),
			'about2' => get_field('about2'),
			'flip' => get_field('flip'),
			'lightbg' => get_field('lightbg'),
			'nomt' => get_field('nomt'),
		];
	}
}
