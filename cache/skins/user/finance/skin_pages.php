<?php
class skin_pages{

//===========================================================================
// <vsf:showService:desc::trigger:>
//===========================================================================
function showService($option=array()) {global $vsTemplate, $vsLang,$bw;
  
                
//--starthtml--//
$BWHTML .= <<<EOF
        <div class="news_menu">
            <a href="{$option['show']->getUrl($bw->input['module'])}" title="{$option['show']->getTitle()}">{$option['show']->getTitle()}</a>
                
EOF;
if($option['other']) {
$BWHTML .= <<<EOF

                    {$this->__foreach_loop__id_4ea9174b44a2e($option)}
               
EOF;
}

$BWHTML .= <<<EOF

               <div class='clear'></div>
            </div>
            <div class='clear'></div>
            <div class="content_detail">
                {$option['show']->showImagePopup($option['show']->file,222,0,'dangky_img')}
               {$option['show']->getContent()}
               <div class='clear'></div>
            </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_4ea9174b44a2e($option=array())
{
global $vsTemplate, $vsLang,$bw;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach( $option['other'] as $ot )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <a href="{$ot->getUrl($bw->input['module'])}" title="{$ot->getTitle()}">{$ot->getTitle()}</a>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:loadDetail:desc::trigger:>
//===========================================================================
function loadDetail($obj="",$option=array()) {global $vsTemplate, $vsLang;

//--starthtml--//
$BWHTML .= <<<EOF
        <h4 class="title_pages">
<p>
<span>
{$obj->getTitle()}
</span>
</p>
</h4>
<div class="content_module">
                    <div class="news_detail">
                        <p class="news_date"></p>
                        <div class="wine_cost_info2">
                        {$obj->getContent()}
                        </div>                        
                        <div class="clear"></div>
                    </div>
                    <!-- STOP WINE COST -->
                   
                    <div class="key_wine">
                        {$vsTemplate->global_template->addthis}
                     </div>
                </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:loadDefault:desc::trigger:>
//===========================================================================
function loadDefault($option=array()) {global $vsLang,$bw;
                print "<pre>";
                print_r($option);
                print "<pre>";
                exit();

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}


}?>