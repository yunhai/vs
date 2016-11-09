<?php
class skin_messages{

	function detail($obj, $option){
		global $vsLang, $bw, $vsUser;

		$this->vsLang = $vsLang;
		$this->vsUser = $vsUser;
		$this->board_url = $bw->vars['board_url'];
		
		$BWHTML .= <<<EOF
			<h3 class="mess_title">{$obj->getTitle()}</h3>
            <div class="link_nick" id='recipient'>
            	<span class="form">From:</span>
                <a href="#" class="form">{$option['user'][$obj->getUser()]['name']}</a>
                <if=" $option['recipient'] ">
                <span class="form">to</span>
                <foreach=" $option['recipient'] as  $key=>$recipient">
                	<a href="#">{$option['user'][$key]['name']}</a>
                	<span>,&nbsp;</span>
				</foreach>
				</if>
                <div class="clear_left"></div>
            </div>
            
            <if=" $obj->deliverStatus ">
            <div class="mess_item">
            	<a href="#" class="mess_item_img">
            		<if=" $option['user'][$obj->getUser()]['image'] ">
						{$obj->createImageCache($option['user'][$obj->getUser()]['image'],50,50)}
					<else />
						<img src="{$bw->vars['img_url']}/noavatar.png" alt="{$vsLang->getWords('global_no_image','No Image')}" width="50" height="50" />
					</if>
            	</a>
                <div class="mess_item_info">                	
                    <div>
                    	<a href="{$option['user'][$obj->getUser()]['profile']}" class='sender' title="{$option['user'][$obj->getUser()]['profile_title']}">
							{$option['user'][$obj->getUser()]['name']}
						</a>
						{$obj->getContent(0, 1)}
                    </div>
                    <span>{$obj->getPostdate('real')}</span>                    
                </div>
                <if=" $obj->attfiles ">
                <div class="mess_item_info">
                	<foreach=" $obj->attfiles as $attfile">
                    <div class='attfile'>
                    	<div class='preview'>
                    		{$attfile->show(200, 0)}
                    	</div>
                    	<div class='option'>
	                    	<a href="{$this->board_url}/files/download/{$attfile->getId()}/0" title="{$attfile->getTitle()}">
	                    		Download
	                    	</a>
                    	</div>
                    	<div class="clear"></div>
                    </div>
                   	</foreach>
                </div>
                </if>
                <div class="clear"></div>
                <div class='option'>
	                <a class="link_reply" rel="{$obj->getId()}" title="{$this->vsLang->getWords('reply_title','reply this message')}" href="javascript:;">Reply</a>
	                <a class="link_forward" rel="{$obj->getId()}" title="{$this->vsLang->getWords('forward_title','forward this message')}" href="javascript:;">Forward</a>
	                <a class="link_delete" cur="{$obj->getId()}" title="{$this->vsLang->getWords('delete_title','delete this message')}" href="javascript:;">Delete</a>
	                <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div id='form_con_{$obj->getId()}' rel='{$obj->getId()}'></div>
            </div>
            </if>
            
            <if=" $option['pageList'] ">
            <foreach=" $option['pageList'] as $mes ">
            <div class="mess_item">
            	<a href="#" class="mess_item_img">
            		<if=" $option['user'][$obj->getUser()]['image'] ">
						{$obj->createImageCache($option['user'][$obj->getUser()]['image'],50,50)}
					<else />
						<img src="{$bw->vars['img_url']}/noavatar.png" alt="{$vsLang->getWords('global_no_image','No Image')}" width="50" height="50" />
					</if>
            	</a>
                <div class="mess_item_info">
					<p>
						<a href="#">{$option['user'][$mes->getUser()]['name']}</a>
                    	{$mes->getContent()}
                   	</p>
                    <span>{$mes->getPostdate('real')}</span>                    
                </div>
                <if=" $mes->attfiles ">
                <div class="mess_item_info">
                	<foreach=" $mes->attfiles as $attfile">
                    <div class='attfile'>
                    	<div class='preview'>
                    		{$attfile->show(200, 0)}
                    	</div>
                    	<div class='option'>
	                    	<a href="{$this->board_url}/files/download/{$attfile->getId()}/0" title="{$attfile->getTitle()}">
	                    		Download
	                    	</a>
                    	</div>
                    	<div class="clear"></div>
                    </div>
                   	</foreach>
                </div>
                </if>
                <div class="clear"></div>
                <div class='option'>
	                <a rel="{$mes->getId()}" class="link_reply" title="{$this->vsLang->getWords('reply_title','reply this message')}" href="javascript:;" >Reply</a>
	                <a rel="{$mes->getId()}" class="link_forward" title="{$this->vsLang->getWords('forward_title','forward this message')}" href="javascript:;" >Forward</a>
	                <a rel="{$mes->deliverId}" <if="$mes->getUser() == $this->vsUser->obj->getId()">cur='{$mes->getId()}'</if> class="link_delete" title="{$this->vsLang->getWords('delete_title','delete this message')}" href="javascript:;" >Delete</a>
                	<div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div id='form_con_{$mes->getId()}' rel='{$mes->getId()}'></div>
            </div>
            </foreach>
            </if>

            <div id='topcon'></div>
            <div id='reply'><input type='hidden' name='allrecipient' id='allrecipient' value='{$option['allrecipient']}' /></div>
            <div id='forward'></div>
            <div id='temp' style='display:none;'></div>
            <input type='hidden' id='currentURL' value='{$option['detailId']}' />
            <style>
				.ui-dialog { position: absolute !important;}
			</style>
            <script type='text/javascript'>
      			$("#recipient span:last").html('');
            	
      			$(".link_delete").each(function(){
		   			$(this).bind("click", function(e){
		   				var curstr = '';
		   				if(typeof($(this).attr('cur')) != 'undefined')
		   					curstr = '<input type="hidden" name="deliverCur" value="'+$(this).attr('cur')+'" />';
		   				
		   				linkdelete(curstr, $(this).attr('rel'));
					});
		   		});
		   		
		   		function linkdelete(curstr, irel){
		   			jConfirm(
							'Are you sure to delete', 
							'Dialog board', 
							function(r){
								if(r){
					   				var temp = 	'<form id="deleteForm" method="POST" >'+
					   							'<input type="hidden" name="deliverId" value="'+irel+'" />'+
					   							'<input type="hidden" name="objGroup" value="{$obj->getGroup()}" />'+
					   							curstr +
					   							'<input type="hidden" name="detailURL" value="{$option['detailId']}" />'+
					   							'</form>'
					   				$('#temp').append(temp);
					   				vsf.submitForm($('#deleteForm'), 'messages/delete', 'main_content_container');
					   				$.blockUI({
							       		css: {
							        		border: 'none',
				            				padding: '50px',
								            backgroundColor: '#C0C0C0',
								            color: '#000',
								            cursor:'progress'
								        }
									});
				   				}
							}
						)
		   		}
      			
            	$(".link_reply").each(function(){
		   			$(this).bind("click", function(e){
						var option = {
										title: '{$vsLang->getWords('reply_message','Reply message')}',
										width: 600,
										height: 600,
										params:{
											mainmod: "messages",
											mtype:	 "individual",
											popupId: 'abc'										}
									};
						vsf.popupLightGet('messages/popup/', 'abc', option);
		   				
   					//	vsf.get('messages/reply/'+$(this).attr('rel'), 'form_con_'+$(this).attr('rel'));
		   				return true;
					});
		   		});
			   		
		   		$(".link_forward").each(function(){
		   			$(this).bind("click", function(e){
		   				$('#editForm').remove();
		   				vsf.get('messages/forward/'+$(this).attr('rel'), 'form_con_'+$(this).attr('rel'));
		   				return false;
					});
		   		});
		   		
		   		$(".marklabel").each(function(){
		   			$(this).bind("click", function(e){
		   				var temp = 	'<form id="markForm" method="POST">'+
		   							'<input type="hidden" name="curmod" value="{$bw->input[1]}" />' +
			   						'<input type="hidden" name="curact" value="{$bw->input[2]}" />' +
		   							'<input type="hidden" name="lma" value="mark" />'+
		   							'<input type="hidden" name="lmt" value="1" />'+
		   							'<input type="hidden" name="lmo" value="{$obj->getId()}" />'+
		   							'<input type="hidden" name="lmi" value="'+$(this).attr('rel')+'" />'+
		   							'<input type="hidden" name="detailURL" value="{$option['detailId']}" />'+
		   							'</form>'
		   				$('#temp').append(temp);
		   				
		   				$.blockUI({
				        	css: {
				        		border: 'none',
	            				padding: '50px',
					            backgroundColor: '#C0C0C0',
					            color: '#000',
					            cursor:'progress'
					        }
						});
		   				vsf.submitForm($('#markForm'), 'messages/label', 'temp');
		   				
		   				$(document).ajaxStop(function(){
							setTimeout(function(){
								$.unblockUI();
							}, 1000);
						});
						return false;
					});
		   		});

		   		$('#replyTop').click(function(){
			   		$('#editForm').remove();
			   		vsf.get('messages/reply/{$obj->getId()}/&recipient={$option['allrecipient']}', 'topcon');
			   		return false;
			   	});
			   	
			   	$('#forwardTop').click(function(){
			   		$('#editForm').remove();
			   		vsf.get('messages/forward/{$obj->getId()}', 'topcon');
			   		return false;
			   	});
			   	
		   		$('#deleteDetail').click(function(){
	   				jConfirm(
						'Are you sure to delete', 
						'Dialog board', 
						function(r){
							if(r){
								var temp = 	'<form id="deleteForm" method="POST">'+
				   							'<input type="hidden" name="da" value="da" />'+
				   							'<input type="hidden" name="g" value="{$obj->getGroup()}" />'+
				   							'<input type="hidden" name="do" value="{$obj->getId()}" />'+
				   							'</form>';
				   				$('#temp').append(temp);
				   				vsf.submitForm($('#deleteForm'), 'messages/delete', 'main_content_container');
				   				$.blockUI({
							        css: {
							        		border: 'none',
				            				padding: '50px',
								            backgroundColor: '#C0C0C0',
								            color: '#000',
								            cursor:'progress'
								        }
								});
				   				$(document).ajaxStop(function(){
									setTimeout(function(){
										$.unblockUI();
									}, 1000);
								});
								return false;
			   				}
						}
					);	
				});
				
				$('#spamDetail').click(function(){
	   				var temp = 	'<form id="spamForm" method="POST">'+
	   							'<input type="hidden" name="curact" value="{$bw->input[1]}" />' +
	   							'<input type="hidden" name="g" value="{$obj->getGroup()}" />'+
	   							'<input type="hidden" name="so" value="{$obj->getId()}" />'+
	   							'<input type="hidden" name="sf" value="sf" />'+
	   							'</form>';
	   				$('#temp').append(temp);
	   				$.blockUI({
			        	css: {
			        		border: 'none',
            				padding: '50px',
				            backgroundColor: '#C0C0C0',
				            color: '#000',
				            cursor:'progress'
				        }
					});
	   				vsf.submitForm($('#spamForm'), 'messages/spam', 'campus_user_right');
	   				$(document).ajaxStop(function(){
						setTimeout(function(){
							$.unblockUI();
						}, 2000);
					});
				});
				
				$(document).ajaxStop(function(){
					setTimeout(function(){
						$.unblockUI();
					}, 1000);
				});
            </script>
EOF;
	}
	
