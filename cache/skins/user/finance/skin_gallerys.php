<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_gallerys extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;
//$vsPrint->addCurentJavaScriptFile("jmorph");
//$vsPrint->addCSSFile('jmorph');
$vsPrint->addCurentJavaScriptFile("jquery.bxSlider");
$vsPrint->addCSSFile('bx_styles');

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content_center">
    <h1 class="center_title">{$vsPrint->pageTitle}</h1>
   
EOF;
if($option['pageList']) {
$BWHTML .= <<<EOF

       <div class="duan_group">
       
       {$this->__foreach_loop__id_4f910139bc216($option)}
          
          <div class="clear_left"></div>
          
       </div>
       
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

    <!-- STOP DUAN GROUP -->
                 
</div>
   <script type="text/javascript">
    $(document).ready(function(){
    
$('.duan_img,.duan_title').click(function(){
var option = {
width: 889,
height:580
};
var id = $(this).attr('ref');
vsf.popupLightGet('{$bw->input['module']}/detail/'+id, 'chau123', option);
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
function __foreach_loop__id_4f910139bc216($option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['pageList'] as $image )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
           <div class="duan_item">
           <a ref='{$image->getId()}' title="{$image->getTitle()}" class="duan_img">{$image->createImageCache($image->file,296,200,2,1)}</a>
            <h3><a ref='{$image->getId()}' title="{$image->getTitle()}" class="duan_title">{$image->getTitle()}</a></h3>
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
//$vsPrint->addCurentJavaScriptFile("jmorph");
//$vsPrint->addCSSFile('jmorph');
$vsPrint->addCurentJavaScriptFile("jquery.bxSlider");
$vsPrint->addCSSFile('bx_styles');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="duan_chitiet">
<div class="header_popup">
    <p class="popup_logo"><img src="{$bw->vars['img_url']}/popup_logo.jpg" /></p>
        
        <a href="{$obj->getUrl($bw->input['module'])}&print=1" class="popup_print">In<img src="{$bw->vars['img_url']}/icon_print.jpg" /></a>
        <a href="{$obj->getUrl($bw->input['module'])}&save=1" class="popup_save">Lưu<img src="{$bw->vars['img_url']}/icon_save.jpg" /></a>
    </div>
    

EOF;
if($option['gallery']) {
$BWHTML .= <<<EOF

<div class="show">
<ul class="band" id="slider1">
{$this->__foreach_loop__id_4f910139bc437($obj,$option)}
</ul>
</div>

EOF;
}

$BWHTML .= <<<EOF
 
<div class="duan_intro">
    <h1>{$obj->getTitle()}</h1>
    <p>{$obj->getIntro()}</p>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
var slider1 = $('#slider1').bxSlider({
infiniteLoop: false,
hideControlOnEnd: true,
mode: 'fade',
auto: true,
autoControls: false,
pager: true
});
$('.popup_print').popupWindow({ 
height:660, 
width:889
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
function __foreach_loop__id_4f910139bc437($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach(  $option['gallery'] as $image  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            <li>{$image->createImageCache($image,818,413,2)}</li>
                
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetail1:desc::trigger:>
//===========================================================================
function showDetail1($obj="",$option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;
//$vsPrint->addCurentJavaScriptFile("jmorph");
//$vsPrint->addCSSFile('jmorph');
$vsPrint->addCurentJavaScriptFile("jquery.bxSlider");
$vsPrint->addCSSFile('bx_styles');

//--starthtml--//
$BWHTML .= <<<EOF
        <script type="text/javascript">
$(document).ready(function(){
var slider1 = $('#slider1').bxSlider({
infiniteLoop: false,
hideControlOnEnd: true,
mode: 'fade',
auto: true,
autoControls: false,
pager: true
});

});
</script>
<div class="duan_chitiet">
<div class="header_popup">
    <p class="popup_logo"><img src="{$bw->vars['img_url']}/popup_logo.jpg" /></p>
        <a onClick="window.print()" class="popup_print">In<img src="{$bw->vars['img_url']}/icon_print.jpg" /></a>
        <a href="{$obj->getUrl($bw->input['module'])}&save=1"  class="popup_save">Lưu<img src="{$bw->vars['img_url']}/icon_save.jpg" /></a>
    </div>
    
EOF;
if($option['gallery']) {
$BWHTML .= <<<EOF

<div class="show">
<ul class="band" id="slider1">
{$this->__foreach_loop__id_4f910139bc5f7($obj,$option)}
</ul>
</div>

EOF;
}

$BWHTML .= <<<EOF
 
<div class="duan_intro">
    <h1>{$obj->getTitle()}</h1>
    <p>{$obj->getIntro()}</p>
    </div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f910139bc5f7($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach(  $option['gallery'] as $image  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            <li>{$image->createImageCache($image,818,413,2)}</li>
 
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDefaultVideo:desc::trigger:>
//===========================================================================
function showDefaultVideo($option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;
$vsPrint->addCurentJavaScriptFile("thickbox-compressed");
    $vsPrint->addCSSFile('thickbox-compressed');  
    $vsPrint->addCurentJavaScriptFile( "jquery.pajinate");   

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content_center">
    <h1 class="center_title">{$vsPrint->pageTitle}</h1>
   
EOF;
if($option['gallery']) {
$BWHTML .= <<<EOF

   
       <div class="duan_group" id="paging_container5">
       <div class="content">
       {$this->__foreach_loop__id_4f910139bc7b5($option)}
          </div>
          <div class="clear_left"></div>
          
EOF;
if(count($option['gallery'])>6) {
$BWHTML .= <<<EOF

          <div class="page_navigation"></div>
          
EOF;
}

$BWHTML .= <<<EOF

       </div>
       
       
EOF;
}

else {
$BWHTML .= <<<EOF

    <p class="nodata">{$vsLang->getWordsGlobal('global_nodata','Dữ liệu đang được chúng tôi cập nhật')}</p>
  
EOF;
}
$BWHTML .= <<<EOF

  
    <!-- STOP DUAN GROUP -->         
</div>
   <script type="text/javascript" charset="utf-8">
$(document).ready(function(){
$('#paging_container5').pajinate({
nav_label_first : '<<',
nav_label_last : '>>',
nav_label_prev : '<',
nav_label_next : '>'
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
function __foreach_loop__id_4f910139bc7b5($option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['gallery'] as $image )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
           <div class="duan_item">
            <a href="#TB_inline?height=385&amp;width=509&amp;inlineId=myOnPageContent{$image->getId()}" title="" class="duan_img thickbox">{$image->createImageCache($image,296,200,2)}</a>
               <h3>{$image->getTitle()}</h3>
               <div id="myOnPageContent{$image->getId()}" style="display:none;">
                    {$image->show(480,350)}
                    <h3>{$image->getTitle()}</h3>
          </div>
          </div>
          
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetailVideo:desc::trigger:>
//===========================================================================
function showDetailVideo($obj="",$option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;
$vsPrint->addCurentJavaScriptFile("thickbox-compressed");
    $vsPrint->addCSSFile('thickbox-compressed');  
    $vsPrint->addCurentJavaScriptFile( "jquery.pajinate");   

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content_center">
    <h1 class="center_title">{$vsPrint->pageTitle}</h1>
   
EOF;
if($option['gallery']) {
$BWHTML .= <<<EOF

   
       <div class="duan_group" id="paging_container5">
       <div class="content">
       {$this->__foreach_loop__id_4f910139bc9e7($obj,$option)}
          </div>
          <div class="clear_left"></div>
          
EOF;
if(count($option['gallery'])>6) {
$BWHTML .= <<<EOF

          <div class="page_navigation"></div>
          
EOF;
}

$BWHTML .= <<<EOF

       </div>
       
       
EOF;
}

else {
$BWHTML .= <<<EOF

    <p class="nodata">{$vsLang->getWordsGlobal('global_nodata','Dữ liệu đang được chúng tôi cập nhật')}</p>
  
EOF;
}
$BWHTML .= <<<EOF

  
    <!-- STOP DUAN GROUP -->         
</div>
   <script type="text/javascript" charset="utf-8">
$(document).ready(function(){
$('#paging_container5').pajinate({
nav_label_first : '<<',
nav_label_last : '>>',
nav_label_prev : '<',
nav_label_next : '>'
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
function __foreach_loop__id_4f910139bc9e7($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['gallery'] as $image )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
           <div class="duan_item">
            <a href="#TB_inline?height=385&amp;width=509&amp;inlineId=myOnPageContent{$image->getId()}" title="" class="duan_img thickbox">{$image->createImageCache($image,296,200,2)}</a>
               <h3>{$image->getTitle()}</h3>
               <div id="myOnPageContent{$image->getId()}" style="display:none;">
                    {$image->show(480,350)}
                    <h3>{$image->getTitle()}</h3>
          </div>
          </div>
          
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>