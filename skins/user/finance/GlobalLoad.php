<?php
class GlobalLoad {

	function __construct() {
		$this->addDefaultScript ();
		$this->addDefaultCSS ();
	}
	function addDefaultScript() {
		global $vsPrint, $bw, $vsSkin;
		
//		$vsPrint->addCurentJavaScriptFile ( 'jquery-ui-1.9.2.custom.min' );
		$vsPrint->addCurentJavaScriptFile ( 'imenu');
		$vsPrint->addCurentJavaScriptFile ( 'jquery-1.7.1.min',1 );
		$vsPrint->addCurentJavaScriptFile ( 'jquery.bxslider');
//		$vsPrint->addCurentJavaScriptFile ( 'jquery.validate');
//		$vsPrint->addCurentJavaScriptFile ( 'start');
		
		//$vsPrint->addJavaScriptFile ( 'jquery-1.7.1.min', 1 );
// $vsPrint->addExternalJavaScriptFile("https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js",1)
		
		//$vsPrint->addJavaScriptFile ( 'jquery/ui.cyclel' );
//		$vsPrint->addJavaScriptFile ( 'ddsmoothmenu' );
//		$vsPrint->addJavaScriptFile ('vs.ajax');
//		$vsPrint->addJavaScriptFile ('vs.fwpublic');
//		$vsPrint->addJavaScriptFile ( 'jquery/ui.alerts' );
//		$vsPrint->addJavaScriptFile ( 'jquery/ui.widget' );
//		$vsPrint->addJavaScriptFile ( 'jquery/ui.dialog' );
//		$vsPrint->addJavaScriptFile ( 'jquery-ui-1.8.16' );
//		
//		
		$vsPrint->addCurentJavaScriptFile("jquery-1.7.1.min",1);
		$vsPrint->addCurentJavaScriptFile("jquery.bxslider");
		$vsPrint->addCurentJavaScriptFile("imenu");
		$vsPrint->addCurentJavaScriptFile("highslide/highslide-full");
		
		
		
//		$jspath = ROOT_PATH . $vsSkin->basicObject->getFolder () . "/javascripts/";
//		$files = $this->find ( $jspath, '/\.js/' );
//		foreach ( $files as $value ) {
//			if ($value == "jquery.js") {
//				// $vsPrint->addCurentJavaScriptFile(str_replace(".js","",$value),1);
//			} else {
//				//$vsPrint->addCurentJavaScriptFile(str_replace(".js","",$value));
//			}
//		}
//		$vsPrint->addJavaScriptFile ( 'jquery.numeric' );
		$vsPrint->addJavaScriptString ( 'global_var', '
		
		
    			var vs = {};
				var noimage=0;
				var image = "loader.gif";
				var imgurl = "' . $bw->vars ['img_url'] . '";
				var img = "' . $bw->vars ['cur_folder'] . 'htc";
				var boardUrl = "' . $bw->vars ['board_url'] . '";
				var baseUrl  = "' . $bw->base_url . '";
				 var ajaxfile = boardUrl + "/index.php";
				var global_website_title = "' . $bw->vars ['global_websitename'] . '";
    		', 1 );
		$vsSettings = VSFactory::getSettings ();
		if ($vsSettings->getSystemKey ( 'google_analysiss', 1, 'global', 1, 1 ) && $vsSettings->getSystemKey ( 'google_analysis_key', 'UA-42288880-1', 'global', 1, 1 )) {
			$vsPrint->addJavaScriptString ( 'global_analysis', "
    			 
    		" );
		}
	}

	function addDefaultCSS() {
		global $vsUser, $vsPrint, $vsModule, $vsSkin;
//		$vsPrint->addGlobalCSSFile('jquery/base/ui.theme');
//		$vsPrint->addGlobalCSSFile('jquery/base/ui.core');
//		$vsPrint->addGlobalCSSFile('jquery/base/ui.theme');
//		$vsPrint->addGlobalCSSFile('jquery/base/ui.dialog');
//		$vsPrint->addCSSFile('screen','screen');
//		$vsPrint->addCSSFile("ddsmoothmenu");
		
		$vsPrint->addCSSFile("global");
		$vsPrint->addCSSFile("default");
		$vsPrint->addCSSFile("jquery.bxslider");
		$vsPrint->addCSSFile('../javascripts/highslide/highslide');

//		$vsPrint->addCSSFile("jquery/jquery-ui-1.8.16.custom");
//		$vsPrint->addCSSFile("jquery.ui.timepicker");
		
	}

	function find($direct, $pattern) {
		$images = array ();
		if ($dir = opendir ( $direct )) {
			
			while ( false !== ($file = readdir ( $dir )) ) {
				if ($file != "." && $file != ".." && $file != '.svn') {
					if (is_dir ( $file )) {
						// $images=array_merge($images,$this->find($file,$pattern,$file."/"));
					} else {
						if (preg_match ( $pattern, $file )) {
							$images [] = $file;
						}
					}
				}
			}
			closedir ( $dir );
		}
		return $images;
	}
}
$styleLoad = new GlobalLoad ();