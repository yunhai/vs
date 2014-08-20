<?php
require_once CORE_PATH.'contacts/pcontacts.php';
class pcontacts_controler_public extends VSControl_public {
	function __construct($modelName){
		global $vsTemplate,$bw,$vsPrint;
//		$this->html=$vsTemplate->load_template("skin_product");
		parent::__construct($modelName,"skin_pcontacts","pcontact",$bw->input[0]);
		//$this->model->categoryName=$bw->input[0];
		$vsPrint->addExternalJavaScriptFile("http://maps.google.com/maps/api/js?sensor=true&language=vi",1);
	}
	
	/*
	 * Show default action 
	 */
	function showDefault(){
		global $bw,$vsTemplate,$vsStd,$vsPrint;
		$category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		if(!$ids){
			return $this->output=VSFactory::getLangs()->getWords('not_count_item');
		}
		
		$this->model->setCondition("status=1 and catId in ($ids)");
		$this->model->setOrder("`index`");
		$obj=$this->model->getOneObjectsByCondition();
		require_once CORE_PATH.'contacts/contacts.php';
		$contacts=new contacts();
		if(!$obj){
			return $this->output=VSFactory::getLangs()->getWords('not_count_item');
		}
//		$option['hot']=$this->model->getHotpcontact(VSFactory::getSettings()->getSystemKey('hot_pcontact_limit',4));
		if(isset($_POST['btnSubmit'])){
			$vsStd->requireFile ( ROOT_PATH . "vscaptcha/VsCaptcha.php" );
			if($_FILES['file']['size']){
				$files=new files();
				$id=$files->copyFile($_FILES['file']['tmp_name'],"contacts",$_FILES['file']['name']);
				$contacts->basicObject->setImage($id);
			}
			if($bw->input['prefix']) $bw->input['prefix']=$bw->input['prefix'].":";
		   	$contacts->basicObject->setTitle($bw->input['prefix'].$bw->input['title']);
		   	$contacts->basicObject->setName($bw->input['name']);
		   	$contacts->basicObject->setPhone($bw->input['phone']);
		   	$contacts->basicObject->setAddress($bw->input['address']);
		   	$contacts->basicObject->setEmail($bw->input['email']);
		   	$contacts->basicObject->setContent($bw->input['content']);
		  	$contacts->basicObject->setCompany($bw->input['company']);
		 
		   	$image = new VsCaptcha ();
//		   	echo "<pre>";
//		   	print_r($_SESSION);
//		   	print_r($bw->input['sec_code']);
//		   	echo "<pre>";
//		   	echo $image->check ( $bw->input['sec_code']);
//		   	exit;
			
		  	if ( $image->check ( $bw->input['sec_code'])) {
		    	$contacts->insertObject();
		    	$vsStd->requireFile ( LIBS_PATH . "Email.class.php", true );
		    	$this->email = new Emailer();
				$this->email->setTo(VSFactory::getSettings()->getSystemKey("email_receive", "hieuloc@vietsol.net", "configs"));
				
				$this->email->setFrom(VSFactory::getSettings()->getSystemKey("email_sender", "hieuloc@vietsol.net", "configs"));
				$this->email->setSubject(VSFactory::getSettings()->getSystemKey("global_websitename", "www.vietsol.net", "global", 0));
				
//				$parser = VSFactory::getPostParser();
//				$parser->pp_do_html = 1;
//				$parser->pp_nl2br = 0;
//				$body =  $parser->post_db_parse($bw->input['contacts']['contactContent']);
				$this->email->setSubject($contacts->basicObject->getTitle());
				$this->email->setBody($contacts->basicObject->getContent());
				$this->email->sendMail();
		    	return $this->sendContactSuccess ($contacts->basicObject,$option);
		   	}
			if($_POST['return']){
		    		$vsPrint->boink_it($bw->base_url.$_POST['return']."?error=".VSFactory::getLangs()->getWords('captcha_not_match')."!");
		    		return;
		    }
		   	$option['error']= VSFactory::getLangs()->getWords('captcha_not_match')."!";
		   	
		   	
		}
		$option['obj']=$contacts->basicObject;
		$option['breakcrum']=$this->createBreakCrum(null);
        return $this->output = $this->getHtml()->showDefault($obj,$option);
	}
	function sendContactSuccess($obj,$option){
		$option['breakcrum']=$this->createBreakCrum(null);
		return $this->output = $this->getHtml()->sendContactSuccess($obj,$option);
	}
///*
//	 * Show default action 
//	 */
//	function showCategory($id){
//		global $bw,$vsTemplate,$vsPrint;
//		$category=VSFactory::getMenus()->getCategoryById($this->getIdFromUrl($id));
//		if(!$category){
//			$vsPrint->boink_it($bw->base_url);
//		}
//		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
//		$this->model->setCondition("status=1 and catId in ($ids)");
//		$this->model->setOrder("`order`");
//		$option=$this->model->getPageList("contacts/category/",2,VSFactory::getSettings()->getSystemKey('pcontact_paging_limit',6));
//		$option['hot']=$this->model->getHotpcontact(VSFactory::getSettings()->getSystemKey('hot_pcontact_limit',4));
//		$option['breakcrum']=$this->createBreakCrum($category);
//		$option['obj']=$category;
//        return $this->output = $this->getHtml()->showDefault($option);
//	}
//	/*
//	 * Show detail action 
//	 */
//	function showDetail($objId){
//		global $vsPrint, $bw,$vsTemplate;       
//		$obj=$this->model->getObjectById($this->getIdFromUrl($objId));
//		if(!is_object($obj)){
//			$vsPrint->boink_it($bw->base_url);
//		}       
//		$option['other']=$this->model->getOtherpcontact($obj);
//		$option['breakcrum']=$this->createBreakCrum($obj);
//    	$this->output = $this->getHtml()->showDetail($obj,$option);
//	}
	
//	/*
//	 * Show category action 
//	 */
//	function showCategory($catId){
//		global $bw;
//		return $this->output = $this->getHtml()->showDefault($option);
//	}
	
	
	
	/**
	 * 
	 * @var pcontacts
	 */
	protected $model;
	
	
    function getListLangObject(){
         	
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
	 * @var skin_pcontacts
	 */
	public $html;
}

?>