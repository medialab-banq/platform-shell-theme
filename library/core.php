<?php

// Adding Translation Option
load_theme_textdomain( 'platform-shell-theme', TEMPLATEPATH.'/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if ( is_readable($locale_file) ) require_once($locale_file);


// Cleaning up the Wordpress Head
function platform_shell_bootstrap_head_cleanup() {
	// remove header links
	remove_action( 'wp_head', 'feed_links_extra', 3 );                    // Category Feeds
	remove_action( 'wp_head', 'feed_links', 2 );                          // Post and Comment Feeds
	remove_action( 'wp_head', 'rsd_link' );                               // EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' );                       // Windows Live Writer
	remove_action( 'wp_head', 'index_rel_link' );                         // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
	remove_action( 'wp_head', 'wp_generator' );   						  // WP version
}
	// launching operation cleanup
	add_action('init', 'platform_shell_bootstrap_head_cleanup');
	// remove WP version from RSS
	function wp_bootstrap_rss_version() { return ''; }
	add_filter('the_generator', 'wp_bootstrap_rss_version');


// loading jquery reply elements on single pages automatically
function platform_shell_bootstrap_queue_js(){ if (!is_admin()){ if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) wp_enqueue_script( 'comment-reply' ); }
}
	// reply on comments script
	add_action('wp_print_scripts', 'platform_shell_bootstrap_queue_js');

// Fixing the Read More in the Excerpts
// This removes the annoying […] to a Read More link
function platform_shell_bootstrap_excerpt_more($more) {
	global $post;

	return '...  <a href="'. get_permalink($post->ID) . '" class="more-link" title="Read '.get_the_title($post->ID).'">'.__('Lire plus &raquo;','platform-shell-theme').'</a>';
}
add_filter('excerpt_more', 'platform_shell_bootstrap_excerpt_more');

// Adding WP 3+ Functions & Theme Support
function platform_shell_bootstrap_theme_support() {

	add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled in functions.php)
	set_post_thumbnail_size(125, 125, true);   // default thumb size
	add_theme_support( 'custom-background' );  // wp custom background
	$args = array(
		'flex-width'    => true,
		'width'         => 1030,
		'flex-height'    => true,
		'height'        => 500,
		'default-image' => get_template_directory_uri() . '/images/Ibex_Wallpaper_by_willwill100.jpg',
		'uploads'       => true,
	);
	add_theme_support( 'custom-header', $args );
	add_theme_support('automatic-feed-links'); // rss thingy

	add_theme_support( 'menus' );

	register_nav_menus(
		array(
			'main_nav' => _x('Principal', 'nav_menus','platform-shell-theme'),
			'footer_links' => _x('Pied de page primaire', 'nav_menus','platform-shell-theme')
		)
	);

}

add_action('after_setup_theme','platform_shell_bootstrap_theme_support');

function get_wordpress_menu_id_by_platform_shell_option_menu_id( $menu_option_id ) {

	// platform_shell_installed_menus

	// Lazy.
	if ( !isset( $this->installed_menus_option ) ) {
		$this->getInstalledMenusOption();
	}
	if ( isset( $this->installed_menus_option[ $menu_option_id ] ) ) {
		return $this->installed_menus_option[ $menu_option_id ];
	} else {
		return null;
	}
}

function platform_shell_main_nav() {
    wp_nav_menu(
    	array(
    		'menu' => platform_shell_theme_get_installed_menu_wp_menu_id("platform_shell_menu_main"),
    		'menu_class' => 'nav navbar-nav',
    		'container' => 'false',
    		'fallback_cb' => 'wp_bootstrap_main_nav_fallback',
    		'walker' => new Bootstrap_Walker()
    	)
    );
}

/****************** PLUGINS & EXTRA FEATURES **************************/
// Numeric Page Navi (built into the theme by default)
function page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}

	echo $before.'<ul class="pagination">'."";

	if ($paged > 1) {
		$prevposts = get_previous_posts_link('&larr;');
		if(isset($prevposts) ) {
			echo '<li>' . $prevposts  . '</li>';
		}
	}

	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="active"><a href="#">'.$i.'</a></li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}

	$nexposts  = get_next_posts_link('&rarr;');
	if(isset($nexposts) ) {
		echo '<li>' . $nexposts  . '</li>';
	}

	echo '</ul>'.$after."";
}

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');
