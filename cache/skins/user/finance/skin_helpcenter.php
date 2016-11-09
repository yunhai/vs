<?php
class skin_helpcenter{

//===========================================================================
// <vsf:loadDefault:desc::trigger:>
//===========================================================================
function loadDefault($option="") {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='agreement agreement-full'>
<div class='item'>
<h3>{$option['helpcenter']->getTitle()}</h3>
<div class='content'>
{$option['helpcenter']->getContent()}
</div>
</div> 
</div>
<div class='clear'></div>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>