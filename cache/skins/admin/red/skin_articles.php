<?php
class skin_articles{

//===========================================================================
// <vsf:getList:desc::trigger:>
//===========================================================================
function getList($option=array()) {global $bw, $vsLang, $vsSettings, $vsSetting;


//--starthtml--//
$BWHTML .= <<<EOF
        <div class="red">{$option['message']}</div>
<form id="obj-list-form">
<input type="hidden" name="checkedObj" id="checked-obj" value="" />
<input type="hidden" name="categoryId" value="{$option['catId']}" id="categoryId" />
<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
<span class="ui-icon ui-icon-note"></span>
<span class="ui-dialog-title">{$vsLang->getWords('obj_list_title','List of Articles')}</span>
</div>
                                

EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_add_hide_show_delete',1, $bw->input[0]) ) {
$BWHTML .= <<<EOF

<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner ui-widget-header">
                        <li class="ui-state-default ui-corner-top">
                        <a href="#" id="addObj" title="{$vsLang->getWords('obj_list_add_title','Click here to add an new article')}">
{$vsLang->getWords('obj_list_add','Add')}
</a>
                        </li>
                        <li class="ui-state-default ui-corner-top">
                        <a href="#" id="enableObj" title="{$vsLang->getWords('obj_list_enabel_title','Click here to enable checked items')}">
{$vsLang->getWords('obj_list_enabel','Enable')}
</a>
                        </li>
                        <li class="ui-state-default ui-corner-top">
                        <a href="#" id="disableObj" title="{$vsLang->getWords('obj_list_disable_title','Click here to disable checked items')}">
{$vsLang->getWords('obj_list_disabel','Disable')}
</a>
                        </li>
                                    
                        
EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_home',0, $bw->input[0]) ) {
$BWHTML .= <<<EOF

                        <li class="ui-state-default ui-corner-top" id="home-objlist-bt">
                        <a href="#" id="homeObj" title="{$vsLang->getWords('obj_list_home_title','Click here to set checked items display at home page')}">
{$vsLang->getWords('obj_list_home','Home')}
</a>
                        </li>

EOF;
}

$BWHTML .= <<<EOF

<li class="ui-state-default ui-corner-top">
<a href="#" id="delObj" title="{$vsLang->getWords('obj_list_del_title','Click here to set delete items')}">
{$vsLang->getWords('obj_list_del','Del')}
</a>
</li>
</ul>

EOF;
}

$BWHTML .= <<<EOF

<table cellspacing="1" cellpadding="1" id='objListHtmlTable' width="100%">
<thead>
    <tr>
        <th width="10">
        <input type="checkbox" onclick="vsf.checkAll()" value='0' name="all" />
        </th>
        <th width="60">
{$vsLang->getWords($bw->input[0].'_status_title','Status')}
</th>
        <th>
{$vsLang->getWords($bw->input[0].'_title_title','Title')}
</td>
        <th width="30">
{$vsLang->getWords($bw->input[0].'_index_title','Index')}
</th>
        
EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_option', 0, $bw->input[0], 1, 1) ) {
$BWHTML .= <<<EOF

        <th width="80" align="center">
{$vsLang->getWords($bw->input[0].'_option_title','Option')}
</th>
        
EOF;
}

$BWHTML .= <<<EOF

    </tr>
</thead>
<tbody>

EOF;
if( $option['pageList'] ) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_4ff274511316e($option)}

EOF;
}

$BWHTML .= <<<EOF

</tbody>
<tfoot>
<tr>
<th colspan='5'>
<div style='float:right;'>{$option['paging']}</div>
</th>
</tr>
<tr>
<th colspan='6' align="left">
<span style="padding-left: 10px;line-height:16px;">
<img src="{$bw->vars['img_url']}/enable.png" />{$vsLang->getWords('enable_status_title','Enable')}</span>
<span style="padding-left: 10px;line-height:16px;">
<img src="{$bw->vars['img_url']}/disabled.png" />{$vsLang->getWords('disabled_status_title','Disabled')}</span>

EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_home',0, $bw->input[0]) ) {
$BWHTML .= <<<EOF

<span style="padding-left: 10px;line-height:16px;">
<img src="{$bw->vars['img_url']}/home.png" /> {$vsLang->getWords('home_status_title','Home')}</span>

