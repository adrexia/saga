<?php
/**
 * Adds new fields to brand
 */

class MenuPanelBrandExtension extends DataExtension {
	private static $db = array(
		'MenuPanelBackgroundColour' => 'Varchar(16)',
		'MenuPanelLinkColour' => 'Varchar(16)',
	);

	public function updateCMSFields(FieldList $fields) {

		$fields->insertAfter(
			ColorPaletteField::create('MenuPanelBackgroundColour', 'Menu Panel background colour' ,$this->owner->getFullPalette()),
			'MenuFontColour'
		);
		$fields->insertAfter(
			ColorPaletteField::create('MenuPanelLinkColour', 'Menu Panel link colour' ,$this->owner->getFullPalette()),
			'MenuPanelBackgroundColour'
		);
	}
}
