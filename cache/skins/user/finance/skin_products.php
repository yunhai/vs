<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_products extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;


//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">

EOF;
if($option['title']) {
$BWHTML .= <<<EOF

<h3 class="main_title">{$option['title']}</h3>

EOF;
}

else {
$BWHTML .= <<<EOF

    <h3 class="main_title">{$vsTemplate->global_template->navigator}</h3>
    
EOF;
}
$BWHTML .= <<<EOF

    
EOF;
if($option['pageList']) {
$BWHTML .= <<<EOF

    <script>
$(document).ready(function(){
$(function() {
$(".product_home_item").hover(function(){
$(this).find(".product_text").fadeIn(700);
  }, function (){
$(this).find(".product_text").fadeOut(700);
  });
});
});
</script>
        <div class="product">
        {$this->loadProduct($option['pageList'])}
        
EOF;
}

else {
$BWHTML .= <<<EOF

        <p class="nodata">{$vsLang->getWordsGlobal('global_nodata','Dữ liệu đang được chúng tôi cập nhật')}</p>
    
EOF;
}
$BWHTML .= <<<EOF

        </div>
        
EOF;
if($option['paging']) {
$BWHTML .= <<<EOF

     <div class="page">
        {$option['paging']}
        </div>
     
EOF;
}

$BWHTML .= <<<EOF

        <div class="clear_right"></div>
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;

$vsPrint->addCurentJavaScriptFile("highslide/highslide-full");
if ($option['gallery']){
$vsPrint->addCurentJavaScriptFile("jquery.galleriffic");
$vsPrint->addCurentJavaScriptFile("jquery.opacityrollover");
}
$vsPrint->addCSSFile('galleriffic-2');

//--starthtml--//
$BWHTML .= <<<EOF
        <style>
.color_thumb{
border: 1px solid #fff;
width:26px;
height:14px;
position:relative;
float:left;
margin-right:3px;
}
.view{
border: 1px solid #ccc;
background:#fff;
position:absolute;
top:-145px;
display:none;
}
.view p{
font-weight:bold;
border-top: 1px solid #ccc;
line-height:22px;
padding-left:10px;
}
.list_color_product{margin-top:10px;}
.color_thumb_img:hover{
border: 1px solid #999;
padding:1px;
background:#fff;
width:22px;
height:10px;
cursor:pointer;
}
</style>
<div id="content">
    <h3 class="main_title">{$vsTemplate->global_template->navigator}</h3>
    
EOF;
if($option['gallery']) {
$BWHTML .= <<<EOF

<div class="product_slide">
       <div id="gallery" class="content gallery-content">
            <div class="slideshow-container">
                <div id="loading" class="loader"></div>
                  <div id="slideshow" class="slideshow"></div>
              </div>
          </div>
                        
  <div id="thumbs" class="navigation">
            <ul class="thumbs noscript">
            {$this->__foreach_loop__id_5015e8d75512f($obj,$option)}
                <div class="clear_left"></div>
            </ul>
          </div>
        <div id="controls" class="controls"></div>
     </div>
      
EOF;
}

else {
$BWHTML .= <<<EOF

       <div class="product_slide" style="height:auto;">
            {$obj->showImagePopup($obj->file,407,279,"pro_detail_img",4)}
          </div>
      
EOF;
}
$BWHTML .= <<<EOF

      <script>
$(document).ready(function(){
$('.navigation').find("img").addClass('pandog');
});
</script>
      <!-- STOP PRODUCT SLIDE -->
            
      <div class="product_detail">
            <h3>{$obj->getTitle()}</h3>
            
EOF;
if($option['brand']) {
$BWHTML .= <<<EOF

            <p style="font-weight:bold;">{$vsLang->getWords("products_brands","Thương hiệu")}: <span style="font-weight:normal;">{$option['brand']->getTitle()}</span></p>
          
EOF;
}

$BWHTML .= <<<EOF

            
EOF;
if($obj->getPrice()) {
$BWHTML .= <<<EOF
<p class="cost">{$vsLang->getWords("global_price","Giá")}: <span>{$obj->getPrice()} {$vsLang->getWords("global_unit","VND")}</span></p>
EOF;
}

