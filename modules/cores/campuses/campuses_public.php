<?php
	global $vsStd;
	require_once(CORE_PATH."campuses/campuses.php");

	class campuses_public{
		
		function auto_run(){
			global $bw;
			switch($bw->input[1]){
				case 'getList':
						$this->getList();
					break;

				case 'editForm':
						$this->editForm($bw->input[2]);
					break;

				case 'edit':
						$this->editCampus();
					break;
					
				case 'no-campus':
						$this->noCampus($bw->input[2]);
					break;
					
				default:
					$this->loadDefault();
			}
	  	}

	  	function noCampus($campusTitle= ""){
	  		global $vsStd, $vsLang, $vsPrint;
	  		$vsStd->requireFile(CORE_PATH.'textbooks/textbooks.php');
	  		$vsPrint->addCSSFile("campuses");
	  		$textbooks= new textbooks();
	  		
	  		$option['subject'] = $textbooks->getSubjectList();
	  		$option['campus'] = $campusTitle;
	  		$option['button'] = $vsLang->getWords('submit','submit');
	  		return $this->output = $this->html->nocampus($option);
	  	}
	  	
		function editCampus(){
			global $bw, $vsPrint, $vsLang;

			$this->module->setCondition('campusTitle = "'.$bw->input['campusTitle'].'"');
			$this->module->getObjectsByCondition();
			
			if($this->module->getArrayObj()){
				$option['message'] = $vsLang->getWords('existed','This campus is existed.');
				return $this->output = $this->html->callback($option);
			}
			$bw->input['campusStatus'] = $bw->input['campusStatus'] ? $bw->input['campusStatus'] : 0;
			$this->module->obj->convertToObject($bw->input);
			
			$this->module->insertObject($this->module->obj);
			$option['message'] = $vsLang->getWords('add_fail','Error. Please try again later');
			if($this->module->result['status'])
				$option['message'] = $vsLang->getWords('add_successful','Your campus is added.');
			$option['script'] = "location.href='{$bw->vars['board_url']}/textbooks'";
			$this->output = $this->html->callback($option);
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