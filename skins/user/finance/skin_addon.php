<?php
class skin_addon {
	///show menu top cho user.SU dung mac dinh co san.Chinh sua mot it cho nhanh.Thanks
	function showMenuTopForUser($option= array()) {
		global $bw, $vsLang ,$vsTemplate;
               
		$BWHTML .= <<<EOF
                <ul class="menu_top menu_top{$vsLang->currentLang->getFoldername()}" style="display:block !important;">
                    <li><a href="{$bw->base_url}home"  title="" <if="$bw->input['module']=='home'">class="active"</if> ><span>{$vsLang->getWords('global_Trangchu','Trang chủ')}</span></a>
                    <foreach="$option as $obj">
                        <li><a href="{$obj->getUrl(0)}"  title="{$obj->getTitle()}" class="{$obj->getClassActive()}"><span>{$obj->getTitle()}</span></a>
                           
                        </li>
                    </foreach>
                    <div class="clear_left"></div>
                    
		</ul>
       	
EOF;
		return $BWHTML;
	}
//function showMenuTopForUser($option= array()) {
//		global $bw, $vsLang ,$vsTemplate;
//		
//		$BWHTML .= <<<EOF
//               
//		<style>
//                .nodis{display:none;}
//                </style>
//		<div id="menusaigon">		
//		<div class="fixed_menu">
//        	<div class="menu_main">
//         		<ul id="nav" class="headmenuvi menu_top">
//                  	<foreach="$option as $obj">
//                      <li id="lisc81{$vsf_count}"><a href="{$obj->getUrl(0)}" class="{$obj->getClassActive()}" title="{$obj->getTitle()}" rel="lisc81{$vsf_count}"><span>{$obj->getTitle()}</span></a></li>
//                    </foreach>
//                   	<div class="clear_left"></div>
//       			</ul>
//			</div>
//			<div id="header_sub">
//         <div id="sub1" class="tabcontent selected active">               
//    	<p class="header_hello">{$vsLang->getWords('global_wellcome','Chào mừng bạn đến với website của chúng tôi')} !</p>
//        <a href="#" class="checkmail">{$vsLang->getWords('global_checkmail','Check email')}</a>
//        {$this->showFormSearch()}
//        </div>
//        <foreach="$option as $obj">
//			<if="$vsTemplate->global_template->menu_sub[$obj->getUrl()] || $obj->getChildrenLi()">
//                        <div id="sub{$vsf_count}" class="tabcontent nodis {$obj->getClassActive()}">
//         		<ul>
//               		{$vsTemplate->global_template->menu_sub[$obj->getUrl()]}     
//          		</ul>
//                        <if="$obj->getClassActive()">
//                            <script>
//                            $(document).ready(function(){
//                                $('#sub1').removeClass('selected');
//                                $('#sub1').removeClass('active');
//                                $('#sub1').addClass('nodis');
//                            });
//                            </script>
//                        </if>
//            </div>
//            </if>
//            </foreach>
//    </div>   
//      </div>
//	  
//	  </div>
//         </div>
//    <!-- STOP HEADER -->
//
//	             
//      <script>
//    $(document).ready(function() {
//  		
//			$("ul.headmenuvi li").each(function(){
//           		var id = $(this).attr("id");
//            	var pid = id.substring(6,7);
//            	//lay offset li
//           		var offset = $(this).offset();
//                        
//           		//lay offsetlogo
//           		var headoff = $("#menusaigon").offset();
//                        
//           		// lay position indiv
//          
//	           var pos = offset.left - headoff.left +$(this).width()/2 -10 ;
//                  
//	           if($("#sub"+pid).width()){
//                       
//	                var w = parseInt(pos -$("#sub"+pid).width()/2);
//	                var f = parseInt(pos +$("#sub"+pid).width()/2);
//                        var ri = 908 - $("#sub"+pid).width() - w;
//                       // alert(w+' '+f +" "+ $("#sub"+pid).width());
//                       
//	                if(f < 908 && w){
//                          
//                            $("#sub"+pid).css('padding-left':w);
////                              alert(2);
//                             $("#sub"+pid).css(left:'10px');
//                             if($("#sub"+pid).width()<900)
//                             $("#sub"+pid).css('padding-right':ri);	
//                              
//                        }else{
//                        $("#sub"+pid).css({'padding-left':10});
//                        }
//
//	           }
//          });
//          
//          	$(".tabcontent.selected").removeClass("nodis");
//         
//          	$("ul.headmenuvi li").hover( 
//			function() {
//	       		$("ul.headmenuvi li a ").removeClass("active");
//	            $(".tabcontent .selected").removeClass("active");
//	           	$(".tabcontent ").addClass("nodis");
//	           	$(this).children().addClass("active");
//	            var id = $(this).attr("id");
//	            var pid = id.substring(6,7);
//	            $("#sub"+pid).removeClass("nodis");
//          	});
//          	$(".fixed_menu").mouseenter(function(){
//            }).mouseleave(function(){
//            $(".tabcontent.selected").addClass("active");
//                    $("ul.headmenuvi li a ").removeClass("active");
//                    $("ul.headmenuvi li a.selected").addClass("active");
//                    $(".tabcontent.selected").addClass("active");
//                    $(".tabcontent").addClass("nodis");
//                    $(".tabcontent.active").removeClass("nodis");
//            });
//		$('ul.menu_footer').find('li:last').css({border: 'none'});
//    });
//
//			</script>
//              
//
//      
//EOF;
//		return $BWHTML;
//	}        
        
function showMenuRight($option= array()) {
		global $bw, $vsLang ,$vsTemplate;
               
		$BWHTML .= <<<EOF
                 <ul class="menu_golf" id="menu">
                     <foreach="$option as $obj">
                	<li><a href="{$obj->getUrl(0)}" title="{$obj->getTitle()}">{$obj->getTitle()}</a>
                    	<if="$vsTemplate->global_template->menu_sub[$obj->getUrl()] || $obj->getChildren()">
                                <ul >
                                    {$vsTemplate->global_template->menu_sub[$obj->getUrl()]}
                                    {$obj->getChildrenLi()}
                                </ul>
                            </if>
                    </li>
                    </foreach>
                    
                </ul>
       	<div  class="clear_left"></div>
EOF;
		return $BWHTML;
	}
function scrolltop() {
		global $bw, $vsLang ,$vsTemplate;
               
		$BWHTML .= <<<EOF
                <div class="run_page">
                        <if="$_SERVER['HTTP_REFERER']">         
                            <a href="{$_SERVER['HTTP_REFERER']}" class="back_page">{$vsLang->getWords('global_trove','Trở về')}</a> |
                        </if>
                        <a href="javascript:;" class="top_page">{$vsLang->getWords('global_dautrang','Đầu trang')}</a>
                </div>
       	
EOF;
		return $BWHTML;
	}
	
	
	function showMenuBottomForUser($option= array()) {
		global $bw, $vsLang ,$vsTemplate;

		$BWHTML .= <<<EOF
		
       	<ul class="menu_footer">
	       	<foreach="$option as $obj">
	        	<li><a href="{$obj->getUrl(0)}" class="{$obj->getClassActive()}" title="{$obj->getTitle()}">{$obj->getTitle()}</a></li>
	      	</foreach>
        	<div class="clear_left"></div>
     	</ul>
     	
EOF;
		return $BWHTML;
	}
	
