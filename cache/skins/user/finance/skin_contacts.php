<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_contacts extends skin_objectpublic {

//===========================================================================
// <vsf:contactForm:desc::trigger:>
//===========================================================================
function contactForm() {global $vsLang, $bw, $vsSettings,$vsPrint,$vsTemplate;

$vsPrint->addJavaScriptFile ("jquery.numeric",1);

//--starthtml--//
$BWHTML .= <<<EOF
        <form name="formContact" id="formContact"  method="POST" action="{$bw->base_url}contacts/send/" enctype="multipart/form-data">
         <h3>{$vsLang->getWords('contact_form','Điền thông tin liên hệ')}</h3>
         <input type="hidden" value="0" name="contactType"/>

EOF;
if( $vsSettings->getSystemKey("contact_form_name", 1, "contacts", 0, 1)) {
$BWHTML .= <<<EOF

<label>{$vsLang->getWords('contact_full_name','Họ và tên')}:</label>
            <input  type="text" id="contactName" name="contactName" title="{$vsLang->getWords('contact_full_name','Tên')}" value="{$bw->input['contactName']}"/>
            <div class="clear_left"></div>
            
EOF;
}

$BWHTML .= <<<EOF

            
         
EOF;
if( $vsSettings->getSystemKey("contact_form_phone", 1, "contacts", 0, 1)) {
$BWHTML .= <<<EOF

            <label>{$vsLang->getWords('contact_phone','Điện thoại')}:</label>
            <input type="text" class="numeric"  id="contactPhone" name="contactPhone" title="{$vsLang->getWords('contact_phone','Điện thoại')}" value="{$bw->input['contactPhone']}"/>
<div class="clear_left"></div>
            
EOF;
}

$BWHTML .= <<<EOF

            
            
EOF;
if( $vsSettings->getSystemKey("contact_form_address", 1, "contacts", 0, 1)) {
$BWHTML .= <<<EOF

            <label>{$vsLang->getWords('contact_address','Địa chỉ')}:</label>
            <input id="contactAddress" name="contactAddress" title="{$vsLang->getWords('contact_address','Địa chỉ')}"  type="text" value="{$bw->input['contactAddress']}"/>
            <div class="clear_left"></div>
            
EOF;
}

$BWHTML .= <<<EOF


EOF;
if( $vsSettings->getSystemKey("contact_form_email", 1, "contacts", 0, 1)) {
$BWHTML .= <<<EOF

            <label>{$vsLang->getWords('contact_email','Email')}:</label>
            <input type="text" id="contactEmail" name="contactEmail" title="{$vsLang->getWords('contact_email','Email')}" value="{$bw->input['contactEmail']}"/>
            <div class="clear_left"></div>
            
EOF;
}

$BWHTML .= <<<EOF

            
EOF;
if( $vsSettings->getSystemKey("contact_form_title", 1, "contacts", 0, 1)) {
$BWHTML .= <<<EOF

            <label>{$vsLang->getWords('contact_title','Tiêu đề')}:</label>
            <input  type="text" id="contactTitle" name="contactTitle" title="{$vsLang->getWords('contact_title','Tiêu đề')}" value="{$bw->input['contactTitle']}"/>
            <div class="clear_left"></div>
            
EOF;
}

$BWHTML .= <<<EOF

            
            
EOF;
if( $vsSettings->getSystemKey("contact_form_file", 0, "contacts", 0, 1)) {
$BWHTML .= <<<EOF

            <label>File:</label>
            <input type="file" class="file_input" id="realupload" name="contactFile" size="86"/>
<div class="clear_left"></div>
            
EOF;
}

$BWHTML .= <<<EOF
     
            
            
EOF;
if($vsSettings->getSystemKey("contact_form_content", 1, "contacts", 0, 1)) {
$BWHTML .= <<<EOF

            <label>{$vsLang->getWords("contact_message","Nội dung")}</label>
            <textarea id="contactMessage" name="contactContent">{$bw->input['contactContent']}</textarea>
            <div class="clear_left"></div>
            
EOF;
}

$BWHTML .= <<<EOF

            
<label>{$vsLang->getWords("contact_captcha","Mã bảo vệ")}:</label>
<input type="text" name="contactSecurity" id="contactSecurity" style="width:100px;float:left;"/> 
<div style="margin-left:10px;float:left;">
            <a href="javascript:;" style="float:left; padding-right:10px;">
                <img id="vscapcha" src="{$bw->vars['board_url']}/vscaptcha">
               </a>      
   <a href="javascript:;" class="mamoi" id="reload_img">
{$vsLang->getWords('contact_security','Tạo mã mới')}
</a>
</div>
<div class="clear_left"></div>
<p style="color:red;margin-left: 75px;">{$bw->input['message']}</p>
<div class="clear_left"></div>
<input type="submit" value="{$vsLang->getWords('contact_sends','Gửi')}" class="input_submit" />
            <input type="reset" value="{$vsLang->getWords('contact_reset','Làm lại')}" class="input_reset" />
<div class="clear_left"></div>
</form>
<script type='text/javascript'>
function checkMail(mail){
var filter = /^([a-zA-Z0-9_\\.\\-])+\\@(([a-zA-Z0-9\\-])+\\.)+([a-zA-Z0-9]{2,4})+$/;
if (!filter.test(mail)) return false;
return true;
}
$("input.numeric").numeric();
$("#reload_img").click(function(){
                        $("#vscapcha").attr("src",$("#vscapcha").attr("src")+"?a");
                        $('#random').val('');
                        return false;
});
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
if( $vsSettings->getSystemKey("contact_form_email", 1, "contacts", 1, 1)) {
$BWHTML .= <<<EOF

if(!$('#contactEmail').val()|| !checkMail($('#contactEmail').val())) {
jAlert('{$vsLang->getWords('err_contact_email_blank','Vui lòng nhập đúng loại email!')}','{$bw->vars['global_websitename']} Dialog');
$('#contactEmail').addClass('vs-error');
$('#contactEmail').focus();
return false;
}

EOF;
}

$BWHTML .= <<<EOF



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
jAlert('{$vsLang->getWords('err_contact_security_blank','Vui lòng nhập mã bảo vệ!')}','{$bw->vars['global_websitename']} Dialog');
$('#contactSecurity').addClass('vs-error');
$('#contactSecurity').focus();
return false;
}
//$('#formContact').submit();
});