	function maindetail($option){
		global $bw, $vsLang;
		$BWHTML .= <<<EOF
	        	<div id="smoothmenu1" class="ddsmoothmenu">
	                <ul>
	                    <li class="ddsmoothmenu_first"><a href="{$bw->vars['board_url']}/messages/inbox">Back to inbox</a></li>
	                    <li><a href="#reply" id='replyTop'>Reply</a></li>
						<li><a href="#forward" id='forwardTop'>Forward</a></li>
						<li><a href="javascript:;" id='deleteDetail'>Delete</a></li>
						<li><a href="javascript:;" id='spamDetail'>Spam</a></li>
	                    <li>
	                    	<a href="javascript:;" id='moveTop' title="{$vsLang->getWords('move_title','Move to folder')}">Move</a>
	                    	<if=" $option['label'] ">
	                    	<ul>
	                    		<li><a href="javascript:;" class='marklabel' rel='inbox-0'>inbox</a></li>
	                    		<foreach=" $option['label'] as $label ">
	                          	<li><a href="javascript:;" class='marklabel' rel='{$label->getTitle()}-{$label->getId()}'>{$label->getTitle()}</a></li>
	                        	</foreach>
	                      	</ul>
	                      	</if>
	                    </li>
	                    <li><a href="javascript:;" id='actionTop'>Action</a></li>
	                </ul>
	                <div class="left"></div>
				</div>
				<div id='main_content_container'>
					{$option['main_content']}
				</div>
	        	
				<script type='text/javascript'>
	        		$(document).ready(function(){
		    			DD_roundies.addRule(".campus_user_left a", "3px", true);
						ddsmoothmenu.init({
							mainmenuid: "smoothmenu1", //menu DIV id
							orientation: "h", //Horizontal or vertical menu: Set to "h" or "v"
							classname: "ddsmoothmenu", //class added to menu outer DIV
							contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
						})
		  			});
	        	</script>
EOF;
	}
	
	function messageTemplate($option){
		global $vsLang, $bw;

		$BWHTML .= <<<EOF
			<div></div>
			<div class='prewrote' style='padding-top: 5px;'>
				{$option['pre'] }
				<div style='margin-left: 3px; border-left: 1px solid #DDD; padding-left: 2px;'> 
					{$option['message']}
				</div>
			</div>
EOF;
	}
	
	function inbox($option){
		global $vsLang, $bw;

		$BWHTML .= <<<EOF
			<div class="mess_list_title">
            	<input type="checkbox" class="mess_list_check" name="all" onclick="vsf.checkAll()" value="0" ref="0" />
                <p style="width:130px;">From</p>
                <p style="width:340px;">Subject</p>
                <p>Date</p>
                <div class="clear_left"></div>
            </div>
            <foreach=" $option['pageList'] as $obj">
            <div class="mess_list_item">
            	<input type="checkbox" rel='myCheckbox' class="mess_list_check myCheckbox" value='{$obj->getId()}' ref="{$obj->getGroup()}" lab=""/>
                <a <if=" $obj->getType() == 2 ">href="{$obj->getUrl($obj->gtitle, $obj->getOriginal())}"<else />href="{$obj->getUrl($obj->gtitle)}"</if> title="{$obj->gtitle}" <if=" $obj->dstatus == 2 ">class="active"</if>>
                	<p style="width:130px; overflow: hidden;">
                		<if=" $option['user'][$obj->getUser()]['name']">
							{$option['user'][$obj->getUser()]['name']}
                		<else />
							{$obj->getUser()}
						</if>
                	</p>
                    <p style="width:340px;">
                    	<if=" $obj->gquality > 1 ">
							Re: {$obj->gtitle} ({$obj->gquality})
						<else />
							{$obj->gtitle}
						</if>
                    </p>
                    <p>
						{$obj->getPostdate('real')}
                    </p>
                </a>
                <div class="clear_left"></div>
            </div>
			</foreach>
			
			<if=" $option['pageStatus'] ">
            <p class="count_mess">{$option['pageStatus']} of {$option['total']} {$vsLang->getWords('message','message(s)')}</p>
            <div class="paging">{$option['paging']}</div>
            </if>
            <div id='temp' style='display:none;'></div>
            
            <script type="text/javascript">
	            	$('.campus_user_left > a').each(function(){
	        			var iclass = $(this).attr('id');
	        			iclass = iclass.substring(0, iclass.length-1)+'active';
	        			$(this).removeClass(iclass);
	        			$(this).removeClass('active');
	        		});
	        		
	        		$('#inboxb').addClass('inboxactive active');
	        		
            		$(".marklabel").each(function(){
			   			$(this).bind("click", function(e){
			   				var stro = ''; var strg = '';
						    $("input[rel=myCheckbox]:checked").each(function(){
								if(this.checked)
									stro += $(this).val()+',';
						    });
			   			
						    if(stro == ""){
							    jAlert(
									"{$vsLang->getWords('no_item','No item is chose')}",
									"{$bw->vars['global_websitename']} Dialog"
								);
								return false;
							}
							
			   				var temp = 	'<form id="markForm" method="POST">'+
			   							'<input type="hidden" name="lma" value="mark" />'+
			   							'<input type="hidden" name="lmt" value="1" />'+
			   							'<input type="hidden" name="lmo" value="'+stro+'" />'+
			   							'<input type="hidden" name="lmi" value="'+$(this).attr('rel')+'" />'+
			   							'</form>'
			   				$('#temp').append(temp);
			   				$.blockUI({
					        	css: {
					        		border: 'none',
		            				padding: '50px',
						            backgroundColor: '#C0C0C0',
						            color: '#000',
						            cursor:'progress'
						        }
							});
			   				vsf.submitForm($('#markForm'), 'messages/label', 'main_content_container');
			   				$(document).ajaxStop(function(){
								setTimeout(function(){
									$.unblockUI();
								}, 1000);
							});
						});
			   		});
			   		
			   		function deleteInbox(){
            			jConfirm(
							'Are you sure to delete', 
							'Dialog board', 
							function(r){
								if(r){
									var stro = ''; var strg = ''; cnt = 0;
								    $("input[rel=myCheckbox]:checked").each(function(){
							        	   if(this.checked){
							        	   		cnt = cnt+ 1;
							        	   		strg += $(this).attr('ref')+',';	
												stro += $(this).val()+',';
							        	   }
								    });
			            		
								    if(cnt == 0){
									    jAlert(
											"{$vsLang->getWords('no_item','No item is chose')}",
											"{$bw->vars['global_websitename']} Dialog"
										);
										return false;
									}
								    
					   				var temp = 	'<form id="deleteForm" method="POST">'+
					   							'<input type="hidden" name="da" value="da" />'+
					   							'<input type="hidden" name="dm" value="dm" />'+
					   							'<input type="hidden" name="do" value="'+stro+'" />'+
					   							'<input type="hidden" name="g"  value="'+strg+'" />'+
					   							'</form>';
					   				$('#temp').append(temp);
					   				$.blockUI({
							        	css: {
							        		border: 'none',
				            				padding: '50px',
								            backgroundColor: '#C0C0C0',
								            color: '#000',
								            cursor:'progress'
								        }
									});
					   				vsf.submitForm($('#deleteForm'), 'messages/delete', 'main_content_container');
					   				$(document).ajaxStop(function(){
										setTimeout(function(){
											$.unblockUI();
										}, 2000);
									});
				   				}
							}
						);
					}
            		$('#deleteTop').live('click', deleteInbox);
					
            		
					$('#spamTop').click(function(){
						var stro = ''; var strg = ''; var cnt = 0
					    $("input[rel=myCheckbox]:checked").each(function(){
				        	   if(this.checked){
				        	   		cnt = cnt + 1;
				        	   		strg += $(this).attr('ref')+',';	
									stro += $(this).val()+',';
				        	   }
					    });
					    
					    if(cnt == 0){
						    jAlert(
								"{$vsLang->getWords('no_item','No item is chose')}",
								"{$bw->vars['global_websitename']} Dialog"
							);
							return false;
						}
						
		   				var temp = 	'<form id="spamForm" method="POST">'+
		   							'<input type="hidden" name="curact" value="{$bw->input[1]}" />' +
		   							'<input type="hidden" name="g" value="'+strg+'" />'+
		   							'<input type="hidden" name="so" value="'+stro+'" />'+
		   							'<input type="hidden" name="sf" value="sf" />'+
		   							'</form>';

		   				$('#temp').append(temp);
		   				$.blockUI({
				        	css: {
				        		border: 'none',
	            				padding: '50px',
					            backgroundColor: '#C0C0C0',
					            color: '#000',
					            cursor:'progress'
					        }
						});
		   				vsf.submitForm($('#spamForm'), 'messages/spam', 'main_content_container');
		   				$(document).ajaxStop(function(){
							setTimeout(function(){
								$.unblockUI();
							}, 2000);
						});
					});
            </script>
EOF;
	}

