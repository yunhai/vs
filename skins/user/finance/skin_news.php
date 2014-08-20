<?php
class skin_news extends skin_objectpublic{
	function showDefault($option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		
		$BWHTML .= <<<EOF
		<div class="content">
    	<div class="center">
        	<div class="page_title">Dự án</div>
            
            
            
            <foreach="$option['pageList'] as $obj ">
            <div class="project_item">
            	<div class="im"><a href="{$obj->getUrl('news')}">{$obj->createImageCache($obj->getImage(),356,208)}</a></div>
                <div class="na"><a href="{$obj->getUrl('news')}">{$obj->getTitle()}</a></div>
                <div class="intro">
                	{$obj->getIntro()}
                </div>
                <a href="{$obj->getUrl('news')}" class="detail">Chi tiết</a>
            </div>
            </foreach>
            
            
            <div class="clear"></div>
            <div class="page">
                <a href="#"><img src="{$bw->vars['img_url']}/page_prev.jpg"></a>
                <a class="active" href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#"><img src="{$bw->vars['img_url']}/page_next.jpg"></a>
            </div>
        </div>
        <div class="sitebar">
        	<div class="search_sitebar">
            		<div class="title_searchBar">Tìm kiếm</div>
                	<form >
                    	<p class="provin_title">Thành phố/tỉnh</p>
                        <p class="dis_title">Quận/huyện</p>
                    	<input class="provinces" type="text" />
                        <input class="dis" type="text" />
                        <input class="submit_searchHome" type="submit" value="Tìm"  />
                        <div class="clear"></div>
                    </form>
              </div>
             <div class="ads_sitebar">
              	<a href=""><img src="{$bw->vars['img_url']}/im_ads.png"  /></a>
                <a href=""><img src="{$bw->vars['img_url']}/im_ads.png"  /></a>
                <a href=""><img src="{$bw->vars['img_url']}/im_ads.png"  /></a>
             </div>
             <div class="news_sitebar">
            	<div class="title">Những bài viết gần đây</div>
                <div class="news_home_item">
                    <div class="na"><a href="">Lorem ipsum dolor sit amet <span>[25/02/2014]</span></a></div>
                    <div class="intro">
                        Consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in...
                    </div>
                    <a class="detail" href="">Chi tiết</a>
                     <div class="clear"></div>
                </div>
                <div class="news_home_item">
                    <div class="na"><a href="">Lorem ipsum dolor sit amet <span>[25/02/2014]</span></a></div>
                    <div class="intro">
                        Consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in...
                    </div>
                    <a class="detail" href="">Chi tiết</a>
                    <div class="clear"></div>
                </div>
                <a class="viewall" href="">Xem tất cả...</a>
                <div class="clear"></div>
                
            </div>
             
        </div>
    	<div class="clear"></div>
        
    </div>

			
EOF;
	}
	
	function showDetail($obj,$option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		
		$this->catTitle=$option['cate_obj']->getTitle();
		$this->urlCate="{$this->bw->base_url}news/category/{$option['cate_obj']->getSlugId()}";
		
		$BWHTML .= <<<EOF
		
				
<script>
var urlcate= '{$this->urlCate}';
</script>
EOF;
	}

	function showMore($option = array()) {
		global $bw;
		$BWHTML .= <<<EOF
		
EOF;
	}

}
?>