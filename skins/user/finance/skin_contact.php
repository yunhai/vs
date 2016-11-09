<?php
class skin_contact {

	function contactForm($option) {
		global $vsLang, $bw, $vsSettings, $vsPrint;
			
		$vsPrint->addJavaScriptFile('icampus/jquery.validate.pack', 1);
		$BWHTML .= <<<EOF
				<div id='contact-form'>
					<form id="formContact" method="POST" action="{$bw->vars['board_url']}/contact">
						<div class='type cfheader'>
							<span class='item active' ref='feedback'>Feedback</span>
							<span class='item' ref='report'>Report Bugs/Errors</span>
							<span class='item' ref='suggest'>Suggest Feathers/Improvement</span>
							<div class='clear'></div>
						</div>							
						
						<if=" $option['message'] ">
							<div id='message'>{$option['message']}</div>
							<script type='text/javascript'>
								setTimeout(function(){
						        	$('#message').toggle("slow", function(){	
										$(this).remove();
									});
						        }, 2000);
					        </script>
						</if>
						
				        <label>{$vsLang->getWords('contact_name','Name')}:</label>
				        <input id='contactName' name='contactName' value='{$option['contact']['contactName']}' />
				        
				        <label>{$vsLang->getWords('contact_lastname','Email')}:</label>
				        <input id='contactEmail' name="contactEmail" value='{$option['contact']['contactEmail']}' />
				        
				        <label>{$vsLang->getWords('contact_username','Username')}:</label>
				        <input name="username" value='{$option['contact']['username']}' />
				        
						<label>{$vsLang->getWords('contact_message','Feedback')}</label>
	            		<textarea id="contactContent" name="contactContent">{$option['contact']['contactContent']}</textarea>

	            		
	            		<label>&nbsp;</label>
			            <div class='recapchar'>
			            	{$option['recapcha']}
						</div>

						<div class='clear'></div>
			            <input class="button" name='isubmit' type="submit" value="{$vsLang->getWords('send','Send')}" />
			            
			            <span class="term">
				        	You can also send your fedback to {$vsSettings->getSystemKey('feedback email', 'feedback@icampux.com', 'global')}
			            </span>
				        <div class='clear'></div>
					</form>
              	</div>
			<script type='text/javascript'>
				$('.item').each(function(){
					var ref = $(this).attr('ref');
					if(ref == '{$bw->input['type']}'){					
						$('.active').removeClass('active');
						$(this).addClass('active');
					}
				});
				
				$('.item').click(function(){
					if($(this).hasClass('active')) return false;
					$('.active').removeClass('active');
					$(this).addClass('active');
				});
				
				
				$('input').bind('keypress', function(e) {
					var code = (e.keyCode ? e.keyCode : e.which);
					if(code == 13) return false;
				});
		
				$("#formContact").validate({
					rules: {
						contactName: {
							required: true,
						},
						
						contactEmail:{
							email: true
						},
						
						contactUser: {
							minlength: 6,
						},
						contactContent: {
							required: true,
							minlength: 6,
						}
					},
					messages:{
						contactName: {
							required: "{$vsLang->getWords('validate_contactname','Provide your name')}"
						},
						
						contactEmail:{
							email: "{$vsLang->getWords('validate_contactemail','Please enter a valid email address')}"
						},
						
						contactUser: {
							minlength: jQuery.format("Enter at least {0} characters"),
						},
						contactContent: {
							required: "{$vsLang->getWords('validate_contactcontent','Provide your feedback')}",
							minlength: jQuery.format("Enter at least {0} characters"),
						}
					},
					
					success: function(label) {
						label.html("&nbsp;").addClass("checked");
					},
					
					submitHandler: function(form){
						$.blockUI({
				        	css: {
				        		border: 'none',
	            				padding: '50px',
					            backgroundColor: '#C0C0C0',
					            color: '#000',
					            cursor:'progress',
					        },
						});
						var stype = $('.type > .active').attr('ref');
						var hidden = "<input id='type' type='hidden' name='type' value='"+stype+"' />";
						
						$('#contactType').remove();
						$(form).append(hidden);
						
						form.submit();
						return false;
					}
				});
			</script>
EOF;
	}

	function generalView($option= array()){
		global $bw, $vsLang, $vsSettings;

		$BWHTML = <<<EOF
			<div id="contact">
				<div id='left-contact'>
					<h3>Contact us</h3>
					<div id='info' class='contact'>
						<div class='title'>General Infomation</div>
						<span>{$vsSettings->getSystemKey('global_systememail', 'info@icampux.com', 'global')}</span>
					</div>
					<div id='support' class='contact'>
						<div class='title'>Support Request</div>
						<span>{$vsSettings->getSystemKey('support_email', 'support@icampux.com', 'global')}</span>
					</div>
					<div id='partnership' class='contact'>
						<div class='title'>Partnership Inquires</div>
						<span>
							Bussiness development
							{$vsLang->getWords('bizdev_developement','Bussiness development')}<br />
							{$vsLang->getWords('bizdev_phone','(408) xxx - xxxx')}<br />
							{$vsSettings->getSystemKey('bussiness_development email', 'bizdev@icampux.com', 'global')}
						</span>
					</div>
					<div id='report' class='contact'>
						<div class='title'>Report Abuse/Harassment</div>
						<span>{$vsSettings->getSystemKey('abuse_email', 'abuse@icampux.com', 'global')}</span>
					</div>
					<div id='mailaddress' class='contact'>
						<div class='title'>Mail Address</div>
						<span>
							{$vsLang->getWords('mailbox_mailbox','PO Box 432423')}<br />
							{$vsLang->getWords('mailbox_address','San Jose, CA 34234')}
						</span>
					</div>
					<div class='cslogan'>
						<span>{$vsLang->getWords('contact_slogan',"We'd love to hear from you!")}</span>
					</div>
				</div>
				
				{$this->contactForm($option)}
				
				<div class='clear'></div>
			</div>
			
EOF;
	}
}
?>