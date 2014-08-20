<?php

class skin_orders extends skin_objectpublic {
	
function reviewCart($message) {
		global $bw,$vsFile,$vsLang,$vsPrint;
		
		$this->total=0;
		$vsLang = VSFactory::getLangs ();
		
		$vsPrint->addCurentJavaScriptFile ('jquery.validate');
		
	//unset($_SESSION['vs_item_cart']);
		
		$BWHTML .= <<<EOF


<div class="content_mid">
		<div class="content_mid_title">{$this->catTitle}</div>

	
	<form class="thanhtoan"  method="POST" id="frthanhtoan">
		<table class="giohang" width="100%" border="0">
			<tr class="giohang_row1">
				<th class="col1">Tên sản phẩm </th>
				<th class="col3">Số lượng</th>
				<th class="col4">Đơn giá</th>
				<th class="col4">Tổng cộng</th>
			</tr>
			<foreach="$_SESSION['vs_item_cart'] as $index =>$item">
			
			<php> 
				$price = $item['saleOff']?$item['saleOff']:$item['price'];
				$this->tota=$price*$item['quantity'];
				$this->total += $this->tota; 
				
				</php>
			<tr id="c_$index" class="giohang_row2">
				<td class="col1"><div class="giohang_img">{$vsFile->obj->createImageCache($item['image'],80,84,1)}</div>
					<div class="giohang_sp">
						<h3>{$item['title']} </h3>
						<div class="clear"></div>
						<a href="javascript:void(0)" onclick="delCat('orders','$index')">Bỏ sản phẩm này</a> </div>
					<div class="clear_left"></div></td>
				<td class="col3"><input tyle="number" value="{$item['quantity']}" class="numeric" name="cart" onkeyup="upCat('$index',$(this).val())"  size="8"></td>
				<td class="col4"> {$this->numberFormat($price)} {$this->getLang()->getWords('currency','VNĐ')} </td>
				<td class="col4"> {$this->numberFormat($this->tota)} {$this->getLang()->getWords('currency','VNĐ')} </td>
			</tr>
			</foreach>
			
			<tr class="table_last">
				<td colspan="3" align="right">Thành tiền </td>
				<td style="font-weight:bold"> {$this->numberFormat($this->total,0)} {$this->getLang()->getWords('currency','VNĐ')} </td>
			</tr>
		</table>
		<div class="clear"></div>
		<div class="thanhtoan_title">Thông tin đặt hàng</div>
		<div class="thanhtoan_col1_center" >
			<p class="line">
				<label>Họ và tên<span>*</span></label>
				<input type="text" name="title" id="firstName" value="" />
				<span id="name-error" class="error">Vui lòng nhập tên đầy đủ!</span></p>
			<p class="line">
				<label>Số điện thoại <span>*</span></label>
				<input type="text" name="phone" id="phone" class="numeric" />
				<span id="phone-error" class="error">Vui lòng nhập số điện thoại!</span></p>
			<p class="line">
				<label>Email <span>*</span></label>
				<input type="text" name="email" id="email" />
				<span id="email-error" class="error">Vui lòng nhập địa chỉ email!</span></p>
			<p class="line">
				<label>Địa chỉ <span>*</span></label>
				<input type="text" name="address" id="address" />
				<span id="address-error" class="error">Vui lòng nhập địa chỉ!</span></p>
			<div class="clear_left"></div>
			<div class="thanhtoan_left">
			<p class="line">
				<label>Thông tin thêm</label>
				<textarea id="note" name="intro"></textarea>
			</p>

			<div class="clear"></div>
		</div>
		<input type="submit" value="Đặt hàng" class="btn_thanhtoan1" id="btPayment"/>
		<input type="hidden" name="ok" id="ok" value="1"/>
	</form>
</div>

</div>


<script>

function upCat(id,number){
	
	$.ajax({
		type : 'GET',
		url : baseUrl + 'orders/update/'+id+'/'+number+'',
		success : function(data) {
			if (data.status == 1) {
				window.location.reload(true);
			}
			window.location.reload();
		}
	});
}

$(document).ready(function(){
	$(".thanhtoan").validate({
		rules: {
			
			title: {
				required: true,
				minlength: 2,
				equalTo: "#firstName"
			},
			phone: {
				required: true,
				minlength: 2,
				equalTo: "#phone"
			},
			address: {
				required: true,
				equalTo: "#address"
			},
			email: {
				required: true,
				email: true,
				equalTo: "#email"
			},
			topic: {
				required: "#newsletter:checked",
				minlength: 2
			},
			agree: "required"
		},
		messages: {
			title: "Vui lòng nhập đầy đủ tiều đề !",
			phone: "Vui lòng nhập đầy đủ điện thoại !",
			email: "Vui lòng nhập đầy email !",
			address: "Vui lòng nhập địa chỉ !",
			email: "Vui lòng nhập địa chỉ email !",
			agree: "Please accept our policy !"
		}
	});

});



	function delCat(module,id){
		$.ajax({
			type : 'GET',
			dataType : 'json',
			url : baseUrl + 'orders/delete_item/'+id+'',
			success : function(data) {
				if (data.status == 1) {
					window.location.reload(true);
				}
			}
		});
	return false;
	}
</script>
		
		
		
EOF;
	}
	function paymentFinish($option = array()) {
		global $bw;
		$BWHTML .= <<<EOF
		<div id="contentWrap">
			<h3  class="title titleType1">{$this->getLang()->getWords($bw->input[0])}</h3>
			<div class="line"></div>
			
			<div id="content">
		<b style="font-size:14px;padding:30px 0;display:block">{$this->getLang()->getWords('payment_finish','Cảm ơn quý khách đã đặt hàng! Chúng tôi sẽ kiểm tra đơn hàng và liên hệ với quý khách trong thời gian sớm nhất!')}</b>
		</div></div>
		<script type='text/javascript'>
					setTimeout('delayers()', 5000);
					function delayers(){
	    				window.location = "{$bw->base_url}";
					}
				</script>
EOF;
	}
	function payment($option = array()) {
		global $bw,$vsUser,$vsFile;
		
		$BWHTML .= <<<EOF
		
EOF;
	}
	
