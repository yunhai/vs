<?php

if (! defined ( 'IN_VSF' )) {
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit ();
}

global $vsStd;
$vsStd->requireFile ( CORE_PATH . 'contact/contacts.php' );

class contact_public {
	private $html = "";
	public $output = "";
	public $model;
	
	function __construct() {
		global $vsTemplate, $vsPrint;
		$this->model = new contacts ();
		
		$vsPrint->addCSSFile('contact');
		$this->html = $vsTemplate->load_template ( 'skin_contact' );
	}
	
	function auto_run() {
		global $bw, $vsTemplate;

		switch ($bw->input ['action']) {
			default :
				$this->generalView ();
		}
	}

	function generalView($opt = array()) {
		global $bw,  $vsLang, $vsPrint;

		$array = array('feedback'=>0, 'report'=>1, 'suggest'=>2);
		$bw->input['contactType'] = $array[$bw->input['type']];
		
		if($bw->input['isubmit']) $option = $this->sendContact();
			
		$option['recapcha'] = $this->getRecapcha();
		$this->output = $this->html->generalView($option);
	}
	
	function sendContact() {
		global $bw, $vsLang, $vsSettings, $vsPrint, $vsStd;
		
		$option['status'] = true;
		$option['message'] = 'Thanks for your feedback.';
		
		$bw->input['contactPostDate'] = time();
		
		$users = new users();
		$userIds = $users->convertNameToId($bw->input['username']);
		$cuser = current($userIds);
		$cuser = $cuser['userId'];
		
		$bw->input['contactUser'] = $cuser;
		$this->model->obj->convertToObject($bw->input);

		$error = $this->checkRecapcha();
		if($error){
			$option['status'] = false;
			$option['message'] = $error;
			$option['contact'] = $bw->input;
			return $option;
		}
		
		$result = $this->model->insertObject();
		
		$this->sentContactByEmail();

		if ($this->model->error){
			$option['status'] = false;
			$option['message'] = 'Error! Please, try again later.';
			$option['contact'] = $bw->input;
		}
		
		return $option;
	}
	
	function getRecapcha(){
		global $bw, $vsStd, $vsSettings;
		$error = "";
		$vsStd->requireFile(UTILS_PATH.'recaptcha.php');
		$publickey = $vsSettings->getSystemKey('recaptcha_public_key','6LcvfsMSAAAAACmDwqMWQbK-tQ766sdY2MW2m2lI','global', 1, 1);
		return recaptcha_get_html($publickey, $error);
	}
	
	function checkRecapcha(){
		global $vsLang, $vsStd, $vsSettings;
		
		$vsStd->requireFile(UTILS_PATH.'recaptcha.php');
		$privatekey = $vsSettings->getSystemKey('recaptcha_private_key','6LcvfsMSAAAAAFVsqsZaH2iZvMHegG1co4yBe4yU ','global', 1, 1);
		$resp = recaptcha_check_answer ($privatekey,
		$_SERVER["REMOTE_ADDR"],
		$_POST["recaptcha_challenge_field"],
		$_POST["recaptcha_response_field"]);
		if(!$resp->is_valid)
			return $resp->error = $vsLang->getWords('wrong_recapchar','Incorrect captcha');
	}
	
	function sentContactByEmail($addon_profile) {
		global $vsStd, $vsLang, $bw, $vsSettings;
		
		$vsStd->requireFile ( LIBS_PATH . "Email.class.php", true );
		$this->email = new Emailer ();
		

		$array = array('Feedback', 'Report Bugs/Errors', 'Suggest Feathers/Improvement');
		
		$message = <<<EOF
			<a href="{$bw->vars['board_url']}" title='iCampux'>
			<img src="{$bw->vars['img_url']}/logo.jpg" alt='{$bw->vars['board_url']}'/>
			</a><br />
			
			Hello!<br/>
			There is a feedback from <b>{$this->model->obj->getName()}</b> for iCampux Team.<br/><br/>
			<b>{$vsLang->getWords('contactName','Fullname')}:</b> {$this->model->obj->getName()}<br />
			<b>{$vsLang->getWords('contactEmail','Email')}:</b> {$this->model->obj->getEmail()}<br />
			<b>{$vsLang->getWords('contactType','Type')}:</b>{$array[1]} <br />
			<b>{$vsLang->getWords('contactContent','Detail')}:</b><br />
			{$this->model->obj->getContent()}<br /><br /><br />
			
			-- iCampux Team --<br />
	        <a href="{$bw->vars['board_url']}" title="{$bw->vars['board_url']}">{$bw->vars['board_url']}</a>
EOF;
		$this->email->setTo($bw->vars['global_systememail']);
		$this->email->setFrom('noreply@icampux.com', 'icampux.com');
		$this->email->setSubject('feedback for iCampux Team');
		$this->email->setBody($message);
		
		$this->email->sendMail ();
	}
	
	function thankcontact($url="contacts") {
		global $vsLang, $vsPrint;
		$text = $vsLang->getWords('contact_redirectText', 'Thankyou! Your message have been sent.');
		$this->output = $this->html->thankyou ( $text, 'advisorys/' );
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