<?php
require_once(CORE_PATH."messages/Draft.class.php");

class drafts extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "draftId";
		$this->basicClassName = "Draft";
		$this->tableName = 'message_draft';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
	
	function getMessageObjectById($id) {
		global $DB;
		$this->resetResult();
		$id = intval($id);
		
		$tableName = $this->tableName." as m, vsf_message_group as g";
		$condition = "m.messageGroup = g.groupId AND m.messageId = ".$id;
		$query = array(
					'select'=> $this->fieldsString,
					'from'	=> $tableName,
					'where'	=> $condition,
		);
		$DB->simple_construct($query);
		$DB->simple_exec();
		$objDB = $DB->fetch_row();
		if(is_array($objDB)) {
			$this->basicObject->convertToObject($objDB);
			$this->createMessageSuccess($this->vsLang->getWords('develop_get_obj_success',"Execute successful"));
			
			$this->basicObject->setTitle($objDB['groupTitle']);
			return $this->basicObject;
		}
		
		$this->createMessageError($this->vsLang->getWords('develop_get_obj_fail', "No object was found"));
		$this->resetQuery();
		return false;
	}
}
?>