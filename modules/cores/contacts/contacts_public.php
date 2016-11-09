<?php

if (! defined ( 'IN_VSF' )) {
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit ();
}

global $vsStd;
$vsStd->requireFile ( CORE_PATH . 'contacts/contacts.php' );

class contacts_public {
	private $html = "";
	public $output = "";
	public $model;

	function __construct() {
		global $vsTemplate, $vsPrint,$vsTemplate;
		$this->model = new contacts ();
		$this->html = $vsTemplate->load_template ( 'skin_contacts' );
            
	}

	function auto_run() {
		global $bw, $vsTemplate;
                $this->model->getNavigator();
		switch ($bw->input ['action']) {

			case 'viewform' :
					$this->output=$this->html->showFormDefault ();
				break;
                            
			case 'send' :
					$this->sendContact ();
				break;
                            
//                        case 'crecruiment' :
//					$this->sendCrecruitments ();
//				break;    

			case 'thanks' :
					$this->thankContact();
				break;
			
			default :
				$this->showDefault ();
		}
	}

	
	function showDefault($opt = array()) {
		global $bw, $vsStd, $vsSettings, $vsLang,$vsMenu,$vsPrint;

		$vsStd->requireFile(CORE_PATH.'pcontacts/pcontacts.php');
		$page = new pcontacts();
		$categories = $vsMenu->getCategoryGroup("pcontacts");
                $strIds=$vsMenu->getChildrenIdInTree($categories);
                $page->setCondition("pcontactCatId in ({$strIds}) and pcontactStatus > 0");
                $page->setOrder("pcontactIndex, pcontactId ASC");
		$option['contact'] = $page->getOneObjectsByCondition();
		
		return $this->output = $this->html->showDefault($option);
	}

        
        
        function sendContact() {
		global $bw, $vsLang, $vsSettings, $vsPrint, $vsStd,$DB;

		$vsStd->requireFile ( CORE_PATH . 'files/files.php' );
		$file = new files ();
//                print "<pre>";
//                print_r($bw->input);
//                print "<pre>";
//                exit();
                if(!$bw->input['contactPrePage'])
                                        $bw->input['contactPrePage'] = $_SERVER['HTTP_REFERER'];
		//if($vsSettings->getSystemKey("contact_form_security", 0, "contacts", 1, 1)){
			$vsStd->requireFile(ROOT_PATH."captcha/securimage.php");
			$image = new Securimage();
			if(!$image->check($bw->input['contactSecurity'])) {
				$message = $vsLang->getWords('thank_message','Security code doesnot match');
                                $java = <<<EOF
                                    <script>
                                        $(document).ready(function(){
                                        jAlert('{$vsLang->getWords('thank_message_no','Security code doesnot match')}','{$bw->vars['global_websitename']} Dialog');
});
                                    </script>    

EOF;
                                      
				//$vsPrint->redirect_screen($message, "contacts");
                                return $this->output = $this->html->showFormDefault () .$java;
			}
		//}
		
		$bw->input['contactPostDate'] = time();
		$default_profile = array(
								"contactAddress" 	=> $bw->input['contactAddress'],
								"contactPhone"		=> $bw->input['contactPhone'],
						);
		if($vsSettings->getSystemKey("contact_form_file", 0, "contacts", 0, 1))			
	    	if($_FILES[contactFile]){
	       		$infoupload = $file->uploadFile('contactFile',$bw->input['module']);
	          	$bw->input['contactFileId'] = $infoupload['fileId'];
	      	}
		$bw->input ['contactProfile'] = serialize($default_profile);
		$this->model->obj->convertToObject($bw->input);
	
		$result = $this->model->insertObject();
		if($vsSettings->getSystemKey("contact_sendMail", 1, "contacts")){
			$this->sentContactByEmail($default_profile,$infoupload['objfile']);

		}
		if ($this->model->error != "")
			return $this->sendContactError();
		
		//$url = $bw->input['module'];
		
                if($bw->input['contactPrePage'])
                    $url = $bw->input['contactPrePage'];
		$this->thankcontact($url);
	}

	function sentContactByEmail($addon_profile,$file) {
		global $vsStd, $vsLang, $bw, $vsSettings;
		$vsStd->requireFile ( LIBS_PATH . "Email.class.php", true );
		$this->email = new Emailer ();

		if($vsSettings->getSystemKey("contact_form_name", 1, "contacts", 1, 1))
			$message = "<strong>{$vsLang->getWords('contactName','Fullname')}:</strong> {$this->model->obj->getName()}<br />";

		if($vsSettings->getSystemKey("contact_form_email", 1, "contacts", 1, 1))
			$message .= "<strong>{$vsLang->getWords('contactEmail','Email')}:</strong> {$this->model->obj->getEmail()}<br />";

		if($vsSettings->getSystemKey("contact_form_address", 1, "contacts", 1, 1))
			$message .= "<strong>{$vsLang->getWords('contactAddress','Address')}:</strong>" . $addon_profile ["contactAddress"];

		if($vsSettings->getSystemKey("contact_form_phone", 1, "contacts", 1, 1))
			$message .= "<br /><strong>{$vsLang->getWords('contactPhone','Phone')}:</strong>" . $addon_profile ["contactPhone"];

		if($vsSettings->getSystemKey("contact_form_company", 1, "contacts", 1, 1))
			$message .= "<br /><strong>{$vsLang->getWords('contactCompany','Company:')}:</strong>" . $addon_profile ["contactCompany"];

		if($vsSettings->getSystemKey("contact_form_cell", 1, "contacts", 1, 1))
			$message .= "<br /><strong>{$vsLang->getWords('contactCell','Mobile:')}:</strong>" . $addon_profile ["contactDidong"] . "<br />";


		if($vsSettings->getSystemKey("contact_form_title", 1, "contacts", 1, 1))
			$message .= "<br /><strong>{$vsLang->getWords('contactSubject','Subject:')}:</strong> {$this->model->obj->getTitle()}<br />";

		$message .= "<br /><strong>Message:</strong>" . $this->model->obj->getContent();
		$this->email->setTo ( $vsSettings->getSystemKey("contact_emailrecerver", "minhhai@vietsol.net", "contacts"));
      	if($vsSettings->getSystemKey("contact_form_file", 0, "contacts", 0, 1))	
			if($file){
			$f = file_get_contents($bw->base_url."uploads/".$file->getPath().$file->getName()."_{$file->getUploadTime()}".".".$file->getType(), true);
			$this->email->addAttachment($f,$file->getName()."_{$file->getUploadTime()}".".".$file->getType(),"application/force-download");
	      	}
		$this->email->setFrom ( $this->model->obj->getEmail (), $this->model->obj->getTitle () );
		$this->email->setSubject ( $vsLang->getWords ( 'contactSubject', 'Contact' ) );
		$this->email->setBody ( $message );

		$this->email->sendMail ();
	}

	function thankcontact($url="contacts") {
		global $vsLang, $vsPrint;
		$text = $vsLang->getWords('contacts_redirectText', 'Thankyou! Your message have been sent.');
		
		$this->output = $this->html->thankyou ( $text, $url );
	}

	function sendContactError() {
		global $vsLang;
		$this->output = $vsLang->getWords ( 'contact_sendContentError', 'The following errors were found! Unknow!' );
	}

	function __destruct() {
		unset ( $this->html );
		unset ( $this->ouput );
	}

	function getOutput() {
		return $this->output;
	}
}
?>