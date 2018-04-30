<?php
/**
 * Functions pour les settings du plugin.
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

use Platform_Shell\Profile;

/**
 * Méthode platform_shell_get_option_json_ld
 *
 * @return mixed
 */
function platform_shell_get_option_json_ld() {
	return platform_shell_get_option( 'platform_shell_option_json_ld', 'platform-shell-settings-google-tag-and-json-ld', '' /* Vide par défault. */ );
}

/**
 * Méthode platform_shell_render_json_ld
 */
function platform_shell_render_json_ld() {
	$json_ld = platform_shell_get_option_json_ld();

	if ( '' !== $json_ld ) {
		// phpcs:ignore WordPress --JSON
		echo '<script type="application/ld+json">' . $json_ld . '</script>';
	}
}

/**
 * Méthode platform_shell_render_google_tracking_code
 */
function platform_shell_render_google_tracking_code() {
	$google_tracking_code = platform_shell_get_option( 'platform_shell_option_google_tag_manager_tracking_code', 'platform-shell-settings-google-tag-and-json-ld', '' /* Vide par défault. */ );
	if ( '' !== $google_tracking_code ) {
		// phpcs:ignore WordPress --Javascript code
		echo $google_tracking_code;
	}
}

/**
 * Méthode platform_shell_get_option_google_tag_manager_no_script_url
 *
 * @return mixed
 */
function platform_shell_render_google_tag_manager_no_script() {
	$google_tracking_code_no_script = platform_shell_get_option( 'platform_shell_option_google_tag_manager_no_script', 'platform-shell-settings-google-tag-and-json-ld', '' /* Vide par défault. */ );
	if ( '' !== $google_tracking_code_no_script ) {
		// phpcs:ignore WordPress --Javascript code
		echo $google_tracking_code_no_script;
	}
}

/**
 * Méthode platform_shell_get_option_home_page_show_header_box
 *
 * @return boolean
 */
function platform_shell_get_option_home_page_show_header_box() {
	$option = platform_shell_get_option( 'platform_shell_option_home_page_show_header_box', 'platform-shell-settings-page-site-sections-home', 'on' /* Montrer par défault. */ );
	return platform_shell_option_is_checked( $option );
}

/**
 * Méthode platform_shell_get_option_header_box_title
 *
 * @return mixed
 */
function platform_shell_get_option_header_box_title() {
	return platform_shell_get_option( 'platform_shell_option_home_page_header_box_title', 'platform-shell-settings-page-site-sections-home', '?' );
}

/**
 * Méthode platform_shell_get_option_show_social_menu
 *
 * @return boolean
 */
function platform_shell_get_option_show_social_menu() {
	$option = platform_shell_get_option( 'platform_shell_option_show_social_menu', 'platform-shell-settings-page-site-sections-general', 'on' /* Montrer par défault. */ );
	return platform_shell_option_is_checked( $option );
}

/**
 * Méthode platform_shell_render_header_social_menu
 */
function platform_shell_render_header_social_menu() {

	$menu = wp_nav_menu(
		[
			'menu'           => platform_shell_theme_get_installed_menu_wp_menu_id( 'platform_shell_menu_social_links' ),
			'walker'         => new Social_Media_Links_Walker_Header_Menu(),
			'theme_location' => '__no_such_location', /* bug fix wordpress */
			'fallback_cb'    => false,
			'items_wrap'     => '%3$s', /* Enlever niveau ul. Voir https://wordpress.stackexchange.com/questions/7968/how-do-i-remove-ul-on-wp-nav-menu */
			'container'      => '', /* Enlever niveau div. */
			'echo'           => false,
		]
	);

	if ( ! empty( $menu ) ) {
		echo '<div class="navmain2">' . wp_kses_post( $menu ) . '</div>';
	} else {
		echo '<li>' . wp_kses_post( _x( 'Menu d’accès aux médias sociaux non défini.<br/> Veuillez vérifier les réglages de la plateforme.', 'platform_shell_option', 'platform-shell-theme' ) ) . '</li>';
	}
}

/**
 * Méthode platform_shell_get_option_parent_organisation_logo
 *
 * @return mixed
 */
function platform_shell_get_option_parent_organisation_logo() {
	$default_sample = get_stylesheet_directory_uri() . '/images/interface/samples/organisation_logo_header.png';
	return platform_shell_get_option( 'platform_shell_option_parent_organisation_logo_url', 'platform-shell-settings-page-site-sections-general', $default_sample /* Image échantillon. */ );
}

/**
 * Méthode platform_shell_get_option_parent_organisation_link
 *
 * @return mixed
 */
