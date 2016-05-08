<?php
class Page extends SiteTree {

	private static $icon = "mysite/images/sitetree_images/page.png";

	private static $db = array(
		'Intro' => 'Text',
		'PanelMargin' => "Int"
	);

	private static $has_many = array(
		'Panels' => 'Panel'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->insertBefore(TextareaField::create('Intro', 'Intro'),'Content');

		if($this->ClassName === "Page" || $this->ClassName === "HomePage") {

			$gridField = new GridField(
				'Panels',
				'Panel',
				$this->Panels()->sort(array('Sort'=>'ASC','Archived'=>'ASC')),
				$config = GridFieldConfig_RelationEditor::create()
			);
			$gridField->setModelClass('Panel');
			$fields->addFieldToTab('Root.Panels', $gridField);

			$config->addComponent(new GridFieldOrderableRows());

			$fields->addFieldToTab('Root.Panels',
				$panelmargin = TextField::create('PanelMargin', 'Panel Margin (px)')
			);

		}

		return $fields;
	}

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
	);

	public function init() {
		parent::init();
		Requirements::set_force_js_to_bottom(true);
	}

	public function HomePage() {
		return HomePage::get_one('HomePage');
	}

	public function LoginLink() {
		return Controller::join_links(
			Injector::inst()->get('Security')->Link(),
			'login',
			'?BackURL=' . urlencode($this->Link())
		);
	}

	public function CMSAccess() {
		return Permission::check('ADMIN') || Permission::check('CMS_ACCESS_LeftAndMain');
	}

	// Strip underscores and spaces from a string
	public function NiceString($title, $sentenceCase = false) {
		$title = str_replace("_",  " ", $title);
		if ($sentenceCase) {
			$title = ucfirst($title);
		}
		return str_replace("-",  " ", $title);
	}

	public function CountCharacters($string) {
		return strlen($string);
	}

	/**
	 * Get the {@link Panel} objects attached to this page
	 *
	 * @return ArrayList
	 */
	public function Panels() {
		return $this->getComponents('Panels')->sort('SortOrder');
	}

	/**
	 * Get the {@link Panel} objects attached to this page that are not Archived
	 *
	 * @return ArrayList
	 */
	public function CurrentPanels() {
		return $this->Panels()->filter('Archived', false)->sort('Sort');
	}

	public function PanelMarginHalf(){
		return $this->PanelMargin / 2;
	}
}
