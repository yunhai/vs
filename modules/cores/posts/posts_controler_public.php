<?php
require_once CORE_PATH.'posts/posts.php';
class posts_controler_public extends VSControl_public {
	function __construct($modelName){
		global $vsTemplate,$bw;
		parent::__construct($modelName,"skin_posts","post",$bw->input[0]);
		unset($_SESSION['active']);
	}
	
	function auto_run() {
	    global $bw;

	    switch ($bw->input ['action']) {
	    	case $this->modelName.'_add':
	    	    $this->showForm($bw->input [2]);
	    	    break;
	    	case $this->modelName.'_submit':
	    	    $this->submitForm($bw->input [2]);
	    	    break;
    	    case $this->modelName.'_detail':
    	        $this->showDetail($bw->input [2]);
    	        break;
	        case $this->modelName.'_search':
	            $this->search();
	            break;
	    	default :
	    	    $this->showCategory ( $bw->input [2], $bw->input [3], $bw->input [4]);
	    	    break;
	    }
	}
	
	function showCategory($type = 'state', $location = 0, $catId = 0){
	    global $bw, $vsPrint;
	
	    $option = array();
	 
	    $category = VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
	    $option['cate'] = $category->getChildren();
	    
	    $keywords = array('state', 'city');
	    if(!in_array($type, $keywords)) {
	        $flag = false;
	        foreach( $option['cate'] as $id1 => $level1) {
	            if($level1->getSlugId() == $type) {
	                $flag = true;
	                $location = 0;
	                $catId = $type;
	                $type = 'state';
	            }
	            
                if($flag) break;

                foreach( $level1->children as $level2) {
                    if($level2->getSlugId() == $type) {
                        $flag = true;
                        $location = 0;
                        $catId = $type;
                        $type = 'state';
                        $tabid = $id1;
                    }
                }
                
                if($flag) break;
	        }
	        
	        if(empty($flag)) {
	            global $vsPrint;
	            $vsPrint->boink_it($bw->base_url);
	        }
	    }
	    
	    if($type == 'city') {
	        foreach( $option['cate'] as $id1 => $level1) {
	            if($level1->getSlugId() == $catId) {
	                $tabid = $id1;
	                break;
	            }
	             
	            $flag = false;
	            foreach( $level1->children as $level2) {
	                if($level2->getSlugId() == $catId) {
	                    $tabid = $id1;
	                    
	                    $flag = true;
	                }
	            }
	           
	            if($flag) break;
	        }
	    }
	    
	    if(empty($catId)) {
	        reset($option['cate']);
	        $tmp = current($option['cate']);
	    
	        $catId = $tmp->getSlugId();
	    } 
	    
	    $idcate = $this->getIdFromUrl($catId);
	    if(empty($tabid)) {
	        $tabid = $idcate;
	    }
	    
	    if($type == 'state') {
	        $index = 3;
	        
	        $option['location'] = $this->_formatState($this->_stateList($catId));
	    } elseif($type == 'city') {
    	    if($location) {
    	        $index = 5;
    	        $id = $this->getIdFromUrl($location);
    	        
    	        $locationids = array();
    	        if($type == 'city') {
    	           $option['location'] = $this->_formatCity($this->_cityList($id, $catId, $locationids));
    	        }
    	       
    	        $locationids = implode(',', $locationids);
    	    }
	    }
	    
	    $url = '';
	    $temp = 0;
	    while($temp<$index) {
	        $url .= $bw->input[$temp++]."/";
	    }
	   
	    $size = VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit', 24);
	    
	    $option['current'] = $idcate;
	    
	    $category=VSFactory::getMenus()->getCategoryById($idcate);
	    if(!$category){
	        $vsPrint->boink_it($bw->base_url);
	    }
	    
	    $ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
	    
	    $condition = "status > 0 and status < 99 and catId in ({$ids})";
	    if($locationids) {
	        $condition .= ' and location IN ('.$locationids.') ';
	    }
	    
	    $this->model->setCondition($condition);

	    $this->model->setOrder("`status` desc, public_date desc");
	
	    $option[$tabid]=$this->model->getPageList($url,$index,$size);
	
	    $vsPrint->mainTitle = $vsPrint->pageTitle = $category->getTitle();

	    $option['current'] = $tabid;
	    
	    $tmp = VSFactory::getMenus()->extractNodeInTree($tabid, $option['cate']);
	    $option['sub-category'] = $tmp['category']->getChildren();
	  
	    $option['category-type'] = $type;
	    
	    return $this->output = $this->getHtml()->showDefault($option);
	}
	
