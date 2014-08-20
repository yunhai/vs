<?php
require_once(LIBS_PATH.'boards/VSAdminBoard.php');

class videos_admin extends VSAdminBoard {


	/**
	*auto run function
	*System IDE create
	**/
	public	function auto_run(){
	
		global $bw;		$this->tabs[]=array(
				'id'=>'videos',
				'href'=>"{$bw->base_url}videos/videos_display_tab/&ajax=1",
				'title'=>$this->getLang()->getWords("tab_video",'video'),
				'default'=>0,
		);
	if(VSFactory::getSettings()->getSystemKey ( $bw->input[0]. '_category_list', 0, $bw->input[0] )){
			$this->tabs[]=array(
				'id'=>'categorys_videoss',
				'href'=>"{$bw->base_url}menus/display-category-tab/{$bw->input[0]}/&ajax=1",
				'title'=>$this->getLang()->getWords("{$bw->input[0]}_category","{$bw->input[0]} Category"),
				'default'=>0,
				);
	}
	if(VSFactory::getSettings()->getSystemKey ( $bw->input[0]. '_settings_tab', 1, $bw->input[0] )){
			$this->tabs[]=array(
				'id'=>'settings_videoss',
				'href'=>"{$bw->base_url}settings/moduleObjTab/{$bw->input[0]}/&ajax=1",
				'title'=>$this->getLang()->getWords("{$bw->input[0]}_ss","{$bw->input[0]} Settings"),
				'default'=>0,
				);
	}
		parent::auto_run();
	}



}