function platform_shell_get_option_parent_organisation_link() {
	return platform_shell_get_option( 'platform_shell_option_parent_organisation_link', 'platform-shell-settings-page-site-sections-general', '' /* Rien par défaut. */ );
}

/**
 * Méthode platform_shell_get_option_parent_organisation_alt
 *
 * @return mixed
 */
function platform_shell_get_option_parent_organisation_alt() {
	$default_alt = _x( 'Nom de l’organisation à personnaliser (alt image logo)', 'platform_shell_option', 'platform-shell-theme' );
	return platform_shell_get_option( 'platform_shell_option_parent_organisation_alt', 'platform-shell-settings-page-site-sections-general', $default_alt );
}

/**
 * Méthode platform_shell_get_option_show_coordinate_and_opening_hours_box
 *
 * @return boolean
 */
function platform_shell_get_option_show_coordinate_and_opening_hours_box() {
	$option = platform_shell_get_option( 'platform_shell_option_home_page_show_coordinate_and_opening_hours_box', 'platform-shell-settings-page-site-sections-home', 'on' /* Montrer par défault. */ );
	return platform_shell_option_is_checked( $option );
}

/**
 * Méthode platform_shell_get_option_contact_adress
 *
 * @return string
 */
function platform_shell_get_option_contact_adress() {
	/*
	 * Note : Hack bug styles trop dépendants de la structure html + wysiwig avec p (pas br).
	 * La mise en place ne gère pas l'addresse avec lignes paragraphe,
	 * Il y a des styles div qui entre en conflit.
	 * Le hack transforme le html provenant du wysiwig (avec p) dans le format d'affichage du thème original.
	 * todo : modifier style et html pour avoir une version compatible avec wysiwig.
	 */

	$contact_adress_html = platform_shell_get_option( 'platform_shell_option_contact_adress', 'platform-shell-settings-page-site-sections-home', '?' );
	return platform_shell_hack_wysiwig_html_replace_paragraph_with_br( $contact_adress_html );
}

/**
 * Méthode platform_shell_hack_wysiwig_html_replace_paragraph_with_br
 *
 * @param string $html_text   Code html provenant de l'éditeur.
 * @return string
 */
function platform_shell_hack_wysiwig_html_replace_paragraph_with_br( $html_text ) {
	$html_text_without_closing_p_add_br = str_replace( '</p>', '<br />', $html_text ); /* Remplacer les p de fermeture par un br. */
	$html_text_without_opening_p        = str_replace( '<p>', '', $html_text_without_closing_p_add_br ); /* Enlever les p d'ouverture. */

	return $html_text_without_opening_p;
}

/**
 * Méthode platform_shell_get_option_contact_general_email
 *
 * @return mixed
 */
function platform_shell_get_option_contact_general_email() {
	$no_contact_email_dont_user_admin_email_for_public_contact = '';
	return platform_shell_get_option( 'platform_shell_option_contact_manager_email_adress', 'platform-shell-settings-main-contacts-and-notifications', $no_contact_email_dont_user_admin_email_for_public_contact );
}

/**
 * Méthode platform_shell_get_option_contact_phone_numer
 *
 * @return mixed
 */
function platform_shell_get_option_contact_phone_numer() {
	return platform_shell_get_option( 'platform_shell_option_contact_phone_numer', 'platform-shell-settings-page-site-sections-home', '?' );
}

/**
 * Méthode platform_shell_get_option_itinerary_url
 *
 * @return mixed
 */
function platform_shell_get_option_itinerary_url() {
	$default_location = '';
	return platform_shell_get_option( 'platform_shell_option_itinerary_url', 'platform-shell-settings-page-site-sections-home', $default_location );
}

/**
 * Méthode platform_shell_render_itinerary_link
 */
function platform_shell_render_itinerary_link() {
	$itinerary_url = platform_shell_get_option_itinerary_url();
	if ( '' !== $itinerary_url ) {
		echo '<a href="' . esc_url( $itinerary_url ) . '" target="_blank">' . esc_html_x( 'Itinéraire', 'footer', 'platform-shell-theme' ) . '</a>';
	}
}

/**
 * Méthode platform_shell_get_option_opening_hours
 *
 * @return string
 */
function platform_shell_get_option_opening_hours() {
	/*
	 * Note : Hack bug styles trop dépendants de la structure html + wysiwig avec p (pas br).
	 * Le hack transforme le html provenant du wysiwig (avec p) dans le format d'affichage du thème original.
	 * todo : modifier style et html pour avoir une version compatible avec wysiwig.
	 */
	$opening_hours_html = platform_shell_get_option( 'platform_shell_option_opening_hours', 'platform-shell-settings-page-site-sections-home', '?' );
	return platform_shell_hack_wysiwig_html_replace_paragraph_with_br( $opening_hours_html );
}

