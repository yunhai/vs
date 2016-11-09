<?php
class Project extends BasicObject {
	private $hits = NULL;
	public $parser = NULL;
	public $message = NULL;

	function __construct() {
		parent::__construct ();
	}

	function __destruct() {
		parent::__destruct ();
		unset ( $this->author );
		unset ( $this->hits );
	}
	public function convertToDB() {
		$dbobj = parent::convertToDB('project');
        isset ( $this->postdate )     ? ($dbobj ["projectPostDate"] = $this->postdate) : "";
       	return $dbobj;
	}
	function convertToObject($object) {
		global $vsMenu;
       	parent::convertToObject($object,'project');
		isset ( $object ['projectHits'] ) ? $this->setHits ( $object ['projectHits'] ) : '';
		isset ( $object ['projectPostDate'] ) ? $this->setPostDate( $object ['projectPostDate'] ) : '';
	}

	/**
	 * @param $hits the $hits to set
	 */
	public function setHits($hits) {
		$this->hits = $hits;
	}

	
	
	/**
	 * @return the $hits
	 */
	public function getHits() {
		return $this->hits;
	}

	

}