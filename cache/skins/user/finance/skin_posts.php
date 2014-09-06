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
                {$this->__foreach_loop__id_540b39dd126f6($option)}
            </ul>
                
            <div class='content'>
                <div class='sub-header'>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    {$this->__foreach_loop__id_540b39dd128df($option)}
                    
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
function __foreach_loop__id_540b39dd126f6($option=array())
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
function __foreach_loop__id_540b39dd12842($option=array(),$key='',$cat='')
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
function __foreach_loop__id_540b39dd128df($option=array())
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

                                {$this->__foreach_loop__id_540b39dd12842($option,$key,$cat)}
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
    //<if=" $key == {$option['obj']->getCatId()}">selected</if>
        
//--starthtml--//
$BWHTML .= <<<EOF
        <div class='col-md-9'>
            <ul class="nav nav-tabs" role="tablist">
                {$this->__foreach_loop__id_540b39dd12e14($option)}
            </ul>
    
            <div class='content'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('post_header', 'Đăng quảng cáo')}</span>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    {$this->__foreach_loop__id_540b39dd13174($option)}
                </div>
            </div>
            <script>
                $('a[data-toggle="tab"]').on('click', function (e) {
                    window.location.href = $(e.target).attr("href");
                });
                
                var current = {$option['current']};
                var json = {$option['json']};
                console.log(json);
                $('#state').change(function(){
                    var city = '';
                    $('#city').html(city);
                    
                    var state = $('#state').val();
                    for(var i in json[state]['children']) {
                        city += "<option value='"+i+"'>"+json[state]['children'][i]['name']+"</option>";
                    }
                    $('#city').html(city);
                });
            </script>
            
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="col-sm-3">
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
        </td>
        <td>
            <span class="preview"></span>
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td class="col-sm-3">
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <!--
                <input type="checkbox" name="delete" value="1" class="toggle">
                -->
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
        <td>
            <input type='hidden' name='{%=file.item_name%}[{%=file.id%}]' value='{%=file.id%}' />
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
                {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
            </span>
        </td>
    </tr>
{% } %}
</script>
<script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/vendor/jquery.ui.widget.js'></script>
<script type="text/javascript" src='http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js'></script>
<script type="text/javascript" src='http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js'></script>
<script type="text/javascript" src='http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js'></script>
<script type="text/javascript" src='http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js'></script>
<script type="text/javascript" src="{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.iframe-transport.js"></script>
<script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.fileupload.js'></script>
        
<script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.fileupload-process.js'></script>
        
<script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.fileupload-image.js'></script>
        
<script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.fileupload-audio.js'></script>
        
<script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.fileupload-video.js'></script>
        
<script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.fileupload-validate.js'></script>
        
<script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.fileupload-ui.js'></script>
        
<script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/main.js'></script>

</div>
        {$this->getAddon()->getSidebar()}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_540b39dd12e14($option=array())
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
function __foreach_loop__id_540b39dd12f69($option=array(),$key='',$cat='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array( $option['category_min'])){
    foreach(  $option['category_min'] as $key => $item  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                                            <option value="{$key}" 
EOF;
if( $key == $option['current']) {
$BWHTML .= <<<EOF
selected
EOF;
}

$BWHTML .= <<<EOF
>{$item['name']}</option>
                                        
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_540b39dd1306b($option=array(),$key='',$cat='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array( $option['category_min'][$option['current']]['children'])){
    foreach(  $option['category_min'][$option['current']]['children'] as $key => $item  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                                            <option value="{$key}" 
EOF;
if( $key == $option['obj']->getCatId() ) {
$BWHTML .= <<<EOF
selected
EOF;
}

$BWHTML .= <<<EOF
>{$item['name']}</option>
                                        
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_540b39dd13174($option=array())
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

                                
EOF;
if($option['error']) {
$BWHTML .= <<<EOF

                          <div class="alert alert-danger fade in" role="alert">
                                      <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                      <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                                      <p>{$option['error']}</p>
                                  </div>
                        
EOF;
}

$BWHTML .= <<<EOF

                                <form id="fileupload" class="form-horizontal" role="form" action='{$this->bw->base_url}posts/submit/{$cat->getSlugId()}' method="POST" enctype="multipart/form-data">
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        {$this->getLang()->getWords('faq_form_category', 'Danh mục cần đăng')}
                                    </label>
                                    <div class="col-sm-10">
                                      <select class='form-control location-selection' id='state'>
                                        {$this->__foreach_loop__id_540b39dd12f69($option,$key,$cat)}
                                      </select>
                                      <select class='form-control location-selection' id='city' name='{$this->modelName}[catId]'>
                                        {$this->__foreach_loop__id_540b39dd1306b($option,$key,$cat)}
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">{$this->getLang()->getWords('post_form_title', 'Tiêu đề')} (<span class='required'>*</span>)</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('post_form_title', 'Tiêu đề')}" name='{$this->modelName}[title]' value="{$option['obj']->getTitle()}">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">{$this->getLang()->getWords('post_form_file', 'Hình đại diện')} (<span class='required'>*</span>)</label>
                                    <div class="col-sm-10">
                                        <div class="fileupload-buttonbar">
                                            <div>
                                                <!-- The fileinput-button span is used to style the file input field as button -->
                                                <span class="btn btn-success fileinput-button">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>{$this->getLang()->getWords('post_form_file_chose', 'Chọn tệp')} ...</span>
                                                    <input type="file" name="file[]" multiple>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="fileupload-buttonbar">
                                            <div>
                                                <!-- The fileinput-button span is used to style the file input field as button -->
                                                <span class="btn btn-success fileinput-button">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>{$this->getLang()->getWords('faq_form_album', 'Album hình ảnh')}</span>
                                                    <input type="file" name="gallery[]" multiple>
                                                </span>
                                                <!--
                                                <button type="button" class="btn btn-danger delete hidden delete-button">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                                <input type="checkbox" class="toggle hidden delete-button">
                                                -->
                                            </div>
                                        </div>
                                        <table role="presentation" class="table table-striped" id='gallery-container'><tbody class="files"></tbody></table>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">{$this->getLang()->getWords('post_form_intro', 'Mô tả')} (<span class='required'>*</span>)</label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" rows="5" name='{$this->modelName}[intro]'>{$option['obj']->getIntro()}</textarea>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">{$this->getLang()->getWords('post_form_detail', 'Nội dung chi tiết')} (<span class='required'>*</span>)</label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" rows="15" name='{$this->modelName}[content]'>{$option['obj']->getContent()}</textarea>
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