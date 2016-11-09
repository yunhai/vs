<?php
class Addon{
	public  $html;
	function __construct() {
		
		global	$vsTemplate;
		$this->html = $vsTemplate->load_template('skin_addon');
		
		if(APPLICATION_TYPE=='user')
			$this->runUserAddOn ();
		else
			$this->runAdminAddOn ();
	}

	function runUserAddOn() {
		global	$vsStd, $vsTemplate, $vsMenu;
		
		$vsTemplate->global_template->menu = $vsMenu->getMenuByPosition('main');
		$vsTemplate->global_template->bottom = $vsMenu->getMenuByPosition('bottom');
		
		$analytic = $this->fmAnalytic();
	
		$vsTemplate->global_template->topmenu = $this->html->getTopMenu($analytic);
        $this->managerPortlet();
	}
	
	function fmAnalytic(){
		global $vsUser;
		
		$userId = $vsUser->obj->getId();
		if($userId){
			$result['friend'] = $this->analytic_connect($userId);
			$result['inbox'] =  $this->analytic_inbox($userId);
		}
		
		return $result;
	}
	
	function analytic_connect($userId){
		$connectSQL = 'SELECT count(*) as connect FROM vsf_friend WHERE friendStatus > 0 AND friendUser = '.$userId;
		
		$obj = new VSFObject();
		$temp = $obj->executeQueryAdvance($connectSQL, 0, '');
		$temp = current($temp);
		return $temp['connect'];
	}
	
	function analytic_inbox($reciptient){
		$model = new users();
		$cond = "	m.messageId = d.deliverMessage AND g.groupId = m.messageGroup AND 
					d.deliverStatus = 2 AND d.deliverRecipient = ".$reciptient." AND
					m.messageId NOT IN (
						SELECT d1.deliverMessage
						FROM 	vsf_message_labelm AS lm, vsf_message_deliver AS d1
						WHERE lm.lmMessage = d.deliverId AND lm.lmType = 1 AND d1.deliverId = lm.lmMessage
					) AND 
					m.messageId IN (
					 	SELECT MAX(messageId)
						FROM vsf_message AS mm, vsf_message_deliver AS d
						WHERE mm.messagegroup = m.messagegroup AND d.deliverMessage = mm.messageId AND 
							  d.deliverStatus > 0 AND d.deliverRecipient = ".$reciptient."
						GROUP BY mm.messagegroup
					)";
		$query = "SELECT count(*) as inbox FROM vsf_message AS m, vsf_message_deliver AS d, vsf_message_group AS g WHERE ".$cond;
		$temp = $model->executeQueryAdvance($query, 0, '');
		$temp = current($temp);
		return $temp['inbox'];
	}

	function importFilesForUserProfile(){
		global $vsPrint;

		
		$vsPrint->addJavaScriptFile ( "jquery/ui.tabs.custom");
		
		$vsPrint->addJavaScriptFile("icampus/custom-tags");
		$vsPrint->addCSSFile("custom-tags");
		
		$vsPrint->addJavaScriptFile("icampus/fileuploader", 1);
		$vsPrint->addJavaScriptFile("tiny_mce/tiny_mce", 1);
		
		$vsPrint->addJavaScriptFile('icampus/ddsmoothmenu');
		$vsPrint->addJavaScriptFile('ajaxupload/ajaxfileupload');
		$vsPrint->addJavaScriptFile('icampus/DD_roundies_0.0.2a');
		$vsPrint->addJavaScriptFile('icampus/jquery.validate.pack', 1);

		
		$vsPrint->addJavaScriptFile('icampus/jquery.tokeninput');
		$vsPrint->addCSSFile("token-input/token-input");
		$vsPrint->addCSSFile("token-input/token-input-facebook");
			
		
		$vsPrint->addCSSFile("fileuploader");
		$vsPrint->addCSSFile("jquery.tabs");
		$vsPrint->addCSSFile("ddsmoothmenu");
		$vsPrint->addCSSFile('custom.ui.tabs');
		
		$vsPrint->addCSSFile("usercp");
		$vsPrint->addCSSFile("messages");
		$vsPrint->addCSSFile('icmarket');
		$vsPrint->addCSSFile("messagesform");
		$vsPrint->addCSSFile("listings");
	}
	
