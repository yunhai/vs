<?php
class skin_listings {
	
	
	function listingtab_all($option){
		global $bw, $vsLang;
		$BWHTML .= <<<EOF
			<style>
				.container{
					margin-bottom: 20px;
				}
				.concatttile{
					font-weight: bold;
					background-color: #999;
					height: 20px;
					line-height: 20px;
					display:block;
					text-indent: 10px;
					padding: 10px;
					color: #FFF;
				}
			</style>
			<foreach=" $option['content'] as $key => $content ">
				<div class='container'>
					<div class='concatttile'>{$key}</div>
					<div id='{$option['key'][$key]}'>{$content}</div>
				</div>
			</foreach>
EOF;
	}
	
	
	function mylisting($option){
		global $bw, $vsTemplate, $vsLang;
		
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
				        	<a href="{$bw->base_url}messages/inbox&ajax=1&tab=inbox">
				        		{$vsLang->getWords('tab_message','Message')}
				        	</a>
				        </li>
				        <li>
				        	<a href="{$bw->base_url}users/protab/&ajax=1&tab=protab">
				        		{$vsLang->getWords('tab_profile','Profile')}
				        	</a>
				        </li>
				        <li>
				        	<a href="#tabmylisting">
				        		{$vsLang->getWords('tab_mylisting','My listing')}
				        	</a>
				        </li>
				        <li>
				        	<a href="{$bw->base_url}users/sharing">My sharing</a>
				        </li>
				        <li>
				        	<a href="{$bw->base_url}users/settingtab/&ajax=1&tab=settingtab">
				        		Settings
				        	</a>
				        </li>
	        		</ul>
		            <div class="clear_left"></div>
		            
 					{$this->coremylisting($option)}
		        </div>
		        <script type='text/javascript'>
					$(document).ready(function() {
		    			var itab = $("#tabs").utabs({
		    				cache: false,
		    				selected: 3,
		    				select: function(event, ui) {
						        var content = '<img src="'+imgurl+'ajax-loader.gif" alt="retrieving data ..." style="height: 20px"/>';
						        content += '<br /><b>Fetching Data....</b>';
						        
						        var html = '<div style="margin: 10px">' + content + '</div>';
						        $("#ui-tabs-" + (ui.index)).html(html);
							}
		    			});
					})
				</script>
			</div>
        	<div class="clear"></div>
EOF;
	}
	
