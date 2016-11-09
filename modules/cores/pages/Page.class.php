<?php

	class Page extends BasicObject{  
		function __construct(){
			parent::__construct();
	    }
	    function __destruct(){
	    	parent::__destruct();
	    	
	    }
  		function convertToDB() {
       		$dbobj = parent::convertToDB('page');
        	isset ( $this->postdate )     ? ($dbobj ["pagePostDate"] = $this->postdate) : "";
                isset ( $this->icon )     ? ($dbobj ["pageIcon"] = $this->icon) : "";
                if(isset ( $this->intro ) || isset($this->content) || isset ( $this->title )){
                            $cleanContent = VSFTextCode::removeAccent($this->title)." ";
                            $cleanContent .= VSFTextCode::removeAccent(strip_tags($this->getIntro()))." ";
                            $cleanContent.= VSFTextCode::removeAccent(strip_tags($this->getContent()));	
                            $dbobj ['pageCleanContent'] = strtolower($cleanContent);	
            }
		return $dbobj;
		}
		
		function convertToObject($object) {
                    global $vsFile,$DB;
                    parent::convertToObject($object,'page');
                    isset ( $object ["pagePostDate"] )  ? $this->setPostDate($object ["pagePostDate"])              : '';
                    isset ( $object ["pageIcon"] )  ? $this->icon=$object ["pageIcon"]              : '';
		}
		public $icon;
                public function getPicon(){
                   if($this->icon)return $this->icon;
                    return "main_title_service";
                }
	}
?>