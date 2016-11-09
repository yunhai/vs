<?php
class skin_products extends skin_objectadmin{

function addEditObjForm($objItem, $option = array()) {
		global $vsLang, $bw,$vsSettings,$tableName,$langObject, $vsMenu;
		
		$categories = $vsMenu->getCategoryGroup("manufacture");
	    $colors = $categories->getChildren();
	     $chtml .= "<option value='0'>{$vsLang->getWords('itemListManu',"Nhà sản xuất")}</option>";
		foreach($colors as $key=>$color){
			$chtml .= "<option value='".$key."'>".$color->getTitle()."</option>";
		}
                
		$BWHTML .= <<<EOF
			<div id="error-message" name="error-message"></div>
			<form id='add-edit-obj-form' name="add-edit-obj-form" method="POST" enctype='multipart/form-data'>
				<input type="hidden" id="obj-cat-id" name="{$tableName}CatId" value="{$option['categoryId']}" />
				<input type="hidden" name="{$tableName}Id" value="{$objItem->getId()}" />
				<input type="hidden" name="pageIndex" value="{$bw->input['pageIndex']}" />
				<input type="hidden" name="pageCate" value="{$bw->input['pageCate']}" />
				<input type="hidden" name="searchRecord" value="{$objItem->record}" />
				<input type="hidden" name="{$tableName}PostDate" value="{$objItem->getPostDate()}" />
				<input type="hidden" name="{$tableName}Image" value="{$objItem->getImage()}" />
				<input type="hidden" name="{$tableName}Author" value="{$objItem->getAuthor()}" />

				<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
					<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
						<span class="ui-dialog-title">{$option['formTitle']}</span>
                                                 <p style="float:right; cursor:pointer;">
                                                <span class='ui-dialog-title' id='closeObj'>
                                                 {$langObject['itemObjBack']}
                                                </span>
                                            </p>
					</div>
					<table class="ui-dialog-content ui-widget-content" style="width:100%;">
						
						<tr class='smalltitle'>
							<td class="label_obj" width="75">{$langObject['itemListTitle']}:</td>
							<td colspan="3">
								<input style="width:100%;" name="{$tableName}Title" value="{$objItem->getTitle()}" id="obj-title"/>
							</td>
						</tr>
						
						<tr class='smalltitle'>
							<td width="75" class="label_obj">
								{$langObject['itemObjPrice']}:
							</td>
							<td colspan="3">
								<input size="35" name="{$tableName}Price" value="{$objItem->getPrice(false)}" class="numeric"/>
							</td>
						</tr>
						</if>	
						
						
                                                <tr class='smalltitle'>
							<td class="label_obj" width="75">{$vsLang->getWords('itemListManu',"Nhà sản xuất")}:</td>
							<td colspan="3">
								
								<select id="{$tableName}Manu" name="{$tableName}Manu">
									{$chtml}
								</select>
							</td>
						</tr>                
						<if="$vsSettings->getSystemKey($bw->input[0].'_author',0, $bw->input[0])">
						<tr class='smalltitle'>
							<td class="label_obj"  width="75">
								{$langObject['itemObjAuthor']}:
							</td>
							<td colspan="3">
								<input style="width:100%;" name="{$tableName}Author" value="{$objItem->getAuthor()}"/>
							</td>
						</tr>
						</if>

                     	<if="$vsSettings->getSystemKey($bw->input[0].'_code',0, $bw->input[0])">
						<tr class='smalltitle'>
							<td class="label_obj"  width="75">
								{$langObject['itemObjCode']}:
							</td>
							<td colspan="3">
								<input style="width:40" name="{$tableName}Code" value="{$objItem->getCode()}"/>
							</td>
						</tr>
						</if>
						
						
						<tr class='smalltitle'>
							<td class="label_obj"  width="75">
								{$langObject['itemObjIndex']}:
							</td>
							<td width="170" colspan="3">
								<input size="10" class="numeric" name="{$tableName}Index" value="{$objItem->getIndex()}" />
                               	<span style="margin-right: 20px;margin-left:40px">{$langObject['itemObjStatus']}</span>
                               	<label>{$langObject['itemObjDisplay']}</label>

								<input name="{$tableName}Status" id="{$tableName}Status1" value='1' class='c_noneWidth' type="radio" checked />

								<label>{$langObject['itemListHide']}</label>
								<input name="{$tableName}Status" id="{$tableName}Status0" value='0' class='c_noneWidth' type="radio" />


								<if=" $vsSettings->getSystemKey($bw->input[0].'_home',0, $bw->input[0]) ">
								<label>{$langObject['itemListHome']}</label>
								<input name="{$tableName}Status" id="{$tableName}Status2" value='2' class='c_noneWidth' type="radio" />
								</if>
							</td>
						</tr>
						
						<if="$vsSettings->getSystemKey($bw->input[0].'_image',1, $bw->input[0])">
						<tr class='smalltitle'>
							<td class="label_obj">
								{$langObject['itemObjLink']}:
							</td>
							<td>
								<input onclick="checkedLinkFile($('#link-text').val());" onclicktext="checkedLinkFile($('#link-text').val());" type="radio" id="link-text" name="link-file" value="link" />
								<input size="39" type="text" name="txtlink" id="txtlink"/><br/>
								 {$vsSettings->getSystemKey($bw->input[0]."_image_timthumb_size","(size:100x100px)", $bw->input[0])}
							</td>
							<td colspan="2" rowspan="2">
								{$objItem->createImageCache($objItem->getImage(), 100, 50)}
								<br/>
								<if=" $objItem->getImage() && $vsSettings->getSystemKey($bw->input[0].'_image_delete',1, $bw->input[0]) ">
								<input type="checkbox" name="deleteImage" id="deleteImage" />
								<label for="deleteImage">{$langObject['itemObjDeleteImage']}</lable>
								</if>
							</td>
						</tr>

						<tr class='smalltitle'>
							<td class="label_obj">
								{$langObject['itemObjFile']}:
							</td>
							<td>
								<input onclick="checkedLinkFile($('#link-file').val());" onclicktext="checkedLinkFile($('#link-file').val());" type="radio" id="link-file" name="link-file" value="file" checked="checked"/>
								<input size="27" type="file" name="{$tableName}IntroImage" id="{$tableName}IntroImage" /><br />
								 <!--{$vsSettings->getSystemKey($bw->input[0]."_image_timthumb_size","(size:100x100px)", $bw->input[0])}-->
							</td>
						</tr>						
						</if>
						
						<if=" $vsSettings->getSystemKey($bw->input[0].'_intro',1, $bw->input[0]) ">
						<tr class='smalltitle'>
							<td class="label_obj" width="75">
								{$langObject['itemObjIntro']}:
							</td>
							<td colspan="3" valgin="left">
								{$objItem->getIntro()}
							</td>
						</tr>
						</if>
						
						<if="$vsSettings->getSystemKey($bw->input[0].'_content',1, $bw->input[0])">
						<tr class='smalltitle'>
							<td colspan="4" align="center">{$objItem->getContent()}</td>
						</tr>
						</if>
						<tr>
							<td class="ui-dialog-buttonpanel" colspan="4" align="center">
								<input type="submit" name="submit" value="{$option['formSubmit']}" />
							</td>
						</tr>
					</table>
				</div>
			</form>
			<script language="javascript">
				$(window).ready(function() {
                                        $('#obj-category option').each(function(){
							$(this).removeAttr('selected');
						});
					$("input.numeric").numeric();
					checkedLinkFile();
					vsf.jRadio('{$objItem->getStatus()}','{$tableName}Status');
					vsf.jSelect('{$objItem->getCatId()}','obj-category');
                                        vsf.jSelect('{$objItem->getManu()}','productManu');
				
				});
				
				$('#txtlink').change(function() {
					var img_html = '<img src="'+$(this).val()+'" style="width:100px; max-height:115px;" />'; 
					$('#td-obj-image').html(img_html);
				});
				
				$('#{$tableName}IntroImage').change(function() {
					var img_name = '<input type="hidden" id="image-name" name="image-name" value="'+$(this).val() +'"/>';
					$('#td-obj-image').html(img_name);
				});
				
				function checkedLinkFile(value){
					if(value=='link'){
						$("#txtlink").removeAttr('disabled');
						$("#{$tableName}IntroImage").attr('disabled', 'disabled');
					}else{
						$("#txtlink").attr('disabled', 'disabled');
						$("#{$tableName}IntroImage").removeAttr('disabled');
					}
				}
				
				$('#add-edit-obj-form').submit(function(){
					var flag  = true;
					var error = "";
					var categoryId=0;
					var count=0;

					$("#obj-category  option").each(function () {
						count++;
            			if($(this).attr('selected'))categoryId = $(this).val();
					});

					$('#obj-cat-id').val(categoryId);
					
					if(categoryId == 0 && count>1){
						error = "<li>{$langObject['itemListChoiseCate']}</li>";
						flag  = false;
					}
					
					var title = $("#obj-title").val();
					if(title == 0 || title == ""){
						error += "<li>{$langObject['notItemObjTitle']}</li>";
						flag  = false;
					}
					if(!flag){
						error = "<ul class='ul-popu'>" + error + "</ul>";
						vsf.alert(error);
						return false;
					}
					vsf.uploadFile("add-edit-obj-form", "{$bw->input[0]}", "add-edit-obj-process", "obj-panel","{$bw->input[0]}");
					return false;
				});
              	$('#closeObj').click(function(){                                       
					vsf.get('{$bw->input[0]}/display-obj-list/{$bw->input['pageCate']}/&pageIndex={$bw->input['pageIndex']}','obj-panel');
				});
			</script>
EOF;
	}
	
