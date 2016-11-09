<?php

if ( ! defined( 'IN_VSF' ) ){
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit();
}

global $vsStd;
$vsStd->requireFile(CORE_PATH."icmarket/icmarkets.php");


class icmarket_public{

    function auto_run(){
		global $bw, $vsPrint;
	
		$this->authorize();
		switch($bw->input[1]){
			case 'post':
					$this->post();
				break;
			case 'listing':
					$this->listing();
				break;
			default:
					$this->listing();
				break;
			case 'preview':
					$this->preview();
				break;
			case 'detail':
					$this->detail($bw->input[2]);
				break;
			case 'category':
					$this->category($bw->input[2]);
				break;				
			case 'search':
					$this->search();
				break;
			case 'sendtofriends':
					$this->sendToFriends();
				break;
			case 'suggest':
					$this->suggest();
				break;
		}
		
		$vsPrint->addCSSFile("icmarket");
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
			
		$query = 'CALL icmarketsuggest("'.$match.'", 5)';
		$icmarkets = $this->model->executeQueryAdvance($query, 0, 'objId', 1);
	

		$cfIds = implode(",", array_keys($icmarkets));
		global $vsStd, $vsMenu;
		$vsStd->requireFile(CORE_PATH.'galleries/galleries.php');
		$g = new galleries();
		$gs = $g->getGallery($cfIds, $vsMenu->getCategoryGroup('icMarket')->getId());
	
		
		$result = array();
		foreach($icmarkets as $key=>$value){
			$ifile = 0;
			$og = $value['objGallery'];
			if($og){
				if($gs[$og]){
					$cgs = current($gs[$og]);
					$ifile = $cgs['gdetail']->getFile();
				}
			}
			array_push($result, array(
				"title" 	=> $value['objTitle'],
				"image"		=> $this->model->obj->createImageCache($ifile, 80, 85, 0, 1),
				"content" 	=> $value['objContent']					
			));
		}
		echo json_encode($result);
		exit;
	}
	
	function sendToFriends(){
		global $bw, $vsUser;
		
		if(!$vsUser->obj->getId())
			return $this->output = <<<EOF
				<div id='message'>
					You have to login first.<br />
					<b><a href="{$bw->vars['board_url']}/users/login" title="login to system">Click here to login</a></b>
				</div>
				<script type='text/javascript'>
					$(document).ready(function(){
						setTimeout(function(){
				        	$('#message').toggle("slow", function(){
								location.href='{$bw->vars['board_url']}/users/login';
							});
				        }, 2000);
			        });
				</script>
EOF;

		if(!$bw->input['cfrecipients'])
			return $this->output = <<<EOF
				<div id='message'>
					You have to enter your friends' email.
				</div>
				<script type='text/javascript'>
					$(document).ready(function(){
						setTimeout(function(){
				        	$('#message').toggle("slow", function(){	
								$('#message').remove();
							});
				        }, 2000);
			        });
				</script>
EOF;
		
		$array = explode(',', $bw->input['cfrecipients']);
		
		$mrecipients = "";
		$erecipients = array();
		foreach($array as $value){
			$temp = trim($value);
			if(strpos($temp, '@') === false){
				$mrecipients[] = $temp;
			}else $erecipients[] = $temp;
		}
		
		
		$this->model->getObjectById($bw->input['cfId']);
		$option['cfUrl'] = $this->model->obj->getUrl('icMarket');
		$option['cfTitle'] = $this->model->obj->getTitle();

		if($mrecipients) $this->sendMessage($mrecipients, $option);
		if($erecipients) $this->sendEmail($erecipients, $option);
	
		$this->output = <<<EOF
				<div id='message'>
					Your message has been sent.
				</div>
				<script type='text/javascript'>
					$(document).ready(function(){
						setTimeout(function(){
				        	$('#message').toggle("slow", function(){	
								$('#message').remove();
								$('#cfrecipients').val('');
								$.unblockUI();
							});
				        }, 2000);
			        });
				</script>
EOF;
	}
	
	function sendMessage($mrecipients, $option = array()){
		global $vsStd, $bw, $vsUser;
		
		$vsStd->requireFile(CORE_PATH.'messages/messages.php');
		foreach($mrecipients as $element){
			$content = <<<EOF
				Hi {$element}!
				{$vsUser->obj->getFullname()} wants you to look at this item 
				<b>
				<a href='{$option['cfUrl']}' title="{$option['cfTitle']}" target='_blank'>
					{$option['cfTitle']}
				</a>
				</b>
				(<a href='{$option['cfUrl']}' title="{$option['cfTitle']}" target='_blank'>
					{$option['cfUrl']}
				</a>)
				<br/><br/><br/>
				--iCampux Team--<br/>
				<a href='http://www.iCampux.com' title="http://www.iCampux.com" target='_blank'>http://www.iCampux.com</a>
EOF;
			
			$data['messageUser'] = 0;
			$data['messageRecipient'] = $element;
			$data['messageTitle'] = $vsUser->obj->getFullname()." refers you a listing";
			$data['messageContent'] = $content;

			$message = new messages();
			$message->sendMessage($data);
		}
	}
	
