<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_abouts extends skin_objectpublic {

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
        
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option=array()) {global $bw,$vsPrint;
$this->bw=$bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content">
    <div class="center">
        <div class="page_title">Giới thiệu</div>
            <div class="page_detail">
            <div class="title_detail">{$obj->getTitle()}</div>
            {$obj->getContent()}
             </div>  
            
                       
            <div class="clear"></div>
        </div>
         <div class="sitebar">
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