<?php
/*
 +-----------------------------------------------------------------------------
 |   VIET SOLUTION JSC  base on IPB Code version 2.0.0
 |	Author: Anh Nguyen
 |	Homepage: http://www.vietsol.net
 |	Website: http://www.khkt.net
 |	Email: tuananh@vietsol.net
 |	If you use this code, please don't delete these comment line!
 |	Start Date: 21/09/2004
 |	Finish Date: 22/09/2004
 |	Modified Start Date: 07/02/2007
 |	Modified Finish Date: 10/02/2007
 +-----------------------------------------------------------------------------
 */

class VSFPagination {
    
	public $p_Style = "Number";
	public $p_Size = 10;
	public $p_Current = 0;
	public $p_StartRow = 0;
	public $p_Links = "";
	public $p_TotalRow = 0;
	public $p_TotalPage = 0;
	public $p_MaxPageView = 20;
	public $p_EndingBy = ".html";
	public $url="";
	public $ajax=1;
	public $callbackobjectId='';
	public $advance = NULL;
        
	public $text = array();

	function __construct() {
		$vsLang = VSFactory::getLangs();
		$this->text['p_First'] = $this->text['p_First']?$this->text['p_First']:"First";
		$this->text['p_Last'] = $this->text['p_Last']?$this->text['p_Last']:"Last";
		$this->text['p_Previous'] = $this->text['p_Previous']?$this->text['p_Previous']:"Previous";
		$this->text['p_Next'] = $this->text['p_Next']?$this->text['p_Next']:"Next";
			
		$this->text['p_Page'] = $this->text['p_Page']?$this->text['p_Page']:'';//$vsLang->getWords('n_Page_n','');
		$this->text['p_Total'] = $this->text['p_Total']?$this->text['p_Total']:"Total";
		$this->text['p_Pages'] = $this->text['p_Pages']?$this->text['p_Pages']:"page(s)";
        $this->text['p_Sub'] = $vsLang->getWords('P_trang','trang')."-";
	}

	/**
	 * Set the current page
	 * @param integer $index the index from vs parameters
	 */
	function SetCurrentPage($index=0) {
		global $bw, $vsPrint;
                
		if($bw->input[$index]){
                    //add by Sangpm
                $query = explode('-',$bw->input[$index]);
		$bw->input[$index] = intval($query[count($query)-1]);
                }
                
		$bw->input[$index] = rtrim($bw->input[$index],$this->p_EndingBy);
			
		if(!is_numeric($bw->input[$index]) && $bw->input[$index]!="") $vsPrint->boink_it($bw->base_url);
			
		if(isset($bw->input[$index]) && $bw->input[$index] != "") {
			$this->p_Current = $bw->input[$index];
		}
		else {
			$this->p_Current = 1;
		}
		$this->index = $index;
	}

