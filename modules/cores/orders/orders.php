<?php
global $vsStd;
$vsStd->requireFile ( CORE_PATH . "orders/Order.class.php");
$vsStd->requireFile ( CORE_PATH . "orders/orderitem.php" );
class orders extends VSFObject {
	public $obj;
	public $arrayObj = array();
	public $className;
	public $orderitem;
	
	function __construct() {
		global $DB;
		parent::__construct ();
		$this->primaryField = 'orderId';
		$this->basicClassName = 'Order';
		$this->tableName = 'order';
		$this->obj	=$this->createBasicObject ();
		$this->fields = $this->obj->convertToDB();
		$this->orderitem = new orderItems();
	}
	
	function __destruct() {
		unset ( $this->obj );
		unset ( $this->className );
		unset ( $this->objsource );
	}
	
	function getItemByUserId($userId, $url, $size, $index){
		$this->orderitem->setCondition('bookUserId in ('.$userId.")");
		$this->orderitem->setOrder('orderId DESC');
		return $this->orderitem->getPageList($url, $index, $size);
	}
	
	function updateOrderItem($condition= "", $update= array()){
		if($condition) $this->orderitem->setCondition($condition);
		$this->orderitem->updateObjectByCondition($update);
		return $this->orderitem->result;
	}
}
?>