<?php

class skin_users extends skin_objectpublic {
	
function registry($option){
		global $bw;
		
		$option['location']=VSFactory::getMenus()->getCategoryGroup("locations")->getChildren();
		$BWHTML .= <<<EOF
		
		<div>
            <div class='content'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('user_registry_header', 'Đăng ký thành viên')}</span>
                </div>
                
                <div class='col-sm-8'>
                    <if="$option['error']">
            		  <div class="alert alert-danger fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                          <p>{$option['error']}</p>
                      </div>
        		    </if>
		  
                    <form class="form-horizontal" role="form" method='post' action='{$bw->base_url}users/do_registry'>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('registry_form_phone', 'Số phone')}</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_phone_placeholder', 'Số phone tiệm/thợ/công ty/nhà hàng/cá nhân')}" name='{$this->modelName}[name]'>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">
                            {$this->getLang()->getWords('registry_form_password', 'Mật khẩu')}
                        </label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_password', 'Mật khẩu')}" name='{$this->modelName}[password]'>
                        </div>
                      </div> 
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">
                            {$this->getLang()->getWords('registry_form_password_confirm', 'Nhập lại mật khẩu')}
                        </label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_password_confirm', 'Nhập lại mật khẩu')}" name='{$this->modelName}[password_confirm]'>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('registry_form_name', 'Tên')} (<span class='required'>*</span>)</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_name_placeholder', 'Tên tiệm/thợ/công ty/nhà hàng/cá nhân')}" name='{$this->modelName}[fullname]' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('registry_form_address', 'Địa chỉ')} (<span class='required'>*</span>)</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_address', 'Địa chỉ')}" name='{$this->modelName}[address]' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('registry_form_city', 'Thành phố')} (<span class='required'>*</span>)</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_city', 'Thành phố')}" name='{$this->modelName}[city]' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('registry_form_state', 'Tiểu bang')} (<span class='required'>*</span>)</label>
                        <div class="col-sm-4">
                            <select class='form-control' name="{$this->modelName}[location]">
        					<foreach="$option['location'] as $location">
        					   <option <if="$bw->input[$this->modelName]['location']==$location->getId()">selected='selected'</if> value="{$location->getId()}">{$location->getTitle()}</option>
        					</foreach>
        					</select>
                        </div>
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('registry_form_zipcode', 'Zipcode')} (<span class='required'>*</span>)</label>
                        <div class="col-sm-4">
                        <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_zipcode', 'Zipcode')}" name='{$this->modelName}[zipcode]' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" placeholder="Email" name='{$this->modelName}[email]' value=''>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('contact_form_capchar', 'Mã bảo vệ')} (<span class='required'>*</span>)</label>
                        <div class="col-sm-4">
                          <input class="form-control" placeholder="capchar" name='{$this->modelName}[sec_code]' />
                        </div>
                        <div class="col-sm-4">
                          <img id="siimage" src="{$bw->vars['board_url']}/vscaptcha/" />
                          <a href="javascript:;" id="reload_img" class="mamoi">refresh</a>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-default">{$this->getLang()->getWords('registry_form_submit', 'Gửi')}</button>
                          <button type="reset" class="btn btn-default">{$this->getLang()->getWords('registry_form_reset', 'Làm lại')}</button>  
                          <lable><span class='require'>*</span>{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
                        </div>
                      </div>
                    </form>
                </div>
                <div class='clear'></div>
            </div>
            <script>
                $("#reload_img").click(function(){
                    $("#siimage").attr("src",$("#siimage").attr("src")+"?a");
                    return false;
				});
            </script>
		</div>
EOF;
	}

	
