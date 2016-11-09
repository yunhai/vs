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
					
				case 'list':
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

	  		if($bw->input['fileId']) $bw->input['bookImage'] = $bw->input['fileId'];
	  		
	  		$this->module->obj->convertToObject($bw->input);
	  	
	  		$this->module->updateObjectById();
	  		
			if($this->module->result['status']){
				global $vsStd;
				$vsStd->requireFile(CORE_PATH."textbooks/tus.php");
				
				$tusVerify = 1;
				if($bw->input['bookStatus']) $tusVerify = 0;
				
				$tus = new tus();
				$tus->setCondition('tuBook = '.$this->module->obj->getId().' AND tuVerify = '.$bw->input['bookStatus']);
				$tus->updateObjectByCondition(array('tuVerify'=>$tusVerify, 'tuStatus'=>$bw->input['bookStatus']));
				
				
				$this->module->obj = new Textbook();
				$func = 'getList';
	  			if($bw->input['type'] == 'verify') $func = 'getVerifyList';
	  			
				return $this->output = $this->$func();
			}
			$this->editForm($bw->input['bookId']);
	  	}
	  	
	  	function editForm($bookId = ""){
	  		global $bw, $vsLang;
	  		
	  		$option['submitValue'] = $vsLang->getWords('edit','Edit');
	  		$option['formTitle'] = $vsLang->getWords('edit','Edit');
	  		$option['textbooktype'] = $bw->input['type'];
	  		
	  		if(!$this->module->obj->getId())
	  			$this->module->getObjectById($bookId);
	  		
	  		if($this->module->obj->getId())
	  			$this->output = $this->html->editForm($this->module->obj, $option);
	  		else{
	  			$func = 'getList';
	  			if($bw->input['type'] == 'verify') $func = 'getVerifyList';
	  			$this->output = $this->$func();
	  		}
	  	}
	  	
		function deleteObj($bookId=""){
			global $bw;
			if(!$bookId) return $this->output = $this->getList();
			
			$this->module->setCondition("bookId in (".$bookId.")");
			$this->module->getObjectsByCondition();
		
			foreach($this->module->getArrayObj() as $book ){
				$this->module->vsFile->deleteFile($book->getImage());
			}

			$this->module->setCondition("bookId in (".$bookId.")");
			$this->module->deleteObjectByCondition();

			global $vsStd;
			$vsStd->requireFile(CORE_PATH."textbooks/tus.php");
			$tus = new tus();
			
			$tus->setCondition('tuBook in ('.$bookId.')');
			$tus->updateObjectByCondition(array('tuStatus'=>-1));

			unset($bw->input[2]);
			
			$func = 'getList';
	  		if($bw->input['type'] == 'verify') $func = 'getVerifyList';
	  	
			return $this->$func();
		}
	  	
	  	function displayBookTab(){
	  		global $bw;
	  		
	  		$func = 'getList';
	  		if($bw->input['type'] == 'verify') $func = 'getVerifyList';
	  		
	  		$option['listHTML'] = $this->$func();
	  		$option['textbooktype'] = $bw->input['type'];
	  		$this->output = $this->html->displayBookTab($option);
	  	}
	  	
		function getList($url="textbooks/list", $pageIndex = 2){
			
			global $bw, $vsSettings;
			$size = $vsSettings->getSystemKey("textbook_list_number", 10, 'textbooks', 1);
			
			$this->module->setCondition("bookStatus > 0");
			$option = $this->module->getPageList($url, $pageIndex, $size, 1, 'mainContainer');
			
			return $this->output = $this->html->objListHtml($option);
		}
		
		function getVerifyList($url="textbooks/verify", $pageIndex = 2){
			global $bw, $vsSettings;
			$size = $vsSettings->getSystemKey("textbook_verify_list_number", 10, 'textbooks', 1);
			
			$this->module->setCondition("bookStatus < 1");
			$option = $this->module->getPageList($url, $pageIndex, $size, 1, 'mainContainer'.$bw->input['type']);
			
			$option['textbooktype'] = $bw->input['type'];
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