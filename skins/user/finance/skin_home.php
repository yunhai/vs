<?php
class skin_home extends skin_products{
	
function showDefault($option){
	global $bw,$vsLang,$vsPrint,$vsTemplate;
	$vsPrint->addCSSFile("classic-accordion");
	$vsPrint->addCSSFile('fix');
		$BWHTML .= <<<EOF
	
		
		<if="$option['cate']">
		<style>
		<foreach="$option['cate'] as $lv1">
		ul.accordion li.bg{$vsf_count}{
		    background:url({$lv1->getCacheImagePathByFile($lv1->getFileId(),777,350)}) no-repeat;
		}
		</foreach>
		</style>
		<script>
		$(document).ready(function(){
			$(function() {
                $("#accordion > li").hover(
                    function () {
						$("#accordion li").each(function(){
							var img = $(this);
							img.stop().animate({"width":"61px"},500);							
						});
                        var img = $(this);
                        img.stop().animate({"width":"777px"},500);
                        $(".bgDescription",img).stop(true,true).slideDown(500);
                        $(".description",img).stop(true,true).delay(1000).fadeIn();
                    },
                    function () {
                        var img = $(this);
						$("#accordion li").each(function(){
							var img = $(this);
							img.stop().animate({"width":"240px"},500);							
						});
                        $(".description",img).stop(true,true).fadeOut(500);
                        $(".bgDescription",img).stop(true,true).slideUp(700);
						
                    }
                );

			});
			
			
		});
		</script>

		<div class="slide_home">
    	  	<ul class="accordion" id="accordion">
    	  	<foreach="$option['cate'] as $lv1">
            	<li class="bg{$vsf_count}">
                	<div class="heading"></div>
                	<div class="description">
                        <foreach="$lv1->getChildren() as $lv2">
                        	<a href="{$lv2->getUrlCategory()}" title="{$lv2->getTitle()}">
                                <span>{$lv2->getTitle()}</span>
                            </a>
                    	</foreach>
                 		<div class="clear_left"></div>
                 	</div>
        		</li>
          	</foreach>
           	</ul>
		</div>
		</if>
		<style>
			#banner_top{
				margin-bottom: 0px;
			}
			.slide_home{
				margin-top: 30px;
			}
		</style>
		<!-- STOP SLIDE -->
		{$vsTemplate->global_template->portlet_promotion}
		
		<script>
		$(document).ready(function(){
			$(function() {
				
				$('.product_home_item').hover(function(){
					$(this).find('.product_text').fadeIn('700');			
				},function(){
					$(this).find('.product_text').fadeOut('700');
				});
			});
		});
		$(document).ready(function(){
				$('a.tab').click(function(){
                $('.active').removeClass('active');
                $(this).addClass('active');
                $('.product_home').slideUp();
                var content_show = $(this).attr('title');
                $('#'+ content_show).slideDown();
            });
			
		});
		</script>
		<div id="content_home">
			<h3 class="main_title1">
	            <ul class="tabs">
	           		<li><a  class="active tab" title="product_home1">{$vsLang->getWordsGlobal("global_products_new","sản phẩm mới")}</a></li>
	              	<li><a  class="tab" title="product_home2">{$vsLang->getWordsGlobal("global_products_hot","sản phẩm bán chạy")}</a></li>
	              	<div class="clear"></div>
	       		</ul>
	        </h3>
    	
	    	<div class="product_home" id="product_home1">
	    		<if="$option['pro_new']">
	        	{$this->loadProduct($option['pro_new'])}
	            
	            
	            <a href="{$bw->base_url}products/filter/new/{$option['strId_new']}" class="view_all">{$vsLang->getWordsGlobal("global_viewmore","Xem thêm")}</a>
	        	<div class="clear_right"></div>
	        	</if>
	        </div>
        
	        <div class="product_home" id="product_home2">
	        	<if="$option['banchay']">
	            {$this->loadProduct($option['banchay'])}
	            
	            <a href="{$bw->base_url}products/filter/hot/{$option['strId_hot']}" class="view_all">{$vsLang->getWordsGlobal("global_viewmore","Xem thêm")}</a>
	        	<div class="clear_right"></div>
	        	</if>
	        	
	        </div>
    	</div>
    	