	function sendEmail($erecipients, $option){
		global $bw, $vsStd, $vsUser;
		$vsStd->requireFile(LIBS_PATH."Email.class.php");

		foreach($erecipients as $element){
			$content = <<<EOF
				<a href="{$bw->vars['board_url']}" title='iCampux'>
					<img src="{$bw->vars['img_url']}/logo.jpg" alt='{$bw->vars['board_url']}'/>
				</a><br />
				
				Hi {$element}!<br /><br />
				<a href="{$bw->vars['board_url']}/{$vsUser->obj->getAlias()}" title="{$vsUser->obj->getFullname()}'s profile">{$vsUser->obj->getFullname()}</a> wants you to look at this item 
				<b>
				<a href='{$option['cfUrl']}' title="Click here to see {$option['cfTitle']}" target='_blank'>
					{$option['cfTitle']}
				</a>
				</b><br /><br />
				
				Alternative link: 
				<a href='{$option['cfUrl']}' title="Click here to see {$option['cfTitle']}" target='_blank'>
					{$option['cfUrl']}
				</a>
				<br/><br/><br/>
				--iCampux Team--<br/>
				<a href='{$bw->vars['board_url']}' title="{$bw->vars['board_url']}" target='_blank'>{$bw->vars['board_url']}</a>
EOF;
			$email = new Emailer();
	
	
			$email->setTo($element);
			$email->setFrom($vsUser->obj->getEmail(), "iCampux icMarket");
			$email->setSubject($vsUser->obj->getFullname()." refers you a listing");
			$email->setBody($content);
			$email->sendMail();
		}
	}
	
	function search(){
		global $bw, $vsMenu, $vsPrint, $vsTemplate;
		
		$keywordArray = array();
		$keyword = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($bw->input['cfCrit'])), ' '));
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
		
		$match = 'MATCH(searchContent) AGAINST ("'.$match.'" IN BOOLEAN MODE)';
		$this->model->setTableName('icmarket, vsf_listing_icmarket, vsf_search');
		
		$cond = 'cfId = lcObj AND lcObj = searchObj AND lcStatus < 3 AND lcDel = 0 ';
		if($bw->input['cfCrit']) $cond .= ' AND '.$match.' > 0';
		if($bw->input['cfCatId']) $cond .= ' AND cfCatId = '.$bw->input['cfCatId'];
		if($bw->input['cfLocation']) $cond .= ' AND cfLocation like "%'.$bw->input['cfLocation'].'%"';
		if($bw->input['cfcondition']) $cond .= ' AND cfCondition = '.$bw->input['cfcondition'];
		if($bw->input['minval']) $cond .= ' AND cfPrice >= '.$bw->input['minval'];
		if($bw->input['maxval']) $cond .= ' AND cfPrice <= '.$bw->input['maxval'];
		
	
		$this->model->setFieldsString('vsf_icmarket.*, '.$match.' AS score');
		$this->model->setCondition($cond);
		$this->model->setOrder('score DESC');
		
		if($bw->input['instant']) return $this->instantsearch();
		
		
		
		$total = $this->model->getNumberOfObject();
		$size = 1;

		$cpage = $bw->input['p'] + 1;
		
		$sum = $total-1;
		if($total == 0) $sum = 0;
		$tpage = floor($sum/$size) + 1;

		$start = $size*($cpage - 1);
		$limit = array($start, $size);
		
		
		$this->model->setLimit($limit);
		$option['pageList'] = $this->model->getObjectsByCondition();
			
		if($option['pageList']){		
			foreach($option['pageList'] as $key=>$value){
				$cfId .= $key.",";
				$uId .= $value->getUser().',';
			}
			$cfId = trim($cfId, ",");
			$uId = trim($uId, ",");
			
			global $vsStd, $vsMenu;
			$vsStd->requireFile(CORE_PATH.'galleries/galleries.php');
			$g = new galleries();
			$gs = $g->getGallery($cfId, $vsMenu->getCategoryGroup('icMarket')->getId());
	
			if($uId){
				$user = new users();
				$ucond = 'userId in ('.$uId.')';
				$user->setCondition($ucond);
				$user->setFieldsString('userId, userAlias, userFullname');
				$us = $user->getArrayByCondition('userId');
			}
			
			foreach($option['pageList'] as $key => $value){			
				$tempId = $value->getUser();
				if($us[$tempId]) $option['pageList'][$key]->seller = $us[$tempId]['userAlias'];
				
				$gkey = $value->getGallery();
				if($gs[$gkey]){
					$temp = current($gs[$gkey]);
					if($temp) $option['pageList'][$key]->ifile = $temp['gdetail']->getFile();
				}
				
				$moreinfo = '';
				if($value->getCampus())
					$moreinfo = $value->getCampus() . ', ';
				$moreinfo .= $value->getLocation();
				
				if($moreinfo){
					$moreinfo = trim($moreinfo, ', ');
					$option['pageList'][$key]->moreinfo = '('.$moreinfo.')';
				}
			}
		}


		$option['condition'] = $vsMenu->getCategoryGroup("ccondition")->getChildren();
		
		$bw->input['advance'] = trim(str_replace($_SERVER['REDIRECT_URL'], "", $_SERVER['REQUEST_URI']), "?");
		
		
		if($bw->input['t'] == 'load' || $bw->input['ajax'])
			return $this->output = $this->html->mainsearch($option).<<<EOF
				<script type='text/javascript'>
					var total = $tpage;
					var p = $cpage;
				</script>
