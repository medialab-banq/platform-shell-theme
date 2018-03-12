<?php

class Partners_Links_Walker_Footer_Menu extends Walker_Nav_Menu {
	
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$target = $item->target != '' ? $item->target : '_blank';
		$logo_image_url = $item->description != '' ? $item->description : ''; /* Hack: Utilise le champs description pour sauvegarder lien sur logo. */
		$attr_title =  $item->attr_title != '' ? $item->attr_title : $item->title;

		$output .=  '<a href="' . esc_url( $item->url ) . '" target="' . $target . '" alt=" ' . esc_attr( $attr_title ) . ' "><img src="'. $logo_image_url . '" alt="' . _x( 'Logo', 'footer', 'platform-shell-theme' ) . '"></a>';
	}

	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= '</li>';
	}

}
