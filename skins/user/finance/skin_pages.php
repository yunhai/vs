<?php
	class skin_pages{

		function showService( $option=array()){
		global $vsTemplate, $vsLang,$bw;
  
                $BWHTML .= <<<EOF
			<div class="news_menu">
            	<a href="{$option['show']->getUrl($bw->input['module'])}" title="{$option['show']->getTitle()}">{$option['show']->getTitle()}</a>
                <if="$option['other']">
                    <foreach="$option['other'] as $ot">
                        <a href="{$ot->getUrl($bw->input['module'])}" title="{$ot->getTitle()}">{$ot->getTitle()}</a>
                    </foreach>
               </if>
               <div class='clear'></div>
            </div>
            <div class='clear'></div>

            <div class="content_detail">
                {$option['show']->showImagePopup($option['show']->file,222,0,'dangky_img')}
               	{$option['show']->getContent()}
               	<div class='clear'></div>
            </div>
EOF;
	}
	function loadDetail($obj, $option=array()){
		global $vsTemplate, $vsLang;

		$BWHTML .= <<<EOF
			  	<h4 class="title_pages">
					<p>
						<span>
							{$obj->getTitle()}
						</span>
					</p>
				</h4>
				<div class="content_module">
                    <div class="news_detail">
                        <p class="news_date"></p>
                        <div class="wine_cost_info2">
                        	{$obj->getContent()}
                        </div>                        
                        <div class="clear"></div>
                    </div>
                    <!-- STOP WINE COST -->
                   
                    <div class="key_wine">
                        {$vsTemplate->global_template->addthis}
                     </div>
                </div>
EOF;
	}
	
	
	

	
	function loadDefault($option=array()){
		global $vsLang,$bw;
                print "<pre>";
                print_r($option);
                print "<pre>";
                exit();
		$BWHTML .= <<<EOF
		
EOF;
		return $BWHTML;
	}
	
	
	
}
?>