	function showSearchLeft() {
		global $bw, $vsLang ,$vsTemplate;

		$BWHTML .= <<<EOF
		
        	<div class="sitebar_item">
        	<h3 class="sitebar_title">{$vsLang->getWordsGlobal("global_dattiecol","Đặt tiệc online")}</h3>
            <form id="dattiec" class="dattiec" method="POST" action="{$bw->base_url}contacts/send/">
            	<label>{$vsLang->getWords('global_loai','Loại')} </label>
                <input type="hidden" name="contactPrePage" value="{$bw->base_url}{$bw->input['vs']}"/>
                <select name="contactType" >
                	<option value="2">{$vsLang->getWords('global_tieccuoi','Tiệc cưới')}</option>
                        <option value="3">{$vsLang->getWords('global_hoinghi','Hội nghị')}</option>
                </select>                
                <label>{$vsLang->getWords('global_hoten','Họ & Tên')}</label><input type="text" id="contact1Name" name="contactName"  title="{$vsLang->getWords('contact_full_name','Họ và Tên')}" />
                <label>{$vsLang->getWords('global_diachi','Địa chỉ')}</label><input id="contact1Address" name="contactAddress"  title="{$vsLang->getWords('contact_address','Địa chỉ')}"  type="text" />
                <label>{$vsLang->getWords('global_dienthoai','Điện thoại')}</label><input type="text" class="numeric"   id="contact1Phone" name="contactPhone" maxlength="11" title="{$vsLang->getWords('contact_phone','Điện thoại')}" />
                <label>Email</label><input id="contact1Email" name="contactEmail"  title="{$vsLang->getWords('contact_address','Địa chỉ')}"  type="text" />
                <label>{$vsLang->getWords('global_tieude','Tiêu đề')}</label><input type="text" id="contact1Title" name="contactTitle"  title="{$vsLang->getWords('contact_title','Tiêu đề')}" />
                <label>{$vsLang->getWords('global_noidung','Nội dung')}</label><textarea id="contact1Message" name="contactContent"></textarea>
                <label>{$vsLang->getWords('global_security','Mã bảo vệ')}</label>
	            <input class="text_input" name="contactSecurity" id="contact1Security" style="width:100px"/><span></span>
                    <div class="random" style="width: 255px; float: left;margin-left:57px ">
                    
                    <img id="siimage" align="left" style="padding-right: 5px; border: 0" src="{$bw->vars['board_url']}/captcha/securimage_show.php?sid={$id}" />
                          

                            <!-- pass a session id to the query string of the script to prevent ie caching -->
                            <span style="padding-top:10px;margin-left:0px;">
                            <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '{$bw->vars['board_url']}/captcha/securimage_show.php?sid=' + Math.random(); return false">
                                    <img src="{$bw->vars['board_url']}/captcha/images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" style="margin-left: 0px !important;" />
                            </a>
                            </span> 
              	</div>
                <p>{$vsLang->getWords('global_datcoc','Ghi chú: Đặt cọc trước 30%')}</p>
                                    <div class="clear_left"></div>
                <input type="button" value="{$vsLang->getWords('global_dattiec','Đặt tiệc')}" id="dattiecol" class="submit_btn" />
                <div class="clear"></div>
            </form>
        </div>
	<script type='text/javascript'>
				function checkMail1(mail){
					var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					if (!filter.test(mail)) return false;
					return true;
				}
				
				//$("input.numeric").numeric();
				
				$('#dattiecol').click(function(){
					
					if(!$('#contact1Name').val()) {
						jAlert('{$vsLang->getWords('global_contact_name_blank','Vui lòng nhập họ tên!')}','{$bw->vars['global_websitename']} Dialog');
						$('#contact1Name').addClass('vs-error');
						$('#contact1Name').focus();
						return false;
					}
					
					
					
					if(!$('#contact1Address').val()) {
						jAlert('{$vsLang->getWords('global_contact_address_blank','Vui lòng nhập địa chỉ!')}','{$bw->vars['global_websitename']} Dialog');
						$('#contact1Address').addClass('vs-error');
						$('#contact1Address').focus();
						return false;
					}
					
					
					if(!$('#contact1Phone').val()) {
						jAlert('{$vsLang->getWords('global_contact_phone_blank','Vui lòng nhập số điện thoại!')}','{$bw->vars['global_websitename']} Dialog');
						$('#contact1Phone').addClass('vs-error');
						$('#contact1Phone').focus();
						return false;
					}
					
					
					
					if(!$('#contact1Email').val()|| !checkMail1($('#contact1Email').val())) {
						jAlert('{$vsLang->getWords('global_contact_email_blank','Vui lòng nhập đúng loại email!')}','{$bw->vars['global_websitename']} Dialog');
						$('#contact1Email').addClass('vs-error');
						$('#contact1Email').focus();
						return false;
					}
					
					
					
					
					if(!$('#contact1Title').val()) {
						jAlert('{$vsLang->getWords('global_contact_title_blank','Vui lòng nhập câu hỏi!')}','{$bw->vars['global_websitename']} Dialog');
						$('#contact1Title').addClass('vs-error');
						$('#contact1Title').focus();
						return false;
					}
					
					if($('#contact1Message').val().length < 15) {
						jAlert('{$vsLang->getWords('global_contact_message_blank','Thông tin quá ngắn!')}','{$bw->vars['global_websitename']} Dialog');
						$('#contact1Message').addClass('vs-error');
						$('#contact1Message').focus();
						return false;
					}
                                        
                                          if(!$('#contact1Security').val()) {
						jAlert('{$vsLang->getWords('global_contact_phone_security','Vui lòng nhập mã bảo vệ!')}','{$bw->vars['global_websitename']} Dialog');
						$('#contact1Security').addClass('vs-error');
						$('#contact1Security').focus();
						return false;
					}   
					$('#dattiec').submit();
				});


			</script> 
		
     	
EOF;
		return $BWHTML;
	}
	
