<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_contacts extends skin_objectpublic {

//===========================================================================
// <vsf:contactForm:desc::trigger:>
//===========================================================================
function contactForm() {global $vsLang, $bw, $vsSettings,$vsPrint;
$vsPrint->addJavaScriptFile ("jquery.numeric",1);
//$vsPrint->addJavaScriptFile( 'jquery/ui.core');
//$vsPrint->addJavaScriptFile( 'jquery/ui.widget');
//$vsPrint->addJavaScriptFile( 'jquery/ui.tabs');
//$vsPrint->addJavaScriptFile( 'jquery/ui.position');
//$vsPrint->addJavaScriptFile( 'jquery/ui.dialog');
$vsPrint->addJavaScriptFile( "jquery/ui.alerts");
//$vsPrint->addJavaScriptFile( "jquery/ui.cyclel");
        //$vsPrint->addJavaScriptFile( "jquery.mousewheel");

//--starthtml--//
$BWHTML .= <<<EOF
        <form name="formContact" id="formContact" class="contact_form" method="POST" action="{$bw->base_url}contacts/send/" enctype="multipart/form-data">
<input type="hidden" name="contactPrePage" value="{$bw->input['contactPrePage']}"/>
         <input type="hidden" value="{$bw->input['contactType']}" name="contactType"/>

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
            <input type="text" id="contactTitle" name="contactTitle" value="{$bw->input['contactTitle']}" title="{$vsLang->getWords('contact_title','Tiêu đề')}" />
            
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

                 
            <label>{$vsLang->getWords('contact_security','Mã bảo vệ')}</label>
            <input class="text_input" name="contactSecurity" id="contactSecurity" style="width:100px"/><span></span>
                    <div class="random" style="width: 255px; float: left; ">
                    
                    <img id="siimage" align="left" style="padding-right: 5px; border: 0" src="{$bw->vars['board_url']}/captcha/securimage_show.php?sid={$id}" />
                          
                            <!-- pass a session id to the query string of the script to prevent ie caching -->
                            <span style="padding-top:10px;margin-left:0px;">
                            <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '{$bw->vars['board_url']}/captcha/securimage_show.php?sid=' + Math.random(); return false">
                                    <img src="{$bw->vars['board_url']}/captcha/images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" style="margin-left: 0px !important;" />
                            </a>
                            </span> 
              </div>
              <div class="clear"></div>
        
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
                                        return false;
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
    window.location = "{$url}";
}
</script>
                        
                <div id="content">  
                    <div class="main_title">
                        <h1 class="main_title_contact">{$vsPrint->mainTitle}</h1>
                </div>
                <div class="tintuc" id="center">
                
                <div  id="contact">
                      <h1 class="tintuc_title">{$vsPrint->mainTitle}</h1>
                          
                          <h3 class="title_center">{$vsLang->getWords("dienthongtinlienhe_{$bw->input['contactType']}",'Điền thông tin liên hệ')}:</h3>
                           <div class="tuvan_cauhoi" style="text-align:center">
             <h3>{$text}</h3>
           <p>{$vsLang->getWords('redirect_title','Chuyển trang...')}</p>
           <a style="color:#faaa20;" href='{$bw->base_url}{$url}'>({$vsLang->getWords('redirect_immediate','Click vào đây nếu không muốn chờ lâu')})</a>
</div>
        </div>    
 </div>                            
                        
                               
                
                </div>
                <!-- STOP CONTENT HOME ITEM -->
              
              </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showFormDefault:desc::trigger:>
//===========================================================================
function showFormDefault($option="") {global $bw, $vsTemplate, $vsPrint,$vsLang;
              

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">  
                    <div class="main_title">
                        <h1 class="main_title_contact">{$vsPrint->mainTitle}</h1>
                </div>
                <div class="tintuc" id="center">
                
                <div  id="contact">
                      <h1 class="tintuc_title">{$vsPrint->mainTitle}</h1>
                          
                          <h3 class="title_center">{$vsLang->getWords("dienthongtinlienhe_{$bw->input['contactType']}",'Điền thông tin liên hệ')}:</h3>
                          {$this->contactForm()}    
 </div>                            
          
                </div>
                <!-- STOP CONTENT HOME ITEM -->
              
              </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw, $vsLang, $vsSettings,$vsPrint,$vsTemplate;
//$vsPrint->addCurentJavaScriptFile("jMenu",1);
//$vsPrint->addCSSFile('accordion');
              $bw->input['contactType'] = 0;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">  
                    <div class="main_title">
                        <h1 class="main_title_contact">{$vsPrint->mainTitle}</h1>
                </div>
                <div class="tintuc" id="center">
                
                <div  id="contact">
                      <h1 class="tintuc_title">{$option['contact']->getTitle()}</h1>
                         {$option['contact']->getContent()}
                          
                          <h3 class="title_center">{$vsLang->getWords("dienthongtinlienhe_{$bw->input['contactType']}",'Điền thông tin liên hệ')}:</h3>
                          {$this->contactForm()}    
 </div>                            
                          <div class="map" id="map_canvas" >
                                 <img src="{$bw->vars['img_url']}/map.jpg" />
                          </div>                 
                    
                        
                                {$vsTemplate->global_template->scrolltop}
                
                </div>
                <!-- STOP CONTENT HOME ITEM -->
              
              </div> 
    
            
EOF;
if($option['contact']->getLongitude() && $option['contact']->getLatitude()) {
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