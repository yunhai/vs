<?php
if(!class_exists('skin_objectadmin'))
require_once ('./cache/skins/admin/red/skin_objectadmin.php');
class skin_factory extends skin_objectadmin {

//===========================================================================
// <vsf:objListHtml:desc::trigger:>
//===========================================================================
function objListHtml($objItems=array(),$option=array()) {global $bw, $vsLang, $vsSettings, $vsSetting, $tableName, $vsUser,$langObject;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="red">{$option['message']}</div>
<form id="obj-list-form">
<input type="hidden" name="checkedObj" id="checked-obj" value="" />
<input type="hidden" name="categoryId" value="{$option['categoryId']}" id="categoryId" />
<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
                            <div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
                            <span class="ui-icon ui-icon-note"></span>
                            <span class="ui-dialog-title">{$langObject['itemList']}</span>
                            </div>
                                
EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_add_hide_show_delete',1, $bw->input[0]) ) {
$BWHTML .= <<<EOF

                                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner ui-widget-header">
                                    <li class="ui-state-default ui-corner-top" id="add-objlist-bt"><a href="#" title="{$langObject['itemListAdd']}">{$langObject['itemListAdd']}</a></li>
                                    <li class="ui-state-default ui-corner-top" id="hide-objlist-bt"><a href="#" title="{$langObject['itemListHide']}">{$langObject['itemListHide']}</a></li>
                                    <li class="ui-state-default ui-corner-top" id="visible-objlist-bt"><a href="#" title="{$langObject['itemListVisible']}">{$langObject['itemListVisible']}</a></li>
                                    
EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_home',0, $bw->input[0]) ) {
$BWHTML .= <<<EOF

                                       <li class="ui-state-default ui-corner-top" id="home-objlist-bt"><a href="#" title="{$langObject['itemListHome']}">{$langObject['itemListHome']}</a></li>
                                    
EOF;
}

$BWHTML .= <<<EOF

                                    <li class="ui-state-default ui-corner-top" id="delete-objlist-bt"><a href="#" title="{$langObject['itemListDelete']}">{$langObject['itemListDelete']}</a></li>
                                    
EOF;
if($vsSettings->getSystemKey($bw->input[0].'_category_list',1, $bw->input[0])) {
$BWHTML .= <<<EOF

                                    <li class="ui-state-default ui-corner-top" id="change-objlist-bt"><a href="#" title="{$langObject['itemListChangeCate']}">{$langObject['itemListChangeCate']}</a></li>
                                    
EOF;
}

$BWHTML .= <<<EOF

                                    
EOF;
if($vsSettings->getSystemKey($bw->input[0].'_search_list',0, $bw->input[0])) {
$BWHTML .= <<<EOF

                                    <li class="ui-state-default ui-corner-top" id="insertSearch-objlist-bt"><a href="#" title="{$langObject['itemListInsertSearch']}">{$langObject['itemListInsertSearch']}</a></li>
                                    
EOF;
}

$BWHTML .= <<<EOF

                                </ul>
                                
EOF;
}

$BWHTML .= <<<EOF

<table cellspacing="1" cellpadding="1" id='objListHtmlTable' width="100%">
<thead>
    <tr>
        <th width="10"><input type="checkbox" onclick="vsf.checkAll()" onclicktext="vsf.checkAll()" name="all" /></th>
        <th width="60">{$langObject['itemListActive']}</th>
        <th>{$langObject['itemListTitle']}</td>
        <th width="30">{$langObject['itemListIndex']}</th>
        
EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_option', 0, $bw->input[0], 1, 1) ) {
$BWHTML .= <<<EOF

        <th width="80" align="center">{$langObject['itemListAction']}</th>
        
EOF;
}

$BWHTML .= <<<EOF

    </tr>
