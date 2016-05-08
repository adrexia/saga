<?php
/**
 *Adds new global settings.
 */

class CustomSiteConfig extends DataExtension {
	private static $db = array(
		'GACode' => 'Varchar(16)'
	);


	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab('Root.Main',
		$gaCode = new TextField('GACode', 'Google Analytics account'));
		$gaCode->setRightTitle('Account number to be used all across the site (in the format <strong>UA-XXXXX-X</strong>)');
	}
}
