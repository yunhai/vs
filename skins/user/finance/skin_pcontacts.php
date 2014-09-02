<?php

class skin_pcontacts extends skin_objectpublic{
function showDefault($obj,$option = array()) {
		global $bw;
		
		$BWHTML .= <<<EOF
		
		
		<div>
            <ul class="nav nav-tabs" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if=" $key == $option['category']->getId() ">class='active'</if>>
                        <a href="{$this->bw->base_url}contacts/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
    
            <div class='content'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('contact_header', 'Thông tin liên hệ')}</span>
                </div>
                
                <!-- Tab panes -->
                <div class="tab-content">
                    <foreach=" $option['cate'] as $key => $cat">
                        <div class="tab-pane <if=" $key == $option['category']->getId() ">active</if>" id="tab{$key}" ref="{$key}">
                            <if=" !empty($option[$key]) ">
                                <div class='col-md-6 left'>
                                    <div class="title">{$obj->getTitle()}</div>
                                    <div class="info">{$obj->getContent()}</div>
                                    <div class='form-container'>{$this->getContactForm($option, $cat)}</div>
                                </div>
                                <div class='col-md-6 map'>
    	           		            <div id='map_canvas'></div>
                                </div>
                                <div class="clear"></div>
                            </if>
                        </div>
                    </foreach>
                </div>
            </div>
            <script>
                $('a[data-toggle="tab"]').on('click', function (e) {
                    window.location.href = $(e.target).attr("href");
                });
            </script>
	   </div>
       <script>
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
        </script>
EOF;
	}
	
function getContactForm($option = array(), $category = array()) {
		global $bw;
		
		$BWHTML .= <<<EOF
		  <if="$option['error']">
    		  <div class="alert alert-danger fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">×</span>
                  </button>
                  <h4>{$this->getLang()->getWords('global_error_title', 'Đã có lỗi xảy ra')}</h4>
                  <p>{$option['error']}</p>
              </div>
		  </if>
		  <form class="form-horizontal" role="form" method='post' action='{$bw->base_url}contacts/submit/{$category->getSlugId()}'>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">
                    {$this->getLang()->getWords('contact_form_fullname', 'Họ tên')}
                </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('contact_form_fullname', 'Họ tên')}" name='{$this->modelName}[name]' value='{$option['obj']->getName()}'>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">
                    {$this->getLang()->getWords('contact_form_address', 'Địa chỉ')}
                </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('contact_form_address', 'Địa chỉ')}" name='{$this->modelName}[address]' value='{$option['obj']->getAddress()}'>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">{$this->getLang()->getWords('contact_form_phone', 'Điện thoại')}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('contact_form_phone', 'Điện thoại')}" name='{$this->modelName}[phone]' value='{$option['obj']->getPhone()}'>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" placeholder="Email" name='{$this->modelName}[email]' value='{$option['obj']->getEmail()}'>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">{$this->getLang()->getWords('contact_form_title', 'Tiêu đề')}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="{$this->getLang()->getWords('contact_form_title', 'Tiêu đề')}" name='{$this->modelName}[title]' value='{$option['obj']->getTitle()}'>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">{$this->getLang()->getWords('contact_form_detail', 'Nội dung')} (<span class='required'>*</span>)</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="3" name='{$this->modelName}[content]'>{$option['obj']->getContent()}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">{$this->getLang()->getWords('contact_form_capchar', 'Mã bảo vệ')} (<span class='required'>*</span>)</label>
                <div class="col-sm-10">
                  <input class="form-control" placeholder="capchar" name='{$this->modelName}[sec_code]' value='' />
                  <img id="siimage" src="{$bw->vars['board_url']}/vscaptcha/" />
                  <a href="javascript:;" id="reload_img" class="mamoi">refresh</a>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-default" name='btnSubmit' value='{$this->getLang()->getWords('contact_form_submit', 'Gửi')}' />
                  <button type="reset" class="btn btn-default">{$this->getLang()->getWords('contact_form_reset', 'Làm lại')}</button>  
                  <lable><span class='require'>*</span>{$this->getLang()->getWords('global_require', 'Thông tin bắt buộc')}
                </div>
              </div>
          </form>
		<!--
                    <form id="contact" class="contact" method="POST" action="">
                     <label>Họ tên<span>(*)</span> </label><input class="an" name="name" required type="name" class="col_left" value="{$option['obj']->getName()}"  />
                    <div class="clear"></div>
                    
                   
                    
                    <label>Điện thoại<span>(*)</span></label><input name="phone" required type="name"  value="{$option['obj']->getPhone()}"  />
                    <div class="clear"></div>
                    
                    <label>Email<span>(*)</span></label><input  name="email" required type="email" value="{$option['obj']->getEmail()}"  />                           
                    <div class="clear"></div>
                    
                  	<label>Tiêu đề<span>(*)</span> </label><input class="an" name="title" required type="name" class="col_left" value="{$option['obj']->getTitle()}"  />
                    <div class="clear"></div>
                    <label>Nội dung:</label><textarea class="an" name="content">{$option['obj']->getContent()}</textarea>
                    <div class="clear"></div>
                     <label>Mã bảo vệ :</label><input  name="sec_code"  type="text" style="width:100px" />
                     <img id="siimage" src="{$bw->vars['board_url']}/vscaptcha/" />
                     <a href="#" id="reload_img" class="mamoi">refresh</a>
                    <div class="clear"></div> 
                    <input type="submit" name="btnSubmit" value="Gửi" class="input_submit" />
                    <input type="reset" name="btnSubmit" value="Làm lại" class="input_reset" />
                   
                    <div class="clear"></div>
               </form>
                             -->
                 <script>
                            $("#reload_img").click(function(){
                            $("#siimage").attr("src",$("#siimage").attr("src")+"?a");
                            return false;
				});
				
					
							
</script>
                    
EOF;
	} 
	
function sendContactSuccess($obj,$option = array()) {
		global $bw;
		
		$BWHTML .= <<<EOF
		<div>
            <ul class="nav nav-tabs" role="tablist">
                <foreach=" $option['cate'] as $key=>$cat">
                    <li id='{$key}' <if=" $key == $option['category']->getId() ">class='active'</if>>
                        <a href="{$this->bw->base_url}contacts/{$cat->getSlugId()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                    </li>
                </foreach>
            </ul>
    
            <div class='content'>
                <div class='sub-header'>
                    <span>{$this->getLang()->getWords('contact_header', 'Thông tin liên hệ')}</span>
                </div>
                
                <!-- Tab panes -->
                <div class="tab-content">
                    <foreach=" $option['cate'] as $key => $cat">
                        <div class="tab-pane <if=" $key == $option['category']->getId() ">active</if>" id="tab{$key}" ref="{$key}">
                            <if=" !empty($option[$key]) ">
                                <div class='col-md-6 left'>
                                    <div class="title">{$obj->getTitle()}</div>
                                    <div class="info">{$obj->getContent()}</div>
                                    <div class='form-container'>{$this->getLang()->getWords('contact_thankyou')}</div>
                                </div>
                                <div class='col-md-6 map'>
    	           		            <div id='map_canvas'></div>
                                </div>
                                <div class="clear"></div>
                            </if>
                        </div>
                    </foreach>
                </div>
            </div>
            <script>
                $('a[data-toggle="tab"]').on('click', function (e) {
                    window.location.href = $(e.target).attr("href");
                });
            </script>
	   </div>
		<script>
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
	}
}
?>