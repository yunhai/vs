<?php
class skin_objectadmin{
function getHtmlFullSearch($objItems = array(), $option = array()){
        global $bw, $vsLang, $vsSettings, $vsPrint,$vsUser,$langObject;
		$BWHTML .= <<<EOF
                <if=" $vsSettings->getSystemKey($bw->input[0].'_add_hide_show_delete',1, $bw->input[0]) ">
                                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner ui-widget-header">
                                    <li class="ui-state-default ui-corner-top" id="add-objlist-bt"><a href="#" title="{$langObject['itemListAdd']}">{$langObject['itemListAdd']}</a></li>
                                    <li class="ui-state-default ui-corner-top" id="hide-objlist-bt"><a href="#" title="{$langObject['itemListHide']}">{$langObject['itemListHide']}</a></li>
                                    <li class="ui-state-default ui-corner-top" id="visible-objlist-bt"><a href="#" title="{$langObject['itemListVisible']}">{$langObject['itemListVisible']}</a></li>
                                    <if=" $vsSettings->getSystemKey($bw->input[0].'_home',0, $bw->input[0]) ">
                                       <li class="ui-state-default ui-corner-top" id="home-objlist-bt"><a href="#" title="{$langObject['itemListHome']}">{$langObject['itemListHome']}</a></li>
                                    </if>
                                    <li class="ui-state-default ui-corner-top" id="delete-objlist-bt"><a href="#" title="{$langObject['itemListDelete']}">{$langObject['itemListDelete']}</a></li>
                                    <if="$vsSettings->getSystemKey($bw->input[0].'_category_list',1, $bw->input[0])">
                                    <li class="ui-state-default ui-corner-top" id="change-objlist-bt"><a href="#" title="{$langObject['itemListChangeCate']}">{$langObject['itemListChangeCate']}</a></li>
                                    </if>
                                    <if="$vsSettings->getSystemKey($bw->input[0].'_search_list',0, $bw->input[0])">
                                    <li class="ui-state-default ui-corner-top" id="insertSearch-objlist-bt"><a href="#" title="{$langObject['itemListInsertSearch']}">{$langObject['itemListInsertSearch']}</a></li>
                                    </if>
                                </ul>
                                </if>
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
									<td style='text-align:center'>{$obj->getStatus('image')}</td>
									
									<td>
										<a href="javascript:vsf.get('{$bw->input[0]}/add-edit-obj-form/{$obj->getId()}/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}','content_search')"  class="editObj" >
										{$obj->getTitle()}
										</a>
									</td>
									<td>{$obj->getIndex()}</td>
									<if=" $vsSettings->getSystemKey($bw->input[0].'_option', 0,$bw->input[0], 1, 1) ">
									<td>
										{$this->addOtionList($obj)}
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
                                                         <tr >
                                                      <th colspan='6' align="left">
                                                      <span style="padding-left: 10px;line-height:16px;"><img src="{$bw->vars['img_url']}/enable.png" /> {$langObject['itemListCurrentShow']}</span>
                                                      <span style="padding-left: 10px;line-height:16px;"><img src="{$bw->vars['img_url']}/disabled.png" /> {$langObject['itemListNotShow']}</span>
                                                       <if=" $vsSettings->getSystemKey($bw->input[0].'_home',0, $bw->input[0]) ">
                                                            <span style="padding-left: 10px;line-height:16px;"><img src="{$bw->vars['img_url']}/home.png" /> {$langObject['itemListHomeShow']}</span>
                                                      </if>
                                                      </th>
                                                </tr>
						</tfoot>
					</table>
				
			{$this->addJavaScript()}
EOF;
        return $BWHTML;
    }
function objListHtml($objItems = array(), $option = array()) {
		global $bw, $vsLang, $vsSettings, $vsSetting, $tableName, $vsUser,$langObject;
		$BWHTML .= <<<EOF
		
			<div class="red">{$option['message']}</div>
			
			<input type="hidden" name="checkedObj" id="checked-obj" value="" />
			<input type="hidden" name="categoryId" value="{$option['categoryId']}" id="categoryId" />
			<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
                            <div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
                            <span class="ui-icon ui-icon-note"></span>
                            <span class="ui-dialog-title">{$langObject['itemList']}</span>
                            <p style="align:right; float: right; color: #FFFFFF; cursor: pointer"><span id="search-bt">{$vsLang->getWords('global_search', 'Search')}</span></p>
                            </div>
                            {$this->getHtmlSearch()}
                           <div id="content_search">
                                         {$this->getHtmlFullSearch($objItems,$option)}				   
                                       </div>     
                           </div>
			
			<div class="clear" id="file"></div>
                        <div id='commentList'></div>            
EOF;
	}
function getHtmlSearch(){
        global $bw, $vsLang, $vsSettings, $vsPrint,$vsUser,$vsStd;
               
		$BWHTML .= <<<EOF
                <style>
                #searchinfo span{padding-left:10px; color: #222222; line-height:20px;margin-bottom:10px;}
                #searchinfo label{width:73px;float:left;}
                #searchinfo select{border:solid 1px #666;}
                #ui-datepicker-div{z-index:100 !important;}
                </style>
                 <ul id="search-form" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner ui-widget-header" <if="$bw->input[1]!='search'">style="display:none"</if> >
                    <form id="searchinfo" name="searchinfo" method="POST" enctype='multipart/form-data' autocomplete="off">
                       <input type="hidden" id="searchCate" name="searchCate" value="{$bw->input['searchCate']}"/>
                        <div style="width:450px;float:left;margin-left:20px;" >
                            <span id="show1" style="margin-top:5px;">
                                <label>{$vsLang->getWords("global_id_search", "Id")}</label>
                                <input type="text" name="searchId" class="numeric" id="searchId" size="10" value="{$bw->input['searchId']}"  />
                            </span> <br/>
                            <span class="classhidden" id="show2" style="margin-top:5px;">
                                <label>{$vsLang->getWords("global_title_search", "Title")}</label>
                                <input type="text" name="searchTitle" id="searchTitle" size="48" value="{$bw->input['searchTitle']}" />
                            </span> <br/>
                            <span class="classhidden" id="show3" style="margin-top:5px;">
                                <label>{$vsLang->getWords("global_title_postdate", "PostDate")}</label>
                                <input type="text" name="startDate" id="startDate" size="20" value="{$bw->input['startDate']}" />
                                To <input type="text" name="endDate" id="endDate" size="20" value="{$bw->input['endDate']}" />
                            </span> <br/>
                            
                        </div>
                        
                        <a title="Click here to search this content!" style="float:right;margin-right: 20px; line-height:20px;" id="search"  class="ui-state-default ui-corner-all ui-state-focus">{$vsLang->getWords("global_search", "Search")}</a>
                    </form>
                </ul>
                <script>
                        $('#search-bt').click(function(){
                            $("#search-form").animate({"height": "toggle"}, { duration: 1000 });});
                        $('#search').click(function(){
                        var count ;
                        var categoryId;

                            $("#obj-category  option").each(function () {
						count++;
                                               if($(this).attr('selected')){
                                               categoryId = $(this).val();
                                             

                       }
                                });
                                if(categoryId)
                                    $('#searchCate').val(categoryId);
                                else     $('#searchCate').val(0);
                               
                            vsf.uploadFile("searchinfo", "{$bw->input['module']}", "search", "content_search","{$bw->input['module']}");
                            return false;
                        });
                      function changeValue(val){
                      $('#searchinfo span').addClass('classhidden');
                       $('#show'+val).removeClass('classhidden');
                      }
                      $(document).ready(function(){
                       $('#startDate').datepicker({dateFormat: 'dd/mm/yy'});
                       $('#endDate').datepicker({dateFormat: 'dd/mm/yy'});
                       vsf.jSelect('{$bw->input['searchStatus']}','searchStatus');
                       $("input.numeric").numeric();
                       $('#searchId').change(function() {
                       
                       if( $('#searchId').val()){
                         $('#searchTitle').attr('disabled','disabled');
                         $('#startDate').attr('disabled','disabled');
                         $('#endDate').attr('disabled','disabled');
                         $('#searchStatus').attr('disabled','disabled');
                       }else{
                        $('#searchTitle').attr('disabled','');
                         $('#startDate').attr('disabled','');
                         $('#endDate').attr('disabled','');
                         $('#searchStatus').attr('disabled','');
                       }
});

});
               </script>
<script type="text/javascript">
//$().ready(function() {
//	$("#searchTitle").autocomplete("{$bw->base_url}{$bw->input['module']}/autocomplete", {
//		width: 260,
//		matchContains: true,
//		//mustMatch: true,
//		//minChars: 0,
//		//multiple: true,
//		//highlight: false,
//		//multipleSeparator: ",",
//		selectFirst: false
//	});
});
</script>
EOF;
        return $BWHTML;
    }        
