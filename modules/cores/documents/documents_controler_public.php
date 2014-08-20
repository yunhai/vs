<?php
require_once CORE_PATH.'documents/documents.php';
class documents_controler_public extends VSControl_public {
	function __construct($modelName){
		global $vsTemplate,$bw;
//		$this->html=$vsTemplate->load_template("skin_document");
		parent::__construct($modelName,"skin_documents","document",$bw->input[0]);
		//$this->model->categoryName=$bw->input[0];
	}
function auto_run() {
	global $bw;
		
		switch ($bw->input['action']) {
			case $this->modelName.'_download':
				$this->download($bw->input[2]);
				break;
			default:
				parent::auto_run();
				break;
		}
		
	}
	function download($objId){
		$this->model->getObjectById($objId);
		if(!$this->model->basicObject->getId()){
			return $this->output="File not found!";
		}
		$files=new files();
		$files->getObjectById($this->model->basicObject->getImage());
		if(!$files->basicObject->getId()){
			return $this->output="File not found!";
		}
		header("Content-type: application/{$files->basicObject->getType()}");
			// It will be called downloaded.pdf
			header("Content-Disposition: attachment; filename={$files->basicObject->getName()}.{$files->basicObject->getType()}");
			// The PDF source is in original.pdf
			readfile($files->basicObject->getPathView(0));
			exit;
	}
/*
	 * Show default action 
	 */
	function showDefault(){
		global $bw,$vsTemplate,$vsPrint;
		$category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		if(!$category){
			$vsPrint->boink_it($bw->base_url);
		}
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		$this->model->setCondition("status>0 and catId in ($ids)");
		//$this->model->setCondition("status>1");
		$option=$this->model->getPageList("documents",1,VSFactory::getSettings()->getSystemKey('document_page_limit',6));
		//$option['hot']=$this->model->getHotPost(VSFactory::getSettings()->getSystemKey('hot_post_limit',4));
		$option['breakcrum']=$this->createBreakCrum(null);
        return $this->output = $this->getHtml()->showDefault($option);
	}
	/**
	 * 
	 * @var documents
	 */
	protected $model;
	
	
    function getListLangObject(){
         	
    }
       /**
        * 
        * @param BasicObject
        */ 
    protected  function  onDeleteObject($obj){
    }
	public function getHtml() {
		return $this->html;
	}
	
	public function getOutput() {
		return $this->output;
	}
	
	public function setHtml($html) {
		$this->html = $html;
	}
	
	public function setOutput($output) {
		$this->output = $output;
	}
	/**
	 * 
	 * Enter description here ...
	 * @var skin_documents
	 */
	public $html;
}

?>