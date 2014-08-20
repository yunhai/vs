<?php
class skin_projects extends skin_objectpublic{
	function showDefault($option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] )->getChildren();
		$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]."s");
		
		$cateId = $option['obj']?$option['obj']->getId():0;
		$BWHTML .= <<<EOF
		
		<div class="content">
    	<div class="center">
        	<div class="page_title">Dự án</div>
            <foreach="$option['pageList'] as $obj ">
            <div class="project_item">
            	<div class="im"><a href="{$obj->getUrl('projects')}">{$obj->createImageCache($obj->getImage(),356,208)}</a></div>
                <div class="na"><a href="{$obj->getUrl('projects')}">{$obj->getTitle()}</a></div>
                <div class="time">{$this->dateTimeFormat($obj->getPostDate(),'d/m/Y')}</div>
                <div class="intro">
                	{$this->cut($obj->getContent(),100)}
                </div>
                <a href="{$obj->getUrl('projects')}" class="detail">Chi tiết</a>
            </div>
            </foreach>
            
            
            <div class="clear"></div>
            <div class="page">
                {$option['paging']}
            </div>
        </div>
        <div class="sitebar">
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
		$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] )->getChildren();
		$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]."s");
		
		$BWHTML .= <<<EOF
		

	
		<div class="content">
    	<div class="center">
        	<div class="page_title">Dự án</div>
            <div class="page_detail">
            	<div class="im">{$obj->createImageCache($obj->getImage(),400,235)}</div>
                <div class="na">{$obj->getTitle()}</div>
                <div class="provin"><span>Thành phố/ Tỉnh:</span>{$obj->getProvin()}</div>
                <div class="dis"><span>Quận/ Huyện:</span>{$obj->getDis()}</div>
                
           		<div class="intro">
                	<div class="desc_intro">Mô tả dự án</div>
                    {$obj->getContent()}
                </div>
                <div class="clear"></div>
                <div class="map_detail">
                	<div class="map_title">Bản đồ dự án</div>
                    {$obj->createImageCache($obj->getMap(),745,405)}
                </div>
            </div>  
            
                       
            <div class="clear"></div>
        </div>
         <div class="sitebar">
        	{$this->getAddon()->getHtml()->getSearchSitebar($option)}
            {$this->getAddon()->getHtml()->getAdsSitebar($option)}
            {$this->getAddon()->getHtml()->getNewsSitebar($option)}
             
        </div>
    	<div class="clear"></div>
        
    </div>
		
EOF;
	}
	

}
?>