function addJavaScript() {
		global $bw, $vsLang, $vsSettings, $vsSetting, $tableName, $vsUser,$langObject;
		$BWHTML .= <<<EOF
			<script type="text/javascript">
				
				$('#add-objlist-bt').click(function(){
					vsf.get('{$bw->input[0]}/add-edit-obj-form/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}','content_search');
				});
				
				$('#hide-objlist-bt').click(function() {
					if(vsf.checkValue())
                   	vsf.get('{$bw->input[0]}/hide-checked-obj/'+$('#checked-obj').val()+'/'+ $("#idCategory").val() +'/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}', 'content_search');
				});
				
				$('#visible-objlist-bt').click(function() {
					if(vsf.checkValue())
                 	vsf.get('{$bw->input[0]}/visible-checked-obj/'+$('#checked-obj').val()+'/'+ $("#idCategory").val() +'/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}', 'content_search');
				});

              	 $('#home-objlist-bt').click(function() {
					if(vsf.checkValue())
                    vsf.get('{$bw->input[0]}/home-checked-obj/'+$('#checked-obj').val()+'/'+ $("#idCategory").val() +'/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}', 'content_search');
				});           
				 
				
				$('#delete-objlist-bt').click(function() {
					if(vsf.checkValue())
                                            jConfirm(
                                                    "{$langObject['itemListConfirmDelete']}",
                                                    "{$bw->vars['global_websitename']} Dialog",
                                                    function(r) {
                                                            if(r) {
                                                                    var lists = $('#checked-obj').val();
                                                                    vsf.get('{$bw->input[0]}/delete-obj/'+lists+'/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}','content_search');
                                                            }
                                                    }
                                            );
				});
				
			$('#change-objlist-bt').click(function() {
                            var categoryId = 0;
                            var count = 0;
                            if(vsf.checkValue()){
                                $("#obj-category  option").each(function () {
                                                                count++;
                                    if($(this).attr('selected'))categoryId = $(this).val();
                                });
                            if(categoryId == 0 && count>1){
                                  jAlert("{$langObject['itemListChoiseCate']}",
                                          '{$bw->vars['global_websitename']} Dialog'
                                   );
                                   return false;
                            }
                            vsf.get('{$bw->input[0]}/change-objlist-bt/'+$('#checked-obj').val()+'/'+ categoryId +'/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}', 'content_search');
                     }
				});
			$('#insertSearch-objlist-bt').click(function() {        
             	vsf.get('{$bw->input[0]}/insertSearch-objlist-bt/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}', 'content_search');
				});
			</script>
EOF;
	}        

