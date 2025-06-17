<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Specification extends Block
{
	public $name = 'Specyfikacja';
	public $description = 'specification';
	public $slug = 'specification';
	public $category = 'formatting';
	public $icon = 'feedback';
	public $keywords = ['specification'];
	public $mode = 'edit'; 
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
		'anchor' => true,
		'customClassName' => true,
	];

	public function fields()
	{
		$specification = new FieldsBuilder('specification');

		$specification
			->setLocation('block', '==', 'acf/specification') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Specyfikacja',
				'open' => false,
				'multi_expand' => true,
			])
			/*--- TAB #1 ---*/
			->addTab('Treść', ['placement' => 'top'])
			->addGroup('g_specification', ['label' => ''])
			->addText('title', ['label' => 'Tytuł'])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'medium',
			])
			->addText('subtitle', ['label' => 'Sródtytuł'])
			->addWysiwyg('content', [
				'label' => 'Treść',
				'tabs' => 'all', // 'visual', 'text', 'all'
				'toolbar' => 'full', // 'basic', 'full'
				'media_upload' => true,
			])
			->endGroup()

			/*--- TAB #2 ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addRepeater('repeater', [
				'label' => 'specification',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'min' => 1,
				'max' => 4,
				'button_label' => 'Dodaj pytanie'
			])
			->addText('title', [
				'label' => 'Pytanie',
			])
			->addWysiwyg('txt', [
				'label' => 'Odpowiedź',
				'tabs' => 'all', // 'visual', 'text', 'all'
				'toolbar' => 'full', // 'basic', 'full'
				'media_upload' => true,
			])
			->endRepeater()

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $specification;
	}

	public function with()
	{
		return [
			'g_specification' => get_field('g_specification'),
			'repeater' => get_field('repeater'),
			'flip' => get_field('flip'),
		];
	}
}
