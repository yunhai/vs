<?php
class skin_addon {
	///show menu top cho user.SU dung mac dinh co san.Chinh sua mot it cho nhanh.Thanks
	function showMenuTopForUser($option= array()) {
		global $bw, $vsLang ,$vsTemplate;

		$BWHTML .= <<<EOF
				
		<ul class="menu_top">
			<foreach="$option as $obj">
				<li class="{$obj->getClassActive()}">
				<a <if="$obj->getIsLink()">href="{$obj->getUrl(0)}"</if> class="{$obj->getClassActive()}" ><span>{$obj->getTitle()}</span>
				</a>
				<if="strpos($obj->getUrl(0),'products')">
				<img src="{$bw->vars['img_url']}/new2.gif" class="news_icon"/>
				</if>
	   			<if="$vsTemplate->global_template->menu_sub[$obj->getAlt()] || $obj->getChildren()">
	   			<ul>
	          	{$vsTemplate->global_template->menu_sub[$obj->getAlt()]}
	          	{$obj->getChildrenLi()}     
	         	</ul>
	         	</if>
	   			</li>
	   		</foreach>
	   		<div class="clear_left"></div>
     	</ul>  

     	
EOF;
		return $BWHTML;
	}
	function showMenuBottomForUser($option= array()) {
		global $bw, $vsLang ,$vsTemplate;

		$BWHTML .= <<<EOF
		
       	<ul  class="menu_footer">
	       	<foreach="$option as $obj">
	        	<li><a href="{$obj->getUrl(0)}" class="{$obj->getClassActive()}" title="{$obj->getTitle()}"><span>{$obj->getTitle()}</span></a></li>
	      	</foreach>
        	<div class="clear_left"></div>
     	</ul>	
     	
EOF;
		return $BWHTML;
	}
	
	function showMenuLeft() {
		global $bw, $vsLang ,$vsTemplate;
	
		$BWHTML .= <<<EOF
			<if="$vsTemplate->global_template->menu_sub[$bw->input['module']]">
			<h3 class="main_title">{$vsLang->getWordsGlobal("global_categories_".$bw->input['module'],"DANH MỤC SẢN PHẨM")}</h3>
		
            <ul id="menu" class="product_list">
            	{$vsTemplate->global_template->menu_sub[$bw->input['module']]}
            </ul>
    		</if>
	    
EOF;
		return $BWHTML;
	}
	
	
	
	function portlet_supports($option= array()) {
		global $bw, $vsLang;
		
				$BWHTML .= <<<EOF
		<if="$option">
	    <div class="support">
	    	<p>{$vsLang->getWordsGlobal("global_supports","Hỗ trợ trực tuyến")}:</p>
	    	<foreach=" $option as $key =>$obj">
            	{$obj->show()}
       		</foreach>
       		<div class="clear_left"></div>
     	</div>
		</if>		
  
EOF;
		return $BWHTML;
	}
	
	
	function portlet_banner($option) {
		global $bw, $vsLang,$vsPrint,$vsTemplate;
        $vsPrint->addCurentJavaScriptFile("jquery.prettyPhoto"); 
 		$vsPrint->addCurentJavaScriptFile("jquery.aviaSlider.min");
 		$vsPrint->addCSSFile('style');
		$BWHTML .= <<<EOF
    	<if="$option">
    	<div class="banner">
            <ul class='aviaslider' id="frontpage-slider">
				<foreach="$option as $slide">
                	<li>{$slide->show(987,255)}</li>
               	</foreach>
			</ul>
        </div>
    	
		</if>
	  
EOF;
	}
	
	
	
