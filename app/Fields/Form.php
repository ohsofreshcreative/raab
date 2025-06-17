<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Form extends Field
{
	public $name = 'Formularz oraz zdjęcie';
	public $description = 'Form';
	public $slug = 'forms';
	public $category = 'formatting';
	public $icon = 'email';
	public $keywords = ['formularz', 'zdjecie'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields(): array
	{
		$forms = new FieldsBuilder('forms');

		$forms
			->setLocation('options_page', '==', 'forms') // ważne!
			/*--- FIELDS ---*/
			->addTab('Treść', ['placement' => 'top'])
			->addGroup('forms', ['label' => ''])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'medium',
			])
			->addText('title', ['label' => 'Tytuł'])
			->addText('subtitle', ['label' => 'Śródtytuł'])
			->addText('shortcode', [
				'label' => 'Kod formularza',
				'instructions' => 'Wklej shortcode formularza, np. [contact-form-7 id="84690e3" title="Contact form 1"]',
				'required' => 1,
			])
			->endGroup()

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);


		return [$forms];
	}
}
