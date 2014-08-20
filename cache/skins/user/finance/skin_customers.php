<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_customers extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw,$vsPrint;
$this->bw = $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option=array()) {global $bw, $vsPrint;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content">
    <div class="center">
        <div class="page_title">Hỗ trợ khách hàng</div>
            <div class="page_detail">
            <div class="title_detail">{$obj->getTitle()}</div>
            {$obj->getContent()}
             </div>  
            
                       
            <div class="clear"></div>
        </div>
         <div class="sitebar">
         {$this->getAddon()->getHtml()->getCustomerSitebar($option)}
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