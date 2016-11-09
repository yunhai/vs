<?php
class skin_partners {
	function objListHtml($objItems = array(), $option = array()) {
		global $bw, $vsLang;
		$BWHTML .= <<<EOF
			<div class="red">{$option['message']}</div>
			<form id="obj-list-form">
				<input type="hidden" name="checkedObj" id="checked-obj" value="" />
				<input type="hidden" name="categoryId" value="{$option['categoryId']}" id="categoryId" />
				<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
				    <div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
				        <span class="ui-icon ui-icon-note"></span>
				        <span class="ui-dialog-title">{$vsLang->getWords('obj_objListHtmlTitle',"{$bw->input[0]} Item List")}</span>
				    </div>
				    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner ui-widget-header">
				    	<li class="ui-state-default ui-corner-top" id="add-objlist-bt"><a href="#" title="{$vsLang->getWords('add_obj_alt_bt',"Add {$bw->input[0]}")}">{$vsLang->getWords('add_obj_alt_bt',"Add {$bw->input[0]}")}</a></li>
				        <li class="ui-state-default ui-corner-top" id="hide-objlist-bt"><a href="#" title="{$vsLang->getWords('hide_obj_alt_bt',"Hide selected {$bw->input[0]}")}">{$vsLang->getWords('hide_obj_bt','Hide')}</a></li>
				        <li class="ui-state-default ui-corner-top" id="visible-objlist-bt"><a href="#" title="{$vsLang->getWords('visible_obj_alt_bt',"Visible selected {$bw->input[0]} ")}">{$vsLang->getWords('visible_obj_bt','Visible')}</a></li>
				        <li class="ui-state-default ui-corner-top" id="delete-objlist-bt"><a href="#" title="{$vsLang->getWords('delete_obj_alt_bt',"Delete selected {$bw->input[0]}")}">{$vsLang->getWords('delete_obj_bt','Delete')}</a></li>
				    </ul>
					<table cellspacing="1" cellpadding="1" id='objListHtmlTable' width="100%">
						<thead>
						    <tr>
						        <th width="15"><input type="checkbox" onclick="checkAll()" onclicktext="checkAll()" name="all" /></th>
						        <th width="60">{$vsLang->getWords('obj_list_status', 'Active')}</th>
						        <th>{$vsLang->getWords('obj_list_title', 'Title')}</td>
						        <th width="50">{$vsLang->getWords('obj_list_index', 'Thứ tự')}</th>
						        <th width="150">{$vsLang->getWords('obj_list_action', 'Action')}</th>
						    </tr>
						</thead>
						<tbody>
							<foreach="$objItems as $obj">
								<tr class="$class $vsf_class">
									<td align="center">
										<input type="checkbox" onclicktext="checkObject({$obj->getId()});" onclick="checkObject({$obj->getId()});" name="obj_{$obj->getId()}" value="{$obj->getId()}" class="myCheckbox" />
									</td>
									<td style='text-align:center'>{$obj->getStatus('image')}</td>
									
									<td>
										<a href="javascript:vsf.get('{$bw->input[0]}/add-edit-obj-form/{$obj->getId()}/','obj-panel')" title='{$vsLang->getWords('newsItem_EditObjTitle',"Click here to edit this {$bw->input[0]}")}' style='color:#000 !important;' >
										{$obj->getTitle()}
										</a>
									</td>
									<td>{$obj->getIndex()}</td>
									<td>
										<a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:;" onclick="vsf.get('{$bw->input[0]}/add-edit-obj-form/{$obj->getId()}/','obj-panel')" title='{$vsLang->getWords('newsItem_EditObjTitle',"Click here to edit this {$bw->input[0]}")}'> {$vsLang->getWords('global_edit','Sửa')}</a> 
										<a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:;" onclick="deleteObj({$obj->getId()}, {$obj->createCategory()->getId()});" title='{$vsLang->getWords('newsItem_EditObjTitle',"Click here to delete this {$bw->input[0]}")}'>{$vsLang->getWords('global_del','Xóa')}</a>
									</td>
								</tr>
							</foreach>
						</tbody>
						<tfoot>
							<tr>
								<th colspan='5'>
									<div style='float:right;'>{$option['paging']}</div>
								</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</form>
			<div id="albumn"></div>
			<script type="text/javascript">
				function checkObject() {
					var checkedString = '';
					$("input[type=checkbox]").each(function(){
						if($(this).hasClass('myCheckbox')){
							if(this.checked) checkedString += $(this).val()+',';
						}
					});
					checkedString = checkedString.substr(0,checkedString.lastIndexOf(','));
					$('#checked-obj').val(checkedString);
					
				}
			
				function deleteObj(id, categoryId) {
					jConfirm(
						"{$vsLang->getWords('obj_delete_confirm', "Are you sure want to delete this {$bw->input[0]}?")}",
						"{$bw->vars['global_websitename']} Dialog",
						function(r) {
							if(r) {
								vsf.get('{$bw->input[0]}/delete-obj/'+id+'/','obj-panel');
								vsf.get('{$bw->input[0]}/display-obj-list/'+ categoryId +'/','obj-panel');
							}
						}
					);
					return false;
				}
				function checkAll() {
					var checked_status = $("input[name=all]:checked").length;
					var checkedString = '';
					$("input[type=checkbox]").each(function(){
						if($(this).hasClass('myCheckbox')){
						this.checked = checked_status;
						if(checked_status) checkedString += $(this).val()+',';
						}
					});
					$("span[acaica=myCheckbox]").each(function(){
						if(checked_status)
							this.style.backgroundPosition = "0 -50px";
						else this.style.backgroundPosition = "0 0";
					});
					$('#checked-obj').val(checkedString);
				}
				
				$('#add-objlist-bt').click(function(){
					$("#obj-category option:selected").each(function () {
						$("#idCategory").val($(this).val());
					});
					vsf.get('{$bw->input[0]}/add-edit-obj-form/','obj-panel');
				});
				
				$('#hide-objlist-bt').click(function() {
					if($('#checked-obj').val()=='') {
						jAlert(
							"{$vsLang->getWords('hide_obj_confirm_noitem', "You haven't choose any items to hide!")}",
							"{$bw->vars['global_websitename']} Dialog"
						);
						return false;
					}
					var categoryId =0;
					$("#obj-category option:selected").each(function () {
						categoryId = $(this).val();
					});
					vsf.submitForm($('#obj-list-form'),'{$bw->input[0]}/hide-checked-obj/','');
					vsf.get('{$bw->input[0]}/display-obj-list/'+ categoryId +'/','obj-panel');
				});
				
				$('#visible-objlist-bt').click(function() {
					if($('#checked-obj').val()=='') {
						jAlert(
							"{$vsLang->getWords('visible_obj_confirm_noitem', "You haven't choose any items to visible!")}",
							"{$bw->vars['global_websitename']} Dialog"
						);
						return false;
					}
					var categoryId =0;
					$("#obj-category option:selected").each(function () {
						categoryId = $(this).val();
					});
					vsf.submitForm($('#obj-list-form'),'{$bw->input[0]}/visible-checked-obj/','');
					vsf.get('{$bw->input[0]}/display-obj-list/'+categoryId+'/','obj-panel');
				});
				
				$('#delete-objlist-bt').click(function() {
					if($('#checked-obj').val()=='') {
						jAlert(
							"{$vsLang->getWords('delete_obj_confirm_noitem', "You haven't choose any items to delete!")}",
							"{$bw->vars['global_websitename']} Dialog"
						);
						return false;
					}
					
					jConfirm(
						"{$vsLang->getWords('obj_delete_confirm', "Are you sure want to delete this {$bw->input[0]}?")}",
						"{$bw->vars['global_websitename']} Dialog",
						function(r) {
							if(r) {
							var categoryId ;
								$("#obj-category option:selected").each(function () {
									categoryId = $(this).val();
								});
								vsf.submitForm($('#obj-list-form'),'{$bw->input[0]}/delete-checked-obj/','obj-panel');
								vsf.get('{$bw->input[0]}/display-obj-list/'+ categoryId +'/','obj-panel');
							}
						}
					);
				});
			</script>
EOF;
	}

