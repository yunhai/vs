<?php
class skin_home{

//===========================================================================
// <vsf:loadDefault:desc::trigger:>
//===========================================================================
function loadDefault($option="") {global $bw;
$cclass = array('even', 'odd');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='article-left article'>

EOF;
if( $option['pageList'] ) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_4e9e81feaedf0($option)}

EOF;
}

$BWHTML .= <<<EOF

</div>
<div class='clear'></div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_4e9e81feaedf0($option="")
{
global $bw;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['pageList'] as $page )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class='item item{$page->cclass}'>
<h3>{$page->getTitle()}</h3>
<div class='content'>
{$page->getContent()}
</div>
</div> 

EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>