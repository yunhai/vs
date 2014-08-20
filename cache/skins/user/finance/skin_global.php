<?php
if(!class_exists('skin_board_public'))
require_once ('./cache/skins/user/finance/skin_board_public.php');
class skin_global extends skin_board_public {

//===========================================================================
// <vsf:vs_global:desc::trigger:>
//===========================================================================
function vs_global() {global $bw, $vsLang;
//$vsLang = VSFactory::getLangs();

$total = count($_SESSION['vs_item_cart']);

//--starthtml--//
$BWHTML .= <<<EOF
        <script type="text/javascript">
$(document).ready(function(){
$('.cate_sitebar li:last').addClass('li_child');
$('.main_menu ul li a:first').addClass('last_none');
$('.top_menu ul li a:first').addClass('last_none');
$('.menu_boot ul li a:last').addClass('last_none');
$('.cate_sitebar ul > li > ul  li:first').addClass('cate_top');

var count=1;
$('.block1 .box_item').each(function(){
if(count%3==0)
$(this).addClass('last_child');
count ++;
});
var count=1;
$('.block2 .pro_item').each(function(){
if(count%3==0)
$(this).addClass('last_child');
count ++;
});
var count=1;
$('.center .project_item').each(function(){
if(count%2==0)
$(this).addClass('last_child');
count ++;
});
});
</script>
<script>
$(document).ready(function(){
$('.bxslider').bxSlider({
 mode: 'fade',
 infiniteLoop: true,
 hideControlOnEnd: true,
 controls: false,
 pager: false,
auto: true
});
});
            </script>
<script type="text/javascript">
$(document).ready(function(){
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
   var check_device=1;
  }
  if(check_device==1){
  
  $('.banner').css({'width':'1100px'});
$('.footer').css({'width':'1100px'});
$('.menu_top li a').css({'font-size':'10px'});
$('.menu_top li a').css({'padding-left':'5px'});
$('.menu_top').css({'left':'60px'});
$('.slogan').css({'left':'100px'});
$('.bg_right_head').css({'right':'-200px'});
$('.bg_left_head').css({'width':'80px'});
$('.bott_right_head').remove();
  }
  
});
</script>


EOF;
if($bw->input[0]!='home' ) {
$BWHTML .= <<<EOF

<div class="bg_left_head"></div>
<div class="bg_right_head"></div>
<div class="header">
        <div class="wrap_header">
            <div class="wrap_letf">
            <a href="{$bw->base_url}"><img src="{$bw->vars['img_url']}/logo.png" /></a>
            <div class="bott_left_head"></div>
            </div>
                <div class="wrap_right">
                <div class="slogan">Today - Tomorrow and Forever</div>
                {$this->getAddon()->getMenuTop($option)}
                <div class="bott_right_head"></div>
                </div>
            </div>
        </div>

EOF;
}

$BWHTML .= <<<EOF

{$this->SITE_MAIN_CONTENT}

EOF;
if($bw->input[0]!='home' ) {
$BWHTML .= <<<EOF

<div class="footer">
    <div class="wrap_footer">
        <div class="left">
            {$this->getAddon()->getHtml()->getContactFooter()}
            </div>
            <div class="right">
            {$this->getAddon()->getAnalytic()}
                <div class="vs">
            <a href='http://www.vietsol.net/' target='_blank' rel="" title='Thiết kế web chuyên nghiệp' style="color:#7c7b7b">Thiết kế web </a><span style="color:#7c7b7b">bởi</span>
            <a href='http://www.vietsol.net/gioi-thieu-cong-ty-thiet-ke-web/' rel="nofollow" target='_blank' title='Công ty thiết kế web' style="color:#7c7b7b;">Viet Solution</a>
                    
</div>
            </div>
        </div>
    </div>

EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getSiteBar:desc::trigger:>
//===========================================================================
function getSiteBar($option=null) {global $bw,$vsLang,$vsMenu,$vsSettings,$urlcate,$vsExperts,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:addCSS:desc::trigger:>
//===========================================================================
function addCSS($cssUrl="",$media="") {$media = $media?"media='$media'":'';

//--starthtml--//
$BWHTML .= <<<EOF
        <link type="text/css" rel="stylesheet" href="{$cssUrl}.css"  $media/>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:importantAjaxCallBack:desc::trigger:>
//===========================================================================
function importantAjaxCallBack() {global $bw,$vsLang;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:addJavaScriptFile:desc::trigger:>
//===========================================================================
function addJavaScriptFile($file="",$type='file') {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($type=='cur_file') {
$BWHTML .= <<<EOF

<script type="text/javascript" src='{$bw->vars['cur_scripts']}/{$file}.js'></script>

EOF;
}

else {
$BWHTML .= <<<EOF


EOF;
if($type=='external') {
$BWHTML .= <<<EOF

<script type="text/javascript" src='{$file}'></script>

EOF;
}

else {
$BWHTML .= <<<EOF


EOF;
if($type=='file') {
$BWHTML .= <<<EOF

<script type="text/javascript" src='{$bw->vars['board_url']}/javascripts/{$file}.js'></script>

EOF;
}

$BWHTML .= <<<EOF


EOF;
}
$BWHTML .= <<<EOF


EOF;
}
$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:addJavaScript:desc::trigger:>
//===========================================================================
function addJavaScript($script="") {$BWHTML = "";

//--starthtml--//
$BWHTML .= <<<EOF
        <script language="javascript" type="text/javascript">
{$script}
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:addDropDownScript:desc::trigger:>
//===========================================================================
function addDropDownScript($id="") {$BWHTML = "";
//--starthtml--//

//--starthtml--//
$BWHTML .= <<<EOF
        ddsmoothmenu.init({
mainmenuid: "{$id}", //Menu DIV id
orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
classname: 'ddsmoothmenu-v', //class added to menus outer DIV
//customtheme: ["#804000", "#482400"],
contentsource: "markup", //"markup" or ["container_id", "path_to_menu_file"]
})
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
        <div class="vs-common">
<div class="red" align="left" style="padding: 20px">
Error: {$message}<br />
Line: {$line}<br />
File: {$file}<br />
Trace: <pre>{$trace}</pre><br />
</div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:global_main_title:desc::trigger:>
//===========================================================================
function global_main_title() {global $bw, $vsPrint;
$BWHTML = "";
//--starthtml--//

//--starthtml--//
$BWHTML .= <<<EOF
        <span class="{$bw->input['module']}">{$vsPrint->mainTitle}</span>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:pop_up_window:desc::trigger:>
//===========================================================================
function pop_up_window($title="",$css="",$text="") {
//--starthtml--//
$BWHTML .= <<<EOF
        
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


}
?>