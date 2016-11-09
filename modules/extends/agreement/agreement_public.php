<?php
if(! defined( 'IN_VSF' )){
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit();
}
global $vsStd;
$vsStd->requireFile(CORE_PATH . "pages/pages_public.php");	

class agreement_public extends pages_public {
	function __construct(){
		global $vsTemplate, $vsPrint;
		parent::__construct();

		$vsPrint->addCSSFile('agreement');
		$this->html = $vsTemplate->load_template('skin_agreement');
	}
		
	function auto_run(){
		global $bw;
		
		$bw->input['module'] = "agreement";
		switch ($bw->input[1]){
			default:
				$this->loadDefault();
		}
	}
	
	function loadDefault(){
		global $bw, $vsPrint, $vsLang;
	
		if(!$bw->input[1]){
			global $vsPrint;
			$vsPrint->boink_it($bw->base_url.'error');
			exit;
		}

		$code = strtolower(VSFTextCode::removeAccent(str_replace('-', ' ', trim($bw->input[1])), ' '));
		
		$option['obj'] = $this->module->getObjByCode($code, 'agreement');
		
		if(!$option['obj']){
			global $vsPrint;
			$vsPrint->boink_it($bw->base_url.'error');
			exit;
		}
		$this->output = $this->html->loadDefault($option);
	}
}
?>