	function objForm($obj, $option = array()){
		global $vsLang, $bw, $vsUser;

		$this->vsLang= $vsLang;
		$BWHTML .= <<<EOF
		
			<form id="editForm" enctype="multipart/form-data" method="POST" class="mess_new" >
				<a href="javascript:sendMessage();" class="mess_send"><img src="{$bw->vars['img_url']}/mess_send.jpg" /></a>
                <a href="javascript:sendDraft();" class="mess_send"><img src="{$bw->vars['img_url']}/mess_save.jpg" /></a>
                <a href="javascript:cancelMessage();" class="mess_send"><img src="{$bw->vars['img_url']}/mess_cancel.jpg" /></a>
                <div class="clear_left"></div>

                <div id='formcallback'></div>
                <if=" $bw->input['popupId'] ">
                	<input type="hidden" name='popupId' value='{$bw->input['popupId']}' />
                </if>
                
                <if=" $option['draftaction'] ">
                	<input type="hidden" name='dao' value='{$obj->draftid}' />
                	<input type="hidden" name='dat' value='{$obj->drafttype}' />
                </if>
                
                <if=" $option['ra'] ">
        			<input type='hidden' name='ra' value='{$option['ra']}' />
        		</if>
                
                <input type="hidden" name='a' value='{$option['action']}' />
                <input type="hidden" name='messageGroup' value='{$obj->getGroup()}' />
                <input type="hidden" name='messageOriginal' value='{$option['ori']}' />
                
        		<label>{$vsLang->getWords('to','To')}</label>
        		<input name="messageRecipient" id="messageRecipient" value="" />
        		<div class="clear_left"></div>
        		
 

        		<if=" $bw->input[1] == 'reply' ">
        		<input type='hidden' name='messageTitle' value='{$obj->getTitle()}' />
        		<else />
        		<label>{$vsLang->getWords('Subject','Subject')}</label>
        		<input name="messageTitle" id="messageTitle" value="{$obj->getTitle()}" />
        		</if>
        		<div class="clear_left"></div>
        		
        		<input type="hidden" name='attfiles' id='files' value="{$obj->attfilesid}" />
        		<div id="file-uploader"> 
			        <noscript>          
			            <p>Please enable JavaScript to use file uploader.</p>
			            <!-- or put a simple form for upload here -->
			        </noscript>         
			    </div>
			    <div class="clear_left"></div>
			    <if=" $obj->attfiles ">
			    <div class="attcontainer">
                	<foreach=" $obj->attfiles as $attfile">
                    <div class='attfile'>
                    	<div class='preview'>
                    		{$attfile->getTitle()}
                    	</div>
                    	<div class='option'>
	                    	<input class="delatt" value='{$obj->getId()}' type="checkbox" title="{$this->vsLang->getWords('delete_attact_file','Delete')}" />
                    	</div>
                    	<div class="clear_left"></div>
                    </div>
                   	</foreach>
                </div>
			    </if>
        		<div class="clear_left"></div>
        		
        		{$obj->getContent()}
        		
        		
        		<a href="javascript:sendMessage();" class="mess_send"><img src="{$bw->vars['img_url']}/mess_send.jpg" /></a>
                <a href="javascript:sendDraft();" class="mess_send"><img src="{$bw->vars['img_url']}/mess_save.jpg" /></a>
                <a href="javascript:cancelMessage();" class="mess_send"><img src="{$bw->vars['img_url']}/mess_cancel.jpg" /></a>
                <div class="clear_left"></div>
                <div id='objFormCallback'></div>
        	</form>
        	
	    	<script type="text/javascript">
	    		var uploader = new qq.FileUploader({
			        element: document.getElementById('file-uploader'),
		        	action: "{$bw->vars['board_url']}/files/upload/&ajax=1",
		        	onComplete: function(id, fileName, responseJSON){
		        					var file = responseJSON.fileId + "," +$('#files').val();
		        					$('#files').val(file);
								}
		    	});
		    	
	    		function sendMessage(){
	    			$('#drafttemp').remove();
	    			var temp = "<div id='sendtemp' style='display:none;'></div>";
	    			$("#editForm").append(temp);
	    			
	    			var temp = "<input type='hidden' name='mact' value='{$bw->input[1]}' />";
	    			$("#sendtemp").append(temp);
	    			
	    			var temp = "<input type='hidden' name='previous' value='"+$('#currentURL').val()+"' />";
	    			$("#sendtemp").append(temp);
	    			
	    			$("#editForm").submit();
	    		}
	    		
	    		function sendDraft(){
	    			$('#sendtemp').remove();
	    			var temp = "<div id='drafttemp' style='display:none;'></div>";
	    			$("#editForm").append(temp);
	    			
	    			var temp = "<input type='hidden' name='d' value='d' />";
	    			$("#drafttemp").append(temp);
	    			
	    			<if=" $option['dm'] ">
	    			var temp = "<input type='hidden' name='dm' value='{$option['dm']}' />";
	    			$("#drafttemp").append(temp);
	    			</if>
	    			
	    			<if=" $option['draftaction'] ">
	    			var temp = "<input type='hidden' name='draftdetail' value='draftdetail' />";
	    			$("#drafttemp").append(temp);
	    			</if>
	    			
	    			$.blockUI({
			        	css: {
			        		border: 'none',
            				padding: '50px',
				            backgroundColor: '#C0C0C0',
				            color: '#000',
				            cursor:'progress',
				        }
					});
					var ck = 'main_content_container';
					<if=" $bw->input[1] == 'popup' ">
	    				ck = 'formcallback';
	    			</if>
	    			
	    			vsf.submitForm($("#editForm"), 'messages/draft', ck);
	    		}
				
				function cancelMessage(){
	    			<if=" $option['draftaction'] ">
	    				location.href="{$bw->vars['board_url']}/messages/draft";
	    				return true;
	    			</if>
	    			
	    			<if=" $option['action'] == 'c' ">
	    				vsf.get('messages/inbox&ajaxcallback=callback', 'main_content_container');
	    			<else />
	    				$('#editForm').remove();
	    			</if>
	    			
	    			<if=" $bw->input[1] == 'popup' ">
	    				$('#{$bw->input['popupId']}').dialog('close');
	    			</if>
	    		}
	    		
	    		var senderr = 0;
	    		
	    		$(document).ready(function(){
					$("#editForm").validate({
						rules: {
							messageTitle: {
								required: true
							},
							messageRecipient: {
								required: true
							}
						},
						messages:{
							messageTitle: {
								required: "{$vsLang->getWords('validate_title_require','Provide a title')}"
							},
							messageRecipient:{
								required: "{$vsLang->getWords('validate_recipient_require','Provide a recipient')}"
							}
						},
						
						success: function(label) {
							label.remove();
						},
						
						submitHandler: function(form) {
							$.blockUI({
					        	css: {
					        		border: 'none',
		            				padding: '50px',
						            backgroundColor: '#C0C0C0',
						            color: '#000',
						            cursor:'progress',
						        },
							});
							
							cbobject = 'main_content_container';
							if('{$bw->input[1]}' == 'draft') cbobject = 'campus_user_right';

							if(typeof(tinyMCE) != "undefined") tinyMCE.triggerSave();
							var params = $("#editForm").serialize();
							$.ajax({
							  	url: baseUrl+'messages/{$bw->input[1]}&ajax=1&json=1',
							  	dataType: 'json',
							  	type: 'POST',
							  	data: params,
							  	success: function(msg){
								  	if(msg.status == 2){
							  			$('#formcallback').html(msg.html);
								  	}else{
								  		$('#'+cbobject).html(msg.html);
								  	}
									$('.blockMsg').html(msg.script);
								}
							});
							return false;
						}
					});
					$("#messageRecipient").tokenInput("{$bw->vars['board_url']}/{$vsUser->obj->getAlias()}/suggest/&ajax=1&js=js", {
		                theme: "facebook",
		                minChars: 2,
		                preventDuplicates: true,
		                searchDelay: 300,
		            });
<if=" $obj->recipient ">
					$("#messageRecipient").tokenInput("add", {id: '{$obj->recipient}', name: '{$obj->recipient}'});
</if>
					$(document).ajaxStop(function(){
						setTimeout(function(){
							$.unblockUI();
						}, 2000);
					});
				});
	    	</script>
EOF;
	}

	function spam($option){
		global $vsLang, $bw;

		$BWHTML .= <<<EOF
			<div class="mess_list_title">
            	<input type="checkbox" class="mess_list_check" name="all" onclick="vsf.checkAll()" value="0" ref="0" />
                <p style="width:130px;">From</p>
                <p style="width:340px;">Subject</p>
                <p>Date</p>
                <div class="clear_left"></div>
            </div>
            <foreach=" $option['pageList'] as $obj">
            <div class="mess_list_item">
            	<input value='{$obj->getId()}' ref="{$obj->getGroup()}" type="checkbox" rel='myCheckbox' class="mess_list_check myCheckbox" />
                <a <if=" $obj->getType() == 2 ">href="{$obj->getSpamUrl($obj->gtitle, $obj->getOriginal())}"<else />href="{$obj->getSpamUrl($obj->gtitle)}"</if> title="{$obj->gtitle}" <if=" $obj->dstatus == 2 ">class="active"</if>>
                	<p style="width:130px; overflow: hidden;">
                		<if=" $option['user'][$obj->getUser()]['name']">
							{$option['user'][$obj->getUser()]['name']}
                		<else />
							{$obj->getUser()}
						</if>
                	</p>
                    <p style="width:340px;">
                    	{$obj->gtitle}
                    </p>
                    <p>
						{$obj->getPostdate('real')}
                    </p>
                </a>
                <div class="clear_left"></div>
            </div>
			</foreach>
			
			<if=" $option['pageStatus'] ">
            <p class="count_mess">{$option['pageStatus']} of {$option['total']} {$vsLang->getWords('message','message(s)')}</p>
            <div class="paging">{$option['paging']}</div>
            </if>
            
            <div id='temp' style='display:none;'></div>
            <script type="text/javascript">
            		function deleteSpam(){
					    var strg = ''; var strd = ''; var cnt = 0;
					    $("input[rel=myCheckbox]:checked").each(function(){
							if(this.checked){
								cnt = cnt+1;
								strd += $(this).val() + ',';
								strg += $(this).attr('ref') + ',';
							}
					    });
					    
						if(cnt == 0){
						    jAlert(
								"{$vsLang->getWords('no_item','No item is chose')}",
								"{$bw->vars['global_websitename']} Dialog"
							);
							return false;
						}
					    
		   				var temp = 	'<form id="deleteForm" method="POST">'+
		   							'<input type="hidden" name="curact" value="spam" />'+
		   							'<input type="hidden" name="tra" value="trs" />'+
		   							'<input type="hidden" name="g" value="'+strg+'" />'+
		   							'<input type="hidden" name="trod" value="'+strd+'" />'+
		   							'</form>';
		   				$('#temp').append(temp);
		   				$.blockUI({
				        	css: {
				        		border: 'none',
	            				padding: '50px',
					            backgroundColor: '#C0C0C0',
					            color: '#000',
					            cursor:'progress',
					        },
						});
						vsf.submitForm($('#deleteForm'), 'messages/trash', 'main_content_container');
						$(document).ajaxStop(function(){
							setTimeout(function(){
								$.unblockUI();
							}, 2000);
						});
		   			}
            		$('#deleteSpam').live('click', deleteSpam);
            		
            		
            		
            		
            		
            		$(".marklabel").each(function(){
			   			$(this).bind("click", function(e){
			   				var stro = ''; var strg = '';
						    $("input[rel=myCheckbox]:checked").each(function(){
								if(this.checked)
									stro += $(this).val()+',';
						    });
			   			
						    if(stro == ""){
							    jAlert(
									"{$vsLang->getWords('no_item','No item is chose')}",
									"{$bw->vars['global_websitename']} Dialog"
								);
								return false;
							}
			   				var temp = 	'<form id="markForm" method="POST">'+
			   							'<input type="hidden" name="curmod" value="{$bw->input[1]}" />'+
			   							'<input type="hidden" name="lma" value="mark" />'+
			   							'<input type="hidden" name="lmt" value="1" />'+
			   							'<input type="hidden" name="lmo" value="'+stro+'" />'+
			   							'<input type="hidden" name="lmi" value="'+$(this).attr('rel')+'" />'+
			   							'</form>'
			   				$('#temp').append(temp);
			   				
			   				$.blockUI({
					        	css: {
					        		border: 'none',
		            				padding: '50px',
						            backgroundColor: '#C0C0C0',
						            color: '#000',
						            cursor:'progress',
						        },
							});
							vsf.submitForm($('#markForm'), 'messages/label', 'main_content_container');
							$(document).ajaxStop(function(){
								setTimeout(function(){
									$.unblockUI();
								}, 2000);
							});
						});
			   		});
            </script>
EOF;
	}
	
