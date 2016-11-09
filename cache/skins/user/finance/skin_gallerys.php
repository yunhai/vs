<?php
class skin_gallerys{

//===========================================================================
// <vsf:showDetail:desc::trigger:>
//===========================================================================
function showDetail($obj="",$option=array()) {global $bw,$vsLang,$vsPrint,$vsTemplate,$vsMenu;
               

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
    <div class="main_title">
        <h3 class="main_title_gallery2">{$vsLang->getWords('pageTitle','Địa chỉ')}</h3>
              
        </div>
        
        <div class="gallery">
                
EOF;
if($option['img']) {
$BWHTML .= <<<EOF

                    {$this->__foreach_loop__id_4f2f52e0c2683($obj,$option)}
                
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
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2f52e0c2683($obj="",$option=array())
{
global $bw,$vsLang,$vsPrint,$vsTemplate,$vsMenu;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['img'] as $img )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <a href="{$img->getCacheImagePathByFile($img,1,1,1,1)}" class="highslide" onclick="return hs.expand(this)">{$img->createImageCache($img, 149, 148, 1)}</a>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw,$vsLang,$vsPrint,$vsTemplate,$vsMenu;
                

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
    <div class="main_title">
        <h3 class="main_title_gallery">{$vsLang->getWords('pageTitle','Địa chỉ')}</h3>            
        </div>
        <div class="gallery_dangnhap">
        
EOF;
if($option['page']) {
$BWHTML .= <<<EOF

                    {$option['page']->getContent()}
                
EOF;
}

$BWHTML .= <<<EOF

            <form>
            <label>{$vsLang->getWords('pagetendangnhap','Tên đăng nhập')}: </label>
                <input type="text" id="contactName">
                <input type="button" value="ĐĂNG NHẬP" id="id_gallery_btn" class="gallery_btn">
                <div class="clear"></div>
            </form>
        </div>
    </div>
    <script>
    $(document).ready(function(){
    $('#id_gallery_btn').click(function(){
        if(!$('#contactName').val()) {
                jAlert('{$vsLang->getWords('err_contact_album','Nhập tên Album mà bạn cần tìm!')}','{$bw->vars['global_websitename']} Dialog');
                $('#contactName').addClass('vs-error');
                $('#contactName').focus();
                return false;
        }
        window.location.href="{$bw->vars['board_url']}/{$bw->input['module']}/searchs/"+$('#contactName').val();
    });
});
    </script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:showSearch:desc::trigger:>
//===========================================================================
function showSearch($option=array()) {global $bw,$vsLang,$vsPrint,$vsTemplate,$vsMenu;
                $this->cate = $vsMenu->getCategoryGroup($bw->input['module'])->getChildren();

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
    <div class="main_title">
        <h3 class="main_title_gallery2">{$vsLang->getWords('pageTitle','Địa chỉ')}</h3>
           
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
        
        <div class="gallery">
        
EOF;
if($option['pageList']) {
$BWHTML .= <<<EOF

                    {$this->__foreach_loop__id_4f2f52e0c2c57($option)}
                    
EOF;
}

else {
$BWHTML .= <<<EOF

                    {$vsLang->getWords('gloabal_no_album','Không tìm thấy album bạn cần!')}
                
EOF;
}
$BWHTML .= <<<EOF

            <div class="clear_left"></div>
        </div>
       
       
       
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f2f52e0c2c57($option=array())
{
global $bw,$vsLang,$vsPrint,$vsTemplate,$vsMenu;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $option['pageList'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <a href="{$obj->getUrl($bw->input['module'])}">{$obj->createImageCache($obj->file, 149, 148, 1)}</a>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>