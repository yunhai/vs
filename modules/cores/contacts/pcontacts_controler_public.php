<?php
require_once CORE_PATH.'contacts/pcontacts.php';
class pcontacts_controler_public extends VSControl_public {
	function __construct($modelName){
		global $vsTemplate,$bw,$vsPrint;
		parent::__construct($modelName,"skin_pcontacts","pcontact",$bw->input[0]);
		$vsPrint->addExternalJavaScriptFile("http://maps.google.com/maps/api/js?sensor=true&language=vi",1);
	}
	
	
	function auto_run() {
	    global $bw;
	
	    switch ($bw->input ['action']) {
	    	case $this->modelName . '_detail' :
	    	    $this->showDetail ( $bw->input [2] );
	    	    break;
	    	case $this->modelName . '_review' :
	    	    $this->showReview ( $bw->input [2] );
	    	    break;
	    	case $this->modelName . '_search' :
	    	    $this->showSearch ();
	    	    break;
	    	    
    	    case $this->modelName . '_category' :
	    	default :
	    	    $this->showDefault ($bw->input [2] );
	    	    break;
	    }
	}
	/*
	 * Show default action 
	 */
	function showDefault($catId = ''){
		global $bw,$vsTemplate,$vsStd,$vsPrint;
		
		$category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		if(!$ids){
			return $this->output=VSFactory::getLangs()->getWords('not_count_item');
		}
		
		$option['cate'] = $category->getChildren();
		if(empty($catId)) {
    		reset($option['cate']);
    	    $tmp = current($option['cate']);
    	
    	    $idcate = $tmp->getId();
		} else {
		    $idcate = $this->getIdFromUrl($catId);
		}
		
		$category = VSFactory::getMenus()->getCategoryById($idcate);
		if(!$category){
		    $vsPrint->boink_it($bw->base_url);
		}
		
		$this->model->setCondition("status=1 and code='contact'");
		$this->model->setOrder("`index`");
		$obj=$this->model->getOneObjectsByCondition();
		
		if(!$obj){
			return $this->output=VSFactory::getLangs()->getWords('not_count_item');
		}
		
		$option[$idcate] = $obj;
		$option['category'] = $category;
		
		require_once CORE_PATH.'contacts/contacts.php';
		$contacts = new contacts();
		
		if(isset($_POST['btnSubmit'])){
			$vsStd->requireFile ( ROOT_PATH . "vscaptcha/VsCaptcha.php" );
			if($_FILES['file']['size']){
				$files=new files();
				$id=$files->copyFile($_FILES['file']['tmp_name'],"contacts",$_FILES['file']['name']);
				$contacts->basicObject->setImage($id);
			}
			
			$prefix = "{$category->getTitle()} | ";
		   	$contacts->basicObject->setTitle($prefix.$bw->input['pcontacts']['title']);
		   	$contacts->basicObject->setName($bw->input['pcontacts']['name']);
		   	$contacts->basicObject->setPhone($bw->input['pcontacts']['phone']);
		   	$contacts->basicObject->setAddress($bw->input['pcontacts']['address']);
		   	$contacts->basicObject->setEmail($bw->input['pcontacts']['email']);
		   	$contacts->basicObject->setContent($bw->input['pcontacts']['content']);
		   	$contacts->basicObject->getName($bw->input['pcontacts']['content']);
		 
		   	$image = new VsCaptcha ();
		   	return $this->sendContactSuccess ($obj, $option);
		  	if ( $image->check ( $bw->input['pcontacts']['sec_code'])) {
		    	$contacts->insertObject();
		    	$vsStd->requireFile ( LIBS_PATH . "Email.class.php", true );
		    	$this->email = new Emailer();
				$this->email->setTo(VSFactory::getSettings()->getSystemKey("global_systememail", "hieuloc@vietsol.net", "configs"));
				
				$this->email->setFrom($bw->input['pcontacts']['email']);
				//$this->email->setSubject(VSFactory::getSettings()->getSystemKey("global_websitename", "www.vietsol.net", "global", 0));
				
				$this->email->setSubject($contacts->basicObject->getTitle());
				$this->email->setBody($contacts->basicObject->getContent());
				$this->email->sendMail();
		    	return $this->sendContactSuccess ($contacts->basicObject, $option);
		   	}
		   	
			if($_POST['return']){
	    		$vsPrint->boink_it($bw->base_url.$_POST['return']."?error=".VSFactory::getLangs()->getWords('captcha_not_match')."!");
	    		return;
		    }
		    
		    $contacts->basicObject->setTitle($bw->input['pcontacts']['title']);
		   	$option['error']= VSFactory::getLangs()->getWords('captcha_not_match', 'Mã xác nhận không chính xác')."!";
		}
		
		$option['obj'] = $contacts->basicObject;
		
		
		
        return $this->output = $this->getHtml()->showDefault($obj, $option);
	}
	
	function sendContactSuccess($obj, $option) {
		return $this->output = $this->getHtml()->sendContactSuccess($obj, $option);
	}
	
	/**
	 * 
	 * @var pcontacts
	 */
	protected $model;
	
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
	 * @var skin_pcontacts
	 */
	public $html;
}

?>