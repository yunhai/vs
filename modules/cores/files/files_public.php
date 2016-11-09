<?php
/*
 +-----------------------------------------------------------------------------
 |   VIET SOLUTION JSC  base on IPB Code version 2.0.0
 |	Author: BabyWolf
 |	Homepage: http://khkt.net
 |	If you use this code, please don't delete these comment line!
 |	Start Date: 21/09/2004
 |	Finish Date: 22/09/2004
 |	Modified Start Date: 07/02/2007
 |	Modified Finish Date: 10/02/2007
 +-----------------------------------------------------------------------------
 */

if ( ! defined( 'IN_VSF' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}
class files_public{
	private $output		= "";
	private $html       = "";
	private $module     = NULL;
	

	function auto_run(){
		global $bw;
		switch($bw->input['action'])
		{
			case 'download':
				$this->download($bw->input[2], $bw->input[3]);
				break;
			case 'view':
				$this->viewfile($bw->input);
				break;
			case 'upload':
				$this->upload();
				break;
			case 'uploadfile':
				$this->module->uploadFile($bw->input['uploadName'], $bw->input['fileFolder']);
				break;
			default:
				$this->loadDefault();
				break;
		}
	}
	
	function upload(){
		global $bw;
	
		$time = time();
		$qqname = $bw->input['qqfile'];
		$path = "messages";
		$dot = strrpos($qqname, '.');
		$objName = substr($qqname, 0, $dot-1);
		$objext = substr($qqname, $dot+1);
		
		$ext = array('gif', 'jpeg', 'jpg', 'png','doc','pdf', 'xls','mp3', 'docx', 'xlsx', 'zip', 'rar','swf','avi','mp4','mpg','wmv','flv','wav','wma');
		if(!in_array($objext, $ext)){
			return $this->output = "{error: 'File not allow',fileId: '0'}";
		}
		
		$objName = VSFTextCode::removeAccent(trim($objName), "_");
		$path = "messages/";
		$filepath = UPLOAD_PATH.$path.$objName."_".$time;
		if(!is_dir(UPLOAD_PATH."messages/"))
			mkdir(UPLOAD_PATH."messages/", 0777, true );
		
		$input = fopen("php://input", "r");
   		$target = fopen($filepath.".".$objext, "w");  
		$fileSize = stream_copy_to_stream($input, $target);
		fclose($input);
		
		
		$this->module->obj->convertToObject($bw->input);
		$this->module->obj->setPath(rtrim($path, '/' ) . "/" );
		$this->module->obj->setModule("messages");
		$this->module->obj->setSize($fileSize);
		$this->module->obj->setTitle( '~'.$objName );
		$this->module->obj->setName( '~'.$objName );
		$this->module->obj->setType($objext);
		$this->module->obj->setUploadTime($time);
		
		$this->module->insertObject();
	
		return $this->output = "{error: '',success:true, fileId: '{$this->module->obj->getId()}'}";
	}
	
	function viewfile($array) {
		global $bw;
		$fileId=$array[2];
		$width=$array['width'];
		$height=$array['height'];
		$divid=$array['divid'];
		$file=$this->module->getObjectById($fileId);
		if(is_object($file))
		{
			return $this->output = $file->show($width,$height,$divid);
		}

	}
	
	function download($fileId, $prefix = 1) {
		$this->module->downloadFile($fileId, $prefix);
		$this->output = $this->html->MainFile($this->module->result['message']);
	}
	
	function loadDefault(){
		return "dfsa";
	}
	
	
	function __construct() {
		global $vsTemplate;
		$this->module = new files();
		$this->html = $vsTemplate->load_template('skin_files');
	}
	

	public function getOutput() {
		return $this->output;
	}

	public function setOutput($output="") {
		$this->output = $output;
	}
}
?>