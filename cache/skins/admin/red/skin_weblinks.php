<?php
class skin_weblinks{

//===========================================================================
// <vsf:objListHtml:desc::trigger:>
//===========================================================================
function objListHtml($objItems=array(),$option=array()) {global $bw, $vsLang, $vsSettings, $vsTemplate;
$this->vsSettings = $vsSettings;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="red">{$option['message']}</div>
<form id="obj-list-form">
<input type="hidden" name="checkedObj" id="checked-obj" value="" />
<input type="hidden" name="categoryId" value="{$option['categoryId']}" id="categoryId" />
<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
    <div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
        <span class="ui-icon ui-icon-note"></span>
        <span class="ui-dialog-title">{$vsLang->getWords('tab_obj_list_title',"Item List")}</span>
    </div>
    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner ui-widget-header">
    <li class="ui-state-default ui-corner-top" id="add-objlist-bt">
    <a href="#" title="{$vsLang->getWords('global_add_title',"Add")}">
{$vsLang->getWords('global_add',"Add")}
</a>
</li>
        <li class="ui-state-default ui-corner-top" id="hide-objlist-bt">
        <a href="#" title="{$vsLang->getWords('global_hide_title',"Hide")}">
{$vsLang->getWords('global_hide','Hide')}
</a>
</li>
        <li class="ui-state-default ui-corner-top" id="visible-objlist-bt">
        <a href="#" title="{$vsLang->getWords('global_display_title',"Display")}">
{$vsLang->getWords('global_display','Display')}
</a>
</li>
        <li class="ui-state-default ui-corner-top" id="delete-objlist-bt">
        <a href="#" title="{$vsLang->getWords('global_delete_title',"Delete")}">
{$vsLang->getWords('global_delete','Delete')}
</a>
</li>
    </ul>
<table cellspacing="1" cellpadding="1" id='objListHtmlTable' width="100% !important">
<thead>
    <tr>
        <th width="15">
        <input type="checkbox" onclick="vsf.checkAll()" name="all" />
        </th>
        <th width="60">
{$vsLang->getWords('obj_list_status', 'Status')}
</th>
        <th>
{$vsLang->getWords('obj_list_title', 'Title')}
</td>
        <th width="50">
{$vsLang->getWords('obj_list_index', 'Index')}
</th>

EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_option', 0, "weblinks", 1, 1) ) {
$BWHTML .= <<<EOF

        <th width="150">
{$vsLang->getWords('obj_list_option', 'Option')}
</th>

EOF;
}

$BWHTML .= <<<EOF

    </tr>
</thead>
<tbody>
{$this->__foreach_loop__id_4df72a77f3e66($objItems,$option)}
</tbody>
<tfoot>
<tr>
<th colspan='4' align='right'>
{$option['paging']}
</th>
</tr>
                                                     <tr >
                                                          <th colspan='6' align="left">
                                                          <span style="padding-left: 10px;line-height:16px;"><img src="{$bw->vars['img_url']}/enable.png" /> {$vsLang->getWords('global_status_enable1', 'Current Show')}</span>
                                                          <span style="padding-left: 10px;line-height:16px;"><img src="{$bw->vars['img_url']}/disabled.png" /> {$vsLang->getWords('global_status_disabled1', 'Not Show')}</span>
                                                          
