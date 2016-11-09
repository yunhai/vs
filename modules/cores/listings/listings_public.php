<?php
if ( ! defined( 'IN_VSF' ) )
{
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit();
}


class listings_public{
   
    function auto_run(){
		global $bw, $vsUser, $vsLang, $vsPrint;

		
		$allow = array('reporterrstb');
		if(!in_array($bw->input[1], $allow)){
			if(!$vsUser->obj->getId()){
				print <<<EOF
					<script type='text/javascript'>
						location.href = "{$bw->vars['board_url']}/users/login";
					</script>
EOF;
				exit;
			}
		}
		switch($bw->input[1]){
			case 'mylisting':
					$this->mylisting();
				break;
				
			case 'textbook':
					$this->textbook();
				break;

			case 'tball': // textbook_all
					$this->textbook_all();
				break;

			case 'soldlt':
					$this->sold_textbook();
				break;
				
			case 'openlt':
					$this->open_textbook();
				break;	
				
			case 'pendinglt':
					$this->pending_textbook();
				break;
				
			case 'deletelt':
					$this->delete_textbook();
				break;
				
			case 'editlt':
					$this->edit_textbook();
				break;
				
			case 'tbsold': // textbook_sold
					$this->textbook_sold();
				break;
				
			case 'tbopen': // textbook_open
					$this->textbook_open();
				break;

			case 'tbpending': // textbook_pending
					$this->textbook_pending();
				break;
				

				
				
				
			case 'icmarket':
					$this->icmarket();
				break;
			case 'cf_category':
					$this->cf_category();
				break;
			case 'cfall': // textbook_all
					$this->cf_all();
				break;
			case 'cfsold': // textbook_sold
					$this->cf_sold();
				break;
				
			case 'cfopen': // textbook_open
					$this->cf_open();
				break;

			case 'cfpending': // textbook_pending
					$this->cf_pending();
				break;
				
			case 'soldlc':
					$this->sold_cf();
				break;
				
			case 'openlc':
					$this->open_cf();
				break;	
				
			case 'pendinglc':
					$this->pending_cf();
				break;
				
			case 'deletelc':
					$this->delete_cf();
				break;
			case 'editlc':
					$this->edit_cf();
				break;
				
				
				
			case 'alllistings':
					$this->alllistings();
				break;
				
			default:
					$this->globalerror();
				break;
		}
	}
	
	function alllistings(){
		global $bw;
		
		$bw->input['t'] = 'all';
		
		$bw->input[1] = 'icmarket';
		$option['content']['icMarket'] = $this->cf_all();
		
		$bw->input[1] = 'textbook';
		$option['content']['Textbook'] = $this->textbook_all();
		
		$option['key'] = array('icMarket'=>'ltab_icmarket_alllb', 'Textbook'=>'ltab_textbook_alllb');
		
		$this->output = $this->html->listingtab_all($option);
	}
	
	function icmarket(){
		global $bw, $vsStd;
	
		$option['cf_all'] = $this->cf_all();
		if($bw->input['t'] == 'all') return $option['cf_all'];
		
		$vsStd->requireFile(CORE_PATH.'icmarket/icmarkets.php');
		$cf = new icmarkets();
		$option['cfCategory'] = $cf->getCfCategory();
		
		$this->output =  $this->html->listingtab_icmarket($option);
	}
	
	function cf_category(){
		global $bw;
		
		if($bw->input[2])
			$bw->input['cf_category'] = $bw->input[2];
		if($bw->input['p']) 
			$bw->input['cf_status'] = $bw->input['p'];

		$this->cf_all();
	}
	
