<?php
/**
 * Template pour les auteurs
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

get_header();
?>
<section class="contenu row">
	<header class="col-xs-12">
		<h1><span><?php echo esc_html_x( 'Articles de', 'author', 'platform-shell-theme' ); ?></span>
			<?php
			// If google profile field is filled out on author profile, link the author's page to their google+ profile page.
			$curauth = ( get_query_var( 'author_name' ) ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );
			echo esc_html( get_the_author_meta( 'display_name', $curauth->ID ) );
			?>
		</h1>
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
			'noItems'                 => esc_html_x( 'Aucun article disponible', 'author', 'platform-shell-theme' ),
			'get_query_function_name' => 'platform_shell_theme_get_default_active_query',
			'the_tile_function_name'  => 'platform_shell_theme_the_article_tile',
			'itemsListUrl'            => null,
			'query_created_callback'  => $query_created_function,
			'no_auto_reset'           => true, /* hack, voir note plus bas. */
			'displayContext'          => 'author',
		);

		platform_shell_theme_the_tile_container( $params_array );
		?>

		<?php if ( function_exists( 'page_navi' ) ) { // if experimental feature is active. ?>
			<div class="text-center wrapper">
			<?php
			global $wp_query;

			/**
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
			$wp_query       = $saved_custom_query; // phpcs:ignore WordPress

			page_navi(); // use the page navi function.

			$wp_query = $saved_wp_query; // phpcs:ignore WordPress
			wp_reset_postdata();
			?>
			</div>
			<?php } ?>

	</article>
</section>

<?php get_footer(); ?>
