<?php
require_once(LIBS_PATH.'boards/VSAdminBoard.php');

class users_admin extends VSAdminBoard {


	/**
	*auto run function
	*System IDE create
	**/
	public	function auto_run(){
	
		global $bw;		
	$this->tabs[]=array(
				'id'=>'users',
				'href'=>"{$bw->base_url}users/users_display_tab/&ajax=1",
				'title'=>$this->getLang()->getWords("tab_user",'user'),
				'default'=>0,
		);
	
	if(VSFactory::getSettings()->getSystemKey ('show_location_list', 1, $bw->input[0] )){
			$this->tabs[]=array(
				'id'=>'location',
				'href'=>"{$bw->base_url}menus/display-category-tab/location/&ajax=1",
				'title'=>$this->getLang()->getWords("{$bw->input[0]}_location","location"),
				'default'=>0,
				);
	}
	if(VSFactory::getSettings()->getSystemKey ( $bw->input[0]. '_category_list', 0, $bw->input[0] )){
			$this->tabs[]=array(
				'id'=>'categorys_userss',
				'href'=>"{$bw->base_url}menus/display-category-tab/{$bw->input[0]}/&ajax=1",
				'title'=>$this->getLang()->getWords("{$bw->input[0]}_category","{$bw->input[0]} Category"),
				'default'=>0,
				);
	}
		parent::auto_run();
	}



}
