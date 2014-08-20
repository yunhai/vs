<?php
require_once(CORE_PATH.'widgets/widgets.php');

class widgets_controler extends VSControl_admin {

	function __construct($modelName){
			global $vsTemplate,$bw;//		$this->html=$vsTemplate->load_template("skin_widgets");
		parent::__construct($modelName,"skin_widgets","widget");
		$this->model->categoryName="widgets";

	}
function auto_run() {
		global $bw;
		
		switch ($bw->input [1]) {
			case $this->modelName . '_apply_item' :
				$this->applyItem($bw->input[2]);
				break;
			case $this->modelName . '_update_index' :
				$this->updateIndex($bw->input[2]);
				break;
			default :
				parent::auto_run();
				break;
				
		}
	}
	function indexChange(){
		global $bw;
		if(is_array($bw->input['indexitem']))
		foreach ($bw->input['indexitem'] as $id => $value) {
			$this->model->setCondition("`{$this->model->getPrimaryField()}` IN (".$id .")");
			$this->model->updateObjectByCondition(array('index'=>$value));
		}
		$this->lastModifyChange();
		return $this->output = $this->getObjList($bw->input[3]);
	}
	function applyItem($id){
		global $bw;
		$result=array();
		$this->model->getObjectById($id);
		if(!$this->model->obj){
			$result['status']=0;
			$result['message']="Object not found!";
			return $this->output=json_encode($result);
		}
		if(!$class_name=$this->model->checkWidget($bw->input['instant'])){
			$result['status']=0;
			$result['message']=$this->model->message;
			return $this->output=json_encode($result);
		}
		
		$instant=new $class_name();
		$data=unserialize($this->model->obj->option);
		$instant->onSubmitForm($bw->input['item'],&$data);
		$this->model->obj->option=serialize($data);
		$this->model->updateObject();
		$result['message']=VSFactory::getLangs()->getWords('update_success',"Update success!");
		return $this->output=json_encode($result);
	}
function getObjList($catId = '', $message = "",$option=array()) {
		global $bw,$DB;
		$option['message']=str_replace(array("'","\n"),array("\\'","\\n"), $message) ;
		$catId=intval($catId);
		if($_REQUEST['vdata']){
			$vdata=json_decode($_REQUEST['vdata'],true);
		}
		if($vdata['search']){//last query search
			$bw->input['search']=$vdata['search'];
			$option['table']=$this->displaySearch();
		}else{
			if($bw->input['pageIndex']){
				$bw->input[3]=$bw->input['pageIndex'];
			}
			$this->model->setOrder('`position`,`index` DESC');
//			if($this->model->getCategoryField()){
//				$ids=VSFactory::getMenus()->getChildrenIdInTree($this->model->getCategories());
//				if($ids)
//				$this->model->setCondition("{$this->model->getCategoryField()} in ($ids)");
//			}
//                        if($bw->input['module']=='products'){
//                            $this->model->setOrder('`index` ASC');
//                        }
//           $result = $DB->query("SHOW COLUMNS FROM `".$bw->vars['sql_tbl_prefix_0'].$this->tableName."` LIKE 'status'");
//			$exists = (mysql_num_rows($result))?TRUE:FALSE;
//			if($exists)
//				if($this->model->getCondition())
//					$this->model->setCondition($this->model->getCondition().' AND status>=0');
//					else $this->model->setCondition('status>=0');
            	$list=$this->model->getPageListHash($this->modelName."/".$bw->input [0]."/{$this->modelName}_display_tab/{$catId}/",3,100);
            	$tmp=$list['pageList'];
            	unset($list['pageList']);
            	///get position list here
            	$positionlist=array("BOTTOM"=>array(),"LEFT"=>array());
            	$list['pageList']=$positionlist;
            	foreach ($tmp as $wobj){
            		$list['pageList'][$wobj->getPosition()][$wobj->getId()]	=$wobj;
            	}
			$option=array_merge($option, $list);

			$option['s_order'] = $bw->input['search']['s_order']=='ASC'?'DESC':'ASC';
        	$option['s_ofield'] = $bw->input['search']['s_ofield'];
			$bw->input['pageIndex']=$bw->input[3];
			$bw->input['back']="&pageIndex=".$bw->input['pageIndex'];
			$option['table']=$this->html->getListItemTable ($list['pageList'], $option );
			///some here..................
		}
		return $this->output = $this->html->objListHtml ( $option );
	}
	function addEditObjForm($objId = 0, $option = array()) {
		global  $vsStd, $bw, $vsPrint;
		$files = scandir(WIDGETS_PATH);
		$option['widget_list']=array();
		foreach ($files as $file) {
			if(is_dir(WIDGETS_PATH.$file)&&$file!='..'&&$file!='.'&&file_exists(WIDGETS_PATH.$file."/widgets_$file.php")){
//				echo $file."<br>";
				require_once WIDGETS_PATH.$file."/widgets_$file.php";
				$class="widgets_$file";
				if(class_exists($class)){
					$myclass=new $class();
					$option['widget_list'][$file]=$myclass;
				}
			}
		}
		
		parent::addEditObjForm($objId,$option);
	}



	function getHtml(){
		return $this->html;
	}



	function getOutput(){
		return $this->output;
	}



	function setHtml($html){
		$this->html=$html;
	}




	function setOutput($output){
		$this->output=$output;
	}



	
	/**
	*Skins for widget ...
	*@var skin_widgets
	**/
	var		$html;

	
	/**
	*String code return to browser
	**/
	var		$output;
}