/**
 * Méthode get_platform_shell_footer_location_background_forced_element_style
 *
 * @return string
 */
function get_platform_shell_footer_location_background_forced_element_style() {
	// todo_refactoring: Solution de transition. Un peu hack (utilisation de style sur node).
	// Il faudrait évaluer solution avec image en tag (donc refaire intégration html).
	$default_sample   = get_stylesheet_directory_uri() . '/images/interface/samples/footer_address_background.png';
	$background_image = platform_shell_get_option( 'platform_shell_footer_location_background_url', 'platform-shell-settings-page-site-sections-home', '' );
	if ( empty( $background_image ) ) {
		// Si l'entrée est vide ou nulle, on utilise toujours l'image 'démo', l'affichage vide (en blanc) rend le widget inutilisable / illisible.
		$background_image = $default_sample;
	}

	return 'background: url(' . $background_image . ') no-repeat center center;';
}

/**
 * Méthode get_platform_shell_show_contributors_footer
 *
 * @return boolean
 */
function get_platform_shell_show_contributors_footer() {
	$option = platform_shell_get_option( 'platform_shell_show_contributors_footer', 'platform-shell-settings-page-site-sections-home', 'on' /* Visible par défaut. */ );

	return platform_shell_option_is_checked( $option );
}

/**
 * Méthode platform_shell_render_partners_footer
 */
function platform_shell_render_partners_footer() {

	echo '<div id="footLogo" class="row">';
	echo '<span>' . esc_html_x( 'Réalisé grâce à', 'footer', 'platform-shell-theme' ) . '</span>';
	platform_shell_theme_partners_footer_links();
	echo '</div>';
}

/**
 * Méthode get_platform_shell_site_logo_url_data
 *
 * @return array
 */
function get_platform_shell_site_logo_url_data() {

	$default_url = get_stylesheet_directory_uri() . '/images/interface/samples/site_logo_home.png';
	$default_alt = _x( 'Logo du site (à personnaliser)', 'platform_shell_option', 'platform-shell-theme' );

	$url = platform_shell_get_option( 'platform_shell_site_logo_url', 'platform-shell-settings-page-site-sections-general', $default_url /* logo exemple. */ );
	$alt = platform_shell_get_option( 'platform_shell_site_logo_alt_title', 'platform-shell-settings-page-site-sections-general', $default_alt /* logo exemple. */ );

	return [
		'url' => $url,
		'alt' => $alt,
	];
}

/**
 * Méthode get_platform_shell_other_pages_site_logo_url_data
 *
 * @return mixed
 */
function get_platform_shell_other_pages_site_logo_url_data() {
	$default_sample = [
		'url' => get_stylesheet_directory_uri() . '/images/interface/samples/site_logo_other_pages.png',
		'alt' => _x( 'Logo du site page (à personnaliser)', 'platform_shell_option', 'platform-shell-theme' ),
	];

	return get_option( 'platform_shell_site_logo_url_data', $default_sample /* logo exemple. */ );
}

/**
 * Méthode platform_shell_render_site_logo
 */
function platform_shell_render_site_logo() {

	$data = get_platform_shell_site_logo_url_data();
	platform_shell_render_logo( $data, 'bigger-banner' );
}

/**
 * Méthode platform_shell_render_other_pages_site_logo
 */
function platform_shell_render_other_pages_site_logo() {
	$data = get_platform_shell_site_logo_url_data();
	platform_shell_render_logo( $data, 'smaller-banner' );
}

/**
 * Méthode platform_shell_render_logo
 *
 * @param array  $data     Tableau contenant l'ingormation sur le logo.
 * @param string $class    Classe à assigner au tag image.
 */
function platform_shell_render_logo( $data, $class = null ) {
	$url   = isset( $data['url'] ) ? $data['url'] : '';
	$alt   = isset( $data['alt'] ) ? $data['alt'] : '';
	$class = isset( $class ) ? $class : '';

	echo '<img class="' . esc_attr( $class ) . '" src="' . esc_url( $url ) . '" alt="' . esc_attr( $alt ) . '" />';
}

/**
 * Méthode platform_shell_get_option
 *
 * Get the value of a settings field
 *
 * @param string $option     Settings field name.
 * @param string $section    The section name this field belongs to.
 * @param string $default    Default text if it's not found.
 * @return mixed
 */
function platform_shell_get_option( $option, $section, $default = '' ) {
	/* Voir https://github.com/tareq1988/wordpress-settings-api-class */
	$options = get_option( $section );

	if ( isset( $options[ $option ] ) ) {
		return $options[ $option ];
	}

	return $default;
}

