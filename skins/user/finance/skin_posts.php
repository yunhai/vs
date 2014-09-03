<?php
class skin_posts extends skin_objectpublic{
    
function showDefault($option = array()) {
        global $bw;
    
        $this->bw = $bw;
    
        $BWHTML .= <<<EOF
		<div class='col-md-12'>
            <ul class="nav nav-tabs" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['category']->getId() ">class='active'</if>>
                        <a href="{$cat->getUrlCategory()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
                
            <div class='content'>
                <div class='sub-header'>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <foreach=" $option['cate'] as $key => $cat">
                        <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                            <if=" !empty($option[$key]) ">
                                <foreach="$option[$key]['pageList'] as $obj ">
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
                                </foreach>
                                <div class='clear'></div>
                                <if=" $option[$key]['paging'] ">
                                    <div class='paging pager'>
                                        {$option[$key]['paging']}
                                    </div>
                                </if>
            
                                <if=" count($option[$key]['pageList']) == 0">
                                    {$this->getLang()->getWords('faq_empty', 'Hiện thời danh mục chưa có bài viết.')}
                                </if>
                            </if>
                        </div>
                    </foreach>
                    
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
        return $BWHTML;
    }
    
function showForm($option = array()) {
        global $bw;
    
        $this->bw = $bw;
    
        $BWHTML .= <<<EOF
		<div class='col-md-9'>
            <ul class="nav nav-tabs" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['category']->getId() ">class='active'</if>>
                        <a href="{$this->bw->base_url}faq/form/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
    
            <div class='content'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('post_header', 'Đăng quảng cáo')}</span>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <foreach=" $option['cate'] as $key => $cat">
                        <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                            <if=" !empty($option[$key]) ">
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
                            </if>
                        </div>
                    </foreach>
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
        return $BWHTML;
    }
}