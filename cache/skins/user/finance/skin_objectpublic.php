<?php
class skin_objectpublic{

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw,$vsLang,$vsPrint,$vsTemplate,$class_def;


//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
    <div class="main_title">
        <h1 class="{$class_def}">{$vsLang->getWords('pageTitle','Địa chỉ')}</h1>
            
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
        
       <div id="center" class="tintuc">
            
EOF;
if($option['pageList']) {
$BWHTML .= <<<EOF
        
            {$this->__foreach_loop__id_4f2f8b28dd09b($option)}
            
EOF;
}

else {
$BWHTML .= <<<EOF

                {$vsLang->getWords('global_dataupdate1','Nội dung đang trong quá trình cập nhật. Quý khách vui lòng quay lai sau. Xin cảm ơn!')}
            
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
function __foreach_loop__id_4f2f8b28dd09b($option=array())
{
global $bw,$vsLang,$vsPrint,$vsTemplate,$class_def;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['pageList'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
                
                <div class="news_item">
                    <h3><a href="{$obj->getUrl($bw->input['module'])}">{$obj->getTitle()} <span>{$obj->getPostDate('SHORT')}</span></a></h3>
                    
EOF;
if($obj->file) {
$BWHTML .= <<<EOF

                        <a href="{$obj->getUrl($bw->input['module'])}" class="news_img">
                            {$obj->createImageCache($obj->file,145,101,1)}
                        </a>
                    
EOF;
}

$BWHTML .= <<<EOF

                    <div>{$obj->getIntro()}</div>
                    <div class="clear_right"></div>
                </div>
            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option="") {global $bw,$vsLang,$vsPrint,$vsTemplate,$class_def;
       

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
    <div class="main_title">
        <h3 class="{$obj->getPicon()}">{$vsLang->getWords('pageTitle','Địa chỉ')}</h3>
        </div>
<div class="tintuc detail" id="center">
       <h1 class="tintuc_title">{$obj->getTitle()} 
EOF;
if($bw->input['module']==news) {
$BWHTML .= <<<EOF
<span>{$obj->getPostDate('SHORT')}</span>
EOF;
}

$BWHTML .= <<<EOF
</h1>
                {$obj->getContent()}
                <div class="clear_left"></div>
              
                
EOF;
if($option['other']) {
$BWHTML .= <<<EOF

                <h3 class="tintuc_title">{$vsLang->getWords("cactinkhac2","CÁC TIN KHÁC")}</h3>
                    <div class="other">
                        {$this->__foreach_loop__id_4f2f8b28dd616($obj,$option)}
                    </div>
                
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
function __foreach_loop__id_4f2f8b28dd616($obj="",$option="")
{
global $bw,$vsLang,$vsPrint,$vsTemplate,$class_def;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['other'] as $other )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <a href="{$other->getUrl($bw->input['module'])}">{$other->getTitle()}</a>
                             
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showImage:desc::trigger:>
//===========================================================================
function showImage($obj="",$option=array()) {global $bw,$vsLang,$vsPrint,$vsTemplate,$vsMenu;
               

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
    <div class="main_title" id="main_title">
        <h3 class="main_title_gallery2">{$vsLang->getWords('pageTitle','Địa chỉ')}</h3>
              
        </div>
        
        <div class="gallery">
                
EOF;
if($option['img']) {
$BWHTML .= <<<EOF

                    <ul class="paging">
                    {$this->__foreach_loop__id_4f2f8b28ddaba($obj,$option)}
                    </ul>    
                
EOF;
}

$BWHTML .= <<<EOF

            <div class="clear_left"></div>
        </div>
                
      
EOF;
if($obj->GetContent()) {
$BWHTML .= <<<EOF
          
        <div class="main_title"><h3 class="main_title_gallery">Video</h3></div>
        {$obj->GetContent()}
      
EOF;
}

$BWHTML .= <<<EOF
     
    </div>
    <script>
    $(document).ready(function(){
    $("ul.paging").quickPager();
    });
    </script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2f8b28ddaba($obj="",$option=array())
{
global $bw,$vsLang,$vsPrint,$vsTemplate,$vsMenu;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['img'] as $img )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <li>
                            <a href="{$img->getCacheImagePathByFile($img,1,1,1,1)}" class="highslide" onclick="return hs.expand(this)">{$img->createImageCache($img, 149, 148, 1)}</a>
                        </li>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>