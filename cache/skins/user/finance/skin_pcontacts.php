<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_pcontacts extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($obj="",$option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='col-md-12 no-padding'>
    <ul class="nav nav-tabs shadow" role="tablist">
                {$this->__foreach_loop__id_543d24c2365c0($obj,$option)}
            </ul>
            
            <div class='content shadow content-special'>
                <div class='sub-header margin-bottom-15'>
                    <span>{$this->getLang()->getWords('contact_header', 'Thông tin liên hệ')}</span>
                </div>
                <div class="tab-content">
                    {$this->__foreach_loop__id_543d24c2366c1($obj,$option)}
                </div>
                <div class='clear'></div>
            </div>
</div>
        <script>
            $('a[data-toggle="tab"]').on('click', function (e) {
                window.location.href = $(e.target).attr("href");
            });
            
EOF;
if( !empty($obj) ) {
$BWHTML .= <<<EOF

            function init() {
              var myHtml = '';
              
              var myHtml = "<h4>{$obj->getTitle()}</h4><p>{$obj->getAddress()}</p>";
             
              var map = new google.maps.Map(
                  document.getElementById("map_canvas"),
                  {scaleControl: true}
              );
              map.setCenter(new google.maps.LatLng({$obj->getLatitude()},{$obj->getLongitude()}));
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
            
            $(document).ready(function(){
           init();
        });
            
EOF;
}

$BWHTML .= <<<EOF

        </script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_543d24c2365c0($obj="",$option=array())
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
function __foreach_loop__id_543d24c2366c1($obj="",$option=array())
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
        
                        <div class="tab-pane contact 
EOF;
if( $key == $option['category']->getId() ) {
$BWHTML .= <<<EOF
active
EOF;
}

$BWHTML .= <<<EOF
" id="tab{$key}" ref="{$key}">
                            
EOF;
if( !empty($option[$key]) ) {
$BWHTML .= <<<EOF

                                <div class='col-md-6 left info no-padding-left'>
                                    
EOF;
if( !empty($obj) ) {
$BWHTML .= <<<EOF

                                    <div class="title">{$obj->getTitle()}</div>
                                    <div class="info page-content">{$obj->getContent()}</div>
                                    
EOF;
}

$BWHTML .= <<<EOF

                                    <div class='form-container'>{$this->getContactForm($option, $cat)}</div>
                                </div>
                                <div class='col-md-6 map no-padding-right'>
                           <div id='map_canvas'></div>
                                </div>
                                <div class="clear"></div>
                            
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
// <vsf:getContactForm:desc::trigger:>
//===========================================================================
function getContactForm($option=array(),$category=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <form class="form-horizontal align-left contact-form" role="form" method='post' action='{$bw->base_url}contacts/submit/{$category->getSlugId()}'>
              
EOF;
if($option['error']) {
$BWHTML .= <<<EOF

          <div class="alert alert-danger fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">×</span>
                      </button>
                      <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                      {$this->__foreach_loop__id_543d24c2369be($option,$category)}
                  </div>
      
EOF;
}

$BWHTML .= <<<EOF

              <div class="form-group">
                <label class="col-md-3 control-label">
                    {$this->getLang()->getWords('contact_form_fullname', 'Họ tên')}
                    <span class='required'>*</span>
                </label>
                <div class="col-md-9">
                  <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('contact_form_fullname', 'Họ tên')}" name='{$this->modelName}[name]' value='{$option['obj']->getName()}'>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">
                    {$this->getLang()->getWords('contact_form_address', 'Địa chỉ')}
                </label>
                <div class="col-md-9">
                  <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('contact_form_address', 'Địa chỉ')}" name='{$this->modelName}[address]' value='{$option['obj']->getAddress()}'>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">
                    {$this->getLang()->getWords('contact_form_phone', 'Điện thoại')}
                    <span class='required'>*</span>
                </label>
                <div class="col-md-9">
                  <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('contact_form_phone', 'Điện thoại')}" name='{$this->modelName}[phone]' value='{$option['obj']->getPhone()}'>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                  <input type="email" class="form-control" placeholder="Email" name='{$this->modelName}[email]' value='{$option['obj']->getEmail()}'>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">{$this->getLang()->getWords('contact_form_title', 'Tiêu đề')}</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('contact_form_title', 'Tiêu đề')}" name='{$this->modelName}[title]' value='{$option['obj']->getTitle()}'>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">
                    {$this->getLang()->getWords('contact_form_detail', 'Nội dung')} 
                    <span class='required'>*</span>
                </label>
                <div class="col-md-9">
                  <textarea class="form-control" rows="3" name='{$this->modelName}[content]'>{$option['obj']->getContent()}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">{$this->getLang()->getWords('contact_form_capchar', 'Mã bảo vệ')}
                <span class='required'>*</span></label>
                <div class="col-md-9">
                  <input class="form-control" style='width: 150px; float: left; margin-right: 10px;' placeholder="capchar" name='{$this->modelName}[sec_code]' value='' />
                  <img id="siimage" src="{$bw->vars['board_url']}/vscaptcha/" />
                  <a href="javascript:;" id="reload_img" class="mamoi">Refresh</a>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                  <input type="submit" class="btn btn-default nail-button" name='btnSubmit' value='{$this->getLang()->getWords('contact_form_submit', 'Gửi')}' />
                  <button type="reset" class="btn btn-default nail-button">{$this->getLang()->getWords('contact_form_reset', 'Làm lại')}</button>  
                  <lable class='form-required-note'><span class='required'>*</span>&nbsp;{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
                  <div class='clear'></div>
                </div>
              </div>
          </form>
          <script>
                $("#reload_img").click(function(){
                    $("#siimage").attr("src",$("#siimage").attr("src")+"?a");
                    return false;
});
          </script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_543d24c2369be($option=array(),$category=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array( $option['error'])){
    foreach(  $option['error'] as $error  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                      <p>{$error}</p>
                      
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:sendContactSuccess:desc::trigger:>
//===========================================================================
function sendContactSuccess($obj="",$option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='col-md-12 no-padding'>
    <ul class="nav nav-tabs shadow" role="tablist">
                {$this->__foreach_loop__id_543d24c236c5e($obj,$option)}
            </ul>
            
            <div class='content shadow'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('contact_header', 'Thông tin liên hệ')}</span>
                </div>
                
                <div class="tab-content">
                    {$this->__foreach_loop__id_543d24c236d26($obj,$option)}
                </div>
                <div class='clear'></div>
            </div>
</div>
<script>
    $('a[data-toggle="tab"]').on('click', function (e) {
                window.location.href = $(e.target).attr("href");
            });
                
            function init() {
              var myHtml = "<h4>{$obj->getTitle()}</h4><p>{$obj->getAddress()}</p>";
              var map = new google.maps.Map(
                  document.getElementById("map_canvas"),
                  {scaleControl: true}
              );
              map.setCenter(new google.maps.LatLng({$obj->getLatitude()},{$obj->getLongitude()}));
              map.setZoom({$obj->getZoom()});
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
            
            $(document).ready(function(){
           init();
        });
           // setTimeout('relead()',5000);
            function relead(){
                document.location.href = "{$bw->base_url}";
            }
    </script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_543d24c236c5e($obj="",$option=array())
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
function __foreach_loop__id_543d24c236d26($obj="",$option=array())
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
        
                        <div class="tab-pane contact 
EOF;
if( $key == $option['category']->getId() ) {
$BWHTML .= <<<EOF
active
EOF;
}

$BWHTML .= <<<EOF
" id="tab{$key}" ref="{$key}">
                            
EOF;
if( !empty($option[$key]) ) {
$BWHTML .= <<<EOF

                                <div class='col-md-6 left info'>
                                    <div class="title">{$obj->getTitle()}</div>
                                    <div class="info">{$obj->getContent()}</div>
                                    <div class='form-container'>{$this->getLang()->getWords('contact_thankyou', "Cám ơn quý khách đã liên hệ chúng tôi.")}</div>
                                </div>
                                <div class='col-md-6 map'>
                           <div id='map_canvas'></div>
                                </div>
                                <div class="clear"></div>
                            
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