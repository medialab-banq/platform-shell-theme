<?php
/**
 * Template pour la liste des "Quoi de neuf?"
 * NE PAS ENLEVER_Debut. Requis pour affichage dans liste template WordPress.
 * Template Name: liste Qdn
 * NE PAS ENLEVER_Fin. Requis pour affichage dans liste template WordPress.
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

get_header();
?>

<section class="contenu row">

	<header class="col-lg-9 col-sm-8 col-xs-12">
		<h1><?php echo esc_html_x( 'Quoi de neuf ?' /* devrait être le titre de page?. */, 'list-qdn', 'platform-shell-theme' ); ?></h1>
	</header>

	<article id="listeActivite" class="col-lg-9 col-sm-8 col-xs-12" >

		<?php
		$saved_custom_query;

		$query_created_function = function( $query ) use ( &$saved_custom_query ) {
			$saved_custom_query = $query;
		};

		$params_array = array(
			'title'                   => null,
			'allItems'                => null,
			'noItems'                 => _x( 'Il n’y a aucun article.', 'list-qdn', 'platform-shell-theme' ),
			'get_query_function_name' => 'platform_shell_theme_get_articles_list_query',
			'the_tile_function_name'  => 'platform_shell_theme_the_article_tile',
			'itemsListUrl'            => null,
			'query_created_callback'  => $query_created_function,
			'no_auto_reset'           => true, /* hack, voir note plus bas. */
		);

		platform_shell_theme_the_tile_container( $params_array );
		?>

		<?php if ( function_exists( 'page_navi' ) ) { // if experimental feature is active. ?>
			<div class="text-center wrapper">
			<?php
			global $wp_query;

			/*
			 * Hack :
			 * Problème de page_navi qui dépend de wp_query et utilisation de custom_query. À réviser.
			 * mais ce n'est pas trivial à corriger.
			 *
			 * On veut:
			 *  - Assigner temporairement custom_query à wp_query (équivalent à un push state)
			 *  - Générer les liens (donc )
			 *  - Remettre wp_query actif (équivalent à un pop state)
			 *  - compléter le reset.
			 */
			$saved_wp_query = $wp_query;

			// phpcs:ignore WordPress
			$wp_query = $saved_custom_query;

			page_navi(); // use the page navi function.

			// phpcs:ignore WordPress
			$wp_query = $saved_wp_query;
			wp_reset_postdata();
			?>
			</div>
			<?php } ?>

	</article>
</section>


<?php get_footer(); ?>
