<?php
class skin_products extends skin_objectadmin{

	function objListHtml($objItems = array(), $option = array()) {
		global $bw, $vsLang, $vsSettings, $vsSetting, $tableName, $vsUser,$langObject;
		$BWHTML .= <<<EOF
		
			<div class="red">{$option['message']}</div>
			<input type="hidden" name="checkedObj" id="checked-obj" value="" />
			<input type="hidden" name="categoryId" value="{$option['categoryId']}" id="categoryId" />
			<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
                            <div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
                            <span class="ui-icon ui-icon-note"></span>
                            <span class="ui-dialog-title">{$vsLang->getWords('list_item','List item')}</span>
                            <if="$option['subbreadcumbs']"><span class='ui-dialog-title' style='margin-left: 10px;'>[{$option['subbreadcumbs']}]</span></if>
                            <if=" $vsSettings->getSystemKey($bw->input[0].'_search_function', 0, $bw->input[0]) ">
					        	<span id="search-bt" style='align:right; float: right; color: #FFFFFF; cursor: pointer;'>{$vsLang->getWords('obj_search', 'Search')}</span>
					        	<script>
                            	$('#search-bt').click(function(){
									$("#search-form").animate({"height": "toggle"}, { duration: 1000 });
								});
								</script>
					        </if>
                            </div>
                            {$this->searchForm()}
                            <if=" $vsSettings->getSystemKey($bw->input[0].'_add_hide_show_delete',1, $bw->input[0]) ">
                                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner ui-widget-header">
                                    <li class="ui-state-default ui-corner-top" id="add-objlist-bt"><a href="#" title="{$langObject['itemListAdd']}">{$vsLang->getWords('add_item','Add item')}</a></li>
                                    <li class="ui-state-default ui-corner-top" id="hide-objlist-bt"><a href="#" title="{$langObject['itemListHide']}">{$langObject['itemListHide']}</a></li>
                                    <li class="ui-state-default ui-corner-top" id="visible-objlist-bt"><a href="#" title="{$langObject['itemListVisible']}">{$langObject['itemListVisible']}</a></li>
                                    <if=" $vsSettings->getSystemKey($bw->input[0].'_home',0, $bw->input[0]) ">
                                       <li class="ui-state-default ui-corner-top" id="home-objlist-bt"><a href="#" title="{$langObject['itemListHome']}">{$langObject['itemListHome']}</a></li>
                                    </if>
                                    <if=" $vsSettings->getSystemKey($bw->input[0].'_banchay',0, $bw->input[0]) ">
                                       <li class="ui-state-default ui-corner-top" id="banchay-objlist-bt"><a href="#" title="{$vsLang->getWords("obj_banchay","Bán chạy")}">{$vsLang->getWords("obj_banchay","Bán chạy")}</a></li>
                                    </if>
                                    <li class="ui-state-default ui-corner-top" id="delete-objlist-bt"><a href="#" title="{$langObject['itemListDelete']}">{$langObject['itemListDelete']}</a></li>
                                    <if="$vsSettings->getSystemKey($bw->input[0].'_category_list',1, $bw->input[0])">
                                    <li class="ui-state-default ui-corner-top" id="change-objlist-bt"><a href="#" title="{$langObject['itemListChangeCate']}">{$langObject['itemListChangeCate']}</a></li>
                                    </if>
                                    <if="$vsSettings->getSystemKey($bw->input[0].'_search_list',0, $bw->input[0])">
                                    <li class="ui-state-default ui-corner-top" id="insertSearch-objlist-bt"><a href="#" title="{$langObject['itemListInsertSearch']}">{$langObject['itemListInsertSearch']}</a></li>
                                    </if>
                                    <if=" $vsSettings->getSystemKey($bw->input[0].'_order_function', 0, $bw->input[0]) ">
                                    <li>
                                    	<select id='order' name='order' style='padding: 3px;border: 1px solid #A8211D;'>
                                    		<option value='0'>{$vsLang->getWords('order_0','Chọn cách sắp xếp')}</option>
                                    		<option value='1'>{$vsLang->getWords('order_1','Sản phẩm đang ẩn lên đầu')}</option>
                                    		<option value='2'>{$vsLang->getWords('order_2','Sản phẩm đang hiện lên đầu')}</option>
                                    		<option value='3'>{$vsLang->getWords('order_3','Sản phẩm mới nhất lên đầu')}</option>
                                    	</select>
                                    </li>
                                    </if>
								</ul>
							</if>
							<script>
								vsf.jSelect('{$option['order']}', 'order');
								
								$('#order').change(function(){
									vsf.get('{$bw->input[0]}/reorder/'+$(this).val()+'/&pcategory={$option['categoryId']}', 'obj-panel');
									return false;
								});
							</script>
					<table cellspacing="1" cellpadding="1" id='objListHtmlTable' width="100%">
						<thead>
						    <tr>
						        <th width="10"><input type="checkbox" onclick="vsf.checkAll()" onclicktext="vsf.checkAll()" name="all" /></th>
						        <th width="60">{$langObject['itemListActive']}</th>
						        <th>{$langObject['itemListTitle']}</td>
						        <th width="30">{$langObject['itemListIndex']}</th>
						        <if=" $vsSettings->getSystemKey($bw->input[0].'_option', 0, $bw->input[0], 1, 1) ">
						        <th width="80" align="center">{$langObject['itemListAction']}</th>
						        </if>
						    </tr>
						</thead>
						<tbody>
							<foreach="$objItems as $obj">
								<tr class="$vsf_class">
									<td align="center">
                                    	<if="!$vsSettings->getSystemKey($bw->input[0].'_code',0) && $obj->getCode()">
                                        	<img src="{$bw->vars['img_url']}/disabled.png" />
                                      	<else />
										<input type="checkbox" onclicktext="vsf.checkObject();" onclick="vsf.checkObject();" name="obj_{$obj->getId()}" value="{$obj->getId()}" class="myCheckbox" />
                                     	</if>
									</td>
									<td style='text-align:center'>{$obj->getStatus('image')}
									</td>
									
									<td>
										<a href="javascript:vsf.get('{$bw->input[0]}/add-edit-obj-form/{$obj->getId()}/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}','obj-panel')"  class="editObj" >
										{$obj->getTitle()}
										</a>
									</td>
									<td>{$obj->getIndex()}</td>
									<if=" $vsSettings->getSystemKey($bw->input[0].'_option', 0,$bw->input[0], 1, 1) ">
									<td>
										{$this->addOtionList($obj,$option['modulecomment'])}
									</td>
									</if>
								</tr>
							</foreach>
						</tbody>
						<tfoot>
							<tr>
								<th colspan='5'>
									<div style='float:right;'>{$option['paging']}</div>
								</th>
							</tr>
							
							<tr>
								<th colspan='6' align="left">
                                                      <span style="padding-left: 10px;line-height:16px;"><img src="{$bw->vars['img_url']}/enable.png" /> {$langObject['itemListCurrentShow']}</span>
                                                      <span style="padding-left: 10px;line-height:16px;"><img src="{$bw->vars['img_url']}/disabled.png" /> {$langObject['itemListNotShow']}</span>
                                                       <if=" $vsSettings->getSystemKey($bw->input[0].'_home',0, $bw->input[0]) ">
                                                            <span style="padding-left: 10px;line-height:16px;"><img src="{$bw->vars['img_url']}/home.png" /> {$langObject['itemListHomeShow']}</span>
                                                      </if>
                                                      <if=" $vsSettings->getSystemKey($bw->input[0].'_banchay',0, $bw->input[0]) ">
                                                            <span style="padding-left: 10px;line-height:16px;"><img src="{$bw->vars['img_url']}/special.gif" /> {$vsLang->getWords("obj_banchay","Bán chạy")}</span>
                                                      </if>
                                                      </th>
                                                </tr>
						</tfoot>
					</table>
				</div>
			<div class="clear" id="file"></div>
			<div id='commentList'></div>
			{$this->addJavaScript()}
EOF;
	}
	
