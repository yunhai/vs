	<?php
class Addon{

	public  $html;
        
	function __construct() {
		global	$vsTemplate;
		
		$this->html = $vsTemplate->load_template('skin_addon');
		
		if(APPLICATION_TYPE=='user')$this->runUserAddOn();
		else $this->runAdminAddOn();
		
	}
	
	function runUserAddOn() {
		global	$vsStd, $vsCounter, $vsTemplate;

		$vsCounter->visitCounter();
		while(4-strlen($vsTemplate->global_template->state['today'])){
			$vsTemplate->global_template->state['today'] = "0".$vsTemplate->global_template->state['today'];
		}
		while(4-strlen($vsTemplate->global_template->state['visits'])){
			$vsTemplate->global_template->state['visits'] = "0".$vsTemplate->global_template->state['visits'];
		}
		$this->managerPortlet();
	}

	function managerPortlet(){
		global $vsTemplate, $vsMenu, $bw, $vsStd,$vsLang,$vsPrint,$arracc,$keyacc;

                $listmenu = $vsMenu->getMenuForUser();
                 $vsStd->requireFile(CORE_PATH.'pages/pages.php');
 
                $vsTemplate->global_template->menu_sub['sanh-tiec'] = $this->getPagemenu('sanh-tiec');
                $vsTemplate->global_template->menu_sub['td-tiec-cuoi'] = $this->getPagemenu('td-tiec-cuoi');
//                $vsTemplate->global_template->menu_sub['bang-gia'] = $this->getPagemenu('bang-gia');
                $vsTemplate->global_template->menu_sub['sanh-hoi-nghi'] = $this->getPagemenu('sanh-hoi-nghi');
                $vsTemplate->global_template->menu_sub['am-thuc'] = $this->getPagemenu('am-thuc');
                $vsTemplate->global_template->menu_sub['news'] = $this->buildchildMenu('news');

                $acc = $this->buildMenuLeft($listmenu);
                
               
                $acc['news'] = $this->buildchildMenu('news');
                if($keyacc = $this->getkeyAcc($bw->input['module'])){
                     
                $vsTemplate->global_template->menuLeft = $acc[$keyacc];
                }
              
                 $vsTemplate->global_template->menu = $this->html->showMenuTopForUser($listmenu);
                $vsTemplate->global_template->menu_bottom = $this->html->showMenuBottomForUser($listmenu);
                
                
                $vsStd->requireFile(CORE_PATH.'partners/partners.php');
                $partners = new partners();
                $vsTemplate->global_template->adv = $partners->getArrayPartners(array('slidehome','weblink','banner'));
                
                $vsTemplate->global_template->weblink = $this->html->portlet_dropdown_weblink($vsTemplate->global_template->adv['weblink']);
 
                $vsStd->requireFile(CORE_PATH.'pcontacts/pcontacts.php');
		$pcontacts = new pcontacts();
		$vsTemplate->global_template->footer = $pcontacts->getPageContact();
               
                $vsStd->requireFile(CORE_PATH.'supports/supports.php');
                $supports = new supports();
                $vsTemplate->global_template->supports = $supports->portlet();
                
//                str_replace($supports, $pcontacts, $partners)
               
                $vsTemplate->global_template->searchLeft = $this->html->showSearchLeft();
				
				$pages = new pages();
                $vsTemplate->global_template->listgallery = $pages->getGalleryCode();
            }
            