EOF;
		
		$option['category'] = $vsMenu->getCategoryGroup("ccategory")->getChildren();
		
		$vsPrint->addJavaScriptFile('icampus/typewatch');
		$vsPrint->addJavaScriptFile('icampus/jquery.autocomplete');
		$vsPrint->addCSSFile("autocomplete/jquery.autocomplete");
		$vsPrint->addJavaScriptFile('icampus/scrollpagination', 1);
		
		
		if($tpage > $cpage-1){
			$option['scrollPagination'] = <<< EOF
				<script type='text/javascript'>
					var total = 0; var p = 0; 
					
					$("#cfmctab").scrollPagination({
						'contentPage': '{$bw->vars['board_url']}/icmarket/search/&{$bw->input['advance']}&t=load&ajax=1', // the page where you are searching for results
						'contentData': {}, // you can pass the children().size() to know where is the pagination
						'scrollTarget': $(window), // who gonna scroll? in this example, the full window
						'heightOffset': 0, // how many pixels before reaching end of the page would loading start? positives numbers only please
						'beforeLoad': function(){ // before load, some function, maybe display a preloader div
							$('#loading').fadeIn();
							
							$(this)[0].contentData['total'] = total;
							$(this)[0].contentData['p'] = p;
							
							$(this)[0].contentData['fire'] = true;
						},
						'afterLoad': function(elementsLoaded){ // after loading, some function to animate results and hide a preloader div
							 $('#loading').fadeOut();
							 var i = 0;
							 $(elementsLoaded).fadeInWithDelay();
							 
							 if (total <= p-1){ // if more than 100 results loaded stop pagination (only for test)
							 	$('#nomoreresults').fadeIn();
								$('#cfmctab').stopScrollPagination();
							 }
						}
					});
					$.fn.fadeInWithDelay = function(){
						var delay = 0;
						return this.each(function(){
							$(this).delay(delay).animate({opacity:1}, 200);
							delay += 100;
						});
					};
				</script>
EOF;
		}
		
		return $this->output = $this->html->search($option);
	}
	
	function instantsearch(){
		global $bw, $vsMenu, $vsPrint, $vsTemplate;
		
		$advance = '&instant='.$bw->input['instant'].'&';
		if($bw->input['cfCrit']) $advance .= 'cfCrit='.$bw->input['cfCrit'];
		if($bw->input['cfCatId']) $advance .= '&cfCatId'.$bw->input['cfCatId'];
		if($bw->input['cfLocation']) $advance .= '&cfLocation='.$bw->input['cfLocation'];
		if($bw->input['cfcondition']) $advance .= '&cfcondition='.$bw->input['cfcondition'];
		if($bw->input['minval']) $advance .= '&minval='.$bw->input['minval'];
		if($bw->input['maxval']) $advance .= '&maxval='.$bw->input['maxval'];
		$bw->input['advance'] = $advance;
		
		$size = 10; $url = 'icMarket/search'; $pIndex = 2;

		$option = $this->model->getPageList($url, $pIndex, $size, 1, 'icitem_container');

			
		if($option['pageList']){		
			foreach($option['pageList'] as $key=>$value){
				$cfId .= $key.",";
				$uId .= $value->getUser().',';
			}
			$cfId = trim($cfId, ",");
			$uId = trim($uId, ",");
			
			global $vsStd;
			$vsStd->requireFile(CORE_PATH.'galleries/galleries.php');
			$g = new galleries();
			$gs = $g->getGallery($cfId, $vsMenu->getCategoryGroup('icMarket')->getId());
	
			if($uId){
				$user = new users();
				$ucond = 'userId in ('.$uId.')';
				$user->setCondition($ucond);
				$user->setFieldsString('userId, userAlias, userFullname');
				$us = $user->getArrayByCondition('userId');
			}
			
			foreach($option['pageList'] as $key => $value){			
				$tempId = $value->getUser();
				if($us[$tempId]){
					$option['pageList'][$key]->seller = $us[$tempId]['userAlias'];
				}
				
				$gkey = $value->getGallery();
				if($gs[$gkey]){
					$temp = current($gs[$gkey]);
					if($temp) $option['pageList'][$key]->ifile = $temp['gdetail']->getFile();
				}
				
				$moreinfo = '';
				if($value->getCampus())
					$moreinfo = $value->getCampus() . ', ';
				$moreinfo .= $value->getLocation();
				
				if($moreinfo){
					$moreinfo = trim($moreinfo, ', ');
					$option['pageList'][$key]->moreinfo = '('.$moreinfo.')';
				}
			}
		}

		return $this->output = $this->html->instantSearch($option);
	}
	
	function category($catId){
		global $bw, $vsMenu, $vsPrint;
		
		$caturl = $catId;
		if($bw->input['c']) $catId = $bw->input['c'];
		$query = explode('-',$catId);
		$catId = abs(intval($query[count($query)-1]));
		
		$category = $vsMenu->getCategoryGroup("ccategory")->getChildren();
		
		$seoArr = array();
		foreach($category as $key => $cat){
			if($catId == $key) $seoArr['title'] =  $cat->getTitle();
			$cat->caturl = $bw->vars['board_url'].'/icMarket/category/'.strtolower($cat->getTitle()).'-'.$cat->getId();
		}
		$option['category'] = $category;
		
		if($bw->input['t'] == 'load' && $bw->input['ajax']){
			$output = ""; $option = array();
			if(array_key_exists($catId, $category))
				$output = $this->maincategory($catId, &$option);
			
			return $this->output = $output.<<<EOF
				<script type='text/javascript'>
					var total = {$option['tpage']}; 
					var p = {$option['cpage']}; 
				</script>
EOF;
		}
		
		if(!array_key_exists($catId, $category)){
			global $vsPrint;
			$vsPrint->boink_it($bw->base_url."error"); 
		}
		
		$vsPrint->addJavaScriptFile('icampus/scrollpagination', 1);
		
		$html = $this->maincategory($catId, &$option);
	
		$option['curcatId'] = $catId;
		$option['condition'] = $vsMenu->getCategoryGroup("ccondition")->getChildren();

		
		if($option['tpage'] > $option['cpage']-1)
			$option['caturl'] = $caturl;
			
			$html = $html .<<< EOF
					<script type='text/javascript'>
						var total = {$option['tpage']}; var p = {$option['cpage']}; 
						$("#icmarket-category").scrollPagination({
							'contentPage': '{$bw->vars['board_url']}/icmarket/category/&t=load&c={$caturl}&ajax=1', // the page where you are searching for results
							'contentData': {}, // you can pass the children().size() to know where is the pagination
							'scrollTarget': $(window), // who gonna scroll? in this example, the full window
							'heightOffset': 0, // how many pixels before reaching end of the page would loading start? positives numbers only please
							'beforeLoad': function(){ // before load, some function, maybe display a preloader div
								$('#loading').fadeIn();
								
								$(this)[0].contentData['total'] = total;
								$(this)[0].contentData['p'] = p;
								
								$(this)[0].contentData['fire'] = true;
								
							},
							'afterLoad': function(elementsLoaded){ // after loading, some function to animate results and hide a preloader div
								 $('#loading').fadeOut();
								 var i = 0;
								 $(elementsLoaded).fadeInWithDelay();
								 
								 if (total <= p-1){ // if more than 100 results loaded stop pagination (only for test)
								 	$('#nomoreresults').fadeIn();
									$('#icmarket-category').stopScrollPagination();
								 }
							}
						});
						$.fn.fadeInWithDelay = function(){
							var delay = 0;
							return this.each(function(){
								$(this).delay(delay).animate({opacity:1}, 200);
								delay += 100;
							});
						};
					</script>
EOF;
		$option['html'] = $html; 
		$this->createSEO($seoArr);
		
		$vsPrint->addJavaScriptFile('icampus/typewatch');
		$vsPrint->addJavaScriptFile('icampus/jquery.autocomplete');
		$vsPrint->addCSSFile("autocomplete/jquery.autocomplete");
		
		return $this->output = $this->html->category($option);
	}
	
	function maincategory($catId = 0, &$input = array()){
		global $bw, $vsMenu;
		
		$this->model->setTableName('icmarket, vsf_listing_icmarket');
		
		$cond = 'cfId = lcObj AND lcStatus < 3 AND lcDel = 0 AND cfCatId in ('.$catId.')';
		
		$this->model->setCondition($cond);
		$total = $this->model->getNumberOfObject();
		$size = 2;
		
		$cpage = $bw->input['p'] + 1;
		$tpage = floor(($total-1)/$size)+1;
		
		$input['cpage'] =$cpage;
		$input['tpage'] =$tpage;
		
		$start = $size*($cpage - 1);

		if($cpage > $tpage){
			if($total < $size)
				return $this->output = <<<EOF
					<div class="store_item">
	            		<b>There is no more item in this category.</b>
	            	</div>
EOF;
		}
		
		$this->model->setLimit(array($start, $size));
		$option['pageList'] = $this->model->getObjectsByCondition();

		
		if($option['pageList']){
			foreach($option['pageList'] as $key => $value){
				$cfId .= $key.",";
				$uId .= $value->getUser().',';
			}
			
			$cfId = trim($cfId, ",");
			$uId = trim($uId, ",");
			
			global $vsStd, $vsTemplate;
			$vsStd->requireFile(CORE_PATH.'galleries/galleries.php');
			$g = new galleries();
			$gs = $g->getGallery($cfId, $vsMenu->getCategoryGroup('icMarket')->getId());
		
			$user = new users();
			$ucond = 'userId in ('.$uId.')';
			$user->setCondition($ucond);
			$user->setFieldsString('userId, userAlias, userFullname');
			$us = $user->getArrayByCondition('userId');
			
			foreach($option['pageList'] as $key => $value){
				$tempId = $value->getUser();
				if($us[$tempId]) $option['pageList'][$key]->seller = $us[$tempId]['userAlias'];
			
			
				if($gs[$value->getGallery()]){
					$cgs = current($gs[$value->getGallery()]);
					$option['pageList'][$key]->ifile = $cgs['gdetail']->getFile();
				}
				
				$moreinfo = '';
				if($value->getCampus())
					$moreinfo = $value->getCampus() . ', ';
				$moreinfo .= $value->getLocation();
				
				if($moreinfo){
					$moreinfo = trim($moreinfo, ', ');
					$option['pageList'][$key]->moreinfo = '('.$moreinfo.')';
				}
			}
		}
		
		
		$option['condition'] = $vsMenu->getCategoryGroup("ccondition")->getChildren();
		
		
		return $this->output = $this->html->mainlisting($option);
	}
	
	function listing(){
		global $bw, $vsMenu;
		
		$input = array();
		$category = $vsMenu->getCategoryGroup("ccategory")->getChildren();

		if($bw->input['c']){
			$query = explode('-', $bw->input['c']);
			$catId = abs(intval($query[count($query)-1]));
			
			if($category[$catId]) $input['curcatobj'] = $category[$catId];
			else return $this->output = <<<EOF
				<script type='text/javascript'>
					location.href = '{$bw->vars['board_url']}/error';
				</script>
EOF;
		}
		$mainhtml = $this->mainlisting($catId, &$input);
		if($bw->input['t'] == 'all'){
			$mainhtml = '<div id="allicmarket"><div id="icitem_container">'.$mainhtml.'</div></div>';

			
			if($input['tpage'] > $input['cpage']-1)
				$mainhtml = $mainhtml.<<< EOF
					<script type='text/javascript'>
						var total = 0; var p = 0; 
						
						$("#allicmarket").scrollPagination({
							'contentPage': '{$bw->vars['board_url']}/icmarket/listing/&t=load&ajax=1', // the page where you are searching for results
							'contentData': {}, // you can pass the children().size() to know where is the pagination
							'scrollTarget': $(window), // who gonna scroll? in this example, the full window
							'heightOffset': 0, // how many pixels before reaching end of the page would loading start? positives numbers only please
							'beforeLoad': function(){ // before load, some function, maybe display a preloader div
								$('#loading').fadeIn();
								
								$(this)[0].contentData['total'] = total;
								$(this)[0].contentData['p'] = p;
								
								$(this)[0].contentData['fire'] = true;
								
							},
							'afterLoad': function(elementsLoaded){ // after loading, some function to animate results and hide a preloader div
								 $('#loading').fadeOut();
								 var i = 0;
								 $(elementsLoaded).fadeInWithDelay();
								 
								 if (total <= p-1){ // if more than 100 results loaded stop pagination (only for test)
								 	$('#nomoreresults').fadeIn();
									$('#allicmarket').stopScrollPagination();
								 }
							}
						});
						$.fn.fadeInWithDelay = function(){
							var delay = 0;
							return this.each(function(){
								$(this).delay(delay).animate({opacity:1}, 200);
								delay += 100;
							});
						};
					</script>
EOF;
		}
		
		if($bw->input['ajax']){
			if($input['tpage'] && $input['cpage'])
				$mainhtml = $mainhtml.<<<EOF
					<script type='text/javascript'>
						var total = {$input['tpage']}
						var p = {$input['cpage']}
					</script>
EOF;
			return $this->output = $mainhtml;
		}

		foreach($category as $cat){
			$cat->cleanTitle = strtolower($cat->getTitle());
			$cat->caturl = $bw->vars['board_url'].'/icMarket/category/'.strtolower($cat->getTitle()).'-'.$cat->getId();
		}
		$option['category'] = $category;
		
		global $vsPrint;
		$vsPrint->addJavaScriptFile ( "jquery/ui.tabs.custom");
		
		
		$vsPrint->addCSSFile("jquery.tabs");
		$vsPrint->addCSSFile('custom.ui.tabs');
		
		$quantity = $this->getQuantityOfGroup();
		$vsPrint->addJavaScriptFile('icampus/scrollpagination', 1);

		foreach($category as $key => $cat)
			if(array_key_exists($key,$quantity))
				$option['tabs'][$key] = $cat;

		
		$option['condition'] = $vsMenu->getCategoryGroup("ccondition")->getChildren();
		global $DB;
		$this->createSEO(array('title'=>'icMarket'));
		
		$vsPrint->addJavaScriptFile('icampus/jquery.autocomplete');
		$vsPrint->addCSSFile("autocomplete/jquery.autocomplete");
		
		$this->output = $this->html->listing($option);
	}
	
	function mainlisting($catIds, &$input = array()){
		global $bw, $vsTemplate;
		
		$this->model->setTableName('icmarket, vsf_listing_icmarket');
		
		$cond = 'cfId = lcObj AND lcStatus <> 3 AND lcDel = 0';
		
		$limit = array(0, 5);
		if($catIds) $cond .= ' AND cfCatId in ('.$catIds.')';
		else{
			global $bw;
			if(!$catIds || $bw->input['t']=='load'){
				$this->model->setCondition($cond);
				$total = $this->model->getNumberOfObject();
				$size  = 5;
				
				$cpage = $bw->input['p'] + 1;
				$tpage = floor(($total-1)/$size)+1;
				
				$start = $size*($cpage - 1);
				$limit = array($start, $size);
				
				$input['tpage'] = $tpage;
				$input['cpage'] = $cpage;
				
				
				if($tpage < $cpage){
					$bw->input['p'] += 1;
					return <<<EOF
					<div class="store_item">
	            		<b>There is no more item in this category.</b>
	            	</div>
EOF;
				}
			}
		}

		if($bw->input['t']=='all') return "";
		$this->model->setCondition($cond);
		$this->model->setLimit($limit);
		$this->model->setOrder('cfTime DESC');
		
		$option = array_merge($input);
		
		$option['pageList'] = $this->model->getObjectsByCondition();

		
		if($option['pageList']){
			foreach($option['pageList'] as $key=>$value){
				$cfId .= $key.",";
				$uId .= $value->getUser().',';
			}
			$cfId = trim($cfId, ",");
			$uId = trim($uId, ",");
			
			global $vsStd, $vsMenu;
			$vsStd->requireFile(CORE_PATH.'galleries/galleries.php');
			$g = new galleries();
			$gs = $g->getGallery($cfId, $vsMenu->getCategoryGroup('icMarket')->getId());
		
			$user = new users();
			$ucond = 'userId in ('.$uId.')';
			$user->setCondition($ucond);
			$user->setFieldsString('userId, userAlias, userFullname');
			$us = $user->getArrayByCondition('userId');
			
			
			foreach($option['pageList'] as $key=>$value){
				$tempId = $value->getUser();
				if($us[$tempId]){
					$option['pageList'][$key]->seller = $us[$tempId]['userAlias'];
				}
				if($gs[$value->getGallery()]){
					$cgs = current($gs[$value->getGallery()]);
					$option['pageList'][$key]->ifile = $cgs['gdetail']->getFile();
				}
				
				$moreinfo = '';
				if($value->getCampus())
					$moreinfo = $value->getCampus() . ', ';
				$moreinfo .= $value->getLocation();
				
				if($moreinfo){
					$moreinfo = trim($moreinfo, ', ');
					$option['pageList'][$key]->moreinfo = '('.$moreinfo.')';
				}
			}
			
			if($input['curcatobj']){
				$curcat = $input['curcatobj'];
				$option['curcat']['moreurl'] = $bw->vars['board_url'].'/icMarket/category/'.strtolower($curcat->getTitle()).'-'.$curcat->getId();
				$option['curcat']['catTitle']= $curcat->getTitle();
			}
		}
		return $this->output = $this->html->mainlisting($option);
	}
	
	
		
	function detail($objId){
		global $bw, $vsMenu;
		
		$query = explode('-',$objId);
		$objId = abs(intval($query[count($query)-1]));
			
		$this->model->getObjectById($objId);
		
		if(!$this->model->obj->getId()){
			global $vsPrint;
			$vsPrint->boink_it($bw->base_url."error"); 
		}
		
		$category = $vsMenu->getCategoryGroup("ccategory")->getChildren();
		foreach($category as $cat){
			$cat->caturl = $bw->vars['board_url'].'/icMarket/category/'.strtolower($cat->getTitle()).'-'.$cat->getId();
		}
		$option['category'] = $category;
		$this->model->obj->cfcategory = $category[$this->model->obj->getCatId()]->getTitle();
		
		$condition = $vsMenu->getCategoryGroup("ccondition")->getChildren();
		if($this->model->obj->getCondition())
		$this->model->obj->cfcondition = $condition[$this->model->obj->getCondition()]->getTitle();
		
		$user = new users();
		$user->getObjectById($this->model->obj->getUser());
		$this->model->obj->seller = $user->obj->getAlias();
		
		global $vsStd, $vsMenu;
		$vsStd->requireFile(CORE_PATH.'galleries/galleries.php');
		$g = new galleries();
		$gs = $g->getGallery($objId, $vsMenu->getCategoryGroup('icMarket')->getId());
		
		$this->model->obj->galleries = current($gs);
	
		global $vsCom, $addon;
		$vsCom->SEO->type = 'detail';
		$addon->importFileForMessagePopup();
		$this->output = $this->html->detail($this->model->obj, $option);
	}
	
	function preview(){
		global $bw, $vsMenu, $vsUser;
	
		
		$bw->input['cfTime'] = time();
		$this->model->obj->convertToObject($bw->input);
		
		if($bw->input['cfCondition']){
			$condition = $vsMenu->getCategoryGroup("ccondition")->getChildren();
			$this->model->obj->cfcondition = $condition[$this->model->obj->getCondition()]->getTitle();
		}
		
		$this->model->obj->seller = $vsUser->obj->getAlias();
		
		
		if($bw->input['fileId'])
			$this->model->obj->galleries = explode(",", $bw->input['fileId']);
		
		$this->output = $this->html->preview($this->model->obj);
	}
	
	function post(){
		global $bw, $vsMenu, $vsPrint, $vsUser, $vsTemplate, $vsStd;
		

		if($bw->input['isubmit']){
			unset($bw->input['isubmit']);
			$option = $this->postProcess();
			
			if($bw->input['fportlet']) return $option;

			$option['icURL'] = $this->model->obj->getUrl('icMarket');
			
			if($option['result']) $this->model->obj = new Icmarket();
		}
		
		$vsPrint->addJavaScriptFile('ajaxupload/ajaxfileupload', 1);
		$vsPrint->addJavaScriptFile('icampus/jquery.validate.pack', 1);
		
		$option['condition'] = $vsMenu->getCategoryGroup("ccondition")->getChildren();
		
		$category = $vsMenu->getCategoryGroup("ccategory")->getChildren();
		foreach($category as $cat)
			$cat->caturl = $bw->vars['board_url'].'/icMarket/category/'.strtolower($cat->getTitle()).'-'.$cat->getId();
			
		$option['category'] = $category;
		
		
		$campusList = $vsTemplate->global_template->GLOBAL_CAMPUS_LIST;
		$temp = $campusList[$vsUser->obj->getCampusId()]; 
		if($temp) $this->model->obj->setCampus($temp->getTitle());
		
		$vsStd->requireFile(CORE_PATH.'users/profile/profiles.php');
		$p = new profiles();
		
		$p->setFieldsString('profileUser, profileLocation');
		$profile = $p->getUserProfile($vsUser->obj->getId());
		$this->model->obj->setLocation($profile['profileLocation']);
		
		$option['mainobj'] = $this->model->obj;
		
		$this->output = $this->html->post($option);
	}

	function postProcess(){
		global $bw, $vsUser;
		
		$time = time();
		$imgArr = array();
		if($bw->input['fileId']){
			foreach(explode(",", $bw->input['fileId']) as $value)
				$imgArr[$value] = 0;
		}else{
			if($_FILES){
				foreach($_FILES as $key => $ifile){
					$file = new files();
					if($ifile['name']){
					   	$file->uploadFile($key, "icMarket");
					   	$imgArr[$file->obj->getId()] = 0;
					}
				}
			}
		}
		

		$option = array();
		$option['message'] = 'Error! Try again later.';
		$option['status']	= false;
		
		if($bw->input['cfId']){
			$this->model->obj->convertToObject($bw->input);
			$result = $this->model->updateObjectById();
		}else{
			$bw->input['cfTime'] = $time;
			$bw->input['cfUser'] = $vsUser->obj->getId();
			
			$this->model->obj->convertToObject($bw->input);
			$result = $this->model->insertObject();
			
			
			$this->notifybyMessage();		
		}
		
		if($result){
			global $vsStd, $vsMenu;
			$cId = $this->model->obj->getId();
			
			
			
//add to search module
			$sData = array();
			$sData[$cId]['searchOTitle'] = $bw->input['cfTitle'];
			$sData[$cId]['searchOIntro'] = VSFTextCode::cutString($bw->input['cfContent'], 1024);
			
			$title = strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($bw->input['cfTitle'])),'-'));
			$url = 'icMarket/detail/'.$title.'-'.$cId;
			
			$value['cfTitle'] = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($bw->input['cfTitle'])),' '));
			$value['cfContent'] = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($bw->input['cfContent'])),' '));
			
			$sData[$cId]['searchModule'] = 'icmarket';
			$sData[$cId]['searchObj'] = $cId;
			$sData[$cId]['searchTitle'] =  $value['cfTitle'];
			
			
			$sData[$cId]['searchUrl'] =  $url;
			$content = $value['cfTitle'] . ' ' . $value['cfContent'];
			$sData[$cId]['searchContent'] = $content;
	
			global $vsStd;
			$vsStd->requireFile(CORE_PATH.'search/searchs.php');
			
			$model = new searchs();
			$model->multiInsert($sData);
