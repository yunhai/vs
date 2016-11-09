<?php
require_once LIBS_PATH . "boards/Object.board.php";
class VSFObject extends Object{

	function getPageList($url, $objIndex=3, $size=10, $ajax = 0, $callack="", $method='getId', $group=0){
		global $vsStd,$bw;
		$vsStd->requireFile(LIBS_PATH."Pagination.class.php");
		$total = $this->getNumberOfObject();
		if($size < $total){
			$pagination = new VSFPagination();
			$pagination->text['p_Page']		= "";
			$pagination->ajax				= $ajax;
			$pagination->callbackobjectId 	= $callack;
			$pagination->url 				= $ajax?ltrim($url,'/')."/":$bw->base_url.(trim($url,'/')."/");
		
			$pagination->p_Size 			= $size;
			$pagination->p_TotalRow 		= $total;
			$pagination->SetCurrentPage($objIndex);
			$pagination->BuildPageLinks();
			$this->setLimit(array($pagination->p_StartRow, $pagination->p_Size));
		}

		$option['current'] = $pagination->p_Current;
		$option['paging'] = $pagination->p_Links;

		$option['pageList'] = $this->getObjectsByCondition($method, $group);
		
		$option['total'] = $total;
		return $option;
	}
	
	function getAdvancePageList($url, $objIndex=3, $size=10, $ajax = 0, $callack="", $method='getId', $group=0, $type = 0, $extend = array()){
		global $vsStd,$bw;
		$vsStd->requireFile(LIBS_PATH."Pagination.class.php");
		$total = $this->getNumberOfObject();
		if($size < $total){
			$pagination = new VSFPagination();
			$pagination->text['p_Page']		= "";
			$pagination->ajax				= $ajax;
			$pagination->callbackobjectId 	= $callack;
			$pagination->url 				= $ajax?ltrim($url,'/')."/":$bw->base_url.(trim($url,'/')."/");
		
			$pagination->p_Size 			= $size;
			$pagination->p_TotalRow 		= $total;
			$pagination->SetCurrentPage($objIndex);
			$pagination->BuildPageLinks();
			$this->setLimit(array($pagination->p_StartRow, $pagination->p_Size));
		}

		
		$option['current'] = $pagination->p_Current;
		$option['paging'] = $pagination->p_Links;

		$option['pageList'] = $this->getAdvanceObjectsByCondition($method, $group, $type, $extend);
		$option['total'] = $total;
		return $option;
	}
	
	function getArrPageList($url, $objIndex=3, $size=10, $ajax = 0, $callack="", $method = "", $group = 0){
		global $vsStd,$bw;
		$vsStd->requireFile(LIBS_PATH."/Pagination.class.php");
		$total = $this->getNumberOfObject();
		if($size < $total){
			$pagination = new VSFPagination();
			$pagination->ajax				= $ajax;
			$pagination->callbackobjectId 	= $callack;
			$pagination->url 				= $ajax?ltrim($url,'/')."/":$bw->base_url.(trim($url,'/')."/");
		
			$pagination->p_Size 			= $size;
			$pagination->p_TotalRow 		= $total;
			$pagination->SetCurrentPage($objIndex);
			$pagination->BuildPageLinks();
			$this->setLimit(array($pagination->p_StartRow,$pagination->p_Size));
		}
		$option['paging'] = $pagination->p_Links;

		$option['pageList'] = $this->getArrayByCondition($method, $group);
		$option['total'] = $total;
		return $option;
	}
	
	function countTable() {
		global $DB,$vsLang;
		$this->resetResult();
		$this->fieldsString="count({$this->primaryField}) as total";
		$this->createMessageSuccess($this->vsLang->getWords('count_table_success', "count table successfully!"));
		$query = array(	'select'=> $this->fieldsString,
					 	'from'	=> $this->tableName,
					   	'where'	=> $this->condition
		);
		$totalfeild=1;
		if($this->groupby)
		{
			$query['select'] = "{$this->groupby},$this->fieldsString";
			$query['groupby'] = $this->groupby;
			$totalfeild= count(explode(',',$this->groupby));
		}
		$DB->simple_construct($query);
		$this->resetQuery();
		$array=array();
		if(!$DB->simple_exec()) {
			$this->createMessageError($this->vsLang->getWords('count_table_condition_fail',"There is no item in table!"));
			return $array;
		}
		$result=mysql_fetch_row($DB->query_id);
		if(!is_array($result))
		{
			$this->createMessageError($this->vsLang->getWords('count_table_condition_fail',"There is no item in table!"));
			return array();
		}
		try{
			while($result) {
				$eval ="\$array";
				
				for($i=0; $i<$totalfeild; $i++)
					$eval =$eval."[$result[$i]]";
				
				eval($eval."=$result[$totalfeild] ;");
				$result=mysql_fetch_row($DB->query_id);
			}
		}catch(Exception $e){
			$this->createMessageError($this->vsLang->getWords('count_table_condition_fail',"There is no item in table!"));
			Throw new Exception($e);
		}
		return $array;
	}

	
	
	
	
	
	
	
	
	
	
