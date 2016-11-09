<?php
class skin_addon{

//===========================================================================
// <vsf:showMenuTopForUser:desc::trigger:>
//===========================================================================
function showMenuTopForUser($option=array()) {global $bw, $vsLang ,$vsTemplate;
               

//--starthtml--//
$BWHTML .= <<<EOF
        <ul class="menu_top menu_top{$vsLang->currentLang->getFoldername()}" style="display:block !important;">
                    <li><a href="{$bw->base_url}home"  title="" 
EOF;
if($bw->input['module']=='home') {
$BWHTML .= <<<EOF
class="active"
EOF;
}

$BWHTML .= <<<EOF
 ><span>{$vsLang->getWords('global_Trangchu','Trang chủ')}</span></a>
                    {$this->__foreach_loop__id_4f2f90b38148a($option)}
                    <div class="clear_left"></div>
                    
</ul>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2f90b38148a($option=array())
{
global $bw, $vsLang ,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <li><a href="{$obj->getUrl(0)}"  title="{$obj->getTitle()}" class="{$obj->getClassActive()}"><span>{$obj->getTitle()}</span></a>
                           
                        </li>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showMenuRight:desc::trigger:>
//===========================================================================
function showMenuRight($option=array()) {global $bw, $vsLang ,$vsTemplate;
               

//--starthtml--//
$BWHTML .= <<<EOF
        <ul class="menu_golf" id="menu">
                     {$this->__foreach_loop__id_4f2f90b3817a0($option)}
                    
                </ul>
       <div  class="clear_left"></div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2f90b3817a0($option=array())
{
global $bw, $vsLang ,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li><a href="{$obj->getUrl(0)}" title="{$obj->getTitle()}">{$obj->getTitle()}</a>
                    
EOF;
if($vsTemplate->global_template->menu_sub[$obj->getUrl()] || $obj->getChildren()) {
$BWHTML .= <<<EOF

                                <ul >
                                    {$vsTemplate->global_template->menu_sub[$obj->getUrl()]}
                                    {$obj->getChildrenLi()}
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
// <vsf:scrolltop:desc::trigger:>
//===========================================================================
function scrolltop() {global $bw, $vsLang ,$vsTemplate;
               

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="run_page">
                        
EOF;
if($_SERVER['HTTP_REFERER']) {
$BWHTML .= <<<EOF
         
                            <a href="{$_SERVER['HTTP_REFERER']}" class="back_page">{$vsLang->getWords('global_trove','Trở về')}</a> |
                        
EOF;
}

$BWHTML .= <<<EOF

                        <a href="javascript:;" class="top_page">{$vsLang->getWords('global_dautrang','Đầu trang')}</a>
                </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showMenuBottomForUser:desc::trigger:>
//===========================================================================
function showMenuBottomForUser($option=array()) {global $bw, $vsLang ,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        <ul class="menu_footer">
       {$this->__foreach_loop__id_4f2f90b381c42($option)}
        <div class="clear_left"></div>
     </ul>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2f90b381c42($option=array())
{
global $bw, $vsLang ,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <li><a href="{$obj->getUrl(0)}" class="{$obj->getClassActive()}" title="{$obj->getTitle()}">{$obj->getTitle()}</a></li>
      
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showSearchLeft:desc::trigger:>
//===========================================================================
function showSearchLeft() {global $bw, $vsLang ,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="sitebar_item">
        <h3 class="sitebar_title">{$vsLang->getWordsGlobal("global_dattiecol","Đặt tiệc online")}</h3>
            <form id="dattiec" class="dattiec" method="POST" action="{$bw->base_url}contacts/send/">
            <label>{$vsLang->getWords('global_loai','Loại')} </label>
                <input type="hidden" name="contactPrePage" value="{$bw->base_url}{$bw->input['vs']}"/>
                <select name="contactType" >
                <option value="2">{$vsLang->getWords('global_tieccuoi','Tiệc cưới')}</option>
                        <option value="3">{$vsLang->getWords('global_hoinghi','Hội nghị')}</option>
                </select>                
                <label>{$vsLang->getWords('global_hoten','Họ & Tên')}</label><input type="text" id="contact1Name" name="contactName"  title="{$vsLang->getWords('contact_full_name','Họ và Tên')}" />
                <label>{$vsLang->getWords('global_diachi','Địa chỉ')}</label><input id="contact1Address" name="contactAddress"  title="{$vsLang->getWords('contact_address','Địa chỉ')}"  type="text" />
                <label>{$vsLang->getWords('global_dienthoai','Điện thoại')}</label><input type="text" class="numeric"   id="contact1Phone" name="contactPhone" maxlength="11" title="{$vsLang->getWords('contact_phone','Điện thoại')}" />
                <label>Email</label><input id="contact1Email" name="contactEmail"  title="{$vsLang->getWords('contact_address','Địa chỉ')}"  type="text" />
                <label>{$vsLang->getWords('global_tieude','Tiêu đề')}</label><input type="text" id="contact1Title" name="contactTitle"  title="{$vsLang->getWords('contact_title','Tiêu đề')}" />
                <label>{$vsLang->getWords('global_noidung','Nội dung')}</label><textarea id="contact1Message" name="contactContent"></textarea>
                <label>{$vsLang->getWords('global_security','Mã bảo vệ')}</label>
            <input class="text_input" name="contactSecurity" id="contact1Security" style="width:100px"/><span></span>
                    <div class="random" style="width: 255px; float: left;margin-left:57px ">
                    
                    <img id="siimage" align="left" style="padding-right: 5px; border: 0" src="{$bw->vars['board_url']}/captcha/securimage_show.php?sid={$id}" />
                          
                            <!-- pass a session id to the query string of the script to prevent ie caching -->
                            <span style="padding-top:10px;margin-left:0px;">
                            <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '{$bw->vars['board_url']}/captcha/securimage_show.php?sid=' + Math.random(); return false">
                                    <img src="{$bw->vars['board_url']}/captcha/images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" style="margin-left: 0px !important;" />
                            </a>
                            </span> 
              </div>
                <p>{$vsLang->getWords('global_datcoc','Ghi chú: Đặt cọc trước 30%')}</p>
                                    <div class="clear_left"></div>
                <input type="button" value="{$vsLang->getWords('global_dattiec','Đặt tiệc')}" id="dattiecol" class="submit_btn" />
                <div class="clear"></div>
            </form>
        </div>
<script type='text/javascript'>
function checkMail1(mail){
var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
if (!filter.test(mail)) return false;
return true;
}
//$("input.numeric").numeric();
$('#dattiecol').click(function(){
if(!$('#contact1Name').val()) {
jAlert('{$vsLang->getWords('global_contact_name_blank','Vui lòng nhập họ tên!')}','{$bw->vars['global_websitename']} Dialog');
$('#contact1Name').addClass('vs-error');
$('#contact1Name').focus();
return false;
}

if(!$('#contact1Address').val()) {
jAlert('{$vsLang->getWords('global_contact_address_blank','Vui lòng nhập địa chỉ!')}','{$bw->vars['global_websitename']} Dialog');
$('#contact1Address').addClass('vs-error');
$('#contact1Address').focus();
return false;
}

if(!$('#contact1Phone').val()) {
jAlert('{$vsLang->getWords('global_contact_phone_blank','Vui lòng nhập số điện thoại!')}','{$bw->vars['global_websitename']} Dialog');
$('#contact1Phone').addClass('vs-error');
$('#contact1Phone').focus();
return false;
}

if(!$('#contact1Email').val()|| !checkMail1($('#contact1Email').val())) {
jAlert('{$vsLang->getWords('global_contact_email_blank','Vui lòng nhập đúng loại email!')}','{$bw->vars['global_websitename']} Dialog');
$('#contact1Email').addClass('vs-error');
$('#contact1Email').focus();
return false;
}


if(!$('#contact1Title').val()) {
jAlert('{$vsLang->getWords('global_contact_title_blank','Vui lòng nhập câu hỏi!')}','{$bw->vars['global_websitename']} Dialog');
$('#contact1Title').addClass('vs-error');
$('#contact1Title').focus();
return false;
}
if($('#contact1Message').val().length < 15) {
jAlert('{$vsLang->getWords('global_contact_message_blank','Thông tin quá ngắn!')}','{$bw->vars['global_websitename']} Dialog');
$('#contact1Message').addClass('vs-error');
$('#contact1Message').focus();
return false;
}
                                        
                                          if(!$('#contact1Security').val()) {
jAlert('{$vsLang->getWords('global_contact_phone_security','Vui lòng nhập mã bảo vệ!')}','{$bw->vars['global_websitename']} Dialog');
$('#contact1Security').addClass('vs-error');
$('#contact1Security').focus();
return false;
}   
$('#dattiec').submit();
});

</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:portlet_supports:desc::trigger:>
//===========================================================================
function portlet_supports($option=array()) {global $bw, $vsLang;
$this->arra = array(1=>"Nick Yahoo",2=>"Nick Skype");

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option) {
$BWHTML .= <<<EOF

                {$this->__foreach_loop__id_4f2f90b3822e2($option)}        

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
function __foreach_loop__id_4f2f90b382172($option=array(),$k='',$v='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach(  $option as $key =>$obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                            
EOF;
if($obj->getType()==$k) {
$BWHTML .= <<<EOF

                                {$obj->show()}
                                    
EOF;
}

$BWHTML .= <<<EOF

                            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2f90b3822e2($option=array())
{
global $bw, $vsLang;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $this->arra as $k => $v )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
               
                    {$this->__foreach_loop__id_4f2f90b382172($option,$k,$v)}
                    <div class="clear_left"></div>
                
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:portlet_banner:desc::trigger:>
//===========================================================================
function portlet_banner($option="") {global $bw, $vsLang,$vsPrint;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option) {
$BWHTML .= <<<EOF

            <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
            {$this->__foreach_loop__id_4f2f90b3826f4($option)}
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
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2f90b3826f4($option="")
{
global $bw, $vsLang,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $slide )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
             {$slide->show(1000,318)}
             
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:portlet_video:desc::trigger:>
//===========================================================================
function portlet_video($list="") {global $bw, $vsLang,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($list) {
$BWHTML .= <<<EOF

<h3>{$vsLang->getWordsGlobal('global_video','giới thiệu sản phẩm')}</h3>
<div class="sitebar_right_video">
        {$list->show(209,171)}       
     </div>
     
EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:portlet_partner:desc::trigger:>
//===========================================================================
function portlet_partner($option="") {global $bw, $vsLang,$vsPrint;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option) {
$BWHTML .= <<<EOF

       
   
       {$this->__foreach_loop__id_4f2f90b382b45($option)}
         

 
      
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
function __foreach_loop__id_4f2f90b382b45($option="")
{
global $bw, $vsLang,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
           <div class="sitebar_item">
                <a href="{$obj->getWebsite()}" title="{$obj->getTitle()}" target="_blank" class="sitebar_img">
                {$obj->createImageCache($obj->file,206,86)}
                </a>
                <p><a href="{$obj->getWebsite()}" title="{$obj->getTitle()}" target="_blank">{$obj->getTitle()}</a></p>
          </div>
            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:portlet_bannertop:desc::trigger:>
//===========================================================================
function portlet_bannertop($option="") {global $bw, $vsLang,$vsPrint;
 

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option) {
$BWHTML .= <<<EOF

    <div class="banner">
                 
                    {$option->file->show(699,250)}
                   
            </div>
    
EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showFormSearch:desc::trigger:>
//===========================================================================
function showFormSearch() {global $bw, $vsLang ,$vsTemplate;
               $stringSearch = $vsLang->getWords('global_tim','Tìm kiếm sản phẩm...');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="search_top">
                    <label>{$vsLang->getWords('global_timk','Tìm kiếm')}:</label>
                    <input type="text" onfocus="if(this.value=='{$stringSearch}') this.value='';" onblur="if(this.value=='') this.value='{$stringSearch}';" value="{$stringSearch}" class="input_text" id="keySearch"/>
                    <input type="button" value="" class="search_submit" id="submit_form_search"/>
                </div>
                <script language="javascript" type="text/javascript">
                $(document).ready(function(){
//$("#keySearch").keydown(function(e){
//                    if(e.keyCode==13){
//                     $('#submit_form_search').click();
//                    return false;
//                    }
//                    });
                $('#submit_form_search').click(function()  {
                    if($('#keySearch').val()==""||$('#keySearch').val()=="{$stringSearch}") {
                        jAlert('{$vsLang->getWords('global_tim_thongtin','Vui lòng nhập thông tin cần search:please!!!!!')}',
                        '{$bw->vars['global_websitename']} Dialog');
                        return false;
                    }
                     
                     document.location.href="{$bw->base_url}searchs/"+ $('#keySearch').val();
                           return;
                });
                });
                </script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:portlet_polls:desc::trigger:>
//===========================================================================
function portlet_polls() {global $bw,$vsLang,$vsMenu,$vsStd;
$vsStd->requireFile(CORE_PATH."polls/polls.php");
$this->po = new polls();

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($vsMenu->getCategoryGroup('polls')->children) {
$BWHTML .= <<<EOF

<div class="vote">
<h3>{$vsLang->getWords('global_poll','THĂM DÒ Ý KIẾN')}</h3>
{$this->__foreach_loop__id_4f2f90b383260()}
<div id='sa'></div>
<script>
       function CheckThisVote(valu){
$('input[type=checkbox]').each(function(){
if(this.value!=valu){
if(this.checked)
this.checked = false
}
});
}
$("#subvoite").click(function(){
var value =0;
$("input[type=checkbox]").each(function(){
if(this.checked)
value = this.value;
})
if(!value){
alert("{$vsLang->getWordsGlobal('global_error_vote','Hãy chọn một trong các mục trước khi bình chọn')}");
return false;
}
vsf.get("polls/vote/"+value,"sa");
})
       </script>
       
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
function __foreach_loop__id_4f2f90b3831a2($value='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $this->polls as $oValue )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                                <label>
                                 <input type="checkbox" value="{$oValue->getId()}" onclick="CheckThisVote(this.value)">
                                 {$oValue->getTitle()}
                                 </label>
                            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2f90b383260()
{
global $bw,$vsLang,$vsMenu,$vsStd;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $vsMenu->getCategoryGroup('polls')->getChildren() as $value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';$this->polls = $this->po->getListWithCat($value);
    $BWHTML .= <<<EOF
        
<p id="vote" value='{$value->getId()}'>{$value->getTitle()}</p>

                        <form>
                        
EOF;
if(count($this->polls)) {
$BWHTML .= <<<EOF

                                {$this->__foreach_loop__id_4f2f90b3831a2($value)}
                            
                            <input href="#" id="subvoite" type="button" class="binhluan_btn" value="{$vsLang->getWords('global_vote','Bình luận')}">
                            
                            
<a href="#" class="binhluan_btn" onclick="vsf.get('polls/view/'+$('#vote').attr('value'),'sa');">
{$vsLang->getWords('global_result','Kết quả')}
</a>
</div class='clear'>
                            
EOF;
}

$BWHTML .= <<<EOF

                            </form>
                       
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:portlet_dropdown_weblink:desc::trigger:>
//===========================================================================
function portlet_dropdown_weblink($option=array()) {global $bw,$vsLang,$vsMenu,$vsStd,$vsPrint;
$vsPrint->addJavaScriptString ( 'global_weblink', '
       $("#link").change(function(){
                               if($("#link").val())
                                    window.open($("#link").val(),"_blank");
                            });
    ' );

//--starthtml--//
$BWHTML .= <<<EOF
        <form class="weblink">
                <label></label>
                    <select class="styled" id="link">
                    <option value="0">{$vsLang->getWordsGlobal('global_lienket','Liên kết')}</option>
                        {$this->__foreach_loop__id_4f2f90b383651($option)}       
                    </select>
                
            </form>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2f90b383651($option=array())
{
global $bw,$vsLang,$vsMenu,$vsStd,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $wl )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                            <option value="{$wl->getWebsite()}"> {$wl->getTitle()}</option>
                            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:portlet_sitebar:desc::trigger:>
//===========================================================================
function portlet_sitebar($option=array()) {global $bw,$vsLang,$vsMenu,$vsStd,$vsPrint,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="sitebar">
        <ul class="menu_sub">
             {$vsTemplate->global_template->menu_sub[$bw->input['module']]}     
            </ul>
            
EOF;
if($vsTemplate->global_template->adv['partners']) {
$BWHTML .= <<<EOF

            <div class="slide_adverting">
                 <ul>
                     {$this->__foreach_loop__id_4f2f90b3838bc($option)}
                 </ul>                
             </div>
             
EOF;
}

$BWHTML .= <<<EOF

     <!-- STOP SLIDE -->
             
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2f90b3838bc($option=array())
{
global $bw,$vsLang,$vsMenu,$vsStd,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $vsTemplate->global_template->adv['partners'] as $partn )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
            
                         <li>
                             <a href="{$partn->getWebsite()}" target="_blank" title="{$partn->getTitle()}">
                             {$partn->createImageCache($partn->file,228,102,1)}
                             </a>
                         </li>
                     
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>