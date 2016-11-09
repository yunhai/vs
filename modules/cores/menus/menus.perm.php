<?php
class menus_perm {
	function getAdminPermission() {
		global $vsLang, $vsMenu, $vsTemplate;
	
		$permission = array ($vsLang->getWords ( 'menu_permmission', 'Quản lý quyền Menu' ) );
		$category = $vsTemplate->global_template->ADMIN_TOP_MENU;
		
		if (count ( $category )) {
			foreach ( $category as $oMenu ) {
			if(($oMenu->getId() != 2) && ($oMenu->getId() != 7) && ($oMenu->getId() != 29) && ($oMenu->getId() != 5)){ 
				$permission[1] ["{$oMenu->getUrl()}"] = $oMenu->getTitle ();
				}
				if ($oMenu->children)
					foreach ( $oMenu->children as $oMenu1 ) {
						$permission[1] ["{$oMenu1->getUrl()}"] = $oMenu1->getTitle ();
							if ($oMenu1->children)
								foreach ( $oMenu1->children as $oMenu2 ) 
									$permission[1] ["{$oMenu2->getUrl()}"] = $oMenu2->getTitle ();
					}
			}
		}
		return $permission;
	}
}
?>