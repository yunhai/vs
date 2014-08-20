<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_pages extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw,$vsPrint;
$this->bw=$bw;
$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] )->getChildren();
$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]."s");
$cateId = $option['obj']?$option['obj']->getId():0;



//--starthtml--//
$BWHTML .= <<<EOF
        <div id="primary">
<div id="breadcrumb">
<ul>
{$option['breakcrum']}
</ul>
</div>
<div class="productNew">
<h2 class="H2title">{$vsPrint->mainTitle}</h2>
<div class="productNew-detai-box productNew-box">
<div class="content_news">
{$this->__foreach_loop__id_53f0adfe6a4e9($option)}
</div><!--end content_news-->
</div>
</div>
<!-- end .productNew-box--> 
</div>
<!-- end #primary-->
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adfe6a4e9($option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['pageList'])){
    foreach( $option['pageList'] as $key=>$obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class="news_home_item"> 

EOF;
if($obj->getImage()) {
$BWHTML .= <<<EOF
<a href="{$obj->getUrl($bw->input[0])}" class="news_home_img"><span></span>{$obj->createImageCache($obj->getImage(),185,128)}</a>
EOF;
}

$BWHTML .= <<<EOF

<h3><a href="{$obj->getUrl($bw->input[0])}">{$obj->getTitle()} </a></h3>
<p>{$obj->getIntro()}</p>
<a href="{$obj->getUrl($bw->input[0])}" class="more">Xem chi tiết >></a>
<div class="clear_left"></div>
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
function showDetail($obj="",$option=array()) {global $bw,$vsPrint;
$this->bw=$bw;
$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] )->getChildren();
$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]."s");

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="primary">
<div id="breadcrumb">
<ul>
{$option['breakcrum']}
</ul>
</div>
<div class="productNew">
<h2 class="H2title">{$obj->getTitle()}</h2>
<div class="productNew-detai-box productNew-box"> 
{$obj->getContent()}
</div>


EOF;
if($option['other']) {
$BWHTML .= <<<EOF

<div class="other">
<ul>
<h2 class="H2title">Bài viết cùng loại <a href="">Xem tất cả</a></h2>
{$this->__foreach_loop__id_53f0adfe6a6c7($obj,$option)}
</ul>
</div>

EOF;
}

$BWHTML .= <<<EOF

</div>

<!-- end .productNew-box--> 
</div>
<!-- end #primary-->
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adfe6a6c7($obj="",$option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['other'])){
    foreach( $option['other'] as $key=>$obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<li><a href="{$obj->getUrl($bw->input[0])}">{$obj->getTitle()}</a></li>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


}
?>