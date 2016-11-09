<?php
class skin_listings {
	
	
	function search($option){
		global $bw;
		
 		$BWHTML .= <<<EOF
 			<div class='searchpage'>
	        <div id="content_left">
	            {$this->searchForm($option)}
	            <div id="cfmctab">
	            	<div class="seller_border">
		            	<div class="user_title">
		                	<h3>Search result</h3>
		                </div>
		                <div class='icitem_container' id='icitem_container'>
						{$this->mainsearch($option)}
						</div>
					</div>
	           	</div>
			</div>
			{$option['scrollPagination']}
			<script type='text/javascript'>
				$(document).ready(function(){
					
					
					$('#cfsearchform').submit(function(){
						var hidden = '<input type="hidden" name="instant" value="main" class="cfsfhidden" />';
						$(this).append(hidden);
						
						vsf.submitForm($(this), 'icMarket/search', 'icitem_container');
						
						
						$(".cfsfhidden").remove();
						return false;
					});
					
					var options = {
					    callback:function(){
					    	$('#cfsearchform').submit();
						},
					    wait:300,
					    highlight:true,
					    captureLength: 2
					}
					$("#cfCrit").typeWatch(options);
					
					$("#cfLocation").typeWatch(options);
					
					$("#minval").typeWatch(options);
					$("#maxval").typeWatch(options);
					
					$('#cfCatId').change(function(){
						$('#cfsearchform').submit();
					});
					
					$('#cfcondition').change(function(){
						$('#cfsearchform').submit();
					});
				});
			</script>
	    </div>
EOF;
	}
	
	function mainsearch($option){
		global $bw, $vsLang;
		
		$this->bw = $bw;
		$this->vsLang = $vsLang;
		
		$BWHTML .= <<<EOF
			<if=" $option['pageList'] ">
                <foreach=" $option['pageList'] as $key=>$cf "> 
	                <div class="store_item">
	                	<a href="{$cf->getUrl('icMarket')}" class="store_item_img" title="{$cf->getTitle()}">
							{$cf->createImageCache($cf->ifile, 80,85, 0, 1)}
	                	</a>
	                    <div class="store_intro">
	                    	<p class="store_item_date">
								{$cf->getTime('SHORT')}
								<a href="{$this->bw->vars['board_url']}/{$cf->seller}" title="{$cf->seller}">{$cf->seller}</a>
							</p>
	                        <p class='itemtitle'>
								<a href="{$cf->getUrl('icMarket')}" title="{$cf->getTitle()}">
									{$cf->getTitle()}
								</a>	
	                        </p>
	                        <p class='itemcontent'>{$cf->getContent(200)}</p>
	                        <p class="store_item_cost">
	                        	{$this->vsLang->getWords('global_curency','$')}{$cf->getPrice(true)}
	                         	<span>{$cf->moreinfo}</span>
	                         	<a href="{$cf->getUrl('icMarket')}" title="{$cf->getTitle()}">More</a>
	                         </p>
	                    </div>
	                    <div class="clear_left"></div>
	                </div>
            	</foreach>
            <else />
            	<div class="store_item">
            		<b>Sorry! No match for your search. Please try different keywords</b>
            	</div>
				<div class="clear_left"></div>
           	</if>
           	
EOF;
	}
	
	function instantSearch($option){
		global $bw;
		
 		$BWHTML .= <<<EOF
 			{$this->mainsearch($option)}
 			<if="$option['paging']">
 				<div class='page'>
 					Browse Pages: {$option['paging']}
 				</div>
 			</if>
			<script type='text/javascript'>
				$(document).ready(function(){
					$('#cfmctab').scrollExtend('disable');
				});
			</script>
	    </div>
EOF;
	}
	
	
	function listing($option){
		global $bw, $vsTemplate, $vsLang;
		
		$this->bw = $bw;
		$this->vsLang = $vsLang;
		
		
 		$BWHTML .= <<<EOF
	    {$this->categoryList($option)}
		<style>
			    #cfmctab{
					float:left;
					width:600px;
					border:1px solid #aaaaaa;
					padding-bottom:15px;
					margin:10px 0px;	
				}
		</style>
	    <div id="content1">
	        {$vsTemplate->global_template->GLOBAL_PARTNER}
	        
