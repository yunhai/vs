<?php

if ( ! defined( 'IN_VSF' ) ){
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit();
}

global $vsStd, $vsUser;
$vsStd->requireFile(CORE_PATH."users/users.php");


	$vsUser->authorize();
	class users_public{

	    function __construct(){
			global $bw, $vsTemplate, $vsPrint;
	    	$this->module = new users();
	    	
	    	if($bw->input['statuscomment'] == 'statuscomment'){
	    		if($bw->input[1] == 'info') $this->html = $vsTemplate->load_template('skin_usersstatus_info');
	        	else $this->html = $vsTemplate->load_template('skin_usersstatus');
	    	}
	        elseif($bw->input['userprofile'] == 'userprofile') $this->html = $vsTemplate->load_template('skin_usersprofile');
	        else$this->html = $vsTemplate->load_template('skin_users');
	        
	        $vsPrint->addCSSFile("users");
	    }
		
	    function auto_run(){
			global $bw;
			
			switch($bw->input['user_public_type']){
				case 'userprofile':
						$this->switchProfile();
					break;
				case 'statuscomment':
						$this->switchComment();
					break;
				case 'usersetting':
						$this->switchSetting();
					break;
				case 'useraccount':
						$this->switchAccount();
					break;
				default:
						$this->switchMain();
			}
		}
		
		function switchProfile(){
			global $bw;
			
			switch($bw->input[1]){
				case 'protab':
						$this->protab();
					break;
				default:
						$this->globalerror();
					break;
				case 'editprofile':
						$this->editProfile();
					break;
				case 'editedu':
						$this->editEdu();
					break;
				case 'editepro':
						$this->editEpro();
					break;
				case 'deleteepro':
						$this->deleteEpro();
					break;
				case 'deleteedu':
						$this->deleteEdu();
					break; 
				case 'editwork':
						$this->editWork();
					break;
				case 'deletework':
						$this->deleteWork();
					break;
				case 'editwpro':
						$this->editWpro();
					break;
				case 'deletewpro':
						$this->deleteWpro();
					break;
			}
		}
		
		function switchAccount(){
			global $bw;
			switch($bw->input[1]){
				case 'instant':
						$this->instant($bw->input[2]);
					break;
				case 'acctab':
						$this->acctab();
					break;
				
				case 'changname':
						$this->changeName();
					break;
				case 'changepassword':
						$this->changePassword();
					break;
				case 'changealias':
						$this->changeAlias();
					break;
	
				case 'changelt':
						$this->changelt();
					break;
					
				case 'changepa':
						$this->changepa();
					break;
					
				case 'changepi':
						$this->changepi();
					break;
					
				case 'changepipv':
						$this->changepipv();
					break;
					
				default:
						$this->globalerror();
					break;
			}
		}
		
		function switchComment(){
			global $bw;
			
			switch($bw->input[1]){
				case 'profile':
						$this->profile();
					break;
				case 'comment':
						$this->comment();
					break;
					
				case 'info':
						$this->info();
					break;	
					
				case 'friends':
						$this->friends();
					break;
					
				case 'filterfriends':
						$this->filterfriends();
					break;
			/////		
				case 'friendmanager':
						$this->friendManager();
					break;
					
				case 'connected':
						$this->connected();
					break;
					
				case 'unfriend':
						$this->unfriend();
					break;
				
				case 'requests':
						$this->requests();
					break;
					
				case 'acceptfriend':
						$this->makeFriendDecision(1);
					break;
				case 'rejectfriend':
						$this->makeFriendDecision();
					break;
					
				case 'findfriends':
						$this->findfriends();
					break;
					
				case 'lists':
						$this->lists();
					break;
					
				case 'addlist':
						$this->addlist();
					break;
					
				case 'askforfriend':
						$this->askForFriend();
					break;
					
				case 'delfromlist':
						$this->delFromList();
					break;
					
				case 'deletelist':
						$this->deleteList();
					break;
				case 'af2list':
						$this->af2list();	
					break;
				case 'invitefriends':
						$this->inviteFriends();
					break;
				case 'refer':
						$this->refer();
					break;
				case 'deleteupdate':
						$this->deleteUpdate();
					break;
				case 'editupdate':
						$this->editUpdate();
					break;
				case 'suggest':
						$this->instantsuggest();
					break;
				default:
						$this->globalerror();
					break;
			}
		}
		
		function switchMain(){
			global $bw;
			switch($bw->input[1]){
				case 'recover':
						$this->recoverPasswordForm();
					break;
				case 'renew':
						$this->renewPasswordForm();
					break;
						
				case 'changinfo':
						$this->changInfoProcess();
					break;
	
				case 'logout':
						$this->logoutProcess();
					break;	
				
				case '':
						$this->loadDefault();
					break;
					
				case 'signup':
						$this->signUpForm();
					break;
				case 'verifyemail':
						$this->verifyEmail();
					break;
				case 'updateCampus':
						$this->updateCampus();
					break;
				case 'instant':
						$this->instant($bw->input[2]);
					break;
				case 'login':
						$this->loginForm();
					break;
			}
		}
		
		function switchSetting(){
			global $bw;
			
			switch($bw->input[1]){
				default:
						$this->globalerror();
					break;
					
				case 'settingtab':
						$this->settingtab();
					break;
				case 'sprofile':
						$this->s_profile();
					break;
				case 'editsp':
						$this->edits_profile();
					break;
			}
		}
		
		function edits_profile(){
			global $bw, $vsStd, $vsUser;
			
			$userId = $vsUser->obj->getId();
			$sIds = implode(',', array_keys($bw->input['setting']));
			
			$vsStd->requireFile(CORE_PATH.'users/setting/usettings.php');
			$usetting = new usettings();
			
			$usetting->setFieldsString('settingId');
			$ucond = 'settingId IN ('.$sIds.') AND settingStatus > 0';
			$usetting->setCondition($ucond);
			$usList = $usetting->getArrayByCondition('settingId');
			
			$vsStd->requireFile(CORE_PATH.'users/setting/ususers.php');
			$usu = new ususers();
			
			$usuCond = 'usUser = '.$userId.' AND usSetting in ('.$sIds.')';
			$usu->setCondition($usuCond);
			$usuList = $usu->getArrayByCondition('usId');
			
			$flag = false;
			if($usuList){
				$query = 'UPDATE vsf_user_suser SET usValue = CASE usSetting ';
				foreach($bw->input['setting'] as $key=>$value){
					if(array_key_exists($key, $usList)){
						$subquery .= ' WHEN '.$key.' THEN '.$value;					
					}
				}
				$query = $query.$subquery.' END WHERE usSetting IN ('.implode(',', array_keys($bw->input['setting'])).') AND usUser = '.$userId;
				$flag = $usu->executeNoneQuery($query);
			}else{
				$data = array(); $index = 0;
				
				foreach($bw->input['setting'] as $key=>$value){
					if(array_key_exists($key, $usList)){
						$data[$index]['usUser'] = $userId;
						$data[$index]['usSetting'] = $key;
						$data[$index]['usValue'] = $value;
						$index++;
					}
				}
				$flag = $usu->multiInsert($data);
			}
			
			$message = 'Your settings have been saved.';
			if($flag) return $this->output = <<<EOF
					<div class='message' id='message'>
					{$message}
					</div>
					<script type='text/javascript'>
						$('s_profile_form_cb').addClass('message');
						setTimeout(function(){
				        	$('#s_profile_form_cb').toggle("slow", function(){	
								$('#s_profile_form_cb').html('');
								$('#s_profile_form_cb').removeClass('message');
							});
				        }, 2000);
					</script>
EOF;
		$message = 'Error! Please try again later.';
		return $this->output = <<<EOF
				<div class='message' id='message'>
				{$message}
				</div>
				<script type='text/javascript'>
					$('s_profile_form_cb').addClass('message');
					setTimeout(function(){
			        	$('#s_profile_form_cb').toggle("slow", function(){	
							$('#s_profile_form_cb').html('');
							$('#s_profile_form_cb').removeClass('message');
							
							setDefaultValue();
						});
			        }, 2000);
				</script>
EOF;
	}
	
		function settingtab(){
			global $bw;
	
			$option = array();
			if($bw->input['ajax'] && $bw->input['tab'] == 'settingtab') return $this->output = $this->html->coresettingtab($option);
			
			global $addon;
			$addon->importFilesForUserProfile();
			$this->output = $this->html->settingtab($option);
		}
		
		function s_profile(){
			global $bw, $vsStd, $vsUser;
			
			$vsStd->requireFile(CORE_PATH.'users/setting/usitems.php');
			$usitem = new usitems();
			
			
			$userId = $vsUser->obj->getId();
			$usitem->setFieldsString("i.*, settingTitle, usValue");
			$usitem->setTableName('user_sitem as i, vsf_user_sgroup, vsf_user_setting LEFT JOIN vsf_user_suser ON (usSetting = settingId AND usUser = '.$userId.')');
			$cccond = " i.itemSetting = settingId AND sgId = settingGroup AND
						settingStatus > 0 AND i.itemStatus > 0 AND sgKey = 'profile'
					  ";
			
			$usitem->setCondition($cccond);
			$usitem->setOrder('settingIndex, itemIndex');
			$option['profile']['sItem'] = $usitem->getArrayByCondition('itemId', 'itemSetting');
			
			$sName = array();
	
			foreach($option['profile']['sItem'] as $key => $setting){
				foreach($setting as $sId => $sItem){
					$sName[$key] = $sItem['settingTitle'];
					if($sItem['usValue']){
						$default[$key] = $sItem['usValue'];
						break;
					}
									
					if($sItem['itemDefault']){
						$default[$key] = $sId;
						break;
					}
				}
				
			}
			$option['profile']['sName'] = $sName;
			$option['profile']['sDefault'] = $default;
	
			$this->output = $this->html->s_profile($option);
		}
	
	
	
	
		function editupdate(){
			global $bw, $vsUser, $vsStd;
						
			$vsStd->requireFile(CORE_PATH.'status/comments.php');
			$comment = new comments();
			
			$cId = $bw->input['id'];
			$cond = 'commentId = '.$cId.' AND (commentUser = '.$bw->input['profile'].' OR commentProfile = '.$bw->input['profile'].') AND commentTime > ' . (time() - 3600);
			
			$comment->setCondition($cond);
			$result = $comment->getArrayByCondition();
			
			if(!$result) return $this->output = <<<EOF
				This update cannot be edited.
				<script type='text/javascript'>
					setTimeout(function(){
			        	$('#cec{$cId}').toggle("slow", function(){	
							$('#comment_content{$cId}').html($('#cec{$cId}temp').html());
							bindEditButtonClick();
						});
			        }, 2000);
				</script>
EOF;
			
			$cond = 'commentId = '.$cId;			
			$comment->setCondition($cond);
			$comment->updateObjectByCondition(array('commentContent' => $bw->input['cedit'], 'commentLastUpdate' => time()));
			 
			return $this->output = <<<EOF
				<script type='text/javascript'>
					$('#comment_content{$cId}').html('{$bw->input['cedit']}');
			        $('#cec{$cId}').toggle("slow", function(){});
			        $('#comment_date{$cId}').after(" [Last modified: few seconds ago] ");
			        bindEditButtonClick();
				</script>
EOF;
		}
	
		function deleteUpdate(){
			global $bw, $vsUser, $vsStd;
						
			$vsStd->requireFile(CORE_PATH.'status/comments.php');
			$comment = new comments();
			
			$cId = $bw->input[2];
			$cond = 'commentId = '.$cId.' AND (commentUser = '.$bw->input['profile'].' OR commentProfile = '.$bw->input['profile'].')';
			
			$comment->setCondition($cond);
			$result = $comment->getArrayByCondition();
			
			if(!$result) return $this->output = <<<EOF
				<div id='message'>Error! Try again later.</div>
				<script type='text/javascript'>
					setTimeout(function(){
			        	$('#{$bw->input[2]}cb').toggle("slow", function(){			 
							$(this).remove();
						});
			        }, 2000);
				</script>
EOF;
			
			$cond = 'commentId = '.$bw->input[2];			
			if($bw->input['cl'] == 0) $cond = '('.$cond.' OR commentGroup = '.$bw->input[2].')';
			if($bw->input['cl'] > 0) $cond = '('.$cond.' OR commentOriginal = '.$bw->input[2].')';
			
			$comment->setCondition($cond);
			$comment->deleteObjectByCondition();
			
			$subEle = '';
			if($bw->input['cl'] == 0) $subEle = 'update';
			
			$message = 'This message has been deleted';
			return $this->output = <<<EOF
				<div id='message'>{$message}</div>
				<script type='text/javascript'>
					setTimeout(function(){
			        	$('#{$subEle}{$bw->input[2]}').toggle("slow", function(){
							$(this).remove();
						});
			        }, 2000);
				</script>
EOF;
		}
	

		function filterfriends(){
			global $bw, $vsUser, $vsStd;

			
			$vsStd->requireFile(CORE_PATH.'status/friends.php');
			
			$user = new users();
			$user->setTableName('user, vsf_friend');
			
			$subcond = "(userName LIKE '".$bw->input['qname']."%' OR userAlias LIKE '".$bw->input['qname']."%' OR userFullname LIKE '".$bw->input['qname']."')";
			if($bw->input['criteria'] == 'email') $subcond = "userName LIKE '".$bw->input['qname']."%'";
			elseif($bw->input['criteria'] == 'name') $subcond = "userAlias LIKE '".$bw->input['qname']."%'";
			elseif($bw->input['criteria'] == 'fname') $subcond = "userFullname LIKE '%".$bw->input['qname']."%'";
			
			$ucond = "userId = profileUser AND friendFriend = userId AND friendUser = ".$bw->input['profile']." AND ".$subcond." AND friendStatus > 0";
			$user->setCondition($ucond);
			
			
			$user->setFieldsString('userAlias, userCampusId, userFullname, userImage, profileLocation, userId');
			$user->setTableName('user, vsf_user_profile, vsf_friend');
			
			
			$option['pageList'] = $user->getArrayByCondition('userId');
			global $vsTemplate;
			
			$campusList = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
			
			foreach($option['pageList'] as $key => $value){
					$ctitle = '';
					if($campusList[$value['userCampusId']]) $ctitle = $campusList[$value['userCampusId']]->getTitle();
					$option['pageList'][$key]['userCampusId'] = $ctitle;
					
					$option['pageList'][$key]['userImage'] = $user->obj->createImageCache($value['userImage'], 50, 50, 0, 1);
			}
			
			
			
	
			$this->output = $this->html->filterfriends($option);
		}
	
	
		function refer(){
			global $bw, $vsStd;
			
			$email1 = explode("<br />", $bw->input['emails']);
			$emails = array_merge($email1);
			
			
			foreach($emails as $key=>$element){
				if($element)
					$estr .= "'".$emails."',";
				else unset($emails[$key]);
			}
			
			$cond = 'userEmail in ('.trim($estr,',').')';
			$user = new users();
			
			$user->setCondition($cond);
			$result = $user->getArrayByCondition('userEmail');
			
			$data = array(); $index = 0;
			
			$userId = $bw->input['profile'];
			
			foreach($emails as $element){
				if($result[$element]) continue;
				$time = time();
				$data[$time]['refUser'] = $userId;
				$data[$time]['refEmail'] = $element;
				$data[$time]['refTime'] = $time;
			}
			

			$vsStd->requireFile(CORE_PATH.'friendsgroups/referrals.php');
			$ref= new referrals();
	
			$flag = false;
			if($data) $flag = $ref->multiInsert($data);
			
			$message = 'Error! Try again later';
			if($flag){
				$message = 'Email has been sent';
				$this->sendReferralEmail($emails);
			}

			$this->output = <<<EOF
				<div id='message'>{$message}</div>
				<script type='text/javascript'>
					setTimeout(function(){
			        	$('#message').toggle("slow", function(){
							$(this).remove();
							$('#emails').val('');
						});
						
			        }, 2000);
				</script>
EOF;
		}
	
		function sendReferralEmail($recipients = array()){
			global $vsStd, $bw, $vsUser;
			$vsStd->requireFile(LIBS_PATH."Email.class.php");
			$email = new Emailer();
	
			foreach($recipients as $key=>$element){
			$content = <<<EOF
				<a href="{$bw->vars['board_url']}" title='iCampux'>
				<img src="{$bw->vars['img_url']}/logo.jpg" alt='{$bw->vars['board_url']}'/>
				</a><br />
				Hello!
				Your friend, <a href='{$bw->vars['board_url']}/{$vsUser->obj->getAlias()}' title="{$vsUser->obj->getFullname()}'s profile">{$vsUser->obj->getFullname()}</a>, refers you to icampux.com.<br /><br />
				
				Click <a href="{$bw->vars['board_url']}/users/signup/&ref={$vsUser->obj->getAlias()}&invite={$vsUser->obj->getId()}&t={$key}" title="Click here to register an account">here</a>
				to register an account on icampux.com. <br /><br />
			
				Alternatively, you can click this link to register an account: 
				<a href="{$bw->vars['board_url']}/users/signup/&ref={$vsUser->obj->getAlias()}&invite={$vsUser->obj->getId()}&t={$key}" title="Click here to register an account">
					{$bw->vars['board_url']}/users/signup/&ref={$vsUser->obj->getAlias()}&invite={$vsUser->obj->getId()}&t={$key}
				</a>
				<br /><br />
		         
	         	-- iCampux Team --<br />
	         	<a href="{$bw->vars['board_url']}" title="{$bw->vars['board_url']}">{$bw->vars['board_url']}</a>
	         	
EOF;
			
				$email->setTo($element);
				$email->setFrom('noreply@icampux.com', 'icampux.com');
				$email->setSubject($vsUser->obj->getFullname().' refers you to join iCampux.com');
				$email->setBody($content);
				$email->sendMail();
			}
		}
		
		function inviteFriends(){
			$this->output = $this->html->inviteFriends();
		}
	
		function af2list(){
			global $bw, $vsStd;
			
			
			$l = $bw->input['l']; $uId = $bw->input['profile'];
			
			$vsStd->requireFile(CORE_PATH.'friendsgroups/groups.php');
			$group = new groups();
			$gCond = "groupId = ".$l." AND groupUser = ".$uId;
			$group->setCondition($gCond);
			
			$group->setFieldsString('groupId');
			$temparr = $group->getArrayByCondition('groupId');
			if(!$temparr) return $this->output = <<<EOF
					<script type='text/javascript'>
						$('#{$l}_addform_cb').html('<div id="message" class="message">Group doesnot exist</div>');
						setTimeout(function(){
				        	$('#message').toggle("slow", function(){
								$('#message').remove();
							});
				        }, 2000);
					</script>
EOF;
			
			
			$user = new users();
			$fIdArr = array_keys($user->convertNameToId($bw->input['gname']));
			
			$vsStd->requireFile(CORE_PATH.'status/friends.php');
			$friend = new friends();
			
			$frId = $friend->getUserFriendIds($uId);
			$flist = explode(',', $frId);
			$dif = array_diff($fIdArr, $flist);
		
			$fIds = "";
			foreach($fIdArr as $key => $element)
				if(!in_array($element, $dif))
					$fIds .= $element.',';
				
			$fIds = trim($fIds, ",");
			$message = 'This user is not in your friend';
			
			if($fIds){
				$vsStd->requireFile(CORE_PATH.'friendsgroups/gds.php');
				$gd = new gds();
				
				$cond = "gdGroup = ".$l.' AND gdFriend in ('.$fIds.')';
				$gd->setCondition($cond);
				$result = $gd->getArrayByCondition('gdFriend');

				$data = array(); $index = 0;
				foreach(explode(',', $fIds) as $id){
					if($result[$id]) continue;

					$data[$index]['gdGroup'] = $l;
					$data[$index]['gdFriend'] = $id;
					$index++;
				}
				
		
				$flag = 0; $message = 'This user is in your list';
				if($data){
					$flag = $gd->multiInsert($data);
				
					if($flag){
						$notin = trim($notin, ',');
						
						$user->setFieldsString('userAlias, userCampusId, userFullname, userImage, profileLocation, gdId, gdGroup, gdFriend, userId');
						$user->setTableName('user, vsf_friend_group_detail, vsf_user_profile');
					
						$ucond = 'userId = profileUser AND userId = gdFriend AND gdGroup in ('.$l.')';
						
						$user->setCondition($ucond);
						$user->setOrder('userAlias');
						
						$option['pageList'] = $user->getArrayByCondition('gdFriend');
	
						
						global $vsTemplate;
					
						$campusList = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
					
						foreach($option['pageList'] as $key => $value){
							$ctitle = '';
							if($campusList[$value['userCampusId']]) $ctitle = $campusList[$value['userCampusId']]->getTitle();
							$option['pageList'][$key]['userCampusId'] = $ctitle;
							
							$option['pageList'][$key]['userImage'] = $user->obj->createImageCache($value['userImage'], 50, 50, 0, 1);
						}
						
						$option['list'] = $l;
				
						return $this->output = $this->html->af2list($option);
					}
					$message = 'Error! Try again later';
				}
			}
			
			return $this->output = <<<EOF
					<script type='text/javascript'>
						$('#{$l}_addform_cb').html('<div id="message" class="message">{$message}</div>');
						setTimeout(function(){
				        	$('#{$l}_addform_cb').toggle("slow", function(){
								$('#message').remove();
							});
				        }, 2000);
					</script>
EOF;
		}
		
	
		function deleteList(){
			global $bw, $vsStd, $vsUser;
			
			$l = $bw->input['l'];
			
			$dcond = 'groupId = '.$l;
			$vsStd->requireFile(CORE_PATH.'friendsgroups/groups.php');
			$g = new groups();
			$g->setCondition($dcond);
			$result = $g->deleteObjectByCondition();
			
			if($result){
				$dcond = 'gdGroup = '.$l;
				$vsStd->requireFile(CORE_PATH.'friendsgroups/gds.php');
				$gds = new gds();
				$gds->setCondition($dcond);
				$result = $gds->deleteObjectByCondition();
				
			
				if($result){
					$message = 'List has been removed';
					$fmc = $this->fmAnalytic_list($vsUser->obj->getId());
				
					$contabtitle = 'List';
					if($fmc) $contabtitle .= ' ('.$fmc.')';
					return $this->output = <<<EOF
							<script type='text/javascript'>
								$('#accordion_{$l}cb').html("<div id='message' class='message'>{$message}</div>");
								setTimeout(function(){
						        	$('#dd_accordion_{$l}').toggle("slow", function(){
										$('#dd_accordion_{$l}').remove();
										$('#dt_accordion_{$l}').remove();
										$('#global_callback').html('');
									});
						        }, 2000);
						        $('#listabtitle').html('{$contabtitle}');
							</script>
EOF;
				}
			}
			$message = 'Error! Try again later';
			return $this->output = <<<EOF
						<script type='text/javascript'>
							$('#accordion_{$l}cb').html("<div id='message' class='message'>{$message}</div>");
						</script>
EOF;
		}
		
		function delFromList(){
			global $bw, $vsStd;
			
			$f = $bw->input['f'];
			$gd = $bw->input['gd'];
			$dcond = 'gdId = '.$gd;
			$vsStd->requireFile(CORE_PATH.'friendsgroups/gds.php');
			$gds = new gds();
			$gds->setCondition($dcond);
			$result = $gds->deleteObjectByCondition();
				
			
			if($result){
				$message = $bw->input['un'].' has been removed form list';
				
				return $this->output = <<<EOF
						<script type='text/javascript'>
							$('#{$gd}cb').html('<div id="message">{$message}</div>');
							setTimeout(function(){
					        	$('#{$gd}').toggle("slow", function(){
									$(this).remove();
								});
					        }, 2000);
						</script>
EOF;
			}
			$message = 'Error! Try again later';
			return $this->output = <<<EOF
					<script type='text/javascript'>
						$('#{$gd}cb').html('<div id="message">{$message}</div>');
						setTimeout(function(){
					        	$('#message').toggle("slow", function(){
									$(this).remove();
								});
					        }, 2000);
					</script>
EOF;
		}
	
		function addlist(){
			global $bw, $vsStd;
			
			$userId = $bw->input['profile'];
		
			$tarr = explode(",", $bw->input['gname']);
		
			foreach($tarr as $gn) $gname .= "'".trim($gn)."',";
			
			$gname = trim($gname, ",");
				
			$vsStd->requireFile(CORE_PATH.'friendsgroups/groups.php');
			$g = new groups();

			$gcond = 'groupTitle in ('.$gname.') AND groupUser = '.$userId;
			$g->setCondition($gcond);
			$return = $g->getArrayByCondition('groupTitle');
	
		
			$index = 0;
			foreach($tarr as $gn){
				$gn = strtolower(trim($gn));
				if($return[$gn]) continue;
				$data[$index]['groupTitle'] = trim($gn);
				$data[$index]['groupUser'] = $userId;
				$index++;
			}
			
			$message = 'Group already existed';
			if($index) $result = $g->multiInsert($data);
			
			$temp = "";
			if($result){
				$fmc = $this->fmAnalytic_list($userId);
				
				$contabtitle = 'List';
				if($fmc) $contabtitle .= ' ('.$fmc.')';
				return $this->output = <<<EOF
					<script type='text/javascript'>
						$('#gname').val('');
						vsf.get('yunhaihuang/lists/&m=ml','accordion');
						$('#listabtitle').html('{$contabtitle}');
					</script>
EOF;
			}
			$this->output = <<<EOF
				<div id='message'>{$message}</div>
				<script type='text/javascript'>
					setTimeout(function(){
			        	$('#message').toggle("slow", function(){
							$('#cbtemp').html('');
						});
			        }, 2000);
				</script>
EOF;
		}
		
		function lists($core = false){
			global $bw, $vsUser, $vsStd;
			
			$userId = $bw->input['profile'];
			if(!$userId) return $this->output = 'error';
			
			$option = array();
		
			$vsStd->requireFile(CORE_PATH.'friendsgroups/groups.php');
			$g = new groups();
			
			$gcond = "groupUser = ".$userId;
			$g->setCondition($gcond);
			$gs = $g->getArrayByCondition('groupId');
			$gIds = implode(",", array_keys($gs));
			if($gIds){
				$user = new users();
				$user->setFieldsString('userAlias, userCampusId, userFullname, userImage, gdId, gdGroup, gdFriend, profileLocation, userId');
				$user->setTableName('user, vsf_friend_group_detail, vsf_user_profile');
				
				$ucond = 'userId = profileUser AND userId = gdFriend AND gdGroup in ('.$gIds.')';
				$user->setCondition($ucond);
				$user->setOrder('userAlias');
				
				$option['pageList'] = $user->getArrayByCondition('gdFriend', 'gdGroup');
				global $vsTemplate;
				
				$campusList = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
				
				foreach($option['pageList'] as $mkey => $mvalue){
					foreach($mvalue as $key => $value){
						$ctitle = '';
						if($campusList[$value['userCampusId']]) $ctitle = $campusList[$value['userCampusId']]->getTitle();
						$option['pageList'][$mkey][$key]['userCampusId'] = $ctitle;
						
						$option['pageList'][$mkey][$key]['userImage'] = $user->obj->createImageCache($value['userImage'], 50, 50, 0, 1);
					}
				}
				$option['groups'] = $gs;
			}
				
			if($core) return $option;
			if($bw->input['m'] == 'ml'){
				$html = $this->html->mainlists($option); 
				return $this->output = <<<EOF
					<div id='message' class='message'>Group(s) added.</div>
					{$html}
					<script>
						setTimeout(function(){
				        	$('.message').toggle("slow", function(){
								$(this).remove();
							});
				        }, 2000);
					</script>
EOF;
			}
			$this->output = $this->html->lists($option);
		}
	
		
		function instantsuggest(){
			global $bw, $vsUser;

			$result = array();
			
			$u = $bw->input['q'];
			
			$this->module->setFieldsString('userId, userAlias, userName');
			$cond = "(userAlias LIKE '".$u."%' OR userName LIKE '".$u."%') AND friendUser = ".$vsUser->obj->getId()." AND friendStatus > 0 AND friendFriend = userId";
			$this->module->setCondition($cond);
			
			$this->module->setTableName('user, vsf_friend');
			
			$result = $this->module->getArrayByCondition('userId');
			
			
			if($bw->input['js']){
				$js =array();
				$index = 0;
				foreach($result as $key => $value){
					if($value['userAlias'])
						$js[$index++] = array('id'=>$value['userAlias'], 'name'=>$value['userAlias']);
					if($value['userName'])
						$js[$index++] = array('id'=>$value['userName'], 'name'=>$value['userName']);
				}
				echo $this->output = $_GET["callback"] . "" . json_encode($js). "";
			}else{
				foreach($result as $v)
					echo $v['userAlias']."\n";
			}
			exit;
		}
	
		
		function askForFriend($friendId = 0){
			global $bw, $vsUser, $vsLang, $vsStd;
	
			$f = $bw->input['f'];
			if(!$bw->input['un']){
				$message = 'This username does not exists!';
				return $this->output = <<<EOF
					<div class='message' id='message'>{$message}</div>
					<script type='text/javascript'>
						setTimeout(function(){
				        	$('#message').toggle("slow", function(){
								$(this).remove();
							});
				        }, 2000);
					</script>
EOF;
			}
			
			$user = new users();
			$unIds = $user->convertNameToId($bw->input['un']);
			
			$fIds = implode(",", array_keys($unIds));
			
			$vsStd->requireFile(CORE_PATH.'status/friends.php');
			$friend = new friends(); //nguoi bi ask
			
			$userId = $vsUser->obj->getId(); //nguoi ask for friend
			
			
			$cond = "friendUser = ".$userId.' AND friendFriend IN ('.$fIds.')';
			$friend->setCondition($cond);
			$result = $friend->getObjectsByCondition();
			if($result){
				$message = $message = 'This username has been your friend';
				return $this->output = $message;
			}
			
			$time = time(); $index = 0;
			foreach($unIds as $friendId => $value){
				$data[$index]['friendUser'] = $userId;
				$data[$index]['friendFriend'] = $friendId;			
				$data[$index]['friendTime'] = $time;
				$index++;
			}
			
			$objId = 0;
			$iresult = $friend->multiInsert($data);
			if($iresult){
				$message = 'Your request has been sent';
				return $this->output = <<<EOF
					<div class='message' id='message'>{$message}</div>
					<script type='text/javascript'>
						setTimeout(function(){
				        	$('#{$f}').toggle("slow", function(){
								$(this).remove();
							});
				        }, 2000);
					</script>
EOF;
			}
			$message = $vsLang->getWords('askforfiend_addfriend_error','Add friends error');
			return $this->output = <<<EOF
					<div class='message' id='message'>{$message}</div>
					<script type='text/javascript'>
						setTimeout(function(){
				        	$('#message').toggle("slow", function(){
								$(this).remove();
							});
				        }, 2000);
					</script>;
EOF;
		}
	
		function findfriends(){
			global $bw, $vsSettings, $vsUser, $vsStd;
		
			if($bw->input['instant'] != 'ffriend')
				return $this->output = $this->html->findfriends();

			$vsStd->requireFile(CORE_PATH.'status/friends.php');
			$friend = new friends();
			
			$fIds = $friend->getUserFriendIds($vsUser->obj->getId(), -1);
			$fIds .= ','.$vsUser->obj->getId();
			$fIds = trim($fIds, ',');
			
			$user = new users();
			
			$ucond = "userId = profileUser AND userId NOT IN (".$fIds.") AND (userName LIKE '".$bw->input['qname']."%' OR userAlias LIKE '".$bw->input['qname']."%' OR userFullname LIKE '%".$bw->input['qname']."%') ";
			$user->setCondition($ucond);
			
			$user->setTableName('user, vsf_user_profile');
			$url = $vsUser->obj->getAlias().'/searchfriend';
			$size = $vsSettings->getSystemKey('search_friend_quality', 5, 'friends', 1);
			$pIndex = 2;
			$option['pageList'] = $user->getArrayByCondition('userId');

			global $vsTemplate;
			$campusList = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
			
			foreach($option['pageList'] as $key => $value){
				$ctitle = '';
				if($campusList[$value['userCampusId']]) $ctitle = $campusList[$value['userCampusId']]->getTitle();
				$option['pageList'][$key]['userCampusId'] = $ctitle;
				
				$option['pageList'][$key]['userImage'] = $user->obj->createImageCache($value['userImage'], 50, 50, 0, 1);
			}
			
			$this->output = $this->html->mainfindfriends($option);
		}
	
		function makeFriendDecision($decision = 0){
			global $bw, $vsUser;
		
			$user = new users();
			$fIds = implode(",", array_keys($user->convertNameToId($bw->input['un'])));
			
			
			$f = $bw->input['f'];
			if(!$fIds){
				$message = 'Error! Try again later';
				return $this->output = <<<EOF
					<div id='message' class='message'>{$message}</div>
					<script type='text/javascript'>
						setTimeout(function(){
				        	$('#message').toggle("slow", function(){
								$(this).remove();
							});
				        }, 2000);
			        </script>
EOF;
			}
			global $bw, $vsStd, $vsUser, $vsLang;
			$vsStd->requireFile(CORE_PATH.'status/friends.php');
			$friend = new friends();
			
			$cond = 'friendId = '.$f.' AND friendFriend = '.$vsUser->obj->getId();
			$friend->setCondition($cond);
			$result = $friend->getObjectsByCondition();
			
			if(!$result){
				$message = 'Error! Try again later';
				return $this->output = <<<EOF
					<div id='message' class='message'>{$message}</div>
					<script type='text/javascript'>
						setTimeout(function(){
				        	$('#message').toggle("slow", function(){
								$(this).remove();
							});
				        }, 2000);
			        </script>
EOF;
			}
// accept friend request
			if($decision){
				$friend->setCondition($cond);
				$friend->updateObjectByCondition(array('friendStatus' => 1));
				
				$cond = 'friendId = '.$vsUser->obj->getId().' AND friendFriend in ('.$f.')';
				$friend->setCondition($cond);
				$result1 = $friend->getObjectsByCondition();
				
				$data = array(); $index = 0;
				foreach($result as $key => $element){
					if($element->getStatus() || $result1[$key]) continue;
					$data[$index]['friendUser'] = $element->getFriend(); 
					$data[$index]['friendFriend'] = $element->getUser();
					$data[$index]['friendTime'] = $element->getTime();
					$data[$index]['friendStatus'] = 1;
					
					$index++;
				}
				if($data) $iresult = $friend->multiInsert($data);
				
				if($iresult){
					$fmc = $this->fmAnalytic_request($vsUser->obj->getId());
	
					$contabtitle = 'Requests';
					if($fmc) $contabtitle .= ' ('.$fmc.')';
				
					return $this->output = <<<EOF
						<div id='message'><b>{$bw->input['un']}</b> has been your friend now</div>
						<script type='text/javascript'>
							setTimeout(function(){
					        	$('#request{$f}').toggle("slow", function(){
									$(this).remove();
									$('#reqtabtitle').html('{$contabtitle}');
								});
					        }, 2000);
						</script>
EOF;
				}
				$message = 'Error! Try again later';
				return $this->output = <<<EOF
					<div id='message' class='message'>{$message}</div>
					<script type='text/javascript'>
						setTimeout(function(){
				        	$('#message').toggle("slow", function(){
								$(this).remove();
							});
				        }, 2000);
			        </script>
EOF;
			}
// deny friend request
			$dcond = 'friendId in ('.$f.')';
			
			$friend->setCondition($dcond);
			$dresult = $friend->deleteObjectByCondition();
			if($dresult){
				$fmc = $this->fmAnalytic_request($vsUser->obj->getId());
		
				$contabtitle = 'Requests';
				if($fmc) $contabtitle .= ' ('.$fmc.')';
				
				return $this->output = <<<EOF
						<div id='message'>You rejected <b>{$bw->input['un']}</b>'s friend request</div>
						<script type='text/javascript'>
							setTimeout(function(){
					        	$('#request{$f}').toggle("slow", function(){
									$(this).remove();
									$('#reqtabtitle').html('{$contabtitle}');
								});
					        }, 2000);
						</script>
EOF;
			}
			$message = 'Error! Try again later';
			return $this->output = <<<EOF
					<div id='message' class='message'>{$message}</div>
					<script type='text/javascript'>
						setTimeout(function(){
				        	$('#message').toggle("slow", function(){
								$(this).remove();
							});
				        }, 2000);
			        </script>
EOF;
		}
	
		function unFriend(){
			global $bw, $vsStd, $vsUser;
		
			$vsStd->requireFile(CORE_PATH.'status/friends.php');
			$friend = new friends();
			
			$user = new users();
			$fIds = implode(",", array_keys($user->convertNameToId($bw->input['un'])));
			
			$f = $bw->input['f'];
			$userId = $vsUser->obj->getId();
			
			$cond = '(friendUser = '.$userId.' AND friendFriend in ('.$fIds.')) OR '.
					'(friendUser IN ('.$fIds.') AND friendFriend = '.$userId.')';
			
			$friend->setCondition($cond);
			$result = $friend->deleteObjectByCondition();
			if($result){
				$vsStd->requireFile(CORE_PATH.'friendsgroups/gds.php');
				$gds = new gds();
				
				$gcond = 'gdFriend = '.$fIds;
				$gds->setCondition($gcond);
				$gds->deleteObjectByCondition();
				
				$fmc = $this->fmAnalytic_connect($vsUser->obj->getId());
	
				$contabtitle = 'Connected';
				if($fmc) $contabtitle .= ' ('.$fmc.')';
				
				return $this->output = <<<EOF
					<div id='message' class='message'>Friend has been deleted</div>
					<script type='text/javascript'>
						setTimeout(function(){
				        	$('#{$f}').toggle("slow", function(){
								$(this).remove();
								$('#contabtitle').html('{$contabtitle}');
							});
				        }, 2000);
					</script>
EOF;
			}
			$this->output = <<<EOF
					<div id='message' class='message'>Error! Try again later</div>
					<script type='text/javascript'>
						setTimeout(function(){
				        	$('#message').toggle("slow", function(){
								$(this).remove();
								$('#{$f}concb').remove();
							});
				        }, 2000);
					</script>
EOF;
		}
		
		function friendManager(){
			global $vsPrint, $vsUser;
			
			$vsPrint->addJavaScriptFile('icampus/typewatch');
			$vsPrint->addJavaScriptFile('jquery/ui.tabs.custom');
			$vsPrint->addJavaScriptFile('icampus/jquery.tokeninput');
			
			$vsPrint->addCSSFile("jquery.tabs");
			$vsPrint->addCSSFile('custom.ui.tabs');
			$vsPrint->addCSSFile("status.tab");
			$vsPrint->addCSSFile("friendmanage");
			$vsPrint->addCSSFile("token-input/token-input");
			$vsPrint->addCSSFile("token-input/token-input-facebook");
			 
			$option['user'] = $vsUser->obj;
			$option['analytic'] = $this->fmAnalytic($vsUser->obj->getId());
		
			$this->output = $this->html->friendManager($option);
		}
		
		function fmAnalytic($userId = 0){
			if(!$userId) return array();
			
			
			$result['connected'] = $this->fmAnalytic_connect($userId);
			$result['request'] =  $this->fmAnalytic_request($userId);
			$result['list'] =  $this->fmAnalytic_list($userId);
			
			return $result;
		}
	
		
		function fmAnalytic_connect($userId){
			$connectSQL = 'SELECT count(*) as connect FROM vsf_friend WHERE friendStatus > 0 AND friendUser = '.$userId;
			$temp = $this->module->executeQueryAdvance($connectSQL, 0, '');
			$temp = current($temp);
			return $temp['connect'];
		}
		
		function fmAnalytic_request($userId){
			$requestSQL = 'SELECT count(*) as request FROM vsf_friend WHERE friendStatus = 0 AND friendFriend = '.$userId;
			$temp = $this->module->executeQueryAdvance($requestSQL, 0, '');
			$temp = current($temp);
			return $temp['request'];
		}
		
		function fmAnalytic_list($userId){
			$listSQL = 'SELECT count(*) as ilist FROM vsf_friend_group WHERE groupUser = '.$userId;
			$temp = $this->module->executeQueryAdvance($listSQL, 0, '');
			$temp = current($temp);
			return $temp['ilist'];
		}
		
		function connected(){
			global $bw, $vsUser, $vsStd, $vsUser;
			
			$userId = $bw->input['profile'];
			if(!$userId) $this->output = 'error';
			
			$user = new users();
			
			$user->setFieldsString('userId, userAlias, userFullname, userImage, userCampusId, friendId, friendFriend, profileLocation');
			$cond = "profileUser = userId AND friendUser = ".$userId." AND friendStatus > 0 AND friendFriend = userId";
			$user->setCondition($cond);
			
			$user->setTableName('user, vsf_friend, vsf_user_profile');
	
						
			$url = $bw->input['username'].'/friends'; $pIndex = 2; $size = 10;
			$option = $user->getArrPageList($url, $pIndex, $size, 1, "main-profile-container", "userId");

			global $vsTemplate;
			$campusList = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
			foreach($option['pageList'] as $key => $value){
				$ctitle = '';
				if($campusList[$value['userCampusId']]) $ctitle = $campusList[$value['userCampusId']]->getTitle();
				$option['pageList'][$key]['userCampusId'] = $ctitle;
				
				$option['pageList'][$key]['userImage'] = $user->obj->createImageCache($value['userImage'], 50, 50, 0, 1);
			}
			

			$option['user'] = $vsUser->obj;
			
			$fmc = $this->fmAnalytic_connect($vsUser->obj->getId());
		
			$contabtitle = 'Connected';
			if($fmc) $contabtitle .= ' ('.$fmc.')';
			$option['fmc'] = $contabtitle;
			
			$this->output = $this->html->connected($option);
		}
		
		function requests(){
			global $bw, $vsUser, $vsStd;
			
			$userId = $bw->input['profile'];
			if(!$userId) $this->output = 'error';
			
			$user = new users();
			
			
			$user->setTableName('user, vsf_friend');
	
			
			$user->setFieldsString('userId, userAlias, userFullname, userImage, userCampusId, friendId, friendFriend, profileLocation');
			$cond = "profileUser = userId AND friendFriend = ".$userId." AND friendStatus = 0 AND friendUser = userId";
			$user->setCondition($cond);
			
			$user->setTableName('user, vsf_friend, vsf_user_profile');
	
						
			$url = $bw->input['username'].'/requests'; $pIndex = 2; $size = 10;
			$option = $user->getArrPageList($url, $pIndex, $size, 1, "main-profile-container", "userId");

			global $vsTemplate;
			$campusList = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
			foreach($option['pageList'] as $key => $value){
				$ctitle = '';
				if($campusList[$value['userCampusId']]) $ctitle = $campusList[$value['userCampusId']]->getTitle();
				$option['pageList'][$key]['userCampusId'] = $ctitle;
				
				$option['pageList'][$key]['userImage'] = $user->obj->createImageCache($value['userImage'], 50, 50, 0, 1);
			}
			
			
			
			
			
			
			
			
			$fmc = $this->fmAnalytic_request($vsUser->obj->getId());
		
			$contabtitle = 'Requests';
			if($fmc) $contabtitle .= ' ('.$fmc.')';
			$option['fmc'] = $contabtitle;
			
			$this->output = $this->html->requests($option);
		}
		
		
		function info(){
			global $bw, $vsStd, $vsTemplate, $vsUser;
			
			$vsStd->requireFile(CORE_PATH.'users/profile/profiles.php');
			$profiles = new profiles();
			
			$vsStd->requireFile(CORE_PATH.'users/profile/edus.php');
			$edus = new edus();
			
			$vsStd->requireFile(CORE_PATH.'users/profile/works.php');
			$works = new works();
			
			
			$userObj = $vsUser->obj;
			$userId = $bw->input['profile'];
			if($userId){
				$user = new users();
				$userObj = $user->getObjectById($userId);
			}
			
			$profile = $profiles->getUserProfile($userId);
			$profile['education'] = $edus->getUserEdu2($userId);
			$profile['work'] = $works->getUserWork($userId);

			$profile['profileSN'] = json_decode($profile['profileSN'], true);
			
			$option['editable'] = '';
			if($userId == $vsUser->obj->getId()){
				foreach($profile['education'] as $key => $value){
					if($value['eduStart']){
						$from = explode('-', $value['eduStart']);
						
						$value['fmonth'] = $from[0];
						$value['fyear'] = $from[1];
					}
					if($value['eduEnd']){
						$to = explode('-', $value['eduEnd']);
						$value['tmonth'] = $to[0];
						$value['tyear'] = $to[1];
					}
					
					if($value['projects']){
						foreach($value['projects'] as $pkey => $pvalue){
							$from = array(); $end = array();
							if($pvalue['epStart']){
								$from = explode('-', $pvalue['epStart']);
								$pvalue['fmonth'] = $from[0];
								$pvalue['fyear'] = $from[1];
							}
							if($pvalue['epEnd']){
								$to = explode('-', $pvalue['epEnd']);
								$pvalue['tmonth'] = $to[0];
								$pvalue['tyear'] = $to[1];
							}
							$value['projects'][$pkey] = $pvalue;
						}
					}
					$profile['education'][$key] = $value;
					$option['editable'] = '_editable';
				}
				
				foreach($profile['work'] as $key => $value){
					if($value['workStart']){
						$from = explode('-', $value['workStart']);
						
						$value['fmonth'] = $from[0];
						$value['fyear'] = $from[1];
					}
					if($value['workEnd']){
						$to = explode('-', $value['workEnd']);
						$value['tmonth'] = $to[0];
						$value['tyear'] = $to[1];
					}
					
					if($value['projects']){
						foreach($value['projects'] as $pkey => $pvalue){
							$from = array(); $end = array();
							if($pvalue['wpStart']){
								$from = explode('-', $pvalue['wpStart']);
								$pvalue['fmonth'] = $from[0];
								$pvalue['fyear'] = $from[1];
							}
							if($pvalue['wpEnd']){
								$to = explode('-', $pvalue['wpEnd']);
								$pvalue['tmonth'] = $to[0];
								$pvalue['tyear'] = $to[1];
							}
							$value['projects'][$pkey] = $pvalue;
						}
					}
					$profile['work'][$key] = $value;
				}
			}
			
			global $vsTemplate, $vsMenu;
			$rs = array();
			foreach($vsMenu->getCategoryGroup('relationship')->getChildren() as $key => $value){
				$rs[$key]['id']	= $key;
				$rs[$key]['title'] =  $value->getTitle();
			}
			 
			if($rs[$profile['profileRS']]) $profile['profileRSV'] = $rs[$profile['profileRS']]['title'];
			
			
			if($profile['profileLanguage']) $profile['profileLanguages'] = explode(',', $profile['profileLanguage']);
			$option['profile'] = $profile;
			
			
			$option['profilejs'] = json_encode($profile);
			$option['rsjs'] = json_encode($rs);
			
			
			$cArray = array();
			foreach($vsTemplate->global_template->GLOBAL_CAMPUS_LIST as $key => $campus)
				$cArray[$key] = array('id'=>$key, 'title'=>$campus->getTitle());

			$option['campusjs'] = json_encode($cArray);

			$this->output = $this->html->info($option);
		}
		
		function friends(){
			global $bw, $vsUser, $vsStd;
			
			$userId = $bw->input['profile'];
			if(!$userId) $this->output = 'error';
			
			$user = new users();
			
			$cond = "friendUser = ".$userId." AND friendStatus > 0 AND friendFriend = userId";
			$user->setCondition($cond);
			
			$user->setTableName('user, vsf_friend');
	
			$extends = array(
							'friendId' 		=> 'friendId',
							'friendFriend' 	=> 'friendFriend'
						);
						
			$url = $bw->input['username'].'/friends'; $pIndex = 2; $size = 10;
			$option = $user->getAdvancePageList($url, $pIndex, $size, 1, "main-profile-container", 'getId', 0, 2, $extends);
	
			
			if($bw->input['profile'] != $vsUser->obj->getId()){
				$vsStd->requireFile(CORE_PATH.'status/friends.php');
				$friend = new friends();
				$userIds = implode(',', array_keys($option['pageList']));
				
				$temp = $friend->checkMultiFriendRelationship($userIds);
				foreach($option['pageList'] as $key=>$value){
					$flag = 1;
					if(array_key_exists($key, $temp)) $flag = 0;
					
					$option['pageList'][$key]->addtofriend = $flag;
				}
				if($option['pageList'][$vsUser->obj->getId()])
					$option['pageList'][$vsUser->obj->getId()]->addtofriend = 0;
			}
			
			
			$option['user'] = $vsUser->obj;
			if($bw->input['profile'] != $vsUser->obj->getId()) $option['user'] = $user->getObjectById($bw->input['profile']);  
			
			
			$this->output = $this->html->getFriends($option);
		}

		function profile(){
			global $bw, $vsPrint;
			
			$vsPrint->addJavaScriptFile ( "jquery/ui.tabs.custom");
						
			$vsPrint->addCSSFile('custom.ui.tabs');
			$vsPrint->addCSSFile("status.tab");
			$vsPrint->addCSSFile("usersstatus");
			$vsPrint->addCSSFile("friendmanage");
			
			///// right portlet calendar
			$vsPrint->addJavaScriptFile('icampus/jquery.tabs.pack');
			$vsPrint->addCSSFile("jquery.tabs");
			////
			
			$vsPrint->addJavaScriptFile('icampus/typewatch');
	
			$userId = $bw->input['profile'];
			if(!$userId) $userId = $vsUser->obj->getId();
				
			$this->getUpdates($userId);
		}
	
		function comment(){
			global $bw, $vsStd, $vsUser;
			
			$vsStd->requireFile(CORE_PATH.'status/comments.php');
			$comment = new comments();
	
			$data = array();
			
			$userId = $vsUser->obj->getId();
			
			$data['commentContent'] = $bw->input['status'];
			$data['commentTime']	= time();
			$data['commentUser']	= $userId;
			$data['commentType']	= $bw->input['privacy'];
			$data['commentProfile']	= $bw->input['wallId'];
			
			$level = 0;
			
			if($bw->input['original']){
				$comObj = $comment->getObjectById($bw->input['original']);
			
				if(!$comObj)
					return $this->output = 'Error, try again later';

				$data['commentGroup'] = $comObj->getGroup();
				
				$level = $comObj->getLevel() + 1;
				
				$data['commentLevel'] = $level;
				$data['commentOriginal'] = $bw->input['original'];
			}
			
			$objId = 0;
			$comment->singleInsert($data, &$objId);

// add to whitelist while comment is for friends only
			if($bw->input['privacy'] == 1){
				$vsStd->requireFile(CORE_PATH.'status/friends.php');
				$friend = new friends();
				
				$friendIds = $friend->getUserFriendIds($userId);
				
				
				$wArr = array(); $index = 0;
				foreach(explode(",", $friendIds) as $element){
					$wArr[$index]['statusId'] = $objId;
					$wArr[$index]['statusRecipient'] = $element;
					$index++;
				}
				if($wArr){
					$vsStd->requireFile(CORE_PATH.'status/whitelists.php');
					$whitelist = new whitelists();
					
					$whitelist->multiInsert($wArr);
				}
			}
//end add to whitelist
			
			$update = array('commentGroup'=>$objId);
			$cond = 'commentId = '.$objId;
			if($bw->input['original']){
				$cond = 'commentId = '.$bw->input['original'];
				$update = array('commentReply' => $comObj->getReply() + 1);
			}
			$comment->setCondition($cond);
			$comment->updateObjectByCondition($update);
			

			
			$option = array('content' 	=> $bw->input['status'], 
							'level' 	=> $level, 
							'original' 	=> $bw->input['original'],
							'curId'		=> $objId
						);
			return $this->output = $this->html->commentCallback($option);
		}
		
		function getUpdates($userId = 0, $updates = 0){
			global $bw, $vsStd, $vsUser;
			
			
			$vsStd->requireFile(CORE_PATH.'status/friends.php');
			$friend = new friends();
			
			$userObj = $vsUser->obj;
			if($userId){
				$user = new users();
				$userObj = $user->getObjectById($userId);
			} else $userId = $vsUser->obj->getId();
	
			$showprofile = 1; $postonprofile = 0; $replyupdate = 1;
			$friendFlag = $friend->checkFriendRelationship($bw->input['profile'], $vsUser->obj->getId());
			if($bw->input['profile'] != $vsUser->obj->getId()){
				//check friend of friend - extend network
				$extendedFlag = $friend->checkFoFriendRelationship($bw->input['profile'], $vsUser->obj->getId());
				$privacy = $this->getProfilePrivacy($userId);
			
// view profile				
				$showprofile = 0;
				$itemKey = $privacy['viewprofile']['itemKey'];			
				if($itemKey == 'friend'){
					if($friendFlag) $showprofile = 1;
				}elseif($itemKey == 'everyone'){
					$showprofile = 1;
				}elseif($itemKey == 'extended'){
					if($extendedFlag) $showprofile = 1;
				}
// view profile

// post on profile
				$itemKey = $privacy['postonprofile']['itemKey'];
				if($itemKey == 'friend'){
					if($friendFlag) $postonprofile = 1;
				}elseif($itemKey == 'everyone'){
					$postonprofile = 1;
				}elseif($itemKey == 'extended'){
					if($extendedFlag) $postonprofile = 1;
				}
// post on profile

// reply comment
				$replyupdate = 0;
				$itemKey = $privacy['replyupdate']['itemKey'];
				if($showprofile){
					if($itemKey == 'friend'){
						if($friendFlag) $replyupdate = 1;
					}elseif($itemKey == 'everyone'){
						$replyupdate = 1;
					}elseif($itemKey == 'extended'){
						if($extendedFlag) $replyupdate = 1;
					}
				}
// reply comment
			}else{
				$postonprofile = 1;
				$friendFlag = true;
			}
			
			
		
			if($showprofile){
				$vsStd->requireFile(CORE_PATH.'status/comments.php');
				$comment = new comments();
					
				$friendIds = $friend->getUserFriendIds($userId);
				if($friendIds){
					$comment->setFieldsString('commentId');
					
					$subcond = ""; $subcond1 = "";
					
					$subcond = ' (commentProfile = '.$userId.')';
					
					$ccond = 'commentLevel = 0 AND ('.$subcond.') '.$subcond1;
					
					$comment->setCondition($ccond);
					$tempArray = $comment->getArrayByCondition('commentId');
					$rootIds = implode(",", array_keys($tempArray));
				}
				else{
					$comment->setFieldsString('commentId');
					
					$subcond = ' ( (commentReply > 0 AND commentUser = '.$userId.') OR (commentProfile = '.$userId.'))';
					$ccond = 'commentLevel = 0 AND  '.$subcond.' AND '.
							 'commentId NOT IN (
									SELECT statusId
									FROM vsf_status_blacklist
									WHERE statusLevel = 0 AND statusUser = '.$userId.' 
								)';
					$comment->setCondition($ccond);
					$tempArray = $comment->getArrayByCondition('commentId');
					$rootIds = implode(",", array_keys($tempArray));
				}
	
				if($rootIds){
					$ccond = 'userId = commentUser AND commentGroup in ('.$rootIds.') AND '.
							 'commentOriginal NOT IN (
								SELECT statusId
								FROM vsf_status_blacklist bl0
								WHERE bl0.statusUser = '.$userId.' AND bl0.statusLevel = 1
							  ) AND '.
							 'commentId NOT IN (
								SELECT statusId
								FROM vsf_status_blacklist AS bl1
								WHERE bl1.statusUser = '.$userId.' AND (bl1.statusLevel = 2 OR bl1.statusLevel = 1)
							  )';
					
					$comment->setFieldsString('c.*, userFullname, userAlias, userImage, userCampusId');
					$comment->setTableName("status_comment AS c, vsf_user");
					$comment->setCondition($ccond);
					$comment->setOrder('commentGroup DESC, commentLevel');
					
					$extend = array(
							'fullname' 	=> 'userFullname',
							'alias'		=> 'userAlias',
							'image'		=> 'userImage',
							'campus'	=> 'userCampusId',
						);
						
					$commentLists = $comment->getAdvanceObjectsByCondition('getId', 0, 2, $extend);
					$time = time() - 3600;
					
					$loginuserId = $vsUser->obj->getId();
					foreach($commentLists as $key=>$value){
						$editFlag = 0; $delFlag = 0;
						if($value->getUser() == $loginuserId){
							$delFlag = 1;
							if($value->getTime() > $time)
								$editFlag = 1;
						}
						
						if($value->getProfile() == $loginuserId)
							$delFlag = 1;
						
						$commentLists[$key]->editFlag = $editFlag;
						$commentLists[$key]->delFlag = $delFlag;
					}
					
					$this->buildTreeStructure(&$commentLists);
				
					$option['pageList'] = $commentLists;
				}
			}else{
				$postonprofile = 0;
			}
			
			$option['user'] = $userObj;
			
			$profile = $this->prepareUserProfile($userId);
			$option['user']->userprofile = $profile;
			
			
			$option['right']['friends'] = $this->friendListRightPortlet();
			$option['right']['totalfriend'] = count($option['right']['friends']);
			
			$option['privacy']['viewprofile'] = $showprofile;
			$option['privacy']['postonprofile'] = $postonprofile;
			$option['privacy']['replyupdate'] = $replyupdate;
			$option['privacy']['addasfriend'] = $friendFlag;
			
			
			if($updates) return $this->output = $this->html->getUpdates($option);
			return $this->output = $this->html->getProfile($option);
		}

		function prepareUserProfile($userId = 0){
			if(!$userId) return array();
			global $vsStd, $vsTemplate;
			
			$vsStd->requireFile(CORE_PATH.'users/profile/profiles.php');
			$profiles = new profiles();
			
			$vsStd->requireFile(CORE_PATH.'users/profile/edus.php');
			$edus = new edus();
			
			
			$profile = $profiles->getUserProfile($userId);
			
			$education = $edus->getUserMainEdu($userId);
			global $vsTemplate;
			$campus = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
			
			if($campus[$education['eduSchool']])
				$education['eduSchool'] = $campus[$education['eduSchool']]->getTitle();
		
			$gender = array('Male', 'Female');
			$profile['profileGender'] = $gender[$profile['profileGender']];
			
			return $profile = array_merge($profile, $education);
		}

		function getProfilePrivacy($userId = 0){
			if(!$userId) return array();
			
			global $vsStd;
			
			$vsStd->requireFile(CORE_PATH.'users/setting/usettings.php');
			$usetting = new usettings();
			
			$usetting->setFieldsString('itemId, settingKey, itemKey, itemSetting, itemDefault, usValue');
			$usetting->setTableName("user_sitem AS i, vsf_user_sgroup, vsf_user_setting LEFT JOIN vsf_user_suser ON (usSetting = settingId AND usUser = ".$userId.")");
			
			$cond = "	i.itemSetting = settingId AND sgId = settingGroup AND
						settingStatus > 0 AND i.itemStatus > 0 AND sgKey = 'profile'
					";
//i.*, settingTitle, usValue
			$usetting->setCondition($cond);
			$array = $usetting->getArrayByCondition('itemId', 'itemSetting');
			
			$result = array();
			foreach($array as $key=>$value){
				foreach($value as $item){
					if($item['itemDefault'] || $item['usValue']){
						$temp = array();
						$temp = $item; 
						if($item['usValue']){
							$result[$item['settingKey']] = $value[$item['usValue']];
							break;	
						}
						$result[$item['settingKey']] = $temp;
					}
				}
			}
			return $result;
		}
		
		function buildTreeStructure(&$array=array()) {
			foreach ($array as $element){
				if(isset($array[$element->getOriginal()])){
					$array[$element->getOriginal()]->children[$element->getId()] = $element;
					$unset[$element->getId()] = $element->getId();
				}
			}
			
			if($unset)
				foreach($unset as $key)
					unset($array[$key]);	
			
		}
		
		
		
		
		
		
	
	function changepipv(){
		$this->output = $this->html->changepipv();
	}
	
	function changepi(){
		global $bw, $vsStd, $vsLang, $vsUser;

		$bw->input['userImage'] = $bw->input['fileId'];		
		$vsUser->obj->convertToObject($bw->input);
		$status = $vsUser->updateObjectById();

		$option['message'] = $vsLang->getWords('chang_pi_fail','Change profile fail');
		if($status){
			$option['message'] = $vsLang->getWords('chang_pi_successful','Change profile successfully');
			$vsUser->sessions->updateLoginSession($vsUser->obj);
		}
		
		$_SESSION[APPLICATION_TYPE]['obj'] = $vsUser->obj->convertToDB();
		$this->output = $vsUser->obj->createImageCache($bw->input['fileId'], 180, 180, 0, 0);
	}
	
	
	function changelt(){
		global $bw, $vsUser, $vsLang;
		$vsUser->obj->setLanguage($bw->input['userLanguage']);
		$vsUser->obj->setTimezone($bw->input['userTimezone']);
		
		$status = $vsUser->updateObjectById();
		
		$option['status'] = $status;
		$option['message'] = $vsLang->getWords('chang_information_fail','Change information fail');
		if($status){
			$option['message'] = $vsLang->getWords('chang_information_successful','Change information successfully');
			$vsUser->sessions->updateLoginSession($vsUser->obj);
		}
		
		$_SESSION[APPLICATION_TYPE]['obj'] = $vsUser->obj->convertToDB();
		
		$this->output = $this->html->changelt($option);
	}
	
	function changeName(){
		global $bw, $vsUser, $vsLang;

		$fullname = $bw->input['userFirstName']." ".$bw->input['userLastName'];
		$vsUser->obj->setFirstName($bw->input['userFirstName']);
		$vsUser->obj->setLastName($bw->input['userLastName']);
		$vsUser->obj->setFullName($fullname);
		
		$status = $vsUser->updateObjectById($vsUser->obj);
		
		$option['status'] = $status;
		$option['message'] = $vsLang->getWords('chang_name_fail','Change name fail');
		if($status){
			$option['message'] = $vsLang->getWords('chang_name_successful','Change name successfully');
			$vsUser->sessions->updateLoginSession($vsUser->obj);
		}
		
		$_SESSION[APPLICATION_TYPE]['obj'] = $vsUser->obj->convertToDB();
		$status = false;
		if($bw->input['a'] == 'protab_changname'){
			if($status){
				return $this->output = <<<EOF
				<div id="message">Your profile has been update</div>
				<script type='text/javascript'>
					var newjs = {};
					newjs['fullname'] = '{$fullname}';
					newjs['firstname'] = '{$bw->input['userFirstName']}';
					newjs['lastname'] = '{$bw->input['userLastName']}';
					
					{$bw->input['a']}_true(newjs);
				</script>
EOF;
			}
			return $this->output = <<<EOF
				<div id="message">Error! Try again later</div>
				<script type='text/javascript'>
					{$bw->input['a']}_false();
				</script>
EOF;
		}
		
		$option['userFullname'] = $fullname;
		$this->output = $this->html->changeName($option);
	}

	function acctab(){
		global $bw, $vsStd;
		
		$option = array();
		

		if($bw->input['ajax'] && $bw->input['tab'] == 'acctab'){
			$language = new languages();
			foreach($language->arrayLang as $element)
			if($element->getStatus()) $option['language'][$element->getId()] = $element;
			return $this->output = $this->html->coreacctab($option);
		}
		global $addon;
		$addon->importFilesForUserProfile();
		$this->output = $this->html->acctab($option);
	}
	
	function protab(){
		global $bw;

		$option = array();
		if($bw->input['ajax'] && $bw->input['tab'] == 'protab'){
			$option = $this->mainprotab();
			return $this->output = $this->html->coreprotab($option);
		}
		
		global $addon;
		$addon->importFilesForUserProfile();
		$this->output = $this->html->protab($option);
	}
	
	function mainprotab(){
		global $bw, $vsMenu, $vsTemplate, $vsStd, $vsUser;
		
		$option = array();
		
		$vsStd->requireFile(CORE_PATH.'users/profile/profiles.php');
		
		$profiles = new profiles();
		$pf = $profiles->getUserProfile($vsUser->obj->getId());
		
		
		if($pf['profileSN']) $pf['profileSN'] = json_decode($pf['profileSN'], true);
		
		unset($pf['profileId']);
		unset($pf['profileSN']);
			
		$pf['fullname'] = $vsUser->obj->getFullname();
		$option['profile'] = $pf;
		
		$array = $vsUser->obj->getArrayInfo();
		
		$pf['firstname'] = trim($array['userFirstName']);
		$pf['lastname'] = trim($array['userLastName']);
		$option['profile']['json']['pfjs'] = json_encode($pf);
			
		
		$rstemp = $vsMenu->getCategoryGroup('relationship')->getChildren();
		if($rstemp){
			$rsarray = array();
			foreach($rstemp as $key => $value)
				$rsarray[$key] = $value->getTitle();
			$option['profile']['json']['rsjs'] = json_encode($rsarray);
		}	
			
		
		
// education		
		$vsStd->requireFile(CORE_PATH.'users/profile/edus.php');
		$edus = new edus();
		$option['edu'] = $edus->getUserEdu($vsUser->obj->getId());
		
		foreach($option['edu'] as $tkey => $tarray){
			foreach($tarray as $key => $value){
				if($value['eduStart']){
					$from = explode('-', $value['eduStart']);
					
					$value['fmonth'] = $from[0];
					$value['fyear'] = $from[1];
				}
				if($value['eduEnd']){
					$to = explode('-', $value['eduEnd']);
					$value['tmonth'] = $to[0];
					$value['tyear'] = $to[1];
				}
				
				if($value['projects']){
					foreach($value['projects'] as $pkey => $pvalue){
						$from = array(); $end = array();
						if($pvalue['epStart']){
							$from = explode('-', $pvalue['epStart']);
							$pvalue['fmonth'] = $from[0];
							$pvalue['fyear'] = $from[1];
						}
						if($pvalue['epEnd']){
							$to = explode('-', $pvalue['epEnd']);
							$pvalue['tmonth'] = $to[0];
							$pvalue['tyear'] = $to[1];
						}
						$value['projects'][$pkey] = $pvalue;
					}
				}
				$option['edu'][$tkey][$key] = $value;
			}
		}
		
		$option['edu']['json'] = json_encode($option['edu']);
		$clist = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
		$json = array();
		foreach($clist as $ckey => $campus){
			$temp = array();
			$temp['campusId'] = $ckey;
			$temp['campusTitle'] = $campus->getTitle();
			$json[$ckey] = $temp;
		}
		$option['edu']['cjs'] = json_encode($json);
		
		
///// work		
		$vsStd->requireFile(CORE_PATH.'users/profile/works.php');
		$works = new works();
		$option['work'] = $works->getUserWork($vsUser->obj->getId());
		
		foreach($option['work'] as $key => $value){
			if($value['workStart']){
				$from = explode('-', $value['workStart']);
				
				$value['fmonth'] = $from[0];
				$value['fyear'] = $from[1];
			}
			if($value['workEnd']){
				$to = explode('-', $value['workEnd']);
				$value['tmonth'] = $to[0];
				$value['tyear'] = $to[1];
			}
			
			if($value['projects']){
				foreach($value['projects'] as $pkey => $pvalue){
					$from = array(); $end = array();
					if($pvalue['wpStart']){
						$from = explode('-', $pvalue['wpStart']);
						$pvalue['fmonth'] = $from[0];
						$pvalue['fyear'] = $from[1];
					}
					if($pvalue['wpEnd']){
						$to = explode('-', $pvalue['wpEnd']);
						$pvalue['tmonth'] = $to[0];
						$pvalue['tyear'] = $to[1];
					}
					$value['projects'][$pkey] = $pvalue;
				}
			}
			$option['work'][$key] = $value;
		}
		$option['work']['json'] = json_encode($option['work']);
		
 		return $option;
	}
	
	function editEdu(){
		global $bw, $vsUser, $vsStd;
		
		$vsStd->requireFile(CORE_PATH.'users/profile/edus.php');
		$edus = new edus();
	
		$bw->input['eduStart'] = $bw->input['efmonth'].'-'.$bw->input['efyear'];
			
		if($bw->input['epCurrent']){
			$bw->input['eduEnd'] = '';
			unset($bw->input['etmonth']);
			unset($bw->input['etyear']); 
		}
		else $bw->input['eduEnd'] = $bw->input['etmonth'].'-'.$bw->input['etyear'];
		
			
		if($bw->input['eduId']){
			$edus->obj->convertToObject($bw->input);
			$flag = $edus->updateObject();
			
			if($flag){
				if($bw->input['eduMain'] == 1){
					$vsUser->obj->setCampusId($bw->input['eduSchool']);
					$vsUser->updateObjectById($vsUser->obj);
		
					$vsUser->sessions->updateLoginSession($vsUser->obj);
					$_SESSION[APPLICATION_TYPE]['obj'] = $vsUser->obj->convertToDB();
				}
			
				$data['eduId'] 		= $bw->input['eduId'];
				$data['eduEdu'] 	= $bw->input['eduEdu'];
				$data['eduStart'] 	= $bw->input['eduStart'];
				$data['eduEnd'] 	= $bw->input['eduEnd'];
				$data['eduSchool'] 	= $bw->input['eduSchool'];
				$data['eduMajor'] 	= $bw->input['eduMajor'];
				$data['eduDegree'] 	= $bw->input['eduDegree'];
				$data['eduMain'] 	= $bw->input['eduMain'];
				$data['fmonth'] 	= $bw->input['efmonth'];
				$data['fyear'] 		= $bw->input['efyear'];
				
				
				if($bw->input['etmonth']) $data['tmonth'] = $bw->input['etmonth'];
				if($bw->input['etyear']) $data['tyear'] = $bw->input['etyear'];
				
				$json = json_encode($data);
				return $this->output = <<<EOF
						<div id='message' name='message'>Your profile has been updated</div>
						<script type='text/javascript'>
							var temp = {$json};
							profilecbtrue_edu_edit(temp);
						</script>
EOF;
			}
			
			return $this->output = <<<EOF
				<div id='message' name='message'>Error! Try again later</div>
				<script type='text/javascript'>
					profilecbfalse_edu_edit();
				</script>
EOF;
		}
		
		$bw->input['eduUser'] = $vsUser->obj->getId();
		$edus->obj->convertToObject($bw->input);
		
		$flag = $edus->insertObject();
		if($flag){
			$data = $edus->obj->convertToDB();
			
			$data['projects'] 	= array();
			$data['fmonth'] 	= $bw->input['efmonth'];
			$data['fyear'] 		= $bw->input['efyear'];
			if($bw->input['etmonth']) $data['tmonth'] = $bw->input['etmonth'];
			if($bw->input['etyear']) $data['tyear'] = $bw->input['etyear'];
			
			$json = json_encode($data);
			return $this->output = <<<EOF
					<div id='message' name='message'>Your profile has been updated</div>
					<script type='text/javascript'>
						var temp = {$json};
						profilecbtrue_edu_add(temp);
					</script>
EOF;
		}
			
		return $this->output = <<<EOF
			<div id='message' name='message'>Error! Try again later</div>
			<script type='text/javascript'>
				profilecbfalse_edu_add();
			</script>
EOF;
	}
	
	function deleteEdu(){
		global $bw, $vsStd, $vsUser;
		
		$vsStd->requireFile(CORE_PATH.'users/profile/edus.php');
		$edu = new edus();
		
		$cond = 'eduId = '.$bw->input[2].' AND eduUser = '.$vsUser->obj->getId();
		$edu->setCondition($cond);
		$result = $edu->getArrayByCondition('epId');
		
		$flag = false;
		if($result){
			$result = current($result);
			if(!$result['eduMain']){
				$flag = $edu->deleteObjectById($bw->input[2]);
				if($flag){
					$vsStd->requireFile(CORE_PATH.'users/profile/epros.php');
					$epros = new epros();
					
					$cond = 'epEdu = '.$bw->input[2];
					$epros->setCondition($cond);
					$flag = $epros->deleteObjectByCondition();
				}
			}
		}
		
		if($flag){
			$type = 'normalschool';
			if($result['eduMain']) $type = 'mainschool';
			
			return $this->output = <<<EOF
				<script type='text/javascript'>
					profilecbtrue_edu_remove();
				</script>
EOF;
		}
		return	$this->output = <<<EOF
				<div id='message' class='message'>Error! Try again later.</div>
				<script type='text/javascript'>
					profilecbfalse_edu_remove();
				</script>
EOF;
	}

	function editEpro(){
		global $vsStd, $bw;
		$vsStd->requireFile(CORE_PATH.'users/profile/epros.php');
		$epros = new epros();
		
		$bw->input['epStart'] = $bw->input['efmonth'] . '-' .$bw->input['efyear'];
		
		if($bw->input['epCurrent']){
			$bw->input['epEnd'] = '';
			unset($bw->input['etmonth']);
			unset($bw->input['etyear']);
		}
		else $bw->input['epEnd'] = $bw->input['etmonth'] . '-' .$bw->input['etyear'];
		
		if($bw->input['epId']){
			$epros->obj->convertToObject($bw->input);
			$flag = $epros->updateObject();
			
			if($flag){
				$data['epId'] 		= $bw->input['epId'];
				$data['epEdu'] 		= $bw->input['epEdu'];
				$data['epStart'] 	= $bw->input['epStart'];
				$data['epEnd'] 		= $bw->input['epEnd'];
				$data['epTitle'] 	= $bw->input['epTitle'];
				$data['epDetail'] 	= $bw->input['epDetail'];
				$data['fmonth'] 	= $bw->input['efmonth'];
				$data['fyear'] 		= $bw->input['efyear'];
				
				if($bw->input['etmonth']) $data['tmonth'] = $bw->input['etmonth'];
				if($bw->input['etyear']) $data['tyear'] = $bw->input['etyear'];
				
				$json = json_encode($data);
				return $this->output = <<<EOF
						<div id='message' name='message'>Your profile has been updated</div>
						<script type='text/javascript'>
							var temp = {$json};
							profilecbtrue_epro_edit(temp);
						</script>
EOF;
			}
			return $this->output = <<<EOF
				<div id='message' name='message'>Error! Try again later</div>
				<script type='text/javascript'>
					profilecbfalse_epro_edit();
				</script>
EOF;
		}
		
		$epros->obj->convertToObject($bw->input);
		$flag = $epros->insertObject();
		
		if($flag){
			$data = $epros->obj->convertToDB();
			$data['fmonth'] 	= $bw->input['efmonth'];
			$data['fyear'] 		= $bw->input['efyear'];
			if($bw->input['etmonth']) $data['tmonth'] = $bw->input['etmonth'];
			if($bw->input['etyear']) $data['tyear'] = $bw->input['etyear'];

			$json = json_encode($data);
			return $this->output = <<<EOF
				<div id='message' name='message'>Your profile has been updated</div>
				<script type='text/javascript'>
					var temp = {$json};
					profilecbtrue_epro_add(temp);
				</script>
EOF;
		}
		return $this->output = <<<EOF
					<div id='message' name='message'>Error! Try again later</div>
					<script type='text/javascript'>
						profilecbfalse_epro_add();
					</script>
EOF;
		
	}
	
	function deleteEpro(){
		global $bw, $vsStd, $vsUser;
		
		$vsStd->requireFile(CORE_PATH.'users/profile/epros.php');
		$epros = new epros();
		
		$epros->setTableName('user_edu, vsf_user_edu_project');
		$cond = 'epId = '.$bw->input[2].' AND epEdu = eduId AND eduUser = '.$vsUser->obj->getId();
		$epros->setCondition($cond);
		$result = $epros->getArrayByCondition('epId');
		
		$flag = false;
		if($result){
			$result = current($result);
			$epros->setTableName('user_edu_project');
			$cond = 'epId = '.$bw->input[2];
			$epros->setCondition($cond);
			$flag = $epros->deleteObjectByCondition();
		}
		if($flag){
			$type = 'normalschool';
			if($result['eduMain']) $type = 'mainschool';
			$this->output = <<<EOF
				<script type='text/javascript'>
					profilecbtrue_epro_remove();
				</script>
EOF;
		}else{
			$this->output = <<<EOF
				<div id='message' class='message'>Error! Try again later.</div>
				<script type='text/javascript'>
					profilecbfalse_epro_remove();
				</script>
EOF;
		}
	}
	
	function editProfile(){
		global $bw, $vsUser, $vsStd;
		
		$vsStd->requireFile(CORE_PATH.'users/profile/profiles.php');
		$pf = new profiles();
		$profile = $pf->getUserProfile($vsUser->obj->getId());

		$this->prepareProfile();

		if($profile){
			$bw->input['profileId'] = $profile['profileId'];
			$pf->obj->convertToObject($bw->input);
			$flag = $pf->updateObject();
		}else{
			$bw->input['profileUser'] = $vsUser->obj->getId();
			$pf->obj->convertToObject($bw->input);
			
			$flag = $pf->insertObject();
		}
	

		
		if($flag) return $this->output = <<<EOF
			<div id='message' name='message'>Your profile has been updated</div>
			<script type='text/javascript'>
				profilecbtrue_{$bw->input['a']}();
			</script>
EOF;
		return $this->output = <<<EOF
			<div id='message' name='message'>Error! Try again later</div>
			<script type='text/javascript'>
				profilecbfalse_{$bw->input['a']}();
			</script>
EOF;
	}
	
	function prepareProfile(){
		global $bw;
	

		if($bw->input['lang']){
			foreach($bw->input['lang'] as $key=>$lang)
				if(!$lang) unset($bw->input['lang'][$key]);
				
			$bw->input['profileLanguage'] = implode(",", $bw->input['lang']);
			
			unset($bw->input['lang']);
		}
		
		if($bw->input['sn']){
			$index = 0; $tsn = array();
			foreach($bw->input['sn'] as $key => $sn)
				if($sn['value'] && $sn['type'])
					$tsn[$index++] = $sn;

			$bw->input['profileSN'] = json_encode($tsn);
			unset($bw->input['sn']);
		}
		
		
		if($bw->input['month'] && $bw->input['day'] && $bw->input['year'])
			$bw->input['profileBirthday'] = $bw->input['month']."-".$bw->input['day']."-".$bw->input['year'];
	}
	
	function editWork(){
		global $bw, $vsUser, $vsStd;
		
		$vsStd->requireFile(CORE_PATH.'users/profile/works.php');
		$works = new works();
	
		$bw->input['workStart'] = $bw->input['efmonth'].'-'.$bw->input['efyear'];
			
		if($bw->input['epCurrent']){
			$bw->input['workEnd'] = '';
			unset($bw->input['etmonth']);
			unset($bw->input['etyear']); 
		}
		else $bw->input['workEnd'] = $bw->input['etmonth'].'-'.$bw->input['etyear'];
		
			
		if($bw->input['workId']){
			$works->obj->convertToObject($bw->input);
			$flag = $works->updateObject();
			
			if($flag){
				$data['workId'] 	= $bw->input['workId'];
				$data['workUser'] 	= $bw->input['workUser'];
				$data['workStart'] 	= $bw->input['workStart'];
				$data['workEnd'] 	= $bw->input['workEnd'];
				$data['workTitle'] 	= $bw->input['workTitle'];
				$data['workCompany']= $bw->input['workCompany'];
				$data['fmonth'] 	= $bw->input['efmonth'];
				$data['fyear'] 		= $bw->input['efyear'];
				
				
				if($bw->input['etmonth']) $data['tmonth'] = $bw->input['etmonth'];
				if($bw->input['etyear']) $data['tyear'] = $bw->input['etyear'];
				
				$json = json_encode($data);
				return $this->output = <<<EOF
						<div id='message' name='message'>Your profile has been updated</div>
						<script type='text/javascript'>
							var temp = {$json};
							profilecbtrue_work_edit(temp);
						</script>
EOF;
			}
			
			return $this->output = <<<EOF
				<div id='message' name='message'>Error! Try again later</div>
				<script type='text/javascript'>
					profilecbfalse_work_edit();
				</script>
EOF;
		}
	
		$bw->input['workUser'] = $vsUser->obj->getId();
		$works->obj->convertToObject($bw->input);
		
		$flag = $works->insertObject();
		
		if($flag){
			$data = $works->obj->convertToDB();
			
			$data['projects'] 	= array();
			$data['fmonth'] 	= $bw->input['efmonth'];
			$data['fyear'] 		= $bw->input['efyear'];
			if($bw->input['etmonth']) $data['tmonth'] = $bw->input['etmonth'];
			if($bw->input['etyear']) $data['tyear'] = $bw->input['etyear'];
			
			$json = json_encode($data);
			return $this->output = <<<EOF
					<div id='message' name='message'>Your profile has been updated</div>
					<script type='text/javascript'>
						var temp = {$json};
						profilecbtrue_work_add(temp);
					</script>
EOF;
		}
			
		return $this->output = <<<EOF
			<div id='message' name='message'>Error! Try again later</div>
			<script type='text/javascript'>
				profilecbfalse_work_add();
			</script>
EOF;
	}
	
	function deleteWork(){
		global $bw, $vsStd, $vsUser;
		
		$vsStd->requireFile(CORE_PATH.'users/profile/works.php');
		$works = new works();
		
		$cond = 'workId = '.$bw->input[2].' AND workUser = '.$vsUser->obj->getId();
		$works->setCondition($cond);
		$result = $works->getArrayByCondition('workId');
		
		$flag = false;
		if($result){
			$result = current($result);
			$flag = $works->deleteObjectById($bw->input[2]);
			if($flag){
				$vsStd->requireFile(CORE_PATH.'users/profile/wpros.php');
				$wpros = new wpros();
				
				$cond = 'wpWork = '.$bw->input[2];
				$wpros->setCondition($cond);
				$flag = $wpros->deleteObjectByCondition();
			}
		}

		if($flag){
			return $this->output = <<<EOF
				<script type='text/javascript'>
					profilecbtrue_work_remove();
				</script>
EOF;
		}
		return	$this->output = <<<EOF
				<div id='message' class='message'>Error! Try again later.</div>
				<script type='text/javascript'>
					setTimeout(function(){
			        	$('#message').toggle("slow", function(){	
							$('#rmepcb').remove();
							removeWHover({$bw->input[2]});
						});
			        }, 2000);
				</script>
EOF;
	}
	
	function editWpro(){
		global $vsStd, $bw;
		$vsStd->requireFile(CORE_PATH.'users/profile/wpros.php');
		$wpros = new wpros();
		
		$bw->input['wpStart'] = $bw->input['efmonth'] . '-' .$bw->input['efyear'];
		
		if($bw->input['epCurrent']){
			$bw->input['wpEnd'] = '';
			unset($bw->input['etmonth']);
			unset($bw->input['etyear']);
		}
		else $bw->input['wpEnd'] = $bw->input['etmonth'] . '-' .$bw->input['etyear'];
		
		if($bw->input['wpId']){
			$wpros->obj->convertToObject($bw->input);
			$flag = $wpros->updateObject();
			
			if($flag){
				$data['wpId'] 		= $bw->input['wpId'];
				$data['wpWork'] 	= $bw->input['wpWork'];
				$data['wpStart'] 	= $bw->input['wpStart'];
				$data['wpEnd'] 		= $bw->input['wpEnd'];
				$data['wpTitle'] 	= $bw->input['wpTitle'];
				$data['wpDetail'] 	= $bw->input['wpDetail'];
				$data['fmonth'] 	= $bw->input['efmonth'];
				$data['fyear'] 		= $bw->input['efyear'];
				
				if($bw->input['etmonth']) $data['tmonth'] = $bw->input['etmonth'];
				if($bw->input['etyear']) $data['tyear'] = $bw->input['etyear'];
				
				$json = json_encode($data);
				return $this->output = <<<EOF
						<div id='message' name='message'>Your profile has been updated</div>
						<script type='text/javascript'>
							var temp = {$json};
							profilecbtrue_wpro_edit(temp);
						</script>
EOF;
			}
			return $this->output = <<<EOF
				<div id='message' name='message'>Error! Try again later</div>
				<script type='text/javascript'>
					profilecbfalse_wpro_edit();
				</script>
EOF;
		}
		
		$wpros->obj->convertToObject($bw->input);
		$flag = $wpros->insertObject();
		
		if($flag){
			$data = $wpros->obj->convertToDB();
			$data['fmonth'] 	= $bw->input['efmonth'];
			$data['fyear'] 		= $bw->input['efyear'];
			if($bw->input['etmonth']) $data['tmonth'] = $bw->input['etmonth'];
			if($bw->input['etyear']) $data['tyear'] = $bw->input['etyear'];

			$json = json_encode($data);
			return $this->output = <<<EOF
				<div id='message' name='message'>Your profile has been updated</div>
				<script type='text/javascript'>
					var temp = {$json};
					profilecbtrue_wpro_add(temp);
				</script>
EOF;
		}
		return $this->output = <<<EOF
					<div id='message' name='message'>Error! Try again later</div>
					<script type='text/javascript'>
						profilecbfalse_wpro_add();
					</script>
EOF;
	}
	
	function deleteWpro(){
		global $bw, $vsStd, $vsUser;
		
		$vsStd->requireFile(CORE_PATH.'users/profile/wpros.php');
		$wpros = new wpros();
		
		$wpros->setTableName('user_work, vsf_user_work_project');
		$cond = 'wpId = '.$bw->input[2].' AND wpWork = workId AND workUser = '.$vsUser->obj->getId();
		$wpros->setCondition($cond);
		$result = $wpros->getArrayByCondition('epId');
		
		$flag = false;
		if($result){
			$result = current($result);
			$wpros->setTableName('user_work_project');
			$cond = 'wpId = '.$bw->input[2];
			$wpros->setCondition($cond);
			$flag = $wpros->deleteObjectByCondition();
		}
		if($flag){
			$this->output = <<<EOF
				<script type='text/javascript'>
					profilecbtrue_wpro_remove();
				</script>
EOF;
		}else{
			$this->output = <<<EOF
				<div id='message' class='message'>Error! Try again later.</div>
				<script type='text/javascript'>
					profilecbfalse_wpro_remove();
				</script>
EOF;
		}
	}

	
	
	
	function getCategoryBox($categoryGroup, $message="", $option=array()) {
		global $bw, $vsMenu, $vsLang;
		
		$data['message'] = $message;
		
		if(!$option['listStyle']) $option['listStyle'] = "| - -";
		if(!$option['id']) $option['id'] = 'userLocation';
		if(!$option['size']) $option['size'] = 1;
		if(!$option['multiple']) $option['multiple'] = false;
		$option['index'] = 0;
		$option['name'] = 'userLocation';
		$option['root_name'] = $vsLang->getWords('location_select_root',"Location");
		
		$data['html']= $vsMenu->displaySelectBox($categoryGroup->getChildren(), $option);
		
		return $data;
	}
	
	function instant($type=0){
		global $bw;

// valid username / alias
//trong listing textbook, update ltStatus
		if($type == 'userexits'){
			$buyer = $bw->input['ltBuyer'] ? $bw->input['ltBuyer'] : $bw->input['lcBuyer'];
			$this->module->setCondition("userAlias = '".$buyer."' OR userName = '".$buyer."'");
			$this->module->getObjectsByCondition();
			if($this->module->getArrayObj())
				return $this->output = 'true';
			return $this->output = 'false';
		}
		
		
//valid alias
		if($type == 'username') {
			$this->module->setCondition(" userAlias = '".$bw->input['userAlias']."'");
			$this->module->getObjectsByCondition();
			if($this->module->getArrayObj())
				return $this->output = 'false';
			return $this->output = 'true';
		}



//valid userName
		if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $bw->input['userName']))
			return $this->output = 'false';
			
		$this->module->setCondition(" userName = '".$bw->input['userName']."'");
		$this->module->getObjectsByCondition();
	
		if($this->module->getArrayObj())
			return $this->output = 'false';
		
		return $this->output = 'true';
	}
	
	function updateCampus(){
		global $bw, $vsUser, $vsLang;
		$this->module->setCondition("userId = ".$vsUser->obj->getId());
		$this->module->updateObjectByCondition(array('userCampusId'=>$bw->input['userCampusId']));
		
		$option['message'] = $vsLang->getWords('update_campus_fail','Error. Please try again later!');
		if($this->module->result['status']){
			$vsUser->obj->setCampusId($bw->input['userCampusId']);
			$this->module->obj = $vsUser->obj;
			$this->module->sessions->updateLoginSession($this->module->obj);
			$_SESSION[APPLICATION_TYPE]['obj'] = $this->module->obj->convertToDB();
				
			$option['message'] = $vsLang->getWords('update_campus_successful','Your campus is updated.');
		}
		
		return $this->output = $this->html->updateCampusCallback($option);
	}
	
	function changePassword(){
		global $bw, $vsLang, $vsUser, $vsPrint;

		$option['status'] = false;
		if($vsUser->obj->getPassword()!= md5($bw->input['userOldPassword'])){
			$option['message'] = $vsLang->getWords('old_pass_does_not_match', 'Password doesnot match');
			return $this->output = $this->html->changePassword($option);		
		}

		$vsUser->obj->setPassword($bw->input['userPassword']);
		$status = $vsUser->updateObjectById();

		$option['status'] = $status;
		
		$option['message'] = $vsLang->getWords('chang_password_fail','Change password fail');
		if($status){
			$option['message'] = $vsLang->getWords('chang_password_successful','Change password successfully');
			$vsUser->sessions->updateLoginSession($vsUser->obj);
		}
		
		$_SESSION[APPLICATION_TYPE]['obj'] = $vsUser->obj->convertToDB();
		$this->output = $this->html->changePassword($option);
	}
	
	function changeAlias(){
		global $bw, $vsUser, $vsLang;
		
		$vsUser->obj->setAlias($bw->input['userAlias']);
		$status = $vsUser->updateObjectById($vsUser->obj);

		
		
		
		$option['status'] = $status;
		$option['message'] = $vsLang->getWords('chang_alias_fail','Change username fail');
		if($status){
			$option['message'] = $vsLang->getWords('chang_alias_successful','Change username successfully');
			$vsUser->sessions->updateLoginSession($vsUser->obj);
		}
		
		$option['alias'] = $bw->input['userAlias'];
		$_SESSION[APPLICATION_TYPE]['obj'] = $vsUser->obj->convertToDB();
		
		$this->output = $this->html->changeAlias($option);
	}
	
	
	
	
	
	
	
	function signUpForm(){
		global $bw, $vsStd, $vsUser, $vsPrint;
		
		if($bw->input['submit']) return $this->signupProcess();
		
		if($vsUser->obj->getId()){
			$vsPrint->boink_it($bw->base_url."textbooks");
			return false;
		}
		
		$vsStd->requireFile(CORE_PATH."campuses/campuses.php");
		$campus = new campuses();
		$option['campusList'] = $campus->getCampusList();
		
		$option['recapcha'] = $this->getRecapcha();
		$option['referror'] = $bw->input['ref'];
		$option['invite'] = $bw->input['invite'];
		
		if($bw->input['ref'] && $bw->input['invite']){
			$option['suburl'] = '/&ref='.$bw->input['ref'].'&invite='.$bw->input['invite'].'&t='.$bw->input['time'];
			if($bw->input['t']){
				$vsStd->requireFile(CORE_PATH.'friendsgroups/referrals.php');
				$ref= new referrals();
				$cond = 'refTime = '.$bw->input['t'].' AND refUser = '.$bw->input['invite'];
				$ref->setCondition($cond);
				$temp = $ref->getArrayByCondition();
			
				$email = current($temp);
				
				if($email) $this->module->obj->setName($email['refEmail']);			
			}
		}
		
		$vsPrint->addJavaScriptFile('icampus/jquery.autocomplete');
		$vsPrint->addCSSFile("autocomplete/jquery.autocomplete");
		
		return $this->output = $this->html->signUpForm($this->module->obj, $option);
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
	
	function signupProcess(){
		global $bw, $vsStd, $vsLang, $vsUser, $vsPrint;
	
		$option = array();
		
		$bw->input['userFullname'] = $bw->input['userFirstName'] . " " . $bw->input['userLastName'];
		 
		$username = $bw->input['userEmail'] = $bw->input['userName'];

	
		$this->module->obj->convertToObject($bw->input);

		$option['recapcha'] = $this->getRecapcha();
		$option['referror'] = $bw->input['ref'];
		$option['invite'] = $bw->input['invite'];
		
		$objfail = $this->module->obj;
 
        if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $username)){
			$option['message'] = $vsLang->getWords('wrong_email_format','Email does not valid');
			$option['recapcha'] = $this->getRecapcha();
			return $this->output = $this->html->signUpForm($objfail, $option);	
		}

		
		$option['campusList'] = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
		$option['message'] = $vsLang->getWords('null_data','Please refill your information');
		
		$objfail->day = $bw->input['day'];
		$objfail->month = $bw->input['month'];
		$objfail->year = $bw->input['year'];

		$error = $this->checkRecapcha();
		if($error){
			$option['message'] = $error;
			$option['recapcha'] = $this->getRecapcha();
		
			return $this->output = $this->html->signUpForm($objfail, $option);	
		}
		if(!$this->module->obj->getName()){
			$option['recapcha'] = $this->getRecapcha();
			return $this->output =	$this->html->signUpForm($objfail, $option);	
		}
		
		$defaultGroup = empty($bw->vars['user_defaultGroup'])?1:$bw->vars['user_defaultGroup'];
		
	    
		$this->module->setCondition("userName ='{$bw->input['userName']}'");
		$this->module->getOneObjectsByCondition();
	
		if($this->module->result['status']){
			$option['message'] = $vsLang->getWords('dupicate_username', 'This email isnot available');
			$option['recapcha'] = $this->getRecapcha();
			return $this->output =	$this->html->signUpForm($objfail, $option);	
		}
		
		$this->module->setCondition("userAlias = '{$bw->input['userAlias']}'");
		$this->module->getOneObjectsByCondition();
		if($this->module->result['status']){
			$option['message'] = $vsLang->getWords('dupicate_useralias', 'This username isnot available');
			$option['recapcha'] = $this->getRecapcha();
			return $this->output =	$this->html->signUpForm($objfail, $option);	
		}
		
		$bw->input['userJoinedDate']= time();
		$bw->input['userLastLogin'] = time();
		$bw->input['userStatus']  = empty($bw->vars['user_defaultActive'])?0:$bw->vars['user_defaultActive'];
		
		$groups=$this->module->groupusers->getGroupById($defaultGroup);
		$this->module->obj->addGroup($groups);
		
		if($this->module->obj->getId())
			$this->module->updateObjectById($this->module->obj);
		else {
			$this->module->obj->setJoinDate(time());
			$this->module->obj->setLastLogin(time());
			$this->module->obj->setPassword($bw->input['userPassword']);
			
			$this->module->insertObject($this->module->obj);
		}
		
		if($this->module->result['status']){
			$this->module->vsRelation->setObjectId($this->module->obj->getId());
			$this->module->vsRelation->setRelId($defaultGroup);
			$this->module->vsRelation->setTableName($this->module->getRelTableName());
			$this->module->vsRelation->insertRel();
		}
		$this->module->sessions->updateLoginSession($this->module->obj);
		$vsUser->obj = $this->module->obj;
		
		$temp = $this->module->convertNameToId($bw->input['referror']);
		$refId = implode(",", array_keys($temp));
		
		if($bw->input['invite']) $this->updateFriendReferral($refId);
		
		$this->sendVerifyEmail($vsUser->obj->getId(), $refId);
		$vsPrint->boink_it($bw->base_url."textbooks");
	}
	
	function insertProfile(){
		global $bw, $vsStd, $vsUser;
		
		$vsStd->requireFile(CORE_PATH.'users/profile/profiles.php');
		$profile = new profiles();
		
		$userId = $this->module->obj->getId();
		
		$pdata = array();
		$pdata['profileUser'] = $userId;
		$pdata['profileBirthday'] = $bw->input['month']."-".$bw->input['day']."-".$bw->input['year'];
		$pdata['profileGender'] = $bw->input['userGender'];
		$profile->singleInsert($pdata);
		
		$vsStd->requireFile(CORE_PATH.'users/profile/edus.php');
		$edus = new edus();
		
		$edata = array();
		$edata['eduSchool'] = $vsUser->obj->getCampusId();
		$edata['eduUser'] = $userId;
		$edata['eduMain'] = 1;
		
		$edus->singleInsert($edata);
		
	}
	function updateFriendReferral($userId){
		global $bw, $vsStd;

		if($userId){

			$vsStd->requireFile(CORE_PATH.'friendsgroups/referrals.php');
			$ref= new referrals();
		
			$cond = 'refEmail = "'.$bw->input['userName'].'" AND refUser = '.$userId;
			$ref->setCondition($cond);
			$ref->updateObjectByCondition(array('refStatus'=>1));	
		}
	}
	
	
	
	function sendVerifyEmail($userId = 0, $refId = 0){
		global $bw, $vsStd, $vsUser, $vsSettings, $vsLang;
		
		$time = time();
		$content = <<<EOF
			<a href="{$bw->vars['board_url']}" title='iCampux'>
			<img src="{$bw->vars['img_url']}/logo.jpg" alt='{$bw->vars['board_url']}'/>
			</a><br />
			We would like to thank for your registration at iCampux.com. Please take an extra step to complete your registration!
			Click <a href='{$bw->vars['board_url']}/users/verifyemail/{$userId}/&ref={$refId}&t={$time}' title="Click here to confirm your email address">here</a> to confirm your email address.
			<br/><br/>
			If the above link does not work, you can paste the following address into your browser:
			
			{$bw->vars['board_url']}/users/verifyemail/{$userId}/&ref={$refId}&t={$time}
			<br/><br/>
			-- iCampux Team --<br/>
			<a href='{$bw->vars['board_url']}/users/verifyemail/{$userId}/&ref={$refId}&t={$time}'> {$bw->vars['board_url']}</a>
EOF;
		
		$vsStd->requireFile(LIBS_PATH."Email.class.php", true);
		$email = new Emailer();
		
		$email->setTo($vsUser->obj->getName());
		$email->setFrom('noreply@icampux.com', 'iCampux Team');
		$email->setSubject('Please confirm your email addrss');
		$email->setBody($content);
		$email->sendMail();
	}
	
	function verifyEmail(){
		global $bw, $vsPrint;
		
		$cond = 'userId = '.$bw->input[2];
		$user = new users();
		$user->setCondition($cond);
		$result = $user->updateObjectByCondition(array('userStatus'=>1));
		
		if($result){
			$this->module->getObjectById($bw->input[2]);
			$this->module->sessions->updateLoginSession($this->module->obj);
			$_SESSION[APPLICATION_TYPE]['obj'] = $this->module->obj->convertToDB();
			
			$this->insertProfile();
			
			$this->wellcomeEmail();
			
			$this->updateUserReferral($bw->input['ref']);
		
			//add expirate link: chua lam
			return $vsPrint->boink_it($bw->base_url."textbooks");
		}
		$option['message'] = 'There was an error, please try again later.';
		$this->output = $this->html->error_page($option);
	}
	
	function updateUserReferral($userId){
		global $bw, $vsStd;
		
		if($userId){
			$query = 'UPDATE vsf_user SET userReferral = userReferral + 1'.
			 		 ' WHERE userId = '.$userId.';';
			$this->module->executeNoneQuery($query);
		}
	}
	
	function wellcomeEmail(){
		global $vsStd, $vsUser, $vsSettings, $vsLang;
		
		$vsStd->requireFile(LIBS_PATH."Email.class.php", true);
		$email = new Emailer();
		
		$email->setTo($vsUser->obj->getName());
		$email->setFrom('noreply@icampux.com', $vsLang->getWords("wellcome_title", "Wellcome icampux"));
		$email->setSubject($vsLang->getWords("wellcome_title", "Wellcome to icampux"));
		$email->setBody($this->html->wellcomeEmail());
		$email->sendMail();
	}
	
	function loginForm($message = ""){	
		global $bw, $vsLang, $vsSettings, $vsPrint, $vsUser;
		
		if($vsUser->obj->getId())
			return $vsPrint->boink_it($bw->base_url."textbooks");
		
		if(!isset($_SESSION['login_attempt'])) $_SESSION['login_attempt'] = 0;
		
		$time = $vsSettings->getSystemKey('login_attempt', 5, "users", 1, 0);
		$period = $vsSettings->getSystemKey('login_exceed_period', 10, "users", 1, 0);

		if($_SESSION['login_attempt'] > $time){
			if((time() - $_SESSION['login_attempt_time']) > ($period*60)){
				$_SESSION['login_attempt'] = 0;
				unset($_SESSION['login_attempt_time']);
			}else{
				$message = $vsLang->getWords('try_later', 'you have exceeded '.$time.' attempts. Please wait '.$period.' Minutes to log in again');
				unset($bw->input['submit']);
			}
		}
			
		if($bw->input['submit']) return $this->loginProcess();
		
		if($bw->input[2] == "nosession")
			$message = $vsLang->getWords('require_login', 'You have to login first');
		elseif($bw->input[2] == "timeout")
			$message = $vsLang->getWords('require_login_timeout', 'Session timeout. Please relogin');

		$option['message'] = $message;
		
		return $this->output = $this->html->loginForm($this->module->obj, $option);
	}	
	
	function loginProcess() {		
		global $bw, $vsPrint, $vsLang;
		unset($bw->input['submit']);
	
		if($bw->input['u']) $bw->input['userName'] = $bw->input['u'];
		
		if($bw->input['loginName']) $bw->input['userName'] = $bw->input['loginName'];
		if($bw->input['loginPassword']) $bw->input['userPassword'] = $bw->input['loginPassword'];
		
		
		$this->module->setCondition("(userName ='{$bw->input['userName']}' OR userAlias = '".$bw->input['userName']."')");
		$this->module->getOneObjectsByCondition();
		if(!$this->module->result['status']){
			$option['message']=$vsLang->getWords('invalid_email_alias','Invalid Email or username');
			return $this->output = $this->loginForm($option['message']);
		}
		if(!$this->module->obj->getStatus()){
			$option['message']=$vsLang->getWords('pendding_user','Your account hasnot verify email yet.');
			return $this->output = $this->loginForm($option['message']);
		}	
		
		if($this->module->obj->getPassword()!= md5($bw->input['userPassword'])){
			$_SESSION['login_attempt']++;
			$_SESSION['login_attempt_time'] = time();
			
			$option['message'] = $vsLang->getWords('wrong_password','Wrong Password');
			return $this->output = $this->loginForm($option['message']);
		}
		
		$this->module->vsRelation->setObjectId($this->module->obj->getId());
		$this->module->vsRelation->setTableName($this->module->getRelTableName());
		$groupStr=$this->module->vsRelation->getRelByObject();
		
		if(!$groupStr){
			$option['message']=$vsLang->getWords('invalid_account','Invalid account');
			return $this->output = $this->loginForm($option['message']);
		}
		$array = $this->module->vsRelation->arrval;
		
		foreach ($array as $id => $group) {
			$this->module->obj->addGroup($this->module->groupusers->getGroupById($id));
		}
		
		$this->module->sessions->updateLoginSession($this->module->obj);
		$_SESSION[APPLICATION_TYPE]['obj'] = $this->module->obj->convertToDB();
		
	
		if($bw->input['verify']){
			$param = str_replace('users/login','textbooks/sell', $_SERVER['HTTP_REFERER']);
			return $vsPrint->boink_it($param);
		}
		
		$vsPrint->boink_it($bw->base_url."textbooks");
	}
	

	function renewPasswordForm($option = array()){
		global $bw;
		
		if($bw->input['isubmit']) return $this->renewPassword();
		return $this->output =	$this->html->renewPasswordForm($option);
	}
	
	function renewPassword(){
		global $bw, $vsStd, $vsLang, $vsSettings;
		unset($bw->input['isubmit']);
		
		$option = array();
		$this->module->setCondition("userEmail='".$bw->input['account']."' OR userAlias = '".$bw->input['account']."'");
		$account = $this->module->getOneObjectsByCondition();
	
		if(!$account){
			$option['message'] = $vsLang->getWords('wrong_email_or_username','This email or username does not exist!');	
			$option['account'] = $bw->input['account'];	
			return $this->output = $this->renewPasswordForm($option);
		}
		
		
		$vsStd->requireFile(LIBS_PATH."Email.class.php", true);
		$email = new Emailer();
		
		
		$email->setTo($account->getEmail());
		$email->setFrom($vsSettings->getSystemKey('global_system_message_alias', 'noreply@icampux.com', 'global', 1, 1), 'iCampux Team');
		$email->setSubject($vsLang->getWords('recover_email_title','Password Recovery'));
		$email->setBody($this->html->renewPasswordEmail($account));
		$email->sendMail();
		
		$option['email'] = $account->getName();
		$option['message'] = $vsLang->getWords('recover_password_guide','Check your email address below for a message from icampux.')."<br/><b>".$account->getEmail()."</b>";
			
		$this->renewPasswordForm($option);
	}

	function recoverPasswordForm($option = array()){
		global $bw, $vsLang;
	
		if($bw->input['submit']) return $this->recoverPassword();

		
		$bw->input['id'] = abs($bw->input['id']);
		$bw->input['t'] = abs($bw->input['t']);
		
		if(!$bw->input['id'] || !$bw->input['t']){
			$option['message'] = $vsLang->getWords('wrong_recover_link','Your recover password link is expired');
			return $this->renewPasswordForm($option);
		}
		
		
		$this->module->setCondition('userId = '.$bw->input['id'].' AND userLastLogin = '.$bw->input['t']);
		$account = $this->module->getOneObjectsByCondition();
		
		if(!$account){
			$option['message'] = $vsLang->getWords('wrong_recover_link','Your recover password link is expired');	
			return $this->output = $this->renewPasswordForm($option);
		}
		
		$option['userId'] = $account->getId();
		$option['userLastLogin'] = $account->getLastLogin();
		
		return $this->output =	$this->html->recoverPasswordForm($option);
	}
	
	function recoverPassword(){
		global $bw, $vsStd, $vsLang, $vsPrint, $vsSettings;
		
		unset($bw->input['submit']);
		
		if(!abs($bw->input['id']) || !abs($bw->input['t'])){
			$option['message'] = $vsLang->getWords('wrong_recover_link','Your recover password link is expired');
			return $this->renewPasswordForm($option);
		}
		
		if(!$bw->input['userPassword']){
			$option['message'] = $vsLang->getWords('wrong_password_empty','Your password cannot be blank');
			return $this->recoverPasswordForm($option);
		}
		
		if($bw->input['userPassword'] != $bw->input['confirmPassword']){
			$option['message'] = $vsLang->getWords('wrong_password_match','Your two password donot match');
			return $this->recoverPasswordForm($option);
		}
		
		$this->module->setCondition('userId = '.$bw->input['id'].' AND userLastLogin = '.$bw->input['t']);
		$account = $this->module->getOneObjectsByCondition();
		
		if(!$account){
			$option['message'] = $vsLang->getWords('wrong_recover_link','Your recover passsword link is expired');	
			return $this->output = $this->renewPasswordForm($option);
		}
		
		$account->setPassword($bw->input['userPassword']);
		$account->setLastLogin(time());
		$this->module->updateObjectById($account);
		
		$vsUser->obj = $account;
		
		
		$this->module->sessions->updateLoginSession($account);
		$_SESSION[APPLICATION_TYPE]['obj'] = $account->convertToDB();
		
		
		
		$vsStd->requireFile(LIBS_PATH."Email.class.php",true);
		$email = new Emailer();
		
		$email->setTo($account->getEmail());
		$email->setFrom($vsSettings->getSystemKey('global_system_message_alias', 'noreply@icampux.com', 'global', 1, 1), 'iCampux Team');
		$email->setSubject($vsLang->getWords('recover_email_title','Recover Password!'));
		$email->setBody($this->html->notifyRecoverEmail($account));
		$email->sendMail();
		
		
		$vsPrint->boink_it($bw->vars['board_url'].'/textbooks');
	}
	

	function genRandomString($length = 6){
    	$characters = "0123456789abcdefghijklmnopqrstuvwxyz";
    	$string = "";    
    	for($p = 0; $p < $length; $p++)
        	$string .= $characters[mt_rand(0, strlen($characters))];

        return strtoupper($string);
	}
	
	
	function friendListRightPortlet(){
			global $bw, $vsStd, $vsUser;
			
			$userId = $vsUser->obj->getId();
			if(!$userId) return array();
			
			$user = new users();
			
			$cond = "friendUser = ".$userId." AND friendStatus > 0 AND friendFriend = userId";
			$user->setCondition($cond);
			
			$user->setTableName('user, vsf_friend');
	
			$extends = array(
							'friendId' 		=> 'friendId',
							'friendFriend' 	=> 'friendFriend'
						);
						
			$url = $bw->input['username'].'/friends'; $pIndex = 2; $size = 10;
			$result = $user->getAdvanceObjectsByCondition('getId', 0, 2, $extends);
			return $result;
	}
