<?php
require_once(CORE_PATH."listings/LT.class.php");

class lts extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "ltId";
		$this->basicClassName = "LT";
		$this->tableName = 'listing_textbook';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
	
	function listing_textbook($option = array()){
		global $vsUser, $vsSettings;
		$userId = $vsUser->obj->getId();
		
		$where = "bookId = tubook AND tuId = ltTu AND bookStatus > 0 AND tuUser = ".$userId;
		if($option['where']) $where = $option['where']. ' AND '.$where;

		$this->setTableName("textbook_user, vsf_textbook, vsf_listing_textbook");
		$this->setCondition($where);
		
		$order = 'ltTime DESC, ltId DESC';
		if($option['order']) $order = $option['order'];
		$this->setOrder($order);
		
		$index = $option['index'] ? $option['index'] : 2;
		$size = $vsSettings->getSystemKey('listing_textbook_quality', 10, 'textbooks', 1);
		if($bw->input['t']) $bw->input['advance']='/&t='.$bw->input['t'];
	
		return $this->getArrPageList($option['url'], $index, $size, $option['pajax'], $option['pcallback']);
	}

	function addListingTextbook($input = array()){
		if(!$input) return false;
		$this->obj->convertToObject($input);
		return $this->insertObject();
	}
}
?>