<?php

class skin_users extends skin_objectpublic {
	
function registry($option){
		global $bw;
		
		$option['location']=VSFactory::getMenus()->getCategoryGroup("locations")->getChildren();
		$BWHTML .= <<<EOF
		
		
		<div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs main-tab shadow" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['category']->getId() ">class='active'</if>>
                        <a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
            
            <div class='col-md-12 no-padding'>
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('user_registry_header', 'Đăng ký thành viên')}</span>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <foreach=" $option['cate'] as $key => $cat">
                            <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                                <if=" !empty($option[$key]) ">
                                    <div class='col-md-9 no-padding'>
                                    {$this->_registryForm($option)}
                                    </div>
                                    <div class='clear'></div>
                                </if>
                            </div>
                        </foreach>
                    </div>
                </div>
            </div>    
            <div class='clear'></div>
        </div>
EOF;
	}

function _registryForm($option = array()){
	    global $bw;
	    
	    $this->bw = $bw;
	    $BWHTML .= <<<EOF
	               <form class="form-horizontal nail-form-center" role="form" method='post' action='{$bw->base_url}users/do_registry'>
                     <if="$option['error']">
            		  <div class="alert alert-danger fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                          <p>{$option['error']}</p>
                      </div>
        		     </if>
                    
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
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_name', 'Tên')} <span class='required'>*</span></label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_name_placeholder', 'Tên tiệm/thợ/công ty/nhà hàng/cá nhân')}" name='{$this->modelName}[fullname]' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_website', 'Website')} <span class='required'>*</span></label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_website', 'Website')}" name='{$this->modelName}[website]' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_address', 'Địa chỉ')} <span class='required'>*</span></label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_address', 'Địa chỉ')}" name='{$this->modelName}[address]' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_city', 'Thành phố')} <span class='required'>*</span></label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_city', 'Thành phố')}" name='{$this->modelName}[city]' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_state', 'Tiểu bang')} <span class='required'>*</span></label>
                        <div class="col-md-4 select-container">
                            <select class='form-control' name="{$this->modelName}[location]">
        					<foreach="$option['location'] as $location">
        					   <option <if="$this->bw->input[$this->modelName]['location']==$location->getId()">selected='selected'</if> value="{$location->getId()}">{$location->getTitle()}</option>
        					</foreach>
        					</select>
                        </div>
                        <label class="col-md-2 control-label zipcode-label">{$this->getLang()->getWords('registry_form_zipcode', 'Zipcode')} <span class='required'>*</span></label>
                        <div class="col-md-3  zipcode-input">
                        <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_zipcode', 'Zipcode')}" name='{$this->modelName}[zipcode]' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                          <input type="email" class="form-control" placeholder="Email" name='{$this->modelName}[email]' value=''>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('contact_form_capchar', 'Mã bảo vệ')} <span class='required'>*</span></label>
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
                          <lable class='pull-right'><span class='required'>*</span>&nbsp;{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
                          <div class='clear'></div>
                        </div>
                      </div>
                    </form>
EOF;
	}	
	
function renewPassword($option){
	    global $bw;
	    
	    $BWHTML .= <<<EOF
	    
	    <div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs main-tab shadow" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['category']->getId() ">class='active'</if>>
                        <a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
            
            <div class='col-md-12 no-padding'>
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('renew_password_header', 'Cập nhật mật khẩu mới')}</span>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <foreach=" $option['cate'] as $key => $cat">
                            <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                                <if=" !empty($option[$key]) ">
                                    <div class='col-md-9 no-padding'>
                                    {$this->_renewPassword($option)}
                                    </div>
                                    <div class='clear'></div>
                                </if>
                            </div>
                        </foreach>
                    </div>
                </div>
            </div>    
            <div class='clear'></div>
        </div>
EOF;
	}	
	
