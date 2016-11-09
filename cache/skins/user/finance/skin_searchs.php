<?php
class skin_searchs{

//===========================================================================
// <vsf:loadDefault:desc::trigger:>
//===========================================================================
function loadDefault($option="") {global $bw, $vsLang, $vsPrint;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='searchpage'>
        <div id="content_left">
            <div class="seller_border">
            <div class="user_title">
                <h3>Search result</h3>
                </div>
                <div class='icitem_container' id='icitem_container'>

EOF;
if( $option['pageList'] ) {
$BWHTML .= <<<EOF

                {$this->__foreach_loop__id_4e8c1aa1df444($option)}
            
EOF;
}

else {
$BWHTML .= <<<EOF

            <div class="store_item">
            Sorry! No match for your search. Please try different keywords
            </div>
<div class="clear"></div>
           
EOF;
}
$BWHTML .= <<<EOF

           
           
EOF;
if($option['paging']) {
$BWHTML .= <<<EOF

           <div class="page">
                   <span>Browse Pages:</span>
                   {$option['paging']}
                   </div>
           
EOF;
}

$BWHTML .= <<<EOF

</div>
</div>
</div>
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_4e8c1aa1df444($option="")
{
global $bw, $vsLang, $vsPrint;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['pageList'] as $key=>$value  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
         
                <div class="item">
                <h3 class='title'>
                <a href='{$this->board_url}/{$value['searchURL']}' title="{$value['searchOTitle']}">
                {$value['searchOTitle']}
                </a>
                </h3>
                <div class='description'>
                {$value['searchOIntro']}
                </div>
                    <div class="clear"></div>
                </div>
            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>