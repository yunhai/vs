<?php
class skin_articles{

//===========================================================================
// <vsf:loadDefault:desc::trigger:>
//===========================================================================
function loadDefault($option="") {global $bw, $vsLang;
$this->vsLang= $vsLang;
$cclass = array('even', 'odd');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='article-left article'>

EOF;
if( $option['pageList'] ) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_4ea9266c41ea0($option)}

EOF;
}

$BWHTML .= <<<EOF


EOF;
if( $option['paging'] ) {
$BWHTML .= <<<EOF

<div class='page'>
<span>Browse Pages:</span>
{$option['paging']}
</div>

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
function __foreach_loop__id_4ea9266c41ea0($option="")
{
global $bw, $vsLang;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['pageList'] as $page )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class='item item{$page->cclass}'>
<h3>
<a href='{$page->seourl}' title='{$page->getTitle()}' class='atitle'>
{$page->getTitle()}
</a>
<span class='time'>[{$page->getTime('SHORT')}]</span>
</h3>
<div class='content'>
{$page->getContent(500)} 
<a href='{$page->seourl}' title='{$page->getTitle()}' class='amore'>
{$this->vsLang->getWords('read_more','Continue Reading [+]')}
</a>
</div>
</div> 

EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:loadDetail:desc::trigger:>
//===========================================================================
function loadDetail($option="") {global $bw, $vsLang;
$this->vsLang= $vsLang;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id='detail' class='article-left article'>
<div class='item'>
<h3>
{$option['obj']->getTitle()}
<span class='time'>[{$option['obj']->getTime('SHORT')}]</span>
</h3>
<div class='content'>
{$option['obj']->getContent()} 
</div>
</div>

EOF;
if( $option['other'] ) {
$BWHTML .= <<<EOF

<div id='other' class='item'>
<span class='other'>{$vsLang->getWords('other_'.$bw->input[0],'Other '.$bw->input[0])}</span>
{$this->__foreach_loop__id_4ea9266c422d2($option)}
</div>

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
function __foreach_loop__id_4ea9266c422d2($option="")
{
global $bw, $vsLang;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['other'] as $page )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<a href='{$page->seourl}' title='{$page->getTitle()}' class='ltitle'>
{$page->getTitle()} [{$page->getTime('SHORT')}]
</a>

EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>