</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:thankyou:desc::trigger:>
//===========================================================================
function thankyou($text="",$url="") {global $vsLang,$bw,$vsTemplate,$vsPrint;

//--starthtml--//
$BWHTML .= <<<EOF
        <script type='text/javascript'>
setTimeout('delayer()', 3000);
function delayer(){
    window.location = "{$bw->base_url}$url.html";
}
</script>
   
<div id="content_contact">
    <h3 class="main_title">{$vsPrint->pageTitle}</h3>
        <div id="contact">
        <h1>{$text}</h1>
      <p>{$vsLang->getWords('redirect_title','Chuyển trang...')}</p>
 <a style="color:#faaa20;" href='{$bw->base_url}{$url}'>({$vsLang->getWords('redirect_immediate','Click vào đây nếu không muốn chờ lâu')})</a>
        </div> 
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw, $vsLang, $vsSettings,$vsPrint,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content_contact">
    <h3 class="main_title">{$vsPrint->pageTitle}</h3>
        <div id="contact">
        <h1>{$option['contact']->getTitle()}</h1>
            <p>{$option['contact']->getContent()}</p>
            {$this->contactForm()}
        </div>
        <div class="map" id="map_canvas"></div>
        <div class="clear"></div> 
    </div>

            
EOF;
if($option['contact'] && $option['contact']->getLongitude() && $option['contact']->getLatitude()) {
$BWHTML .= <<<EOF

       <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&language=vi"></script>
<script  type="text/javascript">
    function init() {
                                               
                   var myHtml = "<h4>{$option['contact']->getTitle()}</h4><p>{$option['contact']->getAddress()}</p>";
                                                
      var map = new google.maps.Map(
      document.getElementById("map_canvas"),
      {scaleControl: true}
      );
      map.setCenter(new google.maps.LatLng({$option['contact']->getLatitude()},{$option['contact']->getLongitude()}));
      map.setZoom(15);
      map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
      var marker = new google.maps.Marker({
      map: map,
      position:map.getCenter()
});
var infowindow = new google.maps.InfoWindow({
'pixelOffset': new google.maps.Size(0,15)
});
      infowindow.setContent(myHtml);
      infowindow.open(map, marker);
    }
    $(document).ready(function(){
init();
});
</script>

EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:loadRequireJavascript:desc::trigger:>
//===========================================================================
function loadRequireJavascript() {global $vsLang, $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <script type='text/javascript'>
fontend = {
get:function(act, id) {
var params = {
ajax:1,
vs: act,
identifyId :document.getElementById('identifyCode').name
};
$.get(ajaxfile,params,function(data){
document.getElementById('identifyCode').name = data;
document.getElementById('identifyCode').src = '{$bw->base_url}contacts/createIdentifyCodeImage/'+data;
});
},
submitForm:function(obj,act,id) {
var params = {
vs:act,
ajax: 1
};
var count = 0;
obj
.find("input[type='radio']:checked, input[checked], input[type='text'], input[type='hidden'], input[type='password'], input[type='submit'], option[selected], textarea")
.each(function() {
params[ this.name || this.id || this.parentNode.name || this.parentNode.id ] = this.value;
});
$.post(ajaxfile,params,function(data){
$("#"+id).html(data);
});
}
}
</script>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>