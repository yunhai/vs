<?php
class skin_orders {

	function mainHtml($objList = "",$option = array()) {
		global $vsLang, $bw;
		$BWHTML .= <<<EOF
		
			{$option['leftHTML']}
			<div id="content1">
	        	{$this->rightAd()}        	
		        
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
		            <div class="seller_border">
		            	<div class="user_title">
			                <h3>{$vsLang->getWords('cart_info','Your shopping cart')}</h3>
						</div>
			            
						{$option['message']}
						<div id="cart">{$objList}</div>
					</div>
		        </div>
	    	</div>
	    	<div class="clear"></div>
		
EOF;
		return $BWHTML;
	}

	function customerInfo() {
		global $vsLang, $bw, $vsUser;
		$array = $vsUser->obj->getArrayInfo();

		$BWHTML = <<<EOF
			<div class='payment-info'>
					<form id="order_form" action="{$bw->base_url}orders/info/" method="post">
			      		<div class="text-cell">
							{$vsLang->getWords('customer_full_name','Fullname')}
						</div>
			      		<div class="input-cell">
			      			<input id="orderName" name="orderName" title="{$vsLang->getWords('customer_full_name','Enter your name')}" value="{$array['userFirstName']} {$array['userLastName']}"/>
			      		</div>
			      		
			      		
			      		<div class="text-cell">
							{$vsLang->getWords('order_address','Address')}
						</div>
			      		<div class="input-cell">
			      			<input type="text" id="orderAddress" name="orderAddress" title="{$vsLang->getWords('customer_address','Enter your address')}" />
		      			</div>
		      			<div class='clear'></div>
		      			
			      		<div class="text-cell">
							{$vsLang->getWords('order_phone','Phone')}
						</div>
			      		<div class="input-cell">
			      			<input type="text" name="orderPhone" title="{$vsLang->getWords('customer_phone','Enter your phone')}" value="{$vsUser->obj->getPhone()}"/>
		      			</div>
		      			
			      		<div class="text-cell">
							{$vsLang->getWords('order_email','Email')}
						</div>
			      		<div class="input-cell">
			      			<input type="text" id="orderEmail" name="orderEmail" title="{$vsLang->getWords('customer_email','Email address')}" value="{$vsUser->obj->getEmail()}"/>
		      			</div>
		      			<div class='clear'></div>
		      			
			      		<div class="text-cell">
							{$vsLang->getWords('order_message','Message')}
						</div>
			      		<div class="input-cell"><textarea id="orderMessage" name="orderMessage"></textarea></div>
			      		<div class='clear'></div>
			      		
			      		<div class="vs-submit">
			      			<input id="input_submit" value="Submit" type="submit"/>
		      			</div>
					</form>
			</div>
	   
EOF;
		return $BWHTML;
	}

	function cartSummary($itemCart) {
		global $vsLang, $bw;
		$cart = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'];
		$BWHTML = <<<EOF
			
            <div class="cart_info">
				<if="count($cart['item'])">
					{$itemCart['cart']}
				<else />
					<b>{$vsLang->getWords('global_cart_empty','Your shopping cart is empty now.')}</b>
				</if>
			</div>
EOF;
		return $BWHTML;
	}

