<?php 
require_once(CORE_PATH."users/User.class.php");

class users extends VSFObject {


	/**
	*Enter description here ...
	**/
	public	function __construct($category=''){
			$this->primaryField 	= 'id';
		$this->basicClassName 	= 'User';
		$this->tableName 		= 'user';
		//$this->categoryField='catId';
		//$this->categoryName=$category?$category:"users";
		$this->createBasicObject();		parent::__construct();

	}

	
	/**
	*Enter description here ...
	*@var User
	**/
	var		$obj;
	function updateSession($obj=null){
		if(!$obj){
			$obj=$this->basicObject;
		}
		$_SESSION['user']['obj']=$obj->convertToDB();
	}
	
	function getObjectByName($name){
		$name=strtolower($name);
		$this->setCondition("name='$name'");
		return $this->getOneObjectsByCondition();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//pandog
	//function for set cookies 1 hour
	function setCookies($user, $time= 0) {
	    if(empty($time)) $time = time() + 7776000;
	    setcookie("user", $user, $time, '/', $_SERVER['HTTP_HOST']);
	}
	
	//function for checking cookies
	function checkCookies() {
	    $flag = VSFactory::getUsers()->obj->getId();
	    if(empty($flag)) {
    	    if(isset($_COOKIE)) {
    	        if(isset($_COOKIE['user'])) {
    	            $obj = $this->getObjectById($_COOKIE['user']);
    	            if($obj->getId()) {
        	            VSFactory::getUsers()->basicObject = $obj;
        	            VSFactory::getUsers()->updateSession();
        	            VSFactory::getUsers()->obj = VSFactory::getUsers()->basicObject;
    	            }
    	        }
    	    }
	    }
	}
	//pandog
}