	function search($type = 'state', $location = 0, $catId = 0){
	    global $bw, $vsPrint;
	
	    $keyword = VSFactory::getTextCode()->removeAccent($bw->input['keywords'], ' ');
	    print "<pre>";
	    print_r($bw->input);
	    print "</pre>";
	    
	    
	    $option = array();
	
	    $category = VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
	    $option['cate'] = $category->getChildren();
	     
	    $keywords = array('state', 'city');
	    if(!in_array($type, $keywords)) {
	        $flag = false;
	        foreach( $option['cate'] as $id1 => $level1) {
	            if($level1->getSlugId() == $type) {
	                $flag = true;
	                $location = 0;
	                $catId = $type;
	                $type = 'state';
	            }
	             
	            if($flag) break;
	
	            foreach( $level1->children as $level2) {
	                if($level2->getSlugId() == $type) {
	                    $flag = true;
	                    $location = 0;
	                    $catId = $type;
	                    $type = 'state';
	                    $tabid = $id1;
	                }
	            }
	
	            if($flag) break;
	        }
	         
	        if(empty($flag)) {
	            global $vsPrint;
	            $vsPrint->boink_it($bw->base_url);
	        }
	    }
	     
	    if($type == 'city') {
	        foreach( $option['cate'] as $id1 => $level1) {
	            if($level1->getSlugId() == $catId) {
	                $tabid = $id1;
	                break;
	            }
	
	            $flag = false;
	            foreach( $level1->children as $level2) {
	                if($level2->getSlugId() == $catId) {
	                    $tabid = $id1;
	                     
	                    $flag = true;
	                }
	            }
	
	            if($flag) break;
	        }
	    }
	     
	    if(empty($catId)) {
	        reset($option['cate']);
	        $tmp = current($option['cate']);
	         
	        $catId = $tmp->getSlugId();
	    }
	     
	    $idcate = $this->getIdFromUrl($catId);
	    if(empty($tabid)) {
	        $tabid = $idcate;
	    }
	     
	    if($type == 'state') {
	        $index = 3;
	         
	        $option['location'] = $this->_formatState($this->_stateList($catId));
	    } elseif($type == 'city') {
	        if($location) {
	            $index = 5;
	            $id = $this->getIdFromUrl($location);
	             
	            $locationids = array();
	            if($type == 'city') {
	    	           $option['location'] = $this->_formatCity($this->_cityList($id, $catId, $locationids));
	            }
	
	            $locationids = implode(',', $locationids);
	        }
	    }
	     
	    $url = '';
	    $temp = 0;
	    while($temp<$index) {
	        $url .= $bw->input[$temp++]."/";
	    }
	
	    $size = VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit', 24);
	     
	    $option['current'] = $idcate;
	     
	    $category=VSFactory::getMenus()->getCategoryById($idcate);
	    if(!$category){
	        $vsPrint->boink_it($bw->base_url);
	    }
	     
	    $ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
	     
	    $condition = "status > 0 and status < 99 and catId in ({$ids})";
	    if($locationids) {
	        $condition .= ' and location IN ('.$locationids.') ';
	    }
	     
	    $this->model->setCondition($condition);
	
	    $this->model->setOrder("`status` desc, public_date desc");
	
	    $option[$tabid]=$this->model->getPageList($url,$index,$size);
	
	    $vsPrint->mainTitle = $vsPrint->pageTitle = $category->getTitle();
	
	    $option['current'] = $tabid;
	     
	    $tmp = VSFactory::getMenus()->extractNodeInTree($tabid, $option['cate']);
	    $option['sub-category'] = $tmp['category']->getChildren();
	     
	    $option['category-type'] = $type;
	     
	    return $this->output = $this->getHtml()->showDefault($option);
	}
	