	//importMessageFile
	function importFileForMessagePopup(){
//import js and css for make an offer.			
		global $vsPrint, $vsStd;
		
		$vsPrint->addJavaScriptFile('icampus/jquery.tokeninput');
		$vsPrint->addCSSFile("token-input/token-input");
		$vsPrint->addCSSFile("token-input/token-input-facebook");
		
		$vsPrint->addJavaScriptFile('icampus/jquery.validate.pack', 1);

		$vsPrint->addCSSFile("messagesform");
		
		$vsPrint->addJavaScriptFile ( 'jquery/ui.core' );
		$vsPrint->addJavaScriptFile ( "jquery/ui.widget");
		$vsPrint->addJavaScriptFile ( 'jquery/ui.position');
		$vsPrint->addJavaScriptFile ( 'jquery/ui.dialog' );
		$vsPrint->addGlobalCSSFile ( 'jquery/base/ui.dialog' );
		
		$vsPrint->addJavaScriptFile("tiny_mce/tiny_mce", 1);
		$vsStd->requireFile(JAVASCRIPT_PATH . "tiny_mce/tinyMCE.php");
		
		$vsPrint->addCSSFile("fileuploader");
		$vsPrint->addJavaScriptFile("icampus/fileuploader", 1);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function runAdminAddOn() {
		global $bw;
		
		if($bw->vars['user_multi_lang']=="Yes") $this->displayChooseLanguage();
		$this->displayAdminMenus();
	}
	/*
	 * get ACP Help: Hien thi thong tin ho tro nguoi dung theo tung module va chuc nang
	 * @param $curr_action	=	$bw->input['module']?$bw->input['module']:$bw->input['module']."::".$bw->input['action']
	 * @return void
	 */
	function displayAcpHelp(){
		global $bw, $vsSkin,$DB;
		$curr_action	=	$bw->input['module'];
		if($bw->input['action']!=""){
			$curr_action	.=	"::".$bw->input['action'];
		}

		$curr_LangId	=	$_SESSION[APPLICATION_TYPE]['language']['currentLang']['langId'];
		$DB->simple_construct	(	array(	'select'	=>	'*',
											'from'		=>	'acp_help',
											'where'		=>	'langId='.$curr_LangId.' AND `module_key`="'.$curr_action.'"',
											'order'		=>	'id'
											));
											$DB->simple_exec();
											if($acp_help	=	$DB->fetch_row()){
												$vsSkin->ACP_HELP_SYSTEM	=	$this->html->acpHelpHTML($acp_help);
											}
	}

	function displayChooseLanguage($langType = 1, $display = '<!--USER LANGUAGE LIST-->') {
		global $vsStd, $vsTemplate;

		if (! isset ( $_SESSION [APPLICATION_TYPE] ['language']['currentLang'] )) {
			//load lang default current
			$oLanguages = new languages ( );
			$oLanguages->language->setAdminDefault ( 1 );
			$langResult = $oLanguages->getLangByObject ( array ('getAdminDefault'), $oLanguages->arrayLang );
				
			reset ( $langResult );
			$language = current ( $langResult );
			$_SESSION [APPLICATION_TYPE]['language']['currentLang'] = $language->convertToDB ();
		}

		$currentUserLanguage = new Lang ( );
		$currentUserLanguage->convertToObject ( $_SESSION [APPLICATION_TYPE] ['language']['currentLang'] );

		$vsStd->requireFile ( CORE_PATH . "languages/languages.php" );
		$languages = new languages ( );
		$vsTemplate->global_template->LANGUAGE_LIST = $this->html->userLanguages ( $languages->arrayLang, $title);
	}

	function displayAdminMenus() {
		global $vsTemplate, $vsMenu,$vsSettings;
		$vsMenu->obj->setIsAdmin ( 1 );
		$vsMenu->obj->setStatus ( 1 );
		$vsMenu->obj->setPosition ( 'top' );
		$vsMenu->obj->setTitle ( 'Categories' );
		
		if(!$vsSettings->getSystemKey('admin_use_multi_language', 0, 'global', 1, 1))
			$menus = $vsMenu->filterMenu(array('isAdmin'=>true,'status'=>true),$vsMenu->arrayTreeMenu);
		else{
			$vsMenu->obj->setLangId($_SESSION[APPLICATION_TYPE]['language']['currentLang']['langId']);
			$menus = $vsMenu->filterMenu(array('isAdmin'=>true,'langId'=>true),$vsMenu->arrayTreeMenu);
		}
		$vsMenu->obj->setLangId($_SESSION [APPLICATION_TYPE] ['language']['currentLang']['langId']);
		$vsTemplate->global_template->ADMIN_TOP_MENU = $menus;
	}
	
	function managerPortlet(){
		global $vsUser, $vsStd, $vsTemplate;
		$vsStd->requireFile(CORE_PATH.'partners/partners.php');
		$partners = new partners();
		$option['global'] = $partners->getPartnerByCatName("Global");
		
		$vsStd->requireFile(CORE_PATH.'campuses/campuses.php');
		$campuses = new campuses;
		$vsTemplate->global_template->GLOBAL_CAMPUS_LIST = $campuses->getCampusList();
		
		$vsTemplate->global_template->GLOBAL_PARTNER = $this->html->globalParner($option);
		
		$vsTemplate->global_template->GLOBAL_USER_PANEL = $this->html->globalUserPanel();
	}
}
?>