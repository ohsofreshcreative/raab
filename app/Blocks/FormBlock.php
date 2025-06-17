<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FormBlock extends Block
{
	public $name = 'Formularz';
	public $description = 'FormBlock';
	public $slug = 'form-block'; // Changed slug to be more specific
	public $category = 'formatting';
	public $icon = 'email';
	public $keywords = ['offer', 'cards', 'oferta', 'kafelki'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
		'multiple' => true,
		'anchor' => true,
		'customClassName' => true,
	];

	/**
	 * The block field group.
	 *
	 * @return array
	 */
	public function fields()
	{
		$formBlock = new FieldsBuilder('form_block'); // Changed key from 'form' to 'form_block'

		$formBlock
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Formularz',
				'open' => false,
				'multi_expand' => true,
			])
			->addMessage('Edycja', 'Formularz edytujemy klikajac w menu panelu w poe "Formularz".');

		return $formBlock->build();
	}

	/**
	 * Data to be passed to the block before rendering.
	 *
	 * @return array
	 */
	public function with()
	{
		return [
			'forms' => get_field('forms', 'option'),
		];
	}
}
