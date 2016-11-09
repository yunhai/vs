<?php
class skin_agreement{

//===========================================================================
// <vsf:loadDefault:desc::trigger:>
//===========================================================================
function loadDefault($option="") {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='agreement agreement-full'>
<div class='item'>
<h3>{$option['obj']->getTitle()}</h3>
<div class='content'>
{$option['obj']->getContent()}
</div>
</div> 
</div>
<div class='clear'></div>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>