	function spamdetail($obj, $option){
		global $vsLang, $bw, $vsUser;

		$this->vsLang = $vsLang;
		$this->vsUser = $vsUser;
		$this->board_url = $bw->vars['board_url'];
		
		$BWHTML .= <<<EOF
			<input type='hidden' id='currentURL' value='' />
			<h3 class="mess_title">{$obj->getTitle()}</h3>
            <div class="link_nick" id='recipient'>
            	<span class="form">From:</span>
                <a href="#" class="form">{$option['user'][$obj->getUser()]['name']}</a>
                <if=" $option['recipient'] ">
                <span class="form">to</span>
                <foreach=" $option['recipient'] as  $key=>$recipient">
                	<a href="#">{$option['user'][$key]['name']}</a>
                	<span>,&nbsp;</span>
				</foreach>
				</if>
                <div class="clear_left"></div>
            </div>
            
            <div class="mess_item">
            	<a href="#" class="mess_item_img">
            		<if=" $option['user'][$obj->getUser()]['image'] ">
						{$obj->createImageCache($option['user'][$obj->getUser()]['image'],50,50)}
					<else />
						<img src="{$bw->vars['img_url']}/noavatar.png" alt="{$vsLang->getWords('global_no_image','No Image')}" width="50" height="50" />
					</if>
            	</a>
                <div class="mess_item_info">                	
                    <div>
                    	<a href="#">{$option['user'][$obj->getUser()]['name']}</a>
						{$obj->getContent()}
                    </div>
                    <span>{$obj->getPostdate('real')}</span>                    
                </div>
                <if=" $obj->attfiles ">
                <div class="mess_item_info">
                	<foreach=" $obj->attfiles as $attfile">
                    <div class='attfile'>
                    	<div class='preview'>
                    		{$attfile->show(200, 0)}
                    	</div>
                    	<div class='option'>
	                    	<a href="{$this->board_url}/files/download/{$attfile->getId()}/0" title="{$attfile->getTitle()}">
	                    		Download
	                    	</a>
                    	</div>
                    	<div class="clear"></div>
                    </div>
                   	</foreach>
                </div>
                </if>
                <div class="clear"></div>
            </div>

            <if=" $option['pageList'] ">
            <foreach=" $option['pageList'] as $mes ">
            <div class="mess_item">
            	<a href="#" class="mess_item_img">
            		<if=" $option['user'][$obj->getUser()]['image'] ">
						{$obj->createImageCache($option['user'][$obj->getUser()]['image'],50,50)}
					<else />
						<img src="{$bw->vars['img_url']}/noavatar.png" alt="{$vsLang->getWords('global_no_image','No Image')}" width="50" height="50" />
					</if>
            	</a>
                <div class="mess_item_info">
					<p>
						<a href="#">{$option['user'][$mes->getUser()]['name']}</a>
                    	{$mes->getContent()}
                   	</p>
                    <span>{$mes->getPostdate('real')}</span>                    
                </div>
                <if=" $mes->attfiles ">
                <div class="mess_item_info">
                	<foreach=" $mes->attfiles as $attfile">
                    <div class='attfile'>
                    	<div class='preview'>
                    		{$attfile->show(200, 0)}
                    	</div>
                    	<div class='option'>
	                    	<a href="{$this->board_url}/files/download/{$attfile->getId()}/0" title="{$attfile->getTitle()}">
	                    		Download
	                    	</a>
                    	</div>
                    	<div class="clear"></div>
                    </div>
                   	</foreach>
                </div>
                </if>
                <div class="clear"></div>
            </div>
            </foreach>
            </if>

            <div id='temp' style='display:none;'></div>
            <script type='text/javascript'>
      			$("#recipient span:last").html('');
            	$('#deleteSpam').addClass('phide');
            	$('#deleteSpamDetail').removeClass('phide');
            	
            	$('#deleteSpamDetail').click(function(){
	   				var temp = 	'<form id="deleteForm" method="POST">'+
	   							'<input type="hidden" name="curmod" value="spam" />'+
	   							'<input type="hidden" name="tra" value="trs" />'+
	   							'<input type="hidden" name="g" value="{$obj->getGroup()}" />'+
	   							'<input type="hidden" name="trod" value="{$obj->getId()}" />'+
	   							'</form>';
	   				$('#temp').append(temp);
	   				$.blockUI({
			        	css: {
			        		border: 'none',
            				padding: '50px',
				            backgroundColor: '#C0C0C0',
				            color: '#000',
				            cursor:'progress',
				        }
					});
					vsf.submitForm($('#deleteForm'), 'messages/trash', 'main_content_container');
					return false;
				});
				$(document).ajaxStop(function(){
					setTimeout(function(){
						$.unblockUI();
					}, 2000);
				});
				
            	$(".marklabel").each(function(){
		   			$(this).bind("click", function(e){
		   				var temp = 	'<form id="markForm" action="{$bw->vars['board_url']}/messages/label"  method="POST">'+
		   							'<input type="hidden" name="curact" value="{$bw->input[1]}" />'+
		   							'<input type="hidden" name="lma" value="mark" />'+
		   							'<input type="hidden" name="lmt" value="1" />'+
		   							'<input type="hidden" name="lmo" value="{$obj->getId()}" />'+
		   							'<input type="hidden" name="lmi" value="'+$(this).attr('rel')+'" />'+
		   							'</form>'
		   				$('#temp').append(temp);
		   				$('#markForm').submit();
					});
		   		});
            </script>
EOF;
	}
	
	function mainspam($option){
		global $bw, $vsLang;
		$BWHTML .= <<<EOF
	        	<div id="smoothmenu1" class="ddsmoothmenu">
	                <ul>
	                    <li class="ddsmoothmenu_first"><a href="{$bw->vars['board_url']}/messages/inbox">Back to inbox</a></li>
	                    <li><a href="javascript:;" id='deleteSpam'>Delete</a></li>
	                    <li><a href="javascript:;" id='deleteSpamDetail' class='phide'>Delete</a></li>
	                    <li>
	                    	<a href="javascript:;" id='moveTop' title="{$vsLang->getWords('move_title','Move to folder')}">Move</a>
	                    	<if=" $option['label'] ">
	                    	<ul>
	                    		<li><a href="javascript:;" class='marklabel' rel='inbox-0'>inbox</a></li>
	                    		<foreach=" $option['label'] as $label ">
	                          	<li><a href="javascript:;" class='marklabel' rel='{$label->getTitle()}-{$label->getId()}'>{$label->getTitle()}</a></li>
	                        	</foreach>
	                      	</ul>
	                      	</if>
	                    </li>
	                    <li><a href="javascript:;" id='actionTop'>Action</a></li>
	                </ul>
	                <div class="left"></div>
				</div>
				<div id='main_content_container'>
					{$option['main_content']}
				</div>
	        	
				<script type='text/javascript'>
	        		$(document).ready(function(){
		    			DD_roundies.addRule(".campus_user_left a", "3px", true);
						ddsmoothmenu.init({
							mainmenuid: "smoothmenu1", //menu DIV id
							orientation: "h", //Horizontal or vertical menu: Set to "h" or "v"
							classname: "ddsmoothmenu", //class added to menu outer DIV
							contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
						})
		  			});
	        	</script>
EOF;
	}
	
	function trash($option){
		global $vsLang, $bw;

		$BWHTML .= <<<EOF
			<div class="mess_list_title">
            	<input type="checkbox" class="mess_list_check" name="all" onclick="vsf.checkAll()" value="0" ref="0" />
                <p style="width:130px;">From</p>
                <p style="width:340px;">Subject</p>
                <p>Date</p>
                <div class="clear_left"></div>
            </div>
            <foreach=" $option['pageList'] as $obj">
            <div class="mess_list_item">
            	<input value='{$obj->getId()}' ref="{$obj->getGroup()}" type="checkbox" rel='myCheckbox' class="mess_list_check myCheckbox" />
                <a <if=" $obj->getType() == 2 ">href="{$obj->getTrashUrl($obj->gtitle, $obj->getOriginal())}"<else />href="{$obj->getTrashUrl($obj->gtitle)}"</if> title="{$obj->gtitle}" <if=" $obj->dstatus == 2 ">class="active"</if>>
                	<p style="width:130px; overflow: hidden;">
                		<if=" $option['user'][$obj->getUser()]['name']">
							{$option['user'][$obj->getUser()]['name']}
                		<else />
							{$obj->getUser()}
						</if>
                	</p>
                    <p style="width:340px;">
                    	{$obj->gtitle}
                    </p>
                    <p>
						{$obj->getPostdate('real')}
                    </p>
                </a>
                <div class="clear_left"></div>
            </div>
			</foreach>
			
			<if=" $option['pageStatus'] ">
            <p class="count_mess">{$option['pageStatus']} of {$option['total']} {$vsLang->getWords('message','message(s)')}</p>
            <div class="paging">{$option['paging']}</div>
            </if>
            
            <div id='temp' style='display:none;'></div>
            
            <script type="text/javascript">
            		$('#deleteTrash').click(function(){
					    var strm = ''; var strd = '';
					    $("input[rel=myCheckbox]:checked").each(function(){
							if(this.checked)
								strd += $(this).val()+',';
					    });
					    if(!strd){
						    jAlert(
								"{$vsLang->getWords('no_item','No item is chose')}",
								"{$bw->vars['global_websitename']} Dialog"
							);
							return false;
						}
					    
		   				var temp = 	'<form id="deleteForm" method="POST">'+
		   							'<input type="hidden" name="tra" value="empty" />'+
		   							'<input type="hidden" name="trod" value="'+strd+'" />'+
		   							'</form>';
		   				$('#temp').append(temp);
		   				$.blockUI({
				        	css: {
				        		border: 'none',
	            				padding: '50px',
					            backgroundColor: '#C0C0C0',
					            color: '#000',
					            cursor:'progress',
					        },
						});
						vsf.submitForm($('#deleteForm'), 'messages/trash', 'main_content_container');
						return false;
					});
					$(document).ajaxStop(function(){
						setTimeout(function(){
							$.unblockUI();
						}, 2000);
					});
					
					$(".marklabel").each(function(){
			   			$(this).bind("click", function(e){
			   				var stro = ''; var strg = ''; var cnt = 0;
						    $("input[rel=myCheckbox]:checked").each(function(){
								if(this.checked){
									cnt = cnt + 1;
									stro += $(this).val()+',';
								}
						    });
			   			
						    if(cnt == 0){
							    jAlert(
									"{$vsLang->getWords('no_item','No item is chose')}",
									"{$bw->vars['global_websitename']} Dialog"
								);
								return false;
							}
							
			   				var temp = 	'<form id="markForm" method="POST">'+
			   							'<input type="hidden" name="curmod" value="{$bw->input[1]}" />'+
			   							'<input type="hidden" name="lma" value="mark" />'+
			   							'<input type="hidden" name="lmt" value="1" />'+
			   							'<input type="hidden" name="lmo" value="'+stro+'" />'+
			   							'<input type="hidden" name="lmi" value="'+$(this).attr('rel')+'" />'+
			   							'</form>'
			   				$('#temp').append(temp);
			   				vsf.submitForm($('#markForm'), 'messages/label', 'main_content_container');
						});
			   		});
            </script>
EOF;
	}
	