$BWHTML .= <<<EOF

          <a href="{$bw->base_url}orders/addtocart/{$obj->getId()}" class="dathang_btn">{$vsLang->getWords("global_order","Đặt hàng")}</a>
          
EOF;
if($obj->getColor()) {
$BWHTML .= <<<EOF

                <div class="list_color_product">
                <p style="font-weight:bold;margin-bottom:10px">{$vsLang->getWords('p_mausanco','Các màu sẵn có')}:</p>
                  {$this->__foreach_loop__id_5015e8d755330($obj,$option)}
                  <div class="clear_left"></div>
                  <script type="text/javascript">
 $('.color_thumb_img').hover(function() {
$(this).next().css({display: "block"});
},function(){
 $(this).next().css({display: "none"});
 });
</script> 
</div>                                
          
EOF;
}

$BWHTML .= <<<EOF

          
     <p>{$obj->getContent()}</p>
     </div>
    <!-- STOP PRODUCT DETAIL-->
    <div class="clear"></div>
    
    
    
EOF;
if($option['other']) {
$BWHTML .= <<<EOF

    <script>
$(document).ready(function(){
$(function() {
$(".product_home_item").hover(function(){
$(this).find(".product_text").fadeIn(700);
  }, function (){
$(this).find(".product_text").fadeOut(700);
  });
});
});
</script>
<div class="other">
<a href="{$bw->base_url}products" class="view_all1">{$vsLang->getWordsGlobal("global_viewall","Xem tất cả")}</a>
<h3 class="main_title">{$vsLang->getWords($bw->input['module'].'_other','sản phẩm cùng loại')}</h3>
        <div class="product">
        {$this->loadProduct($option['other'])}
        </div>
       </div>
        <div class="clear_right"></div>

EOF;
}

