<?php
class skin_home{
	
	function loadDefault($option){
		global $bw;
		$cclass = array('even', 'odd');
		$BWHTML .= <<<EOF
			<div class='article-left article'>
				<if=" $option['pageList'] ">
				<foreach=" $option['pageList'] as $page">
				<div class='item item{$page->cclass}'>
					<h3>{$page->getTitle()}</h3>
					<div class='content'>
						{$page->getContent()}
					</div>
				</div> 
				</foreach>
				</if>
			</div>
			<div class='clear'></div>
EOF;
	}


	
}
?>