	function portlet_supports($option= array()) {
		global $bw, $vsLang;
		$this->arra = array(1=>"Nick Yahoo",2=>"Nick Skype");
				$BWHTML .= <<<EOF
		<if="$option">
                <foreach="$this->arra as $k => $v">
               
                    <foreach=" $option as $key =>$obj">	
                            <if="$obj->getType()==$k">
                                {$obj->show()}
                                    </if>
                            </foreach>
                    <div class="clear_left"></div>
                </foreach>        
		</if>		
  
EOF;
		return $BWHTML;
	}
	
	function portlet_banner($option) {
		global $bw, $vsLang,$vsPrint;
		
		$BWHTML .= <<<EOF
    	<if="$option">
            <div class="slider-wrapper theme-default">
	            <div id="slider" class="nivoSlider">
	            	<foreach="$option as $slide">
	            	 {$slide->show(1000,318)}
	            	 </foreach>
	            </div>	
			</div>
            
    	</if>
	  		
EOF;
	}
	
	
	function portlet_video($list) {
		global $bw, $vsLang,$vsTemplate;

		$BWHTML .= <<<EOF
		
		<if="$list">
			<h3>{$vsLang->getWordsGlobal('global_video','giới thiệu sản phẩm')}</h3>
			<div class="sitebar_right_video">
	        	{$list->show(209,171)}       
	     	</div>
     	</if>
     	
EOF;
}
	