        function buildMenuLeft($listmenu){
            global $vsTemplate,$access;
            
            if($listmenu){
                foreach($listmenu as $key=>$men){       
                    if($men->getChildren())
                    $access[$men->getUrl()] = $this->getSubMenuLeft($men);
                }
            }
            return $access;
        }    
        function getSubMenuLeft($children){
            global $vsTemplate,$arracc;
            $retur ="";
            $arracc['news'][]='news';
            if($children->getChildren())
            foreach($children->getChildren() as $obj){
                $arracc[$children->getUrl()][]=$obj->getUrl();
                $retur.="<li><a href='{$obj->getUrl(0)}'  title='{$obj->getTitle()}' class='{$obj->getClassActive()}'><span>{$obj->getTitle()}</span></a>";
                      if($vsTemplate->global_template->menu_sub[$obj->getUrl()]) 
                          $retur.="<ul>{$vsTemplate->global_template->menu_sub[$obj->getUrl()]}</ul>";
                $retur.='</li>';
            }
            return $retur;
        }
        
        function getkeyAcc($key){
            global $vsTemplate,$arracc;
            
            if(!is_array($arracc))return "";
            foreach($arracc as $ke => $val){
                if(in_array($key, $val))return $ke;
            }
            return "";
        }

        function getThoiTiet(){
            global $vsStd,$vsTemplate,$vsLang;
            $vsStd->requireFile(UTILS_PATH.'class_utilities.php');
			$utilities = new class_ultilities();
			$citys = array(
  					array('city'=>'Sonla', 'name'=>$vsLang->getWords('global_nSonLa','Sơn La')),
//  					array('city'=>'Haipho', 'name'=>$vsLang->getWords('global_nHaiPhong','Hải Phòng')),
  					array('city'=>'Hanoi', 'name'=>$vsLang->getWords('global_nHanoi','Hà Nôi')),
  					array('city'=>'Vinh', 'name'=>$vsLang->getWords('global_nVinh','Vinh')),
  					array('city'=>'Danang', 'name'=>$vsLang->getWords('global_ndanang','Ðà Nẵng')),
  					array('city'=>'Nhatra', 'name'=>$vsLang->getWords('global_nnhatrang','Nha Trang')),
  					array('city'=>'Pleicu', 'name'=>$vsLang->getWords('global_npleiku','Pleiku')),
					array('city'=>'HCM', 'name'=>$vsLang->getWords('global_nHCM','Tp. Hồ Chí Minh'))
			);

			$weather = $utilities->getWeatherFromVNExpress($citys);
			$vsTemplate->global_template->weatherArray = $citys;

//                       foreach($weather as $key=>$obj){
//                           $weather[$key]['weatherDes'] = substr ($obj['weatherDes'], -12,4);
//                       }
                       
			$vsTemplate->global_template->weather = $weather;
        }
public function buildchildMenuPro($key = "products"){
		global $vsMenu,$bw,$vsLang,$vsStd;
	  	$re ="";
		$count = 0;
		$count_li = 0;
	  	$list = $vsMenu->getCategoryGroup ( $key );
	  	
	  	$vsStd->requireFile(CORE_PATH."products/products.php");
		$product = new products();
		
		$strIds = $vsMenu->getChildrenIdInTree($list);
        $product->setFieldsString('productId,productTitle,productCatId');
        $product->setOrder('productIndex ASC,productId DESC');
        $product->setCondition("productCatId in ({$strIds}) and productStatus > 0");
        $listpro = $product->getObjectsByCondition("getCatId",1);
      
	  	if ($list)
	  	if($list->getChildren()){
	   		foreach( $list->getChildren() as $k => $obj){
	   			$count+=1;
	    		if($obj->getChildren()){
	     			$re .= "<li><a title='{$obj->getTitle()}'>{$obj->getTitle()}</a><ul class='abc{$count}'>";
	     			foreach( $obj->getChildren() as $k1 => $obj1){
	     				$count_li +=1;
	     				if ($listpro[$k1]){
	     					if($count_li==1)
		    				$re .= "<li><a title='{$obj1->getTitle()}'>{$obj1->getTitle()}</a><ul class='abc{$count}'>";
		    				else
		    				$re .= "<li><a title='{$obj1->getTitle()}'>{$obj1->getTitle()}</a><ul>";
			   				foreach ($listpro[$k1] as $pro) 
			   					$re .= "<li><a href='{$pro->getUrl('products')}' title='{$pro->getTitle()}'>{$pro->getTitle()}</a></li>";
			   				$re .= "</ul></li>";
		    			}else 
	      					$re .= "<li><a title='{$obj1->getTitle()}'>{$obj1->getTitle()}</a></li>";
	     			}
	     			$re .="</ul></li>";
	    		}
	    		else{
	   	 			
		    		if ($listpro[$k]){
		    			$re .= "<li><a title='{$obj->getTitle()}'>{$obj->getTitle()}</a><ul class='abc{$count}'>";
		   				foreach ($listpro[$k] as $pro1) 
		   				$re .= "<li><a href='{$pro1->getUrl('products')}' title='{$pro1->getTitle()}'>{$pro1->getTitle()}</a></li>";
		   				$re .= "</ul></li>";
		    		}else 
		    			$re .= "<li><a title='{$obj->getTitle()}'>{$obj->getTitle()}</a></li>";
	    		}
	   		}

	  	}
		
	  	return $re;
	 }
        function getTygia(){
            global $vsStd,$vsTemplate,$vsLang;
            $vsStd->requireFile(UTILS_PATH.'class_utilities.php');
			$utilities = new class_ultilities();
			$time = time();
			$array = array('USD','EUR','JPY','SGD');
			$exchange = $utilities->getCurrencyFormVietcombank($array, $time);
			
			foreach($array as $obj)
	        	$rates .= <<<EOF
	            	<tr><td>{$obj}:</td><td>{$exchange[$obj]['exchangeSell']}</td><td>{$exchange[$obj]['exchangeBuy']}</td></tr>
EOF;

			$vsTemplate->global_template->rates = $rates;
        }
	
		
	function runAdminAddOn() {
		global $bw, $vsTemplate;
		
		if($bw->vars['user_multi_lang']) $this->displayChooseLanguage();
		
		$this->displayAdminMenus();
	}

