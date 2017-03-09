<?php
class Page extends SiteTree {

	private static $icon = "mysite/images/sitetree_images/page.png";

	private static $db = array(
		'Intro' => 'Text',
		'PanelMargin' => "Int",
		'ShowNavigationPanel' => 'Boolean',
		'NavigationPosition' => 'Enum("With Panels, With Content", "With Content")',
		'NavigationWidth' => 'Varchar(255)',
		'HideOverlay' => 'Boolean'
	);

	private static $has_many = array(
		'Panels' => 'Panel'
	);


	private static $defaults = array('ShowNavigationPanel' => true, 'NavigationWidth' => 'three');

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

			$fields->addFieldsToTab('Root.Navigation', array(
				$navBool = CheckboxField::create('ShowNavigationPanel', 'Show navigation panel'),
				OptionSetField::create("NavigationPosition", "Navigation position", $this->dbObject('NavigationPosition')->enumValues()),
				$width =  DropdownField::create('NavigationWidth', 'Navigation Width', $this->getColumns())
			));

			$navBool->setDescription('Displays a navigation panel within a page');
			$width->setDescription("Width of navigation panel at desktop size");

		}

		return $fields;
	}

	public function getSettingsFields() {
		$fields = parent::getSettingsFields();

		$fields->addFieldToTab('Root.Settings', $overlay = CheckboxField::create('HideOverlay', 'Turn of the image overlay'));

		$overlay->setDescription('Note: the overlay helps with the accessiblity of header text');

		return $fields;
	}


	public function getColumns() {
		return array(
			'three' => '1/4',
			'four' => '1/3',
			'eight' => '2/3',
			'six' => '1/2',
			'nine' => '3/4',
			'twelve' => '1'
		);
	}

	public function getWidthNice() {
		if (!$this->NavigationWidth){
			return '1';
		}
		$columns = $this->getColumns();
		return $columns[$this->NavigationWidth];
	}

	public function ContentWidth() {
		if($this->NavigationPosition === 'With Panels') {
			return 'twelve';
		}

		$opts = array(
			'three' => 'nine',
			'four' => 'eight',
			'eight' => 'four',
			'six' => 'six',
			'nine' => 'three',
			'twelve' => 'twelve'
		);

		return $this->NavigationWidth ? $opts[$this->NavigationWidth] : 'twelve';
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