function _renewPassword($option=array()){
	    global $bw;
	    
	    $this->bw= $bw;
	    $BWHTML .= <<<EOF
         <if="$option['error']">
		 <div class="alert alert-danger fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">×</span>
              </button>
              <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
              <p>{$option['error']}</p>
          </div>
        <else />  
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
                  <lable class='pull-right'><span class='required'>*</span>&nbsp;{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
                  <div class='clear'></div>
                </div>
              </div>
            </form>
          </if>
EOF;
	}
	
function forgotPassword($option){
		global $bw;
		$BWHTML .= <<<EOF
		
		<div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs main-tab shadow" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['category']->getId() ">class='active'</if>>
                        <a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
            
            <div class='col-md-12 no-padding'>
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('user_forget_password_header', 'Quên mật khẩu')}</span>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <foreach=" $option['cate'] as $key => $cat">
                            <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                                <if=" !empty($option[$key]) ">
                                    <div class='col-md-9 no-padding'>
                                    {$this->_forgetPasswordForm($option)}
                                    </div>
                                    <div class='clear'></div>
                                </if>
                            </div>
                        </foreach>
                    </div>
                </div>
            </div>    
            <div class='clear'></div>
        </div>
EOF;
	}

function _forgetPasswordForm($option = array()){
	    global $bw;
	     
	    $this->bw = $bw;
	    $BWHTML .= <<<EOF
	               <form class="form-horizontal nail-form-center" role="form" method='post' action='{$bw->base_url}users/do_forgot_password'>
                     <if="$option['error']">
            		  <div class="alert alert-danger fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                          <p>{$option['error']}</p>
                      </div>
        		     </if>
	
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
                          <lable class='pull-right'><span class='required'>*</span>&nbsp;{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
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
	}	
	
function changePassword($option){
		global $bw;
		$BWHTML .= <<<EOF
        <div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs main-tab shadow" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['category']->getId() ">class='active'</if>>
                        <a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
    
            <div class='col-md-9 no-padding col-md-9-fix'>
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('renew_password_header', 'Cập nhật mật khẩu mới')}</span>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <foreach=" $option['cate'] as $key => $cat">
                            <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                                <if=" !empty($option[$key]) ">
                                    {$this->_changePasswordForm($option)}
                                </if>
                            </div>
                        </foreach>
                    </div>
                </div>
            </div>    
            {$this->_accountLink()}
            <div class='clear'></div>
        </div>
EOF;
	}
	
function _changePasswordForm($option = array()){
        global $bw;
        
	    $BWHTML .= <<<EOF
           <form class="form-horizontal nail-form" role="form" method='post' action='{$bw->base_url}users/do_change_password'>
              <if="$option['error']">
        		  <div class="alert alert-danger fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">×</span>
                      </button>
                      <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                      <p>{$option['error']}</p>
                  </div>
    		    </if>
		    
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
                  <lable class='pull-right'><span class='required'>*</span>&nbsp;{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
                  <div class='clear'></div>
                </div>
              </div>
            </form>
EOF;
	}
		
function changeInfo($option){
		global $bw;
		
		$option['location']=VSFactory::getMenus()->getCategoryGroup("locations")->getChildren();
		
		$this->option = $option;
		$this->bw = $bw;
		
		$BWHTML .= <<<EOF
		
		<div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs main-tab shadow" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['category']->getId() ">class='active'</if>>
                        <a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
    
            <div class='col-md-9 no-padding col-md-9-fix'>
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('user_update_header', 'Cập nhật tiệm')}</span>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <foreach=" $option['cate'] as $key => $cat">
                            <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                                <if=" !empty($option[$key]) ">
                                    {$this->_changeInfoForm($option)}
                                </if>
                            </div>
                        </foreach>
                    </div>
                </div>
            </div>    
            {$this->_accountLink()}
            <div class='clear'></div>
        </div>
EOF;
	}
	
