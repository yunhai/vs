<?php
class skin_news extends skin_objectpublic{
	function showDefault($option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		
		
		$BWHTML .= <<<EOF
		<div class="content_mid">
		<div class="content_mid_title">{$vsPrint->mainTitle}</div>
		<foreach="$option['pageList'] as $obj ">
		<div class="news_item">
			<div class="im"><a href="{$obj->getUrl('news')}">{$obj->createImageCache($obj->getImage(),110,74)}</a></div>
			<div class="na"><a href="{$obj->getUrl('news')}">{$obj->getTitle()} <span>[10/04/2013]</span></a></div>
			<div class="intro">{$this->cut($obj->getIntro(),200)}</div>
		</div>
		</foreach>
		<div class="clear"></div>
	</div>
		

			
EOF;
	}
	
	function showDetail($obj,$option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		
		
		
		$BWHTML .= <<<EOF
		<div class="content_mid">
			<div class="content_mid_title">{$obj->getTitle()}</div>
			{$obj->getContent()}
			<div class="clear"></div>
			<div class="other">Tin khác</div>
			<ul class="other_post">
				<foreach="$option['other'] as $obj ">
				<li><a href="{$obj->getUrl('lease')}">{$obj->getTitle()}</a></li>
				</foreach>
			</ul>
		</div>		
				

EOF;
	}

	function showMore($option = array()) {
		global $bw;
		$BWHTML .= <<<EOF
		
EOF;
	}

}
?>