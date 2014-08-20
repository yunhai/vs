<?php
if(!class_exists('skin_objectadmin'))
require_once ('./cache/skins/admin/red/skin_objectadmin.php');
class skin_newsletters extends skin_objectadmin {

//===========================================================================
// <vsf:getListItemTable:desc::trigger:>
//===========================================================================
function getListItemTable($objItems=array(),$option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="ui-dialog">
<div >
<span class="ui-dialog-title">{$this->getLang()->getWords($this->modelName,$this->modelName)}</span>
</div>

EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_search_form",1,$bw->input[0])) {
$BWHTML .= <<<EOF

{$this->getSearchForm($option)}

EOF;
}

$BWHTML .= <<<EOF

<form class="frm_obj_list" id="frm_obj_list">
<div>

EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName.'_button_delete',1)) {
$BWHTML .= <<<EOF

<input type="button"  class="btnDelete" id="btn-delete-obj" value="{$this->getLang()->getWords('action_delete')}"/>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName.'_button_disable',1)) {
$BWHTML .= <<<EOF

<input type="button" class="btnDisable" id="btn-disable-obj" value="{$this->getLang()->getWords('action_hide')}"/>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName.'_button_visible',1)) {
$BWHTML .= <<<EOF

<input type="button" class="btnEnable" id="btn-enable-obj" value="{$this->getLang()->getWords('action_visible')}"/>

EOF;
}

$BWHTML .= <<<EOF

</div>
<div id="{$this->modelName}_item_panel">
<input type="hidden" name="catId" value="{$bw->input['catId']}"/>
<input type="hidden" name="pageIndex" value="{$bw->input['pageIndex']}"/>
<table class="obj_list">
<thead>
<tr>
<th class="cb"><input type="checkbox" onClick="checkAllClick()" class="check_alll" name=""/></th>
<th class="id">{$this->getLang()->getWords("id")}</th>
<th class="title">{$this->getLang()->getWords("email","Địa chỉ email")}</th>

EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_status",1,$bw->input[0])) {
$BWHTML .= <<<EOF

<th class="status">{$this->getLang()->getWords("status")}</th>

EOF;
}

$BWHTML .= <<<EOF

<th class="action">{$this->getLang()->getWords("action")}</th>
</tr>
</thead>
<tbody>

EOF;
if(is_array($objItems)) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_53f47b8a719ff($objItems,$option)}

EOF;
}

$BWHTML .= <<<EOF

</tbody>
<tfoot>
<tr>
<th colspan="10">{$option['paging']}</th>
</tr>
</tfoot>
</table>
</div>
<div class="more_action">
<img width="38" height="22" alt="With selected:" src="{$bw->vars['img_url']}/arrow_ltr.png" class="selectallarrow">

EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_category_list",0,$bw->input[0])) {
$BWHTML .= <<<EOF

<label>Move selected to
<select name='toCatId'>
{$this->model->getCategories()->getChildrenBoxOption()}
</select>
</label>
<input type="button" class="btnOk" name="" onClick="changCate()"  value="go"/>
<br>

EOF;
}

$BWHTML .= <<<EOF


EOF;
if($option['vdata']) {
$BWHTML .= <<<EOF

<input type="hidden" value='{$option['vdata']}' name="vdata"/>

EOF;
}

$BWHTML .= <<<EOF

