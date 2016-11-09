<?php

require_once(CORE_PATH."partners/Partner.class.php");
class partners extends VSFObject {
	public $obj;

	protected $categoryField 	="";
	protected $relTableName 	="";
	protected $categories 		= array();

	function __construct(){
		parent::__construct();
		$this->categoryField 	= "partnerCatId";
		$this->primaryField 	= 'partnerId';
		$this->basicClassName 	= 'Partner';
		$this->tableName 		= 'partner';
		$this->relTableName 	= "rel_partner_file";
		$this->obj = $this->createBasicObject();
		$this->categories = $this->vsMenu->getCategoryGroup(strtolower($this->tableName."s"));
	}

	/**
	 * @return the $relTableName
	 */
	public function getPartnersForUser() {
		return $this->arrayObj	=	$this->getPartnerList();
	}
	/**
	 * @return the $relTableName
	 */
	public function getRelTableName() {
		return $this->relTableName;
	}

	/**
	 * @param $relTableName the $relTableName to set
	 */
	public function setRelTableName($relTableName) {
		$this->relTableName = $relTableName;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
	}

	/**
	 * @param $categoryField the $categoryField to set
	 */
	public function setCategoryField($categoryField) {
		$this->categoryField = $categoryField;
	}

	/**
	 * @return the $categories
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * @return the $categoryField
	 */
	public function getCategoryField() {
		return $this->categoryField;
	}
	/**
	 * @return the $categoryField
	 */
	public function getListWithCat($treeCat) {
		if(!is_object($treeCat))
		return false;
		$ids=$this->vsMenu->getChildrenIdInTree($treeCat);
		if($ids)
		$this->condition = "partnerCatId in ( {$ids})";
		$this->limit=array(0,8);
		return $this->getObjectsByCondition();
	}
	/**
	 * @return the $categoryField
	 */
	public function getOtherList($obj) {
		global $vsMenu;
		$cat=$vsMenu->getCategoryById($obj->getCatId());
		$ids=$vsMenu->getChildrenIdInTree($cat);
		$this->condition = "partnerId <> {$obj->getId()}";
		if($ids)
		$this->condition .= " and partnerCatId in ( {$ids})";
		return $this->getObjectsByCondition();
	}

	/**
	 * @return the $categoryField
	 */
	public function getPartnerList($condition="") {
		global $vsMenu;
		$ids=$vsMenu->getChildrenIdInTree($this->getCategories());
		$this->condition = "partnerStatus > 0 and partnerCatId in ( {$ids})";
		if($condition)
		$this->condition .= " and {$condition}";
		return $this->getObjectsByCondition();
	}

	function __destruct(){
		unset($this);
	}

	function delete($ids = 0) {
		global $vsStd;
		$this->createMessageSuccess($this->vsLang->getWords('partner_delete_by_id_success', "Deleted partner successfully!"));
		// Get objects information
		$this->fieldsString = "partnerFileId";
		$this->condition = "partnerId IN (".$ids .")";
		$list = $this->getObjectsByCondition();
		if(!count($list)) return false;
		// Delete news data
		$this->condition = "partnerId IN (".$ids .")";
		if(!$this->deleteObjectByCondition()) return false;
		foreach ($list as $news){
			$this->vsFile->deleteFile($news->getFileId());
		}
		unset($news);
		unset($list);
		return true;
	}

	public function updateStatus($ids, $status){
		$this->setCondition("partnerId IN (". $ids.")");
		return $this->updateObjectByCondition($status);
	}
	
	
	function getPartnerByCatName($catName){
		foreach( $this->categories->getChildren() as $cat){
			if(strtolower($cat->getTitle()) == strtolower($catName)){
				$catObj = $cat;
				break;
			}
		}
	
		if($catObj) $this->setCondition("partnerCatId in(".$catObj->getId().")");
		return $this->getObjectsByCondition();
	}
}
?>