	function cf_all(){
		global $bw, $vsStd;
		
		$option = array();
		$vsStd->requireFile(CORE_PATH.'listings/lcs.php');
		
		$lcs = new lcs();
		$input = array('pajax' => 1, 'pcallback' => 'ltab_icmarket', 'url' => "listings/".$bw->input[1]);
		
		$lcs->setFieldsString('cfId, cfTitle, cfTime, lcId, lcStatus');
		$input['where'] = 'lcDel = 0';
		if($bw->input['t']){
			$input['pcallback'] = 'ltab_icmarket_alllb';
		}else{
			if($bw->input['cf_category']){
				$input['index'] = 3;
				$input['pcallback'] = 'cf_maincontain';
				
				$input['url'] = "listings/cf_category/".$bw->input['cf_category'];
				
				
				$input['where'] .= ' AND cfCatId = '.$bw->input['cf_category'];
			}
		}
		
		
		if($bw->input['cf_status']) $input['where'] .= ' AND lcStatus = '.$bw->input['cf_status'];
		
		$input['order'] = 'lcStatus, lcTime DESC, lcId DESC';
		$option = $lcs->listing_icmarket($input);

		foreach($option['pageList'] as $key=>$element){
			$option['pageList'][$key]['cfType'] = 'Local';
				
			$option['pageList'][$key]['ltStatus_'.$element['lcStatus']] = 'selected';

			$title = strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($element['cfTitle'])),'-')). '-' . $element['cfId'];
			$option['pageList'][$key]['cfURL'] = $bw->base_url . "icMarket/detail/".$title;
			
			$option['pageList'][$key]['cfTime'] = "";
			if($element['cfTime'])
				$option['pageList'][$key]['cfTime'] = $this->getDate($element['cfTime']);
		}
		
		$option['ajaxcallback'] = $bw->input['cf_ajaxcallback'] ? $bw->input['cf_ajaxcallback'] : 'lc_a_form_callback';
		$option['ajaxtype'] = $bw->input['cf_ajaxtype'] ? $bw->input['cf_ajaxtype'] : 'all';
		
		$option['curpan'] = $bw->input['cf_status'] ? $bw->input['cf_status'] : 0;
		
		return $this->output = $this->html->icmarket_all($option);
	}
	
	function cf_sold(){
		global $bw, $vsStd;
		$lcStatus = 3; 	$option = array();
		
		$vsStd->requireFile(CORE_PATH.'listings/lcs.php');
		
		$lcs = new lcs();

		
 		$input = array('pajax' => 1, 'pcallback' => 'ltab_icmarket', 'url' => "listings/".$bw->input[1]);
		
		$lcs->setFieldsString('cfId, cfTitle, cfTime, lcId, lcStatus, lcBuyer, lcPrice');
		
		$input['where'] = 'lcDel = 0 AND lcStatus = '.$lcStatus;
			
		$input['order'] = 'lcStatus, lcTime DESC, lcId DESC';
		$option = $lcs->listing_icmarket($input);
	
		foreach($option['pageList'] as $key=>$element){
			$option['pageList'][$key]['cfType'] = 'Local';
				
			$option['pageList'][$key]['ltStatus_'.$element['lcStatus']] = 'selected';
			
			$option['pageList'][$key]['cfTime'] = "";
			if($element['cfTime'])
				$option['pageList'][$key]['cfTime'] = $this->getDate($element['cfTime']);
			

			if(!$element['lcBuyer']) $option['pageList'][$key]['lcBuyer'] = 'Undisclosed';
			
			$option['pageList'][$key]['lcPrice'] = 'Undisclosed';
			if($element['ltPrice'])
				$option['pageList'][$key]['lcPrice'] = number_format($element['lcPrice'], 2, ".", ", ");
			
			$buyerIds .= $element['lcBuyer'].',';
			if($bw->input['cf_status'] ==  2){
				$option['pageList'][$key]['ltBuyer'] = 'Pending';
				$option['pageList'][$key]['ltPrice'] = 'Pending';
			}
		}
	
		$buyerIds = trim($buyerIds,",");
		if($buyerIds){
			$user = new users();
			$user->setCondition('userId in ('.$buyerIds.')');
			$array = $user->getObjectsByCondition();
			
			foreach($option['pageList'] as $key => $element)
				if($array[$element['lcBuyer']])
					$option['pageList'][$key]['lcBuyer'] = $array[$element['lcBuyer']]->getAlias();
		}
		


		return $this->output = $this->html->cf_sold($option);
	}
	
	function cf_open(){
		global $bw;
		
		$bw->input['cf_status'] = 1;
		$bw->input['cf_ajaxcallback'] = 'ltab_icmarket';
		$bw->input['cf_ajaxtype'] = 'open';

		$this->cf_all();
	}
	
	function cf_pending(){
		global $bw;
		
		$bw->input['cf_status'] = 2;
		$bw->input['textbook_ajaxcallback'] = 'ltab_icmarket';
		$bw->input['textbook_ajaxtype'] = 'pending';
	
		$this->cf_all();
	}
	
	function delete_cf(){
		global $bw, $vsStd, $vsLang;
		
		
		$vsStd->requireFile(CORE_PATH.'listings/lcs.php');
		$lcs = new lcs();
		
		$lcs->setCondition('lcId = '.$bw->input[2]);
		
		$update = array('lcDel' => 1);
		$status = $lcs->updateObjectByCondition($update);
		
		
		$option['message'] = $vsLang->getWords('lc_delete_fail','There was an error while deleting item');
		
		if($status)
			$option['message'] = $vsLang->getWords('lct_delete_successfully','You have successfully delete your item');
		
		unset($bw->input[2]);
		$this->cf_all();
	
		$this->output = $this->html->delete_icmarket_callback($option).$this->output;
	}
	
	function pending_cf(){
		global $bw, $vsUser, $vsStd, $vsLang;

		$option['curStatus'] = 0;
		if(!$bw->input['temp']){
			$option['message'] = $vsLang->getWords('lc_update_fail', 'There was an error while updating item');
			if($bw->input['atype']){
				$func = 'cf_'.$bw->input['atype'];
				$this->$func();
			}
			return $this->output .= $this->html->icmarket_callback($option);
		}
		
		$option['status'] = 0;
		$update = array(
						'lcBuyer'	=> 0,
						'lcPrice' 	=> 0,
						'lcStatus' 	=> 2,
						'lcTime' 	=> 0
		);
		
		$vsStd->requireFile(CORE_PATH.'listings/lcs.php');
		$lcs = new lcs();
		
		$lcs->setCondition('lcId = '.$bw->input['temp']);
		
		$status = $lcs->updateObjectByCondition($update);
		
		$option['lcId'] = $bw->input['temp'];
		$option['status'] = $status;
		$option['message'] = $vsLang->getWords('lc_update_fail', 'There was an error while updating item');

		if($status)
			$option['message'] = $vsLang->getWords('lc_update_successfully','You have successfully update your item');
		
		$option['curStatus'] = 3;
		
		if($bw->input['atype']){
			$func = 'cf_'.$bw->input['atype'];
			$this->$func();
		}
		$this->output .= $this->html->icmarket_callback($option);
	}

	function open_cf(){
		global $bw, $vsUser, $vsStd, $vsLang;
		
		$option['curStatus'] = 0;
		if(!$bw->input['temp']){
			$option['message'] = $vsLang->getWords('lc_update_fail', 'There was an error while updating textbook');
			if($bw->input['atype']){
				$func = 'cf_'.$bw->input['atype'];
				$this->$func();
			}
			return $this->output .= $this->html->icmarket_callback($option);
		}
		
		$option['status'] = 0;
		$update = array(
						'lcBuyer'	=> 0,
						'lcPrice' 	=> 0,
						'lcStatus' 	=> 1,
						'lcTime' 	=> 0
					);
		
		$vsStd->requireFile(CORE_PATH.'listings/lcs.php');
		$lcs = new lcs();
		
		$lcs->setCondition('lcId = '.$bw->input['temp']);
		
		$status = $lcs->updateObjectByCondition($update);
		
		$option['lcId'] = $bw->input['temp'];
		$option['status'] = $status;
		$option['message'] = $vsLang->getWords('lc_update_fail', 'There was an error while updating item');

		if($status)
			$option['message'] = $vsLang->getWords('lc_update_successfully','You have successfully update your item');
		
		$option['curStatus'] = 1;
		
		if($bw->input['atype']){
			$func = 'cf_'.$bw->input['atype'];
			$this->$func();
		}
		
		$this->output .= $this->html->icmarket_callback($option);
	}

	function sold_cf(){
		global $bw, $vsUser, $vsStd, $vsLang;
		

		$option['status'] = 0;
		if(!$bw->input['temp']){
			$option['message'] = $vsLang->getWords('lc_update_fail', 'There was an error while updating item');
			
			return $this->output = $this->html->sold_icmarket_callback($option);
		}
		

		$vsStd->requireFile(CORE_PATH.'listings/lcs.php');
		$lcs = new lcs();
		

		$lcs->setFieldsString('cfId, cfTitle, cfTime, lcId, lcStatus');
		$lcs->setTableName('listing_icmarket, vsf_icmarket');
		$lcs->setCondition('lcObj = cfId  AND lcId = '.$bw->input['temp']);
		
		$temp = $lcs->getArrayByCondition();
		
		
		if(!$temp){
			$option['message'] = $vsLang->getWords('report_sold_c_err_err', 'There was an error while reporting');
			return $this->output = $this->html->report_sold_tb_err($option);
		}
		$cf = current($temp);
		
		$update = array(
				'lcPrice' => $bw->input['lcPrice'],
				'lcStatus' => 3,
				'lcTime' => time()
			);
		
		if($bw->input['lcBuyer']){
			$userTemp = $vsUser->convertNameToId($bw->input['lcBuyer']);
			
			if(!$userTemp){
				$option['message'] = $vsLang->getWords('lc_error_no_user', 'This username/email is not exist in our website');
				return $this->output = $this->html->sold_icmarket_callback($option);
			}
			
			$userTemp = current($userTemp);
			$userId = $userTemp['userId'];
			$update['lcBuyer'] = $userId;
		}
		
		
		$lcs->setCondition('lcId = '.$bw->input['temp']);
		$status = $lcs->updateObjectByCondition($update);
		
		$option['status'] = $status;
		$option['lcId'] = $bw->input['temp'];
		
		$option['message'] = $vsLang->getWords('lc_update_fail', 'There was an error while updating item');
		if($status)
			$option['message'] = $vsLang->getWords('lc_update_successfully','You have successfully update your item');

		
		if($userId) $this->sendNotifyEmailAndMessageForClassified($userId, $cf);
		$this->output = $this->html->sold_icmarket_callback($option);
	}
	
	function edit_cf(){
		global $vsStd, $bw, $vsLang;
	
		$vsStd->requireFile(CORE_PATH.'icmarket/icmarket_public.php');
		
		$cf = new icmarket_public();

		if($bw->input['submit']){
			$option = $cf->post();
			$option['title'] = $bw->input['cfTitle'];
			$option['cfId'] = $bw->input['cfId'];
			return $this->output = $this->html->edit_icmarket_callback($option);
		}
		$this->output = $cf->postFormPortlet($bw->input[2]);
	}
	
	function sendNotifyEmailAndMessageForClassified($buyer, $textbook){
			global $vsStd, $bw, $vsLang, $vsUser;
			
			$user = new users();
			$user->getObjectById($buyer);
			
			$buyeremail = $user->obj->getEmail();
			
			$vsStd->requireFile(LIBS_PATH."Email.class.php");
			
			
			$tbtitle = $textbook['bookTitle'];
			$tblink = $bw->base_url . "textbooks/detail/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($textbook['bookTitle'])),'-')). '-' . $textbook['tuId'] . '/';

			$content = <<<EOF
					Hi {$user->obj->getAlias()} <br />

					Did you purchase this <b><a href="{$tblink}" title="$tbtitle">{$tbtitle}</a></b> from this {$vsUser->obj->getAlias()}? <br />
					
					If YES, Click <a href="{$bw->vars['board_url']}/listings/transaction/accept/{$bw->input['temp']}" title="Click here to verify your purchase">here</a> (<a href="{$bw->vars['board_url']}/listings/transaction/accept/{$bw->input['temp']}" title="Click here to verify your purchase">{$bw->vars['board_url']}/listings/transaction/accept/{$bw->input['temp']}</a>) to verify your purchase!<br/>
					If NO, Click <a href="{$bw->vars['board_url']}/listings/transaction/deny/{$bw->input['temp']}" title="Click here to report an error">here</a> (<a href="{$bw->vars['board_url']}/listings/transaction/deny/{$bw->input['temp']}" title="Click here to report an error">{$bw->vars['board_url']}/listings/transaction/deny/{$bw->input['temp']}</a>) to report an error! <br /><br />
					<b>If you've already done this, please disregard this message! <br /> </b
					Thank you!! <br /> <br />
					
							         
		         	-- iCampux Team -- <br />
		         	<a href="{$bw->vars['board_url']}" title="{$bw->vars['board_url']}">{$bw->vars['board_url']}</a>
EOF;
			
			
			$data['messageUser'] = 0;
			$data['messageRecipient'] = $user->obj->getAlias();
			$data['messageTitle'] = "Did you purchase a textbook at iCampux?";
			$data['messageContent'] = $content;
		
			$vsStd->requireFile(CORE_PATH.'messages/messages.php');
			$message = new messages();
		
			$message->sendMessage($data);
			
			
			$email = new Emailer();

			$email->setTo($buyeremail);
			$email->setFrom("noreply@icampux.com", "Did you purchase a textbook at iCampux?");
			$email->setSubject("Did you purchase a textbook at iCampux?");
			$email->setBody($content);
			$email->sendMail();
	}
	
	
	
	
	function delete_textbook(){
		global $bw, $vsStd, $vsLang;
		
		
		$vsStd->requireFile(CORE_PATH.'listings/lts.php');
		$lts = new lts();
		
		$lts->setCondition('ltId = '.$bw->input[2]);
		
		$update = array('ltDel' => 1);
		$status = $lts->updateObjectByCondition($update);
		
		
		$option['message'] = $vsLang->getWords('lt_delete_fail','There was an error while deleting textbook');
		
		if($status)
			$option['message'] = $vsLang->getWords('lt_delete_successfully','You have successfully delete your textbook');
		
		unset($bw->input[2]);
		$this->textbook_all();
	
		$this->output = $this->html->delete_textbook_callback($option).$this->output;
	}
	
	function pending_textbook(){
		global $bw, $vsUser, $vsStd, $vsLang;

		$option['curStatus'] = 0;
		if(!$bw->input['temp']){
			$option['message'] = $vsLang->getWords('lt_update_fail', 'There was an error while updating textbook');
			if($bw->input['atype']){
				$func = 'textbook_'.$bw->input['atype'];
				$this->$func();
			}
			return $this->output .= $this->html->pending_open_textbook_callback($option);
		}
		
		$option['status'] = 0;
		$update = array(
						'ltBuyer'	=> 0,
						'ltPrice' 	=> 0,
						'ltStatus' 	=> 2,
						'ltTime' 	=> 0
		);
		
		$vsStd->requireFile(CORE_PATH.'listings/lts.php');
		$lts = new lts();
		
		$lts->setCondition('ltId = '.$bw->input['temp']);
		
		$status = $lts->updateObjectByCondition($update);
		
		$option['ltId'] = $bw->input['temp'];
		$option['status'] = $status;
		$option['message'] = $vsLang->getWords('lt_update_fail', 'There was an error while updating textbook');

		if($status)
			$option['message'] = $vsLang->getWords('lt_update_successfully','You have successfully update your textbook');
		
		$option['curStatus'] = 3;
		
		if($bw->input['atype']){
			$func = 'textbook_'.$bw->input['atype'];
			$this->$func();
		}
		$this->output .= $this->html->pending_open_textbook_callback($option);
	}

	function open_textbook(){
		global $bw, $vsUser, $vsStd, $vsLang;
		
		$option['curStatus'] = 0;
		if(!$bw->input['temp']){
			$option['message'] = $vsLang->getWords('lt_update_fail', 'There was an error while updating textbook');
			if($bw->input['atype']){
				$func = 'textbook_'.$bw->input['atype'];
				$this->$func();
			}
			return $this->output .= $this->html->pending_open_textbook_callback($option);
		}
		
		$option['status'] = 0;
		$update = array(
						'ltBuyer'	=> 0,
						'ltPrice' 	=> 0,
						'ltStatus' 	=> 1,
						'ltTime' 	=> 0
					);
		
		$vsStd->requireFile(CORE_PATH.'listings/lts.php');
		$lts = new lts();
		
		$lts->setCondition('ltId = '.$bw->input['temp']);
		
		$status = $lts->updateObjectByCondition($update);
		
		$option['ltId'] = $bw->input['temp'];
		$option['status'] = $status;
		$option['message'] = $vsLang->getWords('lt_update_fail', 'There was an error while updating textbook');

		if($status)
			$option['message'] = $vsLang->getWords('lt_update_successfully','You have successfully update your textbook');
		
		$option['curStatus'] = 1;
		
		if($bw->input['atype']){
			$func = 'textbook_'.$bw->input['atype'];
			$this->$func();
		}
		$this->output .= $this->html->pending_open_textbook_callback($option);
	}

	function sold_textbook(){
		global $bw, $vsUser, $vsStd, $vsLang;
		

		$option['status'] = 0;
		if(!$bw->input['temp']){
			$option['message'] = $vsLang->getWords('lt_update_fail', 'There was an error while updating textbook');
			
			return $this->output = $this->html->sold_textbook_callback($option);
		}
		

		$vsStd->requireFile(CORE_PATH.'listings/lts.php');
		$lts = new lts();
		
		$vsStd->requireFile(CORE_PATH.'/textbooks/textbooks.php');
		$tb = new textbooks();
		
		$cond = "bookId = tubook AND tuId = ltTu AND bookStatus > 0 AND ltId = ".$bw->input['temp'];

		$tb->setTableName("textbook_user, vsf_textbook, vsf_listing_textbook");
		$tb->setCondition($cond);
		$temp = ($tb->getArrayByCondition());

		
		if(!$temp){
			$option['message'] = $vsLang->getWords('report_sold_tb_err_err', 'There was an error while reporting');
			return $this->output = $this->html->report_sold_tb_err($option);
		}
		$textbook = current($temp);
		
		$update = array(
				'ltPrice' => $bw->input['ltPrice'],
				'ltStatus' => 3,
				'ltTime' => time()
			);
		
		if($bw->input['ltBuyer']){
			$userTemp = $vsUser->convertNameToId($bw->input['ltBuyer']);
			
			if(!$userTemp){
				$option['message'] = $vsLang->getWords('lt_error_no_user', 'This username/email is not exist in our website');
				return $this->output = $this->html->sold_textbook_callback($option);
			}
			
			$userTemp = current($userTemp);
			$userId = $userTemp['userId'];
			$update['ltBuyer'] = $userId;
		}
		
		
		$lts->setCondition('ltId = '.$bw->input['temp']);
		$status = $lts->updateObjectByCondition($update);
		
		$option['status'] = $status;
		$option['ltId'] = $bw->input['temp'];
		
		$option['message'] = $vsLang->getWords('lt_update_fail', 'There was an error while updating textbook');
		if($status)
			$option['message'] = $vsLang->getWords('lt_update_successfully','You have successfully update your textbook');

		if($userId) $this->sendNotifyEmailAndMessage($userId, $textbook);
		
		$this->output = $this->html->sold_textbook_callback($option);
	}
	
	function sendNotifyEmailAndMessage($buyer, $cf){
			global $vsStd, $bw, $vsLang, $vsUser;
			
			$user = new users();
			$user->getObjectById($buyer);
			
			$buyeremail = $user->obj->getEmail();
			
			
			$vsStd->requireFile(LIBS_PATH."Email.class.php");
			
			
			$cftitle = $cf['cfTitle'];
			$cflink = $bw->base_url . "icMarket/detail/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($cftitle['cfTitle'])),'-')). '-' . $cftitle['cfId'] . '/';

			$content = <<<EOF
					Hi {$user->obj->getAlias()} <br />

					Did you purchase this <b><a href="{$cflink}" title="{$cftitle}">{$cftitle}</a></b> from this {$vsUser->obj->getAlias()}? <br />
					
					If YES, Click <a href="{$bw->vars['board_url']}/listings/transaction/accept/{$bw->input['temp']}" title="Click here to verify your purchase">here</a> (<a href="{$bw->vars['board_url']}/listings/transaction/accept/{$bw->input['temp']}" title="Click here to verify your purchase">{$bw->vars['board_url']}/listings/transaction/accept/{$bw->input['temp']}</a>) to verify your purchase!<br/>
					If NO, Click <a href="{$bw->vars['board_url']}/listings/transaction/deny/{$bw->input['temp']}" title="Click here to report an error">here</a> (<a href="{$bw->vars['board_url']}/listings/transaction/deny/{$bw->input['temp']}" title="Click here to report an error">{$bw->vars['board_url']}/listings/transaction/deny/{$bw->input['temp']}</a>) to report an error! <br /><br />
					<b>If you've already done this, please disregard this message! <br /> </b
					Thank you!! <br /> <br />
					
							         
		         	-- iCampux Team -- <br />
		         	<a href="{$bw->vars['board_url']}" title="{$bw->vars['board_url']}">{$bw->vars['board_url']}</a>
EOF;
			
			
			$data['messageUser'] = 0;
			$data['messageRecipient'] = $user->obj->getAlias();
			$data['messageTitle'] = "Did you purchase from iCampux?";
			$data['messageContent'] = $content;
		
			$vsStd->requireFile(CORE_PATH.'messages/messages.php');
			$message = new messages();
		
			$message->sendMessage($data);
			
			
			$email = new Emailer();

			$email->setTo($buyeremail);
			$email->setFrom("noreply@icampux.com", "Did you purchase from iCampux?");
			$email->setSubject("Did you purchase from iCampux?");
			$email->setBody($content);
			$email->sendMail();
	}
	
	function edit_textbook(){
		global $vsStd, $bw, $vsLang;
	
		$vsStd->requireFile(CORE_PATH.'textbooks/textbooks_public.php');
		
		$textbook = new textbooks_public();

		if($bw->input['submitForm']){
			$status = $textbook->editObj();

			$option['status'] = $status;
			$option['message'] = $vsLang->getWords('edit_textbook_fail','Error while editing textbook');
			if($status)
				$option['message'] = $vsLang->getWords('edit_textbook_successfully','You have successfully edit your textbook');

			$textbookType = $textbook->getTextbookType();
			
			if($textbookType[$bw->input['tuType']])
				$option['textbookType'] = $textbookType[$bw->input['tuType']]->getTitle();
			
				
			$option['ltId'] = $bw->input['ltId'];
			return $this->output = $this->html->edit_textbook_callback($option);
		}
		$this->output = $textbook->objFormPortlet($bw->input[2]);
	}
	
	function textbook(){
		$option['tb_all'] = $this->textbook_all();
		$this->output =  $this->html->listingtab_textbook($option);
	}
	
	function textbook_all(){
		global $bw, $vsStd;
		
		$option = array();
		
		$vsStd->requireFile(CORE_PATH.'listings/lts.php');
		$vsStd->requireFile(CORE_PATH.'textbooks/textbooks.php');
		
		$lts = new lts();
		$textbook = new textbooks();
		
		$textbookType = $textbook->getTextbookType();
	
		foreach($textbookType as $key=> $element){
			$title = $element->getIsLink();
			if(strtolower($title) == 'local'){
				$typeId = $element->getId();
				break;
			}
		}
		
		
		if(!$typeId) return $this->output = $this->html->textbook_all($option);
		
		
		$input = array('pajax' => 1, 'pcallback' => 'ltab_textbook', 'url' => "listings/".$bw->input[1]);
		
		$lts->setFieldsString('bookId, bookTitle, tuId, tuType, tuPostdate, ltId, ltStatus');
		if($bw->input['t']){
			$input['pcallback'] = 'ltab_textbook_alllb';
		}
		$input['where'] = 'ltDel = 0';
		if($bw->input['textbook_stat']){
			$ltStatus = $bw->input['textbook_stat'];
			$input['where'] .= ' AND ltStatus = '.$ltStatus;//.' AND tuType = '.$typeId;
		}
		 
		
		$input['order'] = 'ltStatus, ltTime DESC, ltId DESC';
		$option = $lts->listing_textbook($input);

		foreach($option['pageList'] as $key=>$element){
			if($textbookType[$element['tuType']])
				$option['pageList'][$key]['tuType'] = $textbookType[$element['tuType']]->getTitle();
				
			$option['pageList'][$key]['ltStatus_'.$element['ltStatus']] = 'selected';

			$title = $element['bookTitle'];
			$option['pageList'][$key]['listingURL'] =  $bw->base_url . "textbooks/detail/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($title)),'-')). '-' . $element['tuId'] . '/';
			
			$option['pageList'][$key]['tuPostdate'] = "";
			if($element['tuPostdate'])
				$option['pageList'][$key]['tuPostdate'] = $this->getDate($element['tuPostdate']);
		}

		$option['main_action'] = 'tball';
		$option['ajaxcallback'] = $bw->input['textbook_ajaxcallback'] ? $bw->input['textbook_ajaxcallback'] : 'lt_a_form_callback';
		$option['ajaxtype'] = $bw->input['textbook_ajaxtype'] ? $bw->input['textbook_ajaxtype'] : 'all';
		

		return $this->output = $this->html->textbook_all($option);
	}
	
	
	function textbook_sold(){
		global $bw, $vsStd;
		$vsStd->requireFile(CORE_PATH.'listings/lts.php');
		$vsStd->requireFile(CORE_PATH.'textbooks/textbooks.php');
		
		$lts = new lts();
		$textbook = new textbooks();
		
		$option = array();
		
		$textbookType = $textbook->getTextbookType();

		foreach($textbookType as $key=> $element){
			$title = $element->getIsLink();
			if(strtolower($title) == 'local'){
				$typeId = $element->getId();
				break;
			}
		}
	
		if(!$typeId) return $this->output = $this->html->textbook_sold($option);
		
		$ltStatus = 3;
		
		$input = array('pajax'=>1, 'pcallback'=> 'ltab_textbook', 'url' => "listings/".$bw->input[1]);
		$input['where'] = 'ltStatus = '.$ltStatus;//.' AND tuType = '.$typeId;
		
		$lts->setFieldsString('bookId, bookTitle, tuId, tuType, tuPostdate, ltId, ltBuyer, ltPrice, ltStatus');
		$option = $lts->listing_textbook($input);

		
		foreach($option['pageList'] as $key=>$element){
			if($textbookType[$element['tuType']])
				$option['pageList'][$key]['tuType'] = $textbookType[$element['tuType']]->getTitle();
				

			$title = $element['bookTitle'];
			$option['pageList'][$key]['listingURL'] =  $bw->base_url . "textbooks/detail/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($title)),'-')). '-' . $element['tuId'] . '/';
			
			$buyerIds .= $element['ltBuyer'].',';
			
			
			$option['pageList'][$key]['tuPostdate'] = "";
			if($element['tuPostdate'])
			$option['pageList'][$key]['tuPostdate'] = $this->getDate($element['tuPostdate']);
			

			if(!$element['ltBuyer']) $option['pageList'][$key]['ltBuyer'] = 'Undisclosed';
			
			$option['pageList'][$key]['ltPrice'] = 'Undisclosed';
			if($element['ltPrice'])
			$option['pageList'][$key]['ltPrice'] = number_format($element['ltPrice'], 2, ".", ", ");
			
			if($bw->input['textbook_stat'] ==  2){
				$option['pageList'][$key]['ltBuyer'] = 'Pending';
				$option['pageList'][$key]['ltPrice'] = 'Pending';
			}
		}
		
		$buyerIds = trim($buyerIds,",");
		if($buyerIds){
			$user = new users();
			$user->setCondition('userId in ('.$buyerIds.')');
			$array = $user->getObjectsByCondition();
			
			foreach($option['pageList'] as $key => $element)
				if($array[$element['ltBuyer']])
					$option['pageList'][$key]['ltBuyer'] = $array[$element['ltBuyer']]->getAlias();
		}
		

		return $this->output = $this->html->textbook_sold($option);
	}
	
	function textbook_open(){
		global $bw;
		
		$bw->input['textbook_stat'] = 1;
		$bw->input['textbook_ajaxcallback'] = 'ltab_textbook';
		$bw->input['textbook_ajaxtype'] = 'open';
		
		$this->textbook_all();
	}
	
	function textbook_pending(){
		global $bw;
		
		$bw->input['textbook_stat'] = 2;
		$bw->input['textbook_ajaxcallback'] = 'ltab_textbook';
		$bw->input['textbook_ajaxtype'] = 'pending';

		$this->textbook_all();
	}
	
	function mylisting(){
		global $bw;

		$option = array();
		
		if($bw->input['ajax'] && $bw->input['tab'] == 'mylisting')
			return $this->output = $this->html->coremylisting($option);
		
		global $addon;
		$addon->importFilesForUserProfile();
		$this->output = $this->html->mylisting($option);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function importFiles(){
		global $vsPrint;

		
		$vsPrint->addJavaScriptFile ( 'jquery/ui.core' );
		$vsPrint->addJavaScriptFile ( "jquery/ui.widget");
		$vsPrint->addJavaScriptFile ( "jquery/ui.tabs.custom");
		$vsPrint->addJavaScriptFile ( 'jquery/ui.position');
		$vsPrint->addJavaScriptFile ( 'jquery/ui.dialog' );
		$vsPrint->addGlobalCSSFile ( 'jquery/base/ui.dialog' );
		
		
		$vsPrint->addJavaScriptFile("icampus/custom-tags");
		$vsPrint->addCSSFile("custom-tags");
		
		$vsPrint->addJavaScriptFile("icampus/fileuploader", 1);
		$vsPrint->addJavaScriptFile("tiny_mce/tiny_mce", 1);
		
		$vsPrint->addJavaScriptFile('icampus/ddsmoothmenu');
		$vsPrint->addJavaScriptFile('ajaxupload/ajaxfileupload');
		$vsPrint->addJavaScriptFile('icampus/DD_roundies_0.0.2a');
		$vsPrint->addJavaScriptFile('icampus/jquery.validate.pack', 1);

		
		
		
		$vsPrint->addCSSFile("fileuploader");
		$vsPrint->addCSSFile("messagesform");
		$vsPrint->addCSSFile("listings");
		$vsPrint->addCSSFile("usercp");
		$vsPrint->addCSSFile("messages");
		$vsPrint->addCSSFile("jquery.tabs");
		$vsPrint->addCSSFile("ddsmoothmenu");
		$vsPrint->addCSSFile('custom.ui.tabs');
		
		$vsPrint->addCSSFile('icmarket');
	}
	
	
	
	
	function globalerror(){
		global $vsPrint;
		$vsPrint->boink_it($bw->base_url."error");
	}
	
	function getDate($date, $method="SHORT", $standard=false){
		global $bw, $vsSettings;

		$date += $bw->vars['TimeZone']*3600;
		$method = 'M d, Y';

		$result = gmdate($method, $date);

		if($standard)
			$result .= " GMT+(".$vsSettings->getSystemKey('global_servertimezone', '+7', 'global', 0, 1).")";
			
		return $result;
	}
	
	
	
 	public 		$output 	= "";
	private 	$html       = "";	
	protected	$module 	= "";
	
	function getOutput(){
		return $this->output;
	}
	
	function setOutput($outputHTML){
		$this->output = $outputHTML;
	}
	
    function __construct(){
		global $vsTemplate;
		
        $this->html = $vsTemplate->load_template('skin_listings');
    }
}
?>