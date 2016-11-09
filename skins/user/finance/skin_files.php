<?php
class skin_files {

function MainFile($fileContentHTML = "") {
$BWHTML = "";
//--starthtml--//
$BWHTML .= <<<EOF
<div class="vs-common">
{$fileContentHTML}
</div>
EOF;
//--endhtml--//
return $BWHTML;
}
}
?>