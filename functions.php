<?php
/**
 * Functions du plugin.
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

/**
 * Fonctions du plugin vennant du thème parent.
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */
require __DIR__ . '/functions-merged-from-parent.php';

/**
 * Configurastion des fonctions du plugin.
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */
require __DIR__ . '/functions-settings.php';

/**
 * Menu du header.
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */
require __DIR__ . '/library/menus/class-walker-platform-shell-header-menu.php';

/**
 * Liens média sociaux footer.
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */
require __DIR__ . '/library/menus/class-social-media-links-walker-footer-menu.php';

/**
 * Liens média sociaux header.
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */
require __DIR__ . '/library/menus/class-social-media-links-walker-header-menu.php';

/**
 * Liens partenaires footer.
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */
require __DIR__ . '/library/menus/class-partners-links-walker-footer-menu.php';

/**
 * Liens login header.
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */
require __DIR__ . '/library/menus/class-login-links-walker-header-menu.php';



/**
 * Plugin update checker. Pour vérification de mise à jour du thème.
 *
 * @package     Platform-Shell
 * @author      Jānis Elsts
 * @copyright   Copyright (c) 2017 Jānis Elsts
 * @license     MIT
 */
// Le require de plugin-update-checker est fait dans le plugin pour ne pas dupliquer la librairie inutilement.
if ( class_exists( 'Puc_v4_Factory' ) ) {
	$update_checker = Puc_v4_Factory::buildUpdateChecker(
		'https://github.com/medialab-banq/platform-shell-theme/',
		__FILE__,
		'platform-shell-theme'
	);
}
// Voir https://github.com/YahnisElsts/plugin-update-checker/issues/201
$update_checker->getVcsApi()->enableReleaseAssets();

use Platform_Shell\Profile;

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Méthode pour vérifier si on est dans la page de login ou register.
 * https://www.google.ca/search?q=wordpress+is+login+page&rlz=1C1GGRV_frCA751CA751&oq=WordPress+is+login+page&aqs=chrome..69i57j69i60j0l4.11527j0j7&sourceid=chrome&ie=UTF-8
 *
 * @return boolean    true / false
 */
function is_login_page() {
	return in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) );
}

// Mécanisme minimal pour attraper installation incorrecte de la plateforme.
if ( ! is_plugin_active( 'platform-shell-plugin/platform-shell-plugin.php' ) && ! is_admin() && ! is_login_page() && ! ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	// Les fichiers de langues ne sont pas chargés. Afficher un message billingue.
	$message  = '';
	$message .= '<div class="alert alert-danger notice notice-error"><p>';
	$message .= '<p>Platform-shell-theme :<p>';
	$message .= '<p>L’installation et l’activation de l’extension « Platform Shell Plugin » est requise au bon fonctionnement de la plateforme.<br/>Voir la documentation pour plus d’information.</p>';
	$message .= '<p>Installation and activation of "Platform Shell Plugin" is required.<br/>See documentation for more information.</p>';

	$admin_url = admin_url();
	$message  .= '<p><a href="' . $admin_url . '">' . 'Aller à l’écran d’administration / Go to admin screen' . '</a></p>';

	$message .= '</p></div>';

	$allowed_tags = [
		'br'  => [
			'class' => [],
		],
		'p'   => [
			'class' => [],
		],
		'div' => [
			'class' => [],
		],
		'a'   => [
			'href' => [],
		],
	];

	echo wp_kses( $message, $allowed_tags );
	die();
}

/************* THUMBNAIL SIZE OPTIONS *************/
/**
 * Méthode platform_shell_theme_add_platform_shell_image_size
 */
function platform_shell_theme_add_platform_shell_image_size() {
	add_image_size( 'project-homepage-large', 840, 400, true );
	add_image_size( 'project-homepage-small', 200, 180, true );
	add_image_size( 'activity-homepage-small', 60, 60, true );
	add_image_size( 'equipment-homepage-small', 130, 130, true );
	add_image_size( 'article-homepage-medium', 266, 200, true );
	add_image_size( 'general-detail-medium', 600, 600, false );
	add_image_size( 'search-result-small', 76, 76, true );
}

// Thumbnail sizes.
add_action( 'after_setup_theme', 'platform_shell_theme_add_platform_shell_image_size' );

// *************** Pour masquer admin bar standard de WordPress.
/* todo_eg. documentmation  + uniformiser. */
add_filter( 'show_admin_bar', '__return_false' );

/**
 * Méthode platform_shell_theme_remove_yoast_json
 *
 * Disable Yoast JSON-LD for search.
 *
 * @param array $data    Données actuelles.
 * @return array
 */
