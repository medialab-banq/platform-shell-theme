<?php
/**
 * Template pour la liste d'activitées
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

?>
<section class="contenu row">
	<header class="col-lg-9 col-sm-8 col-xs-12">
		<h1><?php echo esc_html_x( 'Activités', 'list-activities', 'platform-shell-theme' ); ?></h1>
	</header>

	<div class="col-lg-3 col-sm-4 col-xs-12 boutonListeProjet">

<?php

	$show_button_link_option = platform_shell_get_option( 'platform_shell_option_activities_show_group_activities_link_button', 'platform-shell-settings-page-site-sections-activities', 'on' /* Non visible par défaut. */ );

if ( platform_shell_option_is_checked( $show_button_link_option ) ) {
	$default_text = _x( '?', 'list-activities', 'platform-shell-theme' );
	$text         = platform_shell_get_option( 'platform_shell_option_activities_group_activities_button_label', 'platform-shell-settings-page-site-sections-activities', $default_text );
	$url          = platform_shell_get_option( 'platform_shell_option_activities_group_activities_url', 'platform-shell-settings-page-site-sections-activities', '' );
	// La configuration est vide (option définie, alors le défault ne suffit pas..
	if ( empty( $text ) ) {
		$text = $default_text;
	}
}
if ( ! empty( $url ) ) :
?>
	<a href="<?php echo esc_url( $url ); ?>" class="btn btn-primary"><?php echo wp_kses_post( $text ); ?></a>
<?php endif; ?>
	</div>

	<article id="listeActivite" class="col-lg-10 col-sm-9 col-xs-12">
		<?php
		$params_array = array(
			'title'                   => null,
			'allItems'                => null,
			'noItems'                 => _x( 'Aucune activité n’est prévue.', 'list-activities', 'platform-shell-theme' ),
			'get_query_function_name' => 'platform_shell_theme_get_default_active_query',
			'the_tile_function_name'  => 'platform_shell_theme_the_activity_tile',
			'itemsListUrl'            => null,
		);

		platform_shell_theme_the_tile_container( $params_array );
		?>

		<?php if ( function_exists( 'page_navi' ) ) { // if experimental feature is active. ?>
			<div class="wrapper text-center">
				<?php page_navi(); // use the page navi function. ?>
			</div>
		<?php } ?>

	</article>

	<aside class="col-lg-2 col-sm-3 col-xs-12">
	</aside>
</section>
