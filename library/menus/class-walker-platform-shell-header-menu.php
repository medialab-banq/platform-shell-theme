<?php

class Walker_Plaform_Shell_Header_Menu extends Walker_Nav_Menu {
	
	const ICON_POSITION_LEFT = 0;
	const ICON_POSITION_RIGHT = 1;
	
	protected $icon_position = self::ICON_POSITION_LEFT; /* default. */
	
	
	public function __construct () {
	}
	
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '';
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '';
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {		
		
		$target = $item->target != '' ? $item->target : '_blank';
		$classes = (($item->classes != '') && ($item->classes != null)) ? implode(" ", $item->classes) : '';
		
		$output .= '<li>';
		
		if ($this->icon_position == self::ICON_POSITION_LEFT) {
			$output .= '<a href="' . esc_url( $item->url ) . '" target="' . $target . '"><i class="' . esc_attr( $classes ). '" aria-hidden="true" title="' . esc_attr( $item->title ) . '"></i><span>' . esc_html($item->title) . '</span></a>';
		} else {
			$output .= '<a href="' . esc_url( $item->url ) . '" target="'. $target .'"><span>' . esc_html($item->title) . '</span><i class="' . esc_attr( $classes ). '" aria-hidden="true" title="' . esc_attr( $item->title ) . '"></i></a>';
		}
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= '</li>';
    }
}