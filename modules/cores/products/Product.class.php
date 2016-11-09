<?php
class Product extends BasicObject {	
  	private $hotPrice = 0;
	private $clearSearch = NULL;
	private $manu	= NULL;

	function __construct() {
		parent::__construct ();
	}

	function __destruct() {
		parent::__destruct ();
		unset ( $this->price );
		unset ( $this->certification );
		unset ( $this->app );
		unset ( $this->cleanTitle);
		unset ( $this->cleanContent);
	}
	public function convertToDB() {
		$dbobj = parent::convertToDB('product');
    	isset ( $this->postdate )       ? ($dbobj ["productPostDate"]   = $this->postdate) : "";
      	isset ( $this->price)           ? ($dbobj ['productPrice']	 = $this->price) : '';            
       	isset ( $this->hotPrice)	? ($dbobj ['productHotPrice']	 = $this->hotPrice) : '';
		isset ( $this->clearSearch )  ? ($dbobj ['productClearSearch']       = $this->clearSearch) : '';
		isset ( $this->manu ) 	? ($dbobj ['productManu'] 	= $this->manu) : '';
		if(isset ( $this->intro ) || isset($this->content) || isset ( $this->title )){
			$cleanContent = VSFTextCode::removeAccent($this->title)." ";
			$cleanContent .= VSFTextCode::removeAccent(strip_tags($this->getIntro()))." ";
			$cleanContent.= VSFTextCode::removeAccent(strip_tags($this->getContent()));
			$dbobj['productClearSearch'] = $cleanContent;
		}
      	 return $dbobj;
	}
	function convertToObject($object) {
		global $vsMenu;
       	parent::convertToObject($object,'product');
		
		isset ( $object ['productPostDate'] )   ? $this->setPostDate( $object ['productPostDate'] ) : '';
		isset ( $object ['productPrice'] )      ? $this->setPrice( $object ['productPrice'] )       : '';
    	isset ( $object ['productHotPrice'] )   ? $this->setHotPrice( $object ['productHotPrice'] ) : '';
    	isset ( $object ['productClearSearch'] )   ? $this->setCleanSearch ( $object ['productClearSearch'] ) : '';
		isset ( $object ['productManu'] ) 		? $this->manu = $object ['productManu'] : '';
	}


	public function setApp($app) {
		$this->app = $app;
	}

	public function setCertification($cer) {
		$this->certification = $cer;
	}
        
        public function setManu($app) {
		$this->manu = $app;
	}

	public function getManu() {
		return $this->manu;
	}
 
        public function getPrice($number=true,$rss=0) {
		global $vsLang,$donvi;
		if ((APPLICATION_TYPE=='user' && $number)||$rss){
			if ($this->price>0){
                                if($this->manu && $donvi[$this->manu])$temp =" / ".$donvi[$this->manu]->getTitle();
				return number_format ( $this->price,0,"","." )."(VND)".$temp;
			}
			return $vsLang->getWords('callprice','Call');
		}
		
		return $this->price;
	}

        public function getHotPrice($number=true,$rss=0) {
		global $vsLang;
		if ((APPLICATION_TYPE=='user' && $number)||$rss){
			if ($this->hotPrice>0){
				return number_format ( $this->hotPrice,0,"","." );
			}
			return $vsLang->getWords('callprice','Call');
		}
		
		return $this->hotPrice;
	}
	
        public function setPrice($price) {
		$this->price = $price;
	}

        public function setHotPrice($price) {
		$this->hotPrice = $price;
	}
	
	function getContent($size=0, $br = 0, $tags = "") {
		global $vsCom;

		$parser = new PostParser ();
		$parser->pp_do_html = 1;
		$parser->pp_nl2br = $br;
		
		$content = $parser->post_db_parse($this->content);
		if($size){
			if($tags) $content = strip_tags($content, $tags);
			else $content = strip_tags($content);
			return VSFTextCode::cutString($content, $size);
		}
		return $content;
	}
	
	public function getCleanSearch() {
		return $this->cleanSearch;
	}

	public function setCleanSearch($cleanSearch) {
		$this->cleanSearch = $cleanSearch;
	}
        
        public function convertOrderItem() {
            global $vsPrint;
		if(!$this->getId())$vsPrint->boink_it($_SERVER['HTTP_REFERER']);
                $item = array ( 'productId' 		=> $this->getId(),
                                'itemPrice' 		=>$this->getPrice(false),
                                'itemTitle' 		=> $this->getTitle(),
                                'itemStatus'            =>$this->getStatus(),
                                'itemQuantity' 		=> 1
                                );
                return $item;
	}

}