	function addEditObjForm($objItem, $option = array(),$access) {
		global $vsLang, $bw,$vsSettings;
		$BWHTML .= <<<EOF
			<div id="error-message" name="error-message"></div>
			<form id='add-edit-obj-form' name="add-edit-obj-form" method="POST"  enctype='multipart/form-data'>
				<input type="hidden" id="obj-cat-id" name="partnerCatId" value="{$option['categoryId']}" />
				<input type="hidden" name="partnerId" value="{$objItem->getId()}" />
				<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
					<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
						<span class="ui-dialog-title">{$option['formTitle']}</span>
					</div>
					<table class="ui-dialog-content ui-widget-content">
						<tr>
							<if="$vsSettings->getSystemKey($bw->input[0].'_title',1)">
							<td class="label_obj">{$vsLang->getWords('obj_title', 'Title')}:</td>
							<td><input size="43" type="text" name="partnerTitle" value="{$objItem->getTitle()}" id="obj-title"/></td>
							</if>
							<td align='left' rowspan="6">
							<if="$bw->vars[$bw->input[0].'_image']">
							{$objItem->createImageCache($objItem->getFileId(),250,150)}
								<p><a class="ui-state-default ui-corner-all" href="javascript:;" onclick="vsf.get('gallerys/display-file/{$objItem->getId()}','albumn')"> File Manager</a></p>
							</if>
							</td>
						</tr>
						<tr>
							<if="$vsSettings->getSystemKey($bw->input[0].'_adress',1)">
							<td class="label_obj">{$vsLang->getWords('obj_address', 'Address')}:</td>
							<td><input size="43" type="text" name="partnerAddress" value="{$objItem->getAddress()}" id="obj-address"/></td>
							</if>
						</tr>
						<tr>
							<if="$vsSettings->getSystemKey($bw->input[0].'_website',1)">
							<td class="label_obj">{$vsLang->getWords('obj_website', 'Website Name')}:</td>
							<td><input size="43" type="text" name="partnerWebsite" value="{$objItem->getWebsite()}" id="obj-website"/></td>
							</if>
						</tr>
						<tr>
							<if="$vsSettings->getSystemKey($bw->input[0].'_status',1)">
							<td class="label_obj">{$vsLang->getWords('obj_Status', 'Active')}:</td>
							<td>
								<input class='c_noneWidth' type="checkbox" name="partnerStatus" id="partnerStatus" {$objItem->getStatus()} value="1" style='margin-right:10px;'/>
								
								<if="$vsSettings->getSystemKey($bw->input[0].'_exptime',1)">
								{$vsLang->getWords('obj_exptime', 'Expire Time')}:&nbsp;&nbsp;<input size="4" type="text" name="partnerExpTime" value="{$objItem->getExpTime()}" id="obj-exptime"/>
								</if>
							</td>
							</if>
						</tr>
						<tr>
							<td class="label_obj">{$vsLang->getWords('obj_Index', 'Index')}:</td>
							<td>
								<if="$vsSettings->getSystemKey($bw->input[0].'_index',1)">
									<input size="4" type="text" name="partnerIndex" value="{$objItem->getIndex()}" id="obj-Index"/>
									&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
								</if>
								
								<if="$vsSettings->getSystemKey($bw->input[0].'_price',1)">
								{$vsLang->getWords('obj_price', 'Price')}:&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input size="14" type="text" name="partnerPrice" value="{$objItem->getPrice()}" id="obj-price"/>
								</if>
							</td>
						</tr>
						<tr >
							<if="$vsSettings->getSystemKey($bw->input[0].'_image',1)">
							<td class="label_obj">{$vsLang->getWords('obj_image_file', "File")}:</td>
							<td colspan="1">
								<div style="padding:2px 5px;">
									<input size="27" type="file" name="partnerIntroImage" id="partnerIntroImage"/> 
								</div>
							</td>
							</if>
						</tr>
						<if="$vsSettings->getSystemKey($bw->input[0].'_position',1)">
						<tr>
						    <td>{$vsLang->getWords('obj_Position', "Position")}</td>
						    <td>
						        <input type="checkbox" value="1" name="posTop" id="posTop" class="checkbox">
						        <label for="top">{$vsLang->getWords('global_top', "Top")}</label>
						        
						        <input type="checkbox" value="1" name="posRight" id="posRight" class="checkbox">
						        <label for="right">{$vsLang->getWords('global_right', "Right")}</label>
						        
						        <input type="checkbox" value="1" name="posCenter" id="posCenter" class="checkbox">
						        <label for="main">{$vsLang->getWords('global_center', "Center")}</label>
						        
						        <input type="checkbox" value="1" name="posBottom" id="posBottom" class="checkbox">
						        <label for="bottom">{$vsLang->getWords('global_bottom', "Bottom")}</label>
						        
						        <input type="checkbox" value="1" name="posLeft" id="posLeft" class="checkbox">
						        <label for="left">{$vsLang->getWords('global_left', "Left")}</label>
						    </td>
						</tr>
						</if>
						<if="$vsSettings->getSystemKey($bw->input[0].'_advanceDisplay',1)">
						<tr>
							<td class="label_obj">{$vsLang->getWords('obj_display', 'Advance Display')}:</td>
							<td colspan="2">
								<if="$access">
									<input type="checkbox" value="1" id="chooseAd" class="checkbox">
									<select style="width:250px;" id="partnerAccess" name="relAccess">
									<option value="-1">{$vsLang->getWords('display_link_all','Hiển thị toàn bộ website')}</option>
									<foreach="$access as $obj">
										<option value="{$obj->getId()}">{$obj->getAliasUrl()}</option>
									</foreach>
									</select>
									 <input type="text" size="34" value="Hoặc có thể copy link pass vào đây" name="txtLink">
								</if>
							</td>
						</tr>
						</if>
						<tr>
							<if="$vsSettings->getSystemKey($bw->input[0].'_intro',1)">
							<td class="label_obj">{$vsLang->getWords('obj_Intro', 'Intro')}:</td>
							<td colspan="3">{$objItem->getIntro()}</td>
							</if>
						</tr>
						<if="$vsSettings->getSystemKey($bw->input[0].'_content',1)">
						<tr>
							<td colspan="3" align="center">{$objItem->getContent()}</td>
						</tr>
						</if>
						<tr>
							<td class="ui-dialog-buttonpanel" colspan="3" align="center">
								<input type="submit" name="submit" value="{$option['formSubmit']}" />
							</td>
						</tr>
					</table>
				</div>
			</form>
			<script language="javascript">
				function updateobjListHtml(categoryId){
					vsf.get('{$bw->input[0]}/display-obj-list/'+categoryId+'/','obj-panel');
				}
				function alertError(message){
					jAlert(
						message,
						'{$bw->vars['global_websitename']} Dialog'
					);
				}
				$(window).ready(function() {
					<if="$option['access']">
					<foreach="$option['access'] as $array">
						vsf.jSelect('{$array['relId']}','partnerAccess');
					</foreach>
					</if>
					vsf.jCheckbox('{$objItem->getStatus()}','partnerStatus');
					vsf.jCheckbox('{$objItem->top}','posTop');
					vsf.jCheckbox('{$objItem->right}','posRight');
					vsf.jCheckbox('{$objItem->bottom}','posBottom');
					vsf.jCheckbox('{$objItem->center}','posCenter');
					vsf.jCheckbox('{$objItem->left}','posLeft');
				});
				$('#partnerIntroImage').change(function() {
					var img_name = '<input type="hidden" id="image-name" name="image-name" value="'+$(this).val() +'"/>';
					$('#td-obj-image').html(img_name);
				});
				$('#add-edit-obj-form').submit(function(){
					var flag  = true;
					var error = "";
					var categoryId;
					var count=0;
					$("#obj-category option:selected").each(function () {
						categoryId = $(this).val();
						count=1;
					});
					$('#obj-cat-id').val(categoryId);
					
					if(categoryId == null && count){
						error = "<li>{$vsLang->getWords('not_select_category', 'Vui lòng chọn category!!!')}</li>";
						flag  = false;
					}
					
					var title = $("#obj-title").val();
					if(title == null || title == ""){
						error += "<li>{$vsLang->getWords('null_title', 'Tiêu đề không được để trống!!!')}</li>";
						flag  = false;
					}
					
					if(!flag){
						error = "<ul class='ul-popu'>" + error + "</ul>";
						alertError(error);
						return false;
					}
					
					vsf.uploadFile("add-edit-obj-form", "{$bw->input[0]}", "add-edit-obj-process", "obj-panel","{$bw->input[0]}");
					return false;
				});
				
			</script>
EOF;
	}

