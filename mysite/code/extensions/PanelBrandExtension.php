<?php
/**
 * Adds new fields to brand
 */

class PanelBrandExtension extends DataExtension {
	private static $db = array(
		'PanelBackgroundColour' => 'Varchar(16)',
		'PanelFontColour' => 'Varchar(16)',
		'PanelBackgroundColourHover' => 'Varchar(16)',
		'PanelFontColourHover' => 'Varchar(16)'
	);

	public function updateCMSFields(FieldList $fields) {

		$fields->addFieldsToTab('Root.Colours',
			LiteralField::create('PanelLit', '<h3>Panels</h3>')
		);
		$fields->addFieldToTab(
			'Root.Colours',
			ColorPaletteField::create('PanelBackgroundColour', 'Panel background colour' ,$this->owner->getFullPalette())
		);
		$fields->addFieldToTab(
			'Root.Colours',
			ColorPaletteField::create('PanelFontColour', 'Panel font colour', $this->owner->getFullPalette())
		);
		$fields->addFieldToTab(
			'Root.Colours',
			ColorPaletteField::create('PanelBackgroundColourHover', 'Panel background colour (hover)' ,$this->owner->getFullPalette())
		);
		$fields->addFieldToTab(
			'Root.Colours',
			ColorPaletteField::create('PanelFontColourHover', 'Panel font colour (hover)', $this->owner->getFullPalette())
		);
	}
}
