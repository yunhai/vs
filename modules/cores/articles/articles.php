<?php

global $vsStd;
$vsStd->requireFile(CORE_PATH . "articles/Article.class.php");

class articles extends VSFObject {
	public $obj;
	function __construct() {
		global $vsMenu, $vsStd, $bw;
		parent::__construct();
                
		$this->categoryField 	= "articleCatId";
		$this->primaryField     = "articleId";
		$this->basicClassName   = "Article";
		$this->tableName        = 'article';
		$this->obj = $this->createBasicObject ();
		$this->categories = $vsMenu->getCategoryGroup($bw->input['module']);
	}
	
	function __destruct() {
		unset($this);
	}

	function getObjByModule($module = "articles", $size = 10) {
		global $bw, $vsSettings, $vsMenu;
		
		$categories = $vsMenu->getCategoryGroup($module);
		$strIds = $vsMenu->getChildrenIdInTree($categories);
		
		$this->setTableName('article, vsf_seo');
		
		$cond = $this->getCondition();
		if($cond) $cond .= " AND ";
		$this->setCondition("articleId = seoObj AND seoModule = '".$module."' AND articleCatId in (".$strIds.") AND articleStatus > 0".$cond);
		$this->setLimit(array(0, $size));
		
		$extend = array('seourl'=>'seoAliasUrl');
		
		return $this->getAdvanceObjectsByCondition('getId', 0, 2, $extend);
	}
}
?>