$BWHTML .= <<<EOF

    </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d75512f($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach(  $option['gallery'] as $image  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li>
                    <a class="thumb" name="leaf" href="{$image->getResizeImagePath($image->getPathView(),407,279,1)}" title="{$image->getTitle()}">
                    {$image->createImageCache($image,80,57,2)}
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
function __foreach_loop__id_5015e8d755330($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $obj->getListColor() as $index => $color )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                  <div class="color_thumb">
                   <img src="{$color->file->getCacheImagePathByFile($color->file,26,14,0)}" title="{$color->getTitle()}" class="color_thumb_img" id="{$index}" rel='{$color->file->getCacheImagePathByFile($color->file,182,98,0)}'>
                   <div id="colorpreview{$index}" class="view">
                   {$color->createImageCache($color->file,208,112)}
                   <p>{$color->getTitle()}</p>
                 </div>
                   </div>
                  
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetail_listcolor:desc::trigger:>
//===========================================================================
function showDetail_listcolor($obj="",$option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;
// ds mau -> click mau -> thay toan bo slide
$vsPrint->addCurentJavaScriptFile("highslide/highslide-full");
if ($option['gallery']){
$vsPrint->addCurentJavaScriptFile("jquery.galleriffic");
$vsPrint->addCurentJavaScriptFile("jquery.opacityrollover");
}
$vsPrint->addCSSFile('galleriffic-2');

//--starthtml--//
$BWHTML .= <<<EOF
        <style>
.active_color{
border: 1px solid #ccc;
padding:1px;
float:left;
}
</style>
<div id="content">
    <h3 class="main_title">{$vsTemplate->global_template->navigator}</h3>
    
EOF;
if($option['gallery']) {
$BWHTML .= <<<EOF

<div class="product_slide">
       <div id="gallery" class="content gallery-content">
            <div class="slideshow-container">
                <div id="loading" class="loader"></div>
                  <div id="slideshow" class="slideshow"></div>
              </div>
          </div>
                        
  <div id="thumbs" class="navigation">
            <ul class="thumbs noscript">
            {$this->__foreach_loop__id_5015e8d755de6($obj,$option)}
                <div class="clear_left"></div>
            </ul>
          </div>
        <div id="controls" class="controls"></div>
     </div>
      
EOF;
}

else {
$BWHTML .= <<<EOF

       <div class="product_slide" style="height:auto;">
            {$obj->showImagePopup($obj->file,407,279,"pro_detail_img",4)}
          </div>
      
EOF;
}
$BWHTML .= <<<EOF

      <script>
$(document).ready(function(){
$('.navigation').find("img").addClass('pandog');
});
</script>
      <!-- STOP PRODUCT SLIDE -->
            
      <div class="product_detail">
            <h3>{$obj->getTitle()}</h3>
            <div class="list_color_product">
            
EOF;
if($obj->getColor()) {
$BWHTML .= <<<EOF

                <p>{$vsLang->getWords('p_mausanco','Các màu sẵn có')}:</p>
                  {$this->__foreach_loop__id_5015e8d7560c7($obj,$option)}
                  <div class="clear_left"></div>                                 
             
EOF;
}

$BWHTML .= <<<EOF

          </div>
          
EOF;
if($obj->getPrice()) {
$BWHTML .= <<<EOF
<p class="cost">{$vsLang->getWords("global_price","Giá")}: <span>{$obj->getPrice()} {$vsLang->getWords("global_unit","VND")}</span></p>
EOF;
}

$BWHTML .= <<<EOF

          <a href="{$bw->base_url}orders/addtocart/{$obj->getId()}" class="dathang_btn">{$vsLang->getWords("global_order","Đặt hàng")}</a>
     <p>{$obj->getContent()}</p>
     
     </div>
    <!-- STOP PRODUCT DETAIL-->
    <div class="clear"></div>
    
    
    
EOF;
if($option['other']) {
$BWHTML .= <<<EOF

    <script>
$(document).ready(function(){
$(function() {
$(".product_home_item").hover(function(){
$(this).find(".product_text").fadeIn(700);
  }, function (){
$(this).find(".product_text").fadeOut(700);
  });
});
});
</script>
<div class="other">
<a href="{$bw->base_url}products" class="view_all1">{$vsLang->getWordsGlobal("global_viewall","Xem tất cả")}</a>
<h3 class="main_title">{$vsLang->getWords($bw->input['module'].'_other','sản phẩm cùng loại')}</h3>
        <div class="product">
        {$this->loadProduct($option['other'])}
        </div>
       </div>
        <div class="clear_right"></div>

EOF;
}

$BWHTML .= <<<EOF

    </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d755de6($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach(  $option['gallery'] as $image  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li>
                    <a class="thumb" name="leaf" href="{$image->getResizeImagePath($image->getPathView(),407,279,1)}" title="{$image->getTitle()}">
                    {$image->createImageCache($image,80,57,2)}
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
function __foreach_loop__id_5015e8d7560c7($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $obj->getListColorFile() as $index => $file )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                   <a href="{$obj->getUrl($bw->input['module'])}
EOF;
if($index!=$option['current']->getId()) {
$BWHTML .= <<<EOF
?color={$index}
EOF;
}

$BWHTML .= <<<EOF
" 
EOF;
if($index==$bw->input['color']) {
$BWHTML .= <<<EOF
class="active_color"
EOF;
}

$BWHTML .= <<<EOF
>
                   <img fileid="{$index}" src="{$file->getCacheImagePathByFile($file,12,11,0)}" title="{$file->getTitle()}" >
                   </a>
                  
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:loadProduct:desc::trigger:>
//===========================================================================
function loadProduct($option="") {global $bw,$vsLang, $vsPrint;

//--starthtml--//
$BWHTML .= <<<EOF
        {$this->__foreach_loop__id_5015e8d75696c($option)}
        <div class="clear_left"></div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d75696c($option="")
{
global $bw,$vsLang, $vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <div class="product_home_item">
            {$obj->createImageCache($obj->file, 210,140, 0, 1)}
            <div class="product_text">
                <div class="product_text_intro">
                <h3><a href="{$obj->getUrl('products')}" title="{$obj->getTitle()}">{$obj->getTitle()}</a></h3>
                    <p>{$obj->getIntro(100)}</p>
                    </div>
                    <a href="{$obj->getUrl('products')}" title="{$obj->getTitle()}" class="dathang_btn">{$vsLang->getWordsGlobal("global_detail","Chi tiết")}</a>
                    <div class="clear_left"></div>
                </div>
            </div>
     
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>