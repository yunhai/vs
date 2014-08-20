<?php
$mirror="http://vssvn.vietsol.net/vsf50/updates/udpate.5.0.zip";
$delay=500000;
// PHP Configuration
error_reporting ( E_ERROR | E_WARNING | E_PARSE );
//error_reporting(1);
set_magic_quotes_runtime ( 0 );
/* Tutorial by AwesomePHP.com -> www.AwesomePHP.com */
/* Function: download remote file */
/* Parameters: $url -> to download | $dir -> where to store file |
    $file_name -> store file as this name - if null, use default*/

sendHeader();
if(!isset($_REQUEST['btn_submit'])){
	sendConfirm();
	exit;
}
if(!checksystem()){
	exit;
}
$return=downloadRemoteFile($mirror,"./","update.5.0.zip");
#$return=downloadRemoteFile("http://www.vsf.ipd/updates/get_install_package","./","install.zip");
if(file_exists( $return)){
	if(!is_dir("./tmp/")){
		mkdir("./tmp/");
	}
	extractZip($return,"./tmp/");
}else{
	//sendOutPut("Can't open file $return");
	exit;
}
@unlink($return);
#rename("setup.php","setup_".time().".php");
sendOutPut("
<script>
window.location='update.php';
</script>
",true);



function downloadRemoteFile($url,$dir,$file_name = NULL){
    if($file_name == NULL){ $file_name = basename($url);}
    $url_stuff = parse_url($url);
    $port = isset($url_stuff['port']) ? $url_stuff['port'] : 80;
	sendOutPut("Resolving............<br/>");
    $fp = @fopen($url, "r");
    if(!$fp){ 
    	sendOutPut("Not download mirror package!<br>");
    	exit;
		return false;
    }
    $info=stream_get_meta_data($fp);
	foreach ($info['wrapper_data'] as $value) {
		if(strpos($value,"Content-Length")!==FALSE ){
			$size=explode(":",$value);
			$size=$size[1];
			$size=intval($size);
		}
	}
	ini_set('max_execution_time', 1000);
		ini_set('max_input_time', 1000);
	$cout=0;
	$lengbuff=16384;
	sendOutPut("<br><center>Download package:</center> 
	<div style=\"margin:auto;width:1000px;height:20px;background:#B2DFEE;\">
<div id='tuyenbui_percent' style=\"color:#fff;text-align:center;height: 20px; float: left; background: #0004FF; width: 0%;\">
0%
</div>
</div>
	");
    while ($tmp = fread($fp, $lengbuff))   {
    	//sendOutPut(".");
//    	$cout+=s$lengbuff;
        $buffer .= $tmp;
        $cout++;
        if($cout%100==0&&$size>0){
        //sendOutPut("<br>Download: ".number_format((strlen($buffer)/$size)*100,2)."%");
        $per=number_format((strlen($buffer)/$size)*100,2);
        sendOutPut("
        	<script>
        	$('#tuyenbui_percent').css('width','$per%');
        	$('#tuyenbui_percent').html('$per%');
        	</script>
        	",true);
        }
        
    }
	sendOutPut("
        	<script>
        	$('#tuyenbui_percent').css('width','100%');
        	</script>
        	",true);
       
    preg_match('/Content-Length: ([0-9]+)/', $buffer, $parts);
    $file_binary = substr($buffer, - $parts[1]);
    if($file_name == NULL){
        $temp = explode(".",$url);
        $file_name = $temp[count($temp)-1];
    }
    $file_open = fopen($dir . "/" . $file_name,'w');
    if(!$file_open){ return false;}
    fwrite($file_open,$file_binary);
    fclose($file_open);
    return $file_name;
}  
function sendOutPut($html,$echo=false){
	global $delay;
	if($echo){
		echo $html;
	} else{
		$html=str_replace(array("\n","'","\t","\r"),array("\\n","\\'"),$html);
	echo <<<EOF
	<script>
	var _body = document.getElementsByTagName('body') [0];
var _div = document.createElement('div');
_body.innerHTML+='$html';
//_div.appendChild(_text);
//_body.appendChild(_div);
	</script>
EOF;
	}
	if (ob_get_level () == 0)
	 ob_start ();
	        echo str_pad('',4096);  
	 ob_flush ();
	 flush (); // needed ob_flush 
	 usleep ( $delay );
	
	
	
}
function sendHeader(){
	$output=<<<EOF
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">
<head>
<title>Install | Viet Solution</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="http://vstatic.net/jscripts/jquery.js"></script>
</head>
<body>

</body>
</html>
EOF;
	sendOutPut(
	$output,true
	
	);
}
function sendConfirm(){
	$path=realpath ("./");
	$path=str_replace("\\","\\\\",$path);
	$output=<<<EOF
<form method="POST">
<h1>Mọi dữ liệu ở thư mục $path có thể bị xóa, nhấn vào nút dưới đây để sẵn sàng tiến trình cài đặt</h1>
<br>
<input type="submit" name="btn_submit" value="Sẵn sàng"/>
</form>

EOF;
sendOutPut($output);
}
function checksystem(){
	$ok=true;
	if(!class_exists('ZipArchive')){
		sendOutPut('php_zip no install in apache!');
		$ok=false;
	}
	return $ok;
}
function extractZip($file,$toPath="./"){
	sendOutPut("Extract file $file ..........<br>");
	try{
		$zip = new ZipArchive();
		$code=$zip->open($file);
		if ($code===TRUE) {
	        @$zip->extractTo($toPath);
	    }else{
	    	throw  new Exception("Failed to Extract file");
	    }
	    $zip->close();
	}catch ( Exception $e ) {
		sendOutPut("{$e->getMessage()}!<br>");
		exit;
	}
                   

     
}