	        <div id="content_left">
	            {$this->searchForm($option)}
	            <div id="cfmctab">
					<ul class="campus_user_menu">
						<li>
				        	<a href="{$this->board_ur}/icMarket/listing&ajax=1&t=all">
				        		All
				        	</a>
				        </li>
				        <if=" $option['tabs'] ">
				        <foreach=" $option['tabs'] as $cat ">
				        <li>
				        	<a href="{$this->board_ur}/icMarket/listing&ajax=1&t={$cat->cleanTitle}&c={$cat->cleanTitle}-{$cat->getId()}">
				        		{$cat->getTitle()}
				        	</a>
				        </li>
				        </foreach>
				        </if>
	        		</ul>
		            <div class="clear_left"></div>
	           	</div>
	           	<script type='text/javascript'>
					$(document).ready(function() {
		    			var itab = $("#cfmctab").utabs({
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
	    </div>
EOF;
	}
	
	
	function mainlisting($option){
		global $bw, $vsTemplate, $vsLang;
		
		$this->bw = $bw;
		$this->vsLang = $vsLang;
		
 		$BWHTML .= <<<EOF
	            <if=" $option['pageList'] ">
                <foreach=" $option['pageList'] as $key=>$cf "> 
	                <div class="store_item">
	                	<a href="{$cf->getUrl('icMarket')}" class="store_item_img" title="{$cf->getTitle()}">
							{$cf->createImageCache($cf->ifile, 80,85, 0, 1)}
	                	</a>
	                    <div class="store_intro">
	                    	<p class="store_item_date">
								{$cf->getTime('real')}
								<a href="{$this->bw->vars['board_url']}/{$cf->seller}" title="{$cf->seller}">{$cf->seller}</a>
							</p>
	                        <p class='itemtitle'>
	                        	<a href="{$cf->getUrl('icMarket')}" title="{$cf->getTitle()}">
									{$cf->getTitle()}
								</a>
							</p>
							<p class='itemcontent'>{$cf->getContent(150)}</p>
	                        <p class="store_item_cost">
	                        	{$this->vsLang->getWords('global_curency','$')}{$cf->getPrice(true)}
	                         	<span>{$cf->moreinfo}</span>
	                         	<a href="{$cf->getUrl('icMarket')}" title="{$cf->getTitle()}">More</a>
	                         </p>
	                    </div>
	                    <div class="clear_left"></div>
	                </div>
            	</foreach>
            	<else />
            	<div class="store_item">
            		<b>There is no more item in this category.</b>
            	</div>
	           	</if>
	           	<if=" $option['curcat'] ">
            	<div class='more'>
            		<a title="{$option['curcat']['catTitle']}" href="{$option['curcat']['moreurl']}">more</a>
            	</div>
            	</if>
EOF;
	}
	
	
	function category($option){
		global $bw, $vsTemplate, $vsLang;
		
		$this->bw = $bw;
		$this->vsLang = $vsLang;
		
 		$BWHTML .= <<<EOF
	    {$this->categoryList($option)}
	    <div id="content1">
	        {$vsTemplate->global_template->GLOBAL_PARTNER}
	        
	        <div id="content_left">
	            {$this->searchForm($option)}
	            <div id="cfmctab">
	            	<div id='icmarket-category' class="seller_border">
		            	<div class="user_title">
		                	<h3>{$option['category'][$option['curcatId']]->getTitle()}</h3>
		                	<if=" $option['pageList'] ">
		                    <a href="{$option['category'][$option['curcatId']]->caturl}" title="{$option['category'][$option['curcatId']]->getTitle()}">more</a>
		                    </if>
		                </div>
	                	{$option['html']}
		            </div>
	           	</div>
			</div>
			<if=" $option['fbscript'] ">
			<script>
					$('#cfmctab').scrollExtend({	
						'target': 'div.seller_border',
						'url': '{$bw->vars['board_url']}/icmarket/category/&t=load&c={$option['caturl']}&ajax=1'
					});
			</script>
			</if>
	    </div>
EOF;
	}
	
	
	
	
	
	
	
	
	
	
	
	function detail($obj, $option = array()){
		global $bw, $vsTemplate, $vsLang;
		
 		$BWHTML .= <<<EOF
 			<style>
				.tabs-nav li{
					margin-right: 0px !important;
				}
			</style>
		    {$this->categoryList($option)}
		    <div id="content1">
		        {$vsTemplate->global_template->GLOBAL_PARTNER}
		        
		        <div id="content_left">
		            <div class="post_classified" id='detailpage'>
		            	<h3>{$obj->cfcategory}</h3>
		            	<div id='classified_info'>
		            		<div class='row' id='maininfo'>
		            			<span class='title'>{$obj->getTitle()}</span>
		            			<span class='cprice'>{$vsLang->getWords('global_curency','$')}{$obj->getPrice(true)}</span>
		            			<div class='clear'></div>
		            		</div>
		            		<div class='row cinfo'>
		            			<span class='label'>Condition:</span>
		            			<span id='cfcond'>{$obj->cfcondition}</span>
		            			<if=" $obj->seller ">
		            			<span class='label'>Seller:</span>
		            			<span id='cfseller'>
		            				<a href="{$bw->vars['board_url']}/{$obj->seller}" alt='{$obj->seller}' class='cfprofile'>
		        					{$obj->seller}
		        					</a>
		        				</span>
		            			</if>
		            			<span class='label'>Date:</span>
		            			<span>{$obj->getTime('SHORT')}</span>
		            			
		            			<div class='clear'></div>
		            		</div>
		            		<div class='row'>
		            			<span class='cdesctitle label'>Description:</span>
		            			<div class='cdesc'>
		            				{$obj->getContent()}
		            			</div>
		            			<div class='clear'></div>
		            		</div>
		            		<if=" $obj->getCampus() ">
		            		<div class='row'>
		            			<span class='label'>Campus:</span>
		            			{$obj->getCampus()} 
		            		</div>
		            		</if>
		            		<if=" $obj->getLocation() ">
		            		<div class='row'>
		            			<span class='label'>Location:</span>
		            			{$obj->getLocation()} 
		            		</div>
		            		</if>
		            		<div class='coption'>
		            			<div class='coffer' id="makeanoffer">Make an offer</div>
		            			<div class='coffer' id="sendtofriend">Send to friends</div>
		            			<div class='clear'></div>
		            		</div>
		            		
		            		<if=" $obj->galleries ">
		            		<div class='gallery' style="padding: 0px 10px;">
		            			<foreach=" $obj->galleries as $gd ">
									{$obj->createImageCache($gd['gdetail']->getFile(),170,180, 0, 1)}
		            			</foreach>
		            			<div class='clear'></div>
		            		</div>
		            		</if>
		            	</div>
		            </div>
		        </div>
		    </div>
		    <div style="display:none;" id="stfcontainer">
		    		<div id='ctfform_callback'></div>
		    		<form id="stffrom" method="POST">
		    			<input type='hidden' name='cfTitle' value="{$obj->getTitle()}" />
		    			<input type='hidden' name='cfId' value="{$obj->getId()}" />
		    			<label>Recipients: </label>
				        <input name="cfrecipients" id="cfrecipients" placeholder="Separate username/email by comma" />
				        <div class='clear'></div>
				        
						<a href="javascript:;" class='ainput' id="stf_submit">
				        	<span>Send</span>
				        </a>
				        <a href="javascript:;" class='ainput' id="stf_cancel">
				        	<span>Cancel</span>
				        </a>
				        <div class='clear'></div>
		    		</form>
		    		<div class="clear"></div>
		    	</div>
		    <div class='clear'></div>
		    
		    <script>
		    		$('#makeanoffer').click(function(){
						var option = {
										title: '{$vsLang->getWords('global_make_offer','Make an Offer')}',
										width: 600,
										height: 600,
										params:{
											cfTitle: "{$obj->getTitle()}",
											seller: "{$obj->seller}",
											mainmod: "classified",
											popupId: "global_formContainer"
										}
									};
						vsf.popupLightGet('messages/popup', 'global_formContainer', option);
					});
					
					
					$('#sendtofriend').click(function() { 
						$('#ctfform_callback').html('');
						$.blockUI({
							css:{
								width : '300px'
							},
							theme: true,
							title: 'Send to friends', 
							message: $('#stfcontainer'),
							fadeIn: 1000
						});
						$('.blockOverlay').click($.unblockUI);
					});
					
					$('#stf_cancel').click(function(){
						$.unblockUI();
					});
					
					$('#stf_submit').click(function(){
						vsf.submitForm($('#stffrom'), 'icMarket/sendtofriends', 'ctfform_callback');
						return false;
					});
			</script>
EOF;
	}
	
	function preview($obj, $option){
		global $bw, $vsTemplate, $vsLang;
		
 		$BWHTML .= <<<EOF
	            <div class="post_classified" id='previewdiv'>
	            	<h3>
	            		Preview
	            		<span id='cpv'>X</span>
	            	</h3>
	            	<div id='classified_info'>
	            		<div class='row' id='maininfo'>
	            			<span class='title'>{$obj->getTitle()}</span>
	            			<span class='cprice'>{$vsLang->getWords('global_curency','$')}{$obj->getPrice(true)}</span>
	            			<div class='clear'></div>
	            		</div>
	            		<div class='row cinfo'>
	            			<if=" $obj->cfcondition ">
	            			<span class='label'>Condition:</span>
	            			<span id='cfcond'>{$obj->cfcondition}</span>
	            			</if>
	            			
	            			<span class='label'>Seller:</span>
	            			<span id='cfseller'>{$obj->seller}</span>
	            			
	            			<span class='label'>Date:</span>
	            			<span>{$obj->getTime('SHORT')}</span>
	            			
	            			<div class='clear'></div>
	            		</div>
	            		<div class='row'>
	            			<span class='cdesctitle label'>Description:</span>
	            			<div class='cdesc'>
	            				{$obj->getContent()}
	            			</div>
	            			<div class='clear'></div>
	            		</div>
	            		<div class='row'>
	            			<span class='label'>Campus:</span>
	            			{$obj->getCampus()} 
	            		</div>
	            		<div class='row'>
	            			<span class='label'>Location:</span>
	            			{$obj->getLocation()} 
	            		</div>
	            		
	            		<if=" $obj->galleries ">
	            		<div class='gallery'>
	            			<foreach=" $obj->galleries as $gd ">
								{$obj->createImageCache($gd,170,180, 0, 1)}
	            			</foreach>
	            			<div class='clear'></div>
	            		</div>
	            		</if>
	            	</div>
	            </div>
	            <script type='text/javascript'>
	            	$.unblockUI();
	            	$('#cpv').click(function(){
			        	$('#previewContainer').toggle("slow", function(){	
							$('#previewContainer').html('');
						});
	            	});
	            </script>
EOF;
	}
	
	function post($option){
		global $vsLang, $bw, $vsTemplate;

		$BWHTML .= <<<EOF
			{$this->categoryList($option)}
			<div id="content1">
				{$vsTemplate->global_template->GLOBAL_PARTNER}
		        <div id="content_left">
					<div id="previewContainer"></div>
		           	{$this->postForm($option)}
		        </div>
		    </div>
		    <div class="clear"></div>
EOF;
	}

	function postForm($option = array()){
		global $bw, $vsLang;
	 
		$BWHTML = <<<EOF
			<div class="post_classified">
           		<h3>List an item for sell</h3>
           		<if=" $option['message'] ">
           			<div id="message" class='message'>
						{$option['message']}
						<if=" $option['status'] ">
						<br /><b>Redirecting to listed item's detail page .....</b>
						</if>
           			</div>
           			<script type='text/javascript'>
           				$(document).ready(function(){
							setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
									$('#message').html('');
									$('#message').removeClass('message');
									<if=" $option['status'] ">
										location.href = '{$option['icURL']}';
									</if>
								});
					        }, 2000);
					        vsf.jRadio('{$option['mainobj']->getCondition()}', 'cfCondition');
			    			vsf.jSelect('{$option['mainobj']->getCatId()}', 'cfCatId');
				        });
					</script>
           		</if>
                <form id="postForm" method='POST' enctype="multipart/form-data" action='{$bw->vars['board_url']}/icMarket/post' >
                	<div class='dtitle' id='dtc'>
	                	<label>Title</label>
	                	<input name='cfTitle' id='cfTitle' value='{$option['mainobj']->getTitle()}' class='cftitle'/>
	                	<div id='tecontainer'></div>
                	</div>

