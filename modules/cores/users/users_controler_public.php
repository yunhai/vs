<?php
require_once(CORE_PATH.'users/users.php');

class users_controler_public extends VSControl_public {
	function __construct($modelName){
		global $vsTemplate,$bw,$vsPrint,$vsSkin;
//		if(file_exists(ROOT_PATH.$vsSkin->basicObject->getFolder()."/skin_".$bw->input[0].".php")){
//			parent::__construct($modelName,"skin_".$bw->input[0],"page",$bw->input[0]);;
//		}else{
		parent::__construct($modelName,"skin_users","user");
//		}
		//$this->model->categoryName=$bw->input[0];
		//$vsPrint->addExternalJavaScriptFile("http://maps.google.com/maps/api/js?sensor=true&language=vi",1);
	}
	public	function auto_run(){
	
	global $bw;
				switch ($bw->input['action']) {
			case $this->modelName.'_registry':
				$this->registry($bw->input[2]);
				break;
			case $this->modelName.'_do_registry':
				$this->doRregistry();
				break;
			case $this->modelName.'_do_login':
				$this->doLogin();
				break;
			case $this->modelName.'_do_logout':
				$this->doLogOut();
				break;
			case $this->modelName.'_forgot_password':
				$this->forgotPassword();
				break;
			case $this->modelName.'_do_forgot_password':
				$this->doForgotPassword();
				break;
			case $this->modelName.'_chang_password':
				$this->changePassword();
				break;
			case $this->modelName.'_do_chang_password':
				$this->doChangePassword();
				break;
			case $this->modelName.'_chang_info':
				$this->changeInfo();
				break;
			case $this->modelName.'_do_chang_info':
				$this->doChangeInfo();
				break;
			case $this->modelName.'_submit_video':
				$this->submitVideo();
				break;
			case $this->modelName.'_do_submit_video':
				$this->doSubmitVideo();
				break;
			case $this->modelName.'_reg_list':
				$this->showRegList();
				break;
			case $this->modelName.'_approve_list':
				$this->showApproveList();
				break;
			case $this->modelName.'_view_info':
				$this->showViewInfo();
				break;
			case $this->modelName.'_comment':
				$this->userComment();
				break;
			default:
				parent::auto_run();
				break;
		}

	}


