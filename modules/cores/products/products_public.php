<?php

class products_public extends ObjectPublic{
	function __construct(){
            global $vsTemplate,$donvi,$vsMenu;
            parent::__construct('products', CORE_PATH.'products/', 'products');
            $this->html = $vsTemplate->load_template('skin_products');
          
	}
	
	
//	function auto_run() {
//		global $bw, $vsPrint;
//		
//		switch ($bw->input['action']) {
//			case 'detail':
//					$this->showDetail($bw->input[2]);
//				break;
//			case 'category':
//					$this->showCategory($bw->input[2]);
//				break;
//				
//			case 'search':
//					$this->search();
//				break;
//                        case 'comment':
//					$this->writeComment();
//				break;    
//			default:
//					$this->showDefault();
//				break;
//		}
//	}
//	
//function writeComment(){
//		global $vsStd, $vsPrint, $bw, $vsLang,$DB;
//		$vsStd->requireFile(CORE_PATH."comments/comments.php");
//		$vsStd->requireFile(ROOT_PATH."captcha/securimage.php");
//		$image = new Securimage();
//		if(!$image->check($bw->input['commentSecurity'])) {
//			$bw->input['message'] = $vsLang->getWords('thank_message','Security code doesnot match');
//			unset($bw->input[3]);
//			$com = new Comment();
//			$profile['email'] = $bw->input['commentEmail'];
//			$bw->input['commentProfile']= serialize($profile); 
//			$com->convertToObject($bw->input);
//			return $this->showDetail($bw->input[2],$com);
//		}
//		$query = explode('-',$bw->input[2]);
//		$objId = abs(intval($query[count($query)-1]));
//		$bw->input['commentObjId'] = $objId;
//		$bw->input['commentCatId'] = $bw->input['cat'];
//
//		$comments = new comments();
//		$result = $comments->writeComment();
//		
//		if($result['status']){
//			$bw->input['message'] = $vsLang->getWords("comment_successful","Your feedback has been sent");
//		}
//		else {
//			$bw->input[1] = 'detail';
//			unset($bw->input[3]);
//			$bw->input['message'] = $vsLang->getWords("comment_fail","Xảy ra lỗi trong quá trình gửi phản hổi");
//		}
//		
//		$this->showDetail($bw->input[2]);
//		
//	}	
//function showDetail($objId,$com=NULL){
//		global $vsPrint, $vsLang, $bw,$vsMenu,$vsTemplate,$vsSettings,$vsStd;              
//		$query = explode('-',$objId);
//		$Id = intval($query[count($query)-1]);
////                $cond = "{$this->tableName}MtUrl = '{$objId}'";
//                if($Id)$cond.="  {$this->tableName}Id = {$Id}";
////                $this->model->setOrder("{$this->tableName}MtUrl DESC");
//		$this->model->setCondition($cond);
//		$obj=$this->model->getOneObjectsByCondition();
//     	if(!$obj) return $vsPrint->redirect_screen($vsLang->getWords('global_no_item','KhÃ´ng cÃ³ dá»¯ liá»‡u theo yÃªu cáº§u'));
//		$this->model->convertFileObject(array($obj),$bw->input['module']);
//                
//		
//		$this->model->getNavigator($obj->getCatId());
//
//		$option['cate'] =  $vsMenu->getCategoryById($obj->getCatId());
//		
//		$cat = $vsMenu->getCategoryById($obj->getCatId());
//		$ids=$vsMenu->getChildrenIdInTree($cat);
//
//		$this->model->setFieldsString("{$this->tableName}Id,{$this->tableName}Title,{$this->tableName}Image,{$this->tableName}PostDate,{$this->tableName}CatId,{$this->tableName}Intro,{$this->tableName}Price,{$this->tableName}HotPrice,{$this->tableName}Manu");
////		$this->model->setOrder("{$this->tableName}Index Desc, {$this->tableName}Id Desc");
//       	
//    	$size =  $vsSettings->getSystemKey("{$this->tableName}_user_list_number_other",10,$bw->input['module']);
//		$this->model->setLimit(array(0,$size));
//		if($ids)
//			$this->model->setCondition("{$this->tableName}Id <> {$obj->getId()} and {$this->tableName}Status >0 and {$this->tableName}CatId in ( {$ids})");
//
//   		$option['other'] = $this->model->getObjectsByCondition();
//                if($option['other'])
//                    $this->model->convertFileObject($option['other'],$bw->input['module']);
//                $option['img'] =$this->model->getarrayGallery($obj->getId(),$bw->input['module']);
//   		
//		//comment 
//		
//			$this->model->vsRelation->setTableName('products_comments');
//			$this->model->vsRelation->setObjectId($Id);
//			$this->model->vsRelation->setRelId(NULL);
//			$this->model->vsRelation->setFieldsString("relId");
//			$strIds = $this->model->vsRelation->getRelByObject();
//			$vsStd->requireFile(CORE_PATH."comments/comments.php");
//		        $comments = new comments();
//			if($strIds){
//				
//				$comments->setCondition("commentId in (".$strIds.") AND commentCatId in (".$obj->getCatId().") AND commentStatus > 0");
//				$total = $comments->getNumberOfObject();
//				$size = $vsSettings->getSystemKey('comment_simple_cat_quality', 4, $bw->input[0], 0, 0);
//				$comment['comment'] = $comments->getPageList($bw->input['module'].'/detail/'.$objId.'/',3,$size);
//				
//			}
//		
//			$comment['count_comment'] = $total?$total:0;
//			$comment['message']  = $bw->input['message'];
//			if($com)$comment['com'] = $com;
//			else $comment['com'] = new Comment();
//		//$obj->createSeo();
//    		$this->output = $this->html->showDetail($obj,$option,$comment);
//		
// 
//	}	
//	function showCategory($catId){
//		global $vsPrint,$bw,$vsSettings, $vsMenu,$vsTemplate;
//               
//		$query = explode('-',$catId);
//		$idCate = abs(intval($query[count($query)-1]));
//		$categories = $this->model->getCategories();
//                
//		if(!intval($idCate)){
//			$strIds = $vsMenu->getChildrenIdInTree( $categories);
//		}else{
//			$result = $vsMenu->extractNodeInTree($idCate, $categories->getChildren());
//			if($result)
//			//$strIds = implode (",", $result['ids']);
//			$strIds = $vsMenu->getChildrenIdInTree( $result['category']);
//		}
//             
//		if($strIds)
//			$this->model->setCondition($this->model->getCategoryField().' in ('. $strIds. ") and {$this->tableName}Status > 0 ");
//		
//		$this->model->setFieldsString("{$this->tableName}Title, {$this->tableName}Image, {$this->tableName}Id, {$this->tableName}Intro, {$this->tableName}CatId,{$this->tableName}PostDate,{$this->tableName}Price,{$this->tableName}HotPrice,{$this->tableName}Manu");       
//		
////		$this->model->setOrder("{$this->tableName}Status Desc,{$this->tableName}Index Asc,{$this->tableName}Id Desc");
//		$size  = $vsSettings->getSystemKey("{$bw->input[0]}_user_item_quality",7,$bw->input[0]);
//		
//    	$option = $this->model->getPageList($bw->input['module']."/category/".$catId."/", 3, $size);
//                $this->model->getNavigator($idCate);
//      	if($option['pageList'])
//        	$this->model->convertFileObject($option['pageList'],$bw->input['module']);
//                
//      	
//		$option['cate'] =  $vsMenu->getCategoryById($idCate);
//		$option['parentcate'] =  $vsMenu->getCategoryById($option['cate']->getParentId());
//		$vsPrint->mainTitle = $vsPrint->pageTitle =  $result['category']->getTitle();
//		
//    	return $this->output = $this->html->showDefault($option);
//	}
        
        
}

?>