<?php
	global $vsStd;
	
	require_once(CORE_PATH."messages/messages.php");

	class messages_public {
		
		function auto_run() {
			global $bw, $vsPrint;
			
			switch ($bw->input[1]){
				case 'label':
						$this->label();
					break;
					
				case 'add':
						$this->add();
					break;
					
				case 'detail':
						$this->detail($bw->input[2]);
					break;
					
				case 'compose':
						$this->compose();
					break;
					
				case 'inbox':
						$this->inbox();
					break;
					
				case 'reply':
						$this->reply($bw->input[2]);
					break;
					
				case 'delete':
						$this->delete();
					break;
					
				case 'forward':
						$this->forward($bw->input[2]);
					break;
					
				case 'spam':
						$this->spam();
					break;

				case 'draft':
						$this->draft();
					break;

				case 'trash':
						$this->trash();
					break;
					
				case 'sent':
						$this->sent();
					break;
					
				default:
						global $vsPrint;
						$vsPrint->boink_it($bw->base_url."messages/inbox");
					break;

				case 'popup':
						$this->popup();
					break;
			}
		}
		
		function label(){
			global $bw;
		
			if($bw->input['label']) return $this->add();
			if($bw->input['lma']=='mark') return $this->mark();
			$this->labellist();
		}
		
		function mark(){
			global $bw, $vsStd, $vsPrint, $vsUser, $vsLang;

			$bw->input['ajaxcallback'] = 'callback';
			$func =  $bw->input['curmod'] ? $bw->input['curmod']  : 'inbox';
			if($bw->input['curmod'] == 'label'){
				$bw->input[2] = $bw->input['curact'];
				$func = 'labellist';
			}
			if(in_array($bw->input['curmod'], array('spam', 'trash'))){
				$func = $bw->input['curmod'].'list';
			}
			
			$query = explode('-', $bw->input['lmi']);
			$lmLabel = abs(intval($query[count($query)-1]));
			if($query[0] == 'inbox') return $this->markInbox($func);
			
			if(!$lmLabel) return $this->output = $this->$func(1).<<<EOF
				<script type='text/javascript'>
					$('.blockMsg').html('<h1>{$vsLang->getWords('message_spam','Your message has been update.')}</h1>');
				</script>
EOF;
			
			$vsStd->requireFile(CORE_PATH."messages/labelms.php");
			$labelm = new labelms();
			
			$vsStd->requireFile(CORE_PATH.'messages/delivers.php');
			$deliver = new delivers();
			
			$lmIds = trim($bw->input['lm'], ',');
			if($lmIds){
				$labelm->setCondition('lmId in ('.$lmIds.')');
				$labelm->deleteObjectByCondition();
			}
			
			$type = $bw->input['lmt'];
			$data = array();
			
			$mois = trim($bw->input['lmo'], ",");
			
			if($bw->input['curmod'] == 'sent'){
				$this->module->setFieldsString("messageId");
				$this->module->setCondition('messageId in ('.$mois.') AND messageUser =' .$vsUser->obj->getId());
				$temp = $this->module->getObjectsByCondition();
			}else{
				$deliver->setFieldsString("deliverId");
				$condd = "deliverMessage in (".$mois.") AND deliverRecipient = ".$vsUser->obj->getId();
				$deliver->setCondition($condd);
				$temp = $deliver->getObjectsByCondition();
			}
			
			if($temp){
				$lmos = implode(",", array_keys($temp));
				
				$cond = "lmLabel = ".$lmLabel." AND lmMessage in (".$lmos.") AND lmType = ".$type;
				$labelm->setCondition($cond);
				$labelm->deleteObjectByCondition();
					
				$array = explode(",", $lmos);
				foreach($array as $lmo){
					$data[$lmo]['lmMessage'] = $lmo;
					$data[$lmo]['lmLabel'] = $lmLabel;
					$data[$lmo]['lmType'] = $type;
				}
				
				$labelm->multiInsert($data);
			}
			$deliver->setCondition($condd);
			$array = array('deliverStatus' => 1);
			$deliver->updateObjectByCondition($array);

			
			
			if($bw->input['curmod'] == 'detail'){
				return $this->output = <<<EOF
				<script type='text/javascript'>
					$('.blockMsg').html('<h1>{$vsLang->getWords('message_spam','Your message has been update.')}</h1>');
				</script>
EOF;
			}
			if(in_array($bw->input['curmod'], array('spam', 'trash'))){
				$func = $bw->input['curmod'].'list';
				$html = $this->$func(1);
				
				$this->setReadAttr($lmos);
			}else $html = $this->$func();

			return $this->output = $html.<<<EOF
				<script type='text/javascript'>
					$('.blockMsg').html('<h1>{$vsLang->getWords('message_spam','Your message has been update.')}</h1>');
				</script>
EOF;
		}
		
		function setReadAttr($labelmObj = 0){
			global $vsUser, $vsStd;
			$this->module->setCondition('messageId in ('.$labelmObj.') AND messageStatus < 0 AND messageUser = '.$vsUser->obj->getId());
			$this->module->updateObjectByCondition(array('messageStatus' => 2));
		}
		
		function markInbox($func){
			global $bw, $vsStd, $vsPrint, $vsUser, $vsLang;
			
			$vsStd->requireFile(CORE_PATH."messages/labelms.php");
			$labelm = new labelms();
			
			$vsStd->requireFile(CORE_PATH.'messages/delivers.php');
			$deliver = new delivers();
	
			$mois = trim($bw->input['lmo'],",");
			$cond = "d.deliverRecipient = {$vsUser->obj->getId()} AND deliverMessage in (".$mois.") AND ".
					"m.messageId = d.deliverMessage";

			$deliver->setTableName("message AS m, vsf_message_deliver AS d");
			$deliver->setCondition($cond);
			
			$array = array ('deliverStatus' => 1);
			$deliver->updateObjectByCondition($array);
			
			$cond = "messageUser = ".$vsUser->obj->getId()." AND messageId in (".$mois.") AND messageStatus = -1";
			$this->module->setCondition($cond);
			$array = array ('messageStatus' => 2);
			$this->module->updateObjectByCondition($array);
			
			
			$lmIds = trim($bw->input['lm'], ',');
			if($lmIds){
				$labelm->setCondition('lmId in ('.$lmIds.')');
				$labelm->deleteObjectByCondition();
			}
			
			
			
			if($func == 'labellist') $html = $this->$func(1);
			
			return $this->output = $html.<<<EOF
				<script type='text/javascript'>
					$('.blockMsg').html('<h1>{$vsLang->getWords('message_marklabel','Your message has been update.')}</h1>');
				</script>
EOF;
		}
				
		function add(){
			global $bw, $vsStd, $vsUser;
			
			require_once(CORE_PATH."messages/labels.php");
			$label = new labels();
			
			$user = $vsUser->obj->getId();
			$cond = 'labelTitle = "'.$bw->input['labelTitle'].'" AND labelUser = '.$user;
			$label->setCondition($cond);
			$total = $label->getNumberOfObject();
			
			if(!$total){
				$bw->input['labelStatus'] 	= 1;
				$bw->input['labelUser'] 	= $user;
				
				$label->obj->convertToObject($bw->input);
				$label->insertObject();
			}
			
			
			$label->setCondition('labelStatus > 0 AND labelUser = '.$vsUser->obj->getId());
			$option['label'] = $label->getObjectsByCondition();
			
			$option['message'] = "aaa";
			$this->output = $this->html->foldersPanel($option);
		}
		
		function labellist($core = 0){
			global $bw, $vsStd, $vsUser, $vsSettings;
			
			$query = explode('-', $bw->input[2]);
			$lmLabel = abs(intval($query[count($query)-1]));
			
			$reciptient = $vsUser->obj->getId();
			$cond = "	m.messageId = d.deliverMessage AND g.groupId = m.messageGroup AND 
						m.messageStatus > 1 AND d.deliverRecipient = ".$reciptient." AND
						((lm.lmMessage = d.deliverId AND lm.lmType = 1) OR (lm.lmMessage = m.messageId AND lm.lmType =2)) AND
						lm.lmLabel = ".$lmLabel." AND 
						m.messageId IN (
						 	SELECT MAX(messageId)
							FROM vsf_message AS mm, vsf_message_deliver AS d1, vsf_message_labelm AS lm1
							WHERE mm.messagegroup = m.messagegroup AND d1.deliverMessage = mm.messageId AND 
								  ((lm1.lmMessage = d1.deliverId AND lm1.lmType = 1) OR (lm.lmMessage = mm.messageId AND lm1.lmType =2))AND
								  d.deliverRecipient = ".$reciptient."
							GROUP BY mm.messagegroup
						)";
			
			$this->module->setFieldsString("m.*, g.groupTitle, d.deliverId, d.deliverStatus, d.deliverPostdate, count(messageId) as cnt, lm.lmId");
			$this->module->setTableName("message AS m, vsf_message_deliver AS d, vsf_message_group AS g, vsf_message_labelm AS lm");
			$this->module->setCondition($cond);
			$this->module->setGroupby("groupid");
			$this->module->setOrder('d.deliverPostdate DESC');
			
			$url = "messages/inbox"; $pIndex = 2; $size = $vsSettings->getSystemKey('inbox_quality', 10, 'message', 1);
			$data = $this->module->getAdvancePageList($url, $pIndex, $size, 0, "", "getId", 0, 2, array('gquality'=>'cnt', 'gtitle'=>'groupTitle', 'dstatus'=>'deliverStatus', 'lmId'=>'lmId'));

			$option['count'] = 0;
			foreach($data['pageList'] as $message){
				$str .= $message->getUser().",";
				if($message->dstatus == 2)
					$option['count']++;
			}

			$str = trim($str, ",");
			$data['user'] = $this->getUserInfoById($str);
			
			if(!$data['current']) $data['current'] = 1;
			
			$count = count($data['pageList']);
			if($count)
			$data['pageStatus'] = (($data['current']-1)*$size + 1)." - ".(($data['current']-1)*($size)+$count);
			
			$option['main_content'] = $this->html->labellist($data);
			if($core) return $this->output = $option['main_content'];
			
			$option['label'] = $this->userLabel();
			return $this->output = $this->html->mainlabel($option);
		}
		
		function forward($original = 0){
			global $bw, $vsPrint, $vsLang;
			
			if($bw->input['mact']) return $this->sendMessage(3);
			
			$this->module->getMessageObjectById($original);
			$this->module->obj->setTitle($vsLang->getWords('forward_prefix','Fwd: ').$this->module->obj->getTitle());
			
			$bw->input['a']= 'f';
			$bw->input['dm'] = $original;
			$this->output = $this->objForm($original);
		}
		
		function detail($messageId = "", $core = 0){
			global $vsPrint, $vsStd, $vsUser, $bw, $vsSettings, $addon;
			
			$query = explode('-',$messageId);
			$mesId = abs(intval($query[count($query)-1]));
			if(!$mesId) return $this->output = $this->html->error('', $bw->base_url."error");
			
			$this->module->getMessageObjectById($mesId);

			if(!$this->module->obj->getId()){
				$bw->input['coreinbox'] = 'coreinbox';
				return $this->inbox();
			}

			$cond = "m.messageId = d.deliverMessage AND (d.deliverStatus > 0 AND messageType = 2 AND ".
					"d.deliverRecipient = ".$vsUser->obj->getId()." AND messageOriginal = ".$mesId.") AND messageStatus > 1 AND ". 
					"messageGroup = ".$this->module->obj->getGroup();
			
			$this->module->setFieldsString("m.*, d.deliverId, d.deliverPostdate");
			$this->module->setTableName("message AS m, vsf_message_deliver AS d");
			$this->module->setOrder('messageType, messagePostdate DESC');
			$this->module->setCondition($cond);
		
			$url = "messages/detail/".$messageId;
			$size = 10; $index = 3;
			$option = $this->module->getArrPageList($url, $index, $size, 0, "", "messageId");
			$option['pageList'] = $this->convertArrToObj($option['pageList'], array('deliverId'=>'deliverId'));

			$objectId = $mesId;
			if($option['pageList'])
				$objectId = $objectId.",".implode(array_keys($option['pageList']), ",");

			$this->module->vsRelation->setTableName('message_file');
			$this->module->vsRelation->setCondition("objectId in (".$objectId.")");
			$this->module->vsRelation->setOrder("objectId");
			$array = $this->module->vsRelation->getArrayByCondition("", "objectId");
			
			if($array){
				foreach($array as $attfiles){
					foreach($attfiles as $attfile)
						$fileIds .=  $attfile['relId'].",";
				}

				global $vsFile;
				
				$vsFile->setCondition('fileId in ('.trim($fileIds,",").')');
				$fileOs = $vsFile->getObjectsByCondition();
	
				if($option['pageList']){
					foreach($array as $key => $attfiles){
						if(array_key_exists($key, $option['pageList']))
							foreach($attfiles as $attfile){
								$fileOs[$attfile['relId']]->setTitle(trim($fileOs[$attfile['relId']]->getTitle(), "~"));
								$option['pageList'][$key]->attfiles[] = $fileOs[$attfile['relId']];
							}
					}
				}
				if($array[$this->module->obj->getId()])
					foreach($array[$this->module->obj->getId()] as $attfile){
						$fileOs[$attfile['relId']]->setTitle(trim($fileOs[$attfile['relId']]->getTitle(), "~"));
						$this->module->obj->attfiles[] = $fileOs[$attfile['relId']];
					}
			}

			
		
// get recipient
			$vsStd->requireFile(CORE_PATH.'messages/delivers.php');
			$deliver = new delivers();
			
			$deliver->setFieldsString("deliverId, deliverRecipient");
			$deliver->setCondition('deliverMessage = '.$mesId);
			$option['recipient'] = $deliver->getObjectsByCondition('getRecipient');
			
			$recipientId = "";
			if($option['recipient'])
				foreach($option['recipient'] as $obj)
					$recipientId .= $obj->getRecipient().",";
			$option['allrecipient'] = $recipientId.$this->module->obj->getUser();
			
			$userId = $this->module->obj->getUser().",";
			if($option['pageList'])
				foreach($option['pageList'] as $temp)
					$userId .= $temp->getUser().",";
			$userId .= implode(",", array_keys($option['recipient']));
			
			$option['user'] = $this->getUserInfoById(trim($userId,","));
			$option['user'][0] = array('name' => $vsSettings->getSystemKey('global_system_message_name', 'system', 'global', 1, 1));			
			$option['user'][-1] = array('name' => $vsSettings->getSystemKey('global_system_message_name_icmarket', 'iCampux icMarket', 'global', 1, 1));
	
			foreach($option['user'] as $key=>$value){
				$option['user'][$key]['profile'] = "#";
				if($key > 0){
					$option['user'][$key]['profile'] = $bw->vars['board_url'].'/'.$value['name'];
					$option['user'][$key]['profile_title'] = $value['name']."'s profile";
				}
			}
			
			require_once(CORE_PATH."messages/labels.php");
			$label = new labels();
			
			$label->setCondition('labelStatus > 0 AND labelUser = '.$vsUser->obj->getId());
			$option['label'] = $label->getObjectsByCondition();
			
			
//update status to read	
//			if($option['pageList'])
			$delMes = $mesId.','.@implode(",", @array_keys($option['pageList']));
			$deliver->setCondition('deliverStatus > 0 AND deliverMessage in (' . trim($delMes,",") . ") AND deliverRecipient = ".$vsUser->obj->getId() );
			$array = array ('deliverStatus' => 1);
			$deliver->updateObjectByCondition($array);
//end update status	

			
			$option['detailId'] = $messageId;
			
			$option['main_content'] = $this->html->detail($this->module->obj, $option);
			if($core)
				return $this->output = $option['main_content'];
				
			return $this->output = $this->html->maindetail($option);
			
			$this->output = $this->html->mainlayout($option);
		}
		
		function countNewMessage($reciptient = 0){
			if(!$reciptient) return 0;
	
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
			
			$this->module->setFieldsString("count(*) as cnt");
			$this->module->setTableName("message AS m, vsf_message_deliver AS d, vsf_message_group AS g");
			$this->module->setCondition($cond);
			$this->module->setGroupby("groupid");
			return $this->module->getNumberOfObject();
		}
		
		function inbox(){
			global $bw, $vsStd, $vsUser, $vsSettings;
			global $addon;
			$addon->importFilesForUserProfile();
			$addon->importFileForMessagePopup();
			$reciptient = $vsUser->obj->getId();

			$cond = "	m.messageId = d.deliverMessage AND g.groupId = m.messageGroup AND 
						m.messageStatus > 1 AND d.deliverStatus > 0 AND d.deliverRecipient = ".$reciptient." AND
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
			
			$this->module->setFieldsString("m.*, g.groupTitle, d.deliverId, d.deliverStatus, d.deliverPostdate, count(messageId) as cnt");
			$this->module->setTableName("message AS m, vsf_message_deliver AS d, vsf_message_group AS g");
			$this->module->setCondition($cond);
			$this->module->setGroupby("groupid");
			$this->module->setOrder('d.deliverPostdate DESC');
			
			$url = "messages/inbox"; $pIndex = 2; $size = $vsSettings->getSystemKey('inbox_quality', 10, 'message', 1);
			$data = $this->module->getAdvancePageList($url, $pIndex, $size, 0, "", "getId", 0, 2, array('gquality'=>'cnt', 'gtitle'=>'groupTitle', 'dstatus'=>'deliverStatus'));


			$option['count'] = 0;
			$option['count'] = $this->countNewMessage($reciptient);
			
			foreach($data['pageList'] as $message)
				$str .= $message->getUser().",";

			$str = trim($str, ",");
			$data['user'] = $this->getUserInfoById($str);
			
			$data['user'][0] = array('name' => $vsSettings->getSystemKey('global_system_message_name', 'system', 'global', 1, 1));
			$data['user'][-1] = array('name' => $vsSettings->getSystemKey('global_system_message_name_icmarket', 'iCampux icMarket', 'global', 1, 1));
			
			if(!$data['current']) $data['current'] = 1;
			$count = count($data['pageList']);
			if($count)
				$data['pageStatus'] = (($data['current']-1)*$size + 1)." - ".(($data['current']-1)*($size)+$count);
			
			$option['main_content'] = $this->html->inbox($data);
			
			if($bw->input['ajaxcallback'] == 'callback'){
				$inboxcount = "";
				if($option['count']) $inboxcount = "(".$option['count'].")";
				return $this->output = $option['main_content'].<<<EOF
					<script type='text/javascript'>
						$('#inboxb').html('Inbox {$inboxcount}');
						$('#inboxb').addClass('inboxactive active');
					</script>
EOF;
			}
			
			global $vsUser;
			require_once(CORE_PATH."messages/labels.php");
			$label = new labels();

			$label->setCondition('labelStatus > 0 AND labelUser = '.$vsUser->obj->getId());
			$option['label'] = $label->getObjectsByCondition();
			
			$option['campus_user_right'] = $this->html->maininbox($option);
			if($bw->input['coreinbox']) return $this->output = $option['campus_user_right'];
			
			$corehtml = $this->html->corelayout($option);
			if($bw->input['ajax'] || $bw->input['tab'] == 'inbox') return $this->output = $corehtml;
			
			$option['core_content'] = $corehtml;
			$this->output = $this->html->mainlayout($option);
		}

		
		function reply($ori = 0){
			global $bw, $vsPrint, $vsUser;

			$bw->input['dm'] = $ori;
			if($bw->input['mact']){
				$type = 2;
				return $this->sendMessage($type);
			}
			$bw->input['a']= 'r';
			$this->module->getMessageObjectById($ori);
		
			if($bw->input['recipient']){//reply all
				$bw->input['ra'] = 'ra';
				$userId = $bw->input['recipient'];
				$users = $this->getUserInfoById($userId);
				foreach($users as $element)
					$recipient .= $element['name'].", ";
				$recipient = trim($recipient,", ");
			}
			else{
				$ori = 0;
				$userId = $this->module->obj->getUser();
				$temp = $this->getUserInfoById($userId);
				$recipient = $temp[$this->module->obj->getUser()]['name'];
			}
			$this->module->obj->recipient = $recipient;
			$this->module->obj->poster = $users[$this->module->obj->getUser()]['name'];
			$this->output = $this->objForm($ori);
		}
		
		function compose(){
			global $bw;
			
			if($bw->input['mact']){
				$bw->input[1] = 'inbox';
				return $this->sendMessage();
			}
			
			$bw->input['a'] = 'c';
			return $this->output = $this->objForm();
		}
		
		function popup(){
			global $bw, $vsPrint, $vsUser;
			
			if($bw->input['mact']) return $this->sendMessage();
			
			if($bw->input['mainmod'] == 'textbook'){
//				$bw->input['a'] = 'offertextbook';
				$this->module->obj->setTitle('Order textbook: '.$bw->input['bookTitle']);
				
				$data = $this->getUserInfoById($bw->input['seller']);
				$recipient = $data[$bw->input['seller']]['name'];
			}
			
			if($bw->input['mainmod'] == 'uprofile'){
				$recipient = $bw->input['alias'];
			}
			
			if($bw->input['mainmod'] == 'classified'){
				$this->module->obj->setTitle($bw->input['cfTitle']);
				$recipient = $bw->input['seller'];
			}
			
			$this->module->obj->recipient = $recipient;
			return $this->output = $this->objForm();
		}
		
		function objForm($ori = 0){
			global $bw, $vsPrint, $vsStd;
		
			$value = "";
			$vsStd->requireFile (JAVASCRIPT_PATH . "tiny_mce/tinyMCE.php");
			
			if($bw->input['a'] == 'r' && $bw->input['ra'] != 'ra'){
					$vopt['pre'] = 'On '.$this->module->obj->getPostdate('long'). ', ' .$this->module->obj->poster.' wrote:';
				$vopt['message'] = $this->module->obj->getContent();
				$value = $this->html->messageTemplate($vopt);
			}
			elseif($bw->input['a'] == 'f'){
				$vopt['pre'] = '---------- Forwarded message ----------';
				$vopt['message'] = $this->module->obj->getContent();
				$value = $this->html->messageTemplate($vopt);
			}
			
			$option = array();
	
			$editor = new tinyMCE( );
			$editor->setUrl($bw->vars['board_url']);
				
			$editor->setWidth('100%');
			$editor->setHeight('250px');
			$editor->setToolbar('message');
			$editor->setTheme("advanced");
			
			$editor->setInstanceName('messageContent');
			$editor->setValue($value);
			
			$this->module->obj->setContent($editor->createHtml());

			$option['ori'] = $ori;
			$option['action'] = $bw->input['a'];
			$option['ra'] = $bw->input['ra'];
			$option['draftaction'] = $bw->input['draftaction'];
			$option['dm'] = $bw->input['dm'];
			return $this->html->objForm($this->module->obj, $option);
		}
		
		function sendMessage($type = 1){
			global $bw, $vsPrint, $vsUser, $vsStd, $vsLang;

		
			$time = time(); $newgroup = true;
			$bw->input['ajaxcallback'] = 'callback';

			$vsStd->requireFile(CORE_PATH."messages/mgroups.php");
			$mgroup = new mgroups();
			
			$user = new users(); $result = array();
			$result = $user->convertNameToId($bw->input['messageRecipient']);
			if(!$result){
				$cresult['status'] = 0;
				$cresult['script'] = <<<EOF
					<h1>{$vsLang->getWords("no_recipient", "This user/username doesn't exist. Please check & try again.")}</h1>
EOF;
				echo json_encode($cresult);
				exit;
			}
			
			
			$group = $bw->input['messageGroup'];
			if($group){
				$newgroup = false;
				$mgroup->getObjectById($group);
				if($bw->input['a']=='f'){
					$newgroup = true;
				}elseif($bw->input['a']=='r'){
					if(!$bw->input['ra']){
						$bw->input['messageTitle'] = $vsLang->getWords('reply_prefix','Re: ').$bw->input['messageTitle'];
						$newgroup = true;
					}
					if(trim($bw->input['messageTitle']) != trim($mgroup->obj->getTitle())){
						$bw->input['messageType'] = 1;
						$bw->input['messageOriginal'] = 0;
						$newgroup = true;
					}
				}
			}

			if($newgroup){
				$mgroup->obj = new MGroup();
				$gData['groupTitle'] = $bw->input['messageTitle'];
				$mgroup->obj->convertToObject($gData);
				
				$mgroup->insertObject($mgroup->obj);
				$group = $mgroup->obj->getId();
			}
			
			$bw->input['messageGroup'] = $group;
			$bw->input['messageType'] = $type;
			$bw->input['messagePostdate'] = $time;
			$bw->input['messageStatus'] = 3;
			
			$bw->input['messageUser'] = $vsUser->obj->getId();
			
			$this->module->obj->convertToObject($bw->input);
			$this->module->insertObject();
			
		
			$data = array();
			if($type == 2)
				$result[$vsUser->obj->getId()] = $vsUser->obj->getId();
				
			foreach(array_keys($result) as $recipient){
				$data[$recipient]['deliverMessage'] = $this->module->obj->getId();
				$data[$recipient]['deliverRecipient'] = $recipient;
				$data[$recipient]['deliverPostdate'] = $time;
				$data[$recipient]['deliverStatus'] = 2;
			}
			
			$vsStd->requireFile(CORE_PATH."messages/delivers.php");
			$deliver = new delivers();
			$deliver->multiInsert($data);

			$userId = implode(',', array_keys($result));
			$user->setCondition("userId in (".$userId.")");
			
			$userArray = $user->getArrayByCondition();
			
			
			$this->sendNotifyEmail($userArray);
			
			if($bw->input['attfiles']) $this->attactFiles();
			
			if($bw->input['mact'] == 'popup'){
				$cresult['status'] = 2;
				$cresult['script'] = "<h1>{$vsLang->getWords('send_successfully','Your message has sent')}</h1>";
				$cresult['html'] = <<<EOF
					<script type='text/javascript'>
					setTimeout(function(){
						$.unblockUI();
						$('#{$bw->input['popupId']}').dialog('close');
					}, 2000);
					</script>
EOF;
				echo json_encode($cresult);
				exit;
			}
			if($bw->input['mact'] == 'draft'){
				$cresult['html'] = $this->inbox();
				$cresult['script'] = <<<EOF
					<h1>{$vsLang->getWords('send_successfully','Your message has sent')}</h1><br />Redicting to draft
EOF;
				echo json_encode($cresult);
				exit;
			}
			if($type == 1){
				$cresult['html'] = $this->inbox();
				$cresult['script'] = <<<EOF
					<h1>{$vsLang->getWords('send_successfully','Your message has sent')}</h1><br />Redicting to inbox
EOF;
				echo json_encode($cresult);
				exit;
			}

			$cresult['html'] = $this->detail($bw->input['previous'], 1);
			$cresult['script'] = <<<EOF
					<h1>{$vsLang->getWords('send_successfully','Your message has sent')}</h1><br />Reloading....
EOF;
			echo json_encode($cresult);
			exit;
		}

		function attactFiles(){
			global $bw;
		
			$data = array();
			$objId = $this->module->obj->getId();
			foreach(explode(",", trim($bw->input['attfiles'], ",")) as $key=>$fileId){
				$data[$key]['objectId'] = $objId;
				$data[$key]['relId'] = $fileId;
			}
			$this->module->vsRelation->setTableName('message_file');
			$this->module->vsRelation->multiInsert($data);
		}
		
		function sendNotifyEmail($users = array()){
			if(!$users) return false;
			global $vsStd, $bw, $vsLang, $vsUser;
			
			$vsStd->requireFile(LIBS_PATH."Email.class.php");
			foreach($users as $element){
				$emails = $element['userEmail'];
			
				$content = <<<EOF
					<a href="{$bw->vars['board_url']}" title='iCampux'>
					<img src="{$bw->vars['img_url']}/logo.jpg" alt='{$bw->vars['board_url']}'/>
					</a><br />
					Hi {$element['userAlias']}! <br />

		         	{$vsUser->obj->getAlias()} has sent you a message! 
		         	Click <a href="{$bw->vars['board_url']}/messages/inbox" title="Click here to read and reply your message">here</a> to read and reply!
		         	<br /><br />
		         
		         	-- iCampux Team --<br />
		         	<a href="{$bw->vars['board_url']}" title="{$bw->vars['board_url']}">{$bw->vars['board_url']}</a>
EOF;
			
				$email = new Emailer();
	
				$email->setTo($emails);
				$email->setFrom("noreply@icampux.com", "iCampux Team");
				$email->setSubject("New icampux.com message");
				$email->setBody($content);
				$email->sendMail();
			}
		}
		
		function delete(){
			global $bw, $vsPrint, $vsStd, $vsUser, $vsLang;

			
			$vsStd->requireFile(CORE_PATH.'messages/delivers.php');
			$deliver = new delivers();
			
			$lmIds = trim($bw->input['lm'], ',');
			if($lmIds){
				$vsStd->requireFile(CORE_PATH."messages/labelms.php");
				$labelm = new labelms();
				
				$labelm->setCondition('lmId in ('.$lmIds.')');
				$labelm->deleteObjectByCondition();
			}
			
			if($bw->input['da']=='da'){
				$bw->input['ajaxcallback'] = 'callback';
				$g = trim($bw->input['g'],",");
				if($g){
					$cond = "m.messageId = d.deliverMessage AND d.deliverRecipient = {$vsUser->obj->getId()} AND messageGroup in (".$g.")";
				
					$deliver->setTableName("message AS m, vsf_message_deliver AS d");
					$deliver->setCondition($cond);
					
					$array = array ('deliverStatus' => 0);
					$deliver->updateObjectByCondition($array);
					
					$cond = "messageUser = ".$vsUser->obj->getId()." AND messageGroup in (".trim($bw->input['g'],",").")";
					$this->module->setCondition($cond);
					$array = array ('messageStatus' => -1);
					$this->module->updateObjectByCondition($array);
				}
				
				$func =  $bw->input['curmod']? $bw->input['curmod']  : 'inbox';
				if($bw->input['curmod'] == 'label'){
					$bw->input[2] = $bw->input['curact'];
					return $this->output = $this->labellist(1).<<<EOF
						<script type='text/javascript'>
							$('.blockMsg').html('<h1>{$vsLang->getWords('message_delete','Your message has been deleted.')}</h1>');
						</script>
EOF;
				}
				if($bw->input['curmod'] == 'sent'){
					return $this->output = $this->sentlist(1).<<<EOF
						<script type='text/javascript'>
							$('.blockMsg').html('<h1>{$vsLang->getWords('message_delete','Your message has been deleted.')}</h1>');
						</script>
EOF;
				}
				
				return $this->output = $this->$func().<<<EOF
					<script type='text/javascript'>
						$('.blockMsg').html('<h1>{$vsLang->getWords('message_delete','Your message has been deleted.')}</h1>');
					</script>
EOF;
			}

			if($bw->input['deliverId']){
				$deliver->setCondition('deliverId in ('.$bw->input['deliverId'].') AND deliverRecipient = '.$vsUser->obj->getId());
				
				$array = array ('deliverStatus' => 0);
				$deliver->updateObjectByCondition($array);
			}

			if($bw->input['deliverCur']){
				$this->module->setCondition('messageId in ('.$bw->input['deliverCur'].')'." AND messageUser = ".$vsUser->obj->getId());
				$array = array ('messageStatus' => -1);
				$this->module->updateObjectByCondition($array);
				
				$deliver->setCondition('deliverMessage in ('.$bw->input['deliverCur'].') AND deliverRecipient = '.$vsUser->obj->getId());
				
				$array = array ('deliverStatus' => 0);
				$deliver->updateObjectByCondition($array);
			}

			if($bw->input['curmod'] == 'sent'){
				return $this->output = $this->sentlist(1).<<<EOF
					<script type='text/javascript'>
						$('.blockMsg').html('<h1>{$vsLang->getWords('message_delete','Your message has been deleted.')}</h1>');
					</script>
EOF;
			}
			$count = $this->countGroupMessage();
			if(!$count){
					$bw->input['coreinbox'] = 'ci';
					return $this->output = $this->inbox().<<<EOF
					<script type='text/javascript'>
						$('#campus_user_right').html($('#main_content_container').html());
						$('.blockMsg').html('<h1>{$vsLang->getWords('message_delete','Your message has been deleted.')}</h1>');
					</script>
EOF;
			}
			return $this->output = $this->detail($bw->input['detailURL'], 1).<<<EOF
					<script type='text/javascript'>
						$('.blockMsg').html('<h1>{$vsLang->getWords('message_delete','Your message has been deleted.')}</h1>');
					</script>
EOF;
		}
		
		function countGroupMessage(){
			global $bw, $vsUser;
			$cond = <<<EOF
				m.messageId = d.deliverMessage AND g.groupId = m.messageGroup AND 
				d.deliverStatus > 0 AND d.deliverRecipient = {$vsUser->obj->getId()} AND
				m.messageGroup = {$bw->input['objGroup']}
EOF;
			$this->module->setTableName("message AS m, vsf_message_deliver AS d, vsf_message_group AS g ");
			$this->module->setCondition($cond);
			$count = $this->module->getNumberOfObject();
			$this->module->resetQuery();
			$this->module->setTableName('message');
			return $count;
		}
		
		function spam(){
			global $bw;

			if($bw->input['sf'] == 'sf') return $this->setSpam();
			if($bw->input['spt'] == 'spd') return $this->spamdetail();
			
			$this->spamlist();
		}
		
		function spamlist($core = 0){
			global $bw, $vsPrint, $vsStd, $vsUser, $vsSettings;
			$reciptient = $vsUser->obj->getId();
			$cond = "
						m.messageGroup = g.groupId AND
						m.messageId = d.deliverMessage AND d.deliverStatus = -1
					";
			
			$this->module->setFieldsString("m.*, g.groupTitle, d.deliverId, d.deliverStatus, d.deliverPostdate, count(messageId) as cnt");
			$this->module->setTableName("message AS m, vsf_message_deliver AS d, vsf_message_group AS g");
			$this->module->setCondition($cond);
			$this->module->setGroupby("groupid");
			$this->module->setOrder('d.deliverPostdate DESC');
			
			$url = "messages/inbox"; $pIndex = 2; $size = $vsSettings->getSystemKey('inbox_quality', 10, 'message', 1);
			$data = $this->module->getAdvancePageList($url, $pIndex, $size, 0, "", "getId", 0, 2, array('gquality'=>'cnt', 'gtitle'=>'groupTitle', 'dstatus'=>'deliverStatus'));
			
			
			foreach($data['pageList'] as $message)
				$str .= $message->getUser().",";

			$str = trim($str, ",");
			$data['user'] = $this->getUserInfoById($str);
			
			if(!$data['current']) $data['current'] = 1;
			$count = count($data['pageList']);
			if($count)
			$data['pageStatus'] = (($data['current']-1)*$size + 1)." - ".(($data['current']-1)*($size)+$count);
			
			$option['main_content'] = $this->html->spam($data);
			if($core )return $this->output = $option['main_content'];
			
			$option['label'] = $this->userLabel();
			return $this->output = $this->html->mainspam($option);
		}
		
		function spamdetail(){
			global $vsPrint, $vsStd, $vsUser, $bw, $vsRelation;
			
			$trashurl = $bw->input[2];
			
			$query = explode('-',$trashurl);
			$mesId = abs(intval($query[count($query)-1]));
		
			if(!$mesId) return $this->spamlist(1);
			
			$this->module->getMessageObjectById($mesId);
			if(!$this->module->obj->getId()) return $this->spamlist(1);
			
			
			$cond = "m.messageId = d.deliverMessage AND d.deliverStatus = -1 AND messageType = 2 AND ".
					"d.deliverRecipient = ".$vsUser->obj->getId()." AND messageOriginal = ".$mesId."  AND messageId <> ".$mesId." AND messageGroup = ".$this->module->obj->getGroup();
			
			$this->module->setFieldsString("m.*, d.deliverId, d.deliverPostdate");
			$this->module->setTableName("message AS m, vsf_message_deliver AS d");
			$this->module->setOrder('messageType, messagePostdate DESC');
			$this->module->setCondition($cond);
		
			$url = "messages/trash/".$trashurl.'trt=trd';
			$size = 10; $index = 3;
			$option = $this->module->getArrPageList($url, $index, $size, 0, "", "messageId");
			$option['pageList'] = $this->convertArrToObj($option['pageList'], array('deliverId'=>'deliverId'));

			$objectId = $mesId;
			if($option['pageList'])
				$objectId = $objectId.",".implode(array_keys($option['pageList']), ",");

			$vsRelation->setTableName('message_file');
			$vsRelation->setCondition("objectId in (".$objectId.")");
			$vsRelation->setOrder("objectId");
			$array = $this->module->vsRelation->getArrayByCondition("", "objectId");
			
			if($array){
				foreach($array as $attfiles){
					foreach($attfiles as $attfile)
						$fileIds .=  $attfile['relId'].",";
				}

				global $vsFile;
				$vsFile->setCondition('fileId in ('.trim($fileIds,",").')');
				$fileOs = $vsFile->getObjectsByCondition();
	
				if($option['pageList']){
					foreach($array as $key => $attfiles){
						if(array_key_exists($key, $option['pageList']))
							foreach($attfiles as $attfile){
								$fileOs[$attfile['relId']]->setTitle(trim($fileOs[$attfile['relId']]->getTitle(), "~"));
								$option['pageList'][$key]->attfiles[] = $fileOs[$attfile['relId']];
							}
					}
				}
				foreach($array[$this->module->obj->getId()] as $attfile){
					$fileOs[$attfile['relId']]->setTitle(trim($fileOs[$attfile['relId']]->getTitle(), "~"));
					$this->module->obj->attfiles[] = $fileOs[$attfile['relId']];
				}
			}
// get recipient
			$vsStd->requireFile(CORE_PATH.'messages/delivers.php');
			$deliver = new delivers();
			
			$deliver->setFieldsString("deliverId, deliverRecipient");
			$deliver->setCondition('deliverMessage = '.$mesId);
			$option['recipient'] = $deliver->getObjectsByCondition('getRecipient');
			
			
			$userId = $this->module->obj->getUser().",";
			if($option['pageList'])
				foreach($option['pageList'] as $temp)
					$userId .= $temp->getUser().",";
			$userId .= implode(",", array_keys($option['recipient']));
			$option['user'] = $this->getUserInfoById(trim($userId,","));
			
			
			require_once(CORE_PATH."messages/labels.php");
			$label = new labels();
			
			$label->setCondition('labelStatus > 0 AND labelUser = '.$vsUser->obj->getId());
			$option['label'] = $label->getObjectsByCondition();
			
			
			return $this->output = $option['main_content'] = $this->html->spamdetail($this->module->obj, $option);
			
			$this->output = $this->html->mainlayout($option);
		}
		
		function setSpam(){
			global $bw, $vsPrint, $vsStd, $vsUser, $vsLang;
			
			$bw->input['ajaxcallback'] = 'callback';
			
			$func = $bw->input['curact'];
			
			$g = trim($bw->input['g'],",");
			if(!$g) return $this->output = <<<EOF
				<script>
				$.blockUI({
		        	css: {
		        		border: 'none',
            			padding: '50px',
			            backgroundColor: '#C0C0C0',
			            color: '#000',
			            cursor:'progress'
			        },
			        message: '<h1>There was an error. Redirecting to inbox ...</h1>',
			        
				});
				setTimeout(function(){
					$.unblockUI();
				}, 2000);
				</script>
EOF;
		
				
			$vsStd->requireFile(CORE_PATH.'messages/delivers.php');
			
			$deliver = new delivers();
			$cond = "m.messageId = d.deliverMessage AND d.deliverRecipient = {$vsUser->obj->getId()} AND messageGroup in (".$g.")";
		
			$deliver->setTableName("message AS m, vsf_message_deliver AS d");
			$deliver->setCondition($cond);
			
			$array = array ('deliverStatus' => -1);
			$deliver->updateObjectByCondition($array);
			
			$cond = "messageUser = ".$vsUser->obj->getId()." AND messageGroup in (".$g.")";
			$this->module->setCondition($cond);
			$array = array ('messageStatus' => -2);
			$this->module->updateObjectByCondition($array);

			$lmIds = trim($bw->input['lm'], ',');
			if($lmIds){
				$vsStd->requireFile(CORE_PATH.'messages/labelms.php');
				$labelm = new labelms();
				
				$labelm->setCondition('lmId in ('.$lmIds.')');
				$labelm->deleteObjectByCondition();
			}
			
			if($func == 'detail'){
				return $this->output = $this->$func($bw->input['so']).<<<EOF
				<script type='text/javascript'>
					$('.blockMsg').html('<h1>{$vsLang->getWords('message_spam','Your message has been update.')}</h1>');
				</script>
EOF;
			}
			return $this->output = $this->$func().<<<EOF
				<script type='text/javascript'>
					$('.blockMsg').html('<h1>{$vsLang->getWords('message_spam','Your message has been update.')}</h1>');
				</script>
EOF;
			
		}
		
		function draft(){
			global $bw;

			if($bw->input['mact'] == 'draft') return $this->sendDraft();
			if(in_array($bw->input['dt'], array(1, 2, 3, 4))) return $this->draftdetail($bw->input[2]);
			if($bw->input['d'] == 'd') return $this->saveDraft();
			if($bw->input['da'] == 'discard') return $this->discardDraft();
			$this->draftList();
		}

		function discardDraft(){
			global $bw, $vsStd, $vsPrint, $vsUser;
			
			$draftIds = $bw->input['do'];
			
			$draftIds = trim($draftIds, ",");
			if($draftIds){
				$vsStd->requireFile(CORE_PATH."messages/drafts.php");
				$draft = new drafts();
			
				$draft->setCondition("draftId in (".$draftIds.") AND draftUser = ".$vsUser->obj->getId());
				$draft->deleteObjectByCondition();
			}
			return $this->draftList();
		}
		
		function sendDraft(){
			global $bw, $vsStd, $vsPrint;
			$vsStd->requireFile(CORE_PATH."messages/drafts.php");
			$draft = new drafts();
			
			$type = 1;
			switch($bw->input['dat']){
				case 1:
				case 2:
						$type = 2;
					break;
				case 3:
						$type = 3;
					break;
				case 4:
				default:
						$type = 1;
					break;
					
			}
			
			$draft->deleteObjectById($bw->input['dao']);
			$this->sendMessage($type);
		}
		
		function draftdetail($draft = ""){
			global $bw, $vsPrint, $vsStd, $vsUser;
			$query = explode('-',$draft);
			$draftId = abs(intval($query[count($query)-1]));
			
			if(!$draftId) 
				return $this->output = $this->draftList(1);
	
			$vsStd->requireFile(CORE_PATH."messages/drafts.php");
			$draft = new drafts();
			
			$draft->setCondition("draftId = ".$draftId." AND draftUser = ".$vsUser->obj->getId());
			$draft->getOneObjectsByCondition();
			
			if(!$draft->obj->getId()) return $this->output = $this->draftList(1);

			$this->convertDraftToMessage($draft->obj);

			switch($draft->obj->getType()){
				case 1:
						$this->draftReply('ra');
					break;
				case 2:
						$this->draftReply();
					break;
				case 3:
						$this->draftForward();
					break;
				case 4:
				default:
						$this->draftCompose();
					break;
			}
		}
		
		function draftForward(){
			global $bw, $vsPrint, $vsLang, $vsUser;
			
			$bw->input['a']= 'f';
			$bw->input['draftaction'] = 'draftforward';


			$option['main_content'] = $this->draftReplyContent($this->module->obj->draftmessage, $this->module->obj->draftid, $this->module->obj->draftid);
			return $this->output = $option['main_content'];
		}
		
		function draftReply($replyall=""){
			global $bw, $vsPrint, $vsUser;
			
			$bw->input['a']= 'r';
			$bw->input['draftaction'] = 'draftreply';
			
			if($replyall) $bw->input['ra']= 'ra';
			
			$option['main_content'] = $this->draftReplyContent($this->module->obj->draftmessage, $this->module->obj->draftid, $this->module->obj->draftmessage);
			return $this->output = $option['main_content'];
		}
		
		function draftReplyContent($mesId, $draftid = 0, $draftmessage = 0){
			global $bw, $vsUser, $vsStd, $vsRelation;
			
			if($mesId){
				$module = new messages();
				$module->getMessageObjectById($mesId);
				
				$cond = "((m.messageId = d.deliverMessage AND d.deliverStatus > 0 AND messageType = 2 AND ".
						"d.deliverRecipient = ".$vsUser->obj->getId()." AND messageOriginal = ".$mesId.") OR 
						(messageUser = ".$vsUser->obj->getId()." AND messageStatus > 1 AND messageOriginal = 0)) AND 
						messageGroup = ".$module->obj->getGroup();
				
				$this->module->setFieldsString("m.*, d.deliverId, d.deliverPostdate");
				$this->module->setTableName("message AS m, vsf_message_deliver AS d");
				$this->module->setOrder('messageType, messagePostdate DESC');
				$this->module->setCondition($cond);
			
				$url = "messages/draft/".$bw->input[2];
				$size = 10; $index = 3;
				
				$option = $this->module->getArrPageList($url, $index, $size, 0, "", "messageId");
				$option['pageList'] = $this->convertArrToObj($option['pageList'], array('deliverId'=>'deliverId'));
	
				$objectId = $mesId;
				if($option['pageList'])
					$objectId = $objectId.",".implode(array_keys($option['pageList']), ",");
	
				if($objectId){
					$this->module->vsRelation->setTableName('message_file');
					$this->module->vsRelation->setCondition("objectId in (".$objectId.")");
					$this->module->vsRelation->setOrder("objectId");
					$array = $this->module->vsRelation->getArrayByCondition("", "objectId");
					
					if($array){
						foreach($array as $attfiles){
							foreach($attfiles as $attfile)
								$fileIds .=  $attfile['relId'].",";
						}
		
						global $vsFile;
						$vsFile->setCondition('fileId in ('.trim($fileIds,",").')');
						$fileOs = $vsFile->getObjectsByCondition();
			
						if($option['pageList']){
							foreach($array as $key => $attfiles){
								if(array_key_exists($key, $option['pageList']))
									foreach($attfiles as $attfile){
										$fileOs[$attfile['relId']]->setTitle(trim($fileOs[$attfile['relId']]->getTitle(), "~"));
										$option['pageList'][$key]->attfiles[] = $fileOs[$attfile['relId']];
									}
							}
						}
						if($array[$this->module->obj->getId()])
						foreach($array[$this->module->obj->getId()] as $attfile){
							$fileOs[$attfile['relId']]->setTitle(trim($fileOs[$attfile['relId']]->getTitle(), "~"));
							$this->module->obj->attfiles[] = $fileOs[$attfile['relId']];
						}
					}
				}
				
				$vsStd->requireFile(CORE_PATH.'messages/delivers.php');
				$deliver = new delivers();
				
				$deliver->setFieldsString("deliverId, deliverRecipient");
				$deliver->setCondition('deliverMessage = '.$mesId);
				$option['recipient'] = $deliver->getObjectsByCondition('getRecipient');
				
				$recipientId = "";
				if($option['recipient'])
					foreach($option['recipient'] as $obj)
						$recipientId .= $obj->getRecipient().",";
				$option['allrecipient'] = $recipientId.$this->module->obj->getUser();
				
				$userId = $module->obj->getUser().",";
				
				if($option['pageList'])
					foreach($option['pageList'] as $temp)
						$userId .= $temp->getUser().",";
				$userId .= implode(",", array_keys($option['recipient']));
				$option['user'] = $this->getUserInfoById(trim($userId,","));
			}
			$bw->input['dm'] = $draftmessage;
			$bw->input['draftdetail'] = 'draftdetail';
			
			$option['draftform'] = $this->objForm($mesId);
			$option['draftid'] = $draftid;
			
			return $this->html->draftdetail($module->obj, $option);
		}
		
		function draftCompose(){
			global $bw, $vsLang;
			
			$bw->input['a'] = 'c';
			$bw->input['draftaction'] = 'draftcom';
			
			$option['main_content'] = $this->objForm();
			return $this->output = $option['main_content'].<<<EOF
				$('#draftTop').addClass('phide');
      			$('#draftTopDetail').removeClass('phide');
EOF;
		}
		
		function draftList($core = 0){
			global $bw, $vsUser, $vsStd, $vsLang, $vsSettings;
			$vsStd->requireFile(CORE_PATH."messages/drafts.php");
			$draft = new drafts();
			
			$field = "(draftId) AS draftId, draftPostdate, draftTitle, draftContent, draftRecipient, draftOriginal, draftFiles, draftType, draftUser, draftGroup";
			$cond = "draftUser = ".$vsUser->obj->getId();
			$draft->setFieldsString($field);
			$draft->setCondition($cond);
			
//			$draft->setGroupby("draftOriginal, draftType");
			$url = "messages/draft"; $pIndex = 2; $size = $vsSettings->getSystemKey('draft_quality', 10, 'message', 1);
			$data = $draft->getPageList($url, $pIndex, $size);

			if(!$data['current']) $data['current'] = 1;
			
			$count = count($data['pageList']);
			if($count)
			$data['pageStatus'] = (($data['current']-1)*$size + 1)." - ".(($data['current']-1)*($size)+$count);
		
			$option['main_content'] = $this->html->draftList($data);
			if($core) return $this->output = $option['main_content'];
			return $this->output = $this->html->maindraft($option);
		}
		
		function saveDraft(){
			global $bw, $vsUser, $vsStd, $vsLang, $vsPrint;

			$array = array('ra'=>1, 'r'=>2, 'f' => 3, 'c' => 4);
			$type = $array[$bw->input['a']] ? $array[$bw->input['a']] : 4;
			if($bw->input['ra']) $type = 1;

			$vsStd->requireFile(CORE_PATH."messages/drafts.php");
			$draft = new drafts();
			$userId = $vsUser->obj->getId();
			if($type < 4){
				$cond = "draftType = ".$type." AND draftOriginal = ".$bw->input['messageOriginal']." AND draftUser = ".$userId;
				$draft->setCondition($cond);
				$draft->deleteObjectByCondition();
			}
			$time = time();
		
			$data['draftPostdate'] = $time;
			$data['draftTitle'] = $bw->input['messageTitle'];
			$data['draftContent'] = $bw->input['messageContent'];
			$data['draftRecipient'] = trim($bw->input['messageRecipient'], ","); 
			
			$data['draftOriginal'] = $bw->input['messageOriginal'];
			$data['draftFiles'] = trim($bw->input['attfiles'], ",");
			$data['draftType'] = $type;
			$data['draftUser'] = $userId;
			$data['draftGroup'] = $bw->input['messageGroup'];
			$data['draftMessage'] = $bw->input['dm'];
			
			$draft->obj->convertToObject($data);
			
			$data['a'] = $bw->input['a'];
			$data['ra'] = $bw->input['ra'];
			$this->buildCache($time, $data);
			
			$draft->insertObject();

			$bw->input['ajaxcallback'] = 'callback';
			if($draft->result['status']){
				if($bw->input['a'] == 'offertextbook')
					return $this->output = <<<EOF
								<script type='text/javascript'>
									$('.blockMsg').html('<h1>{$vsLang->getWords('save_draft','Your message has sent to draft')}</h1>');
									setTimeout(function(){
										$.unblockUI();
										$('#{$bw->input['popupId']}').dialog('close');
									}, 2000);
								</script>
EOF;
				if($bw->input['draftdetail'] == 'draftdetail')
					return $this->output = <<<EOF
											<script type='text/javascript'>
												$('.blockMsg').html('<h1>{$vsLang->getWords('save_draft','Your message has sent to draft')}</h1><br />Redirecting to draft');
												setTimeout(function(){
													$.unblockUI();
												}, 2000);
											</script>
EOF;
				if($type == 4){
					$bw->input[1] = 'inbox';
					return $this->output = $this->inbox().<<<EOF
											<script type='text/javascript'>
												$('.blockMsg').html('<h1>{$vsLang->getWords('save_draft','Your message has sent to draft')}</h1><br />Redirecting to inbox');
												$(document).ajaxStop(function(){
													setTimeout(function(){
														$.unblockUI();
													}, 1000);
												});
											</script>
EOF;
				}
				return $this->output = 
										<<<EOF
											<script type='text/javascript'>
												$('.blockMsg').html('<h1>{$vsLang->getWords('save_draft','Your message has sent to draft')}</h1>');
												setTimeout(function(){
													$('#editForm').remove();
													$.unblockUI();
												}, 2000);
											</script>
EOF;
			}
			
			return $this->output = <<<EOF
											<script type='text/javascript'>
												$('.blockMsg').html('<h1>{$vsLang->getWords('save_draft_fail','Error! try again later')}</h1>');
												setTimeout(function(){
													$.unblockUI();
												}, 2000);
											</script>
EOF;
		}
		
		function trash(){
			global $bw;

			if($bw->input['tra'] == 'trdel') return $this->delete();
			if($bw->input['tra'] == 'trs') return $this->savetrash();
			if($bw->input['tra'] == 'empty') return $this->emptytrash();
			if($bw->input['trt'] == 'trd') return $this->trashdetail();
			
			$this->trashList();
		}

		function trashList($core = 0){
			global $bw, $vsStd, $vsUser, $vsSettings;
			
			$reciptient = $vsUser->obj->getId();
			$cond = "
						m.messageGroup = g.groupId AND
						m.messageId = d.deliverMessage AND (d.deliverStatus = 0 OR messageStatus = -1) AND messageStatus <> -2
					";
			
			$this->module->setFieldsString("m.*, g.groupTitle, d.deliverId, d.deliverStatus, d.deliverPostdate, count(messageId) as cnt");
			$this->module->setTableName("message AS m, vsf_message_deliver AS d, vsf_message_group AS g");
			$this->module->setCondition($cond);
			$this->module->setGroupby("groupid");
			$this->module->setOrder('d.deliverPostdate DESC');
			
			$url = "messages/inbox"; $pIndex = 2; $size = $vsSettings->getSystemKey('inbox_quality', 10, 'message', 1);
			$data = $this->module->getAdvancePageList($url, $pIndex, $size, 0, "", "getId", 0, 2, array('gquality'=>'cnt', 'gtitle'=>'groupTitle', 'dstatus'=>'deliverStatus'));

			foreach($data['pageList'] as $message)
				$str .= $message->getUser().",";

			$str = trim($str, ",");
			$data['user'] = $this->getUserInfoById($str);
			
			if(!$data['current']) $data['current'] = 1;
			$count = count($data['pageList']);
			if($count)
			$data['pageStatus'] = (($data['current']-1)*$size + 1)." - ".(($data['current']-1)*($size)+$count);
			
		
			$option['main_content'] = $this->html->trash($data);
			
			if($core) return $this->output = $option['main_content'];
			
			$option['label'] = $this->userLabel();
			return $this->output = $this->html->maintrash($option);
		}
		
		function userLabel(){
			global $vsUser;
			require_once(CORE_PATH."messages/labels.php");
			$label = new labels();
			
			$label->setCondition('labelStatus > 0 AND labelUser = '.$vsUser->obj->getId());
			return $label->getObjectsByCondition();
		}
		
		function savetrash(){
			global $bw, $vsPrint, $vsStd, $vsUser, $vsLang;
			$vsStd->requireFile(CORE_PATH.'messages/delivers.php');
			
			$trod = trim($bw->input['trod'], ",");
			
			if($trod){
				$deliver = new delivers();
				$cond = "m.messageId = d.deliverMessage AND d.deliverRecipient = {$vsUser->obj->getId()} AND ".
						"messageGroup in (".trim($bw->input['g'],",").") AND messageId in (".$trod.")";
			
				$deliver->setTableName("message AS m, vsf_message_deliver AS d");
				$deliver->setCondition($cond);
				
				$array = array ('deliverStatus' => 0);
				$deliver->updateObjectByCondition($array);
				
				$lmIds = trim($bw->input['lm'], ',');
				if($lmIds){
					$vsStd->requireFile(CORE_PATH."messages/labelms.php");
					$labelm = new labelms();
					
					$labelm->setCondition('lmId in ('.$lmIds.')');
					$labelm->deleteObjectByCondition();
				}
			}

			if($bw->input['curmod'] == 'spam'){
				$html = $this->spamList(1);
			}
			return $this->output = $html.<<<EOF
				<script type='text/javascript'>
					$('.blockMsg').html("<h1>{$vsLang->getWords("trash_delete", "Your message has been deleted")}</h1>");
				</script>
EOF;
		}
		
		function emptytrash(){
			global $bw, $vsStd, $vsPrint, $vsUser, $vsLang;

			$userId = $vsUser->obj->getId();

			$total = 0;
			$strod = trim($bw->input['trod'], ",");
			if($strod){
				$vsStd->requireFile(CORE_PATH.'messages/delivers.php');
				$deliver = new delivers();
			
				$cond = "deliverMessage in (".$strod.") AND deliverStatus = 0 AND deliverRecipient = ".$userId;
				$deliver->setCondition($cond);
				$deliver->deleteObjectByCondition();

				$cond = "messageId in (".$strod.") AND messageUser = ".$userId;
				$this->module->setCondition($cond);
				$this->module->updateObjectByCondition(array('messageStatus'=>0));
			}
	
			$this->output = $this->trashList(1).<<<EOF
				<script type='text/javascript'>
					$('.blockMsg').html("<h1>{$vsLang->getWords("trash_delete", "Your message has been deleted")}</h1>");
				</script>
EOF;
		}
		
		function trashdetail(){
			global $vsPrint, $vsStd, $vsUser, $bw, $vsRelation;
			
			$trashurl = $bw->input[2];
			
			$query = explode('-',$trashurl);
			$mesId = abs(intval($query[count($query)-1]));
		
			if(!$mesId) return $this->trashList(1);
			
			$this->module->getMessageObjectById($mesId);
			if(!$this->module->obj->getId()) return $this->trashList(1);
			
			
			$cond = "m.messageId = d.deliverMessage AND ((d.deliverStatus = 0 AND messageType = 2 AND ".
					"d.deliverRecipient = ".$vsUser->obj->getId()." AND messageOriginal = ".$mesId.") OR 
					(messageUser = ".$vsUser->obj->getId()." AND messageStatus > -1 AND messageOriginal = 0)) AND messageId <> ".$mesId." AND messageGroup = ".$this->module->obj->getGroup();
			
			$this->module->setFieldsString("m.*, d.deliverId, d.deliverPostdate");
			$this->module->setTableName("message AS m, vsf_message_deliver AS d");
			$this->module->setOrder('messageType, messagePostdate DESC');
			$this->module->setCondition($cond);
		
			$url = "messages/trash/".$trashurl.'trt=trd';
			$size = 10; $index = 3;
			$option = $this->module->getArrPageList($url, $index, $size, 0, "", "messageId");
			$option['pageList'] = $this->convertArrToObj($option['pageList'], array('deliverId'=>'deliverId'));

			$objectId = $mesId;
			if($option['pageList'])
				$objectId = $objectId.",".implode(array_keys($option['pageList']), ",");

			$vsRelation->setTableName('message_file');
			$vsRelation->setCondition("objectId in (".$objectId.")");
			$vsRelation->setOrder("objectId");
			$array = $this->module->vsRelation->getArrayByCondition("", "objectId");
			
			if($array){
				foreach($array as $attfiles){
					foreach($attfiles as $attfile)
						$fileIds .=  $attfile['relId'].",";
				}

				global $vsFile;
				$vsFile->setCondition('fileId in ('.trim($fileIds,",").')');
				$fileOs = $vsFile->getObjectsByCondition();
	
				if($option['pageList']){
					foreach($array as $key => $attfiles){
						if(array_key_exists($key, $option['pageList']))
							foreach($attfiles as $attfile){
								$fileOs[$attfile['relId']]->setTitle(trim($fileOs[$attfile['relId']]->getTitle(), "~"));
								$option['pageList'][$key]->attfiles[] = $fileOs[$attfile['relId']];
							}
					}
				}
				foreach($array[$this->module->obj->getId()] as $attfile){
					$fileOs[$attfile['relId']]->setTitle(trim($fileOs[$attfile['relId']]->getTitle(), "~"));
					$this->module->obj->attfiles[] = $fileOs[$attfile['relId']];
				}
			}
