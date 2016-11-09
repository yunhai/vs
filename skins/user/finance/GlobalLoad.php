<?php

class GlobalLoad {

	function __construct() {
		$this->addDefaultScript();
		$this->addDefaultCSS();
	}


	function addDefaultScript() {
		global $vsPrint, $bw, $vsSettings;
		$vsPrint->addCurentJavaScriptFile("jquery-1.4.2", 1);
                $vsPrint->addCurentJavaScriptFile('quickpager.jquery');
               
                $vsPrint->addCurentJavaScriptFile('jquery.innerfade');
                $vsPrint->addCurentJavaScriptFile('imenu');
                $vsPrint->addCurentJavaScriptFile('highslide/highslide-full');
                $vsPrint->addJavaScriptFile('jquery/ui.alerts');

		$vsPrint->addJavaScriptString ( 'global_var', '
                    var vs = {};
    		    var ajaxfile = "index.php";
                    var noimage=0;
                    var image = "loader.gif";
                    var imgurl = "' . $bw->vars ['img_url'] . '/";
                    var img = "' . $bw->vars ['cur_folder'] . 'htc";
                    var boardUrl = "'.$bw->vars['board_url'].'";
                    var baseUrl  = "'.$bw->base_url.'";
                    var global_website_title = "'.$bw->vars['global_websitename'].'/";
    		', 1 );
		

		
		if($vsSettings->getSystemKey('google_analysis', 0, 'global', 1, 1) && $vsSettings->getSystemKey('google_analysis_key', 'UA-17663652-4', 'global', 1, 1)){
			
    		$vsPrint->addJavaScriptString ( 'global_analysis', "
    			 var _gaq = _gaq || [];
				 _gaq.push(['_setAccount', '{$bw->vars['google_analysis_key']}']);
				  _gaq.push(['_trackPageview']);
				
				  (function() {
				    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
				  })();
    		");
		}
	}

	function addDefaultCSS() {
		global $vsUser,$vsPrint, $vsModule;

		$vsPrint->addCSSFile('default');
		$vsPrint->addCSSFile('global');
		$vsPrint->addCSSFile('content');
                $vsPrint->addCSSFile('slide1');
                $vsPrint->addCSSFile('menu');
                $vsPrint->addCSSFile('highslide');
//                $vsPrint->addCSSFile('scroll');
//                $vsPrint->addCSSFile('stock');
		$vsPrint->addGlobalCSSFile('jquery/base/ui.theme');
		$vsPrint->addGlobalCSSFile('jquery/base/ui.core');
		$vsPrint->addGlobalCSSFile('jquery/base/ui.theme');
		$vsPrint->addGlobalCSSFile('jquery/base/ui.dialog');
		$vsPrint->addCSSFile($vsModule->obj->getClass());
	}
}
	$styleLoad = new GlobalLoad();