	function address_payment($prefix=""){
		global $vsUser;
		
		$title= "Địa chỉ thanh toán";
		if($prefix) $title= "Địa chỉ giao hàng";
		
		$BWHTML .= <<<EOF
		<h3>Địa chỉ thanh toán</h3>
                
                	<label>Họ và tên<span>*</span></label>
	                <input type="text" name="{$prefix}title" id="{$prefix}firstName" value="{$vsUser->obj->getFirstName()}" />
	                <span id="{$prefix}name-error" class="error">Vui lòng nhập tên đầy đủ!</span>
                <label>Số điện thoại <span>*</span></label>
                <input type="text" name="{$prefix}phone" id="{$prefix}phone" class="numeric" />
					<span id="{$prefix}phone-error" class="error">Vui lòng nhập số điện thoại!</span>
                <label>Địa chỉ <span>*</span></label>
                <input type="text" name="{$prefix}address" id="{$prefix}address" /><span id="{$prefix}address-error" class="error">Vui lòng nhập địa chỉ!</span>
                <div class="clear_left"></div>
                <div class="thanhtoan_left">
                	<label>Thành phố/Tỉnh <span>*</span></label>
	                <select name="{$prefix}province[key]" id="{$prefix}address_region">
<option value="272">An Giang</option>
<option value="275">Bà Rịa - Vũng Tàu</option>
<option value="234">Bắc Giang</option>
<option value="233">Bắc Kạn</option>
<option value="276">Bạc Liêu</option>
<option value="235">Bắc Ninh</option>
<option value="277">Bến Tre</option>
<option value="273">Bình Dương</option>
<option value="274">Bình Phước</option>
<option value="278">Bình Thuận</option>
<option value="261">Bình Định</option>
<option value="279">Cà Mau</option>
<option value="280">Cần Thơ</option>
<option value="236">Cao Bằng</option>
<option value="262">Gia Lai</option>
<option value="238">Hà Giang</option>
<option value="239">Hà Nam</option>
<option value="232">Hà Nội</option>
<option value="240">Hà Tĩnh</option>
<option value="241">Hải Dương</option>
<option value="242">Hải Phòng</option>
<option value="283">Hậu Giang</option>
<option value="271">Hồ Chí Minh</option>
<option value="244">Hòa Bình</option>
<option value="243">Hưng Yên</option>
<option value="265">Khánh Hòa</option>
<option value="284">Kiên Giang</option>
<option value="264">Kon Tum</option>
<option value="246">Lai Châu</option>
<option value="286">Lâm Đồng</option>
<option value="247">Lạng Sơn</option>
<option value="245">Lào Cai</option>
<option value="285">Long An</option>
<option value="248">Nam Định</option>
<option value="249">Nghệ An</option>
<option value="250">Ninh Bình</option>
<option value="287">Ninh Thuận</option>
<option value="251">Phú Thọ</option>
<option value="266">Phú Yên</option>
<option value="267">Quảng Bình</option>
<option value="269">Quảng Nam </option>
<option value="270">Quảng Ngãi</option>
<option value="252">Quảng Ninh</option>
<option value="268">Quảng Trị</option>
<option value="288">Sóc Trăng</option>
<option value="253">Sơn La</option>
<option value="289">Tây Ninh</option>
<option value="254">Thái Bình</option>
<option value="255">Thái Nguyên</option>
<option value="256">Thanh Hóa</option>
<option value="263">Thừa Thiên Huế</option>
<option value="290">Tiền Giang</option>
<option value="291">Trà Vinh</option>
<option value="257">Tuyên Quang</option>
<option value="292">Vĩnh Long</option>
<option value="258">Vĩnh Phúc</option>
<option value="259">Yên Bái</option>
<option value="260">Đà Nẵng</option>
<option value="293">Đắk Lắk</option>
<option value="294">Đắk Nông</option>
<option value="237">Điện Biên</option>
<option value="281">Đồng Nai</option>
<option value="282">Đồng Tháp</option>
</select> 
<span id="{$prefix}region-error" class="error">Vui lòng chọn tỉnh/thành phố!</span>

                </div>
                <div class="thanhtoan_right">
                	<label>Quận <span>*</span></label>
	               <select name="{$prefix}city[key]" id="{$prefix}address_city">
</select><span id="{$prefix}city-error" class="error">Vui lòng chọn quận!</span>   
<input type="hidden" name="{$prefix}city[name]" id="{$prefix}city_name"/>
<input type="hidden" name="{$prefix}province[name]" id="{$prefix}province_name"/>           
                </div>
                <script type="text/javascript">
/* <![CDATA[ */
$('#{$prefix}address_region').prepend('<option value="">- Choose a Province</option>');
$('#{$prefix}address_region').val("");

    /**
     *
     * @param l - JSON object - list of all cities from Bob
     * @param regionId - region to select cities only
     * @param selected - pre-selected city id - after reload or in editing
     * @return {*} - string - generated options for attaching into the selectbox by jQuery
     */
    function createOptions(l, regionId, selected) {
        if(l) {
            t = '';
            for(var i in l) {
                if(l[i]['region'] == regionId) {
                    t += '<option value="' + l[i]['id'] +'"'+ (selected == l[i]['id'] ? 'selected="selected"' : '') +'>'+ l[i]['name'] +'</option>';
                }
            }
            return t;
        }
    }
    var citiesList = [{"id":"88","name":"A L\u01b0\u1edbi","region":"263"},{"id":"299","name":"An Bi\u00ean","region":"284"},{"id":"525","name":"An D\u01b0\u01a1ng","region":"242"},{"id":"70","name":"An Kh\u00ea","region":"262"},{"id":"526","name":"An L\u00e3o","region":"242"},{"id":"300","name":"An Minh","region":"284"},{"id":"59","name":"An Nh\u01a1n","region":"261"},{"id":"195","name":"An Ph\u00fa","region":"272"},{"id":"533","name":"\u00c2n Thi","region":"243"},{"id":"60","name":"An \u0111\u1ea3o","region":"261"},{"id":"587","name":"Anh S\u01a1n","region":"249"},{"id":"71","name":"Ayun Pa","region":"262"},{"id":"439","name":"Ba B\u1ec3","region":"233"},{"id":"632","name":"Ba Ch\u1ebf","region":"252"},{"id":"227","name":"B\u00e0 R\u1ecba","region":"275"},{"id":"3","name":"B\u00e1 Th\u01b0\u1edbc","region":"256"},{"id":"155","name":"Ba T\u01a1","region":"270"},{"id":"234","name":"Ba Tri","region":"277"},{"id":"420","name":"Ba V\u00ec","region":"232"},{"id":"409","name":"Ba \u0110\u00ecnh","region":"232"},{"id":"338","name":"B\u00e1c \u00c1i","region":"287"},{"id":"246","name":"B\u1eafc B\u00ecnh","region":"278"},{"id":"555","name":"B\u1eafc H\u00e0","region":"245"},{"id":"482","name":"B\u1eafc M\u00ea","region":"238"},{"id":"483","name":"B\u1eafc Quang","region":"238"},{"id":"570","name":"B\u1eafc S\u01a1n","region":"247"},{"id":"141","name":"B\u1eafc Tr\u00e0 My","region":"269"},{"id":"642","name":"B\u1eafc Y\u00ean","region":"253"},{"id":"527","name":"B\u1ea1ch Long V\u1ef9","region":"242"},{"id":"440","name":"B\u1ea1ch Th\u00f4ng","region":"233"},{"id":"461","name":"B\u1ea3o L\u1ea1c","region":"236"},{"id":"327","name":"B\u1ea3o L\u00e2m","region":"286"},{"id":"462","name":"B\u1ea3o L\u00e2m","region":"236"},{"id":"326","name":"B\u1ea3o L\u1ed9c","region":"286"},{"id":"553","name":"B\u1ea3o Th\u1eafng","region":"245"},{"id":"554","name":"B\u1ea3o Y\u00ean","region":"245"},{"id":"552","name":"B\u00e1t X\u00e1t","region":"245"},{"id":"206","name":"B\u1ebfn C\u00e1t","region":"273"},{"id":"360","name":"B\u1ebfn C\u1ea7u","region":"289"},{"id":"312","name":"B\u1ebfn L\u1ee9c","region":"285"},{"id":"242","name":"B\u1ebfn Tre","region":"277"},{"id":"270","name":"Bi\u00ean H\u00f2a","region":"281"},{"id":"1","name":"B\u1ec9m S\u01a1n","region":"256"},{"id":"569","name":"B\u00ecnh Gia","region":"247"},{"id":"509","name":"B\u00ecnh Giang","region":"241"},{"id":"631","name":"B\u00ecnh Li\u00eau","region":"252"},{"id":"211","name":"B\u00ecnh Long","region":"274"},{"id":"496","name":"B\u00ecnh L\u1ee5c","region":"239"},{"id":"380","name":"B\u00ecnh Minh","region":"292"},{"id":"156","name":"B\u00ecnh S\u01a1n","region":"270"},{"id":"381","name":"B\u00ecnh T\u00e2n","region":"292"},{"id":"262","name":"B\u00ecnh Th\u1ee7y","region":"280"},{"id":"35","name":"B\u00ecnh Xuy\u00ean","region":"258"},{"id":"235","name":"B\u00ecnh \u0110\u1ea1i","region":"277"},{"id":"124","name":"B\u1ed1 Tr\u1ea1ch","region":"267"},{"id":"215","name":"B\u00f9 Gia M\u1eadp","region":"274"},{"id":"213","name":"B\u00f9 \u0110\u0103ng","region":"274"},{"id":"214","name":"B\u00f9 \u0110\u1ed1p","region":"274"},{"id":"388","name":"Bu\u00f4n Ma Thu\u1ed9t","region":"293"},{"id":"391","name":"Bu\u00f4n \u0110\u00f4n","region":"293"},{"id":"364","name":"C\u00e1i B\u00e8","region":"290"},{"id":"371","name":"Cai L\u1eady","region":"290"},{"id":"255","name":"C\u00e1i N\u01b0\u1edbc","region":"279"},{"id":"263","name":"C\u00e1i R\u0103ng","region":"280"},{"id":"510","name":"C\u1ea9m Gi\u00e0ng,Gia L\u1ed9c","region":"241"},{"id":"613","name":"C\u1ea9m Kh\u00ea","region":"251"},{"id":"109","name":"Cam L\u00e2m","region":"265"},{"id":"55","name":"C\u1ea9m L\u1ec7","region":"260"},{"id":"129","name":"Cam L\u1ed9","region":"268"},{"id":"279","name":"C\u1ea9m M\u1ef9","region":"281"},{"id":"627","name":"C\u1ea9m Ph\u1ea3","region":"252"},{"id":"103","name":"Cam Ranh","region":"265"},{"id":"4","name":"C\u1ea9m Th\u1ee7y","region":"256"},{"id":"498","name":"C\u1ea9m Xuy\u00ean","region":"240"},{"id":"314","name":"C\u1ea7n Giu\u1ed9c","region":"285"},{"id":"499","name":"Can L\u1ed9c","region":"240"},{"id":"313","name":"C\u1ea7n \u0110\u01b0\u1edbc","region":"285"},{"id":"373","name":"C\u00e0ng Long","region":"291"},{"id":"281","name":"Cao L\u00e3nh","region":"282"},{"id":"573","name":"Cao L\u1ed9c","region":"247"},{"id":"543","name":"Cao Phong","region":"244"},{"id":"528","name":"C\u00e1t H\u1ea3i","region":"242"},{"id":"328","name":"C\u00e1t Ti\u00ean","region":"286"},{"id":"410","name":"C\u1ea7u Gi\u1ea5y","region":"232"},{"id":"374","name":"C\u1ea7u K\u00e8","region":"291"},{"id":"377","name":"C\u1ea7u Ngang","region":"291"},{"id":"196","name":"Ch\u00e2u Ph\u00fa","region":"272"},{"id":"358","name":"Ch\u00e2u Th\u00e0nh","region":"289"},{"id":"315","name":"Ch\u00e2u Th\u00e0nh","region":"285"},{"id":"369","name":"Ch\u00e2u Th\u00e0nh","region":"290"},{"id":"292","name":"Ch\u00e2u Th\u00e0nh","region":"283"},{"id":"236","name":"Ch\u00e2u Th\u00e0nh","region":"277"},{"id":"197","name":"Ch\u00e2u Th\u00e0nh","region":"272"},{"id":"282","name":"Ch\u00e2u Th\u00e0nh","region":"282"},{"id":"376","name":"Ch\u00e2u Th\u00e0nh","region":"291"},{"id":"301","name":"Ch\u00e2u Th\u00e0nh","region":"284"},{"id":"347","name":"Ch\u00e2u Th\u00e0nh","region":"288"},{"id":"293","name":"Ch\u00e2u Th\u00e0nh A","region":"283"},{"id":"193","name":"Ch\u00e2u \u0110\u1ed1c","region":"272"},{"id":"222","name":"Ch\u00e2u \u0110\u1ee9c","region":"275"},{"id":"572","name":"Chi L\u0103ng","region":"247"},{"id":"508","name":"Ch\u00ed Linh","region":"241"},{"id":"28","name":"Chi\u00eam H\u00f3a","region":"257"},{"id":"368","name":"Ch\u1ee3 G\u1ea1o","region":"290"},{"id":"237","name":"Ch\u1ee3 L\u00e1ch","region":"277"},{"id":"198","name":"Ch\u1ee3 M\u1edbi","region":"272"},{"id":"438","name":"Ch\u1ee3 M\u1edbi","region":"233"},{"id":"441","name":"Ch\u1ee3 \u0110\u1ed3n","region":"233"},{"id":"216","name":"Ch\u01a1n Th\u00e0nh","region":"274"},{"id":"72","name":"Ch\u01b0 Pak","region":"262"},{"id":"73","name":"Ch\u01b0 Prong","region":"262"},{"id":"85","name":"Ch\u01b0 Puh","region":"262"},{"id":"74","name":"Ch\u01b0 S\u00ea","region":"262"},{"id":"421","name":"Ch\u01b0\u01a1ng M\u1ef9","region":"232"},{"id":"633","name":"C\u00f4 T\u00f4","region":"252"},{"id":"267","name":"C\u1edd \u0110\u1ecf","region":"280"},{"id":"130","name":"C\u1ed3n C\u1ecf","region":"268"},{"id":"588","name":"Con Cu\u00f4ng","region":"249"},{"id":"224","name":"C\u00f4n \u0110\u1ea3o","region":"275"},{"id":"402","name":"C\u01b0 J\u00fat","region":"294"},{"id":"345","name":"C\u00f9 Lao Dung","region":"288"},{"id":"392","name":"C\u01b0 M'gar","region":"293"},{"id":"585","name":"C\u1eeda L\u00f2","region":"249"},{"id":"207","name":"D\u1ea7u Ti\u1ebfng","region":"273"},{"id":"205","name":"D\u0129 An","region":"273"},{"id":"329","name":"Di Linh","region":"286"},{"id":"589","name":"Di\u1ec5n Ch\u00e2u","region":"249"},{"id":"106","name":"Di\u00ean Kh\u00e1nh","region":"265"},{"id":"518","name":"D\u01b0\u01a1ng Kinh","region":"242"},{"id":"357","name":"D\u01b0\u01a1ng Minh Ch\u00e2u","region":"289"},{"id":"492","name":"Duy Ti\u00ean","region":"239"},{"id":"153","name":"Duy Xuy\u00ean","region":"269"},{"id":"379","name":"Duy\u00ean H\u1ea3i","region":"291"},{"id":"389","name":"Ea H'leo","region":"293"},{"id":"395","name":"Ea Kar","region":"293"},{"id":"390","name":"Ea So\u00fap","region":"293"},{"id":"455","name":"Gia B\u00ecnh","region":"235"},{"id":"401","name":"Gia Ngh\u0129a","region":"294"},{"id":"231","name":"Gi\u00e1 Rai","region":"276"},{"id":"606","name":"Gia Vi\u1ec5n","region":"250"},{"id":"576","name":"Giao Th\u1ee7y","region":"248"},{"id":"132","name":"Gio Linh","region":"268"},{"id":"302","name":"Gi\u1ed3ng Ri\u1ec1ng","region":"284"},{"id":"238","name":"Gi\u1ed3ng Tr\u00f4m","region":"277"},{"id":"365","name":"G\u00f2 C\u00f4ng","region":"290"},{"id":"367","name":"G\u00f2 C\u00f4ng T\u00e2y","region":"290"},{"id":"366","name":"G\u00f2 C\u00f4ng \u0110\u00f4ng","region":"290"},{"id":"361","name":"G\u00f2 D\u1ea7u","region":"289"},{"id":"303","name":"G\u00f2 Quao","region":"284"},{"id":"615","name":"H\u1ea1 H\u00f2a","region":"251"},{"id":"463","name":"H\u1ea1 Lang","region":"236"},{"id":"624","name":"H\u1ea1 Long","region":"252"},{"id":"464","name":"H\u00e0 Qu\u1ea3ng","region":"236"},{"id":"298","name":"H\u00e0 Ti\u00ean","region":"284"},{"id":"6","name":"H\u00e0 Trung","region":"256"},{"id":"412","name":"H\u00e0 \u0110\u00f4ng","region":"232"},{"id":"520","name":"H\u1ea3i An","region":"242"},{"id":"413","name":"Hai B\u00e0 Tr\u01b0ng","region":"232"},{"id":"50","name":"H\u1ea3i Ch\u00e2u","region":"260"},{"id":"635","name":"H\u1ea3i H\u00e0","region":"252"},{"id":"577","name":"H\u1ea3i H\u1eadu","region":"248"},{"id":"133","name":"H\u1ea3i L\u0103ng","region":"268"},{"id":"250","name":"H\u00e0m T\u00e2n","region":"278"},{"id":"247","name":"H\u00e0m Thu\u1eadn B\u1eafc","region":"278"},{"id":"248","name":"H\u00e0m Thu\u1eadn Nam","region":"278"},{"id":"29","name":"H\u00e0m Y\u00ean","region":"257"},{"id":"7","name":"H\u1eadu L\u1ed9c","region":"256"},{"id":"447","name":"Hi\u1ec7p H\u00f2a","region":"234"},{"id":"146","name":"Hi\u1ec7p \u0110\u1ee9c","region":"269"},{"id":"465","name":"H\u00f2a An","region":"236"},{"id":"233","name":"H\u00f2a B\u00ecnh","region":"276"},{"id":"607","name":"Hoa L\u01b0","region":"250"},{"id":"359","name":"H\u00f2a Th\u00e0nh","region":"289"},{"id":"56","name":"H\u00f2a Vang","region":"260"},{"id":"61","name":"Ho\u00e0i \u00c2n","region":"261"},{"id":"62","name":"Ho\u00e0i Nh\u01a1n","region":"261"},{"id":"414","name":"Ho\u00e0n Ki\u1ebfm","region":"232"},{"id":"8","name":"Ho\u1eb1ng H\u00f3a","region":"256"},{"id":"415","name":"Ho\u00e0ng Mai","region":"232"},{"id":"57","name":"Ho\u00e0ng Sa","region":"260"},{"id":"484","name":"Ho\u00e0ng Su Ph\u00ec","region":"238"},{"id":"636","name":"Ho\u00e0nh B\u1ed3","region":"252"},{"id":"138","name":"H\u1ed9i An","region":"269"},{"id":"218","name":"H\u1edbn Qu\u1ea3n","region":"274"},{"id":"304","name":"H\u00f2n \u0110\u1ea5t","region":"284"},{"id":"522","name":"H\u1ed3ng B\u00e0ng","region":"242"},{"id":"229","name":"H\u1ed3ng D\u00e2n","region":"276"},{"id":"497","name":"H\u1ed3ng L\u0129nh","region":"240"},{"id":"283","name":"H\u1ed3ng Ng\u1ef1","region":"282"},{"id":"649","name":"H\u01b0ng H\u00e0","region":"254"},{"id":"591","name":"H\u01b0ng Nguy\u00ean","region":"249"},{"id":"134","name":"H\u01b0\u1edbng H\u00f3a","region":"268"},{"id":"501","name":"H\u01b0\u01a1ng Kh\u00ea","region":"240"},{"id":"502","name":"H\u01b0\u01a1ng S\u01a1n","region":"240"},{"id":"86","name":"H\u01b0\u01a1ng Th\u1ee7y","region":"263"},{"id":"87","name":"H\u01b0\u01a1ng Tr\u00e0","region":"263"},{"id":"571","name":"H\u1eefu L\u0169ng","region":"247"},{"id":"424","name":"Huy\u1ec7n Gia L\u00e2m","region":"232"},{"id":"425","name":"Huy\u1ec7n Ho\u00e0i \u0110\u1ee9c","region":"232"},{"id":"426","name":"Huy\u1ec7n M\u00ea Linh","region":"232"},{"id":"427","name":"Huy\u1ec7n M\u1ef9 \u0110\u1ee9c","region":"232"},{"id":"428","name":"Huy\u1ec7n Ph\u00fa Xuy\u00ean","region":"232"},{"id":"429","name":"Huy\u1ec7n Ph\u00fac Th\u1ecd","region":"232"},{"id":"430","name":"Huy\u1ec7n Qu\u1ed1c Oai","region":"232"},{"id":"431","name":"Huy\u1ec7n S\u00f3c S\u01a1n","region":"232"},{"id":"432","name":"Huy\u1ec7n Th\u1ea1ch Th\u1ea5t","region":"232"},{"id":"433","name":"Huy\u1ec7n Thanh Oai","region":"232"},{"id":"434","name":"Huy\u1ec7n Thanh Tr\u00ec","region":"232"},{"id":"435","name":"Huy\u1ec7n Th\u01b0\u1eddng T\u00edn","region":"232"},{"id":"436","name":"Huy\u1ec7n T\u1eeb Li\u00eam","region":"232"},{"id":"437","name":"Huy\u1ec7n \u1ee8ng H\u00f2a","region":"232"},{"id":"422","name":"Huy\u1ec7n \u0110an Ph\u01b0\u1ee3ng","region":"232"},{"id":"423","name":"Huy\u1ec7n \u0110\u00f4ng Anh","region":"232"},{"id":"80","name":"K'Bang","region":"262"},{"id":"346","name":"K\u1ebf S\u00e1ch","region":"288"},{"id":"108","name":"Kh\u00e1nh S\u01a1n","region":"265"},{"id":"107","name":"Kh\u00e1nh Vinh","region":"265"},{"id":"534","name":"Kho\u00e1i Ch\u00e2u","region":"243"},{"id":"546","name":"K\u00ec S\u01a1n","region":"244"},{"id":"521","name":"Ki\u1ebfn An","region":"242"},{"id":"305","name":"Ki\u00ean H\u1ea3i","region":"284"},{"id":"306","name":"Ki\u00ean L\u01b0\u01a1ng","region":"284"},{"id":"529","name":"Ki\u1ebfn Th\u1ee5y","region":"242"},{"id":"650","name":"Ki\u1ebfn X\u01b0\u01a1ng","region":"254"},{"id":"493","name":"Kim B\u1ea3ng","region":"239"},{"id":"545","name":"Kim B\u00f4i","region":"244"},{"id":"610","name":"Kim S\u01a1n","region":"250"},{"id":"511","name":"Kim Th\u00e0nh","region":"241"},{"id":"535","name":"Kim \u0110\u1ed9ng","region":"243"},{"id":"512","name":"Kinh M\u00f4n","region":"241"},{"id":"97","name":"Kon Plong","region":"264"},{"id":"98","name":"Kon R\u1eaby","region":"264"},{"id":"81","name":"Kong Chro","region":"262"},{"id":"399","name":"Kr\u00f4ng Ana","region":"293"},{"id":"397","name":"Kr\u00f4ng B\u00f4ng","region":"293"},{"id":"393","name":"Kr\u00f4ng B\u00fak","region":"293"},{"id":"394","name":"Kr\u00f4ng N\u0103ng","region":"293"},{"id":"407","name":"Kr\u00f4ng N\u00f4","region":"294"},{"id":"82","name":"Krong Pa","region":"262"},{"id":"398","name":"Kr\u00f4ng P\u1eafc","region":"293"},{"id":"503","name":"K\u1ef3 Anh","region":"240"},{"id":"593","name":"K\u1ef3 S\u01a1n","region":"249"},{"id":"244","name":"La Gi","region":"278"},{"id":"78","name":"La Grai","region":"262"},{"id":"79","name":"La Pa","region":"262"},{"id":"334","name":"L\u1ea1c D\u01b0\u01a1ng","region":"286"},{"id":"547","name":"L\u1ea1c S\u01a1n","region":"244"},{"id":"548","name":"L\u1ea1c Th\u1ee7y","region":"244"},{"id":"284","name":"Lai Vung","region":"282"},{"id":"400","name":"L\u1eafk","region":"293"},{"id":"33","name":"L\u00e2m B\u00ecnh","region":"257"},{"id":"335","name":"L\u00e2m H\u00e0","region":"286"},{"id":"616","name":"L\u00e2m Thao","region":"251"},{"id":"9","name":"Lang Ch\u00e1nh","region":"256"},{"id":"451","name":"L\u1ea1ng Giang","region":"234"},{"id":"36","name":"L\u1eadp Th\u1ea1ch","region":"258"},{"id":"285","name":"L\u1ea5p V\u00f2","region":"282"},{"id":"524","name":"L\u00ea Ch\u00e2n","region":"242"},{"id":"126","name":"L\u1ec7 Th\u1ee7y","region":"267"},{"id":"54","name":"Li\u00ean Chi\u1ec3u","region":"260"},{"id":"574","name":"L\u1ed9c B\u00ecnh","region":"247"},{"id":"507","name":"L\u1ed9c H\u00e0","region":"240"},{"id":"219","name":"L\u1ed9c Ninh ","region":"274"},{"id":"416","name":"Long Bi\u00ean","region":"232"},{"id":"382","name":"Long H\u1ed3","region":"292"},{"id":"271","name":"Long Kh\u00e1nh","region":"281"},{"id":"294","name":"Long M\u1ef9","region":"283"},{"id":"353","name":"Long Ph\u00fa","region":"288"},{"id":"273","name":"Long Th\u00e0nh","region":"281"},{"id":"192","name":"Long Xuy\u00ean","region":"272"},{"id":"220","name":"Long \u0110i\u1ec1n","region":"275"},{"id":"452","name":"L\u1ee5c Nam","region":"234"},{"id":"450","name":"L\u1ee5c Ng\u1ea1n","region":"234"},{"id":"43","name":"L\u1ee5c Y\u00ean","region":"259"},{"id":"542","name":"L\u01b0\u01a1ng S\u01a1n","region":"244"},{"id":"456","name":"L\u01b0\u01a1ng T\u00e0i","region":"235"},{"id":"494","name":"L\u00fd Nh\u00e2n","region":"239"},{"id":"167","name":"L\u00fd S\u01a1n","region":"270"},{"id":"396","name":"M'dr\u1eafk","region":"293"},{"id":"549","name":"Mai Ch\u00e2u","region":"244"},{"id":"643","name":"Mai S\u01a1n","region":"253"},{"id":"383","name":"Mang Th\u00edt","region":"292"},{"id":"83","name":"Mang Yang","region":"262"},{"id":"485","name":"M\u00e8o V\u1ea1c","region":"238"},{"id":"121","name":"Minh H\u00f3a","region":"267"},{"id":"158","name":"Minh Long","region":"270"},{"id":"239","name":"M\u1ecf C\u00e0y B\u1eafc","region":"277"},{"id":"240","name":"M\u1ecf C\u00e0y Nam","region":"277"},{"id":"159","name":"M\u1ed9 \u0110\u1ee9c","region":"270"},{"id":"646","name":"M\u1ed9c Ch\u00e2u","region":"253"},{"id":"318","name":"M\u1ed9c H\u00f3a","region":"285"},{"id":"625","name":"M\u00f3ng C\u00e1i","region":"252"},{"id":"44","name":"M\u00f9 Cang Ch\u1ea3i","region":"259"},{"id":"476","name":"M\u01b0\u1eddng \u1ea2ng","region":"237"},{"id":"477","name":"M\u01b0\u1eddng Ch\u00e0","region":"237"},{"id":"556","name":"M\u01b0\u1eddng Kh\u01b0\u01a1ng","region":"245"},{"id":"639","name":"M\u01b0\u1eddng La","region":"253"},{"id":"10","name":"M\u01b0\u1eddng L\u00e1t","region":"256"},{"id":"473","name":"M\u01b0\u1eddng Lay","region":"237"},{"id":"478","name":"M\u01b0\u1eddng Nh\u00e9","region":"237"},{"id":"560","name":"M\u01b0\u1eddng T\u00e8","region":"246"},{"id":"536","name":"M\u1ef9 H\u00e0o","region":"243"},{"id":"578","name":"M\u1ef9 L\u1ed9c","region":"248"},{"id":"363","name":"M\u1ef9 Tho","region":"290"},{"id":"348","name":"M\u1ef9 T\u00fa","region":"288"},{"id":"349","name":"M\u1ef9 Xuy\u00ean","region":"288"},{"id":"30","name":"Na Hang","region":"257"},{"id":"442","name":"Na R\u00ec","region":"233"},{"id":"259","name":"N\u0103m C\u0103n","region":"279"},{"id":"149","name":"Nam Giang","region":"269"},{"id":"513","name":"Nam S\u00e1ch","region":"241"},{"id":"142","name":"Nam Tr\u00e0 My","region":"269"},{"id":"579","name":"Nam Tr\u1ef1c","region":"248"},{"id":"594","name":"Nam \u0110\u00e0n","region":"249"},{"id":"89","name":"Nam \u0110\u00f4ng","region":"263"},{"id":"291","name":"Ng\u00e3 B\u1ea3y","region":"283"},{"id":"350","name":"Ng\u00e3 N\u0103m","region":"288"},{"id":"11","name":"Nga S\u01a1n","region":"256"},{"id":"443","name":"Ng\u00e2n S\u01a1n","region":"233"},{"id":"595","name":"Nghi L\u1ed9c","region":"249"},{"id":"504","name":"Nghi Xu\u00e2n","region":"240"},{"id":"160","name":"Ngh\u0129a H\u00e0nh","region":"270"},{"id":"580","name":"Ngh\u0129a H\u01b0ng","region":"248"},{"id":"42","name":"Ngh\u0129a L\u1ed9","region":"259"},{"id":"596","name":"Ngh\u0129a \u0110\u00e0n","region":"249"},{"id":"523","name":"Ng\u00f4 Quy\u1ec1n","region":"242"},{"id":"254","name":"Ng\u1ecdc Hi\u1ec3n","region":"279"},{"id":"99","name":"Ng\u1ecdc H\u1ed3i","region":"264"},{"id":"12","name":"Ng\u1ecdc L\u1eb7c","region":"256"},{"id":"53","name":"Ng\u0169 H\u00e0nh S\u01a1n","region":"260"},{"id":"466","name":"Nguy\u00ean B\u00ecnh","region":"236"},{"id":"102","name":"Nha Trang","region":"265"},{"id":"605","name":"Nho Quan","region":"250"},{"id":"274","name":"Nh\u01a1n Tr\u1ea1ch","region":"281"},{"id":"13","name":"Nh\u01b0 Thanh","region":"256"},{"id":"14","name":"Nh\u01b0 Xu\u00e2n","region":"256"},{"id":"514","name":"Ninh Giang","region":"241"},{"id":"339","name":"Ninh H\u1ea3i","region":"287"},{"id":"104","name":"Ninh H\u00f2a","region":"265"},{"id":"261","name":"Ninh Ki\u1ec1u","region":"280"},{"id":"340","name":"Ninh Ph\u01b0\u1edbc","region":"287"},{"id":"341","name":"Ninh S\u01a1n","region":"287"},{"id":"15","name":"N\u00f4ng C\u1ed1ng","region":"256"},{"id":"147","name":"N\u00f4ng S\u01a1n","region":"269"},{"id":"143","name":"N\u00fai Th\u00e0nh","region":"269"},{"id":"264","name":"\u00d4 M\u00f4n","region":"280"},{"id":"444","name":"P\u00e1c N\u1ea1m","region":"233"},{"id":"337","name":"Phan Rang - Th\u00e1p Ch\u00e0m","region":"287"},{"id":"243","name":"Phan Thi\u1ebft","region":"278"},{"id":"659","name":"Ph\u1ed5 Y\u00ean","region":"255"},{"id":"561","name":"Phong Th\u1ed5","region":"246"},{"id":"90","name":"Phong \u0110i\u1ec1n","region":"263"},{"id":"266","name":"Phong \u0110i\u1ec1n","region":"280"},{"id":"660","name":"Ph\u00fa B\u00ecnh","region":"255"},{"id":"63","name":"Ph\u00f9 C\u00e1t","region":"261"},{"id":"537","name":"Ph\u00f9 C\u1eeb","region":"243"},{"id":"209","name":"Ph\u00fa Gi\u00e1o","region":"273"},{"id":"115","name":"Ph\u00fa H\u00f2a","region":"266"},{"id":"91","name":"Ph\u00fa L\u1ed9c","region":"263"},{"id":"661","name":"Ph\u00fa L\u01b0\u01a1ng","region":"255"},{"id":"491","name":"Ph\u1ee7 L\u00fd","region":"239"},{"id":"64","name":"Ph\u00f9 M\u1ef9","region":"261"},{"id":"151","name":"Ph\u00fa Ninh","region":"269"},{"id":"617","name":"Ph\u00f9 Ninh","region":"251"},{"id":"92","name":"Ph\u00fa Quang","region":"263"},{"id":"307","name":"Ph\u00fa Qu\u1ed1c","region":"284"},{"id":"252","name":"Ph\u00fa Qu\u00fd","region":"278"},{"id":"199","name":"Ph\u00fa T\u00e2n","region":"272"},{"id":"260","name":"Ph\u00fa T\u00e2n","region":"279"},{"id":"84","name":"Ph\u00fa Thi\u1ec7n","region":"262"},{"id":"612","name":"Ph\u00fa Th\u1ecd","region":"251"},{"id":"641","name":"Ph\u00f9 Y\u00ean","region":"253"},{"id":"467","name":"Ph\u1ee5c H\u00f2a","region":"236"},{"id":"34","name":"Ph\u00fac Y\u00ean","region":"258"},{"id":"295","name":"Ph\u1ee5ng Hi\u1ec7p","region":"283"},{"id":"228","name":"Ph\u01b0\u1edbc Long","region":"276"},{"id":"212","name":"Ph\u01b0\u1edbc Long","region":"274"},{"id":"144","name":"Ph\u01b0\u1edbc S\u01a1n","region":"269"},{"id":"69","name":"Pleiku","region":"262"},{"id":"168","name":"Qu\u1eadn 1","region":"271"},{"id":"177","name":"Qu\u1eadn 10","region":"271"},{"id":"178","name":"Qu\u1eadn 11","region":"271"},{"id":"179","name":"Qu\u1eadn 12","region":"271"},{"id":"169","name":"Qu\u1eadn 2","region":"271"},{"id":"170","name":"Qu\u1eadn 3","region":"271"},{"id":"171","name":"Qu\u1eadn 4","region":"271"},{"id":"172","name":"Qu\u1eadn 5","region":"271"},{"id":"173","name":"Qu\u1eadn 6","region":"271"},{"id":"174","name":"Qu\u1eadn 7","region":"271"},{"id":"175","name":"Qu\u1eadn 8","region":"271"},{"id":"176","name":"Qu\u1eadn 9","region":"271"},{"id":"486","name":"Qu\u1ea3n B\u1ea1","region":"238"},{"id":"189","name":"Qu\u1eadn B\u00ecnh Ch\u00e1nh","region":"271"},{"id":"186","name":"Qu\u1eadn B\u00ecnh T\u00e2n","region":"271"},{"id":"183","name":"Qu\u1eadn B\u00ecnh Th\u1ea1nh","region":"271"},{"id":"191","name":"Qu\u1eadn C\u1ea7n Gi\u1edd","region":"271"},{"id":"187","name":"Qu\u1eadn C\u1ee7 Chi","region":"271"},{"id":"180","name":"Qu\u1eadn G\u00f2 V\u1ea5p","region":"271"},{"id":"16","name":"Quan H\u00f3a","region":"256"},{"id":"188","name":"Qu\u1eadn H\u00f3c M\u00f4n","region":"271"},{"id":"190","name":"Qu\u1eadn Nh\u00e0 B\u00e8","region":"271"},{"id":"184","name":"Qu\u1eadn Ph\u00fa Nhu\u1eadn","region":"271"},{"id":"17","name":"Quan S\u01a1n","region":"256"},{"id":"181","name":"Qu\u1eadn T\u00e2n B\u00ecnh","region":"271"},{"id":"182","name":"Qu\u1eadn T\u00e2n Ph\u00fa","region":"271"},{"id":"185","name":"Qu\u1eadn Th\u1ee7 \u0110\u1ee9c","region":"271"},{"id":"487","name":"Quang B\u00ecnh","region":"238"},{"id":"125","name":"Qu\u1ea3ng Ninh","region":"267"},{"id":"123","name":"Qu\u1ea3ng Tr\u1ea1ch","region":"267"},{"id":"128","name":"Qu\u1ea3ng Tr\u1ecb","region":"268"},{"id":"468","name":"Qu\u1ea3ng Uy\u00ean","region":"236"},{"id":"18","name":"Qu\u1ea3ng X\u01b0\u01a1ng","region":"256"},{"id":"628","name":"Qu\u1ea3ng Y\u00ean","region":"252"},{"id":"93","name":"Qu\u1ea3ng \u0110i\u1ec1n","region":"263"},{"id":"597","name":"Qu\u1ebf Phong","region":"249"},{"id":"154","name":"Qu\u1ebf S\u01a1n","region":"269"},{"id":"457","name":"Qu\u1ebf V\u00f5","region":"235"},{"id":"592","name":"Qu\u1ef3 Ch\u00e2u","region":"249"},{"id":"598","name":"Qu\u1ef3 H\u1ee3p","region":"249"},{"id":"58","name":"Quy Nh\u01a1n","region":"261"},{"id":"599","name":"Qu\u1ef3nh L\u01b0u","region":"249"},{"id":"638","name":"Qu\u1ef3nh Nhai","region":"253"},{"id":"651","name":"Qu\u1ef3nh Ph\u1ee5","region":"254"},{"id":"297","name":"R\u1ea1ch Gi\u00e1","region":"284"},{"id":"557","name":"Sa Pa","region":"245"},{"id":"100","name":"Sa Th\u1ea7y","region":"264"},{"id":"2","name":"S\u1ea7m S\u01a1n","region":"256"},{"id":"562","name":"S\u00ecn H\u1ed3","region":"246"},{"id":"354","name":"S\u00f3c Tr\u0103ng","region":"288"},{"id":"31","name":"S\u01a1n D\u01b0\u01a1ng","region":"257"},{"id":"161","name":"S\u01a1n H\u00e0","region":"270"},{"id":"116","name":"S\u01a1n H\u00f2a","region":"266"},{"id":"162","name":"S\u01a1n T\u00e2y","region":"270"},{"id":"419","name":"S\u01a1n T\u00e2y","region":"232"},{"id":"163","name":"S\u01a1n T\u1ecbnh","region":"270"},{"id":"52","name":"S\u01a1n Tr\u00e0","region":"260"},{"id":"448","name":"S\u01a1n \u0110\u1ed9ng","region":"234"},{"id":"112","name":"S\u00f4ng C\u1ea7u","region":"266"},{"id":"655","name":"S\u00f4ng C\u00f4ng","region":"255"},{"id":"117","name":"S\u00f4ng Hinh","region":"266"},{"id":"37","name":"S\u00f4ng L\u00f4","region":"258"},{"id":"644","name":"S\u00f4ng M\u00e3","region":"253"},{"id":"647","name":"S\u1ed1p C\u1ed9p","region":"253"},{"id":"384","name":"Tam B\u00ecnh","region":"292"},{"id":"604","name":"Tam B\u00ecnh","region":"250"},{"id":"38","name":"Tam D\u01b0\u01a1ng","region":"258"},{"id":"137","name":"Tam K\u1ef3","region":"269"},{"id":"618","name":"Tam N\u00f4ng","region":"251"},{"id":"286","name":"Tam N\u00f4ng","region":"282"},{"id":"39","name":"Tam \u0110\u1ea3o","region":"258"},{"id":"563","name":"Tam \u0110\u01b0\u1eddng","region":"246"},{"id":"311","name":"T\u00e2n An","region":"285"},{"id":"355","name":"T\u00e2n Bi\u00ean","region":"289"},{"id":"356","name":"T\u00e2n Ch\u00e2u","region":"289"},{"id":"194","name":"T\u00e2n Ch\u00e2u","region":"272"},{"id":"308","name":"T\u00e2n Hi\u1ec7p","region":"284"},{"id":"287","name":"T\u00e2n H\u1ed3ng","region":"282"},{"id":"319","name":"T\u00e2n H\u01b0ng","region":"285"},{"id":"600","name":"T\u00e2n K\u1ef3","region":"249"},{"id":"550","name":"T\u00e2n L\u1ea1c","region":"244"},{"id":"275","name":"T\u00e2n Ph\u00fa","region":"281"},{"id":"372","name":"T\u00e2n Ph\u00fa \u0110\u00f4ng","region":"290"},{"id":"370","name":"T\u00e2n Ph\u01b0\u1edbc","region":"290"},{"id":"619","name":"T\u00e2n S\u01a1n","region":"251"},{"id":"223","name":"T\u00e2n Th\u00e0nh","region":"275"},{"id":"320","name":"T\u00e2n Th\u1ea1nh","region":"285"},{"id":"321","name":"T\u00e2n Tr\u1ee5","region":"285"},{"id":"565","name":"T\u00e2n Uy\u00ean","region":"246"},{"id":"208","name":"T\u00e2n Uy\u00ean","region":"273"},{"id":"446","name":"T\u00e2n Y\u00ean","region":"234"},{"id":"249","name":"T\u00e1nh Linh","region":"278"},{"id":"152","name":"T\u00e2y Giang","region":"269"},{"id":"417","name":"T\u00e2y H\u1ed3","region":"232"},{"id":"118","name":"T\u00e2y H\u00f2a","region":"266"},{"id":"66","name":"T\u00e2y S\u01a1n","region":"261"},{"id":"164","name":"T\u00e2y Tr\u00e0","region":"270"},{"id":"469","name":"Th\u1ea1ch An","region":"236"},{"id":"505","name":"Th\u1ea1ch H\u00e0","region":"240"},{"id":"19","name":"Th\u1ea1ch Th\u00e0nh","region":"256"},{"id":"586","name":"Th\u00e1i H\u00f2a","region":"249"},{"id":"652","name":"Th\u00e1i Th\u1ee5y","region":"254"},{"id":"564","name":"Than Uy\u00ean","region":"246"},{"id":"140","name":"Th\u0103ng B\u00ecnh","region":"269"},{"id":"620","name":"Thanh Ba","region":"251"},{"id":"288","name":"Thanh B\u00ecnh","region":"282"},{"id":"601","name":"Thanh Ch\u01b0\u01a1ng","region":"249"},{"id":"515","name":"Thanh H\u00e0","region":"241"},{"id":"27","name":"Thanh H\u00f3a","region":"256"},{"id":"322","name":"Thanh H\u00f3a","region":"285"},{"id":"51","name":"Thanh Kh\u00ea","region":"260"},{"id":"495","name":"Thanh Li\u00eam","region":"239"},{"id":"516","name":"Thanh Mi\u1ec7n","region":"241"},{"id":"241","name":"Th\u1ea1nh Ph\u00fa","region":"277"},{"id":"621","name":"Thanh S\u01a1n","region":"251"},{"id":"622","name":"Thanh Th\u1ee7y","region":"251"},{"id":"352","name":"Th\u1ea1nh Tr\u1ecb","region":"288"},{"id":"418","name":"Thanh Xu\u00e2n","region":"232"},{"id":"289","name":"Th\u00e1p M\u01b0\u1eddi","region":"282"},{"id":"20","name":"Thi\u1ec7u H\u00f3a","region":"256"},{"id":"21","name":"Th\u1ecd Xu\u00e2n","region":"256"},{"id":"200","name":"Tho\u1ea1i S\u01a1n","region":"272"},{"id":"258","name":"Th\u1edbi B\u00ecnh","region":"279"},{"id":"268","name":"Th\u1edbi Lai","region":"280"},{"id":"276","name":"Th\u1ed1ng Nh\u1ea5t","region":"281"},{"id":"470","name":"Th\u00f4ng N\u00f4ng","region":"236"},{"id":"265","name":"Th\u1ed1t N\u1ed1t","region":"280"},{"id":"203","name":"Th\u1ee7 D\u1ea7u M\u1ed9t","region":"273"},{"id":"323","name":"Th\u1ee7 Th\u1eeba","region":"285"},{"id":"204","name":"Thu\u1eadn An","region":"273"},{"id":"342","name":"Thu\u1eadn B\u1eafc","region":"287"},{"id":"640","name":"Thu\u1eadn Ch\u00e2u","region":"253"},{"id":"343","name":"Thu\u1eadn Nam","region":"287"},{"id":"458","name":"Thu\u1eadn Th\u00e0nh","region":"235"},{"id":"22","name":"Th\u01b0\u1eddng Xu\u00e2n","region":"256"},{"id":"532","name":"Th\u1ee7y Nguy\u00ean","region":"242"},{"id":"459","name":"Ti\u00ean Du","region":"235"},{"id":"653","name":"Ti\u1ec1n H\u1ea3i","region":"254"},{"id":"530","name":"Ti\u00ean L\u00e3ng","region":"242"},{"id":"538","name":"Ti\u00ean L\u1eef","region":"243"},{"id":"145","name":"Ti\u00ean Ph\u01b0\u1edbc","region":"269"},{"id":"630","name":"Ti\u00ean Y\u00ean","region":"252"},{"id":"375","name":"Ti\u1ec3u C\u1ea7n","region":"291"},{"id":"201","name":"T\u1ecbnh Bi\u00ean","region":"272"},{"id":"23","name":"T\u0129nh Gia","region":"256"},{"id":"165","name":"Tr\u00e0 b\u1ed3ng","region":"270"},{"id":"378","name":"Tr\u00e0 C\u00fa","region":"291"},{"id":"471","name":"Tr\u00e0 L\u0129nh","region":"236"},{"id":"385","name":"Tr\u00e0 \u00d4n","region":"292"},{"id":"46","name":"Tr\u1ea1m T\u1ea5u","region":"259"},{"id":"256","name":"Tr\u1ea7n V\u0103n Th\u1eddi","region":"279"},{"id":"45","name":"Tr\u1ea5n Y\u00ean","region":"259"},{"id":"351","name":"Tr\u1ea7n \u0110\u1ec1","region":"288"},{"id":"362","name":"Tr\u1ea3ng B\u00e0ng","region":"289"},{"id":"280","name":"Tr\u1ea3ng Bom","region":"281"},{"id":"566","name":"Tr\u00e0ng \u0110\u00ecnh","region":"247"},{"id":"202","name":"Tri T\u00f4n","region":"272"},{"id":"135","name":"Tri\u1ec7u Phong","region":"268"},{"id":"24","name":"Tri\u1ec7u S\u01a1n","region":"256"},{"id":"581","name":"Tr\u1ef1c Ninh","region":"248"},{"id":"472","name":"Tr\u00f9ng Kh\u00e1nh","region":"236"},{"id":"110","name":"Tr\u01b0\u1eddng Sa","region":"265"},{"id":"517","name":"T\u1ee9 K\u1ef3","region":"241"},{"id":"101","name":"Tu M\u01a1 R\u00f4ng","region":"264"},{"id":"166","name":"T\u01b0 Ngh\u0129a","region":"270"},{"id":"454","name":"T\u1eeb S\u01a1n","region":"235"},{"id":"479","name":"T\u1ee7a Ch\u00f9a","region":"237"},{"id":"480","name":"Tu\u1ea7n Gi\u00e1o","region":"237"},{"id":"602","name":"T\u01b0\u01a1ng D\u01b0\u01a1ng","region":"249"},{"id":"119","name":"Tuy An","region":"266"},{"id":"111","name":"Tuy H\u00f2a","region":"266"},{"id":"245","name":"Tuy Phong","region":"278"},{"id":"65","name":"Tuy Ph\u01b0\u1edbc","region":"261"},{"id":"408","name":"Tuy \u0110\u1ee9c","region":"294"},{"id":"122","name":"Tuy\u00ean H\u00f3a","region":"267"},{"id":"257","name":"U Minh","region":"279"},{"id":"310","name":"U Minh Th\u01b0\u1ee3ng","region":"284"},{"id":"626","name":"U\u00f4ng B\u00ed","region":"252"},{"id":"559","name":"V\u0103n B\u00e0n","region":"245"},{"id":"67","name":"V\u00e2n Canh","region":"261"},{"id":"47","name":"V\u0103n Ch\u1ea5n","region":"259"},{"id":"539","name":"V\u0103n Giang","region":"243"},{"id":"540","name":"V\u0103n L\u00e2m","region":"243"},{"id":"567","name":"V\u0103n L\u00e3ng","region":"247"},{"id":"105","name":"V\u1ea1n Ninh","region":"265"},{"id":"568","name":"V\u0103n Quang","region":"247"},{"id":"48","name":"V\u0103n Y\u00ean","region":"259"},{"id":"637","name":"V\u00e2n \u0110\u1ed3n","region":"252"},{"id":"290","name":"V\u1ecb Thanh","region":"283"},{"id":"296","name":"V\u1ecb Th\u1ee7y","region":"283"},{"id":"488","name":"V\u1ecb Xuy\u00ean","region":"238"},{"id":"611","name":"Vi\u1ec7t Tr\u00ec","region":"251"},{"id":"449","name":"Vi\u1ec7t Y\u00ean","region":"234"},{"id":"531","name":"V\u0129nh B\u1ea3o","region":"242"},{"id":"344","name":"V\u0129nh Ch\u00e2u","region":"288"},{"id":"277","name":"V\u0129nh C\u1eedu","region":"281"},{"id":"324","name":"V\u0129nh H\u01b0ng","region":"285"},{"id":"136","name":"V\u0129nh Linh","region":"268"},{"id":"25","name":"V\u0129nh L\u1ed9c","region":"256"},{"id":"230","name":"V\u0129nh L\u1ee3i","region":"276"},{"id":"387","name":"V\u0129nh Long","region":"292"},{"id":"68","name":"V\u0129nh Th\u1ea1nh","region":"261"},{"id":"269","name":"V\u0129nh Th\u1ea1nh","region":"280"},{"id":"309","name":"V\u0129nh Thu\u1eadn","region":"284"},{"id":"40","name":"V\u0129nh T\u01b0\u1eddng","region":"258"},{"id":"662","name":"V\u00f5 Nhai","region":"255"},{"id":"582","name":"V\u1ee5 B\u1ea3n","region":"248"},{"id":"506","name":"V\u0169 Quang","region":"240"},{"id":"654","name":"V\u0169 Th\u01b0","region":"254"},{"id":"386","name":"V\u0169ng Li\u00eam","region":"292"},{"id":"226","name":"V\u0169ng T\u00e0u","region":"275"},{"id":"558","name":"Xi Ma Cai","region":"245"},{"id":"489","name":"X\u00edn M\u1ea7n","region":"238"},{"id":"278","name":"Xu\u00e2n L\u1ed9c","region":"281"},{"id":"583","name":"Xu\u00e2n Tr\u01b0\u1eddng","region":"248"},{"id":"225","name":"Xuy\u00ean M\u1ed9c","region":"275"},{"id":"584","name":"\u00dd Y\u00ean","region":"248"},{"id":"49","name":"Y\u00ean B\u00ecnh  ","region":"259"},{"id":"645","name":"Y\u00ean Ch\u00e2u","region":"253"},{"id":"453","name":"Y\u00ean D\u0169ng","region":"234"},{"id":"608","name":"Y\u00ean Kh\u00e1nh","region":"250"},{"id":"41","name":"Y\u00ean L\u1ea1c","region":"258"},{"id":"623","name":"Y\u00ean L\u1eadp","region":"251"},{"id":"490","name":"Y\u00ean Minh","region":"238"},{"id":"609","name":"Y\u00ean M\u00f4","region":"250"},{"id":"541","name":"Y\u00ean M\u1ef9","region":"243"},{"id":"460","name":"Y\u00ean Phong","region":"235"},{"id":"32","name":"Y\u00ean S\u01a1n","region":"257"},{"id":"603","name":"Y\u00ean Th\u00e0nh","region":"249"},{"id":"445","name":"Y\u00ean Th\u1ebf","region":"234"},{"id":"551","name":"Y\u00ean Th\u1ee7y","region":"244"},{"id":"26","name":"Y\u00ean \u0110\u1ecbnh","region":"256"},{"id":"544","name":"\u0110\u00e0 B\u1eafc","region":"244"},{"id":"331","name":"\u0110\u1ea1 Huoai","region":"286"},{"id":"131","name":"\u0110a Krong","region":"268"},{"id":"325","name":"\u0110\u00e0 L\u1ea1t","region":"286"},{"id":"332","name":"\u0110\u1ea1 T\u1ebbh","region":"286"},{"id":"150","name":"\u0110\u1ea1i L\u1ed9c","region":"269"},{"id":"656","name":"\u0110\u1ea1i T\u1eeb","region":"255"},{"id":"94","name":"\u0110ak Glei","region":"264"},{"id":"403","name":"\u0110\u1eafk Glong","region":"294"},{"id":"95","name":"\u0110ak H\u00e0","region":"264"},{"id":"404","name":"\u0110\u1eafk Mil","region":"294"},{"id":"76","name":"\u0110\u0103k P\u01a1","region":"262"},{"id":"405","name":"\u0110\u1eafk R'L\u1ea5p","region":"294"},{"id":"406","name":"\u0110\u1eafk Song","region":"294"},{"id":"96","name":"\u0110ak T\u00f4","region":"264"},{"id":"75","name":"\u0110\u0103k \u0110oa","region":"262"},{"id":"253","name":"\u0110\u1ea7m D\u01a1i","region":"279"},{"id":"634","name":"\u0110\u1ea7m H\u00e0","region":"252"},{"id":"330","name":"\u0110am R\u00f4ng","region":"286"},{"id":"221","name":"\u0110\u1ea5t \u0110\u1ecf","region":"275"},{"id":"139","name":"\u0110i\u1ec7n B\u00e0n","region":"269"},{"id":"474","name":"\u0110i\u1ec7n Bi\u00ean","region":"237"},{"id":"475","name":"\u0110i\u1ec7n Bi\u00ean \u0110\u00f4ng","region":"237"},{"id":"657","name":"\u0110\u1ecbnh H\u00f3a","region":"255"},{"id":"575","name":"\u0110\u00ecnh L\u1eadp","region":"247"},{"id":"272","name":"\u0110\u1ecbnh Qu\u00e1n","region":"281"},{"id":"590","name":"\u0110\u00f4 L\u01b0\u01a1ng","region":"249"},{"id":"519","name":"\u0110\u1ed3 S\u01a1n","region":"242"},{"id":"614","name":"\u0110oan H\u00f9ng","region":"251"},{"id":"333","name":"\u0110\u01a1n D\u01b0\u01a1ng","region":"286"},{"id":"148","name":"\u0110\u00f4ng Giang","region":"269"},{"id":"127","name":"\u0110\u00f4ng H\u00e0","region":"268"},{"id":"232","name":"\u0110\u00f4ng H\u1ea3i","region":"276"},{"id":"113","name":"\u0110\u00f4ng H\u00f2a","region":"266"},{"id":"120","name":"\u0110\u1ed3ng H\u1edbi","region":"267"},{"id":"648","name":"\u0110\u00f4ng H\u01b0ng","region":"254"},{"id":"658","name":"\u0110\u1ed3ng H\u1ef7","region":"255"},{"id":"217","name":"\u0110\u1ed3ng Ph\u00fa","region":"274"},{"id":"5","name":"\u0110\u00f4ng S\u01a1n","region":"256"},{"id":"629","name":"\u0110\u00f4ng Tri\u1ec1u","region":"252"},{"id":"481","name":"\u0110\u1ed3ng V\u0103n","region":"238"},{"id":"210","name":"\u0110\u1ed3ng Xo\u00e0i","region":"274"},{"id":"114","name":"\u0110\u1ed3ng Xu\u00e2n","region":"266"},{"id":"411","name":"\u0110\u1ed1ng \u0110a","region":"232"},{"id":"77","name":"\u0110\u1ee9c C\u01a1","region":"262"},{"id":"316","name":"\u0110\u1ee9c H\u00f2a","region":"285"},{"id":"317","name":"\u0110\u1ee9c Hu\u1ec7","region":"285"},{"id":"251","name":"\u0110\u1ee9c Linh","region":"278"},{"id":"157","name":"\u0110\u1ee9c Ph\u1ed5","region":"270"},{"id":"500","name":"\u0110\u1ee9c Th\u1ecd","region":"240"},{"id":"336","name":"\u0110\u1ee9c Tr\u1ecdng","region":"286"}];                            
    $('#{$prefix}address_region').change(function(e) {
        $('#{$prefix}address_city').children('option').remove();
        if($(this).val() != '') {
            var regionId = $(this).val();
            $('#{$prefix}province_name').val($('#address_region option:selected').text())
            $('#{$prefix}address_city').append('<option value="">- Choose a City</option>').append(createOptions(citiesList, regionId));
        }
    });
    $("#{$prefix}address_city").change(function () {
    		$('#{$prefix}city_name').val($('#address_city option:selected').text())
      })
		
                            /* ]]> */
       $(window).ready(function() {
					$("input.numeric").numeric();
					});
</script>
EOF;
	}
	
