<?php
if(!class_exists('skin_board_public'))
require_once ('./cache/skins/user/finance/skin_board_public.php');
class skin_objectpublic extends skin_board_public {

//===========================================================================
// <vsf:itemProduct:desc::trigger:>
//===========================================================================
function itemProduct($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        {$this->__foreach_loop__id_540c42c3eb245($option)}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_540c42c3eb245($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option)){
    foreach( $option as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class="product-item" 
EOF;
if($vsf_count%3==0) {
$BWHTML .= <<<EOF
style="margin-right:0px;"
EOF;
}

$BWHTML .= <<<EOF
 >
 <div class="product-item-br">
<div class="product-thumbnail">
<a href="{$value->getUrl('products')}">{$value->createImageCache($value->getImage(),170,170)}</a>
</div>
<h3 class="H3title"><a href="{$value->getUrl('products')}">{$this->cut($value->getTitle(), 25)}</a></h3>
<p class="msp">MSP:<span>{$value->getCode()}</span></p>
<p class="price">{$this->numberFormat($value->getPrice())} <span>đ</span></p>
<span class="order" onclick="addCart({$value->getId()})" ></span>
</div>
</div><!-- end .product-item -->

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="center">
            <h3 class="navigator">
                      {$option['breakcrum']}
                </h3>
                <h1 class="main_title">{$obj->getTitle()}</h1>
                <div class="detail_text">                
        <!--<h1>Công ty TNHH MTV TM-DV Huỳnh Gia Khang<span>(2/2/2012)</span></h1>-->
                    <p>{$obj->getContent()}</p>
                    <!--
                    <div class="other">
                        <h3 class="other_title">Các tin khác</h3>
                        <a href="#">Công ty TNHH MTV TM-DV Huỳnh Gia Khang<span>(2/2/2012)</span></a>
                        <a href="#">Công ty TNHH MTV TM-DV Huỳnh Gia Khang<span>(2/2/2012)</span></a>
                        <a href="#">Công ty TNHH MTV TM-DV Huỳnh Gia Khang<span>(2/2/2012)</span></a>
                        <a href="#">Công ty TNHH MTV TM-DV Huỳnh Gia Khang<span>(2/2/2012)</span></a>
                        <a href="#">Công ty TNHH MTV TM-DV Huỳnh Gia Khang<span>(2/2/2012)</span></a>
                    </div>
-->
                </div>
                
                       
            </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showEmail:desc::trigger:>
//===========================================================================
function showEmail($content="") {global $bw,$vsPrint;
$lang = VSFactory::getLangs ();
$copyright_left = VSFactory::getSettings ()->getSystemKey ( "copyright_left", "092 2727 939", "configs" );


//--starthtml--//
$BWHTML .= <<<EOF
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>{$bw->vars ['global_websitename']}</title>
<style>
h1,h2,h3,h4,p{margin:0px;padding:0px}
table{
border-collapse:collapse;
}
ul.menu_top li.last {background: none repeat scroll 0% 0% transparent;}
.footer a{text-decoration: none; outline: none; }
</style>
</head>
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0"
marginheight="0" marginwidth="0" bgcolor="#ffffff">
<div marginheight="0" marginwidth="0" bgcolor="#FFFFFF">
<table width="650" height="122" cellspacing="0" cellpadding="0" border="0" align="center">
  <tbody><tr>
    <td colspan="6"><a target="_blank" href="{$bw->base_url}"><img  border="0"  src="{$bw->vars['board_url']}/images/logo.png"></a></td>
  </tr>
</tbody></table>
<table width="650" height="auto" cellspacing="0" cellpadding="0" border="0" align="center">
  <tr>
    <td style="border:15px solid #ccc;padding:30px;display:block">
$content</td>
  </tr>
</tbody></table>
<table width="650" cellspacing="0" cellpadding="0" border="1" align="center" frame="BOX" rules="NONE" style="display: block; margin-top: 10px;">
  <tbody><tr>
    <td height="10px" style="padding:10px;border:0" class="footer">{$copyright_left}</td>
  </tr>
</tbody></table><div class="yj6qo"></div><div class="adL">
</div></div>
</body>
</html>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showMore:desc::trigger:>
//===========================================================================
function showMore($option=array(),$count=4) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        {$this->__foreach_loop__id_540c42c3eb53c($option,$count)}
<script type="text/javascript">
var tallest = 0
jQuery(document).ready(function(){
$(".grid-item-info").each(function(){
if ($(this).height() > tallest)
tallest = $(this).height()
})
if (tallest > 0) {
$(".grid-item-info").each(function(){
$(this).css("min-height",tallest);
})
}
})
</script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_540c42c3eb53c($option=array(),$count=4)
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option)){
    foreach( $option as $value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';$last = $vsf_count%$count==0?' last':'';
    $BWHTML .= <<<EOF
        

<div class="grid-item$last">
<h3 class="item-title"><a href="{$value->getUrl('products')}" title="{$value->getTitle()}">{$value->getTitle()}</a></h3>
<div class="grid-item-image">
<a href="{$value->getUrl('products')}">
{$value->createImageCache($value->getImage(),210,162,3)}
</a>
</div>
<div class="grid-item-code">MSP: <span>{$value->getCode()}</span></div>
<div class="grid-item-info">{$this->cut($value->getIntro(),150)}</div>
<div class="grid-item-price-order">
<div class="item-price">
<span>{$value->getPrice(true)}</span> 
EOF;
if($value->getPrice()) {
$BWHTML .= <<<EOF
{$this->getLang()->getWords('global_currency','VNĐ')}
EOF;
}

$BWHTML .= <<<EOF

</div>
<div class="item-order"><a href="{$value->getUrl('products')}" >Đặt hàng</a></div>
<div class="clear"></div>
</div>
</div>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


}
?>