	function ItemList($item, $total = 0) {
		global $vsLang, $bw, $vsPrint;
		
		
		$BWHTML = "";
		$BWHTML .= <<<EOF
				<form id="addEditForm" name="addEditForm" method="post">
	                <table class="cart_table" border="1" id="item-list">
						<tr>
	                    	<th width="30"><input type="checkbox" /></th>
	                        <th>{$vsLang->getWords('book_label','Books')}</th>
	                        <th width="50">{$vsLang->getWords('price_label','Price')}</th>
	                        <th width="50">{$vsLang->getWords('quality_label','Quality')}</th>
	                        <th width="75">{$vsLang->getWords('sub_total_label','Sub Total')}</th>
	                    </tr>
	                    
	                    <foreach=" $item as $obj ">
						 	<tr>
		                    	<td align="center"><input type="checkbox" name="cart[{$obj['bookId']}]" value="{$obj['bookId']}" /></td>
		                        <td class="item_content">{$obj['itemTitle']}</td>
		                        <td class="item_content">{$vsLang->getWords('global_curency','$')} {$obj['itemNumberPrice']}</td>
		                        <td width="50" class="item_content">
		                        	<input name="cart[{$obj['bookId']}]" value="{$obj['itemQuantity']}" class="item_quality" />
	                        	</td>
		                        <td class="sub_total">{$vsLang->getWords('global_curency','$')} {$obj['total']}</td>
							</tr>
		        		</foreach>
	                    <tr>
	                    	<td colspan="4">
	                        	<a href="#" onclick="deleteCart()" class="float_left cart_button" id="delete">
									{$vsLang->getWords('delete_checked','Delete checked')}
								</a>
	                            <a href="#" onclick="updateCart()" class="float_right cart_button" id="update">
	                            	{$vsLang->getWords('update_cart','Update cart')}
	                            </a>
	                            <div class="clear"></div>
	                            
	                            <a href="{$bw->base_url}orders/deleteallcart/" class="float_right cart_button" id="cancel">
	                            	{$vsLang->getWords('cancel_cart','Cancel')}
                            	</a>
	                            <div class="clear_right">
	                        </td>
	                        <td class="cart_total">
								{$vsLang->getWords('global_curency','$')} {$total}
	                        </td>
	                    </tr>
	                    <tr>
	                    	<td colspan="5">
	                        	<a href="javascript:;" id="order" class="float_left cart_button" >
									<span>{$vsLang->getWords('check_out','Checkout')}</span>
								</a>
							</td>
	                    </tr>
	                </table>
				</form>
				<div id="callback"></div>
                <script type="text/javascript">
                	function updateCart(){
                		if(checkSelect($('#addEditForm')))
					        $.blockUI({
					        	css: {
					        		border: 'none', 
	            					padding: '50px',
						            backgroundColor: '#C0C0C0',
						            color: '#000',
						            cursor:'progress',
						        },
						        message: "<div id='block_message'><img src='{$bw->vars['board_url']}/styles/images/ajax-loader.gif' alt='loading' /><br />{$vsLang->getWords('global_wait','Please wait...')}</div>",
						        fadeIn: 1000,
						        timeout: 2000,
						        onBlock: function() { 
						        	formFilter('orders/updatecart','callback');
					            }
							});
                	}

                	function formFilter(action, callback){
                		var checked = "";
                		$('#addEditForm').find("input[type='checkbox']").each(function(){
							if(this.checked){
								checked += $(this).val() + ",";
							}
						});
						checked = checked.substring(0, checked.length - 1);
						$('#addEditForm').append("<input type='hidden' name='checkedItem' value='" + checked + "' />");
						vsf.submitForm($('#addEditForm'), action, callback);
                	}
                	
                	function deleteCart(){
                		if(checkSelect($('#addEditForm'))){
                			$.blockUI({
					        	css: {
					        		border: 'none', 
	            					padding: '50px',
						            backgroundColor: '#C0C0C0',
						            color: '#000',
						            cursor:'progress',
						        },
						        message: "<div id='block_message'><img src='{$bw->vars['board_url']}/styles/images/ajax-loader.gif' alt='loading' /><br />{$vsLang->getWords('global_wait','Please wait...')}</div>",
						        fadeIn: 1000,
						        timeout: 2000,
						        onBlock: function() { 
						        	formFilter('orders/deletecart','cart');
					            }
							});
						}
                	}
                	
                	function checkSelect(obj){
						if(!obj) return false;
						countItem=0;
						obj.find("input[type='checkbox']").each(function(){
							if(this.checked){
								countItem ++;
							}
						});
						if(countItem==0){
							$.blockUI({ message: '<h1 style="padding:20px;"> {$vsLang->getWords('err_none_select_items','No item is chosen!')}</h1>' });
							setTimeout($.unblockUI, 2000);
							return false;
						}
						return true;
					}
					
					$('#order').click(function(){
			    		$.blockUI({
			    			css: {	border: 'none', 
	            					padding: '50px',
						            backgroundColor: '#C0C0C0',
						            color: '#000',
						            cursor:'progress'
						        },
							message: "<div id='block_message'><img src='{$bw->vars['board_url']}/styles/images/ajax-loader.gif' alt='loading' /><br />{$vsLang->getWords('global_wait','Please wait...')}</div>",
							fadeIn: 1000
			    		});
			    		
			    		location.href = "{$bw->base_url}orders/payment/";
			    	});
					
                </script>
                
EOF;
				//--endhtml--//
				return $BWHTML;
	}

