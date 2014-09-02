<?php
class skin_pages extends skin_objectpublic{
    
    function showDefault($option = array()) {
		global $bw;

		$this->bw = $bw;
		
		$BWHTML .= <<<EOF
		<ul class="nav nav-tabs" role="tablist">
            <foreach=" $option['cate'] as $key=>$cat">
                <li id='{$key}' <if="$key == $option['obj']->getId() ">class='active'</if>>
                    <a href="{$cat->getUrlCategory()}" role="tab" data-toggle="tab">{$cat->getTitle()}</a>
                </li>
            </foreach>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
            <foreach=" $option['cate'] as $key => $cat">
                <div class="tab-pane <if=" !empty($option[$key]) ">active</if>" id="tab{$key}" ref="{$key}">
                    <if=" !empty($option[$key]) ">
                        <foreach="$option[$key]['pageList'] as $obj ">
                        <div class='{$this->bw->input[0]}-item item'>
                            <span class='postdate'>{$this->getLang()->getWords('faq_postdate', 'Ngày gửi: ')}{$this->dateTimeFormat($obj->getPostDate(),"d/m/Y")}</span>
                            <span class='label-question'>{$obj->getId()}:{$this->getLang()->getWords('faq_question', 'Câu hỏi')}</span>
                            <div  class='intro'>{$obj->getIntro()}</div>
                            <span class='label-answer icon-plus' data-id='{$obj->getId()}' id='question-{$obj->getId()}'>
                                {$this->getLang()->getWords('faq_answer', 'Xem câu trả lời')}
                            </span>
                            <div  class='content' id='detail-{$obj->getId()}'>{$obj->getContent()}</div>
                        </div>
                        </foreach>
                                    
                        <if=" $option[$key]['paging'] ">
                            <div class='paging pager'>
                                {$option[$key]['paging']}
                            </div>
                        </if>
                                    
                        <script type='text/javascript'>
                            $(".label-answer").click(function(){
                                var id = $(this).attr('data-id');
                                $("#detail-"+id ).slideToggle('', function() {
                                    if ($("#detail-"+id).is(':visible') === true ){
                                        $('#question-'+id).addClass('icon-minus');
                                        $('#question-'+id).removeClass('icon-plus');
                                    }
                                    else {
                                        $('#question-'+id).addClass('icon-plus');
                                        $('#question-'+id).removeClass('icon-minus');    
                                    }    
                                });
                            });
                        </script>
                        <if=" count($option[$key]['pageList']) == 0">
                            {$this->getLang()->getWords('faq_empty', 'Hiện thời danh mục chưa có bài viết.')}
                        </if>
                    </if>
                </div>
            </foreach>
        </div>
		
        <script>
                    $('a[data-toggle="tab"]').on('click', function (e) {
                                        window.location.href = $(e.target).attr("href");
                                        console.log($(e.target).attr("href"));
})
                                        </script>
        <div style='margin-top:100px'>&nbsp;</div>
EOF;
		return $BWHTML;
	}
	
	function showDetail($obj,$option = array()) {
		global $bw,$vsPrint;
		
		$this->bw=$bw;
		$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] )->getChildren();
		$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]."s");
		$this->catTitle=$option['cate_obj']->getTitle();
		$this->urlCate="{$this->bw->base_url}posts/category/{$option['cate_obj']->getSlugId()}";
		$BWHTML .= <<<EOF
		

	
		<div class="content">
    	<div class="center">
        	<div class="page_title">{$this->catTitle}</div>
            <div class="page_detail">
            <div class="title_detail">{$obj->getTitle()}</div>
            <div class="time_detail">Ngày đăng: {$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}</div>
           		{$obj->getContent()}
           		<if="$option['other'] ">
           		<div class="other">
           			<p class="title_other">Các tin liên quan</p>
           			<ul>
           				<foreach="$option['other'] as $other ">
           					<li><a href="{$other->getUrl('posts')}">{$other->getTitle()} <span>Ngày đăng: {$this->dateTimeFormat($other->getPostDate(),'d/m/y')}</span></a></li>
           				</foreach>
           			</ul>
           		</div>
           		</if>
             </div>  
            
                       
            <div class="clear"></div>
        </div>
         <div class="sitebar">
         	{$this->getAddon()->getHtml()->getNewsCategory($option)}
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
}
?>