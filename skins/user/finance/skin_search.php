<?php
class skin_home{
	
	function loadDefault($option){
		global $bw, $vsLang, $vsPrint;
		$BWHTML .= <<<EOF
	        <div id="content_left">
            	<div class="seller_border">
	            	<div class="user_title">
	                	<h3>Search result</h3>
	                </div>
	                <div class='icitem_container' id='icitem_container'>
						<if=" $option['pageList'] ">
			                <foreach=" $option['pageList'] as $key=>$value "> 
				                <div class="item">
				                	<a href='{$this->board_url}/{$value['searchURL']}' title="{$value['searchOTitle']}" class='title'>
				                		<h3>{$value['searchOTitle']}</h3>
				                	</a>
				                	
				                	<div class='description'>
				                		{$value['searchOIntro']} ...
				                	</div>
				                    <div class="clear"></div>
				                </div>
			            	</foreach>
			            <else />
			            	<div>
			            		Sorry! No match for your search. Please try different keywords
			            	</div>
							<div class="clear"></div>
			           	</if>
			           	
			           	<if='$option['paging']'>
			           		<div class="page">
		                   		<span>Browse Pages:</span>
		                   		{$option['paging']}
		                   </div>
			           	</if>
					</div>
				</div>
			</div>
	    <script type='text/javascript'>
	    	$(document).ready(function(){
	    	$('#globalsearch').val('{$option['keyword']}');
	    	$('.item').highlight('{$option['keyword']}');
	    	});
	    </script>
EOF;
	}


	
}
?>