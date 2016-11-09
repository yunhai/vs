<?php
class Menu extends BasicObject{  
	public $langId 		= NULL;
	public $id 			= NULL;
	public $url			= NULL;
	public $title		= NULL;
	public $status		= NULL;
	public $index		= NULL;
	public $alt 		= NULL;
	public $parentId	= NULL;
	public $isLink 		= NULL;
	public $isDropdown 	= NULL;
	public $isAdmin	 	= NULL;
	public $level 		= NULL;
	public $type 		= NULL;
	public $top 		= 0;
	public $main 		= 0;
	public $right 		= 0;
	public $bottom 		= 0;
	public $left 		= 0;
	public $fileId 		= NULL;
	public $backup 		= NULL;
	public $children 	= array();
	public function __clone(){
		
	}
	function getBackup() {
		return $this->backup;
	}
	
	function setBackup($backup) {
		$this->backup = $backup;
	}

	function convertToDB() {
		isset ( $this->id ) 		? ($dbobj ['menuId'] 			= $this->id) 			: '';
		isset ( $this->langId ) 	? ($dbobj ['langId'] 			= $this->langId) 		: '';
		isset ( $this->title ) 		? ($dbobj ['menuTitle'] 		= $this->title) 		: '';
		isset ( $this->url ) 		? ($dbobj ['menuUrl'] 			= $this->url )			: '';
		isset ( $this->index ) 		? ($dbobj ['menuIndex'] 		= $this->index) 		: '';
		isset ( $this->status ) 	? ($dbobj ['menuStatus'] 		= $this->status) 		: '';
		isset ( $this->alt )		? ($dbobj ['menuAlt'] 			= $this->alt) 			: '';
		isset ( $this->parentId ) 	? ($dbobj ['parentId'] 			= $this->parentId) 		: '';
		isset ( $this->isLink ) 	? ($dbobj ['menuIsLink'] 		= $this->isLink) 		: '';
		isset ( $this->isDropdown ) ? ($dbobj ['menuIsDropDown'] 	= $this->isDropdown) 	: '';
		isset ( $this->isAdmin ) 	? ($dbobj ['menuIsAdmin'] 		= $this->isAdmin) 		: '';
		isset ( $this->type ) 		? ($dbobj ['menuType'] 			= $this->type) 			: '';
		isset ( $this->level )		? ($dbobj ['menuLevel'] 		= $this->level) 		: '';
		isset ( $this->fileId )		? ($dbobj ['menuFileId'] 		= $this->fileId) 		: '';
		isset ( $this->backup )		? ($dbobj ['menuBackup'] 		= $this->backup) 		: '';
		isset ( $this->seoId ) 			? ($dbobj ['seoId'] 	= $this->getSeoId()) 		: '';
		$posStr = "@";
		$posStr .= $this->top;
		$posStr .= $this->right;
		$posStr .= $this->bottom;
		$posStr .= $this->left;
		$posStr .= $this->main;
		$dbobj['menuPosition'] = $posStr;
		return $dbobj;
	}
	 
	function convertToObject($object) {
		isset ( $object ['menuId'] ) 		? $this->setId 		( $object ['menuId'] ) 			: '';
		isset ( $object ['langId'] ) 		? $this->setLangId 	( $object ['langId'] ) 			: '';
		isset ( $object ['menuTitle'] ) 	? $this->setTitle 	( $object ['menuTitle'] ) 		: '';
		isset ( $object ['menuUrl'] ) 		? $this->setUrl 	( $object ['menuUrl'] ) 		: '';
		isset ( $object ['menuIndex'] ) 	? $this->setIndex 	( $object ['menuIndex'] ) 		: '';
		isset ( $object ['menuStatus'] )	? $this->setStatus 	( $object ['menuStatus'] ) 		: '';
		isset ( $object ['menuAlt'] )		? $this->setAlt 	( $object ['menuAlt'] ) 		: '';
		isset ( $object ['parentId'] ) 		? $this->setParentId( $object ['parentId'] ) 		: '';
		isset ( $object ['menuIsLink'] ) 	? $this->setIsLink	( $object ['menuIsLink'] ) 		: '';
		isset ( $object ['menuIsDropDown'])	? $this->setIsDropdown( $object ['menuIsDropDown'] ): '';
		isset ( $object ['menuIsAdmin'] ) 	? $this->setIsAdmin ( $object ['menuIsAdmin'] ) 	: '';
		isset ( $object ['menuType'] ) 		? $this->setType 	( $object ['menuType'] ) 		: '';
		isset ( $object ['menuLevel'] )		? $this->setLevel 	( $object ['menuLevel'] ) 		: '';
		isset ( $object ['menuFileId'] )	? $this->setFileId 	( $object ['menuFileId'] ) 		: '';
		isset ( $object ['menuBackup'] )	? $this->setBackup 	( $object ['menuBackup'] ) 		: '';
		isset ( $object ['seoId'] ) 		? $this->setSeoId ( $object ['seoId'] ) 				: '';
		if($object['menuPosition'])
		{
			$posString		= trim($object['menuPosition'],'@');
			$this->top 		= $posString[0];
			$this->right 	= $posString[1];
			$this->bottom 	= $posString[2];
			$this->left 	= $posString[3];
			$this->main 	= $posString[4];
		}
	}
	
	function validate() {
		$status = true;
		if ($this->title == "") {
			$status = false;
			$this->message .= "Menu title can't be left blank!<br>";
		}
		return $status;
	}
	function getUrl($real=true) {
		global $bw;
		if($real)
			return $this->url;
		if($this->type){
			return $this->url;
		}
		return $bw->base_url.$this->url;
	}
	function getUrlCategory() {
		global $bw;
		return $bw->base_url.$this->url."/category/".$this->id;
	}
	function getClassActive() {
		global $bw;
		if($this->url==$bw->input['vs']||$this->url==$bw->input[0]){
			return 'active';
		}
	}

