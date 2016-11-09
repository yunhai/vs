<?php
class projects_public extends ObjectPublic{
	function __construct(){
            global $vsTemplate;
            parent::__construct( 'projects', CORE_PATH.'projects/', 'projects');
            $this->html = $vsTemplate->load_template('skin_projects'); 
	}
	
}

?>