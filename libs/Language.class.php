<?php
class VSFLanguage {
	public $currentLang = array ();
	public $currentArea ="";
	public $defaultArrayWords = array ();
	public $currentArrayWords = array ();

	//initialize value for default Language
	function __construct() {
		global $vsStd;

		$vsStd->requireFile(CORE_PATH."languages/languages.php");
		$vsStd->requireFile(CORE_PATH."languages/Language.class.php");

		if (!isset($_SESSION [APPLICATION_TYPE]['language']['currentLang'])	|| !is_array($_SESSION [APPLICATION_TYPE]['language']['currentLang']))
		{
			//load lang default current
			$oLanguages = new languages();
			if(APPLICATION_TYPE=='admin')
			{
				$oLanguages->language->setAdminDefault(1);
				$language = $oLanguages->getLangByObject(array('getAdminDefault'),$oLanguages->arrayLang);
			}
			else {
				$oLanguages->language->setUserDefault(1);
				$language = $oLanguages->getLangByObject(array('getUserDefault'),$oLanguages->arrayLang);

			}
			reset($language);
			$this->currentLang = current($language);
			unset($_SESSION [APPLICATION_TYPE]);
			$_SESSION [APPLICATION_TYPE]['language']['currentLang'] = $this->currentLang->convertToView();
				
		}
		$oLang = new Lang();
		$oLang->convertToObject($_SESSION [APPLICATION_TYPE]['language']['currentLang']);
		$this->currentLang = $oLang;
		$pathFolder = $this->currentLang->getLangPath()."/".APPLICATION_TYPE.'/';
		if(!is_dir($pathFolder))
			mkdir($pathFolder, 0777, true);
		// load default array words
		$this->setCurrentArea('global');
			
	}
	//destroy  Language
	function __destruct() {
		unset ( $this->currentLang );
		unset ( $this->currentArea );
		unset ( $this->defaultArrayWords );
		unset ( $this->currentArrayWords );
	}

	function getWords($key='',$value='') {
		global $vsModule;

		if(isset($this->currentArrayWords[$key])) {
			return $this->currentArrayWords[$key];
		}

		$this->currentArrayWords[$key] = $value;
		$fileName = explode("_",$key);
		$pathFolder = $this->currentLang->getLangPath()."/".APPLICATION_TYPE.'/';
		// If the current area is not set, write the words by prefix of current class has been calling
		if(!$this->currentArea) {
			$pathFile = $pathFolder.$vsModule->obj->getClass().".lang";
			$this->currentArea = 'global';
		}
		else $pathFile = $pathFolder.$this->currentArea.".lang";

		// Even if the current area is set but prefix is global, then write to global.lang
		if($fileName[0]=='global') $pathFile = $pathFolder.'global.lang';

		if(!$this->currentArea) throw new Exception("Current language area is invalid!");

		require($pathFile);

		if(isset($lang[$key])) {
			return $lang[$key];
		}

		$lang[$key] = $value;
		if($lang[$key]!='')
		$this->writeLangToFile($lang,$pathFile);
		else $value="<span style='color:red'>No word for keyword [{$key}]</span>";

		return $value;
	}

	function getWordsGlobal($key='',$value='') {
		global $vsModule;

		if(isset($this->currentArrayWords[$key])) {
			return $this->currentArrayWords[$key];
		}

		$this->currentArrayWords[$key] = $value;
		$fileName = explode("_",$key);

		$pathFolder = $this->currentLang->getLangPath()."/".APPLICATION_TYPE.'/';


		// Even if the current area is set but prefix is global, then write to global.lang
		$pathFile = $pathFolder.'global.lang';

		if(!$this->currentArea) throw new Exception("Current language area is invalid!");

		require($pathFile);

		if(isset($lang[$key])) {
			return $lang[$key];
		}

		$lang[$key] = $value;
		if($lang[$key]!='')
		$this->writeLangToFile($lang,$pathFile);
		else $value="<span style='color:red'>No word for keyword [{$key}]</span>";

		return $value;
	}

