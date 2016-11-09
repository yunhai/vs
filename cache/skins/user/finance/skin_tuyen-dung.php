<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_tuyen-dung extends skin_objectpublic {

//===========================================================================
// <vsf:showDefault:desc::trigger:>
//===========================================================================
function showDefault($option=array()) {global $bw,$vsLang,$vsPrint,$vsTemplate;


//--starthtml--//
$BWHTML .= <<<EOF
        <div id="content">
    <div class="main_title">
        <h1 class="main_title_tuyendung">Tuyển dụng</h1>
            <div class="page">
            <a href="#"><img src="images/page_prev.png" /></a>
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#"><img src="images/page_next.png" /></a>
            </div>
        </div>
        
       <div id="center" class="tuyendung">
<a href="#">TRƯỞNG PHÒNG KIỂM SOÁT NĂNG LỰC BÁN HÀNG (Sales capability & auditing Manager) 07/11/2011</a>
            <a href="#">TRƯỞNG PHÒNG KIỂM SOÁT NĂNG LỰC BÁN HÀNG (Sales capability & auditing Manager) 07/11/2011</a>
            <a href="#">TRƯỞNG PHÒNG KIỂM SOÁT NĂNG LỰC BÁN HÀNG (Sales capability & auditing Manager) 07/11/2011</a>
            <a href="#">TRƯỞNG PHÒNG KIỂM SOÁT NĂNG LỰC BÁN HÀNG (Sales capability & auditing Manager) 07/11/2011</a>
            <a href="#">TRƯỞNG PHÒNG KIỂM SOÁT NĂNG LỰC BÁN HÀNG (Sales capability & auditing Manager) 07/11/2011</a>
       </div>
       
       
       
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>