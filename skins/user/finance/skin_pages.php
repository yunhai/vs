<?php
class skin_pages extends skin_objectpublic{
	function showDefault($option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] )->getChildren();
		$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]."s");
		
		$cateId = $option['obj']?$option['obj']->getId():0;
		
		
		
		
		$BWHTML .= <<<EOF
		
		
		<div id="primary">
			<div id="breadcrumb">
				<ul>
					{$option['breakcrum']}
				</ul>
			</div>
			<div class="productNew">
				<h2 class="H2title">{$vsPrint->mainTitle}</h2>
				<div class="productNew-detai-box productNew-box">
					<div class="content_news">
						<foreach="$option['pageList'] as $key=>$obj">
						<div class="news_home_item"> 
							<if="$obj->getImage()"><a href="{$obj->getUrl($bw->input[0])}" class="news_home_img"><span></span>{$obj->createImageCache($obj->getImage(),185,128)}</a></if>
							<h3><a href="{$obj->getUrl($bw->input[0])}">{$obj->getTitle()} </a></h3>
							<p>{$obj->getIntro()}</p>
							<a href="{$obj->getUrl($bw->input[0])}" class="more">Xem chi tiết >></a>
							<div class="clear_left"></div>
						</div>
						</foreach>
					</div><!--end content_news-->
					
				</div>
			</div>
			<!-- end .productNew-box--> 
			
		</div>
		<!-- end #primary--> 
		
			
EOF;
	}
	
	function showDetail($obj,$option = array()) {
		global $bw,$vsPrint;
		
		$this->bw=$bw;
		$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] )->getChildren();
		$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]."s");
		$BWHTML .= <<<EOF
		

	
		<div id="primary">
			<div id="breadcrumb">
				<ul>
					{$option['breakcrum']}
				</ul>
			</div>
			<div class="productNew">
				<h2 class="H2title">{$obj->getTitle()}</h2>
				<div class="productNew-detai-box productNew-box"> 
					{$obj->getContent()}
				</div>
				
				
				<if="$option['other']">
				<div class="other">
					<ul>
					<h2 class="H2title">Bài viết cùng loại <a href="">Xem tất cả</a></h2>
						<foreach="$option['other'] as $key=>$obj">
						<li><a href="{$obj->getUrl($bw->input[0])}">{$obj->getTitle()}</a></li>
						</foreach>
					</ul>	
				</div>
				</if>
				
			</div>
			
			
			
			<!-- end .productNew-box--> 
			
		</div>
		<!-- end #primary--> 

		
EOF;
	}
	

}
?>