</thead>
<tbody>
{$this->__foreach_loop__id_4f84f2fc72dc4($objItems,$option)}
</tbody>
<tfoot>
<tr>
<th colspan='5'>
<div style='float:right;'>{$option['paging']}</div>
</th>
</tr>
                                                         <tr >
                                                      <th colspan='6' align="left">
                                                      <span style="padding-left: 10px;line-height:16px;"><img src="{$bw->vars['img_url']}/enable.png" /> {$langObject['itemListCurrentShow']}</span>
                                                      <span style="padding-left: 10px;line-height:16px;"><img src="{$bw->vars['img_url']}/disabled.png" /> {$langObject['itemListNotShow']}</span>
                                                       
EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_home',0, $bw->input[0]) ) {
$BWHTML .= <<<EOF

                                                            <span style="padding-left: 10px;line-height:16px;"><img src="{$bw->vars['img_url']}/home.png" /> {$langObject['itemListHomeShow']}</span>
                                                      
EOF;
}

$BWHTML .= <<<EOF

                                                      </th>
                                                </tr>
</tfoot>
</table>
</div>
</form>
<div class="clear" id="file"></div>
                        <div id='commentList'></div>
{$this->addJavaScript()}
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function 
//===========================================================================
function __foreach_loop__id_4f84f2fc72dc4($objItems=array(),$option=array())
{
global $bw, $vsLang, $vsSettings, $vsSetting, $tableName, $vsUser,$langObject;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    foreach( $objItems as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<tr class="$vsf_class">
<td align="center">
                                    
EOF;
if(!$vsSettings->getSystemKey($bw->input[0].'_code',0) && $obj->getCode()) {
$BWHTML .= <<<EOF

                                        <img src="{$bw->vars['img_url']}/disabled.png" />
                                      
EOF;
}

else {
$BWHTML .= <<<EOF

<input type="checkbox" onclicktext="vsf.checkObject();" onclick="vsf.checkObject();" name="obj_{$obj->getId()}" value="{$obj->getId()}" class="myCheckbox" />
                                     
EOF;
}
$BWHTML .= <<<EOF

</td>
<td style='text-align:center'>{$obj->getStatus('image')}
</td>
<td>
<a href="javascript:vsf.get('{$bw->input[0]}/add-edit-obj-form/{$obj->getId()}/&pageIndex={$bw->input[3]}&pageCate={$bw->input[2]}','obj-panel')"  class="editObj" >
{$obj->getTitle()}
</a>
</td>
<td>{$obj->getIndex()}</td>

EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_option', 0,$bw->input[0], 1, 1) ) {
$BWHTML .= <<<EOF

<td>
{$this->addOtionList($obj,$option['modulecomment'])}
</td>

EOF;
}

$BWHTML .= <<<EOF

</tr>

EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:addOtionList:desc::trigger:>
//===========================================================================
function addOtionList($obj="",$option="") {            global $vsLang, $bw,$vsSettings,$tableName;
          
            
//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if($vsSettings->getSystemKey($bw->input[0].'_multi_file',0, $bw->input[0], 1, 1)) {
$BWHTML .= <<<EOF

                
EOF;
if($obj->getCode()) {
$BWHTML .= <<<EOF

                    <a class="ui-state-default ui-corner-all ui-state-focus" href="javascript:;" onclick="vsf.popupGet('gallerys/display-album-tab/{$bw->input[0]}/{$obj->getId()}&albumCode=factory_image','albumn')">
                            {$vsLang->getWords('global_album','Album')}
                    </a>
                    
EOF;
}

$BWHTML .= <<<EOF

                
EOF;
}

$BWHTML .= <<<EOF

                
                
EOF;
if( $vsSettings->getSystemKey($bw->input[0].'_comment',0, $bw->input[0], 1, 1)  && in_array($obj->getId(),$option)) {
$BWHTML .= <<<EOF

                    <a onclick="vsf.popupGet('comments/display_panel_popup_comment/{$tableName}/{$obj->getId()}','comment-panel-callback', 520,500)"  class="ui-state-default ui-corner-all ui-state-focus" href="javascript:;" >
                            {$vsLang->getWords('comment','Comments')}
                    </a>
                
EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}


}?>