<?php

/*
Bones Plugins & Extra Functionality

This file contains extra features not 100% ready to be included
in the core. Feel free to edit anything here or even help us fix
and optimize the code!

IF YOU WANT TO DISABLE THIS FILE, REMOVE IT'S CALL IN THE FUNCTIONS.PHP FILE

*/

// adding the rel=me thanks to yoast
function yoast_allow_rel() {
	global $allowedtags;
	$allowedtags['a']['rel'] = array ();
}
add_action( 'wp_loaded', 'yoast_allow_rel' );

// adding facebook, twitter, & google+ links to the user profile
function bones_add_user_fields( $contactmethods ) {
	// Add Facebook
	$contactmethods['user_fb'] = 'Facebook';
	// Add Twitter
	$contactmethods['user_tw'] = 'Twitter';
	// Add Google+
	$contactmethods['google_profile'] = 'Google Profile URL';
	// Save 'Em
	return $contactmethods;
}
add_filter('user_contactmethods','bones_add_user_fields',10,1);

// ***************************************************************************

require_once dirname( __FILE__ ) . '/plugins/tgmpa/class-tgm-plugin-activation.php';

function platform_shell_load_textdomain() {
	$locale = apply_filters( 'theme_locale', get_locale(), 'tgmpa' );
	load_theme_textdomain( 'tgmpa', dirname( __FILE__ ) . '/plugins/tgmpa/languages/' );
}
add_action( 'init', 'platform_shell_load_textdomain', 1 );

add_action( 'tgmpa_register', 'platform_shell_register_required_plugins' );

// todo_eg : à revoir. Est-ce que tgmpa peut gérer update via repo git?
function platform_shell_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = [

		// L'extension principale.
		[
			'name'               => _x( 'Plateforme médialab BAnQ', 'theme-name', 'platform-shell-theme' ),
			'slug'               => 'platform-shell-plugin',
			'source'             => EPWP_LOCAL_PATH . '/library/plugins/platform-shell-plugin.zip',
			'required'           => true,
		],

		// L'extension TinyMCE Advanced.
		[
			'name'        => 'TinyMCE Advanced',
			'slug'        => 'tinymce-advanced',
			'required'    => false,
		],

		// L'extension Image Widget.
		[
			'name'        => 'Image Widget',
			'slug'        => 'image-widget',
			'required'    => false,
		],

		// L'extension Yoast SEO.
		[
			'name'        => 'Yoast SEO',
			'slug'        => 'wordpress-seo',
			'is_callable' => 'wpseo_init',
			'required'    => false,
		],

		// L'extension iThemes Security.
		[
			'name'        => 'iThemes Security',
			'slug'        => 'better-wp-security',
			'required'    => false,
		],
	];

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = [
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => [
			'menu_title'                      => __( 'Extensions du thème', 'platform-shell-theme' ),
			// Bug notice_cannot_install : https://github.com/TGMPA/TGM-Plugin-Activation/issues/731.
			'notice_cannot_install'           => _n_noop(
				'Vous n’avez pas les droits nécessaires pour installer l’extension %1$s.',
				'Vous n’avez pas les droits nécessaires pour installer les extensions %1$s.',
				'platform-shell-theme'
			), // %1$s = plugin name(s).

			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		],
	];

	tgmpa( $plugins, $config );
}


?>