	function registry($option=array()){
		return $this->output= $this->html->registry($option);
	}
	function doRregistry(){
		global $bw,$vsPrint;
		
		require_once ROOT_PATH.'vscaptcha/VsCaptcha.php';
		$vscaptcha=new VsCaptcha();
		if($vscaptcha->check($bw->input['security'])){
			if(($bw->input['password']!=$bw->input['password_confirm'])||!$bw->input['password']){
				$option['message']= VSFactory::getLangs()->getWords('password_not_available','Mật khẩu không hợp lệ');
				return $this->output= $this->registry($option);
			}
			if(strlen($bw->input['name'])<4){
				$option['message']= VSFactory::getLangs()->getWords('name_not_available','Tên đăng nhập quá ngắn');
				return $this->output= $this->registry($option);
			}
			$this->model->setCondition("`name`='".strtolower($bw->input['name'])."'");
			$this->model->getOneObjectsByCondition();
			if($this->model->basicObject->getId()){
				$option['message']= VSFactory::getLangs()->getWords('username_exist','Tên đăng nhập đã tồn tại');
				return $this->output= $this->registry($option);
			}
//			if(!preg_match('/[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/iu', $bw->input['email'])){
//				return $this->output= $this->registry(VSFactory::getLangs()->getWords('email_not_available','Email không hợp lệ'));
//			}
			if($_FILES['image']['size']){
				$files=new files();
				if($id=$files->copyFile($_FILES['image']['tmp_name'], "users",$_FILES['image']['name'])){
					$bw->input['image']=$id;
				}
				
			}
			
			$bw->input['name']=strtolower($bw->input['name']);
			$bw->input['email']=strtolower($bw->input['email']);
			$this->model->basicObject->convertToObject($bw->input);
			$this->model->basicObject->setPassword(md5($bw->input['password']));
			$this->model->basicObject->setStatus(null);
//			$this->model->basicObject->setMinutes();
			$time=time()+($bw->vars['TimeZone']?$bw->vars['TimeZone']:7)*3600;;
			$this->model->basicObject->setMinutes(date("i",$time));
			$this->model->basicObject->setHour(date("h",$time));
			$this->model->basicObject->setDay(date("d",$time));
			$this->model->basicObject->setMonth(date("m",$time));
			$this->model->basicObject->setYear(date("yyyy",$time));
			
			$this->model->insertObject();
			$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('registry_successfully','Đăng ký thành công'),'/');
			///đi đâu???
			
		}else{
			$option['message']=VSFactory::getLangs()->getWords('captcha_not_match','Mã bảo mật không đúng');
			return $this->output= $this->registry($option);
		}
		
	}
	function forgotPassword($message=""){
		return $this->output= $this->html->forgotPassword($option);
	}
	function doForgotPassword($message=""){
		global $bw;
		$this->model->setCondition("name='".strtolower($bw->input['name'])."' and email='".(strtolower($bw->input['email']))."'");
		$result=$this->model->getObjectsByCondition();
//		echo "<pre>";
//		print_r(VSFactory::createConnectionDB()->obj);
//		echo "<pre>";
//		exit;

		require_once ROOT_PATH.'vscaptcha/VsCaptcha.php';
		$vscaptcha=new VsCaptcha();
		if(!$vscaptcha->check($bw->input['security'])){
			$option['message']=VSFactory::getLangs()->getWords('captcha_not_match','Mã bảo mật không đúng');
			return $this->output=$this->html->forgotPassword($option);
		}
		if(!count($result)){
			$option['message']=VSFactory::getLangs()->getWords('user_email_not_exist','Tên đăng nhập hoặc email không đúng');
			return $this->output=$this->html->forgotPassword($option);
		}
		$result=current($result);
		$email=VSFactory::getEmailer();
		$option['token']=md5(time().$result->getName());
		$email->setBody($this->html->doSendPasswordForm($result,$option));
		$email->setFrom(VSFactory::getSettings()->getSystemKey('global_systememail'),
		VSFactory::getSettings()->getSystemKey('global_websitename'));
		$email->setTo($result->getEmail());
		$email->setSubject(VSFactory::getLangs()->getWords('forgot_password_info','Thông tin mật khẩu'));
		
//		echo "<pre>";
//		print_r($this->html->doSendPasswordForm($result,$option));
//		echo "<pre>";
//		exit;
		
		
		$email->sendMail();
		$option['message']=VSFactory::getLangs()->getWords('forgot_passwd_message','Hệ thống đã gửi mật khẩu vào tài khoản email của bạn vui lòng kiểm tra email');
		return $this->output= $this->html->doForgotPassword($option);
	}
	function submitVideo(){
		global $vsPrint;
		if(!VSFactory::getUsers()->basicObject->getId()){
			$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('not_login','Bạn chưa đăng  nhập'),'users/do_login');
		}
		return $this->output= $this->html->submitVideo($option);
	}
	function changePassword(){
		global $vsPrint;
		if(!VSFactory::getUsers()->basicObject->getId()){
			$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('not_login','Bạn chưa đăng  nhập'),'users/do_login');
		}
		return $this->output= $this->html->changePassword($option);
	}
	function doChangePassword(){
		global $vsPrint,$bw;
		if(!VSFactory::getUsers()->basicObject->getId()){
			$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('not_login','Bạn chưa đăng  nhập'),'users/do_login');
		}
