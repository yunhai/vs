<?php
class VSFPath {

	private $paramIndex = 0;
	private $alias = array();
	private $realurl = array();
	private $seo 	= array();

	function __construct() {
		global $bw, $vsLang;

		$this->initPath();
		if(APPLICATION_TYPE!='install')
		if(!$vsLang->currentLang->getUserDefault() && APPLICATION_TYPE=='user' ) {
			$bw->input['vs'] = str_replace($vsLang->currentLang->getFolderName()."/",'',$bw->input['vs']);
			$this->initPath();
		}

		$clean_url = explode("/",trim($bw->input['vs'],"/"));

		$bw->input = array_merge($clean_url, $bw->input);
		$bw->input['module'] = $bw->input[0];
		$bw->input['action'] = $bw->input[1];
		$this->setupBaseUrl();
	}

	function initPath() {
		global $bw;

		if(!$bw->input['vs'] || !isset($bw->input ['vs'])) {
			switch(APPLICATION_TYPE) {
				case 'admin': $bw->input['vs'] = $bw->vars['admin_frontpage'];
				break;
					
				case 'user': $bw->input['vs'] = $bw->vars['public_frontpage'];
				break;
			}
		}
	}

	function setupBaseUrl() {
		global $bw, $vsLang;

		if(APPLICATION_TYPE=='admin') {
			$bw->base_url = $bw->vars['board_url'].'/admin.'.$bw->vars['php_ext'].'?vs=';
		}
		else {
			$bw->base_url = $bw->vars['board_url'].'/';
			if(!$bw->vars['public_cleanurl'])
				$bw->base_url = $bw->vars['board_url'].'/index.'.$bw->vars['php_ext'].'?vs=';
			if(APPLICATION_TYPE=='install')
				$bw->base_url = $bw->vars['board_url'].'/installer/index.'.$bw->vars['php_ext'].'?vs=';
		}
	}
}
?>