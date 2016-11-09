<?php
class skin_pcontacts extends skin_objectadmin{
	function addEditObjForm($objItem, $option = array()) {
		global $vsLang, $bw,$vsSettings,$langObject;

		$BWHTML .= <<<EOF
			<div id="error-message" name="error-message"></div>
			<form id='add-edit-obj-form' name="add-edit-obj-form" method="POST" enctype='multipart/form-data'>
				<input type="hidden" id="obj-cat-id" name="pcontactCatId" value="{$option['categoryId']}" />
				<input type="hidden" name="pcontactId" value="{$objItem->getId()}" />
				<input type="hidden" name="pageIndex" value="{$bw->input['pageIndex']}" />
				<input type="hidden" name="pageCate" value="{$bw->input['pageCate']}" />
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
								<input style="width:100%;" name="pcontactTitle" value="{$objItem->getTitle()}" id="obj-title"/>
							</td>
						</tr>

						<tr class='smalltitle'>
							<td class="label_obj"  width="75">
								{$langObject['itemObjIndex']}:
							</td>
							<td width="170" colspan="3">
								<input size="10" class="numeric" name="pcontactIndex" value="{$objItem->getIndex()}" />
                             	<span style="margin-right: 20px;margin-left:40px">{$langObject['itemLObjStatus']}</span>
                          		<label>{$langObject['itemObjDisplay']}</label>
								<input name="pcontactStatus" id="pcontactStatus1" value='1' class='c_noneWidth' type="radio" checked />
								<label>{$langObject['itemObjHide']}</label>
								<input name="pcontactStatus" id="pcontactStatus0" value='0' class='c_noneWidth' type="radio" />
								<if=" $vsSettings->getSystemKey($bw->input[0].'_home',0) ">
								<label>{$langObject['itemObjHome']}</label>
								<input name="pcontactStatus" id="pcontactStatus2" value='2' class='c_noneWidth' type="radio" />
								</if>
							</td>
						</tr>
                                                <if="$vsSettings->getSystemKey($bw->input[0].'_email',0)">
                                                    <tr class='smalltitle'>
                                                            <td class="label_obj" width="75">Email:</td>
                                                            <td colspan="3">
                                                                    <input size="30" name="pcontactEmail" value="{$objItem->getEmail()}" id="obj-Email"/>
                                                            </td>
                                                    </tr>
						</if>
                                                <if="$vsSettings->getSystemKey($bw->input[0].'_code',0)">
                                                    <tr class='smalltitle'>
                                                            <td class="label_obj" width="75">{$langObject['itemObjCode']}:</td>
                                                            <td colspan="3">
                                                                    <input size="20" name="pcontactCode" value="{$objItem->getCode()}" id="obj-code"/>
                                                            </td>
                                                    </tr>
						</if>
						<if="$vsSettings->getSystemKey($bw->input[0].'_image',1)">
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
								{$objItem->createImageCache($objItem->getImage(), 100, 60, $vsSettings->getSystemKey($bw->input[0]."_image_timthumb_type", 0, $bw->input[0], 1, 1), $vsSettings->getSystemKey($bw->input[0]."_image_timthumb_noimage", 0, $bw->input[0], 1, 1))}
								<br/>
								<if=" $objItem->getImage() && $vsSettings->getSystemKey($bw->input[0].'_image_delete',1) ">
								<input type="checkbox" name="deleteImage" id="deleteImage" />
								<label for="deleteImage">{$vsLang->getWords('delete_image','Delete Image')}</lable>
								</if>
							</td>
						</tr>

						<tr class='smalltitle'>
							<td class="label_obj">
								{$langObject['itemObjFile']}:
							</td>
							<td>
								<input onclick="checkedLinkFile($('#link-file').val());" onclicktext="checkedLinkFile($('#link-file').val());" type="radio" id="link-file" name="link-file" value="file" checked="checked"/>
								<input size="27" type="file" name="pcontactIntroImage" id="pcontactIntroImage" /><br />
								 <!--{$vsSettings->getSystemKey($bw->input[0]."_image_timthumb_size","(size:100x100px)", $bw->input[0])}-->
							</td>
						</tr>
						</if>
						<if="$vsSettings->getSystemKey($bw->input[0].'_Address',1)">
						<tr class='smalltitle'>
							<td class="label_obj"  width="75">
								{$langObject['itemObjAddressview']}:
							</td>
							<td colspan="3">
                        		<input style="width:100%;" name="pcontactAddressview" value="{$objItem->getAddressview()}" id="obj-Addressview"/>	
							</td>
						</tr>
						</if>
                   		<if="$vsSettings->getSystemKey($bw->input[0].'_googleposition',1)">
                   		<tr class='smalltitle'>
							<td class="label_obj"  width="75">
								{$langObject['itemObjAddress']}:
							</td>
							<td colspan="3">
                        		<input style="width:100%;" name="pcontactAddress" value="{$objItem->getAddress()}" id="obj-Address"/>	
							</td>
						</tr>
						<tr class='smalltitle'>
							<td class="label_obj" width="75">{$langObject['itemObjPosition']}:</td>
							<td colspan="3">
								{$vsLang->getWords('obj_Latitude', 'Latitude')}<input size="20" name="pcontactLatitude" value="{$objItem->getLatitude()}" id="gmap_lat"/> X
								{$vsLang->getWords('obj_Longitude', 'Longitude')}<input size="20" name="pcontactLongitude" value="{$objItem->getLongitude()}" id="gmap_lng"/> 
								
								<a class="find_address" onclick="return false;">{$vsLang->getWords('obj_choise_place', ' Choise Place')}</a> |
                               	<a class="go_hcm" onclick="return false;">{$vsLang->getWords('obj_center_hcm', ' Center HCM')} </a>
								<div class="clear_left"></div>
								<div id="show_google_map" style="display:none">
                                	<h3 class="ttks_title"><span>{$vsLang->getWords('Google_map_goo','Bản đồ google')}</span></h3>
                              		<div class="clear_left" ></div>
                                  	<div class="gioithieuks" style="padding-top:10px;">
                                   		<div id="map_canvas" style="height: 448px;">Google image not show</div>
                                      	<div class="clear_left" ></div>
                                 	</div>
                          		</div>
							</td>
						</tr>
						</if>
						

						<if=" $vsSettings->getSystemKey($bw->input[0].'_intro',1) ">
						<tr class='smalltitle'>
							<td class="label_obj" width="75">
								{$vsLang->getWords("obj_footer","Địa chỉ Footer")}:
							</td>
							<td colspan="3" valgin="left">
								{$objItem->getIntro()}
							</td>
						</tr>
						</if>

						<if="$vsSettings->getSystemKey($bw->input[0].'_content',1)">
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
                                        vsf.jRadio('{$objItem->getStatus()}','pcontactStatus');

                                        $('#obj-category option').each(function(){
							$(this).removeAttr('selected');
						});
					$("input.numeric").numeric();
					checkedLinkFile();

					vsf.jSelect('{$objItem->getCatId()}','obj-category');

				});

				$('#txtlink').change(function() {
					var img_html = '<img src="'+$(this).val()+'" style="width:100px; max-height:115px;" />';
					$('#td-obj-image').html(img_html);
				});

				$('#pcontactIntroImage').change(function() {
					var img_name = '<input type="hidden" id="image-name" name="image-name" value="'+$(this).val() +'"/>';
					$('#td-obj-image').html(img_name);
				});

				function checkedLinkFile(value){
					if(value=='link'){
						$("#txtlink").removeAttr('disabled');
						$("#pcontactIntroImage").attr('disabled', 'disabled');
					}else{
						$("#txtlink").attr('disabled', 'disabled');
						$("#pcontactIntroImage").removeAttr('disabled');
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
						error = "<li>{$vsLang->getWords('not_select_category', 'Please chose category')}</li>";
						flag  = false;
					}

					var title = $("#obj-title").val();
					if(title == 0 || title == ""){
						error += "<li>{$vsLang->getWords('null_title', 'Title cannot be blank')}</li>";
						flag  = false;
					}
					if(!flag){
						error = "<ul class='ul-popu'>" + error + "</ul>";
						vsf.alert(error);
						return false;
					}
					vsf.uploadFile("add-edit-obj-form", "{$bw->input[0]}", "add-edit-obj-process", "obj-panel","pcontacts");
					return false;
				});
                        $('#closeObj').click(function(){
					vsf.get('{$bw->input[0]}/display-obj-list/{$bw->input['pageCate']}/&pageIndex={$bw->input['pageIndex']}','obj-panel');
				});
			</script>

			<script type="text/javascript">


			  var stockholm = new google.maps.LatLng('10.798', '106.696');
			  var parliament = new google.maps.LatLng('10.798', '106.696');
			  var marker;
			  var map;
			  function initialize() {
			    var mapOptions = {
			      zoom: 13,
			      mapTypeId: google.maps.MapTypeId.ROADMAP,
			      center: stockholm
			    };
			    map = new google.maps.Map(document.getElementById("map_canvas"),
			            mapOptions);

			    marker = new google.maps.Marker({
			      map:map,
			      draggable:true,
			      animation: google.maps.Animation.DROP,
			      position: parliament
			    });
			    google.maps.event.addListener(marker, 'click', toggleBounce);
			    google.maps.event.addListener(marker, 'mouseup', function(event) {
			    $("#gmap_lat").val(event.latLng.lat());
			    $("#gmap_lng").val(event.latLng.lng());
			  });

			  }
			  function toggleBounce() {
			    if (marker.getAnimation() != null) {
			      marker.setAnimation(null);
			    } else {
			      marker.setAnimation(google.maps.Animation.BOUNCE);
			    }
			  }


			$('.find_address').click(function(){
			$("#show_google_map").animate({"height": "toggle"}, { duration: 1000 });
			if($('#gmap_lat').val() & $('#gmap_lng').val()){
			    stockholm = new google.maps.LatLng($('#gmap_lat').val(), $('#gmap_lng').val());
			    parliament = new google.maps.LatLng($('#gmap_lat').val(), $('#gmap_lng').val());
			}

			    initialize();
			});
			$('.go_hcm').click(function(){
			    $("#show_google_map").show({"height": "toggle"}, { duration: 1000 });
			    stockholm = new google.maps.LatLng('10.798', '106.696');
			    parliament = new google.maps.LatLng('10.798', '106.696');
			    initialize();
			});

</script>

EOF;
	}

}
?>