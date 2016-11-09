<?php
require_once(CORE_PATH."textbooks/TU.class.php");

class tus extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "tuId";
		$this->basicClassName = "TU";
		$this->tableName = 'textbook_user';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
	
	function getUserBooks($user=0, $current=0, $limit=3){
		if(!$user) return;
		
		if(!$current) $this->setCondition("tuUser in (".$user.") AND tuId <>".$current."  AND tuStatus > 0");
		else $this->setCondition("tuUser in (".$user.")  AND tuStatus > 0");
		
		$this->setOrder("tuId DESC");
		if($limit) $this->setLimit(array(0, $limit));
		return $this->getObjectsByCondition('getBook');
	}

	function getFullTU($tuId){
		if(!$tuId) return false;

		$this->setTableName("textbook_user, vsf_listing_textbook");
		$this->setCondition('tuId = ltTu AND tuId = '.$tuId);
		
		global $vsStd;
		$vsStd->requireFile(CORE_PATH.'listings/LT.class.php');
		
		return $this->getAdvanceOneObjectsByCondition('getId', 0, 1, array('lt'=>'LT'));
	}
	
		function getTUDetail($tuId){
			if(!$tuId) return false;
	
			$this->setTableName("textbook_user, vsf_textbook, vsf_listing_textbook, vsf_user");
			$this->setCondition('tuUser = userId AND tuBook = bookId AND tuId = ltTu AND tuId = '.$tuId.' AND ((ltDel = 0 AND ltStatus = 1) OR ltStatus <> 1)');
			global $vsStd;
			$vsStd->requireFile(CORE_PATH.'listings/LT.class.php');
			
			return $this->getAdvanceOneObjectsByCondition('getId', 0, 1, array('bookDetail'=>'Textbook', 'lt'=>'LT', 'seller'=>'User'));
		}
}
?>