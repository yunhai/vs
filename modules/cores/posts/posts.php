<?php
require_once(CORE_PATH."posts/Post.class.php");

class posts extends VSFObject {


	/**
	*Enter description here ...
	**/
	public	function __construct($category=''){
			$this->primaryField 	= 'id';
		$this->basicClassName 	= 'Post';
		$this->tableName 		= 'post';
		$this->categoryField='catId';
		$this->categoryName=$category?$category:"posts";
		$this->createBasicObject();		parent::__construct();

	}
	function getOtherPost($obj,$limit=5){
		if(!is_object($obj)) return array();
		$ids=VSFactory::getMenus()->getChildrenIdInTree(VSFactory::getMenus()->getCategoryById($obj->getCatId()));
		if($ids){
			$this->setCondition("id!='{$obj->getId()}' and catId in ($ids)");
		}
		
		$this->setLimit(array(0,$limit));
		return $this->getObjectsByCondition();
	}

	function getHotPost($limit=5){
		$this->setCondition("status =2");
		$this->setLimit(array(0,$limit));
		return $this->getObjectsByCondition();
	}

	public function locationList() {
	    return VSFactory::getMenus()->getCategoryGroup('locations');
	}
	
	public function createSearch($input) {
	    global $bw;
	    
	    $name = $input['posts']['name'];
	    $phone    = $input['posts']['phone'];
	    $address  = $input['posts']['address'];
	  
	    if($input['posts']['location']) {
	        $tmp = VSFactory::getMenus()->getCategoryById($input['posts']['location']);
	        $state = $tmp->getTitle() . ' ' . $tmp->getIsLink();
	    }
	    $zipcode    = $input['posts']['zipcode'];
	    
	    $title   = $bw->input['posts']['title'];
	    $intro   = $bw->input['posts']['intro'];
	    $content = $bw->input['posts']['content'];
	    
	    $clean = $name . ' ' . $phone . ' ' . $address . ' ' . $state . ' ' . $zipcode . ' ' . $title . ' ' . $intro . ' ' . $content;
	    
	    return strtolower(VSFactory::getTextCode()->removeAccent($clean, ' '));
	}
	
	
	/**
	*Enter description here ...
	*@var Post
	**/
	var		$obj;
}
