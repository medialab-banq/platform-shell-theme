<?php
/**
 * Template pour la liste des équipements
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

?>
<section class="contenu row">
	<header class="col-xs-12">
		<h1><?php echo esc_html_x( 'Équipements', 'list-equipments', 'platform-shell-theme' ); ?></h1>
		<p><?php echo esc_html_x( 'Les équipements ci-dessous sont disponibles sur place.', 'list-equipments', 'platform-shell-theme' ); ?></p>
	</header>

	<article id="accueilProjets" class="col-lg-9 col-sm-8 col-xs-12 listeProjets" >

		<?php
		$params_array = array(
			'title'                   => null,
			'allItems'                => null,
			'noItems'                 => _x( 'Aucun équipement disponible', 'list-equipments', 'platform-shell-theme' ),
			'get_query_function_name' => 'platform_shell_theme_get_default_active_query',
			'the_tile_function_name'  => 'platform_shell_theme_the_equipment_tile',
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
</section>
