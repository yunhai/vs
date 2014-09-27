<?php
if(!class_exists('skin_board_public'))
require_once ('./cache/skins/user/finance/skin_board_public.php');
class skin_addon extends skin_board_public {

//===========================================================================
// <vsf:getMenuTop:desc::trigger:>
//===========================================================================
function getMenuTop($option=array()) {global $bw,$vsLang;
$this->bw = $bw;
$vsLang = VSFactory::getLangs();
$this->flag = false;
if(VSFactory::getUsers()->basicObject->getId()){
   foreach($option['menu'] as $key => $menu) {
       if($menu->getAlt() == 'users_login' || $menu->getAlt() == 'users_registry')
           unset($option['menu'][$key]);
       $this->flag = true;
   } 
}

//--starthtml--//
$BWHTML .= <<<EOF
        <ul class="nav navbar-nav navbar-right">
            {$this->__foreach_loop__id_542434a2610b1($option)}
            
EOF;
if( $this->flag ) {
$BWHTML .= <<<EOF

                <li class='current-user'>
                    <a href="javascript:;">
                        Chào <span class='username'>{$this->getUser()->basicObject->getFullName()}</span> 
                    </a>
                </li>
                <li class="logout">
                    <a href="{$this->bw->base_url}users/logout" title='{$this->getLang()->getWords('global_logout', 'Thoát')}'>
                        {$this->getLang()->getWords('global_logout', 'Thoát')}
                    </a>
                </li>
            
EOF;
}

$BWHTML .= <<<EOF

          </ul>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_542434a2610b1($option=array())
{
global $bw,$vsLang;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array( $option['menu'])){
    foreach(  $option['menu'] as $menu  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                
EOF;
if( $menu->getAlt() == 'users_login' ) {
$BWHTML .= <<<EOF

                    <li class='dropdown login-form'>
                        <a href="javascript:;" class="dropdown-toggle user_login" data-toggle="dropdown">Đăng nhập &nbsp;</a>
                        <ul class="dropdown-menu" role="menu">
                        <li>
                           {$this->getLoginForm()}
                        </li>
                        </ul>
                    </li>
                
EOF;
}

else {
$BWHTML .= <<<EOF

                    <li class='li-{$menu->getAlt()}'>
                        <a href="{$menu->getUrl(false)}" class='menu-item {$menu->getAlt()} {$menu->getClassActive()}' title='{$menu->getTitle()}'>
                            {$menu->getTitle()}
                        </a>
                    </li>
                
EOF;
}
$BWHTML .= <<<EOF

            
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getHeader:desc::trigger:>
//===========================================================================
function getHeader($option=array()) {    global $bw, $vsStd, $vsLang;
    $vsStd->requireFile(CORE_PATH."banners/banners.php");
    $model = new banners();
    $option['news'] = $model->getByPosition('BANNER_TOP');
    
    $option['news'] = array_merge($option['news'], $option['news'], $option['news'],$option['news']);
    $this->index = 0;
    
    
//--starthtml--//
$BWHTML .= <<<EOF
        <div class="col-md-12 top-sub-header no-padding">
            <div class='col-md-5 top-sub-header-left no-padding'>
                <a class='branch-name' href='{$bw->base_url}' title='{$this->getSettings()->getSystemKey('global_websitename', 'All nail', 'global')}'>
                    <img alt='logo' src="{$bw->vars['img_url']}/logo.png" />
                    
                    <h1 class='websitename'>{$this->getSettings()->getSystemKey('global_websitename', 'All nail', 'global')}</h1>
                    <span class='slogan'>{$this->getSettings()->getSystemKey('configs_slogan', 'slogan here!', 'configs')}</span>
                <div class='clear'></div>
                </a>
            <form class='search' name="search" method="get" action="{$bw->base_url}posts/search" >
                <input class="input col-md-9" type="input" placeholder="{$vsLang->getWords('global_search', 'Tìm theo tên địa điểm, danh mục')}" name='keywords' />
                    <input class="submit" type="submit" value="Tìm" placeholder="{$vsLang->getWords('global_search', 'Tìm theo tên địa điểm, danh mục')}" />
                    <div class="clear"></div>
                </form>
            </div>
            
            <div class="col-md-7 carousel top-banner slide" data-type="multi" data-interval="3000" >
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    {$this->__foreach_loop__id_542434a2613f0($option)}
                  </div>
            </div>
            <div class='clear'></div>
            <script>
                $('.carousel[data-type="multi"] .item').each(function(){
                  var next = $(this).next();
                  if (!next.length) {
                    next = $(this).siblings(':first');
                  }
                  next.children(':first-child').clone().appendTo($(this));
                  
                  for (var i=0; i<2; i++) {
                    next=next.next();
                    if (!next.length) {
                    next = $(this).siblings(':first');
                  }
                    
                    next.children(':first-child').clone().appendTo($(this));
                  }
                });
                                              
                $('.carousel').carousel({
                  interval: 5000,
                  wrap: true
                });
            </script>
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_542434a2613f0($option=array())
{
    global $bw, $vsStd, $vsLang;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['news'])){
    foreach( $option['news'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    <div class="item 
EOF;
if( $this->index++ == 0) {
$BWHTML .= <<<EOF
active
EOF;
}

$BWHTML .= <<<EOF
">
                        {$obj->createImageCache($obj->getImage(),280, 150)}
                    </div>
                    
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getSideBar:desc::trigger:>
//===========================================================================
function getSideBar($option="") {        global $vsStd;
         
        $vsStd->requireFile(CORE_PATH."banners/banners.php");
        $model = new banners();
    
        $option['banner'] = $model->getByPosition('BANNER_RIGHT');
        
//--starthtml--//
$BWHTML .= <<<EOF
        <div class='sidebar'>
    <div class='header'>
           {$this->getLang()->getWords('global_sidebar_ad', 'Quảng cáo')}
    </div>
          {$this->__foreach_loop__id_542434a261649($option)}
         </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_542434a261649($option="")
{
        global $vsStd;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['banner'])){
    foreach( $option['banner'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
           {$obj->createImageCache($obj->getImage(),195, 132, 1)}
          
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:getLoginForm:desc::trigger:>
//===========================================================================
function getLoginForm($option=array()) {    global $bw,$vsLang;
    $session = $_COOKIE['remember_me'];
    
    
//--starthtml--//
$BWHTML .= <<<EOF
        <div class='form-container'>
                <span class='title'>{$this->getLang()->getWords('global_login', 'Đăng nhập vào tài khoản')}</span>
            <form class="form-horizontal" role="form" method='post' action='{$bw->base_url}users/do_login'>
                  <div class="form-group">
                    <label class="col-md-4 control-label">{$this->getLang()->getWords('global_login_form_phone', 'Số phone:')}</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name='users[name]' value='{$session}' />
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-4 control-label">
                        {$this->getLang()->getWords('global_login_form_password', 'Mật khẩu:')}
                    </label>
                    <div class="col-md-8">
                      <input type="password" class="form-control" name='users[password]'>
                    </div>
                  </div> 
                  
                  <div class="form-group">
                    <div class="col-md-12">
                      <button type="submit" class="pull-right nail-button">{$this->getLang()->getWords('global_login_form_login', 'Đăng nhập')}</button>
                      <div class='remember-me pull-right'>
                        <input type='checkbox' name='users[rememberme]' class='remember-me-check' value='1' 
EOF;
if( isset($_COOKIE['remember_me']) ) {
$BWHTML .= <<<EOF
checked
EOF;
}

$BWHTML .= <<<EOF
 />&nbsp;
                        <span class='remember-me-title'>{$this->getLang()->getWords('global_login_form_remember_me', 'Nhớ tài khoản')}</span><br/>
                        <a href='{$bw->base_url}/users/forgot_password'>{$this->getLang()->getWords('global_login_form_forget_password', 'Quên mật khẩu?')}</a>
                      </div>
                    </div>
                  </div>
                </form>
      </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getSupport:desc::trigger:>
//===========================================================================
function getSupport($option=array()) {    global $bw;
    
//--starthtml--//
$BWHTML .= <<<EOF
        <div class='support-portlet'>
{$this->__foreach_loop__id_542434a2619cc($option)}
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_542434a2619cc($option=array())
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
        
<div class='item'>
     <div class='support-title'>{$obj->getTitle()}</div>
     <div class='support-icon'>
         <a href='ymsgr:sendIM?{$obj->getYahoo()}'><img src='{$bw->vars['img_url']}/yahoo.jpg' alt='yahoo icon' /></a>
     <a href='skype:{$obj->getSkype()}?chat'><img src='{$bw->vars['img_url']}/skype.jpg' alt='skype icon' /></a>
     </div>
     <div class='support-phone'>Tel: {$obj->getPhone()}</div>
             <div class='clear'></div>
</div>

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
{$this->__foreach_loop__id_542434a261c2f($option)}
</ul>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_542434a261c2f($option=array())
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
{$this->__foreach_loop__id_542434a261faf($option)}
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
function __foreach_loop__id_542434a261f0c($option=array(),$cate='')
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
function __foreach_loop__id_542434a261faf($option=array())
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
{$this->__foreach_loop__id_542434a261f0c($option,$cate)}
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
        {$this->__foreach_loop__id_542434a2621f0($option)}
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
function __foreach_loop__id_542434a2621f0($option=array())
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
                {$this->__foreach_loop__id_542434a262383($option)}
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
function __foreach_loop__id_542434a262383($option=array())
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
                {$this->__foreach_loop__id_542434a262551($option)}
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
function __foreach_loop__id_542434a262551($option=array())
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
                {$this->__foreach_loop__id_542434a2626dc($option)}
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
function __foreach_loop__id_542434a2626dc($option=array())
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
                
                {$this->__foreach_loop__id_542434a2628d8($option)}
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
function __foreach_loop__id_542434a2628d8($option=array())
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
                
                {$this->__foreach_loop__id_542434a262aa8($option)}
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
function __foreach_loop__id_542434a262aa8($option=array())
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
            {$this->__foreach_loop__id_542434a262d2a($option)}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_542434a262d2a($option=array())
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
$option['news']=Object::getObjModule('pages', 'banners', '>0', '', '');
$option['ads']=Object::getObjModule('banners', 'banners', '>0', '', '');

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="ads_sitebar">
              {$this->__foreach_loop__id_542434a262eb4($option)}
                
             </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_542434a262eb4($option=array())
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
// <vsf:getCustomerBlock:desc::trigger:>
//===========================================================================
function getCustomerBlock($option=array()) {global $bw;
$this->bw=$bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="sitebar_item partner_sitebar">
<div class="title_box "><h3>Khách hàng</h3></div>
<div class="clear"></div>
{$this->__foreach_loop__id_542434a26321c($option)}
<div class="sitebar_bott"></div>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_542434a26321c($option=array())
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