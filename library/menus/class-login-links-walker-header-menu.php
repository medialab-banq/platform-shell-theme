<?php

class Login_Links_Walker_Header_Menu extends Walker_Plaform_Shell_Header_Menu {
	
	public function __construct () {
		parent::__construct();
		
		$this->icon_position = parent::ICON_POSITION_RIGHT;
	}
}