//		echo "<pre>";
//		print_r(VSFactory::getUsers()->basicObject);
//		print_r($bw->input['oldpassword']);
//		echo "<pre>";
//		exit;
		if(md5($bw->input['oldpassword'])!=VSFactory::getUsers()->basicObject->getPassword() ){
			$option['message']="Mật khẩu cũ không đúng";
			return $this->output= $this->html->changePassword($option);
		}
		if($bw->input['password']!=$bw->input['passwordconfirm']){
			$option['message']="Mật khẩu mới không khớp";
			return $this->output= $this->html->changePassword($option);
		}
		VSFactory::getUsers()->basicObject->setPassword(md5($bw->input['password']));
		VSFactory::getUsers()->updateObject();
		$option['message']="Đã đổi mật khẩu";
		return $this->output= $this->html->doChangePassword($option);
	}
	function changeInfo(){
		global $vsPrint;
		if(!VSFactory::getUsers()->basicObject->getId()){
			$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('not_login','Bạn chưa đăng  nhập'),'users/do_login');
		}
		$option['location']=VSFactory::getMenus()->getCategoryGroup("location")->getChildren();
		$option['obj']=VSFactory::getUsers()->basicObject;
		return $this->output= $this->html->changeInfo($option);
	}
	function doChangeInfo(){
		global $vsPrint;
		global $bw;
		if(!VSFactory::getUsers()->basicObject->getId()){
			$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('not_login','Bạn chưa đăng  nhập'),'users/do_login');
		}
		
//			if(strlen($bw->input['name'])<4){
//				$option['message']="T";
//				return $this->changeInfo($option);
//			}
			
//			if(!preg_match('/[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/iu', $bw->input['email'])){
//				return $this->output= $this->registry(VSFactory::getLangs()->getWords('email_not_available','Email không hợp lệ'));
//			}
			if($_FILES['image']['size']){
				$files=new files();
				if($id=$files->copyFile($_FILES['image']['tmp_name'], "users",$_FILES['image']['name'])){
					$bw->input['image']=$id;
//					echo "<pre>";
//					print_r($files);
//					echo "<pre>";
//					exit;
				}
			}
			$bw->input['name']=null;
			$bw->input['email']=strtolower($bw->input['email']);
			VSFactory::getUsers()->basicObject->convertToObject($bw->input);
			VSFactory::getUsers()->basicObject->setPassword(null);
			VSFactory::getUsers()->basicObject->setLocation(null);
			VSFactory::getUsers()->basicObject->setStatus(null);
//			$this->model->basicObject->setMinutes();
//			$time=time()+($bw->vars['TimeZone']?$bw->vars['TimeZone']:7)*3600;;
//			$this->model->basicObject->setMinutes(date("i",$time));
//			$this->model->basicObject->setHour(date("h",$time));
//			$this->model->basicObject->setDay(date("d",$time));
//			$this->model->basicObject->setMonth(date("m",$time));
//			$this->model->basicObject->setYear(date("yyyy",$time));
//			echo "<pre>";
//			print_r(VSFactory::getUsers()->basicObject);
//			echo "<pre>";
//			exit;
			VSFactory::getUsers()->updateObject();
			$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('chang_info_successfully','Thay đổi thông tin thành công'),'/');
		
		
		return $this->output= $this->html->changePassword($option);
	}
	function doSubmitVideo(){
		global $bw,$vsPrint;
		if(!VSFactory::getUsers()->basicObject->getId()){
			$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('not_login','Bạn chưa đăng  nhập'),'users/do_login');
		}
		require_once ROOT_PATH.'vscaptcha/VsCaptcha.php';
		$vscaptcha=new VsCaptcha();
		if(!$vscaptcha->check($bw->input['security'])){
			$option['message']=VSFactory::getLangs()->getWords('captcha_not_match','Mã bảo mật không đúng');
			return $this->output=$this->html->submitVideo($option);
		}
		if($_POST['ytubeLink']){
			require_once UTILS_PATH.'youtube_parser.php';
			$youtube_parser=new youtube_parser();
			if(!$ylink=$youtube_parser->parse($_POST['ytubeLink'])){
				$option['message']=VSFactory::getLangs()->getWords('you_tube_link_not_available','Link youtube không hợp lệ');
				return $this->output=$this->html->submitVideo($option);
			}
			$bw->input['ytubeLink']="http://www.youtube.com/embed/$ylink";
			
		}
		if(!$bw->input['title']){
			$option['message']=VSFactory::getLangs()->getWords('video_title_not_null','Tiêu đề không được bỏ trống');
			return $this->output=$this->html->submitVideo($option);
		}