<!--MORE_ACTION-->
</div>
</form>
</div>
<script>
var objChecked=new Array();
////////////////checked
function checkAllClick(){
var check=$("#vs_panel_{$this->modelName}  .check_alll").attr("checked");
objChecked=new Array();
$("#vs_panel_{$this->modelName} .btn_checkbox").each(function(){
if(check){
$(this).attr("checked","checked").change();
objChecked.push($(this).val());
}else{
$(this).attr("checked","").change();
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
alert("{$this->getLang()->getWords('error_none_select')}");
return false;
}
jConfirm(
                     "{$this->getLang()->getWords('yesno_delete')}?",
                     "{$bw->vars['global_websitename']} Dialog",
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
alert("{$this->getLang()->getWords('error_none_select')}");
return false;
}
vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_hide_checked/'+objChecked,'vs_panel_{$this->modelName}');
return false;
});
$("#vs_panel_{$this->modelName} #btn-trash-obj").click(function(){
if(objChecked.length==0){
alert("{$this->getLang()->getWords('error_none_select')}");
return false;
}
vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_trash_checked/'+objChecked,'vs_panel_{$this->modelName}');
return false;
});
$("#vs_panel_{$this->modelName} #btn-enable-obj").click(function(){
if(objChecked.length==0){
alert("{$this->getLang()->getWords('error_none_select')}");
return false;
}
vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_visible_checked/'+objChecked,'vs_panel_{$this->modelName}');
return false;
});
$("#vs_panel_{$this->modelName} #btn-home-obj").click(function(){
if(objChecked.length==0){
alert("{$this->getLang()->getWords('error_none_select')}");
return false;
}
vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_home_checked/'+objChecked,'vs_panel_{$this->modelName}');
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
///alert(window.location.hash);
//vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_add_edit_form/','vs_panel_{$this->modelName}');
}
function btnEditItem_Click(id,c){
var hashbase=$(c).parents('.ui-tabs-panel').attr('id');
window.location.hash=hashbase+"/{$bw->input[0]}/{$this->modelName}_add_edit_form/"+id+'&{$bw->input['back']}';
///vsf.submitForm($("#vs_panel_{$this->modelName} #frm_obj_list"),'{$bw->input[0]}/{$this->modelName}_add_edit_form/'+id,'vs_panel_{$this->modelName}');
//alert(hashbase);
return false;
}
function btnRemoveItem_Click(id){
jConfirm(
                     "{$this->getLang()->getWords('yesno_delete')}?",
                     "{$bw->vars['global_websitename']} Dialog",
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
jAlert("{$this->getLang()->getWords('error_none_select')}");
}
return false;
}
</script>

<script>

EOF;
if($option['message']) {
$BWHTML .= <<<EOF

jAlert('{$option['message']}');

EOF;
}

$BWHTML .= <<<EOF

</script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f47b8a719ff($objItems=array(),$option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($objItems)){
    foreach( $objItems as $item )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<tr class="$vsf_class">
<td><input onClick="checkRow()" class="btn_checkbox" value="{$item->getId()}" type="checkbox" /></td>
<td>{$item->getId()}</td>
<td>{$item->getEmail()}</td>

EOF;
if($this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName."_status",1,$bw->input[0])) {
$BWHTML .= <<<EOF

<td class="status"><img src="{$bw->vars['img_url']}/status_{$item->getStatus()}.png"/></td>

EOF;
}

$BWHTML .= <<<EOF

<td class="action">
{$this->addOtionList($item)}
</td>
</tr>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:addOtionList:desc::trigger:>
//===========================================================================
function addOtionList($obj="") {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <input  type="button" onClick="btnRemoveItem_Click({$obj->getId()})" class="btnDelete" value="{$this->getLang()->getWords('delete')}" />
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showEmail:desc::trigger:>
//===========================================================================
function showEmail($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Mỹ phẩm Thanh Thúy</title>
<style>
a,p{color:#fff;font-size:11px;line-height:16px}
</style>
</head>
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0"
marginheight="0" marginwidth="0" bgcolor="#ffffff">
<table width="100%" border="0" align="center" cellpadding="0"
cellspacing="0" bgcolor="#ffffff">
<tr>
<td valign="top"><table width="650" border="0" align="center"
cellpadding="0" cellspacing="0"
style="font-family: Arial, Helvetica, sans-serif; font-size: 12px">
<tr>
<td valign="top"><table width="650" border="0"
cellspacing="0" cellpadding="0">
<tr>
<td valign="top" width="180"><a href="{$bw->base_url}"
class="logo"><img src="{$bw->vars['img_url']}/logo.jpg"
width="180" /></a></td>
<td width="434"><img
src="{$bw->vars['board_url']}/images/newsletter-1.png"
alt="Trả hàng trong 14 ngày - Giao hàng miễn phí trên toàn quốc (*) - Thanh toán khi nhận hàng"
width="434" height="60" border="0"
style="display: block; line-height: 16px;"></td>
</tr>
</table></td>
</tr>
<tr>
<td valign="top" bgcolor="#dddddd"
style="border-top: 8px solid #184e8d;"><table width="100%"
border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" valign="top"
style="border-left: 2px solid #a5a5a5; border-right: 2px solid #a5a5a5; padding: 8px;"><table
width="630" border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="top" bgcolor="#ffffff" style="padding: 10px;"><table
width="610" border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="top" width="220">
dsadsa
</td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
<td valign="top" bgcolor="#163d6a"
style="padding: 10px; margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #ffffff; text-align: center; line-height: 16px;">
<table width="610" border="0" cellpadding="0" cellspacing="0">
<tr>
<td valign="top" width="420">
{$this->getAddon()->getFooter()->getContent()}
</td>
</tr>
</table>
</td>
</tr>
</table></td>
</tr>
</table>
</body>
</html>
EOF;
//--endhtml--//
return $BWHTML;
}


}
?>