	function displayChooseLanguage($langType = 1, $display = '<!--USER LANGUAGE LIST-->') {
		global $vsStd, $vsTemplate;
                 
		if (! isset($_SESSION [APPLICATION_TYPE] ['language']['currentLang'] )) {
			$oLanguages = new languages ( );
			$oLanguages->language->setAdminDefault ( 1 );
			$langResult = $oLanguages->getLangByObject ( array ('getAdminDefault'), $oLanguages->arrayLang );
				
			reset($langResult);
			$language = current($langResult);
			$_SESSION [APPLICATION_TYPE]['language']['currentLang'] = $language->convertToDB();
		}

		$currentUserLanguage = new Lang ( );
		$currentUserLanguage->convertToObject ( $_SESSION [APPLICATION_TYPE] ['language']['currentLang'] );

		$vsStd->requireFile ( CORE_PATH . "languages/languages.php" );
		$languages = new languages();
		$vsTemplate->global_template->LANGUAGE_LIST = $this->html->userLanguages($languages->arrayLang, $title);
	}

	function displayAdminMenus() {
		global $vsTemplate, $vsMenu, $vsSettings;
		
		$vsMenu->obj->setIsAdmin(1);
		$vsMenu->obj->setStatus(1);
		$vsMenu->obj->setPosition('top');
		$vsMenu->obj->setTitle('Categories');
		

		if($vsSettings->getSystemKey('admin_multi_lang', 0, 'global', 1, 1)){
			$vsMenu->obj->setLangId($_SESSION[APPLICATION_TYPE]['language']['currentLang']['langId']);
			$menus = $vsMenu->filterMenu(array('isAdmin'=>true,'langId'=>true, 'status'=>true, 'position'=>true), $vsMenu->arrayTreeMenu);
		}
		else
			$menus = $vsMenu->filterMenu(array('isAdmin'=>true,'status'=>true, 'position'=>true), $vsMenu->arrayTreeMenu);
				
		$vsTemplate->global_template->ADMIN_TOP_MENU = $menus;
		$vsMenu->obj->setLangId($_SESSION [APPLICATION_TYPE] ['language']['currentLang']['langId']);
	}
	