function platform_shell_theme_remove_yoast_json( $data ) {
	$data = [];
	return $data;
}
add_filter( 'wpseo_json_ld_output', 'platform_shell_theme_remove_yoast_json', 10, 1 );

/**
 * Méthode pour masquer le message par défaut de WordPress.
 */
function platform_shell_theme_remove_footer_admin() {
	echo '';
}
add_filter( 'admin_footer_text', 'platform_shell_theme_remove_footer_admin' );

/**
 * Méthode platform_shell_theme_register_theme_scripts
 *
 * Des fonctionnalités sont communes mais utilisées dans des contexte différents.
 * Dans le cas de la validation de metabox du côté admin, nous avons besoin des scripts.
 * mais le thème usager n'est pas chargé à ce moment.
 * La fonction permet ici de faire le register script à partir de deux contextes différents.
 */
function platform_shell_theme_register_theme_scripts() {

	$template_base_url  = get_template_directory_uri();
	$template_base_path = get_template_directory();

	// all javascripts are loaded at the end of the page load , in the wp_footer.
	wp_register_script( 'bootstrap', $template_base_url . '/library/js/bootstrap.min.js', array( 'jquery' ), '3.3.5', true );

	// js file related to the theme.
	$site_scripts_url  = $template_base_url . '/library/js/platform-shell-common-scripts.js';
	$site_scripts_path = $template_base_path . '/library/js/platform-shell-common-scripts.js';
	wp_register_script( 'platform-shell-common-scripts', $site_scripts_url, [], platform_shell_theme_get_checksum_file_version( $site_scripts_path ) );
	wp_localize_script( 'platform-shell-common-scripts', 'WP_platform_shell_common_scripts_string', get_platform_shell_common_script_language_strings() );

	wp_register_script( 'modernizr', $template_base_url . '/library/js/modernizr.full.min.js', array( 'jquery' ), '3.1', true );
	wp_register_script( 'jquery.validate', $template_base_url . '/library/js/jquery.validate.min.js', array( 'jquery' ), '1.15.0', true );
	wp_register_script( 'jquery.validate.additional-methods', $template_base_url . '/library/js/additional-methods.min.js', array( 'jquery', 'jquery.validate' ), '1.15.0', true );

	$currentlocale = get_locale();

	$localcomponent = explode( '_', $currentlocale );
	$baselang       = $localcomponent[0]; // extraire fr de fr_CA par ex.

	// Fix erreur console.log. Localisation en dans le script lui-même, il n'y a pas de fichiers de ressources externes.
	if ( 'en' !== $baselang ) {
		$langfile = 'messages_' . $baselang . '.min.js';
		wp_register_script( 'jquery.validate.langfile', $template_base_url . '/library/js/localization/' . $langfile, array( 'jquery', 'jquery.validate' ), '1.15.0', true );
	}
}

/**
 * Méthode get_platform_shell_common_script_language_strings
 *
 * @return string[]
 */
function get_platform_shell_common_script_language_strings() {
	$strings = [
		'previous' => _x(
			'Précédent',
			'image-bx-slider-navigation',
			'platform-shell-theme'
		),
		'next'     => _x(
			'Suivant',
			'image-bx-slider-navigation',
			'platform-shell-theme'
		),
	];

	return $strings;
}

/**
 * Méthode platform_shell_theme_enqueue_admin_theme_scripts
 */
function platform_shell_theme_enqueue_admin_theme_scripts() {
	/* Un sous ensemble seulement des scripts disponibles seulement.. */
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'jquery.validate' );
	wp_enqueue_script( 'jquery.validate.additional-methods' );
	wp_enqueue_script( 'jquery.validate.langfile' );
}

/**
 * Méthode platform_shell_theme_enqueue_theme_scripts
 */
function platform_shell_theme_enqueue_theme_scripts() {

	// Conditionnal scripts for IE.
	// css3-mediaqueries.
	wp_register_script( 'css3-mediaqueries', 'https://cdnjs.cloudflare.com/ajax/libs/livingston-css3-mediaqueries-js/1.0.0/css3-mediaqueries.min.js' );
	wp_enqueue_script( 'css3-mediaqueries' );
	wp_script_add_data( 'css3-mediaqueries', 'conditional', 'lt IE 9' );

	// html5shiv.
	wp_register_script( 'html5shiv', 'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js' );
	wp_enqueue_script( 'html5shiv' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	// respond.
	wp_register_script( 'respond', 'https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js' );
	wp_enqueue_script( 'respond' );
	wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'bootstrap' );
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'jquery.validate' );
	wp_enqueue_script( 'jquery.validate.additional-methods' );
	wp_enqueue_script( 'jquery.validate.langfile' );

	wp_enqueue_script( 'platform-shell-common-scripts' );
}

