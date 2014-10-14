<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_users extends skin_objectpublic {

//===========================================================================
// <vsf:registry:desc::trigger:>
//===========================================================================
function registry($option="") {global $bw;
$option['location']=VSFactory::getMenus()->getCategoryGroup("locations")->getChildren();

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs main-tab shadow" role="tablist">
                {$this->__foreach_loop__id_543d24c64de33($option)}
            </ul>
            
            <div class='col-md-12 no-padding'>
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('user_registry_header', 'Đăng ký thành viên')}</span>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        {$this->__foreach_loop__id_543d24c64df1e($option)}
                    </div>
                </div>
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
function __foreach_loop__id_543d24c64de33($option="")
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
                        <a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
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
function __foreach_loop__id_543d24c64df1e($option="")
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

                                    <div class='col-md-9 no-padding'>
                                    {$this->_registryForm($option)}
                                    </div>
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
//===========================================================================
// <vsf:_registryForm:desc::trigger:>
//===========================================================================
function _registryForm($option=array()) {    global $bw;
    
    $this->bw = $bw;
    
//--starthtml--//
$BWHTML .= <<<EOF
        <form class="form-horizontal nail-form-center user-registry-form" role="form" method='post' action='{$bw->base_url}users/do_registry'>
                     
EOF;
if($option['error']) {
$BWHTML .= <<<EOF

              <div class="alert alert-danger fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                          {$this->__foreach_loop__id_543d24c64e241($option)}
                      </div>
             
EOF;
}

$BWHTML .= <<<EOF

                    
                     <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_phone', 'Số phone')}</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_phone_placeholder', 'Số phone tiệm/thợ/công ty/nhà hàng/cá nhân')}" name='{$this->modelName}[name]' value='{$this->bw->input[$this->modelName]['name']}'>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">
                            {$this->getLang()->getWords('registry_form_password', 'Mật khẩu')}
                        </label>
                        <div class="col-md-9">
                          <input type="password" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_password', 'Mật khẩu')}" name='{$this->modelName}[password]'>
                        </div>
                      </div> 
                      <div class="form-group">
                        <label class="col-md-3 control-label">
                            {$this->getLang()->getWords('registry_form_password_confirm', 'Nhập lại mật khẩu')}
                        </label>
                        <div class="col-md-9">
                          <input type="password" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_password_confirm', 'Nhập lại mật khẩu')}" name='{$this->modelName}[password_confirm]'>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_name', 'Tên')}</label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_name_placeholder', 'Tên tiệm/thợ/công ty/nhà hàng/cá nhân')}" name='{$this->modelName}[fullname]' value='{$this->bw->input[$this->modelName]['fullname']}'/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_website', 'Website')}</label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_website', 'Website')}" name='{$this->modelName}[website]' value='{$this->bw->input[$this->modelName]['website']}'/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_address', 'Địa chỉ')}</label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_address', 'Địa chỉ')}" name='{$this->modelName}[address]' value='{$this->bw->input[$this->modelName]['address']}'/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_city', 'Thành phố')}</label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_city', 'Thành phố')}" name='{$this->modelName}[city]' value='{$this->bw->input[$this->modelName]['city']}'/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_state', 'Tiểu bang')}</label>
                        <div class="col-md-4 select-container">
        <select class='form-control' name="{$this->modelName}[location]">
{$this->__foreach_loop__id_543d24c64e3e1($option)}
</select>
                        </div>
                        <label class="col-md-2 control-label zipcode-label">{$this->getLang()->getWords('registry_form_zipcode', 'Zipcode')}</label>
                        <div class="col-md-3  zipcode-input">
                        <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_zipcode', 'Zipcode')}" name='{$this->modelName}[zipcode]' value='{$this->bw->input[$this->modelName]['zipcode']}'/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                          <input type="email" class="form-control" placeholder="Email" name='{$this->modelName}[email]' value='{$this->bw->input[$this->modelName]['email']}'>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('contact_form_capchar', 'Mã bảo vệ')}</label>
                        <div class="col-md-4">
                          <input class="form-control" placeholder="capchar" name='{$this->modelName}[security]' />
                        </div>
                        <div class="col-md-4">
                          <img id="siimage" src="{$this->bw->vars['board_url']}/vscaptcha/" />
                          <a href="javascript:;" id="reload_img" class="mamoi">refresh</a>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">&nbsp;</label>
                        <div class="col-md-9">
                          <button type="submit" class="btn btn-default nail-button">{$this->getLang()->getWords('registry_form_submit', 'Gửi')}</button>
                          <button type="reset" class="btn btn-default nail-button">{$this->getLang()->getWords('registry_form_reset', 'Làm lại')}</button>  
                          <lable class='form-required-note' style='margin-left: 10px;'><span class='required'>*</span>&nbsp;{$this->getLang()->getWords('global_all_required', 'Tất cả thông tin đều bắt buộc')}
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
function __foreach_loop__id_543d24c64e241($option=array())
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
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_543d24c64e318($option=array(),$item='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array( $item->getChildren())){
    foreach(  $item->getChildren() as $key => $child  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
    <option value='{$key}' 
EOF;
if($this->bw->input[$this->modelName]['location'] == $key) {
$BWHTML .= <<<EOF
selected
EOF;
}

$BWHTML .= <<<EOF
>&nbsp;&nbsp;&nbsp;{$child->getTitle()}</option>
    
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_543d24c64e3e1($option=array())
{
    global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array( $option['location'])){
    foreach(  $option['location'] as $item  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
    <optgroup label="{$item->getTitle()}">
    {$this->__foreach_loop__id_543d24c64e318($option,$item)}
    </optgroup>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:renewPassword:desc::trigger:>
//===========================================================================
function renewPassword($option="") {    global $bw;
    
    
//--starthtml--//
$BWHTML .= <<<EOF
        <div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs main-tab shadow" role="tablist">
                {$this->__foreach_loop__id_543d24c64e652($option)}
            </ul>
            
            <div class='col-md-12 no-padding'>
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('renew_password_header', 'Cập nhật mật khẩu mới')}</span>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        {$this->__foreach_loop__id_543d24c64e73b($option)}
                    </div>
                </div>
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
function __foreach_loop__id_543d24c64e652($option="")
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
                        <a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
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
function __foreach_loop__id_543d24c64e73b($option="")
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

                                    <div class='col-md-9 no-padding'>
                                    {$this->_renewPassword($option)}
                                    </div>
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
//===========================================================================
// <vsf:_renewPassword:desc::trigger:>
//===========================================================================
function _renewPassword($option=array()) {    global $bw;
    
    $this->bw= $bw;
    
//--starthtml--//
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

else {
$BWHTML .= <<<EOF
  
            <form class="form-horizontal nail-form-center" role="form" method='post' action='{$this->bw->base_url}users/do_renew_password'>
              <input type='hidden' value='{$option['user']->getId()}' name='{$this->modelName}[id]' />
              
              <div class="form-group">
                <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_phone', 'Số phone')}</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_phone_placeholder', 'Số phone tiệm/thợ/công ty/nhà hàng/cá nhân')}" name='{$this->modelName}[name]'>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-md-3 control-label">
                    {$this->getLang()->getWords('registry_form_password', 'Mật khẩu')}
                </label>
                <div class="col-md-9">
                  <input type="password" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_password', 'Mật khẩu')}" name='{$this->modelName}[password]'>
                </div>
              </div> 
              <div class="form-group">
                <label class="col-md-3 control-label">
                    {$this->getLang()->getWords('registry_form_password_confirm', 'Nhập lại mật khẩu')}
                </label>
                <div class="col-md-9">
                  <input type="password" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_password_confirm', 'Nhập lại mật khẩu')}" name='{$this->modelName}[password_confirm]'>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">&nbsp;</label>
                <div class="col-md-9">
                  <button type="submit" class="btn btn-default nail-button">{$this->getLang()->getWords('registry_form_submit', 'Gửi')}</button>
                  <button type="reset" class="btn btn-default nail-button">{$this->getLang()->getWords('registry_form_reset', 'Làm lại')}</button>
                  <lable class='form-required-note'><span class='required'>*</span>&nbsp;{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
                  <div class='clear'></div>
                </div>
              </div>
            </form>
          
EOF;
}
$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:forgotPassword:desc::trigger:>
//===========================================================================
function forgotPassword($option="") {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs main-tab shadow" role="tablist">
                {$this->__foreach_loop__id_543d24c64ea9b($option)}
            </ul>
            
            <div class='col-md-12 no-padding'>
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('user_forget_password_header', 'Quên mật khẩu')}</span>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        {$this->__foreach_loop__id_543d24c64eb5e($option)}
                    </div>
                </div>
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
function __foreach_loop__id_543d24c64ea9b($option="")
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
                        <a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
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
function __foreach_loop__id_543d24c64eb5e($option="")
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

                                    <div class='col-md-9 no-padding'>
                                    {$this->_forgetPasswordForm($option)}
                                    </div>
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
//===========================================================================
// <vsf:_forgetPasswordForm:desc::trigger:>
//===========================================================================
function _forgetPasswordForm($option=array()) {    global $bw;
     
    $this->bw = $bw;
    
//--starthtml--//
$BWHTML .= <<<EOF
        <form class="form-horizontal nail-form-center" role="form" method='post' action='{$bw->base_url}users/do_forgot_password'>
                     
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

                     <div class="form-group">
                        <label class="col-md-2 control-label">{$this->getLang()->getWords('registry_form_phone', 'Số phone')}</label>
                        <div class="col-md-10">
                          <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_phone_placeholder', 'Số phone tiệm/thợ/công ty/nhà hàng/cá nhân')}" name='{$this->modelName}[name]'>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-2 control-label">Email</label>
                        <div class="col-md-10">
                          <input type="email" class="form-control" placeholder="Email" name='{$this->modelName}[email]' value=''>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-2 control-label">{$this->getLang()->getWords('contact_form_capchar', 'Mã bảo vệ')} <span class='required'>*</span></label>
                        <div class="col-md-4">
                          <input class="form-control" placeholder="capchar" name='{$this->modelName}[security]' />
                        </div>
                        <div class="col-md-4">
                          <img id="siimage" src="{$this->bw->vars['board_url']}/vscaptcha/" />
                          <a href="javascript:;" id="reload_img" class="mamoi">refresh</a>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                          <button type="submit" class="btn btn-default nail-button">{$this->getLang()->getWords('registry_form_submit', 'Gửi')}</button>
                          <button type="reset" class="btn btn-default nail-button">{$this->getLang()->getWords('registry_form_reset', 'Làm lại')}</button>  
                          <lable class='form-required-note'><span class='required'>*</span>&nbsp;{$this->getLang()->getWords('global_all_required', 'Tất cả thông tin đều bắt buộc')}
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
// <vsf:changePassword:desc::trigger:>
//===========================================================================
function changePassword($option="") {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs main-tab shadow" role="tablist">
                {$this->__foreach_loop__id_543d24c64ee73($option)}
            </ul>
    
            <div class='col-md-9 no-padding col-md-9-fix'>
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('renew_password_header', 'Cập nhật mật khẩu mới')}</span>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        {$this->__foreach_loop__id_543d24c64ef40($option)}
                    </div>
                </div>
            </div>    
            {$this->_accountLink()}
            <div class='clear'></div>
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_543d24c64ee73($option="")
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
                        <a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
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
function __foreach_loop__id_543d24c64ef40($option="")
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

                                    {$this->_changePasswordForm($option)}
                                
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
// <vsf:_changePasswordForm:desc::trigger:>
//===========================================================================
function _changePasswordForm($option=array()) {        global $bw;
        
    
//--starthtml--//
$BWHTML .= <<<EOF
        <form class="form-horizontal nail-form" role="form" method='post' action='{$bw->base_url}users/do_change_password'>
              
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

    
              <div class="form-group">
                <label class="col-md-3 control-label">
                    {$this->getLang()->getWords('changepassword_form_password_old', 'Mật khẩu cũ')}
                </label>
                <div class="col-md-9">
                  <input type="password" class="form-control" placeholder="{$this->getLang()->getWords('changepassword_form_password_old', 'Mật khẩu cũ')}" name='{$this->modelName}[password_old]'>
                </div>
              </div> 
              
              <div class="form-group">
                <label class="col-md-3 control-label">
                    {$this->getLang()->getWords('changepassword_form_password_new', 'Mật khẩu mới')}
                </label>
                <div class="col-md-9">
                  <input type="password" class="form-control" placeholder="{$this->getLang()->getWords('changepassword_form_password_new', 'Mật khẩu mới')}" name='{$this->modelName}[password]'>
                </div>
              </div> 
              <div class="form-group">
                <label class="col-md-3 control-label">
                    {$this->getLang()->getWords('changepassword_form_password_new_confirm', 'Nhập lại mật khẩu mới')}
                </label>
                <div class="col-md-9">
                  <input type="password" class="form-control" placeholder="{$this->getLang()->getWords('changepassword_form_password_new_confirm', 'Nhập lại mật khẩu mới')}" name='{$this->modelName}[password_confirm]'>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">&nbsp;</label>
                <div class="col-md-9">
                  <button type="submit" class="btn btn-default nail-button">{$this->getLang()->getWords('registry_form_submit', 'Gửi')}</button>
                  <button type="reset" class="btn btn-default nail-button">{$this->getLang()->getWords('registry_form_reset', 'Làm lại')}</button>
                  <lable class='form-required-note'><span class='required'>*</span>&nbsp;{$this->getLang()->getWords('global_all_required', 'Tất cả thông tin đều bắt buộc')}
                  <div class='clear'></div>
                </div>
              </div>
            </form>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:changeInfo:desc::trigger:>
//===========================================================================
function changeInfo($option="") {global $bw;
$option['location']=VSFactory::getMenus()->getCategoryGroup("locations")->getChildren();
$this->option = $option;
$this->bw = $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs main-tab shadow" role="tablist">
                {$this->__foreach_loop__id_543d24c64f25b($option)}
            </ul>
    
            <div class='col-md-9 no-padding col-md-9-fix'>
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('user_update_header', 'Cập nhật tiệm')}</span>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        {$this->__foreach_loop__id_543d24c64f328($option)}
                    </div>
                </div>
            </div>    
            {$this->_accountLink()}
            <div class='clear'></div>
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_543d24c64f25b($option="")
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
                        <a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
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
function __foreach_loop__id_543d24c64f328($option="")
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

                                    {$this->_changeInfoForm($option)}
                                
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
// <vsf:_changeInfoForm:desc::trigger:>
//===========================================================================
function _changeInfoForm($option=array()) {    global $bw;
    
//--starthtml--//
$BWHTML .= <<<EOF
        <form class="form-horizontal nail-form" role="form" method='post' action='{$bw->base_url}users/do_update'>
                      
EOF;
if($option['error']) {
$BWHTML .= <<<EOF

                  <div class="alert alert-danger fade in" role="alert">
                              <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">×</span>
                              </button>
                              <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                              {$this->__foreach_loop__id_543d24c64f5ea($option)}
                          </div>
              
EOF;
}

$BWHTML .= <<<EOF

                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_phone', 'Số phone')}</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_phone_placeholder', 'Số phone tiệm/thợ/công ty/nhà hàng/cá nhân')}" disabled value='{$option['obj']->getName()}'>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_name', 'Tên')}</label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_name_placeholder', 'Tên tiệm/thợ/công ty/nhà hàng/cá nhân')}" name='{$this->modelName}[fullname]'  value='{$option['obj']->getFullname()}'/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_website', 'Website')}</label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_website', 'Website')}" name='{$this->modelName}[website]'  value='{$option['obj']->getWebsite()}' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_address', 'Địa chỉ')}</label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_address', 'Địa chỉ')}" name='{$this->modelName}[address]' value='{$option['obj']->getAddress()}' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_city', 'Thành phố')}</label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_city', 'Thành phố')}" name='{$this->modelName}[city]' value='{$option['obj']->getCity()}'/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_state', 'Tiểu bang')}</label>
                        <div class="col-md-3  select-container">
        <select class='form-control' name="{$this->modelName}[location]">
{$this->__foreach_loop__id_543d24c64f79f($option)}
</select>
        
                        </div>
                        <label class="col-md-2 control-label zipcode-label">{$this->getLang()->getWords('registry_form_zipcode', 'Zipcode')}</label>
                        <div class="col-md-3">
                        <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_zipcode', 'Zipcode')}" name='{$this->modelName}[zipcode]' value='{$option['obj']->getZipcode()}' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                          <input type="email" class="form-control" placeholder="Email" name='{$this->modelName}[email]' value='{$option['obj']->getEmail()}' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">&nbsp;</label>
                        <div class="col-md-9">
                          <button type="submit" class="btn btn-default nail-button">{$this->getLang()->getWords('registry_form_submit', 'Gửi')}</button>
                          <button type="reset" class="btn btn-default nail-button">{$this->getLang()->getWords('registry_form_reset', 'Làm lại')}</button>
                          <lable class='form-required-note' style='margin-left: 10px;'><span class='required'>*</span>&nbsp;{$this->getLang()->getWords('global_all_required', 'Tất cả thông tin đều bắt buộc')}
                          <div class='clear'></div>
                        </div>
                      </div>
                    </form>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_543d24c64f5ea($option=array())
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
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_543d24c64f6db($option=array(),$item='')
{
;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array( $item->getChildren())){
    foreach(  $item->getChildren() as $key => $child  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
    <option value='{$key}' 
EOF;
if($key == $option['obj']->getLocation()) {
$BWHTML .= <<<EOF
selected
EOF;
}

$BWHTML .= <<<EOF
>&nbsp;&nbsp;&nbsp;{$child->getTitle()}</option>
    
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_543d24c64f79f($option=array())
{
    global $bw;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array( $option['location'])){
    foreach(  $option['location'] as $item  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
    <optgroup label="{$item->getTitle()}">
    {$this->__foreach_loop__id_543d24c64f6db($option,$item)}
    </optgroup>

EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:_accountLink:desc::trigger:>
//===========================================================================
function _accountLink() {    global $bw;
    
//--starthtml--//
$BWHTML .= <<<EOF
        <div class='col-md-3 col-md-3-fix col-md-3-fix-link shadow'>
        <div class='content custom-content account-link col-md-3-special'>
            <div class='sub-header'>
                <span>{$this->getLang()->getWords('user_update_header', 'Quản lý tài khoản')}</span>
            </div>
            <div class='account-link-detail'>
               <a href='{$bw->base_url}users/update' 
EOF;
if($bw->input['action'] == 'users_update') {
$BWHTML .= <<<EOF
class='active'
EOF;
}

$BWHTML .= <<<EOF
 title='{$this->getLang()->getWords('update-store', 'Cập nhật tiêm (Tài khoản)')}'>
                    {$this->getLang()->getWords('update-store', 'Cập nhật tiệm (Tài khoản)')} 
               </a>
               
               <a href='{$bw->base_url}users/change_password' 
EOF;
if($bw->input['action'] == 'users_change_password') {
$BWHTML .= <<<EOF
class='active'
EOF;
}

$BWHTML .= <<<EOF
 title='{$this->getLang()->getWords('change_password', 'Cập nhật mật khẩu')}'>
                    {$this->getLang()->getWords('change_password', 'Cập nhật mật khẩu')}
               <a>
               
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
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:doForgotPassword:desc::trigger:>
//===========================================================================
function doForgotPassword($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs main-tab shadow" role="tablist">
                {$this->__foreach_loop__id_543d24c64fabf($option)}
            </ul>
            
            <div class='col-md-12 no-padding'>
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('user_forget_password_header', 'Quên mật khẩu')}</span>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        {$this->__foreach_loop__id_543d24c64fba6($option)}
                    </div>
                </div>
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
function __foreach_loop__id_543d24c64fabf($option=array())
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
                        <a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
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
function __foreach_loop__id_543d24c64fba6($option=array())
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

                                    {$this->getLang()->getWords('user_forget_password_success', 'Chúng tôi đã gửi email để cập nhật password mới cho bạn, xin vui lòng kiểm tra email')}
                                
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
// <vsf:doSendPasswordForm:desc::trigger:>
//===========================================================================
function doSendPasswordForm($obj="",$option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <p>Chào {$obj->getFullname()}, bạn vừa yêu cầu lấy lại mật khẩu</p>
<p>Vui lòng truy cập vào địa chỉ sau để đổi lại mật khẩu</p>
<p>
<a  href="{$bw->base_url}users/renew_password/{$obj->getId()}/{$option['token']}">
{$bw->base_url}users/renew_password/{$obj->getId()}/{$option['token']}
</a>
</p>
EOF;
//--endhtml--//
return $BWHTML;
}


}
?>