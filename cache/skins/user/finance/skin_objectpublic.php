<?php
class skin_objectpublic{

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
    <h3 class="main_title">{$vsTemplate->global_template->navigator}</h3>
    
EOF;
if($option['pageList']) {
$BWHTML .= <<<EOF

        {$this->__foreach_loop__id_5015e8d74d002($option)}
        
EOF;
}

else {
$BWHTML .= <<<EOF

        <p class="nodata">{$vsLang->getWordsGlobal('global_nodata','Dữ liệu đang được chúng tôi cập nhật')}</p>
    
EOF;
}
$BWHTML .= <<<EOF

        
        
EOF;
if($option['paging']) {
$BWHTML .= <<<EOF

     <div class="page">
        {$option['paging']}
        </div>
     
EOF;
}

$BWHTML .= <<<EOF

        <div class="clear_right"></div>
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d74d002($option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['pageList'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class="news_item">
            
EOF;
if($obj->file) {
$BWHTML .= <<<EOF

        <a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}" class="news_img">
{$obj->createImageCache($obj->file,153,111,2)}
</a>
        
EOF;
}

$BWHTML .= <<<EOF

            <h3><a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}">{$obj->getTitle()} 
EOF;
if($bw->input['module']=='promotions') {
$BWHTML .= <<<EOF
<span> [{$obj->getPostDate(SHORT)}]</span>
EOF;
}

$BWHTML .= <<<EOF
</a></h3>
            <div class="news_intro">
            <p>{$obj->getIntro(500)} </p>
            </div>
            <a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}" class="view_detail">{$vsLang->getWordsGlobal("global_detail","Chi tiết")}</a>
            <div class="clear_left"></div>
        </div>
        
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;


//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
    <h3 class="main_title">{$vsTemplate->global_template->navigator}</h3>
            <h1 class="page_title">{$obj->getTitle()} 
EOF;
if($bw->input['module']=='promotions') {
$BWHTML .= <<<EOF
<span> [{$obj->getPostDate(SHORT)}]</span>
EOF;
}

$BWHTML .= <<<EOF
</h1>
            <p>{$obj->getContent()}</p>
            
EOF;
if($option['other']) {
$BWHTML .= <<<EOF

       <div class="other">
       <a href="{$bw->base_url}{$bw->input['module']}" class="view_all1">{$vsLang->getWordsGlobal("global_viewall","Xem tất cả")}</a>
        <h3 class="main_title">{$vsLang->getWords($bw->input['module'].'_other','Tin tức cùng chủ đề')}</h3>
            {$this->__foreach_loop__id_5015e8d74d5ce($obj,$option)}
          
      </div>
       
EOF;
}

$BWHTML .= <<<EOF

          <div class="clear_right"></div>
  </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d74d5ce($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['other'] as $ob )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    <a href="{$ob->getUrl($bw->input['module'])}" title="{$ob->getTitle()}" class="other_item"> {$ob->getTitle()} 
EOF;
if($bw->input['module']=='promotions') {
$BWHTML .= <<<EOF
<span>[{$ob->getPostDate(SHORT)}]</span>
EOF;
}

$BWHTML .= <<<EOF
</a>
              
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showSearch:desc::trigger:>
//===========================================================================
function showSearch($option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
    <h3 class="main_title">{$vsPrint->pageTitle}</h3>
    
EOF;
if($option['pageList']) {
$BWHTML .= <<<EOF

        {$this->__foreach_loop__id_5015e8d74da9b($option)}
        
EOF;
}

else {
$BWHTML .= <<<EOF

        <p class="nodata">{$option['error_search']}</p>
    
EOF;
}
$BWHTML .= <<<EOF

        
        
EOF;
if($option['paging']) {
$BWHTML .= <<<EOF

     <div class="page">
        {$option['paging']}
        </div>
     
EOF;
}

$BWHTML .= <<<EOF

        <div class="clear_right"></div>
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_5015e8d74da9b($option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['pageList'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class="news_item">
            
EOF;
if($obj->file) {
$BWHTML .= <<<EOF

        <a href="{$obj->getUrl($obj->getModule())}" title="{$obj->getTitle()}" class="news_img">{$obj->createImageCache($obj->file,153,111,2)}</a>
        
EOF;
}

$BWHTML .= <<<EOF

            <h3><a href="{$obj->getUrl($obj->getModule())}" title="{$obj->getTitle()}">{$obj->getTitle()} 
EOF;
if($bw->input['module']=='promotions') {
$BWHTML .= <<<EOF
<span> [{$obj->getPostDate(SHORT)}]</span>
EOF;
}

$BWHTML .= <<<EOF
</a></h3>
            <div class="news_intro">
            <p>{$obj->getIntro(500)} </p>
            </div>
            <a href="{$obj->getUrl($obj->getModule())}" title="{$obj->getTitle()}" class="view_detail">{$vsLang->getWordsGlobal("global_detail","Chi tiết")}</a>
            <div class="clear_left"></div>
        </div>
        
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>