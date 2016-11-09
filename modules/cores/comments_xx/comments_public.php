<?php
class comments_public extends ObjectPublic{
	
	function __construct() {
		global $vsTemplate;
		parent::__construct('skin_comments', 'comments', CORE_PATH.'comments/', 'comments');
	}
	
	function auto_run() {
		global $bw, $vsPrint;
		switch ($bw->input [1]) {
		
			
			case 'form-comment' :
				$vsPrint->addJavaScriptFile ( 'jquery/ui.alerts' );
				$vsPrint->addJavaScriptFile ( 'ajaxupload/ajaxfileupload' );
				$vsPrint->addJavaScriptFile ( 'vs.ajax' );
				
				$vsPrint->addGlobalCSSFile ( 'jquery/base/ui.dialog' );
				$vsPrint->addGlobalCSSFile ( 'jquery/base/ui.theme' );
				$vsPrint->addGlobalCSSFile ( 'jquery/base/ui.core' );
				$this->output = $this->html->displayComment ();
				break;
			case 'load-form' :
				$this->output = $this->html->formComment ();
				break;
			
			case 'process-add' :
			$vsPrint->addJavaScriptFile ( 'jquery/ui.alerts' );
				$vsPrint->addJavaScriptFile ( 'ajaxupload/ajaxfileupload' );
				$vsPrint->addJavaScriptFile ( 'vs.ajax' );
				
				$vsPrint->addGlobalCSSFile ( 'jquery/base/ui.dialog' );
				$vsPrint->addGlobalCSSFile ( 'jquery/base/ui.theme' );
				$vsPrint->addGlobalCSSFile ( 'jquery/base/ui.core' );
				$this->processAdd ();
				break;

		}
	}
	
	function processAdd() {
		global $bw, $vsStd, $vsLang, $vsSettings;
		
		$bw->input ['commentPostDate'] = time ();
		$bw->input ['commentStatus'] = $bw->input ['commentStatus'] ? $bw->input ['commentsStatus'] : 0;
		
		$bw->input ['commentCatId'] = $this->model->getCategories ()->getId ();
		
		if ($bw->input ['fileId'])
			$bw->input ['commentsImage'] = $bw->input ['fileId'];
		
		$com = $this->module->createBasicObject();
		$com->convertToObject ( $bw->input );
		$this->module->insertObject ($com);
		
		$obj = $this->module->vsRelation->createBasicObject();
		$this->module->vsRelation->setObjectId($bw->input ['objectId']);
		$this->module->vsRelation->setRelId($com->getId());
		$this->module->vsRelation->setTableName("{$bw->input ['tableName']}");
		$this->module->vsRelation->insertRel(NULL,NULL, false);
	}
	
	function loadDefault() {
		global $vsMenu, $vsSettings;
		
		$categories = $this->module->getCategories ();
		$strIds = $vsMenu->getChildrenIdInTree ( $categories );
		$size = $vsSettings->getSystemKey ( "comments_show_cat_num", 7, "comments" );
		
		$this->module->setFieldsString ( "commentsTitle,commentsImage,commentsId,commentsIntro,commentsContent,vsf_file.*" );
		$this->module->setCondition ( "commentsStatus > 0 and commentsCatId in ({$strIds})" );
		$this->module->setOrder ( "commentsId DESC" );
		$this->module->setTableName ( "comments left join vsf_file on commentsImage = fileId" );
		
		$option = $this->module->getPageList ( "comments", 1, 5 );
		
		return $this->output = $this->html->loadDefault ( $option );
	}
	
	
	public function loadDetail($objId) {
		global $bw, $vsLang, $vsPrint, $vsStd, $vsSettings, $vsMenu;
		
		$query = explode ( '-', $objId );
		$objId = abs ( intval ( $query [count ( $query ) - 1] ) );
		$this->module->setTableName ( "comments left join vsf_file on commentsImage = fileId" );
		$obj = $this->module->getObjectById ( $objId );
		if (! $obj)
			return $vsPrint->redirect_screen ( 'Không có dữ liệu theo yêu cầu' );
		$vsPrint->pageTitle = $obj->getTitle ();
		$option ['obj'] = $obj;
		$option ['category'] = $vsMenu->getCategoryById ( $obj->getCatId () );
		$option ['other'] = $this->module->getOtherList ( $obj );
		$otherHtml .= "<ul>";
		foreach ( $option ['other'] as $news ) {
			$otherHtml .= "<li><a href='" . $bw->base_url . "comments/detail/" . $news->getId () . "'>" . $news->getTitle () . "</a></li>";
		}
		$otherHtml .= "</ul>";
		$option ['other'] = " <div class='other'>" . "<h3>" . $vsLang->getWords ( 'comments_other_title', 'Các ý kiến khác' ) . "</h3>" . $otherHtml . "</div>";
		
		return $this->output = $this->html->loadDetail ( $obj, $option );
	}
	
	public function getOutput() {
		return $this->output;
	}
	
	public function setOutput($output) {
		$this->output = $output;
	}

}

?>