// get recipient
			$vsStd->requireFile(CORE_PATH.'messages/delivers.php');
			$deliver = new delivers();
			
			$deliver->setFieldsString("deliverId, deliverRecipient");
			$deliver->setCondition('deliverMessage = '.$mesId);
			$option['recipient'] = $deliver->getObjectsByCondition('getRecipient');
			
			
			$userId = $this->module->obj->getUser().",";
			if($option['pageList'])
				foreach($option['pageList'] as $temp)
					$userId .= $temp->getUser().",";
			$userId .= implode(",", array_keys($option['recipient']));
			$option['user'] = $this->getUserInfoById(trim($userId,","));
			
			
			return $this->output = $option['main_content'] = $this->html->trashdetail($this->module->obj, $option);
		}
		
		function sent(){
			global $bw;
		
			if($bw->input['st'] == 'sd') return $this->sentdetail();
			$this->sentlist();
		}

		function sentlist($core = 0){
			global $bw, $vsStd, $vsUser, $vsSettings;
			
			$reciptient = $vsUser->obj->getId();
			$cond = "	m.messageGroup = g.groupId AND m.messageId = d.deliverMessage AND 
						m.messageOriginal = 0 AND m.messageUser = {$vsUser->obj->getId()} AND
						m.messageStatus > 2
					";
			
			$this->module->setFieldsString("m.*, g.groupTitle, d.deliverId, d.deliverStatus, d.deliverPostdate, count(messageId) as cnt");
			$this->module->setTableName("message AS m, vsf_message_deliver AS d, vsf_message_group AS g");
			$this->module->setCondition($cond);
			$this->module->setGroupby("groupid");
			$this->module->setOrder('d.deliverPostdate DESC');
			
			$url = "messages/inbox"; $pIndex = 2; $size = $vsSettings->getSystemKey('inbox_quality', 10, 'message', 1);
			$data = $this->module->getAdvancePageList($url, $pIndex, $size, 0, "", "getId", 0, 2, array('gquality'=>'cnt', 'gtitle'=>'groupTitle', 'dstatus'=>'deliverStatus'));
			
			$option['count'] = 0;
			foreach($data['pageList'] as $message)
				$str .= $message->getUser().",";
			$str = trim($str, ",");
			$data['user'] = $this->getUserInfoById($str);

			if(!$data['current']) $data['current'] = 1;
			$count = count($data['pageList']);
			if($count)
				$data['pageStatus'] = (($data['current']-1)*$size + 1)." - ".(($data['current']-1)*($size)+$count);
				
			$option['main_content'] = $this->html->sent($data);
		
			if($core) return $this->output = $option['main_content'];
			return $this->output = $this->html->mainsent($option);
		}
		
		function sentdetail(){
			global $vsPrint, $vsStd, $vsUser, $bw;
			
			$messageId = $bw->input[2];
			$query = explode('-',$messageId);
			$mesId = abs(intval($query[count($query)-1]));
			if(!$mesId) return $this->$this->sentlist();
			
			$this->module->setCondition('m.messageGroup = g.groupId AND messageUser = '.$vsUser->obj->getId(). " AND messageId = ".$mesId);
			$this->module->setTableName("message as m, vsf_message_group as g");
			$result = $this->module->getAdvanceOneObjectsByCondition('getId', 0, 2, array('gtitle'=>'groupTitle'));
			if(!$result) return $this->$this->sentlist();
			
			$cond = "m.messageId = d.deliverMessage AND ((d.deliverStatus > 0 AND messageType = 2 AND ".
					"d.deliverRecipient = ".$vsUser->obj->getId()." AND messageOriginal = ".$mesId.") OR 
					(messageUser = ".$vsUser->obj->getId()." AND messageStatus > 1 AND messageOriginal = 0)) AND messageId <> ".$mesId." AND messageGroup = ".$this->module->obj->getGroup();
			
			$this->module->setFieldsString("m.*, d.deliverId, d.deliverPostdate");
			$this->module->setTableName("message AS m, vsf_message_deliver AS d");
			$this->module->setOrder('messageType, messagePostdate DESC');
			$this->module->setCondition($cond);
		
			$url = "messages/sent/".$messageId.'&sd=sd';
			$size = 10; $index = 3;
			$option = $this->module->getArrPageList($url, $index, $size, 0, "", "messageId");
			$option['pageList'] = $this->convertArrToObj($option['pageList'], array('deliverId'=>'deliverId'));

			$objectId = $mesId;
			if($option['pageList'])
				$objectId = $objectId.",".implode(array_keys($option['pageList']), ",");

			$this->module->vsRelation->setTableName('message_file');
			$this->module->vsRelation->setCondition("objectId in (".$objectId.")");
			$this->module->vsRelation->setOrder("objectId");
			$array = $this->module->vsRelation->getArrayByCondition("", "objectId");
			
			if($array){
				foreach($array as $attfiles){
					foreach($attfiles as $attfile)
						$fileIds .=  $attfile['relId'].",";
				}

				global $vsFile;
				
				$vsFile->setCondition('fileId in ('.trim($fileIds,",").')');
				$fileOs = $vsFile->getObjectsByCondition();
	
				if($option['pageList']){
					foreach($array as $key => $attfiles){
						if(array_key_exists($key, $option['pageList']))
							foreach($attfiles as $attfile){
								$fileOs[$attfile['relId']]->setTitle(trim($fileOs[$attfile['relId']]->getTitle(), "~"));
								$option['pageList'][$key]->attfiles[] = $fileOs[$attfile['relId']];
							}
					}
				}
				foreach($array[$this->module->obj->getId()] as $attfile){
					$fileOs[$attfile['relId']]->setTitle(trim($fileOs[$attfile['relId']]->getTitle(), "~"));
					$this->module->obj->attfiles[] = $fileOs[$attfile['relId']];
				}
			}
			