                	<div class='dtitle' id='dpc'>
	                    <label class='price'>Price</label>
	                	<input name='cfPrice' id='cfPrice' value='{$option['mainobj']->getPrice()}' class='cfprice'/>
	                	<div id='pecontainer'></div>
                	</div>
                	<div class='clear'></div>
                	
					<label>Description</label>
                	<textarea name='cfContent' id='cfContent'>{$option['mainobj']->getContent()}</textarea>
                	<div class='clear'></div>
                	<div id='cecontainer'></div>
                	
                	<if=" $option['condition'] ">
                	<label>Condition</label>
                	<div class='radiocontainer' id='conditioncontainer'>
                	
                	<foreach=" $option['condition'] as $cond">
                	<input type='radio' name='cfCondition' class='radio' value="{$cond->getId()}" />
                	<span class='radio'>{$cond->getTitle()}</span>
                    </foreach>
                    </div>
                	<div class='clear'></div>
                	</if>
                	
                	<label>Category</label>
                	<select name='cfCatId' id='cfCatId'>
                		<option value="0">Please select a category</option>
                		<if=" $option['category'] ">
                		<foreach="$option['category'] as $cat ">
                		<option value='{$cat->getId()}'>{$cat->getTitle()}</option>
                		</foreach>
                		</if>
                	</select>
                    <label>Image 1</label>
                	<input name='cfImage1' type='file' class='file' id='cfImage1' />
                	<div class='clear'></div>
                	<div id='catecontainer'></div>
                	
                	
                	<label>Campus</label>
                	<input name='cfCampus' id='cfCampus' value='{$option['mainobj']->getCampus()}' />
                    <label>Image 2</label>
                	<input name='cfImage2' type='file' class='file' id='cfImage2' />
                	<div class='clear'></div>
                	