	function displayAcpHelp(){
		global $bw, $vsSkin,$DB;
		$curr_action	=	$bw->input['module'];
		if($bw->input['action']!=""){
			$curr_action	.=	"::".$bw->input['action'];
		}

		$curr_LangId	=	$_SESSION[APPLICATION_TYPE]['language']['currentLang']['langId'];
		$DB->simple_construct	(	array(	'select'	=>	'*',
                                                        'from'		=>	'acp_help',
                                                        'where'		=>	'langId='.$curr_LangId.' AND `module_key`="'.$curr_action.'"',
                                                        'order'		=>	'id'
                                        ));
                                        $DB->simple_exec();
                                        if($acp_help	=	$DB->fetch_row()){
                                                $vsSkin->ACP_HELP_SYSTEM	=	$this->html->acpHelpHTML($acp_help);
                                        }
	}
        public function getPagemenu($key = 'pages'){
		global $vsStd,$bw,$vsMenu;
        $categories = $vsMenu->getCategoryGroup($key);
		$strIds = $vsMenu->getChildrenIdInTree($categories);
		if($key=='gallerys'){
			$pages = new gallerys();
			$pages->setFieldsString('galleryId,galleryTitle');
	        $pages->setOrder('galleryIndex ASC,galleryId DESC');
			$pages->setCondition("galleryCatId in ({$strIds}) and galleryStatus > 0");
		}else{
			$pages = new pages();
	        $pages->setFieldsString('pageId,pageTitle,pageCode');
	        $pages->setOrder('pageIndex ASC,pageId DESC');
			$pages->setCondition("pageCatId in ({$strIds}) and pageStatus > 0");
		}
		$list = $pages->getObjectsByCondition();
              
		
		return $this->buildLi($key,$list);
	}

 	public function buildLi($key = 'pages',$list=array()){
            global $vsTemplate;
     	$re ="";
		if(count($list)){
			foreach( $list as $obj){
                            if($obj->getCode()&&$vsTemplate->global_template->menu_sub[$obj->getCode()])
				$re .= "<li><a href='{$obj->getUrl($key)}' title='{$obj->getTitle()}'>{$obj->getTitle()}</a><ul>{$vsTemplate->global_template->menu_sub[$obj->getCode()]}</ul></li>";
                            else
                                $re .= "<li><a href='{$obj->getUrl($key)}' title='{$obj->getTitle()}'>{$obj->getTitle()}</a></li>";
			}
		}
       	return $re;
  	}
  	
	public function buildchildMenu($key = "news"){
		global $vsMenu,$bw,$vsLang;
	  	$re ="";

	  	$list = $vsMenu->getCategoryGroup ( $key );
	  	if ($list)
	  	if($list->getChildren()){
	   		foreach( $list->getChildren() as $obj){
	    		if($obj->getChildren()){
	     		$re .= "<li><a href='{$obj->getUrlCategory()}' title='{$obj->getTitle()}'>{$obj->getTitle()}</a><ul>";
	     		foreach( $obj->getChildren() as $obj1)
	      		$re .= "<li><a href='{$obj1->getUrlCategory()}' title='{$obj1->getTitle()}'>{$obj1->getTitle()}</a></li>";
	     		$re .="</ul></li>";
	    		}else
	   	 		$re .= "<li><a href='{$obj->getUrlCategory()}' title='{$obj->getTitle()}'>{$obj->getTitle()}</a></li>";
	   		}

	  	}
		
	  	return $re;
	 }
	 
	
	 
	public function getTitleMenu($option){
	global $vsTemplate;

	foreach ($option as $obj){
		if($obj->getClassActive()){
			return $obj;
		}
	}
	return ;
}	
	
}
?>