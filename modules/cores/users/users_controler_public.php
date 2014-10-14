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
				$this->doRegistry();
				break;
			case $this->modelName.'_do_login':
				$this->doLogin();
				break;
			case $this->modelName.'_logout':
				$this->doLogOut();
				break;
			case $this->modelName.'_forgot_password':
				$this->forgotPassword();
				break;
			case $this->modelName.'_do_forgot_password':
				$this->doForgotPassword();
				break;
			case $this->modelName.'_change_password':
				$this->changePassword();
				break;
			case $this->modelName.'_do_change_password':
				$this->doChangePassword();
				break;
			case $this->modelName.'_update':
				$this->changeInfo();
				break;
			case $this->modelName.'_do_update':
				$this->doChangeInfo();
				break;
			case $this->modelName.'_renew_password':
				    $this->renewPassword();
				    break;
    	    case $this->modelName.'_do_renew_password':
    	        $this->doRenewPassword();
    	        break;
			default:
				parent::auto_run();
				break;
		}

	}

	function renewPassword() {
	    global $bw;
	    
	    $obj = $this->model->getObjectById($bw->input[2]);
	    
	    if(md5($obj->getName()) != $bw->input[3]) {
	        $option['error'] = VSFactory::getLangs()->getWords('link_invalid','Đường dẫn không chính xác');
	    }
	    
	    $category = VSFactory::getMenus()->getCategoryGroup('posts');
	    $option['cate'] = $category->getChildren();
	    $current = current($option['cate']);
	    $option['category'] = $current;
	    $option[$current->getId()] = true;
	    
	    $option['user'] = $obj;
	    
	    return $this->output = $this->html->renewPassword($option);
	}
	
	function doRenewPassword(){
	    global $bw, $vsPrint;
	    
	    $category = VSFactory::getMenus()->getCategoryGroup('posts');
	    $option['cate'] = $category->getChildren();
	    $current = current($option['cate']);
	    $option['category'] = $current;
	    $option[$current->getId()] = true;
	    
	    if(($bw->input['users']['password']!=$bw->input['users']['password_confirm'])||!$bw->input['users']['password']){
	        $option['error']= VSFactory::getLangs()->getWords('password_not_available', 'Mật khẩu không hợp lệ');
	        return $this->output= $this->html->renewPassword($option);
	    }
	    
	    $model = new users();
	    	
	    $model->setCondition("`name`='".strtolower($bw->input['users']['name'])."'");
	    $model->getOneObjectsByCondition();
	   
	    if(!$model->basicObject->getId()){
	        $option['error']= VSFactory::getLangs()->getWords('username_doesnot_exist','Tên đăng nhập không đã tồn tại');
	        return $this->output= $this->html->renewPassword($option);
	    }
	    	
	    $this->model->basicObject->setId($model->basicObject->getId());
	    $this->model->basicObject->setPassword(md5($bw->input['users']['password']));
	    
	    $flag = $this->model->updateObject();
	    
	    $vsPrint->redirect_screen(VSFactory::getLangs()->getWords('renew_password_successfully', 'Mật khẩu đã được cập nhật'), '');
	}

	function registry($option=array()){
	    $category = VSFactory::getMenus()->getCategoryGroup('posts');
	    $option['cate'] = $category->getChildren();
	    $current = current($option['cate']);
	    $option['category'] = $current;
	    
	    $option[$current->getId()] = true;
	    
		return $this->output= $this->html->registry($option);
	}
	
	function _validateRegistry(&$error = array()) {
	    global $bw, $vsPrint;
		
		require_once ROOT_PATH.'vscaptcha/VsCaptcha.php';
		$vscaptcha=new VsCaptcha();
		
		$target = $bw->input['users'];
		
		$empty = array(
			        'name' => VSFactory::getLangs()->getWords('validate_registry_name_empty', 'Tên đăng nhập không được để trống'),
                    'fullname' => VSFactory::getLangs()->getWords('validate_registry_fullname_empty', 'Tên tiệm không được để trống'),
	                'website'  => VSFactory::getLangs()->getWords('validate_registry_website_empty', 'Website không được để trống'),
	                'address'  => VSFactory::getLangs()->getWords('validate_registry_address_empty', 'Địa chỉ không được để trống'),
	                'city' => VSFactory::getLangs()->getWords('validate_registry_city_empty', 'Thành phố không được để trống'),
	                'location' => VSFactory::getLangs()->getWords('validate_registry_location_empty', 'Tiểu bang không được để trống'), 
	                'zipcode' => VSFactory::getLangs()->getWords('validate_registry_zipcode_empty', 'Zipcode không được để trống'),
	                'email' => VSFactory::getLangs()->getWords('validate_registry_email_empty', 'Email không được để trống'),
		                
		);
		
		foreach( $empty as $key => $message) {
		    if(empty($target[$key])) {
		        $error[] = $message;
		    }
		}
		
		if(($target['password']!=$target['password_confirm'])||!$target['password']){
		    $error[] = VSFactory::getLangs()->getWords('validate_registry_password_not_available', 'Mật khẩu không hợp lệ');
		}
		
		if(strlen($target['name'])<4){
		    $error[] = VSFactory::getLangs()->getWords('validate_registry_name_not_available','Tên đăng nhập quá ngắn');
		}
	
		if(!$vscaptcha->check($target['security']))
		  $error[] = VSFactory::getLangs()->getWords('captcha_not_match', 'Mã bảo mật không đúng');
		
		return empty($error);
	}
	
	function doRegistry(){
		global $bw, $vsPrint;
		
		$error = array();
		if($this->_validateRegistry($error)){
			$model = new users();
			
			$model->setCondition("`name`='".strtolower($bw->input['users']['name'])."' OR email = '".$bw->input['users']['email']."'");
			$model->getOneObjectsByCondition();
			if($model->basicObject->getId()){
				$option['error']= VSFactory::getLangs()->getWords('username_email_exist','Tên đăng nhập hoặc email đã tồn tại');
				return $this->output= $this->registry($option);
			}

			$bw->input['users']['group_code'] = USER_TYPE_NORMAL;
			
			$bw->input['users']['name']=strtolower($bw->input['users']['name']);
			$bw->input['users']['email']=strtolower($bw->input['users']['email']);
			$bw->input['users']['joinDate']=date('Y-m-d H:i:s');
	
			$this->model->basicObject->convertToObject($bw->input['users']);
			$this->model->basicObject->setPassword(md5($bw->input['users']['password']));
			
			$this->model->insertObject();
		
			$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('registry_successfully','Đăng ký thành công'),'');
		} else{
			$option['error'] = $error;
			return $this->output = $this->registry($option);
		}
	}
	
	function forgotPassword($message="") {
	    $category = VSFactory::getMenus()->getCategoryGroup('posts');
	    $option['cate'] = $category->getChildren();
	    $current = current($option['cate']);
	    $option['category'] = $current;
	     
	    $option[$current->getId()] = true;
	    
		return $this->output= $this->html->forgotPassword($option);
	}
	
	function doForgotPassword($message=""){
		global $bw;

		require_once ROOT_PATH.'vscaptcha/VsCaptcha.php';
		$vscaptcha=new VsCaptcha();
		

		$category = VSFactory::getMenus()->getCategoryGroup('posts');
		$option['cate'] = $category->getChildren();
		$current = current($option['cate']);
		$option['category'] = $current;
		$option[$current->getId()] = true;
		
		if(!$vscaptcha->check($bw->input['users']['security'])){
			$option['error']=VSFactory::getLangs()->getWords('captcha_not_match','Mã bảo mật không đúng');
			return $this->output=$this->html->forgotPassword($option);
		}
		
		$this->model->setCondition("1 or name='".strtolower($bw->input['users']['name'])."' and email='".(strtolower($bw->input['users']['email']))."'");
		$result=$this->model->getOneObjectsByCondition();
		
		if(!$result){
			$option['error']=VSFactory::getLangs()->getWords('user_email_not_exist','Tên đăng nhập hoặc email không đúng');
			return $this->output=$this->html->forgotPassword($option);
		}
		
		$email=VSFactory::getEmailer();
		$option['token']=md5($result->getName());
		$email->setBody($this->html->doSendPasswordForm($result,$option));
		$email->setFrom(VSFactory::getSettings()->getSystemKey('global_systememail'),
		VSFactory::getSettings()->getSystemKey('global_websitename'));
		$email->setTo($result->getEmail());
		$email->setSubject(VSFactory::getLangs()->getWords('forgot_password_info','Thông tin mật khẩu'));
		
		$email->sendMail();
	    
		return $this->output= $this->html->doForgotPassword($option);
	}
	
	function changePassword(){
		global $vsPrint;
		if(!VSFactory::getUsers()->basicObject->getId()){
			$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('not_login','Bạn chưa đăng  nhập'),'');
		}
		
		$category = VSFactory::getMenus()->getCategoryGroup('posts');
		$option['cate'] = $category->getChildren();
		$current = current($option['cate']);
		$option['category'] = $current;
		$option[$current->getId()] = true;
		 
		return $this->output= $this->html->changePassword($option);
	}
	
	function doChangePassword(){
		global $vsPrint,$bw;
		if(!VSFactory::getUsers()->basicObject->getId()){
			$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('not_login','Bạn chưa đăng  nhập'),'');
		}
		
		$category = VSFactory::getMenus()->getCategoryGroup('posts');
		$option['cate'] = $category->getChildren();
		$current = current($option['cate']);
		$option['category'] = $current;
		$option[$current->getId()] = true;
		
		if(md5($bw->input['users']['password_old'])!=VSFactory::getUsers()->basicObject->getPassword() ){
			$option['error']="Mật khẩu cũ không đúng";
			return $this->output= $this->html->changePassword($option);
		}
		if($bw->input['users']['password']!=$bw->input['users']['password_confirm']){
			$option['error']="Mật khẩu mới không khớp";
			return $this->output= $this->html->changePassword($option);
		}
		VSFactory::getUsers()->basicObject->setPassword(md5($bw->input['users']['password']));
		VSFactory::getUsers()->updateObject();
		VSFactory::getUsers()->updateSession();
		
		$vsPrint->redirect_screen("Bạn đã cập nhật mật khẩu thành công", '');
	}
	
	function changeInfo($option = array()){
		global $vsPrint;
		
		if(!VSFactory::getUsers()->basicObject->getId()){
			$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('not_login','Bạn chưa đăng nhập'), '');
		}
		
		if(empty($option['obj']))
		  $option['obj'] = VSFactory::getUsers()->basicObject;

		$category = VSFactory::getMenus()->getCategoryGroup('posts');
		$option['cate'] = $category->getChildren();
		$current = current($option['cate']);
		$option['category'] = $current;

		$option[$current->getId()] = true;
		
		return $this->output= $this->html->changeInfo($option);
	}
	
	

	function _validateUpdateInfo(&$error = array()) {
	    global $bw;
	
	    $target = $bw->input['users'];
	
	    $empty = array(
	                    'fullname' => VSFactory::getLangs()->getWords('validate_registry_fullname_empty', 'Tên tiệm không được để trống'),
	                    'website'  => VSFactory::getLangs()->getWords('validate_registry_website_empty', 'Website không được để trống'),
	                    'address'  => VSFactory::getLangs()->getWords('validate_registry_address_empty', 'Địa chỉ không được để trống'),
	                    'city' => VSFactory::getLangs()->getWords('validate_registry_city_empty', 'Thành phố không được để trống'),
	                    'location' => VSFactory::getLangs()->getWords('validate_registry_location_empty', 'Tiểu bang không được để trống'),
	                    'zipcode' => VSFactory::getLangs()->getWords('validate_registry_zipcode_empty', 'Zipcode không được để trống'),
	                    'email' => VSFactory::getLangs()->getWords('validate_registry_email_empty', 'Email không được để trống'),
	
	    );
	
	    foreach( $empty as $key => $message) {
	        if(empty($target[$key])) {
	            $error[] = $message;
	        }
	    }
	
	    return empty($error);
	}
	
	function doChangeInfo(){
		global $bw, $vsPrint;
		if(!VSFactory::getUsers()->basicObject->getId()){
			$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('not_login','Bạn chưa đăng  nhập'),'');
		}
		unset($bw->input['users']['name']);
		
		$error = array();
		if($this->_validateUpdateInfo($error)) {
    		$bw->input['users']['email']=strtolower($bw->input['users']['email']);
    		VSFactory::getUsers()->basicObject->convertToObject($bw->input['users']);
    
    		VSFactory::getUsers()->updateObject();
    		VSFactory::getUsers()->updateSession();
    		$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('chang_info_successfully','Thay đổi thông tin thành công'),'');
		}
		
		$option['obj'] = VSFactory::getUsers()->basicObject->convertToObject($bw->input['users']);
		$option['error'] = $error;
		return $this->output = $this->changeInfo($option);
	}
	
	function doLogin(){
		global $bw, $vsPrint;
	
		$this->model->setCondition("name='".strtolower($bw->input['users']['name'])."' and password='".md5(strtolower($bw->input['users']['password']))."' and `status` = 1");
		$result=$this->model->getObjectsByCondition();
		
		if(!count($result)){
			$option['error']=VSFactory::getLangs()->getWords('user_password_not_exist','Tên đăng nhập hoặc mật khẩu không tồn tại');
			return $vsPrint->redirect_screen("Thông tin đăng nhập không chính xác", '');
		}
		$result=current($result);
		VSFactory::getUsers()->basicObject=$result;
		VSFactory::getUsers()->updateSession();

		VSFactory::getUsers()->obj = VSFactory::getUsers()->basicObject;
		
		if(!empty($bw->input['users']['rememberme'])){
		    echo 1;
    		$this->model->setCookies($this->model->obj->getId());
		} 
		
	    $back=str_replace($bw->base_url, "", $_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']: "");
		$vsPrint->redirect_screen("Bạn đã đăng nhập thành công",$back);
	}
	

	
	
	
	
	function doLogOut(){
		global $bw, $vsPrint;
		
		unset($_SESSION['user']);
		
		//delete cookie
		$season = time() - 7776000;
		$this->model->setCookies($this->model->obj->getId(), $season);
		
		$vsPrint->boink_it($bw->base_url);
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
