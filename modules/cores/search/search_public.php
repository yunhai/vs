<?php
if ( ! defined( 'IN_VSF' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

global $vsStd;
$vsStd->requireFile(CORE_PATH."search/searchs.php");

class search_public{

	public function auto_run(){
		global $bw, $vsLang;

		switch ($bw->input[1]){
			
			default:
					$this->defaultSearch();
				break;
				
			case 'initdata':
					$this->initData();
				break;
				
			case 'cleandata':
					$this->cleanData();
				break;
		}
	}

	function cleanData(){
		global $bw;
		$query = 'SELECT * FROM vsf_textbook_user WHERE tubook NOT IN (SELECT bookId FROM vsf_textbook)';
		$tbbooks = $this->model->executeQueryAdvance($query, 0, 'tuId');
		if($tbbooks){
			$tbIds = implode(',', array_keys($tbbooks));
		
			$query2 = 'DELETE FROM vsf_textbook_user WHERE tuId IN ('.$tbIds.')';
			$query3 = 'DELETE FROM vsf_listing_textbook WHERE ltTu IN ('.$tbIds.')';
			print "<pre>";
			print_r($query2);
			print "</pre>";
			print "<pre>";
			print_r($query3);
			print "</pre>";
			print "<pre>";
			print_r($tbbooks);
			print "</pre>";
			$this->model->executeQuery($query2);$this->model->executeQuery($query3);
		}		
	}
	
	function initData(){
		global $bw, $vsStd;
		$vsStd->requireFile(CORE_PATH.'textbooks/textbooks.php');
		
		$tb = new textbooks();
		$tb->setFieldsString('bookId, bookISBN, bookISBN10, bookTitle, bookAuthor, bookPublisher');
		$tbs = $tb->getArrayByCondition('bookId');
		
		$sData = array(); $index = 0;
		foreach($tbs as $key => $value){
			$sData[$index]['searchOTitle'] = trim($value['bookTitle']);
			
			$oIntro = trim($value['bookISBN'].' '.$value['bookISBN10'].' '.$value['bookAuthor']." ".$value["bookPublisher"]);
			$sData[$index]['searchOIntro'] = VSFTextCode::cutString($oIntro, 1024);
			
			$title = strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($value['bookTitle'])),'-'));
			$url = 'textbooks/listing/'.$title.'-'.$key;
			
			$value['bookTitle'] = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($value['bookTitle'])),' '));
			$value['bookAuthor'] = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($value['bookAuthor'])),' '));
			$value['bookPublisher'] = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($value['bookPublisher'])),' '));
			
			$sData[$index]['searchModule'] = 'textbooks';
			$sData[$index]['searchObj'] = $key;
			$sData[$index]['searchTitle'] =  $value['bookTitle'];
			
			
			
			$sData[$index]['searchUrl'] =  $url;
			$content = $value['bookISBN'] . ' ' . $value['bookISBN10'] . ' ' . $value['bookTitle'] . ' ' . $value['bookAuthor'] . ' ' . $value['bookPublisher'];
			$sData[$index]['searchContent'] = $content;
			
			$index++;
		}
		
		$sData = array_reverse($sData);
		
		$vsStd->requireFile(CORE_PATH.'icmarket/icmarkets.php');
		
		$ic = new icmarkets();
		$ic->setFieldsString('cfId, cfTitle, cfContent');
		$ics = $ic->getArrayByCondition('cfId');
		
		$temp = array();
		foreach($ics as $key => $value){
			$temp[$index]['searchOTitle'] = $value['cfTitle'];
			$temp[$index]['searchOIntro'] = VSFTextCode::cutString($value['cfContent'], 1024);
			
			$title = strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($value['cfTitle'])),'-'));
			$url = 'icMarket/detail/'.$title.'-'.$key;
			
			$value['cfTitle'] = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($value['cfTitle'])),' '));
			$value['cfContent'] = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($value['cfContent'])),' '));
			
			$temp[$index]['searchModule'] = 'icmarket';
			$temp[$index]['searchObj'] = $key;
			$temp[$index]['searchTitle'] =  $value['cfTitle'];
			
			
			$temp[$index]['searchUrl'] =  $url;
			$content = $value['cfTitle'] . ' ' . $value['cfContent'];
			$temp[$index]['searchContent'] = $content;
			
			$index++;
		}
		$temp = array_reverse($temp);
		
		$insert = array_merge($sData, $temp);
		$this->model->multiInsert($insert);
		global $DB;
		print "<pre>";
		print_r($DB->obj);
		print "</pre>";exit;	
	}
	
	function defaultSearch(){
		global $bw, $vsPrint;
		$keywordArray = array();
		$keyword = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($bw->input['keyword'])), ' '));
		$keyword = trim(preg_replace("/[^a-zA-Z0-9\s]/", "", $keyword));
		if($keyword) $keywordArray = explode(" ", $keyword);
		
		$match = ""; $index = 0; $length = count($keywordArray);
		foreach($keywordArray as $value){
			$index++;
			if($index == $length) $match .= ' < '.$value;
			else $match .= ' <(> '.$value;
		}
		$match = trim($match, ' <(> ');
			
		for($i = 1; $i < $index-1; $i++) $match .= ")";

		$cond = 'MATCH(searchContent) AGAINST ("'.$match.'"  IN BOOLEAN MODE) > 0';
		$this->model->setCondition($cond);
		
		$this->model->setFieldsString('searchId, searchURL, searchOTitle, searchOIntro, MATCH(searchContent) AGAINST ("'.$match.'"  IN BOOLEAN MODE) as score');
		
		$this->model->setOrder('score DESC');
		
		$url = 'search/'; $index = 1; $size = 5;
		$bw->input['advance'] = str_replace($_SERVER['REDIRECT_URL'], "", $_SERVER['REQUEST_URI']);
		
		$option = $this->model->getArrPageList($url, $index, $size, 0, "", 'searchId');
		
		$vsPrint->addCSSFile("globalsearch");
		$vsPrint->addJavaScriptFile('icampus/jquery.highlight');
		

		$option['keyword'] = $keyword;
		return $this->output = $this->html->loadDefault($option);
	}
	
	function __construct() {
		global $vsTemplate;
		 
		$this->model = new searchs();
		$this->html = $vsTemplate->load_template('skin_search');
	}

	public function getOutput() {
		return $this->output;
	}

	public function setOutput($output) {
		$this->output = $output;
	}
	
	
	private  $output;
	private  $html;
	
}
?>