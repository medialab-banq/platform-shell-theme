<?php
/**
 * Functions merged from parent theme
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

// active le debug pour le backend Admin seulement.
if ( WP_DEBUG ) {
	if ( is_admin() ) {
		// phpcs:ignore WordPress
		ini_set( 'display_errors', 'On' );
		// phpcs:ignore WordPress
		error_reporting( E_ALL );
	}
}

// fonction de debug, log les erreurs et les log de debug dans wp-content/debug.log.
if ( ! function_exists( 'write_log' ) ) {
	/**
	 * Méthode write_log
	 *
	 * @param mixed $log    Élément à ajouter au fichier log.
	 */
	function write_log( $log ) {
		if ( true === WP_DEBUG ) {
			if ( is_array( $log ) || is_object( $log ) ) {
				// phpcs:ignore WordPress
				error_log( print_r( $log, true ) );
			} else {
				// phpcs:ignore WordPress
				error_log( $log );
			}
		}
	}
}

define( 'EPWP_LOCAL_PATH', get_template_directory() );

if ( ! defined( 'HASH_TYPE' ) ) {
	// Valeur par défaut pour le hash. Cette valeur peut être remplacé dans le fichier wp-config.php.
	define( 'HASH_TYPE', 'sha1' );
}

if ( ! function_exists( 'platform_shell_theme_get_checksum_file_version' ) ) {
	/**
	 * Méthode platform_shell_theme_get_checksum_file_version
	 *
	 * @param string $path    URI du fichier.
	 * @return boolean|string
	 */
	function platform_shell_theme_get_checksum_file_version( $path = '' ) {

		$return_value = false;

		if ( ! empty( $path ) && file_exists( $path ) ) {
			$return_value = hash_file( HASH_TYPE, $path );
		}

		return $return_value;
	}
}

// Get Bones Core Up & Running!.
require_once get_template_directory() . '/library/core.php';            // core functions (don't remove).

// Shortcodes.
require_once get_template_directory() . '/library/shortcodes.php';

// Plugins.
require_once get_template_directory() . '/library/plugins.php';

// Theme widgets.
require_once get_template_directory() . '/library/widgets/widget.php';

// Admin Functions (commented out by default).
require_once 'library/admin.php';         // custom admin functions.

// require_once('library/admin.php');         // custom admin functions.
// Navigation Walker  - https://codex.wordpress.org/Class_Reference/Walker.
require_once get_template_directory() . '/library/menus/class-bootstrap-walker.php';

if ( ! function_exists( 'platform_shell_theme_enqueue_main_script' ) ) {
	/**
	 * Méthode platform_shell_theme_enqueue_main_script
	 *
	 * @param int    $file_id          ID du fichier.
	 * @param string $base_url         Url du fichier.
	 * @param string $base_path        Emplacement du fichier.
	 * @param string $file_location    Emplacement du fichier.
	 * @throws \Exception              Lorsque les arguments sont invalides.
	 */
	function platform_shell_theme_enqueue_main_script( $file_id, $base_url, $base_path, $file_location = '' ) {
		if ( ! empty( $file_id ) && ! empty( $base_url ) && ! empty( $base_path ) && ! empty( $file_location ) ) {
			wp_enqueue_script( $file_id, $base_url . $file_location, [], platform_shell_theme_get_checksum_file_version( ( $base_path . $file_location ) ), true );
		} else {
			throw new \Exception( 'Invalid arguments in platform_shell_theme_enqueue_main_script' );
		}
	}
}

if ( ! function_exists( 'platform_shell_theme_enqueue_main_style' ) ) {
	/**
	 * Méthode platform_shell_theme_enqueue_main_style
	 *
	 * @param int    $file_id          ID du fichier.
	 * @param string $base_url         Url du fichier.
	 * @param string $base_path        Emplacement du fichier.
	 * @param string $file_location    Emplacement du fichier.
	 * @throws \Exception              Lorsque les arguments sont invalides.
	 */
	function platform_shell_theme_enqueue_main_style( $file_id, $base_url, $base_path, $file_location = '' ) {
		if ( ! empty( $file_id ) && ! empty( $base_url ) && ! empty( $base_path ) && ! empty( $file_location ) ) {
			wp_enqueue_style( $file_id, $base_url . $file_location, [], platform_shell_theme_get_checksum_file_version( ( $base_path . $file_location ) ), 'all' );
		} else {
			throw new \Exception( 'Invalid arguments in platform_shell_theme_enqueue_main_script' );
		}
	}
}

/**
 * Méthode kv_add_font_family_size
 *
 * @param array $buttons    Liste des boutons.
 * @return array
 */
function kv_add_font_family_size( $buttons ) {
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';

	return $buttons;
}
add_filter( 'mce_buttons_3', 'kv_add_font_family_size' );