/**
 * Méthode platform_shell_theme_theme_enqueue_styles
 */
function platform_shell_theme_theme_enqueue_styles() {

	$template_base_url  = get_template_directory_uri();
	$template_base_path = get_template_directory();
	$theme_base_url     = get_stylesheet_directory_uri();
	$theme_base_path    = get_stylesheet_directory();

	platform_shell_theme_enqueue_main_style( 'platform-shell-style', $theme_base_url, $theme_base_path, '/style.css' );
	platform_shell_theme_enqueue_main_style( 'square-css', $theme_base_url, $theme_base_path, '/square.css' );
	platform_shell_theme_enqueue_main_style( 'bxslider-css', $theme_base_url, $theme_base_path, '/library/js/bxslider/jquery.bxslider.css' );

	// This is the compiled css file from LESS.
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/library/css/bootstrap.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'bootstrap' );

	wp_register_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'fontawesome' );
}
add_action( 'wp_enqueue_scripts', 'platform_shell_theme_theme_enqueue_styles' );

/**
 * Méthode platform_shell_theme_admin_theme_custom_login_styles
 *
 * Pour changements page de login WP (thème admin).
 */
function platform_shell_theme_admin_theme_custom_login_styles() {

	$theme_base_url  = get_stylesheet_directory_uri();
	$theme_base_path = get_stylesheet_directory();

	platform_shell_theme_enqueue_main_style( 'custom-login', $theme_base_url, $theme_base_path, '/style-admin-theme-login.css' );
}

add_action( 'login_enqueue_scripts', 'platform_shell_theme_admin_theme_custom_login_styles' );

/**
 * Méthode platform_shell_theme_enqueue_child_js
 *
 * Chargement des Script de Navigation et détails des sliders.
 */
function platform_shell_theme_enqueue_child_js() {

	$theme_base_url  = get_stylesheet_directory_uri();
	$theme_base_path = get_stylesheet_directory();

	platform_shell_theme_enqueue_main_script( 'bxslider-js', $theme_base_url, $theme_base_path, '/library/js/bxslider/jquery.bxslider.min.js' );
	platform_shell_theme_enqueue_main_script( 'fitvid-js', $theme_base_url, $theme_base_path, '/library/js/bxslider/plugins/jquery.fitvids.js' );
	platform_shell_theme_enqueue_main_script( 'social-media-sharing-js', $theme_base_url, $theme_base_path, '/library/js/social-media-sharing.js' );

	wp_localize_script( 'social-media-sharing-js', 'WP_platform_shell_social_media_sharing_script_settings', platform_shell_get_social_media_sharing_script_settings() );
}
add_action( 'wp_enqueue_scripts', 'platform_shell_theme_enqueue_child_js' );

/**
 * Méthode platform_shell_get_social_media_sharing_script_settings
 *
 * @return array
 */
function platform_shell_get_social_media_sharing_script_settings() {

	$site_name                       = get_bloginfo( 'name' );
	$post_thumbnail_url              = get_the_post_thumbnail_url();
	$common_default_message_template = _x( 'Découvrez « %post_title% »', 'sharing', 'platform-shell-theme' );

	// Facebook.
	$facebook_description_template = platform_shell_get_option( 'platform_shell_option_social_sharing_facebook_description_template', 'platform-shell-settings-social-sharing-facebook', $common_default_message_template );

	$default_message_template = str_replace( '\\n', "\r\n", _x( 'Bonjour,\n\nUn ami ou une amie pense que  « %post_title% » (%post_url%) suscitera votre intérêt et vous invite à l’explorer.', 'sharing', 'platform-shell-theme' ) );
	$email_message_template   = platform_shell_get_option( 'platform_shell_option_social_sharing_email_message_template', 'platform-shell-settings-social-sharing-email', $default_message_template );

	$default_title       = _x( 'À découvrir', 'sharing', 'platform-shell-theme' );
	$email_message_title = platform_shell_get_option( 'platform_shell_option_social_sharing_email_title', 'platform-shell-settings-social-sharing-email', $default_title );

	$twitter_message_template = platform_shell_get_option( 'platform_shell_option_social_sharing_twitter_message_template', 'platform-shell-settings-social-sharing-twitter', $common_default_message_template );

	$settings = [
		'email_message_template'        => $email_message_template,
		'email_message_title'           => $email_message_title,
		'current_post_permalink'        => get_the_permalink(),
		'current_post_title'            => get_the_title(),
		'facebook_description_template' => $facebook_description_template,
		'site_name'                     => $site_name,
		'current_post_thumbnail'        => $post_thumbnail_url,
		'twitter_message_template'      => $twitter_message_template,
	];

	return $settings;
}