	function portlet_partner($option) {
		global $bw, $vsLang,$vsPrint;
	
		$BWHTML .= <<<EOF
		
		<if="$option">	
       
   		
       		<foreach="$option as $obj">
           		<div class="sitebar_item">	
                	<a href="{$obj->getWebsite()}" title="{$obj->getTitle()}" target="_blank" class="sitebar_img">
                	{$obj->createImageCache($obj->file,206,86)}
                	</a>
                	<p><a href="{$obj->getWebsite()}" title="{$obj->getTitle()}" target="_blank">{$obj->getTitle()}</a></p>
          		</div>
            </foreach>
         	
		
			
 		
      	</if>
      	
EOF;
	}

	function portlet_bannertop($option) {
		global $bw, $vsLang,$vsPrint;
 
		$BWHTML .= <<<EOF
    	<if="$option">
    		<div class="banner">
                 
                    {$option->file->show(699,250)}
                   
            </div>
    	</if>
	  		
EOF;
	}
	

        
function showFormSearch() {
		global $bw, $vsLang ,$vsTemplate;
               $stringSearch = $vsLang->getWords('global_tim','Tìm kiếm sản phẩm...');
		$BWHTML .= <<<EOF
                <div class="search_top">
                    <label>{$vsLang->getWords('global_timk','Tìm kiếm')}:</label>
                    <input type="text" onfocus="if(this.value=='{$stringSearch}') this.value='';" onblur="if(this.value=='') this.value='{$stringSearch}';" value="{$stringSearch}" class="input_text" id="keySearch"/>
                    <input type="button" value="" class="search_submit" id="submit_form_search"/>
                </div>
                <script language="javascript" type="text/javascript">
                $(document).ready(function(){
//$("#keySearch").keydown(function(e){
//                    if(e.keyCode==13){
//                     $('#submit_form_search').click();
//                    return false;
//                    }
//                    });
                $('#submit_form_search').click(function()  {
                    if($('#keySearch').val()==""||$('#keySearch').val()=="{$stringSearch}") {
                        jAlert('{$vsLang->getWords('global_tim_thongtin','Vui lòng nhập thông tin cần search:please!!!!!')}',
                        '{$bw->vars['global_websitename']} Dialog');
                        return false;
                    }
                     
                     document.location.href="{$bw->base_url}searchs/"+ $('#keySearch').val();
                           return;
                });
                });
                </script> 
       	
EOF;
		return $BWHTML;
	}
	
	

