<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_simple extends skin_objectpublic {

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


</div>

<!-- end .productNew-box--> 
</div>
<!-- end #primary-->
EOF;
//--endhtml--//
return $BWHTML;
}


}
?>