// get recipient
			$vsStd->requireFile(CORE_PATH.'messages/delivers.php');
			$deliver = new delivers();
			
			$deliver->setFieldsString("deliverId, deliverRecipient");
			$deliver->setCondition('deliverMessage = '.$mesId);
			$option['recipient'] = $deliver->getObjectsByCondition('getRecipient');
			
			$recipientId = "";
			if($option['recipient'])
				foreach($option['recipient'] as $obj)
					$recipientId .= $obj->getRecipient().",";
			$option['allrecipient'] = $recipientId.$this->module->obj->getUser();
			
			$userId = $this->module->obj->getUser().",";
			if($option['pageList'])
				foreach($option['pageList'] as $temp)
					$userId .= $temp->getUser().",";
			$userId .= implode(",", array_keys($option['recipient']));
			$option['user'] = $this->getUserInfoById(trim($userId,","));
			
			return $this->output = $option['main_content'] = $this->html->sentdetail($this->module->obj, $option);
		}
		
		
		function buildCache($cachetime, $data = array()) {
			if(!is_dir(CACHE_PATH."tmp/message/"))
				mkdir(CACHE_PATH."tmp/message/", 0777, true );
			
			$data['cachetime'] = $cachetime;
			$cache_content  = "<?php\n";
			$cache_content .= "\$cache = ".var_export($data, true).";\n";
			$cache_content .= "?>";
			$cache_path = CACHE_PATH."tmp/message/".$cachetime.'.txt';
			$cache_content = preg_replace('/\s\s+/', '', $cache_content);
			$file = fopen($cache_path, "w");
			fwrite($file, $cache_content);
			fclose($file);
		}
		
		function convertArrToObj($input = array(), $expend = array()){
			foreach($input as $keyinput=>$temp){
				$obj = new Message();
				
				$obj->convertToObject($temp);
				foreach($expend as $key=>$exp){
					$obj->$key = $temp[$exp];
				}
				$result[$keyinput] = $obj;
			}
			return $result;
		}
		
		function convertDraftToMessage($draft){
			global $vsRelation;
			$this->module->obj->setTitle($draft->getTitle());
			$this->module->obj->setContent($draft->getContent());
			$this->module->obj->setOriginal($draft->getOriginal());
			$this->module->obj->setGroup($draft->getGroup());
			
			$this->module->obj->draftmessage = $draft->getMessage();
			$this->module->obj->drafttype = $draft->getType();
			$this->module->obj->draftid = $draft->getId();
			$this->module->obj->recipient = trim($draft->getRecipient(),", ");
			
			$fildId = $draft->getFiles();
			$this->module->obj->attfilesid = $fildId;
		
			if($fildId){
				global $vsFile;
				$vsFile->setCondition('fileId in ('.trim($fildId,",").')');
				$fileOs = $vsFile->getObjectsByCondition();
				foreach($fileOs as $attfile){
					$attfile->setTitle(trim($attfile->getTitle(), "~"));
					$this->module->obj->attfiles[] = $attfile;
				}
			}
			
			
		}
		
		function getUserInfoById($Ids = ""){
			if(!$Ids) return array();
			$user = new users();
			$user->setFieldsString("userId, userName, userAlias, userImage");
			$user->setCondition('userId in ('.$Ids.")");
			$users = $user->getObjectsByCondition();
			
			$data = array();
			foreach($users as $obj){
				$data[$obj->getId()]['name'] = $obj->getName();
				if($obj->getAlias())
					$data[$obj->getId()]['name'] = $obj->getAlias();
				$data[$obj->getId()]['image'] = $obj->getImage();
			}
			
			return $data;
		}
		
		
		
		
		
		protected $html;
		protected $module;
		protected $output;
		
		function __construct() {
			global $vsTemplate, $vsPrint, $vsUser, $vsLang, $bw;

			$this->module = new messages();
	        $this->html = $vsTemplate->load_template('skin_messages');

	       	if(!$vsUser->obj->getId()){
	       		if($bw->input[1] == 'popup'){
	       			 $temp =  <<<EOF
	       			 		<h1 style="margin: 10px;">You have to login first.</h1>
       						<script type='text/javascript'>
       							setTimeout(function(){
									location.href='{$bw->vars['board_url']}/users/login';
								}, 2000);
							</script>
EOF;
					echo ($temp); exit;
	       		}
	       		echo $this->output = $this->html->error('', $bw->vars['board_url']."/users/login");
	       		exit;
	       	}
		}
		
		function getOutput() {
			return $this->output;
		}
	
		function setOutput($output) {
			$this->output = $output;
		}
}
?>