	function coremylisting($option){
		global $bw, $vsLang;

 		$BWHTML .= <<<EOF
 			<div id='tabmylisting'>
		        <ul class="listing_tab">
		        	<li id='listing_all' class='iselect'>
		        		<a href="javascript:;">
 							{$vsLang->getWords('mylisting_all','All')}
 						</a>
 						<ul class='subtab'>
 							<li>
	 							<a href="javascript:;" id='ltab_textbook_all' class='submenu active' rel='all'>
									{$vsLang->getWords('mylisting_textbook_all','All')}
								</a>
		 					</li>
		 					<li>
				        		<a href="javascript:;" id='ltab_textbook_open' class='submenu' rel='open'>
									{$vsLang->getWords('mylisting_textbook_open','Open')}
			 					</a>
		 					</li>
		 					<li>
				        		<a href="javascript:;" id='ltab_textbook_sold' class='submenu' rel='sold'>
									{$vsLang->getWords('mylisting_textbook_sold','Sold')}
								</a>
		 					</li>
		 					<li>
				        		<a href="javascript:;" id='ltab_textbook_pending' class='submenu' rel='pending'>
									{$vsLang->getWords('mylisting_textbook_pending','Pending')}
			 					</a>
		 					</li>
 						</ul>
		        	</li>

		        	<li id='listing_textbook'>
		        		<a href="javascript:;">
							{$vsLang->getWords('mylisting_textbook','Textbook')}
 						</a>
 						<ul class='subtab'>
 							<li>
	 							<a href="javascript:;" id='ltab_textbook_all' class='submenu active' rel='all'>
									{$vsLang->getWords('mylisting_textbook_all','All')}
								</a>
		 					</li>
		 					<li>
				        		<a href="javascript:;" id='ltab_textbook_open' class='submenu' rel='open'>
									{$vsLang->getWords('mylisting_textbook_open','Open')}
			 					</a>
		 					</li>
		 					<li>
				        		<a href="javascript:;" id='ltab_textbook_sold' class='submenu' rel='sold'>
									{$vsLang->getWords('mylisting_textbook_sold','Sold')}
								</a>
		 					</li>
		 					<li>
				        		<a href="javascript:;" id='ltab_textbook_pending' class='submenu' rel='pending'>
									{$vsLang->getWords('mylisting_textbook_pending','Pending')}
			 					</a>
		 					</li>
 						</ul>
		        	</li>

		        	<li id='listing_icmarket' class='iselect'>
		        		<a href="javascript:;">
							{$vsLang->getWords('mylisting_icmarket','icMarket')}
 						</a>
 						<ul class='subtab'>
 							<li>
	 							<a href="javascript:;" id='ltab_icmarket_all' class='submenu active' rel='all'>
									{$vsLang->getWords('mylisting_icmarket_all','All')}
								</a>
		 					</li>
		 					<li>
				        		<a href="javascript:;" id='ltab_icmarket_open' class='submenu' rel='open'>
									{$vsLang->getWords('mylisting_icmarket_open','Open')}
			 					</a>
		 					</li>
		 					<li>
				        		<a href="javascript:;" id='ltab_icmarket_sold' class='submenu' rel='sold'>
									{$vsLang->getWords('mylisting_icmarket_sold','Sold')}
								</a>
		 					</li>
		 					<li>
				        		<a href="javascript:;" id='ltab_icmarket_pending' class='submenu' rel='pending'>
									{$vsLang->getWords('mylisting_icmarket_pending','Pending')}
			 					</a>
		 					</li>
 						</ul>
		        	</li>
		            <div class="clear_left"></div>
		        </ul>
		        <div id='mylistingContainer'></div>
		        
		        <script type='text/javascript'>
		        	$(document).ready(function(){
		        		$('#listing_all').click(function(){
			        		$(this).siblings().removeClass('ui-tabs-selected');
			        		$(this).addClass('ui-tabs-selected');

			        		var content = '<img src="'+imgurl+'ajax-loader.gif" alt="retrieving data ..." style="height: 20px"/>';
					        content += '<br /><b>Fetching Data....</b>';
					        
					        var html = '<div style="margin: 10px">' + content + '</div>';
					        $("#mylistingContainer").html(html);
					        
			        		vsf.get('listings/alllistings/', 'mylistingContainer');
			        		return false;
			        	});
			        	
			        	$('#listing_textbook').click(function(){
			        		$(this).siblings().removeClass('ui-tabs-selected');
			        		$(this).addClass('ui-tabs-selected');

			        		var content = '<img src="'+imgurl+'ajax-loader.gif" alt="retrieving data ..." style="height: 20px"/>';
					        content += '<br /><b>Fetching Data....</b>';
					        
					        var html = '<div style="margin: 10px">' + content + '</div>';
					        $("#mylistingContainer").html(html);
					        
			        		vsf.get('listings/textbook/', 'mylistingContainer');
			        		return false;
			        	});
			        	
			        	$('#listing_icmarket').click(function(){
			        		$(this).siblings().removeClass('ui-tabs-selected');
			        		$(this).addClass('ui-tabs-selected');

			        		var content = '<img src="'+imgurl+'ajax-loader.gif" alt="retrieving data ..." style="height: 20px"/>';
					        content += '<br /><b>Fetching Data....</b>';
					        
					        var html = '<div style="margin: 10px">' + content + '</div>';
					        $("#mylistingContainer").html(html);
					        
			        		vsf.get('listings/icmarket/', 'mylistingContainer');
			        		return false;
			        	});

			        	
			        	
			        	
//fire first tab			        	
			        	var iid = '';
			        	if ($(".iselect").length > 0){
    						iid = $('.iselect').attr('id');
			        		$('#'+iid).click();
						}
//end fire first tab




//begin submenu						
						$(".listing_tab li").hover(
							function(){
								$(this).find('ul:first').css({visibility: "visible", display: "none"}).fadeIn("slow");
								/* -- nếu bỏ display none thì khi hover lại lần thứ 2 thì kg có faceIn -- */
							},
							function(){
								$(this).find('ul:first').css({visibility: "hidden"});
						});
		        	});
//end submenu
		        </script>
	        </div>
EOF;
	}
	
	
	