/*End pandog*/

	
	function loadDefault($msg=""){
		global $bw, $vsPrint;
		
		if($_SESSION[APPLICATION_TYPE]['obj']['userId'])
			$vsPrint->boink_it($bw->base_url."textbooks");
		$vsPrint->boink_it($bw->base_url."users/login");
	}
	

	
	function globalerror(){
		global $vsPrint;
		$vsPrint->boink_it($bw->base_url."error");
	}
	
	
	
	function logoutProcess(){	
		global $bw, $vsLang,$vsPrint;
		unset($_SESSION[APPLICATION_TYPE]['obj']);
		unset($_SESSION[APPLICATION_TYPE]['groups']);
		
		$_SESSION[APPLICATION_TYPE]['session']['userId'] = 0;
		$vsPrint->boink_it($bw->base_url."textbooks");
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
	
	function convertProfile(){
			global $vsStd;
			$vsStd->requireFile(CORE_PATH.'users/profile/profiles.php');
			$profile = new profiles();
			
			$vsStd->requireFile(CORE_PATH.'users/profile/edus.php');
			$edus = new edus();
			
			$array = $this->module->getObjectsByCondition();
			
			$pdata = array(); $edata = array(); 
			$query = "UPDATE vsf_user SET userInfo = CASE userId ";
			
			foreach($array as $key=>$user){
				
				$ainfo = array(); $temp = array();
				$userId = $user->getId();
				$ainfo = $user->getArrayInfo();
				
				$birthday = '';
				if(trim($ainfo['userBirthday']) && trim($ainfo['userBirthday']) != 'Day-Month-Year'){
					$temp = explode('-', trim($ainfo['userBirthday']));
					$birthday = $temp[1].'-'.$temp[0].'-'.$temp[2];
				}
			
				$pdata[$key]['profileUser'] = $userId;
				$pdata[$key]['profileBirthday'] = $birthday;
				$pdata[$key]['profileGender'] = $ainfo['profileGender'];
				$pdata[$key]['profileLanguage'] = $ainfo['userLanguages'];
				
				$edata[$key]['eduUser'] = $userId;
				$edata[$key]['eduMain'] = 1;
				$edata[$key]['eduSchool'] = $user->getCampusId();
				
				$iarray = serialize(array('userFirstName'=>$ainfo['userFirstName'], 'userLastName'=>$ainfo['userLastName']));
				$query	.= sprintf("WHEN  %d  THEN '%s' ", $userId, $iarray);
			}
			$query .= "END ";
			

			
			$this->module->executeQuery($query);

			
			
//			$profile->multiInsert($pdata);
//			$edus->multiInsert($edata);

//			global $DB;
//			print "<pre>";
//			print_r($DB->obj);
//			print "</pre>";
		}
}
?>