/**
 * Méthode platform_shell_theme_get_avatar
 *
 * Utilitaire pour faire la sortir standardisé de l'icône d'avatar Platform_Shell tout en ayant
 * une certaine flexibilité au niveau des tailles d'affichage.
 * Devra être réajusté à mesure qu'on a une meilleure vue d'ensemble des cas d'utilisation.
 *
 * @param integer $user_id    ID de l'utilisateur.
 * @param integer $size       Taille du thumbnail.
 * @param string  $class      Classe à affecter au thumbnail.
 * @return string
 */
function platform_shell_theme_get_avatar( $user_id, $size = 30, $class = '' ) {
	$user      = get_user_by( 'ID', $user_id );
	$avatar    = get_avatar( $user->ID, $size, '', '', array( 'class' => 'img-circle' ) );
	$with_link = false;

	if ( ! in_array( 'administrator', (array) $user->roles, true ) ) {
		$profile_url = Profile::get_profile_url( $user_id );
		$with_link   = true;
	}

	$avatar_display = '<p class="' . $class . '">' . $avatar . ( $with_link ? '<a href="' . $profile_url . '">' . $user->display_name . '</a>' : $user->display_name ) . '</p>';

	return $avatar_display;
}

/**
 * Méthode platform_shell_theme_get_contest_type_icon
 *
 * @param integer $post_id    Identifiant du concours.
 * @return string
 */
function platform_shell_theme_get_contest_type_icon( $post_id ) {
	// Affichage de l'icône du type de projet.
	$contest_type = get_post_meta( $post_id, 'platform_shell_meta_contest_type', true );

	if ( isset( $contest_type ) ) {

		$contest_type_option_json_config = platform_shell_get_option( 'platform_shell_option_contests_type_list', 'platform-shell-settings-page-site-sections-contests', '' );

		$class = 'fa-question'; // Default if missing or data error.

		// todo_eg. Il faudrait voir s'il serait possible de cacher le calcul + récupération à partir du plugin.
		if ( '' !== $contest_type_option_json_config ) {

			$parse_associative = true;
			$parsed_option     = json_decode( $contest_type_option_json_config, $parse_associative );

			if ( isset( $parsed_option ) ) {
				foreach ( $parsed_option as $key => $option ) {

					$type_key = $option['type'] ? $option['type'] : null;

					if ( $type_key === $contest_type ) {
						$class = $option['class'] ? $option['class'] : '';
						break;
					}
				}
			}
		}

		return '<span><i class="fa ' . $class . ' " aria-hidden="true"></i>' . $contest_type . '</span>';
	} else {
		return '';
	}
}

/**
 * Méthode platform_shell_theme_get_admissibility
 *
 * @param integer $post_id    Identifiant du concours.
 * @return string
 */
function platform_shell_theme_get_admissibility( $post_id ) {
	$contest_admissibility = get_post_meta( $post_id, 'platform_shell_meta_contest_admissibility', true );

	if ( null === $contest_admissibility || '' === $contest_admissibility ) {
		return _x( '?', 'contest-admissibility-missing', 'platform-shell-theme' );
	} else {
		return $contest_admissibility;
	}
}

/**
 * Méthodes platform_shell_theme_the_tile_container
 *
 * @param array $params_array    Paramètres.
 */
function platform_shell_theme_the_tile_container( $params_array ) {
	/* Affichage du template. */

	if ( isset( $params_array['title'] ) ) {
		echo '<h2>' . wp_kses_post( $params_array['title'] ) . '</h2>';
	}

	$display_context = isset( $params_array['displayContext'] ) ? $params_array['displayContext'] : 'default';
	$query           = call_user_func( $params_array['get_query_function_name'] );
	// Solution minimale problématique d'initialisation des liens de paging pour les custom query.
	if ( isset( $params_array['query_created_callback'] ) ) {
		call_user_func( $params_array['query_created_callback'], $query );
	}

	if ( $query->have_posts() ) {
		echo '<ul>';
		// 3. on lance la boucle !.
		$index_query_result = 0;
		while ( $query->have_posts() ) {
			$query->the_post();
			// Niveau <li>.
			if ( isset( $params_array['the_tile_function_name'] ) ) {
				call_user_func( $params_array['the_tile_function_name'], $index_query_result, $display_context );
			}
			$index_query_result++;
		}
		echo '</ul>';

		if ( isset( $params_array['itemsListUrl'] ) ) {
			echo '<p><a href="' . esc_url( $params_array['itemsListUrl'] ) . '">' . wp_kses_post( $params_array['allItems'] ) . '</a></p>';
		}
	} else { /* have post */
		if ( 'home' === $display_context ) {
			echo '<p>' . wp_kses_post( $params_array['noItems'] ) . '</p>';
		} else {
			// Tags a revalider.
			echo '<header><h3>' . wp_kses_post( $params_array['noItems'] ) . '</h3></header>';
		}
	}

	// 4. On réinitialise à la requête principale (important).
	if ( ! isset( $params_array['no_auto_reset'] ) || isset( $params_array['no_auto_reset'] ) && false === $params_array['no_auto_reset'] ) {
		wp_reset_postdata();
	}
}

