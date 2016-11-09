<?php
class skin_comments{

	function getHome($option = array()){
		global $bw, $vsLang;
		
		$this->board_url = $bw->vars['board_url'];
		$BWHTML .= <<<EOF
			<div id="content1">
	        	<div id="content_left">
		            <form action="{$bw->vars['board_url']}/status/comment" method='POST'>
		            	<input name='status' value='' />
		            	<input type='submit' name='submit' value='submit' />
		            </form>
		            
		            <div id=''>
		            	<if=" $option['pageList'] ">
		            	<foreach=" $option['pageList'] as $friend ">
		            		<div class='item'>
		            			
		            			{$friend->getFullname()} 
		            			{$friend->getName()} 
		            			
		            			<a href='{$this->board_url}/status/askforfriend/{$friend->getId()}'>
		            				ask for friend
		            			</a>
		            		</div>
		            	</foreach>
		            	</if>
		            </div>
		        </div>
	    	</div>
	    	<div class="clear"></div>
EOF;
	}
	
	function getNewFeed($option= array()){
		global $bw, $vsLang, $vsUser;

		$this->board_url = $bw->vars['board_url'];
		$BWHTML .= <<<EOF
			<div id="profile_left">
		    	<div class="profile_left_top">
		        	<div style="line-height:26px;">
		                <div class="profile_avatar">{$option['user']->createImageCache($option['user']->getImage(), 85, 115, 0, 1)}</div>
		                <p class="profile_nick"><span>{$option['user']->getFullname()}</span> [Male, San Jose, CA]</p>
		                <p>Student @ San Jose State University </p>
		                <p><strong>Ellectrial Engineering</strong></p>
		                <div class="clear_left"></div>
		            </div>
		            
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
		        </div>
		        
		        <div id="profile_tab">
		            <ul>
		                <li><a href="#fragment-20"><span>Updates</span></a></li>
		                <li><a href="#fragment-21"><span>Listing</span></a></li>
		                <li><a href="#fragment-22"><span>Info</span></a></li>
		            </ul>

		            <div id="fragment-20">
		            	<if=" $option['pageList'] ">
		            	<foreach=" $option['pageList'] as $comment ">
		                <div class="update_item">
		                	<div class="update_avatar">
		                		<a href="{$this->board_url}/{$comment->alias}" title="{$comment->alias}">
		                		{$option['user']->createImageCache($comment->image, 50, 50, 0, 1)}
		                		</a>
		                	</div>
		                    <div class="update_comment" id="{$comment->getId()}">
		                    	<div>
			                    	<p style="color:#808080">
			                    		<a href="{$this->board_url}/{$comment->alias}"><strong>{$comment->alias}</strong></a> 
			                    	</p>
			                        <p>{$comment->getContent()}</p>
			                    	<p style="line-height:30px;">
			                    		{$comment->getTime('real')} 
			                    		<a href="javascript:;" class='commentbutton' level="0" ref="{$comment->getId()}">Comment</a>
			                    	</p>
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
			                                    <p>{$level1->getContent()}</p>
			                                    <div class="clear_left"></div>
			                                    <p class="tab_comment_date">
			                                    	{$level1->getTime('real')}
			                                    	<a href="javascript:;" class='commentbutton' level='1' ref="{$level1->getId()}">Comment</a>
			                                    </p>
			                                </div>
			                                <div class="clear"></div>
			                            </div>
			                            
			                            <if=" $level1->children ">
			                            <div class="tab_comment_item_sub">
			                            	<foreach=" $level1->children as $level2 ">
			                        		<div class="tab_comment_item_center_sub" id="{$level1->getId()}">
			                        			<p style="color:#808080">
			                                    <a href="{$this->board_url}/{$level2->alias}" class="avatar_comment" title="{$level2->alias}">
			                                    	{$option['user']->createImageCache($level2->image, 50, 50, 0, 1)}
			                                    </a>
			                                    </p>
			                                    <div class="comment_info_sub">
			                                        <a href="{$this->board_url}/{$level2->alias}" class="nick_comment">{$level2->alias}</a>
			                                        <p>{$level2->getContent()}</p>
			                                        <div class="clear_left"></div>
			                                        <p class="tab_comment_date">{$level2->getTime('real')}</p>
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
		            
		            <div id="fragment-21">
		            	Listing tab
		            </div>
		            <div id="fragment-22">
		            	Info tab
		            </div>
		        </div>    
		    </div>
		    {$this->rightPortlet()}
		    		
	    	<script type='text/javascript'>
	    		var htmlclass = {0:'tab_comment_form', 1:'tab_comment_form_sub'};
	    		
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
							
			    			vsf.submitForm($('#form_'+id), '{$vsUser->obj->getAlias()}/comment', 'form_'+id+'_cb');
			    			return false;
						});
					});
    			}
	    		
				
	    		$(function() {
					$('#profile_tab').tabs({ fxFade: true, fxSpeed: 'fast' });
				});
			</script>
