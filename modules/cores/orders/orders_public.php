<?php

if (! defined ( 'IN_VSF' )) {
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit ();
}

global $vsStd;
$vsStd->requireFile ( CORE_PATH . "orders/orders.php" );
require_once(CORE_PATH."products/options.php");
class orders_public {
	protected $html;
	protected $module;
	protected $output;
	private $products;

	function __construct() {
		global $vsTemplate,$bw,$vsModule,$vsStd;
                $vsStd->requireFile ( CORE_PATH . "products/products.php" );
		$this->model = new orders();
		$this->products = new products();
                $this->item = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'];
                $this->total = 0;
                $this->objItems = array();
                $this->option = new  options();
                $this->html = $vsTemplate->load_template('skin_orders');
	}

	/**
	 * @return unknown
	 */

	public function getOutput() {
		return $this->output;
	}

	function auto_run() {
		global $bw,$vsSess;
		$this->model->getNavigator();
		switch ($bw->input ['action']) {
                    //card Session
			case 'cartsummary' :
				$this->cartSummary ();
				break;
			case 'addtocart' :
				$this->addtocart ($bw->input[2],intval($bw->input[3]));
				break;
			case 'updatecart' :
				$this->updateCart ();
				break;
			case 'deletecart' :
				$this->deleteCart ($bw->input[2]);
				break;
                        
         	case 'deleteallcart':
				$this->item = array();
               	$this->saveItemstoSession();
               	$this->cartSummary();
               	break;
            
                            //tao moi 1 orders
        	case 'billName':
        		$this->billName();
				//$this->output = $this->html->billName($option);
				break;    
			case 'neworder'	:
				$this->newOrder($bw->input[2]);
				break;    
			case 'vieworder':
				$this->	viewOrder($bw->input[2]);
				break;
			// don hang cua toi
			case 'mycart' :
				$this->myCart ();
				break;
			case 'deletemycart' :
				$this->deleteMyCart($bw->input[2]);
				break;
			default :
				$this->cartSummary ();
		}
	}

	function newOrder(){
            global $bw,$vsUser,$vsLang,$vsPrint,$DB,$vsStd;
			$security = $bw->input ['userSecurity'];
			$vsStd->requireFile ( ROOT_PATH . "vscaptcha/VsCaptcha.php" );
			$image = new VsCaptcha();
			if (! $image->check ( $security )) {
				$bw->input['message'] = $vsLang->getWords('thank_message','Security code doesnot match');
				return $this->billName();
			}
            if(!count($this->item)){
                $vsPrint->redirect_screen($vsLang->getWords('no_products','Không có sản phẩm trong giỏ hàng'),'products/');
                return;
            }
            $this->getObjectsItem();
            if($vsUser){
                $info = $vsUser->obj->getArrayInfo();
                $this->model->obj->setUserId($vsUser->obj->getId());
            }
            
            $this->model->obj->convertToObject($bw->input);
        
            $this->model->obj->setPostDate(time());
            $this->model->obj->setTotal($this->total);
            $id = $this->model->insertObject($this->model->obj);
    
			// cap nhat so luot mua san pham 
            /*$vsStd->requireFile(CORE_PATH."products/products.php");
			$product = new products();
			foreach ($this->item as $val) {
				$product->setCondition("productId = {$val['productId']}");
				$obj_pro = $product->getOneObjectsByCondition();
				$obj_pro->setView($obj_pro->getView()+1);
				$product->updateObjectById($obj_pro);
			}*/
	
            if ($this->model->result) {
                global  $DB;
                    $this->orderProccess ( $this->model->obj->getId());
                    $message = sprintf($vsLang->getWords("order_add_success","Ä�Æ¡n hÃ ng Ä‘Æ°á»£c táº¡o thÃ nh cÃ´ng"),$this->model->obj->getName());
            }

            
            $this->viewOrder($this->model->obj->getId(),$message);
	}


	function billName(){
		global $vsUser,$bw,$vsPrint,$vsLang;
//                if(!$vsUser->obj->getId())
//			$vsPrint->redirect_screen($vsLang->getWords('global_checkout_message','Ä�á»ƒ thá»±c hiá»‡n checkOut báº¡n pháº£i Ä‘Äƒng nháº­p'),'users/login-form');
//		$this->model->setCondition("userId = {$vsUser->obj->getId()} AND orderSeri IS NULL");
//		$option['listorder'] = $this->model->getObjectsByCondition();
		
	$option['orderItem'] = $this->getObjectsItem();
	          	$option['total'] =  number_format($this->total ,0,"",",");
	          	$option['opt'] = array();
	           	if($this->item){
	           		$ids = array_keys($this->item);
	           		foreach ($ids as $index=>$value) {
	           			$value=explode("_", $value);
	           			$ids[$index]=$value[0];
	           		}
	              	$stringid = implode(",", $ids);
	           	}
		$this->output = $this->html->billName($option);
	}

