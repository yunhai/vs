<?php
require_once(CORE_PATH."listings/Lc.class.php");

class lcs extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "lcId";
		$this->basicClassName = "Lc";
		$this->tableName = 'listing_icmarket';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
	
	function listing_icmarket($option = array()){
		global $vsUser, $vsSettings, $bw;
		$userId = $vsUser->obj->getId();
		
		$where = "cfId = lcObj AND cfUser = ".$userId;
		if($option['where']) $where = $option['where']. ' AND '.$where;

		$this->setTableName("icmarket, vsf_listing_icmarket");
		$this->setCondition($where);
		
		$order = 'lcTime DESC, lcId DESC';
		if($option['order']) $order = $option['order'];
		$this->setOrder($order);
		
		$index = $option['index'] ? $option['index'] : 2;
		$size = $vsSettings->getSystemKey('listing_icmarket_quality', 10, 'icmarket', 1);
		if($bw->input['t']) $bw->input['advance']='/&t='.$bw->input['t'];
		return $this->getArrPageList($option['url'], $index, $size, $option['pajax'], $option['pcallback']);
	}

	function addLC($input = array()){
		if(!$input) return false;
		$this->obj->convertToObject($input);
		return $this->insertObject();
	}
}
?>