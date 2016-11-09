<?php
/**
 * @author Sanh Nguyen
 * @version 1.0 RC
 */
class skin_gallerys {
	
	function loadDefault() {
		global $bw, $vsLang,$vsSettings;
		
		$BWHTML .= <<<EOF
			<div id="page_tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all-top">
				<ul id="tabs_nav">
					<li>
						<a href="{$bw->base_url}gallerys/display-gallery-tab/&ajax=1">
							<span>{$vsLang->getWords('tab_gallery','Gallery')}</span>
						</a>
					</li>
				<if="$vsSettings->getSystemKey($bw->input[0].'_category_tab',1)">
				    <li>
					    <a href="{$bw->base_url}menus/display-category-tab/gallery/&ajax=1">
					    	<span>{$vsLang->getWords('tab_gallery_categories','Categories')}</span>
					    </a>
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
	
	function catagoryList($category) {
		global $vsLang, $bw;
		
		$BWHTML .= <<<EOF
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all">
				<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
					<span class="ui-icon ui-icon-triangle-1-e"></span>
					<span class="ui-dialog-title">{$vsLang->getWords('category_table_title_header','Categories')}</span>
				</div>
				<table width="100%" cellpadding="0" cellspacing="1">
					<tr>
				    	<th id="discover-category-message" colspan="2">{$vsLang->getWords('category_chosen',"Selected categories")}: {$vsLang->getWords('category_not_selected',"None")}</th>
				    </tr>
				    <tr>
				        <td width="220">
				        {$category}
				        </td>
				    	<td align="center">
				        	<img src="{$bw->vars['img_url']}/view.png" alt="{$vsLang->getWords('view_news_bt',"View news")}" id="view-gallery-bt" />
				            <img src="{$bw->vars['img_url']}/add.png" align="{$vsLang->getWords('add_news_bt',"Add news")}" id="add-gallery-bt" />
				        </td>
					</tr>
				</table>
			</div>
			<script type="text/javascript">
				$('#view-gallery-bt').click(function(){
					var categoryId = '';
					$("#gallery-category option:selected").each(function () {
						categoryId=$(this).val();
					});
					if(categoryId==0){
						jAlert(
		        			'{$vsLang->getWords('gallery_category_empty','Vui lòng chọn danh mục!')}',
		        			'{$bw->vars['global_websitename']} Dialog'
	        			);
						$('#gallery-category').addClass('ui-state-error ui-corner-all-inner');
						return false;
					}
					$('#gallery-category').removeClass('ui-state-error ui-corner-all-inner');
					vsf.get('gallerys/display-album-list/'+categoryId, 'gallery-panel');
				});
				$('#add-gallery-bt').click(function(){
					var categoryId = '';
					$("#gallery-category option:selected").each(function () {
						categoryId=$(this).val();
					});
					if(categoryId==0){
						jAlert(
		        			'{$vsLang->getWords('gallery_category_empty','Vui lòng chọn danh mục!')}',
		        			'{$bw->vars['global_websitename']} Dialog'
	        			);
						$('#gallery-category').addClass('ui-state-error ui-corner-all-inner');
						return false;
					}
					$('#gallery-category').removeClass('ui-state-error ui-corner-all-inner');
					vsf.get('gallerys/add-album-form/'+categoryId, 'gallery-panel');
				});
				var parentId = '';
				var cateId	=	'';
				$('#gallery-category').change(function() {
					var currentId = '';
					$("#gallery-category option:selected").each(function () {
						currentId += $(this).val() + ',';
						cateId = $(this).val();
					});
										
					currentId = currentId.substr(0, currentId.length-1);
					$("#gallery-category-message").html('{$vsLang->getWords('category_chosen',"Selected categories")}:'+currentId);
					$('#cate-Id').val(cateId);
				});
			</script>
EOF;
	}

	function displayMain($option){
		global $vsSettings,$bw;
		$class = " ";
		if($vsSettings->getSystemKey($bw->input[0].'_category_tab',1))
			$class = "right-cell";
		$BWHTML .= <<<EOF
			<if="$vsSettings->getSystemKey($bw->input[0].'_category_tab',1)">
			<div class='left-cell'><div id='category-panel'>{$option['categoryList']}</div></div>
				
			</if>
			<div id="gallery-panel" class="$class">{$option['galleryAlbum']}</div>
EOF;
		return $BWHTML;
	}
	
	function addEditAlbumFrom($albumItem,$option){
		global $vsLang,$bw,$vsSettings;
		$BWHTML .= <<<EOF
			<div id="error-message" name="error-message"></div>
			<form id='addEditForm' name="addEditForm" method="POST" enctype='multipart/form-data'>
				<input type="hidden" name="galleryCatId" value="{$albumItem->getCatId()}" id="cate-Id" />
				<input type="hidden" name="galleryId" value="{$albumItem->getId()}" id="galleryId" />
				<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
					<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
						<span class="ui-dialog-title">{$option['formTitle']}</span>
					</div>
					
					<table class="ui-dialog-content ui-widget-content">
						<if="$vsSettings->getSystemKey($bw->input[0].'_title',1)">
							<tr>
								<td class="label_news" style="width:78px;">{$vsLang->getWords('gallery_title', 'Tên album')}:</td>
								<td><input size="35" type="text" name="galleryAlbum" value="{$albumItem->getTitle()}" id="galleryAlbum"/></td>
							</tr>
						</if>
						<if="$vsSettings->getSystemKey($bw->input[0].'_Index',1)">
							<tr>
								<td class="label_news">{$vsLang->getWords('gallery_Index', 'Index')}:</td>
								<td><input size="15" type="text" name="galleryIndex" value="{$albumItem->getIndex()}" class="numeric"/></td>
							</tr>
							</if>
							
						<if="$vsSettings->getSystemKey($bw->input[0].'_password',1)">
							<tr>
								<td class="label_news">{$vsLang->getWords('gallery_password',"Mật khẩu")}</td>
								<td><input size="15" type="password" name="galleryPassWord" value="" /></td>
							</tr>
						</if>
						<if="$vsSettings->getSystemKey($bw->input[0].'_status',1)">
							<tr>
								<td class="label_news">{$vsLang->getWords('gallery_status',"Status")}</td>
								<td colspan="3">
									<input type="radio" name="galleryStatus" value="0" id="galleryStatus_last" class="checkbox">
					            	<label for = "galleryStatus_last">{$vsLang->getWords('gallery_hides','ẩn')}</label>&nbsp;&nbsp;
									<input type="radio" name="galleryStatus" value="1" id="galleryStatus_fist" class="checkbox">
									<label for = "galleryStatus_fist">{$vsLang->getWords('gallery_active','Hiển thị')}</label>&nbsp;&nbsp;
								</td>
							</tr>
						</if>
						<if="$vsSettings->getSystemKey($bw->input[0].'_Intro',1)">
							<tr >
								<td class="label_area">{$vsLang->getWords('area_Intro', 'Intro')}:</td>
								<td  colspan='2'>{$albumItem->getIntro()}</td>
							</tr>
						</if>
						<if="$vsSettings->getSystemKey($bw->input[0].'_Images',1)">
							<tr >
								<td class="label_area" style="vertical-align:top">{$vsLang->getWords('gallery_image', 'Hình ảnh ')}:</td>
								<td style="vertical-align:top"><input  type="file" name="fileType" id="fileType" /></td>
								<div style="float:right; border: 1px solid;" id="td-obj-image">{$albumItem->createImageCache($albumItem->getImage(),125,125)}</div>
							</tr>
						</if>
						<tr>
							<td class="ui-dialog-buttonpanel" colspan="4" align="center">
								<input class="ui-state-default ui-corner-all" type="submit" name="submit" value="{$option['formSubmit']}" />
							</td>
						</tr>
					</table>
				</div>
			</form>
			<script type="text/javascript">
				var count=0;
				
				function selectOption(select_id, option_val) {
				    $('#'+select_id+' option:selected').removeAttr('selected');
				    $('#'+select_id+' option[value='+option_val+']').attr('selected','selected');       
				}
				
				var the_formed = window.document.addEditForm;
				$(document).ready(function(){
					$("input.numeric").numeric();
						vsf.radio('{$albumItem->getStatus()}',the_formed.galleryStatus);
					selectOption('gallery-category','{$albumItem->getCatId()}');
					
					$('#gallery-category option').each(function(){
						count++;
					});
				});
				
				$('#addEditForm').submit(function() {
					if(($('#cate-Id').val()=="" || $('#cate-Id').val()==0) &&count>1){
						jAlert('{$vsLang->getWords('not_select_category', 'Vui lòng chọn category!!!')}','{$bw->vars['global_websitename']} Dialog');
						$('#gallery-category').addClass('ui-state-error ui-corner-all-inner');
						return false;
					}
					
					if($('#galleryAlbum').val()==""){
						jAlert('{$vsLang->getWords('gallery_title_album_error','Vui lòng cho biết tên album')}','{$bw->vars['global_websitename']} Dialog');
						$('#galleryAlbum').focus(); 
						$('#galleryAlbum').addClass('ui-state-error ui-corner-all-inner');
						return false;
					}
					$('#galleryAlbum').removeClass('ui-state-error ui-corner-all-inner');
					vsf.uploadFile("addEditForm", "{$bw->input[0]}", "add-edit-album", "gallery-panel","gallery/deputy");
					return false;
				});
			</script>
EOF;
		return $BWHTML;
	}
	
	function displayGalleryAlbumList($albumList,$option){
		global $bw,$vsLang;
		$count = 0;
		$message = $vsLang->getWords('gallery_deleteConfirm_NoItem', "You haven't choose any items!");
		$BWHTML .= <<<EOF
			<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
			    <div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
			        <span class="ui-icon ui-icon-triangle-1-e"></span>
			        <span class="ui-dialog-title">{$vsLang->getWords('gallery_listAlbum','Danh sách các album')}</span>
			    </div>
			    
			    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner ui-widget-header">
			    	<li class="ui-state-default ui-corner-top">
			    		<a onclick="addPage()" title="{$vsLang->getWords('gallery_addAlum','Add')}" id="addAlum" href="#">
							{$vsLang->getWords('gallery_addAlum','Add')}
						</a>
		    		</li>
		    		<li class="ui-state-default ui-corner-top">
			        	<a id="deleteAlbum" title="{$vsLang->getWords('gallery_deleteAlbum','Delete')}" href="#">
							{$vsLang->getWords('gallery_deleteAlbum','Delete')}
						</a>
					</li>
			        <li class="ui-state-default ui-corner-top">
			        	<a id="hideAlbum" title="{$vsLang->getWords('gallery_hideAlbum','Hide')}" href="#">
							{$vsLang->getWords('gallery_hideAlbum','Hide')}
						</a>
					</li>
			        <li class="ui-state-default ui-corner-top">
			        	<a id="displayAlbum" title="{$vsLang->getWords('gallery_unhideAlbum','Display')}" href="#">
							{$vsLang->getWords('gallery_unhideAlbum','Display')}
						</a>
					</li>
			    </ul>
				    
				<table cellspacing="1" cellpadding="1" id='productListTable' width="100%">
					<thead>
					    <tr>
					        <th style='text-align:center;' width="15"><input type="checkbox" onclick="checkAll()" onclicktext="checkAll()" name="all" /></th>
					        <th style='text-align:center;' width="20">{$vsLang->getWords('gallery_labelStatus', 'Hiện')}</th>
					        <th style='text-align:center;' width="200">{$vsLang->getWords('gallery_labelTitle', 'Tên Album')}</td>
					        <th style='text-align:center;' width="">{$vsLang->getWords('gallery_labelIntro', 'Giới Thiệu')}</th>
					        <th style='text-align:center;' width="100">{$vsLang->getWords('gallery_option', 'Tùy chọn')}</th>
					    </tr>
					</thead>
					<tbody>
						<if="count($albumList)">
							<foreach="$albumList as $Album">
								<php> 
									$classType = ($count%2)+1;
									$count++;
			           			</php> 
								<tr class="row{$classType}">
									<td align="center" width="20">
										<input type="checkbox" onclicktext="checkObject({$Album->getId()});" onclick="checkObject({$Album->getId()});" name="obj_{$Album->getId()}" value="{$Album->getId()}" class="myCheckbox" />
									</td>
									<td style='text-align:center' width="20">{$Album->getStatus('image')}</td>
									
									<td>
									<a href="javascript:vsf.get('gallerys/edit-album-form/{$Album->getId()}/','gallery-panel')" title='{$vsLang->getWords('gallery_edit_album','Click here to edit this album')}' class="title">
											{$Album->getTitle()}
										</a>
									</td>
									
									<td>{$Album->getIntro(200)}</td>
									
									<td class="ui-dialog-buttonpanel" colspan="4" align="center">
										<a class="ui-state-default ui-corner-all" href="javascript:;" onclick="vsf.popupGet('gallerys/display-file/{$Album->getId()}','auto{$Album->getId()}')"> Hình ảnh</a>
										<a class="ui-state-default ui-corner-all" href="javascript:vsf.get('gallerys/edit-album-form/{$Album->getId()}/','gallery-panel');" title='{$vsLang->getWords('gallery_edit_album','Click here to edit this album')}' > Sửa</a>
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
			<script type="text/javascript">
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
				function addPage(){
					vsf.get('gallerys/add-album-form','gallery-panel');
				}
				$('#deleteAlbum').click(function(){
					jConfirm(
						'{$vsLang->getWords("gallery_deleteConfirm","Are you sure to delete these Album information?")}', 
						'{$bw->vars['global_websitename']} Dialog', 
						function(r){
							if(r){
								var flag=true; var jsonStr = "";
						
								$("input[type=checkbox]").each(function(){
									if($(this).hasClass('myCheckbox')){
										flag=false;
										if(this.checked) jsonStr += $(this).val()+',';
									}
								});
								if(flag){
									jAlert(
										"{$message}",
										"{$bw->vars['global_websitename']} Dialog"
									);
									return false;
								}
								jsonStr = jsonStr.substr(0,jsonStr.lastIndexOf(','));
								
								vsf.get('gallerys/delete-album/{$option['cateId']}/'+jsonStr+'/','gallery-panel');
							}
						}
					);
				});
				$('#hideAlbum').click(function(){
						var flag=true; var jsonStr = "";
						$("input[type=checkbox]").each(function(){
								if($(this).hasClass('myCheckbox')){
									flag=false;
									if(this.checked) jsonStr += $(this).val()+',';
								}
							});
						if(flag){
							jAlert(
								"{$message}",
								"{$bw->vars['global_websitename']} Dialog"
							);
							return false;
						}
						jsonStr = jsonStr.substr(0,jsonStr.lastIndexOf(','));
						
						vsf.get('gallerys/update-album-status/{$option['cateId']}/'+jsonStr+'/0/','gallery-panel');
				});
				
				$('#displayAlbum').click(function(){
						var flag=true; var jsonStr = "";
				
						$("input[type=checkbox]").each(function(){
								if($(this).hasClass('myCheckbox')){
									flag=false;
									if(this.checked) jsonStr += $(this).val()+',';
								}
							});
						if(flag){
							jAlert(
								"{$message}",
								"{$bw->vars['global_websitename']} Dialog"
							);
							return false;
						}
						jsonStr = jsonStr.substr(0,jsonStr.lastIndexOf(','));
						vsf.get('gallerys/update-album-status/{$option['cateId']}/'+jsonStr+'/1/','gallery-panel');
				});
				
			</script>
EOF;
		return $BWHTML;
	}
	
	function displayFile($option){
		return $BWHTML .= <<<EOF
<div id="dialog" title="Dialog Title">
	<div class='left-cell'><div id='file-form' >{$option['file-form']}</div></div>
			<div id="file-panel" >{$option['file-list']}</div>
			</div>	
EOF;
	}
	
	function addEditFileForm($form = array(), $file,$album) {
		global $bw, $vsLang, $vsSettings;
		$BWHTML = "";
		if(!$album->getCode())
			$album->setCode(common);
		$albumName=$album->getCode()."/Album-{$album->getId()}";
		if(!$file->getId())
			$file->setStatus(1);
		$BWHTML .= <<<EOF
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all">
				<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
				<span class="ui-dialog-title">{$form['title']}</span></div>
				<form name="form" method="post" id="form-add-edit-file" enctype="multipart/form-data">
					<input type="hidden" name="oldFileId" id="file-id" value="{$file->getId()}" />
					<input type="hidden" name="albumId" id="albumId" value="{$form['albumId']}" />
				<div class="red">{$form['message']}</div>
				<table cellpadding="0" cellspacing="0" border="0"
					class="ui-dialog-content ui-widget-content">
					<if="$vsSettings->getSystemKey($album->getCode().'_title',1,$album->getCode())">
					<tr>
						<td class="normalcell" width="100">{$vsLang->getWords('file_upload_form_name',"File	name")}:</td>
						<td class="normalcell" width="300"><input type="text" value="{$file->getTitle()}" name="fileTitle" size="45" id="fileTitle" /></td>
						<td rowspan="2">{$file->show(50,50)}</td>
					</tr>
					</if>
					<if="$vsSettings->getSystemKey($album->getCode().'_url',0,$album->getCode())">
					<tr>
						<td class="normalcell" width="100">{$vsLang->getWords('file_url',"File	Link")}:</td>
						<td class="normalcell" width="300"><input type="text" value="{$file->getUrl()}" name="fileUrl" size="45" id="fileUrl" /></td>
					</tr>
					</if>
					<tr>
						<td class="normalcell">{$vsLang->getWords('file_upload_form_source',"Source")}:</td>
						<td class="ui-dialog-buttonpanel"><input type="file" name="fileUpload" id="fileUpload" /></td>
					</tr>
					<if="$vsSettings->getSystemKey($album->getCode().'_intro',0,$album->getCode())">
					<tr>
						<td class="normalcell" width="100">{$vsLang->getWords('file_url',"File	Intro")}:</td>
						<td class="normalcell" width="300"><textarea name="fileIntro">{$file->getIntro()}</textarea></td>
					</tr>
					</if>
					<if="$vsSettings->getSystemKey($album->getCode().'_index',0,$album->getCode())">
					<tr>
						<td class="normalcell" width="100">{$vsLang->getWords('file_index',"File Index")}:</td>
						<td class="normalcell" width="300"><input type="checkbox" value="{$file->getIndex()}" name="fileIndex" /></td>
					</tr>
					</if>
					<if="$vsSettings->getSystemKey($album->getCode().'_status',0,$album->getCode())">
					<tr>
						<td class="normalcell" width="100">{$vsLang->getWords('file_status',"File	Status")}:</td>
						<td class="normalcell" width="300"><input type="checkbox" value="1" name="fileStatus" /></td>
					</tr>
					</if>
					<tr>
						<td class="ui-dialog-buttonpanel" align="right" colspan="2">
							<input class="ui-state-default ui-corner-all" type="submit" name="submit" value="{$form ['formSubmit']}" /> {$form ['switchform']}
						</td>
					</tr>
				</table>
				</form>
			</div>
			<script type="text/javascript">
				$('#switch-add-file-bt').click( function() {
					vsf.get('gallerys/add-form-file/{$form['albumId']}','file-form');
				});
				
				$('#form-add-edit-file').submit(function() {
					vsf.uploadFile("form-add-edit-file", "gallerys", "add-edit-gallery-file", "file-panel", 'gallery/{$albumName}');
					return false;
				});
				$(window).ready(function() {
					vsf.jCheckbox('{$file->getStatus()}','fileStatus');
				});
			</script>
EOF;
		//--endhtml--//
		return $BWHTML;
	}
	function displayGalleryFileList($file,$albumId){
		global $vsLang, $bw;
		$BWHTML .= <<<EOF
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all">
			<if="count($file)">
				<foreach="$file as $value">
				<div class="ui-dialog-content ui-widget-content" style="float: left; width: 100px; margin: 5px;" title="{$value->getTitle()}">
					{$value->show(100,100)}
					<a class="ui-state-default ui-corner-all ui-state-focus" href="javascript: displayEditFile({$value->getId()},$albumId)" title='{$vsLang->getWords('newsItem_EditObjTitle',"Click here to edit this {$bw->input[0]}")}'>{$vsLang->getWords('global_edit','Sửa')}</a>
					<a class="ui-state-default ui-corner-all ui-state-focus" href="javascript: removeFile({$value->getId()},$albumId,'{$value->getTitle()}')" title='{$vsLang->getWords('newsItem_EditObjTitle',"Click here to delete this {$bw->input[0]}")}'>{$vsLang->getWords('global_del','Xóa')}</a>
					
				</div>
				</foreach>
			<else />
				<div class="error">{$vsLang->getWords('gallery_file_empty',"Không có hình ảnh nào cả.")}</div>	
			</if>
			<div class="clear"></div>
        </div>
		<script>
			function displayEditFile(fileId, cateId){
				vsf.get('gallerys/edit-form-file/'+cateId + '/'+fileId+'/','file-form');	
			}
	
			function removeFile(fileId, cateId, fileName){
				vsf.get("gallerys/delete-file/" + fileId +'/'+ cateId +'/', 'file-panel');
			}		
		</script>
EOF;
		return $BWHTML;
	}	
	
}
?>