<?php
class skin_products {
	
	function MainPage() {
		global $bw, $vsLang;
		$BWHTML .= <<<EOF
			<div id="page_tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all-top">
				<ul id="tabs_nav" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all-inner">
			        <li class="ui-state-default ui-corner-top">
			        	<a href="{$bw->base_url}/menus/display-category-tab/products/&ajax=1">
			        		<span>{$vsLang->getWords('tab_product_categories','Categories')}</span>
			        	</a>
			        </li>
			        <li class="ui-state-default ui-corner-top  ui-tabs-selected ui-state-active">
			        	<a href="{$bw->base_url}/products/display-product-tab/&ajax=1">
			        		<span>{$vsLang->getWords('tab_product_products','Products')}</span>
			        	</a>
			        </li>
			    </ul>
			</div>
EOF;
		return $BWHTML;	
	}
	
	function loadRequireJavascript() {
		global $bw, $vsLang;
		
		$BWHTML .= <<<EOF
			<script type="text/javascript">
				function deleteAllProduct(){
					jConfirm(
						'{$vsLang->getWords("deleteProductConfirm","Are you sure to delete these product information?")}', 
						'{$bw->vars['global_websitename']} Dialog', 
						function(r){
							if(r){
								$("#product-category option:selected").each(function () {
									var categoryId = $(this).val();
								});
								var flag=true; var jsonStr = "("; var myStr = "";
								contactType = $('#contactType').val();
				
								$("input[class=myCheckbox]").each(function(){
									if(this.checked){
										flag=false;
										jsonStr += this.value + ',';
										if(typeof(imageStr[this.value])!='undefined')
											myStr += imageStr[this.value] + ","; 
									}
								});
								if(flag){
									jAlert(
										"{$vsLang->getWords('deleteProductConfirm_NoItem', 'You haven\'t choose any items!')}",
										"{$bw->vars['global_websitename']} Dialog"
									);
									return false;
								}
								myStr = myStr.substr(0,myStr.lastIndexOf(','));
								jsonStr = jsonStr.substr(0,jsonStr.lastIndexOf(','))+' -- '+myStr+'--'+categoryId+')';
								
								if(currentPage >= totalPage) 
									currentPage = totalPage - 1;
									
								if(currentPage<=0) currentPage=1;
								
								vsf.get('products/deleteProduct/'+jsonStr+'/'+currentPage+'/','productList');
							}
						}
					);
					vsf.get('products/display-product-list/'+ $("#idCategory").val() +'/', 'product-panel');
				}
			</script>		
EOF;
				}
	
