<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_pcontacts extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($obj="",$option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div class="content">
<div class="page_title">Liên hệ</div>
<div class="ct_form">
<div class="ct_nd">{$obj->getContent()}</div>
{$this->getContactForm($option)}
</div>
 <div class="map" id="map_canvas"></div>
<div class="clear"></div>

</div>

    <script>
     function init() {
                                               
    var myHtml = "<h4>{$obj->getTitle()}</h4><p>{$obj->getAddress()}</p>";
                                                
      var map = new google.maps.Map(
      document.getElementById("map_canvas"),
      {scaleControl: true}
      );
      map.setCenter(new google.maps.LatLng({$obj->getLatitude()},{$obj->getLongitude()}));
      map.setZoom({$obj->getZoom()});
      map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
      var marker = new google.maps.Marker({
      map: map,
      position:map.getCenter()
});
var infowindow = new google.maps.InfoWindow({
'pixelOffset': new google.maps.Size(0,15)
});
      infowindow.setContent(myHtml);
      infowindow.open(map, marker);
    }
    $(document).ready(function(){
init();
});
            </script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:getContactForm:desc::trigger:>
//===========================================================================
function getContactForm($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <form id="contact" class="contact" method="POST" action="">
                     <label>Họ tên<span>(*)</span> </label><input class="an" name="name" required type="name" class="col_left" value="{$option['obj']->getName()}"  />
                    <div class="clear"></div>
                    
                   
                    
                    <label>Điện thoại<span>(*)</span></label><input name="phone" required type="name"  value="{$option['obj']->getPhone()}"  />
                    <div class="clear"></div>
                    
                    <label>Email<span>(*)</span></label><input  name="email" required type="email" value="{$option['obj']->getEmail()}"  />                           
                    <div class="clear"></div>
                    
                  <label>Tiêu đề<span>(*)</span> </label><input class="an" name="title" required type="name" class="col_left" value="{$option['obj']->getTitle()}"  />
                    <div class="clear"></div>
                    <label>Nội dung:</label><textarea class="an" name="content">{$option['obj']->getContent()}</textarea>
                    <div class="clear"></div>
                     <label>Mã bảo vệ :</label><input  name="sec_code"  type="text" style="width:100px" />
                     <img id="siimage" src="{$bw->vars['board_url']}/vscaptcha/" />
                     <a href="#" id="reload_img" class="mamoi">refresh</a>
                    <div class="clear"></div> 
                    <input type="submit" name="btnSubmit" value="Gửi" class="input_submit" />
                    <input type="reset" name="btnSubmit" value="Làm lại" class="input_reset" />
                   
                    <div class="clear"></div>
               </form>
                        
                 <script>
                            $("#reload_img").click(function(){
                            $("#siimage").attr("src",$("#siimage").attr("src")+"?a");
                            return false;
                            
});

</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:sendContactSuccess:desc::trigger:>
//===========================================================================
function sendContactSuccess($obj="",$option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="center">
            <h3 class="navigator">
{$option['breakcrum']}
                </h3>
                <h1 class="main_title">{$this->getLang()->getWords('contacts')}</h3>
                <div class="detail_text">   
            {$this->getLang()->getWords('contact_thankyou')}
            
                    
                </div>
                
                       
            </div>
            <script>
 $(document).ready(function()
                            {
                             
                            });
                        
                        setTimeout('relead()',5000);
                        function relead(){
                                document.location.href = "{$bw->base_url}home";
                        }
                        
            </script>
EOF;
//--endhtml--//
return $BWHTML;
}


}
?>