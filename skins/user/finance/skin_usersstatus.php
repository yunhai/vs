<?php
class skin_comments{

	function getProfile($option= array()){
		global $bw, $vsLang, $vsUser;

		$BWHTML .= <<<EOF
			<style>
				.ui-dialog { position: absolute !important;}
			</style>
			<div id="profile_left">
		    	<div class="profile_left_top">
		    		<div id='mainuserinfo'>
		    			<div id='maincb'></div>
			        	<div style="line-height:26px; width: 550px; float:left;">
			                <div class="profile_avatar">{$option['user']->createImageCache($option['user']->getImage(), 85, 115, 0, 1)}</div>
			                <p class="profile_nick">
			                	<span>{$option['user']->getFullname()}</span> 
			                	[{$option['user']->userprofile['profileGender']}, {$option['user']->userprofile['profileLocation']}]
			                </p>
			                <p>Student @ {$option['user']->userprofile['eduSchool']} </p>
			                <p><strong>{$option['user']->userprofile['eduMajor']}</strong></p>
			                <div class="clear_left"></div>
			            </div>
		            	<div style='float: right;'>
		            		<if=" !$option['privacy']['addasfriend'] ">
		            		<div id='mainaddfriend' class="friend_add_friend" style="margin-bottom: 5px;" ref="{$option['user']->getAlias()}" f="{$option['user']->getId()}">            
				            	Add as friend
				            </div>
				            </if>
				            
				            <if=" $bw->input['profile'] != $vsUser->obj->getId() ">
				            <div id='mainsendmessage' class="friend_send_message" style="margin-bottom: 5px;" ref="{$option['user']->getAlias()}" f="{$option['user']->getId()}">            
				            	Send a message
				            </div>
				            </if>
		            	</div>
		            	<div class="clear"></div>
		            </div>
		            <script>
		            	$('#mainaddfriend').click(function(){
		            		var alias = $(this).attr('ref');
            				var f = $(this).attr('f');
            		
            				vsf.get('{$vsUser->obj->getAlias()}/askforfriend/&un='+alias+'&f='+f, 'maincb');
            				$('#mainuserinfo').ajaxStop(function(){
            					$('#maincb').addClass('message');
            					$('#maincb').removeClass('message');
	            				setTimeout(function(){
						        	$('#maincb').toggle("slow", function(){
										$(this).remove();
									});
						        }, 2000);
							});
            				return false;
		            	});
		            	
		            	$('#mainsendmessage').click(function(){
		            		var alias = $(this).attr('ref');
            				var f = $(this).attr('f');
							var option = {
											title: 'Send a message',
											width: 600,
											height: 600,
											params:{
												mainmod: "uprofile",
												alias: alias,
												f: f,
												popupId: "global_formContainer"
											}
										};
							vsf.popupLightGet('messages/popup', 'global_formContainer', option);
						});
		            </script>
		            
		            <if=" $option['privacy']['postonprofile'] ">
		            <form method='POST' id='mainshare'>
		            	<input type="hidden" name="privacy" id='privacy' value="0" />
		            	<textarea id="mainstatus" name='status'></textarea>
		                <input type="button" name="submmit" value="Share" id='sharemainshare' level='0'>
		                <div id='shareprivacy'>
			                <a href="javascript:;" class="clock_sub" id="clock_sub">
			                	<img src="{$bw->vars['img_url']}/clock_sub.jpg" />
			                </a>
			                
			                <div id="status_privacy_container">
			                    <span ref="0">Public</span><br />
			                    <span ref="1">Friends</span>
			                    <div class="clear_left"></div>
			                </div>
		                </div>
		                
		                <div id="mainshare_cb"></div>
		                <div class="clear_right"></div>
		            </form>

		            <script type='text/javascript'>
		            	var flag = true;
		            	$("#clock_sub").click(function(){
		            		if(flag){
			            		$('#clock_sub').addClass('active1');
								$('#status_privacy_container').css({display: "block"}).show();
							}else{
								$('#status_privacy_container').css({display: "none"}).hide();	
								$('#clock_sub').removeClass("active1");
							}
							flag = !flag;
						});
						
						$('#status_privacy_container span').click(function(){
							flag = true;
							$('#clock_sub').removeClass('active1');
							$('#privacy').val($(this).attr('ref'));
							$('#status_privacy_container').css({display: "none"}).hide();
						});
						
		            	$('#sharemainshare').click(function(){
		            		var hidden = "<input type='hidden' name='wallId' id='wallId' value='{$option['user']->getId()}' />";
		            		$('#mainshare').append(hidden);
		            		
		            		if($('#mainstatus').val())
			    				vsf.submitForm($('#mainshare'), '{$vsUser->obj->getAlias()}/comment', 'mainshare_cb');
			    			return false;
		            	});
		            </script>
		            </if>
		        </div>
		        
		        
		        <if=" $option['privacy']['viewprofile'] ">
		        <div id="profile_tab">
		            <ul class='tabs-nav'>
		                <li><a href="#tabupdate"><span>Updates</span></a></li>
		                <li><a href="{$bw->base_url}{$option['user']->getAlias()}/friends&ajax=1"><span>Friends</span></a></li>
		                <li><a href="{$bw->base_url}{$option['user']->getAlias()}/info&ajax=1"><span>Info</span></a></li>
		            </ul>
					<div id='main-profile-container'>
						{$this->getUpdates($option)}
					</div>
		        </div>
		        <script type='text/javascript'>
		    		$(function() {
						var ptab = $('#profile_tab').utabs({
							selected: 0
						});
					});
				</script>
		        </if>
		    </div>
		    {$this->rightPortlet($option['right'])}
EOF;
	}
	