	function trashdetail($obj, $option){
		global $vsLang, $bw, $vsUser;

		$this->vsLang = $vsLang;
		$this->vsUser = $vsUser;
		$this->board_url = $bw->vars['board_url'];
		
		$BWHTML .= <<<EOF
			<input type='hidden' id='currentURL' value='' />
			<h3 class="mess_title">{$obj->getTitle()}</h3>
            <div class="link_nick" id='recipient'>
            	<span class="form">From:</span>
                <a href="#" class="form">{$option['user'][$obj->getUser()]['name']}</a>
                <if=" $option['recipient'] ">
                <span class="form">to</span>
                <foreach=" $option['recipient'] as  $key=>$recipient">
                	<a href="#">{$option['user'][$key]['name']}</a>
                	<span>,&nbsp;</span>
				</foreach>
				</if>
                <div class="clear_left"></div>
            </div>
            
            <div class="mess_item">
            	<a href="#" class="mess_item_img">
            		<if=" $option['user'][$obj->getUser()]['image'] ">
						{$obj->createImageCache($option['user'][$obj->getUser()]['image'],50,50)}
					<else />
						<img src="{$bw->vars['img_url']}/noavatar.png" alt="{$vsLang->getWords('global_no_image','No Image')}" width="50" height="50" />
					</if>
            	</a>
                <div class="mess_item_info">                	
                    <div>
                    	<a href="#">{$option['user'][$obj->getUser()]['name']}</a>
						{$obj->getContent()}
                    </div>
                    <span>{$obj->getPostdate('real')}</span>                    
                </div>
                <if=" $obj->attfiles ">
                <div class="mess_item_info">
                	<foreach=" $obj->attfiles as $attfile">
                    <div class='attfile'>
                    	<div class='preview'>
                    		{$attfile->show(200, 0)}
                    	</div>
                    	<div class='option'>
	                    	<a href="{$this->board_url}/files/download/{$attfile->getId()}/0" title="{$attfile->getTitle()}">
	                    		Download
	                    	</a>
                    	</div>
                    	<div class="clear"></div>
                    </div>
                   	</foreach>
                </div>
                </if>
                <div class="clear"></div>
            </div>

            <if=" $option['pageList'] ">
            <foreach=" $option['pageList'] as $mes ">
            <div class="mess_item">
            	<a href="#" class="mess_item_img">
            		<if=" $option['user'][$obj->getUser()]['image'] ">
						{$obj->createImageCache($option['user'][$obj->getUser()]['image'],50,50)}
					<else />
						<img src="{$bw->vars['img_url']}/noavatar.png" alt="{$vsLang->getWords('global_no_image','No Image')}" width="50" height="50" />
					</if>
            	</a>
                <div class="mess_item_info">
					<p>
						<a href="#">{$option['user'][$mes->getUser()]['name']}</a>
                    	{$mes->getContent()}
                   	</p>
                    <span>{$mes->getPostdate('real')}</span>                    
                </div>
                <if=" $mes->attfiles ">
                <div class="mess_item_info">
                	<foreach=" $mes->attfiles as $attfile">
                    <div class='attfile'>
                    	<div class='preview'>
                    		{$attfile->show(200, 0)}
                    	</div>
                    	<div class='option'>
	                    	<a href="{$this->board_url}/files/download/{$attfile->getId()}/0" title="{$attfile->getTitle()}">
	                    		Download
	                    	</a>
                    	</div>
                    	<div class="clear"></div>
                    </div>
                   	</foreach>
                </div>
                </if>
                <div class="clear"></div>
                <div class='option'>
	                <a href="javascript:;" rel="{$mes->getId()}" class="link_reply" title="{$this->vsLang->getWords('move_inbox_title','move this message to inbox')}">Move to inbox</a>
	                <a href="javascript:;" rel="{$mes->getId()}" reg='{$mes->getGroup()}' class="link_delete" title="{$this->vsLang->getWords('empty_trash_detail_title','delete this message from trash')}">Empty</a>
	                <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            </foreach>
            </if>

            <div id='temp' style='display:none;'></div>
            <script type='text/javascript'>
      			$("#recipient span:last").html('');
      			
      			$('#deleteTrash').addClass('phide');
            	$('#deleteTrashDetail').removeClass('phide');
            	
            	$('#deleteTrashDetail').click(function(){
	   				var temp = 	'<form id="deleteForm" method="POST">'+
	   							'<input type="hidden" name="curmod" value="trash" />'+
	   							'<input type="hidden" name="tra" value="empty" />'+
	   							'<input type="hidden" name="g" value="{$obj->getGroup()}" />'+
	   							'<input type="hidden" name="trod" value="{$obj->getId()}" />'+
	   							'</form>';
	   				$('#temp').append(temp);
	   				$.blockUI({
			        	css: {
			        		border: 'none',
            				padding: '50px',
				            backgroundColor: '#C0C0C0',
				            color: '#000',
				            cursor:'progress',
				        }
					});
					vsf.submitForm($('#deleteForm'), 'messages/trash', 'main_content_container');
					return false;
				});
				$(document).ajaxStop(function(){
					setTimeout(function(){
						$.unblockUI();
					}, 2000);
				});
				
            	
            	$(".marklabel").each(function(){
		   			$(this).bind("click", function(e){
		   				var stro = ''; var strg = '';
					    $("input[rel=myCheckbox]:checked").each(function(){
							if(this.checked)
								stro += $(this).val()+',';
					    });
		   			
		   				var temp = 	'<form id="markForm" action="{$bw->vars['board_url']}/messages/label"  method="POST">'+
		   							'<input type="hidden" name="lma" value="{$bw->input[1]}" />'+
		   							'<input type="hidden" name="lma" value="mark" />'+
		   							'<input type="hidden" name="lmt" value="1" />'+
		   							'<input type="hidden" name="lmo" value="'+stro+'" />'+
		   							'<input type="hidden" name="lmi" value="'+$(this).attr('rel')+'" />'+
		   							'</form>'
		   				$('#temp').append(temp);
		   				$('#markForm').submit();
					});
		   		});
		   	</script>
EOF;
	}
	
	function maintrash($option){
		global $bw, $vsLang;
		$BWHTML .= <<<EOF
	        	<div id="smoothmenu1" class="ddsmoothmenu">
	                <ul>
	                    <li class="ddsmoothmenu_first"><a href="{$bw->vars['board_url']}/messages/inbox">Back to inbox</a></li>
	                    <li><a href="javascript:;" id='deleteTrash'>{$vsLang->getWords('empty_trash','Empty Trash')}</a></li>
	                    <li><a href="javascript:;" id='deleteTrashDetail' class='phide'>{$vsLang->getWords('empty_trash','Empty Trash')}</a></li>
	                    <li>
	                    	<a href="javascript:;" id='moveTop' title="{$vsLang->getWords('move_title','Move to folder')}">Move</a>
	                    	<if=" $option['label'] ">
	                    	<ul>
	                    		<li><a href="javascript:;" class='marklabel' rel='inbox-0'>inbox</a></li>
	                    		<foreach=" $option['label'] as $label ">
	                          	<li><a href="javascript:;" class='marklabel' rel='{$label->getTitle()}-{$label->getId()}'>{$label->getTitle()}</a></li>
	                        	</foreach>
	                      	</ul>
	                      	</if>
	                    </li>
	                    <li><a href="javascript:;" id='actionTop'>Action</a></li>
	                </ul>
	                <div class="left"></div>
				</div>
				<div id='main_content_container'>
					{$option['main_content']}
				</div>
	        	
				<script type='text/javascript'>
	        		$(document).ready(function(){
		    			DD_roundies.addRule(".campus_user_left a", "3px", true);
						ddsmoothmenu.init({
							mainmenuid: "smoothmenu1", //menu DIV id
							orientation: "h", //Horizontal or vertical menu: Set to "h" or "v"
							classname: "ddsmoothmenu", //class added to menu outer DIV
							contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
						})
		  			});
		  		</script>
EOF;
	}
	
	function sent($option){
		global $vsLang, $bw;

		$BWHTML .= <<<EOF
			<div class="mess_list_title">
            	<input type="checkbox" class="mess_list_check" name="all" onclick="vsf.checkAll()" value="0" ref="0" />
                <p style="width:130px;">From</p>
                <p style="width:340px;">Subject</p>
                <p>Date</p>
                <div class="clear_left"></div>
            </div>
            <foreach=" $option['pageList'] as $obj">
            <div class="mess_list_item">
            	<input rel='myCheckbox' value='{$obj->getId()}' ref="{$obj->getGroup()}" type="checkbox" class="mess_list_check myCheckbox" />
                <a <if=" $obj->getType() == 2 ">href="{$obj->getSentUrl($obj->gtitle, $obj->getOriginal())}"<else />href="{$obj->getSentUrl($obj->gtitle)}"</if> title="{$obj->gtitle}" <if=" $obj->dstatus == 2 ">class="active"</if>>
                	<p style="width:130px; overflow: hidden;">
                		<if=" $option['user'][$obj->getUser()]['name']">
							{$option['user'][$obj->getUser()]['name']}
                		<else />
							{$obj->getUser()}
						</if>
                	</p>
                    <p style="width:340px;">
                    	{$obj->gtitle}
                    </p>
                    <p>
						{$obj->getPostdate('real')}
                    </p>
                </a>
                <div class="clear_left"></div>
            </div>
			</foreach>
			
			<if=" $option['pageStatus'] ">
            <p class="count_mess">{$option['pageStatus']} of {$option['total']} {$vsLang->getWords('message','message(s)')}</p>
            <div class="paging">{$option['paging']}</div>
            </if>
            
            <div id='temp' style='display:none;'></div>
            <script type="text/javascript">
            		$("#recipient span:last").html('');
            		$('#deleteSentDetail').addClass('phide');
      				$('#deleteSent').removeClass('phide');

            		$('#deleteSent').click(function(){
					    var stro = ''; var strg = ''; var cnt = 0;
					    $("input[rel=myCheckbox]:checked").each(function(){
				        	   if(this.checked){
				        	   		cnt = cnt + 1;
				        	   		strg += $(this).attr('ref')+',';	
									stro += $(this).val()+',';
				        	   }
					    });
            		
					    if(cnt == 0){
						    jAlert(
								"{$vsLang->getWords('no_item','No item is chose')}",
								"{$bw->vars['global_websitename']} Dialog"
							);
							return false;
						}
					    
		   				var temp = 	'<form id="deleteForm" method="POST">'+
		   							'<input type="hidden" name="curact" value="{$bw->input[1]}" />'+
		   							'<input type="hidden" name="tra" value="trdel" />'+
		   							'<input type="hidden" name="da" value="da" />'+
		   							'<input type="hidden" name="dm" value="dm" />'+
		   							'<input type="hidden" name="do" value="'+stro+'" />'+
		   							'<input type="hidden" name="g"  value="'+strg+'" />'+
		   							'</form>';

		   				$('#temp').append(temp);
		   				$.blockUI({
				        	css: {
				        		border: 'none',
	            				padding: '50px',
					            backgroundColor: '#C0C0C0',
					            color: '#000',
					            cursor:'progress',
					        },
						});
						vsf.submitForm($('#deleteForm'), 'messages/delete', 'main_content_container');
						$(document).ajaxStop(function(){
							setTimeout(function(){
								$.unblockUI();
							}, 2000);
						});
					});
            </script>
EOF;
	}

	function mainsent($option){
		global $bw, $vsLang;
		$BWHTML .= <<<EOF
	        	<div id="smoothmenu1" class="ddsmoothmenu">
	                <ul>
	                    <li class="ddsmoothmenu_first"><a href="{$bw->vars['board_url']}/messages/inbox">Back to inbox</a></li>
	                    <li><a href="javascript:;" id='deleteSent'>Delete</a></li>
	                    <li><a href="javascript:;" id='deleteSentDetail' class='phide'>Delete</a></li>
	                </ul>
	                <div class="left"></div>
				</div>
				<div id='main_content_container'>
					{$option['main_content']}
				</div>
	        	
				<script type='text/javascript'>
	        		$(document).ready(function(){
		    			DD_roundies.addRule(".campus_user_left a", "3px", true);
						ddsmoothmenu.init({
							mainmenuid: "smoothmenu1", //menu DIV id
							orientation: "h", //Horizontal or vertical menu: Set to "h" or "v"
							classname: "ddsmoothmenu", //class added to menu outer DIV
							contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
						})
		  			});
		  		</script>
EOF;
	}
	