	function _cityList($state = 0, $category = '', &$callback = array()) {
	    $tmp = VSFactory::getMenus()->getCategoryGroup('locations')->getChildren();
	
	    $location = array(); 
	    foreach($tmp as $id => $level1) {
	        if($id != $state) continue;
	        
	        $callback[$id] = $id;
	        foreach($level1->children as $id2 => $level2) {
	           $location[$level2->getTitle()] = array('title' => $level2->getTitle(), 'url'=> $level2->getCatUrl('posts/category/detail/').'/'.$category);
	           
	           $callback[$id2] = $id2;
	        }
	    }
	   
	    ksort($location);
	     
	    return $location;
	}
	
	function _stateList($category = '', &$callback = array()) {
	    $tmp = VSFactory::getMenus()->getCategoryGroup('locations')->getChildren();

	    $location = array(); 
	    foreach($tmp as $id => $level1) {
	       $location[$level1->getTitle()] = array('title' => $level1->getTitle(), 'url'=> $level1->getCatUrl('posts/category/city/').'/'.$category);
	       $callback[$id] = $id;
	    }
	    
	    ksort($location);
	    
	    return $location;
	}
	
	function _formatState($location = array()) {
	    $result = array();
	    $row = 6; $index = 0;
	     
	    while($index < $row ) {
	        $resutl[$index++] = array();
	    }
	     
	    $index = 0;
	    foreach($location as $item) {
	        if($index == $row) $index = 0;
	         
	        $result[$index][] = $item;
	         
	        $index++;
	    }
	     
	    return $result;
	}
	
	function _formatCity($location = array()) {
	    $result = array();
	    
	    $run = array(); $total = 26; $t = 1;
	    foreach($location as $key => $item) {
	        if(1||$t++ < $total) {
	        $first = strtoupper($key[0]);
	        
	        if(empty($run[$first])) {
	            $run[$first] = array('title' => $first, 'url' => '');
	        }
	        
	        $run[$item['title']] = $item;
	        }
	    }
	   
	    $col = 6;
	    $row = ceil(count($run)/$col);
	    
	    $i = $j = 0; $result = array();
	    foreach($run as $key => $item) {
	        
	        if($i == $row) {
	            $i = 0;
	            $j++;
	        }
	        $result[$i][$j] = $item;
	        $i++;
	    }
	    
	    return $result;
	}
	
	function showForm($catId, $custom = array()) {
	    global $vsPrint,$bw;
	
	    if(!VSFactory::getUsers()->basicObject->getId()){
	        $vsPrint->redirect_screen(VSFactory::getLangs()->getWords('not_login','Bạn chưa đăng nhập'), '/');
	    }
	    
	    $category = VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
	    $option['cate'] = $category->getChildren();
	    
	    if(empty($catId)) {
	        reset($option['cate']);
	        $tmp = current($option['cate']);
	         
	        $idcate = $tmp->getId();
	    } else {
	        $idcate = $this->getIdFromUrl($catId);
	    }
	     
	    $category=VSFactory::getMenus()->getCategoryById($idcate);
	    if(!$category){
	        $vsPrint->boink_it($bw->base_url);
	    }
	     
	    $json = array();
	    foreach($option['cate'] as $item) {
	        $tmp = $item->getChildren();
	        if(empty($tmp)) continue;
	        $children = array();
	        foreach ($tmp as $child) {
	            $children[$child->getId()] = array('name' => $child->getTitle());
	        }
	        
	        $json[$item->getId()] = array(
	        	'name' => $item->getTitle(),
                'children' => $children
	        );
	    }
	    $option['current'] = $idcate;
	    $option['category_min'] = $json;
	    $option['json'] = json_encode($json);
	    $option['category'] = $category;
	     
	    $option[$idcate] = true;
	   
	    $vsPrint->addCSSFile("uploader/style");
	    $vsPrint->addCSSFile("uploader/jquery.fileupload");
	    $vsPrint->addCSSFile("uploader/jquery.fileupload-ui");
	    
	    $option['obj'] = $this->model->basicObject;
	    if($custom) {
	        foreach($custom as $k => $value) {
	            $option[$k] = $value;
	        }
	    }
	   
	    $this->output = $this->html->showForm($option);
	}
	
