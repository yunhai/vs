<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_recruitments extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option="") {global $bw, $vsTemplate, $vsPrint,$vsLang;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="center_page">
   <h1 class="main_title">{$vsTemplate->global_template->navigator}</h1>
   <div class="tintuc_page">
   
EOF;
if($option['pageList']) {
$BWHTML .= <<<EOF

    {$this->__foreach_loop__id_4f9621fcad400($option)}
      
EOF;
}

else {
$BWHTML .= <<<EOF

        <p class="nodata">{$vsLang->getWordsGlobal('global_nodata','Dữ liệu đang được chúng tôi cập nhật')}</p>
        
EOF;
}
$BWHTML .= <<<EOF

        
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
<div id="contact" style="padding-top: 20px;border-top: 1px solid #cccccc;">
{$this->recruitmentForm("default",$option)}
     </div>
       
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f9621fcad400($option="")
{
global $bw, $vsTemplate, $vsPrint,$vsLang;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['pageList'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <div class="news_item">
        
EOF;
if($obj->file) {
$BWHTML .= <<<EOF

        <a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}" class="news_img">{$obj->createImageCache($obj->file,117,74,2)}</a>
        
EOF;
}

$BWHTML .= <<<EOF

            <h3><a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}">{$obj->getTitle()}</a></h3>
              <p class="news_intro">{$obj->getIntro(330)} </p>
               <div class="clear_left"></div>
        </div>
        
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="center_page">
   <h1 class="main_title">{$vsTemplate->global_template->navigator}</h1>
   
EOF;
if($obj) {
$BWHTML .= <<<EOF

      <div class="tintuc_detail">
      <h3>{$obj->getTitle()} </h3>
        <p>{$obj->getContent()}</p>
        <a href="{$_SERVER['HTTP_REFERER']}" class="back_link">{$vsLang->getWords('recruitment_back','Quay lại trang trước')}</a>
        <div class="clear_right"></div>
</div>

EOF;
}

$BWHTML .= <<<EOF

<div id="contact">
{$this->recruitmentForm("detail",$option)}
     </div>
       
</div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:recruitmentForm:desc::trigger:>
//===========================================================================
function recruitmentForm($skin="",$option="") {global $vsLang, $bw, $vsSettings,$vsPrint;
$vsPrint->addJavaScriptFile ("jquery.numeric",1);

//--starthtml--//
$BWHTML .= <<<EOF
        <h3 class="form_title">{$vsLang->getWords($bw->input['module'].'_form','Tuyển dụng trực tuyến')}</h3>    
        <form name="formContact" id="formContact"  method="POST" action="{$bw->base_url}recruitments/send/" enctype="multipart/form-data">
<input  name="skin" type="hidden" value="$skin">
<input  name="id" type="hidden" value="{$option['id']}">
<input type="hidden" value="1" name="contactType"/>
<label>{$vsLang->getWords('recruitment_full_name','Họ tên')}</label>
            <input id="contactName" name="contactName" title="{$vsLang->getWords('recruitment_full_name','Họ tên')}" value="{$bw->input['contactName']}">
            <div class="clear_left"></div>
            
          
            <label >{$vsLang->getWords('recruitment_address','Địa chỉ')}:</label>
            <input id="contactAddress" name="contactAddress" title="{$vsLang->getWords('recruitment_address','Địa chỉ')}"  type="text" value="{$bw->input['contactAddress']}"/>
            <div class="clear_left"></div>
            
            
            <label>{$vsLang->getWords('recruitment_phone','Điện thoại')}:</label>
            <input  type="text" class="numeric"  id="contactPhone" name="contactPhone" title="{$vsLang->getWords('recruitment_phone','Điện thoại')}" value="{$bw->input['contactPhone']}"/>
<div class="clear_left"></div>
           
            
            <label>{$vsLang->getWords('recruitment_email','Email')}</label>
            <input id="contactEmail" name="contactEmail" title="{$vsLang->getWords('recruitment_email','Email')}" value="{$bw->input['contactEmail']}">
<div class="clear_left"></div>
            
            <label>{$vsLang->getWords('recruitment_title','Vị trí ứng tuyển')}  </label>
           <input id="contactTitle" name="contactTitle" title="{$vsLang->getWords('recruitment_title','Vị trí ứng tuyển')}" value="{$bw->input['contactTitle']}">
           <div class="clear_left"></div>
            
           
           
            <label>{$vsLang->getWords('recruitment_message','Nội dung')} </label>
            <textarea id="contactMessage" name="contactContent">{$bw->input['contactContent']}</textarea>
            <div class="clear_left"></div>
            
            <label>{$vsLang->getWords("recruitment_captcha","Mã bảo vệ")}:</label>
<input type="text" name="contactSecurity" id="contactSecurity" style="width:100px"/> 
<div style="margin-left:10px;float:left;">
            <a href="javascript:;" style="float:left; padding-right:10px;">
                <img id="vscapcha" src="{$bw->vars['board_url']}/vscaptcha">
               </a>      
   <a href="javascript:;" class="mamoi" id="reload_img">
{$vsLang->getWords('recruitment_security','Tạo mã mới')}
</a>
</div>
<div class="clear_left"></div>
<p style="color:red;margin-left: 97px;">{$bw->input['message']}</p>
            
     <input type="submit" value="{$vsLang->getWords('button_send','Gửi')}" class="input_submit" />
     <input type="reset" value="{$vsLang->getWords('button_reset','Làm lại')}" class="input_reset" />
          
          <div class="clear"></div>
</form>
<script type='text/javascript'>
function checkMail(mail){
var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
if (!filter.test(mail)) return false;
return true;
}
vsf.jSelect('{$bw->input['advisoryCat']}','advisoryCat');

$("input.numeric").numeric();
$("#reload_img").click(function(){
                        $("#vscapcha").attr("src",$("#vscapcha").attr("src")+"?a");
                        $('#random').val('');
                        return false;
});
$('#formContact').submit(function(){
if(!$('#contactName').val()) {
jAlert('{$vsLang->getWords('err_contact_name_blank','Vui lòng nhập họ tên!')}','{$bw->vars['global_websitename']} Dialog');
$('#contactName').addClass('vs-error');
$('#contactName').focus();
return false;
}
if(!$('#contactAddress').val()) {
jAlert('{$vsLang->getWords('err_contact_address_blank','Vui lòng nhập địa chỉ!')}','{$bw->vars['global_websitename']} Dialog');
$('#contactAddress').addClass('vs-error');
$('#contactAddress').focus();
return false;
}
if(!$('#contactPhone').val()) {
jAlert('{$vsLang->getWords('err_contact_phone_blank','Vui lòng nhập số điện thoại!')}','{$bw->vars['global_websitename']} Dialog');
$('#contactPhone').addClass('vs-error');
$('#contactPhone').focus();
return false;
}
if(!$('#contactEmail').val()|| !checkMail($('#contactEmail').val())) {
jAlert('{$vsLang->getWords('err_contact_email_blank','Nhập vào đúng loại email!')}','{$bw->vars['global_websitename']} Dialog');
$('#contactEmail').addClass('vs-error');
$('#contactEmail').focus();
return false;
}

if(!$('#contactTitle').val()) {
jAlert('{$vsLang->getWords('err_contact_title_blank','Vui lòng nhập câu hỏi!')}','{$bw->vars['global_websitename']} Dialog');
$('#contactTitle').addClass('vs-error');
$('#contactTitle').focus();
return false;
}

if($('#contactMessage').val().length < 15 ) {
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
$('#formContact').submit();
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
<div id="center_page">
   <h1 class="main_title">{$vsPrint->pageTitle}</h1>
      <div class="tintuc_detail">
      <h1>{$text}</h1>
      <p>{$vsLang->getWords('redirect_title','Chuyển trang...')}</p>
 <a style="color:#faaa20;" href='{$bw->base_url}{$url}'>({$vsLang->getWords('redirect_immediate','Click vào đây nếu không muốn chờ lâu')})</a>
</div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>