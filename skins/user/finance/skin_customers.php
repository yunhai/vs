<?php
class skin_products extends skin_objectpublic {

	function showDefault($option = array()) {
		global $bw,$vsPrint;
		
		$this->bw = $bw;
		
		$BWHTML .= <<<EOF
EOF;
	}


	

	function showDetail($obj, $option = array()) {
		global $bw, $vsPrint;
		$BWHTML .= <<<EOF
		<div class="content">
    	<div class="center">
        	<div class="page_title">Hỗ trợ khách hàng</div>
            <div class="page_detail">
            <div class="title_detail">{$obj->getTitle()}</div>
            	{$obj->getContent()}
             </div>  
            
                       
            <div class="clear"></div>
        </div>
         <div class="sitebar">
         	{$this->getAddon()->getHtml()->getCustomerSitebar($option)}
        	{$this->getAddon()->getHtml()->getSearchSitebar($option)}
            {$this->getAddon()->getHtml()->getAdsSitebar($option)}
            {$this->getAddon()->getHtml()->getNewsSitebar($option)}
             
        </div>
    	<div class="clear"></div>
        
    </div>

		
EOF;
	}

	function showSearch($option = array()) {
		global $bw,$vsPrint;
		$BWHTML .= <<<EOF
EOF;
	}
	
	
}
?>