	function icmarket_all($option = array()){
		global $bw, $vsLang;

		$this->editImage = "<img src='{$bw->vars['img_url']}/edit.png' height='15' style='margin-top: 8px;' />";
		$this->deleteImage = "<img src='{$bw->vars['img_url']}/delete.png' height='13' style='margin-top: 8px;' />";
		
		
		$BWHTML .= <<<EOF
			<div id='ltab_cf_all_con' class='ltab_textbook_con'>
				<div class='header'>
		        	<div class='col col1'>{$vsLang->getWords('ltab_title_c','Title')}</div>
		        	<div class='col col2'>{$vsLang->getWords('ltab_action','Action')}</div>
		            <div class='col col3'>{$vsLang->getWords('ltab_status','Status')}</div>
		            <div class='col col4'>{$vsLang->getWords('ltab_postmanage','Manage')}</div>
		            <div class='col col5'>{$vsLang->getWords('ltab_dateposted','Date Posted')}</div>
		            <div class='clear'></div>
		        </div>
		        <div class='table'>
		        	<if=" $option['pageList'] ">
		        	<foreach=" $option['pageList'] as $element ">
		        	<input id='curStatusCF_{$element['lcId']}' value='{$element['lcStatus']}' name='curStatusCF_{$element['lcId']}' type='hidden' />
		        	<div class='row' id='rowcf_{$element['lcId']}'>
		        		<div class='col col1'>
		        			<a href="{$element['cfURL']}" title="{$element['cfTitle']}" target="_blank">
							{$element['cfTitle']}
							</a>
						</div>
			            <div class='col col2'>{$element['cfType']}</div>
			            <div class='col col3'>
			            	<select class='styled' id='lcStatus_{$element['lcId']}' name='lcStatus_{$element['lcId']}'>
			            		<if=" $element['lcStatus'] != 3">
								<option {$element['lcStatus_1']} value='1'>Open</option>
								<option {$element['lcStatus_2']} value='2'>Pending</option>
								</if>
								<option {$element['lcStatus_3']} value='3'>Sold</option>
							</select>
			            </div>
			            <div class='col col4'>
			            	<if=" $element['lcStatus'] != 3">
			            	<a href='#' title='Click here to edit this item' id='edit_{$element['cfId']}_{$element['lcId']}' class='editlc'>
							{$this->editImage}
							</a>
							</if>
							<a href='javascript:deleteLC({$element['lcId']});' title='Click here to delete this item' id='delete_{$element['lcId']}' style='margin-left: 5px;'>
							{$this->deleteImage}
							</a>
			            </div>
			            <div class='col col5'>{$element['cfTime']}</div>
			            <div class='clear'></div>
		        	</div>
		        	</foreach>
		        	</if>
		        </div>

		        <if=' $option['paging'] '>
		        <div class="page_listing">
		        	<span>Browse Pages:</span>
		        	{$option['paging']}
		        </div>
		        </if>

		        <div style="display:none;" id="lc_a_container">
		    		<div id='lc_a_form_callback'></div>
		    		<form id="lc_a_form" method="POST">
		    			<input type='hidden' name='temp' id='lc_a_form_temp' value='' />
		    			<label>{$vsLang->getWords('lc_a_form_byer','Buyer')}</label>
				        <input name="lcBuyer" id="lcBuyer" value="" />
				        <div class='clear'></div>
				        
				        <label>{$vsLang->getWords('lc_a_form_price','Price')}</label>
				        <input name="lcPrice" id="lcPrice" value="" />
				        <div class='clear'></div>
				        
						<a href="javascript:;" class='bookdetail_btn' id="lc_a_form_submit">
				        	<span>{$vsLang->getWords('cn_form_submit','Submit')}</span>
				        </a>
				        <a href="javascript:;" class='bookdetail_btn' id="lc_a_form_cancel">
				        	<span>{$vsLang->getWords('cn_form_cancel','Cancel')}</span>
				        </a>
				        <div class='clear'></div>
		    		</form>
		    		<div class="clear"></div>
		    	</div>
				<script type='text/javascript'>
					var curpan = {$option['curpan']};
					function deleteLC(id){
		        		jConfirm(
							'Are you sure to delete', 
							'Dialog board', 
							function(r){
								if(r){
									var cb = 'cf_maincontain';
									<if=" $bw->input['t'] ">
										var cb = 'ltab_icmarket_alllb';
									</if>
									vsf.get('listings/deletelc/'+id+'/&t={$bw->input['t']}', cb);
									return false;
								}
						});
		        	}
		        	
		        	var handlerLCSubmit = function() {
						$('#lc_a_form').submit();
					};
					
					
					var handlerLCCancel = function(){
	        			$.unblockUI();
						var tuId = $('#lc_a_form_temp').val();
						var val = $('#curStatusCF_'+tuId).val();
						vsf.jSelect(val, 'lcStatus_'+tuId);
						
						Custom.init();
					};
					
					
					function initBindEditLC(){
                		$('.editlc').bind('click', function(e){
                			var curTemp = $(this).attr('id');
                			var curArr = curTemp.split('_');
                			var curId = curArr[1];
                			var cbId =  curArr[2];

                			$('#rowtemp').remove();

                			$('<div class="row" id="rowtemp" rel="'+curId+'" cb="'+cbId+'"></a>').insertAfter('#rowcf_'+cbId);
                			vsf.get('listings/editlc/'+curId, 'rowtemp');
                			return false;
						});
					}
					
					$(document).ready(function(){
						<if=" $option['pageList'] ">
		        		<foreach=" $option['pageList'] as $element ">
		        			vsf.jSelect('{$element['lcStatus']}', 'lcStatus_{$element['lcId']}');
		        		</foreach>
		        		</if>
						Custom.init();
						
						initBindEditLC(); 
						
						
						var curId; var curTemp; var curArr;
						
						initLCBind(); 
                		function initLCBind(){
                			$('#ltab_cf_all_con select.styled').bind('change', function(e){
                				var curTemp = $(this).attr('id');
                				var curArr = curTemp.split('_');
                				var curId = curArr[1];
                				$('#lc_a_form_temp').val(curId);
                				
	                			$('#lc_a_form_callback').html('');
	                			$('#lcBuyer').val('');
	                			$('#lcPrice').val('');
	                			
	                			if($(this).val() == 1){
	                				jConfirm(
										'Change to open', 
										'Dialog board', 
										function(r){
											if(r){
												vsf.get('listings/openlc/&atype={$option['ajaxtype']}&temp='+curId, '{$option['ajaxcallback']}');
												return false;
											}else{
												var tuId = $('#lc_a_form_temp').val();
												var val = $('#curStatusCF_'+tuId).val();
												vsf.jSelect(val, 'lcStatus_'+tuId);
												Custom.init();

												return false;
											}
									});
									return false;
	                			}
	                			
	                			if($(this).val() == 2){
	                				jConfirm(
										'Change to pending', 
										'Dialog board', 
										function(r){
											if(r){
												vsf.get('listings/pendinglc/&atype={$option['ajaxtype']}&temp='+curId, '{$option['ajaxcallback']}');
												return false;
											}else{
												var tuId = $('#lc_a_form_temp').val();
												var val = $('#curStatusCF_'+tuId).val();
												vsf.jSelect(val, 'lcStatus_'+tuId);
												Custom.init();

												return false;
											}
									});
									return false;
	                			}
	                			
	                			jConfirm(
										'Change to sold', 
										'Dialog board', 
										function(r){
											if(r){
												$('#lc_a_form_submit').bind('click', handlerLCSubmit);
					                			$('#lc_a_form_cancel').bind('click', handlerLCCancel);
					                			
					                			
										        $.blockUI({
										        	theme: true,
					           						title: "{$vsLang->getWords('lc_form_change_cf_status', "Change item's status")}", 
											        message: $('#lc_a_container'),
											        fadeIn: 1000,
												});
												
												
												$('.blockOverlay').click(function(){
						        					$.unblockUI({
														onUnblock: function(){
															var tuId = $('#lc_a_form_temp').val();
															var val = $('#curStatusCF_'+tuId).val();
															vsf.jSelect(val, 'lcStatus_'+tuId);
															Custom.init();
														}
													});
						        				});	
											
												return false;
											}else{
												var tuId = $('#lc_a_form_temp').val();
												var val = $('#curStatusCF_'+tuId).val();
												vsf.jSelect(val, 'lcStatus_'+tuId);
												Custom.init();

												return false;
											}
									});
							});
						}
						

						var crt = '';
						jQuery.validator.addMethod('validUser', function(value, element, alias){
							if($('#lcBuyer').val() != ''){
								return $.validator.methods.remote.call(this, value, element, "{$bw->base_url}users/instant/userexits&ajax=1");
							}
							return true;
						}, jQuery.validator.messages.remote);

						var validator = $("#lc_a_form").validate({
							rules: {
								lcBuyer: {
									validUser: true
								},
								lcPrice: {
									number: true
								}
							},

							messages:{
								lcBuyer: {
									remote: "{$vsLang->getWords('validate_remote_lc_user_exist','This buyer doesnot exists')}"
								},
								lcPrice: {
									number: "{$vsLang->getWords('validate_price_number','Provide a valid price')}"
								}
							},

							success: function(label) {
								label.html("&nbsp;").addClass("checked");
								label.remove();
							},

							submitHandler: function(form){
								$('#lc_a_form_submit').unbind('click', handlerLCSubmit);
								$('#lc_a_form_cancel').unbind('click', handlerLCCancel);
								vsf.submitForm($('#lc_a_form'), 'listings/soldlc/&t={$bw->input['t']}&atype={$option['ajaxtype']}', 'lc_a_form_callback');
								return false;
							}
						});
					});
				</script>
	        </div>
EOF;
	}
	
