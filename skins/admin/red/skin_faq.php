<?php

class skin_pages extends skin_objectadmin {
// dd_edit_form#

function addEditObjForm($obj, $option = array()) {
		global $bw;
		

		$info = json_decode($obj->getTitle(), true);

		$BWHTML .= <<<EOF
		<div class="vs_panel" id="vs_panel_{$this->modelName}">
		<div class="ui-dialog">
		<form class="frm_add_edit_obj" id="frm_add_edit_obj"  method="POST" enctype='multipart/form-data'>
		<input type="hidden" value="{$bw->input['vdata']}" name="vdata"/>
		<input type="hidden" value="{$bw->input['pageIndex']}" name="pageIndex"/>
		<input type="hidden" value="{$obj->getId()}" name="{$this->modelName}[id]" />
			<table class="obj_add_edit" width="100%">
				<thead>
					<tr>
						<th colspan="2">
							<span class="ui-dialog-title-form">{$this->getLang()->getWords('add_edit_'.$bw->input[0],'Thêm/Sửa tin')}</span>
							<a class="btn_custom_settings icon-wrapper-vs" 
							group="{$bw->input[0]}_{$this->modelName}_form">
							</a>
							<div class="vs-buttons">
								<button type="submit" ><span><img src="{$bw->vars['img_url']}/pixel-vfl3z5WfW.gif" class="icon-wrapper-vs vs-icon-accept"></span><span>{$this->getLang()->getWords('global_accept')}</span></button>
								<button type="button" id="frm_close" class="btnCancel frm_close"><span><img src="{$bw->vars['img_url']}/pixel-vfl3z5WfW.gif" class="icon-wrapper-vs vs-icon-cancel"></span><span>{$this->getLang()->getWords("global_cancel")}</span></button>
							</div>
						</th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<td style="width: 111px;"><label>{$this->getLang()->getWords('question','Câu hỏi')}</label></td>
					<td>
						<textarea rows="5" name="{$this->modelName}[intro]" id="{$this->modelName}_intro" style='width:99%'>{$obj->getIntro()}</textarea>
					</td>
				</tr>
				<tr>
				</tr>
				<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_status','Status',$bw->input[0].'_'.$this->modelName.'_form')">
				<tr>
					<td style="width: 121px;"><label>{$this->getLang()->getWords('status','Trạng thái')}</label></td>
					<td>
					<label>
						<input <if="$obj->getStatus()=='0'">checked='checked'</if>  name="{$this->modelName}[status]" id="{$this->modelName}_status_0" type="radio" value="0"  />
						{$this->getLang()->getWords('global_hide','Ẩn')}
					</label>
					<label>
						<input <if="$obj->getStatus()==1||$obj->getStatus()==null">checked='checked'</if>  name="{$this->modelName}[status]" id="{$this->modelName}_status_1" type="radio" value="1"  />
						{$this->getLang()->getWords('global_visible','Hiện')}
					</label>
					<if="$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_status_home",0,$bw->input[0])">
					<label>
						<input  <if="$obj->getStatus()==2">checked='checked'</if>  name="{$this->modelName}[status]" id="{$this->modelName}_status_2" type="radio" value="2"  />
						{$this->getLang()->getWords('global_home','Trang chủ')}
					</label>
					</if>
					</td>
				</tr>
				</if>
				<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_category_list', 'Category',$bw->input[0]) and $this->model->getCategories()->getChildren()">
				<tr>
					<td><label>{$this->getLang()->getWords("category",'Danh mục')}</label></td>
					<td>
						<select  name="{$this->modelName}[catId]" id="vs_cate">
								{$this->model->getCategories()->getChildrenBoxOption($obj->getCatId())}
						</select>
					</td>
				</tr>
				</if>
				<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_index','index',$bw->input[0].'_'.$this->modelName.'_form')">
				<tr>
					<td><label>{$this->getLang()->getWords("index",'Thứ tự')}</label></td>
					<td>
						<input  name="{$this->modelName}[index]" id="{$this->modelName}_index" type="text" value="{$obj->getIndex()}" />
					</td>
				</tr>
				</if>
				
