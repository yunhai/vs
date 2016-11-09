<?php
class skin_orders {

	function mainHtml($projectlist = "",$message="") {
		global $vsLang, $bw;
		$BWHTML .= <<<EOF
		{$projectlist}
EOF;
		return $BWHTML;
	}

function billName($option){
		global $bw, $vsLang, $vsUser, $vsMenu,$vsPrint,$vsTemplate,$vsSettings;
       
                $vsPrint->addJavaScriptFile ("jquery.numeric",1);
                //$vsPrint->addGlobalCSSFile('jquery/base/ui.core');
                //$vsPrint->addGlobalCSSFile('jquery/base/ui.theme');
               // $vsPrint->addGlobalCSSFile('jquery/base/ui.dialog');
                //$vsPrint->addJavaScriptFile('jquery/ui.dialog');
                //$this->vsLang=$vsLang;
		$BWHTML .= <<<EOF
		
     	{$this->defineHead()}
           
     	<div class="giohang_form">
           <h3 style="text-transform:uppercase;">{$vsLang->getWords("orders_infocart","thông tin giỏ hàng")}</h3>     
  		<if="$option['orderItem']">
    	<table border="1" width="100%">
        	<tr>
             	<th class="giohang_col2">{$vsLang->getWords("orders_tensp","Tên sản phẩm")}</th>
              	<if="$vsSettings->getSystemKey("order_type",0, "orders", 0, 1)">
             	<th>{$vsLang->getWords("orders_loai","Loại")}</th>
              	</if>
             	<th class="giohang_col3">{$vsLang->getWords("orders_soluong","Số lượng")}</th>
               	<th class="giohang_col4">{$vsLang->getWords("orders_dongia","Đơn giá")}</th>
              	<th class="giohang_col5">{$vsLang->getWords("orders_thanhtien","Thành tiền")}</th>
            </tr>
          	<foreach="$option['orderItem'] as $obj">
          	<tr>
                <td class="giohang_col2">
                	<a href="{$obj->getUrl('products')}" title="{$obj->getTitle()}">{$obj->createImageCache($obj->getImage(),42,44)}</a>
                    <p>{$obj->getTitle()}</p>
           		</td>
              	<if="$vsSettings->getSystemKey("order_type", 0, "orders", 0, 1)">
             		<td><if="$obj->getType()">{$obj->getType()}<else />Cái</if></td>
             	</if>
				<td class="giohang_col3">{$obj->getQuantity()}</td>
                <td class="giohang_col4">{$obj->getPrice()}</td>
                <td class="giohang_col5">{$obj->getTotals()}</td>
            </tr>
	   		</foreach>
          	</table>
            <p class="total">
                     {$vsLang->getWords("orders_tongtien","Tổng thành tiền")} :
         		<span>{$option['total']}</span> {$vsLang->getWordsGlobal("global_unit","đ")}
         	</p>
      
      	
       	<button id="back-id" class="xoa" type="button">{$vsLang->getWords("orders_back","Trở về")}</button>
       	<button id="cancel_sel" class="huy" type="button">{$vsLang->getWords("orders_Cancel_Order","Cancel Order")}</button>
     	<div class="clear"></div>
       	</if>
    	
       	
    	<div class="thongtinkh">
    		<h3>{$vsLang->getWords('order_form','thông tin đặt hàng')}</h3>
     		<form id='user-form' class="register" name="user-form" method="POST" action="{$bw->base_url}orders/neworder/" enctype='multipart/form-data'>
				<input type='hidden' name='userId' value='{$vsUser->obj->getId()}'>
                <label>{$vsLang->getWords('user_full_middle','Tên người nhận')}:</label>
                <input type="text" name="orderName" id="obj-FullName" size="31" value="{$bw->input['orderName']}"/><span>*</span>
                
            
           		<label>{$vsLang->getWords('user_email','Email')}:</label>
               	<input type="text" name="orderEmail" class="obj_number" id="obj-Email"  value="{$bw->input['orderEmail']}"/><span>*</span>
            	

              	<label>{$vsLang->getWords('user_address','Địa chỉ')}:</label>
               	<input type="text" name="orderAddress" class="obj_number" id="obj-Address"  value="{$bw->input['orderAddress']}"/><span>*</span>
               

               	<label>{$vsLang->getWords('user_phone','Điện thoại')}:</label>
               	<input  type="text" class="numeric" name="orderPhone" class="obj_number" id="obj-Phone" size="11" value="{$bw->input['orderPhone']}"/><span>*</span>
              

              	<label>{$vsLang->getWords("user_message","Nội dung")}</label>
            	<textarea id="orderMessage" name="orderMessage">{$bw->input['orderMessage']}</textarea>
            	
            	
            	<label>{$vsLang->getWords("user_captcha","Mã bảo vệ")}:</label>
				<input type="text" name="userSecurity" id="userSecurity" style="width:100px;float:left;"/> 
				<div style="margin-left:10px;">
	            	<a href="javascript:;" style="float:left;margin: 0 0 0 10px;">
	                	<img id="vscapcha" src="{$bw->vars['board_url']}/vscaptcha">
	               	</a>      	
				
			   	<a href="javascript:;" class="mamoi" id="reload_img">
					{$vsLang->getWords('user_security','Tạo mã mới')}
				</a>
				</div>
				<div class="clear_left"></div>
				<p style="color:red;margin-left: 100px;">{$bw->input['message']}</p>
				<div class="clear_left"></div>
			
              	<input type="submit" class="dathang_btn" id="bt_submit" value="{$vsLang->getWords('users_dathang','Đặt hàng')}">
               	<input type="reset"  class="reset_btn" value="{$vsLang->getWords('user_reset','Làm lại')}"></a>
               	<button id="back-id2" class="back" type="button">{$vsLang->getWords("orders_back","Trở về")}</button>
               	
              	<div class="clear"></div>
            </form>
            </div>
           </div>
           {$this->defineFoot()}
     	
 	


	<script language="javascript" type="text/javascript">
	$('#back-id').click(function(){
     		window.location.href="{$bw->vars['board_url']}/orders";
     		return false;
     });
     $('#back-id2').click(function(){
     		window.location.href="{$bw->vars['board_url']}/orders";
     		return false;
     });
     $('#cancel_sel').click(function(){
     		window.location.href="{$bw->vars['board_url']}/orders/deleteallcart/";
     		return false;
     });
	function checkMail(mail){
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test(mail))
			return false;
		return true;
	}
	$("#reload_img").click(function(){
    	$("#vscapcha").attr("src",$("#vscapcha").attr("src")+"?a");
       	$('#random').val('');
      	return false;
	});
	$("input.numeric").numeric();
	$('#user-form').submit(function()  {
            if(!$('#obj-FullName').val()) {
			jAlert('{$vsLang->getWords('err_contact_reserve_blank','Nhập vào tên người nhận!')}','{$bw->vars['global_websitename']} Dialog');
			$('#obj-FullName').addClass('vs-error');
			$('obj-FullName').focus();
			return false;
		}
		if(!$('#obj-Email').val()|| !checkMail($('#obj-Email').val())) {
						jAlert('{$vsLang->getWords('err_contact_email_blank','Vui lòng nhập đúng loại email!')}','{$bw->vars['global_websitename']} Dialog');
						$('#obj-Email').addClass('vs-error');
						$('#obj-Email').focus();
						return false;
		}
		if(!$('#obj-Address').val()) {
			jAlert('{$vsLang->getWords('err_contact_address_blank','Nhập vào địa chỉ!')}','{$bw->vars['global_websitename']} Dialog');
			$('#obj-Address').addClass('vs-error');
			$('#obj-Address').focus();
			return false;
		}
            if(!$('#obj-Phone').val()) {
			jAlert('{$vsLang->getWords('err_contact_phone_blank','Nhập vào số điện thoại!')}','{$bw->vars['global_websitename']} Dialog');
			$('#obj-Phone').addClass('vs-error');
			$('#obj-Phone').focus();
			return false;
			}
		if(!$('#userSecurity').val()) {
			jAlert('{$vsLang->getWords('err_contact_security_blank','Vui lòng nhập mã bảo vệ!')}','{$bw->vars['global_websitename']} Dialog');
			$('#userSecurity').addClass('vs-error');
			$('#userSecurity').focus();
			return false;
		}
		//$('#user-form').submit()
	});

