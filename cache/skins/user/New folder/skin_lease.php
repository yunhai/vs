<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_lease extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw,$vsPrint;
$this->bw=$bw;


//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content_mid">
<div class="content_mid_title">{$vsPrint->mainTitle}</div>
{$this->__foreach_loop__id_53c1717b7c6be($option)}
<div class="clear"></div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53c1717b7c6be($option=array())
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
        
<div class="news_item">
<div class="im"><a href="{$obj->getUrl('news')}">{$obj->createImageCache($obj->getImage(),110,74)}</a></div>
<div class="na"><a href="{$obj->getUrl('news')}">{$obj->getTitle()} <span>[10/04/2013]</span></a></div>
<div class="intro">{$this->cut($obj->getIntro(),200)}</div>
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


//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content_mid">
<div class="content_mid_title">{$obj->getTitle()}</div>
{$obj->getContent()}
<div class="clear"></div>
<div class="other">Tin khác</div>
<ul class="other_post">
{$this->__foreach_loop__id_53c1717b7c7c1($obj,$option)}
</ul>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53c1717b7c7c1($obj="",$option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['other'])){
    foreach( $option['other'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<li><a href="{$obj->getUrl('lease')}">{$obj->getTitle()}</a></li>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showMore:desc::trigger:>
//===========================================================================
function showMore($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}


}
?>