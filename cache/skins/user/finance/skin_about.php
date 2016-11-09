<?php
class skin_about{

//===========================================================================
// <vsf:loadDefault:desc::trigger:>
//===========================================================================
function loadDefault($option="") {global $bw, $vsLang;
$this->bare_url = $bw->vars['board_url'];
$cclass = array('even', 'odd');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='agreement-left agreement'>

EOF;
if( $option['pageList'] ) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_4ea9174b46500($option)}

EOF;
}

$BWHTML .= <<<EOF

</div>
<div class='agreement-right' style='float:right'>
<div id='news-portlet' class='portlet'>
<span class='ptitle'>iCampux News</span>
<div class='pdetail'>
{$this->__foreach_loop__id_4ea9174b46614($option)}
<a href='{$this->bare_url}/news' class='more' title='{$vsLang->getWords('all_news_title', 'Read all news')}'>
{$vsLang->getWords('all_news', 'All news')}
</a>
</div>
</div>
<div id='events-portlet' class='portlet'>
<span class='ptitle'>iCampux Events</span>
<div class='pdetail'>
{$this->__foreach_loop__id_4ea9174b46720($option)}
<a href='{$this->bare_url}/events' class='more' title='{$vsLang->getWords('all_event_title', 'Read all events')}'>
{$vsLang->getWords('all_event', 'All events')}
</a>
</div>
</div>
</div>
<div class='clear'></div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_4ea9174b46500($option="")
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


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_4ea9174b46614($option="")
{
global $bw, $vsLang;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['news'] as $news  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class='pitem'>
<span class='itime'>{$news->getTime('m-d-Y')}</span>
<a href='{$this->bare_url}/{$news->seourl}' class='ititle' title='{$news->getTitle()}'>
{$news->getTitle()}
</a>
</div>

EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_4ea9174b46720($option="")
{
global $bw, $vsLang;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['events'] as $news  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class='pitem'>
<span class='itime'>{$news->getTime('m-d-Y')}</span>
<a href='{$this->bare_url}/{$news->seourl}' class='ititle' title='{$news->getTitle()}'>
{$news->getTitle()}
</a>
</div>

EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>