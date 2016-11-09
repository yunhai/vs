<?php
class skin_products extends skin_objectpublic{

//sanpham
function showDefault($option){
	global $bw,$vsLang,$vsPrint,$vsTemplate;
	
	
		$BWHTML .= <<<EOF
		<div id="content">
		<if="$option['title']">
		<h3 class="main_title">{$option['title']}</h3>
		<else />
    	<h3 class="main_title">{$vsTemplate->global_template->navigator}</h3>
    	</if>
    	<if="$option['pageList']">
    	<script>
		$(document).ready(function(){
			$(function() {
				$(".product_home_item").hover(function(){
						$(this).find(".product_text").fadeIn(700);
					  }, function (){
						$(this).find(".product_text").fadeOut(700);
					  });
			});
		});
		</script>
        <div class="product">
        {$this->loadProduct($option['pageList'])}
        <else />
        	<p class="nodata">{$vsLang->getWordsGlobal('global_nodata','Dữ liệu đang được chúng tôi cập nhật')}</p>
    	</if>	
        </div>
        <if="$option['paging']">
     		<div class="page">
        	{$option['paging']}
        	</div>
     	</if>
        <div class="clear_right"></div>
    	</div>
    	

EOF;
	}
	


function showDetail($obj,$option){
		global $bw,$vsLang,$vsPrint,$vsTemplate;
		
		
		$vsPrint->addCurentJavaScriptFile("highslide/highslide-full");
		if ($option['gallery']){
			$vsPrint->addCurentJavaScriptFile("jquery.galleriffic");
			$vsPrint->addCurentJavaScriptFile("jquery.opacityrollover");
		}
		
		$vsPrint->addCSSFile('galleriffic-2');

		$BWHTML .= <<<EOF
		<style>
		.color_thumb{
		border: 1px solid #fff;
		width:26px;
		height:14px;
		position:relative;
		float:left;
		margin-right:3px;
		}
		.view{
		border: 1px solid #ccc;
		background:#fff;
		position:absolute;
		top:-145px;
		display:none;
		}
		.view p{
			font-weight:bold;
			border-top: 1px solid #ccc;
			line-height:22px;
			padding-left:10px;
		}
		.list_color_product{margin-top:10px;}
		.color_thumb_img:hover{
		border: 1px solid #999;
		padding:1px;
		background:#fff;
		width:22px;
		height:10px;
		cursor:pointer;
		}
		</style>
		<div id="content">
    	<h3 class="main_title">{$vsTemplate->global_template->navigator}</h3>
    	<if="$option['gallery']">
		<div class="product_slide">
       		<div id="gallery" class="content gallery-content">
            	<div class="slideshow-container">
                	<div id="loading" class="loader"></div>
                  	<div id="slideshow" class="slideshow"></div>
              	</div>
          	</div>
                        
  			<div id="thumbs" class="navigation">
            	<ul class="thumbs noscript">
            		<foreach=" $option['gallery'] as $image ">
                	<li>
                    	<a class="thumb" name="leaf" href="{$image->getResizeImagePath($image->getPathView(),407,279,1)}" title="{$image->getTitle()}">
                    	{$image->createImageCache($image,80,57,2)}
                     	</a>                                
                 	</li>
        			</foreach>
                	<div class="clear_left"></div>
            	</ul>
          	</div>
        	<div id="controls" class="controls"></div>
     	</div>
      	<else />
       		<div class="product_slide" style="height:auto;">
            	{$obj->showImagePopup($obj->file,407,279,"pro_detail_img",4)}
          	</div>
      	</if>
      	<script>
			$(document).ready(function(){
				$('.navigation').find("img").addClass('pandog');
			});
		</script>
      	<!-- STOP PRODUCT SLIDE -->
            
      	<div class="product_detail">
            <h3>{$obj->getTitle()}</h3>
            <if="$option['brand']">
            <p style="font-weight:bold;">{$vsLang->getWords("products_brands","Thương hiệu")}: <span style="font-weight:normal;">{$option['brand']->getTitle()}</span></p>
          	</if>
            <if="$obj->getPrice()"><p class="cost">{$vsLang->getWords("global_price","Giá")}: <span>{$obj->getPrice()} {$vsLang->getWords("global_unit","VND")}</span></p></if>
          	<a href="{$bw->base_url}orders/addtocart/{$obj->getId()}" class="dathang_btn">{$vsLang->getWords("global_order","Đặt hàng")}</a>
          	<if="$obj->getColor()">
                	<div class="list_color_product">
                	<p style="font-weight:bold;margin-bottom:10px">{$vsLang->getWords('p_mausanco','Các màu sẵn có')}:</p>
                  	<foreach="$obj->getListColor() as $index => $color">
                  		<div class="color_thumb">
	                   		<img src="{$color->file->getCacheImagePathByFile($color->file,26,14,0)}" title="{$color->getTitle()}" class="color_thumb_img" id="{$index}" rel='{$color->file->getCacheImagePathByFile($color->file,182,98,0)}'>
	                   		<div id="colorpreview{$index}" class="view">
	                   		{$color->createImageCache($color->file,208,112)}
	                   		<p>{$color->getTitle()}</p>
	                 		</div>
                   		</div>
                  	</foreach>

                  	<div class="clear_left"></div>
                  	<script type="text/javascript">
				 	$('.color_thumb_img').hover(function() {
						$(this).next().css({display: "block"});
						},function(){
					 	$(this).next().css({display: "none"});
				 	});
					</script> 
					</div>                                
          	</if>
          	
     		<p>{$obj->getContent()}</p>

     	</div>
    	<!-- STOP PRODUCT DETAIL-->

    	<div class="clear"></div>
    	
    	
    	<if="$option['other']">
    	<script>
		$(document).ready(function(){
			$(function() {
				$(".product_home_item").hover(function(){
						$(this).find(".product_text").fadeIn(700);
					  }, function (){
						$(this).find(".product_text").fadeOut(700);
					  });
			});
		});
		</script>
		<div class="other">
			<a href="{$bw->base_url}products" class="view_all1">{$vsLang->getWordsGlobal("global_viewall","Xem tất cả")}</a>
			<h3 class="main_title">{$vsLang->getWords($bw->input['module'].'_other','sản phẩm cùng loại')}</h3>
	        <div class="product">
	        {$this->loadProduct($option['other'])}
	        </div>
       	</div>
        <div class="clear_right"></div>
		</if>
    	</div>
EOF;
	}
	
function showDetail_listcolor($obj,$option){
		global $bw,$vsLang,$vsPrint,$vsTemplate;
		// ds mau -> click mau -> thay toan bo slide
		
		$vsPrint->addCurentJavaScriptFile("highslide/highslide-full");
		if ($option['gallery']){
			$vsPrint->addCurentJavaScriptFile("jquery.galleriffic");
			$vsPrint->addCurentJavaScriptFile("jquery.opacityrollover");
		}
		
		$vsPrint->addCSSFile('galleriffic-2');
		
		$BWHTML .= <<<EOF
		<style>
		.active_color{
		border: 1px solid #ccc;
		padding:1px;
		float:left;
		}
		</style>
		<div id="content">
    	<h3 class="main_title">{$vsTemplate->global_template->navigator}</h3>
    	<if="$option['gallery']">
		<div class="product_slide">
       		<div id="gallery" class="content gallery-content">
            	<div class="slideshow-container">
                	<div id="loading" class="loader"></div>
                  	<div id="slideshow" class="slideshow"></div>
              	</div>
          	</div>
                        
  			<div id="thumbs" class="navigation">
            	<ul class="thumbs noscript">
            		<foreach=" $option['gallery'] as $image ">
                	<li>
                    	<a class="thumb" name="leaf" href="{$image->getResizeImagePath($image->getPathView(),407,279,1)}" title="{$image->getTitle()}">
                    	{$image->createImageCache($image,80,57,2)}
                     	</a>                                
                 	</li>
        			</foreach>
                	<div class="clear_left"></div>
            	</ul>
          	</div>
        	<div id="controls" class="controls"></div>
     	</div>
      	<else />
       		<div class="product_slide" style="height:auto;">
            	{$obj->showImagePopup($obj->file,407,279,"pro_detail_img",4)}
          	</div>
      	</if>
      	<script>
			$(document).ready(function(){
				$('.navigation').find("img").addClass('pandog');
			});
		</script>
      	<!-- STOP PRODUCT SLIDE -->
            
      	<div class="product_detail">
            <h3>{$obj->getTitle()}</h3>
            <div class="list_color_product">
            	<if="$obj->getColor()">
                	<p>{$vsLang->getWords('p_mausanco','Các màu sẵn có')}:</p>
                  	<foreach="$obj->getListColorFile() as $index => $file">
                   		<a href="{$obj->getUrl($bw->input['module'])}<if="$index!=$option['current']->getId()">?color={$index}</if>" <if="$index==$bw->input['color']">class="active_color"</if>>
                   		<img fileid="{$index}" src="{$file->getCacheImagePathByFile($file,12,11,0)}" title="{$file->getTitle()}" >
                   		</a>
                  	</foreach>
                  	<div class="clear_left"></div>                                 
             	</if>
          	</div>
          	<if="$obj->getPrice()"><p class="cost">{$vsLang->getWords("global_price","Giá")}: <span>{$obj->getPrice()} {$vsLang->getWords("global_unit","VND")}</span></p></if>
          	<a href="{$bw->base_url}orders/addtocart/{$obj->getId()}" class="dathang_btn">{$vsLang->getWords("global_order","Đặt hàng")}</a>
     		<p>{$obj->getContent()}</p>
     		
     	</div>
    	<!-- STOP PRODUCT DETAIL-->

    	<div class="clear"></div>
    	
    	
    	<if="$option['other']">
    	<script>
		$(document).ready(function(){
			$(function() {
				$(".product_home_item").hover(function(){
						$(this).find(".product_text").fadeIn(700);
					  }, function (){
						$(this).find(".product_text").fadeOut(700);
					  });
			});
		});
		</script>
		<div class="other">
			<a href="{$bw->base_url}products" class="view_all1">{$vsLang->getWordsGlobal("global_viewall","Xem tất cả")}</a>
			<h3 class="main_title">{$vsLang->getWords($bw->input['module'].'_other','sản phẩm cùng loại')}</h3>
	        <div class="product">
	        {$this->loadProduct($option['other'])}
	        </div>
       	</div>
        <div class="clear_right"></div>
		</if>
    	</div>
EOF;
	}
	function loadProduct($option){
		global $bw,$vsLang, $vsPrint;
		
		$BWHTML .= <<<EOF
		
    	<foreach="$option as $obj">
        	<div class="product_home_item">
            	{$obj->createImageCache($obj->file, 210,140, 0, 1)}
            	<div class="product_text">
                	<div class="product_text_intro">
                		<h3><a href="{$obj->getUrl('products')}" title="{$obj->getTitle()}">{$obj->getTitle()}</a></h3>
	                    <p>{$obj->getIntro(100)}</p>
                    </div>
                    <a href="{$obj->getUrl('products')}" title="{$obj->getTitle()}" class="dathang_btn">{$vsLang->getWordsGlobal("global_detail","Chi tiết")}</a>
                    <div class="clear_left"></div>
                </div>
            </div>
     	</foreach>
        <div class="clear_left"></div>
		
EOF;
	}
	


}
?>