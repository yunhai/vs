<?php
require_once(CORE_PATH."products/Product.class.php");
class products extends VSFObject {
	public $obj;
	protected $categoryField 	="";
	protected $relTableName 	="";
	protected $categories 		= array();
	
	function __construct(){
		$this->requireFileUseFull();
		parent::__construct();
		$this->categoryField 	= "productCatId";
		$this->primaryField 	= 'productId';
		$this->basicClassName 	= 'Product';
		$this->tableName 		= 'product';
		
		$this->relTableName 	= "product_category";
		$this->obj = $this->createBasicObject();
		$this->fields = $this->obj->convertToDB();
		$this->categories = array();
         $this->categories = $this->vsMenu->getCategoryGroup(strtolower($this->tableName."s"));
	}
	
	/**
	 * @param $categories the $categories to set
	 */
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
	
	function requireFileUseFull() {
		global $vsStd;
		$vsStd->requireFile(UTILS_PATH."TextCode.class.php");
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
		if(!is_object($treeCat)) return false;
		
		global $vsSettings;
		$ids = $this->vsMenu->getChildrenIdInTree($treeCat);
		if($ids) $this->condition = "productCatId in ( {$ids})";
		$this->limit = array(0, $vsSettings->getSystemKey('product_listCat_Quality', 10, 'products'));
		return $this->getObjectsByCondition();
	}
	
	/**
	 * @return the $categoryField
	 */
	public function getOtherList($obj) {
		$cat=$this->vsMenu->getCategoryById($obj->getCatId());
		$ids=$this->vsMenu->getChildrenIdInTree($cat);
		$this->condition = "productId <> {$obj->getId()}";
		if($ids)
			$this->condition .= " and productCatId in ( {$ids})";
		return $this->getObjectsByCondition();
	}
	
	/**
	 * @return the $categoryField
	 */
	public function getHotList() {
		global $vsSettings;
		$ids=$this->vsMenu->getChildrenIdInTree($this->getCategories());
		$this->condition .= " productStatus > 0 and productCatId in ( {$ids})";
		$this->setOrder("productIndex DESC, productId DESC");
		$this->setLimit(array(0,$vsSettings->getSystemKey('product_hotList_Quality', 10, 'products')));
		return $this->getObjectsByCondition();
	}
	
	function __destruct(){	
		unset($this);
	}	
	
	function delete($ids = 0) {
		global $vsStd;
		$this->createMessageSuccess($this->vsLang->getWords('product_delete_by_id_success', "Deleted product successfully!"));
		// Get objects information
		$this->fieldsString = "productImage";
		$this->condition = "productId IN (".$ids .")";
		$list = $this->getObjectsByCondition();
		if(!count($list)) return false;
		// Delete product data
		$this->condition = "productId IN (".$ids .")";
		if(!$this->deleteObjectByCondition()) return false;
		foreach ($list as $product){
			$this->vsFile->deleteFile($product->getImage());
		}	
		unset($product);
		unset($list);
		return true;
	}
	
	public function updateStatus($ids, $status){
		$this->setCondition("productId IN (". $ids.")");
		return $this->updateObjectByCondition($status);
	}
}
?>