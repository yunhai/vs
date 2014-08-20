<?php
class skin_news extends skin_objectpublic{
	function showDefault($option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] )->getChildren();
		$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]."s");
		
		$cateId = $option['obj']?$option['obj']->getId():0;
		
		
		
		
		$BWHTML .= <<<EOF
		
		<div class="content">
    	<div class="center">
        	<div class="page_title">{$vsPrint->mainTitle}</div>
            
            
            
            <foreach="$option['pageList'] as $obj ">
            <div class="project_item">
            	<div class="im"><a href="{$obj->getUrl('services')}">{$obj->createImageCache($obj->getImage(),356,208)}</a></div>
                <div class="na"><a href="{$obj->getUrl('services')}">{$obj->getTitle()}</a></div>
                <div class="time">{$this->dateTimeFormat($obj->getPostDate(),'d/m/Y')}</div>
                <div class="intro">
                	{$this->cut($obj->getIntro(),100)}
                </div>
                <a href="{$obj->getUrl('services')}" class="detail">Chi tiết</a>
            </div>
            </foreach>
            
            
            <div class="clear"></div>
            <div class="page">
                {$option['paging']}
            </div>
        </div>
         <div class="sitebar">
         	{$this->getAddon()->getHtml()->getServiceSitebar($option)}
        	{$this->getAddon()->getHtml()->getSearchSitebar($option)}
            {$this->getAddon()->getHtml()->getAdsSitebar($option)}
            {$this->getAddon()->getHtml()->getNewsSitebar($option)}
             
        </div>
    	<div class="clear"></div>
        
    </div>
			
EOF;
	}
	
	function showDetail($obj,$option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		$this->catTitle=$option['cate_obj']->getTitle();
		$this->urlCate="{$this->bw->base_url}services/category/{$option['cate_obj']->getSlugId()}";
		$BWHTML .= <<<EOF
		<div class="content">
    	<div class="center">
        	<div class="page_title">{$obj->getTitle()}</div>
            <div class="page_detail">
            	{$obj->getContent()}
             </div>  
            <div class="clear"></div>
        </div>
        <div class="sitebar">
        	
            
            {$this->getAddon()->getHtml()->getServiceSitebar($option)}
        	{$this->getAddon()->getHtml()->getSearchSitebar($option)}
            {$this->getAddon()->getHtml()->getAdsSitebar($option)}
            {$this->getAddon()->getHtml()->getNewsSitebar($option)}
             
        </div>
    	<div class="clear"></div>
        
    </div>
				
<script>
var urlcate= '{$this->urlCate}';
</script>
EOF;
	}

	function showMore($option = array()) {
		global $bw;
		$BWHTML .= <<<EOF
		
EOF;
	}

}
?>