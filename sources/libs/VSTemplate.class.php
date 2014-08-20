<?php

class VSTemplate {
	
	
	# The basics
    var $root_path   = './';
    var $cache_dir   = '';
    var $cache_id    = '1';
    var $database_id = '1';
    var $rebuilcache = '0';
    var $cache_path  = '';
    var $arrayTemplate= array();
    var $skin_path  = '';
    var $extends  = '';
    var $foreach_blocks = array();
    var $allow_php_code = 1;
    /**
     * 
     * @var VSFTemplateEngine
     */
	var $engine=null;
	/**
	 * @return VSFTemplate
	 */
//	public function getEngine() {
//		if( $this->engine===NULL){
//			require_once UTILS_PATH . "TemplateEngine.class.php";
//			$this->engine=new VSFTemplateEngine();
//		}
//		return $this->engine;
//	}
	function __construct($tem_folder,$rebuild=1){
		
		$this->skin_path = $this->root_path . $tem_folder;
        $this->cache_path = $this->root_path."cache/".$tem_folder;
        if($rebuild){
        	$this->buildAllCache($this->skin_path,$this->cache_path);
        }
	}
	/**
	 * return a object skin object
	 */
	function load_template($class_name,$subfolder=""){
		if(class_exists($class_name)){
			return new $class_name();
			
		}else{
			$subfolder=rtrim($subfolder,"/")."/";
			if(file_exists($this->cache_path."/".$subfolder.$class_name.".php")){
				require $this->cache_path."/".$subfolder.$class_name.".php";
				return new $class_name();
			}else{
				 die($this->cache_path."/".$subfolder.$class_name.".php not exist!" );
			}
			
		
		}
	}
	function buildAllCache($foldersource,$folderdest){
		set_time_limit(-1);
        //ini_set("memory_limit","500024M");
		ini_set('max_execution_time', 30000);
		ini_set('session.gc_maxlifetime', 30000);
		ini_set('max_input_time', 30000);
		$folderdest=rtrim($folderdest,"/")."/";
		$logfile=CACHE_PATH."skins/".APPLICATION_TYPE."/log.php";
		if(!is_dir($folderdest)){
			mkdir($folderdest,0777,true);
		}
		if(file_exists($logfile)){
			require $logfile;
			
		}
		is_array($skinslog)?'':$skinslog=array();
		$write=false;
		$foldersource=rtrim($foldersource,"/")."/";
		$files = glob($foldersource . "/skin_*.php");
		foreach($files as $file)
		{
			$filename= basename($file) ;
			$modify=false;
			if(!file_exists($folderdest.$filename)){
				$modify=true;
			}else{
				if(filemtime ($foldersource.$filename)!=$skinslog['filemtime'][$foldersource.$filename]){//good for window
					//echo filemtime  ($foldersource.$filename).":".filemtime ($folderdest.$filename)."<br>";
//					echo 'filemtime<br>';
					//$skinslog['filemtime'][$foldersource.$filename]=filemtime ($foldersource.$filename);
					$write=true;
						$modify=true;
				}
				if(getlastmod ($foldersource.$filename)!=$skinslog['getlastmod'][$foldersource.$filename]){//good for window
//					echo 'getlastmod<br>';
//					echo getlastmod ($foldersource.$filename).":".$skinslog['getlastmod'][$foldersource.$filename]."<br>";
					
					//$skinslog['getlastmod'][$foldersource.$filename]=getlastmod ($foldersource.$filename);
					$write=true;
						$modify=true;
				}
				if(filectime ($foldersource.$filename)!=$skinslog['filectime'][$foldersource.$filename]){//good for window
//					echo 'filectime<br>';
					//$skinslog['filectime'][$foldersource.$filename]=filectime ($foldersource.$filename);
					$write=true;
					$modify=true;
				}
			}
			if($modify){
				$fp = fopen($folderdest.$filename, 'w');
				
				
				//$parse=$this->getEngine()->load_template(basename($file,".php"),file_get_contents($foldersource.$filename),$folderdest);
				global $bw;
				$apiserver=$bw->vars['api_server'].'ws/templates/50/index.php?wsdl';
				require_once(UTILS_PATH.'/nusoaps/nusoap.php');
				// Create the client instance
				$client = new nusoap_client($apiserver);
				$client->soap_defencoding="UTF-8";
				$client->decode_utf8=false;;
				// Call the SOAP method
				
				$result = $client->call('parseTemplate', 
					array(
					'sourcepath' => basename($file,".php"),
					'template' => file_get_contents($foldersource.$filename),
					'destpath' => $folderdest,
					)
				);
				
				$parse="<?php\n".$result."\n?>";
				fwrite($fp,$parse );
				fclose($fp);
				$changed[]=$filename;
				/**write to log fil*/
				$skinslog['filemtime'][$foldersource.$filename]=filemtime ($foldersource.$filename);
				$skinslog['getlastmod'][$foldersource.$filename]=getlastmod ($foldersource.$filename);
				$skinslog['filectime'][$foldersource.$filename]=filectime ($foldersource.$filename);
				$fp = fopen($logfile, 'w');
				$parse=var_export($skinslog,true);
				$parse="<?php\n\$skinslog=".$parse."\n?>";
				fwrite($fp,$parse );
				fclose($fp);
				
			}
		}
		/*
		if($write){
				$fp = fopen($logfile, 'w');
				$parse=var_export($skinslog,true);
				$parse="<?php\n\$skinslog=".$parse."\n?>";
				fwrite($fp,$parse );
				fclose($fp);
				
		}
		*/
		chmod($folderdest,750);
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return skin_global
	 */
	function getGlobal(){
		if(!is_object($this->global_skin)){
			$this->global_skin=$this->load_template("skin_global");
		}
		return $this->global_skin;
	}
}

?>