	function portlet_polls(){
		global $bw,$vsLang,$vsMenu,$vsStd;
		$vsStd->requireFile(CORE_PATH."polls/polls.php");
		$this->po = new polls();
		
		$BWHTML .= <<<EOF
				<if="$vsMenu->getCategoryGroup('polls')->children">
						<div class="vote">
							<h3>{$vsLang->getWords('global_poll','THĂM DÒ Ý KIẾN')}</h3>
							<foreach="$vsMenu->getCategoryGroup('polls')->getChildren() as $value">
							<p id="vote" value='{$value->getId()}'>{$value->getTitle()}</p>
							<php>
	                        	$this->polls = $this->po->getListWithCat($value);
	                        </php>
	                        <form>
	                        <if="count($this->polls)">
                                <foreach="$this->polls as $oValue">
                                	<label>
                                 	<input type="checkbox" value="{$oValue->getId()}" onclick="CheckThisVote(this.value)">
                                 	{$oValue->getTitle()}
                                 	</label>
                            	</foreach>
                            	
                            	<input href="#" id="subvoite" type="button" class="binhluan_btn" value="{$vsLang->getWords('global_vote','Bình luận')}">
                            		
                            
								<a href="#" class="binhluan_btn" onclick="vsf.get('polls/view/'+$('#vote').attr('value'),'sa');">
									{$vsLang->getWords('global_result','Kết quả')}
								</a>
								</div class='clear'>
                            </if>
                            </form>
                       		</foreach>
						
						<div id='sa'></div>
						<script>
				       		function CheckThisVote(valu){
								$('input[type=checkbox]').each(function(){
									if(this.value!=valu){
										if(this.checked)
											this.checked = false
										}
								});	
							}
							
							$("#subvoite").click(function(){
								var value =0;
								$("input[type=checkbox]").each(function(){
									if(this.checked)
										value = this.value;
								})
								if(!value){
									alert("{$vsLang->getWordsGlobal('global_error_vote','Hãy chọn một trong các mục trước khi bình chọn')}");
									return false;	
								}
								vsf.get("polls/vote/"+value,"sa");
							})
				       </script>
       			</if>
EOF;
   		return $BWHTML;
	}

	function portlet_dropdown_weblink($option=array()){
		global $bw,$vsLang,$vsMenu,$vsStd,$vsPrint;
		$vsPrint->addJavaScriptString ( 'global_weblink', '
    			   $("#link").change(function(){
                               if($("#link").val())
                                    window.open($("#link").val(),"_blank");
                            });
    		' );
		
		$BWHTML .= <<<EOF
		            
            <form class="weblink">
                <label></label>
                    <select class="styled" id="link">
                    	<option value="0">{$vsLang->getWordsGlobal('global_lienket','Liên kết')}</option>
                        <foreach="$option as $wl">
                            <option value="{$wl->getWebsite()}"> {$wl->getTitle()}</option>
                            </foreach>       
                    </select>
                
            </form>
        
EOF;
   		return $BWHTML;
	}
        
function portlet_sitebar($option=array()){
		global $bw,$vsLang,$vsMenu,$vsStd,$vsPrint,$vsTemplate;
		
		$BWHTML .= <<<EOF
		            
            <div class="sitebar">
        	<ul class="menu_sub">
            	 {$vsTemplate->global_template->menu_sub[$bw->input['module']]}     
            </ul>
            <if="$vsTemplate->global_template->adv['partners']">
            <div class="slide_adverting">
                 <ul>
                     <foreach="$vsTemplate->global_template->adv['partners'] as $partn">    
                         <li>
                             <a href="{$partn->getWebsite()}" target="_blank" title="{$partn->getTitle()}">
                             {$partn->createImageCache($partn->file,228,102,1)}
                             </a>
                         </li>
                     </foreach>
                 </ul>                
             </div>
             </if>
		     <!-- STOP SLIDE -->
             
        </div>
        
EOF;
   		return $BWHTML;
	}
	
}
?>