//		echo "<pre>";
//		print_r($_FILES['upload_video']);
//		echo "<pre>";
//		exit;
		$ok=false;
		if($_FILES['upload_video']['name']&&!$_FILES['upload_video']['error']){
			$files=new files();
			if(!$bw->input['fileId']=$files->copyFile($_FILES['upload_video']['tmp_name'],'videos',$_FILES['upload_video']['name'])){
				$option['message']=VSFactory::getLangs()->getWords('video_cant_upload','Không thể upload files, lỗi hệ thống, vui lòng kiểm tra lại:').$files->message;
				
				return $this->output=$this->html->submitVideo($option);
			}
			$ok=true;
		}
		if($bw->input['ytubeLink']){
			//parse url youtube here
			
			$ok=true;
			
		}
		if(!$ok){
			$option['message']=VSFactory::getLangs()->getWords('no_video_upload','Không có video nào được gửi lên');
			return $this->output=$this->html->submitVideo($option);
		}
		require_once CORE_PATH.'users/videos.php';
		$videos=new videos();
		$videos->basicObject->setUsername(VSFactory::getUsers()->basicObject->getName());
		$videos->basicObject->convertToObject($bw->input);
//		$videos->basicObject->setStatus(0);
		$videos->basicObject->setStatus(1);
		$videos->basicObject->setType(1);
		$videos->insertObject();
		$option['message']=VSFactory::getLangs()->getWords('video_upload_successfully','Đã gửi video thành công, bạn vui lòng đợi chúng tôi xét duyệt');
		return $this->output= $this->html->doSubmitVideo($option);
	}
	function doLogin(){
		global $bw,$vsPrint;
		$this->model->setCondition("name='".strtolower($bw->input['name'])."' and password='".md5(strtolower($bw->input['password']))."'");
		$result=$this->model->getObjectsByCondition();
		if(!count($result)){
			$option['message']=VSFactory::getLangs()->getWords('user_password_not_exist','Tên đăng nhập hoặc mật khẩu không tồn tại');
			return $this->output=$this->html->loginForm($option);
		}
		$result=current($result);
		VSFactory::getUsers()->basicObject=$result;
		VSFactory::getUsers()->updateSession();
//		echo "<pre>";
//		print_r($_SERVER['HTTP_REFERER']);
//		echo "<pre>";
//		exit;
	$back=str_replace($bw->base_url, "", $_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:"") ;
		$vsPrint->redirect_screen("Bạn đã đăng nhập thành công",$back);
		
	}
	function doLogOut(){
		global $bw,$vsPrint;
		unset($_SESSION['user']);
		$back=str_replace($bw->base_url, "", $_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:"") ;
		$vsPrint->redirect_screen("Bạn đã thoát khỏi hệ thống",$back);
		
	}
	function showRegList(){
		global $bw,$vsPrint;
		$option['location']=VSFactory::getMenus()->getCategoryById($bw->input[2]);
		if(!$option['location']) $option['location']=new Menu();
		if($option['location']->getId()){
			$ids=VSFactory::getMenus()->getChildrenIdInTree($option['location']->getId());
			$this->model->setCondition("`status`=1 and location in ($ids)");
		}else{
			$this->model->setCondition("`status`=1");
		}
		$this->model->setOrder('`index`');
		$option=array_merge($option, $this->model->getPageList("users/reg_list/{$bw->input[2]}/",3,VSFactory::getSettings()->getSystemKey('limit_users_home',12)));
		foreach ($option['pageList'] as $u) {
			$u->location=VSFactory::getMenus()->getCategoryById($u->getLocation());
			if(!$u->location) $u->location=new Menu();
		}
		return $this->output=$this->html->showRegList($option);
		
	}
	function showApproveList(){
		global $bw,$vsPrint;
		$option['location']=VSFactory::getMenus()->getCategoryById($bw->input[2]);
		if(!$option['location']) $option['location']=new Menu();
		if($option['location']->getId()){
				$ids=VSFactory::getMenus()->getChildrenIdInTree($option['location']->getId());
			$this->model->setCondition("`status`=2 and location in ($ids)");
		}else{
			$this->model->setCondition("`status`=2");
		}
		$this->model->setOrder('`index`');
		$option=array_merge($option,$this->model->getPageList("users/approve_list/{$bw->input[2]}/",3,VSFactory::getSettings()->getSystemKey('limit_users_home',12)));
		
		foreach ($option['pageList'] as $u) {
			$u->location=VSFactory::getMenus()->getCategoryById($u->getLocation());
			if(!$u->location) $u->location=new Menu();
		}
		return $this->output=$this->html->showApproveList($option);
	}
	function showViewInfo(){
		global $bw,$vsPrint;
		$this->model->getObjectById($this->getIdFromUrl( $bw->input[2]));
		require_once CORE_PATH.'users/videos.php';
		$option['video']=new Video();
		if(!$this->model->basicObject->getId()){
			$vsPrint->boink_it($bw->base_url);
		}
		$videos=new videos();
		$videos->setCondition("username='{$this->model->basicObject->getName()}' and status>0");
		$videos->setOrder('`index`,`id` DESC');
		$tmp=$videos->getOneObjectsByCondition();
		if($tmp){
			$option['video']=$tmp;
		}
		require_once CORE_PATH.'comments/comments.php';
		$comments=new comments();
		$comments->setCondition("userId='{$this->model->basicObject->getId()}' and status>0");
		$coption=$comments->getPageList("users/comment/{$bw->input[2]}/",3,VSFactory::getSettings()->getSystemKey('limit_of_comment',10),1,"comment_panel");
		$option['comment']=str_replace(array("page_prev.jpg","page_next.jpg"), array("binhluan_prev.jpg","binhluan_next.jpg"), $this->html->userComment($coption));
		$option['other']=array();
		$ids=VSFactory::getMenus()->getChildrenIdInTree($this->model->basicObject->getLocation());
		if($ids){
		$users=new users();
			$users->setCondition("location in ($ids) and `id`!='{$this->model->basicObject->getId()}'");
			$option['other']=$users->getObjectsByCondition();
		}
		return $this->output=$this->html->viewInfo($this->model->basicObject,$option);
	}
	function userComment(){
		global $bw,$vsPrint;
		require_once CORE_PATH.'comments/comments.php';
		$this->model->getObjectById($this->getIdFromUrl( $bw->input[2]));
		$comments=new comments();
		$comments->setCondition("userId='{$this->model->basicObject->getId()}' and status>0");
		$option=$comments->getPageList("users/comment/{$bw->input[2]}/",3,VSFactory::getSettings()->getSystemKey('limit_of_comment',10),1,"comment_panel");
		return $this->output=str_replace(array("page_prev.jpg","page_next.jpg"), array("binhluan_prev.jpg","binhluan_next.jpg"), $this->html->userComment($option));
	}
	function getHtml(){
		return $this->html;
	}



	function setHtml($html){
		$this->html=$html;
	}



	
	/**
	*
	*@var users
	**/
	var		$model;

	
	/**
	*
	*@var skin_users
	**/
	var		$html;
}