	function getUpdates($option= array()){
		global $bw, $vsLang, $vsUser;

		$this->board_url = $bw->vars['board_url'];
		$this->img_url = $bw->vars['img_url'];
		
		$BWHTML .= <<<EOF
		            <div id="tabupdate">
		            	<if=" $option['pageList'] ">
		            	<foreach=" $option['pageList'] as $comment ">
		                <div class="update_item" id="update{$comment->getId()}">
		                	<div class="update_avatar">
		                		<a href="{$this->board_url}/{$comment->alias}" title="{$comment->alias}">
		                		{$option['user']->createImageCache($comment->image, 50, 50, 0, 1)}
		                		</a>
		                	</div>
		                    <div class="update_comment" id="{$comment->getId()}">
		                    	<div class='status_info'>
			                    	<p style="color:#808080">
			                    		<a href="{$this->board_url}/{$comment->alias}"><strong>{$comment->alias}</strong></a> 
			                    	</p>
			                        <p id='comment_content{$comment->getId()}'>{$comment->getContent()}</p>
			                    	<p style="line-height:30px;">
			                    		<span id="comment_date{$comment->getId()}">{$comment->getTime('real')}</span>
			                    		<if=" $comment->getLastUpdate('real') ">
			                    		[Last modified: {$comment->getLastUpdate('real')}]
			                    		</if>
			                    		<if=" $option['privacy']['replyupdate'] ">
			                    		<a href="javascript:;" class='commentbutton' level="0" ref="{$comment->getId()}">Comment</a>
			                    		</if>
			                    	</p>
			                    	<div class="comment_opt">
			                    		<if=' $comment->editFlag '>
										<span class="editcomment" ref='{$comment->getId()}' cl='0'><img src="{$this->img_url}/edit_png.png" /></span>
										</if>
										<span class="delcomment" ref='{$comment->getId()}' cl='0'><img src="{$this->img_url}/del_png.png" /></span>
									</div>
		                    	</div>
		                    	

		                        <if=" $comment->children ">
		                        <div class="tab_comment_item" id="sub{$comment->getId()}">
		                        <foreach=" $comment->children as $level1">
		                        	<div id='{$level1->getId()}'>
			                            <div class="tab_comment_item_center">
			                            	<p style="color:#808080">
				                                <a href="{$this->board_url}/{$level1->alias}" class="avatar_comment" title="{$level1->alias}">
				                                	{$option['user']->createImageCache($level1->image, 50, 50, 0, 1)}
				                                </a>
			                                </p>
			                                <div class="comment_info">
			                                    <a href="{$this->board_url}/{$level1->alias}" class="nick_comment">{$level1->alias}</a>
			                                    <p id='comment_content{$level1->getId()}'>{$level1->getContent()}</p>
			                                    <div class="clear_left"></div>
			                                    <p class="tab_comment_date">
			                                    	<span id="comment_date{$level1->getId()}">{$level1->getTime('real')}</span>
			                                    	<if=" $level1->getLastUpdate('real') ">
			                                    	[Last modified: {$level1->getLastUpdate('real')}]
			                                    	</if>
			                                    	<if=" $option['privacy']['replyupdate'] ">
			                                    	<a href="javascript:;" class='commentbutton' level='1' ref="{$level1->getId()}">Comment</a>
			                                    	</if>
			                                    </p>
			                                </div>
			                                <div class="comment_opt">
			                                	<if=' $level1->editFlag '>
			                                    <span class="editcomment" ref='{$level1->getId()}' cl='1'><img src="{$this->img_url}/edit_png.png" /></span>
			                                    </if>
                                				<span class="delcomment" ref='{$level1->getId()}' cl='1'><img src="{$this->img_url}/del_png.png" /></span>
											</div>
			                                <div class="clear"></div>
			                            </div>
			                            
			                            <if=" $level1->children ">
			                            <div class="tab_comment_item_sub">
			                            	<foreach=" $level1->children as $level2 ">
			                        		<div class="tab_comment_item_center_sub" id="{$level2->getId()}">
			                        			<p style="color:#808080">
				                                    <a href="{$this->board_url}/{$level2->alias}" class="avatar_comment" title="{$level2->alias}">
				                                    	{$option['user']->createImageCache($level2->image, 50, 50, 0, 1)}
				                                    </a>
			                                    </p>
			                                    <div class="comment_info_sub">
			                                        <a href="{$this->board_url}/{$level2->alias}" class="nick_comment">{$level2->alias}</a>
			                                        <p id='comment_content{$level2->getId()}'>{$level2->getContent()}</p>
			                                        <div class="clear_left"></div>
			                                        <p class="tab_comment_date">
				                                    	<span id="comment_date{$level1->getId()}">{$level2->getTime('real')}</span>
				                                    	<if=" $level2->getLastUpdate('real') ">
				                                    	[Last modified: {$level2->getLastUpdate('real')}]
				                                    	</if>
			                                        </p>
			                                    </div>
			                                    <div class="comment_opt">
			                                    	<if=' $level2->editFlag '>
			                                    	<span class="editcomment" ref='{$level2->getId()}' cl='2'><img src="{$this->img_url}/edit_png.png" /></span>
			                                    	</if>
                                					<span class="delcomment" ref='{$level2->getId()}' cl='2'><img src="{$this->img_url}/del_png.png" /></span>
			                                    </div>
			                                    <div class="clear"></div>
			                                </div>
			                                </foreach>
			                            </div>
			                            </if>
		                            </div>
		                        </foreach>
		                        </div>
		                        </if>
		                        <!-- STOP TAB COMMENT ITEM -->
		                    </div>
		                    <div class="clear"></div>
		                </div>
		                <!-- STOP UPDATE ITEM -->
		                </foreach>
		                </if>
		            </div>
		            <!-- STOP UPDATES -->
		            
		    		
	    	<script type='text/javascript'>
	    		var htmlclass = {0:'tab_comment_form', 1:'tab_comment_form_sub'};
	    		
	    		bindEditButtonClick();
	    		function bindEditButtonClick(){
	    			$('.editcomment').click(function(){
	    				$('.cec').remove();
	    				$('.editcomment').unbind('click');
	    				var id = $(this).attr('ref');
	    				
						var curhtml = $('#comment_content'+id).html();
						
						var ceditor = "<div id='cec"+id+"'>"+
										"<div id='cec"+id+"temp' style='display:none;'>"+curhtml+"</div>"+
										"<div id='cec"+id+"cb'></div>"+
										"<div style='float:left; width: 350px;' class='cec'>"+
										"<form id='cec"+id+"_form' action='POST'>"+
											"<input type='hidden' name='id' value='"+id+"' />"+
											"<textarea id='cedit"+id+"' name='cedit' style='width:100%;'>"+curhtml+"</textarea>"+
											"<div>"+
												"<input id='cec"+id+"_submit' value='Edit' type='button' />"+
												"<input id='cec"+id+"_cancel' value='Cancel' type='button'/>"+
											"</div>"+
										"</form>"+
										"</div>"+
										"<div class='clear'></div>"+
									  "</div>";

						$('#comment_content'+id).html(ceditor);
						$('#cedit'+id).focus();
						
						$('#cec'+id+'_cancel').click(function(){
							$('#comment_content'+id).html(curhtml);
							bindEditButtonClick();
						});

						$('#cec'+id+'_submit').click(function(){
							vsf.submitForm($('#cec'+id+'_form'), '{$option['user']->getAlias()}/editupdate', 'cec'+id+'cb');
							return false;
						});
	    			});
	    		}
	    		
	    		bindDelButtonClick();
	    		function bindDelButtonClick(){
	    			$('.delcomment').click(function(){
	    				var id = $(this).attr('ref');
						var cl = $(this).attr('cl');
						
						var dcb = id;
						if(cl < 1) dcb = 'update'+id;
						
						var hidden = '<div id="'+dcb+'cb"></div>';
						$('#'+dcb).prepend(hidden);
						
						jConfirm(
							'Are you sure to delete', 
							'Dialog board', 
							function(r){
								if(r){
									vsf.get('{$option['user']->getAlias()}/deleteupdate/'+id+'/&cl='+cl, dcb+'cb');
									return false;
								}
						});
		    			return false;
	    			});
	    		}
	    		
	    		
	    		bindCommentButtonClick();
    			function bindCommentButtonClick(){
    				$('.commentbutton').click(function(){
	    				var level = $(this).attr('level');
		    			var id = $(this).attr('ref');
			            
		    			var html = '<div class="'+htmlclass[level]+' auto">'+
		                            	'<form id="form_'+id+'">'+
		                                	'<input name="status" id="status" />'+
			                				'<input type="input" name="submmit" value="Comment" class="share tab_comment_submit" level="'+level+'" ref="'+id+'"/>'+
		                                    '<div class="clear"></div>'+
		                                '</form>'+
		                                '<div id="form_'+id+'_cb"></div>'+
		                            '</div>';
	
		                $('.auto').remove();
		               
		                if($('#sub'+id).length == 0){
		                	subclass = '';
		                	if(level > 0) subclass = 'tab_comment_item_sub ';
		                	html = 	'<div id="sub'+id+'" class="' + subclass + 'tab_comment_form_sub_nobackground">'+
		                				html+
		                			'</div>';
		                			
			                $('#'+id).append(html);
						}else $('#sub'+id).append(html);
		                
						$('#status').focus();
						
						$('.share').bind('click', function(){
			    			var id = $(this).attr('ref');
			    			
							var hidden = "<input type='hidden' name='original' value='"+id+"' />";
							$('#form_'+id).append(hidden);
							
							var hidden = "<input type='hidden' name='wallId' value='{$option['user']->getId()}' />";
		            		$('#form_'+id).append(hidden);
							
			    			vsf.submitForm($('#form_'+id), '{$vsUser->obj->getAlias()}/comment', 'form_'+id+'_cb');
			    			return false;
						});
					});
    			}
			</script>
EOF;
	}
	
