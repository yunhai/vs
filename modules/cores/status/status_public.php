<?php
	global $vsStd;
	require_once(CORE_PATH."status/friends.php");

	class status_public {
		protected $html;
		protected $module;
		protected $output;
		
		function __construct() {
			global $vsTemplate, $vsPrint, $vsUser, $bw;

			if(!$vsUser->obj->getId())
				return $vsPrint->boink_it($bw->vars['board_url'].'/users/login');
			
				
			$vsPrint->addCSSFile("status");
			
			$this->html = $vsTemplate->load_template('skin_status');
		}
	

		function auto_run() {
			global $bw;

			switch ($bw->input[1]){
				case 'searchfriend':
						$this->searchFriend();
					break;
				case 'askforfriend':
						$this->askForFriend($bw->input[2]);
					break;
				case 'friends':
						$this->getFriends();
					break;
				case 'notice':
						$this->getNotice();
					break;
				case 'unfriend':
						$this->unfriend();
					break;
				case 'profile':
						$this->getProfile();
					break;
				case 'comment':
						$this->comment();
					break;
				case 'newfeed':
						$this->getNewFeed();
					break;
				case 'hide':
						$this->hideStatus();
					break;
				default:
						$this->getFriends();
					break;
			}
		}
		
		function hideStatus(){
			global $bw, $vsUser, $vsStd;
			
			$userId = $vsUser->obj->getId();
		
			$vsStd->requireFile(CORE_PATH.'status/comments.php');
			$comment = new comments();
			$comObj = $comment->getObjectById($bw->input['ref']);
			if(!$comObj) return false;
			
			$group = 0;
			if($bw->input['level'] < 2) $group = 1;
			
			$data = array(
				'statusId'		=> $bw->input['ref'],
				'statusUser' 	=> $userId,
				'statusLevel'	=> $bw->input['level'],
				'statusType'	=> $group
			);
			
		
			
			$vsStd->requireFile(CORE_PATH.'status/blacklists.php');
			$blacklist = new blacklists();
			$result = $blacklist->singleInsert($data);
			print "<pre>";
			print_r($data);
			print "</pre>";
			global $DB;
			print "<pre>";
			print_r($DB->obj);
			print "</pre>";
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
		
		function getProfile(){
			global $bw, $vsUser, $vsStd;
			
			$userId = $vsUser->obj->getId();
			if($bw->input[1]){
				$user = new users();
				$array = $user->convertNameToId($bw->input[2]);
				
				if($array) $userId = implode(",", array_keys($array));
			}
			
			$this->getNewFeed($userId);
		}
		
		function getNewFeed($userId = 0){
			global $bw, $vsStd, $vsUser, $vsPrint;
			
			$vsPrint->addJavaScriptFile('icampus/jquery.tabs.pack');
			$vsPrint->addCSSFile("jquery.tabs");
			
			$vsStd->requireFile(CORE_PATH.'status/friends.php');
			$friend = new friends();
			
			$userObj = $vsUser->obj;
			if($userId){
				$user = new users();
				$userObj = $user->getObjectById($userId);
			} else $userId = $vsUser->obj->getId();
			
			$friendIds = $friend->getUserFriendIds($userId);
		
			if($friendIds){
				$vsStd->requireFile(CORE_PATH.'status/comments.php');
				$comment = new comments();
				
		 
				$comment->setFieldsString('commentId');		
				$ccond = 'commentLevel = 0 AND (commentUser in ('.$friendIds.') OR (commentReply > 0 AND commentUser = '.$userId.')) AND '.
						 'commentId NOT IN (
								SELECT statusId
								FROM vsf_status_blacklist
								WHERE statusLevel = 0 AND statusUser = '.$userId.' 
							)';
				$comment->setCondition($ccond);
				$tempArray = $comment->getArrayByCondition('commentId');
				$rootIds = implode(",", array_keys($tempArray));
				
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
					
					$comment->setFieldsString('c.*, userFullname, userAlias, userImage, userLocation, userCampusId');
					$comment->setTableName("status_comment AS c, vsf_user");
					$comment->setCondition($ccond);
					$comment->setOrder('commentGroup DESC, commentLevel');
					 
					$extend = array(
									'fullname' 	=> 'userFullname',
									'alias'		=> 'userAlias',
									'image'		=> 'userImage',
									'location'	=> 'userLocation',
									'campus'	=> 'userCampusId',
								);
					$commentLists = $comment->getAdvanceObjectsByCondition('getId', 0, 2, $extend);
					$this->buildTreeStructure(&$commentLists);
				
					$option['pageList'] = $commentLists;
				}
			}

			$option['user'] = $userObj;
			$this->output = $this->html->getNewFeed($option);
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
		
		
		
		function unFriend(){
			global $bw, $vsStd, $vsUser;
			
			$vsStd->requireFile(CORE_PATH.'status/friends.php');
			$friend = new friends();
			
			$userId = $vsUser->obj->getId();
			$cond = '(friendUser = '.$userId.' AND friendFriend = '.$bw->input['f'].') OR '.
					'(friendUser = '.$bw->input['f'].' AND friendFriend = '.$userId.')';
			
			$friend->setCondition($cond);
			$friend->deleteObjectByCondition();
			global $DB;
			print "<pre>";
			print_r($DB->obj);
			print "</pre>";
		}
		
		function getFriends(){
			global $vsUser, $vsStd;
			
			$userId = $vsUser->obj->getId();
			
			$vsStd->requireFile(CORE_PATH.'status/friends.php');
			$friend = new users();
			
			$cond = "friendUser = ".$userId." AND friendStatus > 0 AND friendFriend = userId";
			$friend->setCondition($cond);
			
			$friend->setTableName('user, vsf_friend');

			$url = 'status/friends'; $pIndex = 2; $size = 10;
			$option = $friend->getAdvancePageList($url, $pIndex, $size, 0, "", 'getId', 0, 1, array('ifriend'=>'Friend'));
			
			$this->output = $this->html->getFriends($option);
		}
		
		function askForFriend($friendId = 0){
			global $bw, $vsUser, $vsLang;
		
			$decision = array('accept'=>1, 'deny'=>0);
			if(array_key_exists($bw->input[2], $decision)){
				return $this->makeFriendDecision($decision[$bw->input[2]], $bw->input[3]);
			}
			if(!$friendId) return 0;
			
			$userId = $vsUser->obj->getId(); //nguoi ask for friend
			$friend = new friends(); //nguoi bi ask
			
			$cond = "friendUser = ".$userId.' AND friendFriend = '.$friendId;
			$friend->setCondition($cond);
			$result = $friend->getObjectsByCondition();
			if($result){
				$option['message'] = $vsLang->getWords('askforfiend_duplicate','Duplicate');
				return print $option['message'];
			}
			
			$time = time();
			
			$data['friendUser'] = $userId;
			$data['friendFriend'] = $friendId;			
			$data['friendTime'] = $time;
			
			$objId = 0;
			$iresult = $friend->singleInsert($data, &$objId);
			if(!$iresult){
				$option['message'] = $vsLang->getWords('askforfiend_addfriend_error','Add friends error');
				return print $option['message'];
			}
		
			$option['message'] = $vsLang->getWords('askforfiend_successful','Successful');
			
			global $vsStd;
			$vsStd->requireFile(CORE_PATH.'status/notices.php');
	
			$notice = new notices();
			
			
			$nData = array(
						'noticeUser' 	=> $friendId,
						'noticeObj'		=> $objId,
						'noticeContent' => 'request for friend',
						'noticeType'	=> 3,
						'noticeTime' => $time
					);
			$notice->singleInsert($nData);
			
			global $DB;
			print "<pre>";
			print_r($DB->obj);
			print "</pre>";
		}
		
		function makeFriendDecision($decision = 0, $frelation = 0){
			if(!$frelation) return 0;
			
			global $bw, $vsStd, $vsUser, $vsLang;
			$vsStd->requireFile(CORE_PATH.'status/friends.php');
			$friend = new friends();
			
			$cond = 'friendId = '.$frelation.' AND friendFriend = '.$vsUser->obj->getId();
			$friend->setCondition($cond);
			$result = $friend->getObjectsByCondition();
			if(!$result) return 0;
			
// accept friend request
			if($decision){
				$friend->setCondition($cond);
				$friend->updateObjectByCondition(array('friendStatus' => 1));
				
				$data = array(); $index = 0;
				foreach($result as $key => $element){
					if($element->getStatus()) continue;
					$data[$index]['friendUser'] = $element->getFriend(); 
					$data[$index]['friendFriend'] = $element->getUser();
					$data[$index]['friendTime'] = $element->getTime();
					$data[$index]['friendStatus'] = 1;
					
					$index++;
				}
				if($data)
					$iresult = $friend->multiInsert($data);
				
				$option['message'] = $vsLang->getWords('accept_friend_fail', 'Accept friend request fail');
				if($iresult){
					$vsStd->requireFile(CORE_PATH.'status/notices.php');
					$notice = new notices();
					$nCond = "noticeId = ".$bw->input['n'];
					$notice->setCondition($nCond);
					$notice->deleteObjectByCondition();
					
					$option['message'] = $vsLang->getWords('accept_friend_successful', 'Accepted friend request');
				}
				global $DB;
				print "<pre>";
				print_r($DB->obj);
				print "</pre>";
				return print $option['message']; 
			}
// deny friend request
			$friendIds = implode(",", array_keys($result));
			
			$dcond = 'friendId in ('.$friendIds.')';
			
			$friend->setCondition($dcond);
			$dresult = $friend->deleteObjectByCondition();
			global $DB;
			print "<pre>";
			print_r($DB->obj);
			print "</pre>";
			$option['message'] = $vsLang->getWords('deny_friend_fail', 'Deny friend request fail');
			if($dresult){
				$option['message'] = $vsLang->getWords('deny_friend_successful', 'Denied friend request');
				$vsStd->requireFile(CORE_PATH.'status/notices.php');
				$notice = new notices();
				$nCond = "noticeId = ".$bw->input['n'];
				$notice->setCondition($nCond);
				$notice->deleteObjectByCondition();
			}
			return print $option['message']; 
		}
		
		function searchFriend(){
			global $bw, $vsSettings, $vsUser;
			
			if(!$bw->input['submit']){
				return $this->output = $this->html->searchFriend();
			}
			$user = new users();
			
			$ucond = "userId <> ".$vsUser->obj->getId()." AND (userName LIKE '".$bw->input['qname']."%' OR userAlias LIKE '".$bw->input['qname']."%') ";
			$user->setCondition($ucond);
			
			$url = 'status/searchfriend';
			$size = $vsSettings->getSystemKey('search_friend_quality', 5, 'friends', 1);
			$pIndex = 2;
			$option = $user->getPageList($url, $pIndex, $size);
	
			$this->output = $this->html->searchFriend($option);
		}
		
		function getNotice(){
			global $vsUser;
			
			
			global $vsStd;
			$vsStd->requireFile(CORE_PATH.'status/notices.php');
			
			$notice = new notices();
			$option['pageList'] = $notice->getUserNotice($vsUser->obj->getId());
			
			$this->output = $this->html->getNotice($option);
		}
		
		function getOutput() {
			return $this->output;
		}
	
		function setOutput($output) {
			$this->output = $output;
		}
}
?>