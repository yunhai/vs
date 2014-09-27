<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_faq extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {        global $bw;
    
        $this->bw = $bw;
    
        
//--starthtml--//
$BWHTML .= <<<EOF
        <div class='col-md-12 no-padding'>
    <div class='col-md-9 no-padding col-md-9-fix'>
                <ul class="nav nav-tabs" role="tablist">
                    {$this->__foreach_loop__id_542594c20e41e($option)}
                </ul>
                    
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('faq_header', 'Hỏi đáp')}</span>
                        <a class='btn btn-primary pull-right btn-xs' href='{$this->bw->base_url}faq/form/{$option['category']->getSlugId()}' title='{$this->getLang()->getWords('faq_submit', 'Gửi câu hỏi')}'>
                            {$this->getLang()->getWords('faq_submit', 'Gửi câu hỏi')}
                        </a>
                        <div class='clear'></div>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        {$this->__foreach_loop__id_542594c20e620($option)}
                    </div>
                </div>
                <script>
                    $('a[data-toggle="tab"]').on('click', function (e) {
                        window.location.href = $(e.target).attr("href");
                        console.log($(e.target).attr("href"));
                    });
                </script>
    </div>
            <div class='col-md-3 col-md-3-fix'>
                {$this->getAddon()->getSidebar()}
            </div>
            <div class='clear'></div>
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_542594c20e41e($option=array())
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
function __foreach_loop__id_542594c20e572($option=array(),$key='',$cat='')
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
        
                                    <div class='{$this->bw->input[0]}-item item'>
                                        <span class='postdate'>{$this->getLang()->getWords('faq_postdate', 'Ngày gửi: ')}{$this->dateTimeFormat($obj->getPostDate(),"d/m/Y")}</span>
                                        <span class='label-question'>{$this->getLang()->getWords('faq_question', 'Câu hỏi')}</span>
                                        <div  class='intro'>{$obj->getIntro()}</div>
                                        <span class='label-answer icon-plus' data-id='{$obj->getId()}' id='question-{$obj->getId()}'>
                                            {$this->getLang()->getWords('faq_answer', 'Xem câu trả lời')}
                                        </span>
                                        <div  class='content' id='detail-{$obj->getId()}'>{$obj->getContent()}</div>
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
function __foreach_loop__id_542594c20e620($option=array())
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

                                    {$this->__foreach_loop__id_542594c20e572($option,$key,$cat)}
                
                                    
EOF;
if( $option[$key]['paging'] ) {
$BWHTML .= <<<EOF

                                        <div class='paging pager'>
                                            {$option[$key]['paging']}
                                        </div>
                                    
EOF;
}

$BWHTML .= <<<EOF

                
                                    <script type='text/javascript'>
                                        $(".label-answer").click(function(){
                                            var id = $(this).attr('data-id');
                                            
                                            $("#detail-"+id ).slideToggle('', function() {
                                                if ($("#detail-"+id).is(':visible') === true ){
                                                    $('#question-'+id).addClass('icon-minus');
                                                    $('#question-'+id).removeClass('icon-plus');
                                                }
                                                else {
                                                    $('#question-'+id).addClass('icon-plus');
                                                    $('#question-'+id).removeClass('icon-minus');
                                                }
                                            });
                                        });
                                    </script>
                                    
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
        <div class='col-md-12 no-padding'>
    <div class='col-md-9 no-padding col-md-9-fix'>
            <ul class="nav nav-tabs" role="tablist">
                {$this->__foreach_loop__id_542594c20e98a($option)}
            </ul>
            <div class='content shadow content-special'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('faq_form_header', 'Gửi câu hỏi')}</span>
                    <a class='btn btn-primary pull-right btn-xs' href='{$this->bw->base_url}faq' title='{$this->getLang()->getWords('faq_list', 'Các câu hỏi thường gặp')}'>
                        {$this->getLang()->getWords('faq_list', 'Các câu hỏi thường gặp')}
                    </a>
                    <div class='clear'></div>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    {$this->__foreach_loop__id_542594c20ea97($option)}
                </div>
            </div>
            <script>
                $('a[data-toggle="tab"]').on('click', function (e) {
                    window.location.href = $(e.target).attr("href");
                    console.log($(e.target).attr("href"));
                });
            </script>
</div>
<div class='col-md-3 col-md-3-fix'>
            {$this->getAddon()->getSidebar()}
        </div>
        <div class='clear'></div>
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_542594c20e98a($option=array())
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
function __foreach_loop__id_542594c20ea97($option=array())
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

                                <div class='faq_form_intro'>
                                    {$this->getLang()->getWords('faq_form_intro', 'Mục này được thực hiện nhằm tạo cơ hội cho Quý khách, có thể gửi những câu hỏi thắc mắc, trao đổi, hợp tác.. về cho chúng tôi. Để gửi câu hỏi, xin vui lòng nhập vào mẫu bên dưới, chúng tôi sẽ trả lời và cập nhật câu trả lời lên website trong thời gian sớm. nhất.')}
                                </div>
                                <form class="form-horizontal nail-form" role="form" method='post' action='{$this->bw->base_url}faq/submit/{$cat->getSlugId()}'>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        {$this->getLang()->getWords('faq_form_fullname', 'Họ tên')}
                                    </label>
                                    <div class="col-md-6">
                                      <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('faq_form_fullname', 'Họ tên')}" name='{$this->modelName}[fullname]'>
                                    </div>
                                  </div>  
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">{$this->getLang()->getWords('faq_form_phone', 'Điện thoại')}</label>
                                    <div class="col-md-6">
                                      <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('faq_form_phone', 'Điện thoại')}" name='{$this->modelName}[phone]'>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-6">
                                      <input type="email" class="form-control" placeholder="Email" name='{$this->modelName}[email]' value=''>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">{$this->getLang()->getWords('faq_form_question', 'Nội dung cần hỏi')} (<span class='required'>*</span>)</label>
                                    <div class="col-md-9">
                                      <textarea class="form-control" rows="5" name='{$this->modelName}[intro]'></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">&nbsp;</label>
                                    <div class="col-md-9">
                                      <button type="submit" class="btn btn-default nail-button">{$this->getLang()->getWords('faq_form_submit', 'Gửi')}</button>
                                      <button type="reset" class="btn btn-default nail-button">{$this->getLang()->getWords('faq_form_reset', 'Làm lại')}</button>  
                                      <lable class='pull-right'><span class='required'>*</span>&nbsp;{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
                                      <div class='clear'></div>
                                    </div>
                                  </div>
                                </form>
                                <div class='clear'></div>
                            
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