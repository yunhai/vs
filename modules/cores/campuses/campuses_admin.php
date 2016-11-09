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
	require_once(CORE_PATH."campuses/campuses.php");

	class campuses_admin {

		function auto_run(){
			global $bw;
		
			switch($bw->input[1]){
				case 'display-campus-tab':
						$this->displayCampusTab();
					break;
					
				case 'getList':
						$this->getList();
					break;

				case 'editForm':
						$this->editForm($bw->input[2]);
					break;

				case 'editCampus':
						$this->editCampus();
					break;

				case 'updateStatus':
						$this->updateStatus($bw->input[2], $bw->input[3]);
					break;
					
				case 'deleteCampus':
						$this->deleteCampus($bw->input[2]);
					break;
				default:
					$this->loadDefault();
			}
	  	}

		function deleteCampus($campusIds=""){
			global $bw;
			
			$this->module->setCondition("campusId in (".$campusIds.")");
			$this->module->deleteObjectByCondition();
			
			unset($bw->input[2]);
			return $this->output = $this->getList();
		}
	  	
	  	function displayCampusTab(){
	  		$option['listHTML'] = $this->getList();
	  		$this->output = $this->html->displayCampusTab($option);
	  	}
	  	
		function getList($url="campuses/getList", $pageIndex = 2){
			global $bw, $vsSettings;
			$size = $vsSettings->getSystemKey("campus_list_number", 10);
			$option = $this->module->getPageList($url, $pageIndex, $size, 1, 'mainContainer');
			
			return $this->output = $this->html->objListHtml($option);
		}
		
		function editForm($compusId=0){
			global $vsLang;
			
			$this->module->obj = new Campus;
			$option['button'] = $vsLang->getWords('editForm_button_add','Add');
			$option['title'] = $vsLang->getWords('editForm_title_add','Add Campus');
			if($compusId){
				$this->module->obj = $this->module->getObjectById($compusId);
				$option['button'] = $vsLang->getWords('editForm_button_edit','Edit');
				$option['title'] = $vsLang->getWords('editForm_title_edit','Edit Campus');
			}
			
			return $this->output = $this->html->editForm($this->module->obj, $option);
		}
		
		function editCampus(){
			global $bw, $vsPrint, $vsLang, $vsUser;
			
			$bw->input['campusStatus'] = $bw->input['campusStatus'] ? $bw->input['campusStatus'] : 0;
			$this->module->obj->convertToObject($bw->input);
			
			if(empty($bw->input['campusId'])){
				$this->module->insertObject($this->module->obj);
			}else{
				$this->module->updateObjectById($this->module->obj);
			}
			
			if($this->module->result['status'])
				return $this->output = $this->getList();
//				$vsPrint->redirect_screen($vsLang->getWords("update_success","Bạn đã cập nhật tin thành công."), "posts/user/{$bw->input[2]}");
		}
	
		function updateStatus($campusIds="", $status=0){
			$this->module->setCondition('campusId in ('.$campusIds.")");
			$array = array('campusStatus' => $status);
			$this->module->updateObjectByCondition($array);

			return $this->output = $this->getList();
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
			
			
			$this->module = new campuses();
	        $this->html = $vsTemplate->load_template('skin_campuses');
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