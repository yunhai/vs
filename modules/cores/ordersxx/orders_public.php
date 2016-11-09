<?php

if (! defined ( 'IN_VSF' )) {
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit ();
}

global $vsStd;

$vsStd->requireFile ( CORE_PATH . "orders/orders.php" );

$vsStd->requireFile(CORE_PATH."products/options.php");

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
		switch ($bw->input ['action']) {

			case 'cartsummary' :
				$this->cartSummary ();
				break;
			case 'addtocart' :
				$this->addtocart ($bw->input[2]);
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
				$this->output = $this->html->billName($option);
				break;    
			case 'neworder'	:
				$this->newOrder($bw->input[2]);
				break;    
			
			case 'vieworder':
				$this->	viewOrder($bw->input[2]);
                                
				break;

			
			default :
				$this->cartSummary ();
		}
	}

	function newOrder(){
            global $bw,$vsUser,$vsLang,$vsPrint;

            if(!count($this->item)){
                $vsPrint->redirect_screen($vsLang->getWords('no_products','Không có sản phẩm để tạo đơn hàng'),'products/');
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

            if ($this->model->result) {
                global  $DB;
                    $this->orderProccess ( $DB->get_insert_id());
                    $message = sprintf($vsLang->getWords("order_add_success","Đơn hàng được tạo thành công"),$this->model->obj->getName());
            }

            $this->viewOrder($this->model->obj->getId(),$message);
	}


	function billName(){
		global $vsUser,$bw,$vsPrint,$vsLang;

		$this->output = $this->html->billName($option);
	}

	function viewOrder($id=0,$message=""){
		global $bw,$vsUser,$vsPrint,$vsLang,$vsStd,$vsSettings;
               
    	$this->model->setCondition("orderId in ({$id})");
    	$option['order'] = $this->model->getOneObjectsByCondition();
       	if(!$option['order'])  
        	return $this->output = $this->html->viewOrder($option);
     	$this->model->orderitems->setCondition("orderId in ({$id})");
      	$this->model->orderitems->getObjectsByCondition();
       	$option['pageList'] = $this->model->orderitems->getArrayObj();
       	$te =0 ;
      	foreach($option['pageList'] as $obj)
        	$te += $obj->getTotals(false);
		$option['message']= $message;
    	$option['total'] = number_format($te ,0,"",",");
          		  
     	$htmlsendemail =  $this->html->viewSendEmail($option);
     	$vsStd->requireFile ( LIBS_PATH . "Email.class.php", true );
		$this->email = new Emailer ();

   		$this->email->setTo ($bw->input['orderEmail']);
   		$this->email->addBCC($vsSettings->getSystemKey("contact_emailrecerver", "sangpm@vietsol.net", $bw->input['module']));
		$this->email->setFrom ($vsSettings->getSystemKey("contact_emailrecerver", "sangpm@vietsol.net", $bw->input['module']),$bw->vars['global_websitename']);
		$this->email->setSubject ($bw->vars['global_websitename']." - ". $vsLang->getWordsGlobal('global_xacnhandonhang','Xác nhận đơn hàng') );
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
                        $this->model->orderitems->insertObject($obj);
                    }
                $this->item = array();
                $this->saveItemstoSession();
	}

	function cartSummary() {
		global $vsPrint;
                $option['orderItem'] = $this->getObjectsItem();
               
                $option['total'] =  number_format($this->total ,0,"",",");
                $option['opt'] = array();
                if($this->item){
                    $ids = array_keys($this->item);
                    $stringid = implode(",", $ids);
                    $this->option->setCondition("productId in ({$stringid}) ");
                    $option['opt'] = $this->option->getObjectsByCondition('getProductId',1);
                }
               
		return $this->output = $this->html->cartSummary ($option) ;

	}

// get 1 products from id
	function getProductArray($id) {
		global $bw, $DB,$vsPrint;
		$this->products->setFieldsString("productId,productTitle,productPrice,productImage");
		$obj = $this->products->getObjectById($id);
		return $obj->convertOrderItem();
	}
 //save list Item to session  
        
        function saveItemstoSession(){
            $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'] = $this->item;
           
        }
// lấy array sessionItem to ObjecItems        
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
        

	function addtocart($idP = 0) {
		global $bw, $vsPrint,$vsLang,$vsTemplate;

		if(is_numeric($idP)){
                    if($this->item[$idP]){
                        $this->item[$idP]['itemQuantity'] +=  1;
                    }else{
                        $item = $this->getProductArray ( $idP );
                        $this->item[$idP] = $item;
                    }
                    $this->total += $this->item[$idP]['itemPrice'];
                $message = sprintf($vsLang->getWords("order_communicate","Sản phẩm [%s] đã được thêm vào giỏ hàng."),$this->item[$idP]['itemTitle']);   
                $this->saveItemstoSession();
		}else 	$message = $vsLang->getWords('order_messages_none','Sản phẩm này không tồn tại.');

		return $this->output = $this->html->orderLoading($message);

	}

	function updateCart() {
		global $bw,$vsStd,$vsLang,$vsTemplate,$_POST ;
                
                $ids = array_keys($this->item);
                $stringid = implode(",", $ids);
                $this->option->setCondition("productId in ({$stringid}) ");
                $option = $this->option->getObjectsByCondition();
                
               
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

               
//		if($_POST['cart'])
//			foreach ( $_POST['cart']  as $key => $value )
//				if($this->item[$key]){
//                                    if($value==0)unset($this->item[$key]);
//                                    else $this->item[$key]['itemQuantity'] = $value;
//                                        
//				}
		$message=$vsLang->getWords('update_succes','Giỏ hàng đã cập nhật thành công!');
                $this->saveItemstoSession();
		$this->cartSummary($message);
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

//	function sendMail() {
//		global $bw, $vsLang, $vsStd;
//
//		$vsStd->requireFile ( LIBS_PATH . "Email.class.php" );
//		$bw->vars ['order_mail'] = $bw->vars ['order_mail'] ? $bw->vars ['order_mail'] : $bw->vars ['global_systememail'];
//		$email = new Emailer ( );
//		$message = sprintf ( $vsLang->getWords ( 'order_mail_message', 'Khách hàng <strong>%s</strong> đã đặt hàng. <br />Xem chi tiết: %s' ), $bw->input ['orderName'], $bw->vars ['board_url'] . "/admin.php?vs=orders/" );
//		$message = $email->clean_message ( $message );
//		$email->setTo ( $bw->vars ['order_mail'] );
//		$email->setSubject ( $vsLang->getWords ( 'order_subjectMail', 'Đơn đặt hàng' ) );
//		$email->setMessage ( $message );
//		$email->send_mail ();
//	}


}
?>