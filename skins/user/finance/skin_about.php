<?php
class skin_home{
	
	function loadDefault($option){
		global $bw, $vsLang;
		
		$this->bare_url = $bw->vars['board_url'];
		$cclass = array('even', 'odd');
		
		$BWHTML .= <<<EOF
			<div class='agreement-left agreement'>
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
			<div class='agreement-right' style='float:right'>
				<div id='news-portlet' class='portlet'>
					<span class='ptitle'>iCampux News</span>
					<div class='pdetail'>
						<foreach=" $option['news'] as $news ">
							<div class='pitem'>
								<span class='itime'>{$news->getTime('m-d-Y')}</span>
								<a href='{$this->bare_url}/{$news->seourl}' class='ititle' title='{$news->getTitle()}'>
									{$news->getTitle()}
								</a>
							</div>
						</foreach>
						<a href='{$this->bare_url}/news' class='more' title='{$vsLang->getWords('all_news_title', 'Read all news')}'>
							{$vsLang->getWords('all_news', 'All news')}
						</a>
					</div>
				</div>
				<div id='events-portlet' class='portlet'>
					<span class='ptitle'>iCampux Events</span>
					<div class='pdetail'>
						<foreach=" $option['events'] as $news ">
							<div class='pitem'>
								<span class='itime'>{$news->getTime('m-d-Y')}</span>
								<a href='{$this->bare_url}/{$news->seourl}' class='ititle' title='{$news->getTitle()}'>
									{$news->getTitle()}
								</a>
							</div>
						</foreach>
						<a href='{$this->bare_url}/events' class='more' title='{$vsLang->getWords('all_event_title', 'Read all events')}'>
							{$vsLang->getWords('all_event', 'All events')}
						</a>
					</div>
				</div>
			</div>
			<div class='clear'></div>
EOF;
	}


	
}
?>