	function addEditOptionForm($objItem = '', $option = array()) {
		global $bw, $vsLang,$langObject,$tableName;
               
		$active = $objItem->getStatus () != '' ? $objItem->getStatus () : 1;
		$BWHTML .= <<<EOF
			<div id="error-message" name="error-message"></div>
			<form id='add-edit-opt-form' name="add-edit-opt-form" method="POST">
				<input type="hidden" name="productId" value="{$option['productId']}" />
				<input type="hidden" name="optId" value="{$objItem->getId()}" />
				<div class='ui-widget ui-widget-content ui-corner-all'>
					<div class="ui-title ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
						<span class="ui-icon ui-icon-note"></span>
						<span class="ui-dialog-title">{$option['formTitle']}</span>
					</div>
					<table cellpadding="1" cellspacing="1" border="0" class="ui-dialog-content ui-widget-content" style="width:100%;">
						<tr class='smalltitle'>
								<td >{$vsLang->getWords('obj_title', 'Title')}:</td>
								<td><input size="64%" type="text" name="optTitle" value="{$objItem->getTitle()}" id="optTitle"/></td>
						</tr>
						<tr class='smalltitle'>
							<td class="label_obj">{$vsLang->getWords('obj_content', 'Nội dung')}: </td>
							<td align="center">{$objItem->getContent()}</td>
						</tr>
						<tr class='smalltitle'>
							<td>{$langObject['itemObjIndex']}:</td>
							<td><input size="10" class="numeric" name="optIndex" value="{$objItem->getIndex()}" /></td>
						</tr>
						<tr class='smalltitle'>
							<td>{$vsLang->getWords('obj_status', 'Trạng thái')}:</td>
							<td>
                            	{$vsLang->getWords('obj_Status_Hide', 'Hide')}
                              	<input name="optStatus" type="radio"  class='checkbox' value="0" />
                               	{$vsLang->getWords('obj_Status_Display', 'Display')}
                               	<input name="optStatus" type="radio"  class='checkbox' value="1" />
                          	</td>
						</tr>
						<tr class='smalltitle'>
							<td class="ui-dialog-buttonpanel" colspan="2" align="center">
								<input type="submit" name="submit" value="{$option['formSubmit']}" />
							</td>
						</tr>
					</table>
				</div>
			</form>
			<script language="javascript">
				vsf.jRadio('{$active}','optStatus');
				$("input.numeric").numeric();
								
				$('#add-edit-opt-form').submit(function(){
					var title = $("#optTitle").val();
					var flag = true;
					var error = "";
					if(title == 0 || title == ""){
						error += "<li>{$vsLang->getWords('null_title', 'Tiêu đề không được trống !!!')}</li>";
						flag  = false;
					}
					
					if(!flag){
						error = "<ul class='ul-popu'>" + error + "</ul>";
						vsf.alert(error);
						return false;
					}
					vsf.submitForm($("#add-edit-opt-form"), "products/addEditOption", "opt-panel");
					vsf.get('products/addOption/{$option['productId']}','opt-form')
					return false;
				});
			</script>
EOF;
		return $BWHTML;
	}
	
