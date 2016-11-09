<?php

class GlobalLoad {

	function __construct() {
		$this->addDefaultScript();
		$this->addDefaultCSS();
	}


	function addDefaultScript() {
		global $vsPrint, $bw, $vsSettings,$vsTemplate;
		$vsPrint->addCurentJavaScriptFile("jquery-1.4.2",1);
   		$vsPrint->addJavaScriptFile("vs.ajax",1);
//       $vsPrint->addJavaScriptFile( 'jquery/ui.core');
//		$vsPrint->addJavaScriptFile( 'jquery/ui.widget');
//		$vsPrint->addJavaScriptFile( 'jquery/ui.tabs');
//		$vsPrint->addJavaScriptFile( 'jquery/ui.position');
		//$vsPrint->addJavaScriptFile( 'jquery/ui.dialog');
		$vsPrint->addJavaScriptFile( "jquery/ui.alerts");
		$vsPrint->addCurentJavaScriptFile("imenu");

		
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
		
			
		$vsPrint->addJavaScriptString ( 'top_script', '
		$(document).ready(function(){
			$(".page").find("a:last").css({padding: "0px",background: "none"});
			$(".page").find("a:first").css({padding: "0px",background: "none"});
			$(".page").find("a:last").prev().css({background: "none"});
		}); 
		
    	' );
		
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
    	$vsPrint->addCSSFile('menu');
		
		$vsPrint->addCSSFile('../javascripts/highslide/highslide');
		$vsPrint->addGlobalCSSFile('jquery/base/ui.theme');
		$vsPrint->addGlobalCSSFile('jquery/base/ui.core');
		$vsPrint->addGlobalCSSFile('jquery/base/ui.theme');
		$vsPrint->addGlobalCSSFile('jquery/base/ui.dialog');
		$vsPrint->addCSSFile($vsModule->obj->getClass());
	}
}
	$styleLoad = new GlobalLoad();