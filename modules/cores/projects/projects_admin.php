<?php

class projects_admin extends ObjectAdmin{
	function __construct(){
		parent::__construct('projects', CORE_PATH.'projects/', 'projects');
	}
}

?>