    <!-- STOP CONTENT HOME -->
		
EOF;
	}
	
	function showDefault_cu_18_6($option){
	global $bw,$vsLang,$vsPrint,$vsTemplate;
	$vsPrint->addCSSFile("classic-accordion");

		$BWHTML .= <<<EOF
	
		
		<if="$option['cate']">
		<style>
		<foreach="$option['cate'] as $lv1">
		ul.accordion li.bg{$vsf_count}{
		    background:url({$lv1->getCacheImagePathByFile($lv1->getFileId(),777,350)}) no-repeat;
		}
		</foreach>
		</style>
		<script>
		$(document).ready(function(){
			$(function() {
                $("#accordion > li").hover(
                    function () {
						$("#accordion li").each(function(){
							var img = $(this);
							img.stop().animate({"width":"61px"},500);							
						});
                        var img = $(this);
                        img.stop().animate({"width":"777px"},500);
                        $(".bgDescription",img).stop(true,true).slideDown(500);
                        $(".description",img).stop(true,true).delay(1000).fadeIn();
                    },
                    function () {
                        var img = $(this);
						$("#accordion li").each(function(){
							var img = $(this);
							img.stop().animate({"width":"240px"},500);							
						});
                        $(".description",img).stop(true,true).fadeOut(500);
                        $(".bgDescription",img).stop(true,true).slideUp(700);
						
                    }
                );

			});
		});
		</script>

		<div class="slide_home">
    	  	<ul class="accordion" id="accordion">
    	  	<foreach="$option['cate'] as $lv1">
            	<li class="bg{$vsf_count}">
                	<div class="heading"></div>
                	<div class="description">
                        <foreach="$lv1->getChildren() as $lv2">
                        	<a href="{$lv2->getUrlCategory()}" title="{$lv2->getTitle()}">
                                <span>{$lv2->getTitle()}</span>
                            </a>
                    	</foreach>
                 		<div class="clear_left"></div>
                 	</div>
        		</li>
          	</foreach>
           	</ul>
		</div>
		</if>
		<style>
			#banner_top{
				margin-bottom: 0px;
			}
			.slide_home{
				margin-top: 30px;
			}
		</style>
		<!-- STOP SLIDE -->
		{$vsTemplate->global_template->portlet_promotion}
		<if="$option['product']">
		<script>
		$(document).ready(function(){
			$(function() {
				
				$('.product_home_item').hover(function(){
					$(this).find('.product_text').fadeIn('700');			
				},function(){
					$(this).find('.product_text').fadeOut('700');
				});
				
				
			});
		});
		</script>
		<div id="content_home">
    	<h3 class="main_title">{$vsLang->getWordsGlobal("global_products","sản phẩm")}</h3>
        <div class="product_home">
        {$this->loadProduct($option['product'])}	
        </div>
        <a href="{$bw->base_url}products" class="view_all">{$vsLang->getWordsGlobal("global_viewmore","Xem thêm")}</a>
        <div class="clear_right"></div>
    	</div>
    	</if>
    <!-- STOP CONTENT HOME -->
		
EOF;
	}
	
function showDefault_cu_cu($option){
	global $bw,$vsLang,$vsPrint,$vsTemplate;
	$vsPrint->addCSSFile("classic-accordion");

		$BWHTML .= <<<EOF
	
		
		<if="$option['cate']">
		<style>
		<foreach="$option['cate'] as $lv1">
		ul.accordion li.bg{$vsf_count}{
		    background:url({$lv1->getCacheImagePathByFile($lv1->getFileId(),777,350)}) no-repeat;
		}
		</foreach>
		</style>
		<script>
		$(document).ready(function(){
			$(function() {
                $("#accordion > li").hover(
                    function () {
						$("#accordion li").each(function(){
							var img = $(this);
							img.stop().animate({"width":"61px"},500);							
						});
                        var img = $(this);
                        img.stop().animate({"width":"777px"},500);
                        $(".bgDescription",img).stop(true,true).slideDown(500);
                        $(".description",img).stop(true,true).delay(1000).fadeIn();
                    },
                    function () {
                        var img = $(this);
						$("#accordion li").each(function(){
							var img = $(this);
							img.stop().animate({"width":"240px"},500);							
						});
                        $(".description",img).stop(true,true).fadeOut(500);
                        $(".bgDescription",img).stop(true,true).slideUp(700);
						
                    }
                );

			});
		});
		</script>

		<div class="slide_home">
    	  	<ul class="accordion" id="accordion">
    	  	<foreach="$option['cate'] as $lv1">
            	<li class="bg{$vsf_count}">
                	<div class="heading"></div>
                	<div class="description">
                        <foreach="$lv1->getChildren() as $lv2">
                        	<a href="{$lv2->getUrlCategory()}" title="{$lv2->getTitle()}">
                            	{$lv2->createImageCache($lv2->getFileId(),100,60,2)}
                                <span>{$lv2->getTitle()}</span>
                            </a>
                    	</foreach>
                 		<div class="clear_left"></div>
                 	</div>
        		</li>
          	</foreach>
           	</ul>
		</div>
		</if>
		<style>
			#banner_top{
				margin-bottom: 0px;
			}
			.slide_home{
				margin-top: 30px;
			}
		</style>
		<!-- STOP SLIDE -->
		{$vsTemplate->global_template->portlet_promotion}
		<if="$option['product']">
		<script>
		$(document).ready(function(){
			$(function() {
				
				$('.product_home_item').hover(function(){
					$(this).find('.product_text').slideDown('3000');			
				},function(){
					$(this).find('.product_text').fadeOut('900000');
				});
				
				
			});
		});
		</script>
		<div id="content_home">
    	<h3 class="main_title">{$vsLang->getWordsGlobal("global_products","sản phẩm")}</h3>
        <div class="product_home">
        {$this->loadProduct($option['product'])}	
        </div>
        <a href="{$bw->base_url}products" class="view_all">{$vsLang->getWordsGlobal("global_viewmore","Xem thêm")}</a>
        <div class="clear_right"></div>
    	</div>
    	</if>
    <!-- STOP CONTENT HOME -->
		
EOF;
	}
	
}
?>