EOF;
	}
	
	
	function commentCallback($option){
		global $bw, $vsLang, $vsUser;

		$BWHTML .= <<<EOF
			<script type="text/javascript">
				$('.auto').remove();
				$('.commentbutton').unbind('click');
				
				
				var cbclass 	= {1:'tab_comment_item_center', 2:'tab_comment_item_center_sub'};
				var cbcontent 	= {1:'comment_info', 2:'comment_info_sub'};
				
				
				var comment = "";
				if({$option['level']} < 2)
					comment = 	"<a ref='{$option['curId']}' level='{$option['level']}' class='commentbutton' href='javascript:;'>Comment</a>";

				if({$option['level']} == 0){
					var html = 	"<div class='update_item'>"+
								"		<div class='update_avatar'>"+
		                        "            	{$vsUser->obj->createImageCache($vsUser->obj->getImage(), 50, 50, 0, 1)}"+
		                        "       </div>"+
		                        "       <div id='{$option['curId']}' class='update_comment'>"+
		                        "			<div>"+
		                        "				<p style='color:#808080'>"+
		                        "       			<a href='#'><strong>{$vsUser->obj->getAlias()}</strong></a>"+
		                        "				</p>"+
		                        "           	<p>{$option['content']}</p>"+
		                        "           	<p style='line-height:30px;'>a few seconds ago " + comment + "</p>"+
		                        "           </div>"+
		                        "       </div>"+
		                        "       <div class='clear'></div>"+
		                        "	</div>"+
		                        "</div>";
					$('#fragment-20').prepend(html);
					$('#status').val('');
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
			                        "           <p>{$option['content']}</p>"+
			                        "           <div class='clear_left'></div>"+
			                        "           <p class='tab_comment_date'>a few seconds ago " + comment + "</p>"+
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
			                        "           <p>{$option['content']}</p>"+
			                        "           <div class='clear_left'></div>"+
			                        "           <p class='tab_comment_date'>a few seconds ago " + comment + "</p>"+
			                        "       </div>"+
			                        "       <div class='clear'></div>"+
			                        "	</div>"+
			                        "	</div>";
					}
					
					var parent	= '';
					if({$option['level']} > 0) parent = 'sub';
					
					$('#'+parent+'{$option['original']}').append(html);
					
					if($('#'+parent+'{$option['original']}').hasClass('tab_comment_form_sub_nobackground')){
						$('#'+parent+'{$option['original']}').removeClass('tab_comment_form_sub_nobackground');
						if(!$('#'+parent+'{$option['original']}').hasClass('tab_comment_item_sub'))
							$('#'+parent+'{$option['original']}').addClass('tab_comment_item');
					}
				}
				
				bindCommentButtonClick();
			</script>
