<?php

class vsFactory {
	public function getSeo(){
		static $seo;
		if(!$seo){
			global $vsStd;
			$vsStd->requireFile(COM_PATH.'SEO/SEO.php');
			$seo=new COM_SEO();
		}
		return $seo;
	}
	public function getDateTime(){
		static $dateTime;
		if(!$dateTime){
			require_once LIBS_PATH . "DateTime.class.php";
			$dateTime=new VSFDateTime();
		}
		return $dateTime;
	}
}

?>