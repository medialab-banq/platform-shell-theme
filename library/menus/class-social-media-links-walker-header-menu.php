<?php

class Social_Media_Links_Walker_Header_Menu extends Walker_Plaform_Shell_Header_Menu {
	
	public function __construct () {		
		$this->icon_position = self::ICON_POSITION_LEFT;
	}
}