function addOtionList($obj) {
            global $vsLang, $bw,$vsSettings,$tableName;
            
            $BWHTML .= <<<EOF
                <if="$vsSettings->getSystemKey($bw->input[0].'_multi_file',0, $bw->input[0], 1, 1)">
                    <a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:;" onclick="vsf.popupGet('gallerys/display-album-tab/{$bw->input[0]}/{$obj->getId()}&albumCode=image','albumn')">
                            {$vsLang->getWords('global_album','Album')}
                    </a>
                </if>
                <if=" $vsSettings->getSystemKey($bw->input[0].'_comment',0, $bw->input[0], 1, 1)">
                    <a onclick="vsf.get('comments/comment-tab/{$obj->getCatId()}/{$obj->getId()}', 'commentList')" class="ui-state-default ui-corner-all ui-state-focus" href="javascript:;" >
                            {$vsLang->getWords('comment','Comments')}
                    </a>
                </if>
EOF;
            return $BWHTML;
        }

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
				<!--<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>-->
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
					vsf.uploadFile("add-edit-obj-form", "{$bw->input[0]}", "add-edit-obj-process", "content_search","{$bw->input[0]}");
					return false;
				});
              	$('#closeObj').click(function(){                                       
					vsf.get('{$bw->input[0]}/display-obj-list/{$bw->input['pageCate']}/&pageIndex={$bw->input['pageIndex']}','content_search');
				});
			</script>