/**
 * Méthode platform_shell_tiny_mce
 *
 * Helps you to add the custom font to your tinyMCE editor.
 * add_filter('tiny_mce_before_init', 'kv_custom_font_list' );
 * allow span tag in editor.
 *
 * @param array $init    Paramètres d'initialisation de TinyMCE.
 * @return string
 */
function platform_shell_tiny_mce( $init ) {
	// Command separated string of extended elements.
	$ext = 'span[id|name|class|style]';

	// Add to extended_valid_elements if it alreay exists.
	if ( isset( $init['extended_valid_elements'] ) ) {
		$init['extended_valid_elements'] .= ',' . $ext;
	} else {
		$init['extended_valid_elements'] = $ext;
	}

	// Super important: return $init!.
	return $init;
}
add_filter( 'tiny_mce_before_init', 'platform_shell_tiny_mce' );

/**
 * Méthode new_excerpt_more
 *
 * Replaces the excerpt "Read More" text by a link.
 *
 * @param string $more    Text de l'extrait.
 * @return string
 */
function new_excerpt_more( $more ) {
	global $post;
	return '<a class="moretag" href="' . get_permalink( $post->ID ) . '"> ' . __( ' ... En savoir plus', 'platform-shell-theme' ) . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

/**
 * Méthode new_excerpt_length
 *
 * @param integer $length    Longueur de l'extrait.
 * @return number
 */
function new_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'new_excerpt_length' );

/**
 * Méthode list_pings
 *
 * Display trackbacks/pings callback function.
 *
 * @param string  $comment    Commentaire.
 * @param array   $args       Arguments.
 * @param integer $depth      Profondeur.
 */
function list_pings( $comment, $args, $depth ) {
?>
		<li id="comment-<?php comment_ID(); ?>"><i class="icon icon-share-alt"></i>&nbsp;<?php comment_author_link(); ?>
<?php
}

/*********************      Shortcodes       */
// Enable shortcodes in widgets.
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Méthode remove_more_jump_link
 *
 * Disable jump in 'read more' link.
 *
 * @param string $link    Lien.
 * @return mixed
 */
function remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ( $offset ) {
		$end = strpos( $link, '"', $offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end - $offset );
	}
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_jump_link' );

/*********************      Images       */
// Remove height/width attributes on images so they can be responsive.
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

/**
 * Méthode remove_thumbnail_dimensions
 *
 * @param string $html    Code HTML.
 * @return mixed
 */
function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
	return $html;
}

/**
 * Méthode add_class_attachment_link
 *
 * Add thumbnail class to thumbnail links.
 *
 * @param string $html    Code HTML de l'attachement.
 * @return mixed
 */
function add_class_attachment_link( $html ) {
	$postid = get_the_ID();
	$html   = str_replace( '<a', '<a class="thumbnail"', $html );
	return $html;
}
add_filter( 'wp_get_attachment_link', 'add_class_attachment_link', 10, 1 );

/*********************      MISC         */
add_editor_style( 'editor-style.css' );

/**
 * Méthode add_active_class
 *
 * @param array  $classes    Classes à assigner.
 * @param Object $item      Instance de l'objet.
 * @return string
 */
function add_active_class( $classes, $item ) {
	if ( 0 === $item->menu_item_parent && in_array( 'current-menu-item', $classes, true ) ) {
		$classes[] = 'active';
	}

	return $classes;
}
// Add Twitter Bootstrap's standard 'active' class name to the active nav link item.
add_filter( 'nav_menu_css_class', 'add_active_class', 10, 2 );

// enqueue javascript.
if ( ! function_exists( 'theme_js' ) ) {
	/**
	 * Méthode theme_js
	 */
	function theme_js() {
		platform_shell_theme_register_theme_scripts();
		platform_shell_theme_enqueue_admin_theme_scripts();
	}
}
add_action( 'wp_enqueue_scripts', 'theme_js' );

/**
 * Méthode wp_bootstrap_wp_title
 *
 * Get <head> <title> to behave like other themes.
 *
 * @param string $title    Titre de l'article.
 * @param string $sep      Séparateur.
 * @return string
 */
function wp_bootstrap_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	} else {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		/* translators: %1$s: Numéro de page */
		$title = "$title $sep $site_description $sep " . sprintf( __( 'Page %1$s', 'platform-shell-theme' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'wp_bootstrap_wp_title', 10, 2 );

/**
 * Méthode get_wpbs_theme_options
 *
 * Get theme options.
 */
function get_wpbs_theme_options() {
	$theme_options_styles = '';

	/* todo_eg :transition suppression dependances. */
	$suppress_comments_message = true;
	if ( $suppress_comments_message ) {
		$theme_options_styles .= '
        #main article {
          border-bottom: none;
        }';
	}

	if ( $theme_options_styles ) {
		echo '<style>'
		// phpcs:ignore WordPress
		. $theme_options_styles . '
        </style>';
	}
} // end get_wpbs_theme_options function.

/**
 * Méthode cc_mime_types
 *
 * @param array $mimes    Mimes associées à l'image.
 * @return array
 */
function cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

?>
