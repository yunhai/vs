<?php
class pages_admin extends ObjectAdmin{
	function __construct() {
		global $vsTemplate, $vsPrint, $vsStd;
		parent::__construct('pages', CORE_PATH.'pages/', 'pages');
                $this->html = $vsTemplate->load_template('skin_pages');
	}
        function auto_run() {
		global $bw;

		switch ($bw->input ['action']) {
			case 'visible-checked-obj' :
				$this->checkShowAll(1);
				break;

			case 'home-checked-obj' :
				$this->checkShowAll(2);
				break;

			case 'hide-checked-obj' :
				$this->checkShowAll(0);
				break;

			case 'display-obj-tab' :
				$this->displayObjTab ();
				break;

			case 'display-obj-list' :
				$this->getObjList ( $bw->input [2], $this->model->result ['message'] );
				break;

			case 'add-edit-obj-form' :
				$this->addEditObjForm ( $bw->input [2] );
				break;

			case 'add-edit-obj-process' :
				$this->addEditObjProcess ();
				break;

			case 'change-objlist-bt' :
				$this->model->changeCateList ();
				$this->getObjList ();
				break;
			case 'insertSearch-objlist-bt' :
				$this->model->insertSearch ();	
				$this->getObjList ();
				break;
			case 'delete-obj' :
				$this->deleteObj($bw->input[2]);
				break;
                       //start virtual
                        case 'displayVirtualTab' :
					$this->displayVirtualTab ();
				break;

			case 'virtualForm' :
					$this->virtualForm($bw->input[2]);
				break;

			case 'editVirtual' :
					$this->editVirtual();
				break;

			case 'deleteVirtual' :
					$this->deleteVirtual($bw->input[2]);
				break;
			case 'sendemail'    :
                    $this->sendEmail($bw->input[2]);
                 break;	
			default :
				$this->loadDefault ();
				break;
		}
	}
	 function sendEmail(){
		global $bw, $vsStd,$vsLang;
		$vsStd->requireFile ( LIBS_PATH . "Email.class.php", true );
		$email = new Emailer ();
		$email->setTo($bw->vars['global_systememail']);
		
                require_once(CORE_PATH."emails/emails.php");
                $emails = new emails();
                $emails->setCondition("emailStatus > 0");
                $members = $emails->getObjectsByCondition();
        if($members)        
		foreach($members as $member){
			$cc = $member->getEmail();
			$email->addBCC($cc);
		}
              
		$obj = $this->model->getObjectById ( $bw->input [2] );
                
		$email->setFrom($bw->vars['global_systememail'], $obj->getTitle());
		$email->setSubject($obj->getTitle());
		$email->setBody($obj->getContent());
                
		$email->sendMail();
                $javascript =<<<EOF
                    <script>
                    $(document).ready(function(){
                    jAlert('{$vsLang->getWords('global_sendemail_succes','H? th?ng g?i mail th�nh c�ng!')}','{$bw->vars['global_websitename']} Dialog');
                        });
                   </script>     
EOF;
                    print $javascript;
	}
        function checkVitualModule($module_check=""){
            global $bw, $vsLang, $vsMenu, $vsSettings,$vsStd;
            $vsStd->requireFile(CORE_PATH . 'modules/modules_admin.php' );
            $module = new modules_admin();
            $list = $module->getVirtualModuleList();
               foreach($list as $obj)
                   if($obj->getClass()==$module_check)
                       return $obj->getClass();
                return "";
        }

    
	
	function deleteVirtual($modIds = 0){
		global $bw, $vsLang, $vsStd, $vsSettings;

				
		$vsStd->requireFile(CORE_PATH.'modules/modules.php');
		$module = new modules();
		$modules = $module->getModuleByIds($modIds);
		
		
		$module->setCondition("moduleId in ({$modIds})");
		$module->deleteObjectByCondition();


		if($modules){
			$str = "";
			foreach(explode(",", $modules) as $key=>$val)
				$str .= "'".$val."',";
			$str = trim($str, ","); 
			
			$vsSettings->deleteByModule($str);
			

			$menus = new menus();		
			$menus->setCondition("menuAlt in ({$str})");
			$menus->deleteObjectByCondition();
		}
		
		$this->displayVirtualTab();
	}
	
	function editVirtual() {
		global $bw, $vsLang, $vsStd, $vsMenu;
		
		$vsStd->requireFile ( CORE_PATH . 'modules/modules.php' );
		$module = new modules();
		
		$bw->input['moduleVirtual'] = 1;
		$bw->input['moduleClass'] = $bw->input['moduleTitle'];
		
		$bw->input ['moduleIsUser'] = $bw->input['moduleIsUser'] ? $bw->input['moduleIsUser'] : 0;
		$bw->input ['moduleIsAdmin'] = $bw->input['moduleIsAdmin'] ? $bw->input['moduleIsAdmin'] : 0;
		
		$module->obj->convertToObject($bw->input);
		
		if (empty($bw->input['moduleId'])) {
			$module->insertObject ( $module->obj );
			$vsMenu->getCategoryGroup ( $bw->input ['moduleTitle'] );
			if($module->result ['status'])
				$alert = $vsLang->getWords('add_virtual_module_successfully', 'you have successfully add a virtual module' );
		}
		else {
			$module->updateObjectById($module->obj);
			if($module->result['status'])
				$alert = $vsLang->getWords('edit_virtual_module_successful', 'you have successfully edit a virtual module');
		}
		if($alert)
			$javascript = <<<EOF
						<script type='text/javascript'>
							jAlert(
								"{$alert}",							
								"{$bw->vars['global_websitename']} Dialog"
							);
						</script>
EOF;
		return $this->output = $javascript.$this->displayVirtualTab();
	}
	
	function displayVirtualTab() {
		global $vsLang, $vsStd;
		$vsStd->requireFile(CORE_PATH . 'modules/modules_admin.php' );
		$module = new modules_admin();
		
		$option ['list'] = $this->html->displayVirtualItemContainer($module->getVirtualModuleList());
		$option ['form'] = $this->virtualForm();
		return $this->output = $this->html->displayVirtualTab ( $option );
	}
	
	function virtualForm($moduleId = 0) {
		global $bw, $vsLang, $vsStd;
		$vsStd->requireFile ( CORE_PATH . 'modules/modules.php' );
		$option ['submitValue'] = $vsLang->getWords ( 'bt_add', 'Add' );
		$option ['formTitle'] = $vsLang->getWords ( 'pages_addVirtual', 'Add Virtual Module' );
		
		$module = new modules();
		if (! empty ( $moduleId )) {
			$option ['submitValue'] = $vsLang->getWords ( 'bt_edit', 'Edit' );
			$option ['formTitle'] = $vsLang->getWords ( 'pages_editVirtual', 'Edit Virtual Module' );
			$module->getObjectById($moduleId);
		}
		
		return $this->output = $this->html->virtualForm($module->obj, $option);
	}
	
}
?>