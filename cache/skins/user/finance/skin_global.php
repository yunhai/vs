<?php
class skin_global{

//===========================================================================
// <vsf:vs_global:desc::trigger:>
//===========================================================================
function vs_global() {global $bw,$vsLang,$vsMenu,$vsSettings,$urlcate,$vsPrint;

$count= count($_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'])?count($_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item']):'0';

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="wrapper">
<div id="header">
    <a href="{$bw->vars['board_url']}" class="logo"><img src="{$bw->vars['img_url']}/logo.jpg" /></a>
    <div class="slogan">{$vsSettings->getSystemKey("config_slogan","Slogan here","configs")}</div>
    {$this->portlet_supports}
        
        <a href="{$bw->base_url}orders" class="giohang">{$vsLang->getWordsGlobal("global_giohang","Giỏ hàng")} <span>[{$count}]</span></a>
        {$this->portlet_search}
        
    </div>
    <!-- STOP HEADER -->
    
    {$this->menu}
    <!-- STOP MENU -->
    
EOF;
if( $bw->input[0] != 'home' ) {
$BWHTML .= <<<EOF

   {$this->portlet_promotion}
   
EOF;
}

$BWHTML .= <<<EOF

    
EOF;
if($this->menu_left) {
$BWHTML .= <<<EOF

    <div id="sitebar">
{$this->menu_left}
{$this->portlet_partner}
</div>

EOF;
}

$BWHTML .= <<<EOF

    {$this->SITE_MAIN_CONTENT}
    <div class="clear"></div>
        
    <div id="footer">
    <div class="footer_left">
{$this->menu_footer}
    
EOF;
if($this->contacts) {
$BWHTML .= <<<EOF

    {$this->contacts->getIntro()}
    
EOF;
}

$BWHTML .= <<<EOF

        
        </div>
        <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="link_face addthis_button_facebook"></a>
<a class="link_twit addthis_button_twitter"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ec0dc180ab5fc94"></script>
<p class="vietsol"> 
    <a href='http://www.vietsol.net/' target='_blank' title='{$vsLang->getWordsGlobal("global_tkwcn","Thiết kế web")}' style="color:#999999;">{$vsLang->getWordsGlobal("global_tkweb","Thiết kế web")}</a>{$vsLang->getWordsGlobal("global_tkwebby"," bởi ")}
      <a href='http://www.vietsol.net/gioi-thieu-cong-ty-thiet-ke-web/'  target='_blank' title='{$vsLang->getWordsGlobal("global_tkweb_company","Công ty thiết kế web")}' style="color:#e80000;">Viet Solution</a>
      </p>
    </div>
</div>
<script>
 $(function() {
      if(window.hs!=null)
{
hs.graphicsDir = "{$bw->vars['cur_scripts']}/highslide/graphics/";
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.outlineType = 'glossy-dark';
hs.fadeInOut = true;
hs.dimmingOpacity = 0.75;
hs.captionEval = 'this.a.title';
// Add the controlbar
if (hs.addSlideshow) hs.addSlideshow({
                        //slideshowGroup: 'group1',
                        interval: 5000,
                        repeat: false,
                        useControls: false,
                        fixedControls: false,
                        overlayOptions: {
                                opacity: 1,
                                position: 'top right',
                                hideOnMouseOut: false
                        }
                });
}
             });
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
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


}?>