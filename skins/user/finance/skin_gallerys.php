<?php
class skin_gallerys{
	function showDetail($obj,$option = array()){
		global $bw,$vsLang,$vsPrint,$vsTemplate,$vsMenu;
               
		$BWHTML .= <<<EOF
		<div id="content">
    	<div class="main_title">
        	<h3 class="main_title_gallery2">{$vsLang->getWords('pageTitle','Địa chỉ')}</h3>
              
        </div>
        
        <div class="gallery">
                <if="$option['img']">
                    <foreach="$option['img'] as $img">
                        <a href="{$img->getCacheImagePathByFile($img,1,1,1,1)}" class="highslide" onclick="return hs.expand(this)">{$img->createImageCache($img, 149, 148, 1)}</a>
                    </foreach>
                </if>
            <div class="clear_left"></div>
        </div>
                
      <if="$obj->GetContent()">          
        <div class="main_title"><h3 class="main_title_gallery">Video</h3></div>
        {$obj->GetContent()}
      </if>     
    </div>
EOF;
	}
	
	function showDefault($option = array()){
		global $bw,$vsLang,$vsPrint,$vsTemplate,$vsMenu;
                
		$BWHTML .= <<<EOF
	<div id="content">
    	<div class="main_title">
        	<h3 class="main_title_gallery">{$vsLang->getWords('pageTitle','Địa chỉ')}</h3>            
        </div>
        <div class="gallery_dangnhap">
        	<if="$option['page']">
                    {$option['page']->getContent()}
                </if>
            <form>
            	<label>{$vsLang->getWords('pagetendangnhap','Tên đăng nhập')}: </label>
                <input type="text" id="contactName">
                <input type="button" value="ĐĂNG NHẬP" id="id_gallery_btn" class="gallery_btn">
                <div class="clear"></div>
            </form>
        </div>
    </div>
    <script>
    $(document).ready(function(){
    $('#id_gallery_btn').click(function(){
        if(!$('#contactName').val()) {
                jAlert('{$vsLang->getWords('err_contact_album','Nhập tên Album mà bạn cần tìm!')}','{$bw->vars['global_websitename']} Dialog');
                $('#contactName').addClass('vs-error');
                $('#contactName').focus();
                return false;
        }
        window.location.href="{$bw->vars['board_url']}/{$bw->input['module']}/searchs/"+$('#contactName').val();
    });
});
    </script>
EOF;
	}
function showSearch($option = array()){
		global $bw,$vsLang,$vsPrint,$vsTemplate,$vsMenu;

                $this->cate = $vsMenu->getCategoryGroup($bw->input['module'])->getChildren();
		$BWHTML .= <<<EOF
	<div id="content">
    	<div class="main_title">
        	<h3 class="main_title_gallery2">{$vsLang->getWords('pageTitle','Địa chỉ')}</h3>
           <if="$option['paging']">    
                <div class="page">
                    {$option['paging']}
                </div>
            </if>  
        </div>
        
        <div class="gallery">
        	<if="$option['pageList']">
                    <foreach="$option['pageList'] as $obj">
                        <a href="{$obj->getUrl($bw->input['module'])}">{$obj->createImageCache($obj->file, 149, 148, 1)}</a>
                    </foreach>
                    <else />
                    {$vsLang->getWords('gloabal_no_album','Không tìm thấy album bạn cần!')}
                </if>
            <div class="clear_left"></div>
        </div>
       
       
       
    </div>
EOF;
	}


}
?>