/**
 * Méthode platform_shell_theme_the_project_tile
 *
 * @param number $index              Index.
 * @param string $display_context    Context.
 */
function platform_shell_theme_the_project_tile( $index = 0, $display_context = 'default' ) {
	// Mini-template.
	// todo : récupérer ou passer un index pour avoir format d'image différent sur la première.
	// thumbnail.
	global $post;

	if ( 0 === $index && 'home' === $display_context ) {
		$thumbnail_id = 'project-homepage-large';
	} else {
		$thumbnail_id = 'project-homepage-small';
	}

	$target_url = get_the_permalink(); // ex. http://dev-square.local/projets/q324324/.

	if ( 'profile' === $display_context ) {
		// Soit on consulte son propre profil avec /profil/.
		// Ou un profil avec un user_id.
		$profile_user_id = get_query_var( 'user_id', get_current_user_id() );
		$target_url      = add_query_arg( 'user_id', $profile_user_id, $target_url ); // ex. http://dev-square.local/projets/q324324/?user_id=2.
	}

	/* Affichage du template. */
	?>
	<li class="<?php echo ( 'publish' === get_post_status( $post->ID ) ) ? 'published' : 'unpublished'; ?>">
		<a href="<?php echo esc_attr( $target_url ); ?>"  style="<?php echo platform_shell_get_thumbnail_inline_style_override( $post, $thumbnail_id ); ?>">
			<span class="fondDegrad">
				<span class="tuileZoneTexte">
					<span class="tuileLabel"><?php echo do_shortcode( '[platform_shell_project_type_term_label_by_project_id id="' . $post->ID . '"]' ); ?></span>
					<span class="tuileTitre"><?php the_title(); ?></span>
					<span>
					<?php
						echo platform_shell_plugin_get_creators_list( get_post() );
					?>
					</span>
				</span>
			</span>
		</a>
	</li>
	<?php
}

/**
 * Méthode platform_shell_theme_the_activity_tile
 *
 * @param number $index              Index.
 * @param string $display_context    Contexte.
 */
function platform_shell_theme_the_activity_tile( $index = 0, $display_context = 'default' ) {
	// todo : verifier si c'est le même look dans la page liste. */.
	global $post;

	$date = get_post_meta( $post->ID, 'platform_shell_meta_activity_date', true );
	if ( ! empty( $date ) ) {
		$manually_formatted_hour = get_post_meta( $post->ID, 'platform_shell_meta_activity_hour', true );
		$time_display            = ! empty( $manually_formatted_hour ) ? ( ' - ' . $manually_formatted_hour ) : '';
		$show_year               = ( 'home' === $display_context ) ? false : true;

		$date_display           = platform_shell_get_html_formatted_date( $date, $show_year /* Affichage de l'année dépend du contexte. */ );
		$activity_date_and_time = $date_display . $time_display;
	} else {
		$activity_date_and_time = '';
	}
	/* Affichage du template (support de 2 templates différents, il faudrait trouver une autre approche pour plusieurs templates. */
	?>
	<?php if ( 'home' === $display_context ) : ?>
		<li>
			<?php echo platform_shell_get_thumnail_image( $post, 'activity-homepage-small' ); ?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php echo wp_kses_post( $date_display . $time_display ); ?>
		</li>
	<?php else : ?>
		<li>
			<a href="<?php the_permalink(); ?>"  class="imgActivite">
			<?php echo platform_shell_get_thumnail_image( $post, 'thumbnail' ); ?>
			</a>
			<div class="contenuListeActivite">
				<h2><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h2>
				<p><?php the_excerpt(); ?></p>
				<p><span class="activiteDate"><?php echo wp_kses_post( $date_display ); ?></span> <span class="activiteHeure"><?php echo wp_kses_post( $manually_formatted_hour ); ?></span></p>
			</div>
		</li>
	<?php endif; ?>
	<?php
}