	function getFileId() {
		return $this->fileId;
	}
	 
	function setFileId($fileId) {
		$this->fileId = $fileId;
	}

	function __construct(){
		parent::__construct();
	}
	
	function __destruct(){
	unset( $this->langId );
	unset( $this->id );
	unset( $this->url );
	unset( $this->title );
	unset( $this->status );
	unset( $this->index );
	unset( $this->alt );
	unset( $this->parentId );
	unset( $this->isLink  );
	unset( $this->isDropdown  );
	unset( $this->isAdmin );
	unset( $this->level );
	unset( $this->type  );
	unset( $this->top );
	unset( $this->main  );
	unset( $this->right  );
	unset( $this->bottom  );
	unset( $this->left  );
	unset( $this->fileId  );
	unset( $this->backup );
	unset( $this->children );
	}
	
	function __set_state($array=array()) {
		$menu = new Menu();
		foreach ($array as $key => $value) {
			$menu->$key = $value;
		}
		return $menu;
	}
	
	function setLangId($langId=0) {
		$this->langId = intval($langId);
	}
	
	function getLangId() {
		return $this->langId;	
	}
	
	function setChild($menu) {
		$this->children[$menu->getId()]	= $menu;
	}
	
	
	function &getChildren() {
		return $this->children;
	}

	function getAlt() {
		return $this->alt;
	}

	function getIsAdmin() {
		return $this->isAdmin;
	}
	
	function getIsDropdown() {
		return $this->isDropdown;
	}
	
	function getIsLink() {
		return $this->isLink;
	}
	
	function getValue() {
		return $this->isLink;
	}
	 
	function getLevel() {
		return $this->level;
	}
	 
	function getUtilitys() {
		if(is_array($this->isDropdown))
			return $this->isDropdown;
		if($this->isDropdown)
			return explode(',',$this->isDropdown);
		return array();
	}
	 
	function getBenefits() {
		if(is_array($this->isLink))
			return $this->isLink;
		if($this->isLink)
			return explode(',',$this->isLink);
		return array();
	}	

	function getParentId() {
		return $this->parentId;
	}
	 
	function getPosition($position="top") {
		return $this->$position;
	}

	function getType() {
		return $this->type;
	}
	 
	function get_type_unit() {
		if(is_array($this->alt))
			return $this->alt;
		return $this->alt?$this->alt=unserialize($this->alt):'';
		return array();
	}
	
	function get_areas_type() {
		if(is_array($this->fileId))
			return $this->fileId;
		return $this->fileId?$this->fileId=explode(',',$this->fileId):'';
		return array();
	}
	
	function getCatUrl($module) {
		global $bw;
		return "{$bw->vars['board_url']}/{$module}/category/".$this->getId ();
	}
	
	 // $alt
	function setAlt($alt) {
		$this->alt = $alt;
	}
	
	 // $isAdmin
	function setIsAdmin($isAdmin) {
		$this->isAdmin = $isAdmin;
	}
	
	 // $isDropdown
	function setIsDropdown($isDropdown) {
		$this->isDropdown = $isDropdown;
	}
	
	 // $isLink
	function setIsLink($isLink) {
		$this->isLink = $isLink;
	}
	 
	function setLevel($level) {
		$this->level = $level;
	}
	
	 // $parentId
	function setParentId($parentId) {
		$this->parentId = intval($parentId);
	}
	
	 // $position
	function setPosition($position) {
		if(!$position)
			return;
		$this->$position = 1;
	}
	
	 // $type
	function setType($type) {
		$this->type = $type;
	}
	/**
	 * for seo only if you not understand please contact tuyenbui@vietsol.net
	 */
	public $seoId=Null;
	/**
	 * @return the $seoId
	 */
	public function getSeoId() {
		return $this->seoId;
	}

	/**
	 * @param $seoId the $seoId to set
	 */
	public function setSeoId($seoId) {
		$this->seoId = $seoId;
	}
	public function getRealUrl($fullPath=true) {
		global $bw,$vsMenu,$vsSettings;
		$cate=$vsMenu->arrayCategory[$this->getId()];
		
		if(is_object($cate)){//cate
			$tree=$vsMenu->extractNodeInTree($this->getId(),$vsMenu->arrayTreeCategory);
			$rootCate=$vsMenu->arrayCategory[$tree[ids][count($tree[ids])-2]];
			//echo $vsSettings->getSystemKey($rootCate->getUrl()."_category_url",$this->getUrl()."/category/",$rootCate->getUrl());
			$url=$vsSettings->getSystemKey($rootCate->getUrl()."_category_url",$this->getUrl()."/category/",$rootCate->getUrl());
		}else{//menu
			$url=$this->getUrl();
		}
		if($fullPath){
				return $bw->base_url.$url.$this->getId();
			
		}else{
				return $url.$this->getId();
		}
	}
	public function getAliasUrl($fullPath=true) {
		global $vsStd,$bw;
		if($this->seoId){
			$vsStd->requireFile(COM_PATH.'SEO/SEO.php');
			$seo=new COM_SEO();
			$seoObj=$seo->getObjectById($this->seoId);
			if(is_object($seoObj)){
				if($fullPath){
					return $bw->base_url.$seoObj->getAliasUrl();
				}else{
					return $seoObj->getAliasUrl();
				}
			}
		}
		return $this->getRealUrl($fullPath);
	}
	
}
?>