	function commentCallback($option){
		global $bw, $vsLang, $vsUser;

		$this->img_url = $bw->vars['img_url'];
		$BWHTML .= <<<EOF
			<script type="text/javascript">
		
				$('.auto').remove();
				$('.commentbutton').unbind('click');
				$('.delcomment').unbind('click');
				$('.editcomment').unbind('click');
				
				var cbclass 	= {1:'tab_comment_item_center', 2:'tab_comment_item_center_sub'};
				var cbcontent 	= {1:'comment_info', 2:'comment_info_sub'};
				
				
				var comment = "";
				if({$option['level']} < 2)
					comment = 	"<a ref='{$option['curId']}' level='{$option['level']}' class='commentbutton' href='javascript:;'>Comment</a>";

				if({$option['level']} == 0){
					var html = 	"<div id='update{$option['curId']}' class='update_item'>"+
								"		<div class='update_avatar'>"+
		                        "            	{$vsUser->obj->createImageCache($vsUser->obj->getImage(), 50, 50, 0, 1)}"+
		                        "       </div>"+
		                        "       <div id='{$option['curId']}' class='update_comment'>"+
		                        "			<div class='status_info'>"+
		                        "				<p style='color:#808080'>"+
		                        "       			<a href='#'><strong>{$vsUser->obj->getAlias()}</strong></a>"+
		                        "				</p>"+
		                        "           	<p id='comment_content{$option['curId']}'>{$option['content']}</p>"+
		                        "           	<p style='line-height:30px;'><span id='comment_date{$option['curId']}'> few seconds ago </span>" + comment + "</p>"+
		                        "				<div class='comment_opt'>"+
			                    "                	<span class='editcomment' ref='{$option['curId']}' cl='{$option['level']}'><img src='{$this->img_url}/edit_png.png' /></span>"+
                                "					<span class='delcomment' ref='{$option['curId']}' cl='{$option['level']}'><img src='{$this->img_url}/del_png.png' /></span>"+
			                    "                </div>"+
		                        "           </div>"+
		                        "       </div>"+
		                        "       <div class='clear'></div>"+
		                        "	</div>"+
		                        "</div>";
					$('#tabupdate').prepend(html);
					$('#mainstatus').val('');
					$('#profile_tab').utabs( "option", "selected", 0);
				}
				else{
					var html = 		"	<div id='{$option['curId']}' class='"+cbclass[{$option['level']}]+"'>"+
			                        "		<p style='color:#808080'>"+
			                        "            <a class='avatar_comment' href='#'>"+
			                        "            	{$vsUser->obj->createImageCache($vsUser->obj->getImage(), 50, 50, 0, 1)}"+
			                        "            </a>"+
			                        "       </p>"+
			                        "       <div class='"+cbcontent[{$option['level']}]+"'>"+
			                        "       	<a class='nick_comment' href='#'>{$vsUser->obj->getAlias()}</a>"+
			                        "           <p id='comment_content{$option['curId']}'>{$option['content']}</p>"+
			                        "           <div class='clear_left'></div>"+
			                        "           <p class='tab_comment_date'><span id='comment_date{$option['curId']}'> few seconds ago </span>" + comment + "</p>"+
			                        "				<div class='comment_opt'>"+
				                    "                	<span class='editcomment' ref='{$option['curId']}' cl='{$option['level']}'><img src='{$this->img_url}/edit_png.png' /></span>"+
	                                "					<span class='delcomment' ref='{$option['curId']}' cl='{$option['level']}'><img src='{$this->img_url}/del_png.png' /></span>"+
				                    "                </div>"+
			                        "           </div>"+
			                        "       </div>"+
			                        "       <div class='clear'></div>"+
			                        "	</div>";
					
					if({$option['level']} == 1){
						var html = 	"	<div id='"+""+"{$option['curId']}'>"+	
									"	<div class='"+cbclass[{$option['level']}]+"'>"+
			                        "		<p style='color:#808080'>"+
			                        "            <a class='avatar_comment' href='#'>"+
			                        "            	{$vsUser->obj->createImageCache($vsUser->obj->getImage(), 50, 50, 0, 1)}"+
			                        "            </a>"+
			                        "       </p>"+
			                        "       <div class='"+cbcontent[{$option['level']}]+"'>"+
			                        "       	<a class='nick_comment' href='#'>{$vsUser->obj->getAlias()}</a>"+
			                        "           <p id='comment_content{$option['curId']}'>{$option['content']}</p>"+
			                        "           <div class='clear_left'></div>"+
			                        "           <p class='tab_comment_date'><span id='comment_date{$option['curId']}'> few seconds ago </span>" + comment + "</p>"+
			                        "			<div class='comment_opt'>"+
				                    "           	<span class='editcomment' ref='{$option['curId']}' cl='{$option['level']}'><img src='{$this->img_url}/edit_png.png' /></span>"+
	                                "				<span class='delcomment' ref='{$option['curId']}' cl='{$option['level']}'><img src='{$this->img_url}/del_png.png' /></span>"+
				                    "           </div>"+
			                        "       </div>"+
			                        "       <div class='clear'></div>"+
			                        "	</div>"+
			                        "	</div>";
					}
					
					var parentdiv	= '';
					if({$option['level']} > 0) parentdiv = 'sub';
					
		
					$('#'+parentdiv+'{$option['original']}').append(html);
					if($('#'+parentdiv+'{$option['original']}').hasClass('tab_comment_form_sub_nobackground')){
						$('#'+parentdiv+'{$option['original']}').removeClass('tab_comment_form_sub_nobackground');
						if(!$('#'+parentdiv+'{$option['original']}').hasClass('tab_comment_item_sub'))
							$('#'+parentdiv+'{$option['original']}').addClass('tab_comment_item');
					}
				}
				
				
				bindDelButtonClick();
	    		bindEditButtonClick();
	    		
				bindCommentButtonClick();
			</script>
EOF;
	}

