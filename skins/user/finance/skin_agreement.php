<?php
class skin_article{
	
	function loadDefault($option){
		global $bw;
		
		$BWHTML .= <<<EOF
			<div class='agreement agreement-full'>
				<div class='item'>
					<h3>{$option['obj']->getTitle()}</h3>
					<div class='content'>
						{$option['obj']->getContent()}
					</div>
				</div> 
			</div>
			<div class='clear'></div>
EOF;
	}


	
}
?>