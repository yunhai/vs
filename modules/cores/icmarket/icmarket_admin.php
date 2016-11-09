<?php
/*
+-----------------------------------------------------------------------------
|   VS FRAMEWORK 3.0.0
|	Author: BabyWolf
|	Homepage: http://vietsol.net
|	If you use this code, please don't delete these comment line!
|	Start Date: 21/09/2004
|	Finish Date: 22/09/2004
|	Version 2.0.0 Start Date: 07/02/2007
|	Version 3.0.0 Start Date: 03/29/2009
+-----------------------------------------------------------------------------
*/

if ( ! defined( 'IN_VSF' ) )
{
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit();
}


class icmarket_admin{
    function auto_run(){
		global $bw;
		switch($bw->input['action']){
			default: 
					$this->loadDefault();
				break;
		}
	}
	
	function loadDefault() {
		global $vsPrint;
		$vsPrint->addJavaScriptString('init_tab',
			'$(document).ready(function(){
				$("#page_tabs").tabs({fx:{opacity: "toggle"},cache:true});
			});'
    		);
    		
		$this->output = $this->html->MainPage();
	}
	
	
	
	
	
 	private $output		= "";
	private $html       = "";

	function __construct() {
		global $vsStd, $vsPrint, $vsTemplate;
        $this->html = $vsTemplate->load_template('skin_classifieds');
	}
	
	function getOutput() {
		return $this->output;	
	}
	
}
?>