	function getFriends($option){
		global $bw, $vsLang, $vsUser;
		
		$this->board_url = $bw->vars['board_url'];
		$BWHTML .= <<<EOF
            <div id='tabfriends'>
            	<div id='formcontainer' style='margin-top: 5px;'>
	            	<form id='formsearchfriend' method='POST' class="search_friend">
	            		<p>Friends</p>
	            		<div class="search_friend_tt">
			            	<input name='qname' id='qname' />
			            	<select id='criteria' name='criteria'>
			            		<option value='all'>All</option>
			                	<option value='name'>By name</option>
			                	<option value='email'>By email</option>
			                	<option value='fname'>By fullname</option>
			                </select>
			            </div>
		            	<input type='button' name='submit' value='Find' class='search_friend_btn' id='searchfriend'/>
		            </form>
	            </div>
	            
	            <script type="text/javascript">
	            	$('#criteria').change(function(){
	            		$('#formsearchfriend').submit();
	            	});
	            
	            	$('#searchfriend').click(function(){
	            		$('#formsearchfriend').submit();
	            	});
	            	
					$('#formsearchfriend').submit(function(){
						if($('#qname').val() == "") return false;
						var hidden = '<input type="hidden" name="instant" value="ffriend" />';
						$(this).append(hidden);
						
						vsf.submitForm($(this), '{$option['user']->getAlias()}/filterfriends/&s=status', 'f_friendlist');
						
						$(this).find(":hidden").each(function(){
							$(this).remove();
						});
						return false;
					});
					
					$(document).ready(function(){
						var options = {
						    callback:function(){							    	
						    	$('#formsearchfriend').submit();
							},
						    wait:300,
						    highlight:true,
						    captureLength: 2
						}
						$("#qname").typeWatch(options);
					});
				</script>
				
				<div id='f_friendlist'>
	            	<if=" $option['pageList'] ">
	            	<foreach=" $option['pageList'] as $friend ">
	            		<div class='connected_item' id="{$friend->getId()}">
	            			<div class='friendinfo'>
	            				<div id='{$friend->getId()}cb' class='message'></div>
	            				<a href="{$this->board_url}/{$friend->getAlias()}" class="connected_img" title="{$friend->getFullname()}">
	            				{$friend->createImageCache($friend->getImage(), 50, 50, 0, 1)}
	            				</a>
	            				<div class="connected_info">
	            					<p>
										<a href="{$this->board_url}/{$friend->getAlias()}" title="{$friend->getFullname()}">
											{$friend->getAlias()} [{$friend->getFullname()}]
										</a>
										  San Jose, CA 
									</p>
									<p>Student @ San Jose State University </p>
								</div>
	            			</div>
	            			<div class='friendoption'>
	            				<if=" $friend->addtofriend ">
	            				<div class='askforfriend friend_add_friend' ref='{$friend->getAlias()}' f="{$friend->getId()}">            					
	            					Add as friend
	            				</div>
	            				</if>
	            			</div>
	            			<div class='clear'></div>
	            		</div>
	            	</foreach>
	            	</if>
	            	<if=" $option['paging'] ">
	            	<div class='page'>
	            		<span>Browse Pages:</span>
	            		{$option['paging']}
	            	</div>
	            	</if>
            	</div>
            	<script type='text/javascript'>
	            	$('.askforfriend').click(function(){
	            		var alias = $(this).attr('ref');
	            		var f = $(this).attr('f');
	            		
	            		vsf.get('{$vsUser->obj->getAlias()}/askforfriend/&un='+alias+'&f='+f, f+'cb');
	            		return false;
	            	});
	            </script>
            </div>
EOF;
	}
	
	
	
	
	function filterfriends($option){
		global $bw, $vsLang, $vsUser;
		
		$this->board_url = $bw->vars['board_url'];
		$BWHTML .= <<<EOF
			<div id='filterfriend'>
            	<if=" $option['pageList'] ">
            	<foreach=" $option['pageList'] as $friend ">
            		<div class='connected_item' id="{$friend['userId']}">
            			<div class='friendinfo'>
            				<div id='{$friend['userId']}cb' class='message'></div>
            				<a href="{$this->board_url}/{$friend['userAlias']}" class="connected_img" title="{$friend['userFullname']}">
            					{$friend['userImage']}
            				</a>
            				<div class="connected_info">
            					<p>
									<a href="{$this->board_url}/{$friend['userAlias']}" title="{$friend['userFullname']}">
										{$friend['userFullname']} [{$friend['userAlias']}]
									</a>
									{$friend['profileLocation']}
								</p>
								<p>Student @ {$friend['userCampusId']}</p>
							</div>
            			</div>
            			<div class='clear'></div>
            		</div>
            	</foreach>
            	<else />
            		<div class='connected_item'>
            			<div class='friendinfo'>
            				<b>You have no connected friends with this keyword</b>
            			</div>
            		</div>
            	</if>
            </div>
EOF;
	}
	
