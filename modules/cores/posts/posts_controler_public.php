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
    	    case $this->modelName.'_edit':
    	        $this->showForm($bw->input [2], $bw->input [3]);
    	        break;
	    	case $this->modelName.'_submit':
	    	    $this->submitForm($bw->input [2]);
	    	    break;
    	    case $this->modelName.'_detail':
    	        $this->showDetail($bw->input [2]);
    	        break;
	        case $this->modelName.'_search':
	            $this->search($bw->input [2]);
	            break;
            case $this->modelName.'_me':
                $this->me($bw->input [2]);
                break;
            case $this->modelName.'_delete':
                $this->delete($bw->input [2]);
                break;
            case $this->modelName.'_category':
                    $this->showCategory ( $bw->input [2], $bw->input [3], $bw->input [4]);
                break;
	    	default :
	    	      $this->showDefault();
	    	    break;
	    }
	}
	
	function showDefault($type = 'state', $location = 0, $catId = 0){
	    global $bw, $vsPrint;
	
	    $option = array();
	
	    $category = VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
	    $option['cate'] = $category->getChildren();
	     
	    $detailFlag = ($type == 'detail') ? true : false;
	
	    $keywords = array('state', 'city', 'detail');
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
	     
	    if($type == 'city'|| $type == 'detail') {
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
	
	            if($flag) {
	                break;
	            }
	        }
	    }
	     
	    if(empty($catId)) {
	        reset($option['cate']);
	        $tmp = current($option['cate']);
	         
	        $catId = $tmp->getSlugId();
	    }
	     
	     
	    $option['category-id'] = $idcate = $this->getIdFromUrl($catId);
	    if(empty($tabid)) {
	        $tabid = $idcate;
	    }
	
	    $category=VSFactory::getMenus()->getCategoryById($idcate);
	    if(!$category){
	        $vsPrint->boink_it($bw->base_url);
	    }
	     
	    if($type == 'state') {
	        $index = 3;
	        $option['location'] = $this->_formatState($this->_stateList($catId));
	    } elseif($type == 'city') {
	        if($location) {
	            $index = 5;
	            $id = $this->getIdFromUrl($location);
	             
	            $locationids = array();
	            $option['location'] = $this->_cityList($id, $catId, $locationids, $cityObject, $stateObj);
	
	            $locationids = implode(',', $locationids);
	        }
	    } elseif($type == 'detail') {
	        if($location) {
	            $index = 5;
	             
	            $locationids = $this->getIdFromUrl($location);
	             
	            $option['city-obj'] = VSFactory::getMenus()->getCategoryById($locationids);
	            $option['state-obj'] = VSFactory::getMenus()->getCategoryById($option['city-obj']->getParentId());
	        }
	    }
	     
	    $size = VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit', 24);
	     
	    $ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
	     
	    $condition = "status = 2 and catId in ({$ids}) and DATE_FORMAT(public_date, '%Y-%m-%d') <= CURDATE() and DATE_FORMAT(end_date, '%Y-%m-%d') >= CURDATE()";
	    if($locationids) {
	        $condition .= ' and location IN ('.$locationids.') ';
	    }
	     
	    $this->model->setCondition($condition);
	
	    $this->model->setLimit(array(0, 6));
	    $this->model->setOrder("`status` desc, public_date desc");
	
	    $vip = $this->model->getObjectsByCondition();
	    
	    $count = (10 - count($vip) < 0) ? 0 : (10 - count($vip));
	    $condition = "status = 1 and catId in ({$ids}) and DATE_FORMAT(public_date, '%Y-%m-%d') <= CURDATE() and DATE_FORMAT(end_date, '%Y-%m-%d') >= CURDATE()";
	    if($locationids) {
	        $condition .= ' and location IN ('.$locationids.') ';
	    }
	    
	    $this->model->setCondition($condition);
	    
	    $this->model->setLimit(array(0, $count));
	    $this->model->setOrder("`status` desc, public_date desc");
	    
	    $normal = $this->model->getObjectsByCondition();
	    
	    $option[$tabid]['pageList'] = $vip;
	    foreach( $normal as $key => $item) {
	        $option[$tabid]['pageList'][$key] = $item;
	    }

	    foreach( $option[$tabid]['pageList'] as $key => $item ) {
	        $tmp = $item->getLocation();
	        if(empty($tmp)) continue;
	         
	        $tmp = VSFactory::getMenus()->getCategoryById($tmp);
	        $formatted_location = $tmp->getTitle() .'. ';
	         
	        $tmp = VSFactory::getMenus()->getCategoryById($tmp->getParentId());
	         
	        if($tmp->getId() == 544) continue;
	        $formatted_location .= $tmp->getTitle();
	         
	        $option[$tabid]['pageList'][$key]->formatted_location = $formatted_location;
	    }
	     
	    $vsPrint->mainTitle = $vsPrint->pageTitle = $category->getTitle();
	
	    $option['current'] = $tabid;
	     
	    $tmp = VSFactory::getMenus()->extractNodeInTree($tabid, $option['cate']);
	
	    if(count($tmp['category']->getChildren())){
	        $option['sub-category'] = $tmp['category']->getChildren();
	    } else {
	        $tmp = VSFactory::getMenus()->getCategoryById($tmp['category']->getId());
	         
	        $tmp = VSFactory::getMenus()->extractNodeInTree($tmp->getParentId(), $option['cate']);
	        if($tmp['category'])
	            $option['sub-category'] = $tmp['category']->getChildren();
	    }
	
	    $option['detail-flag'] = $detailFlag;
	
	    $option['category-type'] = $type;
	     
	    if(!$detailFlag && $type == 'city') {
	        $this->model->setFieldsString('location, COUNT(*) as title');
	        $this->model->setCondition($condition);
	        $this->model->setGroupby('location');
	        $tmp = $this->model->getObjectsByCondition('getLocation');
	
	        $cout = array();
	        foreach($tmp as $k => $item) {
	            $cout[$k] = $item->getTitle();
	        }
	         
	        $option['location'] = $this->_formatCity($option['location'], $cout);
	    }
	
	    return $this->output = $this->getHtml()->showDefault($option);
	}
	
	function showCategory($type = 'state', $location = 0, $catId = 0){
	    global $bw, $vsPrint;

	    $option = array();
	 
	    $category = VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
	    $option['cate'] = $category->getChildren();
	    
	    $detailFlag = ($type == 'detail') ? true : false;
	   
	    $keywords = array('state', 'city', 'detail');
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
	    
	    if($type == 'city'|| $type == 'detail') {// || $type = 'detai1l'
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
	           
	            if($flag) {
	                break;
	            }
	        }
	    } 
	    
	    if(empty($catId)) {
	        reset($option['cate']);
	        $tmp = current($option['cate']);
	    
	        $catId = $tmp->getSlugId();
	    } 
	    
	    
	    $option['category-id'] = $idcate = $this->getIdFromUrl($catId);
	    if(empty($tabid)) {
	        $tabid = $idcate;
	    }
	   
	    $category=VSFactory::getMenus()->getCategoryById($idcate);
	    if(!$category){
	        $vsPrint->boink_it($bw->base_url);
	    }
	    
	    if($type == 'state') {
	        $index = 3;
	        $option['location'] = $this->_formatState($this->_stateList($catId));
	    } elseif($type == 'city') {
    	    if($location) {
    	        $index = 5;
    	        $id = $this->getIdFromUrl($location);
    	        
    	        $locationids = array();
	            $option['location'] = $this->_cityList($id, $catId, $locationids, $cityObject, $stateObj);
    	       
    	        $locationids = implode(',', $locationids);
    	    }
	    } elseif($type == 'detail') {
    	    if($location) {
    	        $index = 5;
    	        
    	        $locationids = $this->getIdFromUrl($location);
    	        
    	        $option['city-obj'] = VSFactory::getMenus()->getCategoryById($locationids);
    	        $option['state-obj'] = VSFactory::getMenus()->getCategoryById($option['city-obj']->getParentId());
    	    }
	    }
	    
	    $url = '';
	    $temp = 0;
	    while($temp<$index) {
	        $url .= $bw->input[$temp++]."/";
	    }
	   
	    $size = VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit', 24);
	    
	    $ids=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
	    
	    $condition = "status > 0 and status < 99 and catId in ({$ids}) and DATE_FORMAT(public_date, '%Y-%m-%d') <= CURDATE() and DATE_FORMAT(end_date, '%Y-%m-%d') >= CURDATE()";
	    if($locationids) {
	        $condition .= ' and location IN ('.$locationids.') ';
	    }
	    
	    $this->model->setCondition($condition);

	    $this->model->setOrder("`status` desc, public_date desc");
	
	    $option[$tabid]=$this->model->getPageList($url,$index,$size);
	
	    foreach( $option[$tabid]['pageList'] as $key => $item ) {
	        $tmp = $item->getLocation();
	        if(empty($tmp)) continue;
	        
	        $tmp = VSFactory::getMenus()->getCategoryById($tmp);
	        $formatted_location = $tmp->getTitle() .'. ';
	        
	        $tmp = VSFactory::getMenus()->getCategoryById($tmp->getParentId());
	        
	        if($tmp->getId() == 544) continue;
	        $formatted_location .= $tmp->getTitle();
	        
	        $option[$tabid]['pageList'][$key]->formatted_location = $formatted_location;
	    }	    
	    
	    $vsPrint->mainTitle = $vsPrint->pageTitle = $category->getTitle();

	    $option['current'] = $tabid;
	    
	    $tmp = VSFactory::getMenus()->extractNodeInTree($tabid, $option['cate']);

	    if(count($tmp['category']->getChildren())){
	       $option['sub-category'] = $tmp['category']->getChildren();
	    } else {
	        $tmp = VSFactory::getMenus()->getCategoryById($tmp['category']->getId());
	        
	        $tmp = VSFactory::getMenus()->extractNodeInTree($tmp->getParentId(), $option['cate']);
	        if($tmp['category'])
	           $option['sub-category'] = $tmp['category']->getChildren();
	    }
	   
	    $option['detail-flag'] = $detailFlag;

	    $option['category-type'] = $type;
	    
	    if(!$detailFlag && $type == 'city') {
	        $this->model->setFieldsString('location, COUNT(*) as title');
	        $this->model->setCondition($condition);
	        $this->model->setGroupby('location');
	        $tmp = $this->model->getObjectsByCondition('getLocation');
	         
	        $cout = array();
	        foreach($tmp as $k => $item) {
	            $cout[$k] = $item->getTitle();
	        }
	        
	        $option['location'] = $this->_formatCity($option['location'], $cout);
	    }

	    return $this->output = $this->getHtml()->showDefault($option);
	}
	
	function search($catId = 0){
	    global $bw, $vsPrint;
	
	    $option = array();
	
	    $category = VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
	    $option['cate'] = $category->getChildren();

	    $index = 3;
	    if(empty($catId)) {
	        $index = 2;
	        reset($option['cate']);
	        $tmp = current($option['cate']);
	    
	        $catId = $tmp->getSlugId();
	    }
	    $idcate = $this->getIdFromUrl($catId);
	    
	    foreach( $option['cate'] as $id1 => $level1) {
	        if($level1->getId() == $idcate) {
	            $flag = true;
	            $type = 'state';
	        }
	         
	        if($flag) break;
	    
	        foreach( $level1->children as $level2) {
	            if($level2->getId() == $idcate) {
	                $flag = true;
	                $tabid = $id1;
	            }
	        }
	    
	        if($flag) break;
	    }
	    
	    if(empty($tabid)) {
	        $tabid = $idcate;
	    }
	     
	    $option['category-id'] = $idcate;
	    
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
	     
	    $condition = "status > 0 and status < 99 and catId in ({$ids}) and DATE_FORMAT(public_date, '%Y-%m-%d') <= CURDATE() and DATE_FORMAT(end_date, '%Y-%m-%d') >= CURDATE()";
	    
	    $bw->input['keywords'] = trim($bw->input['keywords']);
	    if(!empty($bw->input['keywords'])) {
	        $keyword = VSFactory::getTextCode()->removeAccent($bw->input['keywords'], ' ');
	        
	        $condition .= ' and clean LIKE "%'.$keyword.'%" ';
	    }
	     
	    $this->model->setCondition($condition);
	
	    $this->model->setOrder("`status` desc, public_date desc");
	
	    $bw->input['advance'] = "?keywords={$bw->input['keywords']}";
	    
	    $option[$tabid]=$this->model->getPageList($url,$index,$size);
	
	    $vsPrint->mainTitle = $vsPrint->pageTitle = $category->getTitle();
	
	    $option['current'] = $tabid;
	     
	    $tmp = VSFactory::getMenus()->extractNodeInTree($tabid, $option['cate']);
	    $option['sub-category'] = $tmp['category']->getChildren();
	     
	    return $this->output = $this->getHtml()->search($option);
	}
	
	function _cityList($state = 0, $category = '', &$callback = array()) {
	    $tmp = VSFactory::getMenus()->getCategoryGroup('locations')->getChildren();
	
	    $location = array(); 
	    foreach($tmp as $id => $level1) {
	        if($id != $state) continue;
	        
	        $callback[$id] = $id;
	        foreach($level1->children as $id2 => $level2) {
	           $location[$level2->getTitle()] = array('id' => $level2->getId(), 'title' => $level2->getTitle(), 'url'=> $level2->getCatUrl('posts/category/detail/').'/'.$category);
	           
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
	
	function _formatCity($location = array(), $count = array()) {
	    $result = array();
	    
	    $run = array();
	    foreach($location as $key => $item) {
// 	        if(array_key_exists($item['id'], $count)) {
    	        $first = strtoupper($key[0]);
    	        
    	        if(empty($run[$first])) {
    	            $run[$first] = array('id' => 0, 'title' => $first, 'url' => '#');
    	        }
    	        
    	        if(!empty($count[$item['id']]))
    	           $item['title'] .= '&nbsp;('.$count[$item['id']].')';
    	        
    	        $run[$item['title']] = $item;
// 	        }
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
	    $t = 0; $max = ($col*$row) - count($run);
	    while($t++<$max){
	        $result[$i++][$j] = array('id' => 0, 'title' => '', 'url' => '#');
	    }

	    return $result;
	}
	
	function showForm($catId, $id = 0, $custom = array()) {
	    global $vsPrint,$bw;

	    if(!VSFactory::getUsers()->basicObject->getId()){
	        $vsPrint->redirect_screen(VSFactory::getLangs()->getWords('not_login','Bạn chưa đăng nhập'), '');
	    }
	    
	    $obj = $this->model->basicObject;
	    if($id) {
	        $obj = $this->model->getObjectById($id);
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
	    
	    require_once CORE_PATH.'gallerys/gallerys.php';
	    $model = new gallerys();
	    
	    $gid = 'posts_'.$obj->getId();
	    $tmp = $model->getObjByCode($gid);
	     
	    if($tmp) {
	        $option['gallery'] = $model->getFileByAlbumId($tmp->getId());
	    }

	    $vsPrint->addJavaScriptFile ( "tiny_mce/tiny_mce" );
	    $vsPrint->addJavaScriptFile ( "tiny_mce/jquery.tinymce" );
	    
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
	        return $this->showForm($catId, 0, $option);
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
	    
	    $id = empty($bw->input['posts']['id']) ? 0 : $bw->input['posts']['id'];
	    
	    if(empty($bw->input['posts']['id'])) {
    	    $bw->input['posts']['created_date'] = date('Y-m-d H:m:s');
    	    $this->model->basicObject->convertToObject($bw->input[$this->modelName]);
    	    $flag = $this->model->insertObject();
	    } else {
	        $this->model->getObjectById($bw->input[$this->modelName]['id']);
	        $this->model->basicObject->convertToObject($bw->input[$this->modelName]);
	        $flag = $this->model->updateObject();
	    }
	    
	    if(empty($flag)) {
	        $option['error'] = VSFactory::getLangs()->getWords('empty_title','Tiêu đề không được để trống');
	         
	        return $this->showForm($catId, $id, $option);
	    }
	    
	    $this->_gallery();
	    
	    if(empty($bw->input['posts']['id'])) {
	        return $vsPrint->redirect_screen(VSFactory::getLangs()->getWords('add_ok', 'Bạn đã đăng tin thành công'), '');
	    }

	    return $vsPrint->redirect_screen(VSFactory::getLangs()->getWords('edit_ok', 'Bạn đã cập nhật thành công'), 'posts/me');
	}
	
	function _gallery() {
	    global $bw;
	    require_once CORE_PATH.'gallerys/gallerys.php';
	    $model = new gallerys();
	     
	    if(empty($bw->input['posts']['id'])) {
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
	    } else {
	        $gid = 'posts_'.$this->model->basicObject->getId();
	        $tmp = $model->getObjByCode($gid);
	        	
	        if($tmp) {
	            $g_id = $model->basicObject->getId();
	            if(!empty($bw->input['gallery'])) {
	                $query = "DELETE FROM `vsf_gallery_file_rel` WHERE `vsf_gallery_file_rel`.`galleryId` = '".$g_id."'";
	                $model->executeNoneQuery($query);
	                	
	                foreach($bw->input['gallery'] as $id) {
	                    $model->addFileToAlbum($id, $g_id);
	                }
	            } else {
	                $query = "DELETE FROM `vsf_gallery` WHERE `vsf_gallery`.`id` = '".$g_id."'";
	                $model->executeNoneQuery($query);
	            }
	        } else {
	            if(!empty($bw->input['gallery'])) {
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
	        }
	    }
	}
	
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
		//////////////
		
		$stateInfo = VSFactory::getMenus()->getCategoryById($location_info->getParentId());
		
		$author_type = $obj->getAuthorType();
		$option['author_type'] = $author_type;
		if($author_type == 'user') {
		    require_once CORE_PATH.'users/users.php';
		    $model = new users();
		    
		    $option['author'] = $model->getObjectById($obj->getAuthor());
		   
		    $address = $option['author']->getAddress() . ' ' . $location_info->getTitle() . ' ' .
		    $stateInfo->getTitle();
		    
		    $address = urlencode($address);
		    
		    $du = file_get_contents("http://maps.google.com/maps/api/geocode/json?address={$address}&sensor=false");
		    $tmp = json_decode(utf8_encode($du),true);
		    
		    if($tmp['status'] != 'ZERO_RESULTS') {
		        $tmp = current($tmp['results']);
		
    		    $option['map']['geometry'] = $tmp['geometry']['location'];
    		    $option['map']['formatted_address'] = $tmp['formatted_address'];
		    }
		} else {
		    $address = $obj->getAddress() . ' ' . $location_info->getTitle() . ' ' .
		            $stateInfo -> getTitle();
		    
		    $address = urlencode($address);
		    
		    $du = file_get_contents("http://maps.google.com/maps/api/geocode/json?address={$address}&sensor=false");
		    $tmp = json_decode(utf8_encode($du),true);
		
		    if($tmp['status'] != 'ZERO_RESULTS') {
    		    $tmp = current($tmp['results']);
    		    
    		    $option['map']['geometry'] = $tmp['geometry']['location'];
    		    $option['map']['formatted_address'] = $tmp['formatted_address'];
		    }
		}
	
		if(empty($bw->input['info'])) $bw->input['info'] = 'city';
		$vsPrint->mainTitle = $vsPrint->pageTitle = $category->getTitle();
		$vsPrint->addExternalJavaScriptFile("http://maps.google.com/maps/api/js?v=3.exp&sensor=false&language=vi",1);
		
		$option['category-info'] = VSFactory::getMenus()->getCategoryById($obj->getCatId());
		$option['state-info'] = $stateInfo;
		$option['others'] = $this->_other($obj);

		$this->output = $this->getHtml()->showDetail($obj, $option);
	}
	
	function _other($obj) {
	    $result = array();
	    
	    $idcate = $obj->getCatId();
	    $locationid = $obj->getLocation();
	    
	    $ids=VSFactory::getMenus()->getChildrenIdInTree($idcate);
	     
	    $condition = "id <> {$obj->getId()} AND status > 0 and status < 99 and catId in ({$ids}) and DATE_FORMAT(public_date, '%Y-%m-%d') <= CURDATE() and DATE_FORMAT(end_date, '%Y-%m-%d') >= CURDATE()";
	    if($locationid) {
	        $condition .= ' and location IN ('.$locationid.') ';
	    }
	     
	    $this->model->setCondition($condition);
	    $this->model->setOrder("`status` desc, public_date desc");
	    $this->model->setLimit(array(0, 8));
	    
	    return $result = $this->model->getObjectsByCondition();
	}
	
	function me($catId = 0){
	    global $bw, $vsPrint, $vsUser;
	    
	    $userId = $vsUser->obj->getId();
	    if(empty($userId))
	       $vsPrint->redirect_screen(VSFactory::getLangs()->getWords('login_required', 'Bạn chưa đăng nhập'), '');
	
	    
	    $category = VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
	    $tmp = $category->getChildren();
	    
	    if(empty($catId)) {
	        $first = current($tmp);
	        
	        $vsPrint->boink_it($bw->base_url.'posts/me/'.$first->getSlugId());
	    }
	    
	    $option['cate'] = $tmp;
	    
	    
	    $tabid = $this->getIdFromUrl($catId);
         
	    $size = VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit', 24);
	
	    $ids = VSFactory::getMenus()->getChildrenIdInTree($tabid);
	    $condition = "status > 0 and catId in ({$ids}) and author_type = 'user' and author = {$userId}";
	
	    $this->model->setCondition($condition);
	
	    $this->model->setOrder("created_date desc");
	    $option[$tabid] = $this->model->getPageList($url,$index,$size);
	
	    require_once CORE_PATH.'gallerys/gallerys.php';
	    $model = new gallerys();
	    
	    $categoryInfo = array();
	    foreach($option[$tabid]['pageList'] as $item) {
	        $temp = $item->getCatId();
	        $temp = VSFactory::getMenus()->getCategoryById($temp)->getParentId();
	        $categoryInfo[$item->getCatId()] = VSFactory::getMenus()->getCategoryById($temp)->getSlugId();
	    }
	    
	    $option['tab-id'] = $tabid;
	    $option['category-info'] = $categoryInfo;
	    $vsPrint->mainTitle = $vsPrint->pageTitle = $category->getTitle();
	
	    return $this->output = $this->getHtml()->me($option);
	}
	
	function delete($id = 0){
	    global $bw, $vsPrint, $vsUser;
	     
	    $userId = $vsUser->obj->getId();
	    if(empty($userId))
	        $vsPrint->redirect_screen(VSFactory::getLangs()->getWords('login_required', 'Bạn chưa đăng nhập'), '');

	    $query = "DELETE FROM `vsf_post` WHERE `vsf_post`.`id` = '".$id."' and author_type = 'user' and author = {$userId} ";
	    $model->executeNoneQuery($query);

	    return $vsPrint->redirect_screen(VSFactory::getLangs()->getWords('delete_ok', 'Bạn đã xóa bài viết thành công'), 'posts/me');
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
