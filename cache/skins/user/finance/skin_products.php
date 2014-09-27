<?php
class skin_products{

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option="") {//--starthtml--//
$BWHTML .= <<<EOF
        <div class="sanpham">
        <h3 class="main_title">
            <a>{$vsLang->getWords('global_productservice','Sản phẩm  - Dịch vụ')}</a>
                {$vsTemplate->global_template->navigator}
            </h3>
            
EOF;
if($option['pageList']) {

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="sanpham">
        <h3 class="main_title">
            <a>{$vsLang->getWords('global_productservice','Sản phẩm  - Dịch vụ')}</a>
                {$vsTemplate->global_template->navigator}
            </h3>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showCategory:desc::trigger:>
//===========================================================================
function showCategory($option="") {//--starthtml--//
$BWHTML .= <<<EOF
        <div class="sanpham">
        <h3 class="main_title">
            <a>{$vsLang->getWords('global_productservice','Sản phẩm  - Dịch vụ')}</a>
                {$vsTemplate->global_template->navigator}
            </h3>
            
EOF;
if($option['pageList']) {

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="sanpham">
        <h3 class="main_title">
            <a>{$vsLang->getWords('global_productservice','Sản phẩm  - Dịch vụ')}</a>
                {$vsTemplate->global_template->navigator}
            </h3>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:loadProduct:desc::trigger:>
//===========================================================================
function loadProduct($option="") {
//--starthtml--//
$BWHTML .= <<<EOF
        {$this->__foreach_loop__id_503711e51cc7a($option)}
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:__foreach_loop__id_503711e51cc7a:desc::trigger:>
//===========================================================================
function __foreach_loop__id_503711e51cc7a($option="") {{
global $bw,$vsLang,$vsPrint,$vsTemplate,$catpro;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    
//--starthtml--//
$BWHTML .= <<<EOF
        <div class="sanpham_item">
         <a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}" class="sanpham_img">{$obj->createImageCache($obj->file,142,110,2)}</a>
                <h3><a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}">{$obj->getTitle()}</a></h3>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option="") {$vsPrint->addCSSFile('jquery.tabs');
$vsPrint->addCurentJavaScriptFile("jquery.tabs.pack",1);
$vsPrint->addJavaScriptString ( 'products_script', "
$(document).ready(function(){
$('#container-4').tabs({ fxFade: true, fxSpeed: 'fast' });
});"); 
$vsPrint->addCSSFile('galleriffic-2');
$vsPrint->addCurentJavaScriptFile("highslide/highslide-full");
if ($option['gallery']){
$vsPrint->addCurentJavaScriptFile("jquery.galleriffic");
$vsPrint->addCurentJavaScriptFile("jquery.opacityrollover");
}
$this->array = array("products","electronics");
//--starthtml--//

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:__foreach_loop__id_503711e51d061:desc::trigger:>
//===========================================================================
function __foreach_loop__id_503711e51d061($obj="",$option="") {{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['gallery'] as $i )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    
//--starthtml--//
$BWHTML .= <<<EOF
        {$i->showImagePopup($i,285,189,"",2)}
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:__foreach_loop__id_503711e51d44a:desc::trigger:>
//===========================================================================
function __foreach_loop__id_503711e51d44a($obj="",$option="") {{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach(  $option['gallery'] as $image  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    
//--starthtml--//
$BWHTML .= <<<EOF
        <li>
                    <a class="thumb" name="leaf" href="{$image->getResizeImagePath($image->getPathView(),249,261,1)}" title="{$image->getTitle()}">
                    {$image->createImageCache($image,59,61,2)}
                     </a>                                
                 </li>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showDetailNews:desc::trigger:>
//===========================================================================
function showDetailNews($obj="",$option="") {//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($obj) {

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:__foreach_loop__id_503711e51d830:desc::trigger:>
//===========================================================================
function __foreach_loop__id_503711e51d830($obj="",$option="") {{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['other'] as $ob )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    
//--starthtml--//
$BWHTML .= <<<EOF
        <a href="{$ob->getUrl($bw->input['module'])}" title="{$ob->getTitle()}">{$ob->getTitle()} <span>- ({$ob->getPostDate(SHORT)})</span></a>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showDetailAbouts:desc::trigger:>
//===========================================================================
function showDetailAbouts($obj="",$option="") {//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($obj) {

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:__foreach_loop__id_503711e51dc19:desc::trigger:>
//===========================================================================
function __foreach_loop__id_503711e51dc19($obj="",$option="") {{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['other'] as $ob )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    
//--starthtml--//
$BWHTML .= <<<EOF
        <a href="{$ob->getUrl($bw->input['module'])}" title="{$ob->getTitle()}">{$ob->getTitle()} <span>- ({$ob->getPostDate(SHORT)})</span></a>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showSearch:desc::trigger:>
//===========================================================================
function showSearch($option="") {//--starthtml--//
$BWHTML .= <<<EOF
        <div class="title">
       <div class="title_center">
       <p>{$vsPrint->mainTitle}</p></div>
         <div class="clear_left"></div>
        </div>
        
EOF;
if($option['pageList']) {

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="title">
       <div class="title_center">
       <p>{$vsPrint->mainTitle}</p></div>
         <div class="clear_left"></div>
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:__foreach_loop__id_503711e51e001:desc::trigger:>
//===========================================================================
function __foreach_loop__id_503711e51e001($option="") {{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['pageList'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    
//--starthtml--//
$BWHTML .= <<<EOF
        <div class="vbhc_item">
            <a href="{$obj->getUrl($obj->getModule())}" title="{$obj->getTitle()}">{$obj->getTitle(80)}</a>
            </div>
EOF;
//--endhtml--//
return $BWHTML;
}


}
?>