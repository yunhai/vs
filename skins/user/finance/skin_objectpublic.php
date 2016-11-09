<?php
class skin_objectpublic{
	function showDefault($option = array()){
		global $bw,$vsLang,$vsPrint,$vsTemplate,$class_def;
		
		$BWHTML .= <<<EOF
        <div id="content">
    	<div class="main_title">
        	<h1 class="{$class_def}">{$vsLang->getWords('pageTitle','Địa chỉ')}</h1>
            <if="$option['paging']">    
                <div class="page">
                    {$option['paging']}
                </div>
            </if>    
        </div>
        
       <div id="center" class="tintuc">
            <if="$option['pageList']">        
            <foreach="$option['pageList'] as $obj">        
                <div class="news_item">
                    <h3><a href="{$obj->getUrl($bw->input['module'])}">{$obj->getTitle()} <span>{$obj->getPostDate('SHORT')}</span></a></h3>
                    <if="$obj->file">
                        <a href="{$obj->getUrl($bw->input['module'])}" class="news_img">
                            {$obj->createImageCache($obj->file,145,101,1)}
                        </a>
                    </if>
                    <div>{$obj->getIntro()}</div>
                    <div class="clear_right"></div>
                </div>
            </foreach>
            <else />
                {$vsLang->getWords('global_dataupdate1','Nội dung đang trong quá trình cập nhật. Quý khách vui lòng quay lai sau. Xin cảm ơn!')}
            </if>
       </div>
    </div>    

	
EOF;
	}
	
	
// trang abouts	
function showDetail($obj,$option){
	global $bw,$vsLang,$vsPrint,$vsTemplate,$class_def;
       
		$BWHTML .= <<<EOF
        <div id="content">
    	<div class="main_title">
        	<h3 class="{$obj->getPicon()}">{$vsLang->getWords('pageTitle','Địa chỉ')}</h3>
        </div>
		<div class="tintuc detail" id="center">
       		<h1 class="tintuc_title">{$obj->getTitle()} <if="$bw->input['module']==news"><span>{$obj->getPostDate('SHORT')}</span></if></h1>
                {$obj->getContent()}
                <div class="clear_left"></div>
              
                <if="$option['other']">
                <h3 class="tintuc_title">{$vsLang->getWords("cactinkhac2","CÁC TIN KHÁC")}</h3>
                    <div class="other">
                        <foreach="$option['other'] as $other">
                        <a href="{$other->getUrl($bw->input['module'])}">{$other->getTitle()}</a>
                             </foreach>
                    </div>
                </if>
        </div>
   </div>
EOF;
	}
function showImage($obj,$option = array()){
		global $bw,$vsLang,$vsPrint,$vsTemplate,$vsMenu;
               
		$BWHTML .= <<<EOF
		<div id="content">
    	<div class="main_title" id="main_title">
        	<h3 class="main_title_gallery2">{$vsLang->getWords('pageTitle','Địa chỉ')}</h3>
              
        </div>
        
        <div class="gallery">
                <if="$option['img']">
                    <ul class="paging">
                    <foreach="$option['img'] as $img">
                        <li>
                            <a href="{$img->getCacheImagePathByFile($img,1,1,1,1)}" class="highslide" onclick="return hs.expand(this)">{$img->createImageCache($img, 149, 148, 1)}</a>
                        </li>
                    </foreach>
                    </ul>    
                </if>
            <div class="clear_left"></div>
        </div>
                
      <if="$obj->GetContent()">          
        <div class="main_title"><h3 class="main_title_gallery">Video</h3></div>
        {$obj->GetContent()}
      </if>     
    </div>
    <script>
    $(document).ready(function(){
    $("ul.paging").quickPager();
    });
    </script>
EOF;
	}
	
}
?>