                                                          </th>
                                                    </tr>
</tfoot>
</table>
 
</div>
</form>
<div id="albumn"></div>
<script type="text/javascript">
$('#add-objlist-bt').click(function(){
vsf.get('{$bw->input[0]}/add-edit-obj-form/&pageCate={$bw->input[2]}','obj-panel');
});
$('#hide-objlist-bt').click(function() {
if(vsf.checkValue())
vsf.get('{$bw->input[0]}/hide-checked-obj/'+$('#checked-obj').val()+'/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}', 'obj-panel');
});
$('#visible-objlist-bt').click(function() {
if(vsf.checkValue())
vsf.get('{$bw->input[0]}/visible-checked-obj/'+$('#checked-obj').val()+'/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}', 'obj-panel');
});
$('#delete-objlist-bt').click(function() {
if(vsf.checkValue())
jConfirm(
"{$vsLang->getWords('obj_delete_confirm', "Are you sure want to delete this {$bw->input[0]}?")}",
"{$bw->vars['global_websitename']} Dialog",
function(r) {
if(r) {
vsf.get('{$bw->input[0]}/delete-obj/'+$('#checked-obj').val()+'/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}', 'obj-panel');
}
}
);
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4df72a77f3e66($objItems=array(),$option=array())
{
global $bw, $vsLang, $vsSettings, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $objItems as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<tr class="$class $vsf_class">
<td align="center">
<input onclick="vsf.checkObject();" name="obj_{$obj->getId()}" value="{$obj->getId()}" type="checkbox" class="myCheckbox" />
</td>
<td style='text-align:center'>
{$obj->getStatus('image')}
</td>
<td>
<a href="javascript:vsf.get('{$bw->input[0]}/add-edit-obj-form/{$obj->getId()}/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}','obj-panel')" title='{$vsLang->getWords('global_edit_obj_title',"Click here to edit")}' class='editObj'>
{$obj->getTitle()}
</a><br/>
{$obj->getWebsite()}
</td>
<td>
{$obj->getIndex()}
</td>

EOF;
if( $this->vsSettings->getSystemKey($bw->input[0].'_option', 0, "weblinks", 1, 1) ) {
$BWHTML .= <<<EOF

<td>
</td>

EOF;
}

$BWHTML .= <<<EOF

</tr>

EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:addEditObjForm:desc::trigger:>
//===========================================================================
function addEditObjForm($objItem="",$option=array()) {global $vsLang, $bw,$vsSettings;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="error-message" name="error-message"></div>
<form id='editForm' method="POST"  enctype='multipart/form-data'>
<input type="hidden" id="obj-cat-id" name="weblinkCatId" value="{$objItem->getCatId()}" />
<input type="hidden" name="weblinkId" value="{$objItem->getId()}" />
<input type="hidden" id="pageCate" name="pageCate" value="{$bw->input['pageCate']}" />
<input type="hidden" id="pageIndex" name="pageIndex" value="{$bw->input['pageIndex']}" />
<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
<span class="ui-dialog-title">{$option['formTitle']}</span>
                        <p style="align:right; float: right; color: #FFFFFF; cursor: pointer">
                        <span id="close">{$vsLang->getWords('obj_back', 'Back')}</span>
                        </p>
</div>
<table class="ui-dialog-content ui-widget-content" cellspacing="1" border="0" style="width:100%">
                  <tr class="smalltitle">
<td>{$vsLang->getWords('obj_title', 'Title')}:</td>
<td><input size="43" name="weblinkTitle" value="{$objItem->getTitle()}" id="obj-title"/></td>

EOF;
if($vsSettings->getSystemKey($bw->input[0].'_image', 0, $bw->input[0], 1, 1)) {
$BWHTML .= <<<EOF

<td align='left' rowspan="4">
                                
EOF;
if($objItem->getFileId()) {
$BWHTML .= <<<EOF

                                {$objItem->createImageCache($objItem->getFileId(),$vsSettings->getSystemKey($bw->input[0].'_image_width', 250, $bw->input[0], 0), $vsSettings->getSystemKey($bw->input[0].'_image_height', 150, $bw->input[0]))}
                                <input name="oldImage" value="{$objItem->getFileId()}" type="hidden" />
                                <p>{$vsLang->getWords('obj_image_dellete', 'Delete Image')}<input type="checkbox" class="checkbox" name="partnerDeleteImage" /></p>
                                
EOF;
}

else {
$BWHTML .= <<<EOF

                               
                                {$objItem->createImageCache($objItem->getfileId(), $vsSettings->getSystemKey($bw->input[0].'_image_width', 250, $bw->input[0], 0), $vsSettings->getSystemKey($bw->input[0].'_image_height', 150, $bw->input[0]),0,1, 1, 1)}
                                
EOF;
}
$BWHTML .= <<<EOF
                                                    
</td>

EOF;
}

$BWHTML .= <<<EOF

</tr>
<tr class="smalltitle">
<td>{$vsLang->getWords('obj_website', 'Website')}:</td>
<td><input size="43" name="weblinkWebsite" value="{$objItem->getWebsite()}" id="obj-website"/></td>
</tr>

EOF;
if($vsSettings->getSystemKey($bw->input[0].'_position', 0, $bw->input[0], 1, 1)) {
$BWHTML .= <<<EOF

<tr class="smalltitle">
    <td>{$vsLang->getWords('obj_Position', "Position")}</td>
    <td>
    <input type="radio" value="0" name="weblinkPosition" class="radio">
    <label style="padding-right: 10px" for="left">{$vsLang->getWords('global_left', "Left")}</label>
    <input type="radio" value="1" name="weblinkPosition" class="radio">
    <label style="padding-right: 10px" for="left">{$vsLang->getWords('global_right', "Right")}</label>
    <input type="radio" value="2" name="weblinkPosition" class="radio">
    <label style="padding-right: 10px" for="left">{$vsLang->getWords('global_top', "Top")}</label>
    <input type="radio" value="3" name="weblinkPosition" class="radio">
    <label style="padding-right: 10px" for="left">{$vsLang->getWords('global_bottom', "Bottom")}</label>
    </td>
</tr>

EOF;
}

$BWHTML .= <<<EOF

<tr class="smalltitle">
<td>{$vsLang->getWords('obj_Index', 'Index')}:</td>
<td>
<input size="43" name="weblinkIndex" value="{$objItem->getIndex()}" id="obj-Index"/>
</td>
</tr>
                 <tr class="smalltitle">
<td>
{$vsLang->getWords('obj_Status', 'Status')}:
                     </td>
                     <td>
                                        <input type="radio" value="1" name="weblinkStatus" id="weblinkStatus" class="radio">
   <label style="padding-right: 10px" for="left">{$vsLang->getWords('global_status_enable', "Enable")}</label>
                     <input type="radio" value="0" name="weblinkStatus" id="weblinkStatus" class="radio">
   <label style="padding-right: 10px" for="left">{$vsLang->getWords('global_status_disable', "Disable")}</label>
                        
                     </td>
</tr>
                  
EOF;
if($vsSettings->getSystemKey($bw->input[0].'_begintime', 0, $bw->input[0], 1, 1)) {
$BWHTML .= <<<EOF

                       <tr class="smalltitle">
                           <td>
                          {$vsLang->getWords('obj_begintime', 'Begin Time')}
                           </td>
                           <td>
                           <input size="43" name="weblinkBeginTime" value="{$objItem->getBeginTime("SHORT")}" id="weblinkBeginTime"/>
                           </td>
                       </tr>
                       
EOF;
}

$BWHTML .= <<<EOF

                       
EOF;
if($vsSettings->getSystemKey($bw->input[0].'_exptime', 0, $bw->input[0], 1, 1)) {
$BWHTML .= <<<EOF

                       <tr class="smalltitle">
                            <td>
{$vsLang->getWords('obj_exptime', 'Expire Time')}
                            </td>
                            <td>
                               <input size="43" name="weblinkExpTime" value="{$objItem->getExpTime("SHORT")}" id="weblinkExpTime"/>
                            </td>
                        </tr>
                   
EOF;
}

$BWHTML .= <<<EOF

                   
EOF;
if($vsSettings->getSystemKey($bw->input[0].'_price', 0, $bw->input[0], 1, 1)) {
$BWHTML .= <<<EOF

                        <tr class="smalltitle">
                             <td>
                                 {$vsLang->getWords('obj_price', 'Price')}
                             </td>
                             <td>
<input size="43" name="weblinkPrice" value="{$objItem->getPrice()}" id="obj-price"/>
                             </td>
                         </tr>
                  
EOF;
}

$BWHTML .= <<<EOF


<tr class="smalltitle">
<td class="ui-dialog-buttonpanel" colspan="2" align="center">
<input type="submit" name="submit" value="{$option['formTitle']}" />
</td>
</tr>
</table>
</div>
</form>
<script language="javascript">
                $("#close").click(function(){
                     vsf.get('{$bw->input[0]}/display-obj-list/'+$("#obj-cat-id").val()+'/&pageIndex={$bw->input['pageIndex']}&pageCate={$bw->input['pageCate']}', 'obj-panel');
                });
                
$(window).ready(function() {
                    $("input.numeric").numeric();
vsf.jRadio('{$objItem->getStatus()}','weblinkStatus');
vsf.jRadio('{$objItem->getPosition()}','weblinkPosition');
                    vsf.jSelect('{$objItem->getCatId()}','obj-category');
                    $('#weblinkExpTime').datepicker({dateFormat: 'dd/mm/yy'});
                    $('#weblinkBeginTime').datepicker({dateFormat: 'dd/mm/yy'});
                    $('#editForm').submit(function(){
var flag  = true;
var error = "";
var categoryId = "";
var count=0;
                    if(!$("#obj-cat-id").val()) $("#obj-cat-id").val($("#idCategory").val());
                    var catId = $("#obj-cat-id").val();
                    
                   
EOF;
if($vsSettings->getSystemKey($bw->input[0].'_category_list',1, $bw->input[0], 1, 1)) {
$BWHTML .= <<<EOF

                      if(!($("#obj-category option:selected").val()&&$("#obj-category option:selected").val()!=0)){
                        error = "<li>{$vsLang->getWords('not_select_category', 'Please select category!')}</li>";
flag  = false;
                        $('#obj-category').addClass('ui-state-error ui-corner-all-inner');
}

EOF;
}

$BWHTML .= <<<EOF

                   var title = $("#obj-title").val();
if(title == 0 || title == ""){
error += "<li>{$vsLang->getWords('null_title', 'Please enter weblink title!')}</li>";
flag  = false;
$('#obj-title').addClass('ui-state-error ui-corner-all-inner');
}
                   var title = $("#obj-address").val();
if(title == 0 || title == ""){
error += "<li>{$vsLang->getWords('null_address', 'Please enter weblink address!')}</li>";
flag  = false;
$('#obj-address').addClass('ui-state-error ui-corner-all-inner');
}
                   if(!flag){
error = "<ul class='ul-popu'>" + error + "</ul>";
vsf.alert(error);
return false;
}
vsf.uploadFile("editForm", "{$bw->input[0]}", "add-edit-obj-process", "obj-panel", "{$bw->input[0]}");
return false;
});
});
                 $('#obj-category').change(function() {
var parentId = '';
$("#obj-category option:selected").each(function () {
parentId = $(this).val();
});
$('#obj-cat-id').val(parentId);
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:categoryList:desc::trigger:>
//===========================================================================
function categoryList($categoryGroup=array()) {global $vsLang, $bw;

//--starthtml--//
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
        {$this->__foreach_loop__id_4df72a7800bc7($categoryGroup)}
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
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4df72a7800bc7($categoryGroup=array())
{
global $vsLang, $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $categoryGroup->getChildren() as $oMenu )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <option title="{$oMenu->getAlt()}" value="{$oMenu->id}">| - - {$oMenu->title} ({$oMenu->getIndex()} - $oMenu->id)</option>
        
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:displayObjTab:desc::trigger:>
//===========================================================================
function displayObjTab($option="") {global $bw,$vsSettings;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($vsSettings->getSystemKey($bw->input[0].'_category_list', 0, $bw->input[0], 1, 1)) {
$BWHTML .= <<<EOF

        <div class='left-cell'>
        <div id='category-panel'>{$option['categoryList']}</div>
        </div>
<input type="hidden" id="idCategory" name="idCategory" />
<div id="obj-panel" class="right-cell">{$option['objList']}</div>
<div class="clear"></div>

EOF;
}

else {
$BWHTML .= <<<EOF

<input type="hidden" id="idCategory" name="idCategory" />
<div id="obj-panel" style="width:100%" class="right-cell">{$option['objList']}</div>
<div class="clear"></div>
        
EOF;
}
$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:loadDefault:desc::trigger:>
//===========================================================================
function loadDefault() {global $bw, $vsLang,$vsSettings;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="page_tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all-top">
<ul id="tabs_nav" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner">
    <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
        <a href="{$bw->base_url}{$bw->input[0]}/display-obj-tab/&ajax=1">
        <span>{$vsLang->getWords('tab_obj_objes',"{$bw->input[0]}")}</span>
        </a>
        </li>

EOF;
if($vsSettings->getSystemKey('weblinks_category_tab', 0, 'weblinks', 1, 1)) {
$BWHTML .= <<<EOF

<li class="ui-state-default ui-corner-top">
        <a href="{$bw->base_url}menus/display-category-tab/{$bw->input[0]}/&ajax=1"><span>{$vsLang->getWords('global_categories','Categories')}</span></a>
        </li>
        
EOF;
}

$BWHTML .= <<<EOF

        
EOF;
if($vsSettings->getSystemKey('weblinks_setting_tab', 1, 'weblinks', 1 ,1)) {
$BWHTML .= <<<EOF

        <li class="ui-state-default ui-corner-top">
        <a href="{$bw->base_url}settings/moduleObjTab/{$bw->input[0]}/&ajax=1">
<span>{$vsLang->getWords("tab_{$bw->input[0]}_setting",'Settings')}</span>
</a>
        </li>
        
EOF;
}

$BWHTML .= <<<EOF

</ul>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>