	function listingtab_icmarket($option){
		global $bw, $vsLang;

 		$BWHTML .= <<<EOF
 			<div id='ltab_icmarket'>
				<div id="ltab_cf_category">
					<select name='cfc' id='cfc'>
						<option value='0'>All</option>
						<foreach=" $option['cfCategory'] as $cfc ">
						<option value='{$cfc->getId()}'>{$cfc->getTitle()}</option>
						</foreach>
					</select>
				</div>
				<div class='clear'></div>	
 			
				<div id='cf_maincontain'>				
		        {$option['cf_all']}
		        </if>
	        </div>
	        
	        <script type='text/javascript'>
	        	var curpan = 0;
	        	
	        	$('.submenu').bind('click', function(){
	        		var func = 'cf'+$(this).attr('rel'); 
	        		
	        		$('.subtab .active').removeClass('active');
	        		$(this).addClass('active');

	        		vsf.get('listings/'+func, 'cf_maincontain');
	        		return false;
	        	});
	        	
	        	$('#cfc').change(function(){
					vsf.get('listings/cf_category/'+$(this).val()+'/&p='+curpan, 'cf_maincontain');
				});
	        </script>
EOF;
	}
	
	function icmarket_callback($option){
		global $bw;
		$BWHTML .= <<<EOF
			<script type='text/javascript'>
				$('#curStatus_{$option['lcId']}').val({$option['curStatus']});
				$('#ltab_icmarket').prepend('<div id="message">{$option['message']}</div>');
				setTimeout(function(){
		        	$('#message').toggle("slow", function(){
						$('#message').remove();
					});
		        }, 2000);
			</script>
EOF;
		return $BWHTML; 
	}
	
