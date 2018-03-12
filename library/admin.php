<?php
/*
This file handles the admin area and functions.
You can use this file to make changes to the
dashboard. Updates to this page are coming soon.
It's turned off by default, but you can call it
via the functions file.

Developed by: Eddie Machado
URL: http://themble.com/bones/

Special Thanks for code & inspiration to:
@jackmcconnell - http://www.voltronik.co.uk/
Digging into WP - http://digwp.com/2010/10/customize-wordpress-dashboard/

*/

/************* DASHBOARD WIDGETS *****************/

// disable default dashboard widgets
function disable_default_dashboard_widgets() {

	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');         // dashboard_primary
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       // dashboard_secondary
	
	remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget
}

// removing the dashboard widgets
add_action('admin_menu', 'disable_default_dashboard_widgets');


/************* CUSTOM LOGIN PAGE *****************/
// changing the logo link from wordpress.org to your site
function wp_bootstrap_login_url() { 
	return get_bloginfo('url', 'raw');
}

// changing the alt text on the logo to show your site name
function wp_bootstrap_login_title() { return get_option('blogname'); }

function change_login_logo() {
	$data = get_platform_shell_site_logo_url_data();
	
	if (!isset($data)) {
		throw new \Exception('Impossible de déterminer l’url du logo (default manquant?).');
	}
	?>
		<style type="text/css">
			#login h1 a, .login h1 a {
				background-image: url(<?php echo $data['url'] ?>);
			}
		</style>
	<?php
}

/* Modifier look login, voir voir https://codex.wordpress.org/Customizing_the_Login_Form */
add_action('login_enqueue_scripts', 'change_login_logo');
add_filter('login_headerurl', 'wp_bootstrap_login_url');
add_filter('login_headertitle', 'wp_bootstrap_login_title');
