<?php
require_once (CORE_PATH . 'faqs/faqs.php');
class faqs_controler_public extends VSControl_public {

	public function auto_run() {
		global $bw;
		switch ($bw->input ['action']) {
			case $this->modelName . '_detail' :
				$this->showDetail ( $bw->input [2] );
				break;
			
			case $this->modelName . '_form' :
				$this->showForm ( $bw->input [2] );
				break;
			case $this->modelName . '_send' :
				$this->showSend ();
				break;
			case $this->modelName . '_search' :
				$this->showSearch ();
				break;
			default :
				$this->showDefault ();
				break;
		}
	}

	public function __construct($modelName) {
		global $vsTemplate, $bw;
		// $this->html=$vsTemplate->load_template("skin_faq");
		parent::__construct ( $modelName, "skin_faqs", "faq", $bw->input [0] );
		
		// $this->model->categoryName=$bw->input[0];
	}

	function showDefault($option = array()) {
		global $bw, $vsTemplate, $DB, $vsPrint;
		
		$category = VSFactory::getMenus ()->getCategoryGroup ( 'faqs' );
		if (! $category) {
			$vsPrint->boink_it ( $bw->base_url );
		}
		$ids = VSFactory::getMenus ()->getChildrenIdInTree ( $category );
		$this->model->setCondition ( "status>0 and catId in ($ids)" );
		$this->model->setOrder ( "`index`,id desc" );
		$tmp = $this->model->getPageList ( $bw->input [0], 1, VSFactory::getSettings ()->getSystemKey ( $bw->input [0] . '_paging_limit', 12 ) );
		$option = array_merge ( $tmp, $option );
		
		$option ['breakcrum'] = $this->createBreakCrum ( null );
		$option ['title'] = VSFactory::getLangs ()->getWords ( $bw->input [0] );
		$vsPrint->mainTitle = $vsPrint->pageTitle = $option ['title'];
		$option ['cate'] = $category->getChildren ();
		
		return $this->output = $this->getHtml ()->showDefault ( $option );
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
		$option['other']=$this->model->getOtherList($obj);
		$option['cate'] = $category->getChildren();
		$option['cate_obj']=VSFactory::getMenus()->getCategoryById($obj->getCatId());
		$obj->createSeo();
		$this->showQuestion($option);
		
		$this->output = $this->getHtml()->showDetail($obj,$option);
	}
	
	function showForm() {
		global $vsPrint,$bw;
		
		$option ['title'] = VSFactory::getLangs ()->getWords ( $bw->input [0] );
		$vsPrint->mainTitle = $vsPrint->pageTitle = $option ['title'] . "-Gửi câu hỏi";
		$this->output = $this->html->loadForm($option);
	}

	function showSend() {
		global $bw, $vsTemplate, $vsPrint, $vsStd;
		
		require_once ROOT_PATH . 'vscaptcha/VsCaptcha.php';
		$vscaptcha = new VsCaptcha ();
		
		if (!$vscaptcha->check ( $bw->input ['security'] )) {
			echo 'Mã bảo vệ không đúng!';
			$vsPrint->_finish();
		}
		
		if($vsStd->isPhone($bw->input['phone'])==false){
			echo 'Số điện thoại không chính xác!';
			$vsPrint->_finish();
		}
		
		$category = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] );
		
		$this->model->basicObject->convertToObject($bw->input);
		$this->model->basicObject->setCatId ( $category->getId() );
		$this->model->basicObject->setStatus ( 0 );
		$this->model->basicObject->setPostDate(time());
		
		$this->model->insertObject ($this->model->basicObject);
		
		$message = "<strong>Họ tên:</strong> {$bw->input ['name']}<br />
	   	<strong>Email:</strong> {$bw->input ['email']} <br /><strong>Điện thoại:</strong> {$bw->input ['phone']} <br />";
		$message .= "<br /><strong>Câu hỏi:</strong> {$bw->input ['content']}<br /><br />";
		
		$vsStd->requireFile ( LIBS_PATH . "Email.class.php", true );
		$this->email = new Emailer ();
		$this->email->setTo ( VSFactory::getSettings ()->getSystemKey ( "email_receive_support", "support@myphamthanhthuy.vn", "configs" ) );
		
		$this->email->setFrom ( VSFactory::getSettings ()->getSystemKey ( "email_sender", "customer@vstatic.net", "configs" ), $bw->vars ['global_websitename'] );
		$this->email->setSubject ( $bw->input ['faq_content'] );
		$this->email->setBody ( $this->html->showEmail ( $message ) );
		$this->email->sendMail ();
		
		echo 'ok';
		$vsPrint->_finish();
	}

	function getHtml() {
		return $this->html;
	}

	function setHtml($html) {
		$this->html = $html;
	}
	
	/**
	 *
	 * @var faqs
	 *
	 */
	var $model;
	
	/**
	 *
	 * @var skin_faqs
	 *
	 */
	var $html;
}
