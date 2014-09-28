<?php
class skin_posts extends skin_objectpublic{
    
function showDefault($option = array()) {
        global $bw;

        if($option['detail-flag'] && $option['city-obj'] && $option['state-obj']) {
           $message = $this->getLang()->getWords('category_detail_message', "Danh sách các tin tại thành phố %s' bang '%s'");
           $this->message = sprintf($message, "<b>{$option['city-obj']->getTitle()}</b>", "<b>{$option['state-obj']->getTitle()}</b>");
        }
        
        $this->bw = $bw;
        $this->option = $option;

        $BWHTML .= <<<EOF
		<div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs shadow nav-tabs-border0 post-menu" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['current'] ">class='active'</if>>
                        <a href="{$cat->getUrlCategory()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>

            <div class='border-grey shadow'>
                <div class='content content-grey <if="$option['category-type'] == 'city'">no-padding-bottom</if>'>
                    <div class='i-panel'>
                        <foreach="$option['sub-category'] as $key => $cat">
                        <a <if="$key == $option['category-id'] ">class='active'</if> href='{$cat->getUrlCategory()}' title='{$cat->getTitle()}'>
                            {$cat->getTitle()}
                        </a>
                        </foreach>
                    </div>
                    <div class='location-panel'>
                    <if="in_array($option['category-type'], array('state', 'city'))">
                        {$this->$option['category-type']($this->option)}
                    </if>
                    
                    <if=" $option['detail-flag'] && $option['city-obj'] && $option['state-obj']">
                    <div class='fix-height'>
                        {$this->message}
                    </div>
                    </if>
                    </div>
                </div>
                
                <!-- Tab panes -->
                <div class='content'>
                    <div class="tab-content">
                        <foreach=" $option['cate'] as $key => $cat">
                            <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                                <if=" !empty($option[$key]) ">
                                    <foreach="$option[$key]['pageList'] as $obj ">
                                    <a href='{$obj->getUrl('posts')}' title='{$obj->getTitle()}' class='{$this->bw->input[0]}-category-item col-md-6 post-type-{$obj->getStatus()}'>
                                        <div class='pull-left' style='margin-right: 10px;'>
                                            {$obj->createImageCache($obj->getImage(), 126, 128)}
                                        </div>
                                        <div class='title'>
                                            {$obj->getTitle()}
                                        </div>
                                        <div class='name'>{$obj->getName()}<span class='location'><if="$obj->getName()">, </if>{$obj->formatted_location}</span></div>
                                        <div class='intro'>{$obj->getIntro()}</div>
                                        <div class='clear'></div>
                                    </a>
                                    </foreach>
                                    <div class='clear'></div>
                                    <if=" $option[$key]['paging'] ">
                                        <div class='paging pager'>
                                            {$option[$key]['paging']}
                                        </div>
                                    </if>
                                    <if=" count($option[$key]['pageList']) == 0">
                                        {$this->getLang()->getWords('posts_empty', 'Hiện thời danh mục chưa có bài viết.')}
                                    </if>
                                </if>
                            </div>
                        </foreach>
                     </div>
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
    
function state($option) {
    global $bw;
    
    $BWHTML .= <<<EOF
        <table class="table state">
            <foreach=" $option['location'] as $row">
                <tr>
                <foreach=" $row as $col ">
                    <td>
                        <a href="{$col['url']}" title="{$col['title']}">
                            {$col['title']}
                        </a>
                    </td>
                </foreach>
                </tr>
            </foreach>
        </table>
EOF;
        return $BWHTML;
}

function city($option) {
    global $bw;

    $BWHTML .= <<<EOF
        <div class='fix-height row'>
            <table class="table table-responsive table-striped">
                <foreach=" $option['location'] as $row">
                    <tr>
                    <foreach=" $row as $col ">
                        <td>
                            <a href="{$col['url']}" title="{$col['title']}" <if=" ($col['url']=='#') ">class='seperate'</if>>
                                {$col['title']}
                            </a>
                        </td>
                    </foreach>
                    </tr>
                </foreach>
            </table>
        </div>
EOF;
    return $BWHTML;
}

function showForm($option = array()) {
        global $bw;
    
        $this->bw = $bw;
        $BWHTML .= <<<EOF
		<div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs main-tab shadow" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['category']->getId() ">class='active'</if>>
                        <a href="{$this->bw->base_url}posts/add/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
    
            <div class='col-md-10 no-padding col-md-9-fix'>
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('post_header', 'Đăng quảng cáo')}</span>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <foreach=" $option['cate'] as $key => $cat">
                            <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                                <if=" !empty($option[$key]) ">
                                    <if="$option['error']">
                            		  <div class="alert alert-danger fade in" role="alert">
                                          <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                          </button>
                                          <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                                          <p>{$option['error']}</p>
                                      </div>
                        		    </if>
                                    <form id="fileupload" class="form-horizontal post-form nail-form" role="form" action='{$this->bw->base_url}posts/submit/{$cat->getSlugId()}' method="POST" enctype="multipart/form-data">
                                      <input type="hidden" value="{$option['obj']->getId()}" name='{$this->modelName}[id]' />
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">
                                            {$this->getLang()->getWords('form_category', 'Danh mục cần đăng')}
                                        </label>
                                        <div class="col-md-9">
                                          <select class='form-control selectpicker' id='state'>
                                            <foreach=" $option['category_min'] as $key => $item ">
                                                <option value="{$key}" <if=" $key == $option['current']">selected</if>>{$item['name']}</option>
                                            </foreach>
                                          </select>
                                          <select class='form-control' id='city' name='{$this->modelName}[catId]'>
                                            <foreach=" $option['category_min'][$option['current']]['children'] as $key => $item ">
                                                <option value="{$key}" <if=" $key == $option['obj']->getCatId() ">selected</if>>{$item['name']}</option>
                                            </foreach>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">{$this->getLang()->getWords('post_form_title', 'Tiêu đề')} <span class='required'>*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('post_form_title', 'Tiêu đề')}" name='{$this->modelName}[title]' value="{$option['obj']->getTitle()}">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">{$this->getLang()->getWords('post_form_file', 'Hình đại diện')} <span class='required'>*</span></label>
                                        <div class="col-md-6">
                                            <div class="fileupload-buttonbar">
                                                <div>
                                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                                    <span class="btn btn-default fileinput-button">
                                                        <i class="glyphicon glyphicon-plus"></i>
                                                        <span>{$this->getLang()->getWords('post_form_file_chose', 'Chọn tệp')} ...</span>
                                                        <input type="file" name="file[]" multiple>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="fileupload-buttonbar">
                                                <div>
                                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                                    <span class="btn btn-default fileinput-button">
                                                        <i class="glyphicon glyphicon-plus"></i>
                                                        <span>{$this->getLang()->getWords('form_album', 'Album hình ảnh')}</span>
                                                        <input type="file" name="gallery[]" multiple>
                                                    </span>
                                                </div>
                                            </div>
                                            <table role="presentation" class="table table-striped" id='gallery-container'>
                                                <tbody class="files">
                                                    <if="$option['obj']->getImage()">
                                                        <tr class="fade file in" id='item-{$option['obj']->getImage()}'>
                                                            <td class="col-md-3">
                                                                <button class="btn btn-danger delete preset-list" data-type="DELETE" 
                                                                    data-url="{$option['obj']->getCacheImagePathByFile($option['obj']->getImage(), 150, 200)}" 
                                                                    data-id='{$option['obj']->getImage()}'>
                                                                    <i class="glyphicon glyphicon-trash"></i>
                                                                    <span>Delete</span>
                                                                </button>
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="file[{$option['obj']->getImage()}]" value="{$option['obj']->getImage()}">
                                                                <span class="preview">
                                                                    {$option['obj']->createImageCache($option['obj']->getImage(), 150, 200)}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </if>
                                                    <if="$option['gallery']">
                                                        <foreach=" $option['gallery'] as $gkey => $gitem ">
                                                        <tr class="fade gallery in" id='item-{$gkey}'>
                                                            <td class="col-md-3">
                                                                <button class="btn btn-danger delete preset-list" 
                                                                    data-type="DELETE" data-url="{$gitem->getCacheImagePathByFile($gkey, 150, 200)}" 
                                                                    data-id='{$gkey}'>
                                                                    <i class="glyphicon glyphicon-trash"></i>
                                                                    <span>Delete</span>
                                                                </button>
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="gallery[{$gkey}]" value="{$gkey}">
                                                                <span class="preview">
                                                                    {$gitem->createImageCache($gkey, 150, 200)}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        </foreach>
                                                    </if>
                                                </tbody>
                                            </table>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">{$this->getLang()->getWords('post_form_intro', 'Mô tả')} <span class='required'>*</span></label>
                                        <div class="col-md-6">
                                          <textarea class="form-control" rows="5" name='{$this->modelName}[intro]'>{$option['obj']->getIntro()}</textarea>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">{$this->getLang()->getWords('post_form_detail', 'Nội dung chi tiết')} <span class='required'>*</span></label>
                                        <div class="col-md-9">
                                          {$this->createEditor($option['obj']->getContent(), "{$this->modelName}[content]", "100%", "280px", "simple")}
                                        </div>
                                      </div>
                                      <div class="form-group" style='margin-top: 20px;'>
                                        <label class="col-md-3 control-label">&nbsp;</label>
                                        <div class="col-md-9">
                                          <button type="submit" class="btn btn-default nail-button">{$this->getLang()->getWords('form_submit', 'Gửi')}</button>
                                          <button type="reset" class="btn btn-default nail-button">{$this->getLang()->getWords('form_reset', 'Làm lại')}</button>  
                                          <lable class='pull-right'><span class='required'>*</span>&nbsp;{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
                                          <div class='clear'></div>  
                                        </div>
                                      </div>
                                    </form>
                                </if>
                            </div>
                        </foreach>
                    </div>
                </div>
            </div>    
            {$this->_accountLink()}
            <div class='clear'></div>
        </div>
        <script>
            $(document).ready(function() {
                $('.preset-list').click(function() {
                    var d_id = 'item-' + $(this).data('id');
                    $('#'+d_id).remove();
                });
            });
            
            $('a[data-toggle="tab"]').on('click', function (e) {
                window.location.href = $(e.target).attr("href");
            });
            
            var current = {$option['current']};
            var json = {$option['json']};

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
                <tr class="fade">
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
                <tr class="fade {%=file.item_name%}">
                    <td class="col-sm-3">
                        {% if (file.deleteUrl) { %}
                            <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                <i class="glyphicon glyphicon-trash"></i>
                                <span>Delete</span>
                            </button>
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
                                <img src="{%=file.thumbnailUrl%}">
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
        <script type="text/javascript" src="{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/tmpl.min.js"></script>
        <script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/load-image.all.min.js'></script>
        <script type="text/javascript" src="{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/canvas-to-blob.min.js"></script>
        <script type="text/javascript" src="{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.blueimp-gallery.min.js"></script>
        <script type="text/javascript" src="{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.iframe-transport.js"></script>
        <script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.fileupload.js'></script>
        <script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.fileupload-process.js'></script>
        <script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.fileupload-image.js'></script>
        <script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.fileupload-audio.js'></script>
        <script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.fileupload-video.js'></script>
        <script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.fileupload-validate.js'></script>
        <script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/jquery.fileupload-ui.js'></script>
        <script type="text/javascript" src='{$bw->vars['board_url']}/skins/user/finance/javascripts/uploader/main.js'></script>
EOF;
        return $BWHTML;
    }

function _accountLink() {
    global $bw;

$BWHTML .= <<<EOF
    <div class='col-md-3 col-md-3-fix col-md-3-fix-link shadow'>
        <div class='content custom-content account-link col-md-3-special'>
            <div class='sub-header'>
                <span>{$this->getLang()->getWords('post_account_linkheader', 'Quản lý tài khoản')}</span>
            </div>
            <div class='account-link-detail'>
               <a href='{$bw->base_url}users/update' title='{$this->getLang()->getWords('update-store', 'Cập nhật tiêm (Tài khoản)')}'>
                    {$this->getLang()->getWords('update-store', 'Cập nhật tiêm (Tài khoản)')} 
               </a>
               <a href='{$bw->base_url}posts/add' title='{$this->getLang()->getWords('post', 'Đăng quảng cáo')}'>
                    {$this->getLang()->getWords('post', 'Đăng quảng cáo')} 
               </a>
                <a href='{$bw->base_url}posts/me' title='{$this->getLang()->getWords('my-list', 'Các tin đã đăng')}'>
                    {$this->getLang()->getWords('my-list', 'Các tin đã đăng')} 
               </a>
            </div>
        </div>
     </div>
EOF;
    return $BWHTML;
}

function showDetail($obj, $option = array()) {
        global $bw;

        $this->bw = $bw;
        $this->option = $option;
    
        $BWHTML .= <<<EOF
       <div class='col-md-12 no-padding'>
    		<div class='col-md-9 no-padding col-md-9-fix'>
            <ul class="nav nav-tabs shadow nav-tabs-border0 post-menu" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['current'] ">class='active'</if>>
                        <a href="{$cat->getUrlCategory()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
                
            <div class='border-grey shadow content-special' style='padding-left: 0 !important;padding-right: 0 !important;'>
                <div class='content content-grey <if="$option['category-type'] == 'city'">no-padding-bottom</if>'>
                    <div class='i-panel'>
                        <foreach="$option['sub-category'] as $key=>$cat">
                        <a href='{$cat->getUrlCategory()}' title='{$cat->getTitle()}' <if=" $key == $obj->getCatId() ">class='active'</if> >
                            {$cat->getTitle()}
                        </a>
                        </foreach>
                    </div>
                    
                    {$option['breakcrum']}
					<div class='clear'></div>
                    <!-- Tab panes -->
                </div>
                <div class='content icon'>
                    <div class="tab-content <if="$obj->getStatus() == 2">icon-vip</if>">
                        <foreach=" $option['cate'] as $key => $cat">
                        <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                            <if=" !empty($option[$key]) ">
                                {$this->_detailLeft($obj, $option)}
                            </if>
                        </div>
                        </foreach>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-3 col-md-3-fix'>
            {$this->_sidebar($option)}
        </div>
		</div>
        
        <script>
            $('a[data-toggle="tab"]').on('click', function (e) {
                window.location.href = $(e.target).attr("href");
            });
            
            <if=" $option['map'] && $bw->input['info'] == 'map' ">
            var map;
            var LatLng = new google.maps.LatLng({$option['map']['geometry']['lat']}, {$option['map']['geometry']['lng']});
            function init() {
              var myHtml = "<h4><if="$option['author']">{$option['author']->getFullname()}</if>&nbsp;</h4><p>{$option['map']['formatted_address']}</p>";
              var map = new google.maps.Map(
                  document.getElementById("post_map_canvas"),
                  {scaleControl: true}
              );
              map.setCenter(LatLng);
              map.setZoom(15);
              map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
              var marker = new google.maps.Marker({
                map: map,
                position:map.getCenter()
        	  });
                      
        	  var infowindow = new google.maps.InfoWindow({
        	   'pixelOffset': new google.maps.Size(0,15)
        	  });
    	      infowindow.setContent(myHtml);
    	      infowindow.open(map, marker);
    	    }
            
            google.maps.event.addDomListener(window, 'load', init);
            </if>
        </script>
EOF;
        return $BWHTML;
    }

function _detailLeft($obj, $option) {
    global $bw, $vsPrint;
    $this->bw = $bw;
    
    $vsPrint->addCSSFile('jquery.scrollbar');
    $vsPrint->addCurentJavaScriptFile("jquery.scrollbar");
    
    $BWHTML .= <<<EOF
             <div class='detail-info detail-post-type-{$obj->getStatus()}'>
                <if=" $option['gallery'] "> 
                <div class='pull-left gallery'>
                    {$this->_displayGallery($option)}
                </div>
                </if>
                
                <div class='post-info'>
                    <span class='post-title'>{$obj->getTitle()}</span>
                    <span class='post-id'>({$this->getLang()->getWords('posts_id', 'Ad Id:')}&nbsp;{$obj->getId()})</span><br />
                    <span class='post-publicdate'>{$this->getLang()->getWords('posts_publicdate', 'Ngày đăng:')}&nbsp;{$obj->getPublicdate(false , 'vn')}</span>
                </div>
                <if=" $option['author'] ">
                <div class='author-info'>
                    <div class='author-name'>
                        {$option['author']->getFullname()}
                    </div>
                    <div class='author-address'>
                        <img src='{$this->bw->vars['img_url']}/address.png' />
                        {$option['author']->getAddress()}
                    </div>
                    <div class='author-phone'>
                        <img src='{$this->bw->vars['img_url']}/phone.png' />
                        {$option['author']->getName()}
                    </div>
                    <div class='author-email'>
                        <img src='{$this->bw->vars['img_url']}/email.png' />
                        {$option['author']->getEmail()}
                    </div>
                    <div class='author-website'>
                        <img src='{$this->bw->vars['img_url']}/website.png' />
                        {$option['author']->getWebsite()}
                    </div>
                </div>
                </if>
                <if=" $option['author_type'] == 'admin' ">
                <div class='author-info'>
                    <div class='author-name'>{$obj->getName()}</div>
                    <div class='author-address'>{$obj->getAddress()}</div>
                    <div class='author-phone'>{$obj->getPhone()}</div>
                    <div class='author-email'>{$obj->getEmail()}</div>
                    <div class='author-website'>{$obj->getWebsite()}</div>
                </div>
                </if>
                <if=" $this->getSettings()->getSystemKey('configs_facebook', '', 'configs') ">
                <div class="fb-like" data-href="{$this->getSettings()->getSystemKey('configs_facebook', '', 'configs')}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                </if>
                <div class='post-content'>{$obj->getContent(0, 0, "", true)}</div>
                <div class='clear'></div>
            </div>
            <div class='clear'></div>
            <div id='detail-tab-container' class='row'>
                <ul id='detail-tab' class="nav nav-tabs nav-tabs-nohidden" role="tablist">
                  <if=" $option['location-info'] ">
                  <li <if="$this->bw->input['info'] == 'city'">class='active'</if>>
                    <a href="{$this->bw->base_url}{$bw->input['vs']}?info=city" role="tab" data-toggle="tab">
                        {$this->getLang()->getWords('location-info', 'Thông tin thành phố')}    
                    </a>
                  </li>
                  </if>
                  <if=" $option['map'] ">
                  <li <if="$this->bw->input['info'] == 'map'">class='active'</if>>
                    <a href="{$this->bw->base_url}{$bw->input['vs']}?info=map" role="tab" data-toggle="tab" id='show-map'>
                        {$this->getLang()->getWords('map-info', 'Bản đồ')}
                    </a>
                  </li>
                  </if>
                </ul>
                
                <div>
                    <if="$this->bw->input['info'] == 'city'">
                    <div class='col-md-7'>
                       {$option['location-info']->getAlt()}
                    </div>
                    <div class='col-md-5'>
                       <if=" $option['location-info']->getImage() ">
                        {$option['location-info']->createImageCache($option['location-info']->getImage(), 128, 130)}
                       </if>
                    </div>
                    <div class='clear'></div>
                    </if>
                    <if=" $option['map'] && $this->bw->input['info'] == 'map'">
                        <div class='col-md-12'>
                            <div id='post_map_canvas'></div>
                        </div>
                    </if>
                </div>
            </div>
            <script>
                $(document).ready(function(){
                    $(".post-content").mCustomScrollbar({
    					setHeight:220,
                        autoHideScrollbar: true,    
    					theme:"minimal-dark"
    				});            
                });
            </script>
EOF;
        return $BWHTML;                       
}

function _displayGallery($option = array()) {
        global $bw, $vsPrint;
        
        $vsPrint->addCSSFile('../javascripts/highslide/highslide');
        $vsPrint->addCSSFile('galleriffic-2');
        $vsPrint->addCurentJavaScriptFile("highslide/highslide-full");
        $vsPrint->addCurentJavaScriptFile("jquery.galleriffic");
        $vsPrint->addCurentJavaScriptFile("jquery.opacityrollover");
        
        $BWHTML .= <<<EOF
        <div class="gallery-slide">
            <div id="gallery">
                <div class="slideshow-container">
                    <div id="loading" class="loader"></div>
                    <div id="slideshow" class="slideshow">
                        <div style="display:none;" class="show_popup_img">
                            <foreach=" $option['gallery'] as $i">
                                {$i->showImagePopup($i, "", "", "", 2)}
                            </foreach>
                        </div>
                    </div>
                </div>
            </div>
                        
            <div id="thumbs" class="navigation">
                <ul class="thumbs noscript">
                    <foreach=" $option['gallery'] as $image ">
                        <li>
                            <a class="thumb" name="leaf" href="{$image->getResizeImagePath($image->getPathView(),335,360, 1)}" title="{$image->getTitle()}">
                            {$image->createImageCache($image, 70, 65, 1)}
                             </a>                                
                         </li>
                    </foreach>
                    <div class="clear_left"></div>
                </ul>
            </div>
            <div id="controls" class="controls"></div>
        </div>
<script>
 $(document).ready(function() {
      if(window.hs!=null)
{
hs.graphicsDir = "{$bw->vars['board_url']}/skins/user/finance/javascripts/highslide/graphics/";
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.outlineType = 'glossy-dark';
hs.fadeInOut = true;
hs.dimmingOpacity = 0.75;
// Add the controlbar
if (hs.addSlideshow) hs.addSlideshow({
                        //slideshowGroup: 'group1',
                        interval: 5000,
                        repeat: false,
                        useControls: true,
                        fixedControls: false,
                        overlayOptions: {
                                opacity: 1,
                                position: 'top right',
                                hideOnMouseOut: false
                        }
                });
}
             });
</script>
                                    
EOF;
        return $BWHTML;
    }
    
function _sidebar($option) {
    global $bw;
    $BWHTML .= <<<EOF
        {$this->_more($option)}
        
        {$this->getAddon()->getSidebar()}
EOF;
    return $BWHTML;
}

function _more($option = array()) {
        global $bw;
        
        $this->bw = $bw;
        
        $BWHTML .= <<<EOF
        
        <if=" $option['others'] ">
        <div class='sidebar more-list'>
		    <div class='header'>
	           {$this->getLang()->getWords('other_post_title', 'Tin cùng khu vực')}
		    </div>
		    <div class='body'>
        		<foreach="$option['others'] as $item">
        			<div class="more-item">
        				<a href="{$item->getUrl('posts')}" title="{$item->getTitle()}">{$item->getTitle()}</a>
        				<div class='more-detail'>
    				        <span class='store-name'>{$item->getName()}</span>
    		                <span class='location'>({$option['location-info']->getTitle()}, {$option['state-info']->getValue()})</span>
    			        </div>
        			</div>
        		</foreach>
                <a href='{$this->bw->base_url}posts/category/detail/{$option['location-info']->getSlugId()}/{$option['category-info']->getSlugId ()}' title='{$this->getLang()->getWords('other_post_all', 'Xem tất cả')}'>
                  {$this->getLang()->getWords('other_post_all', 'Xem tất cả')}
                </a>
              </div>
		</div>
        <br />
        </if>
EOF;
    }
    
function search($option = array()) {
        global $bw;
    
        $this->bw = $bw;
        $this->option = $option;
    
        $BWHTML .= <<<EOF
        <div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs shadow" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['current'] ">class='active'</if>>
                        <a href="{$cat->getUrlCategory()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>

            <div class='border-grey shadow'>
                <div class='content content-grey <if="$option['category-type'] == 'city'">no-padding-bottom</if>'>
                    <div class='i-panel'>
                        <foreach="$option['sub-category'] as $key => $cat">
                        <a <if="$key == $option['category-id'] ">class='active'</if> href='{$cat->getCatUrl('posts/search/')}{$this->bw->input['advance']}' title='{$cat->getTitle()}'>
                            {$cat->getTitle()}
                        </a>
                        </foreach>
                    </div>
                    <div class='location-panel'>
                    <if="in_array($option['category-type'], array('state', 'city'))">
                        {$this->$option['category-type']($this->option)}
                    </if>
                    
                    <if=" $option['detail-flag'] && $option['city-obj'] && $option['state-obj']">
                    <div class='fix-height'>
                        {$this->message}
                    </div>
                    </if>
                    </div>
                </div>
                
                <!-- Tab panes -->
                <div class='content'>
                    <div class="tab-content">
                        <foreach=" $option['cate'] as $key => $cat">
                            <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                                <if=" !empty($option[$key]) ">
                                    <foreach="$option[$key]['pageList'] as $obj ">
                                    <a href='{$obj->getUrl('posts')}' title='{$obj->getTitle()}' class='{$this->bw->input[0]}-category-item col-md-6 post-type-{$obj->getStatus()}'>
                                        <div class='pull-left' style='margin-right: 10px;'>
                                            {$obj->createImageCache($obj->getImage(), 126, 128)}
                                        </div>
                                        <div class='title'>
                                            {$obj->getTitle()}
                                        </div>
                                        <div class='name'>{$obj->getName()}<span class='location'><if="$obj->getName()">, </if>{$obj->formatted_location}</span></div>
                                        <div class='intro'>{$obj->getIntro()}</div>
                                        <div class='clear'></div>
                                    </a>
                                    </foreach>
                                    <div class='clear'></div>
                                    <if=" $option[$key]['paging'] ">
                                        <div class='paging pager'>
                                            {$option[$key]['paging']}
                                        </div>
                                    </if>
                
                                    <if=" count($option[$key]['pageList']) == 0">
                                        {$this->getLang()->getWords('posts_empty', 'Hiện thời danh mục chưa có bài viết.')}
                                    </if>
                                </if>
                            </div>
                        </foreach>
                     </div>
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

function me($option){
        global $bw;
        $this->bw = $bw;
        $BWHTML .= <<<EOF
    
        
        <div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs main-tab" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['tab-id'] ">class='active'</if>>
                        <a href="{$this->bw->base_url}posts/me/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
    
            <div class='col-md-9 no-padding col-md-9-fix'>
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('post_me', 'Các tin đã đăng')}</span>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <foreach=" $option['cate'] as $key => $cat">
                            <div class="tab-pane <if=" !empty($option[$key]) ">active</if> my-list" id="tab{$key}" ref="{$key}">
                                <if=" !empty($option[$key]) ">
                                    <table class="table">
                                        <foreach=" $option[$key]['pageList'] as $obj">
                                            <tr>
                                                <td class='col-md-10'>
                                                    <a href='{$obj->getUrl('posts')}' title='{$obj->getTitle()}'>{$obj->getTitle()}</a>
                                                    <span>
                                                        {$this->getLang()->getWords('postdate', 'Ngày đăng')}: 
                                                        {$obj->getCreatedDate()}
                                                    </span>
                                                </td>
                                                <td class='col-md-2' style='padding-left: 50px;'>
                                                    <a href='{$this->bw->base_url}posts/edit/{$option['category-info'][$obj->getCatId()]}/{$obj->getId()}' title="{$this->getLang()->getWords('edit', 'Chỉnh sửa')}" class='icon'>
                                                        <img src='{$this->bw->vars['img_url']}/icon-edit.png' />
                                                    </a>
                                                    <a href='{$this->bw->base_url}posts/delete/{$obj->getId()}' title="{$this->getLang()->getWords('delete', 'Xóa')}" class='icon'>
                                                        <img src='{$this->bw->vars['img_url']}/icon-delete.png' />
                                                    </a>
                                                </td>
                                            </tr>
                                        </foreach>
                                        <if=" $option[$key]['paging'] || count($option[$key]['pageList']) == 0 ">
                                        <tr>
                                            <td colspan="2">
                                                <if=" $option[$key]['paging'] ">
                                                    <div class='paging pager'>
                                                        {$option[$key]['paging']}
                                                    </div>
                                                </if>
                        
                                                <if=" count($option[$key]['pageList']) == 0">
                                                    {$this->getLang()->getWords('posts_empty_me', 'Quý khách chưa có bài đăng.')}
                                                </if>
                                            </td>
                                        </tr>
                                        </if>
                                    </table>
                                </if>
                            </div>
                        </foreach>
                    </div>
                </div>
            </div>    
            {$this->_accountLink()}
            <div class='clear'></div>
        </div>
        <script>
            $('a[data-toggle="tab"]').on('click', function (e) {
                window.location.href = $(e.target).attr("href");
            });
        </script>
EOF;
	}
}