	function sentdetail($obj, $option){
		global $vsLang, $bw, $vsUser;

		$this->vsLang = $vsLang;
		$this->vsUser = $vsUser;
		$this->board_url = $bw->vars['board_url'];
		
		$BWHTML .= <<<EOF
			<input type='hidden' id='currentURL' value='' />
			<h3 class="mess_title">{$obj->gtitle}</h3>
            <div class="link_nick" id='recipient'>
            	<span class="form">From:</span>
                <a href="#" class="form">{$option['user'][$obj->getUser()]['name']}</a>
                <if=" $option['recipient'] ">
                <span class="form">to</span>
                <foreach=" $option['recipient'] as  $key=>$recipient">
                	<a href="#">{$option['user'][$key]['name']}</a>
                	<span>,&nbsp;</span>
				</foreach>
				</if>
                <div class="clear_left"></div>
            </div>
            
            <div class="mess_item">
            	<a href="#" class="mess_item_img">
            		<if=" $option['user'][$obj->getUser()]['image'] ">
						{$obj->createImageCache($option['user'][$obj->getUser()]['image'],50,50)}
					<else />
						<img src="{$bw->vars['img_url']}/noavatar.png" alt="{$vsLang->getWords('global_no_image','No Image')}" width="50" height="50" />
					</if>
            	</a>
                <div class="mess_item_info">                	
                    <div>
                    	<a href="#">{$option['user'][$obj->getUser()]['name']}</a>
						{$obj->getContent()}
                    </div>
                    <span>{$obj->getPostdate('real')}</span>                    
                </div>
                <if=" $obj->attfiles ">
                <div class="mess_item_info">
                	<foreach=" $obj->attfiles as $attfile">
                    <div class='attfile'>
                    	<div class='preview'>
                    		{$attfile->show(200, 0)}
                    	</div>
                    	<div class='option'>
	                    	<a href="{$this->board_url}/files/download/{$attfile->getId()}/0" title="{$attfile->getTitle()}">
	                    		Download
	                    	</a>
                    	</div>
                    	<div class="clear"></div>
                    </div>
                   	</foreach>
                </div>
                </if>
                <div class="clear"></div>
            </div>

            <if=" $option['pageList'] ">
            <foreach=" $option['pageList'] as $mes ">
            <div class="mess_item">
            	<a href="#" class="mess_item_img">
            		<if=" $option['user'][$obj->getUser()]['image'] ">
						{$obj->createImageCache($option['user'][$obj->getUser()]['image'],50,50)}
					<else />
						<img src="{$bw->vars['img_url']}/noavatar.png" alt="{$vsLang->getWords('global_no_image','No Image')}" width="50" height="50" />
					</if>
            	</a>
                <div class="mess_item_info">
					<p>
						<a href="#">{$option['user'][$mes->getUser()]['name']}</a>
                    	{$mes->getContent()}
                   	</p>
                    <span>{$mes->getPostdate('real')}</span>                    
                </div>
                <if=" $mes->attfiles ">
                <div class="mess_item_info">
                	<foreach=" $mes->attfiles as $attfile">
                    <div class='attfile'>
                    	<div class='preview'>
                    		{$attfile->show(200, 0)}
                    	</div>
                    	<div class='option'>
	                    	<a href="{$this->board_url}/files/download/{$attfile->getId()}/0" title="{$attfile->getTitle()}">
	                    		Download
	                    	</a>
                    	</div>
                    	<div class="clear"></div>
                    </div>
                   	</foreach>
                </div>
                </if>
                <div class="clear"></div>
            </div>
            </foreach>
            </if>

            <div id='temp' style='display:none;'></div>
            <script type='text/javascript'>
      			$("#recipient span:last").html('');
      			$('#deleteSent').addClass('phide');
      			$('#deleteSentDetail').removeClass('phide');
      			
      			$('#deleteSentDetail').click(function(){
	   				jConfirm(
						'Are you sure to delete', 
						'Dialog board', 
						function(r){
							if(r){
								var temp = 	'<form id="deleteForm" method="POST">'+
											'<input type="hidden" name="curmod" value="{$bw->input[1]}" />' +
			   								'<input type="hidden" name="curact" value="{$bw->input[2]}" />' +
				   							'<input type="hidden" name="da" value="da" />'+
				   							'<input type="hidden" name="g" value="{$obj->getGroup()}" />'+
				   							'<input type="hidden" name="do" value="{$obj->getId()}" />'+
				   							'</form>';
				   				$('#temp').append(temp);
				   				vsf.submitForm($('#deleteForm'), 'messages/delete', 'main_content_container');
				   				$.blockUI({
							        css: {
							        		border: 'none',
				            				padding: '50px',
								            backgroundColor: '#C0C0C0',
								            color: '#000',
								            cursor:'progress'
								        }
								});
				   				$(document).ajaxStop(function(){
									setTimeout(function(){
										$.unblockUI();
									}, 1000);
								});
			   				}
						}
					);	
				});
            </script>
EOF;
	}
	
	function draftList($option){
		global $vsLang, $bw;

		$this->vsLang= $vsLang;
		$BWHTML .= <<<EOF
        	
				<div class="mess_list_title">
	            	<input type="checkbox" class="mess_list_check" name="all" onclick="vsf.checkAll()" value="0" ref="0" />
	                <p style="width:130px;">From</p>
	                <p style="width:340px;">Subject</p>
	                <p>Date</p>
	                <div class="clear_left"></div>
	            </div>
	            <foreach=" $option['pageList'] as $obj">
	            <div class="mess_list_item">
	            	<input type="checkbox" rel='myCheckbox' class="mess_list_check myCheckbox" value='{$obj->getId()}' ref="{$obj->getGroup()}" />
	                <a href="{$obj->getUrl()}" title="{$obj->getTitle()}">
	                	<p style="width:130px; overflow: hidden;">
	                		{$this->vsLang->getWords('draft_list_draft','Draft')}
	                	</p>
	                    <p style="width:340px; height: 100%; display: block;">
							{$obj->getTitle()}
	                    </p>
	                    <p>
							{$obj->getPostdate('real')}
	                    </p>
	                </a>
	                <div class="clear_left"></div>
	            </div>
				</foreach>
				
				<if=" $option['pageStatus'] ">
	            <p class="count_mess">{$option['pageStatus']} of {$option['total']} {$vsLang->getWords('message','message(s)')}</p>
	            <div class="paging">{$option['paging']}</div>
	            </if>
	            
	            <div id='temp' style='display:none;'></div>
	            <script type="text/javascript">
	            		$('#draftTop').live('click', function(){
						    var stro = ''; var strg = ''; var cnt = 0;
						    $("input[rel=myCheckbox]:checked").each(function(){
								if(this.checked){
									cnt = cnt + 1;	
									stro += $(this).val()+',';
								}
						    });
	            		
						    if(cnt == 0){
							    jAlert(
									"{$vsLang->getWords('no_item','No item is chose')}",
									"{$bw->vars['global_websitename']} Dialog"
								);
								return false;
							}
							
			   				var temp = 	'<form id="deleteForm" method="POST">'+
			   							'<input type="hidden" name="da" value="discard" />'+
			   							'<input type="hidden" name="do" value="'+stro+'" />'+
			   							'</form>';
			   				$('#temp').append(temp);
			   				$.blockUI({
					        	css: {
					        		border: 'none',
		            				padding: '50px',
						            backgroundColor: '#C0C0C0',
						            color: '#000',
						            cursor:'progress'
						        }
							});
			   				vsf.submitForm($('#deleteForm'), 'messages/draft', 'campus_user_right');
			   				$(document).ajaxStop(function(){
								setTimeout(function(){
									$.unblockUI();
								}, 1000);
							});
			   				
						});
	            </script>
EOF;
	}
	
	function maindraft($option){
		global $vsLang, $bw, $vsUser;
		$BWHTML .= <<<EOF
			<div id="smoothmenu1" class="ddsmoothmenu">
                <ul>
                    <li class="ddsmoothmenu_first"><a href="{$bw->vars['board_url']}/messages/inbox">Back to inbox</a></li>
                    <li><a href="javascript:;" id='draftTop'>{$vsLang->getWords('discard_draft','Discard draft')}</a></li>
                    <li><a href="javascript:;" id='draftTopDetail' class='phide'>{$vsLang->getWords('discard_draft','Discard draft')} a</a></li>
                </ul>
                <div class="left"></div>
			</div>
			<div id='main_content_container'>
			{$option['main_content']}
			</div>
EOF;
	}

	function draftdetail($obj, $option){
		global $vsLang, $bw, $vsUser;

		$this->vsLang = $vsLang;
		$this->vsUser = $vsUser;
		$this->board_url = $bw->vars['board_url'];
		
		$BWHTML .= <<<EOF
			<h3 class="mess_title">{$obj->getTitle()}</h3>
            <div class="link_nick" id='recipient'>
            	<span class="form">From:</span>
                <a href="#" class="form">{$option['user'][$obj->getUser()]['name']}</a>
                <if=" $option['recipient'] ">
                <span class="form">to</span>
                <foreach=" $option['recipient'] as  $key=>$recipient">
                	<a href="#">{$option['user'][$key]['name']}</a>
                	<span>,&nbsp;</span>
				</foreach>
				</if>
                <div class="clear_left"></div>
            </div>
            
            <div class="mess_item">
            	<a href="#" class="mess_item_img">
            		<if=" $option['user'][$obj->getUser()]['image'] ">
						{$obj->createImageCache($option['user'][$obj->getUser()]['image'],50,50)}
					<else />
						<img src="{$bw->vars['img_url']}/noavatar.png" alt="{$vsLang->getWords('global_no_image','No Image')}" width="50" height="50" />
					</if>
            	</a>
                <div class="mess_item_info">                	
                    <div>
                    	<a href="#">{$option['user'][$obj->getUser()]['name']}</a>
						{$obj->getContent()}
                    </div>
                    <span>{$obj->getPostdate('real')}</span>                    
                </div>
                <if=" $obj->attfiles ">
                <div class="mess_item_info">
                	<foreach=" $obj->attfiles as $attfile">
                    <div class='attfile'>
                    	<div class='preview'>
                    		{$attfile->show(200, 0)}
                    	</div>
                    	<div class='option'>
	                    	<a href="{$this->board_url}/files/download/{$attfile->getId()}/0" title="{$attfile->getTitle()}">
	                    		Download
	                    	</a>
                    	</div>
                    	<div class="clear"></div>
                    </div>
                   	</foreach>
                </div>
                </if>
                <div class="clear"></div>
            </div>

            <if=" $option['pageList'] ">
            <foreach=" $option['pageList'] as $mes ">
            <div class="mess_item">
            	<a href="#" class="mess_item_img">
            		<if=" $option['user'][$obj->getUser()]['image'] ">
						{$obj->createImageCache($option['user'][$obj->getUser()]['image'],50,50)}
					<else />
						<img src="{$bw->vars['img_url']}/noavatar.png" alt="{$vsLang->getWords('global_no_image','No Image')}" width="50" height="50" />
					</if>
            	</a>
                <div class="mess_item_info">
					<p>
						<a href="#">{$option['user'][$mes->getUser()]['name']}</a>
                    	{$mes->getContent()}
                   	</p>
                    <span>{$mes->getPostdate('real')}</span>                    
                </div>
                <if=" $mes->attfiles ">
                <div class="mess_item_info">
                	<foreach=" $mes->attfiles as $attfile">
                    <div class='attfile'>
                    	<div class='preview'>
                    		{$attfile->show(200, 0)}
                    	</div>
                    	<div class='option'>
	                    	<a href="{$this->board_url}/files/download/{$attfile->getId()}/0" title="{$attfile->getTitle()}">
	                    		Download
	                    	</a>
                    	</div>
                    	<div class="clear"></div>
                    </div>
                   	</foreach>
                </div>
                </if>
                <div class="clear"></div>
            </div>
            </foreach>
            </if>

            <div id='topcon'>{$option['draftform']}</div>
            <div id='forward'></div>
            <div id='temp' style='display:none;'></div>
            <script type='text/javascript'>
      			$("#recipient span:last").html('');
      			
      			$('#draftTop').addClass('phide');
      			$('#draftTopDetail').removeClass('phide');
            	
            	$('#draftTopDetail').click(function(){
            		$.blockUI({
			        	css: {
			        		border: 'none',
            				padding: '50px',
				            backgroundColor: '#C0C0C0',
				            color: '#000',
				            cursor:'progress',
				        },
					});
	   				var temp = 	'<form id="deleteForm" method="POST">'+
	   							'<input type="hidden" name="da" value="discard" />'+
	   							'<input type="hidden" name="do" value="{$option['draftid']}" />'+
	   							'</form>';
	   				$('#temp').append(temp);
	   				vsf.submitForm($('#deleteForm'), 'messages/delete', 'main_content_container');
	   				$.blockUI({
				        css: {
				        		border: 'none',
	            				padding: '50px',
					            backgroundColor: '#C0C0C0',
					            color: '#000',
					            cursor:'progress'
					        }
					});
	   				$(document).ajaxStop(function(){
						setTimeout(function(){
							$.unblockUI();
						}, 1000);
					});
				});
            </script>
EOF;
	}

