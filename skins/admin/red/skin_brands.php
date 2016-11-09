<?php
class skin_brands extends skin_objectadmin{

	function addEditObjForm($objItem, $option = array()) {
		global $vsLang, $bw,$vsSettings,$tableName,$langObject;
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
							<td class="label_obj" width="75">{$langObject['itemListTitle']}:</td>
							<td colspan="3">
								<input style="width:100%;" name="{$tableName}Title" value="{$objItem->getTitle()}" id="obj-title"/>
							</td>
						</tr>

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
								{$langObject['itemObjStatus']}
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
							</td>
						</tr>
						<if="$vsSettings->getSystemKey($bw->input[0].'_image',1, $bw->input[0])">
						<tr class='smalltitle'>
							<td class="label_obj">
								{$langObject['itemObjFile']}:
							</td>
							<td>
								<input size="27" type="file" name="{$tableName}IntroImage" id="{$tableName}IntroImage" /><br />
								 {$vsSettings->getSystemKey($bw->input[0]."_image_timthumb_size","(size:100x100px)", $bw->input[0])}
							</td>
							<td colspan="2">
								{$objItem->createImageCache($objItem->getImage(), 100, 50)}
								<br/>
								<if=" $objItem->getImage() && $vsSettings->getSystemKey($bw->input[0].'_image_delete',1, $bw->input[0]) ">
								<input type="checkbox" name="deleteImage" id="deleteImage" />
								<label for="deleteImage">{$langObject['itemObjDeleteImage']}</lable>
								</if>
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
				$(window).ready(function() {
                     		$('#obj-category option').each(function(){
							$(this).removeAttr('selected');
						});
					$("input.numeric").numeric();
					checkedLinkFile();
					vsf.jRadio('{$objItem->getStatus()}','{$tableName}Status');
					vsf.jSelect('{$objItem->getCatId()}','obj-category');
				
				});
				
				
				
				$('#{$tableName}IntroImage').change(function() {
					var img_name = '<input type="hidden" id="image-name" name="image-name" value="'+$(this).val() +'"/>';
					$('#td-obj-image').html(img_name);
				});
				
				
				
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

	
}
?>