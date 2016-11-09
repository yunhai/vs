<?php
class skin_campuses{
	function nocampus($option){
		global $vsLang, $bw, $vsPrint, $vsTemplate;
		$vsPrint->addJavaScriptFile('icampus/jquery.blockUI', 1);
		$vsPrint->addJavaScriptFile('icampus/jquery.validate.pack');
		$BWHTML .= <<<EOF
			{$this->leftSubject($option['subject'])}
			<div id="content1">
				{$vsTemplate->global_template->GLOBAL_PARTNER}
		        <div id="content_left">
		        	<div class="user_status">
		                <div class="user_title">
		                    <p class="user_nick">David Beckham (Love_Victoria)</p>
		                    <p class="user_status"><strong>Current status</strong> clear</p>
		                </div>
		                <div class="clear"></div>
		                <form>
		                    <input type="text" onfocus="if(this.value=='What are you doing?') this.value='';" onblur="if(this.value=='') this.value='What are you doing?';" value="What are you doing?"  />
		                    <button>Update</button>
		                </form>
		                <div class="user_menu">
		                	<ul>
		                        <li><a href="#" class="active">IM</a></li>
		                        <li><a href="#">Info</a></li>
		                        <li><a href="#">Photos</a></li>
		                        <li><a href="#">My Campus</a></li>                       
		                        <li class="last_li"><a href="#">more >> </a></li>
		                    </ul>
		                </div>
		            </div>
		            <div class="navigation1 clear_left">
		            	<a href="#">Campus </a> >>
		                <a href="#">San jose State university</a>
		            </div>
		            <div class="book_detail" id="book_detail">
		            	Your campus cannot be found. Please try to 
		            		<a href="{$bw->vars['board_url']}/textbooks" title="{$vsLang->getWords('search_again','Click here to search again')}" class="no-campus" id="again" >search again</a>. 
		            		Sorry for the inconvenience.<br /> 
                    	If your campus is not yet in our system, please
                    	<a href="#" title="{$vsLang->getWords('add_campus','Click here to add campus')}" class="no-campus" id="addForm"> click here </a>
                    	to let us know. Thank you so much for your support.<br /> 
                    	<br />
                    	iCampux.com
		            </div>
		        </div>
	    	</div>
	    	<div class="clear"></div>
	    	<div id="callback"></div>
	    	
	    	<div style="display:none;" id="formContainer">
	    		<div class="formHeader">
			        <span class="form_label">Add Campus</span>
			        <span id="close">X</span>
			        <div class="clear"></div>
			    </div>
	    		<div id="container">
	    			<div id="formCont"></div>
	    			<div id="editForm">
				    	<input class="input" type="hidden" name="campusId" />
						<table cellpadding="0" cellspacing="1" width="100%" id="formTable">						
					    	<tr>
					        	<th>{$vsLang->getWords('name','Name')}</th>
					            <td><input id="campusTitle" name="campusTitle" value="{$option['campus']}" /></td>
					        </tr>
					        <tr>
					        	<th>{$vsLang->getWords('address','Address')}</th>
					            <td><input id="campusAddress" name="campusAddress" /></td>
					        </tr>
					        <tr>
					        	<th>{$vsLang->getWords('phone','Phone')}</th>
					            <td><input id="campusPhone" name="campusPhone" /></td>
					        </tr>
					        <tr>
					            <td colspan="2">
					            	<button class="ui-state-default ui-corner-all" id="submit111" onclick="submitForm()">{$option['button']}</button>
				            	</td>
					        </tr>
					    </table>
				    </div>
				</div>
				<script type="text/javascript">
					function submitForm(){
						$('#formContainer').block({
				        	css: {
				        		border: 'none',
				        		padding: '20px',
				        		backgroundColor: '#FFF',
					            color: '#000',
					            cursor:'progress',
					            opacity: .9, 
					        },
					       message: "<div id='block_message'><img src='{$bw->vars['board_url']}/styles/images/ajax-loader.gif' alt='loading' /><br />{$vsLang->getWords('global_wait','Please wait...')}</div>",
					       onBlock: function(){
					        	var formElement = "<form method='post' id='mainForm'></form>";
								$('#formCont').append(formElement);
								$('#mainForm').append($('#formTable'));
								vsf.submitForm($('#mainForm'),'campuses/edit/','callback');
								return false;
					        }
						});
					
					}
				</script>
			</div>
	    	<script type="text/javascript">
            	$(document).ready(function() {
			   		$("#addForm").click(function(){
						$.blockUI({
				        	css: {
				        		border: 'none',            					
					            color: '#000',
					            cursor:'progress',
					            padding: '0px'
					        },
					        message: $('#formContainer'),
						});
			   		});
			   			
			   		$("#again").click(function(){
						$.blockUI({
				        	css: {
				        		border: 'none', 
            					padding: '50px',
					            backgroundColor: '#C0C0C0',
					            color: '#000',
					            cursor:'progress',
					        },
					        message: "<div id='block_message'><img src='{$bw->vars['board_url']}/styles/images/ajax-loader.gif' alt='loading' /><br />{$vsLang->getWords('global_wait','Please wait...')}</div>",
					        fadeIn: 1000
						});
			   		});
				});
				
				$('#close').click(function(){
					$('#formContainer').unblock()
					$.unblockUI();
				});
				
			
            </script>
           
EOF;
		return $BWHTML;
	}
	
	function callback($option){
		global $vsLang;
		$BWHTML .= <<<EOF
			<script type='text/javascript'>
				$('#block_message').html('{$option['message']}');
				setTimeout(function() { 
		        	$.unblockUI();
		        	$('#formContainer').unblock();
		        	{$option['script']}
		        }, 2000);
			</script>
EOF;
		return $BWHTML;
	}
	
	function leftSubject($option = array()){
		global $bw;
		$BWHTML .= <<<EOF
			<div id="sitebar">
		        <div class="subject_list">
		        	<h3>Subjects</h3>
		        	<if=" $option ">
		        	<foreach=" $option as $cat ">
		            <a href="{$bw->vars['board_url']}/textbooks/subject/{$cat->getId()}" title="{$cat->getTitle()}">{$cat->getTitle()}</a>
		            </foreach>
		            </if>
		        </div>
		    </div>
EOF;
		return $BWHTML; 
	}


	
}
?>