EOF;
}

$BWHTML .= <<<EOF

</th>
</tr>
</tfoot>
</table>
</div>
</form>
<div class="clear"></div>

<script type="text/javascript">
$('#addObj').click(function(){
vsf.get('{$bw->input[0]}/edit/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}', 'obj-panel');
return false;
});

$('#enableObj').click(function() {
if(vsf.checkValue()){
var cobj = $('#checked-obj').val();
var cat  = $("#idCategory").val();
vsf.get('{$bw->input[0]}/update/'+cobj+'/'+cat+'/&status=enable&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}', 'obj-panel');
return false;
}
});

$('#disableObj').click(function() {
if(vsf.checkValue()){
var cobj = $('#checked-obj').val();
var cat  = $("#idCategory").val();
vsf.get('{$bw->input[0]}/update/'+cobj+'/'+cat+'/&status=disable&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}', 'obj-panel');
return false;
}
});


$('#delObj').click(function() {
if(vsf.checkValue())
jConfirm(
"Are you sure to delete these items",
"{$bw->vars['global_websitename']} Dialog",
function(r){
if(r){
var cobj = $('#checked-obj').val();
var cat  = $("#idCategory").val();
vsf.get('{$bw->input[0]}/delete/'+cobj+'/'+cat+'/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}','obj-panel');
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
function __foreach_loop__id_4ff274511316e($option=array())
{
global $bw, $vsLang, $vsSettings, $vsSetting;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['pageList'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<tr class="$vsf_class">
<td align="center">

EOF;
if(!$vsSettings->getSystemKey($bw->input[0].'_code',0) && $obj->getCode()) {
$BWHTML .= <<<EOF

<img src="{$bw->vars['img_url']}/disabled.png" />

EOF;
}

else {
$BWHTML .= <<<EOF

<input type="checkbox" onclicktext="vsf.checkObject();" onclick="vsf.checkObject();" name="obj_{$obj->getId()}" value="{$obj->getId()}" class="myCheckbox" />

EOF;
}
$BWHTML .= <<<EOF

</td>
<td style='text-align:center'>{$obj->getStatus('image')}</td>
<td>
<a href="javascript:vsf.get('{$bw->input[0]}/edit/{$obj->getId()}/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}', 'obj-panel')"  class="editObj" >
{$obj->getTitle()}
</a>
</td>
<td>{$obj->getIndex()}</td>

EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_option', 0, $bw->input[0], 1, 1) ) {
$BWHTML .= <<<EOF

<td>
{$this->addOptionList($obj)}
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
// <vsf:displayObjTab:desc::trigger:>
//===========================================================================
function displayObjTab($option="") {global $bw, $vsSettings, $langObject;


//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($vsSettings->getSystemKey($bw->input[0].'_category_list',1, $bw->input[0])) {
$BWHTML .= <<<EOF

        <div class='left-cell'><div id='category-panel'>{$option['categoryList']}</div></div>
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
// <vsf:editObj:desc::trigger:>
//===========================================================================
function editObj($obj="",$option=array()) {global $vsLang, $bw, $vsSettings, $langObject;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="error-message" name="error-message"></div>
                        
<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
<span class="ui-dialog-title">{$option['formTitle']}</span>
<p style="float:right; cursor:pointer;">
<span class='ui-dialog-title' id='closeObj'>X</span>
</p>
</div>
<form id='edit-form' name="edit-form" method="post" enctype='multipart/form-data'>
<input type="hidden" id="obj-cat-id" name="articleCatId" value="{$option['categoryId']}" />
<input type="hidden" name="articleId" value="{$obj->getId()}" />
<input type="hidden" name="pageIndex" value="{$bw->input['pageIndex']}" />
<input type="hidden" name="pageCate" value="{$bw->input['pageCate']}" />
                <input type="hidden" name="articlePostDate" value="{$obj->getPostDate()}" />
                <input type="hidden" name="articleImage" value="{$obj->getImage()}" />

                
<table class="ui-dialog-content ui-widget-content" style="width:100%;">
<tr class='smalltitle'>
<td class="label_obj" width="75">
{$vsLang->getWords('edit_form_title', 'Title')}:
</td>
<td colspan="3">
<input style="width:95%;" name="articleTitle" value="{$obj->getTitle()}" id="obj-title" />
</td>
</tr>


EOF;
if($vsSettings->getSystemKey($bw->input[0].'_code',0, $bw->input[0])) {
$BWHTML .= <<<EOF

<tr class='smalltitle'>
<td class="label_obj" width="75">
{$vsLang->getWords('edit_form_code', 'Code')}:
</td>
<td colspan="3">
<input style="width:40" name="articleCode" value="{$obj->getCode()}"/>
</td>
</tr>

EOF;
}

$BWHTML .= <<<EOF


<tr class='smalltitle'>
<td class="label_obj"  width="75">
{$vsLang->getWords('edit_form_code', 'Index')}:
</td>
<td width="170" colspan="3">
<input size="10" class="numeric" name="articleIndex" value="{$obj->getIndex()}" />


<span style="margin-right: 20px;margin-left:40px">{$vsLang->getWords('edit_form_status', 'Status')}</span>                                
<label>{$vsLang->getWords('edit_form_status_enable','Enable')}</label>
<input name="articleStatus" value='1' class='c_noneWidth' type="radio" checked />
<label>{$vsLang->getWords('edit_form_status_disabled','Disabled')}</label>
<input name="articleStatus" value='0' class='c_noneWidth' type="radio" />


EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_home', 0, $bw->input[0])) {
$BWHTML .= <<<EOF

<label>{$vsLang->getWords('edit_form_status_home','Home')}</label>
<input name="articleStatus" value='2' class='c_noneWidth' type="radio" />

EOF;
}

$BWHTML .= <<<EOF

</td>
</tr>


EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_time', 1, $bw->input[0])) {
$BWHTML .= <<<EOF

<tr class='smalltitle'>
<td class="label_obj"  width="75">
{$vsLang->getWords('edit_form_time', 'Time')}:
</td>
<td width="170" colspan="3">
<input size="10" id="articleTime" name="articleTime" value="{$obj->getTime('SHORT')}" />
</td>
</tr>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($vsSettings->getSystemKey($bw->input[0].'_image',1, $bw->input[0])) {
$BWHTML .= <<<EOF

<tr class='smalltitle'>
<td class="label_obj">
{$vsLang->getWords('edit_form_image', 'Image')}:
</td>
<td>
<input size="27" type="file" name="articleIntroImage" id="articleIntroImage" /><br />
</td>
</tr>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_intro', 1, $bw->input[0]) ) {
$BWHTML .= <<<EOF

<tr class='smalltitle'>
<td class="label_obj" width="75">
{$vsLang->getWords('edit_form_intro', 'Intro')}:
</td>
<td colspan="3">
{$obj->getIntro()}
</td>
</tr>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($vsSettings->getSystemKey($bw->input[0].'_content',1, $bw->input[0])) {
$BWHTML .= <<<EOF

<tr class='smalltitle'>
<td colspan="4" align="center">{$obj->getContent()}</td>
</tr>

EOF;
}

$BWHTML .= <<<EOF


<tr class='smalltitle'>
<td class="label_obj" width="75">Url alias:</td>
<td colspan="3">
<span>{$bw->vars['board_url']}/</span>
<input style="width:70%;" name="metaURL" value="{$obj->metaURL}" id="obj-mtUrl"/>.html
</td>
</tr> 
                                                                
                                                                
                        <tr class='smalltitle'>
<td class="label_obj" width="75">Meta Title:</td>
<td colspan="3">
<input style="width:100%;" name="metaTitle" value="{$obj->metaTitle}" id="obj-mtTitle"/>
</td>
</tr>                
                                                                
<tr class='smalltitle'>
<td class="label_obj" width="75">Meta KeyWords:</td>
<td colspan="3">
<input style="width:100%;" name="metaKeyword" value="{$obj->metaKeyword}" id="obj-MtKeyWord"/>
</td>
</tr>
                                                                
                        <tr class='smalltitle'>
<td class="label_obj" width="75">Meta Description:</td>
<td colspan="3">
<textarea id="obj-MtDesc" style="width:100%;" name="metaDesc">{$obj->metaDesc}</textarea>
</td>
</tr>

<tr>
<td class="ui-dialog-buttonpanel" colspan="4" align="center">
<input type="submit" name="submit" value="{$option['formSubmit']}" />
</td>
</tr>
</table>
</form>
<script type='text/javascript' src='{$bw->vars['js']}/icampus/scripts/remove_accent.js'></script>
<script type='text/javascript' src='{$bw->vars['js']}/jquery/ui.datepicker.js'></script>
<script type='text/javascript'>
$(document).ready(function(){
$("#articleTime").datepicker({dateFormat: 'mm/dd/yy', minDate:0, maxDate:'+3m'});

$('#obj-category option').each(function(){
$(this).removeAttr('selected');
});
$("input.numeric").numeric();


vsf.jRadio('{$obj->getStatus()}','articleStatus');
vsf.jSelect('{$obj->getCatId()}','obj-category');

$('#obj-title').blur(function(){
var permalink = removeDiacritics($(this).val());
$('#obj-mtUrl').val('{$obj->prefix}'+permalink);
});


var space = "-";
$('#obj-mtUrl').keydown(function(e){
if(e.keyCode==32){
var startPos = this.selectionStart;
var endPos = this.selectionEnd;
var text = $(this).val().substring(0,this.selectionStart)+space+$(this).val().substring(this.selectionStart,$(this).val().length);
$(this).val(text);
this.selectionStart=startPos+space.length;
this.selectionEnd=startPos+space.length;
return false;
}
});
});


$('#edit-form').submit(function(){
var flag  = true; var error = "";
var categoryId = 0; var count = 0;

$("#obj-category option").each(function(){
count++;
            if($(this).attr('selected')) categoryId = $(this).val();
});

$('#obj-cat-id').val(categoryId);

if(categoryId == 0 && count>1){
error = "<li>{$vsLang->getWords('valid_edit_form_cat', 'You have to chose a category')}</li>";
flag  = false;
}

var title = $("#obj-title").val();
if(title == 0 || title == ""){
error += "<li>{$vsLang->getWords('valid_edit_form_title', 'Title cannot be blank')}</li>";
flag  = false;
}
if(!flag){
error = "<ul class='ul-popu'>" + error + "</ul>";
vsf.alert(error);
return false;
}
vsf.uploadFile("edit-form", "{$bw->input[0]}", "edit", "obj-panel", "{$bw->input[0]}");
return false;
});

              $('#closeObj').click(function(){                                       
vsf.get('{$bw->input[0]}/objTab/{$bw->input['pageCate']}/&pageIndex={$bw->input['pageIndex']}','obj-panel');
});
</script>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:loadDefault:desc::trigger:>
//===========================================================================
function loadDefault() {global $bw, $vsLang, $vsSettings, $langObject;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="page_tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all-top">
<ul id="tabs_nav" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner">
    <li class="ui-state-default ui-corner-top">
        <a href="{$bw->base_url}{$bw->input[0]}/objTab/&ajax=1">
        <span>{$vsLang->getWords("{$bw->input[0]}_obj_tab_title", "{$bw->input[0]}")}</span>
        </a>
        </li>
                                
        
EOF;
if($vsSettings->getSystemKey($bw->input[0].'_category_tab', 0, "{$bw->input[0]}", 1, 1)) {
$BWHTML .= <<<EOF

<li class="ui-state-default ui-corner-top">
                        <a href="{$bw->base_url}menus/display-category-tab/{$bw->input[0]}/&ajax=1">
<span>{$vsLang->getWords("{$bw->input[0]}_cat_tab_title", 'Category')}</span>
</a>
</li>
        
EOF;
}

$BWHTML .= <<<EOF

        
        
EOF;
if($vsSettings->getSystemKey($bw->input[0].'_setting_tab',0, "{$bw->input[0]}", 1, 1)) {
$BWHTML .= <<<EOF

        <li class="ui-state-default ui-corner-top">
        <a href="{$bw->base_url}settings/moduleObjTab/{$bw->input[0]}/&ajax=1">
<span>{$vsLang->getWords("{$bw->input[0]}_setting_tab_title", 'Settigs')}</span>
</a>
        </li>
        
EOF;
}

$BWHTML .= <<<EOF

</ul>
<!--
<input id='taotest' />
<script>
$("#taotest").datepicker({ dateFormat: 'dd/mm/yy'  , minDate:0, maxDate:'+3m'});
</script>

-->
</div>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>