	function sold_icmarket_callback($option){
		global $bw;
		
		$script = '';
		if($option['status']){
			if($bw->input['t'] == 'all') $script = <<<EOF
					$('#curStatus_{$option['ltId']}').val(2);
					$('#ltStatus_{$option['ltId']}').children().each(function(){
						if($(this).val() == 1 || $(this).val() == 3)
							$(this).remove();
					});
					
					cb = 'ltab_icmarket_alllb';
					vsf.get('listings/icmarket/&t=all', cb);
EOF;
			else $script .= <<<EOF
				vsf.get('listings/icmarket', 'ltab_icmarket');
EOF;
			$script .= <<<EOF
				
				setTimeout(function(){
		        	$('#message').toggle("slow", function(){
		        		$('#message').remove();
						
						$('label.error').remove();

						$.unblockUI();
					});
		        }, 2000);
EOF;
		}else{
			$script = <<<EOF
				$('#lc_a_form_submit').bind('click', handlerLCSubmit);
				$('#lc_a_form_cancel').bind('click', handlerLCCancel);
				
				var tuId = $('#lc_a_form_temp').val();
				var val = $('#curStatusCF_'+tuId).val();
				vsf.jSelect(val, 'lcStatus_'+tuId);
				Custom.init();
												
				setTimeout(function(){
		        	$('#message').toggle("slow", function(){
		        		$('#message').remove();
						
						$('label.error').remove();

						$.unblockUI();
					});
		        }, 2000);
EOF;
		}
		$BWHTML .= <<<EOF
			<div id="message">{$option['message']}</div>
			<script type='text/javascript'>
				{$script}
			</script>
EOF;
	}
	
	function delete_icmarket_callback($option){
		global $bw;
		$BWHTML .= <<<EOF
			<div id="message">{$option['message']}</div>
			<script type='text/javascript'>
				setTimeout(function(){
		        	$('#message').toggle("slow", function(){
						$('#message').remove();
					});
		        }, 2000);
			</script>
			</if>
EOF;
		return $BWHTML; 
	}
	
	function cf_sold($option = array()){
		global $bw, $vsLang;
		
		$BWHTML .= <<<EOF
			<div id='lcab_cf_sold_con' class='ltab_textbook_con'>
				<div class='header'>
		        	<div class='col col1'>{$vsLang->getWords('lcab_title_c','Title')}</div>
		        	<div class='col col2'>{$vsLang->getWords('lcab_action','Action')}</div>
		            <div class='col col3'>{$vsLang->getWords('lcab_buyer','Buyer')}</div>
		            <div class='col col4'>{$vsLang->getWords('lcab_price','Price')}</div>
		            <div class='col col5'>{$vsLang->getWords('lcab_soldtime','Time')}</div>
		            <div class='clear'></div>
		        </div>
		        <div class='table'>
		        	<if=" $option['pageList'] ">
		        	<foreach=" $option['pageList'] as $element ">
		        	<input id='curStatus_{$element['lcId']}' value='{$element['lcStatus']}' name='curStatus_{$element['lcId']}' type='hidden' />
		        	<div class='row' id='row_{$element['lcId']}'>
		        		<div class='col col1 narrow'>
		        			<a href="{$element['listingURL']}" title="{$element['cfTitle']}" target="_blank">
							{$element['cfTitle']}
							</a>
						</div>
			            <div class='col col2'>{$element['cfType']}</div>
			            <div class='col col3 extend' title="{$element['lcBuyer']}">
			            	{$element['lcBuyer']}
			            </div>
			            <div class='col col4 price' title="{$element['lcBuyer']}">
			            	{$element['lcPrice']}
			            </div>
			            <div class='col col5'>{$element['cfTime']}</div>
			            <div class='clear'></div>
		        	</div>
		        	</foreach>
		        	</if>
		        </div>

		        <if=' $option['paging'] '>
		        <div class="page_listing">
		        	<span>Browse Pages:</span>
		        	{$option['paging']}
		        </div>
		        </if>
	        </div>
EOF;
	}
	
	function edit_icmarket_callback($option){
		global $bw;
		$BWHTML .= <<<EOF
			<div id="message">
				{$option['message']}
			</div>
			<if=" $option['status'] ">
			<script type='text/javascript'>
				var ecb = $('#rowtemp').attr('cb');
				$('#rowcf_'+ecb+' > .col1').html('{$option['title']}');
				
				setTimeout(function(){
		        	$('#message').toggle("slow", function(){
						$('#message').remove();
						$('label.error').remove();

						$('#rowtemp').toggle("slow", function(){
							$('#rowtemp').remove();
						});
					});
		        }, 2000);
			</script>
			</if>
EOF;
	}
	
	
	
	function listingtab_textbook($option){
		global $bw, $vsLang;

 		$BWHTML .= <<<EOF
 			<div id='ltab_textbook'>
		        {$option['tb_all']}
	        </div>
	        <script type='text/javascript'>
	        	$('.submenu').bind('click', function(){
	        		var func = 'cf'+$(this).attr('rel'); 
	        		
	        		$('.subtab .active').removeClass('active');
	        		$(this).addClass('active');

	        		vsf.get('listings/'+func, 'ltab_textbook');
	        		return false;
	        	});
	        </script>
EOF;
	}
	