	function getObjectById($id) {
		return parent::getObjectById($id);
	}
	
	function getOneObjectsByCondition() {
		return parent::getOneObjectsByCondition();
	}

	function getObjectsByCondition($method='getId',$group=0) {
		return parent::getObjectsByCondition($method,$group);
	}

	function deleteObjectByCondition() {
		return parent::deleteObjectByCondition();
	}

	function __construct() {
		parent::__construct();
	}

	function createBasicObject(){
		return parent::createBasicObject();
	}

	function getNumberOfObject() {
		return parent::getNumberOfObject();
	}
	
	function deleteObjectById($id) {
		$this->condition = $this->prefixField.$this->primaryField ."=".intval($id);
		return $this->deleteObjectByCondition($id);
	}

	function updateObjectByCondition($updateFields = array()) {
		global $DB;
		if (isset ( $updateFields ['seoId'] ) && ! $DB->field_exists ( 'seoId', $this->tableName ))
			$DB->sql_add_field ( $this->tableName, 'seoId', 'int(255)','NULL' );
		
		return parent::updateObjectByCondition ( $updateFields );
	}

	function updateObjectById($obj = null) {
		global $DB;
		if (isset ( $obj->seoId ) && ! $DB->field_exists ( 'seoId', $this->tableName ))
			$DB->sql_add_field ( $this->tableName, 'seoId', 'int(255)','NULL' );
		return parent::updateObjectById($obj);
	}

	function insertObject($object = null) {
		global $DB;
		if (isset ( $object->seoId ) && ! $DB->field_exists ( 'seoId', $this->tableName ))
			$DB->sql_add_field ( $this->tableName, 'seoId', 'int(255)','NULL' );
		return parent::insertObject($object);
	}

	function executeQuery($query = ""){
		if(!$query) return false;
		global $DB;
		$DB->cur_query = $query;
		$DB->simple_exec();
		return $DB;
	}

	function reportError(){
		print '<script type="text/javascript">window.parent.alertError("'.$this->result['message'].'");</script>';
		return;
	}

	function getBasicObject() {
		return $this->basicObject;
	}

	function getBasicClassName() {
		return $this->basicClassName;
	}

	function setBasicObject($basicObject) {
		$this->basicObject = $basicObject;
	}

	function setBasicClassName($basicClassName) {
		$this->basicClassName = $basicClassName;
	}

	function setPrimaryField($primaryField) {
		$this->primaryField = $primaryField;
	}

	function setTableName($tableName) {
		$this->tableName = $tableName;
	}

	function getPrimaryField() {
		return $this->primaryField;
	}

	function getTableName() {
		return $this->tableName;
	}

	function setFieldsString($fieldsString) {
		$this->fieldsString  = $fieldsString ? $fieldsString : "*";
	}

	function getFieldsString() {
		return $this->fieldsString;
	}

	function setHaving($value) {
		$this->having  = $value;
	}

	function getHaving() {
		return $this->having;
	}

	function setResult($result) {
		$this->result = $result;
	}

	function setFields($fields) {
		$this->fields = $fields;
	}

	function getResult() {
		return $this->result;
	}

	function getFields() {
		return $this->fields;
	}

	function setLimit($limit) {
		$this->limit = $limit;
	}

	function setOrder($order) {
		$this->order = $order;
	}
	
	function setGroupby($groupby) {
		$this->groupby = $groupby;
	}

	function setCondition($condition) {
		$this->condition = $condition;
	}

	function getLimit() {
		return $this->limit;
	}

	function getGroupby() {
		return $this->groupby;
	}

	function getOrder() {
		return $this->order;
	}

	function getCondition() {
		return $this->condition;
	}

	function setPrefixField($prefixField) {
		$this->prefixField = $prefixField;
	}

	function getPrefixField() {
		return $this->prefixField;
	}

	function setArrayObj($arrayObj) {
		$this->arrayObj = $arrayObj;
	}

	function getArrayObj() {
		return $this->arrayObj;
	}

	function getListIds() {
		return implode(',',array_keys($this->arrayObj));
	}
}