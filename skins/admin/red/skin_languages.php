<?php
class skin_languages {
function MainPage($list) {
global $bw, $vsLang;

$ele="";
$BWHTML = "";
//--starthtml--//
$BWHTML .= <<<EOF
<script type="text/javascript">
	function deleted(act,langid,value,id)
	{
		jConfirm('{$vsLang->getWords('lang_confirm','Confirm delete')} "'+value+'"?', 'Confirmation Dialog', function(r) {
					if(r)	
			vsf.get('Languages/'+act+'/'+langid+'/'+value,id);
		});
	}
</script>
<div id="page_tabs">
	<ul id="tabs_nav">
		{$vsLang->getActiveStart($bw->vars['language_hide_add_new_lang'])}
        <li><a href="{$bw->base_url}Languages/displayLangForm/&ajax=1"><span>{$vsLang->getWords('tab_news_lang','Form Language')}</span></a></li>
        {$vsLang->getActiveEnd($bw->vars['language_hide_add_new_lang'])}
        <foreach="$list as $ele">
         	<li><a href="{$bw->base_url}Languages/viewLangWith/{$ele->getId()}/&ajax=1"><span>{$ele->getName()}</span></a></li>
        </foreach>
    </ul>
</div>
EOF;
//--endhtml--//
return $BWHTML;	
}
function LanguagesMain($show) {
global $bw, $vsLang;
$BWHTML = "";
//--starthtml--//

$storein = $bw->vars['storelangtype']?"File":"Database";
$BWHTML = <<<EOF
<script type="text/javascript">
$(document).ready(function(){
	function deleted(act,langid,value,id)
	{			
		jConfirm('{$vsLang->getWords('lang_confirm','Confirm delete')} "'+value+'"?', 'Confirmation Dialog', function(r) {
    					if(r)	
							vsf.get('Languages/'+act+'/'+langid+'/'+value,id);
					});
	}
	});
</script>
<div class="ui-tabs ui-widget ui-widget-content ui-corner-all-top">
    <div id="langmodule" class="left-cell">
    	{$show['form']}
    	
        <div class="clear"></div>
    </div>
    <div id="langlist" class="right-cell">
    	{$show['list']}
        <div class="clear"></div>
	</div>
    <div class="clear"></div>
    <div class="ui-state-error ui-corner-all" style="padding:10px 5px;">
        <p align="left">
            <span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-alert"></span>
            <strong>Alert:</strong> The system language is currently stored in <strong>{$storein}</strong>. 
    So if you make any change it will be saved to <strong>{$storein}</strong>.
        </p>
    </div>
</div>
EOF;
//--endhtml--//

return $BWHTML;
}
/*********
 * {CURRENT_LANG_ADD_ITEM}
        {CURRENT_LANG_ITEM}
 */

//======================================================
// LANGUAGE Lang ZONE
//======================================================
function addEditLangForm($form) {
	global $vsLang, $bw;	
$BWHTML = "";
$langua = $form['language'];
$BWHTML .= <<<EOF
	<form id="LANGFORM" nam='LANGFORM'>
	<input type="hidden" name="FormType" value="{$form ['type']}" />
	<input type="hidden" name="langId" value="{$langua->getId()}" />
	<input type="hidden" name="oldFolder" value="{$langua->getFolderName()}" />
<div class="ui-dialog ui-widget ui-widget-content ui-corner-all">
	<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
    	<span class="ui-dialog-title">{$form ['title']}</span>
    </div>
	<div class="error">{$form ['message']}</div>
	<table class="ui-dialog-content ui-widget-content" cellpadding="0" cellspacing="0">
	<tr>
        <td>{$vsLang->getWords('lang_name','Language')}</td>
        <td><input type="text" id="langName" name="langName" value="{$langua->getName()}" size="32"></td>
	</tr>
	<tr>
        <td>{$vsLang->getWords('lang_folder','Folder')}</td>
        <td><input type="text" id="langFolder" name="langFolder" value="{$langua->getFolderName()}" size="32"></td>
	</tr>
	<tr>
        <td>{$vsLang->getWords('lang_Udefault','User Def')}</td>
        <td>
            <input class="checkbox" type="checkbox" name="userDefault" value="1" >
            <label for="langDefault_first">Yes</label>
           
        </td>
	</tr>
	<tr>
        <td>{$vsLang->getWords('lang_Adefault','Admin Def')}</td>
        <td>
            <input class="checkbox" type="checkbox"  name="adminDefault" value="1" />
            <label for="langType_first">Yes</label>
        </td>
	</tr>
	<tr>
        <td>{$vsLang->getWords('lang_active','Active')}</td>
        <td>
            <input class="checkbox" type="radio" name="langStatus" value="1" >
            <label for="langIsActive_first">Yes </label>
            <input class="checkbox" type="radio" name="langStatus" value="0" >
            <label for="langIsActive_last">No </label>
        </td>
	</tr>
    <tr>
    	<td>{$vsLang->getWords('lang_symbol',Symbol)}</td>
        <td class="ui-dialog-selectpanel">
	      	 <select size="5" multiple="multiple" id="langSymbol" name="langSymbol">
	      	 	<foreach="$form['flags'] as $flag">
					<option value="{$flag['value']}">{$flag['name']}</option>
				</foreach>
			</select>
        </td>
    </tr>
	<tr>
        <td align="left" style="padding-left:70px;" colspan="2" class="ui-dialog-buttonpanel">
	        {$form['switchform']}
	        <input type="submit" value="{$form['submit']}" /></td>
        </td>
	</tr>
	</table>
</div>
</form>
<script language="javascript">
	$(document).ready(function(){
	
		var the_LANGFORM	= window.document.getElementById('LANGFORM');
		vsf.checkbox('{$langua->getAdminDefault()}',the_LANGFORM.adminDefault);
		vsf.radio('{$langua->getStatus()}',the_LANGFORM.langStatus);
		vsf.checkbox('{$langua->getUserDefault()}',the_LANGFORM.userDefault);	
		vsf.select('{$langua->getSymbol()}',the_LANGFORM.langSymbol);
		
		});
	$('#LANGFORM').submit(function() {
		if(!$('#langName').val()) {
			jAlert('{$vsLang->getWords('err_lang_name_blank','Please enter the language name!')}','{$bw->vars['global_websitename']} Dialog');
			$('#langName').addClass('ui-state-error ui-corner-all-inner');
			$('#langName').focus();
			return false;
		}
		if(!$('#langFolder').val()) {
			jAlert('{$vsLang->getWords('err_lang_folder_blank','Please enter the folder name!')}','{$bw->vars['global_websitename']} Dialog');
			$('#langFolder').addClass('ui-state-error ui-corner-all-inner');
			$('#langFolder').focus();
			return false;
		}
		vsf.submitForm($(this),'Languages/addEditLang/','langlist');
		vsf.get('Languages/addLangForm/','langmodule');
});
</script>
EOF;
//--endhtml--//

return $BWHTML;
}
function getLangList($showval) {
	global $vsLang,$bw;

$show="";
$BWHTML = "";
//--starthtml--//

$BWHTML .= <<<EOF
<div class="ui-dialog ui-widget ui-widget-content ui-corner-all">
	<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
    	<span class="ui-dialog-title">{$vsLang->getWords('lang_list','Current Language Packs In Use')}</span>
    </div>
	<div class="error">{$showval['mess']}</div>
	<table cellspacing="0" cellpadding="0" class="ui-dialog-content ui-widget-content" style="width:100%;">
    	<thead>
        	<tr>
            	<th>{$vsLang->getWords('lang_id','ID')}</th>
                <th>{$vsLang->getWords('lang_symbol','Symbol')}</th>
                <th>{$vsLang->getWords('lang_name','Language')}</th>
                <th>{$vsLang->getWords('lang_active','Active')}</th>
                <th>{$vsLang->getWords('lang_folder','Folder name')}</th>
                <th>{$vsLang->getWords('lang_userdefault','Default User')}</th>
                <th>{$vsLang->getWords('lang_admindefault','Default Admin')}</th>
                <th>{$vsLang->getWords('lang_option','Option')}</th>
            </tr>
        </thead>
		<foreach="$showval['values'] as $show">			
			<tr class="{$show['format_class']}">
			    <td align="center">{$show['langId']}</td>
			    <td align="center"><img src="{$bw->vars['img_url']}/flags/{$show['langSymbol']}"></td>
			    <td align="center">{$show['langName']}</td>
			    <td align="center"><img src="{$bw->vars['img_url']}/{$show['imageactive']}.png" width="14" alt="{$show['imageactive']}" /></td>
			    <td align="center">{$show['langFolder']}</td>
			    <td align="center">{$show['userDefault']}</td>
			    <td align="center">{$show['adminDefault']}</td>
			    <td align="center">
			    	<a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:vsf.get('Languages/editLang/{$show['langId']}/','langmodule');" title='{$vsLang->getWords('newsItem_EditObjTitle',"Click here to edit this {$bw->input[0]}")}'>{$vsLang->getWords('global_edit','Sửa')}</a>
					<a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:deleted('deleteLang',{$show['langId']},'{$show['langName']}','langlist')" title='{$vsLang->getWords('newsItem_EditObjTitle',"Click here to delete this {$bw->input[0]}")}'>{$vsLang->getWords('global_del','Xóa')}</a>
			        {$show['defimg']}
			    </td>
		    </tr>
		    
		</foreach>
	</table>
</div>
EOF;
//--endhtml--//##
return $BWHTML;
}
/*****
 * <!-- BEGIN LANG_ITEM -->
	<tr class="{LANG_ITEM.format_class}">
	    <td align="center">{LANG_ITEM.langId}</td>
	    <td align="center"><img src="{$bw->vars['img_url']}/flags/{LANG_ITEM.langSymbol}"></td>
	    <td align="center">{LANG_ITEM.langName}</td>
	    <td align="center"><img src="{$bw->vars['img_url']}/{LANG_ITEM.imageactive}.png" width="14" alt="{LANG_ITEM.imageactive}" /></td>
	    <td align="center">{LANG_ITEM.langFolder}</td>
	    <td align="center">{LANG_ITEM.userDefault}</td>
	    <td align="center">{LANG_ITEM.adminDefault}</td>
	    <td align="center">
	        <a href="javascript: ;" onclick="javascript:vsf.get('Languages/editLang/{LANG_ITEM.langId}/','langmodule');" title=""><img src="{$bw->vars['img_url']}/edit.png" border="0" alt=""></a>
	        <a href="javascript: ;" onclick="javascript:deleted('deleteLang',{LANG_ITEM.langId},'{LANG_ITEM.langName}','langlist');" title=""><img src="{$bw->vars['img_url']}/b_drop.png" border="0" alt=""></a>
	        {LANG_ITEM.defimg}
	    </td>
	</tr>
	<!-- END LANG_ITEM -->
 * *******/
function wordList($showall) {
	global $bw,$vsLang;
	$BWHTML = "";
	//--starthtml--//
$BWHTML .= <<<EOF
<div class="ui-dialog ui-widget ui-widget-content ui-corner-all">
	<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
    	<span class="ui-dialog-title">{$vsLang->getWords('lang_module_add_text',' Add module′s language text')}</span>
    </div>
    <div class="red">{$showall['message']}</div>
    <form action="javascript:vsf.submitForm($('#add_item_{$bw->input[2]}'),'Languages/addMore','langlist_{$bw->input[2]}')" method="Post" id="add_item_{$bw->input[2]}">
    <input type="hidden" name="2" value="{$bw->input[2]}">
    <input type="hidden" name="langtype" value="{$bw->input[3]}">
    <table class="ui-dialog-content ui-widget-content" cellpadding="0" cellspacing="0" style="width:100%;">
    	<thead>
        	<tr>
            	<th>{$vsLang->getWords('lang_module_text_key','Language key')}</th>
                <th>{$vsLang->getWords('lang_module_text_value','Language value')}</th>
                <th></th>
            </tr>
        </thead>

		<tr>
        	<td ><input type="text" name="wkey" value=""></td>
			<td><textarea name="wdisplay" cols="55" rows="1"></textarea></td>
			<td class="ui-dialog-buttonpanel"><input class="button" type="submit" value="Add" name="submit"></td>
		</tr>
	</table>
	<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
    	<span class="ui-dialog-title">{$vsLang->getWords('lang_module_text','Current module′s language text')} : [{$showall['moduleName']}]</span>
    </div>
    </form>
    <form action="javascript:vsf.submitForm($('#frm_save_{$bw->input[2]}'),'Languages/saveLangItem','langlist_{$bw->input[2]}')" id='frm_save_{$bw->input[2]}' method="Post">
    <input type="hidden" name="2" value="{$bw->input[2]}">
    <input type="hidden" name="langtype" value="{$bw->input[3]}">
	<table class="ui-dialog-content ui-widget-content" cellpadding="0" cellspacing="0" style="width:100%;">
    	<thead>
        	<tr>
            	<th>{$vsLang->getWords('lang_module_text_key')}</th>
                <th>{$vsLang->getWords('lang_module_text_value')}</th>
                <th>{$vsLang->getWords('lang_option')}</th>
            </tr>
        </thead>
        
        <foreach="$showall['WORD_ITEM'] as $word">
		<tr>
			<td ><p style="width:150px;overflow:auto">{$word['key']}</p></td>
			<td><textarea name="key_{$word['key']}" cols="50" rows="1">{$word['value']}</textarea></td>
			<td>				
				<a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:deleted('deleteWord',{$bw->input[2]},'{$word['key']}','langlist_{$bw->input[2]}')" title='{$vsLang->getWords('newsItem_EditObjTitle',"Click here to delete this {$bw->input[0]}")}'>{$vsLang->getWords('global_del','Xóa')}</a>
			</td>
		</tr>
		</foreach>
		
        <tr>
        	<td colspan="2" class="ui-dialog-buttonpanel">
                <input class="button" type="Submit" name="Submit" value="Save" />
            </td>
        </tr>
		</form>
	</table>
</div>
EOF;

//--endhtml--//

return $BWHTML;
}

function addLangItemForm() {
global $bw,$vsLang ,$langtype;

$BWHTML = "";
//--starthtml--//

$BWHTML .= <<<EOF
<script type="text/javascript"> 
$('#addlangitem_{$bw->input[2]}').submit(function() {

	if(!$('#moduleName_{$bw->input[2]}').val()) {
		alert('{$vsLang->getWords('err_lang_name_blank','Please enter the module name!')}');
		$('#moduleName').addClass('ui-state-error ui-corner-all-inner');
		$('#moduleName').focus();
		return false;
	}
	vsf.submitForm($(this),'languages/addLangItem','lang_item_list_{$bw->input[2]}');
	vsf.get('languages/additemform/{$bw->input[2]}/','langitemform_{$bw->input[2]}');
});
</script>
<div id="langitemform_{$bw->input[2]}">
	<form id="addlangitem_{$bw->input[2]}">
		<input type="hidden" name="langId" value="{$bw->input[2]}">
		<input type="hidden" name="langtype" value="{$langtype}">
		<div class="ui-dialog ui-widget ui-widget-content ui-corner-all">
			<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
		    	<span class="ui-dialog-title">{$vsLang->getWords('lang_module_add',' Add module′s language file  ')}</span>
		    </div>
		    <table class="ui-dialog-content ui-widget-content" cellpadding="0" cellspacing="0">
		    	<tr>
		        	<td>{$vsLang->getWords('lang_module','Module')}</td>
		            <td><input type="text" id="moduleName_{$bw->input[2]}" name="moduleName" value=" "></td>
		        </tr>
		        <tr>
		        	<td class="ui-dialog-buttonpanel" colspan="2"><input class="button" type="submit" name="submit" value="Add"></td>
		        </tr>
		    </table>
		   </div>
	</form>
</div>
EOF;
//--endhtml--//

return $BWHTML;
}

function langItem($showall) {
	global $vsLang , $bw;

$BWHTML = "";
//--starthtml--//

$BWHTML .= <<<EOF
<div class="ui-dialog ui-widget ui-widget-content ui-corner-all" id="lang_item_list_{$bw->input[2]}">
<div class="red">{$showall['message']}</div>
<table class="ui-dialog-content ui-widget-content" cellpadding="0" cellspacing="0" style="width:100%;">
	<thead>
    	<tr>
        	<th>{$vsLang->getWords('lang_itemm_list','Language Item List')}</th>
            <th>{$vsLang->getWords('lang_option','Option')}</th>
        </tr>
    </thead>
    <if="count($showall['VAR_LANG_ITEM'])">
    <foreach="$showall['VAR_LANG_ITEM'] as $var">
		<tr class="{$var['format_class']}">
			<td><a href="javascript: ;" onclick="javascript:vsf.get('Languages/viewItem/{$bw->input[2]}/{$var['langType']}/{$var['langModule']}/','langlist_{$bw->input[2]}')" title="">{$var['langModule']}</a></td>
			<td>
				<a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:vsf.get('Languages/viewItem/{$bw->input[2]}/{$var['langType']}/{$var['langModule']}/','langlist_{$bw->input[2]}')" title='{$vsLang->getWords('newsItem_EditObjTitle',"Click here to edit this {$bw->input[0]}")}'>{$vsLang->getWords('global_edit','Sửa')}</a>
				<a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:deleted('deleteItem','{$bw->input[2]}/{$var['langType']}','{$var['langModule']}','MODULE_FILE_LIST_{$bw->input[2]}')" title='{$vsLang->getWords('newsItem_EditObjTitle',"Click here to delete this {$bw->input[0]}")}'>{$vsLang->getWords('global_del','Xóa')}</a>
			</td>
		</tr>
	</foreach>
	</if>
</table>
</div>
EOF;
//--endhtml--//

return $BWHTML;
}
//function FileLangMainAjax($show) {
//global $bw, $vsLang;
//$BWHTML = "";
////--starthtml--//
//
//$BWHTML = <<<EOF
//	<div  id="MODULE_FILE_FORM_{$bw->input[2]}">{$show['CURRENT_LANG_ADD_ITEM']}</div>
//    <div  id="MODULE_FILE_LIST_{$bw->input[2]}">{$show['CURRENT_LANG_ITEM']}</div>
//    <div class="clear"></div>
//EOF;
////--endhtml--//
//
//return $BWHTML;
//}

function FileLangMainAjax($show) {
	global $bw, $vsLang;
	$BWHTML = "";
$BWHTML = <<<EOF
	 {$vsLang->getActiveEnd($bw->vars['languages_hide_show_admin'])}

	<div id="sa_content_{$bw->input[2]}" class="uvn-contain ui-dialog">
	    <div id="langmodule_{$bw->input[2]}" class="left-cell">
	    	<div  id="MODULE_FILE_FORM_{$bw->input[2]}">{$show['CURRENT_LANG_ADD_ITEM']}</div>
	    <div  id="MODULE_FILE_LIST_{$bw->input[2]}">{$show['CURRENT_LANG_ITEM']}</div>
	    <div class="clear"></div>
	    </div>
	    <div id="langlist_{$bw->input[2]}" class="right-cell">
	    	{$show['LANGUAGE_LIST']}
	        <div class="clear"></div>
		</div>
	    <div class="clear"></div>
	    <div class="ui-state-error ui-corner-all" style="padding:10px 5px;">
	        <p align="left">
	            <span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-alert"></span>
	            <strong>Alert:</strong> The system language is currently stored in <strong>{$storein}</strong>. 
	    So if you make any change it will be saved to <strong>{$storein}</strong>.
	        </p>
	    </div>
	</div>	
EOF;
	return $BWHTML;
}




function FileLangMain($show) {
global $bw, $vsLang;
$BWHTML = "";
//--starthtml--//

$storein = $bw->vars['storelangtype']?"File":"Database";
$BWHTML = <<<EOF
  	{$vsLang->getActiveStart($bw->vars['Languages_hide_show_admin'])}
  	<div class="uvn-contain ui-dialog">
	    <div class='ui-dialog-buttonpanel' style="text-align:left">
	        <button class='normalWidth' onclick="javascript: vsf.get('Languages/viewLangModule/{$bw->input[2]}/user/','sa_content_{$bw->input[2]}'); return false">User</button>
			<button class='normalWidth' onclick="javascript: vsf.get('Languages/viewLangModule/{$bw->input[2]}/admin/','sa_content_{$bw->input[2]}'); return false">Admin</button>
	    </div>
	</div>
    {$vsLang->getActiveEnd($bw->vars['languages_hide_show_admin'])}

	<div id="sa_content_{$bw->input[2]}" class="uvn-contain ui-dialog">
	    <div id="langmodule_{$bw->input[2]}" class="left-cell">
	    	<div  id="MODULE_FILE_FORM_{$bw->input[2]}">{$show['CURRENT_LANG_ADD_ITEM']}</div>
	    <div  id="MODULE_FILE_LIST_{$bw->input[2]}">{$show['CURRENT_LANG_ITEM']}</div>
	    <div class="clear"></div>
	    </div>
	    <div id="langlist_{$bw->input[2]}" class="right-cell">
	    	{$show['LANGUAGE_LIST']}
	        <div class="clear"></div>
		</div>
	    <div class="clear"></div>
	    <div class="ui-state-error ui-corner-all" style="padding:10px 5px;">
	        <p align="left">
	            <span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-alert"></span>
	            <strong>Alert:</strong> The system language is currently stored in <strong>{$storein}</strong>. 
	    So if you make any change it will be saved to <strong>{$storein}</strong>.
	        </p>
	    </div>
	</div>		

EOF;
//--endhtml--//

return $BWHTML;
}






}
?>