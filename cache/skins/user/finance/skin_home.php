<?php
if(!class_exists('skin_products'))
require_once ('./cache/skins/user/finance/skin_products.php');
class skin_home extends skin_products {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;
$vsPrint->addCSSFile("classic-accordion");
$vsPrint->addCSSFile('fix');

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option['cate']) {
$BWHTML .= <<<EOF

<style>
{$this->__foreach_loop__id_5015e8d750d02($option)}
</style>
<script>
$(document).ready(function(){
$(function() {
                $("#accordion > li").hover(
                    function () {
$("#accordion li").each(function(){
var img = $(this);
img.stop().animate({"width":"61px"},500);
});
                        var img = $(this);
                        img.stop().animate({"width":"777px"},500);
                        $(".bgDescription",img).stop(true,true).slideDown(500);
                        $(".description",img).stop(true,true).delay(1000).fadeIn();
                    },
                    function () {
                        var img = $(this);
$("#accordion li").each(function(){
var img = $(this);
img.stop().animate({"width":"240px"},500);
});
                        $(".description",img).stop(true,true).fadeOut(500);
                        $(".bgDescription",img).stop(true,true).slideUp(700);
                    }
                );
});

});
</script>
<div class="slide_home">
      <ul class="accordion" id="accordion">
      {$this->__foreach_loop__id_5015e8d750fc6($option)}
           </ul>
</div>

EOF;
}

$BWHTML .= <<<EOF

<style>
#banner_top{
margin-bottom: 0px;
}
.slide_home{
margin-top: 30px;
}
</style>
<!-- STOP SLIDE -->
{$vsTemplate->global_template->portlet_promotion}
<script>
$(document).ready(function(){
$(function() {
$('.product_home_item').hover(function(){
$(this).find('.product_text').fadeIn('700');
},function(){
$(this).find('.product_text').fadeOut('700');
});
});
});
$(document).ready(function(){
$('a.tab').click(function(){
                $('.active').removeClass('active');
                $(this).addClass('active');
                $('.product_home').slideUp();
                var content_show = $(this).attr('title');
                $('#'+ content_show).slideDown();
            });
});
</script>
<div id="content_home">
<h3 class="main_title1">
            <ul class="tabs">
           <li><a  class="active tab" title="product_home1">{$vsLang->getWordsGlobal("global_products_new","sản phẩm mới")}</a></li>
              <li><a  class="tab" title="product_home2">{$vsLang->getWordsGlobal("global_products_hot","sản phẩm bán chạy")}</a></li>
              <div class="clear"></div>
       </ul>
        </h3>
    
    <div class="product_home" id="product_home1">
    
EOF;
if($option['pro_new']) {
$BWHTML .= <<<EOF

        {$this->loadProduct($option['pro_new'])}
            
            
            <a href="{$bw->base_url}products/filter/new/{$option['strId_new']}" class="view_all">{$vsLang->getWordsGlobal("global_viewmore","Xem thêm")}</a>
        <div class="clear_right"></div>
        
EOF;
}

$BWHTML .= <<<EOF

        </div>
        
        <div class="product_home" id="product_home2">
        
EOF;
if($option['banchay']) {
$BWHTML .= <<<EOF

            {$this->loadProduct($option['banchay'])}
            
            <a href="{$bw->base_url}products/filter/hot/{$option['strId_hot']}" class="view_all">{$vsLang->getWordsGlobal("global_viewmore","Xem thêm")}</a>
        <div class="clear_right"></div>
        
EOF;
}

$BWHTML .= <<<EOF

        
        </div>
    </div>
    
    <!-- STOP CONTENT HOME -->
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d750d02($option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['cate'] as $lv1 )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
ul.accordion li.bg{$vsf_count}{
    background:url({$lv1->getCacheImagePathByFile($lv1->getFileId(),777,350)}) no-repeat;
}

EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d750f06($option="",$lv1='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $lv1->getChildren() as $lv2 )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <a href="{$lv2->getUrlCategory()}" title="{$lv2->getTitle()}">
                                <span>{$lv2->getTitle()}</span>
                            </a>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d750fc6($option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['cate'] as $lv1 )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            <li class="bg{$vsf_count}">
                <div class="heading"></div>
                <div class="description">
                        {$this->__foreach_loop__id_5015e8d750f06($option,$lv1)}
                 <div class="clear_left"></div>
                 </div>
        </li>
          
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDefault_cu_18_6:desc::trigger:>
//===========================================================================
function showDefault_cu_18_6($option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;
$vsPrint->addCSSFile("classic-accordion");

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option['cate']) {
$BWHTML .= <<<EOF

<style>
{$this->__foreach_loop__id_5015e8d75156c($option)}
</style>
<script>
$(document).ready(function(){
$(function() {
                $("#accordion > li").hover(
                    function () {
$("#accordion li").each(function(){
var img = $(this);
img.stop().animate({"width":"61px"},500);
});
                        var img = $(this);
                        img.stop().animate({"width":"777px"},500);
                        $(".bgDescription",img).stop(true,true).slideDown(500);
                        $(".description",img).stop(true,true).delay(1000).fadeIn();
                    },
                    function () {
                        var img = $(this);
$("#accordion li").each(function(){
var img = $(this);
img.stop().animate({"width":"240px"},500);
});
                        $(".description",img).stop(true,true).fadeOut(500);
                        $(".bgDescription",img).stop(true,true).slideUp(700);
                    }
                );
});
});
</script>
<div class="slide_home">
      <ul class="accordion" id="accordion">
      {$this->__foreach_loop__id_5015e8d75185f($option)}
           </ul>
</div>

EOF;
}

$BWHTML .= <<<EOF

<style>
#banner_top{
margin-bottom: 0px;
}
.slide_home{
margin-top: 30px;
}
</style>
<!-- STOP SLIDE -->
{$vsTemplate->global_template->portlet_promotion}