/**
 * Méthode platform_shell_theme_the_generic_title_image_tile
 *
 * @param number $index              Index.
 * @param string $display_context    Display context.
 */
function platform_shell_theme_the_contest_tile( $index = 0, $display_context = 'default' ) {
	platform_shell_theme_the_generic_title_image_tile( $index, $display_context );
}

/**
 * Méthode platform_shell_theme_the_equipment_tile
 *
 * @param number $index              Index.
 * @param string $display_context    Display context.
 */
function platform_shell_theme_the_equipment_tile( $index = 0, $display_context = 'default' ) {
	platform_shell_theme_the_generic_title_image_tile( $index, $display_context );
}

/**
 * Méthode platform_shell_theme_the_tool_tile
 *
 * @param number $index              Index.
 * @param string $display_context    Display context.
 */
function platform_shell_theme_the_tool_tile( $index = 0, $display_context = 'default' ) {
	platform_shell_theme_the_generic_title_image_tile( $index, $display_context );
}

/**
 * Méthode platform_shell_theme_the_generic_title_image_tile
 *
 * @param number $index              Index.
 * @param string $display_context    Display context.
 */
function platform_shell_theme_the_generic_title_image_tile( $index = 0, $display_context = 'default' ) {
	global $post;
	/* Affichage du template. */
	?>
	<li>
		<a href="<?php the_permalink(); ?>" style="<?php echo platform_shell_get_thumbnail_inline_style_override( $post, 'thumbnail' ); ?>">
			<span class="fondDegrad">
				<span class="tuileZoneTexte">
					<span class="tuileTitre"><?php the_title(); ?></span>
				</span>
			</span>
		</a>
	</li>
	<?php
}

/**
 * Méthode platform_shell_theme_the_article_tile
 *
 * @param number $index              Index.
 * @param string $display_context    Display context.
 */
function platform_shell_theme_the_article_tile( $index = 0, $display_context = 'default' ) {
	global $post;

	// Patch problématique interdépendance thème / plugin.
	if ( ! function_exists( 'platform_shell_get_html_formatted_date' ) ) {
		return '';
	}

	$published_date_message = _x( 'Publié le ', 'general', 'platform-shell-theme' ) . platform_shell_get_html_formatted_date( get_the_date( platform_shell_get_metadata_date_save_format() ), false );
	$published_by           = _x( 'Par ', 'general', 'platform-shell-theme' ) . get_the_author_meta( 'display_name' );

	/* Affichage du template. */
	?>
	<?php if ( 'home' === $display_context ) : ?>
		<li>
			<a href="<?php the_permalink(); ?>"  style="<?php echo platform_shell_get_thumbnail_inline_style_override( $post, 'article-homepage-medium' ); ?>">
				<span class="fondDegrad">
					<span class="tuileZoneTexte">
						<span class="tuileTitre"><?php the_title(); ?></span>
						<span><?php echo wp_kses_post( $published_date_message ); ?></span>
					</span>
				</span>
			</a>
		</li>
	<?php else : ?>
		<li>
			<a href="<?php the_permalink(); ?>"  class="imgActivite">
				<?php echo platform_shell_get_thumnail_image( $post, 'thumbnail' ); ?>
			</a>
			<div class="contenuListeActivite">
				<h2><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h2>
				<p><?php the_excerpt(); ?></p>
				<span>
					<?php
					// todo : corriger message avec 2 params.
					echo wp_kses_post( $published_date_message . ' ' . _x( 'à', 'general', 'platform-shell-theme' ) . ' ' . get_the_time() );
					?>
					<br />
					<?php echo wp_kses_post( $published_by ); ?>
				</span>
			</div>
		</li>
	<?php endif; ?>
	<?php
}

/**
 * Méthode pour retourner le alt de l'image mise en avant s'il existe.
 *
 * @param int $post_id    Identifiant du post.
 * @return string
 */
function platform_shell_theme_get_post_featured_image_alt( $post_id ) {
	$post_thumbnail_id = get_post_thumbnail_id( $post_id );
	$image_alt         = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );

	return $image_alt;
}

/**
 * Méthode pour récupérer un tag image si l'url existe.
 *
 * @param int|object $post        Post ou post id.
 * @param string     $size        Identifiant de taille de vignette.
 * @return string                 html du tag image pour l'afficher une vignette.
 */