EOF;
	}

	function searchFriend($option = array()){
		global $bw, $vsLang;
		
		$this->board_url = $bw->vars['board_url'];
		$BWHTML .= <<<EOF
			<div id="content1">
	        	<div id="content_left">
		            <form action="{$bw->vars['board_url']}/status/searchfriend" method='POST'>
		            	<input name='qname' value='' />
		            	<input type='submit' name='submit' value='submit' />
		            </form>
		            
		            <div id=''>
		            	<if=" $option['pageList'] ">
		            	<foreach=" $option['pageList'] as $friend ">
		            		<div class='item'>
		            			
		            			{$friend->getFullname()} 
		            			{$friend->getName()} 
		            			
		            			<a href='{$this->board_url}/status/askforfriend/{$friend->getId()}'>
		            				ask for friend
		            			</a>
		            		</div>
		            	</foreach>
		            	</if>
		            </div>
		        </div>
	    	</div>
	    	<div class="clear"></div>
EOF;
	}


	
	function getNotice($option){
		global $bw, $vsLang;
		
		$this->board_url = $bw->vars['board_url'];
		$BWHTML .= <<<EOF
			<div id="content1">
	        	<div id="content_left">
		            <form action="{$bw->vars['board_url']}/status/searchfriends" method='POST'>
		            	<input name='qname' value='' />
		            	<input type='submit' name='submit' value='submit' />
		            </form>
		            
		            <div id=''>
		            	<if=" $option['pageList'] ">
		            	<foreach=" $option['pageList'] as $notice ">
		            		<div class='item'>
		            			
								{$notice->getId()} - {$notice->getContent()} 
		            			 
		            			
		            			<a href='{$this->board_url}/status/askforfriend/accept/{$notice->getObj()}/&n={$notice->getId()}'>
		            				accept
		            			</a>
		            			<a href='{$this->board_url}/status/askforfriend/deny/{$notice->getObj()}'/&n={$notice->getId()}>
		            				deny
		            			</a>
		            		</div>
		            	</foreach>
		            	</if>
		            </div>
		        </div>
	    	</div>
	    	<div class="clear"></div>
EOF;
	}


	function getFriends($option){
		global $bw, $vsLang;
		
		$this->board_url = $bw->vars['board_url'];
		$BWHTML .= <<<EOF
			<div id="content1">
	        	<div id="content_left">
		            <div id=''>
		            	<if=" $option['pageList'] ">
		            	<foreach=" $option['pageList'] as $user ">
		            		<div class='item'>
								{$user->getId()} - {$user->getFullname()} 
		            			
		            			<a href='{$this->board_url}/status/unfriend/&f={$user->ifriend->getFriend()}'>
		            				unfriend
		            			</a>
		            		</div>
		            	</foreach>
		            	</if>
		            </div>
		        </div>
	    	</div>
	    	<div class="clear"></div>
EOF;
	}


	function rightPortlet(){
		global $bw, $vsLang;
		
		
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
        
        <div class="profile_right_friends">
        	<div class="profile_right_friends_title">
            	<p style="font-size:12px;"><strong>Friends</strong> (300)</p>
                <a href="#">See all</a>
            </div>
            <a href="#"><img src="{$bw->vars['img_url']}/img1.jpg" /> <span>Roger Vilà</span></a>
            <a href="#"><img src="{$bw->vars['img_url']}/img1.jpg" /> <span>Roger Vilà</span></a>
            <a href="#"><img src="{$bw->vars['img_url']}/img1.jpg" /> <span>Roger Vilà</span></a>
            <a href="#"><img src="{$bw->vars['img_url']}/img1.jpg" /> <span>Roger Vilà</span></a>
            <a href="#"><img src="{$bw->vars['img_url']}/img1.jpg" /> <span>Roger Vilà</span></a>
            <a href="#"><img src="{$bw->vars['img_url']}/img1.jpg" /> <span>Roger Vilà</span></a>
            <a href="#"><img src="{$bw->vars['img_url']}/img1.jpg" /> <span>Roger Vilà</span></a>
            <a href="#"><img src="{$bw->vars['img_url']}/img1.jpg" /> <span>Roger Vilà</span></a>
            <div class="clear_left"></div>
        </div>
        
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
          $('#pro_tab').tabs({ fxFade: true, fxSpeed: 'fast' });
		  $('#profile_right_tab').tabs({ fxFade: true, fxSpeed: 'fast' });
      });
	</script>

EOF;
	}
}
?>