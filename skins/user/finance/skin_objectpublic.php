<?php
class skin_objectpublic{
// tin tuc, khuyen mai, tuyen dung
function showDefault($option){
	global $bw,$vsLang,$vsPrint,$vsTemplate;

		$BWHTML .= <<<EOF
		<div id="content">
    	<h3 class="main_title">{$vsTemplate->global_template->navigator}</h3>
    	<if="$option['pageList']">
        <foreach="$option['pageList'] as $obj">
		<div class="news_item">
            <if="$obj->file">
        		<a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}" class="news_img">
					{$obj->createImageCache($obj->file,153,111,2)}
				</a>
        	</if>
            <h3><a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}">{$obj->getTitle()} <if="$bw->input['module']=='promotions'"><span> [{$obj->getPostDate(SHORT)}]</span></if></a></h3>
            <div class="news_intro">
            <p>{$obj->getIntro(500)} </p>
            </div>
            <a href="{$obj->getUrl($bw->input['module'])}" title="{$obj->getTitle()}" class="view_detail">{$vsLang->getWordsGlobal("global_detail","Chi tiết")}</a>
            <div class="clear_left"></div>
        </div>
        </foreach>
        <else />
        	<p class="nodata">{$vsLang->getWordsGlobal('global_nodata','Dữ liệu đang được chúng tôi cập nhật')}</p>
    	</if>	
        
        <if="$option['paging']">
     		<div class="page">
        	{$option['paging']}
        	</div>
     	</if>
        <div class="clear_right"></div>
    	</div>
    	
		
EOF;
	}
	
	
//khuyen mai, tuyen dung, tin tuuc
	function showDetail($obj,$option){
		global $bw,$vsLang,$vsPrint,$vsTemplate;
		

		$BWHTML .= <<<EOF
		<div id="content">
    		<h3 class="main_title">{$vsTemplate->global_template->navigator}</h3>
            <h1 class="page_title">{$obj->getTitle()} <if="$bw->input['module']=='promotions'"><span> [{$obj->getPostDate(SHORT)}]</span></if></h1>
            <p>{$obj->getContent()}</p>
            <if="$option['other']">
	       	<div class="other">
	       		<a href="{$bw->base_url}{$bw->input['module']}" class="view_all1">{$vsLang->getWordsGlobal("global_viewall","Xem tất cả")}</a>
	        	<h3 class="main_title">{$vsLang->getWords($bw->input['module'].'_other','Tin tức cùng chủ đề')}</h3>
            	<foreach="$option['other'] as $ob">
                    <a href="{$ob->getUrl($bw->input['module'])}" title="{$ob->getTitle()}" class="other_item"> {$ob->getTitle()} <if="$bw->input['module']=='promotions'"><span>[{$ob->getPostDate(SHORT)}]</span></if></a>
              	</foreach>
	          	
	      	</div>
	       	</if>
          	<div class="clear_right"></div>
  		</div>		
	
		

	
EOF;
	}
	



	
function showSearch($option){
	global $bw,$vsLang,$vsPrint,$vsTemplate;

		$BWHTML .= <<<EOF
		<div id="content">
    	<h3 class="main_title">{$vsPrint->pageTitle}</h3>
    	<if="$option['pageList']">
        <foreach="$option['pageList'] as $obj">
		<div class="news_item">
            <if="$obj->file">
        		<a href="{$obj->getUrl($obj->getModule())}" title="{$obj->getTitle()}" class="news_img">{$obj->createImageCache($obj->file,153,111,2)}</a>
        	</if>
            <h3><a href="{$obj->getUrl($obj->getModule())}" title="{$obj->getTitle()}">{$obj->getTitle()} <if="$bw->input['module']=='promotions'"><span> [{$obj->getPostDate(SHORT)}]</span></if></a></h3>
            <div class="news_intro">
            <p>{$obj->getIntro(500)} </p>
            </div>
            <a href="{$obj->getUrl($obj->getModule())}" title="{$obj->getTitle()}" class="view_detail">{$vsLang->getWordsGlobal("global_detail","Chi tiết")}</a>
            <div class="clear_left"></div>
        </div>
        </foreach>
        <else />
        	<p class="nodata">{$option['error_search']}</p>
    	</if>	
        
        <if="$option['paging']">
     		<div class="page">
        	{$option['paging']}
        	</div>
     	</if>
        <div class="clear_right"></div>
    	</div>
    	
	
        
EOF;
	}

}
?>