<?php

class GlobalLoad {
	
	function __construct() {
		$this->addDefaultScript();
		$this->addDefaultCSS();
	}
	
	function addDefaultScript() {
		global $vsPrint, $bw, $vsUser;
		
	
		$vsPrint->addJavaScriptFile ( 'icampus/jquery', 1 );
		$vsPrint->addJavaScriptFile ( 'icampus/vs.ajax', 1);
		
		$vsPrint->addJavaScriptFile ( 'icampus/jquery-ui');
		$vsPrint->addJavaScriptFile ( 'icampus/jquery.alerts');
		$vsPrint->addJavaScriptFile ( 'icampus/jquery.blockUI');
		
		
		
		
		$logged = 0;
		if($vsUser->obj->getId()) $logged = 1;
		
		$vsPrint->addJavaScriptString ( 'global_var', '
    			var vs = {};
    		    var ajaxfile = "index.php";
				var noimage=0;
				var imgurl = "' . $bw->vars ['img_url'] . '/";
				var global_website_title = "' . $bw->vars ['global_websitename'] . '/";
				var boardUrl = "' . $bw->vars['board_url'] . '";
				var baseUrl  = "' . $bw->base_url . '";
				var logged = "'.$logged.'"; 
    		' );
	}
	
	
	
	function addDefaultCSS() {
		global $vsPrint;

		$vsPrint->addGlobalCSSFile('jquery/base/ui.theme');
		
    	$vsPrint->addCSSFile("default");
    	$vsPrint->addCSSFile("global");
    	$vsPrint->addCSSFile("content");
    	
		$vsPrint->addCSSFile("jquery.alerts/jquery.alerts");
	}
}

	$styleLoad = new GlobalLoad();