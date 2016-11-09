<?php
class skin_classifields{
	
	function MainPage() {
		global $bw, $vsLang;
		$BWHTML .= <<<EOF
			<div id="page_tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all-top">
				<ul id="tabs_nav" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner">
			        <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
			        	<a href="{$bw->base_url}menus/display-category-tab/ccategory/&ajax=1">
			        		<span>Classified Category</span>
		        		</a>
			        </li>

			        <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
			        	<a href="{$bw->base_url}menus/display-category-tab/ccondition/&ajax=1">
			        		<span>Classified Condition</span>
		        		</a>
			        </li>
				</ul>
			</div>
EOF;
		return $BWHTML;
	}
}
?>