EOF;
	}

	function categoryList($data = array()) {
		global $vsLang, $bw,$vsSettings,$langObject;
		$BWHTML .= <<<EOF
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all">
				<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
					<span class="ui-icon ui-icon-triangle-1-e"></span>
					<span class="ui-dialog-title">{$langObject['categoriesTitle']}</span>
				</div>
				<table width="100%" cellpadding="0" cellspacing="1">
					<tr>
				    	<th id="obj-category-message" colspan="2">{$data['message']}{$langObject['categoriesSelected']}: {$langObject['categoriesNone']}</th>
				    </tr>
				    <tr>
				        <td width="220">
				        {$data['html']}
				        </td>
				    	<td align="center">
                                            <a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:;" id="view-obj-bt" >
                                                    {$langObject['categoriesView']}
                                            </a>
                                            <if=" $vsSettings->getSystemKey($bw->input[0].'_rss_button',0,$bw->input[0],1,1) ">
                                            <a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:;" id="rss-obj-bt" >
                                                    {$langObject['categoriesRSS']}
                                            </a>
                                            </if>
				        </td>
					</tr>
				</table>
			</div>
                        <div  id="result_rss"></div>
			<script type="text/javascript">
				$('#view-obj-bt').click(function() {
					var categoryId = '';
					$("#obj-category option:selected").each(function () {
						categoryId = $(this).val();
					});
					vsf.get('{$bw->input[0]}/display-obj-list/'+categoryId+'/','content_search');
				});
                                $('#rss-obj-bt').click(function() {
                                var categoryId = '';
                                $("#obj-category option:selected").each(function () {
                                        categoryId = $(this).val();
                                });
                                vsf.get('{$bw->input[0]}/create_rss_file/'+categoryId+'/','result_rss');
				});
				$('#add-obj-bt').click(function(){
//					var categoryId = '';
//					$("#obj-category option:selected").each(function () {
//						categoryId=$(this).val();
//					});
//					$("#idCategory").val(categoryId);
					vsf.get('{$bw->input[0]}/add-edit-obj-form/', 'content_search');
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
					$("#obj-category-message").html('{$langObject['categoriesSelected']}:'+currentId);
					$('#obj-cat-id').val(parentId);
				});
			</script>
EOF;
	}

	function displayObjTab($option) {
		global $bw,$vsSettings,$langObject;
                
		$BWHTML .= <<<EOF
		<if="$vsSettings->getSystemKey($bw->input[0].'_category_list',1, $bw->input[0])">
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
				</ul>
			</div>
EOF;
		return $BWHTML;
	}
}
?>