	function BuildPageLinks(){
		global $vsPrint;
		if(!$this->p_Size) $this->p_Size = 10;
		$this->p_StartRow = $this->p_Size*($this->p_Current-1);
		$this->p_TotalPage = floor(($this->p_TotalRow-1)/$this->p_Size)+1;

		if($this->p_TotalPage < 1) $this->p_TotalPage = 1;
			
		if($this->p_Current > $this->p_TotalPage) {
			if($this->p_TotalPage < 2){
				if($this->ajax){
					print "<script type='text/javascript'>vsf.get('{$this->url}','{$this->callbackobjectId}')</script>";
					return;
				}
				$vsPrint->boink_it($this->url);
			}
			else{
				if($this->ajax){
					print "<script type='text/javascript'>vsf.get('{$this->url}{$this->p_TotalPage}','{$this->callbackobjectId}')</script>";
					return;
				}
				$vsPrint->boink_it($this->url.$this->p_TotalPage."/");
			}
			return;
		}
			
		if($this->p_Current < 1)
		$vsPrint->boink_it($this->url);

		if($this->p_TotalPage < 2) return; 
		switch($this->p_Style){
			case 'Number':
				$this->BuildPageLinksNumber($this->p_Current,$this->p_TotalPage);
				break;
			case 'Text':
				$this->BuildPageLinksText($this->p_Current,$this->p_TotalPage);
				break;
		}
			
		$this->p_Links = str_replace("/{$this->text['p_Sub']}1".$this->p_EndingBy,"/",$this->p_Links);
	}
	function BuildPageLinksHash(){
		global $vsPrint;
		if(!$this->p_Size) $this->p_Size = 10;
		$this->p_StartRow = $this->p_Size*($this->p_Current-1);
		$this->p_TotalPage = floor(($this->p_TotalRow-1)/$this->p_Size)+1;

		if($this->p_TotalPage < 1) $this->p_TotalPage = 1;
			
		if($this->p_Current > $this->p_TotalPage) {
			if($this->p_TotalPage < 2){
				if($this->ajax){
					print "<script type='text/javascript'>vsf.get('{$this->url}','{$this->callbackobjectId}')</script>";
					return;
				}
				$vsPrint->boink_it($this->url);
			}
			else{
				if($this->ajax){
					print "<script type='text/javascript'>vsf.get('{$this->url}{$this->p_TotalPage}','{$this->callbackobjectId}')</script>";
					return;
				}
				$vsPrint->boink_it($this->url.$this->p_TotalPage."/");
			}
			return;
		}
			
		if($this->p_Current < 1)
		$vsPrint->boink_it($this->url);

		if($this->p_TotalPage < 2) return;
		switch($this->p_Style){
			case 'Number':
				$this->BuildPageLinksNumber($this->p_Current,$this->p_TotalPage);
				break;
			case 'Text':
				$this->BuildPageLinksText($this->p_Current,$this->p_TotalPage);
				break;
		}
			
		$this->p_Links = str_replace("/{$this->text['p_Sub']}1".$this->p_EndingBy,"/",$this->p_Links);
	}
	function BuildPageLinksText() {
		$strPageUrl = $this->url."PAGE".$this->p_EndingBy;
		$strPageUrl = "<a class=\"pagelink\" href=\"".$strPageUrl." \">TEXT</a> | ";
			
		if($this->p_Current != 1) {
			$first = str_replace("PAGE",1,$strPageUrl);
			$first = str_replace("TEXT",$this->text['p_First'],$first);
			$prev = str_replace("PAGE",$this->p_Current-1,$strPageUrl);
			$prev = str_replace("TEXT",$this->text['p_Previous'],$prev);
		}

		if($this->p_Current != $this->p_TotalPage) {
			$last = str_replace("PAGE",$this->p_TotalPage,$strPageUrl);
			$last = str_replace("TEXT",$this->text['p_Last'],$last);
			$next = str_replace("PAGE",$this->p_Current+1,$strPageUrl);
			$next = str_replace("TEXT",$this->text['p_Next'],$next);
		}
			
		$this->p_Links = $this->text['p_Page']." ".$this->p_Current." / ".$this->text['p_Total']." ".$this->p_TotalPage." ".$this->text['p_Pages']." &nbsp;&nbsp; ".$first.$prev.$next.$last;
		$this->p_Links = trim($this->p_Links," |");
	}

