<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_home extends skin_objectpublic {

//===========================================================================
// <vsf:loadDefault:desc::trigger:>
//===========================================================================
function loadDefault($option=array()) {global $bw, $vsTemplate, $vsPrint, $vsUser,$menu;


//--starthtml--//
$BWHTML .= <<<EOF
        <style>
body {
background:#fff;
}
</style>
<center>
<div class="banner">
    {$this->getAddon()->getHtml()->getBannerHome($option)}
    <div class="header_home ">
        <div class="wrap_header">
            <div class="wrap_letf">
            <a href="{$bw->base_url}"><img src="{$bw->vars['img_url']}/logo.png" /></a>
             <div class="bott_left_head"></div>
            </div>
                <div class="wrap_right">
                <div class="slogan">Today - Tomorrow and Forever</div>
                {$this->getAddon()->getMenuTop($option)}
                <div class="bott_right_head"></div>
                </div>
               
            
            </div>
            
        </div>
    </div>
    </center>
    {$this->getAddon()->getHtml()->getServiceHome($option)}
    <div class="content_home">
    <div class="block1">
        {$this->getAddon()->getHtml()->getNewsHome($option)}
            {$this->getAddon()->getHtml()->getVideoHome($option)}
            {$this->getAddon()->getHtml()->getSearchHome($option)}
            <div class="clear"></div>
        </div>
        <div class="block2">
        {$this->getAddon()->getHtml()->getProjectHome($option)}
            <div class="clear"></div>
        </div>
    </div>
    <div class="footer">
    <div class="wrap_footer">
        <div class="left">
            {$this->getAddon()->getHtml()->getContactFooter()}
            </div>
            <div class="right">
            {$this->getAddon()->getAnalytic()}
                <div class="vs">
            <a href='http://www.vietsol.net/' target='_blank' rel="" title='Thiết kế web chuyên nghiệp' style="color:#7c7b7b">Thiết kế web </a><span style="color:#7c7b7b">bởi</span>
            <a href='http://www.vietsol.net/gioi-thieu-cong-ty-thiet-ke-web/' rel="nofollow" target='_blank' title='Công ty thiết kế web' style="color:#7c7b7b;">Viet Solution</a>
                    
</div>
            </div>
        </div>
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}


}
?>