	function pending_open_textbook_callback($option){
		global $bw;
		$BWHTML .= <<<EOF
			<script type='text/javascript'>
				$('#curStatus_{$option['ltId']}').val({$option['curStatus']});
				$('#ltab_textbook').prepend('<div id="message">{$option['message']}</div>');
				setTimeout(function(){
		        	$('#message').toggle("slow", function(){
						$('#message').remove();
					});
		        }, 2000);
			</script>
EOF;
		return $BWHTML; 
	}
	
	function textbook_sold($option = array()){
		global $bw, $vsLang;
		
		$BWHTML .= <<<EOF
			<div id='ltab_textbook_sold_con' class='ltab_textbook_con'>
				<div class='header'>
		        	<div class='col col1'>{$vsLang->getWords('ltab_title','Title')}</div>
		        	<div class='col col2'>{$vsLang->getWords('ltab_action','Action')}</div>
		            <div class='col col3'>{$vsLang->getWords('ltab_buyer','Buyer')}</div>
		            <div class='col col4'>{$vsLang->getWords('ltab_price','Price')}</div>
		            <div class='col col5'>{$vsLang->getWords('ltab_soldtime','Time')}</div>
		            <div class='clear'></div>
		        </div>
		        <div class='table'>
		        	<if=" $option['pageList'] ">
		        	<foreach=" $option['pageList'] as $element ">
		        	<input id='curStatus_{$element['ltId']}' value='{$element['ltStatus']}' name='curStatus_{$element['ltId']}' type='hidden' />
		        	<div class='row' id='row_{$element['ltId']}'>
		        		<div class='col col1 narrow'>
		        			<a href="{$element['listingURL']}" title="{$element['bookTitle']}" target="_blank">
							{$element['bookTitle']}
							</a>
						</div>
			            <div class='col col2'>{$element['tuType']}</div>
			            <div class='col col3 extend' title="{$element['ltBuyer']}">
			            	{$element['ltBuyer']}
			            </div>
			            <div class='col col4 price' title="{$element['ltBuyer']}">
			            	{$element['ltPrice']}
			            </div>
			            <div class='col col5'>{$element['tuPostdate']}</div>
			            <div class='clear'></div>
		        	</div>
		        	</foreach>
		        	</if>
		        </div>

		        <if=' $option['paging'] '>
		        <div class="page_listing">
		        	<span>Browse Pages:</span>
		        	{$option['paging']}
		        </div>
		        </if>
	        </div>
EOF;
	}
	
	function sold_textbook_callback($option){
		global $bw;
		$script = '';
		if($option['status']){
			if($bw->input['t'] == 'all') $script = <<<EOF

				$('#curStatus_{$option['ltId']}').val(2);
				
				$('#ltStatus_{$option['ltId']}').children().each(function(){
					if($(this).val() == 1 || $(this).val() == 3)
						$(this).remove();
				});		
			
				cb = 'ltab_textbook_alllb';
				vsf.get('listings/textbook/&t=all', cb);
EOF;
			else $script .= <<<EOF
				vsf.get('listings/textbook', 'ltab_textbook');
EOF;
			$script .= <<<EOF
				setTimeout(function(){
		        	$('#message').toggle("slow", function(){
		        		$('#message').remove();
						
						$('label.error').remove();

						$.unblockUI();
					});
		        }, 2000);
EOF;
		}else{
			$script = <<<EOF
				$('#lc_a_form_submit').bind('click', handlerSubmit);
				$('#lc_a_form_cancel').bind('click', handlerCancel);
				var tuId = $('#lt_a_form_temp').val();
				var val = $('#curStatus_'+tuId).val();
				vsf.jSelect(val, 'ltStatus_'+tuId);
				Custom.init();
				setTimeout(function(){
		        	$('#message').toggle("slow", function(){
		        		$('#message').remove();
						
						$('label.error').remove();

						$.unblockUI();
					});
		        }, 2000);
EOF;
		}
		$BWHTML .= <<<EOF
			<div id="message">{$option['message']}</div>
			<script type='text/javascript'>
				{$script}
			</script>
EOF;
	}
	
	function delete_textbook_callback($option){
		global $bw;
		$BWHTML .= <<<EOF
			<div id="message">
				{$option['message']}
			</div>
			<script type='text/javascript'>
				setTimeout(function(){
		        	$('#message').toggle("slow", function(){
						$('#message').remove();
					});
		        }, 2000);
			</script>
			</if>
EOF;
		return $BWHTML; 
	}
	
	function edit_textbook_callback($option){
		global $bw;
		$BWHTML .= <<<EOF
			<div id="message">
				{$option['message']}
			</div>
			<if=" $option['status'] ">
			<script type='text/javascript'>
				$('#row_{$option['ltId']} > .col2').html('{$option['textbookType']}');
				
				setTimeout(function(){
		        	$('#message').toggle("slow", function(){
						$('#message').remove();
						$('label.error').remove();

						$('#editForm').toggle("slow", function(){
							$('#rowtemp').remove();
						});
					});
		        }, 2000);
			</script>
			</if>
EOF;
	}

