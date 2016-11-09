<?php
class skin_global{

//===========================================================================
// <vsf:vs_global:desc::trigger:>
//===========================================================================
function vs_global() {global $bw,$vsLang,$vsUser,$vsMenu;
$count = abs($_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart']['count']);

$navigation = 1;
if($bw->input['module'] == 'users'){
if(!(in_array($bw->input[1], array('acctab', 'protab', 'settingtab')) || $bw->input['statuscomment'])){
$navigation = 0;
}
} 

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="center">
    <div id="header">
       <a href="{$bw->vars['board_url']}" class="logo">
<img src="{$bw->vars['img_url']}/logo.jpg" alt='{$bw->vars['board_url']}'/>
       </a>
       <div class="search_top">
       <form id='gsform' name='gsform' method='GET' action='{$bw->vars['board_url']}/search'>
        <input placeholder="Search..." id='globalsearch' name='keyword' />
            <a href="#" id='submitglobalsearch'><img src="{$bw->vars['img_url']}/search_btn.jpg" alt='search'/></a>
            </form>
        </div>
        
        <script type='text/javascript'>
        $('#submitglobalsearch').click(function(){
        if($('#globalsearch').val() == '') return false;
        $('#gsform').submit();
        });
        
        $('#globalsearch').bind('keypress', function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
if(code == 13) {
if($('#globalsearch').val() == '') return false;
        $('#gsform').submit();
}
});
        </script>
        
       {$this->topmenu}
    </div>
    <!-- STOP HEADER -->
    
    <div id="menu_top">
    <ul>
    
EOF;
if( $this->menu ) {
$BWHTML .= <<<EOF

    {$this->__foreach_loop__id_509296576e328()}
    
EOF;
}

$BWHTML .= <<<EOF

        </ul>
    </div>
    <!-- STOP MENU TOP -->
    
EOF;
if( $navigation ) {
$BWHTML .= <<<EOF

   <div class="navigation">
    <div class="navigation_left">
    
EOF;
if( $this->GLOBAL_CAMPUS_LIST[$vsUser->obj->getCampusId()] ) {
$BWHTML .= <<<EOF

            <p class="hi_member">Hi, {$vsUser->obj->getFullname()}!</p>
            <a href="#" class="collect_member" id="change">
       {$this->GLOBAL_CAMPUS_LIST[$vsUser->obj->getCampusId()]->getTitle()}
       </a>
            
EOF;
}

else {
$BWHTML .= <<<EOF

            Welcome! Please
            <a href="{$bw->vars['board_url']}/users/login" title="{$vsLang->getWords('global_login_label','Click here to login')}" style="margin:0px;">
            sign in
            </a>
            or 
            <a href="{$bw->vars['board_url']}/users/signup" title="{$vsLang->getWords('global_signup_label','Click here to signup')}" style="margin:0px;">
            register
            </a>

EOF;
}
$BWHTML .= <<<EOF

        </div>
        <a href="#" class="cart_link" id="shopping_cart" title="{$vsLang->getWords('global_cart_checkout','Checkout')}">
        {$vsLang->getWords('global_shopping_cart','Shopping Cart')} ({$count})
        </a>
        <div id='mlcon' style="position:absolute;right: 270px;">
        <a href="#" class="post_link" id='post_link' title="{$vsLang->getWords('global_post_a_list','Post a listing')}">
        {$vsLang->getWords('global_post_a_list','Post a listing')}
        </a>
        <div id='moreposting' style='display:none;'>
        <a href="{$bw->vars['board_url']}/textbooks/sell" title="List a textbook">List a textbook</a>
        <a href="{$bw->vars['board_url']}/icMarket/post" title="List other items">List other items</a>
        </div>
        </div>
       
        <script language="javascript" type="text/javascript">
        $(document).ready(function(){
        var flag = true;
$("#post_link").click(function(){
if(flag){
$('#moreposting').css({display: "block"}).show();
$(this).addClass("active");
}else{
$('#moreposting').css({display: "none"}).hide();
$(this).removeClass("active");
}
flag = !flag;
});
}); 
        </script>
    </div>
   
EOF;
}

$BWHTML .= <<<EOF

    
  {$this->SITE_MAIN_CONTENT}
   
    <div class='clear'></div>
    <div id="footer">
    <p class="copyright">
    <a href="{$bw->vars['board_url']}" title="Icampux" style='color:#000;'>
    iCampux &copy; 2011
    </a>
    </p>
        <ul>
        
EOF;
if( $this->bottom ) {
$BWHTML .= <<<EOF

        {$this->__foreach_loop__id_509296576e523()}
    
EOF;
}

$BWHTML .= <<<EOF

        </ul>
        <div class='fright'>
        {$vsLang->getWords('global_english','English')}
        <img src="{$bw->vars['img_url']}/flang_arrow.png" alt="languages" width="10" />
        </div>
    </div>
</div>
<div id="global_callback"></div>
    
    <div style="display:none;" id="global_formContainer">
    <div class="formHeader">
        <span class="form_label">Change Campus</span>
        <span id="global_close">X</span>
        <div class="clear"></div>
    </div>
    <div id="global_container">
    <div id="global_formCont"></div>
    <div id="global_editForm">
    <input class="input" type="hidden" name="campusId" />
<table cellpadding="0" cellspacing="1" width="100%" id="global_formTable">
    <tr>
        <th>{$vsLang->getWords('name','Name')}</th>
            <td>
            
EOF;
if( $this->GLOBAL_CAMPUS_LIST ) {
$BWHTML .= <<<EOF

            <select name="userCampusId" id="userCampusId">
            {$this->__foreach_loop__id_509296576e75e()}
            </select>
            
EOF;
}

$BWHTML .= <<<EOF

            </td>
        </tr>
        <tr>
            <td colspan="2">
            <button class="ui-state-default ui-corner-all" onclick="submitCampusForm()">{$vsLang->getWords('global_change_campus','Change')}</button>
            </td>
        </tr>
    </table>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
vsf.jSelect('{$vsUser->obj->getCampusId()}','userCampusId')
});
function submitCampusForm(){
$('#global_formContainer').block({
        css: {
        border: 'none',
        padding: '20px',
        backgroundColor: '#FFF',
            color: '#000',
            cursor:'progress',
            opacity: 0.9
        },
       message: "<div id='block_message'><img src='{$bw->vars['board_url']}/styles/images/ajax-loader.gif' alt='loading' /><br />{$vsLang->getWords('global_wait','Please wait...')}</div>",
       onBlock: function(){
        var formElement = "<form method='post' id='changeCampusForm'></form>";
$('#global_formCont').append(formElement);
$('#changeCampusForm').append($('#global_formTable'));
vsf.submitForm($('#changeCampusForm'),'users/updateCampus/','global_callback');
return false;
        }
});
}
</script>
</div>
<script type="text/javascript"> 
$(document).ready(function(){
//$("#link_top").find('a:last').prev().css({border: "none"});
//$("#link_top").find('a:last').css({border: "none",color:"#008ab1"});
$("#menu_top ul").find('li:last').addClass("li_last");
//$(".content_col ul").find('li:first').css({background:"none"});
//$(".col_title").find('a:last').css({margin:"0px"});
//$(".user_menu ul").find('li:first').css({background:"none"});
//$("#login_form ul").find('li:last').addClass("li5");

$("#change").click(function(){
$.blockUI({
        css: {
        border: 'none',            
            color: '#000',
            cursor:'progress',
            padding: '0px'
        },
        message: $('#global_formContainer')
});
   });
   
   $('#global_close').click(function(){
$('#global_formContainer').unblock();
$.unblockUI();
});
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_509296576e328()
{
global $bw,$vsLang,$vsUser,$vsMenu;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach( $this->menu as $menu )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <li>
        <a href="{$menu->getUrl(0)}" class="{$menu->getClassActive()}">
        <span>{$menu->title}</span>
        </a>
        </li>
    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_509296576e523()
{
global $bw,$vsLang,$vsUser,$vsMenu;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach( $this->bottom as $menu )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <li><a href="{$menu->getUrl(0)}" class="{$menu->getClassActive()}">{$menu->title}</a></li>
    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_509296576e75e()
{
global $bw,$vsLang,$vsUser,$vsMenu;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $this->GLOBAL_CAMPUS_LIST as $campus  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            <option value="{$campus->getId()}" > {$campus->getTitle()}</option>
            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:error_page:desc::trigger:>
//===========================================================================
function error_page() {global $bw, $vsLang;
$BWHTML = "";

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="error_page">
    <h3>{$vsLang->getWords('global_error_page','Invalid Page')}</h3>
        <p class="error_page_text">{$vsLang->getWords('global_error',"We are sorry! This page doesn't exist on our site")}</p>
        <a href="{$bw->vars['board_url']}" class="error_home" title="{$vsLang->getWords('global_error_home','Go to home page')}">
        {$vsLang->getWords('global_error_home','Go to home page')}
        </a><br/><br/>
        <a href="javascript: history.go(-1)" class="error_prev" title="{$vsLang->getWords('global_error_previous','Go to previous page')}">
        {$vsLang->getWords('global_error_previous','Go to previous page')}
        </a>
        <form>
        <input type="text" onfocus="if(this.value=='Quick search') this.value='';" onblur="if(this.value=='') this.value='Quick search';" value="Quick search"  />
            <input type="submit" value="Search" class="error_submit_search" />
            <div class="clear_left"></div>
        </form>
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:redirectJS:desc::trigger:>
//===========================================================================
function redirectJS($message='',$redirect='') {
//--starthtml--//
$BWHTML .= <<<EOF
        <script type='text/javascript'>
        
EOF;
if( $message ) {
$BWHTML .= <<<EOF

        $.blockUI({
        css: {
        border: 'none',
            padding: '50px',
            backgroundColor: '#C0C0C0',
            color: '#000',
            cursor:'progress'
        },
message: '<h1>{$message}</h1>'
});
setTimeout(function(){
$.unblockUI();

EOF;
if( $redirect ) {
$BWHTML .= <<<EOF

location.href = '{$redirect}';

EOF;
}

$BWHTML .= <<<EOF

}, 2000);
        
EOF;
}

else {
$BWHTML .= <<<EOF

        location.href = '{$redirect}';

EOF;
}
$BWHTML .= <<<EOF

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

<script type="text/javascript" src='{$bw->vars['js']}/{$file}.js'></script>

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


}?>