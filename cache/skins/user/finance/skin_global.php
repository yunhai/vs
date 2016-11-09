<?php
class skin_global{

//===========================================================================
// <vsf:vs_global:desc::trigger:>
//===========================================================================
function vs_global() {global $bw,$vsLang,$vsMenu,$vsSettings,$urlcate,$vsPrint;
$count= count($_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'])?count($_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item']):'0';
    $stringSearch = $vsLang->getWordsGlobal('search_key','Search...');   
            

//--starthtml--//
$BWHTML .= <<<EOF
        <a href="{$bw->base_url}" class="logo">
   <object  width="190px" height="92px" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
    <param value="{$bw->vars[img_url]}/flash_logo(190x92).swf" name="movie">
    <param value="high" name="quality">
    <param value="samedomain" name="allowscriptaccess">
    <param name="wmode" value="transparent" />
    <embed wmode="transparent" width="190" height="92" allowscriptaccess="samedomain" quality="high"  src="{$bw->vars[img_url]}/flash_logo(190x92).swf"  pluginspage="http://www.adobe.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash">
    </object>
   </a>
<div id="wrapper">
   {$this->menu}
    
EOF;
if($this->listgallery) {
$BWHTML .= <<<EOF

                <ul id="slide_banner">
            {$this->__foreach_loop__id_4f2f90b36879b()}
        </ul>
               
EOF;
}

else {
$BWHTML .= <<<EOF
 
    
EOF;
if($this->adv['banner']) {
$BWHTML .= <<<EOF

        <ul id="slide_banner">
            {$this->__foreach_loop__id_4f2f90b3688c8()}
        </ul>
    
EOF;
}

$BWHTML .= <<<EOF
    
                
EOF;
}
$BWHTML .= <<<EOF

<div id="sitebar">
        
EOF;
if($this->menuLeft) {
$BWHTML .= <<<EOF

            <div class="sitebar_item">
                    <h3 class="sitebar_title">{$vsLang->getWordsGlobal("global_danhmuc","danh mục")}</h3>
                <ul class="danhmuc" id="menu">
                    {$this->menuLeft}
                </ul>
            </div>
        
EOF;
}

$BWHTML .= <<<EOF

        {$this->searchLeft}
        
        
    </div>
    <!-- STOP SITEBAR -->
    
    {$this->SITE_MAIN_CONTENT}
    <!-- STOP CONTENT -->
    
    <div class="clear"></div>
    
    <div id="footer">
    <div class="tienich">
            <a target="_blank" href="{$vsSettings->getSystemKey('dang_twis','twis', "config", 1, 1)}" class="twis" title="twister"><img src="{$bw->vars['img_url']}/icon7.png" /></a>
            <a target="_blank" href="{$vsSettings->getSystemKey('dang_facebook','facebook', "config", 1, 1)}" title="facebook"><img src="{$bw->vars['img_url']}/icon6.png" /></a>
            
            
EOF;
if($this->supports) {
$BWHTML .= <<<EOF

            <div class="support_onl">
                {$this->__foreach_loop__id_4f2f90b3689f2()}    
            </div>
            
EOF;
}

$BWHTML .= <<<EOF

            
            <div class="clear_right"></div>
        </div>
        <div class="footer_page">
        <p class="banquyen">{$this->footer->getIntro(1000)}</p>
            <p class="vietsol"> 
                <a href='http://www.vietsol.net/' target='_blank' style="color:#666" title='{$vsLang->getWordsGlobal("global_tkwcn","Thiết kế web chuyên nghiệp")}'>{$vsLang->getWordsGlobal("global_tkweb","Thiết kế website")}</a>{$vsLang->getWordsGlobal("global_tkwebby"," bởi ")}
        <a href='http://www.vietsol.net/gioi-thieu-cong-ty-thiet-ke-web/' style="color:#767676" target='_blank' title='{$vsLang->getWordsGlobal("global_tkweb_company","Công ty thiết kế web")}'  >Viet Solution</a>
        </p>
            {$this->weblink}
            <p class="truycap"> {$vsLang->getWordsGlobal("global_Online","Đang truy cập")}: <strong>{$this->state['today']}</strong>
                        /{$vsLang->getWordsGlobal("global_Vistor","Tổng truy cập")}: <strong>{$this->state['visits']}</strong></p>
            <div class="clear"></div>
        </div>
    </div>

</div>   
<script type="text/javascript">
    $(document).ready(function(){
   $('.menu_top').find('li:last').addClass('li_last');
   $('.menu_top').find('li:first a').css({background:'none'});
   $('#slide_banner').innerfade({
animationtype: 'fade',
speed:2000,
timeout:5000,
type: 'sequence',
containerheight: '260px'
});
    });
</script>
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
// Add the controlbar
if (hs.addSlideshow) hs.addSlideshow({
                        //slideshowGroup: 'group1',
                        interval: 5000,
                        repeat: false,
                        useControls: true,
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
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2f90b36879b()
{
global $bw,$vsLang,$vsMenu,$vsSettings,$urlcate,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $this->listgallery as $baner1 )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li>{$baner1->createImageCache($baner1, 986, 260, 1)}</li>
            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2f90b3688c8()
{
global $bw,$vsLang,$vsMenu,$vsSettings,$urlcate,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $this->adv['banner'] as $baner )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li>{$baner->createImageCache($baner->file, 986, 260, 1)}</li>
            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2f90b3689f2()
{
global $bw,$vsLang,$vsMenu,$vsSettings,$urlcate,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $this->supports as $sp )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    {$sp->show()}
                
EOF;
$vsf_count++;
    }
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
// <vsf:addFlash:desc::trigger:>
//===========================================================================
function addFlash($url="",$width=0,$height=0,$mode="opaque") {
//--starthtml--//
$BWHTML .= <<<EOF
        <object height="{$height}" width="{$width}" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0">
        <param name="movie" value="{$url}">
        <param name="quality" value="high">
        <param name="allowscriptaccess" value="samedomain">
        <param value="{$mode}" name="wmode">
        <embed height="{$height}" width="{$width}" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" src="{$url}" quality="high" allowscriptaccess="samedomain" wmode="{$mode}">
          <noembed>
          </noembed>
        
      </object>
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