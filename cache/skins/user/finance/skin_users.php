<?php
class skin_users{

//===========================================================================
// <vsf:settingtab:desc::trigger:>
//===========================================================================
function settingtab($option="") {global $bw, $vsTemplate, $vsLang;
 
//--starthtml--//
$BWHTML .= <<<EOF
        {$vsTemplate->global_template->GLOBAL_PARTNER}
 <div id="campus_user">
    <div id="tabs">
<ul class="campus_user_menu">
<li>
        <a href="{$bw->base_url}users/acctab/&ajax=1&tab=acctab">
        {$vsLang->getWords('tab_acc','Account')}
        </a>
        </li>
        <li>
        <a href="{$bw->base_url}messages/inbox&ajax=1&tab=inbox">
        {$vsLang->getWords('tab_message','Message')}
        </a>
        </li>
        <li>
        <a href="{$bw->base_url}users/protab/&ajax=1&tab=protab">
        {$vsLang->getWords('tab_profile','Profile')}
        </a>
        </li>
        <li>
        <a href="{$bw->base_url}listings/mylisting&ajax=1&tab=mylisting">
        {$vsLang->getWords('tab_mylisting','My listing')}
        </a>
        </li>
        <li>
        <a href="{$bw->base_url}users/sharing">My sharing</a>
        </li>
        <li>
        <a href="#tabsetting">Settings</a>
        </li>
        </ul>
            <div class="clear_left"></div>
            
 {$this->coresettingtab($option)}
        </div>
        <script type='text/javascript'>
$(document).ready(function() {
    var itab = $("#tabs").utabs({
    cache: false,
    selected: 5,
    select: function(event, ui) {
        var content = '<img src="'+imgurl+'ajax-loader.gif" alt="retrieving data ..." style="height: 20px"/>';
        content += '<br /><b>Fetching Data....</b>';
        
        var html = '<div style="margin: 10px">' + content + '</div>';
        $("#ui-tabs-" + (ui.index)).html(html);
}
    });
})
</script>
</div>
        <div class="clear"></div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:coresettingtab:desc::trigger:>
//===========================================================================
function coresettingtab($option="") {global $bw, $vsLang;
 
//--starthtml--//
$BWHTML .= <<<EOF
        <div id='tabsetting'>
        <ul class='usercp_listing_menu1'>
        <li>
        <a href="{$bw->vars['board_url']}/users/sprofile/&ajax=1">
 Profile
 </a>
        </li>
            <div class="clear_left"></div>
        </ul>
        
        <script type='text/javascript'>
        $(document).ready(function() {
    $("#tabsetting").utabs({
    cache: false
    });
})
        </script>
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:s_profile:desc::trigger:>
//===========================================================================
function s_profile($option="") {global $bw, $vsLang;
 
//--starthtml--//
$BWHTML .= <<<EOF
        <div id='s_profile'>
 <style>
 .sseting_disable{
 display:none;
 }
 </style>
 
EOF;
if( $option['profile'] ) {
$BWHTML .= <<<EOF

 <form id='s_profile_form' action='POST'>
 <div id='s_profile_form_cb'></div>
 {$this->__foreach_loop__id_503f80fab181b($option)}
<input type='button' name='spform_submit' id='spform_submit' value='Save changes' />
 </form>
 
EOF;
}

$BWHTML .= <<<EOF

 
 <script type='text/javascript'>
 $('#spform_submit').click(function(){
 vsf.submitForm($('#s_profile_form'), 'users/editsp', 's_profile_form_cb');
 return false;
 });
 
 function setDefaultValue(){
 {$this->__foreach_loop__id_503f80fab19c2($option)}
 bindFriendOnly();
 }
 setDefaultValue();
 
 var s2dval = $('#s_2').val();
 var s3dval = $('#s_3').val();
 
 function bindFriendOnly(){
 $('#s_1').change(function(){
 var runme = 0; var curval = $(this).val();
 $(this).children().each(function(){
 if($(this).attr('ref') == 'friend' && $(this).val() == curval)
 runme = 1;
 });
 
 if(runme){
 $('#s_2').children().each(function(){
 if($(this).attr('ref') == 'friend') $(this).attr('selected','selected');
 if($(this).attr('ref') == 'everyone')
 $(this).addClass('sseting_disable');
 })
 
 $('#s_3').children().each(function(){
 if($(this).attr('ref') == 'friend') $(this).attr('selected','selected');
 if($(this).attr('ref') == 'everyone')
 $(this).addClass('sseting_disable');
 })
 }else{
 $('#s_2').children().each(function(){
 if($(this).val() == s2dval) $(this).attr('selected','selected');;
 $(this).removeClass('sseting_disable');
 })
 
 $('#s_3').children().each(function(){
 if($(this).val() == s3dval) $(this).attr('selected','selected');;
 $(this).removeClass('sseting_disable');
 })
 }
 });
 }
 </script>
 </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fab1712($option="",$key='',$setting='')
{
;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $setting as $sId => $sItem  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
 <option value='{$sId}' ref='{$sItem['itemKey']}'>{$sItem['itemTitle']}</option>
 
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fab181b($option="")
{
global $bw, $vsLang;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['profile']['sItem'] as $key => $setting  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
 
 <div class="sitem">
 <div class='title'>
 {$option['profile']['sName'][$key]}
 </div>
 <div class='value'>
 <select name='setting[{$key}]' class='sselect' id='s_{$key}'>
 {$this->__foreach_loop__id_503f80fab1712($option,$key,$setting)}
 </select>
 </div>
 <div class='clear'></div>
 </div>
 
 
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fab19c2($option="")
{
global $bw, $vsLang;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['profile']['sDefault'] as $key => $temp  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
 vsf.jSelect('{$temp}', 's_{$key}');
 
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:changeName:desc::trigger:>
//===========================================================================
function changeName($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="message">{$option['message']}</div>
<script type='text/javascript'>
$("#userFullname").val('{$option['userFullname']}');
$("#fullname").html('{$option['userFullname']}');

EOF;
if( $option['status'] ) {
$BWHTML .= <<<EOF

setTimeout(function(){
        $('#message').toggle("slow", function(){
$('#message').remove();
$('label.error').remove();
$.unblockUI();
});
        }, 2000);

EOF;
}

$BWHTML .= <<<EOF

</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:changeEmail:desc::trigger:>
//===========================================================================
function changeEmail($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="message">
{$option['message']}
</div>
<script type='text/javascript'>
$("#userEmail").val('{$option['email']}');
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:changeAlias:desc::trigger:>
//===========================================================================
function changeAlias($option=array()) {global $bw, $vsUser;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="message">
{$option['message']}
</div>
<script type='text/javascript'>

EOF;
if( $option['status'] ) {
$BWHTML .= <<<EOF

$("#userAlias").val('{$option['alias']}');
$("#link_top a:first-child").html('{$vsUser->obj->getName()} ({$vsUser->obj->getAlias()})');
setTimeout(function(){
        $('#message').toggle("slow", function(){
$('#message').remove();
$('label.error').remove();
$.unblockUI();
});
        }, 2000);

EOF;
}

$BWHTML .= <<<EOF

</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:changePassword:desc::trigger:>
//===========================================================================
function changePassword($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="message">
{$option['message']}
</div>

EOF;
if( $option['status'] ) {
$BWHTML .= <<<EOF

<script type='text/javascript'>
setTimeout(function(){
        $('#message').toggle("slow", function(){
$('#message').remove();
$('label.error').remove();
$.unblockUI();
});
        }, 2000);
</script>

EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:changelt:desc::trigger:>
//===========================================================================
function changelt($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="message">
{$option['message']}
</div>
<script type='text/javascript'>

EOF;
if( $option['status'] ) {
$BWHTML .= <<<EOF

setTimeout(function(){
        $('#message').toggle("slow", function(){
$('#message').remove();
$('label.error').remove();
$.unblockUI();
});
        }, 2000);

EOF;
}

$BWHTML .= <<<EOF

</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:cpCallback:desc::trigger:>
//===========================================================================
function cpCallback($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="message">
{$option['message']}
</div>

EOF;
if( $option['status'] ) {
$BWHTML .= <<<EOF

<script type='text/javascript'>
setTimeout(function(){
        $('#message').toggle("slow", function(){
$('#message').remove();
$('label.error').remove();
$.unblockUI();
});
        }, 2000);
</script>

EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:changepipv:desc::trigger:>
//===========================================================================
function changepipv($option=array()) {global $bw, $vsUser;

//--starthtml--//
$BWHTML .= <<<EOF
        {$vsUser->obj->createImageCache($bw->input['fileId'], 180, 180, 0, 0)}
<script type='text/javascript'>
$("[name=fileId]").each(function(){
$(this).remove();
});
var hd = "<input type='hidden' value={$bw->input['fileId']} name='fileId' id='fileId' />";
$('#cpi_form').append(hd);
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:acctab:desc::trigger:>
//===========================================================================
function acctab($option="") {global $bw, $vsTemplate, $vsLang;
 
//--starthtml--//
$BWHTML .= <<<EOF
        {$vsTemplate->global_template->GLOBAL_PARTNER}
 <div id="campus_user">
    <div id="tabs">
<ul class="campus_user_menu">
<li>
        <a href="#tabaccount">
 {$vsLang->getWords('tab_acc','Account')}
 </a>
        </li>
        
        <li>
        <a href="{$bw->base_url}messages/inbox&ajax=1&tab=inbox">
{$vsLang->getWords('tab_message','Message')}
        </a>
        </li>
        <li>
        <a href="{$bw->base_url}users/protab/&ajax=1&tab=protab">
        {$vsLang->getWords('tab_profile','Profile')}
        </a>
        </li>
        <li>
        <a href="{$bw->base_url}listings/mylisting&ajax=1&tab=mylisting">
        {$vsLang->getWords('tab_mylisting','My listing')}
        </a>
        </li>
        
        <li>
        <a href="{$bw->base_url}users/sharing">My sharing</a>
        </li>
        <li>
        <a href="{$bw->base_url}users/settingtab/&ajax=1&tab=settingtab">
        Settings
        </a>
        </li>
        </ul>
            <div class="clear_left"></div>
            
 {$this->coreacctab($option)}
            
        </div>
        <script>
$(document).ready(function() {
    var maintab = $("#tabs").utabs({
    cache: false,
    select: function(event, ui) {
        var content = '<img src="'+imgurl+'ajax-loader.gif" alt="retrieving data ..." style="height: 20px"/>';
        content += '<br /><b>Fetching Data....</b>';
        
        var html = '<div style="margin: 10px">' + content + '</div>';
        $("#ui-tabs-" + (ui.index)).html(html);
}
    });
})
</script>
</div>
        <div class="clear"></div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:coreacctab:desc::trigger:>
//===========================================================================
function coreacctab($option="") {global $bw, $vsLang;
 
//--starthtml--//
$BWHTML .= <<<EOF
        <div id='tabaccount'>
        <ul class="usercp_listing_menu1">
        <li>
        <a href="#acc-tab">
 {$vsLang->getWords('account','Account')}
 </a>
        </li>
            <div class="clear_left"></div>
        </ul>
        <div class='clear'></div>
        <div id='tabaccountcontainer'>
{$this->acctab_account($option)}
</div>
<script>
$(document).ready(function() {
    $("#tabaccount").utabs({
    cache: true,
    select: function(event, ui) {
        var content = '<img src="'+imgurl+'ajax-loader.gif" alt="retrieving data ..." style="height: 20px"/>';
        content += '<br /><b>Fetching Data....</b>';
        
        var html = '<div style="margin: 10px">' + content + '</div>';
        $("#ui-tabs-" + (ui.index)).html(html);
}
    });
})
</script>
        </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:acctab_account:desc::trigger:>
//===========================================================================
function acctab_account($option="") {global $bw, $vsLang, $vsUser;
$array = $vsUser->obj->getArrayInfo();
$array['userFirstName'] = trim($array['userFirstName']);
$array['userLastName'] = trim($array['userLastName']);
$name = $vsUser->obj->getName();
$alias = $vsUser->obj->getAlias();

//--starthtml--//
$BWHTML .= <<<EOF
        <div id='acc-tab'>
<div id="clt_form_callback"></div>
                <label class='inputtitle'>{$vsLang->getWords('cp_name','Email')}:</label>
        <input name="userName" value="{$name}" id="userName" disabled />
        <div class='clear'></div>
        <label class='inputtitle'>{$vsLang->getWords('cp_fullname','Full name')}:</label>
        <input id="userFullname" value="{$vsUser->obj->getFullname()}" disabled />
        <a href="javascript:;" class='ainput' id="changenamelink">
        <span>{$vsLang->getWords('change','Change')}</span>
        </a>
        <div class='clear'></div>
        
        <label class='inputtitle'>{$vsLang->getWords('cp_username','Username')}:</label>
        <input id="userAlias" value="{$alias}" disabled />
        <a href="javascript:;" class='ainput' id="changealiaslink">
        <span>{$vsLang->getWords('change','Change')}</span>
        </a>
        <div class='clear'></div>
        
        <label class='inputtitle'>{$vsLang->getWords('password','Password')}:</label>
        <input id="passwordmask" type='password' placeholder="your current password" disabled/>
<a href="javascript:;" class='ainput' id='changepasswordlink'>
        <span>{$vsLang->getWords('change','Change')}</span>
        </a>
        <div class='clear'></div>
        
        
        <form id="changelt" method="POST" class='form_account' style='margin-top: 10px;'>
        <label class='inputtitle'>{$vsLang->getWords('cp_language','Language')}:</label>
        <div style="float:left; width: 250px;">
        <select name="userLanguage" id="userLanguage" style="width: 100%;">
            {$this->__foreach_loop__id_503f80fab348e($option)}
            </select>
        </div>
        <div class='clear'></div>
        
        <label class='inputtitle'>{$vsLang->getWords('cp_timezone','Timezone')}:</label>
        <div style="float:left; width: 250px;">
        <select name="userTimezone" id="userTimezone" style="width: 100%;">
<option value="-12">GMT -12:00  Dateline</option>
<option value="-11">GMT -11:00  Samoa</option>
<option value="-10">GMT -10:00  U.S. Hawaiian Time</option>
<option value="-9.5">GMT -09:30  Marquesas</option>
<option value="-9">GMT -09:00  U.S. Alaska Time</option>
<option value="-8.5">GMT -08:30  Pitcarn</option>
<option value="-8">GMT -08:00  Pacific Time</option>
<option value="-7">GMT -07:00  U.S. Mountain Time</option>
<option value="-6">GMT -06:00  U.S. Central Time</option>
<option value="-5">GMT -05:00  U.S. Eastern Time</option>
<option value="in">GMT -05:00  U.S. Eastern Time (Indiana)</option>
<option value="pe">GMT -05:00  Columbia, Peru, South America</option>
<option value="-4">GMT -04:00  Atlantic Time</option>
<option value="-3.5">GMT -03:30  Newfoundland, Canada</option>
<option value="-3">GMT -03:00  Argentina</option>
<option value="br">GMT -03:00  Brazil</option>
<option value="-2">GMT -02:00  Mid-Atlantic</option>
<option value="-1">GMT -01:00  Azores</option>
<option value="+0">GMT U.K., Spain</option>
<option value="+1">GMT +01:00  Western Europe</option>
<option value="+2">GMT +02:00  Eastern Europe</option>
<option value="eg">GMT +02:00  Egypt</option>
<option value="il">GMT +02:00  Israel</option>
<option value="+3">GMT +03:00  Russia</option>
<option value="iq">GMT +03:00  Saudi Arabia</option>
<option value="+3.5">GMT +03:30  Iran</option>
<option value="+4">GMT +04:00  Arabian</option>
<option value="+4.5">GMT +04:30  Afghanistan</option>
<option value="+5">GMT +05:00  Pakistan, West Asia</option>
<option value="+5.5">GMT +05:30  India</option>
<option value="+6">GMT +06:00  Bangladesh, Central Asia</option>
<option value="+6.5">GMT +06:30  Burma</option>
<option value="+7">GMT +07:00  Bangkok, Hanoi, Jakarta</option>
<option value="+8">GMT +08:00  China, Taiwan</option>
<option value="sg">GMT +08:00  Singapore</option>
<option value="+8">GMT +08:00  Australia (WT)</option>
<option value="+9">GMT +09:00  Japan</option>
<option value="kr">GMT +09:00  Korea</option>
<option value="+9.5">GMT +09:30  Australia (CT)</option>
<option value="+10">GMT +10:00  Australia (ET)</option>
<option value="+10.5">GMT +10:30  Australia (Lord Howe)</option>
<option value="+11">GMT +11:00  Central Pacific</option>
<option value="+11.5">GMT +11:30  Norfolk Islands</option>
<option value="+12">GMT +12:00  Fiji, New Zealand</option>
            </select>
        </div>
        <div class='clear'></div>
        
        <a href="javascript:;" class='ainput' id="clt_form_submit" style='margin-left: 220px;'>
        <span>{$vsLang->getWords('clt_form_save_changes','Save changes')}
        </a>
        <div class='clear'></div>
        </form>
        <div class='clear'></div>
        
<div style="display:none;" id="changenamecontainer">
    <div id='cn_form_callback'></div>
    <form id="changename" method="POST">
    <label>{$vsLang->getWords('cn_form_firstname','First Name')}</label>
        <input name="userFirstName" value="{$array['userFirstName']}" />
        <div class='clear'></div>
        
        <label>{$vsLang->getWords('cn_form_lastname','Last Name')}</label>
        <input name="userLastName" value="{$array['userLastName']}" />
        <div class='clear'></div>
        
<a href="javascript:;" class='ainput' id="cn_form_submit">
        <span>{$vsLang->getWords('cn_form_submit','Submit')}</span>
        </a>
        <a href="javascript:;" class='ainput' id="cn_form_cancel">
        <span>{$vsLang->getWords('cn_form_cancel','Cancel')}</span>
        </a>
        <div class='clear'></div>
    </form>
    <div class="clear"></div>
    </div>
    <div class='clear'></div>
    
    <div style="display:none;" id="changepasswordcontainer">
    <div id='cp_form_callback'></div>
    <form id="changepassword" method="POST">
    <label>{$vsLang->getWords('oldpassword','Old Password')}</label>
        <input name="userOldPassword" type="password" />
        <div class='clear'></div>
        
    <label>{$vsLang->getWords('password','Password')}</label>
        <input name="userPassword" type="password" id="userPassword" />
        <div class='clear'></div>
        
        <label>{$vsLang->getWords('confirmpassword','Confirm')}</label>
        <input name="confirmPassword" type="password" id="confirmPassword"/>
        <div class='clear'></div>
        
<a href="javascript:;" class='bookdetail_btn' id="cp_form_submit">
        <span>{$vsLang->getWords('cn_form_submit','Submit')}</span>
        </a>
        <a href="javascript:;" class='bookdetail_btn' id="cp_form_cancel">
        <span>{$vsLang->getWords('cn_form_cancel','Cancel')}</span>
        </a>
        <div class='clear'></div>
    </form>
    <div class="clear"></div>
    </div>
    <div class='clear'></div>
    <div style="display:none;" id="changealiascontainer">
    <div id='ca_form_callback'></div>
    <form id="changealias" method="POST">
    <input type="hidden" id='curalias' value='{$vsUser->obj->getAlias()}' />
    
    <label>{$vsLang->getWords('ca_form_useralias','Username')}</label>
        <input name="userAlias" id="userAlias" value="{$vsUser->obj->getAlias()}" />
        <div class='clear'></div>
        
<a href="javascript:;" class='bookdetail_btn' id="ca_form_submit">
        <span>{$vsLang->getWords('cn_form_submit','Submit')}</span>
        </a>
        <a href="javascript:;" class='bookdetail_btn' id="ca_form_cancel">
        <span>{$vsLang->getWords('cn_form_cancel','Cancel')}</span>
        </a>
        <div class='clear'></div>
    </form>
    <div class="clear"></div>
    </div>
    <div class='clear'></div>
    
    
    
    <script type="text/javascript">
    $('#clt_form_submit').click(function(){
    vsf.submitForm($('#changelt'), 'users/changelt/', 'clt_form_callback');;
    });
$(document).ready(function() {
vsf.jSelect('{$vsUser->obj->getLanguage()}', 'userLanguage');
vsf.jSelect('{$vsUser->obj->getTimezone()}', 'userTimezone');
    $('#changenamelink').click(function() { 
    $('#cn_form_callback').html('');
        $.blockUI({
        theme: true,
           title: '{$vsLang->getWords('cn_form_change_name','Change name information')}', 
        message: $('#changenamecontainer'),
        fadeIn: 1000
});
$('.blockOverlay').click($.unblockUI);
    });
    $('#changepasswordlink').click(function() { 
    $('#cp_form_callback').html('');
        $.blockUI({
        theme: true,
           title: '{$vsLang->getWords('cp_form_change_password','Change password')}', 
        message: $('#changepasswordcontainer'),
        fadeIn: 1000
});
$('.blockOverlay').click($.unblockUI);
    });
    
    $('#changealiaslink').click(function() { 
    $('#ca_form_callback').html('');
        $.blockUI({
        theme: true,
           title: '{$vsLang->getWords('ca_form_change_alias','Change username information')}', 
        message: $('#changealiascontainer'),
        fadeIn: 1000
});
$('.blockOverlay').click($.unblockUI);
    });
});
$('#cn_form_cancel').click(function(){
$.unblockUI();
});
$('#cn_form_submit').click(function(){
vsf.submitForm($('#changename'), 'users/changname/', 'cn_form_callback');
return false;
});
$('#cp_form_cancel').click(function(){
$.unblockUI();
});
$('#cp_form_submit').click(function(){
$('#changepassword').submit();
});
var validator = $("#changepassword").validate({
rules: {
userOldPassword: {
required: true,
minlength: 6
},
userPassword: {
required: true,
minlength: 6
},
confirmPassword: {
required: true,
equalTo: "#userPassword"
},
},
messages:{
userOldPassword: {
required: "{$vsLang->getWords('validate_old_password','Provide old password')}",
minlength: jQuery.format("Enter at least {0} characters"),
},
userPassword: {
required: "{$vsLang->getWords('validate_new_password','Provide new password')}",
minlength: jQuery.format("Enter at least {0} characters"),
},
confirmPassword: {
required: "{$vsLang->getWords('validate_confirm_new_password','Repeat your password')}",
equalTo: "Enter the same password as above"
}
},
success: function(label) {
label.html("&nbsp;").addClass("checked");
label.remove();
},
submitHandler: function(form) {
vsf.submitForm($('#changepassword'), 'users/changepassword/', 'cp_form_callback');
return false;
}
});

$('#ca_form_cancel').click(function(){
$.unblockUI();
});
$('#ca_form_submit').click(function(){
$('#changealias').submit();
});
var crt = '';
jQuery.validator.addMethod('validAlias', function(value, element, alias){
crt = alias;
if($('#curalias').val() != alias){
return $.validator.methods.remote.call(this, value, element, "{$bw->base_url}users/instant/username&ajax=1");
}
},  jQuery.validator.messages.remote);
jQuery.validator.addMethod('validChange', function(alias){
crt = alias;
if($('#curalias').val() != alias)
    return true;
return false;
});
$("#changealias").validate({
rules: {
userAlias: {
required: true,
minlength: 6,
validChange: true,
validAlias: true
},
},
messages:{
userAlias: {
required: "{$vsLang->getWords('validate_username','Provide your username')}",
minlength: jQuery.format("Enter at least {0} characters"),
validChange: "{$vsLang->getWords('validate_change_username','This username isnot modified')}",
remote: "{$vsLang->getWords('validate_remote_username','This username isnot available')}"
}
},
success: function(label) {
label.remove();
},
submitHandler: function(form) {
$('#curalias').val(crt);
vsf.submitForm($('#changealias'), 'users/changealias/', 'ca_form_callback');
return false;
}
});
</script>
<div class='clear'></div>
</div>
        <div class='clear'></div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fab348e($option="")
{
global $bw, $vsLang, $vsUser;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['language'] as $language  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            <option value='{$language->getId()}'>{$language->getName()}</option>
            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:signUpForm:desc::trigger:>
//===========================================================================
function signUpForm($obj=NULL,$option=array()) {global $bw, $vsLang, $vsPrint;
$vsPrint->addJavaScriptFile('icampus/jquery.validate.pack');
$array = $obj->getArrayInfo();

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="register" class='signup'>
<div id='signininfo'>
<div id='stitle'>iCampux - creating a better campus for all</div>
<div id='first' class='sinfo'>
<div>
<span>{$vsLang->getWords('user_signininfo_first','Sell & buy books, textbooks, &items needed for your study locally/at campus 
Meet the buyer/seller, see the products before making purchases
Avoid fraud & watting by dealing directly to other students at your campus')}
</span>
</div>
</div>
<div id='second' class='sinfo'>
<div>
<span>{$vsLang->getWords('user_signininfo_second','More exciting features coming to make study easier & more effective')}
</span>
</div>
</div>
<div id='third' class='sinfo'>
<div>
<span>{$vsLang->getWords('user_signininfo_third','Stay connect to friends, classmates & more to come')}
</span>
</div>
</div>
<div class='divsearch'>
<form id='ssearchform' method='GET'>
<div class='type'>
<span class='item active' ref='tb'>Textbook</span>
<span class='item' ref='icmarket'>icMarket</span>
<span class='item' ref='other'>Other item</span>
<div class='clear'></div>
</div>
<input name='skey' placeholder="Search" class='text' id='skey' />
<input id='dsbutton' type='button' name='isubmit' value='Find' class='submit'/>
</form>
<div class='clear'></div>
</div>
</div>
<div id='register-form'>
<div class='header'>
<h3>{$vsLang->getWords('register-form-title', 'Join iCampux now')}</h3>
    </div>
   <form action="{$bw->base_url}users/signup{$option['suburl']}" id="signUp" method="post"> 
   
        
EOF;
if( $option['message'] ) {
$BWHTML .= <<<EOF

        <div id="message">{$option['message']}</div>
        
EOF;
}

$BWHTML .= <<<EOF

<input type='hidden' name='invite' value='{$option['invite']}' />
        <label>{$vsLang->getWords('firstname','First Name')}:</label>
        <input name="userFirstName" value="{$array['userFirstName']}" />
        
        <label>{$vsLang->getWords('lastname','Last Name')}:</label>
        <input name="userLastName" value="{$array['userLastName']}" />
        
        <label>{$vsLang->getWords('referral','Referral')}:</label>
        <input name="referror" value="{$option['referror']}" />
        
        <label>{$vsLang->getWords('email','Your Email')}:</label>
        <input name="userName" value="{$obj->getName()}" id="userName" />
        
        <label>{$vsLang->getWords('confirmemail','Confirm Email')}:</label>
        <input name="confirmName" value="{$obj->getName()}"/>
        
<label>{$vsLang->getWords('alias','Username')}:</label>
        <input name="userAlias" value="{$obj->getAlias()}" id="userAlias" />
        <label>{$vsLang->getWords('password','Password')}:</label>
        <input name="userPassword" type="password" id="userPassword" />
        
        <label>{$vsLang->getWords('confirmpassword','Confirm Password')}:</label>
        <input type="password" name="confirmPassword" />
        <label>{$vsLang->getWords('campus','Campus')}:</label>
        <select class="select_campus" name="userCampusId" id="userCampusId">
        
EOF;
if( $option['campusList'] ) {
$BWHTML .= <<<EOF

        {$this->__foreach_loop__id_503f80fab3d36($obj,$option)}
        
EOF;
}

$BWHTML .= <<<EOF

        </select>
        <div class="clear_left"></div>
        
        <label>{$vsLang->getWords('iam','I am')}:</label>
        <select class="select_sex" name="userGender">
        <option value="0">{$vsLang->getWords('male', 'Male')}</option>
        <option value="1">{$vsLang->getWords('female', 'Female')}</option>
        </select>
        <div class="clear_left"></div>
        
        <label>{$vsLang->getWords('birthday','Birthday')}:</label>
        <select id="month" name="month" class="birthday">
            <option value='0'>{$vsLang->getWords('moth','Month')}</option>
            </select>
        <select id="day" name="day" class="birthday" >
            <option value='0'>{$vsLang->getWords('day','Day')}</option>
            </select>
            <select id="year" name="year" class="birthday" >
            <option value='0'>{$vsLang->getWords('year','Year')}</option>
            </select>
            <div class='clear'></div>
            
            {$option['recapcha']}
            <input class="button" name='submit' type="submit" value="{$vsLang->getWords('signup','Sign Up')}" />
        <span class="term">
        By signing up, you agree to the 
        <a href="{$bw->vars['board_url']}/terms" title="Term of use">term of service</a> and the
        <a href="{$bw->vars['board_url']}/privacy" title="Private policy">private policy</a>
            </span>
        <div class='clear'></div>
</form>
<div class='clear'></div>
</div>
</div>
    
<script type="text/javascript">
$('.item').click(function(){
if($(this).hasClass('active')) return false;
$('.active').removeClass('active');
$(this).addClass('active');
autoComplete();
});
$('#dsbutton').click(function(){
$('#ssearchform').submit();
});
$('#skey').bind('keypress', function(e) {
var code = (e.keyCode ? e.keyCode : e.which);
if(code == 13) $('#ssearchform').submit();
});
$('#ssearchform').submit(function(){
var stype = $('.type > .active').attr('ref');
if(stype == 'tb'){
var keyword = $('#skey').attr('name', 'keyword');
var action = boardUrl + '/textbooks/search';
}else if(stype == 'icmarket'){
var keyword = $('#skey').attr('name', 'cfCrit');
var action = boardUrl + '/icMarket/search';
}else{
var keyword = $('#skey').attr('name', 'keyword');
var action = boardUrl + '/search/search';
}
$('#ssearchform').attr('action', action);
return true;
});
$(document).ready(function(){
autoComplete();
});
function autoComplete(){
var module = {'tb':'textbooks', 'icmarket':'icMarket', 'other':'search'};
var stype = $('.type > .active').attr('ref');
if(stype == 'other'){
$("#skey").unautocomplete();
return false;
}
var action = boardUrl + '/' + module[stype] + '/suggest';
$("#skey").unautocomplete().autocomplete(action, {
width: 521,
matchContains: true,
minChars: 4,
selectFirst: false
});
}
var arrayMonth = new Array(31,28,31,30,31,30,31,30,31,30,31,30);
$(document).ready(function(){
var crt = '';
jQuery.validator.addMethod('validAlias', function(value, element, alias){
crt = alias;
if($('#curalias').val() != alias){
return $.validator.methods.remote.call(this, value, element, "{$bw->base_url}users/instant/username&ajax=1");
}
},  jQuery.validator.messages.remote);

       var validator = $("#signUp").validate({
rules: {
userName:{
required: true,
email: true,
remote: {
url: "{$bw->base_url}users/instant&ajax=1",
type: "post"
}
},
userFirstName: {
required: true,
},
userLastName: {
required: true,
},
confirmName: {
required: true,
email: true,
equalTo: "#userName"
},
userPassword: {
required: true,
minlength: 6,
maxlength: 20
},
confirmPassword: {
required: true,
minlength: 6,
equalTo: "#userPassword"
},
userEmail:{
email: true
},
userAlias: {
required: true,
minlength: 6,
validAlias: true
}
},
messages:{
userName: {
required: "{$vsLang->getWords('validate_provide_email','Provide a valid email address')}",
email: "{$vsLang->getWords('validate_provide_email','Please enter a valid email address')}",
remote: "{$vsLang->getWords('validate_username_existed','This username is existed')}"
},
userFirstName: {
required: "{$vsLang->getWords('validate_provide_firstname','Provide your firstname')}"
},
userLastName: {
required: "{$vsLang->getWords('validate_provide_lastname','Provide your lastname')}"
},
confirmName: {
required: "{$vsLang->getWords('validate_repeat_email','Repeat your email')}",
equalTo: "{$vsLang->getWords('validate_above_email','Enter the same email as above')}"
},
userPassword: {
required: "{$vsLang->getWords('validate_provide_password','Provide a password')}",
rangelength: jQuery.format("Enter at least {0} - {1} characters")
},
confirmPassword: {
required: "{$vsLang->getWords('validate_repeat_password','Repeat your password')}",
minlength: jQuery.format("Enter at least {0} characters"),
equalTo: "{$vsLang->getWords('validate_above_password','Enter the same password as above')}"
},
userEmail:{
email: "{$vsLang->getWords('validate_provide_email','Please enter a valid email address')}"
},
userAlias: {
required: "{$vsLang->getWords('validate_username','Provide your username')}",
minlength: jQuery.format("Enter at least {0} characters"),
remote: "{$vsLang->getWords('validate_remote_username','This username isnot available')}"
}
},
success: function(label) {
label.html("&nbsp;").addClass("checked");
}
});
var date = new Date();
var y = date.getFullYear();
if(date.getMonth()==2){
var d = new Date("2,29," + y);
if(d.getDate()==29) arrayMonth[1]=29;
else arrayMonth[1]=28;
}
var i; var day = '';
for(i=1;i<=arrayMonth[date.getMonth()];i++){
var current = "";
if(i=='{$obj->day}') var current = 'selected'; 
day += "<option value='"+i+"' " + current +" >"+i+"</option>";
}
$("#day").append(day);
var month = '';
for(i=1;i<=12;i++){
var current = "";
if(i=='{$obj->month}') current = 'selected';
month += "<option value='"+i+"' " + current +" >"+i+"</option>";
}
$("#month").append(month);
var year = '';
for(i = y-17; i >= y-70; i--){
var current = "";
if(i=='{$obj->year}') var current = 'selected';
year += "<option value='"+i+"' " + current +" >"+i+"</option>";
}
$("#year").append(year);
vsf.jSelect("{$obj->getCampusId()}", "userCampusId");
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fab3d36($obj=NULL,$option=array())
{
global $bw, $vsLang, $vsPrint;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['campusList'] as $campus )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <option value="{$campus->getId()}">
{$campus->getTitle()}
</option>
        
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:wellcomeEmail:desc::trigger:>
//===========================================================================
function wellcomeEmail() {global $bw, $vsUser;

//--starthtml--//
$BWHTML .= <<<EOF
        <a href="{$bw->vars['board_url']}" title='iCampux'>
<img src="{$bw->vars['img_url']}/logo.jpg" alt='{$bw->vars['board_url']}'/>
</a><br />
Hi {$vsUser->obj->getAlias()}<br />
Thanks again for joining iCampux! We hope you're having fun, making extra money, and earn good grade at iCampux.com!<br/></br>
Please keep this email for future reference. It includes your membership information and other useful items.<br/></br>
You registered with iCampux using the following membership information:<br/></br>
 Username: {$vsUser->obj->getAlias()}<br/>
Email Address: {$vsUser->obj->getEmail()}</br>
<br/></br>
-- iCampux Team --<br/>
<a href="{$bw->vars['board_url']}" title="http://www.icampux.com">http://www.icampux.com</a>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:error_page:desc::trigger:>
//===========================================================================
function error_page($option="") {global $bw, $vsLang;
$BWHTML = "";

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="error_page">
    <h3>Error</h3>
        <p class="error_page_text">{$option['message']}</p>
        <a href="{$bw->vars['board_url']}" class="error_home" title="{$vsLang->getWords('global_error_home','Go to home page')}">
        {$vsLang->getWords('global_error_home','Go to home page')}
        </a>
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:loginForm:desc::trigger:>
//===========================================================================
function loginForm($user="",$option=array()) {global $vsSession, $vsLang, $vsPrint, $bw;
$vsPrint->addJavaScriptFile('icampus/jquery.validate.pack');

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="signincon">
<div id='signininfo'>
<div id='stitle'>iCampux - creating a better campus for all</div>
<div id='first' class='sinfo'>
<div>
<span>{$vsLang->getWords('user_signininfo_first','Sell & buy books, textbooks, &items needed for your study locally/at campus 
Meet the buyer/seller, see the products before making purchases
Avoid fraud & watting by dealing directly to other students at your campus')}
</span>
</div>
</div>
<div id='second' class='sinfo'>
<div>
<span>{$vsLang->getWords('user_signininfo_second','More exciting features coming to make study easier & more effective')}
</span>
</div>
</div>
<div id='third' class='sinfo'>
<div>
<span>{$vsLang->getWords('user_signininfo_third','Stay connect to friends, classmates & more to come')}
</span>
</div>
</div>
</div>
<div class="signin">
   <form id="signinform" method="post" action="{$bw->base_url}users/login/" >
    <h3>Sign in to your account</h3>
        
EOF;
if( $option['message'] ) {
$BWHTML .= <<<EOF

        <div id="message">{$option['message']}</div>
        
EOF;
}

$BWHTML .= <<<EOF

        
        
EOF;
if( $bw->input['verify'] ) {
$BWHTML .= <<<EOF

        <input type="hidden" name='verify' value='{$bw->input['verify']}' />
        
EOF;
}

$BWHTML .= <<<EOF

        
        <label>Email/Username:</label>
        <input name="u" id="u" value="{$user->getName()}"/>
        
        <label>Password:</label>
        <input name="userPassword" type="password" id="userPassword" />
        <div class="clear"></div>
        <label>&nbsp;</label>
        <input type="checkbox" name="rememberme" style="width: auto;" />
        
        <span>Keep me signed in |</span> 
    <a href="{$bw->base_url}users/renew" title="{$vsLang->getWords('forgot_password','Forgot password')}">
    Forgot your password?
    </a>
    <div class="clear"></div>
     
    <input class="whitebutton" name="submit" type="submit" value="{$vsLang->getWords('signin','Sign In')}" />
    <div class="clear"></div> 
</form>
<div class="clear"></div> 

<div class="tosignup">
    <span class='ftitle'>Are you new to icampus</span>
    <span class='stitle'>Join now! It's free and easy</span>
    <a href="{$bw->base_url}users/signup" title="{$vsLang->getWords('signup','Sign Up')}" class="button">
    {$vsLang->getWords('signup','Sign Up')}
    </a>
    <div class='clear'></div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
jQuery.validator.addMethod('validUsername', function(value, element){
var un = $('#u').val();
if(/@/.test(un)){
return $.validator.methods.email.call(this, value, element);
}else{
return $.validator.methods.required.call(this, value, element);
}
},  jQuery.validator.messages.email);
$("#signinform").validate({
rules: {
u: {
required: true,
validUsername: true,
minlength: 6
},
userPassword: {
required: true,
minlength: 6
}
},
messages:{
u: {
minlength: jQuery.format("Enter at least {0} characters"),
required: "Provide an login account",
email: "Enter an valid email"
},
userPassword: {
required: "Provide a password",
rangelength: jQuery.format("Enter at least {0} characters")
}
},
success: function(label) {
label.html("&nbsp;").addClass("checked");
}
});
});
$("#u").keydown(function(e){
var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
if(e.keyCode==13)
$('#signinform').submit();
})
$("#userPassword").keydown(function(e){
var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
if(e.keyCode==13)
$('#signinform').submit();
})
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:recoverPasswordForm:desc::trigger:>
//===========================================================================
function recoverPasswordForm($option="") {global $bw, $vsLang, $vsPrint;
$vsPrint->addJavaScriptFile('icampus/jquery.validate.pack');

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="register">
<div id='signininfo'>
<div id='stitle'>iCampux - creating a better campus for all</div>
<div id='first' class='sinfo'>
<div>
<span>{$vsLang->getWords('user_signininfo_first','Sell & buy books, textbooks, &items needed for your study locally/at campus 
Meet the buyer/seller, see the products before making purchases
Avoid fraud & watting by dealing directly to other students at your campus')}
</span>
</div>
</div>
<div id='second' class='sinfo'>
<div>
<span>{$vsLang->getWords('user_signininfo_second','More exciting features coming to make study easier & more effective')}
</span>
</div>
</div>
<div id='third' class='sinfo'>
<div>
<span>{$vsLang->getWords('user_signininfo_third','Stay connect to friends, classmates & more to come')}
</span>
</div>
</div>
</div>
<div id='register-form'>
<form action="{$bw->base_url}users/recover" id="recoverPassword" method="post">
<input type='hidden' name='id' value='{$option['userId']}' />
<input type='hidden' name='t' value='{$option['userLastLogin']}' />
<h3>{$vsLang->getWords('recover_password_title','Enter a new Password')}</h3>
        
        <label>{$vsLang->getWords('password','Password')}:</label>
        <input name="userPassword" type="password" id="userPassword" />
        
        <label>{$vsLang->getWords('confirmpassword','Confirm Password')}:</label>
        <input name="confirmPassword" type="password" />
        
        <div class="clr_left"></div>
         <input value="{$vsLang->getWords('renew_password_submit','Submit')}" name='submit' type="submit" class="button" id="submit" >
         <div class="clear"></div>
</form>
</div>
</div>
    
<script type="text/javascript">
$("#submit").keydown(function(e){
var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
if(e.keyCode==13)
$('#resetPassword').submit();
})
$(document).ready(function(){
var validator = $("#resetPassword").validate({
rules: {
userPassword: {
required: true,
minlength: 6,
},
confirmPassword: {
required: true,
minlength: 6,
equalTo: "#userPassword"
}
},
messages:{
userPassword: {
required: "{$vsLang->getWords('valid_email','Provide a email')}",
rangelength: jQuery.format("Enter at least {0} characters")
},
confirmPassword: {
required: "{$vsLang->getWords('validate_repeat_password','Repeat your password')}",
minlength: jQuery.format("Enter at least {0} characters"),
equalTo: "{$vsLang->getWords('validate_above_password','Enter the same password as above')}"
},
},
success: function(label) {
label.html("&nbsp;").addClass("checked");
}
});
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:renewPasswordForm:desc::trigger:>
//===========================================================================
function renewPasswordForm($option="") {global $bw, $vsLang, $vsPrint, $vsUser;
$vsPrint->addJavaScriptFile('icampus/jquery.validate.pack');

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="recover">
<form action="{$bw->base_url}users/renew" id="resetPassword" method="post">
<h3>{$vsLang->getWords('renew_password','Renew Password')}</h3>
        
EOF;
if( $option['message'] ) {
$BWHTML .= <<<EOF

        <div id="message">{$option['message']}</div>
        
EOF;
}

$BWHTML .= <<<EOF

        
        <label>Please enter email address/username to reset your password</label>
        <input name="account" id="account" value="{$option['account']}" />
        
        
        <div class='coffer' id='submit'>Submit</div>
         <div class="clear"></div>
</form>
</div>
    
<script type="text/javascript">
$('#submit').click(function(e){
$('#resetPassword').submit();
return true;
});
$("#account").keydown(function(e){
var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
if(e.keyCode==13){
$('#resetPassword').submit();
return false;
}
})
$(document).ready(function(){
$("#account").focus();
    var tabindex = 1;
    $('#resetPassword').children().each(function() {
    if(!$(this).hasClass('clear'))
            $(this).attr("tabindex", tabindex++);
    });
    
var validator = $("#resetPassword").validate({
rules: {
account: {
required: true
}
},
messages:{
account: {
required: "Provide your email or username",
}
},
success: function(label) {
label.remove();
},
submitHandler: function(form) {
var hidden = "<input value='Submit' name='isubmit' type='hidden' >";
$("#resetPassword").append(hidden);
form.submit();
return true;
}
});

EOF;
if( $option['message'] ) {
$BWHTML .= <<<EOF

setTimeout(function() { 
        $('#message').toggle("slow", function(){
$(this).remove();
});
        }, 2000);

EOF;
}

$BWHTML .= <<<EOF

});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:renewPasswordEmail:desc::trigger:>
//===========================================================================
function renewPasswordEmail($account="") {global $bw;
$url = $bw->vars['board_url'].'/users/recover'.'/&id='.$account->getId().'&t='.$account->getLastLogin();
$random_hash = $account->boundry;


//--starthtml--//
$BWHTML .= <<<EOF
        <a href="{$bw->vars['board_url']}" title='iCampux'>
<img src="{$bw->vars['img_url']}/logo.jpg" alt='{$bw->vars['board_url']}'/>
</a><br />
Hi {$account->getAlias()}!<br /><br />
You recently asked to reset your icampux password. To complete your request, please follow this link:<br /><br />

<a href='{$url}' title='please follow this link to recover password'>
{$url}
</a>
<br /><br />
-- iCampux Team --<br />
{$bw->vars['board_url']}
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:notifyRecoverEmail:desc::trigger:>
//===========================================================================
function notifyRecoverEmail($account="") {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <a href="{$bw->vars['board_url']}" title='iCampux'>
<img src="{$bw->vars['img_url']}/logo.jpg" alt='{$bw->vars['board_url']}'/>
</a><br />
Hi {$account->getAlias()}!<br /><br />
You recently asked to reset your icampux password, and your password has been updated!
<br /><br />
-- iCampux Team -- <br />
{$bw->vars['board_url']}
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:updateCampusCallback:desc::trigger:>
//===========================================================================
function updateCampusCallback($option="") {global $vsLang;

//--starthtml--//
$BWHTML .= <<<EOF
        <script type='text/javascript'>
$('#block_message').html('{$option['message']}');
setTimeout(function() { 
        $.unblockUI();
        $('#global_formContainer').unblock();
        window.location.reload();
        }, 2000);
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:leftSubject:desc::trigger:>
//===========================================================================
function leftSubject($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="sitebar">
        <div class="subject_list">
        <h3>Subjects</h3>
        
EOF;
if( $option ) {
$BWHTML .= <<<EOF

        {$this->__foreach_loop__id_503f80fab51eb($option)}
            
EOF;
}

$BWHTML .= <<<EOF

        </div>
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fab51eb($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option as $cat  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            <a href="{$bw->vars['board_url']}/textbooks/subject/{$cat->getId()}" title="{$cat->getTitle()}">{$cat->getTitle()}</a>
            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


}?>