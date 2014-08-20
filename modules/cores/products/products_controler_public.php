<?php
require_once CORE_PATH . 'products/products.php';
class products_controler_public extends VSControl_public {

	function __construct($modelName) {
		global $vsTemplate, $bw;
		// $this->html=$vsTemplate->load_template("skin_product");
		parent::__construct ( $modelName, "skin_products", "product", $bw->input [0] );
		// $this->model->categoryName=$bw->input[0];
	}

	function auto_run() {
		global $bw;
		
		switch ($bw->input ['action']) {
			case $this->modelName . '_get_price' :
				$this->getPrice ();
				break;
			case $this->modelName . '_label' :
				$this->showLabel ();
				break;
			case $this->modelName . '_search' :
				$this->showSearch ();
				break;
			case $this->modelName.'_tags':
				$this->getTags();
				break;	
			case $this->modelName .'_category' :
				$this->showCategory($bw->input[2]);
				break;
			case $this->modelName .'_categories' :
				$this->showCategories($bw->input[2]);
				break;
			default :
				
				parent::auto_run ();
				break;
		}
	}
	
	
function getTags($option=array()){
		global $vsPrint, $bw,$vsTemplate;   
		
		$category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		
		require_once CORE_PATH.'tags/tags.php';     
		$tags=new tags();
		$tags->getObjectById($this->getIdFromUrl($bw->input[2]));
		if(!$tags->obj->getId()) $vsPrint->boink_it("");
		$category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
//		$tags->getContentByTagId($module, $id);
		$products=new products();
		$products->setCondition("id IN (SELECT contentId FROM vsf_tagcontent WHERE tagid='{$this->getIdFromUrl($bw->input[2])}' )");
		$option=$products->getPageList($bw->input[0]."/".$bw->input[1]."/".$bw->input[2],3,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',10));
		
		$option['title']=$tags->obj->getTitle();
		$tags->obj->createSEO();
		$option['obj']=$tags->obj;
		
		
		
		$option['breakcrum']=$this->createBreakCrum(null);
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
		$option['cate'] = $category->getChildren();
	
		
        return $this->output = $this->getHtml()->showDefault($option);

	}
	
	
	function showSearch($option=array()){
		global $bw,$vsTemplate,$vsStd,$vsPrint;
		$condition="1=1 ";
		if($bw->input['keyword']){
			$condition.=" and status >0 and title like '%".mysql_real_escape_string($bw->input['keyword'])."%'";	
		}

		$this->model->setCondition($condition);
		$this->model->setOrder("`index`,id desc");
		$option['pageList']=$this->model->getObjectsByCondition();

		$option['breakcrum']=$this->createBreakCrum(null);
		if($bw->input['keyword'])
		$option['title']=VSFactory::getLangs()->getWords('products_search_title','Tìm kiếm với từ khóa: ')."<i>".$bw->input['keyword']."</i>";
		else $option['title']=VSFactory::getLangs()->getWords('products_search_result','Kết quả tìm kiếm');
		$vsPrint->mainTitle=$vsPrint->pageTitle="Tìm kiếm với từ khóa: ".$option['title'];
		$option['obj']=new Menu();
		$option['obj']->setTitle("Tìm kiếm");

        return $this->output = $this->getHtml()->showDefault($option);
        
//		return $this->output="";
	}
	function showCategory($catId){
		global $bw,$vsPrint;
               // $category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$idcate = $this->getIdFromUrl($catId);		
		$category=VSFactory::getMenus()->getCategoryById($idcate);
		if(!$category){
			//$vsPrint->boink_it($bw->base_url);
		}
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
		
		$this->model->setCondition("status>0 and catId in ({$ids})");
		$this->model->setOrder("`index` DESC,id desc");
		$option=$this->model->getPageList($bw->input[0]."/".$bw->input[1]."/".$bw->input[2],3,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_public_limit',12));

		$option['title']=$category->getTitle();
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
        $option['obj']=$category;
        $option['breakcrum']=$this->createBreakCrum($category);
		return $this->output = $this->getHtml()->showDefault($option);
	}	
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
		$this->model->setOrder("`index` desc,id desc");
		$tmp=$this->model->getPageList($bw->input[0],1,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',12));
		$option=array_merge($tmp,$option);
		$option['breakcrum']=$this->createBreakCrum(null);
		$option['title']=VSFactory::getLangs()->getWords($bw->input[0]);
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
                $option['cate'] = $category->getChildren();
        return $this->output = $this->getHtml()->showDefault($option);
	}
        
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
       	
       	//count view
		if (!isset($_SESSION[$bw->input[0].$obj->getId().'view'])){
			   $obj->setHot($obj->getHot()+1);
			   $this->model->updateObjectById($obj); 
			   $_SESSION[$bw->input[0].$obj->getId().'view']="stop_view++";
		  }
       	
     
	
		
			
		
    	$this->output = $this->getHtml()->showDetail($obj,$option);
	}
	public function getOtherList($obj) {
		global $bw;
		$vsMenu = VSFactory::getMenus();
		$cat = $vsMenu->getCategoryById ( $obj->getCatId () );
		$ids = $vsMenu->getChildrenIdInTree ( $cat );
	
		$this->model->setOrder ( "`index` Desc, id Desc" );
		$condition = "id <> {$obj->getId()} and status >0";
		$this->model->setLimit ( array (0, 4 ) );
		if ($ids)
			$condition .= " and catId in ( {$ids})";
	
		$this->model->setCondition($condition);
		return $this->model->getObjectsByCondition ();
	}
	
function showLabel() {
		global $bw, $vsTemplate, $vsStd, $vsPrint;

		
		$idlabel = $this->getIdFromUrl($bw->input[2]);

		
		$this->model->setCondition("status>0 and `label` LIKE '%-{$idlabel}-%'");
		$this->model->setOrder("`index`,id desc");
		$option=$this->model->getPageList($bw->input[0],1,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',10));
		
		//$option['title']=$category->getTitle();
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
        $option['cate']=VSFactory::getMenus()->getCategoryGroup($bw->input[0])->getChildren();
      
        $option['breakcrum']=$this->createBreakCrum($category);
        return $this->output = $this->getHtml()->showDefault($option);
	}
	
	/*
	 * Show detail action
	 */
	function getListLangObject() {
	}

	/**
	 *
	 * @param
	 *        	BasicObject
	 */
	protected function onDeleteObject($obj) {
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
	 *
	 *
	 *
	 *
	 *
	 * Enter description here ...
	 *
	 * @var skin_products
	 */
	public $html;
}

?>