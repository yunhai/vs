<?php
require_once CORE_PATH.'pages/pages.php';
class pages_controler_public extends VSControl_public {
	function __construct($modelName){
		global $vsTemplate,$bw,$vsPrint,$vsSkin;
		if(file_exists(ROOT_PATH.$vsSkin->basicObject->getFolder()."/skin_".$bw->input[0].".php")){
			
		parent::__construct($modelName,"skin_".$bw->input[0],"page",$bw->input[0]);;
		}else{
		parent::__construct($modelName,"skin_pages","page",$bw->input[0]);
		}
		unset($_SESSION['active']);
	}
	
	/**
	 * 
	 * @var pages
	 */
	protected $model;
	
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
			case $this->modelName.'_show_video':
				$this->showVideo($bw->input[2]);
				break;	
			case $this->modelName.'_send':
				$this->send();
				break;	
			case $this->modelName.'_export':
				$this->export_exel();
				break;	
			default :
				$this->showDefault ();
				break;
		}
	}
	
	function export_exel(){
  global $bw;
  
 
  date_default_timezone_set ( "Asia/Ho_Chi_Minh" );
    
  require_once './Classes/ExExcel.php';
  $phpExcel = new PHPExcel();
  $time=time();
  
   $this->model->setCondition("status>=0");
   $option['list']=$this->model->getObjectsByCondition();
  $time=VSFactory::getDateTime()->getDate(time());
  $foo = $phpExcel->getActiveSheet();
  $foo->setCellValue("A1", "list Email -- {$time} ");
  $foo->setCellValue("A2", "STT");
  $foo->setCellValue("B2", "Email");
  
  $phpExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
  $phpExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);

  $option['letter']=Object::getObjModule('pages', 'getEmail', '>-1', '', '');

  $col=3;
  foreach ($option['letter'] as $key=>$value){
   $foo->setCellValue("A$col", "$value->stt");
   $foo->setCellValue("B$col", "{$value->getTitle()}");
 
   $col++;
  }
  
  //for ($i=0;$i<=100;$i++){
   
  //}
  
  
  $phpExcel->getActiveSheet()->mergeCells('A1:F1');//->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  //$phpExcel->getActiveSheet()->getStyle("A1:H1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $phpExcel->getActiveSheet()->getStyle("A1:F1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $phpExcel->getActiveSheet()->getStyle("A1:A1000")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  /*$phpExcel->getActiveSheet()->getStyle("AH2:AJ2")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/
 
  $phpExcel->setActiveSheetIndex(o);
 
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=\"list-email-$time.xlsx\"");
  header("Cache-Control: max-age=0");
 
  $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
  $objWriter->save("php://output");
  exit;
  
 }
	function showVideo(){
			global $bw,$vsStd;
			$link=$bw->input['link'];
			return $this->output=$this->getHtml()->showVideo($link);
		}
	
	function showDefault($option=array()){
		global $bw,$vsTemplate,$vsStd,$vsPrint;
                //if(in_array($bw->input['module'], array('abouts','maps','helps')))return $this->showDefault1 ();
		$category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$option['cate_list']=VSFactory::getMenus()->getCategoryGroup($bw->input[0])->getChildren();
		
		if(!$category){
			$vsPrint->boink_it($bw->base_url);
		}
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		$this->model->setCondition("status>0 and catId in ($ids)");
		$this->model->setOrder("`index`,id desc");
		$tmp=$this->model->getPageList($bw->input[0],1,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',12));
		$option=array_merge($tmp,$option);
		$option['breakcrum']=$this->createBreakCrum($category);
		$option['title']=VSFactory::getLangs()->getWords($bw->input[0]);
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
       	$option['cate'] = $category->getChildren();
      
        if($option['pageList'] and in_array($bw->input[0],array('abouts','customers'))){
         	$obj=current($option['pageList']);
         	$vsPrint->boink_it($obj->getUrl($bw->input[0]));
         }       
      
        return $this->output = $this->getHtml()->showDefault($option);
	}

	function showCategory($catId){
		global $bw,$vsPrint;
        $category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$idcate = $this->getIdFromUrl($catId);		
		$category=VSFactory::getMenus()->getCategoryById($idcate);
		if(!$category){
			$vsPrint->boink_it($bw->base_url);
		}
		
		
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		$this->model->setCondition("status>0 and catId in ({$idcate})");
		
		$this->model->setOrder("`index` desc,id desc");
		$option=$this->model->getPageList($bw->input[0]."/".$bw->input[1]."/".$bw->input[2]."/".$bw->input[3],4,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',12));

		$option['title']=$category->getTitle();
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
        $option['cate'] = $category->getChildren();
        $option['breakcrum']=$this->createBreakCrum(VSFactory::getMenus()->getCategoryById($idcate) );
        $option['obj']=$category;
     
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
		$option['other']=$this->getOtherList($obj);
		$option['cate'] = $category->getChildren();
		$option['cate_obj']=VSFactory::getMenus()->getCategoryById($obj->getCatId());
		
		$obj->createSeo();
		if($bw->input[0]=='customer-service')
			$this->showQuestion($option);
			
		
	
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
	
	function showQuestion(&$option) {
		require_once CORE_PATH.'pages/pages.php';
		$pages=new pages();
	
		$category=VSFactory::getMenus()->getCategoryGroup('customer-service');
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
	
		$pages->setCondition("catId in ($ids)");
		$pages->setOrder("`index`");
		$pages->setFieldsString ( "id,title" );
		$option['obj_list']=$pages->getObjectsByCondition();
	}
	function send($option) {
		global $bw,$vsStd;
		
		require_once CORE_PATH.'pages/pages.php';
		$pages=new pages();
		$category=VSFactory::getMenus()->getCategoryGroup('getEmail');
		$pages->basicObject->setTitle($bw->input['new_email']);
		$pages->basicObject->setCatId($category->getId());
		
		
			$pages->insertObject();
		
		
		
		
	}
	
    function getListLangObject(){
         	
    }
	function showSearch($option=array()){
		global $bw,$vsTemplate,$vsStd,$vsPrint;
		$category=VSFactory::getMenus()->getCategoryGroup('projects');
		
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		
		
		
		
		$condition="1=1 ";
		if($bw->input['provin']){
			$condition.=" and status >0 and catId in ($ids) and provin like '%".mysql_real_escape_string($bw->input['provin'])."%'";	
		}
		if($bw->input['dis']){
			$condition.=" and status >0 and catId in ($ids)  and dis like '%".mysql_real_escape_string($bw->input['dis'])."%'";	
		}
		if($bw->input['provin'] and $bw->input['dis']){
			$condition.=" and status >0 and catId in ($ids) and provin like '%".mysql_real_escape_string($bw->input['provin']) ."%' and dis like '%".mysql_real_escape_string($bw->input['dis']) ."%'";	
		}

		$this->model->setCondition($condition);
		$this->model->setOrder("`index`,id desc");
		$option['pageList']=$this->model->getObjectsByCondition();

		$option['breakcrum']=$this->createBreakCrum(null);
		if($bw->input['keyword'])
		$option['title']=VSFactory::getLangs()->getWords('products_search_title','Tìm kiếm với từ khóa: ')."<i>".$bw->input['keyword']."</i>";
		else 
		$option['title']=VSFactory::getLangs()->getWords('products_search_result','Kết quả tìm kiếm');
		$vsPrint->mainTitle=$vsPrint->pageTitle="Tìm kiếm với từ khóa: ".$option['title'];
		$option['obj']=new Menu();
		$option['obj']->setTitle("Tìm kiếm");

        return $this->output = $this->getHtml()->showDefault($option);
        
//		return $this->output="";
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
	 * @var skin_pages
	 */
	public $html;
}

?>