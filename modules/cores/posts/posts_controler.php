<?php
require_once (CORE_PATH . 'posts/posts.php');
class posts_controler extends VSControl_admin {

	function __construct($modelName) {
		global $vsTemplate, $bw; // $this->html=$vsTemplate->load_template("skin_posts");
		parent::__construct ( $modelName, "skin_posts", "post" );
		$this->model->categoryName = "posts";
	}

	function getObjList($catId = '', $message = "",$option=array()) {
	    global $bw,$DB;
	    $option['message']=str_replace(array("'","\n"),array("\\'","\\n"), $message) ;
	    $catId=intval($catId);
	    if($_REQUEST['vdata']){
	        $vdata=json_decode($_REQUEST['vdata'],true);
	    }
	    if($vdata['search']){//last query search
	        $bw->input['search']=$vdata['search'];
	        $option['table']=$this->displaySearch();
	    }else{
	        if($bw->input['pageIndex']){
	            $bw->input[3]=$bw->input['pageIndex'];
	        }
	        	
	        if($this->model->getCategoryField()){
	            $ids=VSFactory::getMenus()->getChildrenIdInTree($this->model->getCategories());
	            if($ids)
	                $this->model->setCondition("{$this->model->getCategoryField()} in ($ids)");
	        }
	        
	        $result = $DB->query("SHOW COLUMNS FROM `".$bw->vars['sql_tbl_prefix_0'].$this->tableName."` LIKE 'status'");
	        $exists = (mysql_num_rows($result))?TRUE:FALSE;
	        if($exists)
	        if($this->model->getCondition())
	            $this->model->setCondition($this->model->getCondition().' AND status>=-1');
	        else $this->model->setCondition('status>=-1');
	         
	        $this->model->setOrder('created_date desc');
	        $option=array_merge($option, $this->model->getPageListHash($this->modelName."/".$bw->input [0]."/{$this->modelName}_display_tab/{$catId}/",3,
	        	
	        VSFactory::getSettings()->getSystemKey("{$this->modelName}_admin_paging_limit",20)));
	
	        $option['s_order'] = $bw->input['search']['s_order']=='ASC'?'DESC':'ASC';
	        $option['s_ofield'] = $bw->input['search']['s_ofield'];
	        $bw->input['pageIndex']=$bw->input[3];
	        $bw->input['back']="&pageIndex=".$bw->input['pageIndex'];
	        $option['table']=$this->html->getListItemTable ($this->model->getArrayObj (), $option );
	       
	        ///some here..................
	    }
	    return $this->output = $this->html->objListHtml ( $option );
	}
	
	function addEditObjForm($objId = 0, $option = array()) {
	    global  $vsStd, $bw, $vsPrint;
	    
	    $obj=$this->model->getObjectById($objId);
	    $option['vdata']=$_REQUEST['vdata'];
	    if(count($_GET['search'])){
	        $tmp['search']=$_GET['search'];
	        $bw->input['back']=$bw->input['back']="/".$bw->input[0]."/".$this->modelName."_search&".urldecode( http_build_query($tmp	));
	    }else{
	        $bw->input['back']="/{$bw->input[0]}/{$this->modelName}_display_tab/";
	    }
	    $bw->input['back'].="&pageIndex=".$bw->input['pageIndex'];
	    
	    $option['location'] = VSFactory::getMenus()->getCategoryGroup('locations')->getChildren();
	    $option['author_type'] = 'admin';
	    if($objId) {
	        require_once (CORE_PATH . 'users/users.php');
	        $model = new users();
	        $user = $model->getObjectById($this->model->basicObject->getAuthor());
	         
	        $date = date('Y-m-d H:m:s');
	        if($this->model->basicObject->getPublicDate() == '0000-00-00') {
	            $this->model->basicObject->setPublicDate($date);
	        }
	        
	        if($this->model->basicObject->getEndDate() == '0000-00-00') {
	            $duration = $user->getGroupCode() == USER_TYPE_VIP ? 'vip_post_duration' : 'normal_post_duration';
	            
	            $duration = VSFactory::getSettings()->getSystemKey($duration, 1);
	            $date = strtotime("+{$duration} day");

	            $this->model->basicObject->setEndDate(date('Y-m-d H:m:s', $date));
	        }

	        $option['author_type'] = $this->model->basicObject->getAuthorType();
	        
// 	        if($this->model->basicObject->getStatus() == 99) {
// 	            $this->model->basicObject->setStatus(0);
// 	        }
	    }
	    
	    return $this->output = $this->html->addEditObjForm ( $obj, $option );
	}
	
