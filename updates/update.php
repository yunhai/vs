<?php
$rootpath="../";
if(!is_dir("./tmp/")){
	echo "tmp folder not found!";
	exit;
}
sendHeader();
ini_set('max_execution_time', 1000);
		ini_set('max_input_time', 1000);
error_reporting ( E_ERROR | E_WARNING | E_PARSE );


//error_reporting(1);
set_magic_quotes_runtime ( 0 );
$oldversion=parse_ini_file("./log.ini",true);
$newversion=parse_ini_file("./tmp/config.ini",true);
if($newversion['update']){
foreach ($newversion['update'] as $name=> $version) {
	if(version_compare($version, $oldversion['update'][$name])>0
		&&!noupdate($name)){
		copyFile("./tmp/".$name,$rootpath.$name);
		$oldversion['update'][$name]=$version;
		//out result
		sendOutPut("<p style='color:#000;margin:0;'>$name</p>");
	}
	if(noupdate($name)){
		sendOutPut("<p style='color:#ff0000;margin:0;'>$name no update</p>");
	}
	@unlink("./tmp/".$name);
}
}
$somecontent="";
if(is_array($oldversion)){
	foreach ($oldversion as $index => $value) {
		$somecontent.="[$index]\n";
		if(is_array($value)){
			foreach ($value as $index => $value) {
				$somecontent.="$index=$value\n";
			}
		}
			
	}
}
//write file
$filename = './log.ini';
//$somecontent = "Add this to the file\n";

// Let's make sure the file exists and is writable first.
if (is_writable($filename)) {
    if (!$handle = fopen($filename, 'w')) {
         echo "Cannot open file ($filename)";
         exit;
    }

    // Write $somecontent to our opened file.
    if (fwrite($handle, $somecontent) === FALSE) {
        echo "Cannot write to file ($filename)";
        exit;
    }

	fclose($handle);
	 echo "<br/>Update successlly!";
        exit;
}
function noupdate($filename){
	global $oldversion;
	$flag=true;
	if(!$oldversion['noupdate']) return false;
	foreach ($oldversion['noupdate'] as $index => $value) {
		if(strpos($filename, $index)===0){
			return true;
		}
	}
}
function copyFile($from,$to){
	$info=pathinfo($to);
	//sendOutPut("Update file {$to} <br>");
//	echo "<pre>";
//	print_r($info['dirname']);
//	echo "<pre>";
//	exit;
	if(!is_dir($info['dirname'])){
		mkdir($info['dirname'],true);
	}
//	echo "$from to $to <br>";
	if(file_exists($from)){
		copy($from, $to);
	}
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
function sendOutPut($html){
		echo $html;
	if (ob_get_level () == 0)
	 ob_start ();
	        echo str_pad('',4096);  
	 ob_flush ();
	 flush (); // needed ob_flush 
	 usleep ( 15000 );
	
	
	
}