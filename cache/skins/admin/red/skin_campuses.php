<?php
class skin_campuses{

//===========================================================================
// <vsf:MainPage:desc::trigger:>
//===========================================================================
function MainPage() {global $bw, $vsLang;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="page_tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all-top">
<ul id="tabs_nav" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner">
<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
        <a href="{$bw->base_url}campuses/display-campus-tab/&ajax=1">
        <span>{$vsLang->getWords('tab_campus_obj','Campus')}</span>
        </a>
        </li>
<!--
<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
        <a href="{$bw->base_url}menus/display-category-tab/campus/&ajax=1">
        <span>{$vsLang->getWords('tab_campus_category','Categories')}</span>
        </a>
        </li>
-->
</ul>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:displayCampusTab:desc::trigger:>
//===========================================================================
function displayCampusTab($option=array()) {global $vsLang, $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id='TabContainer'>
<div id="mainContainer">
{$option['listHTML']}
</div>
<div class="clear"></div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:objListHtml:desc::trigger:>
//===========================================================================
function objListHtml($option=array()) {global $vsLang, $bw;
$BWHTML = "";
$message = $vsLang->getWords('deleteConfirm_NoItem', "You haven't choose any items!");

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
    <div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
        <span class="ui-icon ui-icon-triangle-1-e"></span>
        <span class="ui-dialog-title">{$vsLang->getWords('listobj','List of Campus')}</span>
    </div>
    
    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner ui-widget-header">
    <li class="ui-state-default ui-corner-top">
    <a id="addPage" title="{$vsLang->getWords('add_obj','Add')}" onclick="add();" href="#">
{$vsLang->getWords('pages_addPage','Add')}
</a>
    </li>
    <li class="ui-state-default ui-corner-top">
        <a id="deletePage" title="{$vsLang->getWords('delete_obj','Delete')}" onclick="deleteCampus();" href="#">
{$vsLang->getWords('pages_deletePage','Delete')}
</a>
</li>
        <li class="ui-state-default ui-corner-top">
        <a id="hidePage" title="{$vsLang->getWords('hide_obj','Hide')}" onclick="update(0);" href="#">
{$vsLang->getWords('pages_hidePage','Hide')}
</a>
</li>
        <li class="ui-state-default ui-corner-top">
        <a id="displayPage" title="{$vsLang->getWords('unhide_obj','Display')}" onclick="update(1);" href="#">
{$vsLang->getWords('pages_unhidePage','Display')}
</a>
</li>
    </ul>
    
<table cellspacing="1" cellpadding="1" id='productListTable' width="100%">
<thead>
    <tr>
        <th style='text-align:center;' width="15"><input type="checkbox" onclick="checkAll()" name="all" /></th>
        <th style='text-align:center;' width="20">{$vsLang->getWords('labelStatus', 'Status')}</th>
        <th style='text-align:center;' width="250">{$vsLang->getWords('labelTitle', 'Name')}</td>
        <th style='text-align:center;' width="">{$vsLang->getWords('labelAddress', 'Address')}</th>
        <th style='text-align:center;' width="150">{$vsLang->getWords('labelPhone', 'Phone')}</th>
    </tr>
</thead>
<tbody>

EOF;
if( count($option['pageList'])) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_4fec6d41dd5c4($option)}

EOF;
}

$BWHTML .= <<<EOF

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
function add(){
vsf.get('campuses/editForm/','mainContainer');
}
function deleteCampus(){
jConfirm(
'{$vsLang->getWords("deleteConfirm","Are you sure to delete these information?")}', 
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
vsf.get('campuses/deleteCampus/'+jsonStr+'/','mainContainer');
}
});
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
}
function update(status){
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
vsf.get('campuses/updateStatus/'+jsonStr+'/'+status,'mainContainer');
}
</script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_4fec6d41dd5c4($option=array())
{
global $vsLang, $bw;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach( $option['pageList'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<tr>
<td align="center" width="20">
<input type="checkbox" name="obj_{$obj->getId()}" value="{$obj->getId()}" class="myCheckbox" />
</td>
<td style='text-align:center' width="20">{$obj->getStatus('image')}</td>
<td>
<a href="javascript:vsf.get('campuses/editForm/{$obj->getId()}','mainContainer')" title='{$vsLang->getWords('edit_title','Click here to edit')}' class="title">
{$obj->getTitle()}
</a>
</td>
<td>{$obj->getAddress()}</td>
<td width="50">{$obj->getPhone()}</td>
</tr>

EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:editForm:desc::trigger:>
//===========================================================================
function editForm($obj="",$option="") {global $vsLang, $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='ui-dialog ui-widget ui-widget-content ui-corner-all' id="editFormContainer">
    <div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
        <span class="ui-icon ui-icon-triangle-1-e"></span>
        <span class="ui-dialog-title">{$option['title']}</span>
        <span class="ui-dialog-title" id="close">{$vsLang->getWords('global_close','X')}</span>
    </div>
    <div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
    <form id="editForm" method="post">
    <input class="input" type="hidden" value="{$obj->getId()}" name="campusId" />
<table cellpadding="0" cellspacing="1" width="100%">
    <tr>
        <th>{$vsLang->getWords('name','Name')}</th>
            <td><input id="campusTitle" value="{$obj->getTitle()}" name="campusTitle" /></td>
        </tr>
        <tr>
        <th>{$vsLang->getWords('address','Address')}</th>
            <td><input id="campusAddress" value="{$obj->getAddress()}" name="campusAddress" /></td>
        </tr>
        <tr>
        <th>{$vsLang->getWords('phone','Phone')}</th>
            <td><input id="campusPhone" value="{$obj->getPhone()}" name="campusPhone" /></td>
        </tr>
         <tr>
        <th>{$vsLang->getWords('status','Status')}</th>
            <td>
            <label>{$vsLang->getWords('status_hide','Hide')}</lable>
            <input name="campusStatus" value="0" type="radio" class="radio"/>
            
            <label>{$vsLang->getWords('status_display','Display')}</lable>
            <input name="campusStatus" value="1" type="radio" class="radio" checked/>
            </td>
        </tr>
        <tr>
        <th>&nbsp;</th>
            <td>
            <button class="ui-state-default ui-corner-all" type="submit">{$option['button']}</button>
            </td>
        </tr>
    </table>
</form>
</div>
<div id="result"></div>
</div>
<script type="text/javascript">
$(document).ready(function(){
vsf.jRadio('{$obj->getStatus()}', 'campusStatus');
});
$('#editForm').submit(function(){
if(!$('#campusTitle').val()){
jAlert(
        '{$vsLang->getWords('title_empty','This field can not be empty!')}',
        '{$bw->vars['global_websitename']} Dialog'
        );
        $('#campusTitle').focus(); 
$('#campusTitle').addClass('ui-state-error ui-corner-all-inner');
        return false;
}
        vsf.submitForm($('#editForm'),'campuses/editCampus/','mainContainer');
        return false;
});
$('#close').click(function(){
vsf.get('campuses/getList/','mainContainer');
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>