<?php
if(! defined( 'IN_VSF' )){
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit();
}
global $vsStd;
$vsStd->requireFile(CORE_PATH . "pages/pages_public.php");	

class helpcenter_public extends pages_public {
	function __construct(){
		global $vsTemplate, $vsPrint;
		parent::__construct();

		$vsPrint->addCSSFile('agreement');
		$this->html = $vsTemplate->load_template('skin_helpcenter');
	}
		
	function auto_run(){
		global $bw;
		
		$bw->input['module'] = "helpcenter";
		switch ($bw->input[1]){
			case 'detail':
					$this->loadDetail($bw->input[2]);
				break;
			
			default:
					$this->loadDefault();
		}
	}
	
	function loadDefault(){
		global $bw, $vsPrint, $vsLang;
		
		$option['helpcenter'] = $this->module->getObjByCode('helpcenter', 'helpcenter');
		
		$this->output = $this->html->loadDefault($option);
	}
}
?>