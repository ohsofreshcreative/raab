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
	public $description = 'Blok wyświetlający automatycznie kafelki z CPT Oferta';

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

			->addTab('Elementy', ['placement' => 'top'])
			->addText('title')
			->addWysiwyg('content', [
				'label' => 'Treść',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => true,
			])
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
			])
			
			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addText('section_id', [
				'label' => 'ID',
			])
			->addText('section_class', [
				'label' => 'Dodatkowe klasy CSS',
			])
			
			->addTrueFalse('nomt', [
				'label' => 'Usunięcie marginesu górnego',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('gap', [
				'label' => 'Większy odstęp',
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
			->addTrueFalse('graybg', [
				'label' => 'Szare tło',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('whitebg', [
				'label' => 'Białe tło',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('brandbg', [
				'label' => 'Tło marki',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $offerCardsBlock->build();
	}

	public function with()
	{
		return [
			'block_title' => get_field('block_title'),
			'display_type' => get_field('display_type'),
			'columns' => get_field('columns'),
			'offer_cards' => $this->getOfferCardsFromCpt(),
			'title' => get_field('title'),
			'content' => get_field('content'),
			'nomt' => get_field('nomt'),
			'lightbg' => get_field('lightbg'),
			'graybg' => get_field('graybg'),
			'whitebg' => get_field('whitebg'),
			'brandbg' => get_field('brandbg'),
			'section_id' => get_field('section_id'),
			'section_class' => get_field('section_class'),
		];
	}

	/**
	 * Build cards data from CPT Oferta so the Blade view can keep the same structure.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	protected function getOfferCardsFromCpt(): array
	{
		$posts = \get_posts([
			'post_type' => 'offer',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'suppress_filters' => false,
		]);

		if (empty($posts)) {
			return [];
		}

		$cards = [];

		foreach ($posts as $post) {
			$postId = $post->ID;
			$excerpt = \get_the_excerpt($postId);

			if (empty($excerpt)) {
				$excerpt = \wp_trim_words(\wp_strip_all_tags($post->post_content), 24);
			}

			$thumbnailId = \get_post_thumbnail_id($postId);

			$cards[] = [
				'offer_title' => \get_the_title($postId),
				'offer_description' => $excerpt,
				'offer_image' => $thumbnailId ? ['ID' => $thumbnailId] : null,
				'cta' => [
					'url' => \get_permalink($postId),
					'target' => '_self',
				],
			];
		}

		return $cards;
	}

	/**
	 * Assets to be enqueued when rendering the block.
	 *
	 * @return void
	 */
}
