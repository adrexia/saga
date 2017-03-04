<?php
/**
 * Panels
 *
 * @category model
 */
class Panel extends DataObject {

	/**
	 * @var array
	 * @static
	 */
	private static $db = array(
		'Title' => 'Varchar(255)',
		'Width' => 'Varchar(255)',
		'Type' => 'Enum("Content, HTML, Image, News", "Content")',
		'Content' => 'Text',
		'SubTitle' => 'Varchar(255)',
		'HTML' => 'HTMLText',
		'NumberToDisplay' =>'Int',
		'Sort' => 'Int',
		'Archived' => 'Boolean'
	);


	/**
	 * @var array
	 * @static
	 */
	private static $has_one = array(
		'Parent' => 'Page',
		'Link' => 'Link',
		'Image' => 'Image'
	);

	/**
	 * @var array
	 * @static
	 */
	private static $summary_fields = array(
		'Type' => 'Type',
		'Title' => 'Title',
		'WidthNice' => 'Width',
		'Link.Title' => 'Link',
		'ArchivedStatus' => 'Status'
	);

	/**
	 * @var array
	 * @static
	 */
	private static $default_sort = "Sort";

	/**
	 * Returns a FieldList of cms form fields
	 *
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		// Hide these from editing
		$fields->removeByName('ParentID');
		$fields->removeByName('Sort');

		//Remove to re-add
		$fields->removeByName('Type');

		$content = $fields->dataFieldByName('Content');
		$numberToDisplay = $fields->dataFieldByName('NumberToDisplay');
		$html = $fields->dataFieldByName('HTML');
		$subtitle = $fields->dataFieldByName('SubTitle');

		// $fields->dataFieldByName('Width');

		$fields->replaceField('Width',
			$width =  DropdownField::create('Width', 'Width', $this->getColumns())
		);

		$width->setDescription("Width of panel at desktop size");


		$html->setRows(20);

		$fields->insertAfter(
			$link = LinkField::create('LinkID', 'Link'),
			'Content'
		);

		$image = $fields->dataFieldByName('Image');
		$image->setFolderName('Uploads/Small-Images');

		$fields->removeByName('Image');

		$fields->insertAfter(
			$type = OptionSetField::create(
				"Type", "Type",
				$this->dbObject('Type')->enumValues()
			), "Width"
		);

		$type->addExtraClass('inline-short-list');

		$fields->insertAfter($imageUpload = DisplayLogicWrapper::create($image), 'LinkID');
		$imageUpload->hideUnless("Type")->isEqualTo("Content")->orIf("Type")->isEqualTo("Image");

		$html->hideUnless("Type")->isEqualTo("HTML");
		$subtitle->hideUnless("Type")->isEqualTo("HTML");

		$link->hideUnless("Type")->isEqualTo("Content")->orIf("Type")->isEqualTo("Image");

		$numberToDisplay->hideUnless("Type")->isEqualTo("News");

		$content->hideUnless("Type")->isEqualTo("Content");

		// Archived
		$fields->removeByName('Archived');
		$fields->addFieldToTab('Root.Main', $group = new CompositeField(
			$label = new LabelField("LabelArchive","Archive this feature?"),
			new CheckboxField('Archived', '')
		));

		$group->addExtraClass("special field");
		$label->addExtraClass("left");

		return $fields;
	}

	/**
	 * Returns the anchor tag href attribute for the InternalLink
	 *
	 * @return string
	 */
	public function getLinkHref() {
		if ($this->InternalLinkID) {
			return $this->InternalLink()->Link();
		}
	}

	/**
	 * Returns the anchor tag class attribute for the InternalLink
	 *
	 * @return string (internal link: LinkingMode) | null (external link)
	 */
	public function getLinkClass() {
		if ($this->InternalLinkID) {
			return $this->InternalLink()->LinkingMode();
		}
		return null;
	}


	/**
	 * Returns a description of the 'Archived' attribute state, for display in a GridField summary field
	 *
	 * @return string
	 */
	public function ArchivedStatus() {
		if ($this->Archived == 1) {
			return _t('GridField.Archived', 'Archived');
		}
		return _t('GridField.Live', 'Live');
	}

	public function NewsPage() {
		return NewsPage::get_one('NewsPage');
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
		if (!$this->Width){
			return '1';
		}
		$columns = $this->getColumns();
		return $columns[$this->Width];
	}

	/**
	 * @param Member $member
	 * @return boolean
	 */
	public function canCreate($member = null) {
		return $this->Parent()->canCreate($member);
	}

	/**
	 * @param Member $member
	 * @return boolean
	 */
	public function canEdit($member = null) {
		return $this->Parent()->canEdit($member);
	}

	/**
	 * @param Member $member
	 * @return boolean
	 */
	public function canDelete($member = null) {
		return $this->Parent()->canDelete($member);
	}

	/**
	 * @param Member $member
	 * @return boolean
	 */
	public function canView($member = null) {
		return $this->Parent()->canView($member);
	}
}