				<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_image_field','Image',$bw->input[0].'_'.$this->modelName.'_form')">
				<tr>
					<td><label>{$this->getLang()->getWords('image','Hình ảnh')}</label>
					<p>
					<if="$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_image_width",'')&&$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_image_height",'')">
							{$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_image_width",'')}x{$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_image_height",'')}px
					</if>
					</p>
					</td>
					<td>
					<div style="float:left;width:300px">
						<label>
							<input name="filetype[image]" value="file" type="radio" checked='checked' obj="image-file"/>
							{$this->getLang()->getWords('upload','Tải lên từ máy')}:</label>
						<label>
							<input type="file" value="" style='width:250px;'  id="image-file" name="image"/>
						</label>
						<br/>
						<label>
							<input name="filetype[image]"   value="link" type="radio" obj="image-link"/>
							{$this->getLang()->getWords('download_from','Tải về từ đường dẫn')}:
						</label>
						<label>
							<input disabled='disabled' type="text" value="" style='width:250px;' id="image-link" name="links[image]"/>
						</label>
					</div>
					<div style="float:left;width:200px">
						<if="$obj->getImage()">
							<if="$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_image_height",'')&&$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_image_width",'')">
								{$obj->createImageEditable($obj->getImage(),100,90,$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_image_width",''),$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_image_height",''))}
							<else />
								{$obj->createImageEditable($obj->getImage(),100,90)}
							</if>
						</if>
					</div>
					</td>
				</tr>
				</if>
				
				<tr>
					<td><label>{$this->getLang()->getWords('fullname','Họ tên')}</label></td>
					<td>
						<input name="{$this->modelName}[fullname]" type="text" value="{$info['fullname']}" />
					</td>
				</tr>
				
				<tr>
					<td><label>{$this->getLang()->getWords('email','Email')}</label></td>
					<td>
						<input name="{$this->modelName}[email]" type="text" value="{$info['email']}" />
					</td>
				</tr>
				
				<tr>
					<td><label>{$this->getLang()->getWords('phone', 'Điện thoại')}</label></td>
					<td>
						<input name="{$this->modelName}[phone]" id="{$this->modelName}_code" type="text" value="{$info['phone']}" />
					</td>
				</tr>
				
				<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_content','Content',$bw->input[0].'_'.$this->modelName.'_form')">
					<tr>
						<td><label>{$this->getLang()->getWords('answer','Trả lời')}</label></td>
						<td>
						{$this->createEditor($obj->getContent(), "{$this->modelName}[content]", "100%", "333px","full")}
						</td>
					</tr>
				</if>
				<tr>
					<td></td>
					<td><if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_seo_option','SEO Option',$bw->input[0].'_'.$this->modelName.'_form')">
						<button onclick="$('#seo').toggle();return false;">Seo option</button>
					</if>
				</tr></td>	

				<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_seo_option','SEO Option',$bw->input[0].'_'.$this->modelName.'_form')">
					<tr id="seo" $seo>
						<td><label>{$this->getLang()->getWords('seo')}</label></td>
						<td>
							<label>Slug:<input type="text" style="width:100%" value="{$obj->getSlug()}" name="{$this->modelName}[slug]" /></label>
							<label>Meta Title:<input type="text" style="width:100%" value="{$obj->getMTitle()}" name="{$this->modelName}[mTitle]" /></label>
							<label>Meta Description:<textarea style="width:100%"   name="{$this->modelName}[mIntro]" >{$obj->getMIntro()}</textarea></label>
							<label>Meta Keyword:<textarea style="width:100%"   name="{$this->modelName}[mKeyword]" >{$obj->getMKeyword()}</textarea></label>
						</td>
					</tr>
				</if>
				<tr style="border:none">
					<td class="vs-button" colspan="2" >
						<button type="submit" ><span><img src="{$bw->vars['img_url']}/pixel-vfl3z5WfW.gif" class="icon-wrapper-vs vs-icon-accept"></span><span>{$this->getLang()->getWords('global_accept')}</span></button>
						<button type="button" id="frm_close" class="btnCancel frm_close"><span><img src="{$bw->vars['img_url']}/pixel-vfl3z5WfW.gif" class="icon-wrapper-vs vs-icon-cancel"></span><span>{$this->getLang()->getWords("global_cancel")}</span></button>
					</td>
				</tr>
				</tbody>
			</table>
		</form>
		
		
		</div>
		<script>
		$("#frm_add_edit_obj").submit(function(){
				var flag=false;
				var message="";
				var frm=$(this);
				if($("#{$this->modelName}_intro").val().length<3){
					message+='{$this->getLang()->getWords('error_title')}{$this->DS}n';
					flag=true;
				}
				if(flag){
					jAlert(message);
					return false;
				}
				vsf.uploadFile("frm_add_edit_obj", "{$bw->input[0]}", "{$this->modelName}_add_edit_process", "vs_panel_{$this->modelName}","{$bw->input[0]}",1,
							function(){
								var hashbase=frm.parents('.ui-tabs-panel').attr('id');
								window.location.hash=hashbase+"/{$bw->input['back']}";	
							}
				);
				return false;
		});
		$(".frm_close").click(function(){
			var hashbase=$(this).parents('.ui-tabs-panel').attr('id');
			window.location.hash=hashbase+"{$bw->input['back']}";
				///alert(window.location.hash);
			//vsf.get('{$bw->input[0]}/{$this->modelName}_display_tab&pageIndex={$bw->input['pageIndex']}&vdata={$_REQUEST['vdata']}','vs_panel_{$this->modelName}');
			//vsf.get('{$bw->input[0]}/{$this->modelName}_display_tab','vs_panel_{$this->modelName}',{vdata:'{$_REQUEST['vdata']}',pageIndex:'{$bw->input['pageIndex']}'});
			return false;
		});
		////////*********************select file field*************************/
						$("input[type='radio']").change(function(){
							if($(this).val()=='link'||$(this).val()=='file'){
							
								$("input[name='"+this.name+"']").each(function(){
										if($(this).attr("checked")){
											$("#"+$(this).attr('obj')).removeAttr("disabled");
										}else{
											$("#"+$(this).attr('obj')).attr("disabled","disabled");
										}
								});
								
							}
						});
		</script>
		
