<?php
if ( ! defined( 'IN_VSF' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

global $vsStd;
$vsStd->requireFile(CORE_PATH."galleries/galleries.php");

class galleries_public{

	public function auto_run(){
		global $bw, $vsLang;

		switch ($bw->input[1]){
			default:
					$this->loadDefault();
				break;
		}
	}

	
	function __construct() {
		global $vsTemplate;
		 
		$this->html = $vsTemplate->load_template('skin_galleries');
	}

	public function getOutput() {
		return $this->output;
	}

	public function setOutput($output) {
		$this->output = $output;
	}
	
	
	private  $output;
	private  $html;
	
}
?>