	function mainfindfriends($option){
		global $bw, $vsLang, $vsUser;
		
		$this->board_url = $bw->vars['board_url'];
		$BWHTML .= <<<EOF
			<div id='mainfindfriend'>
            	<if=" $option['pageList'] ">
            	<foreach=" $option['pageList'] as $friend ">
            		<div class='connected_item' id="{$friend['userId']}">
            			<div class='friendinfo'>
            				<div id='{$friend['userId']}cb' class='message'></div>
            				<a href="{$this->board_url}/{$friend['userAlias']}" class="connected_img" title="{$friend['userFullname']}">
								{$friend['userImage']}
            				</a>
            				<div class="connected_info">
            					<p>
									<a href="{$this->board_url}/{$friend['userAlias']}" title="{$friend['userFullname']}">
										{$friend['userFullname']} [{$friend['userAlias']}]
									</a>
									{$friend['profileLocation']}
								</p>
								<p>Student @ {$friend['userCampusId']} </p>
							</div>
            			</div>
            			<div class='friendoption'>
            				<div class='askforfriend friend_add_friend' ref='{$friend['userAlias']}' f='{$friend['userId']}'>            					
            					Add as friend
            				</div>
            			</div>
            			<div class='clear'></div>
            		</div>
            	</foreach>
            	</if>
            	<if=" $option['paging'] ">
            	<div class='page'>
            		<span>Browse Pages:</span>
            		{$option['paging']}
            	</div>
            	</if>
            </div>
            <script type='text/javascript'>
            	$('.askforfriend').click(function(){
            		var alias = $(this).attr('ref');
            		var f = $(this).attr('f');
            		
            		vsf.get('{$vsUser->obj->getAlias()}/askforfriend/&un='+alias+'&f='+f, f+'cb');
            		return false;
            	});
            </script>
EOF;
	}
	

	
	function friendManager($option= array()){
		global $bw, $vsLang, $vsUser;

		$BWHTML .= <<<EOF
			<div id="friend_register">
		        <div id="profile_tab">
		            <ul class='tabs-nav'>
						<li>
							<a href="{$bw->base_url}{$option['user']->getAlias()}/connected&ajax=1">
								<span id='contabtitle'>Connected <if="$option['analytic']['connected']">({$option['analytic']['connected']})</if></span>
							</a>
						</li>
						<li>
							<a href="{$bw->base_url}{$option['user']->getAlias()}/requests&ajax=1">
								<span id='reqtabtitle'>Requests <if="$option['analytic']['request']">({$option['analytic']['request']})</if></span>
							</a>
						</li>
						<li>
							<a href="{$bw->base_url}{$option['user']->getAlias()}/lists&ajax=1">
								<span id='listabtitle'>List <if="$option['analytic']['list']">({$option['analytic']['list']})</if></span>
							</a>
						</li>
						<li>
							<a href="{$bw->base_url}{$option['user']->getAlias()}/findfriends&ajax=1">
								<span id='fintabtitle'>Find Friends</span>
							</a>
						</li>
						<li>
							<a href="{$bw->base_url}{$option['user']->getAlias()}/invitefriends&ajax=1">
								<span id='reftabtitle'>Refer Friends</span>
							</a>
						</li>
		            </ul>

					<div id='fm_container'></div>
		        </div>
		        <div class='clear'></div>
		    </div>
		    
		    
		    		
	    	<script type='text/javascript'>
	    		var finish = false;
	    		$(function(){
					$('#profile_tab').utabs({
						selected: 2,
						cache: false,
						select: function(event, ui) {
						        var content = '<img src="'+imgurl+'ajax-loader.gif" alt="retrieving data ..." style="height: 20px"/>';
						        content += '<br /><b>Fetching Data....</b>';
						        
						        var html = '<div style="margin: 10px">' + content + '</div>';
						        $("#ui-tabs-" + (ui.index)).html(html);
							}
					});
				});
			</script>
EOF;
	}
	
	function connected($option){
		global $bw, $vsLang, $vsUser;
		
		$this->board_url = $bw->vars['board_url'];
		$this->img_url	 = $bw->vars['img_url'];
		
		$BWHTML .= <<<EOF
            <div id='tabconnected'>
            	<div id="fmcontainer">
		    		<form id='mainfsform' method='POST' class="search_friend">
		    			<p>Friends</p>
	            		<div class="search_friend_tt">
			            	<input name='qname' id='mainqname' />
			            	<select id='criteria'>
			            		<option value='all'>All</option>
			                	<option value='name'>By name</option>
			                	<option value='email'>By email</option>
			                	<option value='fname'>By fullname</option>
			                </select>
						</div>
		            	<input type='button' name='submit' value='Find' class='search_friend_btn' id='searchfriend' />
		            </form>
		        </div>
		        
            	<div id='mainconnected'>
            	<if=" $option['pageList'] ">
            	<foreach=" $option['pageList'] as $friend ">
            		<div class='connected_item' id="{$friend['friendId']}">
            			<div class='friendinfo'>
            				<a href="{$this->board_url}/{$friend['userAlias']}" class="connected_img">
            					{$friend['userImage']}
            				</a>
            				<div class="connected_info">
            					<p>
									<a href="{$this->board_url}/{$friend['userAlias']}" title="{$friend['userFullname']}">
										{$friend['userFullname']} [{$friend['userAlias']}]
									</a>
									{$friend['profileLocation']}
								</p>
								 <p>Student @ {$friend['userCampusId']}</p>
							</div>
            			</div>
            			<div class='friendoption'>
            				<div class='unfriend remove' ref='{$friend['userAlias']}' f="{$friend['friendId']}" >            					
            					<img src="{$this->img_url}/del_png.png" alt='unfriend' />
            				</div>
            			</div>
            			<div class='clear'></div>
            		</div>
            	</foreach>
            	<else />
            		<div class='connected_item'>
            			<div class='friendinfo'>
            				<b>You have no connected friends</b>
            			</div>
            		</div>
            	</if>
            	<if=" $option['paging'] ">
	            	<div class='page'>
	            		<span>Browse Pages:</span>
	            		{$option['paging']}
	            	</div>
            	</if>
            	</div>
            </div>
            <script type='text/javascript'>
            		$('#criteria').change(function(){
	            		$('#mainfsform').submit();
	            	});
	            
	            	$('#searchfriend').click(function(){
	            		$('#mainfsform').submit();
	            	});
	            	
					$('#mainfsform').submit(function(){
						if($('#mainqname').val() == "") return false;
						
						var hidden = '<input type="hidden" name="instant" value="ffriend" />';
						$(this).append(hidden);
						
						var hidden = '<input type="hidden" name="qname" value="'+$('#mainqname').val()+'" />';
						$(this).append(hidden);
						
						var hidden = '<input type="hidden" name="criteria" value="'+$('#criteria').val()+'" />';
						$(this).append(hidden);

					
						vsf.submitForm($(this), '{$option['user']->getAlias()}/filterfriends', 'mainconnected');
						
						$(this).find(":hidden").each(function(){
							$(this).remove();
						});
						return false;
					});
					
					$(document).ready(function(){
						var moptions = {
						    callback:function(){							    	
						    	$('#mainfsform').submit();
							},
						    wait:300,
						    highlight:true,
						    captureLength: 2
						}
						$("#mainqname").typeWatch(moptions);
					});
					
	            	$('.unfriend').click(function(){
	            		var alias = $(this).attr('ref');
	            		var f = $(this).attr('f');
	            		var cbn = f+"concb";
	            		var html = "<div id='"+cbn+"'></div>";
	            		
	            		jConfirm(
							'Are you sure to delete', 
							'Dialog board', 
							function(r){
								if(r){
									$('#'+f).prepend(html);
	            					vsf.get('{$vsUser->obj->getAlias()}/unfriend/&un='+alias+'&f='+f, cbn);
				            		return false;
								}
						});
	            		return false;
	            	});
	            	
	            	$('#tabconnected').ajaxStop(function(){
	            		$('#contabtitle').html('{$option['fmc']}');
					});
            </script>
EOF;
	}
	
