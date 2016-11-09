<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_news extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;


//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content_center">
   <div class="gioithieu">
<h2 class="center_title">{$vsPrint->pageTitle}</h2>

EOF;
if($option['pageList']) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_4f8fd1ff398c9($option)}
        
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
 
   
</div>
   <!-- STOP GIOI THIEU -->
                
{$vsTemplate->global_template->weblink}
   <div class="clear"> </div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f8fd1ff398c9($option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['pageList'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
         
      <div class="khuyenmai_item">
      
EOF;
if($obj->file) {
$BWHTML .= <<<EOF

        <a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}" class="news_img">{$obj->createImageCache($obj->file,124,74,2)}</a>
        
EOF;
}

$BWHTML .= <<<EOF

        <h3><a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}">{$obj->getTitle()} <span>[{$obj->getPostDate(SHORT)}]</span> </a></h3>
            <p>{$obj->getIntro(200)}</p>
            <a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}" class="view_more">{$vsLang->getWordsGlobal('global_viewdetail','Xem tiết')}</a>
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
        <div id="content_center">
  <div class="gioithieu">
   <h2 class="center_title">{$option['cate']->getTitle()}</h2> 
          <h1 class="news_title">{$obj->getTitle()} <span>[{$obj->getPostDate(SHORT)}]</span></h1>
          <p>{$obj->getContent()}</p>
                    
        
EOF;
if($option['other']) {
$BWHTML .= <<<EOF

        <h3 class="other_title">
{$vsLang->getWords($bw->input['module'].'_other','Các tin tức khác')}
        <a href="{$bw->base_url}news">{$vsLang->getWordsGlobal('global_viewall','xem tất cả')}</a>
      </h3>
<div class="other">
    {$this->__foreach_loop__id_4f8fd1ff39d16($obj,$option)}                
</div>  

EOF;
}

$BWHTML .= <<<EOF

        
  </div>
<!-- STOP GIOI THIEU -->
                
  {$vsTemplate->global_template->weblink}
  <div class="clear"> </div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f8fd1ff39d16($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['other'] as $ob )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
   <a href="{$ob->getUrl($bw->input['module'])}" title="{$ob->getTitle()}">{$ob->getTitle()} <span>[{$ob->getPostDate(SHORT)}]</span> </a>
   
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>