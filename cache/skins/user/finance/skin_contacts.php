<?php
class skin_contacts{

//===========================================================================
// <vsf:contactForm:desc::trigger:>
//===========================================================================
function contactForm($option="") {global $vsLang, $bw, $vsSettings, $vsPrint;

$vsPrint->addJavaScriptFile('icampus/jquery.validate.pack', 1);

//--starthtml--//
$BWHTML .= <<<EOF
        <div id='register-form'>
<form id="formContact" method="POST" action="{$bw->vars['board_url']}/contacts">
<div class='type cfheader'>
<span class='item active' ref='feedback'>Feedback</span>
<span class='item' ref='report'>Report Bugs/Errors</span>
<span class='item' ref='suggest'>Suggest Feathers/Improvement</span>
<div class='clear'></div>
</div>


EOF;
if( $option['message'] ) {
$BWHTML .= <<<EOF

<div id='message'>{$option['message']}</div>
<script type='text/javascript'>
setTimeout(function(){
        $('#message').toggle("slow", function(){
$(this).remove();
});
        }, 2000);
        </script>

EOF;
}

$BWHTML .= <<<EOF


        <label>{$vsLang->getWords('contact_name','Name')}:</label>
        <input id='contactName' name='contactName' value='{$option['contact']['contactName']}' />
        
        <label>{$vsLang->getWords('contact_lastname','Email')}:</label>
        <input id='contactEmail' name="contactEmail" value='{$option['contact']['contactEmail']}' />
        
        <label>{$vsLang->getWords('contact_username','Username')}:</label>
        <input name="username" value='{$option['contact']['username']}' />
        
<label>{$vsLang->getWords('contact_message','Feedback')}</label>
            <textarea id="contactContent" name="contactContent">{$option['contact']['contactContent']}</textarea>

            
            <label>&nbsp;</label>
            <div class='recapchar'>
            {$option['recapcha']}
</div>

            <input class="button" name='isubmit' type="submit" value="{$vsLang->getWords('send','Send')}" />
        <div class='clear'></div>
</form>
              </div>
<script type='text/javascript'>
$('.item').each(function(){
var ref = $(this).attr('ref');
if(ref == '{$bw->input['type']}'){
$('.active').removeClass('active');
$(this).addClass('active');
}
});

$('.item').click(function(){
if($(this).hasClass('active')) return false;
$('.active').removeClass('active');
$(this).addClass('active');
});


$('input').bind('keypress', function(e) {
var code = (e.keyCode ? e.keyCode : e.which);
if(code == 13) return false;
});

$("#formContact").validate({
rules: {
contactName: {
required: true,
},

contactEmail:{
email: true
},

contactUser: {
minlength: 6,
},
contactContent: {
required: true,
minlength: 6,
}
},
messages:{
contactName: {
required: "{$vsLang->getWords('validate_contactname','Provide your name')}"
},

contactEmail:{
email: "{$vsLang->getWords('validate_contactemail','Please enter a valid email address')}"
},

contactUser: {
minlength: jQuery.format("Enter at least {0} characters"),
},
contactContent: {
required: "{$vsLang->getWords('validate_contactcontent','Provide your feedback')}",
minlength: jQuery.format("Enter at least {0} characters"),
}
},

success: function(label) {
label.html("&nbsp;").addClass("checked");
},

submitHandler: function(form){
$.blockUI({
        css: {
        border: 'none',
            padding: '50px',
            backgroundColor: '#C0C0C0',
            color: '#000',
            cursor:'progress',
        },
});
var stype = $('.type > .active').attr('ref');
var hidden = "<input id='type' type='hidden' name='type' value='"+stype+"' />";

$('#contactType').remove();
$(form).append(hidden);

form.submit();
return false;
}
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:generalView:desc::trigger:>
//===========================================================================
function generalView($option=array()) {global $bw, $vsLang;


//--starthtml--//
$BWHTML .= <<<EOF
        <div id="contact">
<div id='left-contact'>
<h3>Contact us</h3>
<div id='info' class='contact'>
<div class='title'>General Infomation</div>
<span>{$bw->vars['global_systememail']}</span>
</div>
<div id='support' class='contact'>
<div class='title'>Support Request</div>
<span>{$vsLang->getWords('user_signininfo_second','More exciting features coming to make study easier & more effective')}
</span>
</div>
<div id='partnership' class='contact'>
<div class='title'>Partnership Inquires</div>
<span>{$vsLang->getWords('user_signininfo_third','Stay connect to friends, classmates & more to come')}
</span>
</div>
<div id='report' class='contact'>
<div class='title'>Report Abuse/Harassment</div>
<span>{$vsLang->getWords('user_signininfo_third','Stay connect to friends, classmates & more to come')}
</span>
</div>
<div id='mailaddress' class='contact'>
<div class='title'>Mail Address</div>
<span>{$vsLang->getWords('user_signininfo_third','Stay connect to friends, classmates & more to come')}
</span>
</div>
</div>

{$this->contactForm($option)}
</div>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>