	function requests($option){
		global $bw, $vsLang, $vsUser;
		
		$this->board_url = $bw->vars['board_url'];
		$BWHTML .= <<<EOF
            <div id='tabrequests'>
            	<if=" $option['pageList'] ">
            	<foreach=" $option['pageList'] as $friend ">
            		<div class='connected_item' id="request{$friend['friendId']}">
            			<div class='friendinfo'>
            				<div id='{$friend['friendId']}cb' class='message'></div>
            				<a href="{$this->board_url}/{$friend['userAlias']}" class="connected_img">
            					{$friend['userImage']}
            				</a>
            				<div class="connected_info">
            					<p>
									<a href="{$this->board_url}/{$friend['userAlias']}" title="{$friend['userFullname']}">
										{$friend['userFullname']} [{$friend['userAlias']}]
									</a>
									{$friend['profileLocation']}
								</p>
								 <p>Student @ {$friend['userCampusId']}</p>
							</div>
            			</div>
            			<div class='friendoption'>
            				<div class='accept' ref='{$friend['userAlias']}' f="{$friend['friendId']}">            					
            					Accept
            				</div>
            				<div class='reject' ref='{$friend['userAlias']}' f="{$friend['friendId']}">            					
            					Reject
            				</div>
            			</div>
            			<div class='clear'></div>
            		</div>
            	</foreach>
            	<else />
	            	<div class='connected_item'>
            			<div class='friendinfo'>
            				<b>You have no friend requests</b>
            			</div>
            		</div>
            	</if>
            	<if=" $option['paging'] ">
            	<div class='page'>
            		<span>Browse Pages:</span>
            		{$option['paging']}
            	</div>
            	</if>
            </div>
            <script type='text/javascript'>
            	$('.accept').click(function(){
            		var alias = $(this).attr('ref');
            		var f = $(this).attr('f');
            		
            		vsf.get('{$vsUser->obj->getAlias()}/acceptfriend/&un='+alias+'&f='+f, f+'cb');
            		return false;
            	});
            	
            	$('.reject').click(function(){
            		var alias = $(this).attr('ref');
            		var f = $(this).attr('f');
            		
            		vsf.get('{$vsUser->obj->getAlias()}/rejectfriend/&un='+alias+'&f='+f, f+'cb');
            		return false;
            	});
            	
            	$('#tabrequests').ajaxStop(function(){
            		$('#reqtabtitle').html('{$option['fmc']}');
				});
            </script>
EOF;
	}

	function findfriends($option){
		global $bw, $vsLang, $vsUser;
		
		$this->board_url = $bw->vars['board_url'];
		$BWHTML .= <<<EOF
            <div id='tabfindfriend'>
            	<div id='formcontainer' style='margin-top: 5px;'>
	            	<form id='formfindfriend' method='POST' class="search_friend">
	            		<div class="search_friend_tt">
			            	<input value='' id='qname'/>
			            </div>
		            	<input type='button' name='submit' value='Find' class='search_friend_btn' id='submitformfindfriend' />
		            </form>
	            </div>
	            <div id='f_friendlist'></div>
            </div>
            <script type="text/javascript">
            	$('#submitformfindfriend').click(function(){
            		$('#formfindfriend').submit();
            	});
            
				$('#formfindfriend').submit(function(){
					var hidden = '<input type="hidden" name="instant" value="ffriend" />';
					$(this).append(hidden);
					
					var hidden = '<input type="hidden" name="qname" value="'+$('#qname').val()+'" />';
					$(this).append(hidden);
					
					
					vsf.submitForm($(this), '{$vsUser->obj->getAlias()}/findfriends', 'f_friendlist');
					
					$(this).find(":hidden").each(function(){
						$(this).remove();
					});
					return false;
				});
				
				$(document).ready(function(){
					var options = {
					    callback:function(){							    	
					    	$('#formfindfriend').submit();
						},
					    wait:300,
					    highlight:true,
					    captureLength: 2
					}
					$("#qname").typeWatch(options);
				});
			</script>
EOF;
	}
	

	function lists($option = array()){
		global $bw, $vsLang, $vsUser;
		
		$this->board_url = $bw->vars['board_url'];
		$this->img_url = $bw->vars['img_url'];
		
		$BWHTML .= <<<EOF
            <div id='tablists'>
            	<div id='addgroupcontainer'>
            		<div id='agc_mainaddc'>
            			<div id='agc_mainadd' class='friend_add_friend'>Add Group</div>
            		</div>
            		<div class='clear'></div>
            		<div id='agc_friendlist' style='display:none;'>
            			<form id='agc_addform' action='POST'>
            				<input name='gname' id='gname' value='' placeholder='Separate groups by commas' />
            				<input type='button' name='Add' value='Add' class='friend_add_friend agc_addfriend' id='sagc_addform'/>
            				<div class='clear'></div>
            			</form>
            		</div>
            		<div id='cbtemp'></div>
            	</div>
            	<div id="accordion">
	            	{$this->mainlists($option)}
 				</div>
            	
            	<if=" $option['paging'] ">
            	<div class='page'>
            		<span>Browse Pages:</span>
            		{$option['paging']}
            	</div>
            	</if>
            	<script type='text/javascript'>
            		var flag = true;
            		$('#agc_mainadd').click(function(){
            			if(flag){
            				$('#agc_friendlist').toggle("slow", function(){
								$('#agc_friendlist').css({display: "block"}).show();
							});							
            			}else{
            				$('#agc_friendlist').toggle("slow", function(){
								$('#agc_friendlist').css({display: "none"}).hide();
							});	
            			}
            			flag = !flag;
            		});
            		
            		$('#sagc_addform').click(function(){
            			if($('#gname').val().length < 2){
            				var html = "<div id='message' class='message'>Please enter a group name</div>";
            				$('#agc_addform').prepend(html);
            				return false;
            			}
            			$('#message').remove();
            			vsf.submitForm($('#agc_addform'), '{$vsUser->obj->getAlias()}/addlist', 'cbtemp');
            			return false;
            		});
            		
            		bindAddGroupEnter();
            		function bindAddGroupEnter(){
            			$('#agc_addform').unbind('keypress');
						$('#gname').bind('keypress', function(e) {
                			var code = (e.keyCode ? e.keyCode : e.which);
							if(code == 13) {
								$('#sagc_addform').click();
								return false;
							}
						});
					}
            	</script>
            </div>
EOF;
	}

