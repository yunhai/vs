<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_posts extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {        global $bw;
    
        $this->bw = $bw;
    
        
//--starthtml--//
$BWHTML .= <<<EOF
        <div class='col-md-12'>
            <ul class="nav nav-tabs" role="tablist">
                {$this->__foreach_loop__id_54073e5aa088d($option)}
            </ul>
                
            <div class='content'>
                <div class='sub-header'>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    {$this->__foreach_loop__id_54073e5aa0a83($option)}
                    
                </div>
            </div>
            <script>
                $('a[data-toggle="tab"]').on('click', function (e) {
                    window.location.href = $(e.target).attr("href");
                    console.log($(e.target).attr("href"));
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
function __foreach_loop__id_54073e5aa088d($option=array())
{
        global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array( $option['cate'])){
    foreach(  $option['cate'] as $key=>$cat )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    <li id='{$key}' 
EOF;
if($key == $option['category']->getId() ) {
$BWHTML .= <<<EOF
class='active'
EOF;
}

$BWHTML .= <<<EOF
>
                        <a href="{$cat->getUrlCategory()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_54073e5aa09dd($option=array(),$key='',$cat='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option[$key]['pageList'])){
    foreach( $option[$key]['pageList'] as $obj  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                                <div class='{$this->bw->input[0]}-item col-md-6'>
                                    <div class='pull-left' style='margin-right: 10px;'>
                                        {$obj->createImageCache($obj->getImage(), 128, 130)}
                                    </div>
                                    <div class='title'>
                                        <a href='{$obj->getUrl('posts')}' title='{$obj->getTitle()}'>{$obj->getTitle()}</a>
                                    </div>
                                    <div class='title'>Paradise Nail & Spa,  San Francisco, California, USA </div>
                                    <div class='intro'>{$obj->getIntro()}</div>
                                    <div class='clear'></div>
                                </div>
                                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_54073e5aa0a83($option=array())
{
        global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array( $option['cate'])){
    foreach(  $option['cate'] as $key => $cat )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <div class="tab-pane 
EOF;
if( !empty($option[$key]) ) {
$BWHTML .= <<<EOF
active
EOF;
}

$BWHTML .= <<<EOF
" id="tab{$key}" ref="{$key}">
                            
EOF;
if( !empty($option[$key]) ) {
$BWHTML .= <<<EOF

                                {$this->__foreach_loop__id_54073e5aa09dd($option,$key,$cat)}
                                <div class='clear'></div>
                                
EOF;
if( $option[$key]['paging'] ) {
$BWHTML .= <<<EOF

                                    <div class='paging pager'>
                                        {$option[$key]['paging']}
                                    </div>
                                
EOF;
}

$BWHTML .= <<<EOF

            
                                
EOF;
if( count($option[$key]['pageList']) == 0) {
$BWHTML .= <<<EOF

                                    {$this->getLang()->getWords('faq_empty', 'Hiện thời danh mục chưa có bài viết.')}
                                
EOF;
}

$BWHTML .= <<<EOF

                            
EOF;
}

$BWHTML .= <<<EOF

                        </div>
                    
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:showForm:desc::trigger:>
//===========================================================================
function showForm($option=array()) {        global $bw;
    
        $this->bw = $bw;
    
        
//--starthtml--//
$BWHTML .= <<<EOF
        <div class='col-md-9'>
            <ul class="nav nav-tabs" role="tablist">
                {$this->__foreach_loop__id_54073e5aa0d9c($option)}
            </ul>
    
            <div class='content'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('post_header', 'Đăng quảng cáo')}</span>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    {$this->__foreach_loop__id_54073e5aa0eaf($option)}
                </div>
            </div>
            <script>
                $('a[data-toggle="tab"]').on('click', function (e) {
                    window.location.href = $(e.target).attr("href");
                    console.log($(e.target).attr("href"));
                });
            </script>
</div>
        {$this->getAddon()->getSidebar()}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_54073e5aa0d9c($option=array())
{
        global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array( $option['cate'])){
    foreach(  $option['cate'] as $key=>$cat )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    <li id='{$key}' 
EOF;
if($key == $option['category']->getId() ) {
$BWHTML .= <<<EOF
class='active'
EOF;
}

$BWHTML .= <<<EOF
>
                        <a href="{$this->bw->base_url}faq/form/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_54073e5aa0eaf($option=array())
{
        global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array( $option['cate'])){
    foreach(  $option['cate'] as $key => $cat )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <div class="tab-pane 
EOF;
if( !empty($option[$key]) ) {
$BWHTML .= <<<EOF
active
EOF;
}

$BWHTML .= <<<EOF
" id="tab{$key}" ref="{$key}">
                            
EOF;
if( !empty($option[$key]) ) {
$BWHTML .= <<<EOF

                                <form class="form-horizontal" role="form" method='post' action='{$this->bw->base_url}posts/submit/{$cat->getSlugId()}'>
                                  <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">
                                        {$this->getLang()->getWords('faq_form_fullname', 'Họ tên')}
                                    </label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('faq_form_fullname', 'Họ tên')}" name='{$this->modelName}[fullname]'>
                                    </div>
                                  </div>  
                                  <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">{$this->getLang()->getWords('faq_form_phone', 'Điện thoại')}</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('post_form_intro', 'Mô tả')}" name='{$this->modelName}[intro]'>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                      <input type="email" class="form-control" placeholder="Email" name='{$this->modelName}[email]' value=''>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">{$this->getLang()->getWords('post_form_detail', 'Nội dung chi tiết')} (<span class='required'>*</span>)</label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" rows="3" name='{$this->modelName}[content]'></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-default">{$this->getLang()->getWords('faq_form_submit', 'Gửi')}</button>
                                      <button type="reset" class="btn btn-default">{$this->getLang()->getWords('faq_form_reset', 'Làm lại')}</button>  
                                      <lable><span class='require'>*</span>{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
                                    </div>
                                  </div>
                                </form>
                            
EOF;
}

$BWHTML .= <<<EOF

                        </div>
                    
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


}
?>