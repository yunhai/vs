 <?php
class abouts_public extends ObjectPublic{
	function __construct(){
		global $vsTemplate;
		parent::__construct('pages', CORE_PATH.'pages/', 'pages');
		$this->html = $vsTemplate->load_template('skin_abouts');
	}
	

	
	
}
?>
