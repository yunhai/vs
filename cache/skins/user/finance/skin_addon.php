<?php
if(!class_exists('skin_board_public'))
require_once ('./cache/skins/user/finance/skin_board_public.php');
class skin_addon extends skin_board_public {

//===========================================================================
// <vsf:getTags:desc::trigger:>
//===========================================================================
function getTags($obj="") {global $bw;

require_once CORE_PATH.'tags/tags.php';
//$option['category']=VSFactory::getMenus()->getCategoryGroup('products');
//$ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
$tags=new tags();
//$tags->setCondition("status>0");
$tags->setCondition("`id` IN (SELECT `tagId` FROM `vsf_tagcontent` WHERE `contentId` ={$obj->getId()})");
 
//$tags->setOrder("`index`");
$this->list_tag=$tags->getObjectsByCondition();


//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($this->list_tag) {
$BWHTML .= <<<EOF

<div class="tag_detail"><span>Tag:</span>
{$this->__foreach_loop__id_53f0adf732ff8($obj)}
</div>

EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf732ff8($obj="")
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($this->list_tag)){
    foreach( $this->list_tag as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <a  href="{$bw->base_url}products/tags/{$obj->getSlugId()}">{$obj->getTitle()} </a>
            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getBannerHome:desc::trigger:>
//===========================================================================
function getBannerHome($option="") {global $bw, $vsPrint;
$option['banners']=Object::getObjModule('banners', 'banners', '>0', '', '');
$vsPrint->addCurentJavaScriptFile ('jquery.nivo.slider.pack');
$vsPrint->addCSSFile('nivo-slider');

//--starthtml--//
$BWHTML .= <<<EOF
        <script type="text/javascript">
$(window).load(function() {
        $('#slider').nivoSlider({
        effect : 'random',
        slices:18,
        animSpeed:1000,
        pauseTime:3000,
        startSlide:0,
        directionNav:false,
        directionNavHide:true,
        controlNav:false,
        controlNavThumbs:false,
        controlNavThumbsFromRel:true,
        keyboardNav:true,
        pauseOnHover:true,
        manualAdvance:false
    });
});
</script>
<div id="slider" class="nivoSlider">
{$this->__foreach_loop__id_53f0adf73323f($option)}
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf73323f($option="")
{
global $bw, $vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['banners'])){
    foreach( $option['banners'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<a href="{$obj->getUrl()}">{$obj->createImageCache($obj->getImage(),1400,675)}</a>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getMenuTop:desc::trigger:>
//===========================================================================
function getMenuTop($option=array()) {global $bw,$vsLang;
$this->bw = $bw;
$vsLang = VSFactory::getLangs();

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="menu_top">
<ul>
{$this->__foreach_loop__id_53f0adf733619($option)}
            </ul>
</div>
<style>
.menu_li_1 ul, .menu_li_2 ul, .menu_li_3 ul, .menu_li_7 ul{
display:none!important;
}
.menu_li_6 ul {
margin-left:20px!important;
}
</style>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf733476($option=array(),$mn='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option ['list'][$mn->getCate()]->getChildren())){
    foreach( $option ['list'][$mn->getCate()]->getChildren() as $mnChil )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    <li><a href="{$mnChil->getCatUrl()}">{$mnChil->getTitle()}</a>
                        
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf733561($option=array(),$mn='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['obj_customers'][$mn->getId()])){
    foreach( $option['obj_customers'][$mn->getId()] as $page  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                            <li><a href="{$page->getUrl('customers')}"><span>{$page->getTitle()}</span></a></li>
                        
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf733619($option=array())
{
global $bw,$vsLang;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['menu'])){
    foreach( $option['menu'] as $mn )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
              <li class="menu_li_{$vsf_count}"><a  href="{$this->bw->base_url}{$mn->getUrl()}" class="{$mn->active}">{$mn->getTitle()}</a>
                <ul>
                <div class="bg_submenu"></div>
                    
EOF;
if($mn->getCate()&&$option ['list'][$mn->getCate()] ) {
$BWHTML .= <<<EOF

                    {$this->__foreach_loop__id_53f0adf733476($option,$mn)}
                        
EOF;
}

$BWHTML .= <<<EOF

                        
                        {$this->__foreach_loop__id_53f0adf733561($option,$mn)}
                        
                    </ul>
                </li>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getSocial:desc::trigger:>
//===========================================================================
function getSocial($option=array()) {global $bw;
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//echo $url;exit();
if($option=='home'){
$url=$bw->base_url;
}

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="wap_social">
<div class="google-plus"><g:plusone size="medium" href="{$url}"><g:plusone></div>
<div class="tweeter"><a data-url="{$url}" href="https://twitter.com/share" class="twitter-share-button"></a></div>
<div class="fb-like" data-href="{$url}" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
</div>
<style>
.wap_social div{
float:left;
}
</style>
<div id="fb-root"></div>
<script>
$(document).ready(function() {
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
po.src = 'https://apis.google.com/js/plusone.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
  
 !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs'); 
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getMenuBottom:desc::trigger:>
//===========================================================================
function getMenuBottom($option=array()) {global $bw,$vsLang;
$this->bw = $bw;
$vsLang = VSFactory::getLangs();

//--starthtml--//
$BWHTML .= <<<EOF
        <ul>
{$this->__foreach_loop__id_53f0adf733924($option)}
</ul>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf733924($option=array())
{
global $bw,$vsLang;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option ['menu'])){
    foreach( $option ['menu'] as $mn  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li><a class="{$mn->active}" href="{$this->bw->base_url}{$mn->url}">{$mn->getTitle()}</a></li>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getContact:desc::trigger:>
//===========================================================================
function getContact($option=array()) {//$option['contact']=Object::getObjModule("contacts","contacts",">0","",1);
require_once CORE_PATH.'contacts/pcontacts.php';
$pc=new pcontacts();
$category=VSFactory::getMenus()->getCategoryGroup('pcontacts');
$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
$pc->setCondition("status>-1 and catId in (94)");
//$pc->setOrder("`index`");
$option['obj']=$pc->getOneObjectsByCondition();

global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        {$option['obj']->getContent()}
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getAnalytic:desc::trigger:>
//===========================================================================
function getAnalytic($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <p>Đang truy cập:<span>{$this->numberFormat($option['online'])} | Tổng truy cập:{$this->numberFormat($option['total'])}</span></p>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getProductCategory:desc::trigger:>
//===========================================================================
function getProductCategory($option=array()) {global $bw;
$this->bw=$bw;
$option['_category_flower'] = VSFactory::getMenus()->extractNodeInTree ( 457, VSFactory::getMenus()->arrayTreeCategory );
$option['cate_flower']=$option['_category_flower']['category'];

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="sitebar_item cate_sitebar">
<div class="title_box "><h3>Hoa tươi </h3></div>
<ul id="menu">
{$this->__foreach_loop__id_53f0adf733cdd($option)}
</ul>
<div class="sitebar_bott"></div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf733c38($option=array(),$cate='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($cate->children)){
    foreach( $cate->children as $cate1  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<li><a href="{$this->bw->base_url}products/category/{$cate1->getSlugId()}"><span>{$cate1->getTitle()}</span></a></li>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf733cdd($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['cate_flower']->getChildren())){
    foreach( $option['cate_flower']->getChildren() as $cate  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<li><a href="{$this->bw->base_url}products/category/{$cate->getSlugId()}">{$cate->getTitle()}</a>

EOF;
if($cate->children) {
$BWHTML .= <<<EOF

<ul>
{$this->__foreach_loop__id_53f0adf733c38($option,$cate)}
</ul>

EOF;
}

$BWHTML .= <<<EOF

</li>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getServiceHome:desc::trigger:>
//===========================================================================
function getServiceHome($option=array()) {global $bw;
$this->bw=$bw;
$option ['category'] = VSFactory::getMenus ()->getCategoryGroup ( 'services' )->getChildren();

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="service_home">
    <div class="wrap_service_home">
        {$this->__foreach_loop__id_53f0adf733f93($option)}
            <div class="ser_bott"></div>
        </div>
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf733f93($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['category'])){
    foreach( $option['category'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <div class="service_item ser{$vsf_count}">
            <a href="{$this->bw->base_url}services/category/{$obj->getSlugId()}" class="im"></a>
                <a href="{$this->bw->base_url}services/category/{$obj->getSlugId()}" class="na">{$obj->getTitle()}</a>
            </div>
            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getNewsCategory:desc::trigger:>
//===========================================================================
function getNewsCategory($option=array()) {global $bw;
$this->bw=$bw;
$option ['category'] = VSFactory::getMenus ()->getCategoryGroup ( 'posts' )->getChildren();

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="news_sitebar cate_sitebar">
            <div class="title">Tin tức</div>
                <ul id="menu">
                {$this->__foreach_loop__id_53f0adf734150($option)}
                </ul>
            </div>
           <div class="clear"></div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf734150($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option ['category'])){
    foreach( $option ['category'] as $cat  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li><a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}">{$cat->getTitle()}</a></li>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getCustomerSitebar:desc::trigger:>
//===========================================================================
function getCustomerSitebar($option=array()) {global $bw;
$this->bw=$bw;
$option['customers']=Object::getObjModule('pages', 'customers', '>0', '', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="news_sitebar cate_sitebar">
            <div class="title">Hỗ trợ khách hàng</div>
                <ul id="menu">
                {$this->__foreach_loop__id_53f0adf7342f9($option)}
                </ul>
            </div>
           <div class="clear"></div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf7342f9($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option ['customers'])){
    foreach( $option ['customers'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li><a href="{$obj->getUrl('customers')}">{$obj->getTitle()}</a></li>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getServiceSitebar:desc::trigger:>
//===========================================================================
function getServiceSitebar($option=array()) {global $bw;
$this->bw=$bw;
$option ['category'] = VSFactory::getMenus ()->getCategoryGroup ( 'services' )->getChildren();

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="news_sitebar cate_sitebar">
            <div class="title">Dịch vụ</div>
                <ul id="menu">
                {$this->__foreach_loop__id_53f0adf734495($option)}
                </ul>
            </div>
           <div class="clear"></div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf734495($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option ['category'])){
    foreach( $option ['category'] as $cat  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <li><a href="{$this->bw->base_url}services/category/{$cat->getSlugId()}">{$cat->getTitle()}</a></li>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getNewsSitebar:desc::trigger:>
//===========================================================================
function getNewsSitebar($option=array()) {global $bw;
$this->bw=$bw;
$option['news']=Object::getObjModule('posts', 'posts', '=2', '2', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="news_sitebar ">
            <div class="title">Những bài viết gần đây</div>
                
                {$this->__foreach_loop__id_53f0adf73466f($option)}
                <a class="viewall" href="{$bw->base_url}posts">Xem tất cả...</a>
                <div class="clear"></div>
                
            </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf73466f($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['news'])){
    foreach( $option['news'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <div class="news_home_item">
                    <div class="na"><a href="{$obj->getUrl('posts')}">{$obj->getTitle()}<span> [{$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}]</span></a></div>
                    <div class="intro">{$this->cut($obj->getIntro(),100)}</div>
                        
                    
                    <a class="detail" href="{$obj->getUrl('posts')}">Chi tiết</a>
                    <div class="clear"></div>
                </div>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getNewsHome:desc::trigger:>
//===========================================================================
function getNewsHome($option=array()) {global $bw;
$this->bw=$bw;
$option['news']=Object::getObjModule('posts', 'posts', '=2', '2', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="box_item">
            <div class="title">Những bài viết gần đây</div>
                
                {$this->__foreach_loop__id_53f0adf734855($option)}
                <a href="{$bw->base_url}posts" class="viewall">Xem tất cả...</a>
                <div class="clear"></div>
            </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf734855($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['news'])){
    foreach( $option['news'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <div class="news_home_item">
                    <div class="na"><a href="{$obj->getUrl('posts')}">{$obj->getTitle()}<span> [{$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}]</span></a></div>
                    <div class="intro">{$this->cut($obj->getIntro(),170)}</div>
                        
                    
                    <a class="detail" href="{$obj->getUrl('posts')}">Chi tiết</a>
                    <div class="clear"></div>
                </div>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getVideoHome:desc::trigger:>
//===========================================================================
function getVideoHome($option=array()) {global $bw;
$this->bw=$bw;
$option['video']=Object::getObjModule('videos', 'videos', '>0', '', '1');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="box_item ">
            <div class="title">Video clip</div>
                <div class="video_center">
                <iframe width="315" height="300" 
            src="http://www.youtube.com/embed/{$option['video']->getcode()}" 
        frameborder="0" allowfullscreen>
        </iframe>
                </div>
               <!-- <a href="" class="viewall">Xem tất cả...</a>-->
                <div class="clear"></div>
            </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getProjectHome:desc::trigger:>
//===========================================================================
function getProjectHome($option=array()) {global $bw;
$this->bw=$bw;
$option['project']=Object::getObjModule('pages', 'projects', '=2', '3', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="title_block2">Hình ảnh dự án</div>
            {$this->__foreach_loop__id_53f0adf734abf($option)}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf734abf($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['project'])){
    foreach( $option['project'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            <div class="pro_item">
            <div class="im"><a href="{$obj->getUrl('projects')}">{$obj->createImageCache($obj->getImage(),341,208)}</a></div>
                <div class="na"><a href="{$obj->getUrl('projects')}">{$obj->getTitle()}</a></div>
                <div class="intro">
{$this->cut($obj->getContent(),140)}
                </div>
                <a href="{$obj->getUrl('projects')}" class="detail">Chi tiết</a>
            </div>
            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getAdsSitebar:desc::trigger:>
//===========================================================================
function getAdsSitebar($option=array()) {global $bw;
$this->bw=$bw;
$option['news']=Object::getObjModule('pages', 'ads', '>0', '', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="ads_sitebar">
              {$this->__foreach_loop__id_53f0adf734c3d($option)}
                
             </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf734c3d($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['news'])){
    foreach( $option['news'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
              <a href="{$obj->getCode()}">{$obj->createImageCache($obj->getImage(),304,93)}</a>
              
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getSearchHome:desc::trigger:>
//===========================================================================
function getSearchHome($option=array()) {global $bw;
$this->bw=$bw;
$option['video']=Object::getObjModule('videos', 'videos', '>0', '', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="box_item search_box">
            <div class="im"><img src="{$bw->vars['img_url']}/im_search.png"  /></div>
                <div class="title_search">Tìm kiếm</div>
                <div class="form_search">
                <form name="search_product" method="get" action="{$bw->base_url}projects/search" >
                    <p class="provin_title">Thành phố/tỉnh</p>
                        <p class="dis_title">Quận/huyện</p>
                    <input name="provin" class="provinces" type="text" />
                        <input name="dis" class="dis" type="text" />
                        <input class="submit_searchHome" type="submit" value="Tìm"  />
                        <div class="clear"></div>
                    </form>
                </div>
            </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getSearchSitebar:desc::trigger:>
//===========================================================================
function getSearchSitebar($option=array()) {global $bw;
$this->bw=$bw;
$option['news']=Object::getObjModule('pages', 'ads', '>0', '', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="search_sitebar">
            <div class="title_searchBar">Tìm kiếm</div>
                <form name="search_product" method="get" action="{$bw->base_url}projects/search" >
                    <p class="provin_title">Thành phố/tỉnh</p>
                        <p class="dis_title">Quận/huyện</p>
                    <input name="provin" class="provinces" type="text" />
                        <input name="dis" class="dis" type="text" />
                        <input class="submit_searchHome" type="submit" value="Tìm"  />
                        <div class="clear"></div>
                    </form>
              </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getContactFooter:desc::trigger:>
//===========================================================================
function getContactFooter($option=array()) {require_once CORE_PATH.'contacts/pcontacts.php';
$pc=new pcontacts();
$category=VSFactory::getMenus()->getCategoryGroup('pcontacts');
$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
$pc->setCondition("status>-1 and catId in (94)");
//$pc->setOrder("`index`");
$option['obj']=$pc->getOneObjectsByCondition();

global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        {$option['obj']->getContent()}
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getSupport:desc::trigger:>
//===========================================================================
function getSupport($option=array()) {global $bw;
$this->bw=$bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="sitebar_item support_sitebar">
<div class="support_sitebar_title"><h3>Hỗ trợ trực tuyến</h3></div>
{$this->__foreach_loop__id_53f0adf734f9b($option)}
<div class="line"></div>
<div class="sitebar_bott"></div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf734f9b($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['support'])){
    foreach( $option['support'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class="yahoo">{$obj->getTitle()}:</br>
<a href="ymsgr:sendIM?{$obj->getYahoo()}"><img src="{$bw->vars['img_url']}/yahoo_online.png"  /></a>
<a href="{$obj->getSkype()}?chat"><img src="{$bw->vars['img_url']}/sky.png"  /></a>
<a>({$obj->getPhone()})</a>
</div>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getCustomerBlock:desc::trigger:>
//===========================================================================
function getCustomerBlock($option=array()) {global $bw;
$this->bw=$bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="sitebar_item partner_sitebar">
<div class="title_box "><h3>Khách hàng</h3></div>
<div class="clear"></div>
{$this->__foreach_loop__id_53f0adf73512e($option)}
<div class="sitebar_bott"></div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53f0adf73512e($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['cus'])){
    foreach( $option['cus'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<a href="{$obj->getCode()}">{$obj->createImageCache($obj->getImage(),103,80,0,0)}</a>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


}
?>