                	<label>City/Town</label>
                	<input name='cfLocation' id='cfLocation' value='{$option['mainobj']->getLocation()}' />
                    <label>Image 3</label>
                	<input name='cfImage3' type='file' class='file' id='cfImage3' />
                	<div class='clear'></div>
                	
                	<div style="margin: 10px 0px 10px 90px;">
                		<input type="button" name="preview" id="preview" value="Preview" class='button' />
                		<input type="submit" name="isubmit" id="isubmit" value="Submit" class='button' />
                		<div class='clear'></div>
                	</div>
                	<div class='clear'></div>
                </form>
                <script type="text/javascript">
			    	$('#isubmit').click(function(){
			    		$("#postForm").find('label').each(function(){
			    			if($(this).hasClass("error"))
			    			$(this).remove();
			    		});
			    	})
		    	
			    	$(document).ready(function(){
			    		jQuery.validator.addMethod(
							"select_required",
						  	function(value, element) {
						    	if (element.value == 0) return false;
						    	return true; 
						  	},
						  	"Please select a category."
						);
					
						$("#postForm").validate({
							rules: {
								cfTitle: {
									required: true
								},
								cfPrice: {
									required: true,
									number: true
								},
								cfCondition: {
									required: true
								},
								cfContent:{
									required: true
								},
								cfCatId:{
									select_required: true
								}
							},
							messages:{
								cfTitle: {
									required: "{$vsLang->getWords('validate_title_require','Provide a title')}"
								},
								cfPrice: {
									required: "{$vsLang->getWords('validate_price_require','Provide a valid price')}",
									number: "{$vsLang->getWords('validate_price_number','Provide a valid price')}"
								},
								cfContent: {
									required: "Provide your item's description"
								},
								cfCondition: {
									required: "Provide your item's condition"
								},
								cfCatId: {
									select_required: "Provide your item's category"
								}
							},
							
							success: function(label) {
								label.html("&nbsp;").addClass("checked");
							},
							
							errorPlacement: function(error, element) {
								var nname = $(element).attr('name');
								switch(nname){
									case "cfCondition": 
											error.insertAfter($('#conditioncontainer'));;
										break;
									
									case "cfTitle": 
											error.appendTo($('#tecontainer'));
										break;
										
									case "cfPrice": 
											error.appendTo($('#pecontainer'));
										break;
									
									case "cfContent": 
											error.appendTo($('#cecontainer'));
										break;
										
									case "cfCatId": 
											error.appendTo($('#catecontainer'));
										break;
									
									default: 
											error.insertAfter(element);
								}
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
								$('#isubmit').val();
								console.log($('#isubmit').val());
								form.submit();
							}
						});
					});
		    	