	function productList($productItems = array(), $option = array()) {
		global $bw, $vsLang;
		$count = count($productItems);
		$BWHTML .= <<<EOF
			<script type="text/javascript">
				function checkProduct() {
					var checkedString = '';
					$("input[class=myCheckbox]").each(function(){
						if(this.checked) checkedString += $(this).val()+',';
					});
					$('#checked-product').val(checkedString);
				}
			
				function deleteProduct(id, categoryId) {
					jConfirm(
						"{$vsLang->getWords('product_delete_confirm', "Are you sure want to delete this product?")}",
						"{$bw->vars['global_websitename']} Dialog",
						function(r) {
							if(r) {
								vsf.get('products/delete-product/'+id+'/','product-panel');
								vsf.get('products/display-product-list/'+ categoryId +'/','product-panel');
							}
						}
					);
				}
			
				$(document).ready(function(){				
					$("input[name=all]").click(function(){
						var checked_status = this.checked;
						var checkedString = '';
						$("input[class=myCheckbox]").each(function(){
							this.checked = checked_status;
							if(checked_status) checkedString += $(this).val()+',';
						});
						$('#checked-product').val(checkedString);
					});	
				});
				
				$('#add-productlist-bt').click(function(){
					$("#product-category option:selected").each(function () {
						$("#idCategory").val($(this).val());
					});
					vsf.get('products/add-edit-product-form/','product-panel');
				});
				
				$('#hide-productlist-bt').click(function() {
					if($('#checked-product').val()=='') {
						jAlert(
							"{$vsLang->getWords('hide_product_confirm_noitem', "You haven't choose any items to hide!")}",
							"{$bw->vars['global_websitename']} Dialog"
						);
						return false;
					}
					var categoryId ;
					$("#product-category option:selected").each(function () {
						categoryId = $(this).val();
					});
					vsf.submitForm($('#product-list-form'),'products/hide-checked-product/','product-panel');
					vsf.get('products/display-product-list/'+ categoryId +'/','product-panel');
				});

				
				var categoryId = 0;
				$("#product-category").change(function(){
					$("#product-category option:selected").each(function () {
						$("#categoryId").val($(this).val());
						categoryId = $("#categoryId").val();
					});
				});
					
				$('#visible-productlist-bt').click(function() {
					if($('#checked-product').val()=='') {
						jAlert(
							"{$vsLang->getWords('visible_product_confirm_noitem', "You haven't choose any items to visible!")}",
							"{$bw->vars['global_websitename']} Dialog"
						);
						return false;
					}
					
					vsf.submitForm($('#product-list-form'),'products/visible-checked-product/','product-panel');
					vsf.get('products/display-product-list/'+categoryId+'/','product-panel');
				});
				
				$('#delete-productlist-bt').click(function() {
					if($('#checked-product').val()=='') {
						jAlert(
							"{$vsLang->getWords('delete_product_confirm_noitem', "You haven't choose any items to delete!")}",
							"{$bw->vars['global_websitename']} Dialog"
						);
						return false;
					}
					
					jConfirm(
						"{$vsLang->getWords('product_delete_confirm', "Are you sure want to delete this product?")}",
						"{$bw->vars['global_websitename']} Dialog",
						function(r) {
							if(r) {
							var categoryId ;
								$("#product-category option:selected").each(function () {
									categoryId = $(this).val();
								});
								vsf.submitForm($('#product-list-form'),'products/delete-checked-product/','product-panel');
								vsf.get('products/display-product-list/'+ categoryId +'/','product-panel');
							}
						}
					);
				});
			</script>
			
			<div class="red">{$option['message']}</div>
			<form id="product-list-form">
				<input type="hidden" name="checkedProduct" id="checked-product" value="" />
				<input type="hidden" name="categoryId" value="{$option['categoryId']}" id="categoryId" />
				
				<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
				    <div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
				        <span class="ui-icon ui-icon-note"></span>
				        <span class="ui-dialog-title">{$option['productListTitle']}</span>
				    </div>
				    
				    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner ui-widget-header">
				    	<li class="ui-state-default ui-corner-top" id="add-productlist-bt"><a href="#" title="{$vsLang->getWords('add_product_alt_bt','Add product')}">{$vsLang->getWords('add_product_bt','Add product')}</a></li>
				        <li class="ui-state-default ui-corner-top" id="hide-productlist-bt"><a href="#" title="{$vsLang->getWords('hide_product_alt_bt','Hide selected product')}">{$vsLang->getWords('hide_product_bt','Hide')}</a></li>
				        <li class="ui-state-default ui-corner-top" id="visible-productlist-bt"><a href="#" title="{$vsLang->getWords('visible_product_alt_bt','Visible selected product')}">{$vsLang->getWords('visible_product_bt','Visible')}</a></li>
				        <li class="ui-state-default ui-corner-top" id="delete-productlist-bt"><a href="#" title="{$vsLang->getWords('delete_product_alt_bt','Delete selected product')}">{$vsLang->getWords('delete_product_bt','Delete')}</a></li>
				    </ul>
				    
					<table cellspacing="1" cellpadding="1" id='productListTable' width="100%">
						<thead>
						    <tr>
						        <th  style='text-align:center;' width="15"><input type="checkbox" name="all" /></th>
						        <th  style='text-align:center;' width="20">{$vsLang->getWords('product_label_status', 'Trạng thái')}</th>
						        <th  style='text-align:center;' width="100">{$vsLang->getWords('product_labelk=_name', 'Tên')}</td>
						        <th  style='text-align:center;' width="50">{$vsLang->getWords('product_label_code', 'Mã')}</th>
						        <th style='text-align:center;' width="50">{$vsLang->getWords('product_list_price', 'Giá')}</th>
						        <th style='text-align:center;' width="100">{$vsLang->getWords('product_list_description', 'Mô tả')}</th>
						        <th style='text-align:center;' width="55">{$vsLang->getWords('product_list_action', 'Options')}</th>
						    </tr>
						</thead>
						<tbody>
							<if=" $count > 0">
							<foreach="$productItems as $product">
								<tr>        
									<td align="center" width="20">
										<input type="checkbox" onclick="checkProduct({$product->getId()});" name="product_{$product->getId()}" value="{$product->getId()}" class="myCheckbox" />
									</td>
									<td style='text-align:center' width="20">{$product->imageStatus}</td>
									
									<td>
										<a href="javascript:vsf.get('products/add-edit-product-form/{$product->getId()}/','product-panel')" title='{$vsLang->getWords('productItem_EditproductTitle','Click here to edit this product')}' style='color:#CA59AA !important;' >
											{$product->getName()}
										</a>
									</td>
									
									<td width="50">{$product->getCode()}</td>
									<td width="50">{$product->getPrice()}</td>
									<td>{$product->getDescription()}</td>
									<td width="55">
										<a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:vsf.get('products/add-edit-product-form/{$product->getId()}/','product-panel')" title='{$vsLang->getWords('newsItem_EditObjTitle',"Click here to edit this {$bw->input[0]}")}'>{$vsLang->getWords('global_edit','Sửa')}</a>
										<a class="ui-state-default ui-corner-all ui-state-focus" href="avascript:deleteProduct({$product->getId()}, {$product->getCategory()->getId()})" title='{$vsLang->getWords('newsItem_EditObjTitle',"Click here to delete this {$bw->input[0]}")}'>{$vsLang->getWords('global_del','Xóa')}</a>
									</td>
								</tr>
							</foreach>
							</if>
						</tbody>
						
						<tfoot>
							<tr>
								<th colspan='7'>
									<div style='float:right;'>{$option['paging']}</div>
								</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</form>
EOF;
	}
	
