<?php
class skin_addon{

//===========================================================================
// <vsf:getTopMenu:desc::trigger:>
//===========================================================================
function getTopMenu($analytic="") {global $bw, $vsLang, $vsUser;
$BWHTML = "";

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if( $vsUser->obj->getId() ) {
$BWHTML .= <<<EOF


EOF;
if( $analytic['friend'] || $analytic['inbox'] ) {
$BWHTML .= <<<EOF

<style>
.profile_last{
margin-left: 5px; 
}
#login_form_logged ul li a {
    padding: 27px 8px 0;
}
</style>

EOF;
}

$BWHTML .= <<<EOF

<div id="login_form_logged">
<ul>
            <li>
            <a href="{$bw->vars['board_url']}/{$vsUser->obj->getAlias()}" class="li1">
            Profile
            </a>
            </li>
            <li>
            <a href="{$bw->vars['board_url']}/{$vsUser->obj->getAlias()}/friendmanager" class="li2">
            Friends 
EOF;
if( $analytic['friend'] ) {
$BWHTML .= <<<EOF
({$analytic['friend']})
EOF;
}

$BWHTML .= <<<EOF

            </a>
            </li>
            <li>
            <a href="{$bw->base_url}messages/inbox" title="{$vsLang->getWords('global_top_inbox','Inbox')}" class="li3">
{$vsLang->getWords('global_top_inbox','Inbox')} 
EOF;
if( $analytic['inbox'] ) {
$BWHTML .= <<<EOF
({$analytic['inbox']})
EOF;
}

$BWHTML .= <<<EOF

</a>
            </li>
            </ul>
            <div class="profile_last">
            <div class="li4">
                <a href="#">
                <span style='margin-left: -15px;margin-bottom:3px'><img src="{$bw->vars['img_url']}/register_icon_new4.png" /></span>
                {$vsLang->getWords('global_top_account','Account')}
                <img src="{$bw->vars['img_url']}/register_new_icon.png" style='margin: 0 0 -3px 3px;'/>
                <div class="clear_left"></div>
                </a>
                <div class="clear"></div>
                </div>
                <div class="login_member_info">
                    <div class="image_profile">
{$vsUser->obj->createImageCache($vsUser->obj->getImage(), 75, 75, 0, 1)}
                        <p class="profile_top_text">{$vsUser->obj->getAlias()}</p>
                        <div class="clear_left"></div>
                    </div>
                    <a href="{$bw->vars['board_url']}/users/acctab" title="Account">Account</a><br />
                    <a href="{$bw->vars['board_url']}/users/protab" title="Edit profile">Edit profile</a><br />
                    <a href="{$bw->vars['board_url']}/listings/mylisting" title="My Listings">My Listings</a><br />
                    <a href="{$bw->vars['board_url']}/users/settingtab" title="Edit Settings">Settings</a><br />
                    <a href="{$bw->vars['board_url']}/users/logout" tile="Log out" style=font-weight:bold;"">Log out</a>
                    <div class="clear_left"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <script language="javascript" type="text/javascript">
        $(document).ready(function(){
        var flag = true;
$(".li4 a").click(function(){
if(flag){
$('.login_member_info').css({display: "block"}).show();
$(this).addClass("active");
}else{
$('.login_member_info').css({display: "none"}).hide();
$(this).removeClass("active");
}
flag = !flag;
});
}); 
        </script>

EOF;
}

else {
$BWHTML .= <<<EOF

<div id="login_form">
<form action="{$bw->base_url}users/login" id="login-form" method="post">

EOF;
if( $bw->input['verify'] ) {
$BWHTML .= <<<EOF

        <input type="hidden" name='verify' value='{$bw->input['verify']}' />
        
EOF;
}

$BWHTML .= <<<EOF

<div class="login_left">
       <input name="loginName" id="loginName" onfocus="if(this.value=='Email') this.value='';" onblur="if(this.value=='') this.value='Email';" value="Email" class="input_user"/>
            <input name="loginPassword" id="loginPassword" type="password" class="input_pass" placeholder="password" /><br/>
            
            <input type="checkbox" class="input_check"/>
            <label>Keep me logged in</label>
        <a href="{$bw->base_url}users/renew" title="{$vsLang->getWords('renew_password_link_title','Click here to renew your password')}">
        Forgot your password?
        </a>
        </div>
            <input type="submit" value="login" class="button" name="submit" />
            </form>
        </div>
        
        
        
        
        
<script language="javascript" type="text/javascript">
$("#loginName").keydown(function(e){
var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
if(e.keyCode==13)
$('#login-form').submit();
})
$("#loginName").keydown(function(e){
var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
if(e.keyCode==13)
$('#login-form').submit();
})
$('#login-form').submit(function(){
if(!($("#loginPassword").val() && $("#loginName").val())){
jAlert("{$vsLang->getWords('global_error_login','login name or password cannot be empty')}",'{$bw->vars['global_websitename']} Dialog');
return false;
}
});
</script>
        
EOF;
}
$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:globalParner:desc::trigger:>
//===========================================================================
function globalParner($option=array()) {global $vsLang, $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="sitebar_right">
        <div class="advertise">
                <img src="{$bw->vars['img_url']}/adv_title.jpg" />
                
EOF;
if( $option['global'] ) {
$BWHTML .= <<<EOF

                {$this->__foreach_loop__id_50929657a15d6($option)}
                
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
function __foreach_loop__id_50929657a15d6($option=array())
{
global $vsLang, $bw;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['global'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <a href="{$obj->getWebsite()}" target="_blank" title="{$obj->getTitle()}">
                {$obj->createImageCache($obj->getFileId(),177)}
                </a>
                
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:globalUserPanel:desc::trigger:>
//===========================================================================
function globalUserPanel() {
//--starthtml--//
$BWHTML .= <<<EOF
        <div class="user_status">
                <div class="user_title">
                    <p class="user_nick">David Beckham (Love_Victoria)</p>
                    <p class="user_status"><strong>Current status</strong> clear</p>
                </div>
                <div class="clear"></div>
                <form>
                    <input type="text" onfocus="if(this.value=='What are you doing?') this.value='';" onblur="if(this.value=='') this.value='What are you doing?';" value="What are you doing?"  />
                    <button>Update</button>
                </form>
                <div class="user_menu">
                <ul>
                        <li><a href="#" class="active">IM</a></li>
                        <li><a href="#">Info</a></li>
                        <li><a href="#">Photos</a></li>
                        <li><a href="#">My Campus</a></li>                       
                        <li class="last_li"><a href="#">more >> </a></li>
                    </ul>
                </div>
            </div>
           <div class="clear_left"></div>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>