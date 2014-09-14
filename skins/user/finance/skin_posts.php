<?php
class skin_posts extends skin_objectpublic{
    
function showDefault($option = array()) {
        global $bw;
    
        $this->option = $option;
  
        $BWHTML .= <<<EOF
		<div class='col-md-12'>
            <ul class="nav nav-tabs" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['current'] ">class='active'</if>>
                        <a href="{$cat->getUrlCategory()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
                
            <div class='content'>
                <div class='i-panel'>
                    <foreach="$option['sub-category'] as $cat">
                    <a href='{$cat->getUrlCategory()}' title='{$cat->getTitle()}'>
                        {$cat->getTitle()}
                    </a>
                    </foreach>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <foreach=" $option['cate'] as $key => $cat">
                        <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                            <if=" !empty($option[$key]) ">
                                <if="in_array($option['category-type'], array('detail', 'state', 'city'))">
                                    {$this->$option['category-type']($this->option)}
                                </if>
                                <foreach="$option[$key]['pageList'] as $obj ">
                                <div class='{$this->bw->input[0]}-item col-md-6 post-type-{$obj->getStatus()}'>
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
                                    {$this->getLang()->getWords('posts_empty', 'Hiện thời danh mục chưa có bài viết.')}
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
    
function state($option) {
    global $bw;
    
    $BWHTML .= <<<EOF
        <table class="table col-md-12">
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
        <div class='fix-height'>
            <table class="table col-md-12 table-responsive">
                <foreach=" $option['location'] as $row">
                    <tr>
                    <foreach=" $row as $col ">
                        <td>
                            <a href="{$col['url']}" title="{$col['title']}" <if=" empty($col['url']) ">class='seperate'</if>>
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
		<div class='col-md-9'>
            <ul class="nav nav-tabs" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['category']->getId() ">class='active'</if>>
                        <a href="{$this->bw->base_url}posts/add/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
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
                                <if="$option['error']">
                        		  <div class="alert alert-danger fade in" role="alert">
                                      <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                      <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                                      <p>{$option['error']}</p>
                                  </div>
                    		    </if>
                                <form id="fileupload" class="form-horizontal" role="form" action='{$this->bw->base_url}posts/submit/{$cat->getSlugId()}' method="POST" enctype="multipart/form-data">
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        {$this->getLang()->getWords('faq_form_category', 'Danh mục cần đăng')}
                                    </label>
                                    <div class="col-sm-10">
                                      <select class='form-control location-selection' id='state'>
                                        <foreach=" $option['category_min'] as $key => $item ">
                                            <option value="{$key}" <if=" $key == $option['current']">selected</if>>{$item['name']}</option>
                                        </foreach>
                                      </select>
                                      <select class='form-control location-selection' id='city' name='{$this->modelName}[catId]'>
                                        <foreach=" $option['category_min'][$option['current']]['children'] as $key => $item ">
                                            <option value="{$key}" <if=" $key == $option['obj']->getCatId() ">selected</if>>{$item['name']}</option>
                                        </foreach>
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
                            </if>
                        </div>
                    </foreach>
                </div>
            </div>
            <script>
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
        return $BWHTML;
    }

function showDetail($obj, $option = array()) {
        global $bw;
    
        $this->option = $option;
    
        $BWHTML .= <<<EOF
        <div class='col-md-12'>
            <ul class="nav nav-tabs" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['current'] ">class='active'</if>>
                        <a href="{$cat->getUrlCategory()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
                
            <div class='content'>
                <div class='i-panel'>
                    <foreach="$option['sub-category'] as $cat">
                    <a href='{$cat->getUrlCategory()}' title='{$cat->getTitle()}'>
                        {$cat->getTitle()}
                    </a>
                    </foreach>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <foreach=" $option['cate'] as $key => $cat">
                        <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                            <if=" !empty($option[$key]) ">
                                <!-- begin left -->
                                <div class='row'>
                                <div class='col-md-9'>
                                {$option['breakcrum']}
                                <div class='col-md-12 post-type-{$obj->getStatus()}'>
                                    <div class='pull-left' class='gallery'>
                                    </div>
                                    <div>
                                        <span class='post-title'>{$obj->getTitle()}</span>
                                        <span class='post-id'>({$this->getLang()->getWords('posts_id', 'Ad Id:')}&nbsp;{$obj->getId()})</span>
                                    </div>
                                    <if=" $option['author'] ">
                                    <div class='author-info'>
                                        <div class='author-name'>{$option['author']->getFullname()}</div>
                                        <div class='author-address'>{$option['author']->getAddress()}</div>
                                        <div class='author-phone'>{$option['author']->getName()}</div>
                                        <div class='author-email'>{$option['author']->getEmail()}</div>
                                        <div class='author-website'>{$option['author']->getWebsite()}</div>
                                    </div>
                                    </if>
                                    <div class='post-content'>{$obj->getContent()}</div>
                                    <div class='clear'></div>
                                </div>
                                <div class='clear'></div>
                                <div id='detail-tab-container'>
                                    <ul id='detail-tab' class="nav nav-tabs" role="tablist">
                                      <if=" $option['location-info'] ">
                                      <li <if="$bw->input['info'] == 'city'">class='active'</if>>
                                        <a href="{$bw->base_url}{$bw->input['vs']}?info=city" role="tab" data-toggle="tab">
                                            {$this->getLang()->getWords('location-info', 'Thông tin thành phố')}    
                                        </a>
                                      </li>
                                      </if>
                                      <li <if="$bw->input['info'] == 'map'">class='active'</if>>
                                        <a href="{$bw->base_url}{$bw->input['vs']}?info=map" role="tab" data-toggle="tab" id='show-map'>Map</a>
                                      </li>
                                    </ul>
                                    
                                    <div>
                                        <if="$bw->input['info'] == 'city'">
                                        <div class='col-md-7'>
                                           {$option['location-info']->getAlt()}
                                        </div>
                                        <div class='col-md-5'>
                                           {$option['location-info']->createImageCache($option['location-info']->getImage(), 128, 130)}
                                        </div>
                                        <div class='clear'></div>
                                        </if>
                                        
                                        <if="$bw->input['info'] == 'map'">
                                        <div id='post_map_canvas'></div>
                                        </if>
                                    </div>
                                </div>
                                </div>
                                </div>
                                <!-- end left -->
                            </if>
                        </div>
                    </foreach>
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
                  var myHtml = "<h4>{$option['author']->getFullname()}</h4><p>{$option['map']['formatted_address']}</p>";
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
		</div>
EOF;
        return $BWHTML;
    }
    
function _displayGallery($obj, $option = array()) {
        global $bw;
    
        $BWHTML .= <<<EOF
            <!-- thumb navigation carousel -->
    
  
  
    <!-- main slider carousel -->
    <div class="row">
        <div class="col-md-5" id="slider">
                <div class="col-md-12" id="carousel-bounding-box">
                    <div id="myCarousel" class="carousel slide">
                        <!-- main slider carousel items -->
                        <div class="carousel-inner">
                            <div class="active item" data-slide-number="0">
                                <img src="http://placehold.it/1200x480&amp;text=one" class="img-responsive">
                            </div>
                            <div class="item" data-slide-number="1">
                              <img src="http://placehold.it/1200x480/888/FFF" class="img-responsive">
                            </div>
                            <div class="item" data-slide-number="2">
                                <img src="http://placehold.it/1200x480&amp;text=three" class="img-responsive">
                            </div>
                            <div class="item" data-slide-number="3">
                                <img src="http://placehold.it/1200x480&amp;text=four" class="img-responsive">
                            </div>
                            <div class="item" data-slide-number="4">
                                <img src="http://placehold.it/1200x480&amp;text=five" class="img-responsive">
                            </div>
                            <div class="item" data-slide-number="5">
                                <img src="http://placehold.it/1200x480&amp;text=six" class="img-responsive">
                            </div>
                            <div class="item" data-slide-number="6">
                                <img src="http://placehold.it/1200x480&amp;text=seven" class="img-responsive">
                            </div>
                            <div class="item" data-slide-number="7">
                                <img src="http://placehold.it/1200x480&amp;text=eight" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
                
                
                
    <div class="col-md-5 hidden-sm hidden-xs" id="slider-thumbs">
        
            <!-- thumb navigation carousel items -->
          <ul class="list-inline">
                </li>
          <li> <a class="carousel-control left" href="#myCarousel" data-slide="prev">‹</a></li>
                
          <li> <a id="carousel-selector-0" class="selected">
            <img src="http://placehold.it/80x60&amp;text=one" class="img-responsive">
          </a></li>
          <li> <a id="carousel-selector-1">
            <img src="http://placehold.it/80x60&amp;text=two" class="img-responsive">
          </a></li>
          <li> <a id="carousel-selector-2">
            <img src="http://placehold.it/80x60&amp;text=three" class="img-responsive">
          </a></li>
          <li> <a id="carousel-selector-3">
            <img src="http://placehold.it/80x60&amp;text=four" class="img-responsive">
          </a></li>
                <li> <a id="carousel-selector-4">
            <img src="http://placehold.it/80x60&amp;text=five" class="img-responsive">
          </a></li>
          <li> <a id="carousel-selector-5">
            <img src="http://placehold.it/80x60&amp;text=six" class="img-responsive">
          </a></li>
          <li> <a id="carousel-selector-6">
            <img src="http://placehold.it/80x60&amp;text=seven" class="img-responsive">
          </a></li>
          <li> <a id="carousel-selector-7">
            <img src="http://placehold.it/80x60&amp;text=eight" class="img-responsive">
          </a></li>
                </li>
          <li> <a class="carousel-control right" href="#myCarousel" data-slide="next">›</a></li>
            </ul>
    </div>        
    <!--/main slider carousel-->
        
    <script>
                $('#myCarousel').carousel({
    interval: 4000
});

// handles the carousel thumbnails
$('[id^=carousel-selector-]').click( function(){
  var id_selector = $(this).attr("id");
  var id = id_selector.substr(id_selector.length -1);
  id = parseInt(id);
  $('#myCarousel').carousel(id);
  $('[id^=carousel-selector-]').removeClass('selected');
  $(this).addClass('selected');
});

// when the carousel slides, auto update
$('#myCarousel').on('slid', function (e) {
  var id = $('.item.active').data('slide-number');
  id = parseInt(id);
  $('[id^=carousel-selector-]').removeClass('selected');
  $('[id^=carousel-selector-'+id+']').addClass('selected');
});
        </script>
EOF;
        return $BWHTML;
}