	function addEditProductForm($productItem, $option = array()) {
		global $vsLang, $bw;
		$time = time();
		$BWHTML .= <<<EOF
		
			<script language="javascript">
				function updateProductList(categoryId){
					vsf.get('products/display-product-list/'+categoryId+'/','product-panel');
				}
				
				function myAlert(message){
					jAlert(
						message,
						'{$bw->vars['global_websitename']} Dialog'
					);
				}
				
				
				$('#productImages').change(function() {
					var img_name = '<input type="hidden" id="image-name" name="image-name" value="'+$(this).val() +'"/>';
					$('#hidden-product-image-name').html(img_name);
				});
				$(document).ready(function(){
					$('#productCategoryId').val($("#idCategory").val());
					$("#product-category").change(function(){
						$("#product-category option:selected").each(function () {
							$('#productCategoryId').val($(this).val());
						});
					});
				});
				
				$('#add-edit-product-form').submit(function(){
					var flag  = true;
					var error = "";
					var categoryId = $('#productCategoryId').val();
				
					if(categoryId == null || categoryId == 0 || categoryId == "undefine"){
						error = "<li>{$vsLang->getWords('not_select_category', 'Vui lòng chọn category!!!')}</li>";
						flag  = false;
					}
					
					var title = $("#product-name").val();
					if(title == null || title == ""){
						error += "<li>{$vsLang->getWords('null_title', 'Tên không được để trống!!!')}</li>";
						flag  = false;
					}
					
					
					if(!flag){
						error = "<ul class='ul-popu'>" + error + "</ul>";
						myAlert(error);
						return false;
					}
					
					//////////////////////////////////////////
					var countFile = 0
					$("#add-edit-product-form").find("input[type='file']").each(function(){
						if(this.value){
							countFile ++;
						}
					});
					if(countFile > 0){
						$('#error-message').ajaxStart(function(){
							$(this).html("<img src='skins/admin/blue/images/loader.gif' alt='loading' />");
						});
						$("#add-edit-product-form").find("input[type='file']").each(function(){
							if(this.value){
								var name = this.name;
								var title = $("#product-name").val();
								uri ="admin.php?vs=products/uploadImage/&ajax=1&uploadName="+name+"&hiddenTime="+$time+"&subfix="+title;
								$.ajaxFileUpload({
										url:uri,
										secureuri:false,
										fileElementId:name,
										dataType:"json",
										success: function (data, status){
											countFile--;
											if(typeof(data.error) != 'undefined'){
												if(data.error != ''){
													return false;
												}
											}else {
												if(countFile == 0){
													$('#error-message').ajaxStop(function(){
														$(this).html('');
													});
													vsf.submitForm($('#add-edit-product-form'), 'products/add-edit-product-process/', 'product-panel');
													vsf.get('products/display-product-list/'+ categoryId +'/', 'product-panel');
												}
											}
										},
										error: function (data, status, e){
											countFile--;
											$('#error-message').ajaxStop(function(){
												$(this).html(e);
											});
											return false;
										}
									}
								);
							}
						});
					}
					else{
						$('#error-message').ajaxStop(function(){
							$(this).html('');
						});
					
						vsf.submitForm($('#add-edit-product-form'), 'products/add-edit-product-process/', 'product-panel');
						vsf.get('products/display-product-list/'+ categoryId +'/', 'product-panel');
					}
					return false;
				});
			</script>
			
			<div id="error-message" name="error-message"></div>
			<form id='add-edit-product-form' name="add-edit-product-form" method="POST"  enctype='multipart/form-data'>
				<input type="hidden" id="productCategoryId" name="productCategoryId" value="{$option['categoryId']}" />
				<input type="hidden" name="productId" value="{$productItem->getId()}" />
				<input type="hidden" name="hiddenTime" value="{$time}" />
				<div id="hidden-product-image-name"></div>
				<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
					<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
						<span class="ui-dialog-title">{$option['formTitle']}</span>
					</div>
					
					<table class="ui-dialog-content ui-widget-content">
						<tr>
							<td style="width: 30px;font-weight:bold; float:left;">{$vsLang->getWords('product_name', 'Tên')}<span style="color:red">(*)</span></td>
							<td><input style="border-color:#9CD9EB" size="39" type="text" name="productName" value="{$productItem->getName()}" id="product-name"/></td>
							<td style="width: 100px; float:left;font-weight:bold;">{$vsLang->getWords('product_code_bank', 'Chọn ngân hàng')}</td>
							<td style="float:left;">
								<!--<input style="border-color:#9CD9EB" size="10" type="text" name="productCode" value="{$productItem->getCode()}" id="product-code"/>-->
								{$productItem->optionBanks}
							</td>
							<!--
								<td style="width: 30px; float:left;font-weight:bold;">{$vsLang->getWords('product_price', 'Giá')}</td>
								<td style="float:left;"><input style="border-color:#9CD9EB" size="15" type="text" name="productPrice" value="{$productItem->getPrice()}" id="product-Price"/></td>
							-->
							
						</tr>
						<tr >
							<td style="width: 30px;font-weight:bold;float:left">{$vsLang->getWords('product_image_file', "Hình")}</td>
							<td><input style="border-color:#9CD9EB" size="27" type="file" name="productImages" id="productImages"/></td>
							<td colspan='4' style="font-weight:bold;">{$vsLang->getWords('product_Status', 'Hiện')}
								<input style="border-color:#9CD9EB"  type="checkbox" name="productIsVisible" id="productIsVisible" {$productItem->isStatus()} style='margin-right:10px;'/>
								<!--{$vsLang->getWords('product_Special', 'Đặt biệt')}:
								<input style="border-color:#9CD9EB" type="checkbox" name="productIsSpecial" id="productIsSpecial" {$productItem->isSpecial()} />-->
							</td>
						</tr>
						
						<tr>
							<td style="font-weight:bold; float:left;">{$vsLang->getWords('product_Description', 'Mô tả')}</td>
							<td><textarea id="productDescription" style="border-color:#9CD9EB" name="productDescription" rows="5" cols="30">{$productItem->getDescription()}</textarea></td>
							<td colspan='4'><div id="image-product-preview" style="width:120px; height:100px;border:1px solid  #9CD9EB; font-weight:bold; text-align:center;">{$option['previewImage']}</div></td>
						</tr>
						<tr>
							<td colspan="6" align="center">{$productItem->getContent()}</td>
						</tr>
						
						<tr>
							<td class="ui-dialog-buttonpanel" colspan="4" align="center">
								<input type="submit" name="submit" value="{$option['formSubmit']}" style="width:100px; font-weight:bold;border:1px solid  #9CD9EB;"/>
							</td>
						</tr>
					</table>
				</div>
			</form>
EOF;
	}
	
