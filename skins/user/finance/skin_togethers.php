<?php
class skin_togethers extends skin_objectpublic{
	function showDefault($option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] )->getChildren();
		$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]."s");
		
		$cateId = $option['obj']?$option['obj']->getId():0;
		
		$BWHTML .= <<<EOF
		
			<div class="content">
						<div class="product">
								<div class="tilte_home">{$vsPrint->mainTitle}</div>
								<div class="product_center">
								<foreach="$option['pageList'] as $obj ">
									<div class="Gogo">
										<a href="{$obj->getUrl('togethers')}">{$obj->getTitle()}</a>
										<span>({$this->dateTimeFormat($obj->getPostDate())})</span>
									</div>
									</foreach>
								</div>
								
								<div class="product_center">
										<div class="paging">
											{$option['paging']}
										</div>
								</div>
						</div>
				</div>
EOF;
	}
	
	function showDetail($obj,$option = array()) {
		global $bw,$vsPrint;
		
		$this->bw=$bw;
		$option['cate'] = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] )->getChildren();
		$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]."s");
		$BWHTML .= <<<EOF
		
		
						 <script type="text/javascript">
                      (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                      })();
                    </script>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		

<div class="content">
						<div class="product">
								<div class="tilte_home">{$vsPrint->mainTitle}</div>
								<div class="product_center">
										<div class="title_news"><a>{$obj->getTitle()}</a>
											<span>{$this->getLang()->getWords('date_update')}: {$this->dateTimeFormat($obj->getPostDate())}</span>
											{$obj->getContent()}
										
										</div>
								</div>
											<div class="facebook">

															<div class="social_top">
                            <div class="gplus"><g:plusone size="medium" href="{$url}"><g:plusone></div>
                            <div class="twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-url="" data-text="" data-via="Phusinh" data-related="Phusinh" data-hashtags="Phusinh">Twiter</a>
              				</div>
                            <div class="fb-like" data-href="" data-send="false" data-layout="button_count" data-width="80" data-show-faces="true"></div>
                           
                      </div> 	  
											
										
												</div>
												<div class="other">
													 <h3><span>{$this->getLang()->getWords('News_fix')}:</span></h3>
													 <if="$option['other'] ">
													 <foreach="$option['other'] as $obj ">
													 <a href="{$obj->getUrl($bw->input[0])}">{$obj->getTitle()} <span> [{$this->dateTimeFormat($obj->getPostDate())}]</span></a>
													</foreach>
													 </if>
											</div>
												
												
						</div>
				
				</div>
		
		
EOF;
	}

	function showMore($option = array()) {
		global $bw;
		$BWHTML .= <<<EOF
		
EOF;
	}

}
?>