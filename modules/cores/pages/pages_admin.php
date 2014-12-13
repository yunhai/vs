<?php
require_once(LIBS_PATH.'boards/VSAdminBoard.php');

class pages_admin extends VSAdminBoard {


	/**
	*auto run function
	*System IDE create
	**/
	public	function auto_run(){
		global $bw;
		
		if(VSFactory::getSettings()->getSystemKey ( $bw->input[0]. '_page_list', 1, $bw->input[0] )){
    		$this->tabs[]=array(
    				'id'=>'pages',
    				'href'=>"{$bw->base_url}{$bw->input[0]}/pages_display_tab/&ajax=1",
    				'title'=>$this->getLang()->getWords("tab_{$bw->input[0]}",$bw->input[0]),
    				'default'=>0,
    		);
		}
		
	    
	    
	    if($bw->input['module'] == 'locations') {
            $this->tabs[]=array(
                            'id'=>'categorys_pages',
                            'href'=>"{$bw->base_url}menus/display-category-tab/{$bw->input[0]}/&ajax=1&type=state",
                            'title'=>$this->getLang()->getWords("{$bw->input[0]}_category_tab_state", "Bang"),
                            'default'=>0,
            );
	        $this->tabs[]=array(
	                        'id'=>'categorys_pages_city',
	                        'href'=>"{$bw->base_url}menus/display-category-tab/{$bw->input[0]}/&ajax=1&type=city",
	                        'title'=>$this->getLang()->getWords("{$bw->input[0]}_category_tab_city", "Thành phố"),
	                        'default'=>0,
	        );
	    } else {
	        if(VSFactory::getSettings()->getSystemKey ( $bw->input[0]. '_category_list', 0, $bw->input[0] )){
	            $this->tabs[]=array(
	                            'id'=>'categorys_pages',
	                            'href'=>"{$bw->base_url}menus/display-category-tab/{$bw->input[0]}/&ajax=1",
	                            'title'=>$this->getLang()->getWords("{$bw->input[0]}_category_tab","Danh mục"),
	                            'default'=>0,
	            );
	        }
	    }
	   
	   parent::auto_run();
	}
}