/**
 * Méthode platform_shell_option_is_checked
 *
 * @param string $option    Texte associé à l'option (on/off).
 * @return boolean
 */
function platform_shell_option_is_checked( $option ) {
	if ( 'on' === $option ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Méthode platform_shell_theme_the_social_media_links
 */
function platform_shell_theme_the_social_media_links() {
	include locate_template( 'partials/social-media-sharing-links.php' );
}

/**
 * Méthode platform_shell_render_facebook_sharing_script_tag
 */
function platform_shell_render_facebook_sharing_script_tag() {
	/* SDK Facebook  */
	$script = platform_shell_get_option( 'platform_shell_option_social_sharing_facebook_script_tag', 'platform-shell-settings-social-sharing-facebook', '' );

	// La documentation de Facebook n'est pas claire. Ne devrait plus être requis
	// mais le sharing ne fonctionne pas si le tag n'est pas présent.
	if ( '' !== $script ) {
		// phpcs:ignore WordPress --Javascript code
		echo '<div id="fb-root"></div><script>' . $script . '</script>';
	}
}

/**
 * Méthode platform_shell_render_head_tags
 */
function platform_shell_render_head_tags() {
	platform_shell_render_json_ld();
	wp_head();
	platform_shell_render_google_tracking_code();
}

/**
 * Méthode platform_shell_get_profile_url
 *
 * @return string
 */
function platform_shell_get_profile_url() {
	return Profile::get_profile_url( get_current_user_id() );
}

/**
 * Méthode platform_shell_theme_social_media_footer_links
 */
function platform_shell_theme_social_media_footer_links() {
	wp_nav_menu(
		[
			'menu'           => platform_shell_theme_get_installed_menu_wp_menu_id( 'platform_shell_menu_social_links' ),
			'walker'         => new Social_Media_Links_Walker_footer_Menu(),
			'theme_location' => '__no_such_location', /* bug fix wordpress */
			'fallback_cb'    => false,
		]
	);
}

/**
 * Méthode platform_shell_theme_partners_footer_links
 */
function platform_shell_theme_partners_footer_links() {
	wp_nav_menu(
		[
			'menu'           => platform_shell_theme_get_installed_menu_wp_menu_id( 'platform_shell_menu_partners_links' ),
			'walker'         => new Partners_Links_Walker_Footer_Menu(),
			'theme_location' => '__no_such_location', /* bug fix wordpress */
			'fallback_cb'    => false,
		]
	);
}

/**
 * Méthode platform_shell_theme_render_login_header_links
 */
function platform_shell_theme_render_login_header_links() {

	$current_user = wp_get_current_user();
	if ( 0 !== $current_user->ID ) { // Ne pas afficher si utilisateur non connecté.
		$user_roles = (array) $current_user->roles;

		if ( in_array( 'platform_shell_role_user', $user_roles, true ) ) {
			$menu = wp_nav_menu(
				[
					'menu'           => platform_shell_theme_get_installed_menu_wp_menu_id( 'platform_shell_menu_user_links' ),
					'walker'         => new Login_Links_Walker_Header_Menu(),
					'theme_location' => '__no_such_location', /* bug fix wordpress */
					'fallback_cb'    => false,
					'items_wrap'     => '%3$s', /* Enlever niveau ul. Voir https://wordpress.stackexchange.com/questions/7968/how-do-i-remove-ul-on-wp-nav-menu */
					'container'      => '',  /* Enlever niveau div. */
					'echo'           => false,
				]
			);

			// Ne pas afficher de message si le menu n'existe pas. Menu optionnel.
			if ( ! empty( $menu ) ) {
				// phpcs:ignore WordPress --Menu généré par WordPress
				echo $menu;
			}
		} else {
			if ( in_array( 'platform_shell_role_manager', $user_roles, true ) || in_array( 'administrator', $user_roles, true ) ) {
				echo '<li><a href="' . esc_url( get_dashboard_url() ) . '">' . esc_html_x( 'Gestion', 'header-login-link', 'platform-shell-theme' ) . ' <i class="fa fa-cogs" aria-hidden="true"></i></a></li>';
			}
		}
	}

}

/**
 * Méthode platform_shell_theme_primary_footer_links
 */
function platform_shell_theme_primary_footer_links() {
	wp_nav_menu(
		[
			'menu'            => platform_shell_theme_get_installed_menu_wp_menu_id( 'platform_shell_menu_primary_footer' ),
			'theme_location'  => 'footer_links',
			'container_class' => 'footer-links clearfix',
			'fallback_cb'     => 'wp_bootstrap_footer_links_fallback',
		]
	);
}

/**
 * Méthode pour déterminer le post type name du contexte courant s'il existe.
 * Page single post type et archive retourne post type name.
 * Cas spécial pour platform_shell_tax_proj_cat puisqu'il n'est pas possible de déterminer le post type lorsqu'on affiche archive taxonomie.
 *
 * @return string
 */
function platform_shell_get_queried_object_post_type_name() {
	// Déterminer le contexte est complexe.
	// Si est dans le filtre par exemple, on se trouve au niveau de taxonomie et on pas l'info du post type.
	$queried_object = get_queried_object(); // WP_Term object, WP_Post_Type object, WP_Post object.

	if ( isset( $queried_object ) ) {
		$class_name = get_class( $queried_object );

		switch ( $class_name ) {
			case 'WP_Term' /* Filtre catégorie par ex. */:
				// Sur taxonomie. Pas possible de le déterminer directement.
				// todo: Pas idéal mais pas de manière simple d'implémenter ça.
				if ( is_tax( 'platform_shell_tax_proj_cat' ) ) {
					return 'project';
				}
				break;
			case 'WP_Post_Type' /* Archive par ex. */:
				return $queried_object->name;
				break;
			case 'WP_Post':
				$post             = get_post();
				$post_type_object = get_post_type_object( get_post_type( $post ) );
				return $post_type_object->name;
				break;
		}
	}

	return null; /* Impossible de déduire un context de post. */
}

/**
 * Méthode pour récupérer le bandeau à afficher selon le contexte d'affichage et les configurations de bandeau.
 */
function platform_shell_get_banner() {

	$banner_title_prefix = 'banner_';

	// Valider s'il y a une assignation spécifique sur id post. Valide pour post / page / post type individuels seulement (archive exlues).
	// Valider si le post existe et retourner l'image.
	if ( is_singular() ) {
		$post_title = $banner_title_prefix . 'post_id_' . get_the_ID();
		$postid     = platform_shell_get_banner_postid_with_query( $post_title );

		if ( isset( $postid ) ) {
			return get_the_post_thumbnail_url( $postid, 'full' );
		}
	}

	// Valider s'il y a une assignation plus générale.
	$post_type_name = platform_shell_get_queried_object_post_type_name();

	if ( isset( $post_type_name ) ) {
		// Le match de bandeau se fait avec le post type name.
		$post_title = $banner_title_prefix . $post_type_name;
	} else {
		// todo: Traitement spécial accueil (bannière plus grande).
		if ( is_front_page() && is_home() ) {
			$post_title = $banner_title_prefix . 'front_page';
		}
	}

	// Vérifier si post avec identifiant général existe et retourner l'image (front_page + post types (post, page, project, contest, equipment, tool, activity)).
	if ( isset( $post_title ) ) {
		$postid = platform_shell_get_banner_postid_with_query( $post_title );
		if ( isset( $postid ) ) {
			return get_the_post_thumbnail_url( $postid, 'full' );
		}
	}

	// Dernière tentative avec default.
	$post_title = $banner_title_prefix . 'default';

	$postid = platform_shell_get_banner_postid_with_query( $post_title );

	// Vérifier si le post existe et retourner l'image.
	if ( isset( $postid ) ) {
		return get_the_post_thumbnail_url( $postid, 'full' );
	} else {
		return ''; /* no banner. */
	}
}

/**
 * Méthode pour retrouver le post id correspondant au titre.
 *
 * @global object $wpdb         Référence globale WordPress.
 * @param string $post_title    Titre du post.
 * @return string               Id du post.
 */
function platform_shell_get_banner_postid_with_query( $post_title ) {
	global $wpdb;

	$postid = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE BINARY post_title = %s AND post_type = 'banner' AND post_status = 'publish' LIMIT 1", array( $post_title ) ) );

	return $postid;
}

/**
 * Méthode pour récupérer l'id de menu WordPress en utilisant l'id de menu requis de la plateforme.
 *
 * @param string $platform_id    Identifiant du menu de la plateforme.
 * @return int                   Id de menu WordPress.
 * @throws \Exception            Erreur si menu n'existe pas.
 */
function platform_shell_theme_get_installed_menu_wp_menu_id( $platform_id ) {

	$installed_menus_option = get_option( 'platform_shell_installed_menus' );

	if ( isset( $installed_menus_option[ $platform_id ] ) ) {
		return $installed_menus_option[ $platform_id ];
	} else {
		throw new \Exception( "Menu platforme inconnu, vérifier l'installation : $platform_id" );
	}
}
