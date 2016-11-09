<?php
class BasicObject {
	protected $id 			= NULL;
	protected $catId 		= NULL;
	protected $category	 	= NULL;
	protected $index 		= NULL;
	protected $title 		= NULL;
	protected $intro 		= NULL;
	protected $content 		= NULL;
	protected $status 		= NULL;
	protected $url 			= NULL;
	protected $postdate 	= NULL;
	

	function getTitle($size=0) {
		if($size)
			return VSFTextCode::cutString($this->title,$size);
		return $this->title;
	}

	function getCleanTitle(){
		return strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($this->title)),'-'));
	}
	
	function getIndex() {
		return $this->index;
	}

	function setIndex($index){
		$this->index = $index;
	}

	function setTitle($title) {
		$this->title = $title;
	}

	function getId() {
		return $this->id;
	}

	function getCatId() {
		return $this->catId;
	}

	function setCatId($catId) {
		$this->catId = $catId;
	}

	function getContent($size=0, $br = 0, $tags = "") {
		global $vsCom;

		$parser = new PostParser ();
		$parser->pp_do_html = 1;
		$parser->pp_nl2br = $br;
		
		if($vsCom->SEO->type == 'detail')
			if(is_object($vsCom->SEO->obj) && !$vsCom->SEO->obj->getIntro())
				$this->createSeo();
		
		$content = $parser->post_db_parse($this->content);
		if($size){
			if($tags) $content = strip_tags($content, $tags);
			else $content = strip_tags($content);
			return VSFTextCode::cutString($content, $size);
		}
		return $content;
	}

	function getIntro($size=0, $br = 0, $tags = ""){
		$parser = new PostParser ();
		$parser->pp_do_html = 1;
		$parser->pp_nl2br = $br;
		$intro = $parser->post_db_parse($this->intro);
		if($size){
			if($tags) $intro = strip_tags($intro, $tags);
			else $intro = strip_tags($intro);
			return VSFTextCode::cutString($intro,$size);
		}
		return $intro;
	}

	function getUrl($module=null) {
		global $bw;
		if(!$module) return $this->url;
		return $bw->base_url . "{$module}/detail/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($this->title)),'-')). '-' . $this->getId () ;
	}


	function getStatus($type=null) {
		global $bw, $vsLang;
		
		if(!$type) return isset($this->status) ? $this->status : 1;
		
		if($type=="image"){
			$imgArray = array('disabled.png', 'enable.png', 'home.png', 'hot.png');			
			return $this->status = "<img src='{$bw->vars ['img_url']}/{$imgArray[$this->getStatus()]}' alt='{$this->getStatus()}' />";
		}
		if($type=="text")
			$text = array($vsLang->getWords('global_enable', 'Enable'), $vsLang->getWords('global_disable', 'Disbale'), $vsLang->getWords('global_home', 'Home'));
			return $text['$this->status'];
	}

	
	function getPostDate($format=NULL, $standard=false){
		if($format) {
			$datetime= new VSFDateTime();
			return $datetime->getDate($this->postdate, $format, $standard);
		}
		return $this->postdate;
	}

	function setPostDate($postDate){
		$this->postdate = $postDate;
	}
	
	function setId($id) {
		$this->id = $id;
	}
	
	function setUrl($url) {
		$this->url = $url;
	}
	
	function setStatus($status) {
		$this->status = $status;
	}
	
	function setContent($content) {
		$this->content = $content;
	}

	function setIntro($intro) {
		$this->intro = $intro;
	}

	function getCategory(){
		return $this->category;
	}

	function setCategory($category) {
		$this->category = $category;
	}

	function getResizeImagePath($path,$width = 130, $height = 100,$type=0) {
		global $bw;
		if(TIMTHUMB==1) return $bw->vars['board_url']."/cache/images/{$width}x{$height}-{$type}/uploads/{$path}";
		return "{$bw->vars['board_url']}/utils/timthumb.php?src={$path}&w={$width}&h={$height}&zc={$type}";
	}

	function getCacheImagePathByFile($fileObject, $width = 130, $height = 100, $type=0, $timthumb=0) {
		global $vsFile, $vsSettings, $bw;
		if(!is_object($fileObject)){
			$vsFile = new files();
			$fileObject = $vsFile->getObjectById(intval($fileObject));
		}
		if(!is_a($fileObject, "File")){
			$noimage = $vsSettings->getSystemKey('system_noimage_img_path','styles/images/noimage.gif', 'global', 0, 1);	
			return $this->getResizeImagePath($noimage,$width,$height);
		}
		
		if($timthumb || $fileObject->getType()=="gif")
			return $fileObject->getPathView();
		return
			$this->getResizeImagePath($fileObject->getPathView(TIMTHUMB),$width,$height,$type);
	}

	public function createCategory($catId=null) {
		global $vsMenu;
		if($catId) return $vsMenu->getCategoryById($catId);
		
		if(is_object($this->category)) return $this->category;
		
		$this->setCategory($vsMenu->getCategoryById($this->catId));
		return $this->getCategory();
	}

	function createImageCache($fileObject, $width=100, $height=100, $type=0, $noimage=0) {
		global $vsFile, $bw;
		
		if(!is_object($fileObject)){
			$vsFile = new files();
			$fileObject = $vsFile->getObjectById(intval($fileObject));
		}
		if(!is_a($fileObject, "File")){
			if($noimage)
				return $this->imageCache="<img alt='{$bw->vars['global_websitename']} Image' src='{$this->getCacheImagePathByFile($fileObject,$width,$height)}'/>";
			return "";
		}

		if($fileObject->getType()=="gif")
			return $this->imageCache="<img alt='{$fileObject->getTitle()}' src='{$this->getCacheImagePathByFile($fileObject,$width,$height,$type)}' width='$width' height='$height'/>";
		
		$alt = $fileObject->getIntro() ? $fileObject->getIntro() : $fileObject->getTitle();
		return $this->imageCache="<img alt='{$alt}' src='{$this->getCacheImagePathByFile($fileObject,$width,$height,$type)}'/>";
	}
	
	function createSeo(){
		global $vsCom;
		
		if(is_object($vsCom->SEO->obj)){
			if(!$vsCom->SEO->obj->getIntro()){
				$parser = new PostParser ();
				$parser->pp_do_html = 1;
				$parser->pp_nl2br = 0;
				$intro = $this->intro?$this->getIntro():VSFTextCode::cutString($parser->post_db_parse($this->content), 450);
				$oIntro = strip_tags($intro);
				$vsCom->SEO->obj->setIntro($oIntro);
			}
			if(!$vsCom->SEO->obj->getTitle()){
				$oTitle = strip_tags($this->title);
				$vsCom->SEO->obj->setTitle($oTitle);
			}
			if(!$vsCom->SEO->obj->getKeyword()){
				$oTitle = mb_strtolower(strip_tags($this->title),"UTF-8");
				$oTitle = str_replace(array('?','.',',',';',':','/','*','"',"'",'!','@','#','$','%','^','&','(',')','_','=','+','-'),'',$oTitle);
				$vsCom->SEO->obj->setKeyword(VSFTextCode::removeAccent($oTitle).", ".$oTitle.", ".VSFTextCode::removeAccent($oTitle,", "));
			}
		}
	}

	function __construct(){
	}

	function __destruct(){
		unset ( $this->id );
		unset ( $this->catId );
		unset ( $this->category );
		unset ( $this->content );
		unset ( $this->index );
		unset ( $this->intro );
		unset ( $this->title );
		unset ( $this->status );
		unset ( $this->url);
	}
}

