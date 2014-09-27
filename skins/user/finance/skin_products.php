<?php
class skin_products{

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="sanpham">
        <h3 class="main_title">
            <a>{$vsLang->getWords('global_productservice','Sản phẩm  - Dịch vụ')}</a>
                {$vsTemplate->global_template->navigator}
            </h3>
            
EOF;
if($option['pageList']) {
$BWHTML .= <<<EOF

            {$this->loadProduct($option['pageList'])}
           
EOF;
}

else {
$BWHTML .= <<<EOF

           <div class="sanpham_chitiet">
            <p>{$option['error_search']}<p>
        <p style="margin:15px 0 15px 4px;font-style:italic;color:#000;">{$vsLang->getWordsGlobal('global_nodata','Dữ liệu đang được chúng tôi cập nhật')}</p>
        </div>
        
EOF;
}
$BWHTML .= <<<EOF

            <div class="clear_left"></div>
            
            
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
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showCategory:desc::trigger:>
//===========================================================================
function showCategory($option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="sanpham">
        <h3 class="main_title">
            <a>{$vsLang->getWords('global_productservice','Sản phẩm  - Dịch vụ')}</a>
                {$vsTemplate->global_template->navigator}
            </h3>
            
EOF;
if($option['pageList']) {
$BWHTML .= <<<EOF

            {$this->loadProduct($option['pageList'])}
           
EOF;
}

else {
$BWHTML .= <<<EOF

           <div class="sanpham_chitiet">
            <p>{$option['error_search']}<p>
        <p style="margin:15px 0 15px 4px;font-style:italic;color:#000;">{$vsLang->getWordsGlobal('global_nodata','Dữ liệu đang được chúng tôi cập nhật')}</p>
        </div>
        
EOF;
}
$BWHTML .= <<<EOF

            <div class="clear_left"></div>
            
            
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
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:loadProduct:desc::trigger:>
//===========================================================================
function loadProduct($option="") {global $bw,$vsLang,$vsPrint,$vsTemplate,$catpro;

//--starthtml--//
$BWHTML .= <<<EOF
        {$this->__foreach_loop__id_503711e51cc7a($option)}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_503711e51cc7a($option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate,$catpro;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
                    
            <div class="sanpham_item">
         <a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}" class="sanpham_img">{$obj->createImageCache($obj->file,142,110,2)}</a>
                <h3><a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}">{$obj->getTitle()}</a></h3>
                
EOF;
if($bw->input['module']=='products' || $obj->getModule()=='products') {
$BWHTML .= <<<EOF

<p>{$vsLang->getWords('product_pricegoc','Giá gốc')}:&nbsp;<span class='orgprice'>{$obj->getOrgPrice()}</span></p>
                <p>{$vsLang->getWords('product_pricehopdong','Giá hợp đồng')}:&nbsp;<span>{$obj->getPrice()}</span></p>
<p>{$vsLang->getWords('product_pricenohopdong','Giá không HĐ')}:&nbsp;<span>{$obj->getHotPrice()}</span></p>
<p>Giá trả góp:&nbsp;<span>{$obj->getPhi()}</span></p>
EOF;
if($obj->getNetwork()) {
$BWHTML .= <<<EOF

<p>{$vsLang->getWords('product_nhamang','Nhà mạng')}:<span>&nbsp;{$obj->getNetwork()}</span></p>

EOF;
}

$BWHTML .= <<<EOF


EOF;
}

else {
$BWHTML .= <<<EOF

<p style="text-align:center">{$vsLang->getWords('product_pricegoc','Giá gốc')}:&nbsp;<span class='orgprice'>{$obj->getOrgPrice()}</span></p>
<p style="text-align:center">{$vsLang->getWords('product_price','Giá Won')}:<span>&nbsp;{$obj->getPrice()}</span></p>
<p style="text-align:center">{$vsLang->getWords('product_pricevn','Giá VNĐ')}:<span>&nbsp;{$obj->getPriceVN()}</span></p>

EOF;
}
$BWHTML .= <<<EOF

            </div>
            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option="") {global $bw,$vsLang,$vsPrint,$vsTemplate,$addon;
$vsPrint->addCSSFile('jquery.tabs');
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
$BWHTML .= <<<EOF
        
EOF;
if($obj) {
$BWHTML .= <<<EOF

<div class="sanpham">
        <h3 class="main_title">
            <a>{$vsLang->getWords('global_productservice','Sản phẩm  - Dịch vụ')}</a>
                {$vsTemplate->global_template->navigator}
            </h3>
            <div class="sanpham_chitiet">
            
EOF;
if($option['gallery']) {
$BWHTML .= <<<EOF

            <div class="product_slide">
                    <div id="gallery" class="content">
                            <div class="slideshow-container">
                                <div id="loading" class="loader"></div>
                                <div id="slideshow" class="slideshow">
                <div style="display:none;" class="show_popup_img">
{$this->__foreach_loop__id_503711e51d061($obj,$option)}
</div>
                </div>
                            </div>
                        </div>
                        
                        <div id="thumbs" class="navigation">
                            <ul class="thumbs noscript">
                            {$this->__foreach_loop__id_503711e51d44a($obj,$option)}
                                <div class="clear_left"></div>
                            </ul>
                        </div>
                        <div id="controls" class="controls"></div>
            </div>
            
EOF;
}

else {
$BWHTML .= <<<EOF

            {$obj->showImagePopup($obj->file,249,261,"pro_detail_img",2)}
            
EOF;
}
$BWHTML .= <<<EOF

            <!-- STOP PRODUCT SLIDE -->
            
            <div class="product_detail">
            <h1>{$obj->getTitle()}</h1>
            
EOF;
if($bw->input['module']=='products') {
$BWHTML .= <<<EOF

            <p class="cost">{$vsLang->getWords('product_pricegoc','Giá gốc')}:&nbsp;<span class='orgprice'>{$obj->getOrgPrice()}</span></p>
                <p class="cost">{$vsLang->getWords('product_pricehopdong','Giá hợp đồng')}:<span>&nbsp;{$obj->getPrice()}</span></p>
<p class="cost">{$vsLang->getWords('product_pricenohopdong1','Giá không hợp đồng')}:<span>&nbsp;{$obj->getHotPrice()}</span></p>
<p class="cost">Giá trả góp:<span>&nbsp;{$obj->getPhi()}</span></p>
                <a href="{$bw->base_url}registers" class="dathang hopdong">{$vsLang->getWords('product_dhhopdong','Đặt hàng theo giá hợp đồng')}</a>
                <a href="{$bw->base_url}orders/addtocart/{$obj->getId()}/2" class="dathang khonghopdong">{$vsLang->getWords('product_dhkohopdong','Đặt hàng theo giá không hợp đồng')}</a>
                
EOF;
}

else {
$BWHTML .= <<<EOF

                <p class="cost">{$vsLang->getWords('product_pricegoc','Giá gốc')}:&nbsp;<span class='orgprice'>{$obj->getOrgPrice()}</span></p>
<p class="cost">{$vsLang->getWords('product_price','Giá')}:<span>&nbsp;{$obj->getPrice()}</span></p>
<a href="{$bw->base_url}orders/addtocart/{$obj->getId()}/3" class="dathang1">{$vsLang->getWords('product_dathang','Đặt hàng')}</a>

EOF;
}
$BWHTML .= <<<EOF

                <p>{$obj->getIntro()}</p>
                <div class="clear"></div>
            </div>

<div id="container-4">
                <ul>
                    <li><a href="#fragment-10">Chi tiết tính năng</a></li>
                    <li><a href="#fragment-11">Hình ảnh</a></li>    
                    <li><a href="#fragment-12">Video</a></li>
                </ul>
                <div id="fragment-10" style="padding-top:10px;">
                   {$obj->getContent()}
                </div>
                <div id="fragment-11" style="padding-top:10px;">
                   {$obj->getEditorImage()}
                </div>
                <div id="fragment-12" style="padding-top:10px;">
                  {$obj->getPlayer()}
                </div>
    
            </div>
<!--
            
EOF;
if(in_array($bw->input['module'], $this->array)) {
$BWHTML .= <<<EOF

            <h3 class="product_detail_title">{$vsLang->getWords('product_tinhnang','Chi tiết tính năng')}</h3>
            {$obj->getContent()}
            <h3 class="product_detail_title" style="margin-bottom:10px;">{$vsLang->getWords('product_video','Video')}</h3>
            {$obj->getPlayer()}
            
EOF;
}

else {
$BWHTML .= <<<EOF

            {$obj->getContent()}
            
EOF;
}
$BWHTML .= <<<EOF

        -->    
{$addon->getLikePage($obj->getId())}
        {$addon->getComment($obj->getId())}
     <div class="clear_right"></div>
 
 
            
EOF;
if($option['other']) {
$BWHTML .= <<<EOF

            <div class="product_other">
            <h3 class="other_title">{$vsLang->getWords($bw->input['module'].'_other','sản phẩm cùng loại')}</h3>
                {$this->loadProduct($option['other'])}
                <div class="clear_left"></div>
            </div>
            
EOF;
}

$BWHTML .= <<<EOF

            </div>
        </div>
        
EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_503711e51d061($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['gallery'] as $i )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
         
{$i->showImagePopup($i,285,189,"",2)}

EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_503711e51d44a($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach(  $option['gallery'] as $image  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li>
                    <a class="thumb" name="leaf" href="{$image->getResizeImagePath($image->getPathView(),249,261,1)}" title="{$image->getTitle()}">
                    {$image->createImageCache($image,59,61,2)}
                     </a>                                
                 </li>
        
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetailNews:desc::trigger:>
//===========================================================================
function showDetailNews($obj="",$option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($obj) {
$BWHTML .= <<<EOF

<div class="sanpham">
        <h3 class="main_title">{$vsTemplate->global_template->navigator}</h3>
            <div class="gioithieu detail">
            <h1>{$obj->getTitle()} <span>- ({$obj->getPostDate(SHORT)})</span></h1>
            <p>{$obj->getContent()}</p>
</div>

EOF;
if($option['other']) {
$BWHTML .= <<<EOF

        <div class="other">
            <h3 class="other_title">{$vsLang->getWords($bw->input['module'].'_other','Các tin khác')}</h3>
                {$this->__foreach_loop__id_503711e51d830($obj,$option)} 
    </div>
    
EOF;
}

$BWHTML .= <<<EOF

        </div>
        
EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_503711e51d830($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['other'] as $ob )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <a href="{$ob->getUrl($bw->input['module'])}" title="{$ob->getTitle()}">{$ob->getTitle()} <span>- ({$ob->getPostDate(SHORT)})</span></a>
                
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetailAbouts:desc::trigger:>
//===========================================================================
function showDetailAbouts($obj="",$option="") {global $bw,$vsLang,$vsPrint,$vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($obj) {
$BWHTML .= <<<EOF

<div class="sanpham">
        <h3 class="main_title">{$vsTemplate->global_template->navigator}</h3>
            <div class="gioithieu detail">
            
            <p>{$obj->getContent()}</p>
</div>

EOF;
if($option['other']) {
$BWHTML .= <<<EOF

        <div class="other">
            <h3 class="other_title">{$vsLang->getWords($bw->input['module'].'_other','Các tin khác')}</h3>
                {$this->__foreach_loop__id_503711e51dc19($obj,$option)} 
    </div>
    
EOF;
}

$BWHTML .= <<<EOF

        </div>
        
EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_503711e51dc19($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['other'] as $ob )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <a href="{$ob->getUrl($bw->input['module'])}" title="{$ob->getTitle()}">{$ob->getTitle()} <span>- ({$ob->getPostDate(SHORT)})</span></a>
                
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
        <div class="title">
       <div class="title_center">
       <p>{$vsPrint->mainTitle}</p></div>
         <div class="clear_left"></div>
        </div>
        
EOF;
if($option['pageList']) {
$BWHTML .= <<<EOF

        <div class="vbhc">
        {$this->__foreach_loop__id_503711e51e001($option)}
            <div class="clear_left"></div>                                     
        </div>
        
EOF;
}

else {
$BWHTML .= <<<EOF

        {$option['error_search']}
        
EOF;
}
$BWHTML .= <<<EOF

        <!-- STOP VAN BANG HANH CHINH -->
        
        
EOF;
if($option['paging']) {
$BWHTML .= <<<EOF

     <div class="page">
        {$option['paging']}
        </div>
        
EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_503711e51e001($option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['pageList'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            <div class="vbhc_item">
            <a href="{$obj->getUrl($obj->getModule())}" title="{$obj->getTitle()}">{$obj->getTitle(80)}</a>
            </div>
            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>