	function addEditObjProcess() {
	    global $bw, $vsStd, $vsUser;
	    /****file processing**************/
	
	    $bw->input[$this->modelName]['module'] = $bw->input[0];
	
	    if(is_array($bw->input['files'])){
	        foreach ($bw->input['files'] as $name=> $file) {
	            $bw->input[$this->modelName][$name]=$file;
	        }
	    }
	    if(is_array($bw->input['links'])){
	        foreach ($bw->input['links'] as $name=> $value) {
	            $url=parse_url($value);
	            if($bw->input['filetype'][$name]=='link'&&$url['host']){
	                $files=new files();
	                $fid=$files->copyFile($value,$bw->input[0]);
	                if($fid)
	                    $bw->input[$this->modelName][$name]=$fid;
	            }
	            unset($url);
	        }
	    }
	
	    /****end file processing**************/
	    if($bw->input[$this->modelName]['id']){
	        $this->model->getObjectById($bw->input[$this->modelName]['id']);
	        
	        if(!$this->model->basicObject->getId()){
	            return $this->output =  $this->getObjList ($bw->input['pageIndex'],"Not define object of id={$bw->input[$this->modelName]['id']} submited!");
	        }
	        
	        if($bw->input[$this->modelName]['image']){
	            $files=new files();
	            $files->deleteFile($this->model->basicObject->getImage());
	        }
	        
	        require_once (CORE_PATH . 'users/users.php');
	        $model = new users();
	        $user = $model->getObjectById($this->model->basicObject->getAuthor());
	        
	        if($bw->input[$this->modelName]['status'] == 1 && $this->model->basicObject->getStatus() == 99) {
	            $status = $user->getGroupCode() == USER_TYPE_VIP ? POST_STATUS_VIP : POST_STATUS_GUEST;
	            
	            $bw->input[$this->modelName]['status'] = $status;
	            
// 	            $this->getSettings()->getSystemKey($bw->input[0].'_'.$this->modelName.'_image_field','Image',$bw->input[0].'_'.$this->modelName.'_form');
	        }
	        if($this->model->basicObject->getAuthorType() == 'user'){
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
	                $bw->input[$this->modelName][$k] = $user->$f();
	            }
	        }
	        /////delete some here..........................................
	    } else {
	        $time = date('Y-m-d H:m:s');
	        $bw->input[$this->modelName]['created_date'] = $time;
	        $bw->input[$this->modelName]['public_date']  = $time;
	        
	        $bw->input[$this->modelName]['author'] = $_SESSION[APPLICATION_TYPE]['obj']['id'];
	        $bw->input[$this->modelName]['author_type'] = APPLICATION_TYPE;
	        /////delete some here before inserting...................
	    }
	
	    $clean = $bw->input[$this->modelName]['title'] . ' ' . $bw->input[$this->modelName]['intro'] . ' ' . $bw->input[$this->modelName]['content'];
	    $bw->input[$this->modelName]['clean'] = VSFactory::getTextCode()->removeAccent($clean, ' ');
	    
	    $bw->input[$this->modelName]['mUrl']=$bw->input[$this->modelName]['mUrl']?$bw->input[$this->modelName]['mUrl']:$bw->input[$this->modelName]['slug'];
	