	function mainProductOpt($option) {
		$BWHTML .= <<<EOF
			<div id="opt-form">{$option['objForm']}</div>
			<div id="opt-panel">{$option['objList']}</div>
			<div class="clear"></div>
EOF;
		return $BWHTML;
	}
	
	function displayListOption($objItems) {
		global $vsLang;
		if(count($objItems)>9) $height = "235px";
		$BWHTMl .= <<<EOF
			<div class='ui-widget ui-widget-content ui-corner-all' style="margin-top:15px;">
				    <div class="ui-title ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
				        <span class="ui-icon ui-icon-note"></span>
				        <span class="ui-dialog-title">{$vsLang->getWords('product_opt_title',"Danh sách các loại")}</span>
				    </div>
					<table cellspacing="1" cellpadding="1" id='objListHtmlTable' width="100%">
						<thead>
						    <tr>
						        <th width="20">{$vsLang->getWords('obj_list_status', 'Trạng Thái')}</th>
						        <th>{$vsLang->getWords('obj_list_title', 'Title')}</th>
						        <th width="20">{$vsLang->getWords('obj_index', 'Thứ tự')}</th>
						        <th width="85">{$vsLang->getWords('obj_list_option', 'Tùy chọn')}</th>
						    </tr>
						</thead>
						<tbody style="height: $height;  overflow-x: hidden;">
							<if="count($objItems)">
							<foreach="$objItems as $key => $obj">
								<php>
								if(is_string($obj))
									$obj = unserialize($obj);
								</php>
								<tr class="$vsf_class">
									<td style='text-align:center'>{$obj->getStatus('image')}</td>
									<td>
										{$obj->getTitle()}
									</td>
									
									<td algin="center">{$obj->getIndex()}</td>
									<td align="center">
										<a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:;" onclick="vsf.get('products/editOption/{$obj->getProductId()}/{$key}','opt-form')">Sửa</a>
									<a href="javascript:;" onclick="vsf.get('products/delOption/{$obj->getProductId()}/{$key}','opt-panel')" class="ui-state-default ui-corner-all ui-state-focus">
										Xóa
									</a>
									</td>
								</tr>
							</foreach>
							</if>
						</tbody>
					</table>
				</div>
			<div class="clear" id="file"></div>
EOF;
	}