	function mainlists($option = array()){
		global $bw, $vsLang, $vsUser;
		
			$this->board_url = $bw->vars['board_url'];
			$this->img_url = $bw->vars['img_url'];
		
			$time = time();
					$BWHTML .= <<<EOF
						<if=" $option['groups'] ">
		            	<foreach=" $option['groups'] as $key => $group ">
							<div id='dt_accordion_{$key}' class='accheader'>
								<span class="accheader_title">{$group['groupTitle']}</span>
								<div class='optioncon' ref="{$key}">
									<span class="option_tab" ref='{$key}'>Option</span>
					                <div class="option_hidden" id='option_{$key}'>
					                	<span l="{$key}" class='addtolist'>Add friend</span>
					                    <span l="{$key}" class='removelist'>Remove list</a>
					                </div>
				                </div>
				                <div class='clear'></div>
							</div>
							<div id='dd_accordion_{$key}' class='acccontent'>
								<div id='accordion_{$key}cb'></div>
								<div id='{$key}_friendlist' style='display:none;'></div>
								
								<div id='accordion_{$key}_child'>
								<if=" $option['pageList'][$key] ">
				            	<foreach=" $option['pageList'][$key] as $friend ">
					            	<div class='connected_item' id="{$friend['gdId']}">
				            			<div class='friendinfo'>
				            				<div id='{$friend['gdId']}cb' class='message'></div>
				            				<a href="{$this->board_url}/{$friend['userAlias']}" class="connected_img">
				            					{$friend['userImage']}
				            				</a>
				            				<div class="connected_info">
				            					<p>
													<a href="{$this->board_url}/{$friend['userAlias']}" title="{$friend['userFullname']}">
														{$friend['userFullname']} [{$friend['userAlias']}]
													</a>
													{$friend['profileLocation']}
												</p>
												<if=" $friend['userCampusId'] ">
												<p>Student @ {$friend['userCampusId']} </p>
												</if>
											</div>
				            			</div>
				            			<div class='friendoption'>
				            				<div class='rmlist remove' ref='{$friend['userAlias']}' f="{$friend['userId']}" l="{$friend['gdGroup']}" gd='{$friend['gdId']}'>            					
				            					<img src="{$this->img_url}/del_png.png" alt='remove' />
				            				</div>
				            			</div>
				            			<div class='clear'></div>
				            		</div>
			            		</foreach>
			            		</if>
			            		</div>
							</div>
						</foreach>
						<else />
						<div class='connected_item'>
	            			<div class='friendinfo'>
	            				<b>You have no groups</b>
	            			</div>
	            		</div>
						</if>
			
			<script type='text/javascript'>
				function bindAccordion(){
            		var count = 1000;
            		$('#accordion').accordion("destroy");
	            	$("#accordion .accheader span.option_tab").each(function(){
	            		var temp = count;
	            		$(this).css("z-index", temp);
	            		$(this).next().css("z-index", temp-1);
	            		count = count - 2; 
	            	});
	            	
	            	$( "#accordion" ).accordion({
						'header': 'div.accheader',
						'autoHeight': false 
					});
            	}	
			
				function bindRMList(){
					$('.rmlist').click(function(){
	            		var alias = $(this).attr('ref');
	            		var f = $(this).attr('f');
	            		var l = $(this).attr('l');
	            		var gd= $(this).attr('gd');
	            		
	            		var l = $(this).attr('l');
	            		jConfirm(
							'Are you sure to delete', 
							'Dialog board', 
							function(r){
								if(r){
				            		vsf.get('{$vsUser->obj->getAlias()}/delfromlist/&un='+alias+'&f='+f+'&l='+l+'&gd='+gd, gd+'cb');
				            		return false;
								}
						});
	            	});
            	}
            	
            	function bindAF2List(){
	            	$('.af2list').click(function(){
	            		$('.token-input-dropdown-facebook').css('display','none');
	            		$('.agen').remove();
	            		
	            		var l = $(this).attr('l');
	            		
	            		var hidden = "<input type='hidden' value='" + l + "' name='l' class='agen' />";
	            		$('#'+l+'_addform').append(hidden);
	            		
	            		var hidden = "<input type='hidden' value='" + $("#gname"+l).val() + "' name='gname' class='agen' />";
	            		$('#'+l+'_addform').append(hidden);
	            		
          				vsf.submitForm($('#'+l+'_addform'), '{$vsUser->obj->getAlias()}/af2list', 'accordion_'+l+'cb');
	            		return false;
	            	});	
            	}
            	
            	function bindAddFriendTokenInput(){
		            $(".afgn").tokenInput("{$bw->vars['board_url']}/{$vsUser->obj->getAlias()}/suggest/&ajax=1&js=js", {
		                theme: "facebook",
		                minChars: 2,
		                preventDuplicates: true,
		                searchDelay: 300,
		                customFunction: 'DblEnterSent'
		            });
            	}
            	
            	$(document).bind('DblEnterSent', function(event, l){
                	$('#af2list'+l).click();
				});
					
            	$('.addtolist').click(function(){
            		var l = $(this).attr('l');
            		
            		var html = 	"<div id='"+l+"_addform_cb' class='temp'></div>"+
            					"<form id='"+l+"_addform' action='POST' class='addform temp'>"+
		            			"	<input id='gname"+l+"' class='gname afgn' l='"+l+"' value='' placeholder='Separate friends by commas' />"+
		            			"	<input type='button' name='Add' value='Add' class='friend_add_friend af2list' l='"+l+"' id='af2list"+l+"'/>"+
		            			"	<div class='clear'></div>"+
		            			"</form>";
		            			
		            $('#'+l+'_friendlist').html(html);
		            
		            $('#'+l+'_friendlist').toggle("slow", function(){
						$('#'+l+'_friendlist').css({display: "block"}).show();
					});	
					
					bindAF2List();
					bindAddFriendTokenInput();
					
					$('#dt_accordion_'+l).click();
            		return false;
            	});
            	
            	
				$(document).ready(function(){
	            	bindAccordion();
	            	bindOptionCon();
	            	bindRMList();
            	});
            	
				
				function bindOptionCon(){
					$('.optioncon').unbind('mouseenter mouseleave');
	            	$('.optioncon').hover(
	            		function(){
							var ref = $(this).attr('ref');
							$('#option_'+ref).css({display: "block"}).show();
						},
	            		function(){
		            		var ref = $(this).attr('ref');
							$('#option_'+ref).css({display: "none"}).hide();
						}	
					);
				}
				
				$('.removelist').click(function(){
            		var l = $(this).attr('l');
            		jConfirm(
						'Are you sure to delete', 
						'Dialog board', 
						function(r){
							if(r){
			            		vsf.get('{$vsUser->obj->getAlias()}/deletelist/&l='+l,'accordion_'+l+'cb');
			            		return false;
							}
					});
            	});
            </script>
EOF;
	}
	
	
	function af2list($option = array()){
		global $bw, $vsLang;
		
		$this->board_url = $bw->vars['board_url'];
		$this->img_url = $bw->vars['img_url'];
	
		$BWHTML .= <<<EOF
						<div id='temp_cb_{$option['list']}' style='display:none;'>
							<if=" $option['pageList'] ">
			            	<foreach=" $option['pageList'] as $friend ">
				            	<div class='connected_item' id="{$friend['gdId']}">
			            			<div class='friendinfo'>
			            				<div id='{$friend['gdId']}cb'></div>
			            				<a href="{$this->board_url}/{$friend['userAlias']}" class="connected_img">
											{$friend['userImage']}
			            				</a>
			            				<div class="connected_info">
			            					<p>
												<a href="{$this->board_url}/{$friend['userAlias']}" title="{$friend['userFullname']}">
													{$friend['userFullname']} [{$friend['userAlias']}]
												</a>
												{$friend['profileLocation']}
											</p>
											 <p>Student @ {$friend['userFullname']}</p>
										</div>
			            			</div>
			            			<div class='friendoption'>
			            				<div class='rmlist remove' ref='{$friend['userAlias']}' f="{$friend['userId']}" l="{$friend['gdGroup']}" gd='{$friend['gdId']}'>            					
			            					<img src="{$this->img_url}/del_png.png" alt='remove' />
			            				</div>
			            			</div>
			            			<div class='clear'></div>
			            		</div>
		            		</foreach>
		            		</if>
		            	</div>
	            		<script type='text/javascript'>
	            			$('.temp').remove();
	            			
	            			var html = 	"<div class='message' id='message'>Friend added</div>"+
	            						$('#temp_cb_{$option['list']}').html();
	            			$('#accordion_{$option['list']}_child').html(html);
	            			
	            			setTimeout(function(){
					        	$('#message').toggle("slow", function(){
									$(this).remove();
								});
					        }, 2000);
	            			bindRMList();
		            	</script>
EOF;
	}

