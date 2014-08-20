<?php

class skin_products extends skin_objectpublic {

	function showDefault($option = array()) {
		global $bw,$vsPrint;
		$this->bw = $bw;
		$BWHTML .= <<<EOF
		<div class="content_mid">
		<div class="content_mid_title">{$vsPrint->mainTitle}</div>
		<foreach="$option['pageList'] as $obj ">
		<div class="pro_item">
			<div class="im"><a href="{$obj->getUrl('products')}">{$obj->createImageCache($obj->getImage(),210,210)}</a></div>
			<div class="na">
				<a href="{$obj->getUrl('products')}">{$obj->getTitle()}</a>
			</div>
			
			<if="$obj->getPromotionPrice()">
			<div class="price promo">
				<div class="price_old">{$this->numberFormat($obj->getPrice())} VNÐ</div>
				<div class="price_promo">{$this->numberFormat($obj->getPromotionPrice())} VNÐ</div>
			</div>
			<else />
			<div class="price"><if="$obj->getPrice()">{$this->numberFormat($obj->getPrice())} VNÐ<else />Call</if></div>
			</if>
			
			<a class="order" onclick="addCart({$obj->getId()})"></a>
			<if="$obj->getPromotionPrice()">
			<div class="sale"></div>
			</if>
		</div>
		</foreach>
		<div class="clear"></div>
		<div class="page"> {$option['paging']}</div>
	</div>
		
EOF;
	}


	function showDetail($obj, $option = array()) {
		global $bw, $vsPrint;
		
		$this->bw = $bw;
		
		 $this->catTitle=$option['cate_obj']->getTitle();
		 $this->bw=$bw;
		 $this->urlCate="{$this->bw->base_url}products/category/{$option['cate_obj']->getSlugId()}";
		
		
		$BWHTML .= <<<EOF
		
		
		<script>
			 $(function() {
			      if(window.hs!=null)
			{
			hs.graphicsDir = boardUrl+"/skins/user/finance/javascripts/highslide/graphics/";
			hs.align = 'center';
			hs.transitions = ['expand', 'crossfade'];
			hs.outlineType = 'glossy-dark';
			hs.fadeInOut = true;
			hs.dimmingOpacity = 0.75;
			// Add the controlbar
			if (hs.addSlideshow) hs.addSlideshow({
			                        //slideshowGroup: 'group1',
			                        interval: 5000,
			                        repeat: false,
			                        useControls: true,
			                        fixedControls: false,
			                        overlayOptions: {
			                        opacity: 1,
			                        position: 'bottom center',
			                        hideOnMouseOut: true
			                        }
			                });
			}
			             });
		</script>
		
		<div class="content_mid">
		<div class="content_mid_title">{$this->catTitle}</div>
		<div class="pro_detail">
			<div class="im">
				{$obj->createImageCache($obj->getImage(),210,210)}
				<a onclick="return hs.expand(this)"  class="zoom highslide"  href="{$obj->getCacheImagePathByFile($obj->getImage(),1,1,1,1)}" class="zoom"></a>
				<div class="sale"></div>
				</div>
			<div class="detail_right">
				<div class="na">{$obj->getTitle()}</div>
				<div class="intro">{$this->cut($obj->getIntro(),150)}</div>
				<div class="code"><span class="tit">Mã SP</span>:{$obj->getCode()}</div>
				<div class="status"><span class="tit">Trình trạng</span>:<if="$obj->getState()>0 ">Còn hàng <else />Hết hàng</if></div>
				<div class="view"><span class="tit">Lượt xem</span>:{$obj->getHot()}</div>
				<if="$obj->getPromotionPrice()">
				<div class="price"><span class="tit">Giá</span>:<span class="old">{$this->numberFormat($obj->getPrice())}</span>{$this->numberFormat($obj->getPromotionPrice())} VNÐ</div>
				
				<else />
				<div class="price"><span class="tit">Giá</span>:<if="$obj->getPrice()">{$this->numberFormat($obj->getPrice())} VNÐ<else />Call</if></div>
				</if>
				<a onclick="addCart({$obj->getId()})"  class="order_button"></a>
			</div>
		</div>
		<div class="other">Sản phẩm khác</div>
			<foreach="$option['other'] as $obj ">
		<div class="pro_item">
			<div class="im"><a href="{$obj->getUrl('products')}">{$obj->createImageCache($obj->getImage(),210,210)}</a></div>
			<div class="na">
				<a href="{$obj->getUrl('products')}">{$obj->getTitle()}</a>
			</div>
			
			<if="$obj->getPromotionPrice()">
			<div class="price promo">
				<div class="price_old">{$obj->getPrice()} VNÐ</div>
				<div class="price_promo">{$obj->getPromotionPrice()} VNÐ</div>
			</div>
			<else />
			<div class="price"><if="$obj->getPrice()">{$this->numberFormat($obj->getPrice())} VNÐ<else />Call</if></div>
			</if>
			<a class="order" href=""></a>
			<if="$obj->getPromotionPrice()">
			<div class="sale"></div>
			</if>
		</div>
		</foreach>
		<div class="clear"></div>
	</div>
				
<script>
var urlcate= '{$this->urlCate}';


</script>
		
		
EOF;
	}

	function showSearch($option = array()) {
		global $bw,$vsPrint;
		$BWHTML .= <<<EOF
EOF;
	}
	
	
}
?>