	function chek(){
		global $vsUser;
		
		$info = $vsUser->obj->getInfo();
		
		$city2 = explode("|", $info['city']);
		$province2 = explode("|", $info['province']);
		
		$BWHTML .= <<<EOF
		<if="$info['title']">
               	
            		<p><b>Tên:</b> {$info['title']}</p>
            		<p><b>Địa chỉ:</b> {$info['address']} {$city2[1]}, {$province2[1]}</p>
            		<p><b>Điện thoại:</b> {$info['phone']}</p>
            		<p><a href="javascript:void(0)" onClick="get('orders/address/shipping_','checkout-shipping')">Địa chỉ mới</a>
            	<else />
                <h3>Địa chỉ giao hàng</h3>
                	<label>Họ và tên<span>*</span></label>
	                <input type="text" name="shipping_title" id="shipping_firstName" value="{$vsUser->obj->getFirstName()}" />
	                <span id="shipping_name-error" class="error">Vui lòng nhập tên đầy đủ!</span>
                <label>Số điện thoại <span>*</span></label>
                <input type="text" name="shipping_phone" id="shipping_phone" class="numeric" />
					<span id="shipping_phone-error" class="error">Vui lòng nhập số điện thoại!</span>
                <label>Địa chỉ <span>*</span></label>
                <input type="text" name="shipping_address" id="shipping_address" /><span id="shipping_address-error" class="error">Vui lòng nhập địa chỉ!</span>
                <div class="clear_left"></div>
                <div class="thanhtoan_left">
                	<label>Thành phố/Tỉnh <span>*</span></label>
	                <select name="shipping_province[key]" id="shipping_address_region">
<option value="272">An Giang</option>
<option value="275">Bà Rịa - Vũng Tàu</option>
<option value="234">Bắc Giang</option>
<option value="233">Bắc Kạn</option>
<option value="276">Bạc Liêu</option>
<option value="235">Bắc Ninh</option>
<option value="277">Bến Tre</option>
<option value="273">Bình Dương</option>
<option value="274">Bình Phước</option>
<option value="278">Bình Thuận</option>
<option value="261">Bình Định</option>
<option value="279">Cà Mau</option>
<option value="280">Cần Thơ</option>
<option value="236">Cao Bằng</option>
<option value="262">Gia Lai</option>
<option value="238">Hà Giang</option>
<option value="239">Hà Nam</option>
<option value="232">Hà Nội</option>
<option value="240">Hà Tĩnh</option>
<option value="241">Hải Dương</option>
<option value="242">Hải Phòng</option>
<option value="283">Hậu Giang</option>
<option value="271">Hồ Chí Minh</option>
<option value="244">Hòa Bình</option>
<option value="243">Hưng Yên</option>
<option value="265">Khánh Hòa</option>
<option value="284">Kiên Giang</option>
<option value="264">Kon Tum</option>
<option value="246">Lai Châu</option>
<option value="286">Lâm Đồng</option>
<option value="247">Lạng Sơn</option>
<option value="245">Lào Cai</option>
<option value="285">Long An</option>
<option value="248">Nam Định</option>
<option value="249">Nghệ An</option>
<option value="250">Ninh Bình</option>
<option value="287">Ninh Thuận</option>
<option value="251">Phú Thọ</option>
<option value="266">Phú Yên</option>
<option value="267">Quảng Bình</option>
<option value="269">Quảng Nam </option>
<option value="270">Quảng Ngãi</option>
<option value="252">Quảng Ninh</option>
<option value="268">Quảng Trị</option>
<option value="288">Sóc Trăng</option>
<option value="253">Sơn La</option>
<option value="289">Tây Ninh</option>
<option value="254">Thái Bình</option>
<option value="255">Thái Nguyên</option>
<option value="256">Thanh Hóa</option>
<option value="263">Thừa Thiên Huế</option>
<option value="290">Tiền Giang</option>
<option value="291">Trà Vinh</option>
<option value="257">Tuyên Quang</option>
<option value="292">Vĩnh Long</option>
<option value="258">Vĩnh Phúc</option>
<option value="259">Yên Bái</option>
<option value="260">Đà Nẵng</option>
<option value="293">Đắk Lắk</option>
<option value="294">Đắk Nông</option>
<option value="237">Điện Biên</option>
<option value="281">Đồng Nai</option>
<option value="282">Đồng Tháp</option>
</select> 
<span id="shipping_region-error" class="error">Vui lòng chọn tỉnh/thành phố!</span>

                </div>
                <div class="thanhtoan_right">
                	<label>Quận <span>*</span></label>
	               <select name="shipping_city[key]" id="shipping_address_city">
</select><span id="shipping_city-error" class="error">Vui lòng chọn quận!</span>   
<input type="hidden" name="shipping_city[name]" id="shipping_city_name"/>
<input type="hidden" name="shipping_province[name]" id="shipping_province_name"/>           
                </div>
                <script type="text/javascript">
/* <![CDATA[ */
$('#shipping_address_region').prepend('<option value="">- Choose a Province</option>');
$('#shipping_address_region').val("");
	var citiesShippingList = [{"id":"88","name":"A L\u01b0\u1edbi","region":"263","zip":null},{"id":"299","name":"An Bi\u00ean","region":"284","zip":null},{"id":"525","name":"An D\u01b0\u01a1ng","region":"242","zip":null},{"id":"70","name":"An Kh\u00ea","region":"262","zip":null},{"id":"526","name":"An L\u00e3o","region":"242","zip":null},{"id":"300","name":"An Minh","region":"284","zip":null},{"id":"59","name":"An Nh\u01a1n","region":"261","zip":null},{"id":"195","name":"An Ph\u00fa","region":"272","zip":null},{"id":"533","name":"\u00c2n Thi","region":"243","zip":null},{"id":"60","name":"An \u0111\u1ea3o","region":"261","zip":null},{"id":"587","name":"Anh S\u01a1n","region":"249","zip":null},{"id":"71","name":"Ayun Pa","region":"262","zip":null},{"id":"439","name":"Ba B\u1ec3","region":"233","zip":null},{"id":"632","name":"Ba Ch\u1ebf","region":"252","zip":null},{"id":"227","name":"B\u00e0 R\u1ecba","region":"275","zip":null},{"id":"3","name":"B\u00e1 Th\u01b0\u1edbc","region":"256","zip":null},{"id":"155","name":"Ba T\u01a1","region":"270","zip":null},{"id":"234","name":"Ba Tri","region":"277","zip":null},{"id":"420","name":"Ba V\u00ec","region":"232","zip":null},{"id":"409","name":"Ba \u0110\u00ecnh","region":"232","zip":null},{"id":"338","name":"B\u00e1c \u00c1i","region":"287","zip":null},{"id":"246","name":"B\u1eafc B\u00ecnh","region":"278","zip":null},{"id":"555","name":"B\u1eafc H\u00e0","region":"245","zip":null},{"id":"482","name":"B\u1eafc M\u00ea","region":"238","zip":null},{"id":"483","name":"B\u1eafc Quang","region":"238","zip":null},{"id":"570","name":"B\u1eafc S\u01a1n","region":"247","zip":null},{"id":"141","name":"B\u1eafc Tr\u00e0 My","region":"269","zip":null},{"id":"642","name":"B\u1eafc Y\u00ean","region":"253","zip":null},{"id":"527","name":"B\u1ea1ch Long V\u1ef9","region":"242","zip":null},{"id":"440","name":"B\u1ea1ch Th\u00f4ng","region":"233","zip":null},{"id":"461","name":"B\u1ea3o L\u1ea1c","region":"236","zip":null},{"id":"327","name":"B\u1ea3o L\u00e2m","region":"286","zip":null},{"id":"462","name":"B\u1ea3o L\u00e2m","region":"236","zip":null},{"id":"326","name":"B\u1ea3o L\u1ed9c","region":"286","zip":null},{"id":"553","name":"B\u1ea3o Th\u1eafng","region":"245","zip":null},{"id":"554","name":"B\u1ea3o Y\u00ean","region":"245","zip":null},{"id":"552","name":"B\u00e1t X\u00e1t","region":"245","zip":null},{"id":"206","name":"B\u1ebfn C\u00e1t","region":"273","zip":null},{"id":"360","name":"B\u1ebfn C\u1ea7u","region":"289","zip":null},{"id":"312","name":"B\u1ebfn L\u1ee9c","region":"285","zip":null},{"id":"242","name":"B\u1ebfn Tre","region":"277","zip":null},{"id":"270","name":"Bi\u00ean H\u00f2a","region":"281","zip":null},{"id":"1","name":"B\u1ec9m S\u01a1n","region":"256","zip":null},{"id":"569","name":"B\u00ecnh Gia","region":"247","zip":null},{"id":"509","name":"B\u00ecnh Giang","region":"241","zip":null},{"id":"631","name":"B\u00ecnh Li\u00eau","region":"252","zip":null},{"id":"211","name":"B\u00ecnh Long","region":"274","zip":null},{"id":"496","name":"B\u00ecnh L\u1ee5c","region":"239","zip":null},{"id":"380","name":"B\u00ecnh Minh","region":"292","zip":null},{"id":"156","name":"B\u00ecnh S\u01a1n","region":"270","zip":null},{"id":"381","name":"B\u00ecnh T\u00e2n","region":"292","zip":null},{"id":"262","name":"B\u00ecnh Th\u1ee7y","region":"280","zip":null},{"id":"35","name":"B\u00ecnh Xuy\u00ean","region":"258","zip":null},{"id":"235","name":"B\u00ecnh \u0110\u1ea1i","region":"277","zip":null},{"id":"124","name":"B\u1ed1 Tr\u1ea1ch","region":"267","zip":null},{"id":"215","name":"B\u00f9 Gia M\u1eadp","region":"274","zip":null},{"id":"213","name":"B\u00f9 \u0110\u0103ng","region":"274","zip":null},{"id":"214","name":"B\u00f9 \u0110\u1ed1p","region":"274","zip":null},{"id":"388","name":"Bu\u00f4n Ma Thu\u1ed9t","region":"293","zip":null},{"id":"391","name":"Bu\u00f4n \u0110\u00f4n","region":"293","zip":null},{"id":"364","name":"C\u00e1i B\u00e8","region":"290","zip":null},{"id":"371","name":"Cai L\u1eady","region":"290","zip":null},{"id":"255","name":"C\u00e1i N\u01b0\u1edbc","region":"279","zip":null},{"id":"263","name":"C\u00e1i R\u0103ng","region":"280","zip":null},{"id":"510","name":"C\u1ea9m Gi\u00e0ng,Gia L\u1ed9c","region":"241","zip":null},{"id":"613","name":"C\u1ea9m Kh\u00ea","region":"251","zip":null},{"id":"109","name":"Cam L\u00e2m","region":"265","zip":null},{"id":"55","name":"C\u1ea9m L\u1ec7","region":"260","zip":null},{"id":"129","name":"Cam L\u1ed9","region":"268","zip":null},{"id":"279","name":"C\u1ea9m M\u1ef9","region":"281","zip":null},{"id":"627","name":"C\u1ea9m Ph\u1ea3","region":"252","zip":null},{"id":"103","name":"Cam Ranh","region":"265","zip":null},{"id":"4","name":"C\u1ea9m Th\u1ee7y","region":"256","zip":null},{"id":"498","name":"C\u1ea9m Xuy\u00ean","region":"240","zip":null},{"id":"314","name":"C\u1ea7n Giu\u1ed9c","region":"285","zip":null},{"id":"499","name":"Can L\u1ed9c","region":"240","zip":null},{"id":"313","name":"C\u1ea7n \u0110\u01b0\u1edbc","region":"285","zip":null},{"id":"373","name":"C\u00e0ng Long","region":"291","zip":null},{"id":"281","name":"Cao L\u00e3nh","region":"282","zip":null},{"id":"573","name":"Cao L\u1ed9c","region":"247","zip":null},{"id":"543","name":"Cao Phong","region":"244","zip":null},{"id":"528","name":"C\u00e1t H\u1ea3i","region":"242","zip":null},{"id":"328","name":"C\u00e1t Ti\u00ean","region":"286","zip":null},{"id":"410","name":"C\u1ea7u Gi\u1ea5y","region":"232","zip":null},{"id":"374","name":"C\u1ea7u K\u00e8","region":"291","zip":null},{"id":"377","name":"C\u1ea7u Ngang","region":"291","zip":null},{"id":"196","name":"Ch\u00e2u Ph\u00fa","region":"272","zip":null},{"id":"358","name":"Ch\u00e2u Th\u00e0nh","region":"289","zip":null},{"id":"315","name":"Ch\u00e2u Th\u00e0nh","region":"285","zip":null},{"id":"369","name":"Ch\u00e2u Th\u00e0nh","region":"290","zip":null},{"id":"292","name":"Ch\u00e2u Th\u00e0nh","region":"283","zip":null},{"id":"236","name":"Ch\u00e2u Th\u00e0nh","region":"277","zip":null},{"id":"197","name":"Ch\u00e2u Th\u00e0nh","region":"272","zip":null},{"id":"282","name":"Ch\u00e2u Th\u00e0nh","region":"282","zip":null},{"id":"376","name":"Ch\u00e2u Th\u00e0nh","region":"291","zip":null},{"id":"301","name":"Ch\u00e2u Th\u00e0nh","region":"284","zip":null},{"id":"347","name":"Ch\u00e2u Th\u00e0nh","region":"288","zip":null},{"id":"293","name":"Ch\u00e2u Th\u00e0nh A","region":"283","zip":null},{"id":"193","name":"Ch\u00e2u \u0110\u1ed1c","region":"272","zip":null},{"id":"222","name":"Ch\u00e2u \u0110\u1ee9c","region":"275","zip":null},{"id":"572","name":"Chi L\u0103ng","region":"247","zip":null},{"id":"508","name":"Ch\u00ed Linh","region":"241","zip":null},{"id":"28","name":"Chi\u00eam H\u00f3a","region":"257","zip":null},{"id":"368","name":"Ch\u1ee3 G\u1ea1o","region":"290","zip":null},{"id":"237","name":"Ch\u1ee3 L\u00e1ch","region":"277","zip":null},{"id":"198","name":"Ch\u1ee3 M\u1edbi","region":"272","zip":null},{"id":"438","name":"Ch\u1ee3 M\u1edbi","region":"233","zip":null},{"id":"441","name":"Ch\u1ee3 \u0110\u1ed3n","region":"233","zip":null},{"id":"216","name":"Ch\u01a1n Th\u00e0nh","region":"274","zip":null},{"id":"72","name":"Ch\u01b0 Pak","region":"262","zip":null},{"id":"73","name":"Ch\u01b0 Prong","region":"262","zip":null},{"id":"85","name":"Ch\u01b0 Puh","region":"262","zip":null},{"id":"74","name":"Ch\u01b0 S\u00ea","region":"262","zip":null},{"id":"421","name":"Ch\u01b0\u01a1ng M\u1ef9","region":"232","zip":null},{"id":"633","name":"C\u00f4 T\u00f4","region":"252","zip":null},{"id":"267","name":"C\u1edd \u0110\u1ecf","region":"280","zip":null},{"id":"130","name":"C\u1ed3n C\u1ecf","region":"268","zip":null},{"id":"588","name":"Con Cu\u00f4ng","region":"249","zip":null},{"id":"224","name":"C\u00f4n \u0110\u1ea3o","region":"275","zip":null},{"id":"402","name":"C\u01b0 J\u00fat","region":"294","zip":null},{"id":"345","name":"C\u00f9 Lao Dung","region":"288","zip":null},{"id":"392","name":"C\u01b0 M'gar","region":"293","zip":null},{"id":"585","name":"C\u1eeda L\u00f2","region":"249","zip":null},{"id":"207","name":"D\u1ea7u Ti\u1ebfng","region":"273","zip":null},{"id":"205","name":"D\u0129 An","region":"273","zip":null},{"id":"329","name":"Di Linh","region":"286","zip":null},{"id":"589","name":"Di\u1ec5n Ch\u00e2u","region":"249","zip":null},{"id":"106","name":"Di\u00ean Kh\u00e1nh","region":"265","zip":null},{"id":"518","name":"D\u01b0\u01a1ng Kinh","region":"242","zip":null},{"id":"357","name":"D\u01b0\u01a1ng Minh Ch\u00e2u","region":"289","zip":null},{"id":"492","name":"Duy Ti\u00ean","region":"239","zip":null},{"id":"153","name":"Duy Xuy\u00ean","region":"269","zip":null},{"id":"379","name":"Duy\u00ean H\u1ea3i","region":"291","zip":null},{"id":"389","name":"Ea H'leo","region":"293","zip":null},{"id":"395","name":"Ea Kar","region":"293","zip":null},{"id":"390","name":"Ea So\u00fap","region":"293","zip":null},{"id":"455","name":"Gia B\u00ecnh","region":"235","zip":null},{"id":"401","name":"Gia Ngh\u0129a","region":"294","zip":null},{"id":"231","name":"Gi\u00e1 Rai","region":"276","zip":null},{"id":"606","name":"Gia Vi\u1ec5n","region":"250","zip":null},{"id":"576","name":"Giao Th\u1ee7y","region":"248","zip":null},{"id":"132","name":"Gio Linh","region":"268","zip":null},{"id":"302","name":"Gi\u1ed3ng Ri\u1ec1ng","region":"284","zip":null},{"id":"238","name":"Gi\u1ed3ng Tr\u00f4m","region":"277","zip":null},{"id":"365","name":"G\u00f2 C\u00f4ng","region":"290","zip":null},{"id":"367","name":"G\u00f2 C\u00f4ng T\u00e2y","region":"290","zip":null},{"id":"366","name":"G\u00f2 C\u00f4ng \u0110\u00f4ng","region":"290","zip":null},{"id":"361","name":"G\u00f2 D\u1ea7u","region":"289","zip":null},{"id":"303","name":"G\u00f2 Quao","region":"284","zip":null},{"id":"615","name":"H\u1ea1 H\u00f2a","region":"251","zip":null},{"id":"463","name":"H\u1ea1 Lang","region":"236","zip":null},{"id":"624","name":"H\u1ea1 Long","region":"252","zip":null},{"id":"464","name":"H\u00e0 Qu\u1ea3ng","region":"236","zip":null},{"id":"298","name":"H\u00e0 Ti\u00ean","region":"284","zip":null},{"id":"6","name":"H\u00e0 Trung","region":"256","zip":null},{"id":"412","name":"H\u00e0 \u0110\u00f4ng","region":"232","zip":null},{"id":"520","name":"H\u1ea3i An","region":"242","zip":null},{"id":"413","name":"Hai B\u00e0 Tr\u01b0ng","region":"232","zip":null},{"id":"50","name":"H\u1ea3i Ch\u00e2u","region":"260","zip":null},{"id":"635","name":"H\u1ea3i H\u00e0","region":"252","zip":null},{"id":"577","name":"H\u1ea3i H\u1eadu","region":"248","zip":null},{"id":"133","name":"H\u1ea3i L\u0103ng","region":"268","zip":null},{"id":"250","name":"H\u00e0m T\u00e2n","region":"278","zip":null},{"id":"247","name":"H\u00e0m Thu\u1eadn B\u1eafc","region":"278","zip":null},{"id":"248","name":"H\u00e0m Thu\u1eadn Nam","region":"278","zip":null},{"id":"29","name":"H\u00e0m Y\u00ean","region":"257","zip":null},{"id":"7","name":"H\u1eadu L\u1ed9c","region":"256","zip":null},{"id":"447","name":"Hi\u1ec7p H\u00f2a","region":"234","zip":null},{"id":"146","name":"Hi\u1ec7p \u0110\u1ee9c","region":"269","zip":null},{"id":"465","name":"H\u00f2a An","region":"236","zip":null},{"id":"233","name":"H\u00f2a B\u00ecnh","region":"276","zip":null},{"id":"607","name":"Hoa L\u01b0","region":"250","zip":null},{"id":"359","name":"H\u00f2a Th\u00e0nh","region":"289","zip":null},{"id":"56","name":"H\u00f2a Vang","region":"260","zip":null},{"id":"61","name":"Ho\u00e0i \u00c2n","region":"261","zip":null},{"id":"62","name":"Ho\u00e0i Nh\u01a1n","region":"261","zip":null},{"id":"414","name":"Ho\u00e0n Ki\u1ebfm","region":"232","zip":null},{"id":"8","name":"Ho\u1eb1ng H\u00f3a","region":"256","zip":null},{"id":"415","name":"Ho\u00e0ng Mai","region":"232","zip":null},{"id":"57","name":"Ho\u00e0ng Sa","region":"260","zip":null},{"id":"484","name":"Ho\u00e0ng Su Ph\u00ec","region":"238","zip":null},{"id":"636","name":"Ho\u00e0nh B\u1ed3","region":"252","zip":null},{"id":"138","name":"H\u1ed9i An","region":"269","zip":null},{"id":"218","name":"H\u1edbn Qu\u1ea3n","region":"274","zip":null},{"id":"304","name":"H\u00f2n \u0110\u1ea5t","region":"284","zip":null},{"id":"522","name":"H\u1ed3ng B\u00e0ng","region":"242","zip":null},{"id":"229","name":"H\u1ed3ng D\u00e2n","region":"276","zip":null},{"id":"497","name":"H\u1ed3ng L\u0129nh","region":"240","zip":null},{"id":"283","name":"H\u1ed3ng Ng\u1ef1","region":"282","zip":null},{"id":"649","name":"H\u01b0ng H\u00e0","region":"254","zip":null},{"id":"591","name":"H\u01b0ng Nguy\u00ean","region":"249","zip":null},{"id":"134","name":"H\u01b0\u1edbng H\u00f3a","region":"268","zip":null},{"id":"501","name":"H\u01b0\u01a1ng Kh\u00ea","region":"240","zip":null},{"id":"502","name":"H\u01b0\u01a1ng S\u01a1n","region":"240","zip":null},{"id":"86","name":"H\u01b0\u01a1ng Th\u1ee7y","region":"263","zip":null},{"id":"87","name":"H\u01b0\u01a1ng Tr\u00e0","region":"263","zip":null},{"id":"571","name":"H\u1eefu L\u0169ng","region":"247","zip":null},{"id":"424","name":"Huy\u1ec7n Gia L\u00e2m","region":"232","zip":null},{"id":"425","name":"Huy\u1ec7n Ho\u00e0i \u0110\u1ee9c","region":"232","zip":null},{"id":"426","name":"Huy\u1ec7n M\u00ea Linh","region":"232","zip":null},{"id":"427","name":"Huy\u1ec7n M\u1ef9 \u0110\u1ee9c","region":"232","zip":null},{"id":"428","name":"Huy\u1ec7n Ph\u00fa Xuy\u00ean","region":"232","zip":null},{"id":"429","name":"Huy\u1ec7n Ph\u00fac Th\u1ecd","region":"232","zip":null},{"id":"430","name":"Huy\u1ec7n Qu\u1ed1c Oai","region":"232","zip":null},{"id":"431","name":"Huy\u1ec7n S\u00f3c S\u01a1n","region":"232","zip":null},{"id":"432","name":"Huy\u1ec7n Th\u1ea1ch Th\u1ea5t","region":"232","zip":null},{"id":"433","name":"Huy\u1ec7n Thanh Oai","region":"232","zip":null},{"id":"434","name":"Huy\u1ec7n Thanh Tr\u00ec","region":"232","zip":null},{"id":"435","name":"Huy\u1ec7n Th\u01b0\u1eddng T\u00edn","region":"232","zip":null},{"id":"436","name":"Huy\u1ec7n T\u1eeb Li\u00eam","region":"232","zip":null},{"id":"437","name":"Huy\u1ec7n \u1ee8ng H\u00f2a","region":"232","zip":null},{"id":"422","name":"Huy\u1ec7n \u0110an Ph\u01b0\u1ee3ng","region":"232","zip":null},{"id":"423","name":"Huy\u1ec7n \u0110\u00f4ng Anh","region":"232","zip":null},{"id":"80","name":"K'Bang","region":"262","zip":null},{"id":"346","name":"K\u1ebf S\u00e1ch","region":"288","zip":null},{"id":"108","name":"Kh\u00e1nh S\u01a1n","region":"265","zip":null},{"id":"107","name":"Kh\u00e1nh Vinh","region":"265","zip":null},{"id":"534","name":"Kho\u00e1i Ch\u00e2u","region":"243","zip":null},{"id":"546","name":"K\u00ec S\u01a1n","region":"244","zip":null},{"id":"521","name":"Ki\u1ebfn An","region":"242","zip":null},{"id":"305","name":"Ki\u00ean H\u1ea3i","region":"284","zip":null},{"id":"306","name":"Ki\u00ean L\u01b0\u01a1ng","region":"284","zip":null},{"id":"529","name":"Ki\u1ebfn Th\u1ee5y","region":"242","zip":null},{"id":"650","name":"Ki\u1ebfn X\u01b0\u01a1ng","region":"254","zip":null},{"id":"493","name":"Kim B\u1ea3ng","region":"239","zip":null},{"id":"545","name":"Kim B\u00f4i","region":"244","zip":null},{"id":"610","name":"Kim S\u01a1n","region":"250","zip":null},{"id":"511","name":"Kim Th\u00e0nh","region":"241","zip":null},{"id":"535","name":"Kim \u0110\u1ed9ng","region":"243","zip":null},{"id":"512","name":"Kinh M\u00f4n","region":"241","zip":null},{"id":"97","name":"Kon Plong","region":"264","zip":null},{"id":"98","name":"Kon R\u1eaby","region":"264","zip":null},{"id":"81","name":"Kong Chro","region":"262","zip":null},{"id":"399","name":"Kr\u00f4ng Ana","region":"293","zip":null},{"id":"397","name":"Kr\u00f4ng B\u00f4ng","region":"293","zip":null},{"id":"393","name":"Kr\u00f4ng B\u00fak","region":"293","zip":null},{"id":"394","name":"Kr\u00f4ng N\u0103ng","region":"293","zip":null},{"id":"407","name":"Kr\u00f4ng N\u00f4","region":"294","zip":null},{"id":"82","name":"Krong Pa","region":"262","zip":null},{"id":"398","name":"Kr\u00f4ng P\u1eafc","region":"293","zip":null},{"id":"503","name":"K\u1ef3 Anh","region":"240","zip":null},{"id":"593","name":"K\u1ef3 S\u01a1n","region":"249","zip":null},{"id":"244","name":"La Gi","region":"278","zip":null},{"id":"78","name":"La Grai","region":"262","zip":null},{"id":"79","name":"La Pa","region":"262","zip":null},{"id":"334","name":"L\u1ea1c D\u01b0\u01a1ng","region":"286","zip":null},{"id":"547","name":"L\u1ea1c S\u01a1n","region":"244","zip":null},{"id":"548","name":"L\u1ea1c Th\u1ee7y","region":"244","zip":null},{"id":"284","name":"Lai Vung","region":"282","zip":null},{"id":"400","name":"L\u1eafk","region":"293","zip":null},{"id":"33","name":"L\u00e2m B\u00ecnh","region":"257","zip":null},{"id":"335","name":"L\u00e2m H\u00e0","region":"286","zip":null},{"id":"616","name":"L\u00e2m Thao","region":"251","zip":null},{"id":"9","name":"Lang Ch\u00e1nh","region":"256","zip":null},{"id":"451","name":"L\u1ea1ng Giang","region":"234","zip":null},{"id":"36","name":"L\u1eadp Th\u1ea1ch","region":"258","zip":null},{"id":"285","name":"L\u1ea5p V\u00f2","region":"282","zip":null},{"id":"524","name":"L\u00ea Ch\u00e2n","region":"242","zip":null},{"id":"126","name":"L\u1ec7 Th\u1ee7y","region":"267","zip":null},{"id":"54","name":"Li\u00ean Chi\u1ec3u","region":"260","zip":null},{"id":"574","name":"L\u1ed9c B\u00ecnh","region":"247","zip":null},{"id":"507","name":"L\u1ed9c H\u00e0","region":"240","zip":null},{"id":"219","name":"L\u1ed9c Ninh ","region":"274","zip":null},{"id":"416","name":"Long Bi\u00ean","region":"232","zip":null},{"id":"382","name":"Long H\u1ed3","region":"292","zip":null},{"id":"271","name":"Long Kh\u00e1nh","region":"281","zip":null},{"id":"294","name":"Long M\u1ef9","region":"283","zip":null},{"id":"353","name":"Long Ph\u00fa","region":"288","zip":null},{"id":"273","name":"Long Th\u00e0nh","region":"281","zip":null},{"id":"192","name":"Long Xuy\u00ean","region":"272","zip":null},{"id":"220","name":"Long \u0110i\u1ec1n","region":"275","zip":null},{"id":"452","name":"L\u1ee5c Nam","region":"234","zip":null},{"id":"450","name":"L\u1ee5c Ng\u1ea1n","region":"234","zip":null},{"id":"43","name":"L\u1ee5c Y\u00ean","region":"259","zip":null},{"id":"542","name":"L\u01b0\u01a1ng S\u01a1n","region":"244","zip":null},{"id":"456","name":"L\u01b0\u01a1ng T\u00e0i","region":"235","zip":null},{"id":"494","name":"L\u00fd Nh\u00e2n","region":"239","zip":null},{"id":"167","name":"L\u00fd S\u01a1n","region":"270","zip":null},{"id":"396","name":"M'dr\u1eafk","region":"293","zip":null},{"id":"549","name":"Mai Ch\u00e2u","region":"244","zip":null},{"id":"643","name":"Mai S\u01a1n","region":"253","zip":null},{"id":"383","name":"Mang Th\u00edt","region":"292","zip":null},{"id":"83","name":"Mang Yang","region":"262","zip":null},{"id":"485","name":"M\u00e8o V\u1ea1c","region":"238","zip":null},{"id":"121","name":"Minh H\u00f3a","region":"267","zip":null},{"id":"158","name":"Minh Long","region":"270","zip":null},{"id":"239","name":"M\u1ecf C\u00e0y B\u1eafc","region":"277","zip":null},{"id":"240","name":"M\u1ecf C\u00e0y Nam","region":"277","zip":null},{"id":"159","name":"M\u1ed9 \u0110\u1ee9c","region":"270","zip":null},{"id":"646","name":"M\u1ed9c Ch\u00e2u","region":"253","zip":null},{"id":"318","name":"M\u1ed9c H\u00f3a","region":"285","zip":null},{"id":"625","name":"M\u00f3ng C\u00e1i","region":"252","zip":null},{"id":"44","name":"M\u00f9 Cang Ch\u1ea3i","region":"259","zip":null},{"id":"476","name":"M\u01b0\u1eddng \u1ea2ng","region":"237","zip":null},{"id":"477","name":"M\u01b0\u1eddng Ch\u00e0","region":"237","zip":null},{"id":"556","name":"M\u01b0\u1eddng Kh\u01b0\u01a1ng","region":"245","zip":null},{"id":"639","name":"M\u01b0\u1eddng La","region":"253","zip":null},{"id":"10","name":"M\u01b0\u1eddng L\u00e1t","region":"256","zip":null},{"id":"473","name":"M\u01b0\u1eddng Lay","region":"237","zip":null},{"id":"478","name":"M\u01b0\u1eddng Nh\u00e9","region":"237","zip":null},{"id":"560","name":"M\u01b0\u1eddng T\u00e8","region":"246","zip":null},{"id":"536","name":"M\u1ef9 H\u00e0o","region":"243","zip":null},{"id":"578","name":"M\u1ef9 L\u1ed9c","region":"248","zip":null},{"id":"363","name":"M\u1ef9 Tho","region":"290","zip":null},{"id":"348","name":"M\u1ef9 T\u00fa","region":"288","zip":null},{"id":"349","name":"M\u1ef9 Xuy\u00ean","region":"288","zip":null},{"id":"30","name":"Na Hang","region":"257","zip":null},{"id":"442","name":"Na R\u00ec","region":"233","zip":null},{"id":"259","name":"N\u0103m C\u0103n","region":"279","zip":null},{"id":"149","name":"Nam Giang","region":"269","zip":null},{"id":"513","name":"Nam S\u00e1ch","region":"241","zip":null},{"id":"142","name":"Nam Tr\u00e0 My","region":"269","zip":null},{"id":"579","name":"Nam Tr\u1ef1c","region":"248","zip":null},{"id":"594","name":"Nam \u0110\u00e0n","region":"249","zip":null},{"id":"89","name":"Nam \u0110\u00f4ng","region":"263","zip":null},{"id":"291","name":"Ng\u00e3 B\u1ea3y","region":"283","zip":null},{"id":"350","name":"Ng\u00e3 N\u0103m","region":"288","zip":null},{"id":"11","name":"Nga S\u01a1n","region":"256","zip":null},{"id":"443","name":"Ng\u00e2n S\u01a1n","region":"233","zip":null},{"id":"595","name":"Nghi L\u1ed9c","region":"249","zip":null},{"id":"504","name":"Nghi Xu\u00e2n","region":"240","zip":null},{"id":"160","name":"Ngh\u0129a H\u00e0nh","region":"270","zip":null},{"id":"580","name":"Ngh\u0129a H\u01b0ng","region":"248","zip":null},{"id":"42","name":"Ngh\u0129a L\u1ed9","region":"259","zip":null},{"id":"596","name":"Ngh\u0129a \u0110\u00e0n","region":"249","zip":null},{"id":"523","name":"Ng\u00f4 Quy\u1ec1n","region":"242","zip":null},{"id":"254","name":"Ng\u1ecdc Hi\u1ec3n","region":"279","zip":null},{"id":"99","name":"Ng\u1ecdc H\u1ed3i","region":"264","zip":null},{"id":"12","name":"Ng\u1ecdc L\u1eb7c","region":"256","zip":null},{"id":"53","name":"Ng\u0169 H\u00e0nh S\u01a1n","region":"260","zip":null},{"id":"466","name":"Nguy\u00ean B\u00ecnh","region":"236","zip":null},{"id":"102","name":"Nha Trang","region":"265","zip":null},{"id":"605","name":"Nho Quan","region":"250","zip":null},{"id":"274","name":"Nh\u01a1n Tr\u1ea1ch","region":"281","zip":null},{"id":"13","name":"Nh\u01b0 Thanh","region":"256","zip":null},{"id":"14","name":"Nh\u01b0 Xu\u00e2n","region":"256","zip":null},{"id":"514","name":"Ninh Giang","region":"241","zip":null},{"id":"339","name":"Ninh H\u1ea3i","region":"287","zip":null},{"id":"104","name":"Ninh H\u00f2a","region":"265","zip":null},{"id":"261","name":"Ninh Ki\u1ec1u","region":"280","zip":null},{"id":"340","name":"Ninh Ph\u01b0\u1edbc","region":"287","zip":null},{"id":"341","name":"Ninh S\u01a1n","region":"287","zip":null},{"id":"15","name":"N\u00f4ng C\u1ed1ng","region":"256","zip":null},{"id":"147","name":"N\u00f4ng S\u01a1n","region":"269","zip":null},{"id":"143","name":"N\u00fai Th\u00e0nh","region":"269","zip":null},{"id":"264","name":"\u00d4 M\u00f4n","region":"280","zip":null},{"id":"444","name":"P\u00e1c N\u1ea1m","region":"233","zip":null},{"id":"337","name":"Phan Rang - Th\u00e1p Ch\u00e0m","region":"287","zip":null},{"id":"243","name":"Phan Thi\u1ebft","region":"278","zip":null},{"id":"659","name":"Ph\u1ed5 Y\u00ean","region":"255","zip":null},{"id":"561","name":"Phong Th\u1ed5","region":"246","zip":null},{"id":"90","name":"Phong \u0110i\u1ec1n","region":"263","zip":null},{"id":"266","name":"Phong \u0110i\u1ec1n","region":"280","zip":null},{"id":"660","name":"Ph\u00fa B\u00ecnh","region":"255","zip":null},{"id":"63","name":"Ph\u00f9 C\u00e1t","region":"261","zip":null},{"id":"537","name":"Ph\u00f9 C\u1eeb","region":"243","zip":null},{"id":"209","name":"Ph\u00fa Gi\u00e1o","region":"273","zip":null},{"id":"115","name":"Ph\u00fa H\u00f2a","region":"266","zip":null},{"id":"91","name":"Ph\u00fa L\u1ed9c","region":"263","zip":null},{"id":"661","name":"Ph\u00fa L\u01b0\u01a1ng","region":"255","zip":null},{"id":"491","name":"Ph\u1ee7 L\u00fd","region":"239","zip":null},{"id":"64","name":"Ph\u00f9 M\u1ef9","region":"261","zip":null},{"id":"151","name":"Ph\u00fa Ninh","region":"269","zip":null},{"id":"617","name":"Ph\u00f9 Ninh","region":"251","zip":null},{"id":"92","name":"Ph\u00fa Quang","region":"263","zip":null},{"id":"307","name":"Ph\u00fa Qu\u1ed1c","region":"284","zip":null},{"id":"252","name":"Ph\u00fa Qu\u00fd","region":"278","zip":null},{"id":"199","name":"Ph\u00fa T\u00e2n","region":"272","zip":null},{"id":"260","name":"Ph\u00fa T\u00e2n","region":"279","zip":null},{"id":"84","name":"Ph\u00fa Thi\u1ec7n","region":"262","zip":null},{"id":"612","name":"Ph\u00fa Th\u1ecd","region":"251","zip":null},{"id":"641","name":"Ph\u00f9 Y\u00ean","region":"253","zip":null},{"id":"467","name":"Ph\u1ee5c H\u00f2a","region":"236","zip":null},{"id":"34","name":"Ph\u00fac Y\u00ean","region":"258","zip":null},{"id":"295","name":"Ph\u1ee5ng Hi\u1ec7p","region":"283","zip":null},{"id":"228","name":"Ph\u01b0\u1edbc Long","region":"276","zip":null},{"id":"212","name":"Ph\u01b0\u1edbc Long","region":"274","zip":null},{"id":"144","name":"Ph\u01b0\u1edbc S\u01a1n","region":"269","zip":null},{"id":"69","name":"Pleiku","region":"262","zip":null},{"id":"168","name":"Qu\u1eadn 1","region":"271","zip":null},{"id":"177","name":"Qu\u1eadn 10","region":"271","zip":null},{"id":"178","name":"Qu\u1eadn 11","region":"271","zip":null},{"id":"179","name":"Qu\u1eadn 12","region":"271","zip":null},{"id":"169","name":"Qu\u1eadn 2","region":"271","zip":null},{"id":"170","name":"Qu\u1eadn 3","region":"271","zip":null},{"id":"171","name":"Qu\u1eadn 4","region":"271","zip":null},{"id":"172","name":"Qu\u1eadn 5","region":"271","zip":null},{"id":"173","name":"Qu\u1eadn 6","region":"271","zip":null},{"id":"174","name":"Qu\u1eadn 7","region":"271","zip":null},{"id":"175","name":"Qu\u1eadn 8","region":"271","zip":null},{"id":"176","name":"Qu\u1eadn 9","region":"271","zip":null},{"id":"486","name":"Qu\u1ea3n B\u1ea1","region":"238","zip":null},{"id":"189","name":"Qu\u1eadn B\u00ecnh Ch\u00e1nh","region":"271","zip":null},{"id":"186","name":"Qu\u1eadn B\u00ecnh T\u00e2n","region":"271","zip":null},{"id":"183","name":"Qu\u1eadn B\u00ecnh Th\u1ea1nh","region":"271","zip":null},{"id":"191","name":"Qu\u1eadn C\u1ea7n Gi\u1edd","region":"271","zip":null},{"id":"187","name":"Qu\u1eadn C\u1ee7 Chi","region":"271","zip":null},{"id":"180","name":"Qu\u1eadn G\u00f2 V\u1ea5p","region":"271","zip":null},{"id":"16","name":"Quan H\u00f3a","region":"256","zip":null},{"id":"188","name":"Qu\u1eadn H\u00f3c M\u00f4n","region":"271","zip":null},{"id":"190","name":"Qu\u1eadn Nh\u00e0 B\u00e8","region":"271","zip":null},{"id":"184","name":"Qu\u1eadn Ph\u00fa Nhu\u1eadn","region":"271","zip":null},{"id":"17","name":"Quan S\u01a1n","region":"256","zip":null},{"id":"181","name":"Qu\u1eadn T\u00e2n B\u00ecnh","region":"271","zip":null},{"id":"182","name":"Qu\u1eadn T\u00e2n Ph\u00fa","region":"271","zip":null},{"id":"185","name":"Qu\u1eadn Th\u1ee7 \u0110\u1ee9c","region":"271","zip":null},{"id":"487","name":"Quang B\u00ecnh","region":"238","zip":null},{"id":"125","name":"Qu\u1ea3ng Ninh","region":"267","zip":null},{"id":"123","name":"Qu\u1ea3ng Tr\u1ea1ch","region":"267","zip":null},{"id":"128","name":"Qu\u1ea3ng Tr\u1ecb","region":"268","zip":null},{"id":"468","name":"Qu\u1ea3ng Uy\u00ean","region":"236","zip":null},{"id":"18","name":"Qu\u1ea3ng X\u01b0\u01a1ng","region":"256","zip":null},{"id":"628","name":"Qu\u1ea3ng Y\u00ean","region":"252","zip":null},{"id":"93","name":"Qu\u1ea3ng \u0110i\u1ec1n","region":"263","zip":null},{"id":"597","name":"Qu\u1ebf Phong","region":"249","zip":null},{"id":"154","name":"Qu\u1ebf S\u01a1n","region":"269","zip":null},{"id":"457","name":"Qu\u1ebf V\u00f5","region":"235","zip":null},{"id":"592","name":"Qu\u1ef3 Ch\u00e2u","region":"249","zip":null},{"id":"598","name":"Qu\u1ef3 H\u1ee3p","region":"249","zip":null},{"id":"58","name":"Quy Nh\u01a1n","region":"261","zip":null},{"id":"599","name":"Qu\u1ef3nh L\u01b0u","region":"249","zip":null},{"id":"638","name":"Qu\u1ef3nh Nhai","region":"253","zip":null},{"id":"651","name":"Qu\u1ef3nh Ph\u1ee5","region":"254","zip":null},{"id":"297","name":"R\u1ea1ch Gi\u00e1","region":"284","zip":null},{"id":"557","name":"Sa Pa","region":"245","zip":null},{"id":"100","name":"Sa Th\u1ea7y","region":"264","zip":null},{"id":"2","name":"S\u1ea7m S\u01a1n","region":"256","zip":null},{"id":"562","name":"S\u00ecn H\u1ed3","region":"246","zip":null},{"id":"354","name":"S\u00f3c Tr\u0103ng","region":"288","zip":null},{"id":"31","name":"S\u01a1n D\u01b0\u01a1ng","region":"257","zip":null},{"id":"161","name":"S\u01a1n H\u00e0","region":"270","zip":null},{"id":"116","name":"S\u01a1n H\u00f2a","region":"266","zip":null},{"id":"162","name":"S\u01a1n T\u00e2y","region":"270","zip":null},{"id":"419","name":"S\u01a1n T\u00e2y","region":"232","zip":null},{"id":"163","name":"S\u01a1n T\u1ecbnh","region":"270","zip":null},{"id":"52","name":"S\u01a1n Tr\u00e0","region":"260","zip":null},{"id":"448","name":"S\u01a1n \u0110\u1ed9ng","region":"234","zip":null},{"id":"112","name":"S\u00f4ng C\u1ea7u","region":"266","zip":null},{"id":"655","name":"S\u00f4ng C\u00f4ng","region":"255","zip":null},{"id":"117","name":"S\u00f4ng Hinh","region":"266","zip":null},{"id":"37","name":"S\u00f4ng L\u00f4","region":"258","zip":null},{"id":"644","name":"S\u00f4ng M\u00e3","region":"253","zip":null},{"id":"647","name":"S\u1ed1p C\u1ed9p","region":"253","zip":null},{"id":"384","name":"Tam B\u00ecnh","region":"292","zip":null},{"id":"604","name":"Tam B\u00ecnh","region":"250","zip":null},{"id":"38","name":"Tam D\u01b0\u01a1ng","region":"258","zip":null},{"id":"137","name":"Tam K\u1ef3","region":"269","zip":null},{"id":"618","name":"Tam N\u00f4ng","region":"251","zip":null},{"id":"286","name":"Tam N\u00f4ng","region":"282","zip":null},{"id":"39","name":"Tam \u0110\u1ea3o","region":"258","zip":null},{"id":"563","name":"Tam \u0110\u01b0\u1eddng","region":"246","zip":null},{"id":"311","name":"T\u00e2n An","region":"285","zip":null},{"id":"355","name":"T\u00e2n Bi\u00ean","region":"289","zip":null},{"id":"356","name":"T\u00e2n Ch\u00e2u","region":"289","zip":null},{"id":"194","name":"T\u00e2n Ch\u00e2u","region":"272","zip":null},{"id":"308","name":"T\u00e2n Hi\u1ec7p","region":"284","zip":null},{"id":"287","name":"T\u00e2n H\u1ed3ng","region":"282","zip":null},{"id":"319","name":"T\u00e2n H\u01b0ng","region":"285","zip":null},{"id":"600","name":"T\u00e2n K\u1ef3","region":"249","zip":null},{"id":"550","name":"T\u00e2n L\u1ea1c","region":"244","zip":null},{"id":"275","name":"T\u00e2n Ph\u00fa","region":"281","zip":null},{"id":"372","name":"T\u00e2n Ph\u00fa \u0110\u00f4ng","region":"290","zip":null},{"id":"370","name":"T\u00e2n Ph\u01b0\u1edbc","region":"290","zip":null},{"id":"619","name":"T\u00e2n S\u01a1n","region":"251","zip":null},{"id":"223","name":"T\u00e2n Th\u00e0nh","region":"275","zip":null},{"id":"320","name":"T\u00e2n Th\u1ea1nh","region":"285","zip":null},{"id":"321","name":"T\u00e2n Tr\u1ee5","region":"285","zip":null},{"id":"565","name":"T\u00e2n Uy\u00ean","region":"246","zip":null},{"id":"208","name":"T\u00e2n Uy\u00ean","region":"273","zip":null},{"id":"446","name":"T\u00e2n Y\u00ean","region":"234","zip":null},{"id":"249","name":"T\u00e1nh Linh","region":"278","zip":null},{"id":"152","name":"T\u00e2y Giang","region":"269","zip":null},{"id":"417","name":"T\u00e2y H\u1ed3","region":"232","zip":null},{"id":"118","name":"T\u00e2y H\u00f2a","region":"266","zip":null},{"id":"66","name":"T\u00e2y S\u01a1n","region":"261","zip":null},{"id":"164","name":"T\u00e2y Tr\u00e0","region":"270","zip":null},{"id":"469","name":"Th\u1ea1ch An","region":"236","zip":null},{"id":"505","name":"Th\u1ea1ch H\u00e0","region":"240","zip":null},{"id":"19","name":"Th\u1ea1ch Th\u00e0nh","region":"256","zip":null},{"id":"586","name":"Th\u00e1i H\u00f2a","region":"249","zip":null},{"id":"652","name":"Th\u00e1i Th\u1ee5y","region":"254","zip":null},{"id":"564","name":"Than Uy\u00ean","region":"246","zip":null},{"id":"140","name":"Th\u0103ng B\u00ecnh","region":"269","zip":null},{"id":"620","name":"Thanh Ba","region":"251","zip":null},{"id":"288","name":"Thanh B\u00ecnh","region":"282","zip":null},{"id":"601","name":"Thanh Ch\u01b0\u01a1ng","region":"249","zip":null},{"id":"515","name":"Thanh H\u00e0","region":"241","zip":null},{"id":"27","name":"Thanh H\u00f3a","region":"256","zip":null},{"id":"322","name":"Thanh H\u00f3a","region":"285","zip":null},{"id":"51","name":"Thanh Kh\u00ea","region":"260","zip":null},{"id":"495","name":"Thanh Li\u00eam","region":"239","zip":null},{"id":"516","name":"Thanh Mi\u1ec7n","region":"241","zip":null},{"id":"241","name":"Th\u1ea1nh Ph\u00fa","region":"277","zip":null},{"id":"621","name":"Thanh S\u01a1n","region":"251","zip":null},{"id":"622","name":"Thanh Th\u1ee7y","region":"251","zip":null},{"id":"352","name":"Th\u1ea1nh Tr\u1ecb","region":"288","zip":null},{"id":"418","name":"Thanh Xu\u00e2n","region":"232","zip":null},{"id":"289","name":"Th\u00e1p M\u01b0\u1eddi","region":"282","zip":null},{"id":"20","name":"Thi\u1ec7u H\u00f3a","region":"256","zip":null},{"id":"21","name":"Th\u1ecd Xu\u00e2n","region":"256","zip":null},{"id":"200","name":"Tho\u1ea1i S\u01a1n","region":"272","zip":null},{"id":"258","name":"Th\u1edbi B\u00ecnh","region":"279","zip":null},{"id":"268","name":"Th\u1edbi Lai","region":"280","zip":null},{"id":"276","name":"Th\u1ed1ng Nh\u1ea5t","region":"281","zip":null},{"id":"470","name":"Th\u00f4ng N\u00f4ng","region":"236","zip":null},{"id":"265","name":"Th\u1ed1t N\u1ed1t","region":"280","zip":null},{"id":"203","name":"Th\u1ee7 D\u1ea7u M\u1ed9t","region":"273","zip":null},{"id":"323","name":"Th\u1ee7 Th\u1eeba","region":"285","zip":null},{"id":"204","name":"Thu\u1eadn An","region":"273","zip":null},{"id":"342","name":"Thu\u1eadn B\u1eafc","region":"287","zip":null},{"id":"640","name":"Thu\u1eadn Ch\u00e2u","region":"253","zip":null},{"id":"343","name":"Thu\u1eadn Nam","region":"287","zip":null},{"id":"458","name":"Thu\u1eadn Th\u00e0nh","region":"235","zip":null},{"id":"22","name":"Th\u01b0\u1eddng Xu\u00e2n","region":"256","zip":null},{"id":"532","name":"Th\u1ee7y Nguy\u00ean","region":"242","zip":null},{"id":"459","name":"Ti\u00ean Du","region":"235","zip":null},{"id":"653","name":"Ti\u1ec1n H\u1ea3i","region":"254","zip":null},{"id":"530","name":"Ti\u00ean L\u00e3ng","region":"242","zip":null},{"id":"538","name":"Ti\u00ean L\u1eef","region":"243","zip":null},{"id":"145","name":"Ti\u00ean Ph\u01b0\u1edbc","region":"269","zip":null},{"id":"630","name":"Ti\u00ean Y\u00ean","region":"252","zip":null},{"id":"375","name":"Ti\u1ec3u C\u1ea7n","region":"291","zip":null},{"id":"201","name":"T\u1ecbnh Bi\u00ean","region":"272","zip":null},{"id":"23","name":"T\u0129nh Gia","region":"256","zip":null},{"id":"165","name":"Tr\u00e0 b\u1ed3ng","region":"270","zip":null},{"id":"378","name":"Tr\u00e0 C\u00fa","region":"291","zip":null},{"id":"471","name":"Tr\u00e0 L\u0129nh","region":"236","zip":null},{"id":"385","name":"Tr\u00e0 \u00d4n","region":"292","zip":null},{"id":"46","name":"Tr\u1ea1m T\u1ea5u","region":"259","zip":null},{"id":"256","name":"Tr\u1ea7n V\u0103n Th\u1eddi","region":"279","zip":null},{"id":"45","name":"Tr\u1ea5n Y\u00ean","region":"259","zip":null},{"id":"351","name":"Tr\u1ea7n \u0110\u1ec1","region":"288","zip":null},{"id":"362","name":"Tr\u1ea3ng B\u00e0ng","region":"289","zip":null},{"id":"280","name":"Tr\u1ea3ng Bom","region":"281","zip":null},{"id":"566","name":"Tr\u00e0ng \u0110\u00ecnh","region":"247","zip":null},{"id":"202","name":"Tri T\u00f4n","region":"272","zip":null},{"id":"135","name":"Tri\u1ec7u Phong","region":"268","zip":null},{"id":"24","name":"Tri\u1ec7u S\u01a1n","region":"256","zip":null},{"id":"581","name":"Tr\u1ef1c Ninh","region":"248","zip":null},{"id":"472","name":"Tr\u00f9ng Kh\u00e1nh","region":"236","zip":null},{"id":"110","name":"Tr\u01b0\u1eddng Sa","region":"265","zip":null},{"id":"517","name":"T\u1ee9 K\u1ef3","region":"241","zip":null},{"id":"101","name":"Tu M\u01a1 R\u00f4ng","region":"264","zip":null},{"id":"166","name":"T\u01b0 Ngh\u0129a","region":"270","zip":null},{"id":"454","name":"T\u1eeb S\u01a1n","region":"235","zip":null},{"id":"479","name":"T\u1ee7a Ch\u00f9a","region":"237","zip":null},{"id":"480","name":"Tu\u1ea7n Gi\u00e1o","region":"237","zip":null},{"id":"602","name":"T\u01b0\u01a1ng D\u01b0\u01a1ng","region":"249","zip":null},{"id":"119","name":"Tuy An","region":"266","zip":null},{"id":"111","name":"Tuy H\u00f2a","region":"266","zip":null},{"id":"245","name":"Tuy Phong","region":"278","zip":null},{"id":"65","name":"Tuy Ph\u01b0\u1edbc","region":"261","zip":null},{"id":"408","name":"Tuy \u0110\u1ee9c","region":"294","zip":null},{"id":"122","name":"Tuy\u00ean H\u00f3a","region":"267","zip":null},{"id":"257","name":"U Minh","region":"279","zip":null},{"id":"310","name":"U Minh Th\u01b0\u1ee3ng","region":"284","zip":null},{"id":"626","name":"U\u00f4ng B\u00ed","region":"252","zip":null},{"id":"559","name":"V\u0103n B\u00e0n","region":"245","zip":null},{"id":"67","name":"V\u00e2n Canh","region":"261","zip":null},{"id":"47","name":"V\u0103n Ch\u1ea5n","region":"259","zip":null},{"id":"539","name":"V\u0103n Giang","region":"243","zip":null},{"id":"540","name":"V\u0103n L\u00e2m","region":"243","zip":null},{"id":"567","name":"V\u0103n L\u00e3ng","region":"247","zip":null},{"id":"105","name":"V\u1ea1n Ninh","region":"265","zip":null},{"id":"568","name":"V\u0103n Quang","region":"247","zip":null},{"id":"48","name":"V\u0103n Y\u00ean","region":"259","zip":null},{"id":"637","name":"V\u00e2n \u0110\u1ed3n","region":"252","zip":null},{"id":"290","name":"V\u1ecb Thanh","region":"283","zip":null},{"id":"296","name":"V\u1ecb Th\u1ee7y","region":"283","zip":null},{"id":"488","name":"V\u1ecb Xuy\u00ean","region":"238","zip":null},{"id":"611","name":"Vi\u1ec7t Tr\u00ec","region":"251","zip":null},{"id":"449","name":"Vi\u1ec7t Y\u00ean","region":"234","zip":null},{"id":"531","name":"V\u0129nh B\u1ea3o","region":"242","zip":null},{"id":"344","name":"V\u0129nh Ch\u00e2u","region":"288","zip":null},{"id":"277","name":"V\u0129nh C\u1eedu","region":"281","zip":null},{"id":"324","name":"V\u0129nh H\u01b0ng","region":"285","zip":null},{"id":"136","name":"V\u0129nh Linh","region":"268","zip":null},{"id":"25","name":"V\u0129nh L\u1ed9c","region":"256","zip":null},{"id":"230","name":"V\u0129nh L\u1ee3i","region":"276","zip":null},{"id":"387","name":"V\u0129nh Long","region":"292","zip":null},{"id":"68","name":"V\u0129nh Th\u1ea1nh","region":"261","zip":null},{"id":"269","name":"V\u0129nh Th\u1ea1nh","region":"280","zip":null},{"id":"309","name":"V\u0129nh Thu\u1eadn","region":"284","zip":null},{"id":"40","name":"V\u0129nh T\u01b0\u1eddng","region":"258","zip":null},{"id":"662","name":"V\u00f5 Nhai","region":"255","zip":null},{"id":"582","name":"V\u1ee5 B\u1ea3n","region":"248","zip":null},{"id":"506","name":"V\u0169 Quang","region":"240","zip":null},{"id":"654","name":"V\u0169 Th\u01b0","region":"254","zip":null},{"id":"386","name":"V\u0169ng Li\u00eam","region":"292","zip":null},{"id":"226","name":"V\u0169ng T\u00e0u","region":"275","zip":null},{"id":"558","name":"Xi Ma Cai","region":"245","zip":null},{"id":"489","name":"X\u00edn M\u1ea7n","region":"238","zip":null},{"id":"278","name":"Xu\u00e2n L\u1ed9c","region":"281","zip":null},{"id":"583","name":"Xu\u00e2n Tr\u01b0\u1eddng","region":"248","zip":null},{"id":"225","name":"Xuy\u00ean M\u1ed9c","region":"275","zip":null},{"id":"584","name":"\u00dd Y\u00ean","region":"248","zip":null},{"id":"49","name":"Y\u00ean B\u00ecnh  ","region":"259","zip":null},{"id":"645","name":"Y\u00ean Ch\u00e2u","region":"253","zip":null},{"id":"453","name":"Y\u00ean D\u0169ng","region":"234","zip":null},{"id":"608","name":"Y\u00ean Kh\u00e1nh","region":"250","zip":null},{"id":"41","name":"Y\u00ean L\u1ea1c","region":"258","zip":null},{"id":"623","name":"Y\u00ean L\u1eadp","region":"251","zip":null},{"id":"490","name":"Y\u00ean Minh","region":"238","zip":null},{"id":"609","name":"Y\u00ean M\u00f4","region":"250","zip":null},{"id":"541","name":"Y\u00ean M\u1ef9","region":"243","zip":null},{"id":"460","name":"Y\u00ean Phong","region":"235","zip":null},{"id":"32","name":"Y\u00ean S\u01a1n","region":"257","zip":null},{"id":"603","name":"Y\u00ean Th\u00e0nh","region":"249","zip":null},{"id":"445","name":"Y\u00ean Th\u1ebf","region":"234","zip":null},{"id":"551","name":"Y\u00ean Th\u1ee7y","region":"244","zip":null},{"id":"26","name":"Y\u00ean \u0110\u1ecbnh","region":"256","zip":null},{"id":"544","name":"\u0110\u00e0 B\u1eafc","region":"244","zip":null},{"id":"331","name":"\u0110\u1ea1 Huoai","region":"286","zip":null},{"id":"131","name":"\u0110a Krong","region":"268","zip":null},{"id":"325","name":"\u0110\u00e0 L\u1ea1t","region":"286","zip":null},{"id":"332","name":"\u0110\u1ea1 T\u1ebbh","region":"286","zip":null},{"id":"150","name":"\u0110\u1ea1i L\u1ed9c","region":"269","zip":null},{"id":"656","name":"\u0110\u1ea1i T\u1eeb","region":"255","zip":null},{"id":"94","name":"\u0110ak Glei","region":"264","zip":null},{"id":"403","name":"\u0110\u1eafk Glong","region":"294","zip":null},{"id":"95","name":"\u0110ak H\u00e0","region":"264","zip":null},{"id":"404","name":"\u0110\u1eafk Mil","region":"294","zip":null},{"id":"76","name":"\u0110\u0103k P\u01a1","region":"262","zip":null},{"id":"405","name":"\u0110\u1eafk R'L\u1ea5p","region":"294","zip":null},{"id":"406","name":"\u0110\u1eafk Song","region":"294","zip":null},{"id":"96","name":"\u0110ak T\u00f4","region":"264","zip":null},{"id":"75","name":"\u0110\u0103k \u0110oa","region":"262","zip":null},{"id":"253","name":"\u0110\u1ea7m D\u01a1i","region":"279","zip":null},{"id":"634","name":"\u0110\u1ea7m H\u00e0","region":"252","zip":null},{"id":"330","name":"\u0110am R\u00f4ng","region":"286","zip":null},{"id":"221","name":"\u0110\u1ea5t \u0110\u1ecf","region":"275","zip":null},{"id":"139","name":"\u0110i\u1ec7n B\u00e0n","region":"269","zip":null},{"id":"474","name":"\u0110i\u1ec7n Bi\u00ean","region":"237","zip":null},{"id":"475","name":"\u0110i\u1ec7n Bi\u00ean \u0110\u00f4ng","region":"237","zip":null},{"id":"657","name":"\u0110\u1ecbnh H\u00f3a","region":"255","zip":null},{"id":"575","name":"\u0110\u00ecnh L\u1eadp","region":"247","zip":null},{"id":"272","name":"\u0110\u1ecbnh Qu\u00e1n","region":"281","zip":null},{"id":"590","name":"\u0110\u00f4 L\u01b0\u01a1ng","region":"249","zip":null},{"id":"519","name":"\u0110\u1ed3 S\u01a1n","region":"242","zip":null},{"id":"614","name":"\u0110oan H\u00f9ng","region":"251","zip":null},{"id":"333","name":"\u0110\u01a1n D\u01b0\u01a1ng","region":"286","zip":null},{"id":"148","name":"\u0110\u00f4ng Giang","region":"269","zip":null},{"id":"127","name":"\u0110\u00f4ng H\u00e0","region":"268","zip":null},{"id":"232","name":"\u0110\u00f4ng H\u1ea3i","region":"276","zip":null},{"id":"113","name":"\u0110\u00f4ng H\u00f2a","region":"266","zip":null},{"id":"120","name":"\u0110\u1ed3ng H\u1edbi","region":"267","zip":null},{"id":"648","name":"\u0110\u00f4ng H\u01b0ng","region":"254","zip":null},{"id":"658","name":"\u0110\u1ed3ng H\u1ef7","region":"255","zip":null},{"id":"217","name":"\u0110\u1ed3ng Ph\u00fa","region":"274","zip":null},{"id":"5","name":"\u0110\u00f4ng S\u01a1n","region":"256","zip":null},{"id":"629","name":"\u0110\u00f4ng Tri\u1ec1u","region":"252","zip":null},{"id":"481","name":"\u0110\u1ed3ng V\u0103n","region":"238","zip":null},{"id":"210","name":"\u0110\u1ed3ng Xo\u00e0i","region":"274","zip":null},{"id":"114","name":"\u0110\u1ed3ng Xu\u00e2n","region":"266","zip":null},{"id":"411","name":"\u0110\u1ed1ng \u0110a","region":"232","zip":null},{"id":"77","name":"\u0110\u1ee9c C\u01a1","region":"262","zip":null},{"id":"316","name":"\u0110\u1ee9c H\u00f2a","region":"285","zip":null},{"id":"317","name":"\u0110\u1ee9c Hu\u1ec7","region":"285","zip":null},{"id":"251","name":"\u0110\u1ee9c Linh","region":"278","zip":null},{"id":"157","name":"\u0110\u1ee9c Ph\u1ed5","region":"270","zip":null},{"id":"500","name":"\u0110\u1ee9c Th\u1ecd","region":"240","zip":null},{"id":"336","name":"\u0110\u1ee9c Tr\u1ecdng","region":"286","zip":null}];
    $('#shipping_address_region').change(function(e) {
        $('#shipping_address_city').children('option').remove();
        if($(this).val() != '') {
            var regionId = $(this).val();
            $('#shipping_province_name').val($('#address_region option:selected').text())
            $('#shipping_address_city').append('<option value="">- Choose a City</option>').append(createOptions(citiesList, regionId));
        }
    });
    $("#shipping_address_city").change(function () {
    		$('#shipping_city_name').val($('#address_city option:selected').text())
      })
		
/* ]]> */
</script>
            				</if>	
EOF;
	}
	