	function textbook_all($option = array()){
		global $bw, $vsLang;

		
		$this->editImage = "<img src='{$bw->vars['img_url']}/edit.png' height='15' style='margin-top: 8px;' />";
		$this->deleteImage = "<img src='{$bw->vars['img_url']}/delete.png' height='13' style='margin-top: 8px;' />";
		
		
		$func = $option['main_action'].'_js';
		$BWHTML .= <<<EOF
			<div id='ltab_textbook_all_con' class='ltab_textbook_con'>
				<div class='header'>
		        	<div class='col col1'>{$vsLang->getWords('ltab_title','Textbook Title')}</div>
		        	<div class='col col2'>{$vsLang->getWords('ltab_action','Action')}</div>
		            <div class='col col3'>{$vsLang->getWords('ltab_status','Status')}</div>
		            <div class='col col4'>{$vsLang->getWords('ltab_postmanage','Manage')}</div>
		            <div class='col col5'>{$vsLang->getWords('ltab_dateposted','Date Posted')}</div>
		            <div class='clear'></div>
		        </div>
		        <div class='table'>
		        	<if=" $option['pageList'] ">
		        	<foreach=" $option['pageList'] as $element ">
		        	<input id='curStatus_{$element['ltId']}' value='{$element['ltStatus']}' name='curStatus_{$element['ltId']}' type='hidden' />
		        	<div class='row' id='row_{$element['ltId']}'>
		        		<div class='col col1'>
		        			<a href="{$element['listingURL']}" title="{$element['bookTitle']}" target="_blank">
							{$element['bookTitle']}
							</a>
						</div>
			            <div class='col col2'>{$element['tuType']}</div>
			            <div class='col col3'>
			            	<select class='styled' id='ltStatus_{$element['ltId']}' name='ltStatus_{$element['ltId']}'>
			            		<if=" $element['ltStatus'] != 3">
								<option {$element['ltStatus_1']} value='1'>Open</option>
								<option {$element['ltStatus_2']} value='2'>Pending</option>
								</if>
								<option {$element['ltStatus_3']} value='3'>Sold</option>
							</select>
			            </div>
			            <div class='col col4'>
			            	<if=" $element['ltStatus'] != 3">
			            	<a href='#' title='Click here to edit this textbook' id='edit_{$element['ltId']}_{$element['tuId']}' class='editLT'>
							{$this->editImage}
							</a>
							</if>
							<a href='javascript:deleteLT({$element['ltId']});' title='Click here to delete this textbook' id='delete_{$element['ltId']}' style='margin-left: 5px;'>
							{$this->deleteImage}
							</a>
			            </div>
			            <div class='col col5'>{$element['tuPostdate']}</div>
			            <div class='clear'></div>
		        	</div>
		        	</foreach>
		        	</if>
		        </div>

		        <if=' $option['paging'] '>
		        <div class="page_listing">
		        	<span>Browse Pages:</span>
		        	{$option['paging']}
		        </div>
		        </if>

		        <div style="display:none;" id="lt_a_container">
		    		<div id='lt_a_form_callback'></div>
		    		<form id="lt_a_form" method="POST">
		    			<input type='hidden' name='temp' id='lt_a_form_temp' value='' />
		    			<label>{$vsLang->getWords('lt_a_form_byer','Buyer')}</label>
				        <input name="ltBuyer" id="ltBuyer" value="" />
				        <div class='clear'></div>
				        
				        <label>{$vsLang->getWords('lt_a_form_price','Price')}</label>
				        <input name="ltPrice" id="ltPrice" value="" />
				        <div class='clear'></div>
				        
						<a href="javascript:;" class='bookdetail_btn' id="lt_a_form_submit">
				        	<span>{$vsLang->getWords('cn_form_submit','Submit')}</span>
				        </a>
				        <a href="javascript:;" class='bookdetail_btn' id="lt_a_form_cancel">
				        	<span>{$vsLang->getWords('cn_form_cancel','Cancel')}</span>
				        </a>
				        <div class='clear'></div>
		    		</form>
		    		<div class="clear"></div>
		    	</div>
				<script type='text/javascript'>
					<if=" $option['pageList'] ">
					$(document).ready(function(){
		        		<foreach=" $option['pageList'] as $element ">
		        			vsf.jSelect('{$element['ltStatus']}', 'ltStatus_{$element['ltId']}');
		        		</foreach>
						Custom.init();
					});
					</if>
					function deleteLT(id){
		        		jConfirm(
							'Are you sure to delete', 
							'Dialog board',
							function(r){
								if(r){
									vsf.get('listings/deletelt/'+id, 'ltab_textbook');
									return false;
								}
						});
		        	}
		        	
		        	var handlerSubmit = function() {
						$('#lt_a_form').submit();
					};
					
					
					var handlerCancel = function(){
	        			$.unblockUI();
						var tuId = $('#lt_a_form_temp').val();
						var val = $('#curStatus_'+tuId).val();
						vsf.jSelect(val, 'ltStatus_'+tuId);
						
						Custom.init();
					};
					
					
					function initBindEditLT(){
                		$('.editLT').bind('click', function(e){
                			var curTemp = $(this).attr('id');
                			var curArr = curTemp.split('_');
                			var curId = curArr[1];
                			var mainId = curArr[2];

                			$('#rowtemp').remove();

                			$('<div class="row" id="rowtemp" rel="'+curId+'"></a>').insertAfter('#row_'+curId);
                			vsf.get('listings/editlt/'+mainId,'rowtemp');
                			return false;
						});
					}
					
					$(document).ready(function(){
						<if=" $option['pageList'] ">
		        		<foreach=" $option['pageList'] as $element ">
		        			vsf.jSelect('{$element['ltStatus']}', 'ltStatus_{$element['ltId']}');
		        		</foreach>
		        		</if>
						Custom.init();
						
						initBindEditLT(); 
						
						
						var curId; var curTemp; var curArr;
						initBind(); 
                		function initBind(){
                			$('#ltab_textbook_all_con select.styled').bind('change', function(e){
                				
                				var curTemp = $(this).attr('id');
                				var curArr = curTemp.split('_');
                				var curId = curArr[1];
                				$('#lt_a_form_temp').val(curId);
                				
	                			$('#lt_a_form_callback').html('');
	                			$('#ltBuyer').val('');
	                			$('#ltPrice').val('');
	                			
	                			if($(this).val() == 1){
	                				jConfirm(
										'Change to open', 
										'Dialog board', 
										function(r){
											if(r){
												vsf.get('listings/openlt/&atype={$option['ajaxtype']}&temp='+curId, '{$option['ajaxcallback']}');
												return false;
											}else{
												var tuId = $('#lt_a_form_temp').val();
												var val = $('#curStatus_'+tuId).val();
												vsf.jSelect(val, 'ltStatus_'+tuId);
												Custom.init();

												return false;
											}
									});
									return false;
	                			}
	                			
	                			if($(this).val() == 2){
	                				jConfirm(
										'Change to pending', 
										'Dialog board', 
										function(r){
											if(r){
												vsf.get('listings/pendinglt/&atype={$option['ajaxtype']}&temp='+curId, '{$option['ajaxcallback']}');
												return false;
											}else{
												var tuId = $('#lt_a_form_temp').val();
												var val = $('#curStatus_'+tuId).val();
												vsf.jSelect(val, 'ltStatus_'+tuId);
												Custom.init();

												return false;
											}
									});
									return false;
	                			}
	                			
	                			jConfirm(
										'Change to sold', 
										'Dialog board', 
										function(r){
											if(r){
												$('#lt_a_form_submit').bind('click', handlerSubmit);
					                			$('#lt_a_form_cancel').bind('click', handlerCancel);
					                			
					                			
										        $.blockUI({
										        	theme: true,
					           						title: "{$vsLang->getWords('lt_form_change_tb_status', "Change textbook's status")}", 
											        message: $('#lt_a_container'),
											        fadeIn: 1000,
												});
												
												
												$('.blockOverlay').click(function(){
						        					$.unblockUI({
														onUnblock: function(){
															var tuId = $('#lt_a_form_temp').val();
															var val = $('#curStatus_'+tuId).val();
															vsf.jSelect(val, 'ltStatus_'+tuId);
															Custom.init();
														}
													});
						        				});	
											
												return false;
											}else{
												var tuId = $('#lt_a_form_temp').val();
												var val = $('#curStatus_'+tuId).val();
												vsf.jSelect(val, 'ltStatus_'+tuId);
												Custom.init();

												return false;
											}
									});
							});
						}
						

						var crt = '';
						jQuery.validator.addMethod('validUser', function(value, element, alias){
							if($('#ltBuyer').val() != ''){
								return $.validator.methods.remote.call(this, value, element, "{$bw->base_url}users/instant/userexits&ajax=1");
							}
							return true;
						}, jQuery.validator.messages.remote);

						var validator = $("#lt_a_form").validate({
							rules: {
								ltBuyer: {
									validUser: true
								},
								ltPrice: {
									number: true
								}
							},

							messages:{
								ltBuyer: {
									remote: "{$vsLang->getWords('validate_remote_lt_user_exist','This buyer doesnot exists')}"
								},
								ltPrice: {
									number: "{$vsLang->getWords('validate_price_number','Provide a valid price')}"
								}
							},

							success: function(label) {
								label.html("&nbsp;").addClass("checked");
								label.remove();
							},

							submitHandler: function(form){
								$('#lt_a_form_submit').unbind('click', handlerSubmit);
								$('#lt_a_form_cancel').unbind('click', handlerCancel);
								vsf.submitForm($('#lt_a_form'), 'listings/soldlt/&t={$bw->input['t']}&atype={$option['ajaxtype']}', 'lt_a_form_callback');
								return false;
							}
						});
					});
				</script>
		       
	        </div>
EOF;
	}
}
?>