		    		$(document).ajaxStop($.unblockUI); 
		    	
		    		$('#preview').click(function(){
			    		var flag = true; 
						 
			    		$("#postForm").find('label').each(function(){
			    			if($(this).hasClass("error"))
			    			$(this).remove();
			    		});
			    		
						if($('#cfTitle').val() == ''){
							var error = '<label for="cfTitle" generated="true" class="error">Provide a title</label>';
							$(error).appendTo($('#tecontainer'));
							flag = false;
						}
						
						if($('#cfPrice').val() == ''){
							var error = '<label for="cfPrice" generated="true" class="error">Provide a valid price</label>';
							$(error).appendTo($('#pecontainer'));
							flag = false;
						}
						
						if($('#cfContent').val() == ''){
							var error = "<label for='cfContent' generated='true' class='error'>Provide your item's description</label>";
							$(error).appendTo($('#cecontainer'));
							flag = false;
						}
						
						if(typeof($("input[name='cfCondition']:checked").val()) == 'undefined'){
							var error = "<label for='cfCondition' generated='true' class='error'>Provide your item's condition</label>";
							$(error).insertAfter($('#conditioncontainer'));
							flag = false;
						}
						
						if($('#cfCatId').val() == 0){
							var error = "<label for='cfCatId' generated='true' class='error'>Provide your item's category</label>";
							$(error).appendTo($('#catecontainer'));
							flag = false;
						}
			    	
						if(flag){
				    		vsf.uploadFile('postForm', 'icMarket', 'preview', 'previewContainer', 'icMarket');
									
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
						}
			    		return false;
			    	});
		    	</script>
			</div>
EOF;
	}
	
	function categoryList($option){
		global $bw;
		$this->bw = $bw;

		$BWHTML .= <<<EOF
			<div id="sitebar">
		        <div class="subject_list">
		        	<h3>Categories</h3>		            
		            <if=" $option['category'] ">
		            <foreach=" $option['category'] as $cat ">
		            	<a href="{$cat->caturl}" title="{$cat->getTitle()}">{$cat->getTitle()}</a>
		            </foreach>
		            </if>
		        </div>
		    </div>
EOF;
	}

	function searchForm($option = array()){
		global $bw;

		$BWHTML .= <<<EOF
				<form id='cfsearchform' action="{$bw->vars['board_url']}/icMarket/search" method='GET' class="search_store" >     
	            	<div class="search_store_left">       	
	                    <label style="font-size:18px;">Search</label>
	                    <input id="cfCrit" name="cfCrit" class="search_input" value='{$bw->input['cfCrit']}' placeholder="Enter item title/descriptions" />
	                    <select class="select_cate" name='cfCatId' id='cfCatId'>                    	
	                        <option value="0">All Categories</option>
	                        <if=" $option['category'] ">
	                        <foreach=" $option['category'] as $cat ">
	                        <option value="{$cat->getId()}">{$cat->getTitle()}</option>
	                        </foreach>
	                        </if>
	                    </select>
	                    <div class="clear_left"></div>
	                    
	                    <label style="margin-left:53px;">in</label>
	                    <input id="cfLocation" name="cfLocation" class="search_in" placeholder="City, State" value='{$bw->input['cfLocation']}' />
	                    
	                    <label>price</label>
	                    <input id="minval" name="minval" placeholder="min" class="price_search" value='{$bw->input['minval']}'/>
	                    <input id="maxval" name="maxval" placeholder="max" class="price_search" value='{$bw->input['maxval']}'/>
	                    
	                    <label style="margin-left:11px;">condition:</label>
	                    <select class="select_condition" name='cfcondition' id='cfcondition'>
	                        <option value="0">All</option>
	                        <if=" $option['condition'] ">
	                        <foreach=" $option['condition'] as $cat ">
	                        <option value="{$cat->getId()}">{$cat->getTitle()}</option>
	                        </foreach>
	                        </if>
	                    </select>
	                </div>
	                <input type="submit" class="search_store_submit" value="Find" id='submitcfsf'/>
	                <div class="clear_left"></div>
	            </form>
	            <script type='text/javascript'>
			    	$(document).ready(function() {
			    		vsf.jSelect('{$bw->input['cfcondition']}', 'cfcondition');
			    		vsf.jSelect('{$bw->input['cfCatId']}', 'cfCatId');
			    	
						$("#cfCrit").autocomplete("{$bw->base_url}icMarket/suggest", {
							dataType: 'json',
							width: 500,
							matchContains: true,
							minChars: 4,
							selectFirst: false,
							formatItem: function(row, i, max, term) {
								return row.image +
									   "<div class='ci-title'>"+row.title+"</div>"+
									   "<div class='ci-content'>"+row.content+"</div>"+
									   "<div class='clear'></div>";
							},
							parse: function(data) {
					          var rows = new Array();
					          for(var i=0; i<data.length; i++){
					              rows[i] = {data:data[i], value:data[i].title, result:data[i].title};
					          }
					          return rows;
					      	},
					      	scrollHeight: 300
						});
					});
			    </script>
EOF;
	}
	
	
	
	
	
	
	function postFormPortlet($option = array()){
		global $bw, $vsLang;
	 
		$BWHTML = <<<EOF
			<div class="post_classified">
           		<h3>
           			List an item for sell
           			<span id='cpv'>X</span>
           		</h3>
           		<if=" $option['message'] ">
           			<div id="message" class='message'>{$option['message']}</div>
           			<script type='text/javascript'>
           				$(document).ready(function(){
							setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
									$('#message').html('');
									$('#message').removeClass('message');
								});
					        }, 2000);
				        });
					</script>
           		</if>
                <form id="postForm" method='POST' enctype="multipart/form-data">
                	<input type='hidden' name='cfGallery' value='{$option['mainobj']->getGallery()}' />
                	<input type='hidden' name='cfId' value='{$option['mainobj']->getId()}' />
                	<input type='hidden' name='fportlet' value='{$option['formportlet']}' />
                	
                	<div class='dtitle' id='dtc'>
	                	<label>Title</label>
	                	<input name='cfTitle' id='cfTitle' value='{$option['mainobj']->getTitle()}' class='cftitle'/>
	                	<div id='tecontainer'></div>
                	</div>
                	<div class='dtitle' id='dpc'>
	                    <label class='price'>Price</label>
	                	<input name='cfPrice' id='cfPrice' value='{$option['mainobj']->getPrice()}' class='cfprice'/>
	                	<div id='pecontainer'></div>
                	</div>
                	<div class='clear'></div>
                	
					<label>Description</label>
                	<textarea name='cfContent' id='cfContent'>{$option['mainobj']->getContent()}</textarea>
                	<div class='clear'></div>
                	<div id='cecontainer'></div>
                	
                	<if=" $option['condition'] ">
                	<label>Condition</label>
                	<div class='radiocontainer' id='conditioncontainer'>
                	<foreach=" $option['condition'] as $cond">
                	<input type='radio' name='cfCondition' class='radio' value="{$cond->getId()}" />
                	<span class='radio'>{$cond->getTitle()}</span>
                    </foreach>
                    </div>
                	<div class='clear'></div>
                	</if>
                	
                	<label>Category</label>
                	<select name='cfCatId' id='cfCatId'>
                		<if=" $option['category'] ">
                		<foreach=" $option['category'] as $cat ">
                		<option value='{$cat->getId()}'>{$cat->getTitle()}</option>
                		</foreach>
                		</if>
                	</select>
                    <label>Image 1</label>
                	<input name='cfImage1' type='file' class='file' id='cfImage1' />
                	<div class='clear'></div>
                	
                	<label>Campus</label>
                	<input name='cfCampus' id='cfCampus' value='{$option['mainobj']->getCampus()}' />
                    <label>Image 2</label>
                	<input name='cfImage2' type='file' class='file' id='cfImage2' />
                	<div class='clear'></div>
                	
                	<label>City/Town</label>
                	<input name='cfLocation' id='cfLocation' value='{$option['mainobj']->getLocation()}' />
                    <label>Image 3</label>
                	<input name='cfImage3' type='file' class='file' id='cfImage3' />
                	<div class='clear'></div>
                	<if=" $option['mainobj']->ifiles ">
                	<div class='gallery_container'>
                		<foreach=" $option['mainobj']->ifiles as $ifile ">
                			<div class='imgcontainer'>
                				<div class='imgage'>
                					{$option['mainobj']->createImageCache($ifile[gdFile],170,180, 0, 1)}
                				</div>
                				<div class='option'>
                					<input class='delcb' name="del[{$ifile[gdFile]}]" value="{$ifile[gdFile]}" type="checkbox" /> Delete this image
                				</div>
                			</div>
                		</foreach>
                		<div class='clear'></div>
                	</div>
                	</if>
                	<div style="margin: 10px 0px 10px 90px;">
                		<input type="submit" name="submit" id="submit" value="Submit" class='button' />
                		<div class='clear'></div>
                	</div>
                	<div class='clear'></div>
                </form>
                
                <script type="text/javascript">
                	$('#cpv').click(function(){
			        	$('#rowtemp').toggle("slow", function(){	
							$('#rowtemp').remove();
						});
	            	});
			    	$(document).ready(function(){
			    		vsf.jRadio('{$option['mainobj']->getCondition()}', 'cfCondition');
			    		vsf.jSelect('{$option['mainobj']->getCatId()}', 'cfCatId');
						$("#postForm").validate({
							rules: {
								cfTitle: {
									required: true
								},
								cfPrice: {
									required: true,
									number: true
								},
								cfCondition: {
									required: true
								},
								cfContent:{
									required: true
								}
							},
							messages:{
								cfTitle: {
									required: "{$vsLang->getWords('validate_title_require','Provide a title')}"
								},
								cfPrice: {
									required: "{$vsLang->getWords('validate_price_require','Provide a valid price')}",
									number: "{$vsLang->getWords('validate_price_number','Provide a valid price')}"
								},
								cfCondition: {
									required: "Provide your item's condition"
								},
								cfContent: {
									required: "Provide your item's description"
								}
							},
							
							success: function(label) {
								label.html("&nbsp;").addClass("checked");
							},
							
							errorPlacement: function(error, element) {
								if($(element).attr('name') == "cfCondition")
									error.insertAfter($('#conditioncontainer'));
								else{
									if($(element).attr('name') == "cfTitle"){
										error.appendTo($('#tecontainer'));
									}else{
										if($(element).attr('name') == "cfPrice"){
											error.appendTo($('#pecontainer'));
										}else{
											if($(element).attr('name') == "cfContent"){
												error.appendTo($('#cecontainer'));
											}else{
												error.insertAfter(element);
											}
										}
									}
								}
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
								vsf.uploadFile('postForm', 'listings', 'editlc', 'rowtemp', 'icMarket');
							}
						});
					});
			    	
			    	$(document).ajaxStop($.unblockUI); 
			    </script>
			</div>
EOF;
	}

}
?>