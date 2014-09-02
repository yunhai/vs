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
        <div class='col-md-9'>
            <ul class="nav nav-tabs" role="tablist">
                {$this->__foreach_loop__id_540594e3ad435($option)}
            </ul>
                
            <div class='content'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('faq_header', 'Hỏi đáp')}</span>
                    <a class='btn btn-default' href='{$this->bw->base_url}faq/form/{$option['category']->getSlugId()}' title='{$this->getLang()->getWords('faq_submit', 'Gửi câu hỏi')}'>
                        {$this->getLang()->getWords('faq_submit', 'Gửi câu hỏi')}
                    </a>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    {$this->__foreach_loop__id_540594e3ad645($option)}
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
function __foreach_loop__id_540594e3ad435($option=array())
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
function __foreach_loop__id_540594e3ad5a4($option=array(),$key='',$cat='')
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
                                    <span class='label-question'>{$obj->getId()}:{$this->getLang()->getWords('faq_question', 'Câu hỏi')}</span>
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
function __foreach_loop__id_540594e3ad645($option=array())
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

                                {$this->__foreach_loop__id_540594e3ad5a4($option,$key,$cat)}
            
                                
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
        <div class='col-md-9'>
            <ul class="nav nav-tabs" role="tablist">
                {$this->__foreach_loop__id_540594e3ada0b($option)}
            </ul>
    
            <div class='content'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('faq_header', 'Hỏi đáp')}</span>
                    <a class='btn btn-default' href='{$this->bw->base_url}faq' title='{$this->getLang()->getWords('faq_list', 'Các câu hỏi thường gặp')}'>
                        {$this->getLang()->getWords('faq_list', 'Các câu hỏi thường gặp')}
                    </a>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    {$this->__foreach_loop__id_540594e3adb2e($option)}
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
function __foreach_loop__id_540594e3ada0b($option=array())
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
function __foreach_loop__id_540594e3adb2e($option=array())
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

                                <div>
                                    {$this->getLang()->getWords('faq_form_intro', 'Mục này được thực hiện nhằm tạo cơ hội cho Quý khách, có thể gửi những câu hỏi thắc mắc, trao đổi, hợp tác.. về cho chúng tôi. Để gửi câu hỏi, xin vui lòng nhập vào mẫu bên dưới, chúng tôi sẽ trả lời và cập nhật câu trả lời lên website trong thời gian sớm. nhất.')}
                                </div>
                                <form class="form-horizontal" role="form" method='post' action='{$this->bw->base_url}faq/submit/{$cat->getSlugId()}'>
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
                                      <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('faq_form_phone', 'Điện thoại')}" name='{$this->modelName}[phone]'>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                      <input type="email" class="form-control" placeholder="Email" name='{$this->modelName}[email]' value='yunha@mail.com'>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">{$this->getLang()->getWords('faq_form_question', 'Nội dung cần hỏi')} (<span class='required'>*</span>)</label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" rows="3" name='{$this->modelName}[intro]'></textarea>
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