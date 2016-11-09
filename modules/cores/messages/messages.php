<?php
require_once(CORE_PATH."messages/Message.class.php");

class messages extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "messageId";
		$this->basicClassName = "Message";
		$this->tableName = 'message';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
	
	function getMessageObjectById($id) {
		global $DB, $vsUser;
		$this->resetResult();
		$id = intval($id);
		
		$tableName = $this->tableName." as m, vsf_message_group as g, vsf_message_deliver AS d";
		$condition = "m.messageGroup = g.groupId AND m.messageId = ".$id.
					 " AND m.messageId = d.deliverMessage AND d.deliverRecipient = ".
					 $vsUser->obj->getId();
		
		$query = array(
					'select'=> $this->fieldsString,
					'from'	=> $tableName,
					'where'	=> $condition,
		);
		$DB->simple_construct($query);
		$DB->simple_exec();
		$objDB = $DB->fetch_row();

		if(is_array($objDB)) { // send to him
			$this->basicObject->convertToObject($objDB);
			$this->createMessageSuccess($this->vsLang->getWords('develop_get_obj_success',"Execute successful"));
			
			$this->basicObject->setTitle($objDB['groupTitle']);
			$this->basicObject->deliverStatus = $objDB['deliverStatus'];
			
			return $this->basicObject;
		}else{ 
			$tableName = $this->tableName." as m, vsf_message_group as g, vsf_message_deliver AS d";
			$condition = "m.messageGroup = g.groupId AND messageStatus > 1 AND ".
						 "(m.messageId <> ".$id." OR (m.messageOriginal = ".$id." AND m.messageType = 2)) AND ".
					  	 "m.messageId = d.deliverMessage AND d.deliverRecipient = ".$vsUser->obj->getId()." AND ".
						 "m.messageGroup = (SELECT mm.messageGroup FROM vsf_message as mm WHERE mm.messageId = ".$id.")";
			$query = array(
						'select'=> '*',
						'from'	=> $tableName,
						'where'	=> $condition,
			);
			$DB->simple_construct($query);
			$DB->simple_exec();
			$objDB = $DB->fetch_row();
			
			if(is_array($objDB)) {// reply to him
				$this->createMessageSuccess($this->vsLang->getWords('develop_get_obj_success',"Execute successful"));
				$title = $objDB['groupTitle'];
				$deliverStatus = $objDB['deliverStatus'];
			}
			if($title){
				$this->getObjectById($id);
				$this->basicObject->setTitle($title);
				$this->basicObject->deliverStatus = $deliverStatus;
				return $this->basicObject;
			}
		}
		
		$this->createMessageError($this->vsLang->getWords('develop_get_obj_fail', "No object was found"));
		$this->resetQuery();
		return false;
	}


	function sendMessage($data = array()){
			global $bw, $vsPrint, $vsUser, $vsStd, $vsLang;

			$result = array();
			$time = time(); 

			$vsStd->requireFile(CORE_PATH."messages/mgroups.php");
			$mgroup = new mgroups();
			
			$user = new users();
			$result = $user->convertNameToId($data['messageRecipient']);
	
			if(!$result) return false;
			
			$mgroup->obj = new MGroup();
			$gData['groupTitle'] = $data['messageTitle'];
			$mgroup->obj->convertToObject($gData);
			
			$mgroup->insertObject($mgroup->obj);
			$group = $mgroup->obj->getId();
			
				
			
			
			$data['messageGroup'] = $group;
			$data['messageType'] = 1;
			$data['messagePostdate'] = $time;
			$data['messageStatus'] = 3;
			
			$this->obj->convertToObject($data);
			$this->insertObject();
			

			$insert = array();
			
			foreach(array_keys($result) as $recipient){
				$insert[$recipient]['deliverMessage'] = $this->obj->getId();
				$insert[$recipient]['deliverRecipient'] = $recipient;
				$insert[$recipient]['deliverPostdate'] = $time;
				$insert[$recipient]['deliverStatus'] = 2;
			}
			
			$vsStd->requireFile(CORE_PATH."messages/delivers.php");
			$deliver = new delivers();
			
			$deliver->multiInsert($insert);
			return true;
	}
}
?>