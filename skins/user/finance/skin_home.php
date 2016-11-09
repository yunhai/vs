<?php
class skin_home {
	
	function showDefault($option) {
		global $bw, $vsTemplate, $vsPrint,$vsLang,$vsSettings;
               
                $BWHTML .= <<<EOF
<style>
	body{
		position:relative;
		background:#d2d2d2 url({$bw->vars[img_url]}/home_bg.jpg) repeat-x;	
		padding-top:4px;
		overflow-x:hidden;
	}
</style>                
  <a href="{$bw->base_url}" class="home_logo">
  	<object  width="190px" height="92px" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
    <param value="{$bw->vars[img_url]}/flash_logo(190x92).swf" name="movie">
    <param value="high" name="quality">
    <param value="samedomain" name="allowscriptaccess">
    <param name="wmode" value="transparent" />
    <embed wmode="transparent" width="190" height="92" allowscriptaccess="samedomain" quality="high"  src="{$bw->vars[img_url]}/flash_logo(190x92).swf"  pluginspage="http://www.adobe.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash">
    		</object>
  </a>
<ul id="slide_home">
	<li><img src="{$bw->vars[img_url]}/slide2.jpg"></li>
    <li><img src="{$bw->vars[img_url]}/slide1.jpg"></li>
</ul>
<div id="content_home">
	<div class="menu_home">
    	{$vsTemplate->global_template->menu_bottom}
    </div>
    <div id="footer_home">
    	<div class="tienich">
            <a target="_blank" href="{$vsSettings->getSystemKey('dang_twis','twis', "config", 1, 1)}" class="twis" title="twister"><img src="{$bw->vars['img_url']}/icon7.png" /></a>
            <a target="_blank" href="{$vsSettings->getSystemKey('dang_facebook','facebook', "config", 1, 1)}" title="facebook"><img src="{$bw->vars['img_url']}/icon6.png" /></a>
            <a target="_blank" href="{$vsSettings->getSystemKey('dang_feedback','feedback', "config", 1, 1)}" class="feedback">Feedback</a>
            <if="$vsTemplate->global_template->supports">
            <div class="support_onl">
                <foreach="$vsTemplate->global_template->supports as $sp">
                    {$sp->show()}
                </foreach>    
            </div>
            </if>
            <div class="clear_right"></div>
        </div>
        <div class="footer_home_center">
        	<p class="banquyen">{$vsTemplate->global_template->footer->getIntro(1000)}</p>
            <p class="vietsol"> 
            <a href='http://www.vietsol.net/' target='_blank' style="color:#666" title='{$vsLang->getWordsGlobal("global_tkwcn","Thiết kế web chuyên nghiệp")}'>{$vsLang->getWordsGlobal("global_tkweb","Thiết kế website")}</a>{$vsLang->getWordsGlobal("global_tkwebby"," bởi ")}
        <a href='http://www.vietsol.net/gioi-thieu-cong-ty-thiet-ke-web/' style="color:#767676" target='_blank' title='{$vsLang->getWordsGlobal("global_tkweb_company","Công ty thiết kế web")}'  >Viet Solution</a>
                
        	</p>
            {$vsTemplate->global_template->weblink}
            <p class="truycap"> {$vsLang->getWordsGlobal("global_Online","Đang truy cập")}: <strong>{$vsTemplate->global_template->state['today']}</strong>
                        /{$vsLang->getWordsGlobal("global_Vistor","Tổng truy cập")}: <strong>{$vsTemplate->global_template->state['visits']}</strong></p>
            <div class="clear"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
		var mar_left;
		mar_left=((screen.width) /2 - ($('.home_logo').width()/2));
		$('.home_logo').css('left',mar_left);
		
		$('#slide_home').innerfade({
			animationtype: 'fade',
			speed:2000,
			timeout:5000,
			type: 'sequence',
			containerheight: '395px'
		});
    });

</script>    
   
EOF;
return $BWHTML;

	}
     
}
?>