	function orderLoading($message="", $quality=0){
		global $vsLang;
		$BWHTML .= <<<EOF
			<script type='text/javascript'>
				$('#block_message').html('{$message}');
				$('#shopping_cart').html('{$vsLang->getWords('global_shopping_cart','Shopping Cart')} ({$quality})');
				setTimeout(function() { 
		        	$.unblockUI();
		        }, 2000);
			</script>
EOF;
		return $BWHTML;
	}
	
	
	function payment($option){
		global $bw,$vsUser, $vsLang, $vsPrint;
		
		$BWHTML .= <<<EOF
			{$option['leftHTML']}
			<div id="content1">
	        	{$this->rightAd()}        	
		        
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
		            <div class="seller_border">
		            	<div class="user_title">
			                <h3>{$vsLang->getWords('payment_info','Your Information')}</h3>
						</div>
			            
						{$option['message']}
						{$option['customer']}
					</div>
		        </div>
	    	</div>
	    	<div class="clear"></div>
	    	<script type="text/javascript">
            	$(document).ready(function() { 
				    $('.submit').click(function() { 
				        $.blockUI({
				        	css: {
				        		border: 'none', 
            					padding: '50px',
					            backgroundColor: '#C0C0C0',
					            color: '#000',
					            cursor:'progress',
					        },
					        message: "<div id='block_message'><img src='{$bw->vars['board_url']}/styles/images/ajax-loader.gif' alt='loading' /><br />{$vsLang->getWords('global_wait','Please wait...')}</div>",
					        fadeIn: 1000,
					        timeout: 2000
						});
				    }); 
				});
            </script>
EOF;
	}

	function loadMessage(){
		$BWHTML .= <<<EOF
		<h1><a href="#" style="color:#636363;">thanh toán</a></h1>
            <div class="mem_info">
                <p class="replay_cart">Cảm ơn quý khách đã đặt hàng! Chúng tôi sẽ kiểm tra đơn hàng và liên hệ với quý khách trong thời gian sớm nhất!</p>
            </div>
EOF;
		return $BWHTML;
	}	

	function rightAd($option= array()){
		global $vsTemplate;
		$BWHTML .= <<<EOF
			{$vsTemplate->global_template->GLOBAL_PARTNER}
EOF;
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

	
	function transaction($option){
		global $vsLang, $bw, $vsPrint;
		$BWHTML .= <<<EOF
			{$option['leftHTML']}
			<div id="content1">
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
		            <div id="pro_tab">
		                <div id="PRICE">
		                	<if=" $option['pageList'] ">
		                   	<foreach=" $option['pageList'] as $orderItem">
		                   	<div class="product">
		                   		<div class="product_img">
		                   			<a href="{$orderItem->getUrl('textbooks')}" title="{$orderItem->getTitle()}">
		                   				<if=" $orderItem->getBookImage() ">
											{$orderItem->createImageCache($orderItem->getBookImage(),85,115)}
										<else />
											<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />
										</if>
		                   			</a>
	                   			</div>
		                        <div class="product_intro">
		                        	<h4>
		                        		<a href="{$orderItem->getUrl('textbooks')}" title="Detail: {$orderItem->getTitle()}" target="_blank">
		                        			{$orderItem->getTitle()}
		                        		</a>
	                        		</h4>
		                            <p>
		                        		{$vsLang->getWords('transaction_quality','Quality')}: {$orderItem->getQuantity()}
		                        		{$vsLang->getWords('transaction_time','Time')}: {$orderItem->getPostDate('SHORT')}
		                        	</p>
									<p>
										{$vsLang->getWords('transaction_status','Status')}: {$orderItem->getStatus()}
										<input type="button" class="commit" name="commit" value="{$vsLang->getWords('order_make_deal','Commit')}" id="{$orderItem->getId()}"/>
										<input type="button" class="runout" name="runout" value="{$vsLang->getWords('order_run_out','Run out')}" id="{$orderItem->getId()}" fd="{$orderItem->getBookId()}"/>
		                        	</p>
		                            <p class="cost">
		                            	{$vsLang->getWords('transaction_total','Total')}:
		                        		{$vsLang->getWords('global_curency','$')}{$orderItem->getPrice()}
		                            </p>
		                        </div>
		                        <div class="clear_left"></div>
		                   	</div>
		                   	</foreach>
		                   	</if>
		                   	<if=" $option['paging'] ">
		                   	<div class="page">
		                   		<span>Browse Pages:</span>
		                   		{$option['paging']}
		                   	</div>
		                   	</if>
		                </div>
		            </div>
		        </div>
	    	</div>
	    	<div class="clear"></div>
	    	<div id="callback"></div>
	    	<script type="text/javascript">
            	$(document).ready(function() {
			   		$(".commit").each(function(){
			   			$(this).bind("click", function(e){
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
							vsf.get('orders/updateItem/'+$(this).attr('id'),'callback');					        
						});
			   		});
			   		
			   		$(".runout").each(function(){
			   			$(this).bind("click", function(e){
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
							vsf.get('orders/runout/'+$(this).attr('id')+'/'+$(this).attr('fd'),'callback');					        
						});
			   		});
				});
            </script>
EOF;
		return $BWHTML;
	}
	
	function updateItem($message=""){
		global $vsLang;
		$BWHTML .= <<<EOF
			<script type='text/javascript'>
				$('#block_message').html('{$message}');
				setTimeout(function() { 
		        	$.unblockUI();
		        }, 2000);
			</script>
EOF;
		return $BWHTML;
	}
	
}
?>