	function BuildPageLinksNumber($nCurrentPage, $nTotalPage)
	{
            global $bw;
            if($nCurrentPage>1) $bw->input['vs_page_index']=VSFactory::getLangs()->getWords('page_index','Trang')." ".$nCurrentPage;
        		$strPageLinks = "";
        		$strResult = "";
		
                if(APPLICATION_TYPE=='user'){
                    if($nCurrentPage<$nTotalPage&&$nCurrentPage>1){
                        //<img src="'.$bw->vars['img_url'].'/prev.jpg" />
                        //<img src="'.$bw->vars['img_url'].'/next.jpg" />
                        $strPre = '<a href="'.$this->url.($nCurrentPage-1).$this->p_EndingBy.$bw->input['advance'].'" class="prev"><</a>';
                        $strNext = '<a href="'.$this->url.($nCurrentPage+1).$this->p_EndingBy.$bw->input['advance'].'" class="next">></a>';
                    }
                    else
                        if($nCurrentPage==1){
                            $strPre = '<a href="'.$this->url.$this->text['p_Sub'].'1'.$this->p_EndingBy.$bw->input['advance'].'" class="prev"><</a>';
                            $strNext = '<a href="'.$this->url.$this->text['p_Sub'].'2'.$this->p_EndingBy.$bw->input['advance'].'" class="next">></a>';
                        }
                        if($nCurrentPage==$nTotalPage){
                            $strPre = '<a href="'.$this->url.$this->text['p_Sub'].($nTotalPage-1).$this->p_EndingBy.$bw->input['advance'].'" class="prev"><</a>';
                            $strNext = '<a href="'.$this->url.$this->text['p_Sub'].($nTotalPage).$this->p_EndingBy.$bw->input['advance'].'" class="next">></a>';
                        }
                }


		if($nTotalPage > 0) {
			if($nTotalPage <= $this->p_MaxPageView) {
				for($i = 1; $i <= $nTotalPage; $i++)
				$strPageLinks .= $i." ";
			}
			else{
				if($nCurrentPage <= floor($this->p_MaxPageView/2)+1){
					for($i = 1; $i <= $this->p_MaxPageView; $i++)
						$strPageLinks .= $i." ";
					$strPageLinks .= "...";
				}
				else{
					$strPageLinks1 .= "...";
					$nAfter = $nTotalPage-$nCurrentPage;
					if($nAfter < floor($this->p_MaxPageView/2))
						$nBefore = $this->p_MaxPageView-$nAfter;
					else
						$nBefore = floor($this->p_MaxPageView/2);
					$k=1;
					if($nCurrentPage == $nTotalPage) $nBefore--;
					for($i=$nBefore;$i>=0;$i--){
						$strPageLinks .= ($nCurrentPage-$i)." ";
						if($nCurrentPage == $nTotalPage && $k == $this->p_MaxPageView){
							break;
						}
						$k++;
					}
					if($nCurrentPage+floor($this->p_MaxPageView/2) < $nTotalPage){
						for($i=1;$i<=floor($this->p_MaxPageView/2);$i++){
							$strPageLinks .= ($nCurrentPage+$i)." ";
						}
						$strPageLinks .= "...";
					}
					else
					for($i = $nCurrentPage+1; $i <= $nTotalPage; $i++){
						$strPageLinks .= $i." ";
					}
				}
			}

			$strPageLinks = trim($strPageLinks);
			$strResult = $this->BuildPageLinksNumberUrl($strPageLinks,$nTotalPage);
			//if($nCurrentPage >=$this->p_MaxPageView)
				//$strResult ="<span class='pag-left' style='float:left'>...</span>".$strResult;
			$strResult = str_replace(">".$nCurrentPage."<"," class='active' >".$nCurrentPage."<",$strResult);
			$this->p_Links = $strPre.$this->text['p_Page']." ".$strResult.$strNext;
		}
	}
	 
	function BuildPageLinksNumberUrl($strPageLinks, $nTotalPage){
		$strResult = ""; global $bw;
		$strPageUrl = $this->url.$this->text['p_Sub']."PAGE".$this->p_EndingBy.$bw->input['advance'];      
			
		if($this->ajax==1)
		$strPageUrl = "<a href=\"javascript:vsf.get('".$strPageUrl."','".$this->callbackobjectId."')\">TEXT</a> ";
		else
		$strPageUrl = "<a href='{$strPageUrl}'>TEXT</a> ";
            
		$strTemp = split(' ',$strPageLinks);
               
		foreach($strTemp as $str){
			if($str == "<<"){
				$strResult .= str_replace("PAGE","1",$strPageUrl);
				$strResult = str_replace("TEXT",$str,$strResult);
			}
			elseif($str == ">>"){
				$strResult.= str_replace("PAGE",$nTotalPage,$strPageUrl);
				$strResult = str_replace("TEXT",$str,$strResult);
			}
			elseif($str == "..."){
				//$strResult .= "<span class='pag-right' style='float:left'>...</span>";
			}
			else{
				$strResult .= str_replace("PAGE",$str,$strPageUrl);
				$strResult = str_replace("TEXT",$str,$strResult);
			}
                        
		}
                
		return $strResult;
	}
}
?>