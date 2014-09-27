<?php
class Post extends BasicObject {
   
	public function convertToDB() {
		isset ( $this->id ) ? ($dbobj ['id'] = $this->id) : '';
		isset ( $this->title ) ? ($dbobj ['title'] = $this->title) : '';
		isset ( $this->intro ) ? ($dbobj ['intro'] = $this->intro) : '';
		isset ( $this->content ) ? ($dbobj ['content'] = $this->content) : '';
		isset ( $this->status ) ? ($dbobj ['status'] = $this->status) : '';
		isset ( $this->catId ) ? ($dbobj ['catId'] = $this->catId) : '';
		isset ( $this->index ) ? ($dbobj ['index'] = $this->index) : '';
		isset ( $this->image ) ? ($dbobj ['image'] = $this->image) : '';
		isset ( $this->mTitle ) ? ($dbobj ['mTitle'] = $this->mTitle) : '';
		isset ( $this->mKeyword ) ? ($dbobj ['mKeyword'] = $this->mKeyword) : '';
		isset ( $this->mIntro ) ? ($dbobj ['mIntro'] = $this->mIntro) : '';
		isset ( $this->mUrl ) ? ($dbobj ['mUrl'] = $this->mUrl) : '';
		
		
		$array = array(
		                'phone','website', 'email', 'name', 'address', 'location', 'created_date', 'public_date', 'end_date', 'author', 'author_type', 'clean'
		);
		
		foreach($array as $key) {
		    isset ( $this->$key ) ? ($dbobj [$key] = $this->$key) : '';
		}
		
		
		
		return $dbobj;
	}

	public function convertToObject($object = array()) {
		isset ( $object ['id'] ) ? $this->setId ( $object ['id'] ) : '';
		isset ( $object ['title'] ) ? $this->setTitle ( $object ['title'] ) : '';
		isset ( $object ['intro'] ) ? $this->setIntro ( $object ['intro'] ) : '';
		isset ( $object ['content'] ) ? $this->setContent ( $object ['content'] ) : '';
		isset ( $object ['status'] ) ? $this->setStatus ( $object ['status'] ) : '';
		isset ( $object ['catId'] ) ? $this->setCatId ( $object ['catId'] ) : '';
		isset ( $object ['index'] ) ? $this->setIndex ( $object ['index'] ) : '';
		isset ( $object ['image'] ) ? $this->setImage ( $object ['image'] ) : '';
		isset ( $object ['type'] ) ? $this->setType ( $object ['type'] ) : '';
		isset ( $object ['mTitle'] ) ? $this->setMTitle ( $object ['mTitle'] ) : '';
		isset ( $object ['mKeyword'] ) ? $this->setMKeyWord ( $object ['mKeyword'] ) : '';
		isset ( $object ['mIntro'] ) ? $this->getMIntro ( $object ['mIntro'] ) : '';
		isset ( $object ['mUrl'] ) ? $this->setMUrl ( $object ['mUrl'] ) : '';
		
		$array = array(
			         'phone','website', 'email', 'location', 'name', 'address', 'created_date', 'public_date', 'end_date', 'author', 'author_type', 'clean'
		);
		
		foreach($array as $key) {
		    isset ( $object [$key] ) ? $this->$key = $object [$key] : '';
		}
	}

	function getId() {
		return $this->id;
	}

	function getTitle() {
		return $this->title;
	}


	function getIntro() {
		return $this->intro;
	}


    function getAddress() {
		return $this->address;
	}
	
	function getStatus() {
		return $this->status;
	}

	function getCatId() {
		return $this->catId;
	}

	function getIndex() {
		return $this->index;
	}

	function getImage() {
		return $this->image;
	}


	function setId($id) {
		$this->id = $id;
	}

	function setTitle($title) {
		$this->title = $title;
	}

	function setInfo($info) {
		$this->info = $info;
	}

	function setIntro($intro) {
		$this->intro = $intro;
	}

	function setContent($content) {
		$this->content = $content;
	}

	function setAuthor($author) {
		$this->author = $author;
	}

	function setPostDate($postDate) {
		$this->postDate = $postDate;
	}

	function setHit($hit) {
		$this->hit = $hit;
	}

	function setStatus($status) {
		$this->status = $status;
	}

	function setPublish($publish) {
		$this->publish = $publish;
	}

	function setPublishDate($publishDate) {
		$this->publishDate = $publishDate;
	}

	function setLastModify($lastModify) {
		$this->lastModify = $lastModify;
	}

	function setModifyBy($modifyBy) {
		$this->modifyBy = $modifyBy;
	}

	function setOwner($owner) {
		$this->owner = $owner;
	}

	function setAlbumTemplate($albumTemplate) {
		$this->albumTemplate = $albumTemplate;
	}

	function setVideo($video) {
		$this->video = $video;
	}

	function setTemplate($template) {
		$this->template = $template;
	}

	function setCatId($catId) {
		$this->catId = $catId;
	}

	function setIndex($index) {
		$this->index = $index;
	}

	function setImage($image) {
		$this->image = $image;
	}

	public function getName() {
	    return $this->name;
	}
	
	public function getPhone() {
	    return $this->phone;
	}
	
	public function getLocation() {
	    return $this->location;
	}
	
	public function getWebsite() {
	    return $this->website;
	}
	
	public function getEmail() {
	    return $this->email;
	}
	
	public function getCreatedDate($full = false, $vn = true) {
	    if($full)
	        return $this->created_date;
	    
	    $tmp = explode(' ', $this->created_date);
	    if($vn) {
	        list($year, $month, $day) = explode('-', $tmp[0]);
	        return "{$day}/{$month}/{$year}";
	    }
	    return $tmp[0];
	}
	
	public function getPublicDate($full = false, $vn = true) {
	    if($full)
	        return $this->public_date;
	     
	    $tmp = explode(' ', $this->public_date);
	    if($vn) {
	        list($year, $month, $day) = explode('-', $tmp[0]);
	        return "{$day}/{$month}/{$year}";
        }
	    return $tmp[0];
	}
	
	public function getAuthor() {
	    return $this->author;
	}
	
	public function getEndDate($full = false) {
	    if($full)
	       return $this->end_date;
	    
	    $tmp = explode(' ', $this->end_date);
	    return $tmp[0];
	}
	
	public function getAuthorType() {
	    return $this->author_type;
	}
	
	public function setPublicDate($date) {
	    return $this->public_date = $date;
	}

	public function setEndDate($date) {
	    return $this->end_date = $date;
	}	
	var $id;
	var $title;
	var $info;
	var $intro;
	var $content;
	var $status;
	var $catId;
	var $index;
	var $image;
	
	var $phone;
	var $website;
	var $email;
	var $location;
	var $created_date;
	var $public_date;
	var $author;
	var $author_type;
}
