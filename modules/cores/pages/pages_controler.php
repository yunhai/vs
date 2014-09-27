<?php
require_once (CORE_PATH . 'pages/pages.php');
class pages_controler extends VSControl_admin {

	function __construct($modelName) {
		global $vsSkin, $bw;
		
		if (file_exists ( ROOT_PATH . $vsSkin->basicObject->getFolder () . "/skin_" . $bw->input [0] . ".php" )) {
			parent::__construct ( $modelName, "skin_" . $bw->input [0], "page", $bw->input [0] );
		} else {
			parent::__construct($modelName,"skin_pages","page",$bw->input[0]);
		}
	}

	function getHtml() {
		return $this->html;
	}

	function getOutput() {
		return $this->output;
	}

	function setHtml($html) {
		$this->html = $html;
	}

	function setOutput($output) {
		$this->output = $output;
	}
	
	/**
	 * Skins for page .
	 * ..
	 * 
	 * @var skin_pages
	 *
	 */
	var $html;
	
	/**
	 * String code return to browser
	 */
	var $output;
}
