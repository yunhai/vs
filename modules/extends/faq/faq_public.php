<?php
/*
 +-----------------------------------------------------------------------------
 |   VSF version 5.0
 |	Author: System
 |	Homepage: http://www.vietsol.net
 |	If you use this code, please don't delete these comment lines!
 |	Start Date: 
 |	Finish Date: 
 |	Modified Start Date: 
 |	Modified Finish Date: 
 |	News Description: this file created by auto system
 +-----------------------------------------------------------------------------
 */
global $vsStd;
$vsStd->requireFile ( CORE_PATH . "pages/pages_public.php" );


class faq_public extends pages_public {
    function auto_run() {
        global $bw,$vsModule;
        
        $bw->input['action']="pages_".$bw->input['action'];
        
        require_once EXTEND_PATH.$bw->input[0]."/faq_controler_public.php";
        $controler = new faq_controler_public('pages',"skin_faq","page",'page');
        
        $controler->auto_run();
        
        return $this->setOutput($controler->getOutput());
    }
}
