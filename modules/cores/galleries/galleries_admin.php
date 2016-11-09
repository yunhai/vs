<?php
/**
 *
 * @author Sanh Nguyen
 * @version 1.0 RC
 */
if ( ! defined( 'IN_VSF' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}
require_once(CORE_PATH."galleries/gallerys.php");
class galleries_admin{
	private  $output;
	private  $html;
	private $module;

	function __construct() {
		global $vsStd, $vsTemplate;
		global $vsPrint;
		$vsPrint->addJavaScriptFile('thickbox');
		$vsPrint->addGlobalCSSFile('thickbox');
		$vsPrint->addJavaScriptFile("tiny_mce/tiny_mce");
		$vsStd->requireFile(JAVASCRIPT_PATH."/tiny_mce/tinyMCE.php");
		$this->module = new gallerys();
		$this->html = $vsTemplate->load_template('skin_galleries');
	}

	public function getOutput() {
		return $this->output;
	}
	public function getHtml() {
		return $this->html;
	}
	function auto_run()
	{
		global $bw;
		//-------------------------------------------
		// What to do?
		//-------------------------------------------

		switch($bw->input['action'])
		{
			case 'display-gallery-tab':
				$this->displayMain();
				break;

			case 'display-album-list':
				$this->displayGalleryAlbumList($bw->input[2]);
				break;

			case 'add-edit-album':
				$this->addEditAlbum($bw->input[2]);
				break;

			case 'add-album-form':
				$this->addEditAlbumForm();
				break;

			case 'edit-album-form':
				$this->addEditAlbumForm('edit');
				break;
			case 'delete-album':
				$this->deleteAlbum($bw->input[3],$bw->input[2]);
				break;
			case 'update-album-status':
				$this->updateAlbumStatus();
				break;
			case 'display-file':
				$this->displayFile($bw->input[2]);
				break;
			case 'display-file-list':
				$this->displayGalleryFileList($bw->input[2]);
				break;
			case 'add-edit-gallery-file':
				$this->addEditGalleryFile();
				break;
			case 'delete-file':
				$this->displayDeleteFile();
				break;
			case 'display-album-tab':
				$this->displayGalleryTab();
				break;
			case 'edit-form-file':
				$this->displayFileForm('edit',$bw->input[2]);
				break;
			case 'add-form-file':
				$this->displayFileForm('add',$bw->input[2]);
				break;
			default:
				$this->loadDefault();
				break;
		}
	}

	function loadDefault() {
		global $vsPrint;

		$vsPrint->addJavaScriptString ( 'init_tab', '
			$(document).ready(function(){
    			$("#page_tabs").tabs({
    				cache: false
    			});
  			});
		' );

		$this->output= $this->html->loadDefault () ;
	}

	function getCategoryBox($message = "") {
		global $bw, $vsMenu;

		$option = array ('listStyle' => "| - -", 'id' => 'gallery-category', 'size' => 10, 'multiple' => true );
		$menu = $this->module->getCategories();
		$data = $vsMenu->displaySelectBox ( $menu->getChildren (), $option );

		return $data;
	}

	function displayMain(){
		$option ['categoryList'] = $this->html->catagoryList($this->getCategoryBox ());
		$option ['galleryAlbum'] = $this->displayGalleryAlbumList();
		$this->output = $this->html->displayMain($option);
	}

	function addEditAlbumForm($formType= "add"){
		global $vsStd, $vsLang, $bw;

		$form ['formSubmit'] = $vsLang->getWords ( "gallery_{$formType}_bt", ucwords ( $formType ) );
		$form ['formTitle'] = $vsLang->getWords ( "gallery_{$formType}_title", ucwords ( $formType ) . " information gallery album" );
		$form ['formType'] = $formType;
		if ($formType=='edit') $this->module->obj = $this->module->getObjectById($bw->input[2]);
		else{
			$this->module->obj->setStatus(1);
			$this->module->obj->setCatId($bw->input[2]?$bw->input[2]:'');
		}


		$editor = new tinyMCE();
		$editor->setWidth('550px');
		$editor->setHeight('50px');
		$editor->setToolbar('simple');
		$editor->setTheme("advanced");
		$editor->setUrl($bw->vars['board_url']);
		$editor->setInstanceName('galleryIntro');
		$editor->setValue($this->module->obj->getIntro());
		$this->module->obj->setIntro($editor->createHtml());

		return $this->output = $this->html->addEditAlbumFrom($this->module->obj, $form);
	}

	function addEditAlbum(){
		global $bw;
		$bw->input['galleryPassWord'] = $bw->input['galleryPassWord']?md5($bw->input['galleryPassWord']):null;
		$bw->input ['fileId'] ? $bw->input ['galleryImage'] = $bw->input ['fileId'] : "";
		if ($bw->input ['galleryId']) {
			$gallery = $this->module->getObjectById ( $bw->input ['galleryId'] );
			if (! $gallery) {
				print "<script>vsf.alert(\"{$this->result['message']}\")</script>";
				return false;
			}
			if($bw->input ['fileId']) $this->module->vsFile->deleteFile ( $gallery->getImage() );
			if($bw->input ['delPassword']) $bw->input['galleryPassWord'] = "";
			$this->module->obj->convertToObject ( $bw->input );
			
			if(!$this->module->obj->getCatId())
			$this->module->obj->setCatId($this->module->getCategories()->getId());
			$this->module->updateObjectById($this->module->obj);
		}
		else{
			$this->module->obj->convertToObject ( $bw->input );
			if(!$this->module->obj->getCatId())
			$this->module->obj->setCatId($this->module->getCategories()->getId());
			$this->module->insertObject ( $this->module->obj );
		}

		$this->displayGalleryAlbumList($this->module->obj->getCatId());
	}

	function displayEditFileForm($module, $fileId){
		global $bw;
		$this->getFileById($fileId);
		$this->displayAddEditGalleryForm($module, 'edit', time(),"",$this->file,$bw->input[3]);

	}

	function displayGalleryAlbumList($cateId=0){
		global $vsStd, $bw, $vsLang,$vsSettings;
		$option['cateId'] = $cateId;
		$categories = $this->module->getCategories();
		if($cateId)	$strIds = trim($cateId.",".$this->module->vsMenu->getChildrenIdInTree($categories),",");
		else{
			$strIds = $this->module->vsMenu->getChildrenIdInTree($categories);
		}
		$this->module->setCondition('galleryStatus>=0 and galleryCatId in('.$strIds.')');
		$size = $vsSettings->getSystemKey("admin_{$bw->input[0]}_list_number",10);

		$option=$this->module->getPageList("{$bw->input[0]}/display-gallery-album-list/{$cateId}/", 3,$size,1,'gallery-list');
		$album=$option['pageList'];
		return $this->output = $this->html->displayGalleryAlbumList($album,$option);
	}

	function deleteAlbum($albumId,$catId){
		$this->module->setCondition("galleryId in({$albumId})");
		$this->module->deleteObjectByCondition();
		$this->displayGalleryAlbumList($catId);
	}

	function updateAlbumStatus(){
		global $bw;

		$this->module->setCondition("galleryId in({$bw->input[3]})");
		$this->module->updateObjectByCondition(array("galleryStatus"=>$bw->input[4]));
		$bw->input[3] = 1;
		$this->displayGalleryAlbumList($bw->input[2]);

	}

	function displayFile($albumId=0){
		$option['file-form'] = $this->displayFileForm('add',$albumId);
		$option['file-list'] = $this->displayGalleryFileList($albumId);
		return $this->output = $this->html->displayFile($option);
	}
	function alertMessage($message='') {
		global $bw ;
		print "<script>
			vsf.alert('{$message}');
		</script>";	
	}
	function createAlbum($array=array()){
		global $vsLang,$bw;
		$array['albumTitle']?$this->module->obj->setTitle($array['albumTitle']):$this->module->obj->setTitle($vsLang->getWords('global_system_auto_album',"System Create Album")." [{$bw->input[2]}]");
		$array['albumCode']	?$this->module->obj->setCode($array['albumCode']):$this->module->obj->setCode($bw->input[2]);
		$this->module->obj->setCatId($this->module->getCategories()->getId());
		$this->module->obj->setStatus(-1);
		$this->module->vsRelation->setRelId($bw->input[3]);
		$this->module->vsRelation->setTableName("gallery_{$bw->input[2]}");
		$strId=$this->module->vsRelation->getObjectByRel();
		if($strId){
			$this->module->setCondition("galleryCode='{$this->module->obj->getCode()}' and galleryId in ({$strId})");
			$obj=$this->module->getOneObjectsByCondition();
		}
		if($obj) return ;
		$this->module->insertObject();
		$this->module->vsRelation->setObjectId($this->module->obj->getId());
		$this->module->vsRelation->setRelId($bw->input[3]);
		$this->module->vsRelation->setTableName("gallery_{$bw->input[2]}");
		$this->module->vsRelation->insertRel();
	}
	function displayGalleryTab(){
		global $bw,$vsLang;
		if(!$bw->input[2]){
			$this->alertMessage($vsLang->getWords("global_none_module",'Bạn phải truyền tên module cần tạo Album'));
			return false;
		}
		if(!$bw->input[3]){
			$this->alertMessage($vsLang->getWords("global_none_id",'Bạn phải truyền Id của đối tượng cần tạo Album'));
			return false;
		}

		$this->createAlbum($bw->input);
		if(!$this->module->obj->getId()){
			$this->alertMessage($vsLang->getWords("global_error_system",'Có lỗi trong quá trình tạo Album'));
			return false;
		}

		return 	$this->displayFile($this->module->obj->getId());
	}

	function displayFileForm($formtype="add",$album){
		global $bw,$vsLang;
		if(is_numeric($album))
		$album= $this->module->getObjectById($album);
		if(!$album){
			$this->alertMessage($vsLang->getWords("global_none_album",'Bạn phải tạo Album trước khi sử dụng'));
			return false;
		}
		$form['type'] = $formtype;
		$form['albumId'] = $album->getId();
		$form ['formSubmit'] = $this->module->vsLang->getWords ( "file_type_{$formtype}_bt", ucwords ( $formtype ) );
		$form ['title'] = $this->module->vsLang->getWords ( "file_type_{$formtype}_title", ucwords ( $formtype ) . " File" );
		if ($form ['type']=="edit") {
			$this->module->vsFile->getObjectById($bw->input[3]);
			$form['switchform'] = '<input type="button" class="ui-state-default ui-corner-all" value="Chuyển qua form thêm mới" name="switch" id="switch-add-file-bt" />';
		}
		return $this->output = $this->html->addEditFileForm($form,$this->module->vsFile->obj,$album);
	}

	function displayGalleryFileList($albumId=0){
		$this->module->getFileByAlbumId($albumId);
		return $this->output = $this->html->displayGalleryFileList($this->module->getArrayObj(),$albumId);
	}

	function addEditGalleryFile(){
		global $bw,$vsStd;
		if($bw->input['oldFileId']){
			$vsStd->requireFile ( UTILS_PATH . "TextCode.class.php" );
			$objName = VSFTextCode::removeAccent ( trim ( $bw->input['fileTitle'] ), "_" );
			$this->module->vsFile->getObjectById($bw->input['oldFileId']);
			$pathOld = $this->module->vsFile->obj->getPathView();
			if($bw->input['fileId']) $this->module->vsFile->deleteFile($bw->input['oldFileId']);
			else{
				$this->module->vsFile->obj->convertToObject($bw->input);
				$this->module->vsFile->obj->setTitle($objName);
				$this->module->vsFile->updateObjectById($this->module->vsFile->obj);
			}
		}
		if($bw->input['fileId']){
			$this->module->vsRelation->setObjectId($bw->input['fileId']);
			$this->module->vsRelation->setRelId($bw->input['albumId']);
			$this->module->vsRelation->setTableName($this->module->getRelTableName());
			$this->module->vsRelation->insertRel();
		}
		$this->displayGalleryFileList($bw->input['albumId']);
	}

	function displayDeleteFile(){
		global $bw;
		$this->module->vsFile->deleteFile($bw->input[2]);
		$this->module->vsRelation->setObjectId($bw->input[2]);
		$this->module->vsRelation->setTableName($this->module->getRelTableName());
		$this->module->vsRelation->delRelByObject();
		$this->displayGalleryFileList($bw->input[3]);
	}
}

?>