	function labellist($option){
		global $vsLang, $bw;

		$BWHTML .= <<<EOF
			<div class="mess_list_title">
            	<input type="checkbox" class="mess_list_check" name="all" onclick="vsf.checkAll()" value="0" ref="0" />
                <p style="width:130px;">From</p>
                <p style="width:340px;">Subject</p>
                <p>Date</p>
                <div class="clear_left"></div>
            </div>
            <foreach=" $option['pageList'] as $obj">
            <div class="mess_list_item">
            	<input rel='myCheckbox' value='{$obj->getId()}' ref="{$obj->getGroup()}" lm="{$obj->lmId}" class="mess_list_check myCheckbox" type="checkbox" />
                
            	<a <if=" $obj->getType() == 2 ">href="{$obj->getUrl($obj->gtitle, $obj->getOriginal())}"<else />href="{$obj->getUrl($obj->gtitle)}"</if> title="{$obj->gtitle}" <if=" $obj->dstatus == 2 ">class="active"</if>>
                	<p style="width:130px; overflow: hidden;">
                		<if=" $option['user'][$obj->getUser()]['name']">
							{$option['user'][$obj->getUser()]['name']}
                		<else />
							{$obj->getUser()}
						</if>
                	</p>
                    <p style="width:340px;">
                    	<if=" $obj->gquality > 1 ">
							Re: {$obj->gtitle} ({$obj->gquality})
						<else />
							{$obj->gtitle}
						</if>
                    </p>
                    <p>
						{$obj->getPostdate('real')}
                    </p>
                </a>
                <div class="clear_left"></div>
            </div>
			</foreach>
			
			<if=" $option['pageStatus'] ">
            <p class="count_mess">{$option['pageStatus']} of {$option['total']} {$vsLang->getWords('message','message(s)')}</p>
            <div class="paging">{$option['paging']}</div>
            </if>
            
            <div id='temp' style='display:none;'></div>
            <script type="text/javascript">
            		$('#spamTop').click(function(){
						var stro = ''; var strg = ''; var strlm = ''; var cnt = 0;
						
					    $("input[rel=myCheckbox]:checked").each(function(){
				        	   if(this.checked){
				        	   		cnt = cnt + 1;
				        	   		stro += $(this).val()+',';
				        	   		strg += $(this).attr('ref')+',';
				        	   		strlm += $(this).attr('lm')+',';
				        	   }
					    });
					    
					    if(cnt == 0){
						    jAlert(
								"{$vsLang->getWords('no_item','No item is chose')}",
								"{$bw->vars['global_websitename']} Dialog"
							);
							return false;
						}
					    
		   				var temp = 	'<form id="spamForm" method="POST">'+
		   							'<input type="hidden" name="curact" value="{$bw->input[1]}/{$bw->input[2]}" />' +
		   							'<input type="hidden" name="g" value="'+strg+'" />'+
		   							'<input type="hidden" name="so" value="'+stro+'" />'+
		   							'<input type="hidden" name="lm" value="'+strlm+'" />'+
		   							'<input type="hidden" name="sf" value="sf" />'+
		   							'</form>';
		   				$('#temp').append(temp);
		   				vsf.submitForm($('#spamForm'), 'messages/spam', 'main_content_container');
		   				$(document).ajaxStop(function(){
							setTimeout(function(){
								$.unblockUI();
							}, 2000);
						});
					});
					
					$('#deleteTop').click(function(){
					    var stro = ''; var strg = ''; var strlm = ''; var cnt = 0;
					    $("input[rel=myCheckbox]:checked").each(function(){
				        	   if(this.checked){
				        	   		cnt = cnt + 1;
				        	   		strg += $(this).attr('ref')+',';	
									stro += $(this).val()+',';
									strlm += $(this).attr('lm')+',';
				        	   }
					    });
            		
					    if(cnt == 0){
						    jAlert(
								"{$vsLang->getWords('no_item','No item is chose')}",
								"{$bw->vars['global_websitename']} Dialog"
							);
							return false;
						}
					    
		   				var temp = 	'<form id="deleteForm" method="POST">'+
		   							'<input type="hidden" name="curmod" value="{$bw->input[1]}" />' +
			   						'<input type="hidden" name="curact" value="{$bw->input[2]}" />' +
		   							'<input type="hidden" name="lm" value="'+strlm+'" />'+
		   							'<input type="hidden" name="da" value="da" />'+
		   							'<input type="hidden" name="dm" value="dm" />'+
		   							'<input type="hidden" name="do" value="'+stro+'" />'+
		   							'<input type="hidden" name="g"  value="'+strg+'" />'+
		   							'</form>';
		   				$('#temp').append(temp);
		   				vsf.submitForm($('#deleteForm'), 'messages/delete', 'main_content_container');
		   				$(document).ajaxStop(function(){
							setTimeout(function(){
								$.unblockUI();
							}, 2000);
						});
					});
					
            		$(".marklabel").each(function(){
			   			$(this).bind("click", function(e){
			   				var stro = ''; var strg = ''; var strlm = ''; var cnt = 0;
						
						    $("input[rel=myCheckbox]:checked").each(function(){
								if(this.checked){
									cnt = cnt+ 1;
									stro += $(this).val()+',';
									strlm += $(this).attr('lm')+',';
								}
						    });
			   			
						    if(cnt == 0){
							    jAlert(
									"{$vsLang->getWords('no_item','No item is chose')}",
									"{$bw->vars['global_websitename']} Dialog"
								);
								return false;
							}
						    
			   				var temp = 	'<form id="markForm" method="POST">'+
			   							'<input type="hidden" name="curmod" value="{$bw->input[1]}" />' +
			   							'<input type="hidden" name="curact" value="{$bw->input[2]}" />' +
			   							'<input type="hidden" name="lm" value="'+strlm+'" />'+
			   							'<input type="hidden" name="lma" value="mark" />'+
			   							'<input type="hidden" name="lmt" value="1" />'+
			   							'<input type="hidden" name="lmo" value="'+stro+'" />'+
			   							'<input type="hidden" name="lmi" value="'+$(this).attr('rel')+'" />'+
			   							'</form>'
			   				$('#temp').append(temp);
			   				vsf.submitForm($('#markForm'), 'messages/label', 'main_content_container');
			   				$(document).ajaxStop(function(){
								setTimeout(function(){
									$.unblockUI();
								}, 1000);
							});
						});
			   		});
            </script>
EOF;
	}
	
	function mainlabel($option){
		global $bw, $vsLang;
		$BWHTML .= <<<EOF
	        	<div id="smoothmenu1" class="ddsmoothmenu">
	                <ul>
	                    <li class="ddsmoothmenu_first"><a href="{$bw->vars['board_url']}/messages/inbox">Back to inbox</a></li>
	                    <li><a href="javascript:;" id='deleteTop'>Delete</a></li>
	                    <li>
	                    	<a href="javascript:;" id='moveTop' title="{$vsLang->getWords('move_title','Move to folder')}">Move</a>
	                    	<if=" $option['label'] ">
	                    	<ul>
	                    		<li><a href="javascript:;" class='marklabel' rel='inbox-0'>inbox</a></li>
	                    		<foreach=" $option['label'] as $label ">
	                          	<li><a href="javascript:;" class='marklabel' rel='{$label->getTitle()}-{$label->getId()}'>{$label->getTitle()}</a></li>
	                        	</foreach>
	                      	</ul>
	                      	</if>
	                    </li>
	                    <li><a href="javascript:;" id='actionTop'>Action</a></li>
	                </ul>
	                <div class="left"></div>
				</div>
				<div id='main_content_container'>
					{$option['main_content']}
				</div>
	        	
				<script type='text/javascript'>
	        		$(document).ready(function(){
		    			DD_roundies.addRule(".campus_user_left a", "3px", true);
						ddsmoothmenu.init({
							mainmenuid: "smoothmenu1", //menu DIV id
							orientation: "h", //Horizontal or vertical menu: Set to "h" or "v"
							classname: "ddsmoothmenu", //class added to menu outer DIV
							contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
						})
		  			});
	        	</script>
EOF;
	}
	
