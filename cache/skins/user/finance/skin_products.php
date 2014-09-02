<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_products extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw,$vsPrint;
$this->bw = $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content_mid">
<div class="content_mid_title">{$vsPrint->mainTitle}</div>
{$this->__foreach_loop__id_540593eeaba01($option)}
<div class="clear"></div>
<div class="page"> {$option['paging']}</div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_540593eeaba01($option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['pageList'])){
    foreach( $option['pageList'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class="pro_item">
<div class="im"><a href="{$obj->getUrl('products')}">{$obj->createImageCache($obj->getImage(),210,210)}</a></div>
<div class="na">
<a href="{$obj->getUrl('products')}">{$obj->getTitle()}</a>
</div>

EOF;
if($obj->getPromotionPrice()) {
$BWHTML .= <<<EOF

<div class="price promo">
<div class="price_old">{$this->numberFormat($obj->getPrice())} VNÐ</div>
<div class="price_promo">{$this->numberFormat($obj->getPromotionPrice())} VNÐ</div>
</div>

EOF;
}

else {
$BWHTML .= <<<EOF

<div class="price">
EOF;
if($obj->getPrice()) {
$BWHTML .= <<<EOF
{$this->numberFormat($obj->getPrice())} VNÐ
EOF;
}

else {
$BWHTML .= <<<EOF
Call
EOF;
}
$BWHTML .= <<<EOF
</div>

EOF;
}
$BWHTML .= <<<EOF

<a class="order" onclick="addCart({$obj->getId()})"></a>

EOF;
if($obj->getPromotionPrice()) {
$BWHTML .= <<<EOF

<div class="sale"></div>

EOF;
}

$BWHTML .= <<<EOF

</div>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option=array()) {global $bw, $vsPrint;
$this->bw = $bw;
 $this->catTitle=$option['cate_obj']->getTitle();
 $this->bw=$bw;
 $this->urlCate="{$this->bw->base_url}products/category/{$option['cate_obj']->getSlugId()}";


//--starthtml--//
$BWHTML .= <<<EOF
        <script>
 $(function() {
      if(window.hs!=null)
{
hs.graphicsDir = boardUrl+"/skins/user/finance/javascripts/highslide/graphics/";
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.outlineType = 'glossy-dark';
hs.fadeInOut = true;
hs.dimmingOpacity = 0.75;
// Add the controlbar
if (hs.addSlideshow) hs.addSlideshow({
                        //slideshowGroup: 'group1',
                        interval: 5000,
                        repeat: false,
                        useControls: true,
                        fixedControls: false,
                        overlayOptions: {
                        opacity: 1,
                        position: 'bottom center',
                        hideOnMouseOut: true
                        }
                });
}
             });
</script>
<div class="content_mid">
<div class="content_mid_title">{$this->catTitle}</div>
<div class="pro_detail">
<div class="im">
{$obj->createImageCache($obj->getImage(),210,210)}
<a onclick="return hs.expand(this)"  class="zoom highslide"  href="{$obj->getCacheImagePathByFile($obj->getImage(),1,1,1,1)}" class="zoom"></a>
<div class="sale"></div>
</div>
<div class="detail_right">
<div class="na">{$obj->getTitle()}</div>
<div class="intro">{$this->cut($obj->getIntro(),150)}</div>
<div class="code"><span class="tit">Mã SP</span>:{$obj->getCode()}</div>
<div class="status"><span class="tit">Trình trạng</span>:
EOF;
if($obj->getState()>0 ) {
$BWHTML .= <<<EOF
Còn hàng 
EOF;
}

else {
$BWHTML .= <<<EOF
Hết hàng
EOF;
}
$BWHTML .= <<<EOF
</div>
<div class="view"><span class="tit">Lượt xem</span>:{$obj->getHot()}</div>

EOF;
if($obj->getPromotionPrice()) {
$BWHTML .= <<<EOF

<div class="price"><span class="tit">Giá</span>:<span class="old">{$this->numberFormat($obj->getPrice())}</span>{$this->numberFormat($obj->getPromotionPrice())} VNÐ</div>

EOF;
}

else {
$BWHTML .= <<<EOF

<div class="price"><span class="tit">Giá</span>:
EOF;
if($obj->getPrice()) {
$BWHTML .= <<<EOF
{$this->numberFormat($obj->getPrice())} VNÐ
EOF;
}

else {
$BWHTML .= <<<EOF
Call
EOF;
}
$BWHTML .= <<<EOF
</div>

EOF;
}
$BWHTML .= <<<EOF

<a onclick="addCart({$obj->getId()})"  class="order_button"></a>
</div>
</div>
<div class="other">Sản phẩm khác</div>
{$this->__foreach_loop__id_540593eeabe45($obj,$option)}
<div class="clear"></div>
</div>
<script>
var urlcate= '{$this->urlCate}';

</script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_540593eeabe45($obj="",$option=array())
{
global $bw, $vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['other'])){
    foreach( $option['other'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class="pro_item">
<div class="im"><a href="{$obj->getUrl('products')}">{$obj->createImageCache($obj->getImage(),210,210)}</a></div>
<div class="na">
<a href="{$obj->getUrl('products')}">{$obj->getTitle()}</a>
</div>

EOF;
if($obj->getPromotionPrice()) {
$BWHTML .= <<<EOF

<div class="price promo">
<div class="price_old">{$obj->getPrice()} VNÐ</div>
<div class="price_promo">{$obj->getPromotionPrice()} VNÐ</div>
</div>

EOF;
}

else {
$BWHTML .= <<<EOF

<div class="price">
EOF;
if($obj->getPrice()) {
$BWHTML .= <<<EOF
{$this->numberFormat($obj->getPrice())} VNÐ
EOF;
}

else {
$BWHTML .= <<<EOF
Call
EOF;
}
$BWHTML .= <<<EOF
</div>

EOF;
}
$BWHTML .= <<<EOF

<a class="order" href=""></a>

EOF;
if($obj->getPromotionPrice()) {
$BWHTML .= <<<EOF

<div class="sale"></div>

EOF;
}

$BWHTML .= <<<EOF

</div>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showSearch:desc::trigger:>
//===========================================================================
function showSearch($option=array()) {global $bw,$vsPrint;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}


}
?>