function platform_shell_get_thumnail_image( $post, $size ) {

	$url = get_the_post_thumbnail_url( $post, $size );

	if ( ! empty( $url ) ) {
		$alt = platform_shell_theme_get_post_featured_image_alt( $post->ID );
		return '<img src="' . $url . '" alt="' . $alt . '" />';
	} else {
		return '';
	}
}

/**
 * Méthode platform_shell_theme_get_contests_list_query
 *
 * @return WP_Query
 */
function platform_shell_theme_get_contests_list_query() {
	$args = [
		'post_type' => 'contest',
		'orderby'   => 'modified',
		'order'     => 'DESC',
	];

	return new WP_Query( $args );
}

/**
 * Méthode platform_shell_theme_get_articles_list_query
 *
 * @return WP_Query
 */
function platform_shell_theme_get_articles_list_query() {
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => platform_shell_theme_get_post_per_page_for_list(),
		'orderby'        => 'modified',
		'order'          => 'DESC',
	);

	// Support du paging (page_navi()).
	// Voir cette page pour info sur le problème : http://wordpress.stackexchange.com/questions/120407/how-to-fix-pagination-for-custom-loops.
	$args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	$query = new WP_Query( $args );
	return $query;
}

/**
 * Méthode platform_shell_theme_get_articles_home_list_query
 *
 * @return WP_Query
 */
function platform_shell_theme_get_articles_home_list_query() {
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 4,
		'orderby'        => 'modified',
		'order'          => 'DESC',
	);

	$query = new WP_Query( $args );
	return $query;
}

/**
 * Méthode platform_shell_theme_get_equipments_list_query
 *
 * @return WP_Query
 */
function platform_shell_theme_get_equipments_list_query() {
	$args = array(
		'post_type'      => 'equipment',
		'posts_per_page' => 4,
		'orderby'        => 'modified',
		'order'          => 'DESC',
	);

	$query = new WP_Query( $args );
	return $query;
}

/**
 * Méthode platform_shell_theme_get_tools_list_query
 *
 * @return WP_Query
 */
function platform_shell_theme_get_tools_list_query() {
	$args = array(
		'post_type'      => 'tool',
		'posts_per_page' => 4,
		'orderby'        => 'modified',
		'order'          => 'DESC',
	);

	$query = new WP_Query( $args );
	return $query;
}


/**
 * Méthode platform_shell_theme_get_published_active_query
 *
 * @return WP_Query
 */
function platform_shell_theme_get_published_active_query() {
	global $wp_query;

	return new WP_Query( ( array_merge( $wp_query->query_vars, [ 'post_status' => 'publish' ] ) ) );
}

/**
 * Méthode platform_shell_theme_get_default_active_taxonomy_filtered_query
 *
 * @return WP_Query
 */
function platform_shell_theme_get_published_active_taxonomy_filtered_query() {

	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	$args = array(
		'post_type'      => 'project',
		'pagination'     => true,
		'paged'          => $paged,
		'posts_per_page' => platform_shell_theme_get_post_per_page_for_tiles(),
		'orderby'        => 'modified',
		'order'          => 'DESC',
		'tax_query'      => array(
			array(
				'taxonomy' => 'platform_shell_tax_proj_cat',
				'field'    => 'slug',
				'terms'    => $term->slug,
			),
		),
	);

	$query = new WP_Query( $args );

	return $query;
}

/**
 * Méthode platform_shell_theme_get_default_active_query
 *
 * @return \WP_Query
 */
function platform_shell_theme_get_default_active_query() {
	global $wp_query;
	return $wp_query;
}

/**
 * Méthode platform_shell_theme_get_projects_list_by_user_query
 *
 * @param integer $user_id             Identifiant de l'utilisateur.
 * @param boolean $show_unpublished    Si le projet est publié.
 * @return WP_Query
 */
