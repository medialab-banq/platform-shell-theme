<?php

// todo_eg: utile encore?
function remove_twentyeleven_options() {
	remove_action( 'admin_menu', 'twentyeleven_theme_options_add_page' );
}
/* 
 * Turns off the default options panel from Twenty Eleven
 */
add_action('after_setup_theme','remove_twentyeleven_options', 100);