	function submitForm($catId) {
	    global $bw, $vsPrint;
	
	    if(empty($catId)) {
	        $category = VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
	        $option['cate'] = $category->getChildren();
	         
	        reset($option['cate']);
	        $tmp = current($option['cate']);
	
	        $idcate = $tmp->getId();
	    } else {
	        $idcate = $this->getIdFromUrl($catId);
	    }
	    
	    $category=VSFactory::getMenus()->getCategoryById($idcate);
	    if(!$category){
	        $vsPrint->boink_it($bw->base_url);
	    }
	
	    if(empty($bw->input['file'])) {
	        $option['error'] = VSFactory::getLangs()->getWords('empty_image','Hình đại diện không hợp lệ');
	        
	        $this->model->basicObject->convertToObject($bw->input[$this->modelName]);
	        return $this->showForm($catId, $option);
	    }
	    
	    reset($bw->input['file']);
	    $bw->input['posts']['image'] = current($bw->input['file']);
	    
	    $user = VSFactory::getUsers()->basicObject;
	    
	    $map = array(
	    	      'author'  => 'getId',
                  'address' => 'getAddress',
                  'phone'   => 'getName',
                  'email'   => 'getEmail',
                  'website' => 'getWebsite',
                  'location'=> 'getLocation',
                  'name'    => 'getFullname',
                  'zipcode' => 'getZipcode'
	    );
	    foreach($map as $k => $f) {
	        $bw->input['posts'][$k] = $user->$f();
	    }
	    
	    $bw->input['posts']['status'] = 99;
	    $bw->input['posts']['author_type'] = APPLICATION_TYPE;
	    
	    $bw->input['posts']['clean'] = $this->model->createSearch($bw->input);
	    $bw->input['posts']['created_date'] = date('Y-m-d H:m:s');
	    
	    $this->model->basicObject->convertToObject($bw->input[$this->modelName]);
	    $flag = $this->model->insertObject();
	    
	    if(empty($flag)) {
	        $option['error'] = VSFactory::getLangs()->getWords('empty_title','Tiêu đề không được để trống');
	         
	        return $this->showForm($catId, $option);
	    }
	    
	    if(!empty($bw->input['gallery'])) {
    	    require_once CORE_PATH.'gallerys/gallerys.php';
    	    $model = new gallerys();
    	    $catId = $model->getCategories()->getId();
    	    $galleries = array(
    	    	          'title'  => $bw->input['posts']['title'],
    	                  'module' => $this->modelName,
    	                  'catId'  => $catId,
    	                  'status' => -1,
                          'code'   => $this->modelName.'_'.$this->model->basicObject->getId(),
    	    );
    	    
    	    $model->basicObject->convertToObject($galleries);
    	    $model->insertObject();
    
    	    $g_id = $model->basicObject->getId();
    	    foreach($bw->input['gallery'] as $id) {
    	       $model->addFileToAlbum($id, $g_id);
    	    }
	    }
	    
	    
	    $redirect = $bw->base_url;
	    
	    $vsPrint->boink_it($redirect);
	}
	
	
	/*
	 * Show detail action 
	 */
	function showDetail($objId){
		global $vsPrint, $bw, $vsTemplate;       
		
		$obj = $this->model->getObjectById($this->getIdFromUrl($objId));
		
		$catid = $obj->getCatId();
		
		if(!is_object($obj)) {
			$vsPrint->boink_it($bw->base_url);
		}
		
		$category = VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$option['cate'] = $category->getChildren();
		
		$flag = false; $type = 'state'; $tab = array();
		foreach ( $option['cate'] as $id1 => $level1 ) {
		    if($id1 == $catid) {
		        $flag = true;
		        
		        $tab = $level1;
		        $tabid = $id1;
		        
		        $option['sub-category'] = $level1->children;
		        
		        break;
		    }
		    
		    foreach ( $level1->children as $id2 => $level2 ) {
		        if($id2 == $catid) {
		            $type = 'city';
		            $flag = true;
		            $tabid = $id1;
		            
		            $tab = $level2;
		            $option['sub-category'] = $level1->children;
		            
		            break;
		        }
		    }
		    
		    if($flag) break;
		}
		
		$locationid = $obj->getLocation();
		
		$option[$tabid] = $obj;
		$option['current'] = $tabid;
		
		$option['location-info'] = $location_info = VSFactory::getMenus()->getCategoryById($locationid);

		$breadcrumb = array(
			             'type'   => $type,
		                 'category' => $tab,
		                 'target' => $obj
		              );
		$option['breakcrum'] = $this->createBreakCrum($location_info, $breadcrumb);
		
		$gid = 'posts_'.$obj->getId();
		
		require_once CORE_PATH.'gallerys/gallerys.php';
		$model = new gallerys();
		
		$tmp = $model->getObjByCode($gid);
		
		if($tmp) {
		  $option['gallery'] = $model->getFileByAlbumId($tmp->getId());
		}
		$author_type = $obj->getAuthorType();
		
		if($author_type == 'user') {
		    require_once CORE_PATH.'users/users.php';
		    $model = new users();
		    
		    $option['author'] = $model->getObjectById($obj->getAuthor());
		   
		    $address = $option['author']->getAddress() . ' ' . $location_info->getTitle() . ' ' .
		    VSFactory::getMenus()->getCategoryById($location_info->getParentId()) -> getTitle();
		    
		    $address = urlencode($address);
		    
		    $du = file_get_contents("http://maps.google.com/maps/api/geocode/json?address={$address}&sensor=false");
		    $tmp = json_decode(utf8_encode($du),true);
		    
		    $tmp = current($tmp['results']);
		
		    $option['map']['geometry'] = $tmp['geometry']['location'];
		    $option['map']['formatted_address'] = $tmp['formatted_address'];
		}
		
	
		if(empty($bw->input['info'])) $bw->input['info'] = 'city';
		$vsPrint->mainTitle = $vsPrint->pageTitle = $category->getTitle();
		$vsPrint->addExternalJavaScriptFile("http://maps.google.com/maps/api/js?v=3.exp&sensor=false&language=vi",1);
		$this->output = $this->getHtml()->showDetail($obj,$option);
	}
	
	
	
	
	/**
	 * 
	 * @var posts
	 */
	protected $model;
	
	
    function getListLangObject(){
         	
    }
       /**
        * 
        * @param BasicObject
        */ 
    protected  function  onDeleteObject($obj){
    }
	public function getHtml() {
		return $this->html;
	}
	
	public function getOutput() {
		return $this->output;
	}
	
	public function setHtml($html) {
		$this->html = $html;
	}
	
	public function setOutput($output) {
		$this->output = $output;
	}
	/**
	 * 
	 * Enter description here ...
	 * @var skin_posts
	 */
	public $html;
}
