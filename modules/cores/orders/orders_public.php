<?php

if (! defined ( 'IN_VSF' )) {
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit ();
}

global $vsStd;
$vsStd->requireFile ( CORE_PATH . "orders/orders.php" );

class orders_public {
	protected $html;
	protected $module;
	protected $output;
	private $textbooks;
	
	function __construct() {
		global $vsTemplate, $vsStd, $vsPrint;
		$vsStd->requireFile ( CORE_PATH . "textbooks/textbooks.php" );
		$vsPrint->addCSSFile("orders");
		
		$this->html = $vsTemplate->load_template('skin_orders');
		$this->module = new orders();
		
		$this->textbooks = new textbooks();
	}

	
	public function getOutput() {
		return $this->output;
	}
	
	function auto_run() {
		global $bw,$vsSess;
		switch ($bw->input [1]) {
			case 'summary' :
				$this->orderSummary ();
				break;
			case 'info' :
				$this->orderInfo ();
				break;
			case 'cartsummary' :
				$this->cartSummary ();
				break;
			case 'addtocart' :
				$this->addtocart ();
				break;
			case 'updatecart' :
				$this->updateCart ();
				break;
			case 'deletecart' :
				$this->deleteCart ();
				break;
			case 'successorder' :
				$this->successOrder ();
				break;
			case 'payment' :
				$this->payment ();
				break;
			case 'deleteallcart':
					unset($_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']]['cart']);
			default :
					$this->loadDefault ();
				break;
				
				
			case 'transaction':
					$this->transaction();
				break;	
				
			case 'updateItem':
					$this->updateItem($bw->input[2]);
				break;
				
			case 'runout':
					$this->runout($bw->input[2], $bw->input[3]);
				break;
		}
	}

	
	
	function runout($itemId = 0, $bookId = 0){
		global $vsLang, $vsStd;

		$bookMessage = $this->textbooks->updateBook($bookId, 0, "");
		$this->updateItem_RUNOUT($bookId);
		
		
		return $this->transaction();
		$message = $vsLang->getWords('update_item_fail','Error! This order is not updated.');
		if($this->module->orderitem->result['status']) $message = $vsLang->getWords('update_item_successful','This order is updated.');
		return $this->output = $this->html->updateItem($bookMessage."<br />".$message);
	}
	
	function updateItem_RUNOUT($bookId = ""){
		global $vsLang;
		$condition = 'bookId = '.$bookId.' AND itemStatus = 0';
		$this->module->orderitem->setCondition($condition);
		$this->orderitem->setGroup('orderId');
		$items = $this->orderitem->getObjectsByCondition();
		$orderIds = implode(",", $items);
		$this->setCondition('orderId in ('.$orderIds.")");
		$orders = $this->getObjectsByCondition();
		
		$this->module->orderitem->setCondition($condition);
		$this->module->orderitem->updateObjectByCondition(array('itemStatus'=>-1));
		
		$first = reset($items);
		$bookTitle = $first->getTitle();
		$this->sendMailToTheOrder_RUNOUT($bookTitle, $orders);
			
		
		if($this->module->orderitem->result['status']) return $vsLang->getWords('update_item_successful','This order is updated.');
		return $vsLang->getWords('update_item_fail','Error! This order is not updated.');		
	}
	
	
	
	function updateItem($itemId = 0, $status = 1, $condition = ""){
		global $vsLang;
		$this->module->orderitem->setCondition('itemId = '.$itemId.$condition);
		$this->module->orderitem->updateObjectByCondition(array('itemStatus'=>$status));
		
		$message = $vsLang->getWords('update_item_fail','Error! This order is not updated.');
		if($this->module->orderitem->result['status']) $message = $vsLang->getWords('update_item_successful','This order is updated.');
		return $this->output = $this->html->updateItem($message);
	}
	
	function transaction(){
		global $bw, $vsStd, $vsUser;
		$url = "orders/transaction/";
		$size = 2; $index = 2;
		
		$option = $this->module->getItemByUserId($vsUser->obj->getId(), $url, $size, $index);
		
		$option['leftHTML'] = $this->html->leftSubject($this->textbooks->getSubjectList());
		$this->output = $this->html->transaction($option);
	}
	
	function loadDefault(){
		global $vsStd;
		
		$cartHtml = $this->cartSummary();
		$option['leftHTML'] = $this->html->leftSubject($this->textbooks->getSubjectList());
		$this->output = $this->html->mainHtml($cartHtml, $option);
	}
	
	function payment() {
		global $vsPrint, $vsLang, $bw, $vsUser;
//		if(!$vsUser->obj->getId()) return $this->output = $this->html->login();
		$option['leftHTML'] = $this->html->leftSubject($this->textbooks->getSubjectList());
		switch ($bw->input[2]){
			case 'accept':
					$this->orderInfo($option);
				break;
			case 'cancel':
				unset($_SESSION[APPLICATION_TYPE]['obj']);
				unset($_SESSION[APPLICATION_TYPE]['groups']);
				$_SESSION[APPLICATION_TYPE]['session']['userId']=0;
				$vsPrint->boink_it($bw->base_url."orders/");
				break;
			default:
				if(!count($_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']]['cart']['item']))
					$this->cartSummary();
				$option['customer'] = $this->html->customerInfo();
				$this->output = $this->html->payment($option);
		}
	}
	
	function orderInfo() {
		global $bw, $DB,$vsUser;
		if(!count($_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']]['cart']['item']))
			return $this->cartSummary();				
		$time = time();
		$this->module->obj->setPostDate($time);
		$this->module->insertObject();
		if($this->module->result)
			$this->orderProccess($this->module->obj->getId(), $time);			

		$this->output = $this->html->loadMessage();
	}
	
	function orderProccess($orderId, $time) {
		global $vsStd, $bw,$vsLang;
		$cart = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart']['item'];
		
		
		$itemId = "";
		foreach( $cart  as $value ){
			$this->module->orderitem->obj->convertToObject($value);
			$this->module->orderitem->obj->setStatus(0);
			$this->module->orderitem->obj->setPostDate($time);
			$this->module->orderitem->obj->setOrderId($orderId);
			$this->module->orderitem->insertObject();
			$itemId .= $value['bookId'].","; 
		}
		
		$itemIds = trim($itemId,",");
				
		$this->updateBook($itemIds);
		
		$vsStd->requireFile(LIBS_PATH."Email.class.php");
		$this->sendEmailToOwner($itemIds);
		$this->sendMailToTheOrder($orderId);
		$_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['order'] = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'];
		unset ( $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'] );
		unset ($_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']]['cart']['count']);
	}
	
	function updateBook($bookIds = 0){
		$cart = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart']['item'];
		
		$this->textbooks->setCondition("bookId in (".$bookIds.")");
		$this->textbooks->getObjectsByCondition();
	
		if(!count($this->textbooks->getArrayObj())) return $this->loadDefault();
		$query = "UPDATE vsf_textbook SET bookSold = CASE bookId ";
		
		foreach($this->textbooks->getArrayObj() as $key=>$obj){
			$query .= " WHEN ".$key." THEN ".($obj->getSold() + $cart[$key]['itemQuantity'])." "; 
		}
		$query .= " END  WHERE bookId in (".$bookIds.")";
//sendMail;
		$this->textbooks->executeQuery($query);
	}
	
	function orderSummary() {
		global $vsPrint, $vsLang, $vsTemplate;
		$vsPrint->mainTitle = $vsLang->currentArrayWords ['main_title'];
		$money = 0;
		$cart = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['order'];
		
		foreach ( $cart as $value ) {
			$value ['button'] = $value ['itemQuantity'];
			$vsTemplate->assign_block_vars ( $value, 'CART_ITEM' );
			$money = $money + $value ['total'];
		}
		$vsTemplate->assign_var ( 'Total', number_format ( $money ) );
		$vsTemplate->assign_var ( 'message', $vsLang->currentArrayWords ['message'] );
		$vsTemplate->assign_vars_form_string ( $this->html->cartSummary ( 1 ), 'CART_CURRENT' );
		$vsTemplate->assign_vars_form_string ( $this->html->mainHtml () );
	}
	
	function sendEmailToOwner($bookIds){
		global $bw, $vsLang, $vsStd;		
		$vsStd->requireFile(CORE_PATH."users/users.php");
		

		foreach($this->textbooks->getArrayObj() as $obj){
			$array[$obj->getUserId()][] = $obj; 
		}
		$user = new users();
		$user->setCondition("userId in (".implode(',', array_keys($array)).")");
		$users = $user->getObjectsByCondition();
		
		$theOrder =  "<b>Name:</b>".$this->module->obj->getName()."<br />".
					 "<b>Email:</b>".$this->module->obj->getEmail()."<br />".
					 "<b>Phone:</b>".$this->module->obj->getPhone()."<br />".
					 "<b>Address:</b>".$this->module->obj->getAddress()."<br />";	

		$email = new Emailer();
		
		foreach($array as $element){
			$bookName = "";
			foreach($element as $book){	
				$bookName .= "<strong>".$book->getTitle()."</strong>(".$book->getAuthor().", ".$book->getEdition().", ".$book->getRelease().") <br />";
			}
			$message = sprintf($vsLang->getWords('the_owner_mail_message', '<strong>%s</strong> has ordered book(s). <br />Booking detail as below: <br />'), $bw->input ['orderName']);
			$message.= $bookName."<br />";
			$message.= "The order information as below:<br />".$theOrder;
			$message = $email->clean_message($message);
			$email->setTo($users[$obj->getUserId()]->getName());
			$email->setSubject($vsLang->getWords('the_order_mail_subject', 'Order Information'));
			$email->setBody($message);
			$email->sendMail();
		}
	}
	
	function sendMailToTheOrder($orderId){
		global $bw, $vsLang, $vsStd;
		
		if(!$theOrderEmails){
			$email = new Emailer();
			$message = sprintf($vsLang->getWords('the_order_mail_message', 'You (<strong>%s</strong>) has ordered book(s). <br />Detail at: %s'), $bw->input ['orderName'], $bw->vars['board_url']."/orders/".$orderId);
			$message = $email->clean_message($message);
			$email->setTo($bw->input['orderEmail']);
			$email->setSubject($vsLang->getWords('the_order_mail_subject', 'Order Information'));
			$email->setBody($message );
			$email->sendMail();
		}
	}

	function sendMailToTheOrder_RUNOUT($bookTitle = "", $theOrder=""){
		global $bw, $vsLang, $vsStd;

		if($theOrder){
			$email = new Emailer();
			foreach($theOrder as $element){
				$message = sprintf($vsLang->getWords('the_order_mail_message_runout', 'The <strong>%s</strong> you has ordered is runout now.'), $bookTitle);
				$message = $email->clean_message($message);
				$email->setSubject($vsLang->getWords('the_order_mail_subject', 'Order Information'));
				$email->setBody($message );
				$email->setTo($element->getEmail());
				$email->sendMail();
			}
		}
	}
	
	function sendMailToAdmin() {
		global $bw, $vsLang, $vsStd;
		
		$vsStd->requireFile(LIBS_PATH."Email.class.php");
		$bw->vars['order_mail'] = $bw->vars ['order_mail'] ? $bw->vars ['order_mail'] : $bw->vars ['global_systememail'];
		$email = new Emailer ( );
		$message = sprintf($vsLang->getWords('mail_message', '<strong>%s</strong> has ordered books. <br />Detail at: %s' ), $bw->input ['orderName'], $bw->vars ['board_url'] . "/admin.php?vs=orders/" );
		$message = $email->clean_message ( $message );
		$email->setTo ( $bw->vars['order_mail'] );
		$email->setSubject($vsLang->getWords('mail_subject', 'Order'));
		$email->setBody($message);
		$email->sendMail();
	}
	
	function successOrder() {
		global $vsPrint, $vsLang, $vsTemplate;
		$vsPrint->mainTitle = $vsPrint->pageTitle = $vsLang->getWords ( 'cart_maintitle', 'Giỏ hàng' );
		$cart = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['order'];
		if ($cart) {
			foreach ( $cart as $value ) {
				$money = $money + $value ['total'];
				$value ['total'] = number_format ( $value ['total'] );
				$vsTemplate->assign_block_vars ( $value, 'CART_ITEM' );
			}
			$vsTemplate->assign_var ( 'Total', number_format ( $money ) );
		}
		$mess['message']=$vsLang->getWords('successOrder','Bạn đã đặt hàng thành công!');
		$vsTemplate->assign_vars($mess);
		$vsTemplate->assign_vars_form_string ( $this->html->messageOrder () );
	}
	
	function cartSummary() {
		global $vsPrint;
		
		$itemCart['cart'] = $this->getCart();
		return $this->output = $this->html->cartSummary ($itemCart) ;
		
	}
	
	function getCart($message='') {
		global $vsTemplate,$vsLang;
		
		$cart = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'];
		$total = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['total'];
		
		if(!count($cart)) return "";
		return $this->html->ItemList($cart, $total);
	}
	
	function getProductArray($id) {
		global $bw, $DB, $vsPrint;
		$this->textbooks->getObjectById($id);
		
		if(!$this->textbooks->obj->getId()) $vsPrint->boink_it($_SERVER['HTTP_REFERER']);
		
		$item = array ( 'bookId' 			=> $this->textbooks->obj->getId(),
						'bookUserId' 		=> $this->textbooks->obj->getUserId(),
						'bookImage' 		=> $this->textbooks->obj->getImage(),
						'itemTitle'			=> $this->textbooks->obj->getTitle(),
						'itemPrice' 		=> $this->textbooks->obj->getPrice(),
						'itemNumberPrice' 	=> $this->textbooks->obj->getPrice(), 
						'itemTitle' 		=> $this->textbooks->obj->getTitle(),
						'itemImage' 		=> $this->textbooks->obj->getImage(),
						'itemQuantity' 		=> $bw->input[3]?$bw->input[3]:1, 
						'total' 			=> $this->textbooks->obj->getPrice()
						);
		$item['total'] = $item['total']*$item['itemQuantity'];
		return $item;
	}
	
	function addtocart() {
		global $bw, $vsPrint,$vsLang,$vsTemplate;
		
		if(is_numeric($bw->input [2])){
			$this->item = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'];
			$item = $this->getProductArray ( $bw->input [2] );
			
			$count = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['count'];
			$total = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['total'];

			$i = 0;
			if(is_array($this->item )){
				foreach($this->item as $key => $value){
					if ($value['bookId'] == $item ['bookId']) {
						$i ++;
						$this->item[$key]['itemQuantity'] = $value ['itemQuantity'] + 1;
						$this->item[$key]['total'] += $value ['itemPrice'];
						$total +=$value ['itemPrice'];
					}
				}
			}
			
			if(!$i){
				$count = $count + 1;
				$total += $item['total'];
				$this->item [$item['bookId']] = $item;
			}
			
			$_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'] = $this->item;
			$_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['count'] = $count;
			$_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['total'] = $total;
			$message = sprintf($vsLang->getWords("add_card_successfully","[%s] is added to your shopping cart."),$item['itemTitle']);
		} else $message = $vsLang->getWords('add_card_fail','error whiling add item to cart.');
		
		return $this->output = $this->html->orderLoading($message, $count);
	}
	
	function updateCart(){
		global $bw, $vsLang, $_POST;
	
		if(count($_POST['cart'])){
			$total = 0;
			$cart  = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'];
			$total = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['total'];
			
			foreach ( $_POST['cart']  as $key => $oValue ){
				if (isset ($cart[$key]['bookId'])){
					$update = $cart[$key]['itemPrice'] * ($oValue - $cart[$key]['itemQuantity']);
	
					$cart[$key]['itemQuantity'] = $oValue;
					$cart[$key]['total'] += $update;
					$total += $update;
				}
			}
			$message = $vsLang->getWords('update_successfully','Your cart is updated!');
			
			$_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'] = $cart;
			$_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['total'] = $total < 0 ? 0 : $total ;
		}
		
		$count = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['count'];
		return $this->output = $this->html->orderLoading($message, $count);
	}
	
	function deleteCart() {
		global $bw, $_POST, $vsLang;
		
		$cart = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'];
		$count = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['count'];
		$total = $_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['total'];
		
		foreach(explode(",", $_POST['checkedItem']) as $key){
			if (isset ($cart[$key])) {
			$total -= $cart[$key]['total'];
			$count --;
			unset($cart[$key]);
			
			if(!$cart[$key]) unset($cart[$key]);
			}
		}
				
		if($count==0) $total=0;
		$_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['count'] = $count;
		$_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'] = $cart;
		$_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['total'] = $total;
		
		$message = $vsLang->getWords('update_successfully','Your cart is updated!');
		$this->output = $this->cartSummary().$this->html->orderLoading($message, $count);
	}
}
?>