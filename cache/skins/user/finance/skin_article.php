<?php
class skin_article{

//===========================================================================
// <vsf:loadDefault:desc::trigger:>
//===========================================================================
function loadDefault($option="") {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='article article-full'>
<div class='item'>
<h3>{$option['article']->getTitle()}</h3>
<div class='content'>
{$option['article']->getContent()}
</div>
</div> 
</div>
<div class='clear'></div>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>