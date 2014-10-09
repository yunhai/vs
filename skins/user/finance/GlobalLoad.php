<?php
class GlobalLoad {

	function __construct() {
		$this->addDefaultScript ();
		$this->addDefaultCSS ();
	}
	function addDefaultScript() {
		global $vsPrint, $bw, $vsSkin;
		
        $vsPrint->addCurentJavaScriptFile("jquery.min", 1);
        $vsPrint->addCurentJavaScriptFile("bootstrap.min", 1);
		
        $vsPrint->addCurentJavaScriptFile("jquery-scrollToTop", 1);
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
		
		$vsPrint->addJavaScriptString ( 'totop', '
                $(document).ready(function() {
                    $("body").scrollToTop({skin: "cycle"});
                });
		
    		', 0);
		$vsSettings = VSFactory::getSettings();
		if ($vsSettings->getSystemKey ( 'google_analysiss', 1, 'global', 1, 1 ) && $vsSettings->getSystemKey ( 'google_analysis_key', 'UA-42288880-1', 'global', 1, 1 )) {
			$vsPrint->addJavaScriptString ( 'global_analysis', "
    			 
    		" );
		}
	}

	function addDefaultCSS() {
		global $vsPrint;
		
// 		$vsPrint->addCSSFile("bootstrap");
		$vsPrint->addCSSFile("bootstrap.min");
		$vsPrint->addCSSFile("default");
		
		$vsPrint->addCSSFile("scrollToTop");
		$vsPrint->addCSSFile("easing");
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