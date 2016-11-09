<?php
	global $vsStd;
	require_once(CORE_PATH."textbooks/textbooks.php");
	require_once(CORE_PATH."textbooks/tus.php");

	class textbooks_public {
		
	

		function auto_run() {
			global $bw;

			switch ($bw->input[1]){
				case 'more':
						$this->loadMore($bw->input[2]);
					break;

				case 'search':
						$this->search();
					break;

				case 'preview':
						$this->preview();
					break;
					
				case 'subject':
						$this->subject($bw->input[2]);
					break;
					
				case 'isbn':
						$this->isbnBooks();
					break;

				case 'sell':
						$this->objForm($bw->input[2]);
					break;
					
				case 'listing':
						$this->listing($bw->input[2]);
					break;
					
				case 'detail':
						$this->detail($bw->input[2]);
					break;
					
				case 'rate':
						$this->rate($bw->input[2], $bw->input[3]);
					break;
					
				case 'filter':
						$this->instantFilter();
					break;
					
				case 'suggest':
						$this->suggest();
					break;
					
				default:
						$this->main();
					break;
			}
		}
		
		function suggest(){
			global $bw;
			
			$q = $bw->input[q];
			
			$keywordArray = array();
			$keyword = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($q)), ' '));
			$keyword = trim(preg_replace("/[^a-zA-Z0-9\s]/", "", $keyword));
			if($keyword) $keywordArray = explode(" ", $keyword);
			
			$match = ""; $index = 0; $length = count($keywordArray);
			foreach($keywordArray as $value){
				$index++;
				if($index == $length) $match .= ' < (>'.$value.' < '.$value.'*)';
				else $match .= ' < (>(>'.$value.' < '.$value.'*)';
			}
			$match = '>(>'.trim($match, '< (>');
		
			for($i = 1; $i < $index-1; $i++) $match .= ")";
			$query = "CALL textbooksuggest('".$match."', 5)";
			
			$textbooks = $this->module->executeQueryAdvance($query, 0, 'bookId', 1);
		
			$result = array();
			foreach($textbooks as $key=>$value){
				array_push($result, array(
					"title" 	=> $value['bookTitle'],
					"image"		=> $this->module->obj->createImageCache($value['bookImage'], 50, 80, 0, 1),
					"author" 	=> $value['bookAuthor'],
					"isbn10" 	=> $value['bookISBN10'],
					"isbn" 		=> $value['bookISBN'],
					"url" 		=> $bw->vars['board_url'].'/'.$value['bookURL']
				));
			}
			
			echo json_encode($result);
			exit;
		}
		
		function rate($bookId = 0, $star = 0){
			global $vsPrint, $vsStd, $vsLang, $vsTemplate;
			
			$query = explode('-',$bookId);
			$bookId = abs(intval($query[count($query)-1]));
			
			if(!$bookId) return $vsPrint->redirect_screen($vsLang->getWords('global_exist_error','This item does not exist'));

			$obj = $this->module->getObjectById($bookId);
			if(!$obj) return $vsPrint->redirect_screen($vsLang->getWords('global_exist_error','This item does not exist'));
			
			$rate = ($bw->input['bookRate']) ? $bw->input['bookRate']:1;
			
			
			$bookRate = $this->module->obj->getRate() + 1;
			$this->module->obj->setRate($bookRate);
			
			$bookRateValue = $this->module->obj->getRateValue() + $star;
			$newstar = ($bookRateValue)/$bookRate;

			$this->module->obj->setStar($newstar);
			
			
			$this->module->obj->setRateValue($bookRateValue);
			
			$newstar = intval($newstar);
			$this->module->updateObjectById();
		
			$this->output = <<<EOF
				<script type='text/javascript'>
					
					$('#currate').val('{$newstar}');
					setRating('{$newstar}');
					$('#confirmrating').html('<span id="rateresult">You have rated this textbook {$star} star.</span>');
					
					setTimeout(function(){
			        	$('#confirmrating').toggle("slow", function(){
							$('#rateresult').remove();
							$('#confirmrating').attr('style','');
						});
			        }, 2000);
				</script>
EOF;
		}
		
		function listing($bookId = 0){
			global $vsPrint, $vsStd, $vsLang, $vsTemplate;
			
			$vsPrint->addJavaScriptFile('icampus/rating/irating', 1);

			$query = explode('-', $bookId);
			$bookId = abs(intval($query[count($query)-1]));
			
			if(!$bookId) return $vsPrint->redirect_screen($vsLang->getWords('global_exist_error','This item does not exist'));

			$obj = $this->module->getObjectById($bookId);
			if(!$obj) return $vsPrint->redirect_screen($vsLang->getWords('global_exist_error','This item does not exist'));
			
			
			$option['leftHTML'] = $this->html->leftSubject($this->module->getSubjectList());
			$option['campusList'] = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
			
			$option['seller'] = $this->getSellerByBookId($bookId);

			foreach($option['seller'] as $key=>$seller){
				$bp = reset($seller['list']['pageList']);
				if($bp) $option['bestprice'][$key] = $bp->getPrice();
			}

			$option['tbcond'] = $this->module->getTextbookCondition();

			$this->output = $this->html->listing($obj, $option);
		}
		
		
		function getSellerByBookId($bookId = 0){
			global $vsLang, $bw;
			$option = array();
			
			$type = 0;
			$textbookType = $this->module->getTextbookType();
			
			foreach($textbookType as $tbtype){
				if(strtolower($tbtype->getIsLink()) == 'local'){
					$type = $tbtype->getId();
					break;
				}
			}
		
			require_once(CORE_PATH."textbooks/tus.php");
			$tus = new tus();
			
			$tus->setFieldsString("DISTINCT vsf_textbook_user.*, userAlias");
			$tus->setTableName('textbook_user, vsf_listing_textbook, vsf_user');
			$cond = "userId = tuUser AND ltTu = tuId AND tuBook = ".$bookId." AND ltStatus <> 3 AND ltDel = 0 AND tuStatus > 0 AND ltId";
			if($type) $cond .= " AND tuType = ".$type;
			$tus->setCondition($cond);
			
			$tus->setOrder('tuPrice');
			
			$option[$type]['title'] = $vsLang->getWords('sell_local','Sell Local');
			$option[$type]['from'] = $vsLang->getWords('buy_local_from','Buy Local');
			
			$url = 'textbooks/listing/'.$bw->input[2].'/';
			$index = 3; $size = 10;
			$option[$type]['list'] = $tus->getAdvancePageList($url, $index, $size,"", 0, 'getId', 0, 2, array('useralias'=>'userAlias'));

			return $option;
		}
		
		function isbnBooks(){
			global $bw, $vsPrint, $vsStd, $vsSettings, $vsLang;
			
			if($bw->input[2]) $bw->input['bookISBN'] = $bw->input[2];
				

			$isbnArr = explode(",", $bw->input['bookISBN']);
			$index = 0;
			foreach($isbnArr as $value){
				if($value){
					$ivalue = preg_replace('/[^\dxX]/', '', $value);
					$isbn .= $ivalue.',';
					$isbnStr .= "'".$ivalue."',";
					
					$index ++;
				}
			}
			
			if(!$index) $vsPrint->boink_it($bw->vars['board_url'].'/textbooks/sell');
			
			$vsPrint->addCSSFile("jquery.tabs");
			
			$isbn = trim($isbn, ',');
			$isbnStr = trim($isbnStr, ',');
			
			$option['url'] = 'textbooks/isbn/'.$isbnStr;
			$option['pIndex'] = 3;
			$option['size'] = $vsSettings->getSystemKey('isbn_quality', 10, 'textbooks', 1);
			
			$result = $this->module->getBooksByISBN($isbn, $option);
		
			$result['amazone'] = 0;
			
			if(!$result['total']){
				$result = array();
				
				$data = $this->runAmazon($isbn);

				if(!$data['Items']['Request']['Errors']['Error']){
					$multi = false;
					foreach($data['Items']['Item'] as $key=>$val){
						if(is_numeric($key)) $multi = true;
						break;
					}
					
					$stt = 0;
					
					$cache = array();
					$result['total'] = 1;
					if($multi){
						foreach($data['Items']['Item'] as $item){
							$obj = $this->convertCrawlDataToObj($item, $cache);
							if($obj){
								$obj->stt = $stt++;
								$obj->amazon = 1;
								$obj->key = $isbn;
								$result['pageList'][] = $obj;
								$result['amazone'] = 1;
							}
							$result['total']++;
							if($stt > 4) break;
						}
					}else{
						$obj = $this->convertCrawlDataToObj($data['Items']['Item'], $cache);
						if($obj){
							$obj->stt = 0;
							$obj->amazon = 1;
							$obj->key = $isbn;
							$result['pageList'][] = $obj;
							$result['amazone'] = 1;
						}
					}
					$cachetime = time();
					$this->buildCache($cachetime, $cache);
				}
			}

			if(!$result['total']) return $vsPrint->boink_it($bw->vars['board_url'].'/textbooks/sell');

			$result['campusList'] = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
			$result['subjectList'] = $this->module->getSubjectList();
			$result['leftHTML'] = $this->html->leftSubject($this->module->getSubjectList());
			$result['cachetime'] = $cachetime;
			$this->output = $this->html->isbnBooks($result);
		}
		
		function runAmazon($keyword){
			global $vsStd, $vsSettings;
			
			$vsStd->requireFile(UTILS_PATH.'amazon.php');
			$region = $vsSettings->getSystemKey('amazon_region', 'com', 'textbooks', 1, 1);
    		$accessKey =  $vsSettings->getSystemKey('amazon_public_key', 'AKIAJZWQWIJEFMMADGOQ', 'textbooks', 1, 1);
 			$secretKey = $vsSettings->getSystemKey('amazon_private_key', 'eIIzA2B5ihBcD0lDzamI4B4kR6wftqeqbjqwrLZr', 'textbooks', 1, 1);
			
 			$params=array(
				"region"		=> $region,
				"Operation"		=> 'ItemLookup', // we will be searching
 				"IdType"		=> 'ISBN',
				"SearchIndex"	=> 'Books', // search in the books category
				'ResponseGroup'	=> 'ItemAttributes, Images', // we want images
				'Version'		=> '2009-01-01',
				"ItemId"		=> $keyword
			);
 			
			$amazon = new amazon($accessKey, $secretKey, $params, $region);
			return $amazon->crawlData();
		}
		
		function convertCrawlDataToObj($data, &$array = array()){
			global $bw, $vsFile;
			
			$fileId = @$vsFile->copyFile($data['LargeImage']['URL']['VALUE'], "textbooks");
			$obj = new Textbook();
			if($data['ItemAttributes']['Feature'])
				$textbook['bookISBN'] = trim($data['ItemAttributes']['Feature'][0]['VALUE'], "ISBN13: ");
			else $textbook['bookISBN'] = $data['ItemAttributes']['EAN']['VALUE'];
			
			$textbook['bookISBN10'] = $data['ItemAttributes']['ISBN']['VALUE'];
			$textbook['bookTitle'] = $data['ItemAttributes']['Title']['VALUE'];
			$textbook['bookImage'] = $fileId;

			if($data['ItemAttributes']['Author']['VALUE'])
				$textbook['bookAuthor'] = $data['ItemAttributes']['Author']['VALUE'];
			else{
				if($data['ItemAttributes']['Author'])
					foreach($data['ItemAttributes']['Author'] as $author)
						$textbook['bookAuthor'] .= $author['VALUE'].", ";
				$textbook['bookAuthor'] = trim($textbook['bookAuthor'], ", ");
			}
			$textbook['bookPublisher'] = $data['ItemAttributes']['Manufacturer']['VALUE'];
			
			$edition = $data['ItemAttributes']['Edition']['VALUE'];
			$textbook['bookEdition'] = $edition ? $edition : 1;
			$textbook['bookRelease'] = $data['ItemAttributes']['PublicationDate']['VALUE'];
			$textbook['bookFormat'] = $data['ItemAttributes']['Binding']['VALUE'];
			$textbook['bookPage'] = $data['ItemAttributes']['NumberOfPages']['VALUE'];
			$textbook['bookLanguage'] = $data['ItemAttributes']['Languages']['Language'][0]['Name']['VALUE'];
			
			
			$dimension = (($data['ItemAttributes']['PackageDimensions']['Height']['VALUE'])/100) ." X ";
			$dimension.= (($data['ItemAttributes']['PackageDimensions']['Width']['VALUE'])/100) ." X ";
			$dimension.= (($data['ItemAttributes']['PackageDimensions']['Length']['VALUE'])/100);
			$textbook['bookDimension'] = $dimension;
			
			$dunit = $data['ItemAttributes']['PackageDimensions']['Height']['ATTRIBUTES']['Units'] ." X ";
			$dunit.= $data['ItemAttributes']['PackageDimensions']['Length']['ATTRIBUTES']['Units'] ." X ";
			$dunit.= $data['ItemAttributes']['PackageDimensions']['Width']['ATTRIBUTES']['Units'];
			$textbook['bookDimensionUnit'] = $dunit;
			
			$textbook['bookWeight'] = (($data['ItemAttributes']['PackageDimensions']['Weight']['VALUE'])/100);
			$textbook['bookWeightUnit'] = $data['ItemAttributes']['PackageDimensions']['Weight']['ATTRIBUTES']['Units'];
			
			$array[] = $textbook;
			$result = array_merge($bw->input, $textbook);
			$obj->convertToObject($result);
			
			return $obj;
		}
		
		function buildCache($cachetime, $data = array()) {
			if(!is_dir(CACHE_PATH."tmp/verify/"))
				mkdir(CACHE_PATH."tmp/verify/", 0777, true );
			
			$data['cachetime'] = $cachetime;
			$cache_content  = "<?php\n";
			$cache_content .= "\$cache = ".var_export($data, true).";\n";
			$cache_content .= "?>";
			$cache_path = CACHE_PATH."tmp/verify/".$cachetime.'.txt';
			$cache_content = preg_replace('/\s\s+/', '', $cache_content);
			$file = fopen($cache_path, "w");
			fwrite($file, $cache_content);
			fclose($file);
		}
		
		function objForm($tuId=0){
			global $bw;
			if($bw->input['submitForm']) return $this->editObj();
			
			global $vsStd, $vsLang, $vsPrint, $vsTemplate, $vsSettings;

			$vsPrint->addJavaScriptFile('icampus/jquery.validate.pack', 1);
			$vsPrint->addJavaScriptFile('icampus/jquery.tabs.pack');
			$vsPrint->addCSSFile("textbooks.tabs");

			$option = array();
			if($bw->input['verify']){
				if (file_exists(CACHE_PATH."tmp/verify/".$bw->input['verify'].'.txt')) {
					require_once(CACHE_PATH."tmp/verify/".$bw->input['verify'].'.txt');
					
					$cachetime = $bw->input['verify'];
					$bw->input = $cache;
					
					@unlink(CACHE_PATH."tmp/verify/".$cachetime.'.txt');
				}
				$valid = $bw->input['direct'];
			
				if(!$bw->input['bookImage']) $bw->input['bookImage'] = $bw->input['oldImage'];
				
				$this->module->obj->setISBN(trim(preg_replace('/[^\dxX]/', '', $bw->input['bookISBN'])));
				$this->module->obj->setISBN10(trim(preg_replace('/[^\dxX]/', '', $bw->input['bookISBN10'])));
		
				$this->module->obj->convertToObject($bw->input);
				
				$this->tus->obj->convertToObject($bw->input);
			}
			else{
				$valid = 0;
				if($tuId){
					$this->tus->obj = $this->tus->getObjectById($tuId);
					$this->module->obj = $this->module->getObjectById($this->tus->obj->getBook());
					
					$option['verify'] = $this->tus->obj->getVerify();
				}
				elseif(isset($bw->input['tb'])){
					if($bw->input['isbn']){
						if (file_exists(CACHE_PATH."tmp/verify/".$bw->input['time'].'.txt')) {
							require_once(CACHE_PATH."tmp/verify/".$bw->input['time'].'.txt');
							
							$cachetime = $bw->input['time'];
							@unlink(CACHE_PATH."tmp/verify/".$bw->input['time'].'.txt');
							$this->module->obj->convertToObject($cache[$bw->input['tb']]);
						}
						else{
							$bw->input['isbn'] = trim(preg_replace('/[^\dxX]/', '', $bw->input['isbn']));
					
							if(!$bw->input['isbn'])
								$vsPrint->boink_it($bw->vars['board_url'].'/textbooks/sell');
								
							$data = $this->runAmazon($bw->input['isbn']);
							
							$result = $data['Items'];
							
							if(!$result['Request']['Errors']['Error']){
								$stt = 0;
								$multi = false;
								foreach($data['Items']['Item'] as $key=>$val){
									if(is_numeric($key)) $multi = true;
									break;
								}
								if($multi){
									foreach($data['Items']['Item'] as $item){
										if($stt++ == $bw->input['tb']){
											$this->module->obj = $this->convertCrawlDataToObj($item);
											break;
										}
									}
								}else $this->module->obj = $this->convertCrawlDataToObj($result['Item']);
							}
							else $vsPrint->boink_it($bw->vars['board_url'].'/textbooks/sell');
						}
					}else $this->module->getObjectById($bw->input['tb']);
				}else{
					$valid = 1;
					$temp = trim(preg_replace('/[^\dxX]/', '', $bw->input['bookISBN']));
					$isbnlength = strlen($temp);
					if($isbnlength == 10)
						$this->module->obj->setISBN10($bw->input['isbn']);
					if($isbnlength == 13)
						$this->module->obj->setISBN($bw->input['isbn']);
				}
			}
			$option['cpage'] = $bw->input['cpage']; 
			$option['button'] = $vsLang->getWords('editForm_button','Submit');
			$option['campusList'] = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
			
			$option['subjectList'] = $this->module->getSubjectList();
			$option['leftHTML'] = $this->html->leftSubject($this->module->getSubjectList());
			
			$option['valid'] = $valid;
			$option['textbookCondition'] = $this->module->getTextbookCondition();
			$option['textbookType'] = $this->module->getTextbookType();
			
			return $this->output = $this->html->objForm($this->module->obj, $this->tus->obj, $option);
		}
		
		function editObj(){
			global $bw, $vsUser, $vsPrint;
			
			unset($bw->input['submitForm']);

			$bw->input['tuType']= 465; // default buy local
			if($_FILES['bookImage']['name']){
				$file = new files();
			
			   	$file->uploadFile("bookImage", "textbooks", 1);
			   	$bw->input['bookImage'] = $file->obj->getId();
			   	$file->deleteFile($bw->input['oldImage']);
			}
			else $bw->input['bookImage'] = $bw->input['oldImage'];
			
			if(!$vsUser->obj->getId()){
				$cachetime = time();
				$this->buildCache($cachetime, $bw->input);
				
				$param = str_replace($bw->base_url.'textbooks/sell','', $_SERVER['HTTP_REFERER']);
				$param = trim($param, "/");
				$param = trim($param, "&");
				
				$temp = explode("?",$param);
				$param = $temp[0];
				$vsPrint->boink_it("{$bw->vars['board_url']}/users/login&".$param."?verify=".$cachetime);
			}

			$bw->input['tuUser'] = $vsUser->obj->getId();
			$bw->input['tuUserAlias'] = $vsUser->obj->getAlias();

//tuVerify: user need to verify
			$bw->input['tuVerify'] = $bw->input['direct'];
			$bw->input['tuStatus'] = !$bw->input['tuVerify'];
			
			$this->tus->obj->convertToObject($bw->input);
			
			if($bw->input['tuId']){
				global $vsLang;
				$status = $this->tus->updateObject();
				return $status;
			}
			else{
				if($bw->input['bookId']) $this->tus->obj->setBook($bw->input['bookId']);
				else{
					$this->module->obj->convertToObject($bw->input);
					$this->module->obj->setISBN(trim(preg_replace('/[^\dxX]/', '', $bw->input['bookISBN'])));
					$this->module->obj->setISBN10(trim(preg_replace('/[^\dxX]/', '', $bw->input['bookISBN10'])));
					$this->module->obj->setStatus(!$bw->input['tuVerify']);
					$this->module->insertObject();

					
//add to search module
					$sData = array();
					$key = $this->module->obj->getId();
					$title = strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($bw->input['bookTitle'])),'-'));
					$url = 'textbooks/listing/'.$title.'-'.$key;
					$value['bookTitle'] = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($value['bookTitle'])),' '));
					
					$value['bookAuthor'] = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($bw->input['bookAuthor'])),' '));
					$value['bookPublisher'] = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($bw->input['bookPublisher'])),' '));
					
					$sData[$key]['searchModule'] = 'textbooks';
					$sData[$key]['searchObj'] = $key;
					$sData[$key]['searchTitle'] =  $bw->input['bookTitle'];
					
					
					$sData[$key]['searchUrl'] =  $url;
					$content = $bw->input['bookISBN'] . ' ' . $bw->input['bookISBN10'] . ' ' . $value['bookTitle'] . ' ' . $value['bookAuthor'] . ' ' . $value['bookPublisher'];
					$sData[$key]['searchContent'] = $content;

					$sData[$key]['searchOTitle'] = trim($bw->input['bookTitle']);
					$oIntro = trim($bw->input['bookISBN'].' '.$bw->input['bookISBN10'].' '.$bw->input['bookAuthor']." ".$bw->input["bookPublisher"]);
					$sData[$key]['searchOIntro'] = VSFTextCode::cutString($oIntro, 1024);
					
					global $vsStd;
					$vsStd->requireFile(CORE_PATH.'search/searchs.php');
					
					$model = new searchs();
					$model->multiInsert($sData);
					
					$this->tus->obj->setBook($this->module->obj->getId());
				}
				$this->tus->obj->setPostDate(time());
				$tuStatus = $this->tus->insertObject();
				
				if($tuStatus){
					global $vsStd;
					$vsStd->requireFile(CORE_PATH.'listings/lts.php');
					
					$lt = new lts(); 
					$input['ltTu'] = $this->tus->obj->getId();
					$input['ltStatus'] = 1;
					$lt->addListingTextbook($input);
					

					
// send email					
					$textbook['title'] = $bw->input['bookTitle'];
					$textbook['url'] = $this->tus->obj->getURL($bw->input['bookTitle']);
					
					$this->notifySellerbyMessage($textbook);
				}
			}

			$vsPrint->boink_it($bw->vars['board_url']."/textbooks");
		}
		
		function notifySellerbyMessage($textbook){
			global $vsStd, $bw, $vsSettings, $vsUser, $vsLang;
			
			$content = <<<EOF
				<a href="{$bw->vars['board_url']}" title='iCampux'>
				<img src="{$bw->vars['img_url']}/logo.jpg" alt='{$bw->vars['board_url']}'/>
				</a><br />
				
				Hi {$vsUser->obj->getFullname()}!<br /><br />
				
				Your textboook <b>{$textbook['title']}</b> is listed here 
				<a href='{$textbook['url']}' title="{$textbook['title']}" target='_blank'>
					{$textbook['url']}
				</a>. Please check whether the provided information is correct! <br /><br />
				
				You can also modify it here 
				<a href='{$bw->vars['board_url']}/listings/mylisting' title="You can also modify your textbook" target='_blank'>
					{$bw->vars['board_url']}/listings/mylisting
				</a>
				<br /><br /><br />
				--iCampux Team--<br />
				<a href='{$bw->vars['board_url']}' title="iCampux Team">
					{$bw->vars['board_url']}
				</a>
EOF;
			$data['messageUser'] = 0;
			$data['messageRecipient'] = $vsUser->obj->getAlias();
			$data['messageTitle'] = $vsLang->getWords('textbook_posting_message_title','Posted textbook');
			$data['messageContent'] = $content;
		
			$vsStd->requireFile(CORE_PATH.'messages/messages.php');
			$message = new messages();
		
			$message->sendMessage($data);
			
			
			$vsStd->requireFile(LIBS_PATH."Email.class.php");
			$email = new Emailer();
	

			$email->setTo($vsUser->obj->getName());
			$email->setFrom($vsSettings->getSystemKey('global_system_message_alias', 'noreply@icampux.com', 'global', 1, 1), 'iCampux Team');
			$email->setSubject('You have posted a textbook');
			$email->setBody($content);
			$email->sendMail();
		}
		
		function main(){
			global $vsPrint, $vsTemplate;
			
			$option['leftHTML'] = $this->html->leftSubject($this->module->getSubjectList());
			$option['newBooks'] = $this->getNewBook(6);
		

			$option['campusList'] = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
			
			$vsPrint->addJavaScriptFile('icampus/jquery.autocomplete');
			$vsPrint->addCSSFile("autocomplete/jquery.autocomplete");
			$this->output = $this->html->loadMain($option);
		}

		
		function getNewBook($limit = 3){
			global $vsUser, $vsStd;
			
			$vsStd->requireFile(CORE_PATH."textbooks/tus.php");
			$tus = new tus();
			
			if($vsUser->obj->getCampusId())
				$cond = " AND tuCampus = '".$vsUser->obj->getCampusId()."'";
				
			$tus->setArrayObj(array());
			$where = " b.bookId = u.tubook AND u.tuStatus > 0 AND b.bookStatus > 0 ";
			$this->module->setFieldsString("tuid, tuprice, bookid, b.*");
			$this->module->setTableName("textbook_user as u, vsf_textbook as b");
			$this->module->setCondition($where." AND tuId IN (
											SELECT lttu
											FROM vsf_listing_textbook AS lt
											WHERE ltStatus <> 3 AND ltDel = 0 AND u.tuId = lt.ltTu)"
									);
			$this->module->setGroupby('bookid');
			$this->module->setOrder("u.tuid DESC");
			$this->module->setLimit(array(0, $limit));
			$books = $this->module->getObjectsByCondition();
			$bookId = implode(',', array_keys($books));
			
			if($bookId){
				$priceArr = $this->getMinPriceOfTextbook($bookId);
				$stt = 1;
				foreach($books as $key => $book){
					if($stt++ == 3) $books[$key]->begingroup = 1;
					if($priceArr[$key])
						$books[$key]->price = number_format($priceArr[$key]['price'], 2, ".", ", ");
				}
			}
			
			if(!$books){
				$this->module->setFieldsString("*");
				$this->module->setTableName("textbook");
				$this->module->setCondition("bookStatus > 0");
				$this->module->setLimit(array(0, $limit));
				$books = $this->module->getObjectsByCondition();
			} 
			
		
			return $books;
		}
		
		function getMinPriceOfTextbook($bookId = ''){
			if(!$bookId) return array();
			$tus = new tus();
			$tus->setArrayObj(array());
			$tus->setFieldsString('tuBook, MIN(tuprice) as price');
			
			
			$tus->setTableName('textbook_user, vsf_listing_textbook as lt0');
			$cond = "lt0.ltTu = tuId AND tuBook IN (".$bookId.") AND lt0.ltStatus <> 3  AND lt0.ltDel = 0 AND tuStatus > 0 AND lt0.ltId NOT IN (SELECT ltId FROM vsf_listing_textbook as lt1 WHERE lt0.ltId = lt1.ltId AND lt1.ltDel = 1 AND lt1.ltStatus = 1)";
		
			
			$tus->setCondition($cond);
			$tus->setGroupby('tuBook');
			return  $tus->getArrayByCondition('tuBook');
		}
		

		
		function loadMore($flag = ''){
			global $bw, $vsSettings, $vsLang;

			$flag = 'new-listing'; $type = 1;
				$this->module->setOrder('tuId DESC');
				$title = $vsLang->getWords('global_new_listing','New Listings');
			
			$option = array();
			$mainmore = $this->mainmore($type, &$option);
			
			if($bw->input['t'] == 'load') return $mainmore;
			
			
			$option['leftHTML'] = $this->html->leftSubject($this->module->getSubjectList());
			
			global $vsPrint;
			$vsPrint->addJavaScriptFile('icampus/jquery.scrollExtend', 1);

			$option['moretitle'] = $title;
			$option['url'] = $bw->vars['board_url'].'/textbooks/more/'.$type;
			
			$option['mainmore'] = $mainmore;
			$this->output = $this->html->loadMore($option);
		}
		
		function mainmore($type = 1, &$input = array()){
			global $bw;
			$where = " b.bookId = u.tubook AND u.tuStatus > 0 AND b.bookStatus > 0 ";
			$this->module->setFieldsString("b.*");
			$this->module->setTableName("textbook_user as u, vsf_textbook as b");
			$this->module->setCondition($where." AND tuId IN (
											SELECT lttu
											FROM vsf_listing_textbook AS lt
											WHERE ltStatus <> 3 AND ltDel = 0 AND u.tuId = lt.ltTu)");
			
			$this->module->setGroupby('bookid');
			$this->module->setOrder("u.tuid DESC");
			
			$total = $this->module->getNumberOfObject();
			$size = 5;
			
			$cpage = $bw->input['p'] + 1;
			$tpage = floor(($total-1)/$size)+1;
			
			$start = $size*($cpage - 1);
			$limit = array($start, $size);
			$this->module->setLimit($limit);
			$input['fbscript'] = 0;
			if($total > $size) $input['fbscript'] = 1;
			
			if($cpage > $tpage){
				if($total <= $size) return "";
				return $this->output = <<<EOF
					<script type='text/javascript'>
						$('#more-contain').scrollExtend('disable');
					</script>
EOF;
			}
			
			$option['pageList'] = $this->module->getObjectsByCondition();

			$bookId = implode(',', array_keys($option['pageList']));
		
			if($bookId){
				$priceArr = $this->getMinPriceOfTextbook($bookId);
				
				foreach($option['pageList'] as $key => $book){
					$temp['pageList'][$key]->price = "Nobody is selling this book";
					if($priceArr[$key]){
						$price = number_format($priceArr[$key]['price'], 2, ".", ", ");
						$option['pageList'][$key]->price = $price;
					}
				}
			}
		
			return $this->output = $this->html->mainmore($option);
		}
	
		function importMessageFile(){
//import js and css for make an offer.			
			global $vsPrint, $vsStd;
			$vsPrint->addJavaScriptFile ( 'jquery/ui.core' );
			$vsPrint->addJavaScriptFile ( "jquery/ui.widget");
			
			$vsPrint->addJavaScriptFile ( 'jquery/ui.position');
			$vsPrint->addJavaScriptFile ( 'jquery/ui.dialog' );
		
			$vsPrint->addGlobalCSSFile ( 'jquery/base/ui.dialog' );
			
			
			$vsPrint->addJavaScriptFile('icampus/jquery.validate.pack', 1);
			
			$vsPrint->addJavaScriptFile('icampus/jquery.tabs.pack');
			$vsPrint->addCSSFile("textbooks.tabs");
			$vsPrint->addCSSFile("messagesform");
			
			$vsPrint->addJavaScriptFile("tiny_mce/tiny_mce", 1);
			$vsStd->requireFile(JAVASCRIPT_PATH . "tiny_mce/tinyMCE.php");
			
			$vsPrint->addCSSFile("fileuploader");
			$vsPrint->addJavaScriptFile("icampus/fileuploader", 1);
		}
		
		
		function detail($tuId){
			global $vsPrint, $vsStd, $vsLang, $vsTemplate;
			
			$query = explode('-',$tuId);
			$tuId = abs(intval($query[count($query)-1]));
		
			if(!$tuId) return $vsPrint->redirect_screen($vsLang->getWords('global_exist_error','This item does not exist.'));
			
			require_once(CORE_PATH."textbooks/tus.php");
			$tus = new tus();
				
			$tus->setFieldsString('vsf_textbook_user.*, vsf_textbook.*, vsf_listing_textbook.*, vsf_user.userId, vsf_user.userName, vsf_user.userAlias');
			$tu = $tus->getTUDetail($tuId);

			
			if(!$tu) return $vsPrint->redirect_screen($vsLang->getWords('global_exist_error','This item does not exist.'));
			if($tu->lt->getPrice()) $tu->setPrice($tu->lt->getPrice());
			
			$option = array();
			$option['subjectList'] = $this->module->getSubjectList();
			
			$option['leftHTML'] = $this->html->leftSubject($option['subjectList']);
			

		
			$where = "bookId = tubook AND tuId = ltTu AND bookStatus > 0 AND tuUser = ".$tu->getUser(). ' AND tuId <> '.$tuId.
					 " AND ltStatus <> 3 AND ltDel = 0";
	
			$this->module->setTableName("textbook_user, vsf_textbook, vsf_listing_textbook");
			$this->module->setCondition($where);
			$this->module->setOrder('ltTime DESC, ltId DESC');
			$this->module->setLimit(array(0,3));
			
			$books = $this->module->getAdvanceObjectsByCondition('', 0, 1, array('tu'=>'TU', 'lt'=>'LT'));
			$option['other'] = $books;
			
			global $addon;
			$addon->importFileForMessagePopup();
			
			
			$temp = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST[$tu->getCampus()];
			
			if($temp) $tu->setCampus($temp->getTitle());
			
			
			$textbookConditions = $this->module->getTextbookCondition();
			$temp = $textbookConditions[$tu->getCondition()];
			if($temp) $tu->setCondition($temp->getTitle());
			
			$vsPrint->addJavaScriptFile('icampus/rating/irating', 1);
			$vsPrint->addJavaScriptFile("jquery/ui.tabs.custom");
			$vsPrint->addCSSFile('custom.ui.tabs');
			$this->output = $this->html->detail($tu, $option);
		}
		
		function subject($subId){
			global $vsPrint, $bw, $vsMenu, $vsStd, $vsTemplate;
			$vsPrint->addJavaScriptFile('icampus/jquery.tabs.pack');
			$vsPrint->addCSSFile("jquery.tabs");
			
			$query = explode('-',$subId);
			$subId = abs(intval($query[count($query)-1]));
			
			$option['best'] = $this->subjectDetail($subId);
			$option['price'] = $this->subjectDetail($subId, 1);
			$option['alpha'] = $this->subjectDetail($subId, 2);
			$option['release'] = $this->subjectDetail($subId, 3);
			
			$option['leftHTML'] = $this->html->leftSubject($this->module->getSubjectList());
			$option['order'] = $bw->input['order'];

			
			$subject= $vsMenu->getCategoryGroup("textbooks");
			$temp = $subject->getChildren();
			$option['subject'] = $temp[$subId]; 
			
			$option['campusList'] = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
	
			$this->output = $this->html->subject($option);
		}
		
		function subjectDetail($subId=0, $type=0){
			global $bw, $vsSettings, $vsLang;
			$size = $vsSettings->getSystemKey('subject_book_quality', 5, "textbooks", 1);
			
			
			$this->module->setArrayObj(array());
			if(!$bw->input[3] || $bw->input['first']) $bw->input[3] = $bw->input['first']	? $bw->input['first']	: "1.vsf";
			if(!$bw->input[4] || $bw->input['second']) $bw->input[4] = $bw->input['second']	? $bw->input['second']	: "1.vsf";
			if(!$bw->input[5] || $bw->input['third']) $bw->input[5] = $bw->input['third']	? $bw->input['third']	: "1.vsf";
			if(!$bw->input[6] || $bw->input['fourth']) $bw->input[6] = $bw->input['fourth']	? $bw->input['fourth']	: "1.vsf";
			
		
			switch($type){
				case 1:
						$url = 'textbooks/subject/'.$subId."/".$bw->input[3]; $param = 4;
						$trim = "&first=".$bw->input[3]."&third=".$bw->input[5]."&fourth=".$bw->input[6];
						$bw->input['advance'] = $trim."&order=price";
						
						$this->module->setOrder('tuPrice, bookId');
					break;
				case 2:
						$url = 'textbooks/subject/'.$subId."/".$bw->input[3]."/".$bw->input[4]; $param = 5;
						
						$trim = "&first=".$bw->input[3]."&second=".$bw->input[4]."&fourth=".$bw->input[6];
						$bw->input['advance'] = $trim."&order=alpha";
						
						$this->module->setOrder('bookTitle, bookId');
					break;
				case 3:
						$url = 'textbooks/subject/'.$subId."/".$bw->input[3]."/".$bw->input[4]."/".$bw->input[5]; $param = 6;
						
						$trim = "&first=".$bw->input[3]."&second=".$bw->input[4]."&third=".$bw->input[5]."&order=release";
						$bw->input['advance'] = $trim;
						
						$this->module->setOrder('bookRelease DESC, bookId');
					break;
					
				default:
						$url = 'textbooks/subject/'.$subId; $param = 3;
					
						$trim = "&second=".$bw->input[4]."&third=".$bw->input[5]."&fourth=".$bw->input[6];
						$bw->input['advance'] = $trim;
						
						$this->module->setOrder('tuPrice, bookId');
				 	break;
			}
	

			$where = "b.bookId = u.tubook AND u.tuStatus > 0 AND b.bookStatus > 0 AND u.tuSubject = ".$subId;
			$this->module->setFieldsString("b.*, tuprice");
			$this->module->setTableName("textbook_user as u, vsf_textbook as b");
			$this->module->setCondition($where.' AND tuId IN (
											SELECT lttu
											FROM vsf_listing_textbook AS lt
											WHERE ltStatus <> 3 AND ltDel = 0 AND u.tuId = lt.ltTu)');
			
			
			$extend = array('price' => 'tuprice');
			$temp = $this->module->getAdvancePageList($url, $param, $size, 0, '', 'getId', 0, 2, $extend);
			
			$bookId = implode(',', array_keys($temp['pageList']));
			if($bookId){
				$priceArr = $this->getMinPriceOfTextbook($bookId);
				
				foreach($temp['pageList'] as $key => $book){
					$price = number_format($priceArr[$key]['price'], 2, ".", ", ");
					$temp['pageList'][$key]->price = $vsLang->getWords('global_curency','$').' '.$price;
				}
			}
			return $temp;
		}
		
		
		
		function search($instantCond = "", $instant = 0){
			global $bw, $vsPrint, $vsStd, $vsPrint, $DB;
			
	        $vsPrint->addJavaScriptFile('icampus/typewatch');
			$vsPrint->addJavaScriptFile('icampus/jquery.validate.pack');

			$keywordArray = array();
			$keyword = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($bw->input['keyword'])), ' '));
			$keyword = trim(preg_replace("/[^a-zA-Z0-9\s]/", "", $keyword));
			if($keyword) $keywordArray = explode(" ", $keyword);
			
			$match = ""; $index = 0; $length = count($keywordArray);
			foreach($keywordArray as $value){
				$index++;
				if($index == $length) $match .= ' < (>'.$value.' < '.$value.'*)';
				else $match .= ' < (>(>'.$value.' < '.$value.'*)';
			}
			$match = '>(>'.trim($match, '< (>');
		
			for($i = 1; $i < $index-1; $i++) $match .= ")";
			