	    $this->model->basicObject->convertToObject($bw->input[$this->modelName]);
	    if(!$this->model->basicObject->getCatId()){
	        if($this->model->getCategoryField()){
	            $this->model->basicObject->setCatId($this->model->getCategories()->getId());
	        }
	    }
	    if($this->model->basicObject->getId()){
	        $this->model->updateObject();
	        $message= VSFactory::getLangs()->getWords('update_success');
	    }else{
	        $this->model->insertObject();
	        $message=VSFactory::getLangs()->getWords('insert_success');
	    }
	    
	    global $DB;
	    print "<pre>";
	    print_r($DB->obj);
	    print "</pre>";
	    
	    /**add tags process***/
	    require_once CORE_PATH.'tags/tags.php';
	    $tags=new tags();
	    $tags->addTagForContentId($bw->input[0], $this->model->basicObject->getId(), $bw->input['tags_submit_list']);
	    /****/
	    $this->afterProcess($this->model);
	    if(!$this->model->result['status']){
	        $message=$this->model->result['developer'];
	    }
	    ///////some here.....................
	    $this->lastModifyChange();
	    return $this->output =  $this->getObjList ($bw->input['pageIndex'],$message);
	}
	
	
	function displaySearch(){
	    global $bw;
	    if($bw->input['search']['s_order']&&$bw->input['search']['s_ofield'])
	        $order=$bw->input['search']['s_ofield'].' '.$bw->input['search']['s_order'];
	    $from="vsf_".$this->tableName;
	    $where="1=1";
	    if($bw->input['search']['title']){
	        $where.=" and `title` like '%{$bw->input['search']['title']}%'";
	    }
	    if($bw->input['search']['id']){
	        $where.=" and `id`='{$bw->input['search']['id']}' ";
	    }
	    if(isset($bw->input['search']['catId']))
	    if($bw->input['search']['catId']>0){
	        $category=VSFactory::getMenus()->getCategoryById($bw->input['search']['catId']);
	        if($category){
	            $idns=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
	            $where.=" and `catId` in ({$idns})";
	        }
	    }else{
	        if($this->model->categoryName){
	            $category=VSFactory::getMenus()->getCategoryGroup($this->model->categoryName);
	            if($category){
	                $idns=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
	                $where.=" and `catId` in ({$idns})";
	            }
	        }
	    }
	    
	    if($bw->input['search']['location']>0){
	        $category=VSFactory::getMenus()->getCategoryById($bw->input['search']['location']);
	        if($category){
	            $idns=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
	            $where.=" and `location` in ({$idns})";
	        }
	    }
	    
	    if($bw->input['search']['status']!=-1&&$bw->input['search']['status']!==NULL){
	        $where.=" and `status`='{$bw->input['search']['status']}'";
	
	    }
	    $this->model->setCondition($where);
	    $this->model->setOrder($order);
	     
	    $itemList=$this->model->getObjectsByCondition();
	    $vdata['search']=$bw->input['search'];
	    $option['vdata']=json_encode($vdata);
	    //if(!is_object($_GET['search'])) $_GET['search']=array();
	    $tmp['search']=$_GET['search'];
	    $bw->input['back']=urldecode( http_build_query($tmp	))."&pageIndex=".$bw->input['pageIndex'];
	     
	    $option['s_order'] = $bw->input['search']['s_order']=='ASC'?'DESC':'ASC';
	    $option['s_ofield'] = $bw->input['search']['s_ofield'];
	    return $this->output = $this->html->getListItemTable ($itemList, $option );
	}
	
	function getHtml() {
		return $this->html;
	}

	function getOutput() {
		return $this->output;
	}

	function setHtml($html) {
		$this->html = $html;
	}

	function setOutput($output) {
		$this->output = $output;
	}
	
	/**
	 * Skins for post .
	 * ..
	 * 
	 * @var skin_posts
	 *
	 */
	var $html;
	
	/**
	 * String code return to browser
	 */
	var $output;
}
