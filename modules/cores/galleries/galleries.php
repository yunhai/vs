<?php
require_once (CORE_PATH . "galleries/Gallery.class.php");

class galleries extends VSFObject{
	public $obj;

	function __construct() {
		parent::__construct ();
		
		$this->primaryField 	= 'galleryId';
		$this->basicClassName 	= 'Gallery';
		$this->tableName 		= 'gallery';
		
		$this->obj = $this->createBasicObject();
	}
	
	function addGallery($fileList = array(), $data = array()){
		if(!$fileList) return 0;
		
		if(!$data['galleryTime']) $data['galleryTime'] = time();
			
		
		$gId = 0;
		$result = $this->singleInsert($data, &$gId);
		if($result){
			global $vsStd;
			$vsStd->requireFile(CORE_PATH.'galleries/gdetails.php');
			$gd = new gdetails();
			
			$index = 0; 
			foreach($fileList as $key => $iindex){
				$insert[$index]['gdGallery']= $gId;
				$insert[$index]['gdFile']	= $key;
				$insert[$index]['gdStatus']	= 1;
				$insert[$index]['gdTime']	= $data['galleryTime'];
				$insert[$index]['gdIndex']	= $iindex?$iindex:0;
				$index++;
			}
			
			$result = $gd->multiInsert($insert);
			if(!$result) $this->deleteObjectById($gId);
		}
		return $gId;
	}

	function updateGallery($galleryId='', $fileList = array(), $delList = ""){
		if(!$galleryId) return 1;
		
		global $vsStd;
		$vsStd->requireFile(CORE_PATH.'galleries/gdetails.php');
		$gd = new gdetails();
		
		
		if($fileList){
			$index = 0; 
			foreach($fileList as $key => $iindex){
				$insert[$index]['gdGallery']= $galleryId;
				$insert[$index]['gdFile']	= $key;
				$insert[$index]['gdStatus']	= 1;
				$insert[$index]['gdTime']	= time();
				$insert[$index]['gdIndex']	= $iindex?$iindex:0;
				$index++;
			}
			$result = $gd->multiInsert($insert);
		}
		if($delList){
			$delQuery = 'DELETE FROM vsf_'.$gd->getTableName().' WHERE gdFile in ('.$delList.') AND gdGallery = '.$galleryId;
			$gd->executeNoneQuery($delQuery);
			
			$file = new files();
			$file->deleteFile($delList); 
			$cQuery = 'SELECT count(*) as qua FROM vsf_'.$gd->getTableName().' WHERE gdGallery = '.$galleryId;
			$quaArr = $gd->executeQueryAdvance($cQuery, 0, 'qua');
			$temp = current($quaArr);
			$qua = $temp['qua'];
			if($qua == 0){
				$dresult = $this->deleteObjectById($galleryId);
				if($dresult) return 0;
			}
		}
		return 1;
	}
	
	function getGallery($gObj = 0, $gCatId = 0, $gdetail = true){
		global $vsStd;
		if(!($gObj && $gCatId)) return array();
		
		$this->setFieldsString('g.galleryId, gd.*');
		$this->setTableName('gallery as g, vsf_gallery_detail as gd');
		
		$cond = 'g.galleryId = gd.gdGallery AND g.galleryObj in ('.$gObj.') AND g.galleryObjCat in ('.$gCatId.') AND g.galleryStatus > 0 AND gd.gdStatus > 0';
		$this->setCondition($cond);
		
		$extend = array();
		if($gdetail){
			$vsStd->requireFile(CORE_PATH.'galleries/gdetails.php');
			$extend = array('gdetail'=>'GDetail');
		}
		return $this->getAdvanceArrayByCondition('gdId', 'galleryId', 1, $extend);
		
	}
}