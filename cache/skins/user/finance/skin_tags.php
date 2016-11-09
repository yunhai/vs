<?php
class skin_tags{

//===========================================================================
// <vsf:loadDefault:desc::trigger:>
//===========================================================================
function loadDefault($option=array()) {global $vsLang, $bw, $vsTemplate;
          

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="center_page">
   <h1 class="main_title">
<a href="{$bw->vars['board_url']}" itemprop="url" itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""><span itemprop="title">Trang chủ</span></a>
   </h1>
   <div class="tintuc_detail" style="border:none;">
   <h3>Từ khóa</h3>
   <div class="tag_list">
   {$this->__foreach_loop__id_4f95032426b75($option)}
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
function __foreach_loop__id_4f95032426b75($option=array())
{
global $vsLang, $bw, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['tag_list'] as $tag )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<a style="font-size:{$tag->size}px;" href="{$tag->getUrl(true)}" rel="20"> {$tag->getText()}</a>


EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:listObject:desc::trigger:>
//===========================================================================
function listObject($result="") {global $vsLang,$bw, $vsSettings;
$this->bw=$bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="center_page">
   <h1 class="main_title">
<a href="{$bw->vars['board_url']}" itemprop="url" itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""><span itemprop="title">Trang chủ</span></a>
/ <a href="{$bw->vars['board_url']}/tags/" itemprop="url" itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""><span itemprop="title">Từ khóa</span></a>
   </h1>
   <div class="product_page">
            <h1 class="tag_title">Từ khóa "{$result['obj']->getText()}"</h1>
<h2 class="tag_title">Sản phẩm liên quan từ khóa "{$result['obj']->getText()}"</h2>

                
EOF;
if($result['product']['pageList']) {
$BWHTML .= <<<EOF

                {$this->__foreach_loop__id_4f95032426cb9($result)}
 
EOF;
}

else {
$BWHTML .= <<<EOF


EOF;
if(!$newObject) {
$BWHTML .= <<<EOF

                    {$vsLang->getWords('tags_not_found','Không tìm thấy kết quả nào')}

EOF;
}

$BWHTML .= <<<EOF

                
EOF;
}
$BWHTML .= <<<EOF

            <div class="clear_left"></div>
 </div>
                       

  
<div class="tintuc_page">
<h3 class="other_h3">Bài viết liên quan từ khóa "{$result['obj']->getText()}"</h3>

EOF;
if($result['news']['pageList']) {
$BWHTML .= <<<EOF

                {$this->__foreach_loop__id_4f95032426d58($result)}

       
EOF;
}

$BWHTML .= <<<EOF

        </div>
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f95032426cb9($result="")
{
global $vsLang,$bw, $vsSettings;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $result['product']['pageList'] as $pro )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<div class="product_item">
        
EOF;
if($pro->file) {
$BWHTML .= <<<EOF

        <a href="{$pro->getUrl("products")}" title="{$pro->getTitle()}" class="product_img">{$pro->createImageCache($pro->file,148,159,2)}</a>
        
EOF;
}

$BWHTML .= <<<EOF

            <h3><a href="{$pro->getUrl("products")}" title="{$pro->getTitle()}">{$pro->getTitle()}</a></h3>
              <p class="price">{$vsLang->getWords('products_price','Giá')} : <span>{$pro->getPrice()}</span> {$vsLang->getWordsGlobal("global_unit","VNĐ")}</p>
        </div>
                
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f95032426d58($result="")
{
global $vsLang,$bw, $vsSettings;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $result['news']['pageList'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        

<div class="news_item">
        
EOF;
if($obj->file) {
$BWHTML .= <<<EOF

        <a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}" class="news_img">{$obj->createImageCache($obj->file,117,74,2)}</a>
        
EOF;
}

$BWHTML .= <<<EOF

            <h3><a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}">{$obj->getTitle()} 
EOF;
if($bw->input['module']=='news') {
$BWHTML .= <<<EOF
<span>- [{$obj->getPostDate(SHORT)}]</span>
EOF;
}

$BWHTML .= <<<EOF
</a></h3>
              <p class="news_intro">{$obj->getIntro(300)} </p>
               <div class="clear_left"></div>
        </div>
                
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>