	function categoryList($categoryGroup = array()) {
		global $vsLang, $bw;
		$BWHTML .= <<<EOF
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all">
				<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
					<span class="ui-icon ui-icon-triangle-1-e"></span>
					<span class="ui-dialog-title">{$vsLang->getWords('category_table_title_header','Categories')}</span>
				</div>
				<table width="100%" cellpadding="0" cellspacing="1">
					<tr>
				    	<th id="obj-category-message" colspan="2">{$data['message']}{$vsLang->getWords('category_chosen',"Selected categories")}: {$vsLang->getWords('category_not_selected',"None")}</th>
				    </tr>
				    <tr>
				        <td width="220">
				       		<select size="18" style="width: 100%;" id="obj-category">
				        		<option value="0">{$vsLang->getWords('menus_option_root',"Root")}</option>
				        		<if="count($categoryGroup->getChildren())"
				        		<foreach="$categoryGroup->getChildren() as $oMenu">
				        		<option title="{$oMenu->getAlt()}" value="{$oMenu->id}">| - - {$oMenu->title} ({$oMenu->getIndex()} - $oMenu->id)</option>
				        		</foreach>
				        	</select>
				        </td>
				    	<td align="center">
				        	<a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:;" id="view-obj-bt" title='{$vsLang->getWords('view_list_in_cat',"Click here to edit this {$bw->input[0]}")}'>{$vsLang->getWords('global_view','Xem')}</a>
				    		<a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:;" id="add-obj-bt" title='{$vsLang->getWords('add_object_for_cat',"Click here to add this {$bw->input[0]}")}'>{$vsLang->getWords('global_add','Thêm')}</a>
				        </td>
					</tr>
				</table>
			</div>
			
			<script type="text/javascript">
				$('#view-obj-bt').click(function() {
					var categoryId = '';
					$("#obj-category option:selected").each(function () {
						categoryId = $(this).val();
					});
					vsf.get('{$bw->input[0]}/display-obj-list/'+categoryId+'/','obj-panel');
				});
				
				$('#add-obj-bt').click(function(){
					var categoryId = '';
					$("#obj-category option:selected").each(function () {
						categoryId=$(this).val();
					});
					
					$("#idCategory").val(categoryId);
				
					vsf.get('{$bw->input[0]}/add-edit-obj-form/', 'obj-panel');
				});
				
				var parentId = '';
				$('#obj-category').change(function() {
					var currentId = '';
					var parentId = '';
					$("#obj-category option:selected").each(function () {
						currentId += $(this).val() + ',';
						parentId = $(this).val();
					});
										
					currentId = currentId.substr(0, currentId.length-1);
					$("#obj-category-message").html('{$vsLang->getWords('category_chosen',"Selected categories")}:'+currentId);
					$('#obj-cat-id').val(parentId);
				});
			</script>
EOF;
	}