EOF;
	}

function getListItemTable($objItems = array(), $option = array()) {
	    global $bw;
	
	    $BWHTML .= <<<EOF
		<div class="ui-dialog">
			<span class="ui-dialog-title">{$this->getLang()->getWords($this->modelName."_title","Danh sách bài viết")}</span>
		<if="$this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_search_form",1,$bw->input[0])">
			{$this->getSearchForm($option)}
		</if>
		<form class="frm_obj_list" id="frm_obj_list">
		<div class="vs-button">
			{$this->addOption()}
			<a class="btn_custom_settings icon-wrapper-vs"
			group="{$bw->input[0]}_{$this->modelName}_list">
			</a>
		</div>
		<div id="{$this->modelName}_item_panel">
	
		<input type="hidden" name="catId" value="{$bw->input['catId']}"/>
		<input type="hidden" name="pageIndex" value="{$bw->input['pageIndex']}"/>
		<table class="obj_list">
		<thead>
			<tr>
				<th class="check-column" scope="col"><input type="checkbox" onClick="checkAllClick()" class="check_all" name=""/></th>
				<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_Id','ID',$bw->input[0].'_'.$this->modelName.'_list')">
				<th onclick="orderItem('id', '{$option['s_order']}')" class="id" scope="col">{$this->getLang()->getWords("id")}</th>
				</if>
				<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_image_field','Image',$bw->input[0].'_'.$this->modelName.'_list')">
					<th class="img">{$this->getLang()->getWords("image","Hình ảnh")}</th>
				</if>
				<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_title','Title',$bw->input[0].'_'.$this->modelName.'_list')">
					<th onclick="orderItem('title', '{$option['s_order']}')" class="title" scope="col">{$this->getLang()->getWords("title","Tiêu đề")}</th>
				</if>
				<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_category_list','Category',$bw->input[0].'_'.$this->modelName.'_list')">
					<th>{$this->getLang()->getWords("category",'Danh mục')}</th>
				</if>
				<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_status','Status',$bw->input[0].'_'.$this->modelName.'_list')">
				<th onclick="orderItem('status', '{$option['s_order']}')" class="status" scope="col">{$this->getLang()->getWords("status","Trạng thái")}</th>
				</if>
				<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_postdate','postdate',$bw->input[0].'_'.$this->modelName.'_list')">
				<th class="date">{$this->getLang()->getWords("postdate","Ngày đăng")}</th>
				</if>
				<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_index','index',$bw->input[0].'_'.$this->modelName.'_list')">
				<th class="index" scope="col">{$this->getLang()->getWords("index","Thứ tự")}</th>
				</if>
				<th class="action" scope="col">{$this->getLang()->getWords("action","Thao tác")}</th>
			</tr>
		</thead>
		<tbody>
		<if="$objItems">
			<foreach="$objItems as $item">
				<tr class="$vsf_class">
					<th class="check-column check_td" scope="row"><input onClick="checkRow()"  value="{$item->getId()}" type="checkbox" class="btn_checkbox"/></th>
					<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_Id','ID',$bw->input[0].'_'.$this->modelName.'_list')">
					<td>{$item->getId()}</td>
					</if>
					<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_image_field','Image',$bw->input[0].'_'.$this->modelName.'_list')">
						<td> <a onClick="btnEditItem_Click({$item->getId()},this);return false;" href="">{$item->createImageCache($item->getImage(),100,50)}</a></td>
					</if>
					<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_title','Title',$bw->input[0].'_'.$this->modelName.'_list')">
					<td><a onClick="btnEditItem_Click({$item->getId()},this);return false;" href="">{$item->getIntro()}</a></td>
					</if>
					<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_category_list','Category',$bw->input[0].'_'.$this->modelName.'_list')">
					<td>
						<if="$this->getMenu()->getCategoryById($item->getCatId())">
							{$this->getMenu()->getCategoryById($item->getCatId())->getTitle()}
						<else />
							{$this->getLang()->getWords("Uncategory","Không có danh mục")}
						</if>
					</td>
					</if>
					<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_status','Status',$bw->input[0].'_'.$this->modelName.'_list')">
					<td class="status"><img src="{$bw->vars['img_url']}/status/status_{$item->getStatus()}.png"></td>
					</if>
					<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_postdate','postdate',$bw->input[0].'_'.$this->modelName.'_list')">
					<td>{$this->dateTimeFormat($item->getPostDate(),"d/m/Y") }</td>
					</if>
					<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_index','index',$bw->input[0].'_'.$this->modelName.'_list')">
					<td class="index"><input type="text" name="indexitem[{$item->getId()}]" value="{$item->getIndex()}" size="3"/></td>
					</if>
					<td class="action">
					{$this->addOtionList($item)}
					</td>
				</tr>
			</foreach>
		<else />
			<tr><td colspan="10">{$this->getLang()->getWords("no_data","Hiện không có dữ liệu")}</td></tr>
		</if>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="3">{$this->addOption()}</th>
				<th colspan="10" class="pagination">{$option['paging']}</th>
			</tr>
		</tfoot>
		</table>
		</div>
	
		<if="$this->getSettings()->getKeyGroup($bw->input[0].'_'.$this->modelName.'_category_list','Category',$bw->input[0].'_'.$this->modelName.'_list') and $this->model->getCategories()->getChildren()">
			<div class="more_action">
			<label>{$this->getLang()->getWords("move_to_categories","Di chuyển đến")}
			<select name='toCatId'>
			{$this->model->getCategories()->getChildrenBoxOption()}
			</select>
			</label>
			<input type="button" class="icon-wrapper icon-wrapper-vs btnGo" name="" onClick="changCate()"  title="{$this->getLang()->getWords("move_to_categories","Di chuyển đến")} "/>
			</div>
		</if>
		<if="$option['vdata']">
		<input type="hidden" value='{$option['vdata']}' name="vdata"/>
		</if>
	
		</form>
		</div>
		<script>
			var objChecked=new Array();
			////////////////checked
			function checkAllClick(){
				var check=$("#vs_panel_{$this->modelName}  .check_all").attr("checked");
				objChecked=new Array();
				$("#vs_panel_{$this->modelName} .btn_checkbox").each(function(){
					if(check=='checked'){
						$(this).attr("checked","checked").change();
						objChecked.push($(this).val());
					}else{
						$(this).removeAttr("checked").change();
					}
				});
			}
			function checkRow(){
				objChecked=new Array();
				$(".btn_checkbox").each(function(){
					if($(this).attr("checked")){
						objChecked.push($(this).val());
						$(this).change();
					}
				});
			}
			$(".btn_checkbox").change(function(){
				if($(this).attr("checked")){
					$(this).parents("tr").addClass("marked");
				}else{
					$(this).parents("tr").removeClass("marked");
				}
	
			});
			////////////
			$("#vs_panel_{$this->modelName} #frm_obj_list").submit(function(){
	
			});
			$("#vs_panel_{$this->modelName} #btn-delete-obj").click(function(){
				if(objChecked.length==0){
					vsf.alert("{$this->getLang()->getWords('global_error_none_select','Vui lòng chọn một hay nhiều tin')}");
					return false;
				}
				jConfirm(
                     "{$this->getLang()->getWords('global_yesno_delete','Bạn có chắc chắn muốn xóa nó?')}?",
                     "Hộp thông báo",
                     function(r){
						if(r){
							vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_delete/'+objChecked,'vs_panel_{$this->modelName}');
						}
					 }
				);
				return false;
			});
			$("#vs_panel_{$this->modelName} #btn-disable-obj").click(function(){
				if(objChecked.length==0){
					alert("{$this->getLang()->getWords('global_error_none_select','Vui lòng chọn một hay nhiều tin')}");
					return false;
				}
				vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_hide_checked/'+objChecked,'vs_panel_{$this->modelName}');
				return false;
			});
			$("#vs_panel_{$this->modelName} #btn-enable-obj").click(function(){
				if(objChecked.length==0){
					vsf.alert("{$this->getLang()->getWords('global_error_none_select','Vui lòng chọn một hay nhiều tin')}");
					return false;
				}
				vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_visible_checked/'+objChecked,'vs_panel_{$this->modelName}');
				return false;
			});
			$("#vs_panel_{$this->modelName} #btn-home-obj").click(function(){
				if(objChecked.length==0){
					vsf.alert("{$this->getLang()->getWords('global_error_none_select','Vui lòng chọn một hay nhiều tin')}");
					return false;
				}
				vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_home_checked/'+objChecked,'vs_panel_{$this->modelName}');
				return false;
			});
			$("#vs_panel_{$this->modelName} #btn-trash-obj").click(function(){
				if(objChecked.length==0){
					vsf.alert("{$this->getLang()->getWords('global_error_none_select','Vui lòng chọn một hay nhiều tin')}");
					return false;
				}
				vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_trash_checked/'+objChecked,'vs_panel_{$this->modelName}');
				return false;
			});
			$("#vs_panel_{$this->modelName} #btn-index-change-obj").click(function(){
				vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_index_change/','vs_panel_{$this->modelName}');
				return false;
			});
		
			$("#vs_panel_{$this->modelName} #btn-add-obj").click(btnAdd_Click);
		
		
			function btnAdd_Click(){
				var hashbase=$(this).parents('.ui-tabs-panel').attr('id');
				window.location.hash=hashbase+"/{$bw->input[0]}/{$this->modelName}_add_edit_form/";
			}
			function btnEditItem_Click(id,c){
					var hashbase=$(c).parents('.ui-tabs-panel').attr('id');
					window.location.hash=hashbase+"/{$bw->input[0]}/{$this->modelName}_add_edit_form/"+id+'&{$bw->input['back']}';
					return false;
			}
			function btnRemoveItem_Click(id){
				jConfirm(
                     "{$this->getLang()->getWords('global_yesno_delete')}?",
                     "Hộp thông báo",
                     function(r){
						if(r){
							vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_delete/'+id,'vs_panel_{$this->modelName}');
						}
					 }
				);
					return false;
			}
			function changCate(){
				if(objChecked.length){
				vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_change_cate/'+objChecked,'vs_panel_{$this->modelName}');
				}else{
					vsf.alert("{$this->getLang()->getWords('global_error_none_select')}");
				}
				return false;
			}
		</script>
	
	
		<script>
		<if="$option['message']">
		jAlert('{$option['message']}');
		</if>
		</script>
EOF;
	}
}