	$('#bt_cancel').click(function(){
		$( "form" )[ 1 ].reset()
	});
</script>
<script>
	$(document).ready(function(){
		var the_USERFORM	= window.document.getElementById('user-form');
		vsf.jRadio('{$vsUser->obj->getGender()}','userGender');
		var date = "{$vsUser->obj->getBirthday()}";
			if(date){
				var list =date.split("/");
				vsf.jSelect(list[0],'obj_day');
				vsf.jSelect(list[1],'obj_month');
				vsf.jSelect(list[2],'obj_year');
			}
		});

</script>

EOF;
		return $BWHTML;

	}

function viewOrder($option){
        global $bw,$vsLang,$vsSettings;
        
        $BWHTML .= <<<EOF
       
		{$this->defineHead()}
       		
	 	<div class="giohang_form">
       		<div class="giohang_thongbao">
            <p>{$vsLang->getWords('orders_thanks','Cám ơn quý khách đặt hàng sản phẩm của chúng tôi.')}</p>
            <p>{$vsLang->getWords('orders_thanks2','Chúng tôi sẽ liên lạc với quý khách trong thời gian sớm nhất')}</p>
    		</div>
    		<h3 style="text-transform:uppercase;">{$vsLang->getWords("orders_infocart","thông tin giỏ hàng")}</h3>
	       	<table border="0" class="thongbao">
	       		<tr>
                	<td style="color:#252525">{$vsLang->getWords('user_full_middle','Tên người nhận')}: </td>
                    <td>{$option['order']->getName()}</td>
                </tr>
                <tr>
                	<td style="color:#252525">{$vsLang->getWords('user_email','Email')}: </td>
                    <td style="color:#5599bb">{$option['order']->getEmail()}</td>
                </tr>
                <tr>
                	<td style="color:#252525">{$vsLang->getWords('user_address','Địa chỉ')}:</td>
                    <td>{$option['order']->getAddress()}</td>
                </tr>
                <tr>
                	<td style="color:#252525">{$vsLang->getWords('user_phone','Điện thoại')}: </td>
                    <td>{$option['order']->getPhone()}</td>
                </tr>
                <tr>
                	<td style="color:#252525">{$vsLang->getWords("user_message","Nội dung")}: </td>
                    <td>{$option['order']->getMessage()}</td>
                </tr>
                
            </table>
               
    		<if="$option['pageList']">
    		<table border="0" width="100%">
        	<tr>
             	<th class="giohang_col2">{$vsLang->getWords("orders_tensp","Tên sản phẩm")}</th>
              	<if="$vsSettings->getSystemKey("order_type",0, "orders", 0, 1)">
             	<th>{$vsLang->getWords("orders_loai","Loại")}</th>
              	</if>
             	<th class="giohang_col3">{$vsLang->getWords("orders_soluong","Số lượng")}</th>
               	<th class="giohang_col4">{$vsLang->getWords("orders_dongia","Đơn giá")}</th>
              	<th class="giohang_col5">{$vsLang->getWords("orders_thanhtien","Thành tiền")}</th>
            </tr>
          	<foreach="$option['pageList'] as $obj">
          	<tr>
                <td class="giohang_col2">
                	<a href="{$obj->getUrl('products')}" title="{$obj->getTitle()}">{$obj->createImageCache($obj->getImage(),42,44)}</a>
                    <p>{$obj->getTitle()}</p>
           		</td>
              	<if="$vsSettings->getSystemKey("order_type", 0, "orders", 0, 1)">
             		<td><if="$obj->getType()">{$obj->getType()}<else />Cái</if></td>
             	</if>
				<td class="giohang_col3">{$obj->getQuantity()}</td>
                <td class="giohang_col4">{$obj->getPrice()}</td>
                <td class="giohang_col5">{$obj->getTotals()}</td>
            </tr>
	   		</foreach>
	   		</table>
          
            <p class="total">
                     {$vsLang->getWords("orders_tongtien","Tổng thành tiền")} :
         		<span>{$option['total']}</span> {$vsLang->getWordsGlobal("global_unit","đ")}
         	</p>
      
	      	<else />
	        	<div style="font-size:20px;text-align:center">{$vsLang->getWords("no_products_order","Không tồn tại sản phẩm trong giỏ hàng")}</div>
	     	</if>
			
     		<p style="margin-top:15px;text-align:center;"><a href="{$bw->base_url}" style="color:#FF3028;font-weight:bold;text-transform:uppercase;">{$vsLang->getWords('order_backhome','Trở về trang chủ')}</a></p>
     		
     		<div class="thongbao_thanhtoan">
                <p>{$vsLang->getWords('orders_note1','SAU KHI KIỂM TRA THÔNG TIN TÀI KHOẢN NHÂN VIÊN CỦA CHÚNG TÔI SẼ CHUYỂN SẢN PHẨM QUÝ KHÁCH ĐẶT HÀNG QUA YAHOO CHÁT HOẶC QUA TIN NHẮN ĐIỆN THOẠI.')}</p>
				<p>{$vsLang->getWords('orders_note2','CHÂN THÀNH CẢM ƠN QUÝ KHÁCH.')}</p>
            	<p style="color:#ff3028;margin-top:10px;">{$vsLang->getWordsGlobal('global_company_name','CÔNG TY TNHH NỘI THẤT AN PHÚC')}</p>
         	</div>
     	 </div>
     	{$this->defineFoot()}
	
EOF;
		return $BWHTML;
	}

	function cartSummary($option) {
		global $vsLang, $bw,$vsUser,$vsPrint,$vsSettings;
		$vsPrint->addCurentJavaScriptFile("JScript");
        $vsPrint->addJavaScriptFile ("jquery.numeric",1);      
		$count= count($_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item'])?count($_SESSION [$_SESSION [APPLICATION_TYPE]['language']['currentLang']['langFolder']] ['cart'] ['item']):'0';
		$BWHTML = <<<EOF
     	{$this->defineHead()}
     	
     	
    	<div id="cart" class="giohang_form">  
    	<h3>Hiện tại giỏ hàng của bạn có {$count} sản phẩm!</h3> 
    	<form id="addEditForm" name="addEditForm" method="post"  action="{$bw->base_url}orders/updatecart/" enctype='multipart/form-data'>
            <table id="grvSanPham"  border="0" cellpadding="8" cellspacing="0" rules="all" width="100%">
            <tbody>
            <tr>
           		<th class="giohang_col1"><input type="checkbox" name="checkall" id="checkboxall" title="checkall"/></th>
             	<th class="giohang_col2">{$vsLang->getWords("orders_tensp","Tên sản phẩm")}</th>
              	<if="$vsSettings->getSystemKey("order_type",0, "orders", 0, 1)">
             	<th>{$vsLang->getWords("orders_loai","Loại")}</th>
              	</if>
             	<th class="giohang_col3">{$vsLang->getWords("orders_soluong","Số lượng")}</th>
               	<th class="giohang_col4">{$vsLang->getWords("orders_dongia","Đơn giá")}</th>
              	<th class="giohang_col5">{$vsLang->getWords("orders_thanhtien","Thành tiền")}</th>
            </tr>
            <foreach="$option['orderItem'] as $key => $val">
         	<tr>
        		<td class="giohang_col1"><input type="checkbox" value="{$key}" name="checkall"/></td>
                <td class="giohang_col2">
                	<a href="$val->getUrl('products')" title="{$val->getTitle()}">{$val->createImageCache($val->getImage(),50,37)}</a>
                    <span id="grvSanPham_ctl0{$vsf_count}_lblTenSanPham">{$val->getTitle()}</span>
           		</td>
                 <if="$vsSettings->getSystemKey("order_type",0, "orders", 0, 1)">
                 <td align="center">
                 <if="$option['opt'][$key]">
                    <select name="price[{$key}]" onchange="changevalue({$key},$(this).val(),{$vsf_count})">
                           <option value="0"> Cái </option>
                           <foreach="$option['opt'][$key] as $opt">
                                <option value="{$opt->getId()}" <if="$val->getType()==$opt->getTitle()">selected</if> > {$opt->getTitle()} </option>
                           </foreach>
                    </select>
                    <else />Cái
                     </if>
                 </td>
                 </if>   
				<td class="giohang_col3">
                 	<input name="cart[{$key}]" value="{$val->getQuantity ()}" id="grvSanPham_ctl0{$vsf_count}_txtSoLuong" tabindex="3" onkeyup="TinhTong(this);" onblur="TinhTong(this);" type="text" class="numeric">
					<!--<input name="cart[{$key}]" value="{$val->getQuantity ()}" id="grvSanPham_ctl0{$vsf_count}_txtSoLuong" tabindex="3"   type="text" class="numeric">-->
          		</td>
                <td class="giohang_col4">
                     <input type="hidden" value="{$val->getPrice()}" id="grvSanPham_ctl0{$vsf_count}_txtDonGia"  >
                     {$val->getPrice()}
                </td>
                <td class="giohang_col5">
                    <input value="{$val->getTotals()}" name="" id="grvSanPham_ctl0{$vsf_count}_txtThanhTien"  readonly="readonly" type="text" class="thanhtien" style="width:100px;">
                    <span id="grvSanPham_ctl0{$vsf_count}_lblThanhTien" style="display: none;">NaN</span>
                </td>
            </tr>
            </foreach>
            </table>  
            
         	<p class="total" id="Label1">
                     {$vsLang->getWords("orders_tongtien","Tổng thành tiền")} :
         		<span id="lblTong">{$option['total']}</span> {$vsLang->getWordsGlobal("global_unit","đ")}
         	</p>
      
			 
       		<button id="delete_sel" class="xoa" type="button">{$vsLang->getWords("orders_Delete_selected","Delete selected")}</button>
			<button id="cancel_sel" class="huy" type="button">{$vsLang->getWords("orders_Cancel_Order","Cancel Order")}</button>
       		<button id="orders_sel" class="thanhtoan" type="button">{$vsLang->getWords("orders_Order","Order")}</button>
			<button id="cont_sel" class="muatiep" type="button">{$vsLang->getWords("orders_Cont","Mua tiếp")}</button>        	
       		
         	<!--<button id="update_sel" class="capnhat" >{$vsLang->getWords("orders_Updated","Updated")}</button>-->
        	
       		
            <div class="clear"></div>      
            </tbody>
		</form>                 
        </div>            
       	{$this->defineFoot()}
        <!-- STOP CONTENT CENTER -->
    
    <script>
    var flag = false;
      var price = [];
      <if="!$option['orderItem']">
      $('#delete_sel').css({display:"none"});
      $('#cancel_sel').css({display:"none"});
      $('#orders_sel').css({display:"none"});
      
      </if>
      <if="$option['opt']">           
          <foreach="$option['opt'] as $key => $val">   
               price[$key]=[];
                        price[$key][0] = '{$option['orderItem'][$key]->getPrice()}';
                         <foreach="$val as $k => $v">
                            price[$key][$k] = '{$v->getPrice()}';
                         </foreach>
          </foreach>       
      </if>  
      $("input.numeric").numeric();                  
     function  changevalue(inp,vale,ind){
              if(price[inp][vale]){
                    $('#grvSanPham_ctl0'+ind+'_txtDonGia').val(price[inp][vale]);     
                    $('#grvSanPham_ctl0'+ind+'_txtSoLuong').blur();        
             }
         }
                 
     $('#delete_sel').click(function(){
	     var value = getCheck();
	   	if(value){
	   		window.location.href="{$bw->vars['board_url']}/orders/deletecart/"+value+".html";
	   	}
                        return false;
     });
     $('#update_sel').click(function(){
    		 $('#addEditForm').submit();
     });
     $('#cancel_sel').click(function(){
     		window.location.href="{$bw->vars['board_url']}/orders/deleteallcart.html";
     		return false;
     });
     $('#orders_sel').click(function(){
     		var str ="<input type='hidden' name='actionUpdate' value='bill'>";
     		$('#addEditForm').append(str);
     		$('#addEditForm').submit();
     		//window.location.href="{$bw->vars['board_url']}/orders/billName.html";
     		//return false;
     
     });
     $('#cont_sel').click(function(){
     		var str ="<input type='hidden' name='actionUpdate' value='cont'>";
     		$('#addEditForm').append(str);
     		$('#addEditForm').submit();
     });
      $(document).ready(function(){
      	
	      $("#checkboxall").click(function() {
	      var checked_status = this.checked;
		      $("input[name=checkall]").each(function()
		      {
		      this.checked = checked_status;
		      });
	      });
	    <foreach="$option['orderItem'] as $key => $val">
		$('#grvSanPham_ctl0{$vsf_count}_txtSoLuong').blur();
		</foreach>
		flag = true;
      });

    function getCheck() {
		var checkedString = '';
		$("input[name=checkall]").each(function(){
			if(this.checked) checkedString += $(this).val()+',';
		});
		checkedString = checkedString.substr(0,checkedString.lastIndexOf(','));
		if(checkedString =='') {
			jAlert(
				"{$vsLang->getWords('delete_obj_confirm_noitem', "You haven't choose any items !")}",
				"{$bw->vars['global_websitename']} Dialog"
			);
			return false;
		}
		return checkedString;
	}
    </script>
    <script>
    
     function TinhTong(mObject)
        {
            var object_ = mObject.id;
            
            // Khai báo và gán giá trị các cột dữ liệu
            var m2= object_.replace('txtSoLuong','txtThanhTien');
            var m3 = object_.replace('txtSoLuong','txtDonGia');
            var mNhap = object_.replace('txtSoLuong','txtNhap');
            var lblTT = object_.replace('txtSoLuong','lblThanhTien');
            
            var m4 = document.getElementById(m2);
            var m5 = document.getElementById(m3.replace(/\$|\,/g,''));
            var SoLuong;   
            
            if(mObject.value.length>0)
            {
                 SoLuong = mObject.value.replace(/\$|\,/g,'');
            }
            var DonGia =m5.value.replace(/\$|\,/g,'');
            // Tính ThanhTien =DonGia*SoLuong
            var ThanhTien= parseFloat(SoLuong)* parseFloat(DonGia);
            document.getElementById(lblTT).innerHTML=ThanhTien;
            if(isNaN(m3))
            {
                document.getElementById(m2).value =formatCurrency(ThanhTien);
            }
            // Tính tổng số tiền
            var test="";
            var tongtien =0;
            var z="";
            for(x=1;x<20;x++)
            {
                if(x<10)
                {
                    test ="grvSanPham_ctl0"+x+"_lblThanhTien";
                    if(document.getElementById(test) !=null)
                    {
                        z = document.getElementById(test).innerHTML.toString().replace(/\$|\,/g,'');
                        if(isNaN(z) || z ==''){z = '0';}
                        tongtien =tongtien+ parseFloat(z);
                    }
                }
                else
                {
                    test ="grvSanPham_ctl"+x+"_lblThanhTien";
                    if(document.getElementById(test) !=null)
                    {
                        z = document.getElementById(test).innerHTML.toString().replace(/\$|\,/g,'');
                        if(isNaN(z) || z ==''){z = '0';}
                        z = '0';
                        tongtien =tongtien+ parseFloat(z);
                    }
                }
            }
            document.getElementById('lblTong').innerHTML =formatCurrency(tongtien); 

        }
        
    </script>

EOF;

	//--endhtml--//

	return $BWHTML;
	}

function defineHead(){
    global $vsPrint,$vsTemplate;
	$BWHTML .= <<<EOF
     <h3 class="main_title">{$vsPrint->pageTitle}</h3>
       
	 	
            
EOF;
		return $BWHTML;
        }
function defineFoot(){
            $BWHTML .= <<<EOF
         
       
EOF;
		return $BWHTML;
        }
        
	function orderLoading($message){
		global $vsLang,$bw,$vsPrint;
		$dir = $_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:$bw->base_url."orders/";
		$BWHTML .= <<<EOF
			<script>
                        <if="$message">
                           $(document).ready(function()
                            {
                                jAlert(
                                                "{$message}",
                                                "{$bw->vars['global_websitename']} Dialog"
                                        );
                            });
                        </if>

                        setTimeout('relead()',500)

                        function relead(){
                                document.location.href = "{$dir}";
                        }
			</script>
EOF;
		return $BWHTML;
	}

	function htmlThanhToan($page,$acc){
		$BWHTML .= <<<EOF
		<h3 class="main_title">{$page->getTitle()}</h3>
            <div class="gioithieu">
            <p>{$page->getContent()}</p>
            <div class="link_bank">
            	<foreach="$acc as $ac">
        		<a href="{$ac->getWebsite()}" title="{$ac->getTitle()}" target="_blank">{$ac->createImageCache($ac->file,182,67)}</a>
      			</foreach>
                <div class="clear_left"></div>
            </div>
			</div>
EOF;
	return $BWHTML;
	}
	
	function viewSendEmail($option){
        global $bw,$vsLang;
        
        $BWHTML .= <<<EOF
        <style>
        body{background-color:#F3E1A6;font-family:Arial;font-size:12px;line-height:18px;color:#8A3512;}
        .order_title{font-weight:bold; text-transform: uppercase;color:red;line-height:20px;height:20px;}
		.ordermail{width:728px;}
        table{border:1px solid #fff;width:100%;}
        table .textwhile{background:#5c1e05;font-weight:bold;text-align: center;color:#fff;text-transform: uppercase;line-height:28px;}
        table td{font-size:14px;height:25px;padding:5px;}
        table .label_cart_total,table .text_total{font-weight:bold;text-align: right;}
		.text_left{text-align: center;}
		.text_right{text-align: right;}
        </style>
       <div class="ordermail">    
		<h3 class="order_title">{$vsLang->getWords('global_xacnhandonhang','Xác nhận đơn hàng')}</h3>
		<p>{$vsLang->getWords('global_noidungxacnhan','Bạn đã mua thành công sản phẩm của chúng tôi.')}</p>
		<table border="0" class="thongbao">
	       		<tr>
                	<td style="color:#252525">{$vsLang->getWords('user_full_middle','Tên người nhận')}: </td>
                    <td>{$option['order']->getName()}</td>
                </tr>
                <tr>
                	<td style="color:#252525">{$vsLang->getWords('user_email','Email')}: </td>
                    <td style="color:#5599bb">{$option['order']->getEmail()}</td>
                </tr>
                <tr>
                	<td style="color:#252525">{$vsLang->getWords('user_address','Địa chỉ')}:</td>
                    <td>{$option['order']->getAddress()}</td>
                </tr>
                <tr>
                	<td style="color:#252525">{$vsLang->getWords('user_phone','Điện thoại')}: </td>
                    <td>{$option['order']->getPhone()}</td>
                </tr>
                <tr>
                	<td style="color:#252525">{$vsLang->getWords("user_message","Nội dung")}: </td>
                    <td>{$option['order']->getMessage()}</td>
                </tr>
                
            </table>
            <p></p>
     	<table border="1" cellspacing="0" cellpadding="8">
            <tr class="textwhile">
            	<th class="col3">{$vsLang->getWords("orders_stt","STT")}</th>
             	<th class="col4">{$vsLang->getWords("orders_tensp","Tên sản phẩm")}</th>
               	<th class="col5">{$vsLang->getWords("orders_soluong","Số lượng")}</th>
            	<th class="col6">{$vsLang->getWords("orders_dongia","Đơn giá")}</th>
              	<th class="col7">{$vsLang->getWords("orders_thanhtien","Thành tiền")}</th>
          	</tr>
         	<foreach="$option['pageList'] as $obj">
            <tr>	 
                  <td class="col3" width="30px">{$obj->stt}</td>                   
                  <td class="col4">
        			{$obj->createImageCache($obj->getImage(),42,44)}
            		<p>{$obj->getTitle()}</p>
            		<p><if="$obj->getType()!='-'">({$obj->getType()})</if></p>
            	  </td>
                  <td class="col5">{$obj->getQuantity()}</td>
                  <td class="col7">{$obj->getPrice()}</td>
                  <td class="col7">{$obj->getTotals()}</td>
            </tr>
          	</foreach>
              <tr>
               	<td colspan="4">
                   	<p style="font-weight:bold; color:#f57e20">{$vsLang->getWords("orders_Total","Total")}:({$vsLang->getWordsGlobal("global_unit","VND")})</p>    
              	</td>
                 <td class="text_total text_right">
                  	<b>{$option['total']}</b>
                 </td>
              </tr>
        </table>
		</div>
EOF;
		return $BWHTML;
	}

	function viewMyOrder($option){
        global $bw,$vsLang,$vsSettings,$vsPrint;
        
        $BWHTML .= <<<EOF
       
            {$this->defineHead()}
            <div class="giohang">
            	
         		
                <h3>{$vsLang->getWords('global_mycart','Đơn hàng của tôi')}</h3>
               
                
            	<if="$option">
            	<table border="1" width="100%">
                	<tr>
                		<th class="col3">
                    	<input type="checkbox" name="checkall" id="checkboxall" title="checkall"/></th>
                        <th class="col4">{$vsLang->getWords("orders_Product_Name","Product Name")}</th>
                        <th class="col5">{$vsLang->getWords("orders_Price","Price")}</th>
                        <if="$vsSettings->getSystemKey("order_type", 0, "orders", 0, 1)">
                        <th>{$vsLang->getWords("orders_Type","Type")}</th>
                        </if>
                        <th class="col6">{$vsLang->getWords("orders","Quantity")}</th>
                        <th class="col7">{$vsLang->getWords("orders_Total_amount","Total amount")}</th>
                        <th class="col7">{$vsLang->getWords("orders_Status","Trạng thái")}</th>
                    </tr>
                    
                            <foreach="$option['pageList'] as $key =>$obj">
                                <tr>
                                	<td class="col3"><input type="checkbox" value="{$key}" name="checkall" style="width:25px" <if="$obj->getStatus()==1">DISABLED</if>/></td>	                    
                                    <td class="col4">
            							{$obj->createImageCache($obj->getImage(),42,44)}
            							<p>{$obj->getTitle()}</p>
            							<p><if="$obj->getType()!='-'">({$obj->getType()})</if></p>
            						</td>
                                    <td class="col5">{$obj->getPrice()}</td>
                                    <if="$vsSettings->getSystemKey("order_type", 0, "orders", 0, 1)">
                                    <td class="text_right "><if="$obj->getType()">{$obj->getType()}<else />Cái</if></td>
                                    </if>
                                    <td class="col6" style="text-align: center;">{$obj->getQuantity()}</td>
                                    <td class="col7">{$obj->getTotals() }</td>
                                    <td class="col7">{$obj->getMyStatus() }</td>
                                </tr>
	                    </foreach>
	                    
                    <tr>
                    	<td colspan="5" align="right" style="text-align:left;padding-left:10px;">
                            <button id="delete_sel" class="btn_xoa" type="button">{$vsLang->getWords("orders_Delete_selected","Delete selected")}</button>
                        </td>
                    </tr>
                </table>
                
                <else />
                    <div style="font-size:20px;text-align:center">{$vsLang->getWords("no_products_order","Không tồn tại sản phẩm trong giỏ hàng")}</div>
                 </if>
                 <if="$option['paging']">
                <div class="page">{$option['paging']}</div>
                </if>
            </div>
            
           
            <p style="margin-top:15px;text-align:center;"><a href="{$bw->base_url}" style="color:#1f357e;font-weight:bold;text-transform:uppercase;">{$vsLang->getWords('order_backhome','Trở về trang chủ')}</a></p>
	<script>
	
	function getCheck() {
		var checkedString = '';
		$("input[name=checkall]").each(function(){
			if(this.checked) checkedString += $(this).val()+',';
		});
		checkedString = checkedString.substr(0,checkedString.lastIndexOf(','));
		if(checkedString =='') {
			jAlert(
				"{$vsLang->getWords('delete_obj_confirm_noitem', "You haven't choose any items !")}",
				"{$bw->vars['global_websitename']} Dialog"
			);
			return false;
		}
		return checkedString;
	}
     $('#delete_sel').click(function(){
	     var value = getCheck();
	   	if(value){
	   		window.location.href="{$bw->vars['board_url']}/orders/deletemycart/"+value+".html";
	   	}
                        return false;
     });
     </script>
            {$this->defineFoot()}
	
EOF;
		return $BWHTML;
	}
	
}
?>