	function portlet_weblink($option=array()){
		global $bw,$vsLang,$vsMenu,$vsStd,$vsPrint;
		
		$BWHTML .= <<<EOF
           
      	<div class="lienketweb">
                	<h3>{$vsLang->getWordsGlobal("global_lienketweb","Liên kết website")}:</h3>
                    <div class="lienketweb_content">
                        <foreach="$option as $wl">
                        <a href="{$wl->getWebsite()}" target="_blank">
                        <if="$wl->getImage()">
                        {$wl->createImageCache($wl->getImage(),200,35,4)}
                        <else />
						{$wl->getWebsite()}
						</if>
						</a>
                        </foreach>   
                    </div>
                    <div class="lienket_bottom"><img src="{$bw->vars['img_url']}/lienket_bottom.jpg" /></div>
                </div>      
           
        
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
             	 
                    <select class="styled" id="link">
                    	<option value="0">---{$vsLang->getWordsGlobal("global_lienketweb","Liên kết website")}---</option>
                        <foreach="$option as $wl">
                            <option value="{$wl->getWebsite()}" > {$wl->getTitle()}</option>
                    	</foreach>       
                    </select>
                    
            </form>
            
            
           
        
EOF;
   		return $BWHTML;
	}
	
	function portlet_partner($option) {
		global $bw, $vsLang,$vsPrint;
//		$vsPrint->addCurentJavaScriptFile("jcarousellite"); 
//        $vsPrint->addCSSFile('jcarousellite');
       
		$BWHTML .= <<<EOF
		<if="$option">
		
		<h3 class="main_title">{$vsLang->getWordsGlobal('global_partners','Đối tác')}</h3>
		<div class="slide_partner">
       		<foreach="$option as $obj">
        	<a href="{$obj->getWebsite()}" title="{$obj->getTitle()}" target="_blank">{$obj->createImageCache($obj->file,220,63)}</a>
            </foreach>
    	</div>
      	</if>

EOF;
	}
	
function portlet_search($option){
		global $bw, $vsLang,$vsPrint;
		$stringSearch = $vsLang->getWords('search_key','Từ khóa tìm kiếm...');

		$BWHTML .= <<<EOF
		
        <form class="search_top" name='form_search' id='form_search' method='POST' action='{$bw->base_url}searchs/'>
            <input id="keySearch" name="keySearch" type="text" onfocus="if(this.value=='{$stringSearch}') this.value='';" onblur="if(this.value=='') this.value='{$stringSearch}';" value="{$stringSearch}" class="input_text" />   
        	<input type="button" value="{$vsLang->getWordsGlobal("global_search","Search")}" class="search_btn" id='submit_form_search'/>
        	<div class="clear_left"></div>
       	</form>
        <script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$("#keySearch").keydown(function(e){
        	if(e.keyCode==13)
          	var str =  $('#keySearch').val();
    		if(str=="" || str =="{$stringSearch}")return false;
  		})
    	$('#submit_form_search').click(function()  {
        	if($('#keySearch').val()==""||$('#keySearch').val()=="{$stringSearch}") {
           		jAlert('{$vsLang->getWords('global_tim_thongtin','Vui lòng nhập thông tin cần search:please!!!!!')}',
                        '{$bw->vars['global_websitename']} Dialog');
               	return false;
          	}
          	str =  $('#keySearch').val()+"/";
           	document.location.href="{$bw->base_url}searchs/"+ str;
           	return;
    	});
                
	});
</script>

EOF;
	}

function portlet_promotion($option) {
		global $bw, $vsLang,$vsPrint;
       $vsPrint->addCurentJavaScriptFile("jquery.innerfade"); 

		$BWHTML .= <<<EOF
    	<if="$option">
    	<script>
		$(document).ready(function(){
			$('#banner_top').innerfade({
				animationtype: 'fade',
				speed:1000,
				timeout:3000,
				type: 'random',
				containerheight: '147px'
			});
		});
		</script>
		
      		<div id="banner_top">
            <foreach="$option as $slide">
            <if="$slide->file">
            <a href="{$slide->getUrl('promotions')}" >{$slide->createImageCache($slide->file,961,147)}</a>
            </if>
            </foreach>					 
            </div>
		
		</if>
		
EOF;
	}
	

}
?>