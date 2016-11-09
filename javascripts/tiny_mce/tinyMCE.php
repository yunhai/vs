<?php
class  tinyMCE{
	private $value = "";
	private $width = 100;
	private $height = 40;
	private $skin  = "o2k7";
	private $url = "";
	private $theme = "";
	private $toolbarSet = "";

	
	function setToolbar($toolbarSet="") {
		switch ($toolbarSet) {
			case 'full':
				$this->toolbarSet = <<<EOF
				theme_advanced_buttons1 : "fullscreen,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,|,sub,sup,|,charmap,emotions,template,|,insertimage",
EOF;
				break;

			case 'medium':
				$this->toolbarSet = <<<EOF
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,cut,copy,paste,pastetext,pasteword,|,justifyleft,justifycenter,justifyright,justifyfull,|bullist,numlist,|,outdent,indent,|,undo,redo",
				theme_advanced_buttons2 : "link,unlink,image,insertimage, cleanup,code,forecolor,backcolor,fontsizeselect",
				theme_advanced_buttons3 : '',
EOF;
				break;

			case 'simple':
				$this->toolbarSet = <<<EOF
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,pasteword,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,forecolor,backcolor,|,code",
				theme_advanced_buttons2 : '',
EOF;
				break;
				
			case 'message':
				$this->toolbarSet = <<<EOF
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,pasteword,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,|,emotions,charmap",
				theme_advanced_buttons2 : '',
EOF;
				break;
				
			case 'narrow':
				$this->toolbarSet = <<<EOF
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,pasteword,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect",
				theme_advanced_buttons2 : ",outdent,indent,blockquote,|undo,redo,|,link,unlink,anchor,forecolor,backcolor,|,code",
				theme_advanced_buttons2 : '',
EOF;
				break;

			default:
				$this->toolbarSet = <<<EOF
				theme_advanced_buttons1 : "fullscreen,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,|,sub,sup,|,charmap,emotions,template,|,insertimage",
EOF;
				break;
		}
	}

	function createHtml(){
		$BWHTML .= <<<EOF
		<script language="javascript" type="text/javascript">
			tinyMCE.init({
				mode : "textareas",
				theme : "{$this->theme}",
				skin	:	"{$this->skin}",
				entity_encoding : "raw",
				editor_selector : "{$this->InstanceName}",
				/* Khai bao duong dan chay file*/
				relative_urls:false,
				remove_script_host: true,
				document_base_url:"{$this->url}",
				
				plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist,imagemanager,tabfocus",

				// Theme options
				{$this->toolbarSet}
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				align:"left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,
				extended_valid_elements : "a[name|href|target|title|onclick],img[class|style|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
				// Replace values for the template plugin
				template_replace_values : {
				username : "vietsol",
				staffid : "123456",
				
				tab_focus : ':prev,:next'
				}
			});
		</script>
		<textarea id="{$this->InstanceName}" name="{$this->InstanceName}" class="{$this->InstanceName}" rows="4" cols="50" style="height:{$this->height}; width:{$this->width};">{$this->value}</textarea>
EOF;
		return $BWHTML;
	}

	
	
	
	
	
	
	function getHeight() {
		return $this->height;
	}

	function getInstanceName() {
		return $this->InstanceName;
	}

	function getSimple() {
		return $this->simple;
	}

	function getSkin() {
		return $this->skin;
	}

	function getTheme() {
		return $this->theme;
	}

	function getUrl() {
		return $this->url;
	}

	function getValue() {
		return $this->value;
	}

	function getWidth() {
		return $this->width;
	}

	function setHeight($height) {
		$this->height = $height;
	}

	function setInstanceName($InstanceName) {
		$this->InstanceName = $InstanceName;
	}

	function setSimple($simple) {
		$this->simple = $simple;
	}

	function setSkin($skin) {
		$this->skin = $skin;
	}

	function setTheme($theme) {
		$this->theme = $theme;
	}

	function setUrl($url) {
		$this->url = $url;
	}

	function setValue($value) {
		$this->value = $value;
	}

	function setWidth($width) {
		$this->width = $width;
	}
}
?>