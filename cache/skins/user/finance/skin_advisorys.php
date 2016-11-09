<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_advisorys extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option="") {global $bw, $vsTemplate, $vsPrint,$vsLang;

//--starthtml--//
$BWHTML .= <<<EOF
        <h2 class="main_title title_simplepage">{$vsTemplate->global_template->navigator}</h2>
        <div class="tuvan">
            
EOF;
if($option['pageList']) {
$BWHTML .= <<<EOF

    {$this->__foreach_loop__id_4fa74d801fe11($option)}
      
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

     {$this->advisoryForm("default",$option)}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4fa74d801fe11($option="")
{
global $bw, $vsTemplate, $vsPrint,$vsLang;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['pageList'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
          <p class="tuvan_item">{$obj->getTitle()}<a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}"> - ({$vsLang->getWords('advisorys_viewanswer','Xem trả lời')})</a></p>
        
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
        <h2 class="main_title title_simplepage">{$vsTemplate->global_template->navigator}</h2>
        <div class="tuvan">
        <p class="tuvan_item">{$obj->getTitle()}</p>
        <div class="traloi">
        <p class="traloi_p">{$vsLang->getWords('advisorys_answer','Trả lời')} :</p>
        <p>{$obj->getContent()}</p>
        </div>
        <h3 class="other_tuvan">{$vsLang->getWords($bw->input['module'].'_other','Tin tức cùng chủ đề')}</h3>
            
EOF;
if($option['other']) {
$BWHTML .= <<<EOF

    {$this->__foreach_loop__id_4fa74d801ff95($obj,$option)}

EOF;
}

$BWHTML .= <<<EOF

  </div>

     {$this->advisoryForm("detail",$option)}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4fa74d801ff95($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['other'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
          <p class="tuvan_item">{$obj->getTitle()}<a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}"> - ({$vsLang->getWords('advisorys_viewanswer','Xem trả lời')})</a>
        
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:advisoryForm:desc::trigger:>
//===========================================================================
function advisoryForm($skin="",$option="") {global $vsLang, $bw, $vsSettings,$vsPrint;
$vsPrint->addJavaScriptFile ("jquery.numeric",1);

//--starthtml--//
$BWHTML .= <<<EOF
        <h3 class="form_tuvan_title">{$vsLang->getWords('advisorys_form','Gửi câu hỏi tư vấn')}</h3>
       
        <form name="formContact" id="formContact" class="form_tuvan" method="POST" action="{$bw->base_url}advisorys/send/" enctype="multipart/form-data">
<input  name="skin" type="hidden" value="$skin">
<input  name="id" type="hidden" value="{$option['id']}">
<p class="tuvan_noidung">{$vsLang->getWords('advisory_message','Nhập nội dung cần tư vấn')} <span>*</span></p>
            <textarea id="advisoryMessage" name="advisoryTitle">{$bw->input['advisoryTitle']}</textarea>
            <div class="clear_left"></div>
            
            <input id="advisoryName" name="advisoryName" onfocus="if(this.value=='{$vsLang->getWords('advisory_full_name','Họ tên')}') this.value='';" onblur="if(this.value=='') this.value='{$vsLang->getWords('advisory_full_name','Họ tên')}';" 
EOF;
if($bw->input['advisoryName']) {
$BWHTML .= <<<EOF
value="{$bw->input['advisoryName']}" 
EOF;
}

else {
$BWHTML .= <<<EOF
value="{$vsLang->getWords('advisory_full_name','Họ tên')}"
EOF;
}
$BWHTML .= <<<EOF
>
 
            <input id="advisoryEmail" name="advisoryEmail" onfocus="if(this.value=='{$vsLang->getWords('advisory_email','Email')}') this.value='';" onblur="if(this.value=='') this.value='{$vsLang->getWords('advisory_email','Email')}';" 
EOF;
if($bw->input['advisoryEmail']) {
$BWHTML .= <<<EOF
value="{$bw->input['advisoryEmail']}" 
EOF;
}

else {
$BWHTML .= <<<EOF
value="{$vsLang->getWords('advisory_email','Email')}"
EOF;
}
$BWHTML .= <<<EOF
 >
           
<input type="text" name="advisorySecurity" id="advisorySecurity" style="width:100px" onfocus="if(this.value=='{$vsLang->getWords("advisory_captcha","Mã bảo vệ")}') this.value='';" onblur="if(this.value=='') this.value='{$vsLang->getWords("advisory_captcha","Mã bảo vệ")}';" value="{$vsLang->getWords("advisory_captcha","Mã bảo vệ")}"/> <span style="float:left; margin-top:15px;margin-right:10px;">*</span>
<div style="float:left;">
            <a href="javascript:;" style="float:left; margin-top:10px;">
                <img id="vscapcha" src="{$bw->vars['board_url']}/vscaptcha">
               </a>      
   <a href="javascript:;" class="mamoi" id="reload_img">
<img src="{$bw->vars['img_url']}/capcha_btn.jpg">
</a>
</div>
<input type="submit" value="{$vsLang->getWords('button_send','Gửi tư vấn')}" class="input_submit" />
<div class="clear_left"></div>
<p style="color: #242424;font-size: 11px;text-align:right;">{$vsLang->getWords('advisorys_note','Lưu ý:')} <span>*</span> {$vsLang->getWords('advisorys_note2','là nội dung bắt buộc')}</p>
<p style="color:red;margin-left: 97px;">{$bw->input['message']}</p>
          <div class="clear"></div>
</form>
<script type='text/javascript'>
$("#reload_img").click(function(){
                        $("#vscapcha").attr("src",$("#vscapcha").attr("src")+"?a");
                        $('#random').val('');
                        return false;
});
$('#formContact').submit(function(){
if(!$('#advisoryMessage').val()) {
jAlert('{$vsLang->getWords('err_advisory_title_blank','Vui lòng nhập nội dung!')}','{$bw->vars['global_websitename']} Dialog');
$('#advisoryMessage').addClass('vs-error');
$('#advisoryMessage').focus();
return false;
}
if($('#advisorySecurity').val()=='{$vsLang->getWords("advisory_captcha","Mã bảo vệ")}' || !$('#advisorySecurity').val()) {
jAlert('{$vsLang->getWords('err_advisory_security_blank','Vui lòng nhập mã bảo vệ!')}','{$bw->vars['global_websitename']} Dialog');
$('#advisorySecurity').addClass('vs-error');
$('#advisorySecurity').focus();
return false;
}
if($('#advisoryName').val()=='{$vsLang->getWords('advisory_full_name','Họ tên')}') {
$('#advisoryName').val('');
}
if($('#advisoryEmail').val()=='{$vsLang->getWords('advisory_email','Email')}') {
$('#advisoryEmail').val('');
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
<h2 class="main_title title_simplepage">{$vsPrint->pageTitle}</h2>
  <div class="tuvan">
        <h1>{$text}</h1>
      <p>{$vsLang->getWords('redirect_title','Chuyển trang...')}</p>
 <a style="color:#faaa20;" href='{$bw->base_url}{$url}'>({$vsLang->getWords('redirect_immediate','Click vào đây nếu không muốn chờ lâu')})</a>    
  </div>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>