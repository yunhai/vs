<?php

	 class amazon{
	 	function crawlData(){
		    $method = "GET";
		    $host = "ecs.amazonaws.".$this->region;
		    $uri = "/onca/xml";
		    // additional parameters
		    $this->params["Service"] = "AWSECommerceService";
		    $this->params["AWSAccessKeyId"] = $this->accessKey;
		    // GMT timestamp
		    $this->params["Timestamp"] = gmdate("Y-m-d\TH:i:s\Z");
		    // API version
		    $this->params["Version"] = "2009-03-31";
		    // sort the parameters
		    ksort($this->params);
		    
		    // create the canonicalized query
		    $canonicalized_query = array();
		    foreach ($this->params as $param=>$value){
		        $param = str_replace("%7E", "~", rawurlencode($param));
		        $value = str_replace("%7E", "~", rawurlencode($value));
		        $canonicalized_query[] = $param."=".$value;
		    }
		    $canonicalized_query = implode("&", $canonicalized_query);
		    
		    // create the string to sign
		    $string_to_sign = $method."\n".$host."\n".$uri."\n".$canonicalized_query;
		    
		    // calculate HMAC with SHA256 and base64-encoding
		    $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $this->secretKey, True));
		    
		    // encode the signature for the request
		    $signature = str_replace("%7E", "~", rawurlencode($signature));
		    
		    // create request
		    $request = "http://".$host.$uri."?".$canonicalized_query."&Signature=".$signature;
		    // do request
		    $response = file_get_contents($request);
		    if ($response === false) return false;
		    
//parse XML to Array		    
		    global $vsStd;
		    $vsStd->requireFile(UTILS_PATH.'class_xml.php');
		    $myXML = new class_xml();

			$myXML->xml_parse_document($response);
			
			return current($myXML->xml_array);
		}
		
		private $secretKey = "";
	 	private $accessKey = "";
	 	private $params = "";
	 	private $region = "";
	 	
	 	function __construct($accessKey, $secretKey, $params, $region="com"){
	 		$this->accessKey 	= $accessKey;
			$this->secretKey 	= $secretKey;
			$this->params		= $params;
			$this->region		= $region;
	 		
		}
		
		function __destruct(){	
			unset($this);
		}
}
?>