	function categoryList($data = array()) {
		global $vsLang, $bw;
		
		$BWHTML .= <<<EOF
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all">
				<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
					<span class="ui-icon ui-icon-triangle-1-e"></span>
					<span class="ui-dialog-title">{$vsLang->getWords('category_table_title_header','Categories')}</span>
				</div>
				<table width="100%" cellpadding="0" cellspacing="1">
					<tr>
				    	<th id="product-category-message" colspan="2">{$data['message']}{$vsLang->getWords('category_chosen',"Selected categories")}: {$vsLang->getWords('category_not_selected',"None")}</th>
				    </tr>
				    <tr>
				        <td width="220">
				        {$data['html']}
				        </td>
				    	<td align="center">
				        	<img src="{$bw->vars['img_url']}/view.png" alt="{$vsLang->getWords('view_product_bt',"View product")}" id="view-product-bt" />
				            <img src="{$bw->vars['img_url']}/add.png" align="{$vsLang->getWords('add_product_bt',"Add product")}" id="add-product-bt" />
				        </td>
					</tr>
				</table>
			</div>
			
			<script type="text/javascript">
				$('#view-product-bt').click(function() {
					var categoryId = '';
					$("#product-category option:selected").each(function () {
						categoryId = $(this).val();
					});
					$("#idCategory").val(categoryId);
					vsf.get('products/display-product-list/'+categoryId+'/','product-panel');
				});
				
				$('#add-product-bt').click(function(){
					$("#product-category option:selected").each(function () {
						$("#productCategoryId").val($(this).val());
						$("#idCategory").val($(this).val());
					});
					
					vsf.get('products/add-edit-product-form/', 'product-panel');
				});
				
				var parentId = '';
				$('#product-category').change(function() {
					var currentId = '';
					var parentId = '';
					$("#product-category option:selected").each(function () {
						currentId += $(this).val() + ',';
						parentId = $(this).val();
					});
										
					currentId = currentId.substr(0, currentId.length-1);
					$("#product-category-message").html('{$vsLang->getWords('category_chosen',"Selected categories")}:'+currentId);
					$('#productCategoryId').val(parentId);
					$("#idCategory").val(parentId);
				});
			</script>
EOF;
	}
	
	function MainProduct($option) {
		$BWHTML .= <<<EOF
			<div class='left-cell'><div id='category-panel'>{$option['categoryList']}</div></div>
			<input type="hidden" id="idCategory" name="idCategory" />
			<div id="product-panel" class="right-cell">{$option['productList']}</div>
			<div class="clear"></div>
EOF;
		return $BWHTML;
	}
}