	function inviteFriends($option){
		global $bw, $vsLang, $vsUser;
		
		$this->board_url = $bw->vars['board_url'];
		$this->img_url	 = $bw->vars['img_url'];
		
		$BWHTML .= <<<EOF
            <div id='tabif'>
            	<div id='invitefriend'>	
	            	<div>Start referring friends now, earn rewards in the future</div>
	            	<div>
	            		<span>Total referrals: </span>{$vsUser->obj->getReferral()}
	            	</div>
	            	<div>
	            		<span>Your referral link: </span>{$bw->vars['board_url']}/users/signup/&ref={$vsUser->obj->getAlias()}
	            	</div>
	            	<div>To refer a friend, enter your friend's email address below</div>
	            	
	            	<div id='refer_cb'></div>
	            	<form id='referForm' action='POST'>
	            		<textarea name='emails' placeholder="Separate emails by line" id='emails'></textarea>
	            		<input type='button' name='submit' id='refbutton' value='Send' class='refbutton'/>
	            	</form>
            	</div>
            </div>
            <script>
            	$('#refbutton').click(function(){
            		if($('#emails').val() == "") return false;
            		vsf.submitForm($('#referForm'), '{$vsUser->obj->getAlias()}/refer', 'refer_cb');
            		return true;
            	});
            </script>
EOF;
	}
	
	
	
	function rightPortlet($option = array()){
		global $bw, $vsLang, $vsUser;
		
		$BWHTML .= <<<EOF
			<div id="profile_right">
    	<div id="profile_right_tab">
            <ul>
                <li><a href="#fragment-30"><span>Calendar</span></a></li>
                <li><a href="#fragment-31"><span>Note</span></a></li>
                <li><a href="#fragment-32"><span>To do list</span></a></li>
            </ul>
            <div id="fragment-30">
            	<img src="{$bw->vars['img_url']}/profile_calendar.jpg" />
            </div>
            <div id="fragment-31">
            </div>
            <div id="fragment-32">
            </div>
        </div>
        <!-- STOP PROFILE RIGHT TAB -->
        
        <if=" $option['friends'] ">
        <div class="profile_right_friends">
        	<div class="profile_right_friends_title">
            	<p style="font-size:12px;" title="See {$vsUser->obj->getAlias()}'s all friends">
            		<strong>Friends</strong> ({$option['totalfriend']})
            	</p>
                <a href="{$bw->vars['board_url']}/{$vsUser->obj->getAlias()}/friendmanager" title="See {$vsUser->obj->getAlias()}'s all friends">See all</a>
            </div>
             <foreach=" $option['friends'] as $friend ">
	            <a href="{$this->board_url}/{$friend->getAlias()}" title="{$friend->getAlias()}'s profile">
					{$friend->createImageCache($friend->getImage(), 50, 50, 0, 1)}
					<span>{$friend->getAlias()}</span>
				</a>
            </foreach>
            <div class="clear_left"></div>
        </div>
        </if>
        <div class="profile_right_friends">
        	<div class="profile_right_friends_title">
            	<p style="font-size:12px;"><strong>Network/Groups</strong></p>
                <img img src="{$bw->vars['img_url']}/network_icon.jpg" />
            </div>
            <p>SJSU Alumni</p>
            <p>SJSU Alumni</p>
            <p>VESA</p>            
            <p>VESA</p>
            <p>AADPA</p>
            <p>AADPA</p>
            <div class="clear_left"></div>
        </div>    
    </div>
    <script type="text/javascript">
      $(function() {
		  $('#profile_right_tab').tabs({ fxFade: true, fxSpeed: 'fast'});
      });
	</script>

EOF;
	}
}
?>