//add to search module		
			
			if(!$bw->input['cfId']){
// add to my listing		
				$vsStd->requireFile(CORE_PATH.'listings/lcs.php');
				
				$lcs = new lcs();
				$lData = array(
								'lcObj'		=> $cId,
								'lcPrice'	=> $bw->input['cfPrice']
							); 
				$lcs->singleInsert($lData);
			}
			
	
			$vsStd->requireFile(CORE_PATH.'galleries/galleries.php');
			$g = new galleries();
			
			$iflag = true;
			if($bw->input['cfId']){
// update galleries to classified
				$iflag = false;
				if($imgArr || $bw->input['del']){
					$this->model->getObjectById($bw->input['cfId']);
					
					$objGalId = $this->model->obj->getGallery();
					if($objGalId){
						$delId = implode(',', array_keys($bw->input['del']));
						$uresult = $g->updateGallery($objGalId, $imgArr, $delId);
						
						if($uresult == 0){
							$this->model->obj->setGallery(0);
							$this->model->updateObjectById();
						}
					}else $iflag = true;
				}
			}
			if($iflag){
// add galleries to classified
				$gdata['galleryTime'] = $time;
				$gdata['galleryObj'] = $cId;
				$gdata['galleryObjCat'] = $vsMenu->getCategoryGroup('icMarket')->getId();
			
				$gId = $g->addGallery($imgArr, $gdata);
				if($gId){
					$this->model->setCondition('cfId = '.$cId);
					$this->model->updateObjectByCondition(array('cfGallery'=>$gId));
				}
			}
			$option['message'] = 'Item listed successful';
			$option['status']	= true;
		}
	
		return $option;
	}
	
	function notifybyMessage(){
		global $vsStd, $bw, $vsSettings, $vsUser, $vsLang;
			
		$content = <<<EOF
			<a href="{$bw->vars['board_url']}" title='iCampux'>
				<img src="{$bw->vars['img_url']}/logo.jpg" alt='{$bw->vars['board_url']}'/>
			</a><br />
				
				
			Hi {$vsUser->obj->getFullname()}!<br /><br />
			Your item <b>{$this->model->obj->getTitle()}</b> is listed here 
			<a href='{$this->model->obj->getUrl('icMarket')}' title="{$this->model->obj->getTitle()}" target='_blank'>{$this->model->obj->getUrl('icMarket')}</a>. Please check whether the provided information is correct!<br /><br />
				You can also modify it here 
			<a href='{$bw->vars['board_url']}/listings/mylisting' title="You can also modify your item" target='_blank'>
				{$bw->vars['board_url']}/listings/mylisting
			</a><br /><br />

			Thank you for using iCampux!<br /><br /><br />
				
			--iCampux Team--<br />
			<a href='{$bw->vars['board_url']}' title="iCampux Team">
				{$bw->vars['board_url']}
			</a>
EOF;
			$data['messageUser'] = -1;
			$data['messageRecipient'] = $vsUser->obj->getAlias();
			$data['messageTitle'] = 'Your icMarket listing';
			$data['messageContent'] = $content;
		
			$vsStd->requireFile(CORE_PATH.'messages/messages.php');
			$message = new messages();
		
			$message->sendMessage($data);
			
			
			$vsStd->requireFile(LIBS_PATH."Email.class.php");
			$email = new Emailer();
	

			$email->setTo($vsUser->obj->getName());
			$email->setFrom($vsSettings->getSystemKey('global_system_message_alias', 'noreply@icampux.com', 'global', 1, 1), 'iCampux Team');
			$email->setSubject('Your icMarket listing');
			$email->setBody($content);
			$email->sendMail();
		}
	
	
	function createSEO($option = array()){
		global $vsCom;
		$vsCom->SEO->obj->setTitle($option['title']);
	}
	
	function getQuantityOfGroup(){
		$ic = new icmarkets();
		$ic->setFieldsString('cfCatId, COUNT(*) AS  qua');
		$ic->setTableName('icmarket, vsf_listing_icmarket');
		$ic->setCondition('cfId = lcObj AND lcStatus < 3');
		$ic->setGroupby('cfCatId');
		$array = $ic->getArrayByCondition('cfCatId');
		return $array;
	}
	
	function postFormPortlet($cfId = 0){
		global $vsMenu;
		$option['condition'] = $vsMenu->getCategoryGroup("ccondition")->getChildren();
		$option['category'] = $vsMenu->getCategoryGroup("ccategory")->getChildren();
		
		if($cfId) $this->model->getObjectById($cfId);
		
		
		if($this->model->obj->getId()){
			global $vsStd, $vsMenu;
			$vsStd->requireFile(CORE_PATH.'galleries/galleries.php');
			$g = new galleries();
			$gs = $g->getGallery($cfId, $vsMenu->getCategoryGroup('icMarket')->getId(), false);
		
			if($gs[$this->model->obj->getGallery()])
				$this->model->obj->ifiles = $gs[$this->model->obj->getGallery()];
		}
		
		
		
		$option['mainobj'] = $this->model->obj;
		$option['formportlet'] = 'formportlet';
//		$option['furl'] = $bw->input['board_url'].'/listings/editlc';
		
		
		return $this->output = $this->html->postFormPortlet($option, false);
	}
	
	function globalerror(){
		global $vsPrint;
		$vsPrint->boink_it($bw->base_url."error");
	}
	
 	function __construct(){
		global $vsTemplate;
    	
		$this->model = new icmarkets();
    	$this->html = $vsTemplate->load_template('skin_icmarket');    	
    }
	
    function authorize(){
    	global $bw, $vsPrint, $vsUser;
    	
    	$login = array("post", 'preview');
		if(in_array($bw->input[1], $login)){
			if(!$vsUser->obj->getId()){
				if($bw->input[1] == 'preview'){
					echo <<<EOF
						<scrip type='text/javascript'>
							location.href = '{$bw->base_url}users/login';
						</script>
EOF;
					exit;
				}
				return $vsPrint->boink_it($bw->base_url."users/login");
			}
			return true;
		}

		$valid = array( 'post', 'listing', 'preview','detail','category', 'search', 'sendtofriends', 'suggest', '');
		
		if(!in_array($bw->input[1], $valid)){
			return $vsPrint->boink_it($bw->base_url."error");
		}
    }
	
	
	public 		$output 	= "";
	private 	$html       = "";	
	protected	$model	 	= "";
	
	function getOutput(){
		return $this->output;
	}
}
?>