	/**
	 * get $currentLang
	 * @return $currentLang
	 */
	function getCurrentLang() {
		$this->currentLang;
	}

	/**
	 * set language because $langId
	 * @param $langId int
	 * @return void
	 */
	function setCurrentLang($language) {
		$this->currentLang = $language;
		$_SESSION [APPLICATION_TYPE]['language']['currentLang'] = $this->currentLang->convertToDB();

		//load default array words
		$this->setCurrentArea('global');
		$this->defaultArrayWords = $this->currentArrayWords;
		$_SESSION [APPLICATION_TYPE]['language']['defaultArrayWords'] = $this->defaultArrayWords;
	}

	/**
	 * get current array Words
	 * @return array (array current value languges)
	 */
	public function getCurrentArrayWords() {
		return $this->currentArrayWords;
	}

	/**
	 * @param array $currentArrayWords
	 * @return void
	 */
	public function setCurrentArrayWords($currentArrayWords) {
		$this->currentArrayWords = $currentArrayWords;
	}

	/**
	 * get current area
	 * @return string ($currentArea)
	 */
	public function getCurrentArea() {
		return $this->currentArea;
	}

	/**
	 * get current area
	 * @param string $currentArea
	 * @return void
	 */
	public function setCurrentArea($currentArea) {
		$this->currentArea = $currentArea;
	
		$this->loadWords();
	}


	/**
	 * get current area
	 * @param string $currentArea
	 * @return void
	 */
	public function getActiveStart($param,$parent=0) {
		if(isset($param)and $param>0 and !$parent)
		return '<!-- ';
	}

	/**
	 * get array default words
	 * @return array (array default words)
	 */
	public function getActiveEnd($param,$parent=0) {
		if(isset($param)and $param>0 and !$parent)
		return '--> ';
	}

	/**
	 * get array default words
	 * @return array (array default words)
	 */
	public function getDefaultArrayWords() {
		return $this->defaultArrayWords;
	}

	/**
	 * set default array words
	 * @param array $defaultArrayWords
	 * @return void
	 */
	public function setDefaultArrayWords($defaultArrayWords) {
		$this->defaultArrayWords = $defaultArrayWords;
		$_SESSION [APPLICATION_TYPE]['language'] ['defaultWords'] = $this->currentLang;
	}
	/**
	 * write item lang to file
	 * @return void (array value languges)
	 */
	function writeLangToFile($lang,$pathLang)
	{
		$content = "<?php\n";
		$content .= "\$lang = ";
		$content .= var_export($lang,true);
		$content .= ";\n";
		$content .= "?>";

		if(file_exists($pathLang)) @chmod($pathLang,0775);

		if(!$wf = fopen ( $pathLang, "w" ))
		throw new Exception(sprintf($this->getWords('global_cannot_open_file',"We cannot open file <b>%s</b>. Please check the permission!"),$pathLang));

		if(!fwrite ( $wf, $content )) throw new Exception(sprintf($this->getWords('global_cannot_write_file',"We cannot write file <b>%s</b>. Please check the permission!"),$pathLang));

		fclose ( $wf );
		@chmod($pathLang,0644);
	}
	/**
	 * load value languges from database of file
	 * @return void (array value languges)
	 */
	function loadWords() {
		global $DB, $bw;

		$langarr=array();
		//this is same requrie $lang , we have variable $lang

		$thisLangPath = $this->currentLang->getLangPath()."/".APPLICATION_TYPE.'/'.$this->currentArea.".lang";


		if(!file_exists($thisLangPath))
		$this->writeLangToFile(array('pageTitle' => $this->currentArea, 'main_title'=>$this->currentArea),$thisLangPath);

		require_once ($thisLangPath);

		$langarr = $lang;

		if (is_array($langarr)) {
			$this->currentArrayWords = array_merge ( $this->currentArrayWords, $langarr );
			$this->currentArrayWords = str_replace ( array ("&gt;", "&lt;" ), array (">", "<" ), $this->currentArrayWords );
		}
		unset ( $tmplang );
		unset ( $langarr );
	}
}
?>