	function viewOrder($id=0,$message=""){
		global $bw,$vsUser,$vsTemplate,$vsLang,$vsStd,$vsSettings,$vsMenu;
               
    	
     	$this->model->orderitems->setCondition("orderId in ({$id})");
      	$this->model->orderitems->getObjectsByCondition();
      
       	$option['pageList'] = $this->model->orderitems->getArrayObj();
       	
       	$te =0 ;
      	foreach($option['pageList'] as $obj)
        	$te += $obj->getTotals(false);
		$option['message']= $message;
    	$option['total'] = number_format($te ,0,"",",");
 
    	$this->model->setCondition("orderId in ({$id})");
    	$option['order'] = $this->model->getOneObjectsByCondition();
    		
       	if(!$option['order'])  
        	return $this->output = $this->html->viewOrder($option);
        	
     	$htmlsendemail =  $this->html->viewSendEmail($option);
     	$vsStd->requireFile ( LIBS_PATH . "Email.class.php", true );
		$this->email = new Emailer ();

   		$this->email->setTo ($bw->input['orderEmail']);
   		$this->email->addBCC($vsSettings->getSystemKey("contact_emailrecerver", "sangpm@vietsol.net", $bw->input['module']));
		$this->email->setFrom ($vsSettings->getSystemKey("contact_emailrecerver", "sangpm@vietsol.net", $bw->input['module']),$bw->vars['global_websitename']);
		$this->email->setSubject ($bw->vars['global_websitename']." - ". $vsLang->getWordsGlobal('global_xacnhandonhang','XÃ¡c nháº­n Ä‘Æ¡n hÃ ng') );
		$this->email->setBody ( $htmlsendemail );		
               
		$this->email->sendMail ();
                

    	$this->output = $this->html->viewOrder($option);
	}


	function loadDefault($message = ""){
		global $vsPrint,$vsLang;
		
		$cartHtml = $this->cartSummary();
		$this->output = $this->html->mainHtml($cartHtml,$message);
	}


	function orderProccess($OrderID) {
		global $vsStd, $bw,$vsLang;
		
		if(!count($this->objItems)) return ;
                    foreach($this->objItems as $obj){
                        $obj->setOrderId($OrderID);
                         $obj->setStatus(0);
                        $this->model->orderitems->insertObject($obj);
                    }
        $this->item = array();
      	$this->saveItemstoSession();
	}

	function cartSummary() {
		global $vsPrint;

                $option['orderItem'] = $this->getObjectsItem();
   				$option['total1']= $this->total;
                $option['total'] =  number_format($this->total ,0,"",",");
                $option['opt'] = array();
                if($this->item){
                    $ids = array_keys($this->item);
                foreach ($ids as $index=>$value) {
	           			$value=explode("_", $value);
	           			$ids[$index]=$value[0];
	           		}
                    $stringid = implode(",", $ids);
                    
//                    $this->option->setCondition("productId in ({$stringid}) ");
//                    $option['opt'] = $this->option->getObjectsByCondition('getProductId',1);
                }
   
		return $this->output = $this->html->cartSummary ($option) ;

	}

// get 1 products from id
	function getProductArray($id) {
		global $bw, $DB,$vsPrint;
		$this->products->setFieldsString("productId,productTitle,productPrice,productHotPrice,productImage,productModule");
		$obj = $this->products->getObjectById($id);
		return $obj->convertOrderItem();
	}
 //save list Item to session  
        
        function saveItemstoSession(){
            $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'] = $this->item;
           
        }
// láº¥y array sessionItem to ObjecItems        
        function getObjectsItem(){
           
            if(!$this->item) return array();
            $this->total = 0;
           
            require_once(CORE_PATH."orders/OrderItem.class.php");
                foreach ($this->item as $key => $val){
                    $orderItem = new OrderItem();
                    $orderItem->convertToObject($val);
                    $this->total += $orderItem->getTotals(false);
                    $this->objItems[$key] = $orderItem;
                }
            return $this->objItems;
        }
        