function platform_shell_theme_get_projects_list_by_user_query( $user_id, $show_unpublished = false ) {

	$status = 'publish';

	if ( true === $show_unpublished ) {
		$status = [ 'publish', 'draft' ];
	}

	$args = array(
		'post_type'      => 'project',
		'author'         => $user_id,
		'posts_per_page' => -1, /* Intégration du paging dans profil est problématique, params de page passé par url. Version 1 : On affiche TOUT!. */
		'fields'         => 'ids',
		'post_status'    => $status,
	);

	$query = new WP_Query( $args );

	$direct_projects = $query->posts;

	$args = array(
		'post_type'      => 'project',
		'posts_per_page' => -1, /* Intégration du paging dans profil est problématique, params de page passé par url. Version 1 : On affiche TOUT!. */
		'fields'         => 'ids',
		'post_status'    => $status,
		'meta_query'     => [
			[
				'key'     => 'platform_shell_meta_project_cocreators',
				// Ce regex recherche les différentes positions possibles de l'ID de l'utilisateur.
				// Seul co-créateur (^666$), première position ( ^666,), à l'intérieur de la liste (,666,) et à la fin de la liste (,666$).
				'value'   => sprintf( '^%1$s$|^%1$s,|,%1$s,|,%1$s$', $user_id ),
				'compare' => 'REGEXP',
			],
		],
	);

	$query = new WP_Query( $args );

	$collab_projects = $query->posts;

	$project_ids = array_merge( $direct_projects, $collab_projects );
	$project_ids = array_unique( $project_ids );

	$args = [];

	// S'assurer que $project_ids n'est pas vide.
	// https://core.trac.wordpress.org/ticket/28099.
	if ( sizeof( $project_ids ) > 0 ) {
		$args = [
			'post_type'           => 'project',
			'orderby'             => 'modified',
			'order'               => 'DESC',
			'posts_per_page'      => -1, /* Intégration du paging dans profil est problématique, params de page passé par url. Version 1 : On affiche TOUT!. */
			'post_status'         => $status,
			'post__in'            => $project_ids,
			'ignore_sticky_posts' => true,
		];
	}

	$query = new WP_Query( $args );

	return $query;
}

/**
 * Méthode platform_shell_theme_get_projects_list_query
 *
 * @return WP_Query
 */
function platform_shell_theme_get_projects_list_query() {
	$args = array(
		'post_type'      => 'project',
		'posts_per_page' => 5,
		'post_status'    => 'publish',
		'orderby'        => 'modified',
		'order'          => 'DESC',
	);

	$query = new WP_Query( $args );
	return $query;
}

/* todo_eg. Convertir affichage blocs home en widgets? */

/**
 * Méthode platform_shell_theme_get_activities_list_query
 *
 * @return WP_Query
 */
function platform_shell_theme_get_activities_list_query() {
	$args = array(
		'post_type'      => 'activity',
		'posts_per_page' => 2,
		'meta_key'       => 'platform_shell_meta_activity_date', /* Date requise pour affichage. */
		'orderby'        => 'meta_value',
		'order'          => 'ASC',
	);

	$my_query = new WP_Query( $args );
	return $my_query;
}

/**
 * Méthode platform_shell_theme_get_post_per_page_for_tiles
 *
 * @return number
 */
function platform_shell_theme_get_post_per_page_for_tiles() {
	return 12;
}

/**
 * Méthode platform_shell_theme_get_post_per_page_for_tiles
 *
 * @return number
 */
function platform_shell_theme_get_post_per_page_for_list() {
	return 10;
}

/**
 * Méthode platform_shell_theme_get_search_result_item_label_for_post_type
 *
 * @param string $post_type    Post type.
 * @return string
 */
function platform_shell_theme_get_search_result_item_label_for_post_type( $post_type ) {
	$pt = get_post_type_object( $post_type );
	return $pt->labels->singular_name;
}

/**
 * Méthode platform_shell_filter_and_display_wysiwyg
 *
 * Applique les même filtres que la méthode the_content.
 *
 * @param string $content    Contenu à afficher.
 */
function platform_shell_filter_and_display_wysiwyg( $content ) {
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	echo wp_kses_post( $content );
}

/**
 * Fonction platform_shell_theme_get_comment_author_filter
 *
 * Cette méthode retourne le display_name le plus récent pour l'utilisateur qui a écrit un commentaire.
 *
 * @param string     $return        La valeur actuelle du filtre.
 * @param string     $comment_id    L'id du commentaire.
 * @param WP_Comment $comment       L'instance du commentaire.
 * @return string                   Le "display_name" de l'auteur si disponible, sinon c'est la valeur passé à cette fonction.
 */
function platform_shell_theme_get_comment_author_filter( $return, $comment_id, $comment ) {

	// L'on obtiens l'usagé référencé dans le commentaire.
	if ( isset( $comment->user_id ) && ( 0 !== intval( $comment->user_id ) ) ) {
		$author = get_user_by( 'ID', $comment->user_id );

		if ( false !== $author ) {
			if ( isset( $author->display_name ) && ! empty( $author->display_name ) ) {
				$return = $author->display_name;
			}
		}
	}

	// Si l'usager n'existe plus, nous utilisons la valeur du commentaire.
	return $return;
}
add_filter( 'get_comment_author', 'platform_shell_theme_get_comment_author_filter', 10, 3 );