EOF;
if($option['product']) {
$BWHTML .= <<<EOF

<script>
$(document).ready(function(){
$(function() {
$('.product_home_item').hover(function(){
$(this).find('.product_text').fadeIn('700');
},function(){
$(this).find('.product_text').fadeOut('700');
});

});
});
</script>
<div id="content_home">
    <h3 class="main_title">{$vsLang->getWordsGlobal("global_products","sản phẩm")}</h3>
        <div class="product_home">
        {$this->loadProduct($option['product'])}
        </div>
        <a href="{$bw->base_url}products" class="view_all">{$vsLang->getWordsGlobal("global_viewmore","Xem thêm")}</a>
        <div class="clear_right"></div>
    </div>
    
EOF;
}

$BWHTML .= <<<EOF

    <!-- STOP CONTENT HOME -->
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d75156c($option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['cate'] as $lv1 )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
ul.accordion li.bg{$vsf_count}{
    background:url({$lv1->getCacheImagePathByFile($lv1->getFileId(),777,350)}) no-repeat;
}

EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d751797($option="",$lv1='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $lv1->getChildren() as $lv2 )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <a href="{$lv2->getUrlCategory()}" title="{$lv2->getTitle()}">
                                <span>{$lv2->getTitle()}</span>
                            </a>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d75185f($option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['cate'] as $lv1 )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            <li class="bg{$vsf_count}">
                <div class="heading"></div>
                <div class="description">
                        {$this->__foreach_loop__id_5015e8d751797($option,$lv1)}
                 <div class="clear_left"></div>
                 </div>
        </li>
          
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDefault_cu_cu:desc::trigger:>
//===========================================================================
function showDefault_cu_cu($option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;
$vsPrint->addCSSFile("classic-accordion");

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($option['cate']) {
$BWHTML .= <<<EOF

<style>
{$this->__foreach_loop__id_5015e8d751d49($option)}
</style>
<script>
$(document).ready(function(){
$(function() {
                $("#accordion > li").hover(
                    function () {
$("#accordion li").each(function(){
var img = $(this);
img.stop().animate({"width":"61px"},500);
});
                        var img = $(this);
                        img.stop().animate({"width":"777px"},500);
                        $(".bgDescription",img).stop(true,true).slideDown(500);
                        $(".description",img).stop(true,true).delay(1000).fadeIn();
                    },
                    function () {
                        var img = $(this);
$("#accordion li").each(function(){
var img = $(this);
img.stop().animate({"width":"240px"},500);
});
                        $(".description",img).stop(true,true).fadeOut(500);
                        $(".bgDescription",img).stop(true,true).slideUp(700);
                    }
                );
});
});
</script>
<div class="slide_home">
      <ul class="accordion" id="accordion">
      {$this->__foreach_loop__id_5015e8d752000($option)}
           </ul>
</div>

EOF;
}

$BWHTML .= <<<EOF

<style>
#banner_top{
margin-bottom: 0px;
}
.slide_home{
margin-top: 30px;
}
</style>
<!-- STOP SLIDE -->
{$vsTemplate->global_template->portlet_promotion}

EOF;
if($option['product']) {
$BWHTML .= <<<EOF

<script>
$(document).ready(function(){
$(function() {
$('.product_home_item').hover(function(){
$(this).find('.product_text').slideDown('3000');
},function(){
$(this).find('.product_text').fadeOut('900000');
});

});
});
</script>
<div id="content_home">
    <h3 class="main_title">{$vsLang->getWordsGlobal("global_products","sản phẩm")}</h3>
        <div class="product_home">
        {$this->loadProduct($option['product'])}
        </div>
        <a href="{$bw->base_url}products" class="view_all">{$vsLang->getWordsGlobal("global_viewmore","Xem thêm")}</a>
        <div class="clear_right"></div>
    </div>
    
EOF;
}

$BWHTML .= <<<EOF

    <!-- STOP CONTENT HOME -->
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d751d49($option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['cate'] as $lv1 )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
ul.accordion li.bg{$vsf_count}{
    background:url({$lv1->getCacheImagePathByFile($lv1->getFileId(),777,350)}) no-repeat;
}

EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d751f3f($option="",$lv1='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $lv1->getChildren() as $lv2 )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <a href="{$lv2->getUrlCategory()}" title="{$lv2->getTitle()}">
                            {$lv2->createImageCache($lv2->getFileId(),100,60,2)}
                                <span>{$lv2->getTitle()}</span>
                            </a>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d752000($option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['cate'] as $lv1 )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            <li class="bg{$vsf_count}">
                <div class="heading"></div>
                <div class="description">
                        {$this->__foreach_loop__id_5015e8d751f3f($option,$lv1)}
                 <div class="clear_left"></div>
                 </div>
        </li>
          
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>