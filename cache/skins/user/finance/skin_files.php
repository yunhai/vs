<?php
class skin_files{

//===========================================================================
// <vsf:MainFile:desc::trigger:>
//===========================================================================
function MainFile($fileContentHTML="") {$BWHTML = "";
//--starthtml--//

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="vs-common">
{$fileContentHTML}
</div>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>