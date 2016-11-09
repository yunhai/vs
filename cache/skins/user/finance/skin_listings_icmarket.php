<?php
class skin_listings_icmarket{

//===========================================================================
// <vsf:icmarket_all:desc::trigger:>
//===========================================================================
function icmarket_all($option=array()) {global $bw, $vsLang;

$this->editImage = "<img src='{$bw->vars['img_url']}/edit.png' height='15' style='margin-top: 8px;' />";
$this->deleteImage = "<img src='{$bw->vars['img_url']}/delete.png' height='13' style='margin-top: 8px;' />";


//--starthtml--//
$BWHTML .= <<<EOF
        <div id='ltab_cf_all_con{$bw->input['t']}' class='ltab_textbook_con'>
<div class='header'>
        <div class='col col1'>{$vsLang->getWords('ltab_title_c','Title')}</div>
        <div class='col col2'>{$vsLang->getWords('ltab_action','Action')}</div>
            <div class='col col3'>{$vsLang->getWords('ltab_status','Status')}</div>
            <div class='col col4'>{$vsLang->getWords('ltab_postmanage','Manage')}</div>
            <div class='col col5'>{$vsLang->getWords('ltab_dateposted','Date Posted')}</div>
            <div class='clear'></div>
        </div>
        <div class='table'>
        
EOF;
if( $option['pageList'] ) {
$BWHTML .= <<<EOF

        {$this->__foreach_loop__id_4e72ff066cb42($option)}
        
EOF;
}

$BWHTML .= <<<EOF

        </div>
        
EOF;
if( $option['paging'] ) {
$BWHTML .= <<<EOF

        <div class="page_listing">
        <span>Browse Pages:</span>
        {$option['paging']}
        </div>
        
EOF;
}

$BWHTML .= <<<EOF

<script type='text/javascript'>
var curpan = {$option['curpan']};
$(document).ready(function(){

EOF;
if( $option['pageList'] ) {
$BWHTML .= <<<EOF

        {$this->__foreach_loop__id_4e72ff066cdf6($option)}
        
EOF;
}

$BWHTML .= <<<EOF

Custom.init();
var curId; var curTemp; var curArr;
initBind(); 
                function initBind(){
                $('#ltab_cf_all_con{$bw->input['t']} select.styled').bind('change', function(e){
                var curTemp = $(this).attr('id');
                var curArr = curTemp.split('_');
                var curId = curArr[1];
                $('#lc_a_form_temp').val(curId);
                
                $('#lc_a_form_callback').html('');
                $('#lcBuyer').val('');
                $('#lcPrice').val('');
                
                if($(this).val() == 1){
                jConfirm(
'Change to open', 
'Icampux', 
function(r){
if(r){
vsf.get('listings/openlc/&t=cf&atype={$option['ajaxtype']}&temp='+curId, '{$option['ajaxcallback']}');
return false;
}else{
var tuId = $('#lc_a_form_temp').val();
var val = $('#curStatusCF_'+tuId).val();
vsf.jSelect(val, 'lcStatus_'+tuId);
Custom.init();
return false;
}
});
return false;
                }
                
                if($(this).val() == 2){
                jConfirm(
'Change to pending', 
'Icampux', 
function(r){
if(r){
vsf.get('listings/pendinglc/&t=cf&atype={$option['ajaxtype']}&temp='+curId, '{$option['ajaxcallback']}');
return false;
}else{
var tuId = $('#lc_a_form_temp').val();
var val = $('#curStatusCF_'+tuId).val();
vsf.jSelect(val, 'lcStatus_'+tuId);
Custom.init();
return false;
}
});
return false;
                }
                
                jConfirm(
'Change to sold', 
'Icampux', 
function(r){
if(r){
$('#lc_a_form_submit').bind('click', handlerLCSubmit);
                $('#lc_a_form_cancel').bind('click', handlerLCCancel);
                
                var html = "<div style='display:none;' id='lc_a_container'>"+
    "<div id='lc_a_form_callback'></div>"+
    "<form id='lc_a_form' method='POST'>"+
    "<input type='hidden' name='temp' id='lc_a_form_temp' value='' />"+
    "<label>{$vsLang->getWords('lc_a_form_byer','Buyer')}</label>"+
    "   <input name='lcBuyer' id='lcBuyer' value='' />"+
    "    <div class='clear'></div>"+
        
    "    <label>{$vsLang->getWords('lc_a_form_price','Price')}</label>"+
    "    <input name='lcPrice' id='lcPrice' value='' />"+
    "    <div class='clear'></div>"+
        
"<a href='javascript:;' class='bookdetail_btn' id='lc_a_form_submit'>"+
    "    <span>{$vsLang->getWords('cn_form_submit','Submit')}</span>"+
    "    </a>"+
    "    <a href='javascript:;' class='bookdetail_btn' id='lc_a_form_cancel'>"+
    "    <span>{$vsLang->getWords('cn_form_cancel','Cancel')}</span>"+
    "    </a>"+
    "    <div class='clear'></div>"+
    "</form>"+
    "<div class='clear'></div>"+
    "</div>";
                
        $.blockUI({
        theme: true,
           title: "{$vsLang->getWords('lc_form_change_cf_status', "Change item's status")}", 
        message: html,
        fadeIn: 1000,
});

$('.blockOverlay').click(function(){
        $.unblockUI({
onUnblock: function(){
var tuId = $('#lc_a_form_temp').val();
var val = $('#curStatusCF_'+tuId).val();
vsf.jSelect(val, 'lcStatus_'+tuId);
Custom.init();
}
});
        });
return false;
}else{
var tuId = $('#lc_a_form_temp').val();
var val = $('#curStatusCF_'+tuId).val();
vsf.jSelect(val, 'lcStatus_'+tuId);
Custom.init();
return false;
}
});
});
}
var handlerLCSubmit = function() {
$('#lc_a_form').submit();
};

var handlerLCCancel = function(){
        $.unblockUI();
var tuId = $('#lc_a_form_temp').val();
var val = $('#curStatusCF_'+tuId).val();
vsf.jSelect(val, 'lcStatus_'+tuId);
Custom.init();
};
var crt = '';
jQuery.validator.addMethod('validUser', function(value, element, alias){
if($('#lcBuyer').val() != ''){
return $.validator.methods.remote.call(this, value, element, "{$bw->base_url}users/instant/userexits&ajax=1");
}
return true;
}, jQuery.validator.messages.remote);
var validator = $("#lc_a_form").validate({
rules: {
lcBuyer: {
validUser: true
},
lcPrice: {
number: true
}
},
messages:{
lcBuyer: {
remote: "{$vsLang->getWords('validate_remote_lc_user_exist','This buyer doesnot exists')}"
},
lcPrice: {
number: "{$vsLang->getWords('validate_price_number','Provide a valid price')}"
}
},
success: function(label) {
label.html("&nbsp;").addClass("checked");
label.remove();
},
submitHandler: function(form){
$('#lc_a_form_submit').unbind('click', handlerLCSubmit);
$('#lc_a_form_cancel').unbind('click', handlerLCCancel);
vsf.submitForm($('#lc_a_form'), 'listings/soldlc/&t=cf&atype={$option['ajaxtype']}', 'lc_a_form_callback');
return false;
}
});
});
//////////////
function deleteLC(id){
        jConfirm(
'Are you sure to delete this information?', 
'Delete a Listing', 
function(r){
if(r){
var cb = 'cf_maincontain';

EOF;
if( $bw->input['t'] == 'all' ) {
$BWHTML .= <<<EOF

var cb = 'ltab_icmarket{$bw->input['t']}';

EOF;
}

$BWHTML .= <<<EOF

console.log(cb);
vsf.get('listings/deletelc/'+id+'/&t=cf', cb);
return false;
}
});
        }
  
initBindEditLC();
function initBindEditLC(){
                $('.editlc').bind('click', function(e){
                var curTemp = $(this).attr('id');
                var curArr = curTemp.split('_');
                var curId = curArr[1];
                var cbId =  curArr[2];
                $('#rowtemp').remove();
                $('<div class="row" id="rowtemp" rel="'+curId+'"></a>').insertAfter('#rowcf_'+cbId);
                vsf.get('listings/editlc/'+curId+'/&t=cf', 'rowtemp');
                return false;
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
function __foreach_loop__id_4e72ff066cb42($option=array())
{
global $bw, $vsLang;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['pageList'] as $element  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <input id='curStatusCF_{$element['lcId']}' value='{$element['lcStatus']}' name='curStatusCF_{$element['lcId']}' type='hidden' />
        <div class='row' id='rowcf_{$element['lcId']}'>
        <div class='col col1'>
        <a href="{$element['cfURL']}" title="{$element['cfTitle']}" target="_blank">
{$element['cfTitle']}
</a>
</div>
            <div class='col col2'>{$element['cfType']}</div>
            <div class='col col3'>
            <select class='styled' id='lcStatus_{$element['lcId']}' name='lcStatus_{$element['lcId']}'>
            
EOF;
if( $element['lcStatus'] != 3) {
$BWHTML .= <<<EOF

<option {$element['lcStatus_1']} value='1'>Open</option>
<option {$element['lcStatus_2']} value='2'>Pending</option>

EOF;
}

$BWHTML .= <<<EOF

<option {$element['lcStatus_3']} value='3'>Sold</option>
</select>
            </div>
            <div class='col col4'>
            
EOF;
if( $element['lcStatus'] != 3) {
$BWHTML .= <<<EOF

            <a href='#' title='Click here to edit this item' id='edit_{$element['cfId']}_{$element['lcId']}' class='editlc'>
{$this->editImage}
</a>

EOF;
}

$BWHTML .= <<<EOF

<a href='javascript:deleteLC({$element['lcId']});' title='Click here to delete this item' id='delete_{$element['lcId']}' style='margin-left: 5px;'>
{$this->deleteImage}
</a>
            </div>
            <div class='col col5'>{$element['cfTime']}</div>
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
function __foreach_loop__id_4e72ff066cdf6($option=array())
{
global $bw, $vsLang;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['pageList'] as $element  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        vsf.jSelect('{$element['lcStatus']}', 'lcStatus_{$element['lcId']}');
        
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:listingtab_icmarket:desc::trigger:>
//===========================================================================
function listingtab_icmarket($option="") {global $bw, $vsLang;
 
//--starthtml--//
$BWHTML .= <<<EOF
        <div id='ltab_icmarket{$bw->input['t']}'>
<div id="ltab_cf_category">
<select name='cfc' id='cfc'>
<option value='0'>All</option>
{$this->__foreach_loop__id_4e72ff066d3f4($option)}
</select>
</div>
<div class='clear'></div>
 
<div id='cf_maincontain'>
        {$option['cf_all']}
        </if>
        </div>
        
        <script type='text/javascript'>
        var curpan = 0;
        
        $('.submenu').bind('click', function(){
        var func = 'cf'+$(this).attr('rel'); 
        
        $('.subtab .active').removeClass('active');
        $(this).addClass('active');
        vsf.get('listings/'+func, 'cf_maincontain');
        return false;
        });
        
        $('#cfc').change(function(){
vsf.get('listings/cf_category/'+$(this).val()+'/&p='+curpan+'&t=cf', 'cf_maincontain');
});
        </script>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_4e72ff066d3f4($option="")
{
global $bw, $vsLang;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['cfCategory'] as $cfc  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<option value='{$cfc->getId()}'>{$cfc->getTitle()}</option>

EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:icmarket_callback:desc::trigger:>
//===========================================================================
function icmarket_callback($option="") {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <script type='text/javascript'>
$('#curStatus_{$option['lcId']}').val({$option['curStatus']});
$('#ltab_icmarket{$bw->input['t']}').prepend('<div id="message">{$option['message']}</div>');
setTimeout(function(){
        $('#message').toggle("slow", function(){
$('#message').remove();
});
        }, 2000);
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:sold_icmarket_callback:desc::trigger:>
//===========================================================================
function sold_icmarket_callback($option="") {$script = '';
if($option['status']){
if($bw->input['atype'] == 'all')
$script = <<<EOF
$('#curStatus_{$option['ltId']}').val(2);
$('#ltStatus_{$option['ltId']}').children().each(function(){
if($(this).val() == 1 || $(this).val() == 3)
$(this).remove();
});
EOF;
$script .= <<<EOF
setTimeout(function(){
        $.unblockUI();
        }, 2000);
EOF;
}else $script = <<<EOF
$('#lc_a_form_submit').bind('click', handlerSubmit);
$('#lc_a_form_cancel').bind('click', handlerCancel);
EOF;


//--starthtml--//
$BWHTML .= <<<EOF
        <div id="message">{$option['message']}</div>
<div id='sold_cf_temp' style='display:none;'>
{$option['cf_list']}
</div>
<script type='text/javascript'>
{$script}
vsf.get('listings/icmarket/&t=cf', 'mylistingContainer');
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:delete_icmarket_callback:desc::trigger:>
//===========================================================================
function delete_icmarket_callback($option="") {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="message">
{$option['message']}
</div>
<script type='text/javascript'>
setTimeout(function(){
        $('#message').toggle("slow", function(){
$('#message').remove();
});
        }, 2000);
</script>
</if>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:cf_sold:desc::trigger:>
//===========================================================================
function cf_sold($option=array()) {global $bw, $vsLang;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id='lcab_cf_sold_con' class='ltab_textbook_con'>
<div class='header'>
        <div class='col col1'>{$vsLang->getWords('lcab_title_c','Title')}</div>
        <div class='col col2'>{$vsLang->getWords('lcab_action','Action')}</div>
            <div class='col col3'>{$vsLang->getWords('lcab_buyer','Buyer')}</div>
            <div class='col col4'>{$vsLang->getWords('lcab_price','Price')}</div>
            <div class='col col5'>{$vsLang->getWords('lcab_soldtime','Time')}</div>
            <div class='clear'></div>
        </div>
        <div class='table'>
        
EOF;
if( $option['pageList'] ) {
$BWHTML .= <<<EOF

        {$this->__foreach_loop__id_4e72ff066d8d1($option)}
        
EOF;
}

$BWHTML .= <<<EOF

        </div>
        
EOF;
if( $option['paging'] ) {
$BWHTML .= <<<EOF

        <div class="page_listing">
        <span>Browse Pages:</span>
        {$option['paging']}
        </div>
        
EOF;
}

$BWHTML .= <<<EOF

        </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_4e72ff066d8d1($option=array())
{
global $bw, $vsLang;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['pageList'] as $element  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
        <input id='curStatus_{$element['lcId']}' value='{$element['lcStatus']}' name='curStatus_{$element['lcId']}' type='hidden' />
        <div class='row' id='row_{$element['lcId']}'>
        <div class='col col1 narrow'>
        <a href="{$element['listingURL']}" title="{$element['cfTitle']}" target="_blank">
{$element['cfTitle']}
</a>
</div>
            <div class='col col2'>{$element['cfType']}</div>
            <div class='col col3 extend' title="{$element['lcBuyer']}">
            {$element['lcBuyer']}
            </div>
            <div class='col col4 price' title="{$element['lcBuyer']}">
            {$element['lcPrice']}
            </div>
            <div class='col col5'>{$element['cfTime']}</div>
            <div class='clear'></div>
        </div>
        
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:edit_icmarket_callback:desc::trigger:>
//===========================================================================
function edit_icmarket_callback($option="") {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="message">{$option['message']}</div>

EOF;
if( $option['status'] ) {
$BWHTML .= <<<EOF

<script type='text/javascript'>
$('#rowcf_{$option['cfId']} > .col1').html('{$option['title']}');
setTimeout(function(){
        $('#message').toggle("slow", function(){
$('#message').remove();
$('label.error').remove();
$('#rowtemp').toggle("slow", function(){
$('#rowtemp').remove();
});
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


}?>