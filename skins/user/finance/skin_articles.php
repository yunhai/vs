<?php
class skin_home{
	
	function loadDefault($option){
		global $bw, $vsLang;
		$this->vsLang= $vsLang;
		$cclass = array('even', 'odd');
		$BWHTML .= <<<EOF
			<div class='article-left article'>
				<if=" $option['pageList'] ">
				<foreach=" $option['pageList'] as $page">
				<div class='item item{$page->cclass}'>
					<h3>
						<a href='{$page->seourl}' title='{$page->getTitle()}' class='atitle'>
							{$page->getTitle()}
						</a>
						<span class='time'>[{$page->getTime('SHORT')}]</span>
					</h3>
					<div class='content'>
						{$page->getContent(500)} 
						<a href='{$page->seourl}' title='{$page->getTitle()}' class='amore'>
							{$this->vsLang->getWords('read_more','Continue Reading [+]')}
						</a>
					</div>
				</div> 
				</foreach>
				</if>
				<if=" $option['paging'] ">
				<div class='page'>
					<span>Browse Pages:</span>
					{$option['paging']}
				</div>
				</if>
			</div>
			<div class='clear'></div>
EOF;
	}
	
	function loadDetail($option){
		global $bw, $vsLang;
		$this->vsLang= $vsLang;
		
		$BWHTML .= <<<EOF
			<div id='detail' class='article-left article'>
				<div class='item'>
					<h3>
						{$option['obj']->getTitle()}
						<span class='time'>[{$option['obj']->getTime('SHORT')}]</span>
					</h3>
					<div class='content'>
						{$option['obj']->getContent()} 
					</div>
				</div>
				
				<if=" $option['other'] ">
				<div id='other' class='item'>
					<span class='other'>{$vsLang->getWords('other_'.$bw->input[0],'Other '.$bw->input[0])}</span>
					
					<foreach=" $option['other'] as $page">
						<a href='{$page->seourl}' title='{$page->getTitle()}' class='ltitle'>
							{$page->getTitle()} [{$page->getTime('SHORT')}]
						</a>
					</foreach>
				</div>
				</if>
			</div>
			<div class='clear'></div>
EOF;
	}
}
?>