	function foldersPanel($option = array()){
		global $vsLang, $bw;

		$BWHTML .= <<<EOF
				<div id="folderPanel">
		            <div class="campus_user_left_folder">
		            	<a href="javascript:;" class="folder">Folder</a>
		                <a href="javascript:;" class="folder_add" id="addLabel">Add</a>
		                <if=" $option['label'] ">
		                <foreach=" $option['label'] as $lable ">
		                	<a href="javascript:;" class="labeldetail" rel="{$lable->getTitle()}-{$lable->getId()}" title='{$lable->getTitle()}'>{$lable->getTitle()}</a>
		                </foreach>
		                </if>
		            </div>
			        <div style="display:none;" id="addLabelContainer">
		    			<div id='label_form_callback'></div>
			    		<form id="addlabel" method="POST">
			    			<label>{$vsLang->getWords('form_label','Label')}</label>
					        <input id="labelTitle" name="labelTitle" value="" tabindex='1'/>
					        <div class='clear'></div>
					        
							<a id="label_form_submit" tabindex='2' href="javascript:;" class='bookdetail_btn' >
					        	<span>{$vsLang->getWords('label_form_submit','Submit')}
					        </a>
					        <a id="label_form_cancel" tabindex='3' href="javascript:;" class='bookdetail_btn' >
					        	<span>{$vsLang->getWords('label_form_cancel','Cancel')}
					        </a>
					        
					        <input type='hidden' name='label' value='label' />
					        <div class='clear'></div>
			    		</form>
			    		<div class="clear"></div>
			    	</div>
			    	<script type="text/javascript">
			    		$(".labeldetail").each(function(){
				   			$(this).bind("click", function(e){
				   				vsf.get('messages/label/'+$(this).attr('rel'), 'campus_user_right');
				   				return false;
							});
				   		});
			    	
			    	
						$(document).ready(function(){
						    $('#addLabel').click(function() { 
						    	$('#label_form_callback').html('');
						        $.blockUI({
						        	theme: true,
	           						title: '{$vsLang->getWords('lable_form_title','Add label')}', 
							        message: $('#addLabelContainer'),
							        fadeIn: 1000,
								});
								$('.blockOverlay').click($.unblockUI);
						    });
						});
						
						$('#label_form_cancel').click(function(){
							$.unblockUI();
						});
						
						$('#label_form_submit').click(function(){
							$('#addlabel').submit();
						});
						
						<if="$option['message']">
							$.unblockUI();
						</if>
						

						$.expr[':'].focused = function(a){ return (a == document.activeElement); }
						
						var curtab = 1;
						$('#addlabel').keypress(function(event){
							if(event.which == '13'){
								if(curtab == 3){
									$('.textdecoreation').removeClass('textdecoreation');
									$.unblockUI();
									return false;
								}
								$('#addlabel').submit();
								return true;
							}
							if (event.which == '0') {
								curtab = (curtab%3) + 1;

								$('.textdecoreation').removeClass('textdecoreation');
								$('[tabindex='+curtab+']').addClass("textdecoreation");
						    }
						});
						
						
						
						$(document).ready(function(){
							$("#addlabel").validate({
								rules: {
									labelTitle: {
										required: true
									}
								},
								messages:{
									labelTitle:{
										required: "{$vsLang->getWords('validate_label_require','Provide a label name')}"
									}
								},
								
								success: function(label) {
									label.remove();
								},
								
								submitHandler: function(form) {
									vsf.submitForm($('#addlabel'), 'messages/label', 'folderPanel');
									return false;
								}
							});
						});
					</script>
				</div>
EOF;
	}
	
	function addCallback($option = array()){
		global $bw;
		$BWHTML .= <<<EOF
			<div id="message">
				{$option['message']}
			</div>
			<script type='text/javascript'>
				$("#folderPanel").html('{$html}');
			</script>
EOF;
		return $BWHTML; 
	}

	function maininbox($option){
		global $bw, $vsLang;
		$BWHTML .= <<<EOF
	        				<div id="smoothmenu1" class="ddsmoothmenu">
								<ul>
				                    <li class="ddsmoothmenu_first"><a href="{$bw->vars['board_url']}/messages/inbox">Back to inbox</a></li>
				                    
				                    <if=" $bw->input[1] == 'detail' ">
				                    <li><a href="#reply" id='replyTop'>Reply</a></li>
				                    <li><a href="#forward" id='forwardTop'>Forward</a></li>
				                    </if>
				                    <li><a href="javascript:;" id='deleteTop'>Delete</a></li>
				                    <li><a href="javascript:;" id='spamTop'>Spam</a></li>
				                    <li>
				                    	<a href="javascript:;" id='moveTop' title="{$vsLang->getWords('move_title','Move to folder')}">Move</a>
				                    	<if=" $option['label'] ">
				                    	<ul>
				                    		<li><a href="javascript:;" class='marklabel' rel='inbox-0'>inbox</a></li>
				                    		<foreach=" $option['label'] as $label ">
				                          	<li><a href="javascript:;" class='marklabel' rel='{$label->getTitle()}-{$label->getId()}'>{$label->getTitle()}</a></li>
				                        	</foreach>
				                      	</ul>
				                      	</if>
				                    </li>
				                    <li><a href="javascript:;" id='actionTop'>Action</a></li>
				                </ul>
				                <div class="left"></div>
							</div>
							<div id='main_content_container'>
								{$option['main_content']}
							</div>
							<script type='text/javascript'>
				        		$(document).ready(function(){
					    			DD_roundies.addRule(".campus_user_left a", "3px", true);
									ddsmoothmenu.init({
										mainmenuid: "smoothmenu1", //menu DIV id
										orientation: "h", //Horizontal or vertical menu: Set to "h" or "v"
										classname: "ddsmoothmenu", //class added to menu outer DIV
										contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
									})
					  			});
				        	</script>
EOF;
	}
	
	function corelayout($option){
		global $vsLang, $bw, $vsTemplate;
		$BWHTML .= <<<EOF
				<div id='tabmessage'>
			        	<div class="campus_user_left">
				        	<a href="javascript:;" id="composeb" class="compose">New message</a>
				            <a href="javascript:;" id="inboxb" class="inbox">Inbox <if=" $option['count'] ">({$option['count']})</if></a>
				            <a href="javascript:;" id="draftb" class="draft">Drafts</a>
				            <a href="javascript:;" id="spamb" class="draft">Spam</a>
				            <a href="javascript:;" id='sentb' class="sent">Sent</a>
				            <a href="javascript:;" id='trashb' class="trash">Trash</a>
				            {$this->foldersPanel($option)}
				        </div>
				        <script>
				        	$('#inboxb').click(function(){
				        		$('.campus_user_left > a').each(function(){
				        			var iclass = $(this).attr('id');
				        			iclass = iclass.substring(0, iclass.length-1)+'active';
				        			$(this).removeClass(iclass);
				        			$(this).removeClass('active');
				        		});
				        		$('#inboxb').addClass('inboxactive active');
				        		vsf.get('messages/inbox/&coreinbox=coreinbox', 'campus_user_right');
				        	});
				        	
				        	$('#composeb').click(function(){
				        		$('.campus_user_left > a').each(function(){
				        			var iclass = $(this).attr('id');
				        			iclass = iclass.substring(0, iclass.length-1)+'active';
				        			$(this).removeClass(iclass);
				        			$(this).removeClass('active');
				        		});
				        		$('#composeb').addClass('composeactive active');
				        		vsf.get('messages/compose', 'main_content_container');
				        	});
				        	
				        	$('#draftb').click(function(){
				        		$('.campus_user_left > a').each(function(){
				        			var iclass = $(this).attr('id');
				        			iclass = iclass.substring(0, iclass.length-1)+'active';
				        			$(this).removeClass(iclass);
				        			$(this).removeClass('active');
				        		});
				        		$('#draftb').addClass('draftactive active');
				        		vsf.get('messages/draft', 'campus_user_right');
				        	});
				        	
				        	$('#spamb').click(function(){
				        		$('.campus_user_left > a').each(function(){
				        			var iclass = $(this).attr('id');
				        			iclass = iclass.substring(0, iclass.length-1)+'active';
				        			$(this).removeClass(iclass);
				        			$(this).removeClass('active');
				        		});
				        		$('#spamb').addClass('spamactive active');
				        		vsf.get('messages/spam', 'campus_user_right');
				        	});
				        	
				        	$('#sentb').click(function(){
				        		$('.campus_user_left > a').each(function(){
				        			var iclass = $(this).attr('id');
				        			iclass = iclass.substring(0, iclass.length-1)+'active';
				        			$(this).removeClass(iclass);
				        			$(this).removeClass('active');
				        		});
				        		$('#sentb').addClass('spamactive active');
				        		vsf.get('messages/sent', 'campus_user_right');
				        	});
				        	
				        	$('#trashb').click(function(){
				        		$('.campus_user_left > a').each(function(){
				        			var iclass = $(this).attr('id');
				        			iclass = iclass.substring(0, iclass.length-1)+'active';
				        			$(this).removeClass(iclass);
				        			$(this).removeClass('active');
				        		});
				        		$('#trashb').addClass('spamactive active');
				        		vsf.get('messages/trash', 'campus_user_right');
				        	});
				        </script>
				        <div class="campus_user_right" id='campus_user_right'>
				        	{$option['campus_user_right']}
				        </div>
				        <div class="clear"></div>
			        	<script type='text/javascript'>
			        		$('#{$bw->input[1]}b').addClass('{$bw->input[1]}active active');
			        		{$option['draftcomposejs']}
			        	</script>
		        	</div>
EOF;
	}
	
	function mainlayout($option){
		global $vsLang, $bw, $vsTemplate;

		$BWHTML .= <<<EOF
			{$vsTemplate->global_template->GLOBAL_PARTNER}
			<div id="campus_user">
		    	<div id="tabs">
					<ul class="campus_user_menu">
						<li>
				        	<a href="{$bw->base_url}users/acctab/&ajax=1&tab=acctab">
				        		{$vsLang->getWords('tab_acc','Account')}
				        	</a>
				        </li>
				        <li>
				        	<a href="#tabmessage">
				        		{$vsLang->getWords('tab_message','Message')}
				        	</a>
				        </li>
				        <li>
				        	<a href="{$bw->base_url}users/protab/&ajax=1&tab=protab">
				        		{$vsLang->getWords('tab_profile','Profile')}
				        	</a>
				        </li>
				        <li>
				        	<a href="{$bw->base_url}listings/mylisting&ajax=1&tab=mylisting">
				        		{$vsLang->getWords('tab_mylisting','My listing')}
				        	</a>
				        </li>
				        <li>
				        	<a href="#sharing">My sharing</a>
				        </li>
				        <li>
				        	<a href="#setting">Settings</a>
				        </li>
	        		</ul>
		            <div class="clear_left"></div>
		            {$option['core_content']}
		        </div>
			</div>
        	<div class="clear"></div>
        	<script type='text/javascript'>
        		$(document).ready(function(){
	    			var itab = $("#tabs").utabs({
	    				cache: false,
	    				selected: 1,
	    				select: function(event, ui) {
						        var content = '<img src="'+imgurl+'ajax-loader.gif" alt="retrieving data ..." style="height: 20px"/>';
						        content += '<br /><b>Fetching Data.... </b>';
						        
						        var html = '<div style="margin: 10px">' + content + '</div>';
						        $("#ui-tabs-" + (ui.index)).html(html);
							}
	    			});
	  			});
        	</script>
EOF;
	}

	function error($message = '', $redirect = ''){
		$BWHTML .= <<<EOF
        	<script type='text/javascript'>
        		<if=" $message ">
        			$.blockUI({
				        css: {
				        		border: 'none',
	            				padding: '50px',
					            backgroundColor: '#C0C0C0',
					            color: '#000',
					            cursor:'progress'
					        },
						message: '<h1>{$message}</h1>'
					});
					setTimeout(function(){
						$.unblockUI();
						<if=" $redirect ">
						location.href = '{$redirect}';
						</if>
					}, 2000);
        		<else />
	        		location.href = '{$redirect}';
				</if>
        	</script>
EOF;
	}
}
?>