	function addtocart($idP,$type) {
		global $bw, $vsPrint,$vsLang,$vsTemplate;

		if(is_numeric($idP)){
                    if($this->item[$idP."_".$type]){
                        $this->item[$idP."_".$type]['itemQuantity'] +=  1;
                    }else{
                        $item = $this->getProductArray ( $idP );
                        $this->item[$idP."_".$type] = $item;
                    }
                    $this->total += $this->item[$idP."_".$type]['itemPrice'];
            
                $message = sprintf($vsLang->getWords("order_communicate","Sản phẩm [%s] vừa được thêm vào giỏ hàng."),$this->item[$idP."_".$type]['itemTitle']);   
                $this->saveItemstoSession();
		}else 	$message = $vsLang->getWords('order_messages_none','Sản phẩm này không tồn tại.');

		return $this->output = $this->html->orderLoading($message);

	}

	function updateCart() {
		global $bw,$vsStd,$vsLang,$vsTemplate,$_POST,$vsPrint,$vsUser;
                
//                $ids = array_keys($this->item);
//                $stringid = implode(",", $ids);
//                $this->option->setCondition("productId in ({$stringid}) ");
//                $option = $this->option->getObjectsByCondition();
//     
				$option = array();    
			  foreach($this->item as $key => $val){

                    if($_POST['price'][$key]){
                        if($option[$_POST['price'][$key]]){
                            $this->item[$key]['itemPrice'] = $option[$_POST['price'][$key]]->getPrice(false);
                            $this->item[$key]['itemType']  = $option[$_POST['price'][$key]]->getTitle();
                        }
                    }
                    
                    if($_POST['cart'][$key])
                        if($this->item[$key]){
                            if($_POST['cart'][$key]==0)unset($this->item[$key]);
                            else $this->item[$key]['itemQuantity'] = $_POST['cart'][$key];
                        }
                }

			$message=$vsLang->getWords('update_succes','Giá»� hÃ ng Ä‘Ã£ cáº­p nháº­t thÃ nh cÃ´ng!');
          	$this->saveItemstoSession();
          	if($bw->input['actionUpdate'] == 'bill'){
				$option['orderItem'] = $this->getObjectsItem();
	          	$option['total'] =  number_format($this->total ,0,"",",");
	          	$option['opt'] = array();
	           	if($this->item){
	           		$ids = array_keys($this->item);
	           		foreach ($ids as $index=>$value) {
	           			$value=explode("_", $value);
	           			$ids[$index]=$value[0];
	           		}
	              	$stringid = implode(",", $ids);
//	               	$this->option->setCondition("productId in ({$stringid}) ");
//	               	$option['opt'] = $this->option->getObjectsByCondition('getProductId',1);
	         	}
	         	$this->output = $this->html->billName($option);
          	}
          	elseif($bw->input['actionUpdate'] == 'cont'){
          		$this->buyContinue();
          	}
          	//$this->cartSummary($message);

	}

	function deleteCart($list) {
		global $bw,$vsTemplate,$_POST ,$vsLang;
		
		$arr = explode(",", $list);
                    foreach($arr as $va){
                        if($this->item[$va])unset($this->item[$va]);
                    }
		$this->saveItemstoSession();
                 $message = $vsLang->getWords ( 'order_delete', 'Xóa sản phẩm thành công' );
		$this->loadDefault($message);
	}

	
	function buyContinue() {
		global $bw;
		$javascript = <<<EOF
						<script type='text/javascript'>
					setTimeout('delayer()', 500);
					function delayer(){
	    				window.location = "{$bw->base_url}products.html";
					}
				</script>
EOF;
		return $this->output = $javascript;
		
	}
	
	function myCart(){
		global $bw,$vsUser,$vsTemplate,$vsLang,$vsStd,$vsSettings,$vsMenu;
               
    	$this->model->setCondition("userId in ({$vsUser->obj->getId()})");
    	$usercart = $this->model->getObjectsByCondition();
    	$ids = array_keys($usercart);
    	$ids?$strIds .= implode(",",$ids):$strIds .= implode(",",$ids);
  
       	if(!$usercart)  
        	return $this->output = $this->html->viewMyOrder($option);
      
        	$this->model->orderitems->setCondition("orderId in ({$strIds})");
      		$option = $this->model->orderitems->getPageList("orders/mycart/",2,10);
       		//$option = $this->model->orderitems->getArrayObj();
       
    
    	$this->output = $this->html->viewMyOrder($option);
	}
	
	function deleteMyCart($list) {
		global $bw,$vsTemplate,$_POST ,$vsLang;
		
		
		$this->model->orderitems->setCondition("itemId IN (".$list .")");
		
		if(!$this->model->orderitems->deleteObjectByCondition()) return false;
		$this->myCart();
	}

}
?>