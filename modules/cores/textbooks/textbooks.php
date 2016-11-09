<?php
require_once(CORE_PATH."textbooks/Textbook.class.php");

class textbooks extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "bookId";
		$this->basicClassName = "Textbook";
		$this->tableName = 'textbook';
		$this->obj = $this->createBasicObject();
		
		$this->categories = array();
		$this->categories = $this->vsMenu->getCategoryGroup(($this->tableName."s"));
	}
	
	function __destruct(){	
		unset($this);
	}
	
	function getCategoryList($groupName = "textbooks", $html = true, $size = 18){
		$this->vsMenu = new menus();
		$subject = $this->vsMenu->getCategoryGroup("textbooks");
		if(!$html) return $subject;
		
		$option = array('listStyle' => "| - -",
						'id'		=> 'menus-category',
						'size'		=> $size,
						);
		
		return $this->vsMenu->displaySelectBox($subject->getChildren(), $option);
	}

	
	
	function getSubjectList(){
		global $vsMenu, $bw;
		
		$subject= $vsMenu->getCategoryGroup("textbooks");
		$temp = $subject->getChildren();
	
		foreach($temp as $key => $value)
			$value->subURL = $bw->vars['board_url'].'/textbooks/subject/'.strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($value->title)),'-')).'-'.$value->getId();
		
		usort($temp, array("textbooks", "sorter"));
		return $temp;
	}
	
	static function sorter($a, $b){
		if(is_object($a) && is_object($b))
			if($a->getTitle() > $b->getTitle()) return 1;
		return 0;
	}

	function getTextbookCondition(){
		$condition = $this->vsMenu->getCategoryGroup("condition");
		return $condition->getChildren();
	}
	
	function getTextbookType(){
		$type = $this->vsMenu->getCategoryGroup("type");
		return $type->getChildren();
	}
	

	function getBooksByISBN($isbn = '', $option){
		if(!$isbn) return;
		
		$this->setCondition("(bookISBN in (".$isbn.") OR bookISBN10 in (".$isbn.")) AND bookStatus > 0");
		$this->setOrder("bookId DESC");
		return $this->getPageList($option['url'], $option['pIndex'], $option['size']);
	}



}
?>