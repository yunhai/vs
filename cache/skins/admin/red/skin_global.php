<?php
class skin_global{

//===========================================================================
// <vsf:addCSS:desc::trigger:>
//===========================================================================
function addCSS($cssUrl="") {
//--starthtml--//
$BWHTML .= <<<EOF
        <link type="text/css" rel="stylesheet" href="{$cssUrl}.css" />
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:addJavaScriptFile:desc::trigger:>
//===========================================================================
function addJavaScriptFile($file="") {global $bw;
$BWHTML = "";

//--starthtml--//
$BWHTML .= <<<EOF
        <script type="text/javascript" src='{$bw->vars['js']}/{$file}.js'></script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:addJavaScript:desc::trigger:>
//===========================================================================
function addJavaScript($script="") {
//--starthtml--//
$BWHTML .= <<<EOF
        <script type="text/javascript">
{$script}
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:SelectOption:desc::trigger:>
//===========================================================================
function SelectOption($options=array()) {
//--starthtml--//
$BWHTML .= <<<EOF
        <option value="{$options['value']}" {$options['selected']}>{$options['name']}</option>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:Select:desc::trigger:>
//===========================================================================
function Select($options=array()) {
//--starthtml--//
$BWHTML .= <<<EOF
        <select name="{$options['name']}" id="{$options['name']}"{$options['properties']}>
<!--OPTION LIST-->
</select>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:addDropDownScript:desc::trigger:>
//===========================================================================
function addDropDownScript($id="") {
//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:PermissionDenied:desc::trigger:>
//===========================================================================
function PermissionDenied($error="") {
//--starthtml--//
$BWHTML .= <<<EOF
        <div class="red">
{$error}</div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:displayFatalError:desc::trigger:>
//===========================================================================
function displayFatalError($message="",$line="",$file="",$trace="") {
//--starthtml--//
$BWHTML .= <<<EOF
        <div class="red" align="left" style="padding: 20px">
Error: {$message}<br />
Line: {$line}<br />
File: {$file}<br />
Trace: <pre>{$trace}</pre><br />
</div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:global_main_title:desc::trigger:>
//===========================================================================
function global_main_title() {global $vsPrint;

//--starthtml--//
$BWHTML .= <<<EOF
        {$vsPrint->mainTitle}
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:vs_global:desc::trigger:>
//===========================================================================
function vs_global() {global $bw, $vsUser, $vsLang;
$BWHTML = "";

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if( !$vsUser->obj->getId() ) {
$BWHTML .= <<<EOF

{$this->SITE_MAIN_CONTENT}

EOF;
}

else {
$BWHTML .= <<<EOF

<center>
<a href="{$bw->vars ['board_url']}/admin.php" class="buttom_back_cd">Trở lại trang chủ</a>
<a href="{$bw->vars ['board_url']}"style="right:0px;left:auto;padding-left:25px;" class="buttom_back_cd logo_cd">VS FRAMEWORK 3.0.0</a>
<div id="vsf-wrapper-container">
<div id="vsf-wrapper" align="center">
<!-- BEGIN OF HEADER -->
<div class="vsf-header">
<div class="header_vs_ceedos">
<span>Admin Control Panel</span>
</div>
    <div class="clear"></div>
<!-- BEGIN OF TOP MENU -->
<div class="vsf-topmenu" id="topmenu">
<ul>

EOF;
if( $this->ADMIN_TOP_MENU ) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_4ff2745103e63()}

EOF;
}

$BWHTML .= <<<EOF

</ul>
<div class="clear"></div></div>
<!-- END OF TOP MENU -->
    <div class="clear"></div>
</div>
<!-- END OF HEADER -->
<!-- BEGIN OF SITE NAV -->
<div class="site-nav">
{$vsLang->getWords('global_dungtaitrang', 'Bạn đang đứng tại trang')} :: {$vsLang->currentArrayWords['main_title']}
    (<a href="javascript:vsf.get('{$bw->input['vs']}/','maincontent');">{$vsLang->getWords('global_refresh','Refresh')}</a>)
    <div class="vsf-language-selection">
    {$this->LANGUAGE_LIST}
    </div>
</div>
<div class="clear"></div>
<!-- END OF SITE NAV -->
    {$this->ACP_HELP_SYSTEM}
<!-- BEGIN OF MAIN PAGE CONTENT -->
<div id="maincontent">
    {$this->SITE_MAIN_CONTENT}
<div class="clear"></div>
</div>
<!-- END OF MAIN PAGE CONTENT -->
<div class="clear"></div>
<!-- BEGIN OF FOOTER -->
<div id="footer">
    <img src="{$bw->vars['img_url']}/vsfooter-leftimg.jpg" style="float:left;" height="25" width="25" alt="vs" />
    <span>{$vsLang->getWordsGlobal('global_copyrights', 'Copyright VS Framework 4.0 by Viet Solution Commerce')}</span>
    <img src="{$bw->vars['img_url']}/vsfooter-rightimg.jpg" style="float:right;" height="25" width="245" alt="vs" />
</div>
<!-- END OF FOOTER -->
</div>
</div>
</center>

EOF;
}
$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_4ff2745103da5($menu='')
{
;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach( $menu->children as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    <li><a href="{$obj->getUrl(0)}" title="{$obj->getTitle()}">{$obj->getTitle()}</a></li>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_4ff2745103e63()
{
global $bw, $vsUser, $vsLang;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach( $this->ADMIN_TOP_MENU as $menu )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<li class="{$menu->getClassActive()}"><a href="{$menu->getUrl(0)}" title="{$menu->getTitle()}" >{$menu->getTitle()}</a>

EOF;
if($menu->isDropdown&&count($menu->children)) {
$BWHTML .= <<<EOF

                    <ul>
                    {$this->__foreach_loop__id_4ff2745103da5($menu)}
                    </ul>

EOF;
}

$BWHTML .= <<<EOF

</li>

EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:importantAjaxCallBack:desc::trigger:>
//===========================================================================
function importantAjaxCallBack($Text="",$Url="",$css="") {global $bw;
$BWHTML = "";
//--starthtml--//
//

//--starthtml--//
$BWHTML .= <<<EOF
        <script type="text/javascript">
$(document).ready(function(){
Custom.init();
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:Redirect:desc::trigger:>
//===========================================================================
function Redirect($Text="",$Url="",$css="") {global $bw;
$BWHTML = "";
//--starthtml--//
//

//--starthtml--//
$BWHTML .= <<<EOF
        <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html40/loose.dtd">
<html>
<head>
<title>Redirecting...</title>
<meta http-equiv='refresh' content='2; url=$Url' />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
$css
<style type="text/css">
.title
{
color:red;
}
.text
{
padding:10px;
color:#009F3C;
}
</style>
</head>
  <body >
<center>
<table style="background-color:#6ac3cb" cellpadding="0" cellspacing="0" width="100%" height="100%"> 
<tr>
<td width="416px" align="center" valign="middle" style="background:url({$bw->vars ['board_url']}/styles/redirect/direct.jpg) no-repeat center  top;" height="432px">
<br/><br/><br/><br/>
<img src="{$bw->vars ['board_url']}/styles/redirect/turtle.gif">
<br/><br/>
<p class="text">{$Text}</p>
    <a href='$Url' title="{$Url}" class="title">( Click here if you do not wish to wait )</a>
 </td>
</tr>  
</table> 
</center>
</body>
</html>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:buildRadioButtonHTML:desc::trigger:>
//===========================================================================
function buildRadioButtonHTML($name="",$checkedYes=true,$checkedNo=false,$readonly="",$disabled="",$sAttr="") {
//--starthtml--//
$BWHTML .= <<<EOF
        <input type="radio" name="{$name}" value="Yes" $checkedYes $readonly $disabled $sAttr style='width:10px; margin-right:10px;'>Yes</input>
<input type="radio"  name="{$name}" value="No" $checkedNo $readonly $disabled $sAttr style='width:10px; margin-right:10px;'>No</input>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:buildTextTypeHTML:desc::trigger:>
//===========================================================================
function buildTextTypeHTML($textType="",$id="",$name="",$value="",$readonly="",$disabled="",$sAttr="") {
//--starthtml--//
$BWHTML .= <<<EOF
        <input type="$textType" id="{$id}" name="{$name}" value="$value" {$readonly} {$disabled} {$sAttr}></input>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:buildCheckBoxHTML:desc::trigger:>
//===========================================================================
function buildCheckBoxHTML($id="",$name="",$checked="",$readonly="",$disabled="",$sAttr="") {
//--starthtml--//
$BWHTML .= <<<EOF
        <input type="checkbox" id="{$id}" name="{$name}" value="1" $readonly $checked $disabled $sAttr></input>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:buildDropdownBoxHTML:desc::trigger:>
//===========================================================================
function buildDropdownBoxHTML($id="",$name="",$currentValue="",$currentDisplay="",$listOption="") {
//--starthtml--//
$BWHTML .= <<<EOF
        <select id="{$id}" name="{$name}">
<option value="{$currentValue}">{$currentDisplay}</option>
{$listOption}
</select>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:buildOptionHTML:desc::trigger:>
//===========================================================================
function buildOptionHTML($value="",$display="",$sAtr="") {
//--starthtml--//
$BWHTML .= <<<EOF
        <option value="{$value}" $sAtr>{$display}</option>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:buildRadioButtonHTML1:desc::trigger:>
//===========================================================================
function buildRadioButtonHTML1($sAttr="") {
//--starthtml--//
$BWHTML .= <<<EOF
        <input type="radio" {$sAttr}>Yes</input>
<input type="radio" {$sAttr}>No</input>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:buildTextTypeHTML1:desc::trigger:>
//===========================================================================
function buildTextTypeHTML1($sAttr="") {
//--starthtml--//
$BWHTML .= <<<EOF
        <input {$sAttr}></input>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:buildCheckBoxHTML1:desc::trigger:>
//===========================================================================
function buildCheckBoxHTML1($sAttr="") {
//--starthtml--//
$BWHTML .= <<<EOF
        <input type="checkbox" {$sAttr}></input>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>