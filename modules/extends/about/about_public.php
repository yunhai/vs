<?php
if(! defined( 'IN_VSF' )){
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit();
}
global $vsStd;
$vsStd->requireFile(CORE_PATH . "pages/pages_public.php");	

class about_public extends pages_public {
	function __construct(){
		global $vsTemplate, $vsPrint;
		parent::__construct();

		$vsPrint->addCSSFile('agreement');
		$this->html = $vsTemplate->load_template('skin_about');
	}
		
	function auto_run(){
		global $bw;
		
		$bw->input['module'] = "about";
		switch ($bw->input[1]){
			default:
				$this->loadDefault();
		}
	}
	
	function loadDefault(){
		global $bw, $vsLang, $vsStd;
		
		$option['pageList'] = $this->module->getAllObjByModule('about');
		
		$cclass = array('even','odd');
		foreach($option['pageList'] as $key => $page)
			$option['pageList'][$key]->cclass = $cclass[($page->stt)%2];
			
		$vsStd->requireFile(CORE_PATH.'articles/articles.php');
		$articles = new articles();
		
		$articles->setFieldsString('articleId, articleTime, articleTitle, seoAliasUrl');
		$option['news'] = $articles->getObjByModule('news', 3);
		$option['events'] = $articles->getObjByModule('events', 3);
			
		$this->output = $this->html->loadDefault($option);
	}
}
?>