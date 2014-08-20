<?php
class tinyMCE {
	private $value = "";
	private $width = 100;
	private $height = 40;
	private $skin = "o2k7";
	private $InstanceName = "";
	private $url = "";
	private $theme = "";
	private $toolbarSet = "";
	public $fontPath='./styles/fonts/';
	
	/**
	 * @return unknown
	 */
	public function getHeight() {
		return $this->height;
	}
	
	/**
	 * @return unknown
	 */
	public function getInstanceName() {
		return $this->InstanceName;
	}
	
	/**
	 * @return unknown
	 */
	public function getSimple() {
		return $this->simple;
	}
	
	/**
	 * @return unknown
	 */
	public function getSkin() {
		return $this->skin;
	}
	
	/**
	 * @return unknown
	 */
	public function getTheme() {
		return $this->theme;
	}
	
	/**
	 * @return unknown
	 */
	public function getUrl() {
		return $this->url;
	}
	
	/**
	 * @return unknown
	 */
	public function getValue() {
		return $this->value;
	}
	
	/**
	 * @return unknown
	 */
	public function getWidth() {
		return $this->width;
	}
	
	/**
	 * @param unknown_type $height
	 */
	public function setHeight($height) {
		$this->height = $height;
	}
	
	/**
	 * @param unknown_type $InstanceName
	 */
	public function setInstanceName($InstanceName) {
		$this->InstanceName = $InstanceName;
	}
	
	/**
	 * @param unknown_type $simple
	 */
	public function setSimple($simple) {
		$this->simple = $simple;
	}
	
	/**
	 * @param unknown_type $skin
	 */
	public function setSkin($skin) {
		$this->skin = $skin;
	}
	
	/**
	 * @param unknown_type $theme
	 */
	public function setTheme($theme) {
		$this->theme = $theme;
	}
	
	/**
	 * @param unknown_type $url
	 */
	public function setUrl($url) {
		$this->url = $url;
	}
	
	/**
	 * @param unknown_type $value
	 */
	public function setValue($value) {
		$this->value = $value;
	}
	
	/**
	 * @param unknown_type $width
	 */
	public function setWidth($width) {
		$this->width = $width;
	}
	
	function setToolbar($toolbarSet = "") {
		switch ($toolbarSet) {
			case 'full' :
				$this->toolbarSet = <<<EOF
				theme_advanced_buttons1 : "fullscreen,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,vsindent,vsoutdent,vsresetindent,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,|,sub,sup,|,charmap,emotions,template,|,insertimage,|,media",
EOF;
				break;
			
			case 'medium' :
				$this->toolbarSet = <<<EOF
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,cut,copy,paste,pastetext,pasteword,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,|,vsindent,vsoutdent,vsresetindent,|,undo,redo",
				theme_advanced_buttons2 : "link,unlink,image,insertimage, cleanup,code,forecolor,backcolor,fontsizeselect",
				theme_advanced_buttons3 : '',
EOF;
				break;
			
			case 'simple' :
				$this->toolbarSet = <<<EOF
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,pasteword,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,|,outdent,indent,blockquote,|undo,redo,|,link,unlink,anchor,forecolor,backcolor,|,code",
				theme_advanced_buttons2 : '',
EOF;
			break;
			case 'basic' :
				$this->toolbarSet = <<<EOF
				theme_advanced_buttons1 : "bold,italic,underline|,justifyleft,justifycenter,justifyright,justifyfull",
				theme_advanced_buttons2 : '',
EOF;
			break;
			case 'narrow' :
				$this->toolbarSet = <<<EOF
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : ",|,hr,removeformat,|,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,forecolor,backcolor,|,code,image",
				theme_advanced_buttons3 : "",
EOF;
//,insertimage,tgthvideo,tgthalbum
				break;
			
			default :
				$this->toolbarSet = <<<EOF
				theme_advanced_buttons1 : "fullscreen,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,vsindent,vsoutdent,vsresetindent,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,|,sub,sup,|,charmap,emotions,template,|,insertimage",
EOF;
				break;
		}
	}
	
	function createHtml() {
		global $bw;
	
		$time = rand(0, time());
		
		$path = JAVASCRIPT_PATH."tiny_mce/tiny_mce.js";
		
		preg_match("^\[(.*?)\]^",$this->InstanceName,$fields);
		
		$BWHTML .= <<<EOF
		<script>
		
		$().ready(function() {
			setTimeout("tinyMCE.execCommand('mceAddControl', false, addVSEditor_$time());", 1);
		});
		
		function addVSEditor_{$time}(){
		$('textarea#vs_{$fields[1]}').tinymce({
			// Location of TinyMCE script
			script_url : '$path',
			content_css : "{$bw->vars['board_url']}/styles/fonts",
				theme : "{$this->theme}",
				skin	:	"{$this->skin}",
				/* Khai bao duong dan chay file*/
				relative_urls:false,
				remove_script_host: false,
                  force_p_newlines : true,
				  force_br_newlines : false,
				  forced_root_block : 'p',
				  convert_newlines_to_brs: false,
			
			plugins : "vsindent,tgthalbum,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist,imagemanager",

				// Theme options
				{$this->toolbarSet}
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				align:"left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,
				extended_valid_elements : "iframe[name|src|id|class|frameborder|title|allowfullscreen|videoId|width|height],a[name|href|target|title|onclick],img[class|style|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style],br[*]",
				// Replace values for the template plugin
				theme_advanced_fonts : "Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats,{$this->getFont()}",
				template_replace_values : {
					username : "tongnguyen",
					staffid : "1234567"
				}
		});
	}
		
    
	
		</script>
		<textarea id="vs_{$fields[1]}" name="{$this->InstanceName}" class="{$this->InstanceName}" rows="4" cols="50" style="height:{$this->height}; width:{$this->width};">{$this->value}</textarea>
EOF;
		
		return $BWHTML;
		
		
	}
	function getFont(){
			$fonts=$this->findFont($this->fontPath);
			$result=array();
			foreach ($fonts as  $f){
				$info=pathinfo(strtolower($f));
				
				$result[$info['filename']]=	$info['filename']."=".basename($info['filename']);
			}
			ksort($result);
			$return= implode(",", $result);
			return $return;
		}
	function findFont($direct='./styles/fonts/'){
		$files = array();
			if ($dir = opendir($direct)) {
				
				while (false !== ($file = readdir($dir))) {
					if ($file != "." && $file != ".."&&$file!='.svn'&&$file!='index.php'&&$file!='exe') {
						if(is_dir($file)){
							//$images=array_merge($images,$this->find($file,$pattern,$file."/"));
						}else{
							//if(preg_match($pattern,$file)){
								$files[] = $file;
							//}
						}
					}
				}
				closedir($dir);
			}
	    return $files;
	}
}
?>