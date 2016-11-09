<?php
class skin_partners{
	
	function showBottomGlobal($show){
		global $bw,$vsLang;
		$BWHTML = "";
		$BWHTML .= <<<EOF
		<if="count($show)">
			<div class="content_item_bg">
			  	<foreach="$show as $obj">     
					<div class="doitac"><a href="#">{$obj->createImageCache($obj->getFileId(),220,120)}</a></div>
				</foreach> 
			</div>
		</if>
EOF;
	return $BWHTML;	
	}
	
}
?>