	function managerObjHtml() {
		global $bw, $vsLang,$vsSettings,$langObject;
		$BWHTML .= <<<EOF
			<div id="page_tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all-top">
				<ul id="tabs_nav" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner">
                                <if="$bw->input['module'] == 'pages' ">
                                    <li class="ui-state-default ui-corner-top">
                                            <a href="{$bw->base_url}pages/displayVirtualTab/&ajax=1">
                                                    <span>{$langObject['tabVirtualModule']}</span>
                                            </a>
                                    </li>
	        		</if>
			    	<li class="ui-state-default ui-corner-top">
			        	<a href="{$bw->base_url}{$bw->input[0]}/display-obj-tab/&ajax=1"><span>{$vsLang->getWords("tab_obj_objes_{$bw->input[0]}","{$bw->input[0]}")}</span></a>
			        </li>
                                <if="$vsSettings->getSystemKey($bw->input[0].'_category_tab',0, "{$bw->input[0]}", 1, 1)">
                                        <li class="ui-state-default ui-corner-top">
                                        <a href="{$bw->base_url}menus/display-category-tab/{$bw->input[0]}/&ajax=1">
                                        <span>{$langObject['categoriesTitle']}</span></a>
                                </li>
			        </if>
			        
			        <if="$vsSettings->getSystemKey($bw->input[0].'_color_tab', 1, "{$bw->input[0]}", 1, 1)">
                                        <li class="ui-state-default ui-corner-top">
                                        <a href="{$bw->base_url}menus/display-category-tab/manufacture/&ajax=1">
                                        <span>{$vsLang->getWords('product-manufacture',"Nhà sản xuất")}</span></a>
                                </li>
			        </if>
			        
			        <if="$vsSettings->getSystemKey($bw->input[0].'_setting_tab',0, "{$bw->input[0]}", 1, 1)">
				        <li class="ui-state-default ui-corner-top">
				        	<a href="{$bw->base_url}settings/moduleObjTab/{$bw->input[0]}/&ajax=1">
								<span>Settings</span>
							</a>
			        	</li>
		        	</if>
				</ul>
			</div>
EOF;
		return $BWHTML;
	}

	
}
?>