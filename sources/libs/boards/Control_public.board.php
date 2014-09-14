<?php
class VSControl_public extends VSControl {

	function __construct($modelName, $skinName, $tableName, $categoryName = '') {
		global $bw, $vsPrint;
		$this->modelName = $modelName;
		$this->model = new $modelName ( $categoryName );
		$this->tableName = $tableName;

		if($skinName) {
    		global $vsTemplate;
    		$this->html = $vsTemplate->load_template ( $skinName );
    		$this->html->modelName = $modelName;
    		$this->html->model = $this->model;
		}
		$vsPrint->pageTitle = $vsPrint->mainTitle = VSFactory::getLangs ()->getWords ( $bw->input [0] );
		// //////////
	}
	/*
	 * @description function auto_run, it's a router for actions in model
	 */
	function auto_run() {
		global $bw;
		
		switch ($bw->input ['action']) {
			case $this->modelName . '_detail' :
				$this->showDetail ( $bw->input [2] );
				break;
			
			case $this->modelName . '_category' :
				$this->showCategory ( $bw->input [2] );
				break;
			case $this->modelName . '_review' :
				$this->showReview ( $bw->input [2] );
				break;
			case $this->modelName . '_search' :
				$this->showSearch ();
				break;
			default :
				$this->showDefault ();
				break;
		}
	}

	function showSearch() {
		return $this->output = "";
	}

	function showReview($id) {
		return $this->output = "No thing to do!";
	}
	/*
	 * Show default action
	 */
	function showDefault($option = array()) {
		global $bw, $vsTemplate, $vsStd, $vsPrint;
		if (in_array ( $bw->input ['module'], array ('abouts', 'maps', 'helps' ) ))
			return $this->showDefault1 ();
		$category = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] );
		if (! $category) {
			$vsPrint->boink_it ( $bw->base_url );
		}
		$ids = VSFactory::getMenus ()->getChildrenIdInTree ( $category);
		$this->model->setCondition("status>0 and catId in ($ids)");
		$this->model->setOrder("`index`,id desc");
		$tmp=$this->model->getPageList($bw->input[0],1,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',12));
		$option=array_merge($tmp,$option);
		$option['breakcrum']=$this->createBreakCrum(null);
		$option['title']=VSFactory::getLangs()->getWords($bw->input[0]);
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
                $option['cate'] = $category->getChildren();
        return $this->output = $this->getHtml()->showDefault($option);
	}
        
    function showDefault1(){
		global $bw,$vsTemplate,$vsStd,$vsPrint;
		$category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		if(!$ids){
			$this->output =VSFactory::getLangs()->getWords('not_count_item');
		}
		$option['breakcrum']=$this->createBreakCrum(null);
		$this->model->setCondition("catId in ($ids) and status >0");
		$this->model->setOrder("`index`");
		$this->model->getOneObjectsByCondition();
        return $this->output = $this->getHtml()->showDetail($this->model->basicObject,$option);
	}
	
	/*
	 * Show detail action 
	 */
	function showDetail($objId,$option=array()){
		global $vsPrint, $bw,$vsTemplate;     
                $category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$obj=$this->model->getObjectById($this->getIdFromUrl($objId));
		if(!$obj->getId()||$obj->getStatus()<=0){
			return $this->output=VSFactory::getLangs()->getWords('not_count_item');
		}
		$obj->createSeo();
		$option['breakcrum']=$this->createBreakCrum($obj);
		$option['other']=$this->model->getOtherList($obj);
        $option['cate'] = $category->getChildren();
        $option['cate_obj']=VSFactory::getMenus()->getCategoryById($obj->getCatId());
       	$obj->createSeo();
    	$this->output = $this->getHtml()->showDetail($obj,$option);
	}
	
	/*
	 * Show category action 
	 */
function showCategory($catId){
		global $bw,$vsPrint;
               // $category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$idcate = $this->getIdFromUrl($catId);		
		$category=VSFactory::getMenus()->getCategoryById($idcate);
		if(!$category){
			$vsPrint->boink_it($bw->base_url);
		}
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		$this->model->setCondition("status>0 and catId in ({$idcate})");
		$this->model->setOrder("`index`,id desc");
		$option=$this->model->getPageList($bw->input[0],1,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',10));

		$option['title']=$category->getTitle();
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
        $option['obj']=$category;
        $option['breakcrum']=$this->createBreakCrum($category);
		return $this->output = $this->getHtml()->showDefault($option);
	}
	
    function createBreakCrum($obj, $option = array()){
		global $bw;
		
		$state_city = array(
		                2 => VSFactory::getLangs()->getWords('posts_state', 'Bang'),	
		                3 => VSFactory::getLangs()->getWords('posts_cty', 'Thành phố')
		);
		
		$format = array(
			        2 => 'posts/category/state/',
	                3 => 'posts/category/city/'
		);
		
		$array=array();
		$html = '<li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">'.
		               "<span itemprop='title'>{$option['target']->getTitle()}</span>".
		       '</li>';
		
		if(is_object($obj)) {
			if(get_class($obj)=='Menu') {
				while($obj->getLevel() > 1) {
					$html = '<li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">'.
					           "<a href='{$obj->getCatUrl($format[$obj->getLevel()])}/{$option['category']->getSlugId()}' itemprop='url'>".
					               "{$state_city[$obj->getLevel()]}&nbsp;<span itemprop='title'>\"{$obj->getTitle()}\"</span>".
				               "</a>".
					       '</li>'.
					       $html;
					
					$obj = VSFactory::getMenus()->getCategoryById($obj->getParentId());	
				}
			}
		}
		
		return "<ul class='breadcrumb'>{$html}</ul>";	
    }
	/**
	 * 
	 * Enter description here ...
	 * @var skin_objectpublic
	 */
	public $html;
	/**
	 * (non-PHPdoc)
	 * @see sources/libs/boards/VSControl::getHtml()
	 *@return skin_objectpublic
	 */
	public function getHtml() {
		return $this->html;
	}
	/**
	 * 
	 * Enter description here ...
	 * @var VSFObject
	 */
	protected  $model;
}
?>