function _changeInfoForm($option = array()){
    global $bw;
    $BWHTML .= <<<EOF
                    <form class="form-horizontal nail-form" role="form" method='post' action='{$bw->base_url}users/do_update'>
                      <if="$option['error']">
            		      <div class="alert alert-danger fade in" role="alert">
                              <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">×</span>
                              </button>
                              <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                              <p>{$option['error']}</p>
                          </div>
            		  </if>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_phone', 'Số phone')}</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_phone_placeholder', 'Số phone tiệm/thợ/công ty/nhà hàng/cá nhân')}" disabled value='{$option['obj']->getName()}'>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_name', 'Tên')} <span class='required'>*</span></label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_name_placeholder', 'Tên tiệm/thợ/công ty/nhà hàng/cá nhân')}" name='{$this->modelName}[fullname]'  value='{$option['obj']->getFullname()}'/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_website', 'Website')} <span class='required'>*</span></label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_website', 'Website')}" name='{$this->modelName}[website]'  value='{$option['obj']->getWebsite()}' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_address', 'Địa chỉ')} <span class='required'>*</span></label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_address', 'Địa chỉ')}" name='{$this->modelName}[address]' value='{$option['obj']->getAddress()}' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_city', 'Thành phố')} <span class='required'>*</span></label>
                        <div class="col-md-9">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_city', 'Thành phố')}" name='{$this->modelName}[city]' value='{$option['obj']->getCity()}'/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">{$this->getLang()->getWords('registry_form_state', 'Tiểu bang')} <span class='required'>*</span></label>
                        <div class="col-md-3  select-container">
                            <select class='form-control' name="{$this->modelName}[location]">
        					<foreach="$option['location'] as $location">
        					   <option <if="$option['obj']->getLocation() == $location->getId()">selected='selected'</if> value="{$location->getId()}">{$location->getTitle()}</option>
        					</foreach>
        					</select>
                        </div>
                        <label class="col-md-2 control-label zipcode-label">{$this->getLang()->getWords('registry_form_zipcode', 'Zipcode')} <span class='required'>*</span></label>
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
                          <lable class='pull-right'><span class='required'>*</span>&nbsp;{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
                          <div class='clear'></div>
                        </div>
                      </div>
                    </form>
EOF;
}

function _accountLink() {
    global $bw;

    $BWHTML .= <<<EOF
    <div class='col-md-3 col-md-3-fix col-md-3-fix-link shadow'>
        <div class='content custom-content account-link col-md-3-special'>
            <div class='sub-header'>
                <span>{$this->getLang()->getWords('user_update_header', 'Quản lý tài khoản')}</span>
            </div>
            <div class='account-link-detail'>
               <a href='{$bw->base_url}users/update' title='{$this->getLang()->getWords('update-store', 'Cập nhật tiêm (Tài khoản)')}'>
                    {$this->getLang()->getWords('update-store', 'Cập nhật tiêm (Tài khoản)')} 
               </a>
               
               <a href='{$bw->base_url}users/change_password' title='{$this->getLang()->getWords('change_password', 'Cập nhật mật khẩu')}'>
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
    return $BWHTML;
}

function doForgotPassword($option=array()){
		global $bw;
		$BWHTML .= <<<EOF
		
		<div class='col-md-12 no-padding'>
            <ul class="nav nav-tabs main-tab shadow" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if="$key == $option['category']->getId() ">class='active'</if>>
                        <a href="{$this->bw->base_url}posts/category/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
            
            <div class='col-md-12 no-padding'>
                <div class='content shadow content-special'>
                    <div class='sub-header'>
                        <span>{$this->getLang()->getWords('user_forget_password_header', 'Quên mật khẩu')}</span>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <foreach=" $option['cate'] as $key => $cat">
                            <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                                <if=" !empty($option[$key]) ">
                                    {$this->getLang()->getWords('user_forget_password_success', 'Chúng tôi đã gửi email để cập nhật password mới cho bạn, xin vui lòng kiểm tra email')}
                                </if>
                            </div>
                        </foreach>
                    </div>
                </div>
            </div>    
            <div class='clear'></div>
        </div>
EOF;
	}
	
function doSendPasswordForm($obj, $option=array()){
		global $bw;
		$BWHTML .= <<<EOF
		
		<p>Chào {$obj->getFullname()}, bạn vừa yêu cầu lấy lại mật khẩu</p>
		<p>Vui lòng truy cập vào địa chỉ sau để đổi lại mật khẩu</p>
		<p>
			<a  href="{$bw->base_url}users/renew_password/{$obj->getId()}/{$option['token']}">
				{$bw->base_url}users/renew_password/{$obj->getId()}/{$option['token']}
			</a>
		</p>
EOF;
	}
}
