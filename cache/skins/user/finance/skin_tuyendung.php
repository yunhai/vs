<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_tuyendung extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw,$vsLang,$vsPrint,$vsTemplate;


//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
    <div class="main_title">
        <h1 class="main_title_tuyendung">{$vsLang->getWords('pageTitle','Địa chỉ')}</h1>
            
EOF;
if($option['paging']) {
$BWHTML .= <<<EOF
    
            <div class="page">
            {$option['paging']}
            </div>
            
EOF;
}

$BWHTML .= <<<EOF

        </div>
        
       <div id="center" class="tuyendung">
            
EOF;
if($option['pageList']) {
$BWHTML .= <<<EOF
    
                {$this->__foreach_loop__id_4f2b78d15a1fb($option)} 
                
EOF;
}

else {
$BWHTML .= <<<EOF

                {$vsLang->getWords('global_dataupdate1','Nội dung đang trong quá trình cập nhật. Quý khách vui lòng quay lai sau. Xin cảm ơn!')}
            
EOF;
}
$BWHTML .= <<<EOF

       </div>
       
       
       
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2b78d15a1fb($option=array())
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['pageList'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    <a href="{$obj->getUrl($bw->input['module'])}">{$obj->getTitle()} {$obj->getPostDate('SHORT')}</a>
                
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option="") {global $bw,$vsLang,$vsPrint,$vsTemplate,$class_def;
       

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
    <div class="main_title">
        <h3 class="{$class_def}">{$vsLang->getWords('pageTitle','Địa chỉ')}</h3>
        </div>
<div class="tintuc detail" id="center">
       <h1 class="tintuc_title">{$obj->getTitle()} 
EOF;
if($bw->input['module']==news) {
$BWHTML .= <<<EOF
<span>{$obj->getPostDate('SHORT')}</span>
EOF;
}

$BWHTML .= <<<EOF
</h1>
                {$obj->getContent()}
                <div class="clear_left"></div>
              {$this->contactForm($obj)}
                
EOF;
if($option['other']) {
$BWHTML .= <<<EOF

                <h3 class="tintuc_title">{$vsLang->getWords("cactinkhac2","CÁC TIN KHÁC")}</h3>
                    <div class="other">
                        {$this->__foreach_loop__id_4f2b78d15a9ca($obj,$option)}
                    </div>
                
EOF;
}

$BWHTML .= <<<EOF

        </div>
   </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2b78d15a9ca($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate,$class_def;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['other'] as $other )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <a href="{$other->getUrl($bw->input['module'])}">{$other->getTitle()}</a>
                             
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:contactForm:desc::trigger:>
//===========================================================================
function contactForm($obj="") {global $vsLang, $bw, $vsSettings,$vsPrint;
$vsPrint->addJavaScriptFile ("jquery.numeric",1);
$vsPrint->addJavaScriptFile( "jquery/ui.alerts");

//--starthtml--//
$BWHTML .= <<<EOF
        <h3 class="tintuc_title">{$vsLang->getWords('contact_formtuyendung','Form tuyển dụng')}  </h3>
         <form name="formContact" id="formContact" class="form_tuyendung" method="POST" action="{$bw->base_url}contacts/send/" enctype="multipart/form-data">

         <input type="hidden" value="1" name="contactType"/>


EOF;
if( $vsSettings->getSystemKey("contact_form_name", 1, "contacts", 0, 1)) {
$BWHTML .= <<<EOF

<label>{$vsLang->getWords('contact_full_name','Họ và Tên')}:</label>
            <input type="text" id="contactName" name="contactName" value="{$bw->input['contactName']}" title="{$vsLang->getWords('contact_full_name','Họ và Tên')}" />
            
EOF;
}

$BWHTML .= <<<EOF

            <div class="clear_left"></div>
            
EOF;
if( $vsSettings->getSystemKey("contact_form_address", 1, "contacts", 0, 1)) {
$BWHTML .= <<<EOF

            <label>{$vsLang->getWords('contact_address','Địa chỉ')}:</label>
            <input id="contactAddress" name="contactAddress" value="{$bw->input['contactAddress']}" title="{$vsLang->getWords('contact_address','Địa chỉ')}"  type="text" />

EOF;
}

$BWHTML .= <<<EOF

<div class="clear_left"></div>
            
EOF;
if( $vsSettings->getSystemKey("contact_form_phone", 1, "contacts", 0, 1)) {
$BWHTML .= <<<EOF

            <label>{$vsLang->getWords('contact_phone','Điện thoại')}:</label>
            <input type="text" class="numeric"  value="{$bw->input['contactPhone']}" id="contactPhone" name="contactPhone" maxlength="11" title="{$vsLang->getWords('contact_phone','Điện thoại')}" />

EOF;
}

$BWHTML .= <<<EOF

            <div class="clear_left"></div>

EOF;
if( $vsSettings->getSystemKey("contact_form_email", 1, "contacts", 0, 1)) {
$BWHTML .= <<<EOF

            <label>{$vsLang->getWords('contact_email','Email')}:</label>
<input type="text" id="contactEmail" value="{$bw->input['contactEmail']}" name="contactEmail" title="{$vsLang->getWords('contact_email','Email')}" />
            
EOF;
}

$BWHTML .= <<<EOF

<div class="clear_left"></div>
            
EOF;
if( $vsSettings->getSystemKey("contact_form_title", 1, "contacts", 0, 1)) {
$BWHTML .= <<<EOF

            <label>{$vsLang->getWords('contact_title','Tiêu đề')}:</label>
            <input type="text" id="contactTitle" name="contactTitle" value="{$obj->getTitle()}" title="{$vsLang->getWords('contact_title','Tiêu đề')}" />
            
EOF;
}

$BWHTML .= <<<EOF

            <div class="clear_left"></div>
            
EOF;
if($vsSettings->getSystemKey("contact_form_file", 0, "contacts", 0, 1)) {
$BWHTML .= <<<EOF

            <label>File:</label>
            <input type="file" class="file_input" size="72" id="contactFile" name="contactFile"  />
<div class="clear_left"></div>
            
EOF;
}

$BWHTML .= <<<EOF

             <div class="clear_left"></div>   
            
EOF;
if($vsSettings->getSystemKey("contact_form_content", 1, "contacts", 0, 1)) {
$BWHTML .= <<<EOF

         <label>{$vsLang->getWords("contact_message","Nội dung")}</label>
            <textarea id="contactMessage" name="contactContent">{$bw->input['contactContent']}</textarea>
            
EOF;
}

$BWHTML .= <<<EOF

                 <div class="clear_left"></div> 
            <label>{$vsLang->getWords('contact_security','Mã bảo vệ')}</label>
            <input class="text_input" name="contactSecurity" id="contactSecurity" style="width:100px"/><span></span>
                    <div class="random" style="width: 255px; float: left; ">
                    
                    <img id="siimage" align="left" style="padding-right: 5px; border: 0" src="{$bw->vars['board_url']}/captcha/securimage_show.php?sid={$id}" />
                           <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
                            <param name="allowScriptAccess" value="sameDomain" />
                            <param name="allowFullScreen" value="false" />
                            <param name="movie" value="{$bw->vars['board_url']}/captcha/securimage_play.swf?audio=securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
                            <param name="quality" value="high" />
                            <param name="bgcolor" value="#ffffff" />
                            <!-- <embed src="{$bw->vars['board_url']}/captcha/securimage_play.swf?audio={$bw->vars['board_url']}/captcha/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /> -->
                            </object>

                            <!-- pass a session id to the query string of the script to prevent ie caching -->
                            <span style="padding-top:10px;margin-left:0px;">
                            <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '{$bw->vars['board_url']}/captcha/securimage_show.php?sid=' + Math.random(); return false">
                                    <img src="{$bw->vars['board_url']}/captcha/images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" style="margin-left: 0px !important;" />
                            </a>
                            </span> 
              </div>
              <div class="clear"></div>
        

<input type="submit" value="{$vsLang->getWords('contact_sends','Gửi')}" class="tuyendung_submit" />
<input type="reset" value="{$vsLang->getWords('contact_reset','Làm lại')}" class="tuyendung_reset" />
<div class="clear_left"></div>
</form>

<script type='text/javascript'>
function checkMail(mail){
var filter = /^([a-zA-Z0-9_\\.\\-])+\\@(([a-zA-Z0-9\\-])+\\.)+([a-zA-Z0-9]{2,4})+$/;
if (!filter.test(mail)) return false;
return true;
}

$("input.numeric").numeric();

$('#formContact').submit(function(){

EOF;
if( $vsSettings->getSystemKey("contact_form_name", 1, "contacts", 1, 1)) {
$BWHTML .= <<<EOF

if(!$('#contactName').val()) {
jAlert('{$vsLang->getWords('err_contact_name_blank','Vui lòng nhập họ tên!')}','{$bw->vars['global_websitename']} Dialog');
$('#contactName').addClass('vs-error');
$('#contactName').focus();
return false;
}

EOF;
}

$BWHTML .= <<<EOF



EOF;
if( $vsSettings->getSystemKey("contact_form_address", 1, "contacts", 1, 1)) {
$BWHTML .= <<<EOF

if(!$('#contactAddress').val()) {
jAlert('{$vsLang->getWords('err_contact_address_blank','Vui lòng nhập địa chỉ!')}','{$bw->vars['global_websitename']} Dialog');
$('#contactAddress').addClass('vs-error');
$('#contactAddress').focus();
return false;
}

EOF;
}

$BWHTML .= <<<EOF



EOF;
if( $vsSettings->getSystemKey("contact_form_phone", 1, "contacts", 1, 1)) {
$BWHTML .= <<<EOF

if(!$('#contactPhone').val()) {
jAlert('{$vsLang->getWords('err_contact_phone_blank','Vui lòng nhập số điện thoại!')}','{$bw->vars['global_websitename']} Dialog');
$('#contactPhone').addClass('vs-error');
$('#contactPhone').focus();
return false;
}

EOF;
}

$BWHTML .= <<<EOF



if(!$('#contactEmail').val()|| !checkMail($('#contactEmail').val())) {
jAlert('{$vsLang->getWords('err_contact_email_blank','Vui lòng nhập đúng loại email!')}','{$bw->vars['global_websitename']} Dialog');
$('#contactEmail').addClass('vs-error');
$('#contactEmail').focus();
return false;
}




EOF;
if( $vsSettings->getSystemKey("contact_form_title", 1, "contacts", 1, 1)) {
$BWHTML .= <<<EOF

if(!$('#contactTitle').val()) {
jAlert('{$vsLang->getWords('err_contact_title_blank','Vui lòng nhập câu hỏi!')}','{$bw->vars['global_websitename']} Dialog');
$('#contactTitle').addClass('vs-error');
$('#contactTitle').focus();
return false;
}

EOF;
}

$BWHTML .= <<<EOF


if($('#contactMessage').val().length < 15) {
jAlert('{$vsLang->getWords('err_contact_message_blank','Thông tin quá ngắn!')}','{$bw->vars['global_websitename']} Dialog');
$('#contactMessage').addClass('vs-error');
$('#contactMessage').focus();
return false;
}
                                        
                                          if(!$('#contactSecurity').val()) {
jAlert('{$vsLang->getWords('err_contact_phone_security','Vui lòng nhập mã bảo vệ!')}','{$bw->vars['global_websitename']} Dialog');
$('#contactSecurity').addClass('vs-error');
$('#contactSecurity').focus();
return false;
}   
$('#formContact').submit();
});


</script>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>