	function deleteCart($option = array()) {
		global $bw;
		$BWHTML .= <<<EOF
		{$this->getAddon()->getProductCategory($option)}
		<div id="content">
		Giỏ hàng đã được xóa!
		</div>
EOF;
	}

	function showOrderItem($option,$tyle,$obj=array()){
		global $vsPrint,$bw,$vsUser;
		$this->total = 0;
		
		$info = unserialize($obj->getUserinfo());
		$city2 = explode("|", $info['city']);
		$province2 = explode("|", $info['province']);
		
		$BWHTML .= <<<EOF
		<div id="dondathang">
		<if="$tyle">
		<p>Chào <strong>{$vsUser->obj->getFirstName()}</strong></p><br />

<p>Cảm ơn Quý khách đã mua hàng. Đơn hàng của Quý khách</p>
		<else />
		<strong style="border-bottom: 1px solid rgb(0, 0, 0); padding-bottom: 5px; margin-bottom: 10px;">Thông tin khách hàng</strong>
		<p><b>Tên:</b> {$obj->getTitle()}</p>
		<p><b>Địa chỉ:</b> {$obj->getAddress()}</p>
		<p><b>Email:</b> {$obj->getEmail()}</p>
		<p><b>Điện thoại:</b> {$obj->getPhone()}</p>
		<p><b>Thời gian đặt hàng:</b> {$this->dateTimeFormat($obj->getPostDate(),"h:i d/m/Y") }</p>
		
</if>

       <table style="border:1px solid #dbd9d9;
	margin-top:13px;
	margin-bottom:14px;border-collapse: collapse;" width="100%">
        	<tr style="height:37px;
	background:#f7f7f7;">
            	<th style="padding:16px 0px 12px 11px;	text-align:left;	border:1px solid #dbd9d9;width:319px;text-align:center;">Tên sản phẩm </th>
                <th style="padding:16px 0px 12px 11px;	text-align:left;	border:1px solid #dbd9d9;width:40px;text-align:center;">Số lượng</th>
                <th style="padding:16px 0px 12px 11px;	text-align:left;	border:1px solid #dbd9d9;width:121px;text-align:center;">Đơn giá</th>
                <th style="padding:16px 0px 12px 11px;	text-align:left;	border:1px solid #dbd9d9;width:121px;text-align:center;">Thành tiền</th>
            </tr>
			<foreach="$option as $item">
					<php>
						$price = $item['saleOff']?$item['saleOff']:$item['price'];
                        $price_tt= $price*$item['quantity'];
                        $this->total += $price*$item['quantity'];
					</php>
 					 <tr>
		            	<td style="padding:15px 0px 15px 30px;	border:1px solid #dbd9d9;">
		                    <div style="">
		                    	<p > {$item['title']} </p>
								<div style="color:#e6206f;font-weight:bold;float:left"><span style="float: left; line-height: 20px;">Màu:</span> <p style="background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #CCCCCC;display: block;float: left;height: 18px;margin: 0 2px; overflow: hidden;  padding: 1px;width: 18px;"><span  style="background-color:#{$item['type']};height:18px;width:18px;display:block"> </span></p></div>
		                    </div>
		                    <div class="clear_left"></div>
		                </td>
		                <td style="padding:15px 0px 15px 30px;	border:1px solid #dbd9d9;">
		                	{$item['quantity']}
		                </td>
		                 <td style="padding:15px 0px 15px 15px;	border:1px solid #dbd9d9;">
		                	{$this->numberFormat($price)} VNĐ
		                </td>
		                <td style="padding:15px 0px 15px 15px;	border:1px solid #dbd9d9;">
		                	{$this->numberFormat($price_tt)} VNĐ
		                </td>
		            </tr>
                	</foreach>
	
            <tr style="border-bottom:none;	background:#f7f7f7;">
            	<td colspan="3" style="text-align: right; font-weight: bold; padding:15px 10px 15px 15px;border:1px solid #dbd9d9;">
		                    Tổng tiền
		                </td>
                <td style="padding:15px 0 15px 15px;border:1px solid #dbd9d9;">
                    <span>{$this->numberFormat($this->total,0)} VNĐ</span>
                </td>
            </tr>
        </tbody></table>
                    		<p>Trân trọng,<br />

Idea Mobile</p>
    </div>
EOF;
	}
}