	function preset_products() {
            global $vsLang, $bw,$vsSettings,$langObject;
            
            $BWHTML .= <<<EOF
            	<table class='presetcontent' style='width: 100%'>
            		<tr>
            			<td width='100px'>{$vsLang->getWords('product_code', 'Mã sản phẩm')}</td>
            			<td>&nbsp;</td>
            		</tr>
            		<tr>
            			<td width='100px'>{$vsLang->getWords('product_material', 'Chất liệu')}</td>
            			<td>&nbsp;</td>
            		</tr>
            		<tr>
            			<td width='100px'>{$vsLang->getWords('product_color', 'Màu sắc')}</td>
            			<td>&nbsp;</td>
            		</tr>
            		<tr>
            			<td width='100px'>{$vsLang->getWords('product_size', 'Kích thước')}</td>
            			<td>&nbsp;</td>
            		</tr>
            		<tr>
            			<td width='100px'>{$vsLang->getWords('product_xuatxu', 'Xuất xứ')}</td>
            			<td>&nbsp;</td>
            		</tr>
            	</table>
EOF;
            return $BWHTML;
	}
	
	function addEditObjForm($objItem, $option = array()) {
		global $vsLang, $bw,$vsSettings,$tableName,$langObject,$vsPrint;
		
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
	               	<input type="hidden" name="{$tableName}Module" value="{$bw->input['module']}" />
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
							<td class="label_obj" width="75">{$vsLang->getWords('global_Title',"Tên sản phẩm")}:</td>
							<td colspan="3">
								<input style="width:100%;" name="{$tableName}Title" value="{$objItem->getTitle()}" id="obj-title"/>
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
						<if="$vsSettings->getSystemKey($bw->input[0].'_price',0, $bw->input[0])">
						<tr class='smalltitle'>
							<td class="label_obj"  width="75">
								{$langObject['itemObjPrice']}:
							</td>
							<td colspan="3">
								<input style="width:40" name="{$tableName}Price" value="{$objItem->getPrice()}"/>
							</td>
						</tr>
						</if>
						<if="$vsSettings->getSystemKey($bw->input[0].'_hotprice',0, $bw->input[0])">
						<tr class='smalltitle'>
							<td class="label_obj"  width="75">
								{$langObject['itemObjHotPrice']}:
							</td>
							<td colspan="3">
								<input style="width:40" name="{$tableName}HotPrice" value="{$objItem->getHotPrice()}"/>
							</td>
						</tr>
						</if>
						<tr class='smalltitle'>
							<td class="label_obj"  width="75">
								{$langObject['itemObjIndex']}:
							</td>
							<td width="170" colspan="3">
								<input size="10" class="numeric" name="{$tableName}Index" value="{$objItem->getIndex()}" />
							</td>
						</tr>
						<tr class='smalltitle'>
							<td class="label_obj"  width="75">
								{$langObject['itemObjStatus']}:
							</td>
							<td width="170" colspan="3">
                               	<label>{$langObject['itemObjDisplay']}</label>
								<input name="{$tableName}Status" id="{$tableName}Status1" value='1' class='c_noneWidth' type="radio" checked />

								<label>{$langObject['itemListHide']}</label>
								<input name="{$tableName}Status" id="{$tableName}Status0" value='0' class='c_noneWidth' type="radio" />
								
								<if=" $vsSettings->getSystemKey($bw->input[0].'_home',0, $bw->input[0]) ">
								<label>{$langObject['itemListHome']}</label>
								<input name="{$tableName}Status" id="{$tableName}Status2" value='2' class='c_noneWidth' type="radio" />
								</if>
								<if=" $vsSettings->getSystemKey($bw->input[0].'_banchay',0, $bw->input[0]) ">
								<label>{$vsLang->getWords("obj_banchay","Bán chạy")}</label>
								<input name="{$tableName}Status" id="{$tableName}Status3" value='3' class='c_noneWidth' type="radio" />
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
						<tr class='smalltitle'>
							
							<td colspan="3">
								{$objItem->createImageCache($objItem->getImage(), 250, 200)}
								<br/>
								<if=" $objItem->getImage() && $vsSettings->getSystemKey($bw->input[0].'_image_delete',1, $bw->input[0]) ">
								<input type="checkbox" name="deleteImage" id="deleteImage" />
								<label for="deleteImage">{$langObject['itemObjDeleteImage']}</lable>
								</if>
							</td>
						</tr>
						</if>
						<if=" $vsSettings->getSystemKey($bw->input[0].'_urlvideo',0, $bw->input[0]) ">
						<tr class='smalltitle'>
							<td class="label_obj"  width="75">
								{$vsLang->getWords("obj_url","Url video")}:
							</td>
							<td colspan="3">
								<input style="width:100%;" name="{$tableName}UrlVideo" value="{$objItem->getUrlVideo()}"/>
							</td>
						</tr>
						</if>
						<tr class='smalltitle'>
							<td width="75">{$vsLang->getWords('obj_brand', 'Thương hiệu')}:</td>
							<td colspan="3">
	                        	
	                           	{$this->brandList($option)}
	                         	
	                       	</td>
						</tr>                        
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
						<if="$vsSettings->getSystemKey($bw->input[0].'_tags',0, $bw->input[0])">
						<tr class='smalltitle' >
							<td class="label_obj"  width="75">
								Tags:
							</td>
							<td colspan="3" valgin="left">
								<div id="tag_panel_diplay">
								<script src='{$bw->base_url}tags/get_tag_for_obj/{$bw->input[0]}/{$objItem->getId()}'>
								</script>
								</div>
							</td>
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
				$(window).ready(function(){
					$('#obj-category option').each(function(){
						$(this).removeAttr('selected');
					});
					$("input.numeric").numeric();
					checkedLinkFile();
					vsf.jRadio('{$objItem->getStatus()}','{$tableName}Status');
					vsf.jSelect('{$objItem->getCatId()}','obj-category');
				
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
	
	function addOtionList_listcolor($obj) {
 	global $vsLang, $bw,$vsSettings,$tableName,$opt;
       	$this->array = array();
    	if($obj->getColor())
        	$this->array = explode(",", $obj->getColor()); 
        
        	$BWHTML .= <<<EOF
                <foreach="$opt['color'] as $k => $color">
                    <if="in_array($k,$this->array)">
                    <a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:;" onclick="vsf.popupGet('gallerys/display-album-tab/{$bw->input[0]}/{$obj->getId()}&albumCode={$color->getColorTitle()}_{$k}','albumn')">
                            {$color->getTitle()}
                    </a>
                    </if>
                </foreach>
               
EOF;
            return $BWHTML;
        }
        
	function brandList($option) {
		global $vsLang, $bw,$opt;

		$BWHTML .= <<<EOF
		<style>
		.colorhide{
			display:none;
		}
		.colorshow{
			display:block;
		}
		.brand{
		border : 1px solid #999;
		}
		</style>
		<select  id="brand" name="productBrand" class="brand">
			<option value="0">--- chọn Thương hiệu ----</option>
			<foreach="$opt['brand'] as $key => $obj">
			<option value="$key" <if="$key == $option['bra']"> selected </if>>{$obj->getTitle()}</option>
			</foreach>
		</select>
		<script type="text/javascript">
		$('#brand').change(function() {
		var str =$(this).val();
		$('.colorshow').addClass('colorhide');
		$('.colorshow').removeClass('colorshow');
		$("#brand"+str).addClass('colorshow');
		});
		$("#brand  option").each(function () {
			var str =$(this).val();
        	if($(this).attr('selected')){
        	$('.colorshow').addClass('colorhide');
			$('.colorshow').removeClass('colorshow');
			$("#brand"+str).addClass('colorshow');
			}
		});
		</script>
		
		<foreach="$opt['brand'] as $key => $obj">
             	<if="$obj->list">
             	<div class="colorhide" id="brand{$key}" >
				<foreach="$obj->list as $k1 => $item">
					<p>
						<input type="checkbox"  value="{$k1}" <if="in_array($k1,$option['co'])"> checked </if> id="productColor{$item->getId()}"  name="productColor[{$key}][{$k1}]"  >
						{$item->createImageCache($item->file,12,11,1)} &nbsp;<span>{$item->getTitle()}</span>
					</p>
				</foreach>
				</div>
           		</if>
			
		</foreach>
				
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
				        <span class="ui-dialog-title">
						{$vsLang->getWords('product_opt_title',"Danh sách các loại")}
						</span>
						
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
	
	function advanceTab($option) {
		global $bw, $vsSettings,$vsPrint;
		$vsPrint->addCSSFile ( 'products' );
		$BWHTML .= <<<EOF
			<div id="obj-panel" class="right-cell" style="width:100%;">
				{$option['objList']}
			</div>
			<div class="clear"></div>
EOF;
		return $BWHTML;
	}
	
	function filterList($option = array()) {
		global $bw, $vsLang, $vsSettings, $vsUser;

		$note1 = $vsLang->getWords('file_not_match','Vui lòng chọn file excel 2003 [.xls] để import !!!');
		$BWHTML .= <<<EOF
			
				<div class="red">{$option['message']}</div>
				<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
					<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
						<span class="ui-icon ui-icon-note"></span>
						
						<form id="obj-list-form" name="objlistform" method="post" enctype='multipart/form-data' >
								<div class="import_file" style="float:right; padding-right: 5px;" style="width:600px;">
								
								<a href='{$bw->vars['board_url']}/uploads/sample/import_data_sample.xls' style='color: #FFF;' title='{$vsLang->getWords('download_sample_file','Sample file')}'>
									[{$vsLang->getWords('download_sample_file',"Sample file")}]
								</a>
								<label>{$vsLang->getWords('obj_import_file_Title',"Import file")}</label>
								<input type="file" name="file_document" id="file_document" />
								<input id="buttonImport" name="buttonImport" type="button" value="{$vsLang->getWords('obj_submit_file_Title',"Import")}" />
								
							</div>
							<div class="clear"></div>
						</form>
						
						<script type="text/javascript">
							$(document).ready(function(){
								$("#buttonImport").click(function(){
									vsf.uploadFile("obj-list-form", "products", "import", "importcb", "imports");
								});
							});
						</script>
					</div>
					<div class="clear"></div>
					<div id='importcb' style='margin: 10px 10px 0px 10px;'></div>
					<div id='filter-container'>
						<form id='filterForm' method='post'>
							<div class='tr header'>
								<div class='cbox'>
								<input type='checkbox' name='fieldcheckall' id='fieldcheckall' value='1' />
								</div>
								<div class='fieldname' id='showFieldList'>
									{$vsLang->getWords('export_fields','Mục cần xuất ra exel')}
								</div>
								<div class='clear'></div>
							</div>
							<if=" $option['field'] ">
                            <div id="filterForm_content">
							<foreach=" $option['field'] as $key=>$field">
								<div class='tr field_tr'>
									<div class='cbox'>
									<input name='fields[{$key}]' value='{$key}' type='checkbox' />
									</div>
									<div class='fieldname'>
										{$field}
									</div>
									<div class='clear'></div>
								</div>
							</foreach>
                                                                                </div>
							</if>
                                                                                <div class="clear"></div>
							<div class='submit'>
								<!--<input type='button' id='criteriago' name='isumbit' value='{$vsLang->getWords('field_filter','Lọc dữ liệu')}' />-->
								<input type='button' id='exportgo' name='isumbit' value='{$vsLang->getWords('field_export','Xuất dữ liệu')}' />
								<input type='button' id='exportallgo' name='exportallgo' value='{$vsLang->getWords('field_exportall','Xuất tất cả thông tin dữ liệu')}' />
							</div>
						</form>
						
						<div id='filter-criterion'></div>
						<div class='clear'></div>
						
						<script type='text/javascript'>
							$(document).ready(function(){
								$('#showFieldList').click(function(){
									$('#filterForm_content').animate({
										height: 'toggle'
									});
								});
								$('#fieldcheckall').click(function(){
									var checked = $(this).attr('checked');
									$("#filterForm input[type=checkbox]").each(function(){
										this.checked = checked;
									});
								});
							});
							$('#criteriago').click(function(){
								vsf.submitForm($('#filterForm'), 'products/criteria/', 'filter-criterion');
							});
							var flagajax = false;
							$('#exportgo').click(function(){
								if(flagajax){
									vsf.submitForm($('#filterForm'), 'products/export/', 'filterdata');
									return false;
								}
								
								$('#filterForm').append($('#pForm').children());
								$('#filterForm').attr('action','{$bw->base_url}products/export/');
								$('#filterForm').submit();
								return true;
							});
							
							$('#exportallgo').click(function(){
								$('#fieldcheckall').checked = true;
								$("#filterForm input[type=checkbox]").each(function(){
									this.checked = true;
								});

								if(flagajax){
									vsf.submitForm($('#filterForm'), 'products/export/', 'filterdata');
									return false;
								}
								
								$('#filterForm').append($('#pForm').children());
								$('#filterForm').attr('action','{$bw->base_url}products/export/');
								$('#filterForm').submit();
								return true;
								
							});
						</script>
					</div>
					
					<div id='filterdata'></div>
				</div>
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
			        
			        <if="$vsSettings->getSystemKey($bw->input[0].'_setting_tab',0, "{$bw->input[0]}", 1, 1)">
				        <li class="ui-state-default ui-corner-top">
				        	<a href="{$bw->base_url}settings/moduleObjTab/{$bw->input[0]}/&ajax=1">
								<span>Settings</span>
							</a>
			        	</li>
		        	</if>
		        	<if="$vsSettings->getSystemKey($bw->input[0].'_advance_tab',0, "{$bw->input[0]}", 1, 1)">
		        	<li class="ui-state-default ui-corner-top">
			        	<a href="{$bw->base_url}products/advance/&ajax=1"><span>{$vsLang->getWords('tab_obj_advance','Nâng cao')}</span></a>
			        </li>
			        </if>
				</ul>
			</div>
EOF;
		return $BWHTML;
	}
}
?>