//			$cond = "";
//			if($instantCond){
//				if($cond) $cond .= ' AND ';
//				$cond = $cond.$instantCond;
//			}
			
			$query = "CALL searchtextbooktotal('".$match."')";
			
			$totaltemp = $this->module->executeQueryAdvance($query, 0, '', true);
			$totaltemp = current($totaltemp);
			$total = $totaltemp['total'];
			
			$url = $bw->base_url.'textbooks/search/'; $param = 2; $size = 5;
			$bw->input['advance'] = str_replace($_SERVER['REDIRECT_URL'], "", $_SERVER['REQUEST_URI']);
			
			if($bw->input['instant']) $bw->input['advance'] = '/'.str_replace(" ", "+", $bw->input['keyword']);	
			
			global $vsStd,$bw;
			$vsStd->requireFile(LIBS_PATH."Pagination.class.php");
		
			$lbegin = 0;
			if($size < $total){
				$p = new VSFPagination();
				$p->text['p_Page']		= "";
				$p->ajax				= 0;
				$p->callbackobjectId 	= '';
				$p->url 				= $url;
			
				$p->p_Size 			= $size;
				$p->p_TotalRow 		= $total;
				
				$p->SetCurrentPage($param);
				$p->BuildPageLinks();
				$lbegin = $p->p_StartRow;
			}
		
			
			$query = "CALL searchtextbook('".$match."', ".$lbegin.", ".$size.")";
			$option['tulist'] = $this->module->executeQueryAdvance($query, 0, 'searchObj', true);
		global $DB;
		print "<pre>";
		print_r($DB->obj);
		print "</pre>";
			if($option['tulist']){
				$tbIds = implode(array_keys($option['tulist']), ",");
				global $vsStd;
				$vsStd->requireFile(CORE_PATH.'textbooks/tus.php');
				
				$tus  = new tus();
				$tus->setFieldsString('tuBook, tuprice');
				$tus->setTableName('textbook_user AS tu, vsf_listing_textbook AS lt');
				
				$cond = "lt.ltTU = tu.tuId AND tuVerify = 0 AND tuStatus = 1 AND ltStatus <> 3 AND ltDel = 0 AND
					  		tuPrice <= (
							SELECT MIN(tu1.tuPrice)
							FROM vsf_textbook_user AS tu1, vsf_listing_textbook AS lt1
							WHERE lt1.ltTU = tu1.tuId AND lt1.ltStatus <> 3 AND lt1.ltDel = 0 AND tu.tuBook = tu1.tuBook
							)
						 AND tubook IN ({$tbIds})";
				$tus->setCondition($cond);
				$tuprices = $tus->getArrayByCondition('tuBook');

				global $vsLang;
				foreach($option['tulist'] as $key => $value){
					$price = "Nobody is selling this book";
					if(array_key_exists($key, $tuprices)){
						$price = $vsLang->getWords('global_curency','$').' '. number_format($tuprices[$key]['tuprice'], 2, ".", ", ");
					}
					$value['tuPrice'] = $price;
					
					$value['bookListingURL'] = $bw->base_url . "textbooks/listing/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($value['bookTitle'])),'-')). '-' . $key;
					$value['bookImage'] = $this->module->obj->createImageCache($value['bookImage'], 85,115, 0, 1);
					
					$value['bookPInfo'] = $value['bookPublisher'];
					if($value['bookRelease']) $value['bookPInfo'] .= ", ".$value['bookRelease'];
					
					$option['tulist'][$key] = $value;
				}
			}
			
			$option['paging'] 	= $p->p_Links;
			
	
			$option['keyword'] = $keyword;
			if($option['pageList'])
			$option['tblist'] = implode(",", array_keys($option['pageList']));
			
			if($instant || $bw->input['instant'])
				return $this->output = $this->html->mainsearch($option);

			$this->output = $this->html->search($option);
		}
		
	
		
		function instantFilter(){
			global $bw, $vsMenu;
		
			if($bw->input["filter"]){
				switch($bw->input['instant']){
					case 'subject':
						$subjId = "";
						$temp = $this->module->getSubjectList();
						foreach($temp as $subject){
							$tu = trim(strtolower($_POST['filter']));
							$title = trim(strtolower($subject->getIsLink()));
							if(strlen(strstr($title, $tu)) > 0)
								$subjId .= $subject->getId().',';
						}
						
						$instantCond = '';
						if($subjId)
							$instantCond = 'tuSubject in ('.trim($subjId,",").')';
						break;
					case 'course':
							$instantCond = 'tuCourse like "%'.trim($bw->input["tuCourse"]).'%"';
						break;
					case 'professor':
							$instantCond = 'tuProfessor like "%'.trim($bw->input["tuProfessor"]).'%"';
						break;
				}
			}
			
			if($bw->input['tblist'] && $instantCond){
				$instantCond .= ' AND bookId in ('.$bw->input['tblist'].')';
			}else{
				$bw->input['keyword'] = $bw->input['mainkeyword'];
			}
			
			$this->search($instantCond, 1);
		}
		
		
		
		function preview(){
			global $bw, $vsTemplate;
			
			$bw->input['bookImage'] = $bw->input['oldImage'];
			$this->module->obj->convertToObject($bw->input);
			$this->tus->obj->convertToObject($bw->input);
			
			$campusList = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
			$temp = $campusList[$this->tus->obj->getCampus()];
			if($temp) $this->tus->obj->setCampus($temp->getTitle());
			
			$textbookConditions = $this->module->getTextbookCondition();
			$temp = $textbookConditions[$this->tus->obj->getCondition()];
			if($temp) $this->tus->obj->setCondition($temp->getTitle());
			
			$option= array();
			$this->output = $this->html->preview($this->tus->obj, $this->module->obj, $option);
		}
		
		
		function convertEANToISBN($ean){
			$ean = substr($ean,4,9);
			if(is_numeric($ean)){
				$wv =  0; $y = 0;
				for($x=0; $x<10; $x++){
					$wv = $wv+((10-$y)*substr($ean, $x, 1));
					$y++;
				}
				
				$cd = 11-($wv%11);
		
				if($cd == 11) $cd = "0";
				if($cd == 10) $cd = "X";
				
				return $ean.$cd;
			}
			return "";
		}
		
		function objFormPortlet($tuId=0){
			global $bw, $vsStd, $vsLang, $vsPrint, $vsTemplate, $vsSettings;
			
			if($bw->input['submitForm']) return $this->editObj();
			

			$option = array(); $valid = 1;
			
			$this->tus->obj = $this->tus->getObjectById($tuId);
			$this->module->obj = $this->module->getObjectById($this->tus->obj->getBook());
			
			$option['verify'] = $this->tus->obj->getVerify();
			

			$option['cpage'] = $bw->input['cpage']; 
			$option['button'] = $vsLang->getWords('editForm_button','Submit');
			$option['campusList'] = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
			
			$option['subjectList'] = $this->module->getSubjectList();
			
			$option['textbookCondition'] = $this->module->getTextbookCondition();
			$option['textbookType'] = $this->module->getTextbookType();

			return $this->output = $this->html->objFormPortlet($this->module->obj, $this->tus->obj, $option);
		}
		
		
		function getTextbookType(){
			return $this->module->getTextbookType();
		}
		
		
	
		
		
		function getCampusBook($limit=3){
			global $vsUser;
			
			if(!$vsUser->obj->getCampusId()) return array();
			$this->module->setCondition(" bookStatus = 1 AND bookCampusId = ".$vsUser->obj->getCampusId());
			
			$this->module->setOrder("bookSold DESC, bookId DESC");
			$this->module->setLimit(array(0, $limit));
			return $this->module->getObjectsByCondition();
		}
		
		
		
		
		protected $html;
		protected $tus;
		protected $module;
		protected $output;
		
		function __construct() {
			global $vsTemplate, $vsPrint, $bw;

			$this->module = new textbooks();
			$this->tus = new tus();
	        $this->html = $vsTemplate->load_template('skin_textbooks');
	        
	        $vsPrint->addCSSFile("textbooks");
		}
		
		
		function getOutput() {
			return $this->output;
		}
	
		function setOutput($output) {
			$this->output = $output;
		}
}
?>