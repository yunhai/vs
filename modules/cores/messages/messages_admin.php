<?php
/*
+-----------------------------------------------------------------------------
|   VSF version 3.0.0.0
|	Author: BabyWolf
|	Homepage: http://www.vietsol.net
|	If you use this code, please don't delete these comment lines!
|	Start Date: 10/21/2007
|	Finish Date: 10/21/2007
|	Modified Start Date: 10/27/2007
|	Modified Finish Date: 10/28/2007
+-----------------------------------------------------------------------------
*/
	require_once(CORE_PATH."textbooks/textbooks.php");

	class textbooks_admin {

		function auto_run(){
			global $bw;
		
			switch($bw->input[1]){
				case 'display-textbook-tab':
						$this->displayBookTab();
					break;
					
				case 'getList':
						$this->getList();
					break;
					
				case 'editForm':
						$this->editForm($bw->input[2]);
					break;
					
				case 'delete':
						$this->deleteObj($bw->input[2]);
					break;
					
				case 'editObj':
						$this->editObj();
					break;
				default:
					$this->loadDefault();
			}
	  	}

	  	function editObj(){
	  		global $bw;
	  		$this->module->obj->convertToObject($bw->input);
	  		$this->module->updateObjectById();
			if ($this->module->result['status']) {
				$this->module->obj = new Textbook();
				$this->output = $this->getList();
			}
			$this->editForm();
	  	}
	  	function editForm($bookId = ""){
	  		global $vsLang;
	  		
	  		if(!$this->module->obj->getId())
	  			$this->module->getObjectById($bookId);
	  		
	  		$option['submitValue'] = $vsLang->getWords('edit','Edit');
	  		$option['formTitle'] = $vsLang->getWords('edit','Edit');
	  		if($this->module->obj->getId())
	  			$this->output = $this->html->editForm($this->module->obj, $option);
	  		else $this->output = $this->getList();
	  	}
	  	
		function deleteObj($bookId=""){
			global $bw;
			if(!$bookId) return $this->output = $this->getList();
			
			
			$this->module->setCondition("bookId in (".$bookId.")");
			$this->module->getObjectsByCondition();
		
			foreach( $this->module->getArrayObj() as $book ){
				$this->module->vsFile->deleteFile($book->getImage());
			}

			$this->module->setCondition("bookId in (".$bookId.")");
			$this->module->deleteObjectByCondition();

			return $this->getList();
		}
	  	
	  	function displayBookTab(){
	  	//	$option['subject'] = $this->module->getCategoryList();
	  		
	  		$option['listHTML'] = $this->getList();
	  		$this->output = $this->html->displayBookTab($option);
	  	}
	  	
		function getList($url="textbooks/getList", $pageIndex = 2){
			global $bw, $vsSettings;
			$size = 3;$vsSettings->getSystemKey("campus_list_number", 10);
			$option = $this->module->getPageList($url, $pageIndex, $size, 1, 'mainContainer');
			
			return $this->output = $this->html->objListHtml($option);
		}
		
	
		function loadDefault() {
			global $vsPrint;
			$vsPrint->addJavaScriptFile("tiny_mce/tiny_mce");
			
			
			$vsPrint->addJavaScriptString('init_tab','
				$(document).ready(function(){
	    			$("#page_tabs").tabs({
	    				cache: false
	    			});
	  			});
			');
			
			
			
			$this->setOutput($this->html->MainPage());
		}
	
		protected $module;
		protected $html = "";
		protected $output = "";
		
		public function __construct(){
			global $vsTemplate;
			
			$this->module = new textbooks();
	        $this->html = $vsTemplate->load_template('skin_textbooks');
		}
		
		public function getHtml() {
			return $this->html;
		}
		
		public function getOutput() {
			return $this->output;
		}
		
		public function setHtml($html) {
			$this->html = $html;
		}
		
		public function setOutput($output) {
			$this->output = $output;
		}
}
?>