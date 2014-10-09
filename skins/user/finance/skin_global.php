<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY INVISION POWER BOARD           */
/* CACHE FILE: Skin set id: 2                     */
/* CACHE FILE: Generated: Wed, 28 Jul 2004 10:38:07 GMT */
/* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE   */
/* WRITTEN TO THE DATABASE AUTOMATICALLY            */
/*--------------------------------------------------*/

class skin_global extends skin_board_public{
	//===========================================================================
	// vs_global
	//===========================================================================
	// {$this->SITE_MAIN_CONTENT}
	//
	function vs_global(){
		global $bw, $vsLang;
		$year = date('Y');
		
		$BWHTML .= <<<EOF
		
		<div class="navbar navbar-default navbar-static-top" role="navigation">
		
		<div class="container">
		  <div class='main-body-nav'>
              <div class="col-md-12 no-padding">
                <div class="navbar-collapse collapse">
                  <ul class="nav navbar-nav">
                    <li>
                        <a href="javascript:;" style='text-indent: 5px;'>
                            <span class="glyphicon glyphicon-earphone"></span>&nbsp;Hotline:&nbsp;
                            <span class='hotline'>{$this->getSettings()->getSystemKey('configs_hotline', '0937256242', 'configs')}</span>
                        </a>
                    </li>
                    <li class="dropdown">
                      <a href="#" data-placement="bottom" class='popover-container'
                        data-toggle="popover" 
                        data-html="true" 
                        data-content="{$this->getAddon()->getSupports($option)}">
                          {$this->getLang()->getWords('global_support_online_title', 'Hỗ trợ trực tuyến')}
                      </a>
                    </li>
                  </ul>
                  <script>
                      $('.popover-container').popover()
                  </script>
                  
                  {$this->getAddon()->getMenuTop($option)}
                </div><!--/.nav-collapse -->
              </div>
          </div>
        </div>	
		</div>
		
		<div class="container">
		  <div class='main-body'>
            {$this->getAddon()->getHeader()}
            
            {$this->SITE_MAIN_CONTENT}
            <div class='clear'></div>
          </div>  
        </div>
        <div class="footer shadow">
          <div class="container">
            <div class='main-body-footer'>
                <p class="text-muted copyright">Copyright @ {$year} by {$this->getSettings()->getSystemKey('global_websitename', 'All nail', 'global')}. All Right Reserved.</p>
                <p class="text-muted">{$this->getSettings()->getSystemKey('global_company_address', 'A75/6F/14 Bạch Đằng, Phường 2, Quận Tân Bình, TP.HCM', 'global')}.</p>
                <p class="text-muted">
                    {$this->getLang()->getWords('global_phone_title', 'Phone')}: 
                    {$this->getSettings()->getSystemKey('global_company_phone', '0123456789', 'global')}
                    &nbsp;-&nbsp;
                    {$this->getLang()->getWords('global_email_title', 'Email')}: 
                    {$this->getSettings()->getSystemKey('global_systememail', 'info@vietsol.net', 'global')}
                </p>
            </div>
          </div>
        </div>
EOF;
	return $BWHTML;
	}
	
	
	function addCSS($cssUrl="", $media = "") {
		$media = $media?"media='$media'":'';
		$BWHTML .= <<<EOF
<link type="text/css" rel="stylesheet" href="{$cssUrl}.css"  $media/>
EOF;
		//--endhtml--//
		return $BWHTML;
	}
	
	function importantAjaxCallBack(){
		global $bw,$vsLang;
		$BWHTML .= <<<EOF
EOF;
		return $BWHTML;
	}

	function addJavaScriptFile($file="",$type='file') {
		global $bw;
		$BWHTML .= <<<EOF
    <if="$type=='cur_file'">
		<script type="text/javascript" src='{$bw->vars['cur_scripts']}/{$file}.js'></script>
		<else />
		<if="$type=='external'">
			<script type="text/javascript" src='{$file}'></script>
			<else />
			<if="$type=='file'">
				<script type="text/javascript" src='{$bw->vars['board_url']}/javascripts/{$file}.js'></script>
			</if>
		</if>
	</if>
	
EOF;
		return $BWHTML;
	}

	function addJavaScript($script="") {
		$BWHTML = "";
		$BWHTML .= <<<EOF
<script language="javascript" type="text/javascript">
		{$script}
</script>
EOF;
		return $BWHTML;
	}

	function addDropDownScript($id="") {
		$BWHTML = "";
		//--starthtml--//

		$BWHTML .= <<<EOF
ddsmoothmenu.init({
	mainmenuid: "{$id}", //Menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menus outer DIV
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup", //"markup" or ["container_id", "path_to_menu_file"]
})
EOF;

		//--endhtml--//
		return $BWHTML;
	}

	function PermissionDenied($error="") {
		$BWHTML .= <<<EOF
<div class="red">
		{$error}</div>
EOF;
		return $BWHTML;
	}

	function displayFatalError($message="",$line="",$file="", $trace="") {
		$BWHTML .= <<<EOF
<div class="vs-common">
	<div class="red" align="left" style="padding: 20px">
		Error: {$message}<br />
		Line: {$line}<br />
		File: {$file}<br />
		Trace: <pre>{$trace}</pre><br />
	</div>
</div>
EOF;
		return $BWHTML;
	}
	function global_main_title() {
		global $bw, $vsPrint;
		$BWHTML = "";
		//--starthtml--//
		$BWHTML .= <<<EOF
	<span class="{$bw->input['module']}">{$vsPrint->mainTitle}</span>
EOF;

		//--endhtml--//
		return $BWHTML;
	}
	
	//===========================================================================
	// pop_up_window
	//===========================================================================
	function pop_up_window($title="",$css="",$text="") {
		$IPBHTML = "";
		//--starthtml--//


		$IPBHTML .= <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xml:lang="en" lang="en" xmlns="http://www.w3.org/1999/xhtml"> 
 <head> 
  <meta http-equiv="content-type" content="text/html; utf-8" /> 
  <title>$title</title>
  $css
 </head>
 <body>
 <div style='text-align:left'>
 $text
 </div>
 </body>
</html>
EOF;

 //--endhtml--//
 return $IPBHTML;
	}

	//===========================================================================
	// Redirect
	//===========================================================================
	function Redirect($Text="",$Url="",$css="") {
		global $bw;
		
		$BWHTML = "";
		$BWHTML .= <<<EOF
            <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html40/loose.dtd">
            <html>
            	<head>
            	<title>Redirecting...</title>
            	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            	<meta http-equiv='refresh' content='3; url=$Url' />
            	$css
            	</head>
              	<body >
            		<center>
            		<table cellpadding="0" cellspacing="0" width="100%" height="100%"> 
            			<tr>
            				<td width="416px" align="center" valign="middle">
            					<p class="text">{$Text}</p>
            				    <a href='$Url' title="{$Url}" class="title">( Click here if you do not wish to wait )</a>
            				 </td>
            			</tr>  
            		</table> 
            		</center>
            	</body>
            </html>
EOF;
	return $BWHTML;
	}

}

?>