function renewPassword($option){
	    global $bw;
	    
	    $BWHTML .= <<<EOF
        <div>
            <div class='content'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('renew_password_header', 'Cập nhật mật khẩu mới')}</span>
                </div>
                
                <div class='col-sm-8'>
                    <if="$option['error']">
            		  <div class="alert alert-danger fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                          <p>{$option['error']}</p>
                      </div>
		            <else />  
                        <form class="form-horizontal" role="form" method='post' action='{$bw->base_url}users/do_renew_password'>
                          <input type='hidden' value='{$option['user']->getId()}' name='{$this->modelName}[id]' />
                          
                          <div class="form-group">
                            <label class="col-sm-2 control-label">{$this->getLang()->getWords('registry_form_phone', 'Số phone')}</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_phone_placeholder', 'Số phone tiệm/thợ/công ty/nhà hàng/cá nhân')}" name='{$this->modelName}[name]'>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">
                                {$this->getLang()->getWords('registry_form_password', 'Mật khẩu')}
                            </label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_password', 'Mật khẩu')}" name='{$this->modelName}[password]'>
                            </div>
                          </div> 
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">
                                {$this->getLang()->getWords('registry_form_password_confirm', 'Nhập lại mật khẩu')}
                            </label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_password_confirm', 'Nhập lại mật khẩu')}" name='{$this->modelName}[password_confirm]'>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-default">{$this->getLang()->getWords('registry_form_submit', 'Gửi')}</button>
                              <button type="reset" class="btn btn-default">{$this->getLang()->getWords('registry_form_reset', 'Làm lại')}</button>  
                              <lable><span class='require'>*</span>{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
                            </div>
                          </div>
                        </form>
                      </if>
                </div>
                <div class='clear'></div>
            </div>
		</div>
EOF;
	}	
	
	
function forgotPassword($option){
		global $bw;
		$BWHTML .= <<<EOF
		
		
		<div>
            <div class='content'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('user_forget_password_header', 'Quên mật khẩu')}</span>
                </div>
                
                <div class='col-sm-8'>
                    <if="$option['error']">
            		  <div class="alert alert-danger fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                          <p>{$option['error']}</p>
                      </div>
        		    </if>
		  
                    <form class="form-horizontal" role="form" method='post' action='{$bw->base_url}users/do_forgot_password'>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('registry_form_phone', 'Số phone')}</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_phone_placeholder', 'Số phone tiệm/thợ/công ty/nhà hàng/cá nhân')}" name='{$this->modelName}[name]'>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" placeholder="Email" name='{$this->modelName}[email]' value=''>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('contact_form_capchar', 'Mã bảo vệ')} (<span class='required'>*</span>)</label>
                        <div class="col-sm-4">
                          <input class="form-control" placeholder="capchar" name='{$this->modelName}[sec_code]' />
                        </div>
                        <div class="col-sm-4">
                          <img id="siimage" src="{$bw->vars['board_url']}/vscaptcha/" />
                          <a href="javascript:;" id="reload_img" class="mamoi">refresh</a>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-default">{$this->getLang()->getWords('registry_form_submit', 'Gửi')}</button>
                          <button type="reset" class="btn btn-default">{$this->getLang()->getWords('registry_form_reset', 'Làm lại')}</button>  
                          <lable><span class='require'>*</span>{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
                        </div>
                      </div>
                    </form>
                </div>
                <div class='clear'></div>
            </div>
            <script>
                $("#reload_img").click(function(){
                    $("#siimage").attr("src",$("#siimage").attr("src")+"?a");
                    return false;
				});
            </script>
		</div>
EOF;
	}

function changePassword($option){
		global $bw;
		$BWHTML .= <<<EOF
        <div>
            <div class='content'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('renew_password_header', 'Cập nhật mật khẩu mới')}</span>
                </div>
                
                <div class='col-sm-8'>
                        <if="$option['error']">
                		  <div class="alert alert-danger fade in" role="alert">
                              <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">×</span>
                              </button>
                              <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                              <p>{$option['error']}</p>
                          </div>
            		    </if>
        		    
                        <form class="form-horizontal" role="form" method='post' action='{$bw->base_url}users/do_change_password'>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">
                                {$this->getLang()->getWords('changepassword_form_password_old', 'Mật khẩu cũ')}
                            </label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" placeholder="{$this->getLang()->getWords('changepassword_form_password_old', 'Mật khẩu cũ')}" name='{$this->modelName}[password_old]'>
                            </div>
                          </div> 
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">
                                {$this->getLang()->getWords('changepassword_form_password_new', 'Mật khẩu mới')}
                            </label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" placeholder="{$this->getLang()->getWords('changepassword_form_password_new', 'Mật khẩu mới')}" name='{$this->modelName}[password]'>
                            </div>
                          </div> 
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">
                                {$this->getLang()->getWords('changepassword_form_password_new_confirm', 'Nhập lại mật khẩu mới')}
                            </label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" placeholder="{$this->getLang()->getWords('changepassword_form_password_new_confirm', 'Nhập lại mật khẩu mới')}" name='{$this->modelName}[password_confirm]'>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-default">{$this->getLang()->getWords('changepassword_form_submit', 'Gửi')}</button>
                              <button type="reset" class="btn btn-default">{$this->getLang()->getWords('changepassword_form_reset', 'Làm lại')}</button>  
                              <lable><span class='require'>*</span>{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
                            </div>
                          </div>
                        </form>
                </div>
                <div class='clear'></div>
            </div>
		</div>
EOF;
	}
	
