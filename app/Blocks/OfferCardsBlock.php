<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class OfferCardsBlock extends Block
{
	/**
	 * The block name.
	 *
	 * @var string
	 */
	public $name = 'Kafelki oferty';

	/**
	 * The block description.
	 *
	 * @var string
	 */
	public $description = 'Blok wyświetlający kafelki oferty z ustawień';

	/**
	 * The block slug.
	 *
	 * @var string
	 */
	public $slug = 'offer-cards-block';

	/**
	 * The block category.
	 *
	 * @var string
	 */
	public $category = 'formatting';

	/**
	 * The block icon.
	 *
	 * @var string|array
	 */
	public $icon = 'grid-view';

	/**
	 * The block keywords.
	 *
	 * @var array
	 */
	public $keywords = ['offer', 'cards', 'oferta', 'kafelki'];

	/**
	 * The default block mode.
	 *
	 * @var string
	 */
	public $mode = 'edit';

	/**
	 * The supported block features.
	 *
	 * @var array
	 */
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
		'multiple' => true,
		'anchor' => true,
		'customClassName' => true,
	];

	/**
	 * Data to be passed to the block before rendering.
	 *
	 * @return array
	 */

	/**
	 * The block field group.
	 *
	 * @return array
	 */
	public function fields()
	{
		$offerCardsBlock = new FieldsBuilder('offer-cards-block');

		$offerCardsBlock
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Kafelki oferty',
				'open' => false,
				'multi_expand' => true,
			])
			->addText('title')
			->addSelect('display_type', [
				'label' => 'Typ wyświetlania',
				'choices' => [
					'grid' => 'Siatka',
					'slider' => 'Slider',
				],
				'default_value' => 'grid',
				'required' => 1,
			])
			->addSelect('columns', [
				'label' => 'Liczba kolumn (w siatce)',
				'choices' => [
					'2' => '2 kolumny',
					'3' => '3 kolumny',
					'4' => '4 kolumny',
				],
				'default_value' => '3',
				'required' => 0,
				'conditional_logic' => [
					[
						[
							'field' => 'display_type',
							'operator' => '==',
							'value' => 'grid',
						],
					],
				],
			]);

		return $offerCardsBlock->build();
	}

	public function with()
	{
		return [
			'block_title' => get_field('block_title'),
			'display_type' => get_field('display_type'),
			'columns' => get_field('columns'),
			'offer_cards' => get_field('offer-cards', 'option'),
			'title' => get_field('title')
		];
	}

	/**
	 * Assets to be enqueued when rendering the block.
	 *
	 * @return void
	 */
}