	function displayObjTab($option) {
		global $bw,$vsSettings;
		$BWHTML .= <<<EOF
		<if="$vsSettings->getSystemKey($bw->input[0].'_Category_tab',1)">
	        <div class='left-cell'><div id='category-panel'>{$option['categoryList']}</div></div>
			<input type="hidden" id="idCategory" name="idCategory" />
			<div id="obj-panel" class="right-cell">{$option['objList']}</div>
			<div class="clear"></div>
			<else />
			<input type="hidden" id="idCategory" name="idCategory" />
			<div id="obj-panel" style="width:100%" class="right-cell">{$option['objList']}</div>
			<div class="clear"></div>
        </if>
			
EOF;
		return $BWHTML;
	}

	function managerObjHtml() {
		global $bw, $vsLang,$vsSettings;
		$BWHTML .= <<<EOF
			<div id="page_tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all-top">
				<ul id="tabs_nav" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner">
			    	<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
			        	<a href="{$bw->base_url}{$bw->input[0]}/display-obj-tab/&ajax=1"><span>{$vsLang->getWords('tab_obj_objes',"{$bw->input[0]}")}</span></a>
			        </li>
					 <if="$vsSettings->getSystemKey($bw->input[0].'_category_tab',1)">
						<li class="ui-state-default ui-corner-top">
				        	<a href="{$bw->base_url}menus/display-category-tab/{$bw->input[0]}/&ajax=1"><span>{$vsLang->getWords('global_categories','Categories')}</span></a>
				        </li>
			        </if>
			        <if="$vsSettings->getSystemKey($bw->input[0].'_setting_tab',1)">
				        <li class="ui-state-default ui-corner-top">
				        	<a href="{$bw->base_url}systemsettings/display-setting-tab/{$bw->input[0]}/&ajax=1">
								<span>{$vsLang->getWords("tab_{$bw->input[0]}_SS",'System Settings')}</span>
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