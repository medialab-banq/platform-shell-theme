<?php

class Social_Media_Links_Walker_Footer_Menu extends Walker_Nav_Menu {
	
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '<ul id="social">';
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '</ul>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {		
		
		$target = $item->target != '' ? $item->target : '_blank';
		$classes = (($item->classes != '') && ($item->classes != null)) ? implode(" ", $item->classes) : '';
				
		$output .= '<li>';
		
		$output .= '<a href="' . esc_url($item->url) . '" target="' . $target . '" title=" ' . esc_attr($item->attr_title) . ' "><i class="' . $classes . '" aria-hidden="true"></i><span class="sr-only">' . esc_html($item->title) . '</span></a>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= '</li>';
    }
}