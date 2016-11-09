<?php
class brands_admin extends ObjectAdmin{
	function __construct(){
            global $vsTemplate,$vsPrint;
		parent::__construct('pages', CORE_PATH.'pages/', 'pages');
		//$vsPrint->addJavaScriptFile("jquery/ui.datepicker");
		//$vsPrint->addCSSFile('ui.datepicker');
   		$this->html = $vsTemplate->load_template('skin_brands');
                 
	}
        

}

?>