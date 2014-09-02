<?php 
require_once(CORE_PATH."banners/Banner.class.php");

class banners extends VSFObject {


	/**
	*Enter description here ...
	**/
	public	function __construct($category=''){
			$this->primaryField 	= 'id';
		$this->basicClassName 	= 'Banner';
		$this->tableName 		= 'banner';
		$this->categoryField='catId';
		$this->categoryName=$category?$category:"banners";
		$this->createBasicObject();		parent::__construct();

	}


	public function getByPosition($code = '') {
	    global $vsStd;
	    
	    $vsStd->requireFile ( CORE_PATH . "banners/bannerpos.php" );
	    $model = new bannerpos();
	    
	    $model->setCondition ( "status > 0 AND code ='{$code}'");
	    $tmp = $model->getOneObjectsByCondition();
	    
	    $position = $tmp->getId();
	    
	    $this->setCondition("status > 0 AND position ='{$position}'");
	    $this->setOrder("`index` desc, id desc");
	    
	    return $result = $this->getObjectsByCondition();
	}


	
	/**
	*Enter description here ...
	*@var Banner
	**/
	var		$obj;
}
