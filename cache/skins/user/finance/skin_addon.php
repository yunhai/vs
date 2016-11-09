<?php
class skin_addon{

//===========================================================================
// <vsf:showMenuTopForUser:desc::trigger:>
//===========================================================================
function showMenuTopForUser($option=array()) {global $bw, $vsLang ,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        <ul class="menu_top">
{$this->__foreach_loop__id_5015e8d727e6a($option)}
   <div class="clear_left"></div>
     </ul>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d727e6a($option=array())
{
global $bw, $vsLang ,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<li class="{$obj->getClassActive()}">
<a 
EOF;
if($obj->getIsLink()) {
$BWHTML .= <<<EOF
href="{$obj->getUrl(0)}"
EOF;
}

$BWHTML .= <<<EOF
 class="{$obj->getClassActive()}" ><span>{$obj->getTitle()}</span>
</a>

EOF;
if(strpos($obj->getUrl(0),'products')) {
$BWHTML .= <<<EOF

<img src="{$bw->vars['img_url']}/new2.gif" class="news_icon"/>

EOF;
}

$BWHTML .= <<<EOF

   
EOF;
if($vsTemplate->global_template->menu_sub[$obj->getAlt()] || $obj->getChildren()) {
$BWHTML .= <<<EOF

   <ul>
          {$vsTemplate->global_template->menu_sub[$obj->getAlt()]}
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
// <vsf:showMenuBottomForUser:desc::trigger:>
//===========================================================================
function showMenuBottomForUser($option=array()) {global $bw, $vsLang ,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        <ul  class="menu_footer">
       {$this->__foreach_loop__id_5015e8d728382($option)}
        <div class="clear_left"></div>
     </ul>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d728382($option=array())
{
global $bw, $vsLang ,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <li><a href="{$obj->getUrl(0)}" class="{$obj->getClassActive()}" title="{$obj->getTitle()}"><span>{$obj->getTitle()}</span></a></li>
      
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showMenuLeft:desc::trigger:>
//===========================================================================
function showMenuLeft() {global $bw, $vsLang ,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($vsTemplate->global_template->menu_sub[$bw->input['module']]) {
$BWHTML .= <<<EOF

<h3 class="main_title">{$vsLang->getWordsGlobal("global_categories_".$bw->input['module'],"DANH MỤC SẢN PHẨM")}</h3>
            <ul id="menu" class="product_list">
            {$vsTemplate->global_template->menu_sub[$bw->input['module']]}
            </ul>
    
EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:portlet_supports:desc::trigger:>
//===========================================================================
function portlet_supports($option=array()) {global $bw, $vsLang;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option) {
$BWHTML .= <<<EOF

    <div class="support">
    <p>{$vsLang->getWordsGlobal("global_supports","Hỗ trợ trực tuyến")}:</p>
    {$this->__foreach_loop__id_5015e8d728845($option)}
       <div class="clear_left"></div>
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
function __foreach_loop__id_5015e8d728845($option=array())
{
global $bw, $vsLang;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach(  $option as $key =>$obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            {$obj->show()}
       
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:portlet_banner:desc::trigger:>
//===========================================================================
function portlet_banner($option="") {global $bw, $vsLang,$vsPrint,$vsTemplate;
        $vsPrint->addCurentJavaScriptFile("jquery.prettyPhoto"); 
 $vsPrint->addCurentJavaScriptFile("jquery.aviaSlider.min");
 $vsPrint->addCSSFile('style');

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option) {
$BWHTML .= <<<EOF

    <div class="banner">
            <ul class='aviaslider' id="frontpage-slider">
{$this->__foreach_loop__id_5015e8d728c2f($option)}
</ul>
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
function __foreach_loop__id_5015e8d728c2f($option="")
{
global $bw, $vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $slide )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li>{$slide->show(987,255)}</li>
               
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:portlet_weblink:desc::trigger:>
//===========================================================================
function portlet_weblink($option=array()) {global $bw,$vsLang,$vsMenu,$vsStd,$vsPrint;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="lienketweb">
                <h3>{$vsLang->getWordsGlobal("global_lienketweb","Liên kết website")}:</h3>
                    <div class="lienketweb_content">
                        {$this->__foreach_loop__id_5015e8d729001($option)}   
                    </div>
                    <div class="lienket_bottom"><img src="{$bw->vars['img_url']}/lienket_bottom.jpg" /></div>
                </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d729001($option=array())
{
global $bw,$vsLang,$vsMenu,$vsStd,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $wl )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <a href="{$wl->getWebsite()}" target="_blank">
                        
EOF;
if($wl->getImage()) {
$BWHTML .= <<<EOF

                        {$wl->createImageCache($wl->getImage(),200,35,4)}
                        
EOF;
}

else {
$BWHTML .= <<<EOF

{$wl->getWebsite()}

EOF;
}
$BWHTML .= <<<EOF

</a>
                        
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
              
                    <select class="styled" id="link">
                    <option value="0">---{$vsLang->getWordsGlobal("global_lienketweb","Liên kết website")}---</option>
                        {$this->__foreach_loop__id_5015e8d72940d($option)}       
                    </select>
                    
            </form>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d72940d($option=array())
{
global $bw,$vsLang,$vsMenu,$vsStd,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $wl )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                            <option value="{$wl->getWebsite()}" > {$wl->getTitle()}</option>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:portlet_partner:desc::trigger:>
//===========================================================================
function portlet_partner($option="") {global $bw, $vsLang,$vsPrint;
//$vsPrint->addCurentJavaScriptFile("jcarousellite"); 
//        $vsPrint->addCSSFile('jcarousellite');
       

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option) {
$BWHTML .= <<<EOF

<h3 class="main_title">{$vsLang->getWordsGlobal('global_partners','Đối tác')}</h3>
<div class="slide_partner">
       {$this->__foreach_loop__id_5015e8d729709($option)}
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
function __foreach_loop__id_5015e8d729709($option="")
{
global $bw, $vsLang,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <a href="{$obj->getWebsite()}" title="{$obj->getTitle()}" target="_blank">{$obj->createImageCache($obj->file,220,63)}</a>
            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:portlet_search:desc::trigger:>
//===========================================================================
function portlet_search($option="") {global $bw, $vsLang,$vsPrint;
$stringSearch = $vsLang->getWords('search_key','Từ khóa tìm kiếm...');

//--starthtml--//
$BWHTML .= <<<EOF
        <form class="search_top" name='form_search' id='form_search' method='POST' action='{$bw->base_url}searchs/'>
            <input id="keySearch" name="keySearch" type="text" onfocus="if(this.value=='{$stringSearch}') this.value='';" onblur="if(this.value=='') this.value='{$stringSearch}';" value="{$stringSearch}" class="input_text" />   
        <input type="button" value="{$vsLang->getWordsGlobal("global_search","Search")}" class="search_btn" id='submit_form_search'/>
        <div class="clear_left"></div>
       </form>
        <script language="javascript" type="text/javascript">
$(document).ready(function(){
$("#keySearch").keydown(function(e){
        if(e.keyCode==13)
          var str =  $('#keySearch').val();
    if(str=="" || str =="{$stringSearch}")return false;
  })
    $('#submit_form_search').click(function()  {
        if($('#keySearch').val()==""||$('#keySearch').val()=="{$stringSearch}") {
           jAlert('{$vsLang->getWords('global_tim_thongtin','Vui lòng nhập thông tin cần search:please!!!!!')}',
                        '{$bw->vars['global_websitename']} Dialog');
               return false;
          }
          str =  $('#keySearch').val()+"/";
           document.location.href="{$bw->base_url}searchs/"+ str;
           return;
    });
                
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:portlet_promotion:desc::trigger:>
//===========================================================================
function portlet_promotion($option="") {global $bw, $vsLang,$vsPrint;
       $vsPrint->addCurentJavaScriptFile("jquery.innerfade"); 

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option) {
$BWHTML .= <<<EOF

    <script>
$(document).ready(function(){
$('#banner_top').innerfade({
animationtype: 'fade',
speed:1000,
timeout:3000,
type: 'random',
containerheight: '147px'
});
});
</script>
      <div id="banner_top">
            {$this->__foreach_loop__id_5015e8d729c33($option)} 
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
function __foreach_loop__id_5015e8d729c33($option="")
{
global $bw, $vsLang,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $slide )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            
EOF;
if($slide->file) {
$BWHTML .= <<<EOF

            <a href="{$slide->getUrl('promotions')}" >{$slide->createImageCache($slide->file,961,147)}</a>
            
EOF;
}

$BWHTML .= <<<EOF

            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>