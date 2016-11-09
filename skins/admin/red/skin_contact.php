<?php
	class skin_contact{

		function contactList( $option) {
			global $vsLang, $bw, $vsPrint;
			$count=1;
			$vsPrint->addJavaScriptFile('/jquery/jquery.tablesorter');
			$bw->input[3] = $bw->input[3]?$bw->input[3]:1;		
			$BWHTML = "";
			$BWHTML .= <<<EOF
				
				<div id="ContactList">
				<script>
				function checkAll{$option['contactType']}() {
					var checked_status = $("input[name=all{$option['contactType']}]:checked").length;
					var checkedString = '';
					$("input[type=checkbox]").each(function(){
						if($(this).hasClass('myCheckbox{$option['contactType']}')){
						this.checked = checked_status;
						if(checked_status) checkedString += $(this).val()+',';
						}
					});
					$("span[acaica=myCheckbox{$option['contactType']}]").each(function(){
						if(checked_status)
							this.style.backgroundPosition = "0 -50px";
						else this.style.backgroundPosition = "0 0";
					});
					$('#checked-obj').val(checkedString);
				}
				

				</script>
				<style>
				.writeSangpm{
				background:#9CD9EB none repeat scroll 0 0;
				padding:4px 15px 4px 25px;
				position:relative;
				
				}
				</style>
				<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner writeSangpm">
				    <span class="ui-dialog-title " ">{$vsLang->getWords('contact_TableTittle','List of Contacts')}</span>
				</div>
				<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner ui-widget-header">
			    	<li class="ui-state-default ui-corner-top">
			    		<a style='float:left;margin-right:30px' onclick="javascript:deleteAllContact({$option['contactType']});">
							{$vsLang->getWords('contact_multiDelete','Delete Selected')}
						</a>
			    	</li>
			    	<li class="ui-state-default ui-corner-top">
			        	<a style='float:left;margin-left:5px;' onclick="vsf.get('contact/multiReplyForm/{$option['contactType']}/', 'replyForm');">
							{$vsLang->getWords('contact_multiReply','Multi Reply')}
						</a>
					</li>
				</ul>	
				<table cellpadding="1" cellspacing="1" class='ui-dialog-content ui-widget-content' id='contactItemTable' width="100%">
					<thead>
					    <tr>
					        <th width='10'>
					        	<input type="checkbox" onclick="checkAll{$option['contactType']}()" name="all{$option['contactType']}" />
					        </th>
					        <th>{$vsLang->getWords('contactTitle','Title')}</th>
					        <th width='200'>{$vsLang->getWords('contactParner','From')}</th>
					        <th width='75' >{$vsLang->getWords('contactTime','Sent Time')}</th>
					        <th width='50' >{$vsLang->getWords('contactStatus','Status')}</th>
					    </tr>
					</thead>
					<tbody>
				    <if="is_array($option['pageList'])">
				    <foreach="$option['pageList'] as $contactP">
				    	<tr class='$vsf_class'>
							<td style="text-align:center">
							
								<input type="checkbox" name="obj_{$contactP->getId()}" value="{$contactP->getId()}" class="myCheckbox{$option['contactType']}" />
							</td>
							<td >
								<a class='recordLink' title='{$contactP->getName()}' onclick="javascript:vsf.get('contact/read/{$contactP->getId()}/', 'replyForm');">
									{$contactP->getTitle()}
								</a>
							</td>
							<td >{$contactP->getName()} ({$contactP->getEmail()})</td>
							<td >{$contactP->getPostDate("SHORT")}</td>
							<td>{$contactP->getIsReply()}</td>
						</tr>
				    </foreach>
				    </if>
				    </tbody>
				    <tfoot>
					    <tr>
					    	<th colspan="5" style="height:40px;" align="left">
					        	
					        	<div style='float:right;'>{$option['paging']}</div>
					        </th>
					    </tr>
					</tfoot>
				</table>
				</div>
	<script type='text/javascript'>
		function deleteAllContact(contactType){
			jConfirm(
				'{$vsLang->getWords("contact_deleteContactConfirm","Are you sure to delete this contact information?")}', 
				'{$bw->vars['global_websitename']} Dialog', 
				function(r){
					if(r){
						var jsonStr = "";
						$("input[type=checkbox]").each(function(){
							if($(this).hasClass('myCheckbox'+contactType)){
								if(this.checked) jsonStr += $(this).val()+',';											
							}
						});
								
						if(jsonStr == ""){
							jAlert(
								"{$vsLang->getWords('contact_deleteAllConfirm_NoItem', "You haven't choose any items!")}",
								"{$bw->vars['global_websitename']} Dialog"
							);
							return false;
						}
						
						jsonStr = jsonStr.substr(0,jsonStr.lastIndexOf(','));
						
						vsf.get('contact/deleteAllContact/'+contactType+'/'+jsonStr+'/','ContactList');
					}
				}
			);
		}
</script>
				
EOF;
		return $BWHTML;
				    	
			}
			


		function readContactInfo($contact,$contactProfile){
			global $vsLang;
				
			$BWHTML .= <<<EOF
				<div id='viewFormContainer' class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
				    <div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
						<span class="ui-dialog-title">{$vsLang->getWords('contactReadTitle','Read Email')}: {$contact->getTitle()}</span>
				        	<span id="viewForm" class="buttonClose">  x </span>
				        </a>
					</div>
					<table cellpadding="1" cellspacing="1" border="0" class="ui-dialog-content ui-widget-content" width="100%">
						<tr class="smalltitle">
						<td class='left'>
							{$vsLang->getWords('contactCompany','Company:')}:
						</td>
						<td>{$contactProfile['contactCompany']}</td>
						</tr>
						<tr class="smalltitle">
				        	<td class='left'>{$vsLang->getWords('contactParner','From')}:</td>
							<td><b>{$contact->getName()}</b></td>
						</tr>
				        <tr class="smalltitle">
				        	<td class='left'>{$vsLang->getWords('contactEmail','Email')}:</td>
				            <td>{$contact->getEmail()}</td>
						</tr>
				        <tr class="smalltitle">
				        	<td class='left'>{$vsLang->getWords('contactPhone','Phone')}:</td>
				            <td></td>
						</tr>
				        <tr class="smalltitle">
				        	<td class='left'>{$vsLang->getWords('contactTime','Sent Time')}:</td>
				            <td>{$contact->getPostDate("SHORT")}</td>
						</tr>
				        <tr>
				        	<td valign="top" class="smalltitle">{$vsLang->getWords('contactMessage','Message')}:</td>
				            <td class="ui-dialog-buttonpanel">
				            	<input id='replyButton' style='float:left;' value="{$vsLang->getWords('contactReply','Reply')}" type="button" />
							</td>
						</tr>
				        <tr>
				        	<td class='myTd' colspan="2" valign="top">
				            	<div id='contactMessage' class='ui-dialog ui-widget ui-widget-content ui-corner-all' style='min-height:100px;'>
									<h4>{$vsLang->getWords('contact_message','Message:')}</h4></br>
											{$contact->getContent()}
				               	</div>
							</td>
						</tr>
					</table>
				</div>
				<script type='text/javascript'>
					$('#viewForm').click(function(){
						$('#viewFormContainer').remove();
					});
					
					$('#replyButton').click(function(){
						var containerDiv='<div id="container" style="top:20px!important;"></div>'
						$('#vswrapper').append(containerDiv);
						
						vsf.get('contact/reply/{$contact->getId()}/', 'replyForm');
					});
				</script>
EOF;
			return $BWHTML;
		}

		function multiReplyContactForm($option){
			global $vsLang;
				$BWHTML = "";
				$BWHTML .= <<<EOF
				<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
					<form id="formReply" method="post">
						<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
							<span class="ui-dialog-title">
								{$vsLang->getWords('contact_multiReplyFormTitle','Multi Reply Email')}
							</span>
<!--
					       	<span id="buttonClose" class="ui-dialog-title" style="float:right;float: right; margin-left: 10px; cursor: pointer;"> Close </span>
							<span class="ui-dialog-title" style="float:right;">
								<a title="{$vsLang->getWords('contacts_replyForm_Send','Send Reply')}" onclick="sendReply();return false;" href="javascript:;" class='myLink'> 
									{$vsLang->getWords('contacts_replyForm_Send','Send Reply')}
								</a>
							</span>
-->
							<span id="buttonClose" class="ui-dialog-title" style="float:right;float: right; margin-left: 10px; cursor: pointer;">
								{$vsLang->getWords('contact_formCloseButton','T?t')}
							</span>
					       	<span id="buttonSendMulti" class="ui-dialog-title" style="float:right;float: right; margin-left: 10px; cursor: pointer;">
								{$vsLang->getWords('contacts_replyForm_Send','Send Reply')}
							</span>
						</div>
						{$option['replyFormEditor']}
					</form>
				</div>
				
				<script type='text/javascript'>
					function sendReply(){
						$('#formReply').submit();
					}
							
					$('#buttonSendMulti').click(function (){
						$('#formReply').submit();
					});
					$('#buttonClose').click(function(){
						$("#replyForm").html('');
					});

					$('#formReply').submit(function(){
						var jsonStr = "";
							$("input[type=checkbox]").each(function(){
								if($(this).hasClass('myCheckbox{$option["type"]}')){
									if(this.checked) jsonStr += $(this).val()+',';
								}
							});	
						if(jsonStr == ""){
							
							jAlert(
								"{$vsLang->getWords('contact_deleteAllConfirm_NoItem', 'You haven\'t choose any items!')}",
								"{$bw->vars['global_websitename']} Dialog"
							);
							return false;
						}						
						jsonStr = jsonStr.substr(0,jsonStr.lastIndexOf(','));
						var hiddenId = '<input type="hidden" name="id" value="' + jsonStr + '"/>';						
						$('#formReply').append(hiddenId);
						vsf.submitForm($('#formReply'),'contact/multiReply/{$option['type']}//','maincontent');
						$('#buttonClose').click();
						return false;
					});
				</script>
EOF;
		return $BWHTML;
		}
		
		function replyContactForm( $option){
			global $vsLang;
			$BWHTML .= <<<EOF
				<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
					<form id="formReply" method="post">
						<input type="hidden" name="email" value="{$option['obj']->getEmail()}"/>
						<input type="hidden" name="name"  value="{$option['obj']->getName()}"/>
						<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
							<span class="ui-dialog-title">
								{$vsLang->getWords('contactReplyFormTitle','Reply Email')}
							</span>
<!--
					       	<span id="buttonClose" class="ui-dialog-title" style="float:right;float: right; margin-left: 10px; cursor: pointer;"> Close </span>
							<span class="ui-dialog-title" style="float:right;">
								<a title="{$vsLang->getWords('contacts_replyForm_Send','Send Reply')}" href="javascript:sendReply();" class='myLink'> 
									{$vsLang->getWords('contacts_replyForm_Send','Send Reply')}
								</a>
							</span>
-->							
							<span id="buttonClose" class="ui-dialog-title" style="float:right; margin-left: 10px; cursor: pointer;">
								{$vsLang->getWords('contact_formCloseButton','T?t')}
							</span>
					       	<span id="buttonSend" class="ui-dialog-title" style="float:right; margin-left: 10px; cursor: pointer;">
								{$vsLang->getWords('contacts_replyForm_Send','Send Reply')}
							</span>
							
						</div>
						{$option['replyFormEditor']}
					</form>
				</div>
				
				<script type='text/javascript'>					
					function sendReply(){
						$('#formReply').submit();
						$('#buttonClose').click();
					}
						
					$('#buttonSend').click(function(){
						$('#formReply').submit();
						$('#buttonClose').click();
					});
					
					$('#buttonClose').click(function(){
						$("#replyForm").html('');
					});

					$('#formReply').submit(function(){		
							
						vsf.submitForm($(this),'contact/replyProcess/{$option["obj"]->getId()}/{$option["obj"]->getType()}/','maincontent');
						return false;
					});
				</script>
EOF;
			return $BWHTML;
		}
		
function contactMainLayout($option){
global $bw,$vsLang,$vsSettings;
$BWHTML  = "";
$BWHTML .= <<<EOF
<div id="replyForm"><div style="color:red;">{$option['message']}</div></div>
	<div id="page_tabs"  class="ui-tabs ui-widget ui-widget-content ui-corner-all-top">				
		<ul id="tabs_nav" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner">			    	
	        <li class="ui-state-default ui-corner-top  ui-tabs-selected ui-state-active">
	        	<a href="{$bw->base_url}contact/showContact/0/&ajax=1" ><span>{$vsLang->getWords('tab_contacts_comment','G�p �')}</span></a>
	        </li>
	        <li class="ui-state-default ui-corner-top">
	        	<a href="{$bw->base_url}pages/pageCode/contacts/&ajax=1" ><span>{$vsLang->getWords('tab_contacts_content','N?i dung')}</span></a>
	        </li>
	        <if="$vsSettings->getSystemKey($bw->input[0].'_setting_tab',1)">
	        <li class="ui-state-default ui-corner-top">
        		<a href="{$bw->base_url}systemsettings/display-setting-tab/{$bw->input[0]}/&ajax=1">{$vsLang->getWords('tab_contact_SS','Contacts SystemSettings')}</a>
        	</li>	
        	</if>
		</ul>							
	</div>
	
EOF;
return $BWHTML;
}

}
?>