function changeInfo($option){
		global $bw;
		
		$option['location']=VSFactory::getMenus()->getCategoryGroup("locations")->getChildren();
		
		$BWHTML .= <<<EOF
        <div>
            <div class='content'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('user_update_header', 'Cập nhật tiệm')}</span>
                </div>
                
                <div class='col-sm-8'>
                    <if="$option['error']">
            		  <div class="alert alert-danger fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                          <p>{$option['error']}</p>
                      </div>
        		    </if>
		  
                    <form class="form-horizontal" role="form" method='post' action='{$bw->base_url}users/do_update'>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('registry_form_phone', 'Số phone')}</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('registry_form_phone_placeholder', 'Số phone tiệm/thợ/công ty/nhà hàng/cá nhân')}" disabled value='{$option['obj']->getName()}'>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('registry_form_name', 'Tên')} (<span class='required'>*</span>)</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_name_placeholder', 'Tên tiệm/thợ/công ty/nhà hàng/cá nhân')}" name='{$this->modelName}[fullname]'  value='{$option['obj']->getFullname()}'/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('registry_form_address', 'Địa chỉ')} (<span class='required'>*</span>)</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_address', 'Địa chỉ')}" name='{$this->modelName}[address]'  value='{$option['obj']->getAddress()}' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('registry_form_city', 'Thành phố')} (<span class='required'>*</span>)</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_city', 'Thành phố')}" name='{$this->modelName}[city]' value='{$option['obj']->getCity()}'/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('registry_form_state', 'Tiểu bang')} (<span class='required'>*</span>)</label>
                        <div class="col-sm-4">
                            <select class='form-control' name="{$this->modelName}[location]">
        					<foreach="$option['location'] as $location">
        					   <option <if="$option['obj']->getLocation() == $location->getId()">selected='selected'</if> value="{$location->getId()}">{$location->getTitle()}</option>
        					</foreach>
        					</select>
                        </div>
                        <label class="col-sm-2 control-label">{$this->getLang()->getWords('registry_form_zipcode', 'Zipcode')} (<span class='required'>*</span>)</label>
                        <div class="col-sm-4">
                        <input class="form-control" type="text" placeholder="{$this->getLang()->getWords('registry_form_zipcode', 'Zipcode')}" name='{$this->modelName}[zipcode]' value='{$option['obj']->getZipcode()}' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" placeholder="Email" name='{$this->modelName}[email]' value='{$option['obj']->getEmail()}' />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-default">{$this->getLang()->getWords('registry_form_submit', 'Gửi')}</button>
                          <button type="reset" class="btn btn-default">{$this->getLang()->getWords('registry_form_reset', 'Làm lại')}</button>  
                          <lable><span class='require'>*</span>{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}</label>
                        </div>
                      </div>
                    </form>
                </div>
                {$this->getAddon()->getUserSideBar($option)}
                <div class='clear'></div>
            </div>
		</div>
EOF;
	}
	
function doForgotPassword($option=array()){
		global $bw;
		$BWHTML .= <<<EOF
		<div>
            <div class='content'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('user_forget_password_header', 'Quên mật khẩu')}</span>
                </div>
                
                <div class='col-sm-8'>
                    {$this->getLang()->getWords('user_forget_password_success', 'Chúng tôi đã gửi email để cập nhật password mới cho bạn, xin vui lòng kiểm tra email')}
                </div>
                <div class='clear'></div>
            </div>
		</div>
EOF;
	}
	
function doSendPasswordForm($obj,$option=array()){
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

function loginForm($option){

    global $bw;
    $BWHTML .= <<<EOF
		<div id="content">
        	<div id="content_center">
            	<div class="content_left">
                	<div class="main_title">
	                	<h1>Đăng nhập </h1>
                    </div>
                        <p>{$option['message']}</p>
            
                </div>

                <div class="content_right">
					{$this->getAddon()->getLoginForm($option)}

                </div>
            	<div class="clear"></div>
            </div>
        </div>
EOF;
	}
