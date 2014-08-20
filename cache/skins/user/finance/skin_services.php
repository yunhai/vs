<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_services extends skin_objectpublic {

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
        <div class="content">
    <div class="center">
        <div class="page_title">{$vsPrint->mainTitle}</div>
            
            
            
            {$this->__foreach_loop__id_53f0adff9dead($option)}
            
            
            <div class="clear"></div>
            <div class="page">
                {$option['paging']}
            </div>
        </div>
         <div class="sitebar">
         {$this->getAddon()->getHtml()->getServiceSitebar($option)}
        {$this->getAddon()->getHtml()->getSearchSitebar($option)}
            {$this->getAddon()->getHtml()->getAdsSitebar($option)}
            {$this->getAddon()->getHtml()->getNewsSitebar($option)}
             
        </div>
    <div class="clear"></div>
        
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adff9dead($option=array())
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
        
            <div class="project_item">
            <div class="im"><a href="{$obj->getUrl('services')}">{$obj->createImageCache($obj->getImage(),356,208)}</a></div>
                <div class="na"><a href="{$obj->getUrl('services')}">{$obj->getTitle()}</a></div>
                <div class="time">{$this->dateTimeFormat($obj->getPostDate(),'d/m/Y')}</div>
                <div class="intro">
                {$this->cut($obj->getIntro(),100)}
                </div>
                <a href="{$obj->getUrl('services')}" class="detail">Chi tiết</a>
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
$this->catTitle=$option['cate_obj']->getTitle();
$this->urlCate="{$this->bw->base_url}services/category/{$option['cate_obj']->getSlugId()}";

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content">
    <div class="center">
        <div class="page_title">{$obj->getTitle()}</div>
            <div class="page_detail">
            {$obj->getContent()}
             </div>  
            <div class="clear"></div>
        </div>
        <div class="sitebar">
        
            
            {$this->getAddon()->getHtml()->getServiceSitebar($option)}
        {$this->getAddon()->getHtml()->getSearchSitebar($option)}
            